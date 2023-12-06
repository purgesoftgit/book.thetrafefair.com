<form class="booking-search">
    @csrf
    <div class="">Search</div>
    
    <div class="mb-2">
        <label for="check-in-date" class="form-label">Check-in date</label>
        <div class="control-datepiker">
            <input type="date" class="form-control check-in" onchange="setCheckInDate(this.value)" onkeydown="return false" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime(' +2 months')); ?>" value="<?php echo date('Y-m-d'); ?>" name="checkin" id="datepicker">
            <span class="check-in-error info-aree"></span>
        </div>
    </div>


    <div class="mb-2">
        <label for="check-in-date" class="form-label">Check-out date</label>
        <div class="control-datepiker">
            <input type="date" class="form-control check-out"  onchange="setCheckOutDate(this.value)" onkeydown="return false" min="<?php echo date('Y-m-d', time() + 86400); ?>" max="<?php echo date('Y-m-d', strtotime('+2 months', strtotime('+1 days'))); ?>" value="<?php echo date('Y-m-d', time() + 86400); ?>" id="checkout" name="checkout">
            <span class="check-out-error info-aree"></span>
        </div>
    </div>

    <div class="mb-2">
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
                <div class="col-md-8 col-sm-8 col-xs-7">
                    <button type="button" class="btn btn-dark btn-sm add-other-room"><i class="fa fa-plus"></i> Add another room</button>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-5" style="text-align: right;">
                    <button type="button" class="btn btn-info btn-sm apply-changes">Apply</button>
                </div>
            </div>

        </div>
    </div>


    <div class="d-grid">
        <button type="button" class="btn btn-secondary search-room">Search</button>
    </div>
</form>