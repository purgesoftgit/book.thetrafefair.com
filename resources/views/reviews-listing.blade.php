@if(!empty($reviews))
@foreach($reviews as $key => $value)
<div class="review-list">
    <div class="review-list-top">
        <div class="review-list-img"><img src="img/user-icon2.png" alt="Image"></div>
        <div class="review-list-text">
            <div class="review-list-name">{{$value->author_name}}</div>
            <div class="review-list-number">{{$value->liked ?? ''}}</div>
        </div>
    </div>
    <p>{!! $value->review !!}</p>
</div>
@endforeach
@else
<p></p>
@endif