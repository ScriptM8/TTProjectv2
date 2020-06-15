<?php

namespace App\Http\Controllers;

use App\Poster;
use App\User;
use App\Category;
use Illuminate\Http\Request;

class PosterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posters = Poster::all(); // cits
        return view('posters', ['posters' => $posters, 
            'users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('poster_create', ['user' => Auth::user(), 
            'categories' => Category::all()]);
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
            'author_id' => 'required|exists:users,id',
            'title' => 'required|string|min:5|max:150',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string|min:5|max:150',
            'time' => 'required|string|min:2|max:150',
            'reward' => 'required|numeric|min:0',
            'phone' => 'required|digits_between:2,15',
            'email' => 'required|string|email|max:150'
        );        
        $this->validate($request, $rules); 
        
        $poster = new Car();
        $poster->user()->associate(User::findOrFail($request['author_id']));
        $poster->title = $request['title'];
        $poster->description = $request['description'];
        $poster->category()->associate(Category::findOrFail($request['category_id']));
        $poster->location = $request['location'];
        $poster->time = $request['time'];
        $poster->reward = $request['reward'];
        $poster->phone = $request['phone'];
        $poster->email = $request['email'];
        $poster->save();
        
        return redirect('post/'.$poster->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $poster = Poster::findOrFail($id);
        $category = Category::findOrFail($poster->category_id);
        //if (Auth::check())
        $currentuser = Auth::user();
        if (!$poster) {
            return redirect('posts');
        }
        
        else {
            return view('poster_show', ['poster' => $poster, 
                'user' => User::findOrFail($poster->author_id),
                'currentuser' => $currentuser,
                'category' => $category]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $poster = Poster::find($id);
        if (!$poster) {
            return redirect('posts'); // user posts or?
        }
        
        $user = Auth::user();
        $role = $user->role;
        if ($role === 0 && $poster->author_id !== $user->id) {
            return redirect('posts'); // user posts or?
        }
        
        else {
            $user = User::find($poster->author_id);
            return view('poster_edit', ['poster' => $poster, 
                'categories' => Category::all()]);
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
            'id' => 'required|exists:posters,id',
            'author_id' => 'required|exists:users,id',
            'title' => 'required|string|min:5|max:150',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string|min:5|max:150',
            'time' => 'required|string|min:2|max:150',
            'reward' => 'required|numeric|min:0',
            'phone' => 'required|digits_between:2,15',
            'email' => 'required|string|email|max:150'
        );        
        $this->validate($request, $rules); 
        
        $poster = Poster::findOrFail($id);
        $poster->user()->associate(User::findOrFail($request['author_id']));
        $poster->title = $request['title'];
        $poster->description = $request['description'];
        $poster->category()->associate(Category::findOrFail($request['category_id']));
        $poster->location = $request['location'];
        $poster->time = $request['time'];
        $poster->reward = $request['reward'];
        $poster->phone = $request['phone'];
        $poster->email = $request['email'];
        $poster->save();
        // vai te kkas cits?
        
        return redirect('post/'.$poster->id)->withErrors(['msg' => 'Post updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // to do?
    }
}
