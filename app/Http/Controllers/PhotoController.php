<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Poster;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($poster_id)
    {
        $user = Auth::user();
        $poster = Poster::find($poster_id);

        if (!$poster) {
            return redirect('/profile/show/'.$user->id.'/posts');
        }

        if ($poster->author_id === $user->id) {
            return view('photo_create', ['poster' => $poster]);
        }
        else {
            return redirect('/profile/show/'.$user->id.'/posts');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'poster_id' => 'required|exists:posters,id',
            'description' => 'nullable|string'
        );
        $this->validate($request, $rules);

        $photo = new Photo();
        $path = $request['poster_id'].'_photo_'.time().'.'.$request['photo']->getClientOriginalExtension();
        $request['photo']->storeAs('post_photos', $path);
        $photo->path = $path;
        $photo->poster()->associate(Poster::findOrFail($request['poster_id']));
        $photo->short_description = $request['description'];
        $photo->save();
        return redirect('post/'.$photo->poster_id)->withErrors(['msg' => __('messages.Photo_added')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $role = $user->role;
        $photo = Photo::find($id);

        if (!$photo) {
            if ($role === 0) {
                return redirect('/profile/show/'.$user->id.'/posts');
            }
            else {
                return redirect('posts');
            }
        }

        $poster = Poster::findOrFail($photo->poster_id);
        if ($role === 0 && $poster->author_id !== $user->id) {
            return redirect('/profile/show/'.$user->id.'/posts');
        }

        else {
            return view('photo_edit', ['photo' => $photo,
                'poster' => $poster]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'description' => 'nullable|string'
        );
        $this->validate($request, $rules);

        $photo = Photo::findOrFail($id);
        $photo->short_description = $request['description'];
        $photo->save();

        return redirect('post/'.$photo->poster_id)->withErrors(['msg' => __('messages.Photo_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $role = $user->role;
        $photo = Photo::find($id);

        if (!$photo) {
            if ($role === 0) {
                return redirect('/profile/show/'.$user->id.'/posts');
            }
            else {
                return redirect('posts');
            }
        }

        $poster = Poster::findOrFail($photo->poster_id);
        if ($role === 0 && $poster->author_id !== $user->id) {
            return redirect('/profile/show/'.$user->id.'/posts');
        }
        else {
            File::delete(public_path().'/storage/post_photos/'.$photo->path);
            Photo::findOrFail($id)->delete();
            return redirect('post/'.$poster->id)->withErrors(['msg' => __('messages.Photo_deleted')]);
        }
    }

}
