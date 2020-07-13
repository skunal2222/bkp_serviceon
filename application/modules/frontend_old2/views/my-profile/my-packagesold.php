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
							<a href="<?php echo base_url();?>notifications">
							    Notifications
						    </a>
						</li>
                        <li class="active">
                            <a href="<?php echo base_url();?>my-packages">
                               My Packages
                            </a>
                        </li>
					</ul>
				</div>
			</div>
			<div class="col-md-9 col-sm-8">
				<div class="detail-section">
					<div class="basic-info">
                        <h2>My Packages</h2>
	                 <?php  if(empty($mypackages))  :?>
 						<!-- no Packages ends -->
							<div class="no-packages text-center">
		  						<img src="<?php echo asset_url();?>frontend/images/hierarchy-structure.png" alt="no-ongoin-orders" />
		  						<h3>You have not booked any package till now!</h3>
		  						<button type="button" class="spl-btn" onclick="window.location.href = '<?php echo base_url() ;?>package';">See All Packages +</button>
							</div>
						<!-- no Packages ends -->


			           <!-- Package Sections  -->
						<div class="package-section">
							<div class="row">
								 <?php if (!empty($package)) { ?>
						            <?php foreach ($package as $item):
						            	//print_r($item['services']);
						     $url=base_url().'book-service?id='.$item['id'];?>
					<div class="col-sm-6 col-md-4 col-xs-12">
						<div class="package text-center">
							<img src="<?php echo asset_url().'/'. $item['image'];?>" alt="thankyou">
							<h3><?php echo $item['package_name'];?></h3>
							<h4><?php echo $item['best_price'];?></h4>
						   <?php  foreach ($item['services'] as $services): ?>
							<p><?php echo $services['servicename'];?> </p>
						    <?php endforeach; ?>
							
							<h5>You Saved Rs <?php echo $item['best_price']-$item['special_price'];?></h5>
							<!-- <button type="button" class="know-more-btn" data-dismiss="modal" data-toggle="modal" data-target="#know-package-modal">Know More+</button> -->
							<button type="button" class="know-more-btn" onclick="quickView(<?= $item['id'];?>);">Know More+</button>
							<?php $userid=$this->session->userdata('olouserid');
							if(isset($userid)) :?>

							<button type="button" class="custom-btn1" onclick="window.location.href = '<?php echo $url ;?>';">Buy Now</button>
							<?php else  : ?>
							<button type="button" class="custom-btn1" onclick="checklogin('<?php echo $item['id'] ;?>');">Buy Now</button>
						   <?php endif; ?>
							
						</div>
					</div>
							<!-- 	<tr>
								    <td><?php echo $item['id'];?></td>
									<td><?php echo $item['package_name'];?></td>
									<td><?php echo $item['year'];?></td>
									<td><?php echo $item['service_used_validity'];?></td>
									<td><?php echo $item['short_description'];?></td>
									<td><?php echo $item['long_description'];?></td>
									<td><?php echo $item['best_price'];?></td>
									<td><?php echo $item['special_price'];?></td>
							      
									
								</tr> -->
				     <?php endforeach;?>
						        <?php } else{?>
								
				    <div class="col-sm-6 col-md-4 col-xs-12">
						<div class="package text-center">
							<img src="<?php echo asset_url();?>frontend/images/" alt="thankyou">
							<h3>No Package Found</h3>
							
							
						</div>
					</div>
							<?php }?>
							</div>
						</div>
					<!-- Package Sections  -->
					<?php else :  
						foreach($mypackages as $package) :
							$packageinfo=$package['packages'][0];
							/*echo "<pre>";
							print_r($packageinfo);
							exit();*/
							 ?>
				 
					<!--My Packages -->
						<div class="my-packages">
							<div class="my-package">
								<div class="row">
									<div class="col-md-1 col-sm-2">
										<img src="<?php echo asset_url().$packageinfo['image'];?>" alt="thankyou">
									</div>
									<div class="col-md-8 col-sm-7">
										 <h3><?=$packageinfo['package_name']; ?></h3>
										 <p>
						   <?php $serviceStr=""; $i=1;
								foreach($packageinfo['services'] as $sevices) :
									    $serviceStr.=($i==1 ? '':' | ');
										$serviceStr.=$sevices['name']; 
										$i++;
							    endforeach;
								echo $serviceStr;
							    $packagedate=date('d-m-Y',strtotime($package['created_date']));
							    $expiredate=date('d-m-Y',strtotime($package['expiry_date']));

							    $currentdate = date('d-m-Y');
							    $pkstatus="";


							   // pretag($package['service_used_validity']);

								 if($package['is_expire']!=0 && $package['ordercnt'] < $package['service_used_validity'] && $expiredate > $currentdate)
								    {
										$pkstatus="Active";
										
									}else{
										$pkstatus='Expired' ;
										
									}

										
										//if($packageinfo['year'])
										?>

										 </p>
										
										<div class="row package-details">
											<div class="col-md-4 col-sm-12">
												<h4>Statuts : <span><?= $pkstatus; ?></span></h4>
												<h4>Expiring on : <?= $expiredate; ?></h4>
											</div>
											<div class="col-md-4 col-sm-12">
												<h4>Booking ID :  <?= $package['orders'][0]['ordercode']; ?></h4>
												<h4>Package Limit : <?= $package['service_used_validity']; ?> times</h4>
											</div>
											<div class="col-md-4 col-sm-12">
												<h4>Subscribed on : <?= $packagedate; ?></h4>
												<h4>Used till now : <?= $package['ordercnt']; ?> times</h4>
											</div>
										</div>

									</div>
									<div class="col-md-3 col-sm-3 text-right">
										<h3>Price : <?= $packageinfo['special_price']; ?></h3>
									</div>
								</div>

										<div class="button-sec">
											<?php if($pkstatus=='Expired') : 
											  $url=base_url().'book-service?id='.$packageinfo['id']; ?>
											<button type="button" class="spl-btn"  onclick="window.location.href = '<?php echo $url ;?>';">Renew Package</button>
											<?php else : ?>
											<button type="button" class="spl-btn" onclick="place_order(<?= $packageinfo['id'] ?>);">Avail Package</button>
									     	<?php endif;  ?>
											<button type="button" class="spl-btn" onclick="window.location.href = '<?php echo base_url() ;?>package';">Buy Other Packages</button>
											
											<a href="<?php echo base_url().$mypackages[0]['invoice_url']; ?> " class="spl-btn" target="_blank" >Download Invoice</a>
										</div>
							</div>
						</div>
			
					<!--My Packages -->
				<?php endforeach;
			          endif;  ?>
                        
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>


					<!-- know more package pop up -->
                      <!-- Modal -->
                          <div id="quick_view_Popup"></div>
                      <!-- Modal -->  
                    <!-- know more package pop up -->


<script>
     //  $("#servicename").selectize({});
    //function quickview
    function place_order(pkid){ 
    //	alert(id);
     $.post(base_url+"bookingorder", {id : pkid}, function(data){
          $('#quick_view_Popup').html(data); 
             $("#package_modal").modal('show');
          },'html');
 }
</script>