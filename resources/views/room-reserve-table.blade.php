<table class="table table-bordered">
    <thead>
        <tr>
            <th>Room type</th>
            <th width="300">Number of guests</th>
            <th width="300">Today's Price</th>
            <th width="180"></th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($rooms))
        @foreach($rooms as $key => $value)
        <tr>
            <td>
                <a data-bs-toggle="modal" data-bs-target="#roomDetail-popup" href="javascript:void(0)" class="bold-under">{{$value->title}}</a>
                <!-- <p class="mb-0">1 double bed <img src="img/bed-icon.png" alt="image"></p> -->
            </td>
            <td>
                <img src="{{asset('img/user-icon2.png')}}" alt="User">
                <img src="{{asset('img/user-icon2.png')}}" alt="User">
            </td>
            <td>
                <big><i class="fa fa-rupee"></i><?php echo isset($value->final_price) && !empty($value->final_price) ? $value->final_price : $value->price; ?></big>
            </td>
            <td>
                <button class="btn btn-primary btn-sm show-price">Reserve</button>
                <p>Confirmation is immediate</p>
            </td>
        </tr>
        @endforeach
        @endif

    </tbody>
</table>