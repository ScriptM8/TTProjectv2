@extends('posters')
@section('user_list')

<div class="card">
    <h4 class="list-group-item list-group-item-primary">Author</h4>
    <div class="card-body">
        <img src="{{ asset('storage/profile_img/'.$user->profile_img_path) }}" alt="Profile picture of {{ $user->name }}" class="rounded-circle" width="150" height="150">
        <br>
        <br>
        <a href="/profile/show/{{ $user->id }}"><h4 class="card-text">{{ $user->name }}</h4></a>
        <h4 class="card-text">{{ $user->rating }}</h4>
    </div>
</div>

@endsection
