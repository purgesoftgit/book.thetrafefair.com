@if(isset($picked_up_order_history) && count($picked_up_order_history) > 0)
@foreach($picked_up_order_history as $key => $picked_history)
<?php  $checkoutdata = json_decode($picked_history['checkout_form_data'],true); $payudata = json_decode($picked_history['payu_data'],true); ?>
<div class="col-xl-4 col-lg-6 col-md-12">
  <!-- Order List Start -->
  <div class="order-list">
    <div class="order-title">
      <div class="order-title-inner">
        <div class="order-id">ID: {{$picked_history['txnid']}}</div>
        <div class="mode-div">
           @if(array_key_exists('delivery_mode',$checkoutdata))
            @if(isset($checkoutdata['delivery_mode']) && $checkoutdata['delivery_mode'] == 'In House Order') {{$checkoutdata['delivery_mode']}} (#{{$checkoutdata['delivery_mode_room_no']}})
            @else {{$checkoutdata['delivery_mode']}} @endif
          @endif
        </div>
      </div>

      <div class="order-title-status">
        <span class="status-bg pending-bg">Picked Up</span>
        <span class="status-text">Order by @if($picked_history->user) <span class="d-none" id="Phone">{{ preg_replace('/^\+?91|\|1|\D/', '', ($picked_history->user->phone_number))}}</span>  {{ucwords($picked_history->user->first_name)}} {{ucwords($picked_history->user->last_name)}} @endif
      </div>

    </div>

    <div class="order-list-inner">

      <!-- Order Item Listing Start-->
      <div class="order-item-listing">
        <!-- Order Item List Start-->
        @if(isset($checkoutdata['item']))
          @foreach($checkoutdata['item'] as $itm_key => $itm_value)
            <div class="order-item-list">
              <span class="order-item-name">
                <img src="{{asset('img/order-img.png')}}" alt="Item Icon">
                <span><?php echo $itm_value['quantity']; ?> x <?php echo $itm_value['name']; ?></span>
              </span>
              <strong>₹<?php echo number_format((float)$itm_value['final_price'], 2, '.', ''); ?></strong>
            </div>
          @endforeach
        @endif
          <!-- Order Item List End-->
      </div>
      <!-- Order Item Listing End-->
      
      <div class="hotel-charges">
        <span>Sub Total</span>
        <strong>₹<?php echo number_format((float)$checkoutdata['subtotal_amt'], 2, '.', ''); ?></strong>
      </div>

      <div class="hotel-charges">
        <span>Taxes</span>
        <strong>₹<?php echo number_format((float)$checkoutdata['subtotal_taxes'], 2, '.', ''); ?></strong>
      </div>

      <div class="order-total-bill">
        <span>Total Bill</span>
        <strong>₹<?php echo number_format((float)($checkoutdata['net_total_amt'] + $checkoutdata['subtotal_rider']), 2, '.', ''); ?></strong>
      </div>

      <div class="hotel-charges">
        <span>Trade International Credit</span>
        <strong>- <?php echo number_format((float)$checkoutdata['subtotal_tti_credit'], 2, '.', ''); ?> P</strong>
      </div>
      <div class="hotel-charges">
        <span>Reward Points</span>
        <strong>- <?php echo number_format((float)$checkoutdata['subtotal_tti_rewardpoint'], 2, '.', ''); ?> P</strong>
      </div>
      <div class="hotel-charges">
        <span>Promocode</span>
        <strong>-₹<?php echo number_format((float)$checkoutdata['promocode_deduction'], 2, '.', ''); ?></strong>
      </div>
      <div class="hotel-charges dark-color">
        <span>Payable Amount</span>
        <strong>₹<?php echo number_format((float)$picked_history['amount'], 2, '.', ''); ?></strong>
      </div>

      <hr>

      <div class="hotel-charges">
        <span>Case to be collected from rider</span>
        <strong>₹<?php echo number_format((float)$checkoutdata['subtotal_rider'], 2, '.', ''); ?></strong>
      </div>
      <div class="text-center top-gape">
        <button type="button" class="btn btn-dark picked-up-btn" onclick="var el = this; pickeduptodeliverd({{$picked_history->id}},'{{$checkoutdata['delivery_mode']}}',el);">Order Delivered</button>
        <a href="{{url('order-history',$picked_history->id)}}" type="button" class="btn btn-info order-prepare">View</a>
      </div>

    </div>

  </div>
  <!-- Order List End -->
</div>
@endforeach
<div class="d-none total_picked_up_order">({{count($picked_up_order_history)}})</div>
@else
<div class="col-md-12 no-data-found">
  <h6>No Data is available in Picked Up State.</h6>
</div>
@endif
