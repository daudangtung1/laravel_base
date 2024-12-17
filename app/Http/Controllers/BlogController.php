<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $files = Storage::disk('images')->files('/');

        $directorySize = collect(Storage::disk('images')->allFiles())->map(function ($item) {
            return Storage::disk('images')->size($item);
        })->sum();
        dump($directorySize);
        dump('============');
        foreach ($files as $file) {
            dump(Storage::disk('images')->size($file));
        }
        dd(1);
    }

    public function update(Request $request, $id)
    {
        $data = Blog::find($id); // id = 4
        $index = $request->index; // 10

        try {
            $tmpFirst = Blog::find($id);
            $update = Blog::find($index);
            unset($tmpFirst['id']);

            for ($i = $index - 1; $i >= $data->index; $i--) {
                $newData = Blog::find($i);
                $newData->update([
                    'index' => $newData->index + 1
                ]);
            }

            $update->update([
                'index' => $tmpFirst->index
            ]);

            dd('End');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }
}
