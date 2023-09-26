//timer script

var mySetTimeout;
function countdown( elementName, minutes, seconds )
{
    var element, endTime, hours, mins, msLeft, time;
    function twoDigits( n )
    {
        return (n <= 9 ? "0" + n : n);
    }

    function updateTimer()
    {
        msLeft = endTime - (+new Date);
        if(msLeft < 240500){// 180499 2 minute, 240499 1 minute, only  in case of 20 seconds (10498 it's 10 sec.)
            localStorage.setItem("resent_otp", false);
            $(".resend-otp a").show();
        }
        
        if ( msLeft < 1000 ) {
            localStorage.setItem("resent_otp", false);
            $(".resend-otp a").show();
            $(".countdown").addClass("d-none");
            $('.edit-input-group-append').show()
            $.ajax({
                url: $(".resend-otp-btn").data("url") + $(".phone-num").val(),
                type: "get",
                success: function () {},
            });
           //element.innerHTML = "4:60";
           element.innerHTML = "0:10";
           
        }else {
            time = new Date( msLeft );
            hours = time.getUTCHours();
            mins = time.getUTCMinutes();
            element.innerHTML = (hours ? hours + ':' + twoDigits( mins ) : mins) + ':' + twoDigits( time.getUTCSeconds() );
            mySetTimeout = setTimeout( updateTimer, time.getUTCMilliseconds() + 500 );
        }
    }

    element = document.getElementById( elementName );
    endTime = (+new Date) + 1000 * (60*minutes + seconds) + 500;
    updateTimer();
}

$(document).on("click",".resend-otp-btn, .verify-btn button",function(){
    
    clearTimeout(mySetTimeout);
    setTimeout(function() {
        if((localStorage.getItem("resent_otp") == true || localStorage.getItem("resent_otp") == "true")){
            $('.edit-input-group-append').hide()
            $('#ten-countdown').length <= 0 ? $("#resend-otp-block").html('<div class="countdown" id="ten-countdown"></div>') : '' ;
            //countdown( "ten-countdown",4,60 );
            countdown( "ten-countdown",0,10 );
        }
    }, 2000);
})