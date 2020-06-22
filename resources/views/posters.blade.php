
@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm">
            @yield('category_list')
        </div>
        <div class="col-sm">
            <div class="list-group">
                @foreach ( $posters as $poster )
                    <div class="list-group-item">
                        <a href="post/{{ $poster->id }}">
                            <h4>{{ $poster->title }}</h4>
                            <h5>{{ $users->where('id', $poster->author_id)->first()->name }}</h5>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


@endsection
