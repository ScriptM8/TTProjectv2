<?php

namespace App\Http\Controllers;

use App\Poster;
use App\User;
use App\Category;
use App\Photo;
use App\Feedbacks;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index','show','postFilter');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posters = $this->byCategory();

        return view('category_list', ['posters' => $posters,
            'users' => User::all(),
            'cat_list' => session()->get('category_list'),
            'feedbacks' => Feedbacks::all()]);
    }

    public function listown($user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            return redirect('posts');
        }
        $posters = Poster::where('author_id', $user_id)->get();

        $feedbacks = Feedbacks::where('target_id',$user->id)->get();
        return view('posters', ['posters' => $posters,
            'users' => User::all(),
            'user' => $user,
            'feedbacks' => $feedbacks]);
    }

    public function postFilter(Request $request)
    {
        $rules = array(
            'title' => 'nullable|string',
            'location' => 'nullable|string',
            'edited' => 'nullable|date',
            'pay_from' => 'nullable|numeric|min:0',
            'pay_to' => 'nullable|numeric|min:0|gte:pay_from'
        );
        $this->validate($request, $rules);

        $posters = $this->byCategory();

        $query = Poster::whereIn('id',$posters->modelKeys());
        if ($request->title != null) {
            $query = $query->where('title', 'LIKE', '%'.$request['title'].'%');
        }
        if ($request->location != null) {
            $query = $query->where('location', 'LIKE', '%'.$request['location'].'%');
        }
        if ($request->edited != null) {
            $query = $query->where('updated_at','>',$request['edited']);
        }
        if ($request->pay_from != null) {
            $query = $query->where('reward','>=',$request['pay_from']);
        }
        if ($request->pay_to != null) {
            $query = $query->where('reward','<=',$request['pay_to']);
        }
        return view('category_list', ['posters' => $query->get(),
            'users' => User::all(),
            'cat_list' => session()->get('category_list'),
            'feedbacks' => Feedbacks::all()]);
    }

    public function byCategory()
    {
        if (!session()->has('category_list')) {
            //if(true){
            $temp = Category::all();
            $category_list = array();
            for ($i=0; $i < count($temp); $i++) {
                $cat = array('id' => $temp[$i]->id ,'name' => $temp[$i]->name, 'checked' => false);
                array_push($category_list, $cat);
            }
            session()->put('category_list', $category_list);
        }
        $cat_list = session()->get('category_list');
        $none_checked = true;
        for ($i=0; $i < count($cat_list); $i++) {
            if($cat_list[$i]['checked'] == true){
                $none_checked = false;
            }
        }
        if ($none_checked) {
            $posters = Poster::all();
        }else{
            $posters_id = array();
            for ($i=0; $i < count($cat_list); $i++) {
                if($cat_list[$i]['checked'] == true){
                    $post = Poster::where('category_id', '=', $cat_list[$i]['id'])->get();
                    for ($x=0; $x < count($post); $x++) {
                        array_push($posters_id, $post[$x]->id);
                    }
                }
            }
            $posters = Poster::find($posters_id);
        }

        return $posters;
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
            'location' => 'required|string|min:3|max:150',
            'time' => 'required|string|min:2|max:150',
            'reward' => 'required|numeric|min:0',
            'phone' => 'required|digits_between:2,15',
            'email' => 'required|string|email|max:150'
        );
        $this->validate($request, $rules);

        $poster = new Poster();
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
        $poster = Poster::find($id);
        if (!$poster) {
            return redirect('posts');
        }

        if (Auth::check()) {
            $currentuser = Auth::user();
            $photoshow = $currentuser->photos;
        }
        else {
            $currentuser = NULL;
            $photoshow = 1;
        }

        $category = Category::findOrFail($poster->category_id);
        $photos = Photo::where('poster_id',$id)->get();
        $user = User::findOrFail($poster->author_id);
        $feedbacks = Feedbacks::where('target_id',$user->id)->get();
        return view('poster_show', ['poster' => $poster,
            'user' => $user,
            'currentuser' => $currentuser,
            'category' => $category,
            'photos' => $photos,
            'feedbacks' => $feedbacks,
            'photoshow' => $photoshow]);

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
        $poster = Poster::find($id);

        if (!$poster) {
            if ($role === 0) {
                return redirect('/profile/show/'.$user->id.'/posts');
            }
            else {
                return redirect('posts');
            }
        }

        if ($role === 0 && $poster->author_id !== $user->id) {
            return redirect('/profile/show/'.$user->id.'/posts');
        }

        else {
            $user = User::findOrFail($poster->author_id);
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
            'location' => 'required|string|min:3|max:150',
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

        return redirect('post/'.$poster->id)->withErrors(['msg' => __('messages.Post_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = Auth::user();
        $role = $user->role;
        $poster = Poster::find($id);

        if (!$poster) {
            if ($role === 0) {
                return redirect('/profile/show/'.$user->id.'/posts');
            }
            else {
                return redirect('posts');
            }
        }

        if ($role === 0 && $poster->author_id !== $user->id) {
            return redirect('/profile/show/'.$user->id.'/posts');
        }

        else {
            return view('poster_delete', ['poster' => $poster]);
        }
    }
    public function destroy($id)
    {
        Poster::findOrFail($id)->delete();
        $user = Auth::user();
        $role = $user->role;
        if ($role === 0) {
            return redirect('/profile/show/'.$user->id.'/posts');
        }
        else {
            return redirect('posts');
        }
    }
}
