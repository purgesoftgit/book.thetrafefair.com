@if(!empty($transaction_data))
<?php $checkoutdata = json_decode($transaction_data->checkout_form_data, true);
$payu_data = json_decode($transaction_data->payu_data, true);
?>
<h4 class="room-detail-title">User Detail checkout</h4>
<div class="room-detail-box">
  <div class="room-detail-line">
    <strong>Name :</strong>
    <span>{{$checkoutdata['customerName']}}</span>
  </div>
  <div class="room-detail-line">
    <strong>Email :</strong>
    <span>{{$checkoutdata['customerEmail']}}</span>
  </div>
  <div class="room-detail-line">
    <strong>Phone :</strong>
    <span>{{$checkoutdata['customerPhone']}}</span>
  </div>
  <div class="room-detail-line">
    <strong>Transaction ID :</strong>
    <span>{{$transaction_data->txnid}}</span>
  </div>
 
</div>

<h4 class="room-detail-title">Room Detail</h4>
<div class="room-detail-box blue-box">
  @foreach($checkoutdata['item'] as $key => $value)

  @if($key == 'room_category')
  <div class="room-detail-line">
    <strong> <?php $category = ucwords(str_replace("_", " ", $value)); ?> Room Price :</strong>@endif
    @if($key == 'per_shift_price')<span>₹{{$value}} </span>
  </div>
  @endif
 
  @if($key == 'arrival_time' && $value != 0)
  <div class="room-detail-line">
    <strong>Arrival Time :</strong>
    <span> {{$value}}</span>
  </div>
  @endif

  @if($key == 'preference' && $value != 0)
  <div class="room-detail-line">
    <strong>Preference :</strong>
    <span> {{ ($value == 1) ? 'High Preference' : (($value == 2) ? 'Ground Preference' : 'No Preference')}}</span>
  </div>
  @endif

  @if($key == 'country' && $value != 0)
  <div class="room-detail-line">
    <strong>Country :</strong>
    <span> {{$value}}</span>
  </div>
  @endif

  @if($key == 'room')
  <div class="room-detail-line">
    <strong>Room :</strong>
    <span> {{$value}} Room</span>
  </div>
  @endif

  @if($key == 'guest')
  <div class="room-detail-line">
    <strong>Guest :</strong>
    <span> {{$value}} Guest</span>
  </div>
  @endif
  @endforeach

  <div class="room-detail-line">
    <strong>Checkin :</strong>
    <span>{{date('d M, Y h:i A',strtotime($checkoutdata['checkin']))}}</span>
  </div>
  <div class="room-detail-line">
    <strong>Checkout :</strong>
    <span>{{date('d M, Y h:i A',strtotime($checkoutdata['checkout']))}}</span>
  </div>
  <div class="room-detail-line">
    <strong>Date of Booking :</strong>
    <span>{{ date('d M, Y h:i A',strtotime($transaction_data->created_at)) }}</span>
  </div>
  <div class="room-detail-line">
    <strong>Online Payment Mode :</strong>
    <span>@if(array_key_exists('paymentMode',$payu_data)) {{ str_replace('_',' ',$payu_data['paymentMode']) ?? ''}} @endif </span>
  </div>

  @if($transaction_data['payment_mode'])
  <div class="room-detail-line">
    <strong>New Payment Mode :</strong>
    <span>@if(is_array(json_decode($transaction_data['payment_mode'], true)))
      @foreach(json_decode($transaction_data['payment_mode'], true) as $new_pay_key => $new_pay_index)
      <?php $obj = json_decode($new_pay_index);
      if ($new_pay_key >= 1)
        echo ", ";
      echo $obj->mode . ' =>   ₹' . $obj->value;
      ?>
      @endforeach
      @else
      {{ str_replace('_',' ',$transaction_data['payment_mode']) ?? '----'}}</br>
      @endif
    </span>
  </div>
  @endif
</div>

<h4 class="room-detail-title">Transactions</h4>
<div class="room-detail-box purple-box">
  <div class="room-detail-line">
    <strong>Room Total Price :</strong>
    <span>₹{{$checkoutdata['subtotal_amt']}}</span>
  </div>
  <div class="room-detail-line">
    <strong>Room Tax :</strong>
    <span>₹{{$checkoutdata['subtotal_taxes'] }}</span>
  </div>

  <div class="room-detail-line room-detail-total">
    <strong>Total Amount :</strong>
    <span>₹{{$checkoutdata['net_total_amt']}}</span>
  </div>
  <div class="room-detail-line">
    <strong>Promocode :</strong>
    <span>- ₹{{$checkoutdata['promocode_deduction']}}</span>
  </div>

  <div class="room-detail-line">
    <strong>Payable Amount :</strong>
    <span>₹{{ round($checkoutdata['grand_total_amt'],2) }}</span>
  </div>
  <div class="room-detail-line room-detail-total">
    <strong>Advanced Payment :</strong>
    <span>₹<?php echo number_format($checkoutdata['f_total_amt'], 2, '.', ''); ?></span>
  </div>

  <div class="help-line">
    @if(round($checkoutdata['payment_option']) == 100)
    <p>(Payment Completed.) </p>
    @else
    <p>(You have paid <b>{{ $checkoutdata['payment_option'] }}%</b> from your Total Amount. Now you will have to pay <b>₹<?php $remaining_amount  = (float)round($checkoutdata['grand_total_amt'] - $checkoutdata['f_total_amt'], 2);
                                                                                                                          echo round($remaining_amount, 2); ?> </b>)</p>
    @endif
  </div>
</div>
@endif