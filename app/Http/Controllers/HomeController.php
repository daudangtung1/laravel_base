<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
