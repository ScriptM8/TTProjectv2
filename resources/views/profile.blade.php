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
                    @if ($user->id == $profile_owner->id)
                        <a href="/profile/delete" class="btn btn-info" role="button">Delete profile</a>
                    @endif
                    @if ($user->role == 1)
                        <a href="/profile/delete/{{ $profile_owner->id }}" class="btn btn-info" role="button">Delete profile</a>
                    @endif
                    
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
        </div>
    </div>
</div>
@endsection