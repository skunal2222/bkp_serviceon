<style type="text/css">
  #thanks{
    display: none;
  }
</style>
<section id="main-title">
  <div class="garage-data row">
    <div class="col-lg-2 col-md-2">
      <img class="header-left-img" src="<?php echo asset_url();?>frontend/images/statue.png">   
    </div>
<?php
//session_destroy();
 //print_r($_SESSION); ?>
    <div class="col-lg-8 col-md-8 col-sm-12 text-center">
      <h2 class="main-header">find the best garages for bike servicing</h2>
      <p class="header-content">The best rated bike servicing garages near you</p>

      <form id="getvendors" name="getvendors" action="" method="post">
            <b><label>Service Type :</label>&emsp;
            <label>
            <input type="radio" name="serviceType" id="serviceType1" value="1"> 
            Pick'n drop
            </label>&emsp;&emsp;&emsp;
            <label>
            <input type="radio" name="serviceType" id="serviceType2" value="2"> 
            Breakdown
            </label></b>
        <div class="input-group location-data">
             <input type="text" name="locality" required class="form-control search-input py-2" id="locality" placeholder="enter location" data-rule="minlen:4" style="padding-right: 2.2em;" data-msg="Please enter at least 4 chars">
             <a href="javascript:locateMe()" style="display:inline-block;"><span class="arrow-location"><img src="<?php echo asset_url();?>frontend/images/location-arrow.png"></span></a>
      
            <!-- <img class="input-arrow" src="<?php echo asset_url();?>frontend/images/location-arrow.png"> -->
            <input type="hidden" id="latitude" name="latitude" value="">
            <input type="hidden" id="longitude" name="longitude" value="">
            <span class="input-group-btn">
                <button class="subscribe-button btn btn-default px-4 shadow-none" id="btngarage" type="submit" >Find Garage</button>
            </span>
        </div>
      </form>

    <div class="logo-frame row">
      <div class="col-lg-2 col-md-4 col-sm-12"><img class="bike-brands" src="<?php echo asset_url();?>frontend/images/ktm-logo.png"></div>  
      <div class="col-lg-2 col-md-4 col-sm-12"><img class="bike-brands" src="<?php echo asset_url();?>frontend/images/yamaha-log.png"></div>
      <div class="col-lg-2 col-md-4 col-sm-12"><img class="bike-brands" src="<?php echo asset_url();?>frontend/images/bajaj-Logo.png"></div>
      <div class="col-lg-2 col-md-4 col-sm-12"><img class="bike-brands" src="<?php echo asset_url();?>frontend/images/honda-logo.png"></div>
      <div class="col-lg-2 col-md-4 col-sm-12"><img class="bike-brands" src="<?php echo asset_url();?>frontend/images/Suzuki-logo.png"></div>
      <div class="col-lg-2 col-md-4 col-sm-12"><img class="bike-brands" src="<?php echo asset_url();?>frontend/images/hero-logo.png"></div>
    </div>

      <div class="jumbotron-section">
        <div class="jumbotron row">

          <div class="col-lg-3 col-md-3 col-sm-6 garage-feature">
            <div class="d-flex justify-content-center align-items-center">
              <h4 class="timer count-title count-number" data-to="500" data-speed="1500"></h4>
              <span class="increment-plus">+</span>
            </div>
            <p class="m-0">top rated garage</p>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-6 garage-feature">
            <div class="d-flex justify-content-center align-items-center">
              <h4 class="timer count-title count-number" data-to="10000" data-speed="1500"></h4>
              <span class="increment-plus">+</span>
            </div>
            <p class="m-0">bikes services</p>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-6 garage-feature">
            <div class="d-flex justify-content-center align-items-center">
              <h4 class="timer count-title count-number" data-to="300" data-speed="1500"></h4>
              <span class="increment-plus">+</span>
            </div>
            <p class="m-0">service location</p>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-6 garage-feature">
            <div class="d-flex justify-content-center align-items-center">
              <h4 class="timer count-title count-number" data-to="1500" data-speed="1500"></h4>
              <span class="increment-plus">+</span>
            </div>
            <p class="m-0">bike mechanics</p>
          </div>
          </div>
        </div>
    </div>

    <div class="col-lg-2 col-md-2">
      <img class="header-right-img" src="<?php echo asset_url();?>frontend/images/statue1.png">   
    </div>
  </div>  
</section>
<!-- end of 1st section-- main-title -->

<section id="about-serviceon" class="section-padding">
  <div class="about-serviceon-content row d-flex">
    <div class="col-lg-6 col-md-6 col-sm-12 about-serviceon-section">
      <div class="">
        <h1 class="headers">About <br> ServiceOn</h1>
        <p class="para-content" style="padding: 1em 0;">Serviceon is one of its type online <br> bike service booking platform which <br> allows the user to search the top <br>rated garages and place their bike <br> service requests on the go.</p>

        <div class="d-flex">
          <a href="#" class="book-now-btn btn btn-lg px-4">Book Now</a>
          <a href="<?= base_url() ?>about-us" class="about-us-btn btn btn-lg px-4">About Us</a>  
        </div>


      </div>
      
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 about-serviceon-section">
      <div class="bike-service ">
        <img class="bike-service-img img-fluid" src="<?php echo asset_url();?>frontend/images/bike-service.png">
      </div>  
    </div>
  </div>  
</section>

<section id="Why-Choose-ServiceOn" class="section-padding section-padding1">
  <div class="Choose-ServiceOn-content row">
    <div class="col-lg-5 col-md-6 col-sm-12">
      <div class="">
        <h1 class="headers">Why Choose <br>ServiceOn</h1>
      </div>
      
    </div>

    <div class="col-lg-7 col-md-6 col-sm-12 ">
      <div class="ServiceOn-works-with">
        <p class="para-content para-content1" >ServiceOn works with top notch bike servicing garages in Mumbai. Our team does a thorough audit of the garages to ensure high quality of bike service and an amazing experience for all our customers</p>
      </div>  
    </div>
  </div>  

  <div class="service-settings row d-flex align-items-center">
    <div class="text-center col ">
      <div class="settings-icons">
        <img src="<?php echo asset_url();?>frontend/images/icons/support.png">
      </div>
      <div class="onService-icons ">Top Rated Garages</div>
    </div>

    <div class="text-center col ">
      <div class="settings-icons">
        <img src="<?php echo asset_url();?>frontend/images/icons/sale.png">
      </div>

      <div  class="onService-icons">Transparent Pricing</div>
    </div>

    <div class="text-center col ">
      <div class="settings-icons">
        <img src="<?php echo asset_url();?>frontend/images/icons/time.png">
      </div>
      <div  class="onService-icons">On-Time Delivery</div>
    </div>

    <div class="text-center col ">
      <div class="settings-icons settings_heart_icons">
        <img src="<?php echo asset_url();?>frontend/images/icons/heart.png">
      </div>
      <div  class="onService-icons">Roadside Assistance</div>
    </div>

    <div class="text-center col">
      <div class="settings-icons">
        <img src="<?php echo asset_url();?>frontend/images/icons/tips.png">
      </div>
      <div  class="onService-icons">Smart Notifications</div>
    </div>

  </div>
  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
      <div class="rectangle-section">
        <div class="rectangle d-flex">
          <div class="rect-text">“ServiceOn ensured that my bike was picked upon time
            and delivered on time. I was able to track every stage of
            my bike servicing on their mobile app” - Soumitra Ghosh
          </div>
          <div class="quotes">
            <img src="<?php echo asset_url();?>frontend/images/icons/top.png">
          </div>            
        </div>
      </div>
    </div>
    <div class="col-lg-2"></div>
  </div>
</section>
<section class="section-padding service-back-img">
  <div class="row d-flex align-items-center">
    <div class="col-lg-6 col-md-6 col-sm-12 serviceon-mobile-section">
      <div class="">
        <h1 class="headers">ServiceOn is <br> now on mobile</h1>
      </div>
      <div style="padding: 1em 0;" class="para-content">
        Book your bike servicing on the go - <br> Download our superfast and super <br> easy android app today
      </div>
      <div class="playstore">
        <a href="#"><img src="<?php echo asset_url();?>frontend/images/play-store.png"> </a>
      </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-right mobile-sideimg serviceon-mobile-section">
      <img class="mobile-app-sideimg" src="<?php echo asset_url();?>frontend/images/Layer 6.png">
    </div>

  </div>
</section>

<section class="top-services section-padding-white">    
  <h1 class="headers">Our Top Services</h1>       
  <div style="padding: 1em 0;" class="para-content top-services-content">
    ServiceOn caters more than 1,100 types <br>of bike services and ensures high quality <br> spare parts for your bikes.
  </div>

  <div class="services-slider pt-3">
    <div id="myCarousel" class="carousel slide" data-ride="carousel"> 
      <div class="carousel-inner">
        <div class="carousel-item carousel-image-1 active">         
          <div class="d-flex flex-wrap justify-content-around">
            <div class="services-type-slider">
              <button class="types-of-service">Bike Tyre Service</button> 
            </div>  

            <div class="services-type-slider">
              <button class="types-of-service">Engine Service</button>  
            </div>  

            <div class="services-type-slider">
              <button class="types-of-service">Full Bike Service</button> 
            </div>

            <div class="services-type-slider">
              <button class="types-of-service">Roadside Service</button>  
            </div>  

            <div class="services-type-slider">
              <button class="types-of-service">Bike Cleaning</button> 
            </div>

          </div>
        </div>
        
        <div class="carousel-item carousel-image-2">
          <div class="d-flex flex-wrap justify-content-around">
            <div class="services-type-slider">
              <button class="types-of-service">Bike Tyre Service</button> 
            </div>  

            <div class="services-type-slider">
              <button class="types-of-service">Engine Service</button>  
            </div>  

            <div class="services-type-slider">
              <button class="types-of-service">Full Bike Service</button> 
            </div>

            <div class="services-type-slider">
              <button class="types-of-service">Roadside Service</button>  
            </div>  

            <div class="services-type-slider">
              <button class="types-of-service">Bike Cleaning</button> 
            </div>

          </div>
        </div>
      </div>

      <a href="#myCarousel" data-slide="prev" class="carousel-control-prev">
        <span class="carousel-control-prev-icon"></span>
      </a>

      <a href="#myCarousel" data-slide="next" class="carousel-control-next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>  
  </div>
</section>

<section id="ongoing-offers" class="section-padding section-padding2 d-none">
  <h1 class="headers">Ongoing Offers</h1> 

  <div id="myCarousel2" class="carousel slide pt-5 carousel-slide" data-ride="carousel">  
    <div class="carousel-inner">
      <div class="carousel-item carousel-image-1 active"> 
        <div class="row ongoing-offers-slider">
          <div class="col-lg-4 col-md-4 col-sm-12 d-flex justify-content-center offers-coupon-slider">
            <div class="card" >
              <img class="card-img-top" src="<?php echo asset_url();?>frontend/images/offers-img.png" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Flat 10% OFF</h5>
                <p class="card-text">On full Bike cleaning <br>Use code SOCLEAN10</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-sm-12 d-flex justify-content-center offers-coupon-slider">
            <div class="card" >
              <img class="card-img-top" src="<?php echo asset_url();?>frontend/images/offers-img.png" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Flat 10% OFF</h5>
                <p class="card-text">On full Bike cleaning <br>Use code SOCLEAN10</p>
                
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-sm-12 d-flex justify-content-center offers-coupon-slider">
            <div class="card" >
              <img class="card-img-top" src="<?php echo asset_url();?>frontend/images/offers-img.png" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Flat 10% OFF</h5>
                <p class="card-text">On full Bike cleaning <br>Use code SOCLEAN10</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="carousel-item carousel-image-2">
        <div class="row ongoing-offers-slider">
          <div class="col-lg-4 col-md-4 col-sm-12 d-flex justify-content-center offers-coupon-slider">
            <div class="card" >
              <img class="card-img-top" src="<?php echo asset_url();?>frontend/images/offers-img.png" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Flat 10% OFF</h5>
                <p class="card-text">On full Bike cleaning <br>Use code SOCLEAN10</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-sm-12 d-flex justify-content-center offers-coupon-slider">
            <div class="card" >
              <img class="card-img-top" src="<?php echo asset_url();?>frontend/images/offers-img.png" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Flat 10% OFF</h5>
                <p class="card-text">On full Bike cleaning <br>Use code SOCLEAN10</p>
                
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-sm-12 d-flex justify-content-center offers-coupon-slider">
            <div class="card" >
              <img class="card-img-top" src="<?php echo asset_url();?>frontend/images/offers-img.png" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Flat 10% OFF</h5>
                <p class="card-text">On full Bike cleaning <br>Use code SOCLEAN10</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <a href="#myCarousel2" data-slide="prev" class="carousel-control-prev">
      <span class="carousel-control-prev-icon"></span>
    </a>

    <a href="#myCarousel2" data-slide="next" class="carousel-control-next">
      <span class="carousel-control-next-icon"></span>
    </a>

  </div>    
</section>



<section class="section-padding-white text-center " id="subscribe-section">
  <div class="text-center row" id="subscriptiontab">
    <div class="col-lg-7 col-md-8 col-sm-12 col-12 m-auto">
      <h2 style="font-weight: 900;" class="subscribe-title">Subscribe to our newsletter</h2>
      <p class="subscribe-title-content">Get our top offers and latest updates about bikes, bike servicing and spare parts in your inbox</p>

      
      <form method="post" action="<?= base_url('save_suscriber')?>" name="subscribenews" id="subscribenews">
            <div class="form-group" id="error-name">
              <div class="col-sm-12 input-group location-data">
                <input type="text" autocomplete="off" class="form-control search-input py-2" placeholder="enter your email ID" id="" name="sub_email"/>
                <span class="input-group-btn">
                  <button class="subscribe-button btn btn-default px-4  shadow-none" type="submit">Subscribe</button>
                </span>
              </div>
              <div class="messageContainer col-sm-10"></div>
            </div>                
      </form>

      <div class="pt-4">
        (we promise we won’t spam)
      </div>
    </div>
  </div>

  <div class="jumbotron text-center" id="thanks">
    <h1 class="display-3">Thank You!</h1>
    <p class="lead">Thank you for subscribing us. Will keep you updated!</p>
    <hr>
  </div>
</section>

<script type="text/javascript">
function garageList() {
  location.href='<?php echo base_url(); ?>garage-list';
}

var delay = 5000;
setTimeout(function() { locateMe(); }, delay);
$(document).ready(function(){
locateMe();
});


// $.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&callback=initMap&key=AIzaSyBzGgD0y-keJB4yVldbdzcgjcUt36OqEoo"); 
$.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&callback=initMap&key=<?= GOOGLE_MAP_API_KEY; ?>"); 

function initMap() { 
    var options = {
        componentRestrictions: { country: 'in' }
    }; 
    var input = document.getElementById('locality');
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
        $('#latitude').val(place.geometry.location.lat());
        $('#longitude').val(place.geometry.location.lng()); 
    });
}    
function locateMe() {
    var options = {
        enableHighAccuracy: true,
        timeout: 1000,
        maximumAge: 0
    };

    function success(pos) {
        var crd = pos.coords;
        var geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(crd.latitude, crd.longitude);
        geocoder.geocode({ 'latLng': latlng }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[1]) {
                  
                    $("#latitude").val(crd.latitude);
                    $("#longitude").val(crd.longitude);
                    var geoaddress = results[0].formatted_address
                    $("#locality").val(geoaddress);
                }
            }
        });
    };

    function error(err) {
        console.warn('ERROR(' + err.code + '): ' + err.message);
        /* var locality = $("#locality").val();
         if(locality == ''){
           //alert(err.message);
           alert("Please enter the address");
        } */
    };
    navigator.geolocation.getCurrentPosition(success, error, options);
}


$("#btngarage").click(function(event) { 
     var locality = $("#locality").val();
     var latitude = $("#latitude").val();
     var longitude = $("#longitude").val();
     var serviceType = $("input[name='serviceType']:checked").val();
     // alert(serviceType);
     locality = locality.replace(/[_\W]+/g, "-");
     if (locality == '' || latitude == '' || longitude == '' || serviceType == undefined) {
        alert("Please select the correct location or service type");
        return false;
    } else {
        event.preventDefault();
        //getVendorsList();
        window.location.href = base_url + 'garage-list/'+locality+'/'+latitude+'/'+longitude+'/'+serviceType;
    }
}); 

function getVendorsList() {
     var locality = $("#locality").val();
     var latitude = $("#latitude").val();
     var longitude = $("#longitude").val();
     if (locality == '' || latitude == '' || longitude == '') {
         swal('',"Please select the correct location",'error');
    } else {
      ajaxindicatorstart('Please hang on ...while we submit your query ');
        var options = {
            target: '#response',
            beforeSubmit: showAddRequest,
            success: showAddResponse,
            //url: base_url + 'vendor/searched',
            url: base_url + 'vendor/garage-list/locality/latitude/longitude',
            semantic: true,
            dataType: 'json'
        };
        $('#getvendors').ajaxSubmit(options);
    }

}

function showAddRequest(formData, jqForm, options) {
    $("#response").hide();
    var queryString = $.param(formData);
    return true;
}

function showAddResponse(resp, statusText, xhr, $form) {
   if (resp.status == '0') {
    ajaxindicatorstop();
        swal('',resp.msg,'error');
    } else {
      ajaxindicatorstop();
      //swal('',resp.msg,'success');
      /*setTimeout(function() {
      window.location.href = base_url + "select-subcategory";
      }, 2000); */
      //window.location.href = base_url + "select-subcategory";
      window.location.href = base_url + "garage-list";
    }
}

// for running numbers
(function ($) {
$.fn.countTo = function (options) {
options = options || {};

return $(this).each(function () {
// set options for current element
var settings = $.extend({}, $.fn.countTo.defaults, {
from:            $(this).data('from'),
to:              $(this).data('to'),
speed:           $(this).data('speed'),
refreshInterval: $(this).data('refresh-interval'),
decimals:        $(this).data('decimals')
}, options);

// how many times to update the value, and how much to increment the value on each update
var loops = Math.ceil(settings.speed / settings.refreshInterval),
increment = (settings.to - settings.from) / loops;

// references & variables that will change with each update
var self = this,
$self = $(this),
loopCount = 0,
value = settings.from,
data = $self.data('countTo') || {};

$self.data('countTo', data);

// if an existing interval can be found, clear it first
if (data.interval) {
clearInterval(data.interval);
}
data.interval = setInterval(updateTimer, settings.refreshInterval);

// initialize the element with the starting value
render(value);

function updateTimer() {
value += increment;
loopCount++;

render(value);

if (typeof(settings.onUpdate) == 'function') {
settings.onUpdate.call(self, value);
}

if (loopCount >= loops) {
// remove the interval
$self.removeData('countTo');
clearInterval(data.interval);
value = settings.to;

if (typeof(settings.onComplete) == 'function') {
settings.onComplete.call(self, value);
}
}
}

function render(value) {
var formattedValue = settings.formatter.call(self, value, settings);
$self.html(formattedValue);
}
});
};

$.fn.countTo.defaults = {
from: 0,               // the number the element should start at
to: 0,                 // the number the element should end at
speed: 1000,           // how long it should take to count between the target numbers
refreshInterval: 100,  // how often the element should be updated
decimals: 0,           // the number of decimal places to show
formatter: formatter,  // handler for formatting the value before rendering
onUpdate: null,        // callback method for every time the element is updated
onComplete: null       // callback method for when the element finishes updating
};

function formatter(value, settings) {
return value.toFixed(settings.decimals);
}
}(jQuery));

jQuery(function ($) {
  // custom formatting example
  $('.count-number').data('countToOptions', {
formatter: function (value, options) {
 return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
}
  });
 
  // start all the timers
  $('.timer').each(count);  
 
  function count(options) {
var $this = $(this);
options = $.extend({}, options || {}, $this.data('countToOptions') || {});
$this.countTo(options);
  }
});

$('#subscribenews').bootstrapValidator({
    container: function ($field, validator) {
      return $field.parent().next('.messageContainer');
    },

    feedbackIcons: {
      validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
      'sub_email': {
        validators: {
          notEmpty: {
            message: 'Email is required and cannot be empty'
          },
          regexp: {
            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
            message: 'Please enter valid email address.'
          }
        }
      }
      
    }
  }).on('success.form.bv', function (event, data) {
    event.preventDefault();

    var form = $(this);
    var url = form.attr('action');
    form = new FormData(form[0]);

    $.ajax({
      type: "POST",
      url: url,
      data: form,
      processData: false,
      contentType: false,
      success: function(data)
      {
        data = JSON.parse(data);
        if(data.status == '1'){
            $('#thanks').show();
            $('#subscriptiontab').hide();
        }
      }
    });

    return false;
  });

</script>