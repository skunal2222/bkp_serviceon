<link href="<?php echo asset_url();?>css/customer-profile.css" rel="stylesheet">
<link href="<?php echo asset_url();?>css/order.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			<style>
			  .track-order .head-sec{
			      background-color: #f5f5f7;
			      padding:15px; 
			  }
			  .oo-bg {
			    width: 88%;
			    margin-left: 7% !important;
			    margin: -76px auto;
			    }
			  .order-details-new{
			    background:#f2f2f2;
			  }
			   .track-order{
				    margin-top: 20%;
				}
				.roww{
				  margin:0px;
				}
			  .head-sec h3{
			      font-size: 18px !important;;
				  font-weight: 500;
				  font-style: normal;
				  font-stretch: normal;
				  margin: 0px;
				  line-height: 1.5;
				  letter-spacing: 1px;
				  text-align: left !important;
				  color: #000000 !important;;
			  }
			   .head-sec p{
			      font-size: 15px !important;;
				  font-weight: normal;
				  margin: 0px;
				  font-style: normal;
				  font-stretch: normal;
				  line-height: 1.5;
				  letter-spacing: 1px;
				  text-align: left !important;;
				  color: #000000 !important;;
			  }
			  .heading-section{
			    background:#fff;
			    padding:10px;
			  }
			  .heading-section p{
			      font-size: 15px !important;;
				  font-weight: normal;
				  font-style: normal;
				  cursor: pointer;
				  font-stretch: normal;
				  line-height: 1.5;
				  letter-spacing: 1px;
				  text-align: center !important;;
				 
			  }
			  .main-txt p{
			      font-size: 14px !important;;
				  font-weight: normal;
				  font-style: normal;
				   padding-top: 10px;
				  font-stretch: normal;
				  line-height: 1.5;
				  letter-spacing: 1px;
				  text-align: left !important;;
				  color: #000000 !important;;
			  }
			  .order-details-new{
				margin-bottom: 20px;
			  }
			  
			  .txt-details{ 
			    padding:0px 10px;
			    background: #f5f5f7;
			    margin:0px;
			  }
			  .main-txt{
			    padding:0px 10px;
			    background: #f5f5f7;
			    margin:0px;
			  }
			   .txt-details p{
			   
			      font-size: 15px !important;;
				  font-weight: 400;
				  font-style: normal;
				  font-stretch: normal;
				  line-height: 1.5;
				  letter-spacing: 1px;
				  text-align: left !important;;
				  color: #000000 !important;;
			  }
			.division{
			  display:none;
			}
			
				@media screen and (max-width: 1200px) and (min-width:768px) {
				.head-sec h3 {
				    font-size: 16px !important;
				    }
				    .heading-section p {
				    font-size: 14px !important;
				    }
				    .txt-details p {
				    font-size: 13px !important;
				    }
				}
				@media screen and (max-width: 767px) and (min-width:200px) {
				.head-sec h3 {
				    font-size: 12px !important;
				    }
				    .heading-section p {
				    font-size: 11px !important;
				    }
				    .txt-details p {
				    font-size: 11px !important;
				    }
				    .head-sec p {
				    font-size: 12px !important;
				    }
				    .ongoing-order-new{
				      width:500px;
				    }
				}
			</style>
			
<?php //print_r($logs); ?>
<section class="about" id="about" style='background-image: url("<?php echo asset_url();?>images/img/templatemo_main_bg_bottom_wrapper.jpg");background-position: 0px -65.24px;'>
	<div class="container">
		<div class="row">

			<div class="col-lg-3 col-xs-12">
				<div class="nk-footer-text" style="margin: 23px;">
					<!-- <ul> -->
					<!-- <li><a href="#section-london">London</a></li> -->
					<!-- <li><a href="#section-paris">Paris</a></li> -->
					<!-- </ul> -->
				    <a href="#"><p class="foterp act">Ongoing Orders</p></a>
					<a href="<?php echo base_url();?>order/history"><p class="foterp">Order	History</p></a>
					<!--<a href="<?php echo base_url();?>order/notification"><p class="foterp">Notifications <span>2</span></p></a>-->
					<a href="<?php echo base_url();?>order/setting"><p class="foterp">Settings</p></a>
					<a href="<?php echo base_url();?>order/wallet"><p class="foterp">Wallet</p></a> 
					<a href="<?php echo base_url();?>order/offer"><p class="foterp">Offers</p></a>
				</div>
			</div>

			<div class="col-lg-9 col-xs-12 text-center">

				<!--  <div class="container">
						<div class="col-lg-12 col-xs-12 text-center">
							<div class="container" style="border-top: 2px solid; border-bottom: 2px solid;">
								<div class="row">
									<div class="col-lg-3 col-xs-12 text-center" id="track1" style="background: #faba03;">
										<div class="nk-footer-text">
											<p class="foterp"
												style="font-weight: inherit; margin: 6px; cursor: pointer;"
												id="track" onclick="changecolor();">Track Orders</p>

										</div>
									</div>
									<div class="col-lg-3 col-xs-12 text-center" id="info1">
										<div class="nk-footer-text">
											<p class="foterp"
												style="font-weight: inherit; margin: 6px; cursor: pointer;"
												id="info" onclick="changecolor1();">Order info</p>

										</div>
									</div>

									<div class="col-lg-3 col-xs-12 text-center" id="log1">

										<div class="nk-footer-text">
											<p class="foterp"
												style="font-weight: inherit; margin: 6px; cursor: pointer;"
												id="log" onclick="changecolor2();">Order Logs</p>

										</div>

									</div>
									<div class="col-lg-3 col-xs-12 text-center" id="billing1">
										<div class="nk-footer-text">
											<p class="foterp"
												style="font-weight: inherit; margin: 6px; cursor: pointer;"
												id="billing" onclick="changecolor3();">Billing</p>

										</div>
									</div>
								</div>
							</div>
				
		 
	<div class="row" id="track123">
		 <?php if(!empty($logs)){ ?>
            <div class="container" style="margin-top: 50px;padding-top: 8px;">
                <div class="row">
                <?php foreach($logs as $log) { ?>
                <?php if($log['order_status'] != 5) { ?>
                 <?php if($log['order_status'] == 0) { ?>
					 <div class="col-lg-2 col-md-2 text-center">
					   <p>Order Received</p>
					   <div class="mj-b">
					     <p><?php echo date('j M Y h:i A', strtotime($log['created_date']));?> <br> </p>
					   </div>
					 </div>	
                <?php } if($log['order_status'] == 1) { ?>
					 <div class="col-lg-2 col-md-2 text-center">
					   <p>Garage Assigned</p>
					   <div class="mj-b">
					     <p><?php echo date('j M Y h:i A', strtotime($log['created_date']));?> <br> </p>
					   </div>
					 </div>	
					<?php } if($log['order_status'] == 2) { ?>
					 <div class="col-lg-2 col-md-2 text-center">
					   <p>Estimate Generated</p>
					    <div class="mj-b">
					     <p><?php echo date('j M Y h:i A', strtotime($log['created_date']));?> <br> </p>
					   </div>
					 </div>	
					 <?php } if($log['order_status'] == 3) { ?>
					 <div class="col-lg-2 col-md-2 text-center">
					   <p>Order is in process</p>
					    <div class="mj-b">
					     <p><?php echo date('j M Y h:i A', strtotime($log['created_date']));?> <br> </p>
					   </div>
					 </div>	
					 <?php } if($log['order_status'] == 4) { ?>
					 <div class="col-lg-2 col-md-2 text-center">
					   <p>Order Completed</p>
					    <div class="mj-b">
					     <p><?php echo date('j M Y h:i A', strtotime($log['created_date']));?> <br> </p>
					   </div>
					 </div>
					<?php } if($log['order_status'] == 7) { ?>
					 <div class="col-lg-2 col-md-2 text-center">
					   <p>Order Delivered</p>
					    <div class="mj-b">
					     <p><?php echo date('j M Y h:i A', strtotime($log['created_date']));?> <br> </p>
					   </div>
					 </div>
                	<?php } } else { ?>
                	 <div class="col-lg-2 col-md-2 text-center">
					   <p>Order Cancelled</p>
					    <div class="mj-b">
					     <p><?php echo date('j M Y h:i A', strtotime($log['created_date']));?> <br> </p>
					   </div>
					 </div>
                	<?php }  } ?>
                
			    </div>	
			    				
			  	<div class="row custom-sec-div oo-bg line container">
			  	
					<div class="col-lg-2 col-xs-2 text-center custom-width">
					    <div class="cir" id="fillcircle"></div>
					</div>
					
					<div class="col-lg-2 col-xs-2 text-center custom-width">
					    <div class="cir" id="fillcircle1"></div>
					</div>
					
					<div class="col-lg-2 col-xs-2 text-center custom-width">
					    <div class="cir" id="fillcircle2"></div>
					</div>
					
					<div class="col-lg-2 col-xs-2 text-center custom-width">
					    <div class="cir" id="fillcircle3"></div>
					</div>
					
					<div class="col-lg-2 col-xs-2 text-center custom-width">
					    <div class="cir" id="fillcircle4"></div>
					</div>
					<div class="col-lg-2 col-xs-2 text-center custom-width">
					    <div class="cir" id="fillcircle5"></div>
					</div>
				</div>
			</div>
			<?php } else { ?>
			 <div class="container" style="margin-top: 50px;padding-top: 8px;">
                <div class="row">
                No Ongoing order
                </div>
             </div>
                
            <?php } ?>
		 </div>
					
		<div class="row" id="info123" style="display:none">
     		<div class="container" style="margin-top: 38px;">
     			<?php if(!empty($order[0])){?>	
					<div class="row">
						<div class="col-lg-12 col-xs-12 text-center">
							<div class="col-md-12 form-group" style="margin-top: 10px;">
								<div class="input-group">
									<span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x icon-background1"></i><i class="fa fa-hashtag fa-stack-1x"></i></span>
									<label id="label1"> &nbsp;OrderCode - <?php echo $order[0]['ordercode'];?></label>
								</div>
								<div class="messageContainer"></div>
							</div>
							<div class="col-md-12 form-group" style="margin-top: 10px;">
								<div class="input-group">
									<span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x icon-background1"></i><i class="fa fa-calendar fa-stack-1x"></i></span>
									<label id="label1"> &nbsp;Order booked on - <?php echo date('j M Y', strtotime($order[0]['pickup_date']));?></label>
								</div>
								<div class="messageContainer"></div>
							</div>
							<div class="col-md-12 form-group" style="margin-top: 10px;">
								<div class="input-group">
									<span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x icon-background1"></i><i class="fa fa-wrench fa-stack-1x"></i></span>
									<label id="label1"> &nbsp;<?php echo $order[0]['subcategory'];?></label>
								</div>
								<div class="messageContainer"></div>
							</div>
							<div class="col-md-12 form-group" style="margin-top: 10px;">
								<div class="input-group">
									<span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x icon-background1"></i><i class="fa fa-building fa-stack-1x"></i></span>
									<label id="label1"> &nbsp;Garage Assigned - <?php echo $order[0]['garage_name'];?></label>
								</div>
								<div class="messageContainer"></div>
							</div>
						</div>
					</div>
					<?php } else { ?>
					<div class="row">
						<div class="col-lg-12 col-xs-12 text-center">
						   No Records Found
						</div>
					</div>
					<?php } ?>
				  </div>
			</div>
					
					<div class="row" id="log123" style="display:none" >
     <div class="container" style="margin-top: 38px;">
								<div class="row">
						            <div class="col-lg-12 col-xs-12 text-center">
			
                    <div class="nk-footer-text">
					<!-- <img src="img/Thankucheck.png" class="img-responsive" /> 
                        <!--<p class="foterp" style="font-weight: inherit;text-align: left;background: #f5f5f7;padding: 10px;">A mechanic raised a new service code</p>
						<p class="foterp" style="font-weight: inherit;text-align: left;padding: 10px;">A mechanic raised a new service code</p>
					<?php if(!empty($logs)){?>
					<?php foreach($logs as $logcom) { ?>
					    <p class="foterp" style="font-weight: inherit;text-align:left;padding: 10px;background: #f5f5f7;"><?php echo $logcom['comment']; ?></p>
					<?php } } else { ?>	
						 <p class="foterp" style="font-weight: inherit;text-align:left;padding: 10px;background: #f5f5f7;">No Records Found</p>
					<?php } ?>
						
						
					</div>
					
            </div>	
						</div>
						</div>
					</div>
 
					<div class="row" id="billing123" style="display:none">
							<div class="container"
								style="margin-top: 50px; background: #f5f5f7; padding-top: 8px;">
								<div class="row">
									<div class="col-lg-2 col-xs-2 text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> 
											<p class="foterp" style="font-weight: inherit;">Select</p>

										</div>
									</div>
									<div class="col-lg-3 col-xs-2 text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> 
											<p class="foterp" style="font-weight: inherit;">Particulars</p>

										</div>
									</div>

									<div class="col-lg-2 col-xs-2 text-center">

										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> 
											<p class="foterp" style="font-weight: inherit;">Priority</p>

										</div>

									</div>
									<div class="col-lg-3 col-xs-2   text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> 
											<p class="foterp" style="font-weight: inherit;">Unit Price</p>

										</div>
									</div>
									<div class="col-lg-2 col-xs-2  text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> 
											<p class="foterp" style="font-weight: inherit;">Price</p>

										</div>
									</div>
								</div>
							</div>
							<div class="container">
							<?php foreach($bill as $row) { ?>
								<div class="row">
							      <div class="col-lg-2 col-xs-2  text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> 
											<input type="checkbox" name="vehicle" value="Bike">

										</div>
									</div>
									<div class="col-lg-3 col-xs-2 text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> 
											<p class="foterp" style="font-weight: inherit;">
												<?php echo $row['service_name'];?><span> <img alt="" class="team-img "
													src="<?php //echo asset_url();?>images/img/high.png"></span>
											</p>

										</div>
									</div>

									<div class="col-lg-2 col-xs-2 text-center">

										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> 
											<p class="foterp" style="font-weight: inherit;"><?php if($row['priority']==1) { ?>High<?php } else if($row['priority']==2){ ?>Medium<?php } else { ?> Low<?php } ?></p>

										</div>

									</div>
									<div class="col-lg-3 col-xs-2  text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> 
											<p class="foterp" style="font-weight: inherit;"><?php echo $row['service_price'];?></p>

										</div>
									</div>
									<div class="col-lg-2 col-xs-2  text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> 
											<p class="foterp" style="font-weight: inherit;"><?php echo $row['total_amount'];?></p>

										</div>
									</div>
								</div>
									<?php } ?>
							</div>

							<div class="container"
								style="background: #f5f5f7; padding-top: 8px;padding-bottom:8px">
								<div class="row">
									<div class="col-lg-2 col-xs-2 text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" />
											<p class="foterp" style="font-weight: inherit;"></p>

										</div>
									</div>
									<div class="col-lg-3  col-xs-2 text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> 
											<p class="foterp" style="font-weight: inherit;"></p>

										</div>
									</div>

									<div class="col-lg-2 col-xs-2 text-center">

										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> 
											<p class="foterp" style="font-weight: inherit;"></p>

										</div>

									</div>
									<div class="col-lg-3 col-xs-2  o-6 text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> 
											<p class="foterp" style="font-weight: inherit;">Order Amount</p>
											<p class="foterp" style="font-weight: inherit;">Discount</p>
											<p class="foterp" style="font-weight: inherit;">Net Total</p>
											<p class="foterp" style="font-weight: inherit;">Adjustment</p>
											<p class="foterp" style="font-weight: inherit;">Grand Total</p>

										</div>
									</div>
									<div class="col-lg-2 col-xs-2 o-6 text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> 
											<?php if($bill[0]['order_amount']!=''){?>
											<p class="foterp" style="font-weight: inherit;" id="amt"><?php echo $bill[0]['order_amount'];?></p>
                                            <?php } else { ?>
                                            <p class="foterp" style="font-weight: inherit;" id="amt">0</p>
                                            <?php } ?>
                                            <?php if($bill[0]['order_amount']!=''){?>
											<p class="foterp" style="font-weight: inherit;" id="amt"><?php echo $bill[0]['discount'];?></p>
                                            <?php } else { ?>
                                            <p class="foterp" style="font-weight: inherit;" id="amt">0</p>
                                            <?php } ?>
                                            <?php if($bill[0]['order_amount']!=''){?>
											<p class="foterp" style="font-weight: inherit;" id="amt"><?php echo $bill[0]['net_total'];?></p>
                                            <?php } else { ?>
                                            <p class="foterp" style="font-weight: inherit;" id="amt">0</p>
                                            <?php } ?>
                                            <?php if($bill[0]['order_amount']!=''){?>
											<p class="foterp" style="font-weight: inherit;" id="amt"><?php echo $bill[0]['adjustment'];?></p>
                                            <?php } else { ?>
                                            <p class="foterp" style="font-weight: inherit;" id="amt">0</p>
                                            <?php } ?>
                                            <?php if($bill[0]['order_amount']!=''){?>
											<p class="foterp" style="font-weight: inherit;" id="amt"><?php echo $bill[0]['grand_total'];?></p>
                                            <?php } else { ?>
                                            <p class="foterp" style="font-weight: inherit;" id="amt">0</p>
                                            <?php } ?>
										</div>
									</div>
								</div>
							
							</div>
							<div class="container" style="padding-top: 8px;">
								<div class="row">
<!-- 									<div class="col-lg-2 col-xs-12 text-center"> -->
<!-- 										<div class="nk-footer-text"> -->
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											

<!-- 										</div> -->
<!-- 									</div> -->
<!-- 									<div class="col-lg-3 col-xs-12 text-center"> -->
<!-- 										<div class="nk-footer-text"> -->
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											

<!-- 										</div> -->
<!-- 									</div> -->

<!-- 									<div class="col-lg-2 col-xs-12 text-center"> -->

<!-- 										<div class="nk-footer-text"> -->
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											

<!-- 										</div> -->

<!-- 									</div> -->
									<div class="col-lg-12 col-xs-12 text-center">
									<br>
										<div class="nk-footer-text" style="float:right">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> 
											<?php if($order[0]['grand_total'] > 0) { ?>
											<p class="foterp" style="font-weight: inherit;">
												
		               		<button type="button" class="searchbtn1" onclick="generateInvoice(<?php echo $order[0]['orderid'];?>)">INVOICE</button>
													           </p>
		             <?php } ?>
		             
		              <?php if($order[0]['invoice_status'] == 1) { ?>
		              			<p class="foterp" class="btn-cls">
												<button type="button" class="searchbtn1" style="background: #faba03; border: 2px solid #faba03; font-size: 18px;"> PAY NOW</button>
		               		<a href="<?php echo base_url();?><?php echo $order[0]['invoice_url'];?>" target="_blank"><button type="button"class="invoice-btn"> VIEW INVOICE</button></a>
													           </p>
		              <?php }?>
											
										</div>
									</div>
								<!-- 	<div class="col-lg-2 col-xs-12 text-center">
										<div class="nk-footer-text">
											<p class="foterp" style="font-weight: inherit;">
												<button type="submit"
													style="background: #faba03; border: 2px solid #faba03; font-size: 18px;">PAY
													NOW</button>
											</p>

										</div>
									</div>
								</div>
							</div>

						</div>
					</div>-->
				</div>
			
			<!-- new ongoing order starts-->
			  <div class="ongoing-order-new">
			    
				  <a href="#" data-toggle="#div1" class="track-order">
				    <div class="head-sec">
				      <div class="row">
				        <div class="col-sm-8 col-xs-8">
				          <h3>ORDER ID : #123456789</h3>
				          <p>Delivered on  : 25th Jan 18 </p>
				        </div>
				        <div class="col-sm-4 col-xs-4">
				          <h3>Total Amount : ₹106</h3>
				        </div>
				      </div>
				    </div>
				  </a>
				  <div id="div1" class="division" style="display:block;">
				      <div class="heading-section">
				         <div class="row">
						   <div class="col-lg-3 col-xs-3 text-center" id="track1">
							  <div class="nk-footer-text">
								 <p class="foterp" id="track" onclick="changecolor();"><b>Track Orders</b></p>
							  </div>
						   </div>
						   <div class="col-lg-3 col-xs-3 text-center" id="info1">
							  <div class="nk-footer-text">
								 <p class="foterp" id="info" onclick="changecolor1();"><b>Order info</b></p>
							  </div>
						   </div>
						   <div class="col-lg-3 col-xs-3 text-center" id="log1">
							  <div class="nk-footer-text">
								 <p class="foterp" id="log" onclick="changecolor2();"><b>Order Logs</b></p>
							  </div>
						   </div>
						   <div class="col-lg-3 col-xs-3 text-center" id="billing1">
							  <div class="nk-footer-text">
								 <p class="foterp" id="billing" onclick="changecolor3();"><b>Billing</b></p>
							  </div>
							</div>
						</div>
					</div>
				    <div class="order-details-new">
				      
				      	 
		 <div class="row roww" id="track123" style="min-height: 200px;">
		   <?php if(!empty($logs)){ ?>
		     <div class="container" style="margin-top: 50px;padding-top: 8px;background:#f2f2f2;">
                <div class="row">
                <?php foreach($logs as $log) { ?>
                <?php if($log['order_status'] != 5) { ?>
                 <?php if($log['order_status'] == 0) { ?>
					 <div class="col-lg-2 col-md-2 text-center">
					   <p>Order Received</p>
					   <div class="mj-b">
					     <p><?php echo date('j M Y h:i A', strtotime($log['created_date']));?> <br> </p>
					   </div>
					 </div>	
                <?php } if($log['order_status'] == 1) { ?>
					 <div class="col-lg-2 col-md-2 text-center">
					   <p>Garage Assigned</p>
					   <div class="mj-b">
					     <p><?php echo date('j M Y h:i A', strtotime($log['created_date']));?> <br> </p>
					   </div>
					 </div>	
					<?php } if($log['order_status'] == 2) { ?>
					 <div class="col-lg-2 col-md-2 text-center">
					   <p>Estimate Generated</p>
					    <div class="mj-b">
					     <p><?php echo date('j M Y h:i A', strtotime($log['created_date']));?> <br> </p>
					   </div>
					 </div>	
					 <?php } if($log['order_status'] == 3) { ?>
					 <div class="col-lg-2 col-md-2 text-center">
					   <p>Order is in process</p>
					    <div class="mj-b">
					     <p><?php echo date('j M Y h:i A', strtotime($log['created_date']));?> <br> </p>
					   </div>
					 </div>	
					 <?php } if($log['order_status'] == 4) { ?>
					 <div class="col-lg-2 col-md-2 text-center">
					   <p>Order Completed</p>
					    <div class="mj-b">
					     <p><?php echo date('j M Y h:i A', strtotime($log['created_date']));?> <br> </p>
					   </div>
					 </div>
					<?php } if($log['order_status'] == 7) { ?>
					 <div class="col-lg-2 col-md-2 text-center">
					   <p>Order Delivered</p>
					    <div class="mj-b">
					     <p><?php echo date('j M Y h:i A', strtotime($log['created_date']));?> <br> </p>
					   </div>
					 </div>
                	<?php } } else { ?>
                	 <div class="col-lg-2 col-md-2 text-center">
					   <p>Order Cancelled</p>
					    <div class="mj-b">
					     <p><?php echo date('j M Y h:i A', strtotime($log['created_date']));?> <br> </p>
					   </div>
					 </div>
                	<?php }  } ?>
                </div>	
			    				
			  	<div class="row custom-sec-div oo-bg line">
			  	
					<div class="col-lg-2 col-xs-2 text-center custom-width">
					    <div class="cir" id="fillcircle"></div>
					</div>
					
					<div class="col-lg-2 col-xs-2 text-center custom-width">
					    <div class="cir" id="fillcircle1"></div>
					</div>
					
					<div class="col-lg-2 col-xs-2 text-center custom-width">
					    <div class="cir" id="fillcircle2"></div>
					</div>
					
					<div class="col-lg-2 col-xs-2 text-center custom-width">
					    <div class="cir" id="fillcircle3"></div>
					</div>
					
					<div class="col-lg-2 col-xs-2 text-center custom-width">
					    <div class="cir" id="fillcircle4"></div>
					</div>
					<div class="col-lg-2 col-xs-2 text-center custom-width">
					    <div class="cir" id="fillcircle5"></div>
					</div>
				</div>
			</div>
			<?php } else { ?>
			 <div class="container" style="margin-top: 50px;padding-top: 8px;">
                <div class="row">
                No Ongoing order
                </div>
             </div>
                
            <?php } ?>
		 </div>
	
	     <div class="row" id="info123" style="display:none">
     		<div class="container" style="margin-top: 38px;">
     			<?php if(!empty($order[0])){?>	
					<div class="row roww">
						<div class="col-lg-12 col-xs-12 text-center">
							<div class="col-md-12 form-group" style="margin-top: 10px;">
								<div class="input-group">
									<span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x icon-background1"></i><i class="fa fa-hashtag fa-stack-1x"></i></span>
									<label id="label1"> &nbsp;OrderCode - <?php echo $order[0]['ordercode'];?></label>
								</div>
								<div class="messageContainer"></div>
							</div>
							<div class="col-md-12 form-group" style="margin-top: 10px;">
								<div class="input-group">
									<span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x icon-background1"></i><i class="fa fa-calendar fa-stack-1x"></i></span>
									<label id="label1"> &nbsp;Order booked on - <?php echo date('j M Y', strtotime($order[0]['pickup_date']));?></label>
								</div>
								<div class="messageContainer"></div>
							</div>
							<div class="col-md-12 form-group" style="margin-top: 10px;">
								<div class="input-group">
									<span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x icon-background1"></i><i class="fa fa-wrench fa-stack-1x"></i></span>
									<label id="label1"> &nbsp;<?php echo $order[0]['subcategory'];?></label>
								</div>
								<div class="messageContainer"></div>
							</div>
							<div class="col-md-12 form-group" style="margin-top: 10px;">
								<div class="input-group">
									<span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x icon-background1"></i><i class="fa fa-building fa-stack-1x"></i></span>
									<label id="label1"> &nbsp;Garage Assigned - <?php echo $order[0]['garage_name'];?></label>
								</div>
								<div class="messageContainer"></div>
							</div>
						</div>
					</div>
					<?php } else { ?>
					<div class="row">
						<div class="col-lg-12 col-xs-12 text-center">
						   No Records Found
						</div>
					</div>
					<?php } ?>
				  </div>
			</div>
						    
		    <div class="row" id="log123" style="display:none" >
     		   <div class="container" style="margin-top: 38px;">
				  <div class="row roww">
					 <div class="col-lg-12 col-xs-12 text-center">
			           <div class="nk-footer-text">
					    <!--<p class="foterp" style="font-weight: inherit;text-align: left;background: #f5f5f7;padding: 10px;">A mechanic raised a new service code</p>
						<p class="foterp" style="font-weight: inherit;text-align: left;padding: 10px;">A mechanic raised a new service code</p>-->
						<?php if(!empty($logs)){?>
						<?php foreach($logs as $logcom) { ?>
						    <p class="foterp" style="font-weight: inherit;text-align:left;padding: 10px;background: #f5f5f7;"><?php echo $logcom['comment']; ?></p>
						<?php } } else { ?>	
							 <p class="foterp" style="font-weight: inherit;text-align:left;padding: 10px;background: #f5f5f7;">No Records Found</p>
						<?php } ?>
					</div>
				 </div>	
			   </div>
			</div>
		 </div>
 
					    <div class="row roww" id="billing123" style="display:none">
							<div class="container"
								style="margin-top: 50px; background: #f5f5f7; padding-top: 8px;">
								<div class="row roww">
									<div class="col-lg-2 col-xs-2 text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											<p class="foterp" style="font-weight: inherit;">Select</p>

										</div>
									</div>
									<div class="col-lg-3 col-xs-2 text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											<p class="foterp" style="font-weight: inherit;">Particulars</p>

										</div>
									</div>

									<div class="col-lg-2 col-xs-2 text-center">

										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											<p class="foterp" style="font-weight: inherit;">Priority</p>

										</div>

									</div>
									<div class="col-lg-3 col-xs-2   text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											<p class="foterp" style="font-weight: inherit;">Unit Price</p>

										</div>
									</div>
									<div class="col-lg-2 col-xs-2  text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											<p class="foterp" style="font-weight: inherit;">Price</p>

										</div>
									</div>
								</div>
							</div>
							<div class="container">
							<?php foreach($bill as $row) { ?>
								<div class="row roww">
							      <div class="col-lg-2 col-xs-2  text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											<input type="checkbox" name="vehicle" value="Bike">

										</div>
									</div>
									<div class="col-lg-3 col-xs-2 text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											<p class="foterp" style="font-weight: inherit;">
												<?php echo $row['service_name'];?><span> <img alt="" class="team-img "
													src="<?php //echo asset_url();?>images/img/high.png"></span>
											</p>

										</div>
									</div>

									<div class="col-lg-2 col-xs-2 text-center">

										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											<p class="foterp" style="font-weight: inherit;"><?php if($row['priority']==1) { ?>High<?php } else if($row['priority']==2){ ?>Medium<?php } else { ?> Low<?php } ?></p>

										</div>

									</div>
									<div class="col-lg-3 col-xs-2  text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											<p class="foterp" style="font-weight: inherit;"><?php echo $row['service_price'];?></p>

										</div>
									</div>
									<div class="col-lg-2 col-xs-2  text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											<p class="foterp" style="font-weight: inherit;"><?php echo $row['total_amount'];?></p>

										</div>
									</div>
								</div>
									<?php } ?>
							</div>

							<div class="container"
								style="background: #f5f5f7; padding-top: 8px;padding-bottom:8px">
								<div class="row">
									<div class="col-lg-2 col-xs-2 text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											<p class="foterp" style="font-weight: inherit;"></p>

										</div>
									</div>
									<div class="col-lg-3  col-xs-2 text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											<p class="foterp" style="font-weight: inherit;"></p>

										</div>
									</div>

									<div class="col-lg-2 col-xs-2 text-center">

										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											<p class="foterp" style="font-weight: inherit;"></p>

										</div>

									</div>
									<div class="col-lg-3 col-xs-2  o-6 text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											<p class="foterp" style="font-weight: inherit;">Order Amount</p>
											<p class="foterp" style="font-weight: inherit;">Discount</p>
											<p class="foterp" style="font-weight: inherit;">Net Total</p>
											<p class="foterp" style="font-weight: inherit;">Adjustment</p>
											<p class="foterp" style="font-weight: inherit;">Grand Total</p>

										</div>
									</div>
									<div class="col-lg-2 col-xs-2 o-6 text-center">
										<div class="nk-footer-text">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											<?php if($bill[0]['order_amount']!=''){?>
											<p class="foterp" style="font-weight: inherit;" id="amt"><?php echo $bill[0]['order_amount'];?></p>
                                            <?php } else { ?>
                                            <p class="foterp" style="font-weight: inherit;" id="amt">0</p>
                                            <?php } ?>
                                            <?php if($bill[0]['order_amount']!=''){?>
											<p class="foterp" style="font-weight: inherit;" id="amt"><?php echo $bill[0]['discount'];?></p>
                                            <?php } else { ?>
                                            <p class="foterp" style="font-weight: inherit;" id="amt">0</p>
                                            <?php } ?>
                                            <?php if($bill[0]['order_amount']!=''){?>
											<p class="foterp" style="font-weight: inherit;" id="amt"><?php echo $bill[0]['net_total'];?></p>
                                            <?php } else { ?>
                                            <p class="foterp" style="font-weight: inherit;" id="amt">0</p>
                                            <?php } ?>
                                            <?php if($bill[0]['order_amount']!=''){?>
											<p class="foterp" style="font-weight: inherit;" id="amt"><?php echo $bill[0]['adjustment'];?></p>
                                            <?php } else { ?>
                                            <p class="foterp" style="font-weight: inherit;" id="amt">0</p>
                                            <?php } ?>
                                            <?php if($bill[0]['order_amount']!=''){?>
											<p class="foterp" style="font-weight: inherit;" id="amt"><?php echo $bill[0]['grand_total'];?></p>
                                            <?php } else { ?>
                                            <p class="foterp" style="font-weight: inherit;" id="amt">0</p>
                                            <?php } ?>
										</div>
									</div>
								</div>
							
							</div>
							<div class="container" style="padding-top: 8px;">
								<div class="row">
<!-- 									<div class="col-lg-2 col-xs-12 text-center"> -->
<!-- 										<div class="nk-footer-text"> -->
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											

<!-- 										</div> -->
<!-- 									</div> -->
<!-- 									<div class="col-lg-3 col-xs-12 text-center"> -->
<!-- 										<div class="nk-footer-text"> -->
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											

<!-- 										</div> -->
<!-- 									</div> -->

<!-- 									<div class="col-lg-2 col-xs-12 text-center"> -->

<!-- 										<div class="nk-footer-text"> -->
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											

<!-- 										</div> -->

<!-- 									</div> -->
									<div class="col-lg-12 col-xs-12 text-center">
									<br>
										<div class="nk-footer-text" style="float:right">
											<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
											<?php if($order[0]['grand_total'] > 0) { ?>
											<p class="foterp" style="font-weight: inherit;">
											   <button type="button" class="searchbtn1" onclick="generateInvoice(<?php echo $order[0]['orderid'];?>)">INVOICE</button>
											</p>
		             <?php } ?>
		             
		              <?php if($order[0]['invoice_status'] == 1) { ?>
		              			<p class="foterp" class="btn-cls">
												<button type="button" class="searchbtn1" style="background: #faba03; border: 2px solid #faba03; font-size: 18px;"> PAY NOW</button>
		               		<a href="<?php echo base_url();?><?php echo $order[0]['invoice_url'];?>" target="_blank"><button type="button"class="invoice-btn"> VIEW INVOICE</button></a>
													           </p>
		              <?php }?>
											
										</div>
									</div>
									</div>
									</div>
									</div>
									</div>
									</div>
									</div>
									
				    
				      <!-- <div class="row main-txt">
				        <div class="col-sm-3 col-xs-2"><p>Select <p></div>
				        <div class="col-sm-3 col-xs-3"><p>Particulars<p></div>
				        <div class="col-sm-2 col-xs-2"><p>Priority <p></div>
				        <div class="col-sm-3 col-xs-3"><p>Unit Price<p></div>
				        <div class="col-sm-1 col-xs-1"><p>Price<p></div>
				      </div>
				      <div class="row txt-details">
				        <div class="col-sm-3 col-xs-2"><p><p></div>
				        <div class="col-sm-3 col-xs-3"><p><p></div>
				        <div class="col-sm-2 col-xs-2"> <p><p></div>
				        <div class="col-sm-3 col-xs-3"><p>Order Amount<p></div>
				        <div class="col-sm-1 col-xs-1"><p>2000/-<p></div>
				      </div>
				      <div class="row txt-details">
				        <div class="col-sm-3 col-xs-2"><p><p></div>
				        <div class="col-sm-3 col-xs-3"><p><p></div>
				        <div class="col-sm-2 col-xs-2"> <p><p></div>
				        <div class="col-sm-3 col-xs-3"><p>Discount<p></div>
				        <div class="col-sm-1 col-xs-1"><p>0/-<p></div>
				      </div>
				      <div class="row txt-details">
				        <div class="col-sm-3 col-xs-2"><p><p></div>
				        <div class="col-sm-3 col-xs-3"><p><p></div>
				        <div class="col-sm-2 col-xs-2"> <p><p></div>
				        <div class="col-sm-3 col-xs-3"><p>Net Total<p></div>
				        <div class="col-sm-1 col-xs-1"><p>0/-<p></div>
				      </div>
				      <div class="row txt-details">
				        <div class="col-sm-3 col-xs-2"><p><p></div>
				        <div class="col-sm-3 col-xs-3"><p><p></div>
				        <div class="col-sm-2 col-xs-2"> <p><p></div>
				        <div class="col-sm-3 col-xs-3"><p>Adjustment<p></div>
				        <div class="col-sm-1 col-xs-1"><p>2000/-<p></div>
				      </div>
				      <div class="row txt-details">
				        <div class="col-sm-3 col-xs-2"><p><p></div>
				        <div class="col-sm-3 col-xs-3"><p><p></div>
				        <div class="col-sm-2 col-xs-2"> <p><p></div>
				        <div class="col-sm-3 col-xs-3"><p>Grand Total<p></div>
				        <div class="col-sm-1 col-xs-1"><p>2000/-<p></div>
				      </div>
				    </div>
				  </div>-->
                  <br />
				  <a href="#" data-toggle="#div2" class="track-order">
				     <div class="head-sec">
				      <div class="row">
				        <div class="col-sm-8 col-xs-8">
				          <h3>ORDER ID : #123456789</h3>
				          <p>Delivered on  : 25th Jan 18 </p>
				        </div>
				        <div class="col-sm-4 col-xs-4">
				          <h3>Total Amount : 106</h3>
				        </div>
				      </div>
				    </div>
				  </a>
				  <div id="div2" class="division">
				     <div class="heading-section">
				       <div class="row">
				         <div class="col-sm-3 col-xs-3">
				           <p><b>Track Order</b></p>
				         </div>
				         <div class="col-sm-3 col-xs-3">
				           <p><b>Order Info</b></p>
				         </div>
				         <div class="col-sm-3 col-xs-3">
				           <p><b>Order Logs</b></p>
				         </div>
				         <div class="col-sm-3 col-xs-3">
				           <p><b>Billing</b></p>
				         </div>
				       </div>
				    </div>
				    <div class="order-details-new">
				      <div class="row main-txt">
				        <div class="col-sm-3 col-xs-3"><p>Select <p></div>
				        <div class="col-sm-3 col-xs-3"><p>Particulars<p></div>
				        <div class="col-sm-2 col-xs-1"><p>Priority <p></div>
				        <div class="col-sm-3 col-xs-3"><p>Unit Price<p></div>
				        <div class="col-sm-1 col-xs-1"><p>Price<p></div>
				      </div>
				      <div class="row txt-details">
				        <div class="col-sm-3 col-xs-3"><p><p></div>
				        <div class="col-sm-3 col-xs-3"><p><p></div>
				        <div class="col-sm-2 col-xs-1"> <p><p></div>
				        <div class="col-sm-3 col-xs-3"><p>Order Amount<p></div>
				        <div class="col-sm-1 col-xs-1"><p>2000/-<p></div>
				      </div>
				      <div class="row txt-details">
				        <div class="col-sm-3 col-xs-3"><p><p></div>
				        <div class="col-sm-3 col-xs-3"><p><p></div>
				        <div class="col-sm-2 col-xs-1"> <p><p></div>
				        <div class="col-sm-3 col-xs-3"><p>Discount<p></div>
				        <div class="col-sm-1 col-xs-1"><p>0/-<p></div>
				      </div>
				      <div class="row txt-details">
				        <div class="col-sm-3 col-xs-3"><p><p></div>
				        <div class="col-sm-3 col-xs-3"><p><p></div>
				        <div class="col-sm-2 col-xs-1"> <p><p></div>
				        <div class="col-sm-3 col-xs-3"><p>Net Total<p></div>
				        <div class="col-sm-1 col-xs-1"><p>0/-<p></div>
				      </div>
				      <div class="row txt-details">
				        <div class="col-sm-3 col-xs-3"><p><p></div>
				        <div class="col-sm-3 col-xs-3"><p><p></div>
				        <div class="col-sm-2 col-xs-1"> <p><p></div>
				        <div class="col-sm-3 col-xs-3"><p>Adjustment<p></div>
				        <div class="col-sm-1 col-xs-1"><p>2000/-<p></div>
				      </div>
				      <div class="row txt-details">
				        <div class="col-sm-3 col-xs-3"><p><p></div>
				        <div class="col-sm-3 col-xs-3"><p><p></div>
				        <div class="col-sm-2 col-xs-1"> <p><p></div>
				        <div class="col-sm-3 col-xs-3"><p>Grand Total<p></div>
				        <div class="col-sm-1 col-xs-1"><p>2000/-<p></div>
				      </div>
				    </div>
				  </div>
				  
			  </div>
			  
			  
			  <script type="text/javascript">
			    $("a[data-toggle]").on("click", function(e) {
				  e.preventDefault();  // prevent navigating
				  var selector = $(this).data("toggle");  // get corresponding element
				  $(".division").hide();
				  $(selector).show();
				});
			  </script>
			
			<!-- new ongoing order ends-->


			</div>

			<div class="container">
				<div class="row">
					<div class="col-md-3 bike1"></div>
					<div class="col-md-6">
						<!--<img src="img/GooglePlay.png" class="img-responsive" width="100%"/> -->
					</div>

					<div class="col-md-3"></div>

				</div>
			</div>

		</div>
	</div>


</section>

<a class="scrolltop" href="#"><span class="fa fa-angle-up"></span></a>

<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';
var asset_url = '<?php echo asset_url();?>'; 
</script>
<script src="<?php echo asset_url();?>js/lib/jquery/jquery.min.js"></script>
<script type="text/javascript">
jQuery(window).load(function() {
 <?php foreach($logs as $log) { ?>
   <?php if($log['order_status'] != 5) { ?>
   <?php if($log['order_status'] == 0) { ?>
   		jQuery("#fillcircle").addClass("cir-y");	
   <?php } if($log['order_status'] == 1) { ?>
   		jQuery("#fillcircle1").addClass("cir-y");				
   <?php } if($log['order_status'] == 2) { ?>
   		jQuery("#fillcircle2").addClass("cir-y");				 
   <?php } if($log['order_status'] == 3) { ?>
  		jQuery("#fillcircle3").addClass("cir-y");			
   <?php } if($log['order_status'] == 4) { ?>
   		jQuery("#fillcircle4").addClass("cir-y");			
   <?php } if($log['order_status'] == 7) { ?>
   		jQuery("#fillcircle5").addClass("cir-y");			 
   <?php } } else { ?>
   		jQuery("#fillcircle2").addClass("cir-y");       	
   <?php }  } ?>
});
</script>
<script>
function ajaxindicatorstart(text)
{
	if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
	jQuery('body').append('<div id="resultLoading" style="display:none"><div><i class="fa fa-spinner fa-5x"></i><div>'+text+'</div></div><div class="bg"></div></div>');
	}

	jQuery('#resultLoading').css({
		'width':'100%',
		'height':'100%',
		'position':'fixed',
		'z-index':'10000000',
		'top':'0',
		'left':'0',
		'right':'0',
		'bottom':'0',
		'margin':'auto'
	});

	jQuery('#resultLoading .bg').css({
		'background':'#000000',
		'opacity':'0.7',
		'width':'100%',
		'height':'100%',
		'position':'absolute',
		'top':'0'
	});

	jQuery('#resultLoading>div:first').css({
		'width': '250px',
		'height':'75px',
		'text-align': 'center',
		'position': 'fixed',
		'top':'0',
		'left':'0',
		'right':'0',
		'bottom':'0',
		'margin':'auto',
		'font-size':'16px',
		'z-index':'10',
		'color':'#ffffff'

	});

    jQuery('#resultLoading .bg').height('100%');
       jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}
function ajaxindicatorstop()
{
    jQuery('#resultLoading .bg').height('100%');
       jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
} 
</script>

<script>
    $('#info123').hide();
    $('#log123').hide();
    $('#billing123').hide();
    function changecolor() 
    {
        document.getElementById('track1').style.color ='#faba03  !important';
        document.getElementById('info1').style.color ='#000';
        document.getElementById('log1').style.color ='#000';
        document.getElementById('billing1').style.color ='#000';
        $('#info123').hide();
        $('#log123').hide();
        $('#billing123').hide();
        $('#track123').show();
    }
    </script>
    
    <script>
    $('#log123').hide();
    $('#billing123').hide();
    function changecolor1() 
    {
        document.getElementById('info1').style.color = '#faba03  !important';
        document.getElementById('track1').style.color ='#000';
        document.getElementById('log1').style.color ='#000';
        document.getElementById('billing1').style.color ='#000';
        $('#track123').hide();
        $('#log123').hide();
        $('#billing123').hide();
        $('#info123').show();
    }
    </script>
    
    <script>
  $('#info123').hide();
    $('#billing123').hide();
    function changecolor2() 
    {
        document.getElementById('log1').style.color = '#faba03  !important';
        document.getElementById('track1').style.color ='#000';
        document.getElementById('info1').style.color ='#000';
        document.getElementById('billing1').style.color ='#000';
        $('#track123').hide();
        $('#info123').hide();
        $('#billing123').hide();
        $('#log123').show();
    }
    </script>
    
<script>
 $('#info123').hide();
    $('#log123').hide();
    function changecolor3() 
    {
        document.getElementById('billing1').style.color =' #faba03 !important';
        document.getElementById('track1').style.color ='#000';
        document.getElementById('log1').style.color ='#000';
        document.getElementById('info1').style.color ='#000';
        $('#track123').hide();
        $('#info123').hide();
        $('#log123').hide();
        $('#billing123').show();
    }

    function generateInvoice(orderid) {
    	//alert("inside invoice");
    	var a=document.getElementById("amt").innerHTML;
    	//var b=10;
    	ajaxindicatorstart("Please hang on.. while we generate invoice ..");
    	$.post(base_url+"admin/order/invoice/generate/"+orderid,{grand_total: a}, function(data){
    		ajaxindicatorstop();
    		alert(data.msg);
    		window.location.reload();
    	},'json');
    }
 </script>