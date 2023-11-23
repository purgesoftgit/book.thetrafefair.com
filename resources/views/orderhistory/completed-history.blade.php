@if($mark_complete_cancel->count() > 0)
  @foreach($mark_complete_cancel as $complete_key => $complete_value)
  <?php $checkout2 = json_decode($complete_value->checkout_form_data, true); ?>
  <tr>
    <td class="d-none total_mcc_booking" data-totalmdcount="{{$total_cmc_data}}" data-total_mcc_booking="({{$mark_complete_cancel->count()}})"></td>
    <td>{{ $offset + $complete_key + 1 }}</td>
    <td>{{$checkout2['customerName']}}</td>
    <td> @if($complete_value->inperson_checkin_time) {{date('d M, Y h:i A',strtotime($complete_value->inperson_checkin_time))}} @else {{ date('d M, Y',strtotime($checkout2['checkin'])) }} 12:00 PM @endif</td>
    <td> {{date('d M, Y h:i A',strtotime($complete_value->inperson_checkout_time ?? $checkout2['checkout']))}}</td>
    <td><?php foreach($checkout2['item'] as $key => $item_value){
            if($key == 'room_title')
                echo $item_value;
        }?>
    </td>
    <td>₹{{$checkout2['f_total_amt']}}</td>
    <td>
      @if($complete_value->f_status == "M")
         <span class="badge bg-secondary text-light">Mark as No Show</span>
      @elseif($complete_value->f_status == "C")
          <span class="badge bg-success text-light">Checkout</span>
      @elseif($complete_value->f_status == "IH")
          <span class="badge bg-info text-light">In House</span>
      @else
          <span class="badge bg-danger text-light">Cancelled</span>
      @endif
    </td>
    <td>
      @if($complete_value->f_status == "C") <a class="btn btn-primary btn-sm" href="{{url('downloadTicket').'/'.$complete_value->txnid .'/downl_invoice'}}">Download Invoice</a> @endif
      @if(($checkout2['grand_total_amt'] > 0 &&  !empty($complete_value->wallet)) && ($complete_value->status == 'ROOM_CANCELLED' && $complete_value->is_refunded == 0)) <button class="btn btn-dark btn-sm refund-mount" data-id="{{$complete_value->txnid}}">Refund Amount</button> @endif
      <!-- <button class="btn btn-dark">Mark As No Show</button> -->
      <button class="btn btn-info btn-sm" onclick="seeAllRoomDetails({{$complete_value->id}},'checkout')">View</button>
    </td>
  </tr>
@endforeach
@else
<tr>
<td colspan="8"  class="text-center text-dark"> No Data.</td>
</tr>
@endif
