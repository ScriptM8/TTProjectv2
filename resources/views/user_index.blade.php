@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <h4 class="list-group-item list-group-item-primary">All profiles list</h4>
        <div class="card-body">
            @foreach ($users as $user)
                @if ($user->role == 0)
                    <a href="/profile/show/{{ $user->id }}"><h5>{{ $user->name }}</h5></a>
                @endif           
            @endforeach
        </div>
    </div>
</div>
@endsection