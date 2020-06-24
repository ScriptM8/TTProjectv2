@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h4 class="list-group-item list-group-item-primary">{{ __('messages.Profile') }}</h4>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-text">{{ __('messages.Name') }} {{ $profile_owner->name }}</h5>
                        <h5 class="card-text">{{ __('messages.E_mail') }} {{ $profile_owner->email }}</h5>
                        @if($feedbacks->count() > 0)
                            <h5 class="card-text">{{ __('messages.Rating') }}</h5>
                            <div class="rating">
                                <div class="progress star-bg">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                         style="width: {{ $profile_owner->rating*20 }}%"
                                         aria-valuenow="{{ $profile_owner->rating }}" aria-valuemin="0"
                                         aria-valuemax="5"></div>
                                </div>
                                <img class="star-img" src="/images/stars.png" alt="stars"/>
                                <h5 class="card-text star-text">{{ $profile_owner->rating }}/5</h5>
                            </div>
                        @else
                            <h5 class="card-text">{{ __('messages.Rating') }} {{ __('messages.No_feedback') }}</h5>
                        @endif
                        @if ($user->role == 1 or $user->id == $profile_owner->id)
                            <a href="/profile/delete/{{ $profile_owner->id }}" class="btn btn-info" role="button">{{ __('messages.Delete_profile') }}</a>
                        @endif
                        <br>
                        <br>
                        <a href="/profile/show/{{ $profile_owner->id }}/posts" class="btn btn-info" role="button">{{ __('messages.Show_posts_by') }} {{ $profile_owner->name }}</a>

                    </div>
                    <div class="col">
                        <img class="img-fluid rounded-circle"
                             src="/storage/profile_img/{{ $profile_owner->profile_img_path }}"/>
                        @if ($user->id == $profile_owner->id)
                            <form action="/profile" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="file" class="form-control-file" name="profile_img" id="profile_img"
                                           aria-describedby="fileHelp">
                                    <small id="fileHelp" class="form-text text-muted">{{ __('messages.Size_of_image') }}</small>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('messages.Submit') }}</button>
                            </form>
                        @endif
                    </div>
                </div>
                @if($profile_owner != $user and \App\Feedbacks::where([['author_id','=',$user->id],['target_id','=',$profile_owner->id]])->get()->count() < 1)
                    <a href="{{action('FeedbackController@create')}}" class="btn btn-info" role="button">{{ __('messages.Leave_feedback') }}</a>
                @endif

            </div>
        </div>
    </div>
    <h1></h1>
    <div class="container">
        <div class="card">
            <h4 class="list-group-item list-group-item-primary">{{ __('messages.Feedback') }}</h4>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        @if($feedbacks)
                            <div class="row">
                                <div class="col">
                                    @foreach($feedbacks as $feed)
                                        <h5 class="card-text">
                                            <a href="{{action('UserController@show',\App\User::find($feed->author_id)->id)}}">{{\App\User::find($feed->author_id)->name}}</a>
                                            {{ __('messages.Left_a_rating') }}
                                            <p style="display: inline; font-weight: bolder">{{$feed->rating}}:</p>
                                            {{$feed->description}}
                                            @if(\Illuminate\Support\Facades\Auth::user() == \App\User::find($feed->author_id))
                                                <a class="float-right btn btn-info" style="display: inline" role="button" href="{{ action('FeedbackController@edit',$feed->id)}}">{{ __('messages.Edit_feedback') }}</a>
                                            @endif
                                        </h5>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
