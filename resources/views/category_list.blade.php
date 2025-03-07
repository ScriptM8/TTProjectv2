@extends('posters')

@section('category_list')
    <div class="card">
        <h4 class="list-group-item list-group-item-primary">{{ __('messages.Categories') }}</h4>
        <div class="card-body">
            <form action="index_update">
                <div class="list-group">
                    @foreach ($cat_list as $category)
                        <div class="list-item">
                            <input type="checkbox" id="{{ $category['id'] }}" name="{{ $category['name'] }}" onClick="change({{ $category['id'] }})" @if($category['checked'] === true) checked @endif)>
                            <label for="{{ $category['id'] }}">{{ $category['name'] }}</label>
                            <img src="/images/{{ $category['icon_path'] }}" style="height: 40px; width: 40px;">
                        </div>
                    @endforeach
                </div>
            </form>
        </div>
    </div>

<script>
    function change(id)
    {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type:'POST',
            url:'/cat_update',
            data:{id: id, _token: CSRF_TOKEN},
            success:function(data) {
                //alert('gucci');
                location.reload();
            }
        });
    }
</script>

@stop
