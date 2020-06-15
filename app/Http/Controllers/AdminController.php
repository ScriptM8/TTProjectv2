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

    public function user_show($id)
    {
        return view('profile', ['user' => User::findOrFail($id), 'role' => Auth::user()->role]);
    }

    public function user_delete($id)
    {
        $user = User::findOrFail($id);
        if ($user->profile_img_path != 'default_user.png') {
            Storage::delete('profile_img/'.$user->profile_img_path);
        }
        User::where('id',$user->id)->delete();
        return view('welcome');
    }
}
