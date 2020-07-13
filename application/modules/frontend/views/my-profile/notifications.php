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
						<li  class="active">
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
					<!-- Notification starts -->
                        <div class="notification-list">
                            <h2>Notification</h2>
                             <?php date_default_timezone_set('Asia/Kolkata');
                             if(!empty($notifications)){
                            foreach ($notifications as $notification){?>
                            <div class="notification" <?php if($notification['is_read'] == 1){?> style="background-color:#EEEEEE;"<?php }?>>
                                <div class="row">
                                    <div class="col-md-2 col-sm-4 col-lg-2 text-center">
                                        <h3><?php 
                                          echo date("M j, Y", strtotime($notification['date']));
                                        ?></h3>
                                        <h3><?php echo date("g:i a", strtotime($notification['date']));?></h3>
                                    </div>
                                    <div class="col-md-7 col-sm-8 col-lg-7">
                                        <p><?php echo $notification['description'];?></p>
                                        <!-- <p>step till 28th Feb ’18.</p> -->
                                        <!-- <p class="detailed-info">
                                        	Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum
                                        </p> -->
                                    </div>
                                     <?php 
                                        if($notification['orderid'] > 0){
                                        if($notification['orderstatus'] >=8 ){
                                    ?>
                                    <div class="col-md-3 col-sm-12 col-lg-3">
                                        <button type="button" class="noti-btn fright" onclick="orderhistory('<?php echo $notification['id'];?>','<?php echo $notification['orderid'];?>');">CHECK DETAILS </button>
                                    </div>
                                    <?php }else{?>
                                    <div class="col-md-3 col-sm-12 col-lg-3">
                                        <button type="button" class="noti-btn fright" onclick="ongoingOrders('<?php echo $notification['id'];?>','<?php echo $notification['orderid'];?>');">CHECK DETAILS </button>
                                    </div>
                                     <?php }}else{ ?>
                                      <div class="col-md-3 col-sm-12 col-lg-3">
                                        <button type="button" class="noti-btn fright">CHECK DETAILS </button>
                                    </div>
                                      <?php }?>
                                </div>
                            </div>
                             <?php }}else{?>
                                 <div class="notification">
                                <div class="row">
                                    <div class="col-md-10 col-sm-12 col-lg-8 text-center">
                                        <h3>There are no new notifications for you.</h3>
                                    
                                    </div>
                                   
                                </div>
                            </div>

                              <?php }?>
                            <!-- <div class="notification">
                                <div class="row">
                                    <div class="col-md-2 col-sm-4 col-lg-2 text-center">
                                        <h3>JAN 20 , 2018   </h3>
                                        <h3>1 pm</h3>
                                    </div>
                                    <div class="col-md-7 col-sm-8 col-lg-7">
                                        <p>Get 50% on all products , also free delivery at your door</p>
                                        <p>step till 28th Feb ’18.</p>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-lg-3">
                                        <button type="button" class="noti-btn fright">CHECK DETAILS </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="notification">
                                <div class="row">
                                    <div class="col-md-2 col-sm-4 col-lg-2 text-center">
                                        <h3>JAN 20 , 2018   </h3>
                                        <h3>1 pm</h3>
                                    </div>
                                    <div class="col-md-7 col-sm-8 col-lg-7">
                                        <p>Get 50% on all products , also free delivery at your door</p>
                                        <p>step till 28th Feb ’18.</p>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-lg-3">
                                        <button type="button" class="noti-btn fright">CHECK DETAILS </button>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    <!-- Notification ends -->
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

function orderhistory(id,ordercode){
    
    $.post(base_url+'read',{id:id},function(data){
        if(data.status == 1){
            window.location.href = base_url+'orderhistory/'+ordercode;
        }
    },'json');
    
}
function ongoingOrders(id,ordercode){
    
    $.post(base_url+'read',{id : id},function(data){
        if(data.status==1){
            window.location.href = base_url+'ongoingorder/'+ordercode;
        }
    },'json');
}
</script>