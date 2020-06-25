@extends('layouts.app')
@section('content')

<script type="application/javascript">
    function showContacts() {
        @if($currentuser)
            document.getElementById("contacts").classList.remove('d-none');
        @else
            document.location.href="/login";
        @endif
    }
    function changeCurrent(photo) {
        document.getElementsByClassName("photo-curr")[0].src = "/storage/post_photos/"+photo['path'];
        document.getElementsByClassName("desc-text")[0].innerHTML = photo['short_description'];
        document.getElementById("photo-del-link").href = "/photo/"+photo['id']+"/delete";
        document.getElementById("photo-edit-link").href = "/photo/"+photo['id']+"/edit";
    }
</script>

<div class="container">
    <div class="row">
        <div class="col-sm-9">
            @if($errors->has('msg'))
                <br>
                <h4 class="text-success"><strong>{{ $errors->first('msg') }}</strong></h4>
            @endif
            <div class="card">
                <h4 class="list-group-item list-group-item-primary">{{ $poster->title }}</h4>
                <div class="card-body">
                    <h5 class="card-text">{{ __('messages.Category') }} {{ $category->name }}</h5>
                    <h5 class="card-text">{{ __('messages.Description') }} {{ $poster->description }}</h5>
                    <h5 class="card-text">{{ __('messages.Location') }} {{ $poster->location }}</h5>
                    <h5 class="card-text">{{ __('messages.Time') }} {{ $poster->time }}</h5>
                    <h5 class="card-text">{{ __('messages.Pay') }} {{ $poster->reward }}&euro;</h5>
                    <br>
                    <button class="btn btn-primary" onclick="showContacts()">{{ __('messages.Show_contact') }}</button>
                    <br>
                    <div id="contacts" class="d-none">
                        <br>
                        <h5 class="card-text">{{ __('messages.Phone') }} {{ $poster->phone }}</h5>
                        <h5 class="card-text">{{ __('messages.E_mail') }} {{ $poster->email }}</h5>
                    </div>

                    @if($photoshow === 1)
                        @if($currentuser)
                        @if($currentuser->id === $user->id)
                            <br>
                            <br>
                            <a class="btn btn-primary" href="{{ $poster->id }}/photo/add">{{ __('messages.Add_new_photo') }}</a>
                        @endif
                        @endif
                        @if($photos->count() > 0)
                        <br>
                        <br>
                        <div id="curr-container">
                            <img src="{{ asset('storage/post_photos/'.$photos->first()->path) }}"
                                 alt="Current photo for {{ $poster->title }}"
                                 class="photo-curr">
                            <div class="photo-desc"><p class="desc-text">{{ $photos->first()->short_description }}</p></div>
                            @if($currentuser)
                            @if($currentuser->role === 1 or $currentuser->id === $user->id)
                                <div class="photo-desc photo-panel">
                                    <a class="desc-text photo-links" id="photo-del-link" href="/photo/{{ $photos->first()->id }}/delete">{{ __('messages.Delete') }}</a>
                                    <a class="desc-text photo-links" id="photo-edit-link" href="/photo/{{ $photos->first()->id }}/edit">{{ __('messages.Edit') }}</a>
                                </div>
                            @endif
                            @endif
                            <br>
                        </div>
                        <div id="photo-container">
                        @foreach($photos as $photo)
                            <div class="photo-col" onclick="changeCurrent({{ json_encode($photo) }})">
                                <img src="{{ asset('/storage/post_photos/'.$photo->path) }}"
                                     alt="Photo for {{ $poster->title }}"
                                     class="photo-list">
                                <div class="overlay"></div>
                            </div>
                        @endforeach
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <div class="col-sm">
            @include('user_info')
            <br>

            @if($currentuser)
            @if($currentuser->role === 1 or $currentuser->id === $user->id)
                <a class="btn btn-primary" href="{{ $poster->id }}/edit">{{ __('messages.Edit_post') }}</a>
                <br>
                <br>
                <a class="btn btn-primary" href="{{ $poster->id }}/delete">{{ __('messages.Delete_post') }}</a>
                <br>
            @endif
            @endif
        </div>
    </div>
</div>

@endsection
