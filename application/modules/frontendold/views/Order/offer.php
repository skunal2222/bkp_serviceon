<link href="<?php echo asset_url();?>css/order.css" rel="stylesheet">
    <section class="about" id="about" style='background-image: url("<?php echo asset_url();?>images/img/templatemo_main_bg_bottom_wrapper.jpg");background-position: 0px -65.24px;'>
     <div class="container">
      <div class="row">

              <div class="col-lg-3 col-xs-12">
				<div class="nk-footer-text" style="margin: 23px;">
					<!-- <ul> -->
					<!-- <li><a href="#section-london">London</a></li> -->
					<!-- <li><a href="#section-paris">Paris</a></li> -->
					<!-- </ul> -->
			    <a href="<?php echo base_url();?>order/trackorder"><p class="foterp">Ongoing Orders</p></a>
				<a href="<?php echo base_url();?>order/history"><p class="foterp">Order	History</p></a>
				<!--<a href="<?php echo base_url();?>order/notification"><p class="foterp">Notifications <span>2</span></p></a>-->
				<a href="<?php echo base_url();?>order/setting"><p class="foterp">Settings</p></a>
				<a href="<?php echo base_url();?>order/wallet"><p class="foterp">Wallet</p></a> 
				<a href="<?php echo base_url();?>order/offer"><p class="foterp act">Offers</p></a>
				</div>
			</div>
            
            <div class="col-lg-9 col-xs-12 text-center">
			
                     <div class="container">
      <div class="row">

            <div class="col-lg-3 col-xs-12 text-center">
             
            </div>
            
            <div class="col-lg-6 col-xs-12 text-center">
			
                    <div class="nk-footer-text">
					<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
                        <p class="foterp" style="    font-weight: 100;
    font-size: 30px;margin-bottom: 40px;margin-top: 13px;">SHARE AND EARN</p>
						 
                    </div>
					
            </div>
            <div class="col-lg-3 col-xs-12 text-center">
              
            </div>
	   </div>
		</div>	
		 <div class="container">
      <div class="row">

            <div class="col-lg-2 col-xs-12 text-center">
             <!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
            </div>
			<div class="col-lg-2 col-xs-12 text-center">
             <img src="<?php echo asset_url();?>images/img/offershare.png" class="img-responsive" />
            </div>
            
            <div class="col-lg-6 col-xs-12 text-center">
			
                    <div class="nk-footer-text">
					<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
                        <p class="foterp" style="font-weight: inherit; ">Share this coupon with your friends and family.<br>Your friend will get 50 points in his wallet and after first order you will also get 50 points</p>
						  <span class="foterp" style="font-weight: inherit; ">Your Code</span>
						  <p class="foterp code"><span style="font-size: 20px;"><?php if(!empty($refcode)){ echo $refcode[0]['my_ref_code']; }?></span></p>
                    </div>
					
            </div>
            <div class="col-lg-4 col-xs-12 text-center">
              
            </div>
	   </div>
		</div>	
		
		            <div class="container">
      <div class="row">

            <div class="col-lg-3 col-xs-12 text-center">
             
            </div>
            
            <div class="col-lg-6 col-xs-12 text-center">
                    <div class="nk-footer-text">
                       <p class="foterp" style="font-weight: inherit;margin-top:30px">Share now on</p><br>
						<div class="col-lg-4 text-center width100">
	                      <div class="text-center">
	                       <nav class="nav social-nav text-center">
					        <!-- <a href="#" style="padding: 8px;">
					          <img src="<?php echo asset_url();?>images/img/face.png"class="img-responsive"/>
					        </a> 
							<a href="#" style="padding: 8px;">
							 <img src="<?php echo asset_url();?>images/img/goog.png"class="img-responsive"/>
							</a> 
							<a href="#" style="padding: 8px;">
							 <img src="<?php echo asset_url();?>images/img/tweet.png"class="img-responsive" />
							</a>-->
							 <a onclick="return popitup('https://www.facebook.com/sharer/sharer.php?s=100&p[title]=couponcode<?php echo $refcode[0]['my_ref_code']; ?> &p[url]=<?php echo base_url();?>')" title="Share on Facebook" style="padding: 8px;">
                                <img src="<?php echo asset_url();?>images/img/face.png"class="img-responsive"/>
                             </a>
                             <a onclick="return popitup('https://plus.google.com/share?url=<?php echo base_url();?>')" title="Share on Google+" style="padding: 8px;">
							 	<img src="<?php echo asset_url();?>images/img/goog.png" class="img-responsive"/>
							 </a> 
                             <a class="refer" onclick="return popitup('http://twitter.com/home?status=My coupon code is <?php echo $refcode[0]['my_ref_code']; ?><?php echo base_url();?>')" title="Share on Twitter" style="padding: 8px;" > 
                             	<img src="<?php echo asset_url();?>images/img/tweet.png"class="img-responsive" />
                             </a>
                            <!--  <a class="refer" onclick="return popitup('https://api.instagram.com/v1/media/%d/comments?access_token=%s')" title="Share on Instagram">
                             	<img src="<?php echo asset_url();?>images/My-profile/21.png" alt="wallet" class="media-icon">
                             </a>-->
					      </nav>
	                     </div>
                        </div>
                    </div>
            </div>
            <div class="col-lg-3 col-xs-12 text-center">
              
            </div>
	   </div>
		</div>	
       </div>	
            <!-- <div class="col-lg-3 col-xs-12 text-center"> -->
              
            <!-- </div> -->
			
			

	   </div>


		</div>


<div class="container">
<div class="row">
<div class="col-md-3 bike1">

</div>
 <div class="col-md-6"><!--<img src="img/GooglePlay.png" class="img-responsive" width="100%"/> --></div>
 
<div class="col-md-3"></div>

</div>



</div>

    
    </section>

    <a class="scrolltop" href="#"><span class="fa fa-angle-up"></span></a> 
    
<script>
function popitup(url) {
    newwindow=window.open(url,'name','height=400,width=550,top=150,left=350');
    if (window.focus) {newwindow.focus()}
    return false;
}
</script>