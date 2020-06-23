@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <h4 class="list-group-item list-group-item-primary">Add photo to "{{ $poster->title }}"</h4>
                <div class="card-body">
                    <div>
                        {{ Form::open(array('action' => 'PhotoController@store', 'files' => true)) }}
                        {{ Form::hidden('poster_id', $poster->id) }}


                        <h5 class="card-text">{{ Form::label('photo', 'Add file:') }}</h5>
                        {{ Form::file('photo', ['class' =>
                            'form-control'.($errors-> has('photo') ? ' is-invalid' : '' )]) }}
                        @if ($errors->has('photo'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('photo') }}</strong>
                            </span>
                        @endif

                        <br>
                        <h5 class="card-text">{{ Form::label('description', 'Decription:') }}</h5>
                        {{ Form::textarea('description', '', ['class' =>
                            'form-control'.($errors-> has('description') ? ' is-invalid' : '' )]) }}
                        @if ($errors->has('description'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif


                        <br>
                        {{ Form::submit('Add photo', ['class' => 'btn btn-primary float-right']) }}

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
