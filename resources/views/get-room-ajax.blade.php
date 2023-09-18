@if(!$rooms->isEmpty())
<input type="hidden" value="<?php echo $room_count; ?>" name="total_records" id="total_records" >
<input type="hidden" value="<?php echo count($rooms); ?>" name="current_count" id="current_count">
@foreach($rooms as $room)
  <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12"> 
    <div class="room-list">
      <div class="room-list-top">
        <a href="{{url('room-detail',$room['slug'])}}" class="room-list-img">
         @if($room['image_order'] != null)      
            @foreach(json_decode($room['image']) as $key => $image)
              @if($room['image_order'] == $key)
                <img src="{{url('show-images',$image)}}" alt="{{ucwords($room['title'])}}">
              @endif
            @endforeach         
          @else
            @foreach(json_decode($room['image']) as $key => $image)
              @if($loop->index == 0)
                <img src="{{url('show-images',$image)}}" alt="{{ucwords($room['title'])}}">
              @endif
           @endforeach
          @endif
        </a>
        <div class="room-ratting">
            <div class="my-rating starrating" id="rating_<?php echo $room['id']; ?>" title="<?php echo $room['id']; ?>"></div>
        </div>
      </div>
      <div class="room-list-inner">
        <h3><a href="{{url('room-detail',$room['slug'])}}">{{ucwords($room['title'])}}</a></h3>
        <p>{!! $room->description !!}</p>
        <div class="room-list-bottom">
          <div class="price-section">
              <big><i class="fa fa-rupee"></i><?php echo isset($room->final_price) && !empty($room->final_price) ? $room->final_price : $room->price; ?></big>
               <?php if(isset($room['new_old_price']) && !empty($room['new_old_price'])) {
                        echo '<strike><i class="fa fa-rupee"></i> '.$room->new_old_price.' </strike>';
                   }else{
                     echo isset($room->old_price) && !empty($room->old_price) ? '<strike><i class="fa fa-rupee"></i> '.$room->old_price.' </strike>' : '' ;
                   }  ?> 
              <?php
                   if(isset($room['new_off_percentage']) && !empty($room['new_off_percentage'])) {

                     echo '<span class="price-offers">'.$room->new_off_percentage.'% off</span>';
                   }else{
                     echo isset($room->off_percentage) && !empty($room->off_percentage) ? '<span class="price-offers">'.$room->off_percentage.'% off</span>' : '';
                   }
                   ?>
               <hr>
               <br>
               <a href="{{url('room-detail',$room['slug'])}}" class="btn btn-primary room-book-now">Book Now</a>
           </div>
        </div>
    
      </div>
    </div>
    <!-- Room List End -->
  </div>
   @endforeach
  @else
  <p style="text-align: center;font-size: 25px;font-weight: 500;">No Rooms Available</p>
  @endif
<!-- Col End -->
<script type="text/javascript">
 $(document).ready(function(){
   
  //room rating script
   $(".my-rating").starRating({
        starSize: 25,
        disableAfterRate: false,
        callback: function(currentRating, $el){
        },
        
    });
   $(".starrating").each(function( index ) {
      item_id = $(this).attr('title');
      console.log(item_id)
      $.ajax({
        url:"{{url('get-avg-reviews-rating')}}",
        type:"post",
        data: {item_id: item_id, item_type: "<?php echo 'Room'; ?>"},
        success:function(response){
          resp = JSON.parse(response);
          
          $('#rating_'+resp.item_id).starRating('setReadOnly', true);
          if(resp.status == 'success'){
            $('#rating_'+resp.item_id).starRating('setRating', resp.avg_rating); 
          }else{
          }
        }
      })
     });
    $('.room-book-now').click(function(){
        $('.check-in').val("<?php echo date('Y-m-d'); ?>")
        $('.check-out').val("<?php echo date('Y-m-d', time() + 86400); ?>")
        $('.rooms').val(1)
        $(this).attr('book-now') == "luxury_rooms_suits"  ? $('.category').val(1) : $('.category').val(2)
        $('#RoombookNowfrom').submit();
    });
 });
</script>