@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h4>{{ __('messages.Delete_post') }} "{{ $poster->title }}"?</h4>
                    <h5>{{ __('messages.Photos_will_be_del') }}</h5>
                    {{ Form::open(array('action' => ['PosterController@destroy', $poster->id],
                        'method' => 'delete')) }}
                    {{ Form::submit(__('messages.Delete'), ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
