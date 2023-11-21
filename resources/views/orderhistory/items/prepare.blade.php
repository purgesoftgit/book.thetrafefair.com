@if(isset($preparing_order_history) && count($preparing_order_history) > 0)
@foreach($preparing_order_history as $key => $prepare_history)
<?php  $checkoutdata = json_decode($prepare_history['checkout_form_data'],true); $payudata = json_decode($prepare_history['payu_data'],true); ?>
  <div class="col-xl-4 col-lg-6 col-md-12">
    <!-- Order List Start -->
    <div class="order-list">
      <div class="order-title">

        <div class="order-title-inner">
          <div class="order-id">ID: {{$prepare_history['txnid']}}</div>
          <div class="mode-div">
             @if(array_key_exists('delivery_mode',$checkoutdata))
              @if(isset($checkoutdata['delivery_mode']) && $checkoutdata['delivery_mode'] == 'In House Order') {{$checkoutdata['delivery_mode']}} (#{{$checkoutdata['delivery_mode_room_no']}})
              @else {{$checkoutdata['delivery_mode']}} @endif
            @endif
          </div>
        </div>

        <div class="order-title-status">
          <span class="status-bg pending-bg">Approved</span>
          <span class="status-text">Order by @if($prepare_history->user) {{ucwords($prepare_history->user->first_name)}} {{ucwords($prepare_history->user->last_name)}} @endif
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
          <strong>₹<?php echo number_format((float)$prepare_history['amount'], 2, '.', ''); ?></strong>
        </div>

        <hr>

        <div class="hotel-charges">
          <span>Case to be collected from rider</span>
          <strong>₹<?php echo number_format((float)$checkoutdata['subtotal_rider'], 2, '.', ''); ?></strong>
        </div>

        <div class="text-center top-gape">
        <!-- //{{ url('restaurant-order-history/change-status',$prepare_history->id).'/PU' }} -->
          <a href="javascript:void(0)" type="button" class="btn btn-primary " onclick="var el = this; changeStatusRestaurnat({{$prepare_history->id}},'PU',el)">Order Picked Up</a>
          <button type="button" class="btn btn-dark print-invoice" data-txnid="{{$prepare_history->txnid}}">Print Bill</button>
          <!-- <button type="button" class="btn btn-dark btn-lg"></button> -->
          <a href="{{url('order-history',$prepare_history->id)}}" type="button" class="btn btn-info order-prepare">View</a>
        </div>

      </div>

    </div>
    <!-- Order List End -->
  </div>
@endforeach
<div class="d-none total_preparing_order">({{count($preparing_order_history)}})</div>
@else
<div class="col-md-12 no-data-found">
    <h6>No Data is available in Prepare State.</h6>
</div>
@endif