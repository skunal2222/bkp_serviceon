	<!-- Package Sections  -->

		

			 <?php if (!empty($package)) { ?>

						            <?php foreach ($package as $item):

						            	//print_r($item['services']);

						     $url=base_url().'book-service?id='.$item['id'];?>

					<div class="col-sm-6 col-md-4 col-xs-12">

						<div class="package text-center">

							<img src="<?php echo asset_url().'/'. $item['image'];?>" alt="thankyou">

							<h3><?php echo $item['package_name'];?></h3>

							<h4><?php echo $item['best_price'];?></h4>

						 <!--   <?php  foreach ($item['services'] as $services): ?>

							<p><?php echo $services['servicename'];?> </p>

						    <?php endforeach; ?> -->

						    <div style="height: 168px">

						     <?php  $services=$item['services'];

                            for($f=0;$f<5;$f++){

												

					             echo '<p>'.(isset($services[$f]['servicename']) ? $services[$f]['servicename'] : "") .'</p>';

					          

                           }?>

                            </div>

							

						<!-- 	<h5>You Saved Rs <?php echo $item['best_price']-$item['special_price'];?></h5> -->

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

							

				     <?php endforeach;?>

						        <?php } else{?>

								

				    <div class="col-sm-6 col-md-4 col-xs-12">

						<div class="package text-center">

							<img src="<?php echo asset_url();?>frontend/images/" alt="thankyou">

							<h3>No  More Package Found</h3>

							

							

						</div>

					</div>

							<?php }?>

			



