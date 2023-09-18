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

    var current_url =  window.location.href;
    if(current_url.split('/').pop() == "login")
        var url_str = "login"
    else
        var url_str = "register"

    $('#submitButton').click(function () {
        if ($('#Phone-Number').val().length == 0) {
            $('.p_err').text("Please enter phone number").css({
                'display': 'block'
            });
        } else if ($('#Phone-Number').val().length != 10) {
            $('.p_err').text("Please enter valid phone number").css({
                'display': 'block'
            });
        } else {

            $('#invalid_otp').hide();
            
            $.ajax({
                url: "register/data",
                type: 'get',
                data: {
                    data: $('#Phone-Number').val(),
                    url_str : url_str
                },
                success: function (response) {
                  
                    if (response.status == 500) {
                        $('#invalid_otp').text(response['error']);
                        $('#invalid_otp').show();
                    } else {
                        showSuccess('OTP sent successfully...');
                        $('.first-verify-btn').hide();
                        $(".resend-otp").show();
                        $(".passcode-wrapper").show();
                        var varifiyButton = $('#verifyButton').show()
                        $('#verifyButton').click(function () {
                            var codeBox1 = $("#codeBox1").val(),
                                codeBox2 = $("#codeBox2").val(),
                                codeBox3 = $("#codeBox3").val(),
                                codeBox4 = $("#codeBox4").val();
                            var codeBox = codeBox1 + codeBox2 + codeBox3 + codeBox4;
                            $.ajax({
                                url: "register/data/otp",
                                type: 'get',
                                data: {
                                    codeBox: codeBox,
                                    number: $('#Phone-Number').val()
                                },
                                success: function (response) {
                                    if (response['status'] == 500) {
                                        isSubmit = false
                                        isVerify = false

                                        $('#invalid_otp').text(response['error']);
                                        $('#invalid_otp').show();
                                        setTimeout(function () {
                                            $("#invalid_otp")
                                                .hide();
                                        }, 3000);
                                    } else {
                                        isSubmit = true
                                        isVerify = true
                                        $('#verifyButton').hide()
                                        $(".passcode-wrapper").hide();
                                        $('.valid_otp').text("Verification Successfully...");
                                        setTimeout(function () {
                                            $(".valid_otp")
                                                .hide();
                                        }, 3000);
                                        $('#btn_register').prop(
                                            "disabled", false);
                                    }
                                }
                            });


                        });
                    }
                }
            });
        }
    });

    $("#btn_register").click(function () {
        var eml_reglx = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

        console.log($('#Phone-Number').val().length);

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

    //contact us

    var nameValue, emailValue, phoneValue, messageValue, recaptchaValue;
    $("#name").on("input", function () {
        validateName();
    });

    $("#email").on("input", function () {
        validateEmail();
    });

    $("#phone").on("input", function () {
        validatePhone();
    });

    $("#message").on("input", function () {
        validateMessage();
    });


    $("#contact_btn").click(function (e) {
        e.preventDefault();
        validateName();
        validateEmail();
        validatePhone();
        validateMessage();
        validateRecaptcha();
        if (isValidName(nameValue) && isValidEmail(emailValue) && isValidPhone(phoneValue) && isValidMessage(messageValue) && recaptchaValue) {
            Swal.fire({
                title: 'Request Processing',
                text: 'Your request is in processing.',
                icon: 'info',
                timer: 3000, // Show this message for 3 seconds
                timerProgressBar: true,
                showConfirmButton: false
            }).then(function () {
                // After the first message, show the "Request submitted successfully" message
                $("#contact_form").submit();
                // Redirect to the desired URL after showing both messages
                setTimeout(function () {
                    window.location.href = '/thetradefair/public';
                }, 1000);

            });

        }
    });

    function validateName() {
        nameValue = $("#name").val().trim();
        var nameErrorElement = $("#nameError");

        if (nameValue === "") {
            setError(nameErrorElement, "please enter the name");
        } else if (!isValidName(nameValue)) {
            setError(nameErrorElement, "Invalid Name");
        } else {
            setSuccess(nameErrorElement);
        }
    }

    function validateEmail() {
        emailValue = $("#email").val().trim();
        var emailErrorElement = $("#emailError");

        if (emailValue === "") {
            setError(emailErrorElement, "please enter the email");
        } else if (!isValidEmail(emailValue)) {
            setError(emailErrorElement, "Please enter a valid Email Address!");
        } else {
            setSuccess(emailErrorElement);
        }
    }

    function validatePhone() {
        phoneValue = $("#phone").val().trim();
        var phoneErrorElement = $("#phoneError");

        if (phoneValue === "") {
            setError(phoneErrorElement, "please enter the phone number");
        } else if (!isValidPhone(phoneValue)) {
            setError(
                phoneErrorElement,
                "Enter a valid phone number"
            );
        } else {
            setSuccess(phoneErrorElement);
        }
    }

    function validateMessage() {
        messageValue = $("#message").val().trim();
        var messageErrorElement = $("#messageError");

        if (messageValue === "") {
            setError(messageErrorElement, "plase enter the any message");
        } else {
            setSuccess(messageErrorElement);
        }
    }

    function validateRecaptcha() {
        recaptchaValue = grecaptcha.getResponse();
        var recaptchaErrorElement = $("#recaptchaError");

        if (recaptchaValue == "") {
            setError(recaptchaErrorElement, "Please confirm that you are not a robot.");
        } else {
            setSuccess(recaptchaErrorElement);
        }
    }

    function setError(element, message) {
        element.text(message);
        element.siblings("input").addClass("error").removeClass("success");
    }

    function setSuccess(element) {
        element.text("");
        element.siblings("input").removeClass("error").addClass("success");
    }

    function isValidName(nameValue) {
        return /^[a-zA-Z\s]{3,}$/.test(nameValue);
    }

    function isValidEmail(emailValue) {
        return /^[a-zA-Z0-9][a-zA-Z0-9._%\-]+@[a-zA-Z0-9_.-]{2,}\.[a-zA-Z]{2,}$/.test(emailValue);
    }

    function isValidPhone(phoneValue) {
        return /^\d{10}$/.test(phoneValue);
    }

    function isValidMessage(messageValue) {
        return messageValue !== "";
        // return messageValue.trim().split(/\s+/).length >= 10;
    }

    function isValidRecaptcha(recaptchaValue) {
        return recaptchaValue !== "";
    }

    // $(".ttf_form").submit(function(e){
    //     e.preventDefault(); // Prevent the default form submission
    //     // Show a "Request is in processing" message
    //     Swal.fire({
    //         title: 'Request Processing',
    //         text: 'Your request is in processing.',
    //         icon: 'info',
    //         timer: 3000, // Show this message for 3 seconds
    //         timerProgressBar: true,
    //         showConfirmButton: false
    //     }).then(function () {
    //         // After the first message, show the "Request submitted successfully" message

    //         // Redirect to the desired URL after showing both messages
    //         window.location.href = '/thetradefair/public';

    //     });
    //    })
});

function showSuccess(message) {
    $('.successMassage').text(message);
    setTimeout(function () {
        $(".successMassage").hide();
    }, 5000);
}




