@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-group row">
                    {{Form::open(['route' => array('feedback.update',$feedback->id), 'class' => 'form-horizontal'])}}
                    <div class="row">

                        <div class="col-md-6">
                            {{Form::label('rating', 'Please enter a number from 0 to 5')}}
                            {{Form::number('rating',$feedback->rating,['class'=>'form-control'])}}
                            @if ($errors->has('rating'))
                                <span class="invalid-feedback">
                            <strong>{{ $errors->first('rating') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            {{Form::label('description', 'Leave your feedback here!')}}
                            {{Form::textarea('description',$feedback->description,['class'=>'form-control'])}}

                            @if ($errors->has('description'))
                                <span class="invalid-feedback">
                            <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6">{{Form::submit('Update feedback',['class' =>'btn btn-primary'])}}</div>

                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection
