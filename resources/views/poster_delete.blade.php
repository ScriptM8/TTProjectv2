@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h4>Delete post "{{ $poster->title }}"?</h4>
                    <h5>All photos added to this post will be deleted.</h5>
                    {{ Form::open(array('action' => ['PosterController@destroy', $poster->id],
                        'method' => 'delete')) }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
