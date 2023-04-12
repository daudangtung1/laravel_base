<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\UserRole;

class DashboardController extends Controller
{
    public function index()
    {
        dd(UserRole::USER_ROLE);
    }
}
