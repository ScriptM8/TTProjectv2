@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <h4 class="list-group-item list-group-item-primary">{{ __('messages.Edit_photo_for') }} "{{ $poster->title }}"</h4>
                <div class="card-body">
                    <div>
                        <img src="{{ asset('/storage/post_photos/'.$photo->path) }}"
                             alt="Photo for {{ $poster->title }}"
                             class="photo-main">
                        <br>
                        <br>

                        {{ Form::open(array('action' => ['PhotoController@update', $photo->id], 'method' => 'put')) }}


                        <h5 class="card-text">{{ Form::label('description', __('messages.Description')) }}</h5>
                        {{ Form::textarea('description', $photo->short_description, ['class' =>
                            'form-control'.($errors-> has('description') ? ' is-invalid' : '' )]) }}
                        @if ($errors->has('description'))
                            <span class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                        </span>
                        @endif


                        <br>
                        {{ Form::submit(__('messages.Save_photo'), ['class' => 'btn btn-primary float-right']) }}

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
