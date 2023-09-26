  function countFinalPrice(){
      let totalamt= 0;
      let net_total= 0;
 
      totalamt = parseFloat($('#subtotal_amt').val());

      console.log(totalamt);
      tax_default = $('#settingdata').data('taxrate');
      $('#subtotal').html('<i class="fa fa-rupee"></i>'+ totalamt.toFixed(2));
      let total_tax_amt = (totalamt*tax_default) / 100;
      $('#subtotal_amt').val(totalamt.toFixed(2));
      $('#subtotal_taxes').val(total_tax_amt.toFixed(2));
      $('#total_taxes').html('<i class="fa fa-rupee"></i>'+ total_tax_amt.toFixed(2));
      
      var meal_tax =  $('#subtotal_meal_tax').val()
      $('#meal_tax').html('<i class="fa fa-rupee"></i>'+ parseFloat(meal_tax).toFixed(2));
      
      $('.calculate_grand_total_amount').each(function(index){
        net_total += parseFloat($(this).val());
      })
      $('#net_total_amt').val(net_total);
      $('.net_total').html('<i class="fa fa-rupee"></i>'+net_total.toFixed(2));

      let subtotal_tti_credit = $('#subtotal_tti_credit').val();
      let promocode_deduction = $('#promocode_deduction').val();
      let subtotal_tti_rewardpoint = $('#subtotal_tti_rewardpoint').val();

      payment_options = $('#payment_options').val();
     let final_amt = 0;

      net_total = ((net_total * payment_options) / 100).toFixed(2);
      final_amt = (net_total - (parseFloat(subtotal_tti_credit) + parseFloat(promocode_deduction) + parseFloat(subtotal_tti_rewardpoint)));
      
      //new work
      if($('.additional_charges').hasClass('minus_amount'))
      final_amt = final_amt - parseInt($('.minus_amount').text().trim());

       if($('.additional_charges').hasClass('additional_amount'))
        final_amt = final_amt + parseInt($('.additional_amount').text().trim())
      
      //new work

      final_amt = parseFloat(final_amt).toFixed(2);
      
      if(final_amt <= 0){
        final_amt = '0.00';
        $('#payment_options').attr('disabled','disabled');
      }else{
        $('#payment_options').removeAttr('disabled');
      }

      $('.gr_total').html('<i class="fa fa-rupee"></i>'+ final_amt);
      $('#grand_total_amt').val(final_amt);
      $('#f_total_amt').val(final_amt);
      $('#payuprice').val(final_amt);
  } 


  function applyCoupon(coupon_code,typeofdiscount){

    if(coupon_code == ''){
        $('#pcode-error').html('Please enter code first.');
        return false;
    }else{
      $("#payment_options").val(100);
      countFinalPrice();
      
      var order_id = Math.floor(Date.now() / 1000) + '-' + $('#settingdata').data('orderid');

      $.ajax({
        url:$('#settingdata').data('apcodeurl'),
        type:"post",
        data:{coupon_code: coupon_code,net_total_amt: $('#f_total_amt').val(),no_of_rooms:$('.no_of_rooms span').text(),roomcategory:$('#settingdata').data('roomcat'),checkin:$('.checkout-checkin-date').text(),checkout:$('.checkout-checkout-date').text(),subtotal_meal_amt:$('#subtotal_meal_amt').val(),order_id:order_id},
        success:function(response){
          res = JSON.parse(response);

          console.log(res)
          if(res.status == 'error'){
            $('#pcode-error').html(res.message);
            return false;
          }else{
            //new work
            if($('#settingdata').data('roomcat') == "deluxe"){
              if(typeofdiscount == "percentage"){
                console.log("kfjgkjk deluxe")
                $('#promocode_amt').html('- <i class="fa fa-rupee"></i>'+ (res.dicounted_amt).toFixed(2));
                deductionAmount(coupon_code,"add",0)
              }if(typeofdiscount == "net"){
               
                   setTimeout(function(){
                    $('#subtotal_amt').val(res.net_amount_data.final_amount)
                    $('#subtotal_taxes').val(res.net_amount_data.room_tax.toFixed(2))
                    $('#grand_total_amt').val(res.net_amount_data.payable_amount)
                    $('#f_total_amt').val(res.net_amount_data.payable_amount)
                    $('#promocode_deduction').val(res.net_amount_data.promo_amount)
                    $('#payuprice').val(parseFloat(res.net_amount_data.payable_amount).toFixed(2))


                    $('#subtotal').html('<i class="fa fa-rupee"></i>'+res.net_amount_data.final_amount)
                    $('#total_taxes').html('<i class="fa fa-rupee"></i>'+res.net_amount_data.room_tax)
                    $('#meal_amt').html('<i class="fa fa-rupee"></i>'+res.net_amount_data.meal_amount)
                    $('#food_tax').html('<i class="fa fa-rupee"></i>'+res.net_amount_data.food_tax)
                    $('#net_total_amt').val(res.net_amount_data.tax_include_taxes)
                    $('.net_total').html('<i class="fa fa-rupee"></i>'+res.net_amount_data.tax_include_taxes)
                    $('#promocode_amt').html('- <i class="fa fa-rupee"></i>'+res.net_amount_data.promo_amount)
                    $('.gr_total').html('<i class="fa fa-rupee"></i>'+res.net_amount_data.payable_amount)
                   },300)
              }
              
              var is_validate_guest = validifGuestInRoom($('.total_guests').data("guests"),$('.no_of_rooms span').text())
              if(is_validate_guest == "lesser_guest" ) { $('.additional_persons_charges').hide(); //$('.extra_persons_charges').hide(); 
              }
                
                var values = [0, 25];
                $.each(values, function(k, v) {
                    $('#payment_options option[value=' + v + ']').prop('disabled', true);
                });
            }
            
            $('#coupon_code').val('');
            $('#pcode-error').html('');
            $('#promocodeModal').modal('hide');
            $('#promocode_deduction').val(res.dicounted_amt);
            $('#promocode').val(coupon_code);
            
            $('#promocode_amt').html('- <i class="fa fa-rupee"></i>'+res.dicounted_amt)

            //($('#settingdata').data('loginuser') == 0) ? $('#promocode_amt').html('- <i class="fa fa-rupee"></i>'+ (res.dicounted_amt).toFixed(2)) : '';
            $('#promosuccmsg').html(res.message+`<span style="color:#ff3100;cursor:pointer;font-size:13px;float: right;" onclick="removePromocode('${coupon_code}','${typeofdiscount}')">Remove <i class="fa fa-times"></i></span>`);
            countFinalPrice();
          }
        }
      })
    }
}

function removePromocode(res,coupon_code){
  //new work
  deductionAmount(coupon_code,"remove",0)
  var values = [0, 25];
  $.each(values, function(k, v) {
     $('#payment_options option[value=' + v + ']').prop('disabled', false);
  });
   
  $("#payment_options").val(100);

  if($('#payment_options').val() == 100){
    $('.place-order-sec #item_place_order').text('Book Now')
  }else{
    $('.place-order-sec #item_place_order').text('Book Now & Pay at Hotel')
  }


  countFinalPrice();
  $('#promocode_deduction').val(0);
  $('#promocode').val('');
  $('#promocode_amt').html('- <i class="fa fa-rupee"></i> 0.00');
  $('#promosuccmsg').html('');
  $('.additional_persons_charges').show();
  countFinalPrice();


}

//new work
function deductionAmount(coupon_code,whichcase,reward_amount){
   
  $.ajax({
    url:$('#settingdata').attr('data-deductionurl'),
    type:"post",
    data:{coupon_code: coupon_code,no_of_rooms:$('.no_of_rooms span').text(),roomcategory:$('#settingdata').data('roomcat'),checkin:$('.checkout-checkin-date').text(),checkout:$('.checkout-checkout-date').text(),guest:$('.total_guests').data("guests"),subtotal_meal_amt:$('#subtotal_meal_amt').val(),orderid:window.location.pathname.split('/').pop(),case:whichcase,reward_amount:reward_amount},
    success:function(response){
     
      $('#subtotal_amt').val(response.final_amount)
      $('#subtotal_taxes').val(response.room_tax.toFixed(2))
      $('#grand_total_amt').val(response.payable_amount)
      $('#f_total_amt').val(response.payable_amount)
      $('#promocode_deduction').val(response.promo_amount)
      $('#payuprice').val(parseFloat(response.payable_amount).toFixed(2))

      $('#subtotal').html('<i class="fa fa-rupee"></i>'+response.final_amount)
      $('#total_taxes').html('<i class="fa fa-rupee"></i>'+(Number.isInteger(response.room_tax)) ? response.room_tax.toFixed(2) : response.room_tax)
      $('#meal_amt').html('<i class="fa fa-rupee"></i>'+response.meal_amount)
      $('#food_tax').html('<i class="fa fa-rupee"></i>'+response.food_tax)
      $('#net_total_amt').val(response.tax_include_taxes)
      $('.net_total').html('<i class="fa fa-rupee"></i>'+response.tax_include_taxes)
      $('#promocode_amt').html('- <i class="fa fa-rupee"></i>'+response.promo_amount)
      $('.gr_total').html('<i class="fa fa-rupee"></i>'+response.payable_amount)
    
    }
  });
}

function validifGuestInRoom(guest,total_needed_room){
  var per_room_person = $('#settingdata').data('perroomperson');
  var no_of_avail_rooms = $('#settingdata').data('noofrooms');

  var total_persons = parseInt(per_room_person) * parseInt(total_needed_room);
  var guest = parseInt(guest);
 
  if(guest > total_persons){
   return "greater_guest";
  }else if(guest < total_persons){
    return "lesser_guest";
  }else{
  }
}

//new work

function resetCreditReward(){
  if($('#add_wallet_amount').prop('checked') == true){
    $('#add_wallet_amount').prop('checked', false);
    $('#tti_credit_amt').html('- <i class="fa fa-rupee"></i> 0.00');
    $('#subtotal_tti_credit').val(0);
    $('#add_wallet_amount').val(0);
    $("#payment_options")[0].selectedIndex = 0;
    $("#payment_options").val(100);

    if($('#payment_options').val() == 100){
      $('.place-order-sec #item_place_order').text('Book Now')
    }else{
      $('.place-order-sec #item_place_order').text('Book Now & Pay at Hotel')
    }
  }

  if($('#add_reward_amount').prop('checked') == true){
    $('#add_reward_amount').prop('checked', false);
    $('#tti_reward_amt').html('- <i class="fa fa-rupee"></i> 0.00');
    $('#subtotal_tti_rewardpoint').val(0);
    $('#add_reward_amount').val(0);
    $('.offers-inner-box').removeClass('d-none');
    $("#payment_options").val(100);

    if($('#payment_options').val() == 100){
      $('.place-order-sec #item_place_order').text('Book Now')
    }else{
      $('.place-order-sec #item_place_order').text('Book Now & Pay at Hotel')
    }

  }
}
$(document).ready(function(){
  countFinalPrice();
 
  $(document).on('change', '#payment_options', function(){
      selected_val = parseInt($(this).val());
      grand_amt = $('#grand_total_amt').val();

      if(selected_val == 25)
        new_amt = ((parseFloat(grand_amt) * selected_val) / 100).toFixed(2);
      else
        new_amt = ((parseFloat(grand_amt) * 100) / 100).toFixed(2);


      $('#remaining_total_amt').val(parseFloat(grand_amt) - parseFloat(new_amt));
      $('#f_total_amt').val(new_amt);
      $('.gr_total').html('<i class="fa fa-rupee"></i>'+ new_amt);
      $('#payuprice').val(new_amt);
     
      if(selected_val == 0 || selected_val == 25)
        $('.place-order-sec #item_place_order').text('Book Now & Pay at Hotel')
      else
        $('.place-order-sec #item_place_order').text('Book Now')

  })

  $(document).on('click','#apply_code',()=>{
    applyCoupon($('#coupon_code').val(),0);
  })

  $(document).on('click','.coupon_apply', function(){
    applyCoupon($(this).data('coupon'),$(this).data("typeofdiscount"));
  })

  $(document).on('click', '.show_more', function(){
     promoid = $(this).data('id');
     $('.moredata-'+promoid).show();
     $('.showless_'+promoid).show();
     $('.showmore_'+promoid).hide();
  })
  
  $(document).on('click', '.show_less', function(){
     promoid = $(this).data('id');
     $('.moredata-'+promoid).hide();
     $('.showless_'+promoid).hide();
     $('.showmore_'+promoid).show();
  })
 
  function walletPoint(){
    if($('#payment_options').val() == 100){
      $('.place-order-sec #item_place_order').text('Book Now')
    }else{
      $('.place-order-sec #item_place_order').text('Book Now & Pay at Hotel')
    }
    
    if($('#add_wallet_amount').prop('checked') == true){
      
      let wallet_amt = $('#settingdata').data('creditamount');
      let user_ordered_amt = $('#f_total_amt').val();

      if(parseFloat(wallet_amt) <= 0){
          $('#unsuccess-popups .errormessage').text('Insufficient TTI Credits');
          $('#unsuccess-popups').modal('show');
          
          $('#add_wallet_amount').prop('checked', false);
          return false;
      }else{

          $('#add_wallet_amount').val(1);   
          var auth_data = localStorage.getItem('auth_data');
         
          if(auth_data == true || auth_data == 1){
            if($('#add_wallet_amount').val() == 1){
                $('#item_place_order').prop("disabled",true)
                $('#OTP-popups').modal("show");
            }else{
              $('#item_place_order').prop("disabled",false)
              $('#OTP-popups').modal("hide");
            }
          }

          newamt = 0;
          if(wallet_amt >= user_ordered_amt){
            newamt = user_ordered_amt;
          }else{
            newamt = wallet_amt;
          }

          $('#tti_credit_amt').html('- '+ (parseFloat(newamt).toFixed(2)) + ' <strong>P</strong>');
          $('#subtotal_tti_credit').val((parseFloat(newamt).toFixed(2)));
      }

    }else{
        $('#item_place_order').attr("disabled", false);
        $('#tti_credit_amt').html('- 0.00' + ' <strong>P</strong>');
        $('#subtotal_tti_credit').val(0);
        $('#add_wallet_amount').val(0);
    }
    countFinalPrice();
  }
 
  walletPoint();
  $(document).on('click', '#add_wallet_amount', function(){
    $("#payment_options").val(100);
    countFinalPrice();
    walletPoint();
  })


  function func1(amountrwd){
    if($('#add_wallet_amount').prop('checked') == true){
       grand_total_amt = parseFloat($('#grand_total_amt').val());
       if(grand_total_amt == 0){
         minusamt = parseFloat($('#subtotal_tti_credit').val()) - amountrwd;
         $('#tti_credit_amt').html('- '+ (parseFloat(minusamt).toFixed(2)) + ' <strong>P</strong>');
         $('#subtotal_tti_credit').val(parseFloat(minusamt).toFixed(2)); 
        }else{
       }
   }
  }

  function rewardPoint(is_page_landing){

    var values = [0, 25];
    $.each(values, function(k, v) {
      $('#payment_options option[value=' + v + ']').prop('disabled', false);
    });


    if($('#payment_options').val() == 100){
      $('.place-order-sec #item_place_order').text('Book Now')
    }else{
      $('.place-order-sec #item_place_order').text('Book Now & Pay at Hotel')
    }
    if($('#add_reward_amount').prop('checked') == true){
      
      setTimeout(function(){
        if($('#settingdata').data('roomcat') == "deluxe"){
          deductionAmount($('#coupon_code').val(),"remove",$('#subtotal_tti_rewardpoint').val())
        }
      },200);

      let wallet_amt = $('#settingdata').data('rewardamount');
      let min_tti_percent = $('#settingdata').data('ttireward');
      let user_ordered_amt = $('#subtotal_amt').val();
      if(parseFloat(user_ordered_amt) == 0){
        user_ordered_amt = $('#net_total_amt').val();
      }
      let amount_after_20_percent_deduction = (user_ordered_amt * min_tti_percent) / 100;
     
      if(parseFloat(wallet_amt) <= 0){
          if(!is_page_landing){
            $('#unsuccess-popups .errormessage').text('Insufficient Reward Points');
            $('#unsuccess-popups').modal('show');

          }
          $('#add_reward_amount').prop('checked', false);
          return false;
      }else{
          if(parseFloat(amount_after_20_percent_deduction) > parseFloat(wallet_amt)){
              $('#tti_reward_amt').html('- '+ (parseFloat(wallet_amt).toFixed(2)) + ' <strong>P</strong>');
              $('#subtotal_tti_rewardpoint').val((parseFloat(wallet_amt).toFixed(2)));
              $('#add_reward_amount').val(1);
      
              $('#pcode-error').html('');
              $('#promocode_deduction').val(0);
              $('#promocode').val('');
              $('#promocode_amt').html('- <i class="fa fa-rupee"></i> 0.00');
              $('#promosuccmsg').html('');
              $('.offers-inner-box').addClass('d-none');
              func1(wallet_amt);
          }else{
            let credit_amt = (user_ordered_amt * min_tti_percent) / 100;
            $('#tti_reward_amt').html('- '+ (parseFloat(credit_amt).toFixed(2)) + ' <strong>P</strong>');
            $('#subtotal_tti_rewardpoint').val((parseFloat(credit_amt).toFixed(2)));
            $('#add_reward_amount').val(1);
    
            $('#pcode-error').html('');
            $('#promocode_deduction').val(0);
            $('#promocode').val('');
            $('#promocode_amt').html('- <i class="fa fa-rupee"></i> 0.00');
            $('#promosuccmsg').html('');
            $('.offers-inner-box').addClass('d-none');
            func1(credit_amt);
          }
      }
    }else{

        if($('#add_wallet_amount').prop('checked') == true){
            let net_total = $('#net_total_amt').val();
            let wallet_amt = $('#settingdata').data('creditamount');
            let famount = 0;
            if(net_total >= wallet_amt){
              famount = wallet_amt;
            }else{
              famount = net_total;
            }

            payment_options = $('#payment_options').val();
            famount = (famount * payment_options / 100).toFixed(2); 

            $('#tti_credit_amt').html('- '+ (parseFloat(famount).toFixed(2)) + ' <strong>P</strong>');
            $('#subtotal_tti_credit').val((parseFloat(famount).toFixed(2)));
        }

        $('#tti_reward_amt').html('- 0.00' + ' <strong>P</strong>');
        $('#subtotal_tti_rewardpoint').val(0);
        $('#add_reward_amount').val(0);
        $('.offers-inner-box').removeClass('d-none');
    }
    countFinalPrice();
  }
  rewardPoint(1);
  $(document).on('click', '#add_reward_amount', function(){
    $("#payment_options").val(100);
    countFinalPrice();
    rewardPoint(0);
  })
  

 $(document).on('click','#item_place_order',()=>{

        $('#item-loader').removeClass('d-none')
        $('#item_place_order').prop("disabled",true);
        $('#item_place_order').removeAttr("id");
        
        let subtotal_amt = $('#subtotal_amt').val();
        let subtotal_taxes = $('#subtotal_taxes').val();
        let subtotal_meal_amt = $('#subtotal_meal_amt').val();
        let subtotal_meal_tax = $('#subtotal_meal_tax').val();
        let subtotal_tti_credit = $('#subtotal_tti_credit').val();
        let subtotal_tti_rewardpoint = $('#subtotal_tti_rewardpoint').val();
        let net_total_amt = $('#net_total_amt').val();
        let grand_total_amt = $('#grand_total_amt').val();
        let f_total_amt = $('#payment_options').val() == 0 ? 0 : $('#f_total_amt').val();
        let promocode = $('#promocode').val();
        let promocode_deduction = $('#promocode_deduction').val();

        let customerName = $('#settingdata').data('customername');
        let customerEmail = $('#settingdata').data('customeremail');
        let customerPhone = $('#settingdata').data('customerphone');
        let roomcat = $('#settingdata').data('roomcat');
        let roomid = $('#settingdata').data('roomid');

        ///additional changes
        let checkindate = $('.checkout-checkin-date').text();
        let per_shift_price = $('.checkout-per_shift_price').text();

        let orderid = Math.floor(Date.now() / 1000) + '-' + $('#settingdata').data('orderid');
        $('#orderId').val(orderid);
        //$('#checkout_form').submit();     

        if($('#add_wallet_amount').val() == "" || $('#add_wallet_amount').val() == undefined || $('#add_wallet_amount').val() == 0){
         var add_wallet_amt = 0;
        }
        else{
         var add_wallet_amt = $('#add_wallet_amount').val();
        }
      
      
        if($('#add_reward_amount').val() == "" || $('#add_reward_amount').val() == undefined || $('#add_reward_amount').val() == 0){
          var add_reward_amount = 0;
        }
        else{
          var add_reward_amount = $('#add_reward_amount').val();
        }
 
        $.ajax({
          url:$('#settingdata').data('tempcheckout'),
          type:"POST",
          data : {subtotal_amt:subtotal_amt, subtotal_taxes:subtotal_taxes, subtotal_meal_amt:subtotal_meal_amt, subtotal_meal_tax:subtotal_meal_tax, subtotal_tti_credit:subtotal_tti_credit, subtotal_tti_rewardpoint:subtotal_tti_rewardpoint, net_total_amt:net_total_amt, grand_total_amt:grand_total_amt, f_total_amt:f_total_amt, promocode:promocode, promocode_deduction:promocode_deduction, orderid:orderid, payment_option:$('#payment_options').val(),roomid:roomid,checkindate:checkindate,per_shift_price:per_shift_price
        },
          success:function(response){

              $.ajax({
                url:$('#settingdata').data('generatehashroom'),
                type:"POST",
                data:{orderId: orderid, customerName:customerName, customerEmail:customerEmail, customerPhone:customerPhone, subtotal_amt:subtotal_amt, subtotal_taxes:subtotal_taxes,subtotal_tti_credit:subtotal_tti_credit,subtotal_tti_rewardpoint:subtotal_tti_rewardpoint, net_total_amt:net_total_amt,grand_total_amt:grand_total_amt,promocode:promocode,promocode_deduction:promocode_deduction, roomcat:roomcat, roomid:roomid,add_wallet_amount:add_wallet_amt, add_reward_amount:add_reward_amount, subtotal_meal_amt: $('#subtotal_meal_amt').val(), subtotal_meal_tax : $('#subtotal_meal_tax').val(), payment_options: $('#payment_options').val(), f_total_amt: f_total_amt,checkindate:checkindate},
                success:function(has_res){
      
                  const obj = JSON.parse(has_res)
                  $('#merchantData').val(obj.merchantData);
                  $('#signature').val(obj.signature);
                  setTimeout(function(){
                    if($('#payment_options').val() == 0){
                      $.ajax({
                        url:$('#settingdata').data('zerocheckout'),
                          type:"post",
                          data:{orderId: orderid, orderAmount: grand_total_amt},
                          success:function(response){
                              responseData = JSON.parse(response);
                              if(responseData.status == 'success'){
                                  window.location.href = '/TTI/thetradefair/public/room-payment-summary/'+responseData.txnid;
                              }
                          }
                      })
                    }else{
                      if(grand_total_amt <= 0){
                        $.ajax({
                          url:$('#settingdata').data('zerocheckout'),
                            type:"post",
                            data:{orderId: orderid, orderAmount: grand_total_amt},
                            success:function(response){
                                responseData = JSON.parse(response);
                                if(responseData.status == 'success'){
                                    window.location.href = '/TTI/thetradefair/public/room-payment-summary/'+responseData.txnid;
                                }
                            }
                        })
                    }else{
                        $('#checkout_form').submit();
                    }
                    }
                
                  },800)
                }
              });
          }
        })      
  })

})


///for send OTP

$('.resend-otp-btn').click(function (evt) {

  $('.resend-spinner-border').show();
  setTimeout(() => {
      $('.resend-spinner-border').hide();
      $('.otp-input .passcode-wrapper input').val("");
      $('.resend-otp-btn').hide()
      $('.countdown').removeClass("d-none");
      localStorage.setItem("resent_otp", true)
      sendOTPFunction();

      $('#invalid_otp').text("Successfully send new OTP.").css({ 'display': 'block', 'font-size': '13px', 'color': 'green' }).delay(3000).fadeOut();
  }, 1000);

});


$(document).on('click', '#add_wallet_amount, .verify-btn button', function(){
  if($(this).hasClass('resend-otp-btn')){
    $('.otp-input .passcode-wrapper input').val("");
  }

  if($('#settingdata').data('creditamount') > 0 && $('#add_wallet_amount').is(":checked") == true){
    let customerPhone = $('.customerPhone').val();
    $('.second-verify-btn').css('display','block')
    $('.resend-otp').show();
    $('.verify-btn button').hide();
    $.ajax({
      url: $('.send-otp-url').data('sendotp'),
      type: 'get',
      data: {
          data: customerPhone,
          url_str: "room"
      },
      success: function (response) {
          if (response.status == 500) {
              $('#invalid_otp').text(response['error']);
              $('#invalid_otp').show();
          } else {
              $('.edit-input-group-append').show();
              document.getElementById("checkout-phone").readOnly = true;
              $('.otp-input').show()
              $('.second-verify-btn').show()
              $('.resend-otp').show();
              $('.verify-btn button').hide();
              localStorage.setItem("resent_otp", true)
          }
      }
  })
  }
});


$('.second-verify-btn .verify-btn').click(function(){
  $('#otp-verify-btn').show();
  setTimeout(() => {
    var otp = $('#codeBox1').val()+$('#codeBox2').val()+$('#codeBox3').val()+$('#codeBox4').val() 
    if(otp.length == 4){
      $.ajax({
        url:$('.verify-opt-url').data("verifyopturl"),//+$('#settingdata').data('customerphone')+'/'+otp,
        type:'get',
        data: {
          codeBox: otp,
          number:$('#settingdata').data('customerphone')
      },
        success:function(response){

          $('#codeBox1').val("")
          $('#codeBox2').val("")
          $('#codeBox3').val("")
          $('#codeBox4').val("") 
          $('.second-verify-btn').show()
          $('.verify-btn button').hide();

        if(response.is_verify == 1){
          localStorage.setItem('final_verify',true)

          $('.second-verify-btn').hide()
          $('.verify-btn button').show();
          $('.verify-btn button').prop('disabled',true);
          $('#OTP-popups').modal("hide")

          isVerify = true;
          localStorage.setItem('isVerify',isVerify);
          $('#item_place_order').prop("disabled",false)
        }else{
          isVerify = false;
          localStorage.setItem('isVerify',isVerify);
          $('#item_place_order').prop("disabled",true)
          $('.invalid_otp').text("Invalid OTP.").css({'display':'block','font-size': '13px','color': 'red'}).delay(3000).fadeOut();
        }
        }
      });
    }else{
      isVerify = false;
    
      localStorage.setItem('isVerify',isVerify);

      $('#item_place_order').prop("disabled",true)
      $('.invalid_otp').text("Invalid OTP.").css({'display':'block','font-size': '13px','color': 'red'}).delay(2000).fadeOut();
    }
    $('#otp-verify-btn').hide();
  }, 2000);
})




 
