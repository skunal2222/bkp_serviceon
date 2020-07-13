
<style>
  .car-custom {
    font-size: 20px;
    color: black;
  }
  .custom-banner{
      height: 800px;
      padding: 15% 20% !important;
  }
  .Speciality .nav .slide .glyphicon{
    color:#000;
  }
  #mobileDrop select {
    -webkit-appearance: menulist-button;
  }
    @media screen and (max-width: 1367px) {
        .custom-banner {
            height: 608px;
            padding: 15% 20% !important;
        }
    }
  @media screen and (max-width: 600px) {
  .car-custom {
     font-size: 15px;
  }
  
}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>/frontend/css/banner.css">
<div class="booking">
    <div class="jumbotron custom-banner">
        <h1>Our Services</h1>
        <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed placerat orci in sodales posuere. Aliquam magna quam, molestie a vehiculased, tempor quis turpis.</p>--> 
        <div class="service-quote-section text-center">
          <div class="inline-flex">
                 <button type="button" class="spl-btn service-btn" onclick="window.location.href = '<?php echo base_url();?>select-subcategory';">Book Now
                </button>
                <button type="button" class="spl-btn service-btn bt2" onclick="window.location.href = '<?php echo base_url();?>contact-us';">Contact Us
                </button>
          </div>
      </div>
    </div>
    <div class="">
       <div class="about-us">
        <div class="Speciality">
<!--          <p>Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum 
            lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum 
            ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem 
            lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum  
            lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p>-->
        </div>
          <!-- Our Speciality -->
          <div class="Speciality promise">
              
              <ul class="nav nav-pills nav-justified" >
                  <div class="carousel slide" id="carousel123">
                  <div class="carousel-inner carousel-inner1 nav-pills nav-justified car-custom" style="margin:6px"> 
                     <div class="item active" style="margin-left:5%">
                        <div class="col-sm-3 col-xs-12 center">
                          <li class="active text-left"><a data-toggle="pill" href="#service" style="color:black"><span>Doorstep Bike Servicing</span></a></li>
                        </div>
                       <div class="col-sm-2 col-xs-12  center">
                          <li class="text-left"><a data-toggle="pill" href="#service1" style="color:black"><span>Pick-Up & Drop</span></a></li>
                        </div>
                         <div class="col-sm-2  col-xs-12 center">
                            <li class="text-left"><a data-toggle="pill" href="#service2" style="color:black"><span>B2B Services</span></a></li>
                        </div>
                          <div class="col-sm-4 col-xs-12 center">
                            <li class="text-left"><a data-toggle="pill" href="#service3" style="color:black"><span>Customisation & Modification</span></a></li>
                        </div>
                     </div>
                      <div class="item" style="margin-left:5%">
                          <div class="col-sm-4 col-xs-12 center">
                              <li class="text-left"><a data-toggle="pill" href="#service4" style="color:black"><span>Sports & Super Bike Servicing</span></a></li>
                        </div>
                          <div class="col-sm-4 col-xs-12 center">
                           <li class="text-left"><a data-toggle="pill" href="#service5" style="color:black"><span>Insurance & Insurance Claim</span></a></li>
                        </div>
                        <div class="col-sm-3 col-xs-12 center">
                          <li class="text-left"><a data-toggle="pill" href="#service6" style="color:black"><span>RTO Documentation</span></a></li>
                        </div>
                        </div>
                       <div class="item" style="margin-left:5%">
                        <div class="col-sm-2 col-xs-12 center">
                          <li class="text-left"><a data-toggle="pill" href="#service7" style="color:black"><span>Buy & Sell</span></a></li>
                        </div>
                         <div class="col-sm-2 col-xs-12 center">
                          <li class="text-left"><a data-toggle="pill" href="#service8" style="color:black"><span>E-bike</span></a></li>
                        </div> 
                      </div>  
                     </div>
                  <a class="left carousel-control"  style="background-image:none;width: 0px" href="#carousel123" data-slide="prev"><i class="glyphicon glyphicon-menu-left"></i></a>
                  <a class="right carousel-control" style="background-image:none;width: 0px" href="#carousel123" data-slide="next"><i class="glyphicon glyphicon-menu-right"></i></a>
                     </div>

                  <div class="col-xs-12" id="mobileDrop">
                    <div class="form-group text-left">
                      <label for="sel1">Select Services:</label>
                      <select class="form-control" id="sel1">
                        <option>Doorstep Bike Servicing</option>
                        <option>Pickup & Drop</option>
                        <option>B2B Services</option>
                        <option>Customisation & Modification</option>
                        <option>Sports & Super Bike Servicing</option>
                        <option>Insurance & Insurance Claim</option>
                        <option>RTO Documentation</option>
                        <option>Buy & Sell</option>
                        <option>E-bike</option>
                      </select>
                    </div>
                </div>             
            </ul>

            <div class="tab-content">
              <div id="service" class="tab-pane fade in active">
                <div class="service-sec">
                  <div class="row">
                      <div class="col-sm-7">
                          <!--  <h3>Lorem ipsum lorem ipsum</h3>-->
                          <p>Your comfort is our priority. Feeling lazy to get your bike to the garage? We have you covered. Tell us where it is and we'd take it over from there.</p>
                          <button type="button" class="custom-btn1" onclick="window.location.href = '<?php echo base_url();?>enquiry-form';"> Get A Quote</button>
                      </div>
                       <div class="col-sm-5">
                          <img src="<?php echo asset_url();?>frontend/images/new/ourservices.png" alt="MotorMechs">
                      </div>
                  </div>
                </div>
              </div>
              <div id="service1" class="tab-pane fade">
                <div class="service-sec">
                  <div class="row">
                      <div class="col-sm-7">
                          <!--<h3>Lorem ipsum lorem ipsum</h3>-->
                          <p>Our pick-up vehicle is ready for your services when you need it and where you need it. Afterall, "Your wish is our command." </p>
                          <button type="button" class="custom-btn1" onclick="window.location.href = '<?php echo base_url();?>enquiry-form';"> Get A Quote</button>
                      </div>
                       <div class="col-sm-5">
                          <img src="<?php echo asset_url();?>frontend/images/new/ourservices.png" alt="MotorMechs">
                      </div>
                  </div>
                </div>
              </div>
              <div id="service2" class="tab-pane fade">
                <div class="service-sec">
                  <div class="row">
                      <div class="col-sm-7">
                          <!--<h3>Lorem ipsum lorem ipsum</h3>-->
                          <p>Got a fleet of vehicles but no time to maintain? We feel you. So, we have created flexible B2B plans to fit your bill just right.</p>
                          <button type="button" class="custom-btn1" onclick="window.location.href = '<?php echo base_url();?>enquiry-form';"> Get A Quote</button>
                      </div>
                       <div class="col-sm-5">
                          <img src="<?php echo asset_url();?>frontend/images/new/ourservices.png" alt="MotorMechs">
                      </div>
                  </div>
                </div>
              </div>
              <div id="service3" class="tab-pane fade">
                <div class="service-sec">
                  <div class="row">
                      <div class="col-sm-7">
                          <!--<h3>Lorem ipsum lorem ipsum</h3>-->
                          <p>Rammed your bike into distortion?! Or wanna give your ride a makeover? Don't worry. We promise you that your baby will be up and running in no time with a completely refreshed look. We offer full restoration and customization services.</p>
                          <button type="button" class="custom-btn1" onclick="window.location.href = '<?php echo base_url();?>enquiry-form';"> Get A Quote</button>
                      </div>
                       <div class="col-sm-5">
                          <img src="<?php echo asset_url();?>frontend/images/new/ourservices.png" alt="MotorMechs">
                      </div>
                  </div>
                </div>
              </div>
                <div id="service4" class="tab-pane fade">
                <div class="service-sec">
                  <div class="row">
                      <div class="col-sm-7">
                          <!--<h3>Lorem ipsum lorem ipsum</h3>-->
                          <p>When your bike is not a vehicle but an emotion, you want to take the best care possible. Nobody understands this better than us. Our expert team will leave no stone unturned to give you the best outcomes possible.</p>
                          <button type="button" class="custom-btn1" onclick="window.location.href = '<?php echo base_url();?>enquiry-form';"> Get A Quote</button>
                      </div>
                       <div class="col-sm-5">
                          <img src="<?php echo asset_url();?>frontend/images/new/ourservices.png" alt="MotorMechs">
                      </div>
                  </div>
                </div>
              </div>
                <div id="service5" class="tab-pane fade">
                <div class="service-sec">
                  <div class="row">
                      <div class="col-sm-7">
                          <!--<h3>Lorem ipsum lorem ipsum</h3>-->
                          <p>Worried about the best insurance plan for your bike? Let us handle it for you. We'd not only provide you with the right options but also assist in claiming cover.</p>
                          <button type="button" class="custom-btn1" onclick="window.location.href = '<?php echo base_url();?>enquiry-form';"> Get A Quote</button>
                      </div>
                       <div class="col-sm-5">
                          <img src="<?php echo asset_url();?>frontend/images/new/ourservices.png" alt="MotorMechs">
                      </div>
                  </div>
                </div>
              </div>
                <div id="service6" class="tab-pane fade">
                <div class="service-sec">
                  <div class="row">
                      <div class="col-sm-7">
                          <!--<h3>Lorem ipsum lorem ipsum</h3>-->
                          <p>Hassle-free RTO documentation is a seamless affair with our team working on it relentlessly on your behalf.</p>
                          <button type="button" class="custom-btn1" onclick="window.location.href = '<?php echo base_url();?>enquiry-form';"> Get A Quote</button>
                      </div>
                       <div class="col-sm-5">
                          <img src="<?php echo asset_url();?>frontend/images/new/ourservices.png" alt="MotorMechs">
                      </div>
                  </div>
                </div>
              </div>
                <div id="service7" class="tab-pane fade">
                <div class="service-sec">
                  <div class="row">
                      <div class="col-sm-7">
                          <!--<h3>Lorem ipsum lorem ipsum</h3>-->
                          <p>New beast in town win your heart?! We help you buy it in the first instant. Providing you with all the necessary assistance in your buying and selling.</p>
                          <button type="button" class="custom-btn1" onclick="window.location.href = '<?php echo base_url();?>enquiry-form';"> Get A Quote</button>
                      </div>
                       <div class="col-sm-5">
                          <img src="<?php echo asset_url();?>frontend/images/new/ourservices.png" alt="MotorMechs">
                      </div>
                  </div>
                </div>
              </div>
                <div id="service8" class="tab-pane fade">
                <div class="service-sec">
                  <div class="row">
                      <div class="col-sm-7">
                          <!--<h3>Lorem ipsum lorem ipsum</h3>-->
                          <p>Go green with E-Bike. We buy and sell E-Bikes just with a click of a button.</p>
                          <button type="button" class="custom-btn1" onclick="window.location.href = '<?php echo base_url();?>enquiry-form';"> Get A Quote</button>
                      </div>
                       <div class="col-sm-5">
                          <img src="<?php echo asset_url();?>frontend/images/new/ourservices.png" alt="MotorMechs">
                      </div>
                  </div>
                </div>
              </div>
                
                
            </div>
            
          </div>
          <!-- Our Speciality -->  

       </div>
    </div>
</div>
<script>
   $(document).ready(function () {
       $("#carousel123").carousel({
           interval: false
       });
       if ($(window).width() < 769) {
           $('#carousel123').hide();
           $('#mobileDrop').show();
        }
        else {
           $('#mobileDrop').hide();
            $('#carousel123').show();
        }
   });
   $(".recomment-button").click(function () {
       $(".show-filter").show();
   });
   $("#mobileDrop select").change(function() {
       let dropVal=$(this).val();
       if(dropVal == "Doorstep Bike Servicing"){
        //alert(dropVal);
       $('#service1').removeClass('in active');
       $('#service2').removeClass('in active');
       $('#service3').removeClass('in active');
       $('#service4').removeClass('in active');
       $('#service5').removeClass('in active');
       $('#service6').removeClass('in active');
       $('#service7').removeClass('in active');
       $('#service8').removeClass('in active');
        $('#service').addClass('in active');
       }
       if(dropVal == "Pickup & Drop"){       
        $('#service1').addClass('in active');
         $('#service2').removeClass('in active');
         $('#service3').removeClass('in active');
         $('#service4').removeClass('in active');
         $('#service5').removeClass('in active');
         $('#service6').removeClass('in active');
         $('#service7').removeClass('in active');
         $('#service8').removeClass('in active');
        $('#service').removeClass('in active');
       }
       if(dropVal == "B2B Services"){
                
         $('#service1').removeClass('in active');
         $('#service2').addClass('in active');
         $('#service3').removeClass('in active');
         $('#service4').removeClass('in active');
         $('#service5').removeClass('in active');
         $('#service6').removeClass('in active');
         $('#service7').removeClass('in active');
         $('#service8').removeClass('in active');
        $('#service').removeClass('in active');
       }
        if(dropVal == "Customisation & Modification"){
          $('#service1').removeClass('in active');
         $('#service2').removeClass('in active');
         $('#service3').addClass('in active');
         $('#service4').removeClass('in active');
         $('#service5').removeClass('in active');
         $('#service6').removeClass('in active');
         $('#service7').removeClass('in active');
         $('#service8').removeClass('in active');
        $('#service').removeClass('in active');
        }
        if(dropVal == "Sports & Super Bike Servicing"){
          $('#service1').removeClass('in active');
         $('#service2').removeClass('in active');
         $('#service3').removeClass('in active');
         $('#service4').addClass('in active');
         $('#service5').removeClass('in active');
         $('#service6').removeClass('in active');
         $('#service7').removeClass('in active');
         $('#service8').removeClass('in active');
        $('#service').removeClass('in active');
        }
        if(dropVal == "Insurance & Insurance Claim"){
          $('#service1').removeClass('in active');
         $('#service2').removeClass('in active');
         $('#service3').removeClass('in active');
         $('#service4').removeClass('in active');
         $('#service5').addClass('in active');
         $('#service6').removeClass('in active');
         $('#service7').removeClass('in active');
         $('#service8').removeClass('in active');
        $('#service').removeClass('in active');
        }
        if(dropVal == "RTO Documentation"){
          $('#service1').removeClass('in active');
         $('#service2').removeClass('in active');
         $('#service3').removeClass('in active');
         $('#service4').removeClass('in active');
         $('#service5').removeClass('in active');
         $('#service6').addClass('in active');
         $('#service7').removeClass('in active');
         $('#service8').removeClass('in active');
        $('#service').removeClass('in active');
        }
        if(dropVal == "Buy & Sell"){
          $('#service1').removeClass('in active');
         $('#service2').removeClass('in active');
         $('#service3').removeClass('in active');
         $('#service4').removeClass('in active');
         $('#service5').removeClass('in active');
         $('#service6').removeClass('in active');
         $('#service7').addClass('in active');
         $('#service8').removeClass('in active');
        $('#service').removeClass('in active');
        }
        if(dropVal == "E-bike"){
          $('#service1').removeClass('in active');
         $('#service2').removeClass('in active');
         $('#service3').removeClass('in active');
         $('#service4').removeClass('in active');
         $('#service5').removeClass('in active');
         $('#service6').removeClass('in active');
         $('#service7').removeClass('in active');
         $('#service8').addClass('in active');
          $('#service').removeClass('in active');
        }
    });

</script>