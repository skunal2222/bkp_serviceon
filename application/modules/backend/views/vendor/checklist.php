  	  <div id="mainchk">	
	                          	<input id="box"> <a href="#" id="clear">clear</a>
	                          	<ul id="treecheck">	
	                          	<li>				
                                   <ul class="home-second-menu clearfix hello">
                                   <?php 
                                   foreach ($subcat as $subcategory) { ?>
					                 <li>
										<input type="checkbox" value="<?php echo $subcategory['id'];?>" id="subcategory_id" name="subcategory_id[]" checked><?php echo $subcategory['name'];?> (<?php echo $subcategory['brand'];?>)	
									
									
									<ul class="home-second-menu clearfix">
                                   <?php 
                                   foreach ($services as $service) { 
                                   	if($subcategory['id']==$service['subcategory_id']){
                                   	?>
					                 <li>
										<input type="checkbox" value="<?php echo $service['id'];?>" id="service_id" name="service_id[]" checked><?php echo $service['name'];?>
									
									
									</li>	
								   <?php }} ?>			
									</ul>
									
									</li>	
								   <?php } ?>			
									</ul>
									</li></ul>	
								</div>