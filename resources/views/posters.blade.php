@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm">
            @isset($cat_list)
                @yield('category_list')
                @include('poster_filter')
            @else
                @include('user_info')
            @endisset
            <br>
        </div>
        <div class="col-sm-9">
            <div class="list-group">
                @foreach ( $posters as $poster )
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-sm-8">
                                <a href="/post/{{ $poster->id }}">
                                    <h4>{{ $poster->title }}</h4>
                                    <div>
                                    <h5 id="before-stars">{{ $users->where('id', $poster->author_id)->first()->name }}</h5>
                                    @if($feedbacks->where('target_id', $poster->author_id)->count() > 0)
                                        <div class="rating star-tiny">
                                            <div class="progress star-tiny star-bg">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                     style="width: {{ $users->where('id', $poster->author_id)->first()->rating*20 }}%"
                                                     aria-valuenow="{{ $users->where('id', $poster->author_id)->first()->rating }}" aria-valuemin="0"
                                                     aria-valuemax="5"></div>
                                            </div>
                                            <img class="star-tiny star-img" src="/images/stars.png" alt="stars"/>
                                        </div>
                                    @endif
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm">
                                <h6 class="card-text">{{ __('messages.Location') }} {{ $poster->location }}</h6>
                                <h6 class="card-text">{{ __('messages.Time') }} {{ $poster->time }}</h6>
                                <h6 class="card-text">{{ __('messages.Pay') }} {{ $poster->reward }}&euro;</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
