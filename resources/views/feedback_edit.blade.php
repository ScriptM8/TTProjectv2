@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-group row">
                    {{Form::open(['route' => array('feedback.update',$feedback->id), 'class' => 'form-horizontal'])}}
                    <div class="row">

                        <div class="col-md-6">
                            {{Form::label('rating', __('messages.Enter_0_5'))}}
                            {{Form::number('rating',$feedback->rating,['class'=>'form-control'.($errors-> has('rating') ? ' is-invalid' : '')])}}
                            @if ($errors->has('rating'))
                                <span class="invalid-feedback">
                            <strong>{{ $errors->first('rating') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            {{Form::label('description', __('messages.Leave_feedback_here'))}}
                            {{Form::textarea('description',$feedback->description,['class'=>'form-control'.($errors-> has('description') ? ' is-invalid' : '')])}}
                            @if ($errors->has('description'))
                                <span class="invalid-feedback">
                            <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6">{{Form::submit(__('messages.Update_feedback'),['class' =>'btn btn-primary'])}}</div>

                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection
