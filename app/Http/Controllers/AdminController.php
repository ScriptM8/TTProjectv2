<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function user_index()
    {
        return view('user_index', ['users' => User::all()]);
    }
}
