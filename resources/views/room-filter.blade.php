<section class="reservation-form">
    <form id="bookNowfrom">
        @csrf
        <div class="row">

            <div class="mb-4">
                <label class="form-label">CHECK-IN</label>
                <div class="datepicher-field">
                    <input type="date" class="form-control check-in" onkeydown="return false" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime(' +2 months')); ?>" value="<?php echo date('Y-m-d'); ?>" name="checkin" id="datepicker">
                    <span class="check-in-error"></span>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">CHECK-OUT</label>
                <div class="datepicher-field">
                    <input type="date" class="form-control check-out" onkeydown="return false" min="<?php echo date('Y-m-d', time() + 86400); ?>" max="<?php echo date('Y-m-d', strtotime('+2 months', strtotime('+1 days'))); ?>" value="<?php echo date('Y-m-d', time() + 86400); ?>" id="checkout" name="checkout">
                    <span class="check-out-error"></span>
                </div>
            </div>

            <div class="mb-4">
                <input type="hidden" name="rooms" class="hidden_room">
                <input type="hidden" name="guests" class="hidden_guests">
                <label class="form-label">ROOMS & GUESTS</label>
                <div class="rooms_guests">
                    <p>1 Room - 1 Guest</p>
                </div>
                <div class="rooms_guests_list" style="display: none;">
                    <div class="added_rooms"></div>
                    <?php $row = 1; ?>
                    <div class="guests_list">
                        <div class="row room_adults_heading"><strong>Room
                                {{ $row }}</strong>
                            <p>ADULTS (12y +)</p>
                        </div>
                        <div class="row room_number room_number_adults px-2">
                            <ul><?php $i = 1;
                                for ($i = 1; $i <= 3; $i++) {
                                    echo $i == 1 ? "<li class='selected'>$i</li>" : "<li>$i</li>";
                                } ?></ul>
                        </div>
                    </div>

                    <hr style="border: 1px solid #cfd1d2;">

                    <div class="row action_row">
                        <div class="col-md-6 col-sm-6">
                            <button type="button" class="btn btn-dark btn-sm add-other-room"><i class="fa fa-plus"></i>Add another room</button>
                        </div>
                        <div class="col-md-6 col-sm-6" style="text-align: right;">
                            <button type="button" class="btn btn-info apply-changes">Apply</button>
                        </div>
                    </div>

                </div>
                <span class="room-error"></span>
            </div>

            <div class="mb-4">
                <label class="form-label">CATEGORY</label>
                <select class="form-select category" name="category" id="room_category_filter">
                    @foreach ($rooms as $room)
                    <option value="{{ $room->room_category }}" {{ $room->room_category == 'deluxe' ? 'selected' : '' }} data-id="{{ $room->id }}">{{ $room->title }}</option>
                    @endforeach
                </select>
                <span class="cat-error"></span>
            </div>
            <button type="button" class="btn btn-primary search-room">Check
                Availability</button>
        </div>
    </form>
    <p class="no_room_avail_error_msg_filter d-none"><span id="selected_room_category"></span> Room
        is not availible right now</p>
</section>
<!-- room filter js -->
<script type="text/javascript" src="{{asset('js/room-filter.js')}}"></script>

