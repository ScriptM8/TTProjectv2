<?php

namespace App\Http\Controllers;

use App\Feedbacks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use app\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $id = Auth::user()->id; // vajag pie show id?
        session()->put('target_id', $id);
        return view('profile', ['feedbacks' => Feedbacks::where('target_id', Auth::user()->id)->get(),'user' => Auth::user(), 'role' => Auth::user()->role]);
    }

    public function update_profile_img(Request $request)
    {
        $request->validate([
            'profile_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user = Auth::user();
        $imgName = $user->id . '_profileImg' . time() . '.' . request()->profile_img->getClientOriginalExtension();
        $request->profile_img->storeAs('profile_img', $imgName);
        $user->profile_img_path = $imgName;
        $user->save();
        return back();
    }

    public function delete()
    {
        $user = Auth::user();
        Auth::logout();
        if ($user->profile_img_path != 'default_user.png') {
            Storage::delete('profile_img/' . $user->profile_img_path);
        }
        User::where('id', $user->id)->delete();
        return view('welcome');
    }

}
