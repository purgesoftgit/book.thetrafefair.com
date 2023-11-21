<!-- Today Bookings Start End -->
<h4 class="booking-title">Today Bookings</h4>  
<div class="row">
@if($today_upcoming_booking->count() > 0)
@foreach($today_upcoming_booking as $today_upcoming_key => $today_upcoming_value)
<?php $checkout = json_decode($today_upcoming_value->checkout_form_data, true); ?>
  <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-12 col-sm-12">
    <!-- Bookig List Start -->
    <div class="booking-list">
      <div class="booking-list-inner">
        <h4>{{$checkout['customerName']}}</h4>

        <div class="id-date-div">
          <span class="room-id-span">#{{$today_upcoming_value->txnid}}</span>
          <span class="room-date-span">{{date('d M Y',strtotime($checkout['checkin']))}}</span>
        </div>

        <div class="room-timing-div">
          @foreach($checkout['item'] as $key => $value)
           @if($key == 'room_category') <?php $category = ucwords(str_replace("_"," ",$value)); ?> @endif
           @if($key == 'room')  <span class="total_room{{$today_upcoming_key}}" data-room="{{$value}}"> {{ucfirst($value)}} {{$category}} Room  </span>@endif 
           @if($key == 'guest')  <span> {{ucfirst($value)}} Guest  </span>@endif 
          @endforeach
          <!-- <span>1 Day - 1 night</span> -->
        </div>

        <div class="unpaid-item">
          <span class="primary-bg">@if(round($checkout['payment_option']) == 100) Paid @else Unpaid @endif</span>

        <?php if(array_key_exists('food_items', $checkout)) {
          foreach($checkout['food_items'] as $food_key => $food_value){
            ?>
           <span>{{$food_value['key']}}</span>
            <?php
            } }?> 
          <!-- <span>Lunch</span> -->
          <!-- <span>Dinner</span> -->
        </div>

        <div class="id-date-div amount-pay-div">
          <span class="room-id-span"><strong>Payable Amount :</strong> ₹{{ round($checkout['grand_total_amt'],2) }}</span>
          <!-- <span class="room-date-span"><strong>Final Amount :</strong> ₹<?php //echo number_format($checkout['f_total_amt'], 2, '.', ''); ?></span> -->
          <span class="room-date-span"><strong>Final Amount :</strong> ₹{{ round($checkout['grand_total_amt'],2) }}</span>
        </div>

        <div class="id-date-div amount-pay-div">
          <span class="room-id-span"><strong>Remaining Amount :</strong> ₹<?php echo ($checkout['payment_option'] == 0) ? (float)round($checkout['grand_total_amt']) :( (float)round($checkout['grand_total_amt'] - $checkout['f_total_amt'], 2)); ?></span>
          <span class="room-date-span"><strong>Advanced Payment :</strong> ₹<?php echo ($checkout['payment_option'] == 0) ? "0.00" : number_format($checkout['f_total_amt'], 2, '.', '');// echo number_format($checkout['f_total_amt'], 2, '.', '');?></span>
        </div>

          <div class="pay-box">
           @if(round($checkout['payment_option']) != 100)
            <div class="row">
              <div class="col-sm-6">
                 <div class="form-group">
                    <select class="form-control" data-index="{{$today_upcoming_key}}" name="payment_mode" id="payment_mode_list_{{$today_upcoming_value->id}}">
                      <option>Cash</option>
                      <option>Net Banking </option>
                      <option>Credit Card</option>
                      <option>UPI</option>
                      <option>Wallet</option>
                    </select>
                  </div>
              </div>
              <div class="col-sm-6">
                 <div class="form-group">
                    <input type="number" min="0.1" value="<?php echo ($checkout['payment_option'] == 0) ? (float)round($checkout['grand_total_amt']) :( (float)round($checkout['grand_total_amt'] - $checkout['f_total_amt'], 2)); ?>" placeholder="Enter Amount" class="form-control custom_payment_value{{$today_upcoming_key}}" custom-index="{{$today_upcoming_key}}" name="custom_payment_value" remaining-amount="<?php echo ($checkout['payment_option'] == 0) ? (float)round($checkout['grand_total_amt']) :( (float)round($checkout['grand_total_amt'] - $checkout['f_total_amt'], 2)); ?>"/>
                   <span class="custom_err{{$today_upcoming_key}} amount_error"></span>
                  </div>
              </div>
            </div>
           @endif
          </div>

          <div class="remaining-amount">
             @if(round($checkout['payment_option']) == 100)
                <p>(Payment Completed.) </p>
             @else
                <p>(You have paid <b>{{ $checkout['payment_option'] }}%</b> from your Total Amount. Now you will have to pay <b>₹<?php echo ($checkout['payment_option'] == 0) ? (float)round($checkout['grand_total_amt']) :( (float)round($checkout['grand_total_amt'] - $checkout['f_total_amt'], 2));  //$remaining_amount  = (float)round($checkout['grand_total_amt'] - $checkout['f_total_amt'], 2); echo round($remaining_amount,2); ?> </b>)</p>
             @endif
          </div>

      </div>

      <div class="booking-list-bottom">
        @if(round($checkout['payment_option']) != 100) 
          <button class="btn btn-primary paybtn" data-id="{{$today_upcoming_value->id}}" data-index="{{$today_upcoming_key}}">Pay</button> 
        @else 
        <?php 
          if(round($checkout['payment_option']) == 100 && (time() >= strtotime($checkout['checkin']))) { ?>
            <button type="button" class="btn btn-primary finalstatus{{$key}} edit-status" data-id="{{$today_upcoming_value->id}}" data-index="{{$today_upcoming_key}}" data-already="{{$today_upcoming_value['room_number']}}" data-value="today">Check In</button>
        <?php } ?>
        @endif
        <?php 

        if(round($checkout['payment_option']) == 100 && (time() == strtotime($checkout['checkout']) && (strtotime($checkout['checkout'].' 9:00:00 AM') >= strtotime(date('Y-m-d H:i:s A',strtotime('-2 hour',strtotime($checkout['checkout'].' 11:00:00 AM'))))))){
        ?>
          <a class="btn btn-dark" href="{{ url('room-order-history/change-status',$today_upcoming_value->id).'/M/0/status/1' }}">Mark As No Show</a>
        <?php } ?>
        <button class="btn btn-info" onclick="seeAllRoomDetails({{$today_upcoming_value->id}})">View</button>
      </div>
    </div>
    <!-- Bookig List End -->
  </div>

    @if($today_upcoming_value->room_number == null)

      <div>
      <!-- Modal -->
      <div class="modal fade" id="exampleModalToday{{$today_upcoming_key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Provide Room Number</h5>
            </div>
            <div class="modal-body">
              <form action="javascript:void(0);" method="POST" name="storeroomnumbertoday{{$today_upcoming_key}}" id="storeRoomNumber">
              @csrf
              <input type="hidden" name="status" value="IH"/>
              <input type="hidden" name="txn_id" value="{{$today_upcoming_value->id}}">
              <input type="hidden" name="total_rooms" id="total_rooms" value="<?php 
                  foreach($checkout['item'] as $key => $value){
                      echo ($key == 'room') ? $value : ''; 
                  }
              ?>">
                <div class="mb-3">
                  <label for="roomnumber">Room Number :</label>
                  <input type="text" class="form-control" name="roomnumber" id="roomnumber{{$today_upcoming_key}}">
                  <span class="room_Error"></span>
                </div>
              <div class="footer-action text-center">
                <button type="button" class="btn btn-secondary close-room-number-popup" data-dismiss="modal" onclick="this.form.reset();">Close</button>
                <a href="javascript:void(0);" class="btn btn-primary" id="save-room-number" data-numindex="{{$today_upcoming_key}}" data-txnid="{{$today_upcoming_value->txnid}}">Save </a>
              </div>
              </form >
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif


@endforeach
@else
<div class="col-xxl-4 col-xl-4 col-lg-6 col-md-12 col-sm-12 mt-3"> No Booking in Today </div>
@endif
</div>
<!-- Today Bookings Start End -->

 <div class="gape-div"></div>

 <!-- Later Bookings Start End -->
    <h4 class="booking-title">Later Bookings</h4>
    <div class="row">
      @if($later_upcoming_booking->count() > 0)
      @foreach($later_upcoming_booking as $later_upcoming_key => $late_upcoming_value)
      <?php $checkout1 = json_decode($late_upcoming_value->checkout_form_data, true); ?>

        <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-12 col-sm-12">
          <!-- Bookig List Start -->
          <div class="booking-list">
            <div class="booking-list-inner">
              <h4>{{$checkout1['customerName']}}</h4>

              <div class="id-date-div">
                <span class="room-id-span">#{{$late_upcoming_value->txnid}}</span>
                <span class="room-date-span">{{date('d M Y',strtotime($checkout1['checkin']))}}</span>
              </div>

              <div class="room-timing-div">
                @foreach($checkout1['item'] as $key => $value)
                @if($key == 'room_category') <?php $category = ucwords(str_replace("_"," ",$value)); ?> @endif
                @if($key == 'room')  <span class="total_room{{$later_upcoming_key}}" data-room="{{$value}}"> {{ucfirst($value)}} {{$category}} Room  </span>@endif 
                @if($key == 'guest')  <span> {{ucfirst($value)}} Guest  </span>@endif 
                @endforeach
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
                <span class="room-id-span"><strong>Remaining Amount :</strong> ₹<?php echo ($checkout1['payment_option'] == 0) ? (float)round($checkout1['grand_total_amt']) :( (float)round($checkout1['grand_total_amt'] - $checkout1['f_total_amt'], 2)); ?></span>
                <span class="room-date-span"><strong>Advanced Payment :</strong> ₹<?php echo ($checkout1['payment_option'] == 0) ? "0.00" : number_format($checkout1['f_total_amt'], 2, '.', '');// echo number_format($checkout1['f_total_amt'], 2, '.', '');?></span>
              </div>


                <div class="pay-box">
                @if(round($checkout1['payment_option']) != 100)
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                          <select class="form-control" data-index="{{$later_upcoming_key}}" name="payment_mode" id="payment_mode_list_{{$late_upcoming_value->id}}">
                              <option>Cash</option>
                              <option>Net Banking </option>
                              <option>Credit Card</option>
                              <option>UPI</option>
                              <option>Wallet</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <input type="number" min="0.1" value="<?php echo ($checkout1['payment_option'] == 0) ? (float)round($checkout1['grand_total_amt']) :( (float)round($checkout1['grand_total_amt'] - $checkout1['f_total_amt'], 2)); ?>" placeholder="Enter Amount" class="form-control custom_payment_value{{$later_upcoming_key}}" custom-index="{{$later_upcoming_key}}" name="custom_payment_value" remaining-amount="<?php echo ($checkout1['payment_option'] == 0) ? (float)round($checkout1['grand_total_amt']) :( (float)round($checkout1['grand_total_amt'] - $checkout1['f_total_amt'], 2)); ?>"/>
                          <span class="custom_err{{$later_upcoming_key}} amount_error"></span>
                        </div>
                    </div>
                  </div>
                @endif
                </div>

              <div class="remaining-amount">
                  @if(round($checkout1['payment_option']) == 100)
                      <p>(Payment Completed.) </p>
                  @else
                      <p>(You have paid <b>{{ $checkout1['payment_option'] }}%</b> from your Total Amount. Now you will have to pay <b>₹<?php echo ($checkout1['payment_option'] == 0) ? (float)round($checkout1['grand_total_amt']) :( (float)round($checkout1['grand_total_amt'] - $checkout1['f_total_amt'], 2)); ?> </b>)</p>
                  @endif
                </div>
            </div>

            <div class="booking-list-bottom">
              @if(round($checkout1['payment_option']) != 100)
                <button class="btn btn-primary paybtn" data-id="{{$late_upcoming_value->id}}" data-index="{{$later_upcoming_key}}">Pay</button> 
              @else 
              <?php if(round($checkout1['payment_option']) == 100 && (time() >= strtotime($checkout1['checkin']))) { ?>
                  <button type="button" class="btn btn-primary finalstatus{{$key}} edit-status-later" data-id="{{$late_upcoming_value->id}}" data-index="{{$later_upcoming_key}}" data-already="{{$late_upcoming_value['room_number']}}" data-value="later">Check In</button>
                <?php } ?>
              @endif
              <?php 
                if(round($checkout1['payment_option']) == 100 && (time() == strtotime($checkout1['checkout']) && (strtotime($checkout1['checkout'].' 9:00:00 AM') >= strtotime(date('Y-m-d H:i:s A',strtotime('-2 hour',strtotime($checkout1['checkout'].' 11:00:00 AM'))))))){
                ?>
                  <a class="btn btn-dark" href="{{ url('room-order-history/change-status',$late_upcoming_value->id).'/M/0/status/1' }}">Mark As No Show</a>
              <?php } ?>
              <button class="btn btn-info" onclick="seeAllRoomDetails({{$late_upcoming_value->id}})">View</button>
            </div>
          </div>
          <!-- Bookig List End -->

          @if($late_upcoming_value->room_number == null)
              <div>
              <!-- Modal -->
              <div class="modal fade" id="exampleModalLater{{$later_upcoming_key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Provide Room Number</h5>
                    </div>
                    <div class="modal-body">
                      <form action="javascript:void(0)" method="POST" name="storeroomnumberlater{{$later_upcoming_key}}" id="storeRoomNumberlater">
                      @csrf
                      <input type="hidden" name="status" value="IH"/>
                      <input type="hidden" name="txn_id" value="{{$late_upcoming_value->id}}">
                      <input type="hidden" name="total_rooms" id="total_rooms_latr" value="<?php 
                          foreach($checkout1['item'] as $key => $value){
                            echo ($key == 'room') ? $value : ''; 
                          }
                      ?>">
                        <div class="mb-3">
                          <label for="roomnumber">Room Number :</label>
                          <input type="text" class="form-control" name="roomnumber" id="roomnumberlater{{$later_upcoming_key}}">
                          <span class="room_Error"></span>
                        </div>
                          <div class="footer-action text-center">
                            <button type="button" class="btn btn-secondary close-room-number-popup" data-dismiss="modal" onclick="this.form.reset();">Close</button>
                            <button type="button" class="btn btn-primary" id="save-room-number-later" data-numindex="{{$later_upcoming_key}}" data-txnid="{{$late_upcoming_value->txnid}}">Save </button>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
        </div>
      @endforeach

      @else
        <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-12 mt-3"> No Booking in Later </div>
      @endif

    </div>

    <div class="gape-div"></div>
  <!-- Prev Bookings Start End -->
  <h4 class="booking-title">Previous Bookings</h4>
  <div class="row">
  @if($prev_upcoming_booking->count() > 0)
  @foreach($prev_upcoming_booking as $prev_upcoming_key => $prev_upcoming_value)
  <?php $checkout2 = json_decode($prev_upcoming_value->checkout_form_data, true); ?>

  
    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-12 col-sm-12">
      <!-- Bookig List Start -->
      <div class="booking-list">
        <div class="booking-list-inner">
          <h4>{{$checkout2['customerName']}}</h4>

          <div class="id-date-div">
            <span class="room-id-span">#{{$prev_upcoming_value->txnid}}</span>
            <span class="room-date-span">{{date('d M Y',strtotime($checkout2['checkin']))}}</span>
          </div>

          <div class="room-timing-div">
            @foreach($checkout2['item'] as $key => $value)
            @if($key == 'room_category') <?php $category = ucwords(str_replace("_"," ",$value)); ?> @endif
            @if($key == 'room')  <span class="total_room_prev{{$prev_upcoming_key}}" data-room="{{$value}}"> {{ucfirst($value)}} {{$category}} Room  </span>@endif 
            @if($key == 'guest')  <span> {{ucfirst($value)}} Guest  </span>@endif 
            @endforeach
          </div>

          <div class="unpaid-item">
            <span class="primary-bg">@if(round($checkout2['payment_option']) == 100) Paid @else Unpaid @endif</span>

          <?php if(array_key_exists('food_items', $checkout2)) {
            foreach($checkout2['food_items'] as $food_key => $food_value){
              ?>
            <span>{{$food_value['key']}}</span>
              <?php
              } }?> 
          </div>

          <div class="id-date-div amount-pay-div">
            <span class="room-id-span"><strong>Payable Amount :</strong> ₹{{ round($checkout2['grand_total_amt'],2) }}</span>
            <span class="room-date-span"><strong>Final Amount :</strong> ₹{{ round($checkout2['grand_total_amt'],2) }}</span>
          </div>

          <div class="id-date-div amount-pay-div">
            <span class="room-id-span"><strong>Remaining Amount :</strong> ₹<?php echo ($checkout2['payment_option'] == 0) ? (float)round($checkout2['grand_total_amt']) :( (float)round($checkout2['grand_total_amt'] - $checkout2['f_total_amt'], 2)); ?></span>
            <span class="room-date-span"><strong>Advanced Payment :</strong> ₹<?php echo ($checkout2['payment_option'] == 0) ? "0.00" : number_format($checkout2['f_total_amt'], 2, '.', '');?></span>
          </div>

          <?php 
            $current_time = date("h:i A",time());
            $date_first = strtotime(date('Y-m-d h:i A',strtotime($checkout2['checkin'].$current_time)));
            $date_last = strtotime(date('Y-m-d h:i A',strtotime("+12 hours",strtotime($checkout2['checkin']." 12:00 AM"))));
          ?>

          <div class="pay-box">
          @if(round($checkout2['payment_option']) != 100 && $date_first < $date_last && strtotime($checkout2['checkin']) >= strtotime(date('Y-m-d',strtotime("-1 days") )))
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                    <select class="form-control" data-index="{{$prev_upcoming_key}}" name="payment_mode" id="payment_mode_list_{{$prev_upcoming_value->id}}">
                        <option>Cash</option>
                        <option>Net Banking </option>
                        <option>Credit Card</option>
                        <option>UPI</option>
                        <option>Wallet</option>
                      </select>
                  </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                    <input type="number" min="0.1" value="<?php echo ($checkout2['payment_option'] == 0) ? (float)round($checkout2['grand_total_amt']) :( (float)round($checkout2['grand_total_amt'] - $checkout2['f_total_amt'], 2)); ?>" placeholder="Enter Amount" class="form-control custom_payment_value{{$prev_upcoming_key}}" custom-index="{{$prev_upcoming_key}}" name="custom_payment_value" remaining-amount="<?php echo ($checkout2['payment_option'] == 0) ? (float)round($checkout2['grand_total_amt']) :( (float)round($checkout2['grand_total_amt'] - $checkout2['f_total_amt'], 2)); ?>"/>
                    <span class="custom_err{{$prev_upcoming_key}} amount_error"></span>
                  </div>
              </div>
            </div>
          @endif
          </div>

          <div class="remaining-amount">
              @if(round($checkout2['payment_option']) == 100)
                  <p>(Payment Completed.) </p>
              @else
                  <p>(You have paid <b>{{ $checkout2['payment_option'] }}%</b> from your Total Amount. Now you will have to pay <b>₹<?php echo ($checkout2['payment_option'] == 0) ? (float)round($checkout2['grand_total_amt']) :( (float)round($checkout2['grand_total_amt'] - $checkout2['f_total_amt'], 2)); ?> </b>)</p>
              @endif
            </div>
        </div>
 
        <div class="booking-list-bottom">
          @if(round($checkout2['payment_option']) != 100 && $date_first < $date_last && strtotime($checkout2['checkin']) >= strtotime(date('Y-m-d',strtotime("-1 days"))) )
            <button class="btn btn-primary paybtn" data-id="{{$prev_upcoming_value->id}}" data-index="{{$prev_upcoming_key}}">Pay</button> 
          @else 
              @if(round($checkout2['payment_option']) == 100 && (time() >= strtotime($checkout2['checkin']) && $date_first < $date_last) && strtotime($checkout2['checkin']) >= strtotime(date('Y-m-d',strtotime("-1 days") )))
                  <button type="button" class="btn btn-primary finalstatus{{$key}} edit-status-prev" data-id="{{$prev_upcoming_value->id}}" data-index="{{$prev_upcoming_key}}" data-already="{{$prev_upcoming_value['room_number']}}" data-value="prev">Checkin</button>
              @else
                  <button class="btn btn-dark" id="mark-as-no-prev" data-id="{{$prev_upcoming_value->id}}" >Mark As No Show</button>
              @endif
          @endif
          <button class="btn btn-info" onclick="seeAllRoomDetails({{$prev_upcoming_value->id}})">View</button>
        </div>
      </div>
      <!-- Bookig List End -->

         @if($prev_upcoming_value->room_number == null)
          <div>
          <!-- Modal -->
          <div class="modal fade" id="exampleModalprev{{$prev_upcoming_key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Provide Room Number sdfsd</h5>
                </div>
                <div class="modal-body">
                  <form action="javascript:void(0)" method="POST" name="storeroomnumberprev{{$prev_upcoming_key}}" id="storeRoomNumberprev">
                  @csrf
                  <input type="hidden" name="status" value="IH"/>
                  <input type="hidden" name="txn_id" value="{{$prev_upcoming_value->id}}">
                  <input type="hidden" name="total_rooms" id="total_rooms_prev" value="dkgjkhjkh">
                    <div class="mb-3">
                      <label for="roomnumber">Room Number :</label>
                      <input type="text" class="form-control" name="roomnumber" id="roomnumberprev{{$prev_upcoming_key}}">
                      <span class="room_Error"></span>
                    </div>
                      <div class="footer-action text-center">
                        <button type="button" class="btn btn-secondary close-room-number-popup" data-dismiss="modal" onclick="this.form.reset();">Close</button>
                        <button type="button" class="btn btn-primary" id="save-room-number-prev" data-numindex="{{$prev_upcoming_key}}" data-txnid="{{$prev_upcoming_value->txnid}}">Save </button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
    </div>
  @endforeach
  @else
    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-12 mt-3"> No Booking in Previous </div>
  @endif

@if($total_today_later > 0) <div class="d-none total_today_later">({{$total_today_later}})</div> @endif
 <!-- Later Bookings Start End -->