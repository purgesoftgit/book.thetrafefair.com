<table class="table table-bordered">
    <thead>
        <tr>
            <th width="25%">Room type</th>
            <th width="20%">Number of guests</th>
            <th width="25%">Room Price</th>
            <th width="30%"></th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($rooms))
        @foreach($rooms as $key => $value)

        <!-- <span class="per_room_person d-none"><?php// echo isset($value->avails_room) ? $value->avails_room : $value->no_of_rooms; ?></span>
        <span class="setting_person d-none">{{ $per_room_person->value ?? 2}}</span>
        <span class="per_room_childrens_allowed d-none">{{ $per_room_childrens_allowed->value ?? 0}}</span>
        <span class="no_of_avail_rooms d-none"><?php //echo isset($value->avails_room) ? $value->avails_room : $value->no_of_rooms; ?></span>
 -->

        <tr>
            <td>
                <a data-bs-toggle="modal" data-bs-target="#roomDetail-popup" href="javascript:void(0)" class="bold-under text-decoration-none">{{$value->title}}</a>
            </td>
            <td>
                <img src="{{asset('img/user-icon2.png')}}" alt="User">
                <img src="{{asset('img/user-icon2.png')}}" alt="User">
            </td>
            <td>
                <big><i class="fa fa-rupee"></i><?php echo isset($value->final_price) && !empty($value->final_price) ? $value->final_price : $value->price; ?></big>
            </td>
            <td>
                @if(isset($value->new_avail_price) && !empty($value->new_avail_price) || $value->no_of_rooms != 0)
                <a href="javascript:void(0)" class="btn btn-primary btn-sm reserve-room" data-slug="{{ $value->slug }}" data-roomid="{{ $value->id }}">Reserve</a>
                <p>Confirmation is immediate</p>
                @else
                <span class="info-aree">Room not available</span>
                @endif
            </td>
        </tr>
        @endforeach
        @endif

    </tbody>
</table>