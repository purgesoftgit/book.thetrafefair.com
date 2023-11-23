<!-- We Price Match Modal -->
<div class="modal fade" id="we-price-match" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">We Price Match</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="claim-title">You can claim a refund for the difference if you happen to find your
                    reservation cheaper on another website.</div>
                <p>Just remember to contact us after booking with us and at least 24 hours before your check-in date.
                    You'll need to provide us with the link to the other offer and it must be online and available when
                    we check.</p>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="claim-title">We Price Match checklist</div>
                        <ul class="checklist">
                            <li>The other offer must be for the same property and accommodation type.</li>
                            <li>The other offer must be for the same check in and check out dates.</li>
                            <li>The other offer must have the same cancellation policy and conditions.</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="claim-title">When can't you make a claim?</div>
                        <ul class="closelist">
                            <li>If the other offer is on a website that doesn’t reveal the property or accommodation
                                type you’ll be staying in until after booking.</li>
                            <li>If the other offer is part of a loyalty or rewards programme. We define this type of
                                other offer as any situation where a customer gets a reduced price from a property or
                                other website as a reward for repeat business, logging in, entering a coupon code,
                                referring other customers, or performing any other action which then changes the
                                initially shown price.</li>
                            <li>If your current Bookingengine.com booking is a Partner offer, i.e. an offer that's
                                labelled as 'Partner Offer' on our platform (these offers are made available by
                                Bookingengine.com partner companies) or if you're comparing the other offer with one of
                                these Partner Offers on our platform.</li>
                        </ul>
                    </div>
                </div>

                <div class="gray-box">
                    <div class="claim-title">Found your booking cheaper elsewhere?</div>
                    <ul>
                        <li>Look for Found this room cheaper elsewhere? on your confirmation page or in View all
                            bookings.</li>
                        <li>No account? Log in with your booking number and pin.</li>
                        <li>You can also contact our Customer Care team.</li>
                    </ul>
                </div>

                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<!-- Google Map Popup Modal -->
<div class="modal fade" id="google-map-popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3560.5512677070305!2d75.54117827606402!3d26.822413263964165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396be586c53972d9%3A0xf6f89699ad4b0fdc!2sAjmer-Jaipur%20Expy%2C%20RIICO%20Industrial%20Area%2C%20Bagru%2C%20Rajasthan!5e0!3m2!1sen!2sin!4v1699247216874!5m2!1sen!2sin"
                    class="google-map-iframe" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Gallery Popup Modal -->
<div class="modal fade" id="gallery-popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="gallery" class="gallery-grid">
                    @if (!is_null($resultArray))
                        @foreach ($resultArray as $value)
                            <div class="box">
                                <img src="{{ env('BACKEND_URL') . 'show-images/' . $value }}" alt="Image"
                                    class="img-fluid">
                            </div>
                        @endforeach
                    @endif

                </div>

            </div>
        </div>
    </div>
</div>

<!-- Ask Question Modal -->
<div class="modal fade" id="ask-question-popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Didn't find the answer you were looking for? Ask a
                    question about the property</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-validate" id="submitAskQuestion" action="{{ url('submit-ask-question') }}" method="POST" >
                    @csrf
                    <div class="mb-3">
                        <label for="ask-question-email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control validate[required, custom[email]]" id="ask-question-email">
                    </div>
                    <div class="mb-3">
                        <label for="ask-question-textarea" class="form-label">Type your question here:</label>
                        <textarea class="form-control validate[required]" name="question"  id="ask-question-textarea" rows="5"></textarea>
                    </div>
                    <div class="d-grid mb-3">
                        <button type="button" class="btn btn-primary submitAskquestion">Submit your question</button>
                    </div>
 
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Guidelines Modal -->
<div class="modal fade" id="guidelines-popup" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Bookingengine.com questions and answers guidelines
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="fn-14">Questions and answers should be property or room related. The most helpful
                    contributions are detailed and help others make better decisions. Please don’t include personal,
                    political, ethical, or religious commentary. Promotional content will be removed and issues
                    concerning Bookingengine.com’s services should be routed to our Customer Service or Accommodation
                    Service teams.</p>

                <p class="fn-14">Please avoid using profanity or attempts to approximate profanity with creative
                    spelling, in any language. Comments and media that include 'hate speech', discriminatory remarks,
                    threats, sexually explicit remarks, violence, and the promotion of illegal activity are not
                    permitted.</p>

                <p class="fn-14">Respect the privacy of others. Bookingengine.com will make an effort to obscure email
                    addresses, telephone numbers, website addresses, social media accounts, and similar details.</p>

                <p class="fn-14">Bookingengine.com does not accept responsibility or liability for any question and
                    answers. Bookingengine.com is a distributor (without any obligation to verify) and not a publisher
                    of these questions and answers. Bookingengine.com may, at its own discretion, alter, modify, delete
                    or otherwise change these Guidelines.</p>

            </div>
        </div>
    </div>
</div>

<!-- Room detail Modal
<div class="modal fade" id="roomDetail-popup" tabindex="-1" aria-labelledby="roomDetailPopup" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content ">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="roomDetailPopup">Bookingengine.com questions and answers guidelines</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @if (!empty($roomDetail))
{{ $roomDetail }}
@endif
        <div class="row">
          <div class="col-md-6"></div>
          <div class="col-md-6"></div>
        </div>


      </div>
    </div>
  </div>
</div> -->
