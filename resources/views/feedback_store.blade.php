@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-group row">
                    {{Form::open(['action' => 'FeedbackController@store', 'class' => 'form-horizontal'])}}

                    <div class="row">

                        <div class="col-md-6">
                            {{Form::label('rating', 'Please enter a number from 0 to 5')}}
                            {{Form::number('rating',null,['class'=>'form-control'.($errors-> has('rating') ? ' is-invalid' : '')])}}
                            @if ($errors->has('rating'))
                                <span class="invalid-feedback">
                            <strong>{{ $errors->first('rating') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            {{Form::label('description', 'Leave your feedback here!')}}
                            {{Form::textarea('description',null,['class'=>'form-control'.($errors-> has('description') ? ' is-invalid' : '')])}}

                            @if ($errors->has('description'))
                                <span class="invalid-feedback">
                            <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6">{{Form::submit('Add feedback',['class' =>'btn btn-primary'])}}</div>

                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection
