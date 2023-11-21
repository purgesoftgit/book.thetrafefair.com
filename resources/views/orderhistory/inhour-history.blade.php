@if($in_house_booking->count() > 0)
@foreach($in_house_booking as $inhouse_key => $inhouse_value)
<?php $checkout1 = json_decode($inhouse_value->checkout_form_data, true); ?>
  <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-12 col-sm-12">
    <!-- Bookig List Start -->
    <div class="booking-list">
      <div class="booking-list-inner">
        <h4>{{$checkout1['customerName']}} - <span class="room_number">@if($inhouse_value->room_number != null) @foreach(json_decode($inhouse_value->room_number) as $room_key => $room_value)
                    @if($room_key >= 1)<span>,</span>@endif#{{$room_value}}
              @endforeach
              @endif</span></h4>

        <div class="id-date-div">
          <span class="room-id-span">#{{$inhouse_value->txnid}}</span>
          {{--<span class="room-date-span">{{date('d M Y',strtotime($inhouse_value->updated_at))}}</span>--}}
          <span class="room-date-span">{{date('d M Y',strtotime($checkout1['checkin']))}}</span>
        </div>

        <div class="id-date-div mt-3">
          <span class="room-date-span"><strong>Checkout Date :</strong> <?php echo date('d M Y',strtotime($checkout1['checkout'])); ?></span>
        </div>

        <div class="room-timing-div">
          @foreach($checkout1['item'] as $key => $value)
           @if($key == 'room_category') <?php $category = ucwords(str_replace("_"," ",$value)); ?> @endif
           @if($key == 'room')  <span> {{ucfirst($value)}} {{$category}} Room  </span>@endif 
           @if($key == 'guest')  <span> {{ucfirst($value)}} Guest  </span>@endif
          @endforeach
          <!-- <span>1 Day - 1 night</span> -->
        </div>

        <div class="unpaid-item">
          <span class="primary-bg">@if(round($checkout1['payment_option']) == 100) Paid @else Unpaid @endif</span>
          <?php if(array_key_exists('food_items', $checkout1)) {
            foreach($checkout1['food_items'] as $food_key => $food_value){
              ?>
             <span>{{$food_value['key']}}</span>
              <?php
              } }?> 
        </div>
  
        <div class="id-date-div amount-pay-div">
          <span class="room-id-span"><strong>Payable Amount :</strong> ₹{{ round($checkout1['grand_total_amt'],2) }}</span>
          <span class="room-date-span"><strong>Final Amount :</strong> ₹{{ round($checkout1['grand_total_amt'],2) }}</span>
        </div>

        <div class="id-date-div amount-pay-div">
          <span class="room-id-span"><strong>Remaining Amount :</strong> ₹<?php $remaining_amount  = (float)round($checkout1['grand_total_amt'] - $checkout1['f_total_amt'], 2); echo round($remaining_amount,2); ?></span>
          <span class="room-date-span"><strong>Advanced Payment :</strong> ₹<?php echo number_format($checkout1['f_total_amt'], 2, '.', ''); ?></span>
        </div>

        <div class="pay-box"></div>
            <div class="remaining-amount">
                <p>(Payment Completed.) </p>
            </div>
      </div>

      <div class="booking-list-bottom">
       @if(isset($inhouse_value->items_booking) && $inhouse_value->items_booking->count() != 0)
            <a type="button" data-toggle="modal" data-target="#ItemModal{{$key}}"  class="btn btn-dark success-btn see-order-items">See Order Items</a>
       @endif

      <?php  
        if(date('d-m-y') == date('d-m-y',strtotime($checkout1['checkout']))){
          $today = true;
        }else{
          $today = false;
        }
      ?>
        
        {{--<a class="btn btn-primary {{($today == true) ? 'today_checkout_record' : ''}}" href="{{ url('room-order-history/change-status',$inhouse_value->id).'/C/0/status/1/0' }}">Checkout</a>--}}

        <button class="btn btn-primary checkout-data" type="button" data-id="{{$inhouse_value->id}}">Checkout</button>
        
        <!-- <button class="btn btn-dark">Mark As No Show</button> -->
        <button class="btn btn-info" onclick="seeAllRoomDetails({{$inhouse_value->id}},'inhouse')">View</button>
      </div>

      <!--If Item according to room number Modal Start-->
        <div class="modal fade" id="ItemModal{{$key}}" tabindex="-1" aria-labelledby="ItemModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ItemModalLabel">Order Items</h5>
              </div>
              <div class="modal-body">
                <div class="item_listing">
                  <?php 
                  
                  if( isset($inhouse_value->items_booking) && count($inhouse_value->items_booking) != 0 && isset($inhouse_value['items_booking'])){
                    foreach($inhouse_value['items_booking'] as $key1 => $value1){
                      $itemcheckoutdata = json_decode($value1['checkout_form_data'],true); 
                      foreach($itemcheckoutdata['item'] as $it_key => $it_value){
                      
                    ?> 
                    <div class="item_data">
                      <div class="item_name">
                        <?php echo $it_value['quantity']; ?> x <?php echo $it_value['price']; ?> &nbsp;<img src="{{ asset('img/order-img.png') }}"> <?php echo $it_value['name']; ?>
                      </div>
                      <div class="item_price">
                        <strong class="pricealign">₹<?php echo number_format((float)$it_value['final_price'], 2, '.', ''); ?></strong>
                      </div>
                    </div>
                    <?php } } }?> 
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-room-number-popup" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
       <!--If Item according to room number Modal End-->


    </div>
    <!-- LaterBookig List End -->
  </div>
@endforeach
<div class="d-none total_in_house_booking">({{$in_house_booking->count()}})</div>
@else
<div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-12 mt-3">No any Booking in In House</div>
@endif