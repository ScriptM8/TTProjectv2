
<div class="card">
    <h4 class="list-group-item list-group-item-primary">{{ __('messages.Author') }}</h4>
    <div class="card-body">
        <img src="{{ asset('storage/profile_img/'.$user->profile_img_path) }}" alt="Profile picture of {{ $user->name }}" class="rounded-circle" width="150" height="150">
        <br>
        <br>
        <a href="/profile/show/{{ $user->id }}"><h4 class="card-text">{{ $user->name }}</h4></a>
        <br>
        <div class="rating">
            <div class="progress star-small star-bg">
                <div class="progress-bar bg-warning" role="progressbar"
                     style="width: {{ $user->rating*20 }}%"
                     aria-valuenow="{{ $user->rating }}" aria-valuemin="0"
                     aria-valuemax="5"></div>
            </div>
            <img class="star-small star-img" src="/images/stars.png" alt="stars"/>
        </div>
        @if($feedbacks->count() > 0)
            <h5 class="card-text">{{ $user->rating }}/5</h5>
        @else
            <h5 class="card-text">{{ __('messages.No_feedback') }}</h5>
        @endif
    </div>
</div>
