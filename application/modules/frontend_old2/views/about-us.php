<style>
    .text-muted{
        font-size: 15px !important;
        text-align: center !important;
    }
    .fa-theme{
        color: #EC3237;
    }
    .custom-banner{
        height: 800px;
        padding: 15% 20% !important;
    }

    @media screen and (max-width: 1367px) {
        .custom-banner {
            height: 608px;
            padding: 15% 20% !important;
        }
    }
    @media screen and (max-width: 600px) {
        .custom-banner {
            height: 341px;
        }
    }

</style>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>frontend/css/banner.css">
<div class="booking">
    <div class="jumbotron custom-banner">
        <h1>About BikeDoctor</h1>
        <!--<p>Automated Doorstep Two-Wheeler Servicing</p>--> 
        <div class="service-quote-section text-center">
            <div class="inline-flex">
                <button type="button" class="spl-btn service-btn" onclick="window.location.href = '<?php echo base_url(); ?>select-subcategory';">Book Now
                </button>
                <button type="button" class="spl-btn service-btn bt2" onclick="window.location.href = '<?php echo base_url(); ?>contact-us';">Contact Us
                </button>
            </div>
        </div>
    </div>
    <div class="">
        <div class="about-us">
            <div class="Speciality">
                <p>Automated Doorstep Two-Wheeler Servicing</p>
                <p>Started with a team of three bike enthusiasts and their dream to revolutionise the bike maintenance market.</p>
                <p>Bikedoctor came into operation at the beginning of 2014 within a small part of Pune City.
                    After a successful launch, we started expanding our service areas and by the end of year 2015, Bikedoctor was serving happy customers all over Pune City and PCMC areas.</p>
                <p>Serving happy customers with our QUICK, CONVENIENT & TRANSPARENT services.</p>
            </div>
            <!-- Our Speciality -->
            <div class="Speciality promise">
                <h2><center>Our Speciality</center></h2>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x fa-theme"></i>
                            <i class="fa fa-male fa-stack-1x fa-inverse"></i>
                            <!--map-pin-->
                        </span>
                        <h4 class="service-heading">Exclusive Mechanics</h4>
                        <p class="text-muted">We have handpicked, trained mechanics for your perusal. Mechanics are selected with rigourous procedures so as to provide the ultimate work satisfaction to the customers.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x fa-theme"></i>
                            <i class="fa fa-money fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading">Transparency</h4>
                        <p class="text-muted">One of our key USPs. We pride ourselves in keeping our services and transactions transparent. Be it changing of spares, pricing or the nature of our service. A fully transparent conduct is our code.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x fa-theme"></i>
                            <i class="fa fa-exchange fa-stack-1x fa-inverse"></i>
                            <!--tasks-->
                        </span>
                        <h4 class="service-heading">Convenient</h4>
                        <p class="text-muted">"A happy customer is a repeat customer." We always strive to provide utmost satisfaction in our services. Our services are designed to suit to the convenience of the customers. We provide services at your home/offices/any other suitable location in your provided time slot for your convenience.
                        </p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x fa-theme"></i>
                            <i class="fa fa-firefox fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading">Quality Assurance</h4>
                        <p class="text-muted">What is a service without quality?! Bikedoctor keeps in check the quality of its services. We keep raising the standards of our quality bar periodically. Customer satisfaction with our high quality low-cost services is our primary goal.</p>
                    </div>

                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x fa-theme"></i>
                            <i class="fa fa-suitcase fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading">Tailored annual packages</h4>
                        <p class="text-muted">Bikedoctor provides specially tailored annual package plans for housing socities and companies/offices to best suit the needs of their vehicles. These plans differ as per the customer requirement.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x fa-theme"></i>
                            <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading">Geo-location based </h4>
                        <p class="text-muted">Our services are geo-location based. Visit our app/website and we will automatically fetch your location so that you don't have to lethargically enter your address every time you are in a new location.</p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x fa-theme"></i>
                            <i class="fa fa-female fa-stack-1x fa-inverse"></i>
                            <!--terminal-->
                        </span>
                        <h4 class="service-heading">Women-friendly</h4>
                        <p class="text-muted">The biggest problem women face is maintaining their two-wheeler. Most of the time they need the help of their male counterpart for the same. We have provided a solution for this problem as all women need to do it is pick up their phone and call us/book online and our mechanic will be at your doorstep to service your ride making our services quite women-friendly.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x fa-theme"></i>
                            <i class="fa fa-tasks fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading">Service Logs</h4>
                        <p class="text-muted">Bikedoctor provides a log of all the services it has catered to customer's vehicle. This log provides the details of the service provided and spares changed. This helps a customer in providing an authentic data of the vehicle if they plan to sell off the bike in the future. A complete history of the vehicle maintenance just at the tip of your fingers.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x fa-theme"></i>
                            <i class="fa fa-calendar fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading">Periodic Reminders</h4>
                        <p class="text-muted">Periodic reminders are provided by us to keep the health of your vehicle at an optimum level. Notifications for the next due service date are provided so that a customer can allot a convenient time for his servicing.</p>
                    </div>
                </div>
            </div>
            <!-- Our Speciality -->  

            <!-- Our Promise-->
            <!--          <div class="Speciality promise">
                        <h2>Our Promise</h2>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="promise-box">
                                    <h3>Our Goals</h3>
                                   <p>Bikedoctor moves forward with the aim to revolutionise the service industry in two-wheelers automobile sector.</p>
                                   <p>We have set a goal of drastically reducing the inflation in the service industry of autombiles.</p>
                                   <p>Bikedoctor aspires to set up a whole new market where a layman consumer can procure spares the same way a mechanic does, i.e., cheap and optimum quality.</p>
                                   <p>TRANSPARENCY: a motto which we live by is what we want to provide to the consumers pan India.</p>
                                </div>
                            </div>
                             <div class="col-sm-6">
                                <div class="promise-box">
                                    <h3>Our Aspirations</h3>
                                   <p>Lorem ipsum lorem ipsum 
                                    Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem 
                                    ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum 
                                    lorem ipsum lorem ipsum lorem ipsum lorem 
                                    ipsum lorem ipsum.</p>
                                </div>
                            </div>
                        </div>
                      </div>-->
            <!-- Our Promise-->  

            <!-- Our Team-->
            <!--          <div class="Speciality">
                        <h2>Our Team</h2>
                        <div class="row">
                            <div class="col-sm-7"> 
                                <h3>Lorem ipsum lorem ipsum</h3>
                                <p>Lorem ipsum lorem ipsum 
                                    Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem 
                                    ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum 
                                    lorem ipsum lorem ipsum lorem ipsum lorem 
                                    Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem 
                                    ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum 
                                    lorem ipsum lorem ipsum lorem ipsum lorem 
                                    ipsum lorem ipsum.</p>
                            </div>
                             <div class="col-sm-5">
                                <img src="<?php echo asset_url(); ?>frontend/images/new/ourteam.png" alt="MotorMechs">
                            </div>
                        </div>
                      </div>-->

            <!-- Our Team-->  

            <!-- What We Offer -->
            <!--          <div class="Speciality offer">
                        <h2>What We Offer </h2>
                        <div class="row">
                            <div class="col-sm-7">
                                 <h3>Lorem ipsum lorem ipsum</h3>
                                    <p>Lorem ipsum lorem ipsum 
                                    Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem 
                                    ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum 
                                    lorem ipsum lorem ipsum lorem ipsum lorem 
                                    Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem 
                                    ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum 
                                    lorem ipsum lorem ipsum lorem ipsum lorem 
                                    ipsum lorem ipsum.</p>
                            </div>
                             <div class="col-sm-5">
                                <img src="<?php echo asset_url(); ?>frontend/images/new/whatweoffer.png" alt="MotorMechs">
                            </div>
                        </div>
                      </div>-->

            <!-- What We Offer -->  
        </div>
    </div>
</div>