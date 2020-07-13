<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/booking-flow/common.css">
<div class="booking jumbotron">
	<div class="container">
		<div class="flex-box">
			<div class="flex-1">
                <div class="select-box active">
                    <img src="<?php echo asset_url();?>frontend/images/new-img/subcategoryname1w.png" alt="thankyou">
                    <h2><a href="<?= base_url()?>select-subcategory">Select Subcategory</a></h2>
                </div>
                <div class="">
                    <?php if(!empty($_SESSION['subcategory_id']) ){

                        if ($_SESSION['subcategory_id']== 11) { ?>
                          
                             <h4 class="text-center">Breakdown </h4>
                      <?php } elseif ($_SESSION['subcategory_id']== 12) { ?>
                        
                         <h4 class="text-center">Pick-Up & Drop</h4>
                    <?php  }  elseif ($_SESSION['subcategory_id']== 13) { ?>
                             <h4 class="text-center">Doorstep</h4>

                    <?php }  ?>
                   
                    <?php }  ?>
                </div>
            </div>
            <div class="flex-1">
                <div class="select-box active">
                    <img src="<?php echo asset_url();?>frontend/images/new-img/modelselectbrandw.png" alt="thankyou">
                    <h2><a href="<?= base_url()?>select-vehicle">Select Vehicle</a></h2>
                </div>
                <div class="">
                    <h4 class="text-center"><?php echo $vehicle_number.'('. $vehicle_brand.'-'.$vehicle_model.')'; ?></h4>
                </div>
            </div>
			<div class="flex-1">
				<div class="select-box active">
					<img src="<?php echo asset_url();?>frontend/images/new-img/servicesandpackagesselectbrandw.png" alt="thankyou">
					<h2><a href="https://bikedoctor.in/staging/select-package">Select Service or Packages</a></h2>
				</div>
			</div>
			<div class="flex-1">
				<div class="select-box">
					<img src="<?php echo asset_url();?>frontend/images/new-img/address-selectbrand.png" alt="thankyou">
					<h2>Select Address</h2>
				</div>
			</div>
		</div>

		<!-- select service or package -->
		     <div class="select-service">
		    	<div class="display-inline">
		    		<button type="button" class="ser-btn btn1-spl" onclick="window.location.href = '<?php echo base_url();?>select-services';">Services</button>
		    		<button type="button" class="ser-btn btn2-spl">Packages</button>
		    	</div>
		    </div> 
		<!-- select service or package -->  


				<div class="detail-section">
					<div class="basic-info">
                        <h3 class="text-center">My Packages</h3>
	                 <?php  if(empty($mypackages))  :?>
 						<!-- no Packages ends -->
							<div class="no-packages text-center">
		  						<h3>You have not booked any package till now!</h3>
		  						<button type="button" class="spl-btn" style="font-size: 17px; line-height: 1;"  onclick="window.location.href = '<?php echo base_url() ;?>package';">See All Packages +</button>
							</div>
						<!-- no Packages ends -->

							 <!-- Package Sections  -->
					<?php else :  
						foreach($mypackages as $package) :
							$packageinfo=$package['packages'][0]; ?>
				 
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
							    $expiredate=strtotime($package['expiry_date']);

							    $currentdate = strtotime(date('d-m-Y'));
							    $pkstatus="";

                            
							   // pretag($package['service_used_validity']);
                             //$package['is_expire']!=0 && $package['ordercnt'] < $package['service_used_validity'] && $expiredate > $currentdate
								 if($package['is_expire']!=0 && $package['ordercnt'] < $package['service_used_validity'] && $expiredate > $currentdate )
								    {
										$pkstatus="Active";
										
									}else{
										$pkstatus='Expired' ;
										
									}
										//if($packageinfo['year'])
										?>

										 </p>
									<div class="collapse" id="all-package-details<?php echo $packageinfo['id']?>">	
										<div class="row package-details">
											<div class="col-md-4 col-sm-12">
												<h4>Statuts : <span><?= $pkstatus; ?></span></h4>
												<h4>Expiring on : <?= date('d-m-Y',$expiredate); ?></h4>
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
										<div class="button-sec">
											<?php if($pkstatus=='Expired') : 
											  $url=base_url().'book-service?id='.$packageinfo['id']; ?>
											<button type="button" class="spl-btn" style="font-size: 12px; line-height: 2;" onclick="window.location.href = '<?php echo $url ;?>';">Renew Package</button>
											<?php else : ?>
											<button type="button" class="spl-btn" style="font-size: 12px; line-height: 2;" onclick="place_order(<?= $packageinfo['id'] ?>);">Avail Package</button>
									     	<?php endif;  ?> 

											<!-- <button type="button" class="spl-btn" onclick="window.location.href = '<?php echo base_url() ;?>package';">Buy Other Packages</button> -->

											<a href="<?php echo base_url(); ?>package "  target="_blank" > Buy Other Packages</a> &nbsp; &nbsp;

											<a href="<?php echo base_url().$package['invoice_url']; ?><?php echo $package['orderid']?>"  target="_blank" > Download Invoice</a>
										</div>
									</div> 
									</div>
									<div class="col-md-3 col-sm-3 text-right">
										<!-- <h3>Price : Rs <?= $packageinfo['special_price']; ?></h3>  -->
										<h3 class="spl-btn" style="font-size: 14px; line-height: 1;margin-left: 118px;" data-toggle="collapse" href="#all-package-details<?php echo $packageinfo['id']?>">View More +</h3>
									</div>  
								</div>

										
							</div>
						</div>
			
					<!--My Packages -->
				<?php endforeach;
			          endif;  ?> 

			          </div>

				</div> 

			   <!-- Recommended  Package Sections  -->
				<div class="detail-section">
					<div class="basic-info">
						<h2 class="text-center">Recommended Packages</h2>  
						<?php if (!empty($packages)) { ?> 

						            <?php foreach ($packages as $item):

 						     $url=base_url().'book-service?id='.$item['id'];?>
						<div class="my-packages">
							<div class="my-package">
								<div class="row">
									<div class="col-md-1 col-sm-2">
										<img src="<?php echo asset_url().'/'. $item['image'];?>" alt="thankyou">
									</div>
									<div class="col-md-8 col-sm-7">
										 <h3><?php echo $item['package_name'];?></h3>
										 <h3>Actual Price : Rs   <strike> <?php echo $item['best_price'];?></strike> &nbsp; Offer Price Rs <?php echo $item['special_price'];?> </h3> 
										<div class="collapse" id="all-package-details<?php echo $item['id']?>">	
											<div class="row package-details">
												  <div style="height: 195px">

												     <?php  $services=$item['services'];

						                            for($f=0;$f<5;$f++){ 
											             echo '<p>'.(isset($services[$f]['servicename']) ? $services[$f]['servicename'] : "") .'</p>'; 
						                           }?>

						                            </div>
											</div> 
										</div> 
									</div>

									<div class="col-md-3 col-sm-3 text-right"> 
										<button type="button" class="know-more-btn" onclick="quickView(<?= $item['id'];?>);">Know More+</button>
										<button type="button" class="custom-btn1" style="" onclick="setPackage(<?= $item['id'];?>)">Buy Now</button>
										 
									</div>    
								</div> 
							  </div>
							
							</div>			
							
							 <?php endforeach;?>
							<?php } else{  ?>
										
						    <div class="col-sm-6 col-md-4 col-xs-12">
								<div class="package text-center">
									<img src="<?php echo asset_url();?>frontend/images/" alt="thankyou">
									<h3>No Package Found</h3> 
								</div>
							</div>
							<?php } ?>  
						
							
					</div>
				</div>	 

			</div> 

		<!-- Package Sections  -->
			
		<!-- Package Sections  -->
		<!-- <div class="confirm text-center">
			<button type="button" class="custom-btn1" onclick="next()">Continue</button>
		</div> -->
	</div>
</div> 

					<!-- know more package pop up -->
                      <!-- Modal -->
                        <div id="quick_view_Popup" >
                          
                        </div>
                      <!-- Modal -->  
                    <!-- know more package pop up -->

 
<script>
	var userid = '<?php echo $this->session->userdata('olouserid') ; ?>';
	var vehicle_no = '<?php echo json_encode($_SESSION['vehicle_no']); ?>' ; 
	var catsubcat_id = '<?php echo json_encode($_SESSION['catsubcat_id']); ?>' ; 
 	//alert(catsubcat_id); 
 	//var catsubcat_ids = catsubcat_id.split(",");
 	//alert(catsubcat_ids);
 	//  $("#servicename").selectize({});
    //function quickview
    function quickView(id){ 
	    $.post(base_url+"quickView", {id : id}, function(data){
	          $('#quick_view_Popup').html(data); 
	             $("#package_modal").modal('show');
	    },'html');
 	} 

 	function setPackage(id){  
 		 
  		if(id==""){
 			 		swal('','Please select Package','error'); 
 		}else{
	   		$.post(base_url+'setPackage',{package_id:id,vehicle_no:vehicle_no,catsubcat_id:<?php echo json_encode($_SESSION['catsubcat_id']); ?>},function(data){
	   			if(data.status==1){
	   				if(userid==""){
						$('#myLoginModal').modal('show');
					}else{
						window.location.href=base_url+'select-address';  
					}
				   			}
	    	},'json');
	   	}

 	}

 	function next(){
 		if(id==""){
 			 		swal('','Please select Package','error'); 
 		}
 		else{
			if(userid==""){
				$('#myLoginModal').modal('show');
			}else{
				window.location.href=base_url+'select-address';  
			}
		}	
 	} 
</script>   
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