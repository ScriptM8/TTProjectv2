@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-group row">
                    {{Form::open(['action' => 'FeedbackController@store', 'class' => 'form-horizontal'])}}
                    <div class="row">

                        <div class="col-md-6">
                            {{Form::label('rating', 'Rating:')}}
                            {{Form::number('rating',null,['class'=>'form-control'])}}
                        </div>
                        <div class="col-md-6">
                            {{Form::label('description', 'Feedbacks:')}}
                            {{Form::textarea('description',null,['class'=>'form-control'])}}

                            {{Form::submit('Add feedback',['class' =>'btn btn-primary'])}}
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection
