@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($errors->all() as $message)
                        <p class="has-error">{{ $message }}</p>
                    @endforeach

                    <h4>{{ __('messages.Welcome') }}, {{ Auth::user()->name }}</h4>
                    <br>
                    <a class="btn btn-primary" href="{{action('UserController@togglePhotos')}}">
                    @if(Auth::user()->photos === 0)
                        {{ __('messages.Enable_photos') }}
                    @else
                        {{ __('messages.Disable_photos') }}
                    @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
