@if(isset($del_cancel_order_history) && count($del_cancel_order_history) > 0)
@foreach($del_cancel_order_history as $key => $deliver_history)
  <?php  $checkoutdata = json_decode($deliver_history['checkout_form_data'],true); $payudata = json_decode($deliver_history['payu_data'],true); ?>
  <tr>
    <td class="d-none deliver_cacnel_history" data-totalorderdata="{{$total_orderd_data}}" data-deliv="({{count($del_cancel_order_history)}})">{{ $deliver_history->updated_at }}</td>
    <td>{{ $offset + $key + 1 }}</td>
    <td>@if($deliver_history->user) {{ucwords($deliver_history['user']['first_name'])}} {{ucwords($deliver_history['user']['last_name'])}} @endif</td>
    <td>{{ date('F d, Y',strtotime($deliver_history->created_at)) }}</td>
    <td>
    <?php 
      $result_names = '';
      foreach($checkoutdata['item'] as $item_key => $item_value){
          $result_names .= $item_value['name'].' ,';
      }
      echo rtrim($result_names, ',');
    ?>
    </td>
    <td>₹{{($checkoutdata['net_total_amt'] + $checkoutdata['subtotal_rider'])}}</td>
    <td>@if($checkoutdata['delivery_mode'] == "In House Order")  {{$checkoutdata['delivery_mode']}}  {{'(#'.$checkoutdata['delivery_mode_room_no'].')'}} @else {{$checkoutdata['delivery_mode']}} @endif</td>
    <td>
      @if($deliver_history->status == "D")
      <button type="button" class="btn btn-dark btn-sm print-invoice" data-txnid="{{$deliver_history->txnid}}">Print Bill</button>
      <a href="{{url('downloadReceipt',$deliver_history->txnid)}}" class="btn btn-primary btn-sm">Download</a>
     @endif

     @if($checkoutdata['grand_total_amt'] > 0 && ($deliver_history->status == "C" && $deliver_history->is_refunded == 0)) <button class="btn btn-dark btn-sm refund-mount" data-id="{{$deliver_history->txnid}}">Refund Amount</button> @endif

      <a href="{{url('order-history',$deliver_history->id)}}" type="button" class="btn btn-info  btn-sm order-prepare">View</a>
    </td>
  </tr>
@endforeach

@else
<tr>
<td colspan="7" class="text-center text-dark">No Data</td>
</tr>
@endif