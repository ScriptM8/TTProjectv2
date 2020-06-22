@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm">
            
            <div class="list-group">
                <h4 class="list-group-item list-group-item-primary">All profiles list</h4>
                @foreach ($users as $user)
                    @if ($user->role == 0)
                        <div class="list-group-item">
                            <a href="/profile/show/{{ $user->id }}"><h5>{{ $user->name }}</h5></a>
                        </div>
                    @endif           
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection