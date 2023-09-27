// var total_room = $('.no_of_rooms').val();
// var limit = 5;
// var is_first = 'yes';

// function getRoom(is_first) {

//     if ((localStorage.getItem("index-filter") != null && localStorage.getItem("index-filter") == "true" ||
//             localStorage.getItem("index-filter") == true) && localStorage.getItem("check-in") != null &&
//         localStorage.getItem("check-out") != null && localStorage.getItem("room-guest") != null && localStorage
//         .getItem("category")) {
//         $('#datepicker').val(localStorage.getItem("check-in"));
//         $('#checkout').val(localStorage.getItem("check-out"));
//         $('#room_category_filter').val(localStorage.getItem("category"));
//         $('.rooms_guests p').text(localStorage.getItem("room-guest"));
//         is_first = 'no';
//     }

//     $.ajax({
//         'url': "{{ url('get-room-ajax') }}",
//         'type': 'POST',
//         'data': {
//             'checkin': $('#datepicker').val(),
//             'checkout': $('#checkout').val(),
//             'room_category_filter': $('#room_category_filter').val(),
//             'room_guest': $('.rooms_guests p').text(),
//             "limit": limit,
//             "_token": "{{ csrf_token() }}",
//             'is_first': is_first
//         },
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         success: function(res) {
//             $('#room_data').html(res);
//             limit = limit + 5;
//             if ($('#current_count').val() == $('#total_records').val()) {
//                 $('.load-more').hide();
//             } else {
//                 $('.load-more').show();
//             }
//         }
//     })

// }
$(document).ready(function() {
  //  getRoom(is_first);
    $(document).on('click', '.search-room', function() {

        getAvailsRooms($('.check-in').val(), $('#room_category_filter option:selected').attr(
            "data-id"));

        localStorage.setItem("check-in", $('.check-in').val());
        localStorage.setItem("check-out", $('.check-out').val());
        localStorage.setItem("room-guest", $('.rooms_guests p').text());
        localStorage.setItem("category", $('.category').val());

    })

    // $(document).on('click', '.load-more', function() {
    //     getRoom(is_first);
    // })

    $('#selected_room_category').text(localStorage.getItem("category") ? localStorage.getItem("category").replace('_', ' ') : "");


    var i = 0;
    $('.check-in').on('change', function() {
        startdate = $(this).val()
        $('.check-out').attr("min", moment(startdate).add(1, 'days').format("YYYY-MM-DD"));
        $('.check-out').attr("value", moment(startdate).add(1, 'days').format("YYYY-MM-DD"));

    });


    $('.check-out,.check-in').on('change', function() {
        enddate = $('.check-out').val()
        startdate = $('.check-in').val()

        if (startdate < moment().format('YYYY-MM-DD') || startdate > moment().add(2, 'months')
            .format('YYYY-MM-DD')) {
            $('.check-in-error').show()
            $('.check-in-error').text("Start Date cannot be before Today Date.").css({
                'display': 'block',
                'font-size': '13px',
                'color': 'red'
            }).delay(800).fadeOut(1000);
            $('.search-room').prop("disabled", true)
        }

        if (enddate < moment().format('YYYY-MM-DD') || enddate > moment().add(2, 'months').add(1,
                'days').format('YYYY-MM-DD')) {
            $('.check-out-error').text("End Date cannot be before Today Date.").css({
                'display': 'block',
                'font-size': '13px',
                'color': 'red'
            }).delay(800).fadeOut(1000);
            $('.search-room').prop("disabled", true)
        }

        if ((startdate >= moment().format('YYYY-MM-DD') && startdate <= moment().add(2, 'months')
                .format('YYYY-MM-DD')) && (enddate >= moment().format('YYYY-MM-DD') && enddate <=
                moment().add(2, 'months').add(1, 'days').format('YYYY-MM-DD'))) {
            $('.search-room').prop("disabled", false)
        }
    });


    console.log("it working");
    //room abd guest start
    $(document).on('click', '.rooms_guests', function(e) {
        console.log("clicked before ");
       
        e.stopPropagation();
        console.log("clicked after ");
        $('.rooms_guests_list').toggle();
    });
    $(document).on('click', '.rooms_guests_list', function(event) {
        event.stopPropagation();
    });
    $(document).on('click', '.added_rooms .editDiv .room-guest-edit-remove', function(event) {
        event.stopPropagation();
    });

    $('.room_number_adults ul li').click(function() {
        $('.guests_list .room_number_adults ul li.selected').removeClass('selected');
        $(this).addClass('selected').parent().siblings().children().removeClass('selected');
    });

    $('.room_number_child ul li').click(function() {
        $('.room_number_child ul li.selected').removeClass('selected');
        $(this).addClass('selected').parent().siblings().children().removeClass('selected');

        ($(this).text() == 0) && $('.child-1-block, .child-2-block, .child-3-block, .child-4-block')
            .hide();
        ($(this).text() == 1) && $('.child-1-block').show(), $(
            '.child-2-block,.child-3-block,.child-4-block').hide();
        ($(this).text() == 2) && $('.child-1-block, .child-2-block').show(), $(
            '.child-3-block,.child-4-block').hide();
        ($(this).text() == 3) && $('.child-1-block, .child-2-block,.child-3-block').show(), $(
            '.child-4-block').hide();
        ($(this).text() == 4) && $('.child-1-block, .child-2-block,.child-3-block,.child-4-block')
            .show();
    });

    $(document).change('#child_oneage,#child_twoage,#child_threeage,#child_fourage', function() {
        $('.child_age_error').hide();
    })
    var is_valid_child = true;
    $('.apply-changes').click(function() {
        var count_adults, count_child, total_adults = 0;
        var total_child = 0;
        var count_rooms = 0;
        $('.added_rooms').children().each(function(key, value) {
            count_rooms = key + 1;
            count_adults = parseInt($(value).find("p").text().split(', ')[0].trim().split(
                'Adults')[0])
            count_child = 0;
            total_adults += count_adults;
            total_child += count_child;
        });
        var room = parseInt($('.guests_list .room_number_adults ul li.selected').text());
        var guest = parseInt($('.guests_list .room_number_child ul li.selected').text());

        if (isNaN(guest))
            var total_guests = room + 0 + total_adults + total_child;
        else
            var total_guests = room + guest + total_adults + total_child;

        var total_rooms = count_rooms + 1;

        $('.rooms_guests p').text(total_rooms + ' Room - ' + total_guests + ' Guest');
        $('.hidden_room').val(total_rooms);
        $('.hidden_guests').val(total_guests);
        $('.rooms_guests_list').toggle();
    });

    var room = 0;
    var is_child = true;
    $('.add-other-room').click(function() {
        $('.guests_list').css('display', 'block');
        $('.editDetail').removeClass('compEditDetail').hide()
        $('.editDiv').show()

        var html = '';
        var adults = $('.guests_list .room_number_adults ul li.selected').text();
        var child = $('.guests_list .room_number_child ul li.selected').text();

        child = (child == '') ? 0 : child;

        ++i;
 
        html += '<div class="roomRow' + i + '"><strong>Room ' + i +
            '</strong><div class="editDiv"><p>' + adults +
            ' Adults</p><div class="room-guest-edit-remove"><a class="edit-rooms" onclick="editRooms(' +
            i +
            ')" style="text-decoration:none;font-size: 14px;font-weight: 600;cursor:pointer;"><i class="fa fa-edit"></i></a><a class="removeButton" onclick="removeRow(' +
            i +
            ')" style="font-size: 14px; padding-left: 10px; font-weight: 600;"><i class="fa fa-trash"></i></a></div></div><div class="editDetail" style="display:none;"><p>ADULTS (12y +)</p><div class="new_guest_list"><div class="room_number room_number_adults"><ul><li onclick="editRoomAdults(1,' +
            i + ')">1</li><li onclick="editRoomAdults(2,' + i +
            ')">2</li><li onclick="editRoomAdults(3,' + i +
            ')">3</li></ul></div></div></div>';

        $('.added_rooms').append(html);

        let add_val = i + 1;
        $('.room_adults_heading strong').text("Room " + add_val);

        $('.room_number_adults ul li.selected').removeClass('selected')
        $('.room_number_adults ul li').each(function() {
            if ($(this).text() == 1) {
                $(this).addClass('selected');
            }
        });

        $('.room_number_child ul li.selected').removeClass('selected')
        $('.room_number_child ul li').each(function() {
            if ($(this).text() == 0) {
                $(this).addClass('selected');
            }
        });

        $('#child_oneage').val(0)
        $('#child_twoage').val(0)
        $('#child_threeage').val(0)
        $('#child_fourage').val(0)

    });


});

var i = 0;

function chnageAudultsValue(value) {
    $('.adults li').removeClass('selected');
    $('.adults_class_' + value).addClass('selected');
}

function chnageChildValue(value) {
    $('.child li').removeClass('selected');
    $('.child_class_' + value).addClass('selected');
    (value == 0) && $('.child-1-block, .child-2-block, .child-3-block, .child-4-block').hide();
    (value == 1) && $('.child-1-block').show(), $('.child-2-block,.child-3-block,.child-4-block').hide();
    (value == 2) && $('.child-1-block, .child-2-block').show(), $('.child-3-block,.child-4-block').hide();
    (value == 3) && $('.child-1-block, .child-2-block,.child-3-block').show(), $('.child-4-block').hide();
    (value == 4) && $('.child-1-block, .child-2-block,.child-3-block,.child-4-block').show();
}

function removeRow(index) {
    $('.roomRow' + index).nextAll().each(function(key, value) {
        let st_num = $(value).find('strong').text().split('Room ')[1] - 1;
        $(value).find('strong').text('Room ' + st_num)
    });

    let heading_num = $('.room_adults_heading strong').text().split('Room ')[1] - 1;
    $('.room_adults_heading strong').text('Room ' + heading_num);
    $('.roomRow' + index).remove();

    --i;
}
//edit rooms script start
function editRooms(index) {
    $('.chnageRoomandAdults').show()
    var adults = $('.roomRow' + index + ' .editDiv p').text().split(',')[0].trim().split(" ")[0];

    $('.roomRow' + index + ' .editDetail .room_number_adults ul li').removeClass('selected');
    $('.roomRow' + index + ' .editDetail .room_number_adults ul li').each(function() {

        if ($(this).text() == adults) {
            $(this).addClass('selected');
        }
    });

    $('.roomRow' + index + ' .editDetail .room_number_child ul li').removeClass('selected');
    $('.roomRow' + index + ' .editDetail .room_number_child ul li').each(function() {})

    $('.roomRow' + index + ' .editDiv .edit-rooms').hide();
    $('.roomRow' + index + ' .editDetail').show();
}

function chnageRoomandAdults(index) {
    var adults = $('.roomRow' + index + ' .editDiv p:first').text().split(',')[0].trim().split(" ")[0];
    var room = $('.roomRow' + index + ' strong').text().split(' ')[1];

    $('.roomRow' + room + ' .editDiv p:first').text(adults + " Adults")
    $('.roomRow' + index + ' .editDiv').show();
    $('.roomRow' + index + ' .editDetail').hide();
}

//change rooms adults script start
function editRoomAdults(index, room) {
    $('.roomRow' + room + ' .editDetail .room_number_adults ul li').removeClass('selected');
    $('.roomRow' + room + ' .editDetail .room_number_adults ul li').each(function() {
        if ($(this).text() == index) {
            $(this).addClass('selected');
        }
    });

    $('.roomRow' + room + ' .editDiv p:first').text(index + " Adults")
}

function editRoomChilds(child, index) {
    $('.roomRow' + index + ' .editDetail .room_number_child ul li').removeClass('selected');
    $('.roomRow' + index + ' .editDetail .room_number_child ul li').each(function() {
        if ($(this).text() == child) {
            $(this).addClass('selected');
        }
    });
    var adults = $('.roomRow' + index + ' .editDiv p:first').text().split(', ')[0].trim().split("Adults")[0];
    $('.roomRow' + index + ' .editDiv p:first').text(adults + " Adults");
}

//check availbale rooms 
function getAvailsRooms(checkindate, room_id) {
    $.ajax({
        url: "get-avails-room/" + room_id + "/" + checkindate,
        type: "get",
        success: function(response) {


            if (response.avails_room == 0) {
                $('#selected_room_category').text($('#room_category_filter option:selected').val()
                    .replace('_', ' '));
                $('.no_room_avail_error_msg_filter').removeClass('d-none').fadeIn().css({'color': 'red',}).delay(5000).fadeOut();

            } else {
                $('.no_room_avail_error_msg_filter').addClass('d-none');

                window.location.href = "room/"+$('.category').val().replace("_","-",)+'-room#CheckoutRoomBook';

            }
        }
    })
}
