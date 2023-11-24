function countFinalPrice() {
  let totalamt = 0;
  let net_total = 0;

  totalamt = parseFloat($('#subtotal_amt').val());

  tax_default = $('#settingdata').data('taxrate');
  $('#subtotal').html('<i class="fa fa-rupee"></i>' + totalamt.toFixed(2));
  let total_tax_amt = (totalamt * tax_default) / 100;
  $('#subtotal_amt').val(totalamt.toFixed(2));
  $('#subtotal_taxes').val(total_tax_amt.toFixed(2));
  $('#total_taxes').html('<i class="fa fa-rupee"></i>' + total_tax_amt.toFixed(2));

  $('.calculate_grand_total_amount').each(function (index) {
    net_total += parseFloat($(this).val());
  })
  $('#net_total_amt').val(net_total);
  $('.net_total').html('<i class="fa fa-rupee"></i>' + net_total.toFixed(2));

  let promocode_deduction = $('#promocode_deduction').val();

  payment_options = $('#payment_options').val();
  let final_amt = 0;

  net_total = ((net_total * payment_options) / 100).toFixed(2);
  final_amt = (net_total - parseFloat(promocode_deduction));

  console.log("grand total", final_amt);

  //new work
  if ($('.additional_charges').hasClass('minus_amount'))
    final_amt = final_amt - parseInt($('.minus_amount').text().trim());

  if ($('.additional_charges').hasClass('additional_amount'))
    final_amt = final_amt + parseInt($('.additional_amount').text().trim())

  //new work

  final_amt = parseFloat(final_amt).toFixed(2);

  if (final_amt <= 0) {
    final_amt = '0.00';
    $('#payment_options').attr('disabled', 'disabled');
  } else {
    $('#payment_options').removeAttr('disabled');
  }

  $('.gr_total').html('<i class="fa fa-rupee"></i>' + final_amt);
  $('#grand_total_amt').val(final_amt);
  $('#f_total_amt').val(final_amt);
  $('#payuprice').val(final_amt);

  console.log("grand total", final_amt);
}


function applyCoupon(coupon_code, typeofdiscount) {

  if (coupon_code == '') {
    $('#pcode-error').html('Please enter code first.');
    return false;
  } else {
    $("#payment_options").val(100);
    countFinalPrice();

    var order_id = Math.floor(Date.now() / 1000) + '-' + $('#settingdata').data('orderid');

    $.ajax({
      url: $('#settingdata').data('apcodeurl'),
      type: "post",
      data: { coupon_code: coupon_code, net_total_amt: $('#f_total_amt').val(), no_of_rooms: $('.no_of_rooms span').text(), roomcategory: $('#settingdata').data('roomcat'), checkin: $('.checkout-checkin-date').text(), checkout: $('.checkout-checkout-date').text(), order_id: order_id },
      success: function (response) {
        res = JSON.parse(response);

        if (res.status == 'error') {
          $('#pcode-error').html(res.message);
          return false;
        } else {
          //new work
          if ($('#settingdata').data('roomcat') == "deluxe") {
            if (typeofdiscount == "percentage") {


              $('#promocode_amt').html('- <i class="fa fa-rupee"></i>' + (res.dicounted_amt).toFixed(2));
              deductionAmount(coupon_code, "add", 0)
            } if (typeofdiscount == "net") {

              setTimeout(function () {
                $('#subtotal_amt').val(res.net_amount_data.final_amount)
                $('#subtotal_taxes').val(res.net_amount_data.room_tax.toFixed(2))
                $('#grand_total_amt').val(res.net_amount_data.payable_amount)
                $('#f_total_amt').val(res.net_amount_data.payable_amount)
                $('#promocode_deduction').val(res.net_amount_data.promo_amount)
                $('#payuprice').val(parseFloat(res.net_amount_data.payable_amount).toFixed(2))


                $('#subtotal').html('<i class="fa fa-rupee"></i>' + res.net_amount_data.final_amount)
                $('#total_taxes').html('<i class="fa fa-rupee"></i>' + res.net_amount_data.room_tax)
                $('#net_total_amt').val(res.net_amount_data.tax_include_taxes)
                $('.net_total').html('<i class="fa fa-rupee"></i>' + res.net_amount_data.tax_include_taxes)
                $('#promocode_amt').html('- <i class="fa fa-rupee"></i>' + res.net_amount_data.promo_amount)
                $('.gr_total').html('<i class="fa fa-rupee"></i>' + res.net_amount_data.payable_amount)
              }, 300)
            }

            var is_validate_guest = validifGuestInRoom($('.total_guests').data("guests"), $('.no_of_rooms span').text())
            if (is_validate_guest == "lesser_guest") {
              $('.additional_persons_charges').hide(); //$('.extra_persons_charges').hide(); 
            }

            var values = [0, 25];
            $.each(values, function (k, v) {
              $('#payment_options option[value=' + v + ']').prop('disabled', true);
            });
          }

          $('#coupon_code').val('');
          $('#pcode-error').html('');
          $('#promocodeModal').modal('hide');
          $('#promocode_deduction').val(res.dicounted_amt);
          $('#promocode').val(coupon_code);

          $('#promocode_amt').html('- <i class="fa fa-rupee"></i>' + res.dicounted_amt)

          $('#promosuccmsg').html(res.message + `<span style="color:#ff3100;cursor:pointer;font-size:13px;float: right;" onclick="removePromocode('${coupon_code}','${typeofdiscount}')">Remove <i class="fa fa-times"></i></span>`);
          countFinalPrice();
        }
      }
    })
  }
}

function removePromocode(res, coupon_code) {
  //new work
  deductionAmount(coupon_code, "remove", 0)
  var values = [0, 25];
  $.each(values, function (k, v) {
    $('#payment_options option[value=' + v + ']').prop('disabled', false);
  });

  $("#payment_options").val(100);

  if ($('#payment_options').val() == 100) {
    $('.place-order-sec #item_place_order').text('Book Now')
  } else {
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
function deductionAmount(coupon_code, whichcase, reward_amount) {

  $.ajax({
    url: $('#settingdata').attr('data-deductionurl'),
    type: "post",
    data: { coupon_code: coupon_code, no_of_rooms: $('.room').text(), roomcategory: $('#settingdata').data('roomcat'), checkin: $('.checkout-checkin-date').text(), checkout: $('.checkout-checkout-date').text(), guest: $('.total_guests').data("guests"), orderid: window.location.pathname.split('/').pop(), case: whichcase, reward_amount: reward_amount },
    success: function (response) {

      $('#subtotal_amt').val(response.final_amount)
      $('#subtotal_taxes').val(response.room_tax.toFixed(2))
      $('#grand_total_amt').val(response.payable_amount)
      $('#f_total_amt').val(response.payable_amount)
      $('#promocode_deduction').val(response.promo_amount)
      $('#payuprice').val(parseFloat(response.payable_amount).toFixed(2))

      $('#subtotal').html('<i class="fa fa-rupee"></i>' + response.final_amount)
      $('#total_taxes').html('<i class="fa fa-rupee"></i>' + (Number.isInteger(response.room_tax)) ? response.room_tax.toFixed(2) : response.room_tax)
      $('#net_total_amt').val(response.tax_include_taxes)
      $('.net_total').html('<i class="fa fa-rupee"></i>' + response.tax_include_taxes)
      $('#promocode_amt').html('-<i class="fa fa-rupee"></i>' + response.promo_amount.toFixed(2))
      $('.gr_total').html('<i class="fa fa-rupee"></i>' + response.payable_amount.toFixed(2))

    }
  });
}

function validifGuestInRoom(guest, total_needed_room) {
  var per_room_person = $('#settingdata').data('perroomperson');
  var no_of_avail_rooms = $('#settingdata').data('noofrooms');

  var total_persons = parseInt(per_room_person) * parseInt(total_needed_room);
  var guest = parseInt(guest);

  if (guest > total_persons) {
    return "greater_guest";
  } else if (guest < total_persons) {
    return "lesser_guest";
  } else {
  }
}

$(document).ready(function () {
  countFinalPrice();

  $(document).on('change', '#payment_options', function () {
    selected_val = parseInt($(this).val());
    grand_amt = $('#grand_total_amt').val();

    new_amt = ((parseFloat(grand_amt) * selected_val) / 100).toFixed(2);

    $('#remaining_total_amt').val(parseFloat(grand_amt) - parseFloat(new_amt));
    $('#f_total_amt').val(new_amt);
    $('.gr_total').html('<i class="fa fa-rupee"></i>' + new_amt);
    $('#payuprice').val(new_amt);

    if (selected_val == 10 || selected_val == 25)
      $('.place-order-sec #item_place_order').text('Book Now & Pay at Hotel')
    else
      $('.place-order-sec #item_place_order').text('Book Now')

  })

  $(document).on('click', '#apply_code', () => {
    applyCoupon($('#coupon_code').val(), 0);
  })

  $(document).on('click', '.coupon_apply', function () {
    applyCoupon($(this).data('coupon'), $(this).data("typeofdiscount"));
  })

  $(document).on('click', '.show_more', function () {
    promoid = $(this).data('id');
    $('.moredata-' + promoid).show();
    $('.showless_' + promoid).show();
    $('.showmore_' + promoid).hide();
  })

  $(document).on('click', '.show_less', function () {
    promoid = $(this).data('id');
    $('.moredata-' + promoid).hide();
    $('.showless_' + promoid).hide();
    $('.showmore_' + promoid).show();
  })

  $(document).on('click', '#item_place_order', () => {


    $('#item-loader').removeClass('d-none')
    $('#item_place_order').prop("disabled", true);
    $('#item_place_order').removeAttr("id");

    let subtotal_amt = $('#subtotal_amt').val();
    let subtotal_taxes = $('#subtotal_taxes').val();
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

    $.ajax({
      url: $('#settingdata').data('tempcheckout'),
      type: "POST",
      data: {
        subtotal_amt: subtotal_amt, subtotal_taxes: subtotal_taxes, net_total_amt: net_total_amt, grand_total_amt: grand_total_amt, f_total_amt: f_total_amt, promocode: promocode, promocode_deduction: promocode_deduction, orderid: orderid, payment_option: $('#payment_options').val(), roomid: roomid, checkindate: checkindate, per_shift_price: per_shift_price
      },
      success: function (response) {

        $.ajax({
          url: $('#settingdata').data('generatehashroom'),
          type: "POST",

          data: { orderId: orderid, customerName: customerName, customerEmail: customerEmail, customerPhone: customerPhone, subtotal_amt: subtotal_amt, subtotal_taxes: subtotal_taxes, net_total_amt: net_total_amt, grand_total_amt: grand_total_amt, promocode: promocode, promocode_deduction: promocode_deduction, roomcat: roomcat, roomid: roomid, payment_options: $('#payment_options').val(), f_total_amt: f_total_amt, checkindate: checkindate },
          success: function (has_res) {

            const obj = JSON.parse(has_res)
            $('#merchantData').val(obj.merchantData);
            $('#signature').val(obj.signature);
            setTimeout(function () {
              if ($('#payment_options').val() == 0) {
                $.ajax({
                  url: $('#settingdata').data('zerocheckout'),
                  type: "post",
                  data: { orderId: orderid, orderAmount: grand_total_amt },
                  success: function (response) {
                    responseData = JSON.parse(response);
                    if (responseData.status == 'success') {
                      window.location.href = '/book.thetradefair/public/room-payment-summary/' + responseData.txnid;
                    }
                  }
                })
              } else {
                if (grand_total_amt <= 0) {
                  $.ajax({
                    url: $('#settingdata').data('zerocheckout'),
                    type: "post",
                    data: { orderId: orderid, orderAmount: grand_total_amt },
                    success: function (response) {
                      responseData = JSON.parse(response);
                      if (responseData.status == 'success') {
                        window.location.href = '/book.thetradefair/public/room-payment-summary/' + responseData.txnid;
                      }
                    }
                  })
                } else {
                  $('#checkout_form').submit();
                }
              }

            }, 800)
          }
        });
      }
    })
  })

})


