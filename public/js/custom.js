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

    // function sendOTPVerify(){

    //         console.log("sendOTPVerify");
    //     localStorage.setItem("resent_otp", true)

    //     $.ajax({
    //         url: "register/data",
    //         type: 'get',
    //         data: {
    //             data: $('#Phone-Number').val(),
    //             url_str: url_str
    //         },
    //         success: function (response) {

    //             if (response.status == 500) {
    //                 $('#invalid_otp').text(response['error']);
    //                 $('#invalid_otp').show();
    //             } else {


    //                 showSuccess('OTP sent successfully...');
    //                 // $('.first-verify-btn').hide();
    //                 $(".resend-otp").show();
    //                 $(".passcode-wrapper").show();
    //                 //var varifiyButton = $('#verifyButton').show()

    //                 $('.otp-input .passcode-wrapper input').val("");
    //                 $('.resend-otp-btn').hide()
    //                 $('.countdown').removeClass("d-none");
    //                 // $('.first-verify-btn').show()
    //                 $('#verifyButton').hide()



    //                 // $('#verifyButton').click(function () {
    //                 //     var codeBox1 = $("#codeBox1").val(),
    //                 //         codeBox2 = $("#codeBox2").val(),
    //                 //         codeBox3 = $("#codeBox3").val(),
    //                 //         codeBox4 = $("#codeBox4").val();
    //                 //     var codeBox = codeBox1 + codeBox2 + codeBox3 + codeBox4;
    //                 //     $.ajax({
    //                 //         url: "register/data/otp",
    //                 //         type: 'get',
    //                 //         data: {
    //                 //             codeBox: codeBox,
    //                 //             number: $('#Phone-Number').val()
    //                 //         },
    //                 //         success: function (response) {
    //                 //             if (response['status'] == 500) {
    //                 //                 isSubmit = false
    //                 //                 isVerify = false

    //                 //                 $('#invalid_otp').text(response['error']);
    //                 //                 $('#invalid_otp').show();
    //                 //                 setTimeout(function () {
    //                 //                     $("#invalid_otp")
    //                 //                         .hide();
    //                 //                 }, 3000);
    //                 //             } else {
    //                 //                 isSubmit = true
    //                 //                 isVerify = true;

    //                 //                 localStorage.setItem('isVerify', isVerify);

    //                 //                 $('#verifyButton').hide()
    //                 //                 $('.first-verify-btn').show()
    //                 //                 $(".passcode-wrapper").hide();
    //                 //                 $('.valid_otp').text("Verification Successfully...");
    //                 //                 $('#Phone-Number').prop("readonly", true);
    //                 //                 // $('.resend-url-link').hide();
    //                 //                 $('.resend-otp').hide();
    //                 //                 setTimeout(function () {
    //                 //                     $(".valid_otp")
    //                 //                         .hide();
    //                 //                 }, 3000);
    //                 //                 $('#btn_register').prop(
    //                 //                     "disabled", false);

    //                 //             }
    //                 //         }
    //                 //     });


    //                 // });
    //             }
    //         }
    //     });

    // }

    // $('.resend-otp-btn').click(function (evt) {
    //     sendOTPVerify()
    //     $('#invalid_otp').text("Successfully send new OTP.").css({ 'display': 'block', 'font-size': '13px', 'color': 'green' }).delay(3000).fadeOut();

    //     // localStorage.setItem("resent_otp", true)
    //     // $('.resend-spinner-border').show();
    //     // setTimeout(() => {
    //     //     $('.resend-spinner-border').hide();
    //     //     $('.passcode-wrapper').show();
    //     //     $('.otp-input .passcode-wrapper input').val("");
    //     //     $('.resend-otp-btn').hide()
    //     //     $('.countdown').removeClass("d-none");
    //     //     // $('.first-verify-btn').show()
    //     //     $('#verifyButton').hide()

    //     //     $.ajax({
    //     //         url: $(".resend-url-link").data("url") + $('.phone').val(),
    //     //         type: "get",
    //     //         success: function () { },
    //     //     });

    //     //     $('#invalid_otp').text("Successfully send new OTP.").css({ 'display': 'block', 'font-size': '13px', 'color': 'green' }).delay(3000).fadeOut();

    //     // }, 1000);

    // });

    // $('#submitButton').click(function () {
    //     // $('.otp-input .passcode-wrapper input').val("");

    //     if ($('#Phone-Number').val().length == 0) {
    //         $('.p_err').text("Please enter phone number").css({
    //             'display': 'block'
    //         });
    //     } else if ($('#Phone-Number').val().length != 10) {
    //         $('.p_err').text("Please enter valid phone number").css({
    //             'display': 'block'
    //         });
    //     } else {
    //         $('.p_err').hide();
    //         $('#invalid_otp').hide();

    //         sendOTPVerify()
    //         // localStorage.setItem("resent_otp", true)

    //         // $.ajax({
    //         //     url: "register/data",
    //         //     type: 'get',
    //         //     data: {
    //         //         data: $('#Phone-Number').val(),
    //         //         url_str: url_str
    //         //     },
    //         //     success: function (response) {

    //         //         if (response.status == 500) {
    //         //             $('#invalid_otp').text(response['error']);
    //         //             $('#invalid_otp').show();
    //         //         } else {
    //         //             localStorage.setItem("resent_otp", true)

    //         //             showSuccess('OTP sent successfully...');
    //         //             $('.first-verify-btn').hide();
    //         //             $(".resend-otp").show();
    //         //             $(".passcode-wrapper").show();
    //         //             var varifiyButton = $('#verifyButton').show()


    //         //             // $('#verifyButton').click(function () {
    //         //             //     var codeBox1 = $("#codeBox1").val(),
    //         //             //         codeBox2 = $("#codeBox2").val(),
    //         //             //         codeBox3 = $("#codeBox3").val(),
    //         //             //         codeBox4 = $("#codeBox4").val();
    //         //             //     var codeBox = codeBox1 + codeBox2 + codeBox3 + codeBox4;
    //         //             //     $.ajax({
    //         //             //         url: "register/data/otp",
    //         //             //         type: 'get',
    //         //             //         data: {
    //         //             //             codeBox: codeBox,
    //         //             //             number: $('#Phone-Number').val()
    //         //             //         },
    //         //             //         success: function (response) {
    //         //             //             if (response['status'] == 500) {
    //         //             //                 isSubmit = false
    //         //             //                 isVerify = false

    //         //             //                 $('#invalid_otp').text(response['error']);
    //         //             //                 $('#invalid_otp').show();
    //         //             //                 setTimeout(function () {
    //         //             //                     $("#invalid_otp")
    //         //             //                         .hide();
    //         //             //                 }, 3000);
    //         //             //             } else {
    //         //             //                 isSubmit = true
    //         //             //                 isVerify = true;

    //         //             //                 localStorage.setItem('isVerify', isVerify);

    //         //             //                 $('#verifyButton').hide()
    //         //             //                 $('.first-verify-btn').show()
    //         //             //                 $(".passcode-wrapper").hide();
    //         //             //                 $('.valid_otp').text("Verification Successfully...");
    //         //             //                 $('#Phone-Number').prop("readonly", true);
    //         //             //                 // $('.resend-url-link').hide();
    //         //             //                 $('.resend-otp').hide();
    //         //             //                 setTimeout(function () {
    //         //             //                     $(".valid_otp")
    //         //             //                         .hide();
    //         //             //                 }, 3000);
    //         //             //                 $('#btn_register').prop(
    //         //             //                     "disabled", false);

    //         //             //             }
    //         //             //         }
    //         //             //     });


    //         //             // });
    //         //         }
    //         //     }
    //         // });
    //     }
    // });

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

            $('#invalid_otp').text("Successfully send new OTP.").css({ 'display': 'block', 'font-size': '13px', 'color': 'green' }).delay(3000).fadeOut();
        }, 1000);

    });

    function sendOTPFunction() {
        var phone_number = $('#Phone-Number').val();
        if (phone_number.length == 0) {
            $('.p_err').text("Phone Number is required.").css({ 'display': 'block', 'color': 'red', 'font-size': '13px', 'position': 'absolute', 'top': '50px' }).delay(2000).fadeOut();
        } else if (phone_number.length < 10 || phone_number.length != 10) {
            $('.p_err').html("Enter Valid Phone Number.").css({ 'display': 'block', 'color': 'red', 'font-size': '13px' }).delay(2000).fadeOut();
        } else {

            $('.verify-spinner-border').show()
            $.ajax({
                url: "register/data",
                type: 'get',
                data: {
                    data: $('#Phone-Number').val(),
                    url_str: url_str
                },
                success: function (response) {
                    $('.verify-spinner-border').hide()
                    if (response['status'] == 500) {
                       // isSubmit = false
                        isVerify = false

                        $('#invalid_otp').text(response['error']);
                        $('#invalid_otp').css({'font-size':'13px','color':'red'}).show();
                        setTimeout(function () {
                            $("#invalid_otp")
                                .hide();
                        }, 3000);
                    } else {
                        // $('.first-verify-btn').hide();
                        $(".resend-otp").show();
                        $(".passcode-wrapper").show();

                        //  /$('.passcode-wrapper')
                        // $('.edit-input-group-append').show();
                        document.getElementById("Phone-Number").readOnly = true;
                        $('.otp-input').show()
                        $('.second-verify-btn').show()

                        $('.verify-btn button').hide();
                        localStorage.setItem("resent_otp", true)
                    }
                }
            })
        }
    }


    $('.edit-input-group-append').click(function () {
        document.getElementById("Phone-Number").readOnly = false;
        $('.verify-btn button').show();
        $('.second-verify-btn').hide();
        $('.otp-input').hide();
        $('.otp-input .passcode-wrapper input').val("");
        $('.resend-otp-btn').hide();
        localStorage.setItem("resent_otp", false)
        $("#ten-countdown").remove();
    });

    $('.second-verify-btn .verify-btn').click(function () {
        console.log("second verify btn");
        $('.verify-spinner-border').show();
        setTimeout(() => {
            var otp = $('#codeBox1').val() + $('#codeBox2').val() + $('#codeBox3').val() + $('#codeBox4').val()
            if (otp.length == 4) {
                console.log("second verify btn");
                $.ajax({
                    url: "register/data/otp",
                    type: 'get',
                    data: {
                        codeBox: otp,
                        number: $('#Phone-Number').val()
                    },
                    success: function (response) {
                        console.log("second verify btn");
                        if (response.is_verify == 1) {
                            $('.otp-input').hide()
                            $('.second-verify-btn').hide()
                            $('.resend-otp').hide();
                            $('.verify-btn button').show();
                            $('.verify-btn button').prop('disabled', true);
                            $('.verify-btn button').text('verified');
                            $('.verify-btn').parent().addClass("mb-3");
                            $('.edit-input-group-append').hide();
                            document.getElementById("Phone-Number").readOnly = true;
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


    $("#btn_register").click(function () {
        var eml_reglx = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
 
        if ($('#first-name-field').val().length == 0) {
            $('.f_err').text("Please enter first name").css({
                'display': 'block'
            });
        }
        if ($('#last-name-field').val().length == 0) {
            $('.l_err').text("Please enter last name").css({
                'display': 'block'
            });
        }
        if ($('#email').val().length == 0) {
            $('.e_err').text("Please enter email address").css({
                'display': 'block'
            });
        } else if (!$('#email').val().match(eml_reglx)) {
            $(".e_err").text("Enter Valid Email").css({
                'display': 'block'
            });
        }
        if ($('#Phone-Number').val().length == 0) {
            $('.p_err').text("Please enter phone number").css({
                'display': 'block'
            });
        } else if ($('#Phone-Number').val().length != 10) {
            $('.p_err').text("Please enter valid phone number").css({
                'display': 'block'
            });
        }
        if ($('#flexCheckDefault').prop('checked') == false) {
            $('.tc_err').text("Please accept our policies.").css({
                'display': 'block',
                'color': 'red',
                'font-size': '13px'
            });
        }
        if (grecaptcha.getResponse() == '') {
            $('.gc_err').text("Please confirm that you are not a robot.").css({
                'display': 'block',
                'color': 'red',
                'font-size': '13px'
            });
        }

        if ($('#first-name-field').val().length != 0 && $('#last-name-field').val().length != 10 && $('#email').val().length != 0 && $('#email').val().match(eml_reglx) && isSubmit == true && $('#flexCheckDefault').prop('checked') == true) {

            if (isVerify == false) {
                $('#unsuccess-popups .errormessage').text('Please Verify Your Phone Number');
                $('#unsuccess-popups').modal('show');
            } else {
                $('#registationForm').submit();
                // $('#success-popups .successmessage').text('Register Succesfully');
                Swal.fire({
                    title: 'Success!',
                    text: 'Your request has been submitted successfully.',
                    icon: 'success',
                    timer: 3000, // Show this message for 3 seconds
                    timerProgressBar: true,
                    showConfirmButton: false
                }).then(function () {
                    // Redirect to the desired URL after showing both messages
                    window.location.href = '/thetradefair/public';
                });
            }
        }


    });

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



    $('#banner-slider').owlCarousel({
        // navigation:true
        loop: true,
        nav: true,
        navText: ["<img src='img/slider-left-icon.png'>", "<img src='img/slider-right-icon.png'>"],
        dots: false,
        items: 1,
        autoplay: true,
        smartSpeed: 2000,
        autoplayTimeout: 4000,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            }
        }

    })

    $('#rooms-suites-images-slider').owlCarousel({
        loop: true,
        nav: true,
        navText: ["<img src='img/slider-left-icon.png'>", "<img src='img/slider-right-icon.png'>"],
        dots: false,
        items: 1,
        autoplay: true,
        smartSpeed: 1800,
        autoplayTimeout: 3000,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            }
        }
    })

    $('#restaurants-images-slider').owlCarousel({
        loop: true,
        nav: true,
        navText: ["<img src='img/slider-left-icon.png'>", "<img src='img/slider-right-icon.png'>"],
        dots: false,
        items: 1,
        autoplay: true,
        smartSpeed: 2000,
        autoplayTimeout: 3500,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            }
        }
    })

    $('#meetings-events-images-slider').owlCarousel({
        loop: true,
        nav: true,
        navText: ["<img src='img/slider-left-icon.png'>", "<img src='img/slider-right-icon.png'>"],
        dots: false,
        items: 1,
        autoplay: true,
        smartSpeed: 2200,
        autoplayTimeout: 4000,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            }
        }
    })

    $('#spa-wellness-slider').owlCarousel({
        loop: true,
        nav: true,
        navText: ["<img src='img/slider-left-icon.png'>", "<img src='img/slider-right-icon.png'>"],
        dots: false,
        items: 1,
        autoplay: true,
        smartSpeed: 2400,
        autoplayTimeout: 4400,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            }
        }
    })

    $('#art-artefacts-slider').owlCarousel({
        loop: true,
        nav: true,
        navText: ["<img src='img/slider-left-icon.png'>", "<img src='img/slider-right-icon.png'>"],
        dots: false,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        items: 1,
        autoplay: true,
        smartSpeed: 2000,
        autoplayTimeout: 4000,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            }
        }
    })

    $('#testimonials-slider').owlCarousel({
        loop: true,
        nav: true,
        navText: ["<img src='img/slider-left-icon.png'>", "<img src='img/slider-right-icon.png'>"],
        dots: false,
        items: 1,
        autoplay: true,
        smartSpeed: 2000,
        autoplayTimeout: 4000,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            }
        }
    })

    $('#wedding-hall-slider').owlCarousel({
        loop: true,
        nav: true,
        navText: ["<img src='img/slider-left-icon.png'>", "<img src='img/slider-right-icon.png'>"],
        dots: false,
        items: 1,
        autoplay: true,
        smartSpeed: 2000,
        autoplayTimeout: 4000,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            }
        }
    })

    $('#exp-tim-wed-slider').owlCarousel({
        loop: true,
        margin: 30,
        autoplayHoverPause: true,
        nav: true,
        navText: ['<?xml version="1.0" ?><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;}</style></defs><title/><g data-name="Layer 2" id="Layer_2"><path d="M13,26a1,1,0,0,1-.71-.29l-9-9a1,1,0,0,1,0-1.42l9-9a1,1,0,1,1,1.42,1.42L5.41,16l8.3,8.29a1,1,0,0,1,0,1.42A1,1,0,0,1,13,26Z"/><path d="M28,17H4a1,1,0,0,1,0-2H28a1,1,0,0,1,0,2Z"/></g><g id="frame"><rect class="cls-1" height="32" width="32"/></g></svg>', '<?xml version="1.0" ?><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;}</style></defs><title/><g data-name="Layer 2" id="Layer_2"><path d="M19,26a1,1,0,0,1-.71-.29,1,1,0,0,1,0-1.42L26.59,16l-8.3-8.29a1,1,0,0,1,1.42-1.42l9,9a1,1,0,0,1,0,1.42l-9,9A1,1,0,0,1,19,26Z"/><path d="M28,17H4a1,1,0,0,1,0-2H28a1,1,0,0,1,0,2Z"/></g><g id="frame"><rect class="cls-1" height="32" width="32"/></g></svg>'],
        dots: false,
        items: 3,
        autoplay: true,
        smartSpeed: 2000,
        autoplayTimeout: 5000,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1280: {
                items: 3
            }
        }
    })


    $('#venue-finder-slider').owlCarousel({
        loop: true,
        margin: 30,
        autoplayHoverPause: true,
        nav: true,
        navText: ['<?xml version="1.0" ?><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;}</style></defs><title/><g data-name="Layer 2" id="Layer_2"><path d="M13,26a1,1,0,0,1-.71-.29l-9-9a1,1,0,0,1,0-1.42l9-9a1,1,0,1,1,1.42,1.42L5.41,16l8.3,8.29a1,1,0,0,1,0,1.42A1,1,0,0,1,13,26Z"/><path d="M28,17H4a1,1,0,0,1,0-2H28a1,1,0,0,1,0,2Z"/></g><g id="frame"><rect class="cls-1" height="32" width="32"/></g></svg>', '<?xml version="1.0" ?><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;}</style></defs><title/><g data-name="Layer 2" id="Layer_2"><path d="M19,26a1,1,0,0,1-.71-.29,1,1,0,0,1,0-1.42L26.59,16l-8.3-8.29a1,1,0,0,1,1.42-1.42l9,9a1,1,0,0,1,0,1.42l-9,9A1,1,0,0,1,19,26Z"/><path d="M28,17H4a1,1,0,0,1,0-2H28a1,1,0,0,1,0,2Z"/></g><g id="frame"><rect class="cls-1" height="32" width="32"/></g></svg>'],
        dots: false,
        items: 3,
        autoplay: true,
        smartSpeed: 2000,
        autoplayTimeout: 5000,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1280: {
                items: 3
            }
        }
    })


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




