<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Garage2Ghar - Bike and car servicing at your doorstep</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="Get your bike and car serviced at your doorstep. We provide breakdown assistance at any place, pick up and drop service and doorstep servicing. Top notch servicing at the most affordable price. Book Now" name="description">
    <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
    <meta property="og:title" content="Garage2Ghar - Book bike and car servicing at your doorstep online">
    <meta property="og:image" content="">
    <meta property="og:url" content="<?php echo base_url();?>">
    <meta property="og:site_name" content="">
    <meta property="og:description" content="Most affordable bike and car servicing near you. Book online and get amazing offers on doorstep and pick up-drop service.">
    <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="">
    
    <meta name="google-site-verification" content="0Uh76CrTn-tdD7Z2kTn28vi3-zRMAjRLie1DcB5bdEs" />
    <meta name="msvalidate.01" content="DEFF8E1D668997BB8CFD4264E2C05F79" />
<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-111679248-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		
		gtag('config', 'UA-111679248-1');
	</script>
    
    <!-- Favicon -->
    <link href="<?php echo asset_url();?>images/img/favicon.ico" rel="icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700|Roboto:400,900" rel="stylesheet">
    <!-- Bootstrap CSS File -->
    <link href="<?php echo asset_url();?>js/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Libraries CSS Files -->
    <link href="<?php echo asset_url();?>js/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Main Stylesheet File -->
    <link href="<?php echo asset_url();?>css/custom.css" rel="stylesheet">
    <!-- Home Stylesheet File -->
    <link href="<?php echo asset_url();?>css/home.css" rel="stylesheet">
    
    <style>
    .input-group-btn {
        position: relative !important;
        font-size: 15px !important;
        white-space: nowrap !important;
    }
    .features h2 {
    margin-right: 30px;
    font-size: 24px;
    color: #292b2c !important;;
}
#contact h2 {
    font-family: "Raleway", Helvetica, Arial, sans-serif;
    color: #292b2c !important;;
}
h2{
font-weight: 600 !important;;;
}
@media only screen and (min-width:768px){
.lgsi{
 padding: 22px 2px 18px 2px;
}
.desktop-display{
display:inline-block;
}
}
@media only screen and (max-width:767px) and (min-width:300px){
.lgsi{
 padding: 10px 22px 10px 15px;
}
.desktop-display{
display:none
}
	.dropdown-content{

display:block !important;

}
#mobile-nav ul li li {
    padding-left: 0px !important;;
}
	.mtop {
    width: auto !important;;
    }
    }
    .width-ng {
        width: 96.5%;
    }
.paddi .searchbtn{
    cursor: pointer;
    color: #fff !important;
}
.paddi .searchbtn:hover{
    cursor: pointer;
    color: rgb(250, 186, 3) !important;
}
    .plan-signup .newsbuton {
        color: #fff !important;
        ;
    }

    .plan-signup .newsbuton:hover {
        /* background:rgb(250, 186, 3); */
        color: rgb(250, 186, 3);
        !important;
        ;
    }
    .plan-signup .searchbtn:focus{
    color: #ffffff!important;;
    text-decoration: none !important;;
    }

    .alert-danger {
        background-color: transparent !important;
        border-color: #191717 !important;
        color: black !important;
    }

    .card {
        background-color: transparent !important;
    }

    .block1 {
        display: inline-block;
        width: 100%;
    }
     @media only screen and (max-width:1500px) and (min-width:1300px){
     .err{
     position:absolute;color:#ff0000 !important;text-align:center; width:65%;
     }
     
}
 @media only screen and (max-width:1300px) and (min-width:1000px){
     .err{
     position:absolute;color:#ff0000 !important;text-align:center; width:77%;
     }
     
}
 @media only screen and (max-width:1000px){
     .err{
     position:relative;color:#ff0000 !important;text-align:center;
     }
     
}
    </style>
</head>

<body>
    <section class="toppage" id="maindiv">
        <div class="container text-center">
            <div class="">
                <h3 class="shortroad">
            SHORTEST ROAD TO BIKE & CAR SERVICES
          </h3>
         </div>
   </div>

         <div class="text-center">
          <h1 class="bikecar">
           BIKE AND CAR SERVICING AT YOUR DOORSTEP
          </h1>
          
        </div>
     <div class="container text-center">
        <div class="row">
     <div class="block1">
    <div class="text-center width101">
     
        <form id="getvendors" name="getvendors" action="" method="post">
        <div class="input-group width-ng">
        <img alt="location" src="<?php echo asset_url();?>images/img/delivery-location.png"  width="31x" class="desktop-img">
             <input type="text" name="locality"  required class="col-md-8 delvrname locate-me" id="locality" placeholder="Enter your service location" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
            <span class="input-group-addon col-md-2 block--1">
             <img alt="location" src="<?php echo asset_url();?>images/img/locate-me.png"  class="desktop-img1">
             
            <a href="javascript:locateMe()" class="underline locate-me">Locate Me</a>
          </span>
          <span class="input-group-btn col-md-2" style="font-size: none; padding-left:0px; padding-right:0px;"> <button class="searchbtn" id="book" type="button" onclick="getVendorsList();">BOOK NOW</button></span>
            
              </div>
           <br> <div id="response" class="err"></div>
              <input type="hidden" id="latitude" name="latitude" value="">
              <input type="hidden" id="longitude" name="longitude" value="">
              </form>
              <span class="input-group-btn">
            
          
             </span>
           </div> 
       </div>
       </div>
      </div>
      
    <div class="col-md-12">
     
           <a class="" title="Home"><img alt="SHORTEST ROAD TO BIKE & CAR SERVICES" src="<?php echo asset_url();?>images/ban.jpg" width="100%" class="img222"></a>
         
    </div>
    
    
      </div>
      
    </section>
    <!-- /Hero -->
    
  <!-- Header -->
  <header id="header">
    <div class="container">
    
      <div id="logo" class="pull-left">
        <a href="<?php echo base_url();?>"><img src="<?php echo asset_url();?>images/img/logomain.png"></a>
        <!-- Uncomment below if you prefer to use a text image -->
        <!--<h1><a href="#hero">Bell</a></h1>-->
      </div>
        <nav class="nav social-nav pull-right hidden-sm-down">
      <!--   <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-linkedin"></i></a> <a href="#"><i class="fa fa-envelope"></i></a>  -->
      </nav>
      <nav id="nav-menu-container">
      <ul class="nav-menu">
             <?php if(empty($olouserid)) { ?>
             <li><a href="<?php echo base_url();?>signup" class="lgsi">SIGNUP</a></li>
					<li><a href="<?php echo base_url();?>login" class="lgsi">LOGIN</a><span class="desktop-display">/</span></li>
      <?php } else {?>
            <li class="dropdown">
            <a href="#" style="padding-right: 28px; !important"><i class="fa fa-user">&nbsp;&nbsp;</i><?php echo $olousername ?></a>
              <ul class="dropdown-content">
               <li><a href="<?php echo base_url();?>order/setting">My Account</a></li>
              <li><a href="<?php echo base_url();?>order/history">Order History</a></li>
  <li><a href="<?php echo base_url();?>logout">Logout</a></li>

        </ul>
            </li>
      <?php }?> 
           <li ><a href="#maindiv">BOOK NOW</a></li>
<!--            <div class='dropdown'> -->
<!--     <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>Test</button> -->
<!--     <ul class='dropdown-menu'> -->
<!--         <li><a href='#'>Item 1</a></li> -->
<!--         <li><a href='#'>Item 2</a></li> -->
<!--         <li><a href='#'>Item 3</a></li> -->
<!--     </ul> -->
<!-- </div> -->
          <li><a href="#contact">CONTACT US</a></li>
          <li><a href="#specialoffers">SPECIAL OFFERS</a></li>
          <li><a href="<?php echo base_url();?>services">SERVICES</a></li>
          <li><a href="<?php echo base_url();?>about">ABOUT US</a></li>
          <li><a href="<?php echo base_url();?>">HOME</a></li>
         
        </ul>
      </nav><!-- #nav-menu-container -->
      
      
    </div>
  </header><!-- #header -->
  
    <!-- About -->
   <section class="about sec-special" id="about" style="background-image:url(<?php echo asset_url();?>images/img/world-map.png)">
      <div class="container text-center">
    <div class="col-md-12">
     <a class="numbring">
         <h2 class="stats-no numbringspan">ABOUT GARAGE2GHAR</h2>
        </a>
    </div>
       <!--  <h3>
          Text content will come here which will be linked with the about us page
        </h3> -->
                <div class="row heightmain">
                    <div class="col-lg-3 col-xs-12 col-sm-3">
                        <div class="text-center">
                            <div class="text-center">
                                <img src="<?php echo asset_url();?>images/convenience.png">
                            </div>
                            <br>
                            <div>
                                <h3 class="font-20 family">
                                  Convenience
                                </h3>
                                <p class="font-15 family">
                                    Simply select your desired service location & delivery time, be it your office, a restaurant, your home or a movie theatre.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-sm-3">
                        <div class="text-center">
                            <div class="text-center">
                                <img src="<?php echo asset_url();?>images/quality123.png">
                            </div>
                            <br>
                            <div>
                                <h3 class="font-20 family">
                                  Quality
                                </h3>
                                <p class="font-15 family">
                                    Top-notch professional mechanics with years of experience looking after your vehicle in a fully equipped and dedicated workshop. Use of 100% genuine spare parts.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-sm-3">
                        <div class="text-center">
                            <div class="text-center">
                                <img src="<?php echo asset_url();?>images/trust2.png">
                            </div>
                            <br>
                            <div>
                                <h3 class="font-20 family">
                                  Trust
                                </h3>
                                <p class="font-15 family p1">
                                    We aspire to provide the best for your vehicle to keep it running with and build trust which keeps us running. We believe in a transparent process providing
                                    <button class="more" onclick="show()" id="features">
                                        show more
                                    </button>
                                    <p class="display-none font-15 family p1">
                                        complete customer education and in depth analysis of your vehicle. Cost effective alternative taking away your suspicion of getting ripped off.
                                        <button class="less" onclick="show1()" id="less">show less</button>
                                    </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-sm-3">
                        <div class="text-center">
                            <div class="text-center">
                                <img src="<?php echo asset_url();?>images/res1.png">
                            </div>
                            <br>
                            <div>
                                <h3 class="font-20 family">
                                  Responsibility
                                </h3>
                                <p class="family font-15">From picking up the vehicle from your doorstep till dropping it back with utmost care, we take the complete responsibility of your beloved vehicle.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- /About -->
    <!-- Parallax -->
    <!-- /Parallax -->
    <!-- Call to Action -->
    <section class="cta" style="background-image:url(<?php echo asset_url();?>images/img/year-of-Exp-banner.png)" ;>
        <div class="container">
            <div class="row">
                <div class="stats-col text-center col-md-3 col-sm-6 ">
                    <div>
                        <span class="stats-no wrapersize" data-toggle="counter-up">3</span>
                        <br/>Years of experience
                    </div>
                </div>
                <div class="stats-col text-center col-md-3 col-sm-6">
                    <div>
                        <span class="stats-no wrapersize" data-toggle="counter-up"><?php echo count($users) + 10000;?></span>
                        <br/>Happy Clients
                    </div>
                </div>
                <div class="stats-col text-center col-md-3 col-sm-6">
                    <div>
                        <span class="stats-no wrapersize" data-toggle="counter-up">70</span>
                        <br/> Working Men
                    </div>
                </div>
                <div class="stats-col text-center col-md-3 col-sm-6">
                    <div>
                        <span class="stats-no wrapersize" data-toggle="counter-up"><?php echo count($users) +3500; ?></span>
                        <br/>Fans on facebook
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Call to Action -->
    <!-- Features -->
    <section class="features">
        <div class="container">
            <div class="row family">
                <div class="col-md-3 col-lg-3 col-xs-12">
                    <div class="text-center">
                        <div class="col-md-12" style="text-align: left;">
                            <a class="numbring">
                             <h2 class="stats-no numbringspan uppercase">Our Services</h2>
                            </a>
                            <p class="serviceses">
                                At Garage2Ghar we have devised a dedicated and systematically structured process which aims for a hassle free and effortless customer experience. We constantly pursue to create cost-efficient and effective vehicle maintenance solution at your finger tips.
                            </p>
                        </div>
                        <div>
                            <!-- <a href="#">view all services -> <br/>----------</a> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-xs-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4 ">
                            <div class="text-center">
                                <div class="servicees">
                                    <img alt="" class="team-img width80" src="<?php echo asset_url();?>images/breakdown.png" width="100%">
                                </div>
                                <div>
                                    <h3 class="serviceesheader family">
                                      Breakdown Assistance
                                      </h3>
                                    <p class="text-center family font-15">Vehicle breakdown!!! Frustrated and stuck in a middle of nowhere? Got no assistance nearby? Don&#8217;t panic. Think of your friend, Garage2Ghar to the rescue.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-4">
                            <div class="text-center">
                                <div class="servicees">
                                    <img alt="" class="team-img width80" src="<?php echo asset_url();?>images/pd.png" width="100%">
                                </div>
                                <div>
                                    <h3 class="serviceesheader family">
                                     Pick n Drop Servicing
                                    </h3>
                                    <p class="text-center family font-15">Regular maintenance, Spare replacement, Engine works, Custom Mods, Restoration- You name it and we got it. Get your vehicle picked and dropped at your desired location.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-4">
                            <div class="text-center">
                                <div class="servicees">
                                    <img alt="" class="team-img width80 " src="<?php echo asset_url();?>images/doorstep.png" width="100%">
                                </div>
                                <div>
                                    <h3 class="serviceesheader family">
                                     Doorstep Servicing
                                    </h3>
                                    <p class="text-center family font-15">Regular maintenance, Minor spare replacement right at your doorstep. See your valuable companion get serviced in your presence and vigilance.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- /Features -->
    <!-- pricing -->
    <div class="block block-pd-lg block-bg-overlay text-center" id="specialoffers" style="background-image:url(<?php echo asset_url();?>images/img/parallax-bg.jpg)" ;>
        <div class="col-md-12">
            <a class="numbring">
       <h2 class="stats-no numbringspan uppercase">Special Offers</h2>
       <div class="row text-center">
                <h4 style="width: 100%;">*below charges are excluding service tax charges</h4>
            </div>
      </a>
        </div>
        <p>
            <!--  This is the most powerful theme with thousands of options that you have never seen before.-->
        </p>
        <div class="container">
            <div class="row pricing-tables">
                <div class="col-md-4 col-xs-12">
                    <div class="pricing-table">
                        <div class="plan-name price-colorsele">
                            <h3 class="priceheader">Moped regular servicing</h3>
                            <div class="plan-price">
                                <div class="price-value">Rs 299 &#8212 449*</div>
                            </div>
                        </div>
                        <div class="plan-list">
                            <ul class="">
                                <li><strong>Routine servicing</strong> </li>
                                <li><strong>In-depth analysis</strong> </li>
                                <li><strong>Periodic follow-ups</strong> </li>
                                <li><strong>Washing</strong> </li>
                                <li><strong>Free Delivery</strong></li>
                            </ul>
                        </div>
                        <div class="plan-signup">
                            <a class="searchbtn" href="#maindiv">BOOK NOW</a></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12 vipmain">
                    <div class="pricing-table">
                        <div class="plan-name price-colorsele">
                            <h3 class="priceheader">Motorcycle regular servicing</h3>
                            <div class="plan-price">
                                <div class="price-value">Rs 299 &#8212 499* </div>
                            </div>
                        </div>
                        <div class="plan-list">
                            <ul class="">
                                <li><strong>Routine servicing</strong> </li>
                                <li><strong>In-depth analysis</strong> </li>
                                <li><strong>Periodic follow-ups</strong> </li>
                                <li><strong>Washing</strong> </li>
                                <li><strong>Free Delivery</strong></li>
                            </ul>
                        </div>
                        <div class="plan-signup">
                            <a class="searchbtn" href="#maindiv">BOOK NOW</a></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="pricing-table">
                        <div class="plan-name price-colorsele">
                            <h3 class="priceheader">High cc motorcycle regular servicing</h3>
                            <div class="plan-price">
                                <div class="price-value">Rs 699 &#8212 1199* </div>
                            </div>
                        </div>
                        <div class="plan-list">
                            <ul class="">
                                <li><strong>Routine servicing</strong> </li>
                                <li><strong>In-depth analysis</strong> </li>
                                <li><strong>Periodic follow-ups</strong> </li>
                                <li><strong>Washing</strong> </li>
                                <li><strong>Free Delivery</strong></li>
                            </ul>
                        </div>
                        <div class="plan-signup">
                            <a class="searchbtn" href="#maindiv">BOOK NOW</a></span>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!--/pricing -->
    <!--how it works-->
    <!--  <section class="about" id="about">
      <div class="container text-center">
    <div class="col-md-12">
     <a class="numbring">
         <span class="stats-no numbringspan">How It Works</span></span>
        </a>
    </div>
        <h3>
         Small write Up about our USPs and services
        </h3>

        
      <div class="row heightmain">
          <div class="feature-col col-lg-3 col-xs-12">
            <div class="card card-block text-center">
              <div>
                <img alt="" class="team-img" src="<?php echo asset_url();?>images/img/team-1.jpg" width="100%">
              </div>

              <div>
                <h3>
                  Point 1
                </h3>

              </div>
            </div>
          </div>

          <div class="feature-col col-lg-3 col-xs-12">
            <div class="card card-block text-center">
              <div>
                <img alt="" class="team-img" src="<?php echo asset_url();?>images/img/team-1.jpg" width="100%">
              </div>

              <div>
                <h3>
                 point 2
                </h3>

              </div>
            </div>
          </div>

          <div class="feature-col col-lg-3 col-xs-12">
            <div class="card card-block text-center">
              <div>
               <img alt="" class="team-img " src="<?php echo asset_url();?>images/img/team-1.jpg" width="100%">
              </div>

              <div>
                <h3>
                 Point 3
                </h3>

              </div>
            </div>
          </div>
        <div class="feature-col col-lg-3 col-xs-12">
            <div class="card card-block text-center">
              <div>
               <img alt="" class="team-img " src="<?php echo asset_url();?>images/img/team-1.jpg" width="100%">
              </div>

              <div>
                <h3>
                  Point 4
                </h3>

              </div>
            </div>
          </div>
       <div class="feature-col col-lg-4 col-xs-12"></div>
       <div class="feature-col col-lg-4 col-xs-12"> <div class="plan-signup">
               <a class="searchbtnpnt" href="#about">BOOK NOW</a></span>
              </div>
      </div>
       <div class="feature-col col-lg-4 col-xs-12"></div>
       
        </div>
      </div>
    </section>-->
    <!--/how it works-->
    <!--plan our works-->
    <!--   <section class="features" id="features" style='background-image: url("<?php echo asset_url();?>images/img/brandback.png");background-position: 0px -65.24px;'>
      <div class="container">
       
        <div class="row">
          <div class="feature-col col-lg-4 col-xs-12">
            <div class="card card-block text-center" style="background:transparent;">
               <div class="col-md-12">
           <a class="numbring">
           <span class="stats-no numbringspan">Our Brands</span></span>
           <br/>
           <p class="brandss">
                 Brands We Covers
        
                </p>
          </a>
          </div>
              <div>
               
                
        
              </div>
            </div>
          </div>

          <div class="feature-col col-lg-1 col-xs-12">
             <img alt="" class="team-img" src="<?php echo asset_url();?>images/img/usc.png" width="105px" height="80px">
          </div>

          <div class="feature-col col-lg-1 col-xs-12">
            <div class="card card-block text-center">
              <div class="servicees">
               <img alt="" class="team-img" src="<?php echo asset_url();?>images/img/rhino.png" width="105px" height="80px">
              </div>
            </div>
          </div>
      <div class="feature-col col-lg-1 col-xs-12">
            <div class="card card-block text-center">
              <div class="servicees">
              <img alt="" class="team-img" src="<?php echo asset_url();?>images/img/cleanw.png" width="105px" height="80px">
              </div>

            </div>
          </div>
       <div class="feature-col col-lg-1 col-xs-12">
            <div class="card card-block text-center">
              <div class="servicees">
              <img alt="" class="team-img" src="<?php echo asset_url();?>images/img/winefix.png" width="105px" height="80px">
              </div>

            </div>
          </div>
       <div class="feature-col col-lg-1 col-xs-12">
            <div class="card card-block text-center">
              <div class="servicees">
              <img alt="" class="team-img" src="<?php echo asset_url();?>images/img/madrhino.png" width="105px" height="80px">
              </div>

            </div>
          </div>
        </div>
    
      
    <div class="row">
         

          <div class="feature-col col-lg-3 col-xs-12">
           
          </div>

          <div class="feature-col col-lg-3 col-xs-12 ">
            <div class="card card-block text-center">
              <div class="servicees">
                 <img alt="" class="team-img" src="<?php echo asset_url();?>images/Headlightrestoration.png" width="100%">
              </div>

              <div>
                <h3 class="serviceesheader">
                  Headlight Restoration
                </h3>

              </div>
            </div>
          </div>
      <div class="feature-col col-lg-3 col-xs-12">
            <div class="card card-block text-center">
              <div class="servicees">
               <img alt="" class="team-img" src="<?php echo asset_url();?>images/servicing.png" width="100%">
              </div>

              <div>
                <h3 class="serviceesheader">
                  packaged Car service
                </h3>

              </div>
            </div>
          </div>
      <div class="feature-col col-lg-3 col-xs-12">
            <div class="card card-block text-center">
              <div class="servicees">
                                <img alt="" class="team-img" src="<?php echo asset_url();?>images/stearing.png" width="100%">
              </div>

              <div>
                <h3 class="serviceesheader">
                 Steering and Suspension
                </h3>

                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>-->
    <!--/plan our works-->
    <!--blog updates-->
    <!--  <section class="team" id="team">
      <div class="container">
       
        <div class="row">
          
          <div class="col-sm-12 col-xs-6 col-md-4">
            <div class="text-center">
               <div class="col-md-12">
           <a class="numbring">
           <span class="stats-no numbringspan">BLOG UPDATE</span></span>
          </a>
          </div>
              <div>
               
                <p class="serviceses family font-15">
                 A Small Write Up About Services and will be linked to Services Page
         
                </p>
                <br>
        
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-xs-6 col-md-4">
            <div class="">
              <a href="#"><img alt="" class="team-img" src="<?php echo asset_url();?>images/img/team-3.jpg" width="100%">
              <div class="card-title-wrap">
                <span class="card-title">Sergio Fez</span> <span class="card-text">Art Director</span>
              </div>

             
        </a>
            </div>
          </div>

          <div class="col-sm-6 col-xs-6 col-md-4">
            <div class="borderstyk">
      <div>
              <a href="#" style="padding: 0 35px;" class="uppercase">
        Sergio Fez
         
              </a>
        <p class="card-text" style="padding: 0 35px;" >Best resource for Automative Repair Advice</p>
              <p class="serv">Link with Bolg With the website and Show the latest One here</p>
        </div>
        <div class="row btop" style="padding: 0 35px; margin-top:50px ; margin-bottom:10px;">
        <div class="col-sm-12 col-md-6" >
        <i class="fa fa-calendar"><span>  may 8th, 2015</span></i>
        </div>
         <div class="col-sm-12 col-md-6" >
         <i class="fa fa-comments"><span style="font-size: 14px;">  8 COMMENTS</span></i>
         
        </div>
        </div>
            </div>
          </div>
        </div>
      </div>
    </section>-->
    <!--/blog updates-->
    <section class="about" id="about" style="padding: 29px 0;">
        <!--  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1751.020876017724!2d77.04798774682206!3d28.628510727782803!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d05218976c29d%3A0x6f3a609246c82661!2sPhase+5%2C+Om+Vihar%2C+Hastsal%2C+Delhi%2C+110059!5e0!3m2!1sen!2sin!4v1485177969761" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen=""></iframe>-->
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3782.0893455891064!2d73.79293681445888!3d18.570010287380168!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2bf2aa5dca743%3A0x34808e4c5d959a40!2sGARAGE+2+GHAR!5e0!3m2!1sen!2sin!4v1513949314076" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>    
    </section>
    <div class="container newsltr" style="background-image:url(<?php echo asset_url();?>images/img/newsletter.png)">
        <div class="row paddi">
            <div class="col-md-3 col-sm-12" style="margin-top: 22px;">
                <h3>NEWSLETTER</h1>
  </div>
   
  <div class="col-md-9 col-sm-12 row" style="margin-top: 22px;">
  <form style="width:100%" action="https://garage2ghar.us17.list-manage.com/subscribe/post?u=0eeb8ab83121462f34039b5c5&amp;id=f82ae822f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    
             <input type="text" name="name"  class="col-md-9  col-sm-8 delvrname" class="form-control" value="" name="EMAIL"  id="mce-EMAIL" placeholder="" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
            <span class="col-md-3 col-sm-4"><input type="submit" class="searchbtn" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"> <!-- <a class="searchbtn" href="#about">SUBSCRIBE NOW</a> --></span> 
     		
    
     <div id="mce-responses" class="clear">
				<div class="response" id="mce-error-response" style="display:none"></div>
				<div class="response" id="mce-success-response" style="display:none"></div>
			</div>
   </form>
    </div>
   </div>
   </div>
    <!-- Portfolio -->

       <!-- @component: footer -->

    <section id="contact">
      <div class="container text-center">
     
        <div class="row">
           <div class="col-md-12">
     <a class="numbring">
         <h2 class="stats-no numbringspan">GET IN TOUCH</h2>
        </a>
    <h3 class="h33">
         Are You looking for best service? We want to here from you!
        </h3>
            </div>
        </div>
        <div class="row  text-center spl">
            <div class="col-lg-6">
                <div class="form">
                    <div id="sendmessage">Your message has been sent. Thank you!</div>
                    <div id="errormessage"></div>
                    <form action="" method="post" role="form" id="contactForm" class="contactForm">
                        <div class="form-group">
                            <input type="text" name="name1234" class="form-control" id="name1234" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email1234" id="email1234" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="mobile1234" id="mobile1234" placeholder="Your mobile" data-rule="mobile" data-msg="Please enter a valid mobile" />
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject1234" id="subject1234" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                            <div class="validation"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <textarea class="form-control" id="message1234" name="message1234" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message" style="height: 168px;background: #f7f7f7 !important;"></textarea>
                    <div class="validation"></div>
                </div>
            </div>
            <div class="col-lg-12 text-center">
                <div class="plan-signup">
                    <a class="newsbuton" onclick="sendmsg()">SEND MESSAGE</a></span>
                </div>
            </div>
            
            <div class="row mtop">
                <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3">
                    <div class="card card-block text-center">
                        <div>
                            <div>
                                <img alt="" class="team-img" src="<?php echo asset_url();?>images/location.png">
                            </div>
                        </div>
                        <div>
                            <h3>
                              Address
                            </h3>
                            <p>
                                NO.2, Nisarg Anand Society, Pimple Nilakh, Pune 27
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3">
                    <div class="card card-block text-center">
                        <div>
                            <div>
                                <img alt="" class="team-img" src="<?php echo asset_url();?>images/email.png">
                            </div>
                        </div>
                        <div>
                            <h3>
                              Email
                            </h3>
                            <p>
                                info@garage2ghar.com
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3">
                    <div class="card card-block text-center">
                        <div>
                            <div>
                                <img alt="" class="team-img" src="<?php echo asset_url();?>images/phone.png">
                            </div>
                        </div>
                        <div>
                            <h3>
                              Hotline
                            </h3>
                            <p>
                                +91-9011941194
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3">
                    <div class="card card-block text-center">
                        <div>
                            <div>
                                <img alt="" class="team-img" src="<?php echo asset_url();?>images/web.png">
                            </div>
                        </div>
                        <div>
                            <h3>
                              Website
                            </h3>
                            <p>
                                www.garage2ghar.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <footer class="site-footer">
        <div class="bottom">
            <div class="container text-center">
                <div class="row text-center">
                    <nav class="nav social-nav11 text-center" >
                    <a href="https://twitter.com/garage2ghar" style="padding: 8px;" target="_blank"><img alt="" class="team-img" src="<?php echo asset_url();?>images/twitter.png"></a> 
                    <a href="https://www.facebook.com/garage2ghar/" style="padding: 8px;" target="_blank"><img alt="" class="team-img" src="<?php echo asset_url();?>images/Facebook.png"></a> 
            		    <a href="https://www.instagram.com/garage2ghar/" style="padding: 8px;" target="_blank"><img alt="" class="team-img" src="<?php echo asset_url();?>images/insta1.png"></a> 
            		   <!--  <a href="#" style="padding: 8px;" target="_blank"><img alt="" class="team-img" src="<?php echo asset_url();?>images/mail.png"></a> -->
                  </nav>
                </div>
                <div class="nk-footer-text">
                    <p class="foterp">Copyright Garage2Ghar; All rights reserved</p>
                </div>
                <div class="nk-footer-text">
                    <p class="foterp" style=" font-size: 14px;">Developed by <a href="https://www.brandzgarage.com/" target="_new"  style="cursor:pointer;color:#1b0f41;">BrandzGarage</a></p>
                </div>
            </div>
        </div>
        </div>
        </div>
    </footer>
    <a class="scrolltop" href="#"><span class="fa fa-angle-up"></span></a>
    <!-- JavaScript


    <!-- Required JavaScript Libraries -->
    <script src="<?php echo asset_url();?>js/lib/jquery/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.1/jquery.min.js"></script>-->
    <script src="<?php echo asset_url();?>js/lib/superfish/hoverIntent.js"></script>
    <script src="<?php echo asset_url();?>js/lib/superfish/superfish.min.js"></script>
    <script src="<?php echo asset_url();?>js/lib/tether/js/tether.min.js"></script>
    <script src="<?php echo asset_url();?>js/lib/stellar/stellar.min.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/stellar-base/0.7.6/stellar-base.js"></script>-->
    <script src="<?php echo asset_url();?>js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo asset_url();?>js/lib/counterup/counterup.min.js"></script>
    <script src="<?php echo asset_url();?>js/lib/waypoints/waypoints.min.js"></script>
    <script src="<?php echo asset_url();?>js/lib/easing/easing.js"></script>
    <script src="<?php echo asset_url();?>js/lib/stickyjs/sticky.js"></script>
    <script src="<?php echo asset_url();?>js/lib/parallax/parallax.js"></script>
    <script src="<?php echo asset_url();?>js/lib/lockfixed/lockfixed.min.js"></script>
    <!-- Template Specisifc Custom Javascript File -->
    <script src="<?php echo asset_url();?>js/custom.js"></script>
    
    <script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5a6f37b24b401e45400c7c90/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>

</html>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';
var asset_url = '<?php echo asset_url();?>';
</script>
<script>
function ajaxindicatorstart(text) {
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><i class="fa fa-spinner fa-5x"></i><div>' + text + '</div></div><div class="bg"></div></div>');
    }

    jQuery('#resultLoading').css({
        'width': '100%',
        'height': '100%',
        'position': 'fixed',
        'z-index': '10000000',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto'
    });

    jQuery('#resultLoading .bg').css({
        'background': '#000000',
        'opacity': '0.7',
        'width': '100%',
        'height': '100%',
        'position': 'absolute',
        'top': '0'
    });

    jQuery('#resultLoading>div:first').css({
        'width': '250px',
        'height': '75px',
        'text-align': 'center',
        'position': 'fixed',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto',
        'font-size': '16px',
        'z-index': '10',
        'color': '#ffffff'

    });

    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}

function ajaxindicatorstop() {
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}
</script>
<script>
$("#locality").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        getVendorsList();
        return false;
    }
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
//window.load(locateMe());

var delay = 5000;
setTimeout(function() { locateMe(); }, delay);

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
                    //               for (var i = 0; i < results.address_components.length; i++) {
                    //                    for (var j = 0; j < results.address_components[i].types.length; j++) {
                    //                     // if (place.address_components[i].types[j] == "postal_code") {
                    //                       // document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
                    //                       // $('#pincode').val(place.address_components[i].long_name);
                    //                    //  }
                    //                    }
                    //                  }
                    $("#latitude").val(crd.latitude);
                    $("#longitude").val(crd.longitude);
                    var geoaddress = results[0].formatted_address
                    $("#locality").val(geoaddress);
                    //$('#user_profile_update').bootstrapValidator('revalidateField','location');
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


function getVendorsList() {
    var locality = $("#locality").val();
   // alert(locality);
    if (locality == '') {
        //alert(err.message);
        alert("Please enter the address");
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
        $("#response").removeClass('alert-success');
        $("#response").addClass('alert-danger');
        $("#response").html(resp.msg);
        $("#response").show();
    } else {
    	ajaxindicatorstop();
        // $("#response").html(resp.msg);
        window.location.href = base_url + "booking";
    }
}
</script>
<script>
function show() {
    $(".display-none").show();
    $(".more").hide();
}

function show1() {
    $(".display-none").hide();
    $(".more").show();
}
</script>
<script>
// $(window).scroll(function() {    



//     var scroll = $(window).scrollTop();

//     if (scroll >= 300) {
//         $(".dropdown-content").addClass("dropup");
//     }

// });
$(document).on("shown.bs.dropdown", ".dropdown", function() {
    // calculate the required sizes, spaces
    var $ul = $(this).children(".dropdown-menu");
    var $button = $(this).children(".dropdown-toggle");
    var ulOffset = $ul.offset();
    // how much space would be left on the top if the dropdown opened that direction
    var spaceUp = (ulOffset.top - $button.height() - $ul.height()) - $(window).scrollTop();
    // how much space is left at the bottom
    var spaceDown = $(window).scrollTop() + $(window).height() - (ulOffset.top + $ul.height());
    // switch to dropup only if there is no space at the bottom AND there is space at the top, or there isn't either but it would be still better fit
    if (spaceDown < 0 && (spaceUp >= 0 || spaceUp > spaceDown))
        $(this).addClass("dropup");
}).on("hidden.bs.dropdown", ".dropdown", function() {
    // always reset after close
    $(this).removeClass("dropup");
});

function sendmsg() {
    //var a=$("textarea#message1234").html();
    //alert(a);
    if ($("#name1234").val() == '' || $("#email1234").val() == '' || $("#mobile1234").val() == '' || $("#subject1234").val() == '') {
        alert("Please fill all details");
    } else {
        $.post(base_url + "addcontact", { name: $("#name1234").val(), email: $("#email1234").val(), mobile: $("#mobile1234").val(), subject: $("#subject1234").val(), description: $("#message1234").val() }, function(data) {
            if (data.status == 1) {
            	 alert(data.msg);
                window.location = base_url;
            } else {
                alert(data.msg);
            }
        }, 'json');
    }
}
</script>
