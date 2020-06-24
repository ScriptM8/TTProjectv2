@extends('layouts.app')
@section('content')

<?php
$catarr = array();
foreach ($categories as $cat) {
    $catarr[$cat->id] = $cat->name;
}
?>

<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <h4 class="list-group-item list-group-item-primary">{{ __('messages.Edit_post') }}</h4>
                <div class="card-body">
                    <div>
                        {{ Form::open(array('action' => ['PosterController@update', $poster->id], 'method' => 'put')) }}
                        {{ Form::hidden('id', $poster->id) }}
                        {{ Form::hidden('author_id', $poster->author_id) }}


                        <h5 class="card-text">{{ Form::label('title', __('messages.Title')) }}</h5>
                        {{ Form::text('title', $poster->title, ['class' =>
                            'form-control'.($errors-> has('title') ? ' is-invalid' : '' )]) }}
                        @if ($errors->has('title'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif

                        <br>
                        <h5 class="card-text">{{ Form::label('category_id', __('messages.Category')) }}</h5>
                        {{ Form::select('category_id', $catarr, $poster->category_id, ['placeholder' => __('messages.Select_category'),
                            'class' => 'form-control'.($errors-> has('category_id') ? ' is-invalid' : '' )]) }}
                        @if ($errors->has('category_id'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('category_id') }}</strong>
                            </span>
                        @endif

                        <br>
                        <h5 class="card-text">{{ Form::label('description', __('messages.Description')) }}</h5>
                        {{ Form::textarea('description', $poster->description, ['class' =>
                            'form-control'.($errors-> has('description') ? ' is-invalid' : '' )]) }}
                        @if ($errors->has('description'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif

                        <br>
                        <h5 class="card-text">{{ Form::label('location', __('messages.Location')) }}</h5>
                        {{ Form::text('location', $poster->location, ['class' =>
                            'form-control'.($errors-> has('location') ? ' is-invalid' : '' )]) }}
                        @if ($errors->has('location'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('location') }}</strong>
                            </span>
                        @endif

                        <br>
                        <h5 class="card-text">{{ Form::label('time', __('messages.Time')) }}</h5>
                        {{ Form::text('time', $poster->time, ['class' =>
                            'form-control'.($errors-> has('time') ? ' is-invalid' : '' )]) }}
                        @if ($errors->has('time'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('time') }}</strong>
                            </span>
                        @endif

                        <br>
                        <h5 class="card-text">{{ Form::label('reward', __('messages.Pay')) }}</h5>
                        {{ Form::text('reward', $poster->reward, ['class' =>
                            'form-control'.($errors-> has('reward') ? ' is-invalid' : '' )]) }}
                        @if ($errors->has('reward'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('reward') }}</strong>
                            </span>
                        @endif

                        <br>
                        <h5 class="card-text">{{ Form::label('phone', __('messages.Phone')) }}</h5>
                        {{ Form::text('phone', $poster->phone, ['class' =>
                            'form-control'.($errors-> has('phone') ? ' is-invalid' : '' )]) }}
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif

                        <br>
                        <h5 class="card-text">{{ Form::label('email', __('messages.E_mail')) }}</h5>
                        {{ Form::text('email', $poster->email, ['class' =>
                            'form-control'.($errors-> has('email') ? ' is-invalid' : '' )]) }}
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif


                        <br>
                        {{ Form::submit(__('messages.Save_post'), ['class' => 'btn btn-primary float-right']) }}

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
