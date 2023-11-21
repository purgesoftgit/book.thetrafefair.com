@extends('layouts.dashboard-layout')
@section('content')
<style>.edit-status{cursor:pointer;}</style>
<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" href="#"><i class="fas fa-bars"></i></a>
  <!--Navbar Start-->
  @include('dashboard.navbar')
  <!--EndNavbar Start-->
  <!-- sidebar-wrapper  -->
  <main class="page-content">
  
  <!-- top bar -->
  @include('dashboard.header')

    <div class="midsection">
      <div class="container-fluid">

        <div class="row">
          <!-- <div class="col-md-2 col-lg-2">&nbsp;</div> -->
            <div class="col-lg-12 col-xl-12">
            <div class="row rightgape">
                <div class="col-lg-12">          
                  <div class="whbox">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                        <li class="breadcrumb-item">/</li>
                        <li class="breadcrumb-item active" aria-current="page">Cancelled Room Booking</li>
                      </ol>
                    </nav>
                   
                    <div class="clearfix">&nbsp;</div>
                    
                    <div class="row">
                      <div class="col-md-6">
                        <h3> Cancelled Room Booking</h3>
                      </div>
                      <div class="col-md-6 text-right">
                       <!--  <a href="{{ url('upcoming-room-order-history') }}" class="btn btn-primary">Upcoming History</a>
                        <a href="{{ url('check-in-room-order-history') }}" class="btn btn-primary">CheckIn History</a>
                        <a href="{{ url('check-out-room-order-history') }}" class="btn btn-primary">CheckOut History</a> -->
                        <button class="btn btn-dark" onclick="window.history.back();"><i class="fa fa-arrow-left"></i> Back</button>
                      </div>
                    </div>
                      <div class="row rightgape">
                          <div class="col-lg-12">
                            <div class="table-responsive">
                            <table class="table table-striped medium-table" id="myTable">
                                <thead>
                                <tr>
                                    <th width="8%">S. No.</th>
                                    <th width="20%">User</th>
                                    <th width="25%">Room Detail</th>
                                    <th width="30%">Transactions</th>
                                    <th width="30%">Payment Status</th>
                                </tr>
                            </thead>

                            <tbody>
                              @if($c_room_orders->count() != 0)
                                @foreach($c_room_orders as $key => $d)
                                <?php 
                                 $payu_data = json_decode($d->payu_data, true);
                                 $checkoutdata = json_decode($d['checkout_form_data'],true); 

                                ?>
                                <tr>
                                        <td  style="vertical-align: top;">{{$key+1}}</td>
                                        <td style="vertical-align: top;">
                                          <b>Name : </b> {{$checkoutdata['customerName'] ?? ''}}<br>
                                          <b>Email : </b> {{$checkoutdata['customerEmail'] ?? ''}}<br>
                                          <b>Phone : </b> +91{{$checkoutdata['customerPhone'] ?? ''}}<br>
                                          <strong>Transaction ID :</strong>{{ucwords($d->txnid)}} </br>
                                          <strong>Cancellation Time :</strong>{{ date('d F, Y H:i A',strtotime($d->updated_at)) }} </br>
                                        </td>
                                         
                                        <td style="vertical-align: top;">
                                         
                                          <?php $category = ''; ?>
                                          @foreach($checkoutdata['item'] as $key => $value)
                                          
                                            @if($key == 'room_category')
                                              <?php $category = ucwords(str_replace("_"," ",$value)); ?>
                                            @endif
                                         
                                            @if($key == 'per_shift_price')
                                             <strong> <?php echo $category; ?> Room Price : </strong>&#8377;{{$value}}<br>
                                            @endif
                                            
                                            @if($key == 'room')
                                              <strong>Room : </strong>{{ucfirst($value)}}<br>
                                            @endif

                                            @if($key == 'guest')
                                              <strong>Guest : </strong>{{ucfirst($value)}}<br>
                                            @endif

 
                                          @endforeach
                                            <strong>Inperson Checkin time : </strong>{{date('d M, Y',strtotime($d->inperson_checkin_time ?? $checkoutdata['checkin']))}} 12:00 PM<br>
                                            <strong>Checkout : </strong>{{date('d M, Y',strtotime($checkoutdata['checkout'] ?? ''))}} 11:00 AM<br>
                                            <strong>Date of Booking :</strong>{{ date('d F, Y H:i A',strtotime($d->created_at)) }} </br>
                                          @if(array_key_exists('paymentMode',$payu_data))
                                            <strong>Payment Mode : </strong>{{ str_replace('_',' ',$payu_data['paymentMode']) ?? ''}} </br>
                                          @endif
                                          
                                          <strong>Reason of cancel : </strong>
                                           @if($d->reason_cancelled_room != null)
                                              {{$d->reason_cancelled_room}}
                                           @else
                                            ------
                                           @endif

                                        </td>
                                        <td style="vertical-align: top;">
                                          
                                          <strong>Room Total Price :</strong> <span style="float:right">₹{{$checkoutdata['subtotal_amt']}} </span></br>
                                          <strong>Room Tax :</strong> <span style="float:right">₹{{$checkoutdata['subtotal_taxes'] }} </span> </br>
                                          <strong>Meal Total Amount :</strong> <span style="float:right">₹{{$checkoutdata['subtotal_meal_amt']}}</span> </br>
                                          <strong>Meal Tax :</strong> <span style="float:right">₹{{$checkoutdata['subtotal_meal_tax']}}</span> </br>
                                          <hr style="margin: 5px;">
                                          <strong>Total Amount :</strong> <span style="float:right">₹{{$checkoutdata['net_total_amt']}} </span></br>
                                          <hr style="margin: 5px;">
                                          <strong>Promocode :</strong> <span style="float:right">- ₹{{$checkoutdata['promocode_deduction']}}</span> </br>
                                          <strong>Trade International Credit :</strong> <span style="float:right">- {{$checkoutdata['subtotal_tti_credit']}} P </span></br>
                                          <strong>Reward Point :</strong> <span style="float:right">- {{$checkoutdata['subtotal_tti_rewardpoint'] }} P </span></br>
                                          <hr style="margin: 5px;">
                                          <strong>Payable Amount :</strong> <span style="float:right">₹{{$checkoutdata['grand_total_amt']}} </span></br>
                                          <hr style="margin: 5px;">
                                          <strong>Final Amount : ( {{ $checkoutdata['payment_option'].'%' }})</strong><span style="float:right"> ₹{{$checkoutdata['f_total_amt']}} </span></br>
                                          
                                        </td>
                                        <td style="vertical-align: top;">
                                          <strong>Total Amount : </strong>₹{{$checkoutdata['grand_total_amt']}}</br>
                                          <strong>Refunded Amount : </strong>
                                          @if(isset($d->refunded_amount))
                                           ₹{{$d->refunded_amount}}
                                          @else
                                            -----
                                          @endif
                                        </td>
                                         
                                      </tr>
                                @endforeach
                                @else
                                  <tr>
                                    <td colspan="8"><h6 class="text-center">Order History not available.</h6></td>
                                  </tr>
                                @endif
                            </tbody>
                            </table>
                            </div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
            <!-- Client Section End -->
            </div>
         </div>
      </div>
    </div>
  </main>
</div>
<script type="text/javascript">

  $(document).ready(function(){
  var rowCount = $('#myTable tbody').find('tr').length
   if(rowCount > 1){
    $('#myTable').DataTable({
      "order": [[0, "desc" ]]
    });
  }

  $(document).click(function(e) {
   
    var index = localStorage.getItem('status_index');
    var container = $(".status_list"+index );
    if(!container.is(e.target) && container.has(e.target).length === 0){
        hideStatuses(index)
    }
 });

   
    $(document).on('click','.edit-status',function(event){
    event.stopPropagation();
    // hideStatuses($(this).data('index'))
    localStorage.setItem('status_index',$(this).data('index'));

    $('.status-change-div').hide()
    $('.edit-status').show()

    $('.finalstatus'+$(this).data('index')).toggle();
    $('.status_list'+$(this).data('index')).toggle();
    $('.status_list'+$(this).data('index')).css('display','inline-block');
    $(this).hide();
    });

    $(document).on('change','.change-status',function(){
    var index  = localStorage.setItem('status_index',$(this).data('index'));
    $('.status_list'+index).hide();
    $.ajax({
        url:"{{ url('restaurant-order-history/change-status') }}/"+$(this).parent().data('id')+'/'+$(this).val(),
        type:'get',
        success:function(response){
        location.reload();
        }
    });
    })
  });
  function hideStatuses(index){
    $('.status_list'+index).hide();
     $('.finalstatus'+index).show();
  }
</script>
@endsection
