@extends('layouts.dashboard-layout')
@section('content')
<style>.debit-point{color:red;}.credit-point{color:green;}.amount_error{font-size: 13px;}</style>
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
                          <option value="" selected disabled>select a status</option>
                          <option value="all">All</option>
                          <option value="IH">Check In</option>
                          <option value="M">Mark as No Show</option>
                          <option value="ROOM_CANCELLED">Cancelled</option>
                          <option value="C">Checkout</option>
                        </select>
                       </div>
                        <div class="field-div">
                          <button type="button" class ="btn btn-success export-bookings">Export</button>
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
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7"><h3>Room Booking History</h3></div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 text-right"><button class="btn btn-dark" onclick="window.history.back();"><i class="fa fa-arrow-left"></i>  Back</button></div>
                  </div>
                  <br>
                      <div class="row">
                        <div class="col-lg-12 payments-tabs-list"> 
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="upcoming-tab" data-toggle="tab" href="#upcoming" role="tab" aria-controls="upcoming" aria-selected="true">Upcoming  <small class="upcoming_data"></small></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="in-house-tab" data-toggle="tab" href="#in-house" role="tab" aria-controls="in-house" aria-selected="true">Check In  <small class="in_house_data"></small></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="bokking-completed-tab" data-toggle="tab" href="#bokking-completed" role="tab" aria-controls="bokking-completed" aria-selected="false">Checkout/Mark as No Show/Cancel  @if($total_cmc_data > 0)<small class="mark_complete_cancel_data">(<span>{{$total_cmc_data}}</span>)</small>@endif </a>
                          </li>
                        </ul>

                        <!-- Time Filter Start -->
                        <div class="row">
                          <div class="col-xxl-8 col-xl-8 col-lg-12">
                            <div class="row" style="margin-bottom:10px;">
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 mobiledevice">
                                  <label class="form-label">Start Date</label>
                                  <div class="datepicher-field">
                                    <input type="date" class="form-control startDate" name="startDate" id="startDate">
                                    <span class="sdate"></span>
                                  </div>
                                </div>

                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 mobiledevice">
                                  <label class="form-label">End Date</label>
                                  <div class="datepicher-field">
                                    <input type="date" class="form-control endDate" id="endDate" name="endDate">
                                    <span class="edate"></span>
                                  </div>
                                </div>

                               <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 mobiledevice">
                                   <label class="form-label search-label" style="display: block;">&nbsp;</label>
                                   <button type="button" class="btn btn-primary search-bookings">Search</button>
                                   <a href="{{ url('get-upcoming-checkin-checkout')}}" class="btn btn-light clear-filter">Clear</a>
                                </div>
                               
                              </div>
                          </div>
                        </div>
                        <!-- Time Filter End -->

                        <div class="tab-content" id="myTabContent">

                          <!-- 1st payments tab start-->
                          <div class="tab-pane fade show active" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
                            <!-- Today Later  Bookings Start End -->
                            <div id="today-booking"></div>
                            <!-- Today  Later Bookings Start End -->
                          </div>
                          <!-- 1st payments tab end-->

                          <div class="tab-pane fade" id="in-house" role="tabpanel" aria-labelledby="in-house-tab">
                            <div class="row" id="inhouse-booking"></div>
                          </div>
                          <!-- 1st payments tab end-->

                          <!-- 2nd payments tab start-->
                          <div class="tab-pane fade" id="bokking-completed" role="tabpanel" aria-labelledby="bokking-completed-tab">
                                
                                <div class="mark_complete_cancel-mdc-box">
                                  <div class="mark_complete_cancel-mdc text-right">
                                    <input type="text" name="mark_complete_cancel_value" class="form-control" placeholder="Search...">
                                    <div class="mark_complete_cancel_btn">
                                      <button class="btn btn-primary mark_complete_cancel_search_btn">Search</button>
                                      <a class="btn btn-light mark_complete_cancel_value_clear_btn">Clear</a>
                                    </div>
                                  </div>
                                </div>

                              <div class="row">
                                 <div class="col-lg-12">
                                  <!-- Reservation List Start -->
                                  <div class="table-responsive">
                                    <table class="table table-striped medium-table" id="mark_complete_cancel">
                                      <thead>
                                        <tr> 
                                          <th width="3%">ID</th>
                                          <th width="15%">Name</th>
                                          <th width="18%">Checkin</th>
                                          <th width="18%">Checkout</th>
                                          <th width="10%">Room Type</th> 
                                          <th width="10%">Bill Amount</th>
                                          <th width="10%">Status</th>
                                          <th width="15%">Actions</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                    </table>
                                  </div>

                              </div>
                          </div>
                          
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
<!-- page-content" -->

<!-- Modal Start -->
<div class="modal fade" id="order-view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-medium" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Room Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="roomdetails"></div>
      </div>
    </div>
  </div>
</div>
<!-- Modal End -->
<script type="text/javascript">

  var start_date = '';
  var end_date = '';
  var is_clicked_popup = false
  var search_text = '';
  var current_page = 1;
  var limit = 10;
  var records_per_page = 10;
  var offset = 0;

  function seeAllRoomDetails(value,type){
    
    $.ajax({
      url:"{{ url('see-all-upcoming-checkin-checkout') }}/"+value+'/'+type,
      type:"get",
      success:function(response){
        
        $('.roomdetails').html(response)
        $('#order-view-modal').modal("show")
      }
    })
  }
 

  function getUpcomingData(start_date,end_date){
    if(start_date != "" && end_date != "")
      var url = "{{ url('get-upcoming-history') }}"+'/'+start_date+'/'+end_date
    else
      var url = "{{ url('get-upcoming-history') }}"

    $.ajax({
      url:url,
      type:"get",
      success:function(response){
        $("#today-booking").html(response)
        $('.upcoming_data').text($('.total_today_later').text());
      }
    })

  }

  function getCheckinData(start_date,end_date){
    if(start_date != "" && end_date != "")
      var url = "{{ url('get-checkin-history') }}"+'/'+start_date+'/'+end_date
    else
      var url = "{{ url('get-checkin-history') }}"

    $.ajax({
      url:url,
      type:"get",
      success:function(response){
        $("#inhouse-booking").html(response)
        $('.in_house_data').text($('.total_in_house_booking').text());
      }
    })
  }

  //function getMarkCancelCompleteData(start_date,end_date){
  function getMarkCancelCompleteData(start_date,end_date,current_page,records_per_page,offset,search_text){
    

    if((start_date == '' && end_date == '') && (start_date == 0 && end_date == 0) && search_text == 0){
      start_date = end_date = 0
      search_text = 0;
    }
    var url = "{{ url('get-upcoming-cancel-history') }}"+'/'+start_date+'/'+end_date+'/'+current_page+'/'+records_per_page+'/'+offset+'/'+search_text
 
    $.ajax({
      url:url,
      type:"get",
      success:function(response){
         $("#mark_complete_cancel tbody").html(response)
         $(".mark_complete_cancel_data span").text($('.total_mcc_booking').data("totalmdcount"))
   
          // if($(".mark_complete_cancel_data span").text() > 10)
          // {
          //     var is_zero = 0; 
          //     var total_number_of_pages = Math.ceil($(".mark_complete_cancel_data span").text() / 10);
          //     var i;
          //     var pag_append = ''
          //     for(i=1;i<=total_number_of_pages;i++){
          //       if(i==1)
          //         var i_off = 0;
          //       else
          //         var i_off = i+''+0 - 10
          //       pag_append = pag_append +  '<li class="page-item booking_already_active"><a class="page-link booking_per_data_count" data-pagenum="'+i+'" data-offset="'+i_off+'" href="javascript:void(0)">'+i+'</a></li>';
          //     }

          //     if(start_date != 0 || end_date != 0){
          //       $('.booking_pagination').show()
          //     }
          //   $('.booking_pagination').html(pag_append)
          // }
          // else{
          //   $('.booking_pagination').hide()
          // }
         
        var minus_page_value = current_page - 1;
        $(".booking_pagination li:eq("+minus_page_value+")").addClass("active");
          
      }
    })
  }



  //default add active class
  $('.booking_pagination .page-item').each(function(key,value){
    if($(value).data("index") == 1){
      $(value).addClass("active")
    }
  })

 
 //search script
 $(document).on("click",".mark_complete_cancel_search_btn",function(){
  $('.booking_pagination').hide()
   is_clicked_popup = true;
   start_date = ( start_date != 0 &&   start_date != '') ? start_date : 0;
   end_date = ( end_date != 0 &&   end_date != '') ? end_date : 0;
   search_text = $("input[name='mark_complete_cancel_value']").val();

   getMarkCancelCompleteData(start_date,end_date,current_page,records_per_page,offset,search_text)
 });

 $(document).on("click",".mark_complete_cancel_value_clear_btn",function(){
    search_text = 0;
    current_page = 1;
    limit = 10;
    records_per_page = 10;
    offset = 0;
    is_clicked_popup = false;
    $('.booking_pagination').show();
    $("input[name='mark_complete_cancel_value']").val('')
    getMarkCancelCompleteData(start_date,end_date,current_page,records_per_page,offset,search_text)
 })
 //search script


   //default add active class
  $('.booking_pagination .page-item').each(function(key,value){
    if($(value).data("index") == 1){
      $(value).addClass("active")
    }
  })
 

  //export by status
  
   $(document).on('click','.export-bookings', function(){
      if($('.start_date').val() == "" && $('.end_date').val() != ""){
        $(".s_err").text("Please select start date").css({'display':'block','color':'red','font-size':'13px;'});
      }else if($('.start_date').val() != "" && $('.end_date').val() == ""){
        $(".e_err").text("Please select end date").css({'display':'block','color':'red','font-size':'13px;'});
      }else if($('.start_date').val() != "" && $('.end_date').val() != "" && $('.rest_status :selected').val() == ""){
        window.location.href="{{ url('export-csv-of-all-bookings') }}/"+$('.start_date').val()+'/'+$('.end_date').val()+'/no';
      }else if(($('.start_date').val() != "" && $('.end_date').val() != "") && $('.rest_status :selected').val() != ""){
        window.location.href="{{ url('export-csv-of-all-bookings') }}/"+$('.start_date').val()+'/'+$('.end_date').val()+'/'+$('.rest_status :selected').val();
      }else if($('.rest_status :selected').val() != ""){
        window.location.href="{{ url('export-csv-of-all-bookings') }}/0/0"+'/'+$('.rest_status :selected').val();
      }else{
        $(".s_e_s_err").text("Please select atlease one date or status.").css({'display':'block','color':'red','font-size':'13px;'});
      }
   })
   //export by status

   $(document).on("change","input[type='date']",function(){
      if($(this).attr("name") == "start_date"){ 
        if($('.end_date').val() == ""){  $('.end_date').val(moment($('.start_date').val()).add(1, 'days').format('YYYY-MM-DD')); }
        $(".s_e_s_err").hide(); $('.s_err').hide()
      }
      if($(this).attr("name") == "end_date"){ 
        if($('.start_date').val() == ""){  $('.start_date').val(moment($('.end_date').val()).subtract(1, 'days').format('YYYY-MM-DD')); }
        $('.e_err').hide(); $(".s_e_s_err").hide();
      }
 
    });

//filter by date
  $(window).on('load', function(e) {
    localStorage.removeItem("booking_start_date");
    localStorage.removeItem("booking_end_date");
  });

  $(document).on("click",'.clear-filter',function(){
    localStorage.removeItem("booking_start_date");
    localStorage.removeItem("booking_end_date");
  });

  if(localStorage.getItem("booking_start_date") != null && localStorage.getItem("booking_end_date") != null){
    $('#startDate').val(localStorage.getItem("booking_start_date"))
    $('#endDate').val(localStorage.getItem("booking_end_date"))
  }

  $(document).on("click",'.search-bookings',function(){
   localStorage.setItem("booking_start_date",$('#startDate').val())
   localStorage.setItem("booking_end_date",$('#endDate').val())
    if($('#startDate').val() == ''){
        $('.sdate').text("Please Select Start Date").css({'display':'block','font-size':'13px','color':'red'})
    }if($('#endDate').val() == ''){
        $('.edate').text("Please Select End Date").css({'display':'block','font-size':'13px','color':'red'})
    }
    if($('#startDate').val() != '' && $('#endDate').val() != ''){
      start_date = $('#startDate').val()
      end_date = $('#endDate').val()
      getUpcomingData(start_date,end_date);
      getCheckinData(start_date,end_date);
      //getMarkCancelCompleteData(start_date,end_date);
      search_text = ( search_text != 0 &&   search_text != '') ? search_text : 0;
      
      getMarkCancelCompleteData(start_date,end_date,current_page,records_per_page,offset,search_text);
    }
        //window.location.href= "{{ url('get-upcoming-checkin-checkout') }}/"+$('#startDate').val()+'/'+$('#endDate').val();
  }); 

  // setInterval(function(){ getUpcomingData(start_date,end_date); },5000)
  // setInterval(function(){ getCheckinData(start_date,end_date); },5000)
  //// setInterval(function(){ getMarkCancelCompleteData(start_date,end_date); },5000)
  // setIntervalstart_date,end_date,current_page,records_per_page,offset,search_text(){ getMarkCancelCompleteData(start_date,end_date); },5000)
  
  setInterval(function(){ 
    if(is_clicked_popup == false){
      getAllRoomBookingData(start_date,end_date);
    }
  },5000);

  getAllRoomBookingData(start_date,end_date);


 function getAllRoomBookingData(start_date,end_date) {
  getUpcomingData(start_date,end_date);
  getCheckinData(start_date,end_date);
  //getMarkCancelCompleteData(start_date,end_date);
  getMarkCancelCompleteData(start_date,end_date,current_page,records_per_page,offset,search_text);
 }
//filter by date

//pagination start
 $(document).on("click",".booking_per_data_count",function(){
  offset = $(this).data('offset');
  current_page = $(this).data("pagenum");
 
  $('.booking_already_active').removeClass('active');
  
  setTimeout(function(){
    var minus_page_value = current_page - 1;
    $(".booking_pagination li:eq("+minus_page_value+")").addClass("active");
  },900)

  getMarkCancelCompleteData(start_date,end_date,current_page,records_per_page,offset,search_text,current_page,records_per_page,offset,search_text)
 })
//pagination end

//pay amount
$(document).on('click','.paybtn', function(){
  btnid = $(this).data('id')
  key = $(this).data('index')
  payment_mode = $('#payment_mode_list_'+btnid).val();
  amount = $('.custom_payment_value'+key).val();

  if(amount == ''){
    $('.custom_err'+key).css({'display':'block','color':'red'});
    $('.custom_err'+key).html('Please enter amount first');
    return false;
  }else if(parseFloat(amount) > parseFloat($('.custom_payment_value'+key).attr("remaining-amount"))){
      $('.custom_err'+key).css({'display':'block','color':'red'});
      $('.custom_err'+key).html('Please enter correct amount');
      return false;
  }else{
     Swal.fire({
      customClass: {
        icon: 'border-0',
        confirmButton: 'confirm-payment-btn',
      },
      title: 'Hotel The Trade Fair',
      text: "Are you sure? You want to receive payment?",
      iconHtml: '<img src="{{ asset("img/logo.png")}}" alt="The Trade Fair">',
      showCancelButton: true,
      confirmButtonColor: '#fae17c',
      cancelButtonColor: '#d33',
      confirmButtonText: '<span>Yes, Receive</span>'
    }).then((result) => {

       if (result.isConfirmed) {
         $.ajax({
            url:"{{ url('room-order-history/change-status') }}/"+btnid+'/'+payment_mode+'/'+amount+'/payment_mode/0/0',
            type:'get',
            success:function(response){
              is_clicked_popup = false;
            }
          });
       }
    });
  }
});

//confirm paym+
//pay input box
$(document).on("keypress input click","input[name='custom_payment_value']",function(){
 is_clicked_popup = true;
})

// $(document).on("mouseout","input[name='custom_payment_value']",function(){
//    is_clicked_popup = false;
// })
//pay input box

//pay amount


//upcoming to checkin
$(document).on('click','.edit-status',function(){
  is_clicked_popup = true;
  var index = $(this).data("index");
  var value_t_l = $(this).data("value");

  var room_number = $('.total_room'+index).data("room")
 
  $('#storeRoomNumber #total_rooms').val(room_number)
  
    already_room_number_alloted = $(this).data('already');
   
    if(already_room_number_alloted != null && already_room_number_alloted != '' &&  already_room_number_alloted != undefined)
    {
        var txn_id = $(this).data("id");
        var status = "IH";
        var el = this
        $.ajax({
          url:"{{ url('room-order-history/change-status') }}/"+txn_id+'/'+status+'/0/'+'status/0/2',
          type:'get',
          success:function(response){

              $(el).closest('.booking-list').css('background','tomato');
              $(el).closest('.booking-list').fadeOut(500,function(){
               $(this).remove();
             });
            is_clicked_popup = false;
         //  location.reload()
          }
        });
    }else{
        $('#exampleModalToday'+index).modal('show');
       // $('#exampleModalToday'+index+' #storeRoomNumber input[name="status"]').val("IH");
    }
  //}
});

//close room number popup
$(document).on("click",'.close-room-number-popup',function(){
  is_clicked_popup = false;
  $('.room_Error').text("")
})
//close room number popup

is_submit = true;
$(document).on("keypress blur input",'#storeRoomNumber #roomnumber',function(event){
  var room_numbers = $(this).val();

    $.ajax({
      url:"{{ url('check-room-number-already-exists') }}/"+room_numbers,
      type:"get",
      success:function(response){
        if(response == "length_in_range_is_true"){
          $("#save-room-number").prop("disabled",true)
          $('.room_Error').text("Maximum 3 digits allowed for each Room Number.").css({'display':'block','color':'red','font-size':'13px'}).delay(3000).fadeOut();
        }else if(response == "already_exists"){
          is_submit = false;
          $("#save-room-number").prop("disabled",true)
          $('.room_Error').text("Room Number Already alloted.").css({'display':'block','color':'red','font-size':'13px'}).delay(3000).fadeOut();
        }else{
          is_submit = true;
          $("#save-room-number").prop("disabled",false)
          $('.room_Error').css('display','none')
        }
      }
    });
});

 $(document).on("click","#save-room-number",function(event){
  var room = $('#total_rooms').val()
  var index = $(this).data("numindex");
  var room_number_length = $('#roomnumber'+index).val().split(',').length
  var room_number_arr = $('#roomnumber'+index).val().split(',')
  var count = 0;

  while(count < room_number_length){
    if(room_number_arr[count].toString().split('').length != 3){
      is_submit = false;
    }
    count++;
  }

  if($('#roomnumber'+index).val() == 0){
    $('.room_Error').text("Please fill this box.").css({'display':'block','color':'red','font-size':'13px'});
  }else if(room_number_length != parseInt(room)){
    $('.room_Error').text("Please Enter Room Number for How many you have taken Room.").css({'display':'block','color':'red','font-size':'13px'});
  }else if(room_number_arr.every((e, i, a) => a.indexOf(e) === i) == false){
    $('.room_Error').text("You have repeat the room number. One Room number alloted to only for one Room.").css({'display':'block','color':'red','font-size':'13px'});
  }
  else if(is_submit == false){
    $('.room_Error').text("Room Number Already alloted.").css({'display':'block','color':'red','font-size':'13px'});
  }
  else{
    if(is_submit == true){
      $.ajax({
        url:"{{ url('validation-room-number') }}/"+$(this).data("txnid")+'/'+room_number_length+'/'+room_number_arr,
        type:"get",
        success:function(response){
          if(response.status == "length_of_room_number"){
              $('.room_Error').text("Please Enter Room Number for How many you have taken Room.").css({'display':'block','color':'red','font-size':'13px'});
          }else if(response.status == "repeat_room_number"){
              $('.room_Error').text("You have repeat the room number. One Room number alloted to only for one Room.").css({'display':'block','color':'red','font-size':'13px'});
          }else if(response.status == "length_of_room_number_in_range"){
              $('.room_Error').text("Maximum 3 digits is required for each Room Number. ").css({'display':'block','color':'red','font-size':'13px'});
          }else if(response.status == "already_exists_is_true"){
              $('.room_Error').text("Room Number Already alloted.").css({'display':'block','color':'red','font-size':'13px'});
          }else if(response.status == 200 && (event.keyCode != 13 || event.which != 13)){
            var txn_id = $('#storeRoomNumber[name="storeroomnumbertoday'+index+'"] input[name="txn_id"]').val();
            var status = $('#storeRoomNumber[name="storeroomnumbertoday'+index+'"] input[name="status"]').val();

            $.ajax({
              url:"{{ url('room-order-history/change-status') }}/"+txn_id+'/'+status+'/0'+'/status/0/2',
              type:'get',
              success:function(response){
             
                setTimeout(() => {
                  $('#storeRoomNumber[name="storeroomnumbertoday'+index+'"]').attr("action","{{ url('save-room-number') }}");
                  $('#storeRoomNumber[name="storeroomnumbertoday'+index+'"]').submit();
                }, 1000);
              }
            });
          }else{
          }

        }
      })
    }else{
    }
  }
});

$('#storeRoomNumber #roomnumber').keypress(function(e) 
{
  var charCode = (e.which) ? e.which : event.keyCode 
  if (String.fromCharCode(charCode).match(/[^0-9]/g) && charCode != 44)    
        return false;                        
}); 

//today booking room number save script



//later booking save room number script
$(document).on('click','.edit-status-later',function(){
  is_clicked_popup = true;
  var index = $(this).data("index");
  var value_t_l = $(this).data("value");

  var room_number = $('.total_room'+index).data("room")
 
  $('#storeRoomNumberlater #total_rooms_latr').val(room_number)
  
    already_room_number_alloted = $(this).data('already');
   
    if(already_room_number_alloted != null && already_room_number_alloted != '' &&  already_room_number_alloted != undefined)
    {
        var txn_id = $(this).data("id");
        var status = "IH";
        var el = this
        $.ajax({
          url:"{{ url('room-order-history/change-status') }}/"+txn_id+'/'+status+'/0/'+'status/0/2',
          type:'get',
          success:function(response){

              $(el).closest('.booking-list').css('background','tomato');
              $(el).closest('.booking-list').fadeOut(500,function(){
               $(this).remove();
             });
            is_clicked_popup = false;
         //  location.reload()
          }
        });
    }else{
        $('#exampleModalLater'+index).modal('show');
       // $('#exampleModalLater'+index+' #storeRoomNumberlater input[name="status"]').val("IH");
    }
  //}
});

is_submit = true;
$(document).on("keypress blur input",'#storeRoomNumberlater #roomnumberlater',function(event){
  var room_numbers = $(this).val();

    $.ajax({
      url:"{{ url('check-room-number-already-exists') }}/"+room_numbers,
      type:"get",
      success:function(response){
        if(response == "length_in_range_is_true"){
          $("#save-room-number-later").prop("disabled",true)
          $('.room_Error').text("Maximum 3 digits allowed for each Room Number.").css({'display':'block','color':'red','font-size':'13px'}).delay(3000).fadeOut();
        }else if(response == "already_exists"){
          is_submit = false;
          $("#save-room-number-later").prop("disabled",true)
          $('.room_Error').text("Room Number Already alloted.").css({'display':'block','color':'red','font-size':'13px'}).delay(3000).fadeOut();
        }else{
          is_submit = true;
          $("#save-room-number-later").prop("disabled",false)
          $('.room_Error').css('display','none')
        }
      }
    });
});

 $(document).on("click","#save-room-number-later",function(event){
  var index = $(this).data("numindex");
  var room = $('#total_rooms_latr').val()
  var room_number_length = $('#roomnumberlater'+index).val().split(',').length
  var room_number_arr = $('#roomnumberlater'+index).val().split(',')
  var count = 0;
  
  while(count < room_number_length){
    if(room_number_arr[count].toString().split('').length != 3){
      is_submit = false;
    }
    count++;
  }

  if($('#roomnumberlater'+index).val() == 0){
    $('.room_Error').text("Please fill this box.").css({'display':'block','color':'red','font-size':'13px'});
  }else if(room_number_length != parseInt(room)){
    $('.room_Error').text("Please Enter Room Number for How many you have taken Room.").css({'display':'block','color':'red','font-size':'13px'});
  }else if(room_number_arr.every((e, i, a) => a.indexOf(e) === i) == false){
    $('.room_Error').text("You have repeat the room number. One Room number alloted to only for one Room.").css({'display':'block','color':'red','font-size':'13px'});
  }
  else if(is_submit == false){
    $('.room_Error').text("Room Number Already alloted.").css({'display':'block','color':'red','font-size':'13px'});
  }
  else{
    if(is_submit == true){
      $.ajax({
        url:"{{ url('validation-room-number') }}/"+$(this).data("txnid")+'/'+room_number_length+'/'+room_number_arr,
        type:"get",
        success:function(response){
          if(response.status == "length_of_room_number"){
              $('.room_Error').text("Please Enter Room Number for How many you have taken Room.").css({'display':'block','color':'red','font-size':'13px'});
          }else if(response.status == "repeat_room_number"){
              $('.room_Error').text("You have repeat the room number. One Room number alloted to only for one Room.").css({'display':'block','color':'red','font-size':'13px'});
          }else if(response.status == "length_of_room_number_in_range"){
              $('.room_Error').text("Maximum 3 digits is required for each Room Number. ").css({'display':'block','color':'red','font-size':'13px'});
          }else if(response.status == "already_exists_is_true"){
              $('.room_Error').text("Room Number Already alloted.").css({'display':'block','color':'red','font-size':'13px'});
          }else if(response.status == 200 && (event.keyCode != 13 || event.which != 13)){
            var txn_id = $('#storeRoomNumberlater[name="storeroomnumberlater'+index+'"] input[name="txn_id"]').val();
            var status = $('#storeRoomNumberlater[name="storeroomnumberlater'+index+'"] input[name="status"]').val();

            $.ajax({
              url:"{{ url('room-order-history/change-status') }}/"+txn_id+'/'+status+'/0'+'/status/0/2',
              type:'get',
              success:function(response){
             
                setTimeout(() => {
                  $('#storeRoomNumberlater[name="storeroomnumberlater'+index+'"]').attr("action","{{ url('save-room-number') }}");
                  $('#storeRoomNumberlater[name="storeroomnumberlater'+index+'"]').submit();
                }, 1000);
              }
            });
          }else{
          }

        }
      })
    }else{
    }
  }
});

$('#storeRoomNumberlater #roomnumber').keypress(function(e) 
{
  var charCode = (e.which) ? e.which : event.keyCode 
  if (String.fromCharCode(charCode).match(/[^0-9]/g) && charCode != 44)    
        return false;                        
});
//later booking save room number script

//prev booking save room number script
$(document).on('click','.edit-status-prev',function(){
  is_clicked_popup = true;
  var index = $(this).data("index");
  var value_t_l = $(this).data("value");

  var room_number = $('.total_room_prev'+index).data("room")
 
  $('#storeRoomNumberprev #total_rooms_prev').val(room_number)
  
    already_room_number_alloted = $(this).data('already');
   
    if(already_room_number_alloted != null && already_room_number_alloted != '' &&  already_room_number_alloted != undefined)
    {
        var txn_id = $(this).data("id");
        var status = "IH";
        var el = this
        $.ajax({
          url:"{{ url('room-order-history/change-status') }}/"+txn_id+'/'+status+'/0/'+'status/0/2',
          type:'get',
          success:function(response){

              $(el).closest('.booking-list').css('background','tomato');
              $(el).closest('.booking-list').fadeOut(500,function(){
               $(this).remove();
             });
            is_clicked_popup = false;
          }
        });
    }else{
        $('#exampleModalprev'+index).modal('show');
    }
  //}
});

is_submit = true;
$(document).on("keypress blur input",'#storeRoomNumberprev #roomnumberprev',function(event){
  var room_numbers = $(this).val();

    $.ajax({
      url:"{{ url('check-room-number-already-exists') }}/"+room_numbers,
      type:"get",
      success:function(response){
        if(response == "length_in_range_is_true"){
          $("#save-room-number-prev").prop("disabled",true)
          $('.room_Error').text("Maximum 3 digits allowed for each Room Number.").css({'display':'block','color':'red','font-size':'13px'}).delay(3000).fadeOut();
        }else if(response == "already_exists"){
          is_submit = false;
          $("#save-room-number-prev").prop("disabled",true)
          $('.room_Error').text("Room Number Already alloted.").css({'display':'block','color':'red','font-size':'13px'}).delay(3000).fadeOut();
        }else{
          is_submit = true;
          $("#save-room-number-prev").prop("disabled",false)
          $('.room_Error').css('display','none')
        }
      }
    });
});

 $(document).on("click","#save-room-number-prev",function(event){
  alert("click prev button")
  var index = $(this).data("numindex");
  var room = $('#total_rooms_prev').val()
  var room_number_length = $('#roomnumberprev'+index).val().split(',').length
  var room_number_arr = $('#roomnumberprev'+index).val().split(',')
  var count = 0;

  while(count < room_number_length){
    if(room_number_arr[count].toString().split('').length != 3){
      is_submit = false;
    }
    count++;
  }

  if($('#roomnumberprev'+index).val() == 0){
    $('.room_Error').text("Please fill this box.").css({'display':'block','color':'red','font-size':'13px'});
  }else if(room_number_length != parseInt(room)){
    $('.room_Error').text("Please Enter Room Number for How many you have taken Room.").css({'display':'block','color':'red','font-size':'13px'});
  }else if(room_number_arr.every((e, i, a) => a.indexOf(e) === i) == false){
    $('.room_Error').text("You have repeat the room number. One Room number alloted to only for one Room.").css({'display':'block','color':'red','font-size':'13px'});
  }
  else if(is_submit == false){
    $('.room_Error').text("Room Number Already alloted.").css({'display':'block','color':'red','font-size':'13px'});
  }
  else{
     
    if(is_submit == true){
      $.ajax({
        url:"{{ url('validation-room-number') }}/"+$(this).data("txnid")+'/'+room_number_length+'/'+room_number_arr,
        type:"get",
        success:function(response){
          if(response.status == "length_of_room_number"){
              $('.room_Error').text("Please Enter Room Number for How many you have taken Room.").css({'display':'block','color':'red','font-size':'13px'});
          }else if(response.status == "repeat_room_number"){
              $('.room_Error').text("You have repeat the room number. One Room number alloted to only for one Room.").css({'display':'block','color':'red','font-size':'13px'});
          }else if(response.status == "length_of_room_number_in_range"){
              $('.room_Error').text("Maximum 3 digits is required for each Room Number. ").css({'display':'block','color':'red','font-size':'13px'});
          }else if(response.status == "already_exists_is_true"){
              $('.room_Error').text("Room Number Already alloted.").css({'display':'block','color':'red','font-size':'13px'});
          }else if(response.status == 200 && (event.keyCode != 13 || event.which != 13)){
            var txn_id = $('#storeRoomNumberprev[name="storeroomnumberprev'+index+'"] input[name="txn_id"]').val();
            var status = $('#storeRoomNumberprev[name="storeroomnumberprev'+index+'"] input[name="status"]').val();
 
            $.ajax({
              url:"{{ url('room-order-history/change-status') }}/"+txn_id+'/'+status+'/0'+'/status/0/2',
              type:'get',
              success:function(response){
             
                setTimeout(() => {
                  $('#storeRoomNumberprev[name="storeroomnumberprev'+index+'"]').attr("action","{{ url('save-room-number') }}");
                  $('#storeRoomNumberprev[name="storeroomnumberprev'+index+'"]').submit();
                }, 1000);
              }
            });
          }else{
          }

        }
      })
    }else{
    }
  }
});

$('#storeRoomNumberprev #roomnumber').keypress(function(e) 
{
  var charCode = (e.which) ? e.which : event.keyCode 
  if (String.fromCharCode(charCode).match(/[^0-9]/g) && charCode != 44)    
        return false;                        
});
//prev booking save room number script

$(document).on("click",".refund-mount",function(){
  Swal.fire({
    title: 'Are you sure?',
    text: "Do you want to refund the amount!",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Refund it!'
  }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
          url:"{{ url('refund-data') }}/"+$(this).data("id")+'/room',
          type:"get",
          success:function(response){
            if(response.status == 200){
            //  location.reload();
            }else{
               Swal.fire('', 'Amount is not Refundable. Cancelled booking before 24 hrs.', 'error')
            }
          }
        })
    }
  })
});

//see all ordered item 
$(document).on("click",'.see-order-items',function(){
   is_clicked_popup = true;
});

  //chekcin script end

//checkout Data
$(document).on("click",".checkout-data",function(event){
  var el = this;
    $.ajax({
      url:"{{ url('room-order-history/change-status')}}/"+$(this).data("id")+'/C/0/status/1/1',//last 0 for checkout
      type:"get",
      success:function(response){
        $(el).closest('.booking-list').css('background','tomato');
          $(el).closest('.booking-list').fadeOut(1000,function(){
           $(this).remove();
         });
      }
    })
})
//checkout Data

//mark as no show
$(document).on("click","#mark-as-no-prev",function(){
  var el = this;
    $.ajax({
      url:"{{ url('room-order-history/change-status')}}/"+$(this).data("id")+'/M/0/status/1/0',//last 0 for checkout
      type:"get",
      success:function(response){
        $(el).closest('.booking-list').css('background','tomato');
          $(el).closest('.booking-list').fadeOut(1000,function(){
           $(this).remove();
         });
      }
    })
})
//mark as no show
</script>
@endsection