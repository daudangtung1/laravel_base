<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Author\Entities\Author;
use Pusher\Pusher;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.getLogin');
    }

    public function sendNoti()
    {
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            config('broadcasting.connections.pusher.options')
        );

        $data = ['message' => 'Hello, world!'];
        $pusher->trigger('art-app-channel', 'art-app-event', $data);


        $data = Author::find(1);

        if (!$data) {
            return response()->json(['message' => 'Error']);
        }
        $data->changeIsActive();
        return response()->json(['message' => 'Notification sent!']);
    }
}
