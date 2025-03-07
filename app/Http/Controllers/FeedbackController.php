<?php

namespace App\Http\Controllers;

use App\Feedbacks;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function index()
    {
        //
        /*return view('profile',
            ['feedbacks' => Feedbacks::all()->where('target_id', Auth::user()->id)->get(),
                'user' => Auth::user(),
                'role' => Auth::user()->role]);*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/feedback_store', ['target_user' => session()->get('target_id')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $rules = array(
            'rating' => 'required|numeric|min:0|max:5',
            'description' => 'required|string|min:0',
        );
        $this->validate($request, $rules);
        $request->merge(['author_id' => Auth::user()->id]);
        $request->merge(['target_id' => session()->get('target_id')]);
        $feed = new Feedbacks();
        $feed->fill($request->all());
        $feed->save();

        $affectedUser = User::findOrFail(session()->get('target_id'));
        $arr = Feedbacks::where('target_id', session()->get('target_id'))->get();
        $rate = 0;
        for ($i = 0; $i < count($arr); $i++)
            $rate += $arr[$i]->rating;
        $rate /= count($arr);
        $rate = round($rate, 2);
        $affectedUser->rating = $rate;
        $affectedUser->save();
        return redirect()->action('UserController@show', array(session()->get('target_id')));
    }

    public function edit($id)
    {
        if (Auth::user() and Auth::user()->id == Feedbacks::findOrFail($id)->author_id) {
            $feedback = Feedbacks::findOrFail($id);
            return view('feedback_edit', ['feedback' => $feedback]);
        } else {
            return view('home');
        }
    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'rating' => 'required|numeric|min:0|max:5',
            'description' => 'required|string|min:0',
        );
        $request->merge(['author_id' => Auth::user()->id]);
        $request->merge(['target_id' => session()->get('target_id')]);
        $this->validate($request, $rules);
        $feed = Feedbacks::findOrFail($id);
        $feed->fill($request->all());
        $feed->save();

        $affectedUser = User::findOrFail(session()->get('target_id'));
        $arr = Feedbacks::where('target_id', session()->get('target_id'))->get();
        $rate = 0;
        for ($i = 0; $i < count($arr); $i++)
            $rate += $arr[$i]->rating;
        $rate /= count($arr);
        $rate = round($rate, 2);
        $affectedUser->rating = $rate;
        $affectedUser->save();
        return redirect()->action('UserController@show', array(session()->get('target_id')));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
