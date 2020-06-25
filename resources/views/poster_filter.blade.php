
<br>
<div class="card">
    <h4 class="list-group-item list-group-item-primary">{{ __('messages.Filter') }}</h4>
    <div class="card-body">
        <div>
            {{ Form::open(['action' => 'PosterController@postFilter']) }}


            <h5 class="card-text">{{ Form::label('title', __('messages.Title')) }}</h5>
            {{ Form::text('title', '', ['class' => 'form-control'.($errors->has('title') ? ' is-invalid' : '')]) }}
            @if ($errors->has('title'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif

            <br>
            <h5 class="card-text">{{ Form::label('location', __('messages.Location')) }}</h5>
            {{ Form::text('location', '', ['class' => 'form-control'.($errors->has('location') ? ' is-invalid' : '')]) }}
            @if ($errors->has('location'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('location') }}</strong>
                </span>
            @endif

            <br>
            <h5 class="card-text">{{ Form::label('edited', __('messages.Edited_after')) }}</h5>
            {{ Form::date('edited', '', ['class' => 'form-control'.($errors->has('edited') ? ' is-invalid' : '')]) }}
            @if ($errors->has('edited'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('edited') }}</strong>
                </span>
            @endif

            <br>
            <h5 class="card-text">{{ Form::label('pay_from', __('messages.Pay_from_to')) }}</h5>
            <div class="row">
                <div class="col">
                    {{ Form::text('pay_from', '', ['class' => 'form-control'.($errors->has('pay_from') ? ' is-invalid' : '')]) }}
                </div>
                <div class="col">
                    {{ Form::text('pay_to', '', ['class' => 'form-control'.($errors->has('pay_to') ? ' is-invalid' : '')]) }}
                </div>
            </div>
            @if ($errors->has('pay_from'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('pay_from') }}</strong>
                </span>
            @endif
            @if ($errors->has('pay_to'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('pay_to') }}</strong>
                </span>
            @endif


            <br>
            {{ Form::submit(__('messages.Apply'), ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}
        </div>
    </div>
</div>
