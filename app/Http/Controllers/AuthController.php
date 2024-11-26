<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\RegisterSendMail;
use Modules\Author\Entities\Author;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $input = $request->all();
        event(new RegisterSendMail($input));
        return response()->json('Success!');
    }
}
