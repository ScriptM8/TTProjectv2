@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm">
            @if($errors->has('msg'))
                <br>
                <h4 class="text-success"><strong>{{ $errors->first('msg') }}</strong></h4>
            @endif
            <div class="card">
                <h4 class="list-group-item list-group-item-primary">{{ $poster->title }}</h4>
                <div class="card-body">
                    <h5 class="card-text">Category: {{ $category->name }}</h5>
                    <h5 class="card-text">Description: {{ $poster->description }}</h5>
                    <h5 class="card-text">Location: {{ $poster->location }}</h5>
                    <h5 class="card-text">Time: {{ $poster->time }}</h5>
                    <h5 class="card-text">Pay: {{ $poster->reward }}</h5>
                    <h5 class="card-text">Phone: {{ $poster->phone }}</h5>
                    <h5 class="card-text">E-mail: {{ $poster->email }}</h5>
                </div>

                @if($photos->count() > 0)
                @foreach($photos as $photo)
{{--                    <img src="{{  }}">--}}
                @endforeach
                @endif
            </div>
        </div>

        <div class="col-sm">
            <div class="card">
                <h4 class="list-group-item list-group-item-primary">Author</h4>
                <div class="card-body">
                    <img src="/storage/profile_img/{{ $user->profile_img_path }}" alt="Profile picture of {{ $user->name }}" width="100" height="100">
                    <h4 class="card-text">{{ $user->name }}</h4>
                    <h4 class="card-text">{{ $user->rating }}</h4>
                </div>
            </div>
            <br>

            @if($role === 1 or $currentuser->id === $user->id)
                <a class="btn btn-primary" href="post/{{ $poster->id }}/edit">Edit post</a>
                <br>
                <a class="btn btn-primary" href="post/{{ $poster->id }}/delete">Delete post</a>
                <br>
            @endif
        </div>
    </div>
</div>

@endsection
