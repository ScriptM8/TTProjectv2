@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <h4 class="list-group-item list-group-item-primary">Profile</h4>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-text">Name: {{ $profile_owner->name }}</h5>
                    <h5 class="card-text">Email: {{ $profile_owner->email }}</h5>
                    <h5 class="card-text">Rating: {{ $profile_owner->rating }}/5</h5>
                    @if ($user->role == 1 or $user->id == $profile_owner->id)
                        <a href="/profile/delete/{{ $profile_owner->id }}" class="btn btn-info" role="button">Delete profile</a>
                    @endif
                    <br>
                    <br>
                    <a href="/profile/show/{{ $profile_owner->id }}/posts" class="btn btn-info" role="button">Show posts by {{ $profile_owner->name }}</a>

                </div>
                <div class="col">
                    <img class="img-fluid rounded-circle" src="/storage/profile_img/{{ $profile_owner->profile_img_path }}"/>
                    @if ($user->id == $profile_owner->id)
                        <form action="/profile" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="file" class="form-control-file" name="profile_img" id="profile_img" aria-describedby="fileHelp">
                                <small id="fileHelp" class="form-text text-muted">Size of image should not be more than 2MB.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    @endif
                </div>
            </div>
            @if($profile_owner != $user)
            <a href="{{action('FeedbackController@create')}}" class="btn btn-info" role="button">Leave Feedback!</a>
            @endif
            @if($feedbacks)
                <h1>Feedbacks:</h1>
                <div class="row">
                    <div class="col">
                        @foreach($feedbacks as $feed)
                            <div class="card-text">
                                <a href="{{action('UserController@show',\App\User::find($feed->author_id)->id)}}">{{\App\User::find($feed->author_id)->name}}</a> left a rating <h2 style="display: inline">{{$feed->rating}}:</h2> {{$feed->description}}
                            </div>
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
