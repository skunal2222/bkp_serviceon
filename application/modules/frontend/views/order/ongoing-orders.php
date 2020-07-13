<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/my-profile/common.css">
<link href="<?php echo asset_url();?>frontend/css/my-profile/ongoing-orders.css" rel="stylesheet">
<div class="my-pofile">
	<div class="container">
	    <div class="banner-section">	
		</div>
		<div class="profile row">
			<div class="col-md-3 col-sm-4">
				<div class="profile-navigation" id="profile-navigation">
					<ul>
						<li class="active">
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

					<!-- Ongoing Order  -->
            <?php $i == 0; if(!empty($orders)) {  ?>
          <?php foreach($orders as $order){ ?>
          <?php $i++; ?>
                        <div class="ongoingorder">
                            <div class="orderid" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $order['orderid']?>">
                                <div class="row">
                                    <div class="col-md-8 col-sm-8">
                                        <h3 class="order-id-text"><?php echo $order['subcategory'];?>  ( Booking Id # : <?php echo $order['ordercode']?> )</h3>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-10">
                                        <h3 class="align-right">Total Amount : &#8377; <?php if(!empty($order['grand_total'])){ echo $order['grand_total']; } else { ?>0<?php } ?></h3>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-2 text-center">
                                        <div class="grey-bg">
                                            <img src="<?php echo asset_url();?>frontend/images/up.png" alt="arrow" class="up-img">
                                            <img src="<?php echo asset_url();?>frontend/images/down.png" alt="arrow" class="down-img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="order-status panel-collapse collapse" id="collapse<?php echo $order['orderid']?>">
                                  <div class="order-spl">
                                    <ul class="nav nav-pills spl-navbar">
                                        <li class="active"><a data-toggle="pill" href="#details<?php echo $i ;?>"><span>Details</span></a></li>
                                        <li><a data-toggle="pill" href="#billing<?php echo $i ;?>"><span>Billing</span></a></li>
                                        <li><a data-toggle="pill" href="#track<?php echo $i ;?>"><span>Track</span></a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="details<?php echo $i ;?>" class="tab-pane fade in active">
                                          <div class="details-spl">
                                              <div class="row">
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>Brand Name</p>
                                                  </div>
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p><?php echo $order['brand_name'];?></p>
                                                  </div>
                                              </div>
                                               <div class="row">
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>Model Name.</p>
                                                  </div>
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p><?php echo $order['model_name'];?></p>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>Order booked on.</p>
                                                  </div>
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p><?php echo date('j M Y', strtotime($order['pickup_date']));?></p>
                                                  </div>
                                              </div>
                                               <div class="row">
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>Service Type</p>
                                                  </div>
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p><?php echo $order['subcategory'];?></p>
                                                  </div>
                                              </div>
                                               <div class="row">
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>Mechanic Assigned</p>
                                                  </div>
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p><?php echo $order['garage_name'];?></p>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>Total Amount Paid</p>
                                                  </div>
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p><?php if(!empty($order['grand_total'])){ echo $order['grand_total']; } else { ?>0<?php } ?>/-</p>
                                                  </div>
                                              </div>
                                          </div>
                                        </div>
                                        <div id="billing<?php echo $i ;?>" class="tab-pane fade">
                                            <div class="bolling-spl">
                                                <div class="details-spl">
                                          <?php  $tax=0;
                                           foreach($order['orderbill'] as $row) { 
                                           $tax += ($row['total_amount'] - $row['service_price']); ?>
                                                  <div class="row">
                                                      <div class="col-sm-6 col-md-3 col-xs-6">
                                                        <p><?php echo $row['service_name'];?></p>
                                                      </div>
                                                    <!--   <div class="col-sm-6 col-md-3 col-xs-6">
                                                        <p><?php echo $row['service_price'];?></p>
                                                      </div> -->
                                                       <div class="col-sm-6 col-md-3 col-xs-6">
                                                        <p><?php echo $row['total_amount'];?></p>
                                                      </div>

                                                  </div>
                                          <?php }        ?>
                                                 
                                                  <div class="total-bill-sepration">
                                                    <div class="row">
                                                        <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Subtotal</p>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p><?= ($order['order_amount'] ? $order['order_amount']:0) ?></p>
                                                          </div>
                                                      </div>
                                                     <!--  <div class="row">
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Tax</p>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p><?=  $tax;?></p>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Service charge</p>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p> Amount</p>
                                                          </div>
                                                      </div> -->
                                                      <div class="row">
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p> Discount</p>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p><?= ($order['order_amount'] ? $order['discount']:0) ?></p>
                                                          </div>
                                                      </div>
                                                        <div class="row">
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Net Total</p>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p><?= ($order['order_amount'] ? $order['net_total']:0) ?></p>
                                                          </div>
                                                      </div>
                                                       <div class="row">
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p> Adjustment</p>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p><?= ($order['order_amount'] ? $order['adjustment']:0) ?></p>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="total-bill">
                                                    <div class="row">
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Total Amount </p>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p><?= ($order['order_amount'] ? $order['grand_total']:0) ?></p>
                                                          </div>
                                                         <!--  <div class="col-sm-6 col-md-3 col-xs-5 text-right">
                                                             <button type="button" class="saved-btn">Book Now</button>
                                                          </div> -->
                                                          <!-- <div class="col-sm-6 col-md-3 col-xs-5">
                                                             <a href="<?php echo base_url().$userpackage[0]['invoice_url']; ?>" target="_blank"><button type="button" class="download-btn">Download Invoice</button></a>
                                                          </div> -->
                                                      </div>
                                                  </div>
                                              </div>
                                            </div>
                                        </div>
                                        <div id="track<?php echo $i ;?>" class="tab-pane fade">
                                          <!-- new code -->
                                             
         <div class="track-spl">
              <div class="box1">
                <div class="timeline">
                  <?php 

                 $label = array(
                      '0' => 'Order Received',
                      '1' =>'Mechanic Assigned',
                      '2' => 'Estimate Generated',
                      '3' => 'Order is in process',
                      '4' => 'Order Completed',
                      '7' => 'Order Delivered',
                    ); 
                  $flag_order=true;
                 foreach($order['comment'] as $log) {  
                    if($log['order_status'] != 5) { 
                      $done['done'.$log['order_status']] = 'done';  
                      $datelog['date'.$log['order_status']]=date('j M Y h:i A', strtotime($log['created_date']));
                    }else{

                      $flag_order=false;  //if order canceled
                      
                      $canceled_date=date('j M Y h:i A', strtotime($log['created_date']));
                      break;
                    }
                 }   
                 //iterate for div 6 times
                 if($flag_order)
                 {
                  for($a = 0; $a <= 7; $a++) {
                  if($a==5 or $a==6)
                      continue;


                          $top = $a%2 == 0 ? 'top' : 'bottom'; 
                         ?>
                        <div class="timeline-right <?=($a==0 ? 'white':'') ?>">
                            <div class="img <?= $done['done'.$a]?>"></div>
                            <div class="content <?=$top?>">
                                <p class="green1"><?= $label[$a]?></p>
                                <p class="green2"><?= $datelog['date'.$a]?></p>
                            </div>
                        </div>
        <?php     } }else{ 
                  for($a = 0; $a <= 5; $a++) {

                          $top = $a%2 == 0 ? 'top' : 'bottom';  ?>
                         <div class="timeline-right <?=($a==0 ? 'white':'') ?>">
                            <div class="img <?=($a==0 ? 'done':'') ?>"></div>
                            <div class="content <?=$top?>">
                                <p class="green1"><?=($a==0 ? 'Order Cancelled':'') ?></p>
                                <p class="green2"><?=($a==0 ? $canceled_date:'') ?></p>
                             
                          </div>
                        </div>
                        

              <?php   }   }     ?>
                
                             

              </div>
             </div>
          </div>
                                          <!-- end new -->
                                      
                                        </div>
                                      </div>
                                  </div>

                            </div>
                            
                        </div>
                      <?php } } else{ ?>

       
                    <!-- Ongoing Order ends -->


                    <!-- no ongoing orders ends -->
						<div class="no-ongoing-orders">
	  						<img src="<?php echo asset_url();?>frontend/images/hierarchy-structure.png" alt="no-ongoin-orders" />
	  						<h3>You have no Ongoing order till now!</h3>
	  						<!-- <button type="button" class="saved-btn">Book Now</button> -->
                <!-- <a href="<?php echo base_url();?>select-subcategory" class="spl-btn">Book Now  </a> -->
						</div>
					<!-- no ongoing orders ends -->
        <?php }  ?>


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
</script>