<?php //echo "<pre>"; print_r($point_array); print_r($refercode); exit; ?><link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/my-profile/common.css">
<div class="my-pofile">
	<div class="container">
	    <div class="banner-section">
		</div>
		<div class="profile row">
			<div class="col-md-3 col-sm-4">
				<div class="profile-navigation" id="profile-navigation">
					<ul>
						<li>
							<a href="<?php echo base_url();?>ongoing-orders">
							    Ongoing Order
						    </a>
						</li>
						<li>
							<a href="<?php echo base_url();?>order-history">
							    Order History
						    </a>
						</li>
						<li>
							<a href="<?php echo base_url();?>basic-info">
							    Basic Info
						    </a>
						</li>
						<li class="active">
							<a href="<?php echo base_url();?>refer-n-earn">
							    Refer and Earn
						    </a>
						</li>
						<li>
							<a href="<?php echo base_url();?>wallet">
							   My Wallet
						    </a>
						</li>
						 <li>
                            <a href="<?php echo base_url();?>doc-wallet">
                               Doc Wallet
                            </a>
                        </li>
						<li>
							<a href="<?php echo base_url();?>notifications">
							    Notifications
						    </a>
						</li>
						 <li>
			                <a href="<?php echo base_url();?>my-packages">
			                   My Packages
			                </a>
			            </li>
					</ul>
				</div>
			</div>
			<div class="col-md-9 col-sm-8">
				<div class="detail-section basic-info">
					<!-- Refer &#38; Earn -->
					    <h2>Refer & Earn</h2>
                        <div class="refer text-center">
                            <img src="<?php echo asset_url();?>frontend/images/refer.png" alt="wallet" class="img">
                            <h3> <span class="border-1">YOUR CODE - <span class="span1"><?php echo $refercode['my_ref_code'];?> </span></span></h3>
                            <p>Share this coupon with your friends and family. Your friend will get
                                <br> <?=$point_array['my_referral']?> points in his wallet and after first order you will also get <?=$point_array['other_referral']?> points
                            </p>
                          <!--   <button type="button" class="saved-btn">REFER </button> -->
                            <div class="inline">
                                <p>Share on</p>
                                 <a  class="refer" onclick="return popitup('https://www.facebook.com/sharer/sharer.php?u=<?=base_url()?>user/<?=$this->session->olouserid?>')" title="Share on Facebook"  class="social_icons social_facebook" > 
	                                 	  <img src="<?php echo asset_url();?>frontend/images/social-media/facebook.png" alt="wallet" class="media-icon">
	                                  </a>  

	                                   <a  class="refer" onclick="return popitup('http://twitter.com/home?status=My coupon code is -  <?php echo $refercode['my_ref_code']; ?>  sign up using this code and get 50 points in your wallet. <?php echo base_url();?>')" title="Share on Twitter"  class="social_icons social_twitter" > <img src="<?php echo asset_url();?>frontend/images/social-media/google-plus.png" alt="wallet" class="media-icon"></a>
                               
                                <a  class="refer" onclick="return popitup('https://api.instagram.com/v1/media/%d/comments?access_token=%s')" title="Share on Instagram"> <img src="<?php echo asset_url();?>frontend/images/social-media/instagram.png" alt="wallet" class="media-icon"></a>
                                

                                <!-- <img src="<?php echo asset_url();?>frontend/images/social-media/facebook.png" alt="wallet" class="media-icon">
                                <img src="<?php echo asset_url();?>frontend/images/social-media/google-plus.png" alt="wallet" class="media-icon">
                                <img src="<?php echo asset_url();?>frontend/images/social-media/instagram.png" alt="wallet" class="media-icon"> -->
                            </div>
                        </div>
                    <!-- Refer &#38; Earn ends -->
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/all.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>


<script>
function popitup(url) {
    newwindow=window.open(url,'name','height=400,width=550,top=150,left=350');
    if (window.focus) {newwindow.focus()}
    return false;
}
</script>

<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("profile-navigation");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky && window.pageYOffset <= 600) { 
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}


</script>