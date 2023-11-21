@extends('layouts.dashboard-layout')
@section('content')
<style>.edit-status{cursor:pointer;}</style>
<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" href="#">
    <i class="fas fa-bars"></i>
  </a>
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
          <div class="col-lg-12 col-xl-12">
            <div class="row rightgape">
              <div class="col-lg-12">          
                <div class="whbox">
                <div class="navbar-with-export-data"> 
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                      <li class="breadcrumb-item">/</li>
                      <li class="breadcrumb-item active" aria-current="page">Restaurant Order History</li>
                    </ol>
                  </nav>

                  <div class="">
                    <div class="export-box form-inline room-filter-block">
                      <div class="field-div">
                        <input type="date" name="start_date" class="start_date"/>
                        <span class="s_err"></span>
                      </div>
                      <div class="field-div">
                        <input type="date" name="end_date" class="end_date"/>
                        <span class="e_err"></span>
                      </div>
                      <div class="field-div">
                         <select class="form-control rest_status" name="rest_status">
                            <option value="" disabled selected>choose a status</option>
                            <option value="all">All</option>
                            <option value="P">Pending</option>
                            <option value="A">Prepare</option>
                            <option value="PU">Picked Up</option>
                            <option value="D">Delivered</option>
                            <option value="C">Cancelled</option>
                         </select>
                      </div>
                      <div class="field-div">
                        <button type="button" class ="btn btn-success export-orders">Export</button>
                      </div>
                    </div>
                    <span class="s_e_s_err"></span>
                  </div>
                </div>
                
                  <div class="clearfix"><hr/></div>

                  @if ($message = Session::get('success'))
                  <div class="alert alert-success alert-dismissible fade-message">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{$message}}
                  </div>
                  @endif
                  <div class="clearfix">&nbsp;</div>

                  <div class="row pagetop-title">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7"><h3>Restaurant Order History</h3></div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 text-right">
                      <button class="btn btn-dark" onclick="window.history.back();"><i class="fa fa-arrow-left"></i>  Back</button>
                    </div>
                  </div>

                  <br>

                  <div class="row mt-3">
                    <div class="col-xl-12 col-lg-12">
                       <div class="search-filter-box">
                         <div class="form-group">
                           <label class="form-label">Search by Mode</label>
                           <select class="form-control rest_mode" name="rest_mode">
                              <option value="" disabled>choose a mode</option>
                              <option value="inhouse">In House Order</option>
                              <option value="delivery">Delivery</option>
                              <option value="takeaway">Takeaway</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label class="form-label">Start Date</label>
                            <div class="datepicher-field">
                              <input type="date" class="form-control startDate" name="startDate" id="startDate">
                              <span class="sdate"></span>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="form-label">End Date</label>
                            <div class="datepicher-field">
                              <input type="date" class="form-control endDate" id="endDate" name="endDate">
                              <span class="edate"></span>
                            </div>
                          </div>

                          <div class="form-group-btn">
                            <button type="button" class ="btn btn-primary filter-orders">Filter</button>
                            <a href="{{ url('get-ordered-item-and-cancelled-history') }}" type="button" class ="btn btn-light clear-filter">Clear</a>
                          </div>
                      </div>
                      <span class="mode_s_e_err"></span>
                    </div>
                    <!-- <div class="col-xl-6 col-lg-6"></div> -->
                  </div>

                  <div class="row mt-3">
                    <div class="col-lg-12 payments-tabs-list item-tab-list">
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending orders <small class="total_pending_data"></small></a>
                        </li>

                        <li class="nav-item">
                          <a class="nav-link" id="preparing-tab" data-toggle="tab" href="#preparing" role="tab" aria-controls="preparing" aria-selected="false">Preparing orders <small class="total_preparing_data"></small></a>
                        </li>
 
                        <li class="nav-item">
                          <a class="nav-link" id="picked-up-tab" data-toggle="tab" href="#picked-up" role="tab" aria-controls="picked-up" aria-selected="false">Picked Up orders <small class="total_pickedup_data"></small></a>
                        </li>

                        <li class="nav-item">
                          <a class="nav-link" id="Delivered-tab" data-toggle="tab" href="#Delivered" role="tab" aria-controls="Delivered" aria-selected="false">Delivered/Cancelled orders @if($total_orderd_data > 0)<small class="total_deli_data">(<span>{{$total_orderd_data}}</span>)</small>@endif </a>
                        </li>
 
                      </ul>
                      <!-- 1st payments tab start-->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                               <div class="row" id="pending-orders"></div>
                            </div>
                            <!-- 1st payments tab end-->

                            <!-- 2nd payments tab start-->
                            <div class="tab-pane fade" id="preparing" role="tabpanel" aria-labelledby="preparing-tab">
                               <div class="row" id="prepare-orders"></div>
                            </div>
                            <!-- 2st payments tab end-->
  
                            <!-- 4th payments tab start-->
                            <div class="tab-pane fade" id="picked-up" role="tabpanel" aria-labelledby="picked-up-tab">
                               <div class="row" id="picked-up-orders"></div>
                            </div>
                            <!-- 4th payments tab end-->

                            <!-- 5th payments tab start-->
                            <div class="tab-pane fade" id="Delivered" role="tabpanel" aria-labelledby="Delivered-tab">
                               <div class="search-delivered-box">
                                <div class="search-delivered">
                                  <input type="text" name="delivered_value" class="form-control" placeholder="Search By Name">
                                  <div class="search-delivered-btn">
                                    <button class="btn btn-primary delivered_search_btn">Search</button>
                                    <a class="btn btn-light delivered_clear_btn">Clear</a>
                                  </div>
                                </div>
                               </div>

                                <div class="row">
                                   <div class="col-lg-12">
                                      <!-- Reservation List Start -->
                                      <div class="table-responsive">
                                        <table class="table table-striped medium-table" id="del_cancel_order_history">
                                          <thead>
                                            <tr> 
                                              <th class="d-none"></th>
                                              <th width="3%">ID</th>
                                              <th width="18%">Name</th>
                                              <th width="10%">Date</th>
                                              <th width="20%">Order Items</th> 
                                              <th width="10%">Bill Amount</th>
                                              <th width="15%">Delivery Mode</th>
                                              <th width="30%">Actions</th>
                                            </tr>
                                          </thead>
                                          <tbody></tbody>
                                        </table>
                                      </div>
                                      <!-- Reservation List End -->
                                  </div>
                                  </div>
                                  
                                  <nav class="pagination-nav">
                                    <ul class="pagination item_pagination">
                                   <?php if($total_orderd_data > 10) { 
                                    $is_zero = 0; 
                                    $total_number_of_pages = ceil($total_orderd_data / 10);
                                    for($i=1;$i<=$total_number_of_pages;$i++){ ?>
                                        <li class="page-item order-already-active" data-index="{{$i}}">
                                          <a class="page-link item_per_data_count" data-pagenum="<?php echo $i; ?>" data-offset="<?php if($i==1){ echo 0;}else{ echo ($i.$is_zero - 10); } ?>" href="#Delivered">{{$i}}</a>
                                        </li>
                                   <?php } }?>
                                  </ul>
                                </nav>

                            </div>
                            <!-- 5th payments tab end--> 
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <!-- Client Section End -->

              <!--OTP Success Modal -->
              <div class="modal fade normal-popup TakeawayVerify" id="TakeawayVerify" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="TakeawayVerifyLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-body">
                      <h4>Enter OTP</h4>
                      <div class="row">
                        <div class="col-sm-8 col-xs-7 otp-input">
                          <div class="passcode-wrapper">
                            <input id="codeBox1" type="text" maxlength="1" onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)" maxlength="1">
                            <input id="codeBox2" type="text" maxlength="1" onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)" maxlength="1">
                            <input id="codeBox3" type="text" maxlength="1" onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)" maxlength="1">
                            <input id="codeBox4" type="text" maxlength="1" onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)" maxlength="1">
                          </div>
                          <span class="invalid_otp"></span>
                        </div>
                        <div class="col-sm-4 col-xs-5 second-verify-btn otp-input"><button type="button" class="btn btn-info verify-btn" style="height:40px;" ><span class="spinner-border spinner-border-sm" id="otp-verify-btn" style="display:none;"></span>Verify</button></div>
                        <div class="resend-otp"><a class="resend-otp-btn">Resend OTP</a></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--OTP Success Modal -->

            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
  <!-- page-content" -->
  <style type="text/css">.swal2-title{font-size: 25px;font-weight: 500;}#del_cancel_order_history_paginate, #del_cancel_order_history_info{display: none}</style>
  <script type="text/javascript">

  var start_date = 0;
  var end_date = 0;
  var mode = 'no';
  var is_clicked_popup = false;
  var current_page = 1;
  var limit = 10;
  var records_per_page = 10;
  var offset = 0;
  var is_load_ajax = false;
  var search_text = '';

     //otp input box script
   function getCodeBoxElement(index) {
     return document.getElementById('codeBox' + index);
   }
   function onKeyUpEvent(index, event) {
     const eventCode = event.which || event.keyCode;
     if (getCodeBoxElement(index).value.length === 1) {
      if (index !== 4) {
       getCodeBoxElement(index+ 1).focus();
      } else {
       getCodeBoxElement(index).blur();
       // Submit code
       console.log('submit code ');
      }
     }
     if (eventCode === 8 && index !== 1) {
      getCodeBoxElement(index - 1).focus();
     }
   }
   
   function onFocusEvent(index) {
     for (item = 1; item < index; item++) {
      const currentElement = getCodeBoxElement(item);
      if (!currentElement.value) {
         currentElement.focus();
         break;
      }
     }
   }

  function pickeduptodeliverd(id,mode,el){
    localStorage.setItem('takeaway_id',id);
    if(mode.trim() == "Takeaway"){
      $("#TakeawayVerify").modal("show")
    }else{
      changeStatusRestaurnat(id,'D',el)
    }
  }

function changeStatusRestaurnat(id,status,el){
  $.ajax({
    url:"{{ url('restaurant-order-history/change-status')}}/"+id+'/'+status,
    type:"get",
    success:function(response){
      $(el).closest('.order-list').css('background','tomato');
      $(el).closest('.order-list').fadeOut(1000,function(){
        $(this).remove();
      });
    }
  })
}

function getPendingOrders(start_date,end_date,mode){
  console.log(start_date,end_date,mode)
  $.ajax({
    url:"{{ url('get-pending-orders') }}"+'/'+start_date+'/'+end_date+'/'+mode,
    type:"get",
    success:function(response){
      $('#pending-orders').html(response)
      setTimeout(function(){
        $('.total_pending_data').text($('.total_pending_order').text())
      },400)     
    }
  })
}

function getPreparingOrders(start_date,end_date,mode){
  $.ajax({
    url:"{{ url('get-preparing-orders') }}"+'/'+start_date+'/'+end_date+'/'+mode,
    type:"get",
    success:function(response){
      $('#prepare-orders').html(response)
      setTimeout(function(){
        $('.total_preparing_data').text($('.total_preparing_order').text())
      },400) 
    }
  })
}

function getPickedUpOrders(start_date,end_date,mode){
  $.ajax({
    url:"{{ url('get-picked-up-orders') }}"+'/'+start_date+'/'+end_date+'/'+mode,
    type:"get",
    success:function(response){
      $('#picked-up-orders').html(response)      
      setTimeout(function(){
        $('.total_pickedup_data').text($('.total_picked_up_order').text())
      },400)      
    }
  })
}

function getDeliveredOrders(start_date,end_date,mode,current_page,records_per_page,offset,search_text){
  console.log(search_text)
  $.ajax({
    url:"{{ url('get-delivered-and-cancelled-orders') }}"+'/'+start_date+'/'+end_date+'/'+mode+'/'+current_page+'/'+records_per_page+'/'+offset+'/'+search_text,
    type:"get",
    success:function(response){
      $('#del_cancel_order_history tbody').html(response) 
      $(".total_deli_data span").html($('.deliver_cacnel_history').data("totalorderdata"))
      //if(start_date != "" && end_date != ""){
            // $(".total_deli_data").text("")
            //   setTimeout(function(){
            //     $(".total_deli_data").text($('.mdc-total-count').data("totalOrderData"))
            // },1000)

     // console.log("total count : ",$(".total_deli_data span").text())

            if($(".total_deli_data span").text() > 10)
            {
                var is_zero = 0; 
                var total_number_of_pages = Math.ceil($(".total_deli_data span").text() / 10);
                var i;
                var pag_append = ''
                for(i=1;i<=total_number_of_pages;i++){
                  if(i==1)
                    var i_off = 0;
                  else
                    var i_off = i+''+0 - 10

                  pag_append =  pag_append + '<li class="page-item order-already-active"><a class="page-link item_per_data_count" data-pagenum="'+i+'" data-offset="'+i_off+'" href="#Delivered">'+i+'</a></li>';
                }

              
                if(mode == 0 || (start_date != 0 || end_date != 0)){
                  $('.item_pagination').show()
                }

                $('.item_pagination').html(pag_append)
            }
             else{
              $('.item_pagination').hide()
            }

            var minus_page_value = current_page - 1;
            $(".item_pagination li:eq("+minus_page_value+")").addClass("active");
          }
       
  })
}



 function getAllOrdersData(start_date,end_date,mode,current_page,records_per_page,offset,search_text) {
    getPendingOrders(start_date,end_date,mode);
    getPreparingOrders(start_date,end_date,mode);
    getPickedUpOrders(start_date,end_date,mode);

    if(is_load_ajax == false)
      getDeliveredOrders(start_date,end_date,mode,current_page,records_per_page,offset,search_text);
 }

  setInterval(function(){ 
    if(is_clicked_popup == false){
      getAllOrdersData(start_date,end_date,mode,current_page,records_per_page,offset,search_text);
    }
  },4000);

  getAllOrdersData(start_date,end_date,mode,current_page,records_per_page,offset,search_text);
  

  //default add active class
  $('.item_pagination .page-item').each(function(key,value){
    
    if($(value).data("index") == 1){
      setTimeout(function(){
        $(value).addClass("active");
      },500)
    }
  })
  

  //pagination start
 $(document).on("click",".item_per_data_count",function(){
  $("#Delivered").trigger("click")
   offset = $(this).data('offset');
   current_page = $(this).data("pagenum");
    
   $('.order-already-active').removeClass('active');
  
   setTimeout(function(){
    var minus_page_value = current_page - 1;
    $(".item_pagination li:eq("+minus_page_value+")").addClass("active");
   },900)
 
   getAllOrdersData(start_date,end_date,mode,current_page,records_per_page,offset,search_text);
 })

  
 $(document).on("click",".delivered_search_btn",function(){
  $('.item_pagination').hide()
  is_ajax_load = true;
  search_text = $('input[name="delivered_value"]').val()
    console.log($('input[name="delivered_value"]').val())
   getAllOrdersData(start_date,end_date,mode,current_page,records_per_page,offset,$('input[name="delivered_value"]').val());
 })
 
 $(document).on("click",".delivered_clear_btn",function(){
    search_text = '';
    current_page = 1;
    limit = 10;
    records_per_page = 10;
    offset = 0;
    is_ajax_load = false;
    $('.item_pagination').show()
    $('input[name="delivered_value"]').val("")
   getAllOrdersData(start_date,end_date,mode,current_page,records_per_page,offset,search_text);
 })
//paginate end


//pagination end


  //determine which tab is active
   $(document).on("click",".payments-tabs-list ul li a",function(){
     
    $(".active").not(this).removeClass("active");
    $($(this).attr("href")).not(this).removeClass("active show");
    $(this).addClass("active");
    $($(this).attr("href")).addClass("active show");
    
    localStorage.setItem("current_active_tab",$(this).attr("href"));
   })

   current_active_tab = localStorage.getItem('current_active_tab');

   if(current_active_tab){
    $('.payments-tabs-list ul li a').each(function(key,value){
        if ($(value).attr("href") == current_active_tab) {
          //remove previous active class
          $(".active").not(value).removeClass("active");
          $($(value).attr("href")).not(value).removeClass("active show");

          //add currency active class
          $(this).addClass('active');
          $($(value).attr("href")).addClass("active show");
        }
    })
   }

  //determine which tab is active
  var isVerify = false;

  $(document).on('click', '.resend-otp-btn', function(){
      $.ajax({
          url:"{{ url('send-otp') }}/"+$('#Phone').text(),
          type:"get",
          success:function(response){

          }
      })
  });

  $('.second-verify-btn .verify-btn').click(function(){
    var el = this
   $('.spinner-border').show();
   setTimeout(() => {
    var otp = $('#codeBox1').val()+$('#codeBox2').val()+$('#codeBox3').val()+$('#codeBox4').val() 
    if(otp.length == 4){
      $.ajax({
        url:'{{url("verify-otp")}}/'+$('#Phone').text()+'/'+otp,
        type:'get',
        success:function(response){
        if(response.is_verify == 1){
          $('.otp-input').hide()
          $('.second-verify-btn').hide()
          $('#TakeawayVerify').modal("hide");
          
          isVerify = true;
          changeStatusRestaurnat(localStorage.getItem('takeaway_id'),'D',el)
        }else{
          isVerify = false;
          $('.invalid_otp').text("Invalid OTP.").css({'display':'block','font-size': '13px','color': 'red'}).delay(3000).fadeOut();
        }
        }
      });
    }else{
      isVerify = false;
      $('.invalid_otp').text("Invalid OTP.").css({'display':'block','font-size': '13px','color': 'red'}).delay(2000).fadeOut();
    }
    $('.spinner-border').hide();
   }, 2000);
   })
   

   $(document).on('click load','.clear-filter',function(){
      localStorage.removeItem("current_mode");
      localStorage.removeItem("rest_start_date");
      localStorage.removeItem("rest_end_date");
    });

  $(document).ready(function(){

    // setTimeout(function(){
    //   var rowCount = $('#del_cancel_order_history >tbody >tr').length;
    //   if(rowCount > 1){
    //     $('#del_cancel_order_history').DataTable({
    //        "paging":   false,
    //        "ordering": false,
    //        "info":     false
    //     });
    //   }
    // },1000);

    // $(document).on("#del_cancel_order_history_filter input","input keypress",function(){
    //   is_load_ajax = true;
    //    getDeliveredOrders(start_date,end_date,mode,current_page,records_per_page,offset,search_text);
    //  });

    // $(window).on("mouseout blur",function(){
    //   is_load_ajax = false
    //    getDeliveredOrders(start_date,end_date,mode,current_page,records_per_page,offset,search_text);
    //  });

    

    $(document).on("click",'.export-orders',function(){
      if($('.start_date').val() == "" && $('.end_date').val() != ""){
        $(".s_err").text("Please select start date").css({'display':'block','color':'red','font-size':'13px;'});
      }else if($('.start_date').val() != "" && $('.end_date').val() == ""){
        $(".e_err").text("Please select end date").css({'display':'block','color':'red','font-size':'13px;'});
      }else if($('.start_date').val() != "" && $('.end_date').val() != "" && $('.rest_status :selected').val() == ""){
        window.location.href="{{ url('export-csv-ordered-items') }}/"+$('.start_date').val()+'/'+$('.end_date').val()+'/no';
      }else if(($('.start_date').val() != "" && $('.end_date').val() != "") && $('.rest_status :selected').val() != ""){
        window.location.href="{{ url('export-csv-ordered-items') }}/"+$('.start_date').val()+'/'+$('.end_date').val()+'/'+$('.rest_status :selected').val();
      }else if($('.rest_status :selected').val() != ""){
        window.location.href="{{ url('export-csv-ordered-items') }}/0/0"+'/'+$('.rest_status :selected').val();
      }else{
        $(".s_e_s_err").text("Please select atlease one date or status.").css({'display':'block','color':'red','font-size':'13px;'});
      }

    })

    if(localStorage.getItem("current_mode") != null || localStorage.getItem("rest_start_date") != null || localStorage.getItem("rest_end_date") != null){
      (localStorage.getItem("current_mode") != null) ? $('.rest_mode option[value="'+localStorage.getItem("current_mode")+'"]').prop("selected",true) : $('.rest_mode option[value=""]').prop("selected",true);
      $('#startDate').val(localStorage.getItem("rest_start_date"))
      $('#endDate').val(localStorage.getItem("rest_end_date"))
    }else{
      $('.rest_mode option[value=""]').prop("selected",true)
    }
  
  $(document).on("click",".filter-orders",function(){
  
    if($('#startDate').val() == "" && $('#endDate').val() != ""){
      $(".sdate").text("Please select start date").css({'display':'block','color':'red','font-size':'13px;'});
    }else if($('#startDate').val() != "" && $('#endDate').val() == ""){
      $(".edate").text("Please select end date").css({'display':'block','color':'red','font-size':'13px;'});
    }else if($('#startDate').val() != "" && $('#endDate').val() != "" && $('.rest_mode :selected').val() == ""){
      localStorage.setItem("rest_start_date",$('#startDate').val());
      localStorage.setItem("rest_end_date",$('#endDate').val());

      start_date = $('#startDate').val();
      end_date = $('#endDate').val();
      mode = 'no';
      getAllOrdersData($('#startDate').val(),$('#endDate').val(),'no',current_page,records_per_page,offset,search_text);
    }else if(($('#startDate').val() != "" && $('#endDate').val() != "") && $('.rest_mode :selected').val() != ""){
      localStorage.setItem("current_mode",$('.rest_mode').val());
      localStorage.setItem("rest_start_date",$('#startDate').val());
      localStorage.setItem("rest_end_date",$('#endDate').val());
       
      start_date = $('#startDate').val();
      end_date = $('#endDate').val();
      mode = $('.rest_mode :selected').val();

      getAllOrdersData($('#startDate').val(),$('#endDate').val(),$('.rest_mode :selected').val(),current_page,records_per_page,offset,search_text);
    }else if($('.rest_mode :selected').val() != ""){
      localStorage.setItem("current_mode",$('.rest_mode').val());
      
      start_date = 0;
      end_date = 0;
      mode = $('.rest_mode :selected').val();
      getAllOrdersData(0,0,$('.rest_mode :selected').val(),current_page,records_per_page,offset,search_text);
    }else{
      $(".mode_s_e_err").text("Please select atlease one date or status.").css({'display':'block','color':'red','font-size':'13px;'});
    }

     $('.item_pagination').hide()

  });

  $(document).on("change","input[type='date']",function(){
    if($(this).attr("name") == "start_date"){ 
      if($('.end_date').val() == ""){  $('.end_date').val(moment($('.start_date').val()).add(1, 'days').format('YYYY-MM-DD')); }
      $(".s_e_s_err").hide(); $('.s_err').hide()
    }
    if($(this).attr("name") == "end_date"){ 
      if($('.start_date').val() == ""){  $('.start_date').val(moment($('.end_date').val()).subtract(1, 'days').format('YYYY-MM-DD')); }
      $('.e_err').hide(); $(".s_e_s_err").hide();
    }

     if($(this).attr("name") == "startDate"){ 
      if($('#endtDate').val() == ""){  $('#endtDate').val(moment($('#startDate').val()).add(1, 'days').format('YYYY-MM-DD')); }
      $(".mode_s_e_err").hide(); $('.sdate').hide()
    }
    if($(this).attr("name") == "endtDate"){ 
      if($('#startDate').val() == ""){  $('#startDate').val(moment($('#endtDate').val()).subtract(1, 'days').format('YYYY-MM-DD')); }
      $('.edate').hide(); $(".mode_s_e_err").hide();
    }

  });
  $(document).on('click','.print-invoice',function(){
    $.ajax({
      url:"{{ url('printrestaurantBill') }}/"+$(this).data("txnid"),
      type:"get",
      success:function(response){
        var a = window.open('', '', 'height=500, width=500');
        a.document.write(response.html);
        a.document.close();
        a.print();

      }
    })
  }); 

   $(document).on("click",".refund-mount",function(){
    Swal.fire({
      title: 'Are you sure?',
      text: "You want to receive payment!",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Refund it!'
    }).then((result) => {
      if (result.isConfirmed) {
          $.ajax({
            url:"{{ url('refund-data') }}/"+$(this).data("id")+'/item',
            type:"get",
            success:function(response){
              if(response.status == 200){
               location.reload();
              }
            }
          })
      }
    })
  })
});
</script>
@endsection
