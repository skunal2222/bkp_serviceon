<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/my-profile/common.css">
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
						<li>
							<a href="<?php echo base_url();?>refer-n-earn">
							    Refer and Earn
						    </a>
						</li>
						<li class="active">
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
				<div class="detail-section">
					<!-- Wallet -->
                        <div class="center wallet basic-info">
                        	<h2>My Wallet</h2>
                            <img src="<?php echo asset_url();?>images/wallet.png" alt="wallet" class="img">
                            <h3>You have <span class="points"><?php echo $balance[0]['amount'];?> points </span>in your wallet</h3>
                            <h3>You have <span class="points"><?= $loyality_points;?> Loyality points </span></h3>
                            <h4>Redeem your points on your next booking</h4>
                            <div>
                                <a href="<?php echo base_url();?>" class="spl-btn">Book Now  </a>
                                 <a href="<?php echo base_url();?>refer-n-earn" class="spl-btn">Earn More Points </a>

                               <!--  <button type="button" class="spl-btn" onclick="refer();">Earn More Points</button> -->
                            </div>
                            <div class="list text-center">
                                <?php
                              if(!empty($wallet_history)){
                            foreach($wallet_history as $history){?>
                                <div class="card">
                                    <div class="row">
                                        <div class="col-sm-4 col-xs-4">
                                            <?php if($history['updated_by'] == 0 && $history['is_debit']==0){
                                                if($history['amount'] > 0){
                                        ?>
                                            <p class="add-points">+ <?php echo $history['amount'];?> points</p>
                                            <?php }else{ ?>
                                            <p class="add-points"><?php echo $history['amount'];?> points</p>
                                          <?php }}else{?>
                                            <p class="remove-points">- <?php echo $history['amount'];?> points</p>
                                             <?php }?>
                                        </div>
                                        <div class="col-sm-4 col-xs-4">
                                            <?php if($history['orderid'] > 0){?>
                                             <p>Booking id : <?php echo $history['orderid'];?></p>
                                               <?php }else{?>
                                            <p>Rewards of refer</p>
                                             <?php }?>
                                        </div>
                                        <div class="col-sm-4 col-xs-4">
                                            <p><?php echo date("jS M Y",strtotime($history['updated_date']));?></p>
                                        </div>
                                    </div>
                                </div>
                                 <?php }}?>
                               <!--  <div class="card">
                                    <div class="row">
                                        <div class="col-sm-4 col-xs-4">
                                            <p class="add-points">+ 50 points</p>
                                        </div>
                                        <div class="col-sm-4 col-xs-4">
                                            <p>Booking discount</p>
                                        </div>
                                        <div class="col-sm-4 col-xs-4">
                                            <p>10th Oct 2016</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="row">
                                        <div class="col-sm-4 col-xs-4">
                                            <p class="remove-points">+ 50 points</p>
                                        </div>
                                        <div class="col-sm-4 col-xs-4">
                                            <p>Booking id : 1234</p>
                                        </div>
                                        <div class="col-sm-4 col-xs-4">
                                            <p>10th Oct 2016</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="row">
                                        <div class="col-sm-4 col-xs-4">
                                            <p class="add-points">+ 50 points</p>
                                        </div>
                                        <div class="col-sm-4 col-xs-4">
                                            <p>Booking refund</p>
                                        </div>
                                        <div class="col-sm-4 col-xs-4">
                                            <p>10th Oct 2016</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="row">
                                        <div class="col-sm-4 col-xs-4">
                                            <p class="remove-points">+ 50 points</p>
                                        </div>
                                        <div class="col-sm-4 col-xs-4">
                                            <p>Booking id : 2345</p>
                                        </div>
                                        <div class="col-sm-4 col-xs-4">
                                            <p>10th Oct 2016</p>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    <!-- Wallet ends -->
				</div>
			</div>
		</div>
	</div>
</div>
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

function refer(){
    window.location.href=base_url+"refer-n-earn/";
}
</script>