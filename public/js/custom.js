// Menu Toggle In Mobile Start
$(".navbar-toggler").click(function () {
    $(".navbar-collapse").addClass("show-menu");
    $("body").addClass("overflow-body");
});

$(".mobile-menu-close, .navbar-collapse:after").click(function () {
    $(".navbar-collapse").removeClass("show-menu");
    $("body").removeClass("overflow-body");
});
// Menu Toggle In Mobile End

$(window).scroll(function () {
    var scroll = $(window).scrollTop();

    if (scroll >= 50) {
        $(".web_header").addClass("stiky-header");
    } else {
        $(".web_header").removeClass("stiky-header");
    }
});


function getCodeBoxElement(e) {
    return document.getElementById("codeBox" + e)
}

function onKeyUpEvent(e, o) {
    let t = o.which || o.keyCode;
    1 === getCodeBoxElement(e).value.length && (4 !== e ? getCodeBoxElement(e + 1).focus() : (getCodeBoxElement(e).blur(), console.log("submit code "))), 8 === t && 1 !== e && getCodeBoxElement(e - 1).focus()
}
function onFocusEvent(e) {
    for (item = 1; item < e; item++) {
        let o = getCodeBoxElement(item);
        if (!o.value) {
            o.focus();
            break
        }
    }
}

$(document).ready(function () {

    var isSubmit = true;
    var isVerify = false;

    localStorage.setItem('isVerify', isVerify);
    localStorage.setItem("resent_otp", false)

    var current_url = window.location.href;

    var url_str = current_url.split('/').pop()
    $('.resend-otp-btn').hide();


    $('.verify-btn button').click(function () {
        sendOTPFunction();
    });

    $('.resend-otp-btn').click(function (evt) {

        $('.resend-spinner-border').show();
        setTimeout(() => {
            $('.resend-spinner-border').hide();
            $('.otp-input .passcode-wrapper input').val("");
            $('.resend-otp-btn').hide();
            $('.countdown').removeClass("d-none");
            localStorage.setItem("resent_otp", true)
            sendOTPFunction();

            $('#valid_otp').text("Successfully send new OTP.").css({ 'display': 'block', 'font-size': '13px', 'color': 'green' }).delay(3000).fadeOut();
        }, 1000);

    });

    function sendOTPFunction() {
        var phone_number = $('#checkout-phone').val();
        if (phone_number.length == 0) {
            $('.p_err').text("Phone Number is required.").css({ 'display': 'block', 'color': 'red', 'font-size': '13px', 'position': 'absolute', 'top': '50px' }).delay(2000).fadeOut();
        } else if (phone_number.length < 10 || phone_number.length != 10) {
            $('.p_err').text("Enter Valid Phone Number.").css({ 'display': 'block', 'color': 'red', 'font-size': '13px', 'position': 'absolute', 'top': '50px' }).delay(2000).fadeOut();
        } else {

            $('.verify-spinner-border').show()
            $.ajax({
                // url: "register/data",
                url: $('.send-otp-url').data('sendotp'),
                type: 'get',
                data: {
                    data: $('#checkout-phone').val(),
                    url_str: url_str
                },
                success: function (response) {
                    $('.verify-spinner-border').hide()
                    if (response['status'] == 500) {
                        isVerify = false

                        $('#invalid_otp').text(response['error']);
                        $('#invalid_otp').css({ 'font-size': '13px', 'color': 'red' }).show();
                        setTimeout(function () {
                            $("#invalid_otp")
                                .hide();
                        }, 3000);
                    } else {
                        $(".resend-otp").show();
                        $(".passcode-wrapper").show();
                        document.getElementById("checkout-phone").readOnly = true;
                        $('.passcode-wrapper').show()
                        $('.second-verify-btn').show()

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
        $('.passcode-wrapper').hide();
        $('.otp-input .passcode-wrapper input').val("");
        $('.resend-otp-btn').hide();
        localStorage.setItem("resent_otp", false)
        $("#ten-countdown").remove();
    });

    $('.second-verify-btn .verify-btn').click(function () {
        $('.verify-spinner-border').show();
        setTimeout(() => {
            var otp = $('#codeBox1').val() + $('#codeBox2').val() + $('#codeBox3').val() + $('#codeBox4').val()
            if (otp.length == 4) {

                $.ajax({
                    // url: "register/data/otp",
                    url: $('.verify-otp-url').data('verifyotpurl'),
                    type: 'get',
                    data: {
                        codeBox: otp,
                        number: $('#checkout-phone').val()
                    },
                    success: function (response) {
                        if (response.is_verify == 1) {
                            $('.passcode-wrapper').hide()
                            $('.second-verify-btn').hide()
                            $('.resend-otp').hide();
                            $('.verify-btn button').show();
                            $('.verify-btn button').prop('disabled', true);
                            $('.verify-btn button').text('verified');
                            $('.verify-btn').parent().addClass("mb-3");
                            $('.edit-input-group-append').hide();
                            document.getElementById("checkout-phone").readOnly = true;
                            isVerify = true;
                            localStorage.setItem('isVerify', isVerify);

                            $("#ten-countdown").remove();
                        } else {
                            isVerify = false;
                            localStorage.setItem('isVerify', isVerify);

                            $('#invalid_otp').text("Invalid OTP.").css({ 'display': 'block', 'font-size': '13px', 'color': 'red' }).delay(3000).fadeOut();
                        }
                    }
                });
            } else {
                isVerify = false;
                localStorage.setItem('isVerify', isVerify);

                $('#invalid_otp').text("Invalid OTP or Please resend OTP.").css({ 'display': 'block', 'font-size': '13px', 'color': 'red' }).delay(2000).fadeOut();
            }
            $('.verify-spinner-border').hide();
        }, 2000);
    })

    //remove validation error message on keyup 
    $("input").on('keyup keypress', function () {
        if ($(this).attr('name') == "first_name") {
            $('.f_err').hide();
        }
        if ($(this).attr('name') == "last_name") {
            $('.l_err').hide();
        }
        if ($(this).attr('name') == "email") {
            $('.e_err').hide();
        }
        if ($(this).attr('name') == "phone_number") {
            $('.p_err').hide();
        }
    })

    $('.phone').on('keypress keyup', function (e) {
        var charCode = (e.which) ? e.which : event.keyCode
        if (String.fromCharCode(charCode).match(/[^0-9]/g))
            return false;
    });


    //Read More and Less
    $('.read-more-content').addClass('hide_content')
    $('.read-more-show, .read-more-hide').removeClass('hide_content')

    // Set up the toggle effect:
    $('.read-more-show').on('click', function (e) {
        $(this).next('.read-more-content').removeClass('hide_content');
        $(this).addClass('hide_content');
        e.preventDefault();
    });
    $('.read-more-hide').on('click', function (e) {
        var p = $(this).parent('.read-more-content');
        p.addClass('hide_content');
        p.prev('.read-more-show').removeClass('hide_content'); // Hide only the preceding "Read More"
        e.preventDefault();
    });

});

function showSuccess(message) {
    $('.successMassage').text(message);
    setTimeout(function () {
        $(".successMassage").hide();
    }, 5000);
}




