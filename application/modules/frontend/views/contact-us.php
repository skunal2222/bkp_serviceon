<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/contact-responsive.css">
<script async defer 
        src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLE_MAP_API_KEY; ?>&callback=initMap">
</script>
<section id="contact-us-section">
    <h3 class="contact-section-title">Contact Us</h3>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div id="map"></div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card client-address-card">
                <h4 class="client-address-title">Service On</h4>
                <h6 class="client-address">Phone no. <a href="tel:+91-8850699195">(+91) 8850699195</a> / <a href="tel:+91-9768869222">9768869222 </a><br>
                    Email Id : <a href="mailto: support@serviceon.co.in">support@serviceon.co.in</a> <br>
                    Address : <a href="https://www.google.com/maps/search/206,+2nd+floor,+Nehru+Society+Mahim+Link+road,+T+junction+Mumbai-400017/@19.0415218,72.8441922,16z/data=!3m1!4b1" target="_blank">206, 2nd floor, <br> Nehru Society Mahim Link road, T junction Mumbai-400017</a></h6>
            </div>
        </div>
    </div>


    <div class="feedback-form">
        <div class="card user-feedback-form card">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6 col-sm-12 col-12">
                        <label for="first-name" id="first-name1">First Name</label>
                        <input type="text" class="form-control icon-remover" placeholder="First Name"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'First Name'">
                    </div>

                    <div class="form-group col-md-6 col-sm-12 col-12">
                        <label for="last-name">Last Name</label>
                        <input type="text" class="form-control"  placeholder="Last Name">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 col-sm-12 col-12">
                        <label for="phone-number">Phone number</label>
                        <input type="text" class="form-control" placeholder="Phone Number">
                    </div>

                    <div class="form-group col-md-6 col-sm-12 col-12">
                        <label for="email">Email ID</label>
                        <input type="email" class="form-control" placeholder="Email">
                    </div>
                </div>

                <div class="form-group">
                    <label for="text-box">Give your Feedback</label>
                    <textarea class="form-control" rows="7" placeholder="Write here..." style="border: solid 1.5px #959595;"></textarea>
                </div>

                <button type="" class="send-usereq-btn">Send</button>
            </form>

        </div>
    </div>
</section>

<script type="text/javascript">
    function initMap() {
        // The location of ServiceOn 
        var ServiceOn = {lat: 19.0460634, lng: 72.8505985};
        // The map, centered at ServiceOn
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 10, center: ServiceOn});
        // The marker, positioned at ServiceOn
        var marker = new google.maps.Marker({position: ServiceOn, map: map});
        disableDefaultUI: true
    }
</script>