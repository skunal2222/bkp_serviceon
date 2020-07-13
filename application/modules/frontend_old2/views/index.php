<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/booking-flow/selectize.bootstrap3.css">
<script type="text/javascript" src="<?php echo asset_url();?>js/selectize.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/booking-flow/package.css">



<style type="text/css">
  .text-box{
    border-radius: 29px !important;
    box-shadow: 0px 0px !important;
    font-size: 18px;
    font-weight: 500;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.5;
    letter-spacing: 0.7px;
    text-align: left;
    color: #838383;
    padding: 5px 12px;
    border: 1px solid #cecece !important;
    height: 50px;
    min-height: 40px !important;
  }
  .custom-banner{
      height: 800px;
  }
  .custom-img1 {
       height: 530px;
  }
  @media screen and (max-width: 1367px) {
      .custom-banner {
          height: 608px;
      }
  }
  @media screen and (max-width: 600px) {
      .custom-banner {
          height: 341px;
      }
      .custom-img1 {
          height: none;
      }
}
</style>
<script>
   // alert($(window).width());
    </script>
<div class="jumbotron text-center custom-banner">
  <h1>DOORSTEP BIKE SERVICING</h1> 
  <p>GETTING A BIKE IS EASY. MAINTAINING IT IS A PAIN.</p> 
  <form id="getvendors" name="getvendors" action="" method="post">  
    <div  class="input-group">  
       
        <input type="text" name="locality"  required class="form-control custom-add text-box" id="locality" placeholder="Enter your location" data-rule="minlen:4" style="position:static" data-msg="Please enter at least 4 chars" />
       <a href="javascript:locateMe()" style="display:inline-block;margin-left:-50px"><img src="<?= asset_url()?>images/Locate-me.png" alt="location" class="select-img2" style="height:34px;margin-top: 6px"></a>
      <div class="input-group-btn">
         <input type="hidden" id="latitude" name="latitude" value="">
              <input type="hidden" id="longitude" name="longitude" value="">
        <button type="button" class="spl-btn" onclick="getVendorsList()">Search</button>
      </div> 
    </div> 
  </form>
</div 
<!-- select-location -->


<!--about us section-->
  <div class="about-sec">
    <div class="container">
       <div class="row">
          <div class="col-sm-5">
              <div class="video-section">
                 <img src="<?php echo asset_url();?>frontend/images/new/BD-Fold-2.jpg" alt="">
              </div>
          </div>
           <div class="col-sm-7" style="margin-top:4%">
              <h2>About Us</h2>
              <p>We are the one-stop shop for two-wheeler servicing, repair and break down assisstance. When in need of a high quality and low cost service, reach out to us and we would be at your doorstep in a heartbeat.  Turnaround time for full service? Just 2 hours! Impressed already? Wait till you see your renewed bike!
</p>
              <button type="button" class="custom-btn1" onclick="window.location.href = '<?php echo base_url();?>about-us';"> View More</button>    
          </div>
       </div>
    </div>
  </div>
<!--about us section-->


<!--Our Services section desktop-->
  <div class="service-sec service-sec-desktop">
    <div class="container">
        <h2>Our Services</h2>
        <!--<p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit in <br/>sodales posuere.tempor quis turpis.</p><br/><br/>-->
        <div class="row bg-bike">
          <div class="col-sm-5">
             <div class="service-name text-right">
               <div class="row">
                  <div class="col-sm-9 col-xs-9">
                      <h3>B2B Services</h3>
                      <p>Flexible servicing plans for fleet of vehicles of your business ventures.</p>
                  </div>
                  <div class="col-sm-3 col-xs-3">
                      <img src="<?php echo asset_url();?>frontend/images/new/services-icon/B2Bicon.png" alt="">
                  </div>
                </div>
             </div>
             <div class="service-name text-right">
               <div class="row">
                  <div class="col-sm-9 col-xs-9">
                      <h3>Customisation & Modification</h3>
                      <p>Modification and restoration works of your two-wheeler.</p>
                  </div>
                  <div class="col-sm-3 col-xs-3">
                      <img src="<?php echo asset_url();?>frontend/images/new/services-icon/Customicon.png" alt="">
                  </div>
                </div>
             </div>
             <div class="service-name text-right">
               <div class="row">
                  <div class="col-sm-9 col-xs-9">
                      <h3>Sports & Super Bike Servicing</h3>
                      <p>Hypersports and sports bike maintenance at your doorstep.</p>
                  </div>
                  <div class="col-sm-3 col-xs-3">
                      <img src="<?php echo asset_url();?>frontend/images/new/services-icon/sportsicon.png" alt="">
                  </div>
                </div>
             </div>
              <div class="service-name text-right">
               <div class="row">
                  <div class="col-sm-9 col-xs-9">
                      <h3>Insurance & Insurance Claim</h3>
                      <p>Get help on new insurance cover/insurance renewal/insurace claim with our association.</p>
                  </div>
                  <div class="col-sm-3 col-xs-3">
                      <img src="<?php echo asset_url();?>frontend/images/new/services-icon/insuranceicon.png" alt="">
                  </div>
                </div>
             </div>
          </div>
          <div class="col-sm-2 text-center">
             
          </div>
          <div class="col-sm-5">
              <div class="service-name text-left">
               <div class="row">
                   <div class="col-sm-3 col-xs-3">
                      <img src="<?php echo asset_url();?>frontend/images/new/services-icon/insuranceicon.png" alt="">
                  </div>
                  <div class="col-sm-9 col-xs-9">
                      <h3>Insurance & Insurance Claim</h3>
                      <p>Get help on new insurance cover/insurance renewal/insurace claim with our association.</p>
                  </div>
                  
                </div>
             </div>
            <div class="service-name text-left">
               <div class="row">
                  <div class="col-sm-3 col-xs-3">
                      <img src="<?php echo asset_url();?>frontend/images/new/services-icon/documentationicon.png" alt="">
                  </div>
                  <div class="col-sm-9 col-xs-9">
                      <h3>RTO Documentation</h3>
                      <p>Hassle-free RTO documentation with the help of our team.</p>
                  </div>
                </div>
             </div>
             <div class="service-name text-left">
               <div class="row">
                  <div class="col-sm-3 col-xs-3">
                      <img src="<?php echo asset_url();?>frontend/images/new/services-icon/buy&sellicon.png" alt="">
                  </div>
                  <div class="col-sm-9 col-xs-9">
                      <h3>Buy & Sell</h3>
                      <p>Assist in buying and selling of used vehicles</p>
                  </div>
                </div>
             </div>
             <div class="service-name text-left">
               <div class="row">
                  <div class="col-sm-3 col-xs-3">
                      <img src="<?php echo asset_url();?>frontend/images/new/services-icon/ebikeicon.png" alt="">
                  </div>
                  <div class="col-sm-9 col-xs-9">
                      <h3>E-bike</h3>
                      <p>Sale & service of E-bikes.</p>
                  </div>
                </div>
             </div>
              
              
          </div>
        </div>
    </div>
  </div>
<!--Our Services section desktop-->

<!--Our Services section mobile-->
  <div class="service-sec service-sec-mobile">
    <div class="container">
        <h2>Our Services</h2>
        <!--<p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit in <br/>sodales posuere.tempor quis turpis.</p><br/><br/>-->
        <div class="row bg-bike">
          <div class="col-sm-5">
             <div class="service-name text-right">
               <div class="row">
                  <div class="col-sm-9 col-xs-9">
                      <br><h3>B2B Services</h3>                      
                  </div>
                  <div class="col-sm-3 col-xs-3">
                      <img src="<?php echo asset_url();?>frontend/images/new/services-icon/B2Bicon.png" alt="">
                  </div>
                  <div class="col-xs-12"><br><p>Flexible servicing plans for fleet of vehicles of your business ventures.</p></div>
                </div>
             </div>
             <div class="service-name text-left">
               <div class="row">
                  <div class="col-sm-3 col-xs-3">
                      <img src="<?php echo asset_url();?>frontend/images/new/services-icon/Customicon.png" alt="">
                  </div>
                  <div class="col-sm-9 col-xs-9">
                      <br><h3>Customisation & Modification</h3>
                  </div>
                  <div class="col-xs-12"><br><p>Modification and restoration works of your two-wheeler.</p>
                  </div>
                </div>
             </div>
             <div class="service-name text-right">
               <div class="row">
                  <div class="col-sm-9 col-xs-9">
                      <br><h3>Sports & Super Bike Servicing</h3>
                      
                  </div>
                  <div class="col-sm-3 col-xs-3">
                      <img src="<?php echo asset_url();?>frontend/images/new/services-icon/sportsicon.png" alt="">
                  </div>
                  <div class="col-xs-12"><br><p>Hypersports and sports bike maintenance at your doorstep.</p>
                  </div>
                </div>
             </div>
              <div class="service-name text-left">
               <div class="row">
                  <div class="col-sm-3 col-xs-3">
                      <img src="<?php echo asset_url();?>frontend/images/new/services-icon/insuranceicon.png" alt="">
                  </div>
                  <div class="col-sm-9 col-xs-9">
                     <br><h3>Insurance & Insurance Claim</h3>
                  </div>
                  <div class="col-xs-12"><br><p>Get help on new insurance cover/insurance renewal/insurace claim with our association.</p>
                  </div>
                </div>
             </div>
          </div>
          <div class="col-sm-2 text-center">
             
          </div>
          <div class="col-sm-5">
              <div class="service-name text-right">
               <div class="row">
                  <div class="col-sm-9 col-xs-9">
                      <br><h3>Insurance & Insurance Claim</h3>
                  </div>
                   <div class="col-sm-3 col-xs-3">
                      <img src="<?php echo asset_url();?>frontend/images/new/services-icon/insuranceicon.png" alt="">
                  </div>
                  <div class="col-xs-12"><br>
                      <p>Get help on new insurance cover/insurance renewal/insurace claim with our association.</p>
                  </div>
                </div>
             </div>
            <div class="service-name text-left">
               <div class="row">
                  <div class="col-sm-3 col-xs-3">
                      <img src="<?php echo asset_url();?>frontend/images/new/services-icon/documentationicon.png" alt="">
                  </div>
                  <div class="col-sm-9 col-xs-9">
                      <br><h3>RTO Documentation</h3>
                  </div>
                  <div class="col-xs-12"><br>
                      <p>Hassle-free RTO documentation with the help of our team.</p>
                  </div>
                </div>
             </div>
             <div class="service-name text-right">
               <div class="row">                  
                  <div class="col-sm-9 col-xs-9">
                      <br><h3>Buy & Sell</h3>
                  </div>
                  <div class="col-sm-3 col-xs-3">
                      <img src="<?php echo asset_url();?>frontend/images/new/services-icon/buy&sellicon.png" alt="">
                  </div>
                  <div class="col-xs-12"><br>
                      <p>Assist in buying and selling of used vehicles</p>
                  </div>
                </div>
             </div>
             <div class="service-name text-left">
               <div class="row">
                  <div class="col-sm-3 col-xs-3">
                      <img src="<?php echo asset_url();?>frontend/images/new/services-icon/ebikeicon.png" alt="">
                  </div>
                  <div class="col-sm-9 col-xs-9">
                      <br><h3>E-bike</h3>                      
                  </div>
                  <div class="col-xs-12"><br>
                      <p>Sale & service of E-bikes.</p>
                  </div>
                </div>
             </div>
              
              
          </div>
        </div>
    </div>
  </div>
<!--Our Services section mobile-->

<!--Record section-->
  <div class="record-sec">
    <div class="container">
      <div class="row">
         <div class="col-sm-4 ">
           <img  class="custom-img1" src="<?php echo asset_url();?>frontend/images/new/ourrecords.png" alt="" class="record-banner">
         </div>
         <div class="col-sm-8" id="count-div">
            <div class="record-txt">
              <h2>We Have World Class <br/>Records</h2>
              <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit in <br/>sodales posuere.tempor quis turpis.</p>-->
              <div class="record-name">
                 <div class="row">
                    <div class="col-sm-2 col-xs-4">
                        <img src="<?php echo asset_url();?>frontend/images/new/records1.png" alt="">
                    </div>
                    <div class="col-sm-10 col-xs-8">
                        <h3><span class="count" >17000+ Servicing Done</span></h3>
                        <!--<p>Lorem ipsum dolor</p>-->
                    </div>
                  </div>
              </div>            
              <div class="record-name">
                 <div class="row">
                    <div class="col-sm-2 col-xs-4">
                        <img src="<?php echo asset_url();?>frontend/images/new/record2.png" alt="">
                    </div>
                    <div class="col-sm-10 col-xs-8">
                        <h3><span class="count" >Team of 25</span></h3>
                        <!--<p>Lorem ipsum dolor</p>-->
                    </div>
                  </div>
              </div>
              <div class="record-name">
                 <div class="row">
                    <div class="col-sm-2 col-xs-4">
                        <img src="<?php echo asset_url();?>frontend/images/new/record3.png" alt="">
                    </div>
                    <div class="col-sm-10 col-xs-8">
                        <h3><span class="count">Experience 2.5 years</span></h3>
                        <!--<p>Lorem ipsum dolor</p>-->
                    </div>
                  </div>
              </div>
            </div>
         </div>
      </div>
    </div>
  </div>
<!--Record section-->

<!--why us section-->
  <div class="why-us-sec">
    <div class="container">
      <h2>Why BikeDoctor?!</h2>
      <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit in sodales <br/>posuere.tempor quis turpis.</p>-->
<br/>
      <div class="row info">
        <div class="col-sm-8 ">
          <div class="why-us-txt">
            <p style="font-size:18px; margin: 0px">BIKEDOCTOR solves the problem of Two-wheeler consumers by  providing services @ customer's home/office or any convenient place having very low cost maintenance with total transparency in spares, accessories, consumables and pricing.</p>
           <p style="font-size:18px; margin: 0px">Bikedoctor employs best, trained professionals to take care of all your bike needs at your doorstep. Being a pioneer in the business we have identified the problems faced by the consumer in maintaining the bike and have come up with a unique, mobile solution.</p>
           <p style="font-size:18px; margin: 0px">So when you ask, "Why Bikedoctor?" we ask "Why only BikeDoctor?"</p>
           <p style="font-size:18px; margin: 0px">Women-friendly, easy on your wallet, laid-back solution to the bike needs, total transparency in the transactions. Do you still need a reason?!</p>
          <button type="button" class="custom-btn1" onclick="window.location.href = '<?php echo base_url();?>about-us';"> View More</button>  
          </div> 
        </div>
        <div class="col-sm-4">
          <img src="<?php echo asset_url();?>frontend/images/new/whyus.png" alt="">
        </div>
      </div>
    </div>
  </div>
<!--why us section 

<!--partner section -->
<div class="partner-sec">
    <div class="container">
        <div id="carouselpartner" class="carousel  carousel-showmanymoveone1 slide" data-ride="carousel">
            <!-- Indicators -->

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <?php if(!empty($brands)) {  ?>
            <?php $a = 1 ;foreach($brands as $value) {?>
             <?php $active = $a == 1 ? 'active' : '';?>
                <div class="item <?= $active?>">
 
                  <div class="col-xs-12 col-sm-6 col-md-3 text-center">
                    <!-- <img src="<?php echo asset_url();?>images/brand/KTM.png" alt="KTM"> -->
                    <h1><?= strtoupper($value['name']) ?></h1>
                  </div>
                </div>

                 <?php $a++;}}?>

                <!-- <div class="item active">
                  <div class="col-xs-12 col-sm-6 col-md-3">
                    <img src="<?php echo asset_url();?>images/brand/BAJAJ.png" alt="BAJAJ">
                  </div>
                </div>
                <div class="item">
                  <div class="col-xs-12 col-sm-6 col-md-3">
                    <img src="<?php echo asset_url();?>images/brand/KTM.png" alt="KTM">
                  </div>
                </div>
                <div class="item">
                  <div class="col-xs-12 col-sm-6 col-md-3">
                    <img src="<?php echo asset_url();?>images/brand/HERO.png" alt="HERO">
                  </div>
                </div>

                <div class="item">
                  <div class="col-xs-12 col-sm-6 col-md-3">
                    <img src="<?php echo asset_url();?>images/brand/TVS.png" alt="TVS">
                  </div>
                </div> 
                <div class="item">
                  <div class="col-xs-12 col-sm-6 col-md-3">
                    <img src="<?php echo asset_url();?>images/brand/SUZUKI.png" alt="SUZUKI">
                  </div>
                </div>
                <div class="item">
                  <div class="col-xs-12 col-sm-6 col-md-3">
                    <img src="<?php echo asset_url();?>images/brand/MAHINDRA.png" alt="MAHINDRA">
                  </div>
                </div> 
                <div class="item">
                  <div class="col-xs-12 col-sm-6 col-md-3">
                    <img src="<?php echo asset_url();?>images/brand/KAWASAKI.png" alt="KAWASAKI">
                  </div>
                </div>
                 <div class="item">
                  <div class="col-xs-12 col-sm-6 col-md-3">
                    <img src="<?php echo asset_url();?>images/brand/HONDA.png" alt="HONDA">
                  </div>
                </div>
                <div class="item">
                  <div class="col-xs-12 col-sm-6 col-md-3">
                    <img src="<?php echo asset_url();?>images/brand/DUCATI.png" alt="DUCATI">
                  </div>
                </div> 
                <div class="item">
                  <div class="col-xs-12 col-sm-6 col-md-3">
                    <img src="<?php echo asset_url();?>images/brand/YAMAHA.png" alt="YAMAHA">
                  </div>
                </div> -->
            </div>
          </div>
    </div>
  </div>
<!--partner section -->

<!--our packages section -->

  <div class="packages-sec">

     <div class="">
        <h3>Our Offers / Packages</h3>
        <!--<p>Lorem ipsum dolor sit amet, ligula magna at etiam</p>-->
        <div class="carousel carousel-showmanymoveone1 slide" id="carouselpackage" style="margin-top:2%">
        <div class="carousel-inner">
            <?php if(!empty($packages)) {  ?>
            <?php $a = 1 ;foreach($packages as $value) {?>
             <?php $active = $a == 1 ? 'active' : '';?>
          <div class="item <?= $active?>">
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="package text-center">
                  <img src="<?php echo asset_url();?><?= $value['image']?>" alt="thankyou" style="margin-bottom: 1%;">
                  <h3 style="margin-top: 3%;"><?= $value['package_name']?></h3>
                  <h4>Rs <strike><?= number_format($value['best_price'])?></strike> Rs <?= number_format($value['special_price'])?>  </h4> 
                  <div style="height: 40px">
                 <!--  <?php $b = 1;
                  foreach($value['services'] as $service) { 
                      if($b <= 3) { ?>
                  
                  <p><?= $service?></p>
                  
                  <?php } $b++;}?> -->
                      <p class="know-more-btn"><?= $value['short_description']?> </p>

                  </div >
                  <!--<h5>Rs. <?= $value['special_price']?></h5>-->
                  <button type="button" class="know-more-btn" onclick="packageView(<?=$value['id']?>)">Know More+</button>
                <!-- <button type="button" class="custom-btn1" onclick="window.location.href = '<?php echo base_url();?>book-service';">Buy Now</button> -->
                <button type="button" class="custom-btn1" onclick="setPackage(<?= $value['id'];?>)">Buy Now</button>
              </div>
            </div>
          </div>
            <?php $a++;}}?>
        </div>
        <a class="left carousel-control" href="#carouselpackage" data-slide="prev">
          <img src="<?php echo asset_url();?>frontend/images/new/left-arrow.png" class="arrow-img left-img">
        </a>
        <a class="right carousel-control" href="#carouselpackage" data-slide="next"> 
          <img src="<?php echo asset_url();?>frontend/images/new/right-arrow.png" class="arrow-img right-img">
        </a>
      </div>
     </div>
  </div>
<!--our packages section -->

<!--testimonial section -->
  <div class="why-us-sec testimonial">
    <div class="container">
       <h2>Testimonials</h2>
       <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit <br/>in sodales posuere.tempor quis turpis.</p>-->
        <div class="row">
            <div class="col-md-12">
              <div class="carousel carousel-showmanymoveone slide" id="carouselABC">
                <ol class="carousel-indicators">
                  <li data-target="#carouselABC" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselABC" data-slide-to="1"></li>
                  <li data-target="#carouselABC" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <div class="col-xs-12 col-sm-6 col-md-4">
                     <div class="testimonial-box">
                      <p style="height:95px;">Amazing Service - I don't think I will ever gonna visit any garage now.. Good work guys.. All the Best.</p>
                      <div class="row">
                        <div class="col-sm-3 col-xs-3">
                          <img src="<?php echo asset_url();?>frontend/images/testimonial/pallavi-raut.jpg" alt="pallavi-raut">
                        </div>
                        <div class="col-sm-9 col-xs-9">
                           <h4>Pallavi Raut</h4>
                           <h5>(Infosys, Pune)</h5>
                        </div>
                      </div>
                     </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="col-xs-12 col-sm-6 col-md-4">
                      <div class="testimonial-box">
                      <p style="height:95px;">These guys are unbelievable - They came early morning to service my bike, just because I have a tight schedule.</p>
                      <div class="row">
                        <div class="col-sm-3 col-xs-3">
                          <img src="<?php echo asset_url();?>frontend/images/testimonial/swapnil-bhandari.jpg" alt="swapnil-bhandari">
                        </div>
                        <div class="col-sm-9 col-xs-9">
                           <h4>Swapnil Bhandari</h4>
                           <h5>(Entrepreneur, Pune)</h5>
                        </div>
                      </div>
                     </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="col-xs-12 col-sm-6 col-md-4">
                      <div class="testimonial-box">
                      <p style="height:95px;">Thanks Bike Doctor Team to help me in time, otherwise this breakdown of my Bike could cost me a lot.</p>
                      <div class="row">
                        <div class="col-sm-3 col-xs-3">
                          <img src="<?php echo asset_url();?>frontend/images/testimonial/Ketan-Mujumdar.jpg" alt="Ketan-Mujumdar">
                        </div>
                        <div class="col-sm-9 col-xs-9">
                           <h4>Ketan Mujumdar</h4>
                           <h5>(Accenture, Pune)</h5>
                        </div>
                      </div>
                     </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="col-xs-12 col-sm-6 col-md-4">
                      <div class="testimonial-box">
                      <p style="height:95px;">The best service in City - kaam bahot easy kar diya.</p>
                      <div class="row">
                        <div class="col-sm-3 col-xs-3">
                          <img src="<?php echo asset_url();?>frontend/images/testimonial/hemant-chahankar.jpg" alt="hemant-chahankar">
                        </div>
                        <div class="col-sm-9 col-xs-9">
                           <h4>Hemant Chahankar</h4>
                           <h5>(Infosys, Pune)</h5>
                        </div>
                      </div>
                     </div>
                    </div>
                  </div>
                 <div class="item">
                    <div class="col-xs-12 col-sm-6 col-md-4">
                      <div class="testimonial-box">
                          <p style="height:95px;">So friendly - still stick to commitment and use genuine spare parts, oil etc.</p>
                      <div class="row">
                        <div class="col-sm-3 col-xs-3">
                          <img src="<?php echo asset_url();?>frontend/images/testimonial/harshad-raut.jpg" alt="harshad-raut">
                        </div>
                        <div class="col-sm-9 col-xs-9">
                           <h4>Harshad Raut</h4>
                           <h5>(SBI, Pune)</h5>
                        </div>
                      </div>
                     </div>
                    </div>
                  </div> 
                  <div class="item">
                    <div class="col-xs-12 col-sm-6 col-md-4">
                      <div class="testimonial-box">
                      <p style="height:95px;">Bike Doctor cracked the best deal for my Bike in such a short span - 24 hrs.</p>
                      <div class="row">
                        <div class="col-sm-3 col-xs-3">
                          <img src="<?php echo asset_url();?>frontend/images/testimonial/Piyush-Umate.jpg" alt="Piyush-Umate">
                        </div>
                        <div class="col-sm-9 col-xs-9">
                           <h4>Piyush Umate </h4>
                           <h5>(SEED Service, Pune)</h5>
                        </div>
                      </div>
                     </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="col-xs-12 col-sm-6 col-md-4">
                      <div class="testimonial-box">
                      <p style="height:95px;"> Amazing service at the rate I can never imagine.</p>
                      <div class="row">
                        <div class="col-sm-3 col-xs-3">
                          <img src="<?php echo asset_url();?>frontend/images/testimonial/kritika-gupta.jpg" alt="kritika-gupta">
                        </div>
                        <div class="col-sm-9 col-xs-9">
                           <h4>Kritika Gupta</h4>
                           <h5>(Accenture, Pune)</h5>
                        </div>
                      </div>
                     </div>
                    </div>
                  </div>  
                </div>
              </div>
            </div>
          </div> 
    </div>
  </div>
<!--testimonial section -->

<!--blog section-->
<!--  <div class="why-us-sec bg-white">
    <div class="container">
      <h2><span class="blue">Our Blogs</span></h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit in sodales <br/>posuere.tempor quis turpis.</p><br/><br/>
      <div class="row">
        <div class="col-sm-4">
           <div class="blog-box">
              <img src="<?php echo asset_url();?>frontend/images/new/36.png" alt="GarageWorks">
              <div class="blog-padding">
                <p>Date</p>
                <h4>Lorem ipsum lorem ipsum lorem </h4>
                <p>Lorem ipsum dolor sit amet, cons ectetur adipiscielit, sed do eiusm od tempor incididunt ut labore et </p>
                <button type="button" class="read-btn">Read Article <img src="<?php echo asset_url();?>frontend/images/right.png" alt="GarageWorks"></button>
              </div>
           </div>
        </div>
        <div class="col-sm-4">
          <div class="blog-box">
              <img src="<?php echo asset_url();?>frontend/images/new/37.png" alt="GarageWorks">
              <div class="blog-padding">
                <p>Date</p>
                <h4>Lorem ipsum lorem ipsum lorem </h4>
                <p>Lorem ipsum dolor sit amet, cons ectetur adipiscielit, sed do eiusm od tempor incididunt ut labore et </p>
                <button type="button" class="read-btn">Read Article <img src="<?php echo asset_url();?>frontend/images/right.png" alt="GarageWorks"></button>
              </div>
           </div>
        </div>
        <div class="col-sm-4">
          <div class="blog-box">
              <img src="<?php echo asset_url();?>frontend/images/new/35.png" alt="GarageWorks">
              <div class="blog-padding">
                <p>Date</p>
                <h4>Lorem ipsum lorem ipsum lorem </h4>
                <p>Lorem ipsum dolor sit amet, cons ectetur adipiscielit, sed do eiusm od tempor incididunt ut labore et </p>
                <button type="button" class="read-btn">Read Article <img src="<?php echo asset_url();?>frontend/images/right.png" alt="GarageWorks"></button>
              </div>
           </div>
        </div>
      </div>
    </div>
  </div>-->
  <!--<hr/>-->
<!--blog section--> 

<!-- know more package pop up -->
                      <!-- Modal -->
                        <div id="know-package-modal" class="modal fade" role="dialog">
                          <div class="modal-dialog modal-md">
                        
                            <!-- Modal content-->
                            <div class="modal-content know-more-div">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <div class="modal-body">
                                <div class="text-center">
                                  <h3>What is included in this package?</h3>
                                  <p>* Lorem ipsum lorem ipsum lorem ipsum </p>
                                  <p>* Lorem ipsum lorem ipsum lorem ipsum </p>
                                  <p>* Lorem ipsum lorem ipsum lorem ipsum </p>
                                  <p>* Lorem ipsum lorem ipsum lorem ipsum </p>
                                  <p>* Lorem ipsum lorem ipsum lorem ipsum </p>
                                  <p>* Lorem ipsum lorem ipsum lorem ipsum </p>
                                  <div class="inline-flex">
                                    <br/>
                                  <button type="button" class="custom-btn1"  onclick="window.location.href = '<?php echo base_url();?>book-service';" >Select Now</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                        
                          </div>
                        </div>
                      <div id="quick_view_Popup"></div>
                      <!-- Modal -->  
                    <!-- know more package pop up -->

 <script>
   (function(){
    // setup your carousels as you normally would using JS
    // or via data attributes according to the documentation
    // https://getbootstrap.com/javascript/#carousel
    $('#carouselpartner').carousel({ interval: 4000 });
    $('#carouselABC').carousel({ interval: 4000 });
    //$('#carouselpackage').carousel({ interval: 2000 });
  }());
  
    (
      function(){
      $('.carousel-showmanymoveone .item').each(function(){
        var itemToClone = $(this);

        for (var i=1;i<3;i++) {
          itemToClone = itemToClone.next();

          // wrap around if at end of item collection
          if (!itemToClone.length) {
            itemToClone = $(this).siblings(':first');
          }

          // grab item, clone, add marker class, add to collection
          itemToClone.children(':first-child').clone()
            .addClass("cloneditem-"+(i))
            .appendTo($(this));
        }
      });
    }());
    (function(){
      $('.carousel-showmanymoveone1 .item').each(function(){
        var itemToClone = $(this);

        for (var i=1;i<4;i++) {
          itemToClone = itemToClone.next();

          // wrap around if at end of item collection
          if (!itemToClone.length) {
            itemToClone = $(this).siblings(':first');
          }

          // grab item, clone, add marker class, add to collection
          itemToClone.children(':first-child').clone()
            .addClass("cloneditem-"+(i))
            .appendTo($(this));
        }
      });
    }());
 </script>
 <script>
     var a = 0;
     $(window).scroll(function() {

       var oTop = $('#count-div').offset().top - window.innerHeight;
       if (a == 0 && $(window).scrollTop() > oTop) {
         $('.count').each(function() {
           var $this = $(this),
             countTo = $this.attr('data-count');
           $({
             countNum: $this.text()
           }).animate({
               countNum: countTo
             },

             {

               duration: 2000,
               easing: 'swing',
               step: function() {
                 $this.text(Math.floor(this.countNum));
               },
               complete: function() {
                 $this.text(this.countNum);
                 //alert('finished');
               }

             });
         });
         a = 1;
       }

     });
</script>

<script> 
var delay = 5000;
setTimeout(function() { locateMe(); }, delay);
$(document).ready(function(){
locateMe();
});


$.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&callback=initMap&key=AIzaSyCH-u-UD2bz6cfPEAe8mCVyrnnI7ONx9ro"); 

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
        timeout: 5000,
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


$("#locality").keypress(function(event) { 
     if (event.which == 13) {
        event.preventDefault();
        getVendorsList();
        return false;
    }
}); 

function getVendorsList() {
     var locality = $("#locality").val();
     if (locality == '') {
         swal('',"Please enter the address",'error');
    } else {
      ajaxindicatorstart('Please hang on ...while we submit your query ');
        var options = {
            target: '#response',
            beforeSubmit: showAddRequest,
            success: showAddResponse,
            url: base_url + 'vendor/searched',
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
      window.location.href = base_url + "select-subcategory";
    }
}
var userid = '<?php echo $this->session->userdata('olouserid') ; ?>';

function quickView(id){ 
     $.post(base_url+"quickView", {id : id}, function(data){
          $('#quick_view_Popup').html(data); 
             $("#package_modal").modal('show');
          },'html');
 }

function packageView(id){ 
     $.post(base_url+"packageView", {id : id}, function(data){
          $('#quick_view_Popup').html(data); 
             $("#package_modal").modal('show');
          },'html');
 }


  </script>
  <script> 

  function setPackage(id){ 
      window.location.href = base_url + 'select-subcategory';
      if(id==""){
          swal('','Please select Package','error'); 
    }else{
        $.post(base_url+'setPackage',{package_id:id},function(data){
          console.log(data);
          if(data.status==1){
                if(userid!=""){ 
                window.location.href=base_url+'select-user-address'; 
              }else{
                 $('#myLoginModal').modal('show');
              }
            }
        },'json');
      }

  }
    </script>
<!-- select-location -->