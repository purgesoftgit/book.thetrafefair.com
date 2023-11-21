@extends('layouts.dashboard-layout')
@section('content')

<style>
  .edit-status {
    cursor: pointer;
  }

  .ready {
    background: #3a341f;
    font-weight: 600;
    padding: 5px;
    font-size: 13px;
    color: #fff;
    border-radius: 4px;
  }
</style>
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
                      <li class="breadcrumb-item active" aria-current="page">@if(isset($rastro_order_history)) Restaurant @else Delivered/Cancelled @endif Order History</li>
                    </ol>
                  </nav>
                  <div class="clearfix">
                    <hr />
                  </div>
                  @if($message = Session::get('success'))
                  <div class="alert alert-success alert-dismissible fade-message">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{$message}}
                  </div>
                  @endif
                  <div class="clearfix">&nbsp;</div>

                  <div class="row pagetop-title">
                    <div class="col-lg-6 col-md-7 col-sm-7 col-xs-7">
                      <h3>@if(isset($rastro_order_history)) Restaurant @else Delivered/Cancelled @endif Order History</h3>
                    </div>
                    <div class="col-lg-6 col-md-5 col-sm-5 col-xs-5 add-blogpost-right"><button class="btn btn-dark" onclick="window.history.back();"><i class="fa fa-arrow-left"></i> Back</button></div>
                  </div>

                  <div class="row rightgape">
                    <div class="col-lg-12">
                      <div class="table-responsive">
                        <table class="table table-striped big-table" id="myTable">
                          <thead>
                            <tr>
                              <th width="3%" class="sortedcolumn">S. No.</th>
                              <th width="15%">User</th>
                              <th width="10%">Delivery Mode</th>
                              <th width="5%">Transaction ID</th>
                              <th width="20%">Total Amount</th>
                              <th width="10%">Status</th>
                              <th width="10%">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if(isset($deli_cancel_txn ))
                            @if(count($deli_cancel_txn) > 0)
                            @foreach($deli_cancel_txn as $del_key => $del_value)
                            <?php
                            $checkoutdata = json_decode($del_value['checkout_form_data'], true);
                            $payudata = json_decode($del_value['payu_data'], true);
                            ?>
                            <tr>
                              <td class="sortedcolumn">{{$del_key + 1}}</td>
                              <td>@if($del_value->user)
                                <strong>Name : </strong> {{$del_value->user->first_name}} {{$del_value->user->last_name}} </br>
                                <strong>Email : </strong>{{$del_value->user->email}} </br>
                                <strong>Phone Number : </strong>{{$del_value->user->phone_number}}

                                @else ---- @endif
                              </td>
                              <td>@if(array_key_exists('delivery_mode',$checkoutdata)) {{$checkoutdata['delivery_mode']}} @else ---- @endif</td>
                              <td>{{$del_value->txnid}}</td>
                              <td>
                                <strong>Total : </strong>&#8377;<?php echo number_format((float)($checkoutdata['net_total_amt'] + $checkoutdata['subtotal_rider']), 2, '.', ''); ?></br>
                                <strong>Trade International Credit : </strong>- <?php echo number_format((float)$checkoutdata['subtotal_tti_credit'], 2, '.', ''); ?> P</br>
                                <strong>Reward Points : </strong>- <?php echo number_format((float)$checkoutdata['subtotal_tti_rewardpoint'], 2, '.', ''); ?> P</br>
                                <strong>Promocode : </strong>-&#8377;<?php echo number_format((float)$checkoutdata['promocode_deduction'], 2, '.', ''); ?></br>
                                <strong>Payable Amount : </strong> &#8377;<?php echo number_format((float)$del_value['amount'], 2, '.', ''); ?></br>
                              </td>
                              <td>
                                <span class="finalstatus">@if($del_value->status == 'R') <span class="ready">Ready</span> @elseif($del_value->status == 'A') <span class="incomplete">Approved</span> @elseif($del_value->status == 'P') <span class="incomplete">Pending</span> @elseif($del_value->status == 'D') <span class="delivered">Delivered</span> @else <span class="reject">Cancelled</span> @endif</span>
                              </td>
                              <td>
                                <a href="{{url('order-history',$del_value->id)}}" class="edit-icon" style="margin: 10px;"><i class="far fa-eye"></i> </a>
                                @if($del_value->status != 'C')
                                <a href="{{url('downloadReceipt',$del_value->txnid)}}"><i class="fas fa-download" style="color: #166416;"></i> </a>
                                <a href="javascript:void(0)" style="margin: 8px;"><i class="fas fa-print" data-txnid="{{$del_value->txnid}}"></i> </a>
                                @endif
                              </td>
                            </tr>

                            @endforeach
                            @endif
                            @if(count($deli_cancel_txn) == 0)
                            <tr>
                              <td colspan="8">
                                <h6 class="text-center">Order History not available.</h6>
                              </td>
                            </tr>
                            @endif

                            @endif

                            @if(isset($rastro_order_history))
                            @if(count($rastro_order_history) > 0)
                            @foreach($rastro_order_history as $key => $d)
                            <?php
                            $checkoutdata = json_decode($d['checkout_form_data'], true);
                            $payudata = json_decode($d['payu_data'], true);
                            ?>
                            <tr>
                              <td class="sortedcolumn">{{$key + 1}}</td>
                              <td>@if($d->user)
                                <strong>Name : </strong> {{$d->user->first_name}} {{$d->user->last_name}} </br>
                                <strong>Email : </strong>{{$d->user->email}} </br>
                                <strong>Phone Number : </strong>{{$d->user->phone_number}}

                                @else ---- @endif
                              </td>
                              <td>
                                @if(array_key_exists('delivery_mode',$checkoutdata)) {{$checkoutdata['delivery_mode']}} @else ---- @endif
                              </td>
                              <td>{{$d->txnid}}</td>

                              <td>
                                <strong>Total : </strong>&#8377;<?php echo number_format((float)($checkoutdata['net_total_amt'] + $checkoutdata['subtotal_rider']), 2, '.', ''); ?></br>
                                <strong>Trade International Credit : </strong>- <?php echo number_format((float)$checkoutdata['subtotal_tti_credit'], 2, '.', ''); ?> P</br>
                                <strong>Reward Points : </strong>- <?php echo number_format((float)$checkoutdata['subtotal_tti_rewardpoint'], 2, '.', ''); ?> P</br>
                                <strong>Promocode : </strong>-&#8377;<?php echo number_format((float)$checkoutdata['promocode_deduction'], 2, '.', ''); ?></br>
                                <strong>Payable Amount : </strong> &#8377;<?php echo number_format((float)$d['amount'], 2, '.', ''); ?></br>
                              </td>
                              <td>
                                <span class="finalstatus{{$key}} edit-status" data-index="{{$key}}">@if($d->status == 'R') <span class="ready">Ready</span> @elseif($d->status == 'A') <span class="delivered">Approved</span> @elseif($d->status == 'P') <span class="incomplete">Pending</span> @elseif($d->status == 'D') <span class="delivered">Delivered</span> @else <span class="reject">Cancelled</span> @endif</span>
                                @if($d->status != 'D')
                                <!-- <i class="fas fa-pencil-alt edit-status" style="margin: 0 0 0 5px;color: #e4a927;cursor: pointer;" data-index="{{$key}}"></i> -->
                                <div class="status_list{{$key}} status-change-div" data-id="{{$d->id}}" style="display: none;">
                                  <select class="form-control change-status" data-index="{{$key}}" name="status">
                                    <option value="0" selected disabled>Select Status</option>
                                    <!-- <option value="P">Pending</option> -->
                                    <option value="A">Approved</option>
                                    <option value="R">Ready</option>
                                    <option value="D">Delivered</option>
                                    <option value="C">Cancelled</option>
                                  </select>
                                </div>
                                @endif
                              </td>

                              <td>
                                <a href="{{url('order-history',$d->id)}}" class="edit-icon" style="margin: 10px;"><i class="far fa-eye"></i> </a>
                              </td>
                            </tr>
                            @endforeach
                            @endif

                            @if(count($rastro_order_history) == 0)
                            <tr>
                              <td colspan="8">
                                <h6 class="text-center">Order History not available.</h6>
                              </td>
                            </tr>
                            @endif

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
  $(document).ready(function() {
    var rowCount = $('#myTable tbody').find('tr').length
    if (rowCount > 1) {
      $('#myTable').DataTable({
        "order": [
          [0, "desc"]
        ]
      });
    }
 
    $(document).click(function(e) {

      var index = localStorage.getItem('status_index');
      var container = $(".status_list" + index);
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        hideStatuses(index)
      }
    });


    $(document).on('click', '.edit-status', function(event) {
      event.stopPropagation();
      // hideStatuses($(this).data('index'))
      localStorage.setItem('status_index', $(this).data('index'));

      $('.status-change-div').hide()
      $('.edit-status').show()

      $('.finalstatus' + $(this).data('index')).toggle();
      $('.status_list' + $(this).data('index')).toggle();
      $('.status_list' + $(this).data('index')).css('display', 'inline-block');
      $(this).hide();
    });

    $(document).on('change', '.change-status', function() {
      var index = localStorage.setItem('status_index', $(this).data('index'));
      $('.status_list' + index).hide();
      $.ajax({
        url: "{{ url('restaurant-order-history/change-status') }}/" + $(this).parent().data('id') + '/' + $(this).val(),
        type: 'get',
        success: function(response) {
          location.reload();
        }
      });
    });

    $(document).on('click', '.fa-print', function() {
      $.ajax({
        url: "{{ url('printrestaurantBill') }}/" + $(this).data("txnid"),
        type: "get",
        success: function(response) {
          var a = window.open('', '', 'height=500, width=500');
          a.document.write(response.html);
          a.document.close();
          a.print();

        }
      })
    })
  });

  function hideStatuses(index) {
    $('.status_list' + index).hide();
    $('.finalstatus' + index).show();
  }
</script>
@endsection