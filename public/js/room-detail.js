var isSubmit = true;
var isVerify = false;

var check_in = localStorage.getItem("check-in") == "" ? '' : localStorage.getItem("check-in");
var check_out = localStorage.getItem("check-out") == "" ? '' : localStorage.getItem("check-out");
var category = localStorage.getItem("category") == "" ? '' : localStorage.getItem("category");

l_room_guest = (localStorage.getItem("room-guest") != null) ? localStorage.getItem("room-guest").split(' - ') : '';
l_room = (l_room_guest != '') ? l_room_guest[0].split(' Room') : '';
l_guest = (l_room_guest != '') ? l_room_guest[1].split(' Guest') : '';

$('.room').val(l_room[0])
$('.guest').val(l_guest[0])
$('.check-in').val(check_in)
$('.check-out').val(check_out)


const meal_arr = [];
const meal_item = [];
const food_type = [];


if (localStorage.getItem('food_type') != null && localStorage.getItem('meal_arr') != null) {
    var foodies = localStorage.getItem('food_type');
    var rupee_arr = localStorage.getItem('meal_arr');
    var length = foodies.split(',').length

    $('.enjoy-meals-during').each(function (key1, value1) {
        if ($(value1).find("h6>span").attr("data-foodtype") != undefined) {
            if (foodies.split(',')[0] == $(value1).find("h6>span").attr("data-foodtype"))
                $(value1).find("button").addClass("active")
            if (foodies.split(',')[1] == $(value1).find("h6>span").attr("data-foodtype"))
                $(value1).find("button").addClass("active")
            if (foodies.split(',')[2] == $(value1).find("h6>span").attr("data-foodtype"))
                $(value1).find("button").addClass("active")

        } else {
            if (foodies.split(',')[0] == $(value1).find("h6>select").attr("data-foodtype"))
                $(value1).find("button").addClass("active")
            if (foodies.split(',')[1] == $(value1).find("h6>select").attr("data-foodtype"))
                $(value1).find("button").addClass("active")
            if (foodies.split(',')[2] == $(value1).find("h6>select").attr("data-foodtype"))
                $(value1).find("button").addClass("active")

        }
    })

    var loop = 0;
    while (loop < length) {
        meal_arr.push(rupee_arr.split(',')[loop]);
        food_type.push(foodies.split(',')[loop]);

        meal_item.push(
            { "key": foodies.split(',')[loop], "value": rupee_arr.split(',')[loop] },
        );
        loop++;
    }

}


//validation of room and guest an childrens start
$('.guest').on('blur', function () {
    console.log("guest");
    var children = $('.children').val();
    var total_needed_room = $('.room').val();
    var returnData = checkValidGuestInRoom($('.guest').val(), total_needed_room, children);
    isSubmit = returnData;
    // var key = event.keyCode || event.charCode;

    var per_room_person = $('.setting_person').text();
    per_room_person = (Number(per_room_person) + 1) * total_needed_room;

    var no_of_rooms_is_avail = $('.no_of_avail_rooms').text()
    var category = $('.category-title').text();

    var per_room_childrens_allowed = $('.per_room_childrens_allowed').text();
    var max_allowed_child = parseInt($('.room').val()) * per_room_childrens_allowed;

    showValidationMessage(isSubmit, per_room_person, no_of_rooms_is_avail, category, max_allowed_child);

});

$('.room').on('blur', function () {
    var children = $('.children').val();
    var guest = $('.guest').val();
    var returnData = checkValidGuestInRoom(guest, $('.room').val(), children);
    isSubmit = returnData;
    var key = event.keyCode || event.charCode;

    var per_room_person = $('.setting_person').text();
    per_room_person = (Number(per_room_person) + 1) * parseInt($('.room').val());


    var no_of_rooms_is_avail = $('.no_of_avail_rooms').text()
    var category = $('.category-title').text();

    var per_room_childrens_allowed = $('.per_room_childrens_allowed').text();
    var max_allowed_child = parseInt($('.room').val()) * per_room_childrens_allowed;

    showValidationMessage(isSubmit, per_room_person, no_of_rooms_is_avail, category, max_allowed_child);

});

$('.children').on('blur', function () {
    var returnData = checkValidGuestInRoom($('.guest').val(), $('.room').val(), $('.children').val());
    isSubmit = returnData;
    var key = event.keyCode || event.charCode;
    var per_room_person = $('.setting_person').text();
    per_room_person = (Number(per_room_person) + 1) * parseInt($('.room').val());

    var no_of_rooms_is_avail = $('.no_of_avail_rooms').text()
    var category = $('.category-title').text();

    var per_room_childrens_allowed = $('.per_room_childrens_allowed').text();
    var max_allowed_child = parseInt($('.room').val()) * per_room_childrens_allowed;

    showValidationMessage(isSubmit, per_room_person, no_of_rooms_is_avail, category, max_allowed_child);
});
//validation of room and guest an childrens end


//kahan or meal data selection 
khana_arr = [];
khanatype = [];

$('#breakfast_select').on('click', function () {

    if (khanatype.indexOf("Breakfast") == 0) {
        $(this).removeClass("active");
        khana_arr[0] = '';
        khanatype[0] = '';
    } else {
        $(this).addClass("active");
        khana_arr[0] = { 'key': 'Breakfast', 'value': $('.first_meal_price').text() }
        khanatype[0] = 'Breakfast';
    }
})

$('#lunch_select').on('click', function () {
    if (khanatype.indexOf("Lunch") == 1) {
        $('#lunch_select').removeClass("active");
        khana_arr[1] = '';
        khanatype[1] = '';
    } else {
        $('#lunch_select').addClass("active");
        khana_arr[1] = { 'key': 'Lunch', 'value': $('.second_meal_price').val().split(" ")[0].split("Rs.")[1] }
        khanatype[1] = 'Lunch';
    }
})

$('#dinner_select').on('click', function () {
    if (khanatype.indexOf("Dinner") == 2) {
        $('#dinner_select').removeClass("active");
        khana_arr[2] = '';
        khanatype[2] = '';
    } else {
        $('#dinner_select').addClass("active");
        khana_arr[2] = { 'key': 'Dinner', 'value': $('.third_meal_price').val().split(" ")[0].split("Rs.")[1] }
        khanatype[2] = 'Dinner';
    }
})


$('.select-rs-lunch').on('change', function () {
    $('#lunch_select').removeClass("active");
    khana_arr[1] = '';
    khanatype[1] = '';
});

$('.select-rs-dinner').on('change', function () {
    $('#dinner_select').removeClass("active");
    khana_arr[2] = '';
    khanatype[2] = '';
});


console.log(khanatype);

//set date
$('.check-in').on('change', function () {
    startdate = $(this).val()
    $('.check-out').val(moment(startdate).add(1, 'days').format("YYYY-MM-DD"))
    $('.check-out').attr("min", moment(startdate).add(1, 'days').format("YYYY-MM-DD"));

    getAvailsRooms(startdate);
});

$('.check-out,.check-in').on('change', function () {
    enddate = $('.check-out').val()
    startdate = $('.check-in').val()

    if (startdate < moment().format('YYYY-MM-DD') || startdate > moment().add(2, 'months').format('YYYY-MM-DD')) {
        $('.check-in-error').show()
        $('.check-in-error').text("Start Date cannot be before Today Date or can not be after 2 months.").css({ 'display': 'block', 'font-size': '13px', 'color': 'red' });
        $('#complete-room-reservation-btn').prop("disabled", true)
    }

    if (enddate < moment().format('YYYY-MM-DD') || enddate > moment().add(2, 'months').add(1, 'days').format('YYYY-MM-DD')) {
        $('.check-out-error').text("End Date cannot be before Today Date or can not be before 2 months.").css({ 'display': 'block', 'font-size': '13px', 'color': 'red' });
        $('#complete-room-reservation-btn').prop("disabled", true)
    }

    if ((startdate >= moment().format('YYYY-MM-DD') && startdate <= moment().add(2, 'months').format('YYYY-MM-DD')) || (enddate >= moment().format('YYYY-MM-DD') && enddate <= moment().add(2, 'months').add(1, 'days').format('YYYY-MM-DD'))) {
        $('.check-out-error').hide();
        $('.check-in-error').hide();
        $('#complete-room-reservation-btn').prop("disabled", false)
    }
});


$('.hidden_room').val(1);
$('.hidden_guests').val(1);
 
//complete reservation click script
$(document).on('click', '#complete-room-reservation-btn', function (e) {

    var isSubmit = checkValidGuestInRoom($('.guest').val(), $('.room').val(), $('.children').val());
    var isValidate = $('#CheckoutRoomBook').validationEngine('validate');

    if (isValidate == false) {
    } else if (grecaptcha.getResponse() == "") {
        e.preventDefault();
        $('#recaptchaError').text("Proof that you are not a robot.").show()
    } else if (isValidate == true && isSubmit == true) {
        var auth_data = $('.is_auth_check').val();

        console.log(auth_data);
        let new_khana_arr = khana_arr.filter((a) => a);

        localStorage.setItem('food_type', food_type)
        localStorage.setItem('meal_arr', meal_arr)

        if ((auth_data != true || auth_data != 1) && isVerify == false) {
            $('#unsuccess-popups .errormessage').text('Please Verify Your Phone Number');
            $('#unsuccess-popups').modal('show');
        } else {
            var checkin = $('.check-in').val();
            var checkout = $('.check-out').val();
            var room_category_filter = $('.room_category').val();
            var room = $('.room').val();
            var room_id = $('.room_id').val();
            var guest = $('.guest').val();

            //if (auth_data != true || auth_data != 1) {
            $('.customerName').val($('.first_name').val())
            $('.customerEmail').val($('#checkout-email').val())
            $('.customerPhone').val($('#checkout-phone').val())

            localStorage.setItem('customerName', $('.first_name').val());
            localStorage.setItem('customerEmail', $('#checkout-email').val());
            localStorage.setItem('customerPhone', $('#checkout-phone').val());

            //}

            var customerName = $('.customerName').val()
            var customerEmail = $('.customerEmail').val()
            var customerPhone = $('.customerPhone').val()
            var salutation = $('input[name="salutation"]:checked').val()
            var randomstr = $('#randomstr').val();


            const date1 = new Date($('.check-in').val());
            const date2 = new Date($('.check-out').val());
            const diffTime = Math.abs(date2 - date1);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            $.ajax({
                url: $('.submit-book-now').data('submitbooknowurl'),
                type: "POST",
                data: { checkin: checkin, checkout: checkout, room_category_filter: room_category_filter, room: room, room_id: room_id, guest: guest, name: customerName, email: customerEmail, phone: customerPhone, salutation: salutation, children: $('.children').val(), randomstr: randomstr },
                success: function (response) {

                    if (response.status == "available") {
                        //meal amount
                        let sum = 0;
                        var active_length = $('.enjoy-meals-during button.active').length;

                        if (active_length <= 3 && meal_arr.length != 0) {
                            for (let i = 0; i < meal_arr.length; i++) {
                                sum += parseInt(meal_arr[i]);
                            }
                        }
                        //(sum * guest) because of meal for how many peoples
                        let total_amount = (sum * guest) + (diffDays * parseInt($('.amountofroom').attr('room-amount')) * parseInt($('.room').val()));

                        let totalAmount = total_amount
                        let room_id = $('.room_id').val();
                        let room_category = $('.room_category').val();
                        let room_shift = "night";
                        let per_shift_price = $('.per_person_price').text();
                        let room_title = $('.category-title').text();
                        let children = $('.children').val()
                        let total_meal_amount = sum;
                        let food_items = new_khana_arr;

                        let salutation = $('input[name="salutation"]:checked').val()

                        let email = $('#checkout-email').val()
                        let phone = $('#checkout-phone').val()
                        let tandc = $('input[name="accepttc"]:checked').val()
                        $('#payuprice').val(totalAmount);

                        var room_image = '<?php echo $room_image; ?>';

                        //temporary checkout ajax
                        $.ajax({
                            url: $('.save-room-temp-checkout').data('saveroomtempcheckout'),
                            type: "POST",
                            data: { customerName: customerName, customerEmail: customerEmail, customerPhone: customerPhone, totalAmount: totalAmount, room_id: room_id, room_category: room_category, room_shift: room_shift, per_shift_price: per_shift_price, room_title: room_title, checkin: checkin, checkout: checkout, room: room, guest: guest, children: children, salutation: salutation, room_image: room_image, total_meal_amount: total_meal_amount, food_items: food_items, diffDays: diffDays, meal_arr: meal_arr },
                            success: function (response) {
                                orderid = response.last_inserted_id;

                                $('#orderId').val(orderid);
                                window.location.href = $('.room-checkout-url').data('roomcheckouturl') + '/' + btoa(orderid);
                            }
                        })
                    } else if (response.status == "un-available") {
                        $('#unsuccess-popups .errormessage').text('Room Not available with this details.');
                        $('#unsuccess-popups').modal('show');
                    } else if (response.status == "validation-issue") {
                        $('#unsuccess-popups .errormessage').text('Please fill all fields.');
                        $('#unsuccess-popups').modal('show');
                    } else if (response.status == "incorrect-date") {
                        $('#unsuccess-popups .errormessage').text('You have enter wrong Date.');
                        $('#unsuccess-popups').modal('show');
                    } else if (response.status == "incorrect-phone") {
                        $('#unsuccess-popups .errormessage').text('Phone number is mismatched');
                        $('#unsuccess-popups').modal('show');
                    } else if (response.status == "invalid-room-guest") {
                        $('#unsuccess-popups .errormessage').text('you have entered wrong data for guest or room.');
                        $('#unsuccess-popups').modal('show');
                    } else if (response.success == "invalid-children") {
                        $('#unsuccess-popups .errormessage').text('Childrens is reached the limitation of allowed Childrens for Room.');
                        $('#unsuccess-popups').modal('show');
                    } else {
                    }
                }
            });
        }
    } else {
        var per_room_person = $('.setting_person').text();
        per_room_person = Number(per_room_person) + 1;

        var no_of_rooms_is_avail = $('.no_of_avail_rooms').text()
        var category = $('.category-title').text();

        var per_room_childrens_allowed = $('.per_room_childrens_allowed').text();
        var max_allowed_child = parseInt($('.room').val()) * per_room_childrens_allowed;

        showValidationMessage(isSubmit, per_room_person, no_of_rooms_is_avail, category, max_allowed_child);
    }

});


function checkValidGuestInRoom(guest, total_needed_room, children) {

    var total_avail_rooms = $('.per_room_person').text();
    var per_room_person = $('.setting_person').text();
    var no_of_avail_rooms = $('.no_of_avail_rooms').text();
    var per_room_childrens_allowed = $('.per_room_childrens_allowed').text();

    var total_persons = parseInt(per_room_person) * parseInt(total_needed_room);
    var max_person_room = (parseInt(per_room_person) + 1) * parseInt(total_needed_room);
    var guest = parseInt(guest);

    var max_allowed_guest = guest;
    var min_allowed_guest = Math.ceil(max_allowed_guest / (parseInt(per_room_person) + 1));


    var min_allowed_child = 0;
    var max_allowed_child = total_needed_room * per_room_childrens_allowed;

    if ((parseInt(total_needed_room) <= parseInt(no_of_avail_rooms.trim())) && parseInt(guest) <= parseInt(max_person_room) && (parseInt(total_needed_room) <= parseInt(max_allowed_guest) && parseInt(total_needed_room) >= parseInt(min_allowed_guest)) && parseInt(children) <= max_allowed_child) {
        return true;
    } else if (parseInt(total_needed_room) > parseInt(no_of_avail_rooms.trim())) {
        return "take_greater_room";
    } else if (guest > max_person_room) {
        return "take_greater_guest";
    } else if (parseInt(total_needed_room) > parseInt(max_allowed_guest)) {
        return "take_lesser_guest";
    } else if (parseInt(children) > max_allowed_child) {
        return "take_greater_children";
    } else {
    }
}


function showValidationMessage(isSubmit, per_room_person, no_of_rooms_is_avail, category, max_allowed_child) {
    if (isSubmit == "take_greater_guest") {
        $('#unsuccess-popups .errormessage').text('Sorry! Maximum ' + per_room_person + ' Guests allowed in ' + $('.room').val() + ' Room.');
        $('#unsuccess-popups').modal('show');
    }

    if (isSubmit == "take_greater_room") {
        if (no_of_rooms_is_avail == 0)
            var message = category + ' not available right now.';
        else
            var message = 'Only <span style="font-size: 18px;">' + no_of_rooms_is_avail + '</span> ' + category + ' available right now.';

        $('#unsuccess-popups .errormessage').html(message);
        $('#unsuccess-popups').modal('show');
    }

    if (isSubmit == "take_lesser_guest") {
        $('#unsuccess-popups .errormessage').html('Sorry! Minimum 1 Guest is compulsory for each Room.');
        $('#unsuccess-popups').modal('show');
    }

    if (isSubmit == "take_greater_children") {
        $('#unsuccess-popups .errormessage').html('Sorry! Maximum ' + max_allowed_child + ' Childrens allowed for ' + $('.room').val() + ' Rooms.');
        $('#unsuccess-popups').modal('show');
    }

}

function getAvailsRooms(checkindate) {

    $.ajax({
        url: $('.fetch-avail-room').data('fetchavailroom') + '/' + $('.room_id').val() + '/' + checkindate,
        type: "get",
        success: function (response) {
            localStorage.setItem("per_room_price", response.avails_price);

            (response.avails_room == 0) ? $('.no_room_avail_error_msg').removeClass('d-none') : $('.no_room_avail_error_msg').addClass('d-none');

            $('.no_of_avail_rooms').text(response.avails_room)
            $('.room_date_wise_price span').text(response.avails_price);
            if (response.old_price != null && response.off_percentage != null) {
                $('.room_date_wise_price small').css('display', 'inline').html('<strike><i class="fa fa-rupee"></i> ' + response.old_price + ' </strike><span class="price-offers">' + response.off_percentage + '% off</span>');
            }
            $('.room_date_wise_price .amountofroom').attr("room-amount", response.avails_price)
        }
    })
}



//otp input box script
function getCodeBoxElement(index) {
    return document.getElementById('codeBox' + index);
}
function onKeyUpEvent(index, event) {
    const eventCode = event.which || event.keyCode;
    if (getCodeBoxElement(index).value.length === 1) {
        if (index !== 4) {
            getCodeBoxElement(index + 1).focus();
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


//OTP script

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

$('.verify-btn button').click(function () {
    sendOTPFunction();
});

function sendOTPFunction() {
    var phone_number = $('#checkout-phone').val();
    if (phone_number.length == 0) {
        $('.phone_error').text("Phone Number field is required.").css({ 'display': 'block', 'color': 'red', 'font-size': '13px', 'position': 'absolute', 'top': '50px' }).delay(2000).fadeOut();
    } else if (phone_number.length < 10 || phone_number.length != 10) {
        $('.phone_error').text("Enter Valid Phone Number.").css({ 'display': 'block', 'color': 'red', 'font-size': '13px' }).delay(2000).fadeOut();
    } else {


        $.ajax({
            url: $('.send-otp-url').data('sendotp'),
            type: 'get',
            data: {
                data: phone_number,
                url_str: "room"
            },
            success: function (response) {
                console.log(response);
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
}

$('.edit-input-group-append').click(function () {
    document.getElementById("checkout-phone").readOnly = false;
    $('.verify-btn button').show();
    $('.second-verify-btn').hide();
    $('.otp-input').hide();
    $('.otp-input .passcode-wrapper input').val("");
    $('.resend-otp-btn').hide()
    localStorage.setItem("resent_otp", true)
    $("#ten-countdown").remove();
});


$('.second-verify-btn .verify-btn').click(function () {
    $('.verify-spinner-border').show();
    setTimeout(() => {
        var otp = $('#codeBox1').val() + $('#codeBox2').val() + $('#codeBox3').val() + $('#codeBox4').val()
        if (otp.length == 4) {

            console.log("otp verify");
            $.ajax({
                url: $('.verify-opt-url').data('verifyopturl'),
                type: 'get',
                data: {
                    codeBox: otp,
                    number: $('#checkout-phone').val()
                },
                success: function (response) {
                    console.log(response);
                    if (response.is_verify == 1) {
                        $('.otp-input').hide()
                        $('.second-verify-btn').hide()
                        $('.resend-otp').hide();
                        $('.verify-btn button').show();
                        $('.verify-btn button').prop('disabled', true);
                        $('.verify-btn button').text('verified');
                        $('.edit-input-group-append').hide();
                        document.getElementById("checkout-phone").readOnly = true;
                        isVerify = true;
                        $('#checkout-phone').prop('disabled', true);
                        $('#randomstr').val(response.randomstr);
                        $("#ten-countdown").remove();

                        //remove validaion for verify number
                        $("#CheckoutRoomBook .remaining-box").removeClass("remaining-box")
                        $('.remaining-fields').removeClass("remaining-fields")

                    } else {
                        isVerify = false;
                        $('#invalid_otp').text("Invalid OTP.").css({ 'display': 'block', 'font-size': '13px', 'color': 'red' }).delay(3000).fadeOut();
                    }
                }
            });
        } else {
            isVerify = false;
            $('#invalid_otp').text("Invalid OTP.").css({ 'display': 'block', 'font-size': '13px', 'color': 'red' }).delay(2000).fadeOut();
        }
        $('.verify-spinner-border').hide();
    }, 2000);
})
