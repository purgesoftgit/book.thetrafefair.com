@if(isset($pending_order_history) && count($pending_order_history) > 0)
@foreach($pending_order_history as $key => $pending_history)
<?php  $checkoutdata = json_decode($pending_history['checkout_form_data'],true); $payudata = json_decode($pending_history['payu_data'],true); ?>
  <div class="col-xl-4 col-lg-6 col-md-12">
    <!-- Order List Start -->
    <div class="order-list">

      <div class="order-title">

        <div class="order-title-inner">
          <div class="order-id">ID: {{$pending_history['txnid']}}</div>
          <div class="mode-div">
            @if(array_key_exists('delivery_mode',$checkoutdata))
              @if(isset($checkoutdata['delivery_mode']) && $checkoutdata['delivery_mode'] == 'In House Order') {{$checkoutdata['delivery_mode']}} (#{{$checkoutdata['delivery_mode_room_no']}})
              @else {{$checkoutdata['delivery_mode']}} @endif
            @endif
          </div>
        </div>

        <div class="order-title-status">
          <span class="status-bg pending-bg">Pending</span>
          <span class="status-text">Order by @if($pending_history->user) {{ucwords($pending_history->user->first_name)}} {{ucwords($pending_history->user->last_name)}} @endif
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
          <strong>₹<?php echo number_format((float)$pending_history['amount'], 2, '.', ''); ?></strong>
        </div>

        <hr>

        <div class="hotel-charges">
          <span>Case to be collected from rider</span>
          <strong>₹<?php echo number_format((float)$checkoutdata['subtotal_rider'], 2, '.', ''); ?></strong>
        </div>

        <div class="text-center top-gape">
          <!-- <a href="{{ url('restaurant-order-history/change-status',$pending_history->id).'/C' }}" type="button" class="btn btn-danger order-prepare">Cancel</a> -->
          <!-- <a href="{{ url('restaurant-order-history/change-status',$pending_history->id).'/A' }}" type="button" class="btn btn-success order-prepare">Approve</a> -->
          <a href="javascript:void(0)" type="button" onclick="var el = this; changeStatusRestaurnat({{$pending_history->id}},'A',el)" class="btn btn-success order-prepare">Approve</a>
          <a href="javascript:void(0)" type="button" onclick="var el = this; changeStatusRestaurnat({{$pending_history->id}},'C',el)" class="btn btn-danger order-prepare">Cancel</a>
          <!-- <a href="{{url('order-history',$pending_history->id)}}" type="button" class="btn btn-info  btn-lg order-prepare">View</a> -->
        </div>

      </div>

    </div>
    <!-- Order List End -->
  </div>
@endforeach
<div class="d-none total_pending_order">({{count($pending_order_history)}})</div>
@else
<div class="col-md-12 no-data-found">
  <h6>No Data is available in Pending State.</h6>
</div>
@endif