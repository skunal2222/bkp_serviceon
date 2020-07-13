<link type="text/css" rel="stylesheet"
	href="<?php echo asset_url();?>css/selectize.bootstrap3.css">
<link type="text/css" rel="stylesheet"
	href="<?php echo asset_url();?>css/datepicker3.css">
<link type="text/css" rel="stylesheet"
	href="<?php echo asset_url();?>css/bootstrap-timepicker.min.css">
<link rel="stylesheet"
	href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css">
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css"
	rel="stylesheet" type="text/css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.almightree.js"></script>
<link rel="stylesheet"
	href="<?php echo asset_url();?>css/almightree.css">
	
<div class="row" style="padding-left: 259px;padding-right: 35px;">
<div class="col-lg-12">
<h3 class="page-header">Update Vendor</h3>

<div class="panel-group" id="accordion">
	<div class="panel panel-default"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
    <div class="panel-heading"><b>Basic Details</b></div></a>
    <div id="collapseOne" class="panel-collapse collapse">
	<div class="panel-body">
  		<form id="rest_details" name="rest_details" action="" method="post">
					<input type="hidden" name="restid" value="<?php echo $basic[0]['id'];?>" />
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="row">
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-name">
												<label class="control-label col-sm-5">Garage Name <span
													class='text-danger'>*</span></label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="garage_name" name="garage_name"	value="<?php echo $basic[0]['garage_name'];?>" />
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-name">
												<label class="control-label col-sm-5">Vendor Name <span
													class='text-danger'>*</span></label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="name" name="name" value="<?php echo $basic[0]['name'];?>" />
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>

									</div>
									<div class="row">
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-landmark">
												<label class="control-label col-sm-5">Email <span
													class='text-danger'>*</span></label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="email" name="email" value="<?php echo $basic[0]['email'];?>" />
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-landline_1">
												<label class="control-label col-sm-5">Mobile Number <span
													class='text-danger'>*</span></label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="mobile"	name="mobile" value="<?php echo $basic[0]['mobile'];?>" />
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>

									</div>
									<div class="row">
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-landline_2">
												<label class="control-label col-sm-5">Alternate Number</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="landline" name="landline" value="<?php echo $basic[0]['landline'];?>" />
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-address">
												<label class="control-label col-sm-5">Address <span
													class='text-danger'>*</span></label>
												<div class="col-sm-10">
													<textarea class="form-control" rows="3" id="address" name="address"><?php echo $basic[0]['address'];?></textarea>
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>

									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group" id="error-name">
												<label class="control-label">Category<span
													class='text-danger'>*</span></label>
												<div class="col-sm-10">
													<select name="category_id" id="category_id"	class="form-control">
														<option value="">Select Category</option>
													<?php foreach ($categories as $category) { ?>
													<option value="<?php echo $category['id'];?>"
															<?php if($basic[0]['category_id'] == $category['id']) {?>
															selected <?php }?>><?php echo $category['name'];?></option>
													<?php } ?>
												</select>
												</div>
											</div>
											<div class="messageContainer"></div>
										</div>
										<div class="col-md-6">
											<div class="form-group" id="error-name">
												<label class="control-label">Brand<span class='text-danger'>*</span></label>
												<div class="col-sm-10">
													<select name="brand_id[]" id="brand_id"	class="form-control" multiple="true">
														<option value="">Select Brand</option>		
														<?php //echo $basic[0]['brand_id'];?>										
														<?php //echo print_r($brands); ?>
														<?php
														if (! empty ( $brands )) {
															foreach ( $brands as $pro ) {
																$commaseparatedlist = explode ( ',', $basic [0] ['brand_id'] );
																?>
																	<option value="<?php echo $pro['id'] ?>"
															<?php if (in_array($pro['id'], $commaseparatedlist))  {?>
															selected <?php }?>><?php echo $pro['name'] ?></option>
														<?php  } }  ?>
													</select>
												</div>
											</div>
											<div class="messageContainer"></div>
										</div>

									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" id="error-name">
												<label class="control-label">Model<span class='text-danger'>*</span></label>
												<div class="col-sm-10">
													<select name="model_id[]" id="model_id" class="form-control" multiple="true"> 
													<?php
													if (! empty ( $models )) {
														foreach ( $models as $pro ) {
															$commaseparatedlist = explode ( ',', $basic [0] ['model_id'] );
															?>
																	<option value="<?php echo $pro['id'] ?>"
															<?php if (in_array($pro['id'], $commaseparatedlist))  {?>
															selected <?php }?>><?php echo $pro['name'] ?></option>
													<?php  } }  ?>
													
													<!-- echo '<optgroup label="">';	<option value="">Select Model</option>echo "</optgroup>";-->
													</select>
													<input type="button" id="select_all" name="select_all" value="Select All">
												</div>
											</div>
											<div class="messageContainer"></div>
										</div>
										<!-- 		<div class="col-md-6">
												<div class="form-group" id="error-name">
											<label class="control-label">Subcategory<span class='text-danger'>*</span></label>
											  <div class="col-sm-10">
											<select name="subcategory_id" id="subcategory_id" class="form-control">
													<option value=""> Select Subcategory</option>												
													<?php
													/*
													 * print_r($subcategories[0]);?>
													 * <?php foreach ($subcategories[0] as $category) { ?> <option value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option> <?php }
													 */
													?>
											</select>
											</div>
										</div>
										<div class="messageContainer"></div>
									</div>-->

									</div>

									<div class="row">
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-pincode">
												<label class="control-label col-sm-5">Pincode </label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="pincode" name="pincode" value="<?php echo $basic[0]['pincode'];?>" />
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-address">
												<label class="control-label col-sm-5">Review</label>
												<div class="col-sm-10">
													<textarea class="form-control" rows="3" id="review"	name="review"><?php echo $basic[0]['review'];?></textarea>
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>

									</div>
									<div class="row">
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-pincode">
												<label class="control-label col-sm-5">Grade</label>
												<div class="col-sm-10">
													<select name="rating" id="rating" class="form-control">
														<option value="">Select Grade</option>
													<?php foreach ($grades as $grade) { ?>
													<option value="<?php echo $grade['id'];?>"
															<?php if($basic[0]['rating'] == $grade['id']) {?>
															selected <?php }?>><?php echo $grade['name'];?></option>
													<?php } ?>
												</select>
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
									</div>
									<!--<div class="row">
	                                <div class="col-lg-12 margin-bottom-5">
	                                	<div class="form-group" id="error-logo">
                                            <label class="control-label col-sm-3">Comments<span class='text-danger'>*</span></label>
                                            <div class="col-sm-5">
	                                            <textarea class="form-control" rows="3" id="comment" name="comment"></textarea>        
											</div>
											<div class="messageContainer col-sm-4"></div>
                                        </div>
	                              	</div>
	                          	</div>-->

									<div class="row text-center">
									<?php if($_SESSION['adminsession']['user_role']==1){?>
									<button type="submit" class="btn btn-success">Update</button>
									<?php } else {?>
									<button type="submit" class="btn btn-success" disabled>Update</button>
									<?php }?>
								  </div>

								</div>
							</div>
						</div>
					</div>
				</form>
  
    </div>
    </div>
    </div>
    <!--Second panel for Service-->
    
    <div class="panel panel-default"><a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
    <div class="panel-heading"><b>Service</b></div></a>
    <div id="collapseTwo" class="panel-collapse collapse">
    <div class="panel-body">
        	<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">

								<div id="">
									<input id="box"> <a href="#" id="clear">clear</a>
									<ul id="treecheck">
									  <li>
									   <ul class="home-second-menu clearfix hello">
                                   <?php foreach ( $subcategories as $subcategory ) { ?>
					                  <li>
					                  	  <input type="checkbox" value="<?php echo $subcategory['id'];?>" id="subcategory_id" name="subcategory_id[]" checked><?php echo $subcategory['name'];?> (<?php echo $subcategory['brand'];?>)	
									  <ul class="home-second-menu clearfix">
                                   <?php
									  foreach ( $services as $service ) {
										 if ($subcategory ['id'] == $service ['subcategory_id']) {
									?>
					                 <li>
					                 	 <input type="checkbox" value="<?php echo $service['id'];?>" id="service_id" name="service_id[]" checked><?php echo $service['name'];?>
									 </li>	
								   <?php } } ?>			
									</ul></li>	
								   <?php } ?>			
									</ul>
										</li>
									</ul>
								</div>

							</div>
						</div>
					</div>
				</div>     
    </div>
    </div>
    </div>

    <!-- /Third panel for Zone -->
	<div class="panel panel-default"><a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
    <div class="panel-heading"><b>Zone</b></div></a>
    <div id="collapseThree" class="panel-collapse collapse">
    <div class="panel-body">
	<form id="vendor_area" name="vendor_area" action="" method="post">
			  <input type="hidden" name="rid" value="<?php echo $basic[0]['id'];?>" />
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-landmark">
											<label class="control-label col-sm-3">Landmark</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="landmark" name="landmark" value="<?php echo $basic[0]['landmark'];?>" />
											</div>
											<div class="messageContainer col-sm-4"></div>
										</div>
									</div>
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-locality">
											<label class="control-label col-sm-5">Accurate Location <span class='text-danger'>*</span></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="locality11" name="locality" value="<?php echo $basic[0]['locality'];?>" />
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-longitude">
											<label class="control-label col-sm-5">Latitude <span class='text-danger'>*</span></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="latitude" name="latitude" value="<?php echo $basic[0]['latitude'];?>" />
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-longitude">
											<label class="control-label col-sm-5">Longitude <span class='text-danger'>*</span></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="longitude" name="longitude"	value="<?php echo $basic[0]['longitude'];?>" />
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-radius">
											<label class="control-label col-sm-5">Delivery Radius <span class='text-danger'>*</span></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="radius" name="radius" value="<?php echo $basic[0]['radius'];?>"  />
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<!--<div class="col-lg-12 margin-bottom-5 text-center">
										<div id="response"></div>
										<button type="submit" class="btn btn-success"
											onclick="">Next</button>
									</div>-->
									<div class="col-lg-12 margin-bottom-5 text-center">
										<div id="response"></div>
										<?php if($_SESSION['adminsession']['user_role']==1){?>
										<button type="submit" class="btn btn-success">Update</button>
										<?php } else {?>
										<button type="submit" class="btn btn-success" disabled>Update</button>
										<?php }?>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			 </form>
    </div>
    </div>
	</div>
    <!-- forth panel for Billing Settings -->
    <div class="panel panel-default"><a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
    <div class="panel-heading">
            <b>Billing Settings</b>
    </div></a>
    <div id="collapseFour" class="panel-collapse collapse">
    <div class="panel-body">
   		<form id="restbilling" name="restbilling" action="" method="post">
					<input type="hidden" name="restid" value="<?php echo $basic[0]['id'];?>" />
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="row">
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-billing_cycle">
												<label class="control-label col-sm-5">Billing Cycle <span
													class='text-danger'>*</span></label>
												<div class="col-sm-10">
													<select name="billing_cycle" id="billing_cycle"
														class="form-control" style="display: inline; width: 48%;">
														<option value="">Select Billing Cycle</option>
														<option value="1"
															<?php if(isset($bconfig[0]['billing_cycle']) && $bconfig[0]['billing_cycle'] == 1) {?>
															selected <?php }?>>Weekly</option>
														<option value="2"
															<?php if(isset($bconfig[0]['billing_cycle']) && $bconfig[0]['billing_cycle'] == 2) {?>
															selected <?php }?>>Fortnightly</option>
														<option value="3"
															<?php if(isset($bconfig[0]['billing_cycle']) && $bconfig[0]['billing_cycle'] == 3) {?>
															selected <?php }?>>Monthly</option>
													</select> <input type="text" id="cycle_effective_date"
														name="cycle_effective_date" class="form-control"
														value="<?php if($cycle) {echo date('d-m-Y',strtotime($cycle[0]['from_date']));}?>"
														placeholder="Effective Date"
														style="display: inline; width: 49%;" />
												</div>
												<div class="messageContainer col-sm-10"></div>
												<!--<div>
                                            	<a target="new_blank"  class="btn btn-success btn-sm" href="<?php echo base_url();?>admin/billing/addconfig/<?php echo $basic[0]['id']?>"><i class="fa fa-plus-square">&nbsp;Commission</i></a>
                                            </div>-->
											</div>
										</div>
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-with_service_tax">
												<label class="control-label col-sm-5">Inclusive Service Tax
												</label>
												<div class="col-sm-10">
													<select name="with_service_tax" id="with_service_tax"
														class="form-control">
														<option value="1"
															<?php if(isset($bconfig[0]['with_service_tax']) && $bconfig[0]['with_service_tax'] == 1) {?>
															selected <?php }?>>Yes</option>
														<option value="0"
															<?php if(isset($bconfig[0]['with_service_tax']) && $bconfig[0]['with_service_tax'] == 0) {?>
															selected <?php }?>>No</option>
													</select>
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-payment_mode">
												<label class="control-label col-sm-5">Invoice Payment Mode </label>
												<div class="col-sm-10">
													<select name="payment_mode" id="payment_mode"
														class="form-control" onchange="change()">
														<option value="1"
															<?php if(isset($bconfig[0]['payment_mode']) && $bconfig[0]['payment_mode'] == 1) {?>
															selected <?php }?>>Online</option>
														<option value="2"
															<?php if(isset($bconfig[0]['payment_mode']) && $bconfig[0]['payment_mode'] == 2) {?>
															selected <?php }?>>Cheque</option>
														<option value="0"
															<?php if(isset($bconfig[0]['payment_mode']) && $bconfig[0]['payment_mode'] == 0) {?>
															selected <?php }?>>Cash</option>
														<option value="3"
															<?php if(isset($bconfig[0]['payment_mode']) && $bconfig[0]['payment_mode'] == 3) {?>
															selected <?php }?>>Wallet</option>
													</select>
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-company_name">
												<label class="control-label col-sm-5">Billing Company Name </label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="company_name"
														name="company_name"
														value="<?php echo $bconfig[0]['company_name']; ?>" />
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
									</div>
									<div id="bank">
										<div class="row">
											<div class="col-lg-6 margin-bottom-5" id="chk1">
												<div class="form-group" id="error-cheque-favour-of">
													<label class="control-label col-sm-5">Cheque In Favour <span
														class='text-danger'>*</span></label>
													<div class="col-sm-10">
														<input type="text" class="form-control"
															id="cheque_favour_of" name="cheque_favour_of"
															value="<?php echo $bconfig[0]['cheque_favour_of']; ?>" />
													</div>
													<div class="messageContainer col-sm-10"></div>
												</div>
											</div>
											<div class="col-lg-6 margin-bottom-5">
												<div class="form-group" id="error-account_name">
													<label class="control-label col-sm-5">Account Name <span
														class='text-danger'>*</span></label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="account_name"
															name="account_name"
															value="<?php if(isset($bconfig[0]['account_name']))echo $bconfig[0]['account_name'];?>" />
													</div>
													<div class="messageContainer col-sm-10"></div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-6 margin-bottom-5">
												<div class="form-group" id="error-account_number">
													<label class="control-label col-sm-5">Account Number </label>
													<div class="col-sm-10">
														<input type="text" class="form-control"
															id="account_number" name="account_number"
															value="<?php if(isset($bconfig[0]['account_number'])) echo $bconfig[0]['account_number'];?>" />
													</div>
													<div class="messageContainer col-sm-10"></div>
												</div>
											</div>
											<div class="col-lg-6 margin-bottom-5">
												<div class="form-group" id="error-bank_name">
													<label class="control-label col-sm-5">Bank Name </label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="bank_name"
															name="bank_name"
															value="<?php if(isset($bconfig[0]['bank_name'])) echo $bconfig[0]['bank_name'];?>" />
													</div>
													<div class="messageContainer col-sm-10"></div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-6 margin-bottom-5">
												<div class="form-group" id="error-branch_name">
													<label class="control-label col-sm-5">Branch Name </label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="branch_name"
															name="branch_name"
															value="<?php if(isset($bconfig[0]['branch_name'])) echo $bconfig[0]['branch_name'];?>" />
													</div>
													<div class="messageContainer col-sm-10"></div>
												</div>
											</div>
											<div class="col-lg-6 margin-bottom-5">
												<div class="form-group" id="error-ifsc_code">
													<label class="control-label col-sm-5">IFSC Code </label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="ifsc_code"
															name="ifsc_code"
															value="<?php if(isset($bconfig[0]['ifsc_code'])) echo $bconfig[0]['ifsc_code'];?>" />
													</div>
													<div class="messageContainer col-sm-10"></div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 margin-bottom-5" id="wall">
											<div class="form-group" id="error-min_amount">
												<label class="control-label col-sm-5">Wallet Name</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="wallet_name"
														name="wallet_name" />
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
										<div class="col-lg-6 margin-bottom-5" id="mob">
											<div class="form-group" id="error-min_amount">
												<label class="control-label col-sm-5">Mobile number for
													Wallet</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="mob_no"
														name="mob_no" />
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-min_amount">
												<label class="control-label col-sm-5">Minimum Billing Amount
												</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="min_amount"
														name="min_amount"
														value="<?php  if(isset($bconfig[0]['min_amount']))echo $bconfig[0]['min_amount'];?>" />
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
										<!--     <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-is_official">
                                            <label class="control-label col-sm-5">Is Official ? </label>
                                            <div class="col-sm-10">
	                                            <select name="is_official" id="is_official" class="form-control">
                                                        <option value="1" <?php if(isset($bconfig[0]['is_official']) && $bconfig[0]['is_official'] == 1) {?>selected<?php }?>>Official</option>
                                                        <option value="0" <?php if(isset($bconfig[0]['is_official']) && $bconfig[0]['is_official'] == 0) {?>selected<?php }?>>UnOfficial</option>
                                                </select>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>-->
									</div>
									<div class="row">
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-hard_copy">
												<label class="control-label col-sm-10">Invoice Hardcopy
													Required ?</label>
												<div class="col-sm-10">
													<select name="hard_copy" id="hard_copy"
														class="form-control">
														<option value="1"
															<?php if(isset($bconfig[0]['hard_copy']) && $bconfig[0]['hard_copy'] == 1) {?>
															selected <?php }?>>Yes</option>
														<option value="0"
															<?php if(isset($bconfig[0]['hard_copy']) && $bconfig[0]['hard_copy'] == 0) {?>
															selected <?php }?>>No</option>
													</select>
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-invoice_notify_mobile">
												<label class="control-label col-sm-5">Gateway Charge <span
													class='text-danger'>*</span></label>
												<div class="col-sm-10">
													<input type="text" id="gateway_charge"
														name="gateway_charge" class="form-control"
														value="<?php if($gateway){ echo $gateway[0]['value'];}?>"
														placeholder="Gateway Charge"
														style="width: 37%; display: inline;" /> <input type="text"
														id="gateway_effective_date" name="gateway_effective_date"
														value="<?php if($gateway){ echo date('d-m-Y',strtotime($gateway[0]['from_date']));}?>"
														placeholder="Effective Date" class="form-control"
														style="width: 60%; display: inline;" />
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-branch_name">
												<label class="control-label col-sm-5">Commission for Service
													%</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="comm_ser"
														name="comm_ser"
														value="<?php if(isset($bconfig[0]['commission_service'])) echo $bconfig[0]['commission_service'];?>" />
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-ifsc_code">
												<label class="control-label col-sm-4">Commission for Spare
													part %</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="comm_spare"
														name="comm_spare"
														value="<?php if(isset($bconfig[0]['commission_spare'])) echo $bconfig[0]['commission_spare'];?>" />
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
									</div>
								</div>
								<!--<div class="row">
	                                <div class="col-lg-12 margin-bottom-5">
	                                	<div class="form-group" id="error-logo">
                                            <label class="control-label col-sm-3">Comments<span class='text-danger'>*</span></label>
                                            <div class="col-sm-5">
	                                            <textarea class="form-control" rows="3" id="comment" name="comment"></textarea>        
											</div>
											<div class="messageContainer col-sm-4"></div>
                                        </div>
	                              	</div>
	                        </div>-->
								<div class="text-center">
								<?php if($_SESSION['adminsession']['user_role']==1){?>
								<button type="submit" class="btn btn-success">Update</button>
								<?php } else {?>
								<button type="submit" class="btn btn-success" disabled>Update</button>
								<?php } ?>
							</div>
							</div>

						</div>
					</div>
				</form>
    </div>
	</div>  
	</div> 
		
    <!-- Fifth panel for Delivery	Settings -->
    <div class="panel panel-default"><a data-toggle="collapse" data-parent="#accordion" onclick="initMap();" href="#collapseFive">
    <div class="panel-heading">
            <b>Delivery	Settings</b>
    </div></a>
    <div id="collapseFive" class="panel-collapse collapse">
	<div class="panel-body">
		<form id="vendorDel" name="vendorDel" action="" method="post">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-locality">
										<div class="col-sm-12">
											<input type="text" class="form-control pac-input"
												id="locality" name="locality"
												value="<?php echo $basic[0]['locality'];?>"
												style="width: 80%;" />
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="panel-body">
							<div id="map-canvas" style="height: 550px;"></div>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-radius">
										<label class="control-label col-sm-3">Delivery Radius <span
											class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="radius"
												name="radius" value="<?php echo $basic[0]['radius'];?>" />
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<input type="hidden" name="have_gf" id="have_gf" value="<?php echo $basic[0]['have_gf'];?>" /> 
					<input type="hidden" name="latitude" id="latitude" value="<?php echo $basic[0]['latitude'];?>" />
					<input type="hidden" name="longitude" id="longitude" value="<?php echo $basic[0]['longitude'];?>" /> 
					<input type="hidden" name="geofencestr" id="geofencestr" value="" /> 
					<input type="hidden" name="vendor_id" value="<?php echo $basic[0]['id'];?>" />
	                  	
	                  	<?php if($_SESSION['adminsession']['user_role']==1){?>
						<button type="submit" id="delivery_update" class="btn btn-success">Update</button>
						<?php } else {?>
	                  	<button type="submit" id="delivery_update"
						class="btn btn-success" disabled>Update</button>
	                  	<?php } ?>
	        </form>
    </div>
	</div>  
	</div>   
<div id="geodiv"></div>
			<br> <br>
			<div id="response"></div>

</div>
</div>
</div>

<input type="hidden" id="map_load_count" value="0" />
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url();?>js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo asset_url();?>js/selectize.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script>
<?php if($cycle) {?>
var cycleDate = '<?php echo date('d-m-Y',strtotime($cycle[0]['from_date']));?>'
<?php } else {?>
var cycleDate = new Date();
cycleDate.setDate(cycleDate.getDate()-90);
<?php }?>
<?php if($gateway) {?>
var gatewayDate = '<?php echo date('d-m-Y',strtotime($gateway[0]['from_date']));?>'
<?php } else {?>
var gatewayDate = new Date();
gatewayDate.setDate(gatewayDate.getDate()-90);
<?php }?>


	
$.fn.datepicker.defaults.format = "dd-mm-yyyy";
$('#cycle_effective_date').datepicker({startDate: cycleDate}).on('changeDate', function(ev){
	$('#restbilling').bootstrapValidator('revalidateField', 'cycle_effective_date');
});
$('#gateway_effective_date').datepicker({startDate: gatewayDate}).on('changeDate', function(ev){
	$('#restbilling').bootstrapValidator('revalidateField', 'gateway_effective_date');
});


$('#rest_details').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
    	email: {
			validators: {
				notEmpty: {
					message: 'Email is required and cannot be empty'
				},
				regexp: {
					regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
					message: 'The value is not a valid email address'
				}	
			}
		},
		mobile: {
			validators: {
				notEmpty: {
					message: 'Mobile is required and cannot be empty'
				},
				regexp: {
					regexp: '^[7-9][0-9]{9}$',
					message: 'Invalid Mobile Number'
				}
			}
		},
        name: {
            validators: {
                notEmpty: {
                    message: 'Vendor Name is required and cannot be empty'
                }
            }
        },
        garage_name: {
            validators: {
                notEmpty: {
                    message: 'Garage Name is required and cannot be empty'
                }
            }
        },
        address: {
            validators: {
                notEmpty: {
                    message: 'Address is required and cannot be empty'
                }
            }
        },
     
        pincode: {
            validators: {
                integer: {
                    message: 'Invalid pincode.'
           		},
           		stringLength: {
                    max: 6,
                    min: 6,
                    message: 'Invalid pincode.'
                },
            }
        },
        review: {
            validators: {
                notEmpty: {
                    message: 'Review is required and cannot be empty'
                }
            }
        },
       category_id: {
            validators: {
                notEmpty: {
                    message: 'Category is required and cannot be empty'
                }
            }
        },
     /*   brand_id[]: {
            validators: {
                notEmpty: {
                    message: 'Brand is required and cannot be empty'
                }
            }
        },
        model_id[]: {
            validators: {
                notEmpty: {
                    message: 'Model is required and cannot be empty'
                }
            }
        }*/
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	updateRestaurantDetails();
});


$('#restbilling').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
        billing_cycle: {
            validators: {
                notEmpty: {
                    message: 'Billing cycle is required and cannot be empty'
                }
            }
        },
        cycle_effective_date: {
            validators: {
                notEmpty: {
                    message: 'Effective cycle date is required'
                },
                date: {
                    format: 'DD-MM-YYYY',
                    message: 'Effective cycle date is not a valid'
                }
            }
        },
      /*  subcategory_id[]: {
            validators: {
                notEmpty: {
                    message: 'Subcategory is required and cannot be empty'
                }
            }
        },
        service_id[]: {
            validators: {
                notEmpty: {
                    message: 'Service is required and cannot be empty'
                }
            }
        },
        zone_id: {
            validators: {
                notEmpty: {
                    message: 'Zone is required and cannot be empty'
                }
            }
        },
       area_id: {
            validators: {
                notEmpty: {
                    message: 'Area is required and cannot be empty'
                }
            }
        },*/
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	updateRestaurantBilling();
});

function updateRestaurantDetails() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showEditRequest,
	 		success :  showEditResponse,
	 		url : base_url+'admin/vendor/updatebasic',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#rest_details').ajaxSubmit(options);
}

function updateRestaurantBilling() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showEditRequest,
	 		success :  showEditResponse,
	 		url : base_url+'admin/vendor/updatebilling',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#restbilling').ajaxSubmit(options);
}

$('#vendor_area').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
        locality: {
            validators: {
                notEmpty: {
                    message: 'Locality is required and cannot be empty'
                }
            }
        },
        radius: {
            validators: {
                notEmpty: {
                    message: 'Radius is required and cannot be empty'
                }
            }
        },
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	updateVendorArea();
});

function updateVendorArea() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showEditRequest,
	 		success :  showEditResponse,
	 		url : base_url+'admin/vendor/updatevendorarea',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#vendor_area').ajaxSubmit(options);
}

function showEditRequest(formData, jqForm, options){
	$("#response").hide();
   	var queryString = $.param(formData);
	return true;
}
   	
function showEditResponse(resp, statusText, xhr, $form){
	if(resp.status == '0') {
		$("#response").removeClass('alert-success');
       	$("#response").addClass('alert-danger');
		$("#response").html(resp.msg);
		$("#response").show();
  	} else {
  		$("#response").removeClass('alert-danger');
        $("#response").addClass('alert-success');
        $("#response").html(resp.msg);
        $("#response").show();
        alert(resp.msg);
  	}
}

function addMoreSlabs() {
	var slabcount = parseInt($("#slabcount").val());
	slabcount++;
	var slab_html = '<tr id="slabrow'+slabcount+'">'+
					'<td><input type="text" name="lower_limit[]" class="form-control" placeholder="From Amount"/></td>'+
					'<td><input type="text" name="upper_limit[]" class="form-control" placeholder="To Amount"/></td>'+
					'<td><input type="text" name="from_rad[]" class="form-control" placeholder="From Radius"/></td>'+
					'<td><input type="text" name="to_rad[]" id="to_rad-'+slabcount+'" class="form-control" placeholder="To Radius"/></td>'+
					'<td><input type="text" name="charge[]" class="form-control" placeholder="Delivery Charge"/></td>'+
					'<td><a href="javascript:deleteSlab('+slabcount+');" class="btn btn-danger btn-sm">X</a></td>'+
					'</tr>';
	$("#del_slabs").append(slab_html);
	$("#slabcount").val(slabcount);
}

function deleteSlab(id){
	var slabcount = parseInt($("#slabcount").val());
	slabcount = slabcount - 1;
	$("#slabrow"+id).remove();
	$("#slabcount").val(slabcount);
}

function addMoreDelTime() {
	var timecount = parseInt($("#timecount").val());
	timecount++;
	var slab_html = '<tr id="timeslabrad'+timecount+'">'+
					'<td colspan=3><input type="text" name="from_time_rad[]" class="form-control" placeholder="From Radius"/></td>'+
					'<td colspan=3><input type="text" name="to_time_rad[]" id="to_time_rad_'+timecount+'" class="form-control" placeholder="To Radius"/></td>'+
					'<td class="text-center"><a href="javascript:deleteDelTime('+timecount+');" class="btn btn-danger btn-sm">X</a></td>'+
				'</tr>'+
				'<tr id="timeslabtime'+timecount+'">'+
					'<td><input type="text" name="mon[]" class="form-control" placeholder="Monday"/></td>'+
					'<td><input type="text" name="tue[]" class="form-control" placeholder="Tuesday"/></td>'+
					'<td><input type="text" name="wed[]" class="form-control" placeholder="Wednesday"/></td>'+
					'<td><input type="text" name="thu[]" class="form-control" placeholder="Thursday"/></td>'+
					'<td><input type="text" name="fri[]" class="form-control" placeholder="Friday"/></td>'+
					'<td><input type="text" name="sat[]" class="form-control" placeholder="Saturday"/></td>'+
					'<td><input type="text" name="sun[]" class="form-control" placeholder="Sunday"/></td>'+
				'</tr>';
	$("#del_time").append(slab_html);
	$("#timecount").val(timecount);
}

function deleteDelTime(id){
	var timecount = parseInt($("#timecount").val());
	timecount = timecount - 1;
	$("#timeslabrad"+id).remove();
	$("#timeslabtime"+id).remove();
	$("#timecount").val(timecount);
}

function addMoreMov() {
	var movcount = parseInt($("#movcount").val());
	movcount++;
	var slab_html = '<tr id="movrow'+movcount+'">'+
					'<td><input type="text" name="from_mov_rad[]" class="form-control" placeholder="From Radius"/></td>'+
					'<td><input type="text" name="to_mov_rad[]" class="form-control" placeholder="To Radius"/></td>'+
					'<td><input type="text" name="amount[]" class="form-control" placeholder="MOV"/></td>'+
					'<td><a href="javascript:deleteMov('+movcount+');" class="btn btn-danger btn-sm">X</a></td>'+
					'</tr>';
	$("#del_mov").append(slab_html);
	$("#movcount").val(movcount);
}

function deleteMov(id){
	var movcount = parseInt($("#movcount").val());
	movcount = movcount - 1;
	$("#movrow"+id).remove();
	$("#movcount").val(movcount);
}

function verifyRestaurant(id) {
	$.get(base_url+"admin/vendor/verify/"+id,{},function(data) {
		$("#response").hide();
		if(data.status == '0') {
			$("#response").removeClass('alert-success');
	       	$("#response").addClass('alert-danger');
			$("#response").html(data.msg);
			$("#response").show();
			alert(data.msg);
	  	} else {
	  		$("#response").removeClass('alert-danger');
	        $("#response").addClass('alert-success');
	        $("#response").html(data.msg);
	        $("#response").show();
	        alert(data.msg);
	        window.location.reload();
	  	}
	},'json');
}

function liveRestaurant(id) {
	$.get(base_url+"admin/vendor/madelive/"+id,{},function(data) {
		$("#response").hide();
		if(data.status == '0') {
			$("#response").removeClass('alert-success');
	       	$("#response").addClass('alert-danger');
			$("#response").html(data.msg);
			$("#response").show();
			alert(data.msg);
	  	} else {
	  		$("#response").removeClass('alert-danger');
	        $("#response").addClass('alert-success');
	        $("#response").html(data.msg);
	        $("#response").show();
	        alert(data.msg);
	        window.location.reload();
	  	}
	},'json');
}


    $("#cboCustomTime").change(function(){
        
      showCustomTime();
        
    });
    
    function showCustomTime(){
         if($("#cboCustomTime").val() == 1){
           $("#divCustomT").show();
           $("#divRegularT").hide();
        }else{
           $("#divCustomT").hide();
           $("#divRegularT").show();   
        }
    }

    $('#vendorDel').bootstrapValidator({
    	container: function($field, validator) {
    		return $field.parent().next('.messageContainer');
       	},
        feedbackIcons: {
            validating: 'glyphicon glyphicon-refresh'
        },
       // excluded: ':disabled',
        fields: {
        	locality: {
                validators: {
                    notEmpty: {
                        message: 'Locality is required and cannot be empty'
                    }
                }
            },
            latitude: {
                validators: {
                    notEmpty: {
                        message: 'Please select locality from drop down only.'
                    }
                }
            },
            longitude: {
                validators: {
                    notEmpty: {
                        message: 'Please select locality from drop down only.'
                    }
                }
            },
            radius: {
                validators: {
                    notEmpty: {
                        message: 'Delivery radius is required and cannot be empty'
                    },
                    integer: {
                        message: 'Invalid Radius.'
               		},
               		stringLength: {
                        max: 6,
                        min: 3,
                        message: 'Invalid Radius.'
                    },
                }
            },
            comment: {
            	validators: {
                    notEmpty: {
                        message: 'Comment is required and cannot be empty'
                    }
                }
            },
        }
    }).on('success.form.bv', function(event,data) {
    	// Prevent form submission
    	event.preventDefault();
    	updateVendorDelivery();
    });

    function updateVendorDelivery() {
    	var latlngstr = storeFence();
    	$("#geofencestr").val(latlngstr);
    	if(latlngstr != "")
    	$("#have_gf").val(1);
    	var options = {
    	 		target : '#response', 
    	 		beforeSubmit : showEditRequest,
    	 		success :  showEditResponse,
    	 		url : base_url+'admin/vendor/updatedelivery',
    	 		semantic : true,
    	 		dataType : 'json'
    	 	};
       	$('#vendorDel').ajaxSubmit(options);
    }

    function showEditRequest(formData, jqForm, options){
    	$("#response").hide();
       	var queryString = $.param(formData);
    	return true;
    }
       	
    function showEditResponse(resp, statusText, xhr, $form){
    	if(resp.status == '0') {
    		$("#response").removeClass('alert-success');
           	$("#response").addClass('alert-danger');
    		$("#response").html(resp.msg.name);
    		$("#response").show();
      	} else {
      		$("#response").removeClass('alert-danger');
            $("#response").addClass('alert-success');
            $("#response").html(resp.msg);
            $("#response").show();
           window.location.href = base_url+"admin/vendor/list";
          
      	}
    }
  
</script>
<script>
$(document).ready(function(){
    $('#tblRestos').DataTable();
});

function change() 
{
    var selectBox = document.getElementById("payment_mode");
    var selected = selectBox.options[selectBox.selectedIndex].value;
    var cheque = document.getElementById("bank");
    var cheque1 = document.getElementById("chk1");
    var mob_no1 = document.getElementById("mob");
    var wall1 = document.getElementById("wall");
   // alert(selected);
    if(selected === '2')
        {
      cheque.style.display = "block";
      cheque1.style.display = "block";
      mob_no1.style.display = "none";
      wall1.style.display = "none";
        }
    if(selected === '0')
    {
   cheque.style.display = "none";
   mob_no1.style.display = "none";
   wall1.style.display = "none";
    }
    if(selected === '3')
    {
   cheque.style.display = "none";
   mob_no1.style.display = "block";
   wall1.style.display = "block";
   //document.getElementById("mob_no").disabled=false;
    }
    if(selected === '1')
    {
    cheque.style.display = "block";
    cheque1.style.display = "none";
    mob_no1.style.display = "none";
    wall1.style.display = "none";
    }
       
}

$(document).ready(function(){
	  //Chosen
	 $("#brand_id").select2({
		 maxItems: 3
	  	})

	  	 $("#model_id").select2({
			 maxItems: 3
		  	})
		  	
	  
	});




</script>

<script>
$(document).ready(function(){    
    /*	$("#model_id").change(function() 
    			{
    		var model_id =  $('#model_id').val();       
    			console.log(model_id);	    
    			  $.post(base_url+"admin/vendor/new", {model_id : model_id}, function(data)
    					  {
				
    	               });   
                   });*/

    	$("#category_id").change(function() 
    			{
    		var cat_id =  $('#category_id').val();       
    			console.log(cat_id);	    
    			  $.post(base_url+"admin/brandbycatid/", {cat_id : cat_id}, function(data)
    					  {
    				  $('#brand_id').empty();$('#brand_id').append("<option value=''>"+'Select Brand'+"</option>");		    
    			   if(data.length > 0)
    				   {		    
    				     for( var i=0; i < data.length; i++)
    					     {		   			    
    					           $('#brand_id').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");			
    					            }	    
    			              }	   
    	               },'json');   
                   });

    	$("#brand_id").change(function() 
    			{
    		var brand_id =  $('#brand_id').val();       
    			console.log(brand_id);	
    			 $.post(base_url+"admin/modelbybrandid1/", {brand_id : brand_id}, function(data)
    					  {
    				  $('#model_id').empty();$('#model_id').append("<option value=''>"+'Select Model'+"</option>");		    
    			   if(data.length > 0)
    				   {		    
    				     for( var i=0; i < data.length; i++)
    					     {		
    					           $('#model_id').append("<optgroup label="+data[i].brand_name+">");      			    
    					           $('#model_id').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");
    					          // $('#model_id').append("</optgroup>");
    					   		
    					     }    
    			       }	   
    	               },'json');   
                   });
        });

</script>
<script>
            $(function(){
                $("#treecheck").almightree({search: "#box"});
            });
        </script>

<script>
function initMap() {
	$.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places,drawing&key=AIzaSyCH-u-UD2bz6cfPEAe8mCVyrnnI7ONx9ro&callback=displayMap");
}
function DeleteControl(controlDiv, map) {
	controlDiv.style.padding = '5px';
	var controlUI = document.createElement('div');
	controlUI.style.backgroundColor = 'white';
	controlUI.style.borderStyle = 'solid';
	controlUI.style.borderWidth = '2px';
	controlUI.style.cursor = 'pointer';
	controlUI.style.textAlign = 'center';
	controlUI.title = 'Click to clear polygon';
	controlDiv.appendChild(controlUI);

	var controlText = document.createElement('div');
	controlText.style.fontFamily = 'Arial,sans-serif';
	controlText.style.fontSize = '12px';
	controlText.style.paddingLeft = '4px';
	controlText.style.paddingRight = '4px';
	controlText.innerHTML = '<b>DELETE</b>';
	controlUI.appendChild(controlText);

	google.maps.event.addDomListener(controlUI, 'click', function() {
		deleteSelectedShape();
		clearSelection();
	});
}

var drawingManager;
	var selectedShape;
	var colors = ['#1E90FF', '#FF1493', '#32CD32', '#FF8C00', '#4B0082'];
	var selectedColor;
	var colorButtons = {};
	<?php if(!empty($basic[0]['radius'])) { ?>
	var radius = <?php echo $basic[0]['radius'];?>;
	<?php } else { ?>
	var radius = 0;
	<?php } ?>
	<?php if(!empty($basic[0]['latitude'])) { ?>
	var latitude = <?php echo $basic[0]['latitude'];?>;
	<?php } else { ?>
	var latitude = 0;
	<?php } ?>
	<?php if(!empty($basic[0]['longitude'])) { ?>
	var longitude = <?php echo $basic[0]['longitude'];?>;
	<?php } else { ?>
	var longitude = 0;
	<?php } ?>
	var fence_points = [];
	function clearSelection() {
		if (selectedShape) {
	  	selectedShape.setEditable(false);
	  	selectedShape = null;
	}
}

function setSelection(shape) {
	clearSelection();
	selectedShape = shape;
	shape.setEditable(true);
	selectColor(shape.get('fillColor') || shape.get('strokeColor'));
}

function deleteSelectedShape() {
	if (selectedShape) {
	  	selectedShape.setMap(null);
	  	drawingManager.setDrawingMode(google.maps.drawing.OverlayType.POLYGON);
	}
}

function selectColor(color) {
	selectedColor = color;
	
	var polylineOptions = drawingManager.get('polylineOptions');
	polylineOptions.strokeColor = color;
	drawingManager.set('polylineOptions', polylineOptions);
	
	var rectangleOptions = drawingManager.get('rectangleOptions');
	rectangleOptions.fillColor = color;
	drawingManager.set('rectangleOptions', rectangleOptions);
	
	var circleOptions = drawingManager.get('circleOptions');
	circleOptions.fillColor = color;
	drawingManager.set('circleOptions', circleOptions);
	
	var polygonOptions = drawingManager.get('polygonOptions');
	polygonOptions.fillColor = color;
	drawingManager.set('polygonOptions', polygonOptions);
}
var map;
var polyOptions = {
  		strokeWeight: 0,
  		fillOpacity: 0.45,
  		editable: true,
  		fillColor:'#1E90FF'
	};
function displayMap() {
	//alert('HHHiiii');
	var is_map_loaded = $("#map_load_count").val();
	if(is_map_loaded == 0) {
		map = new google.maps.Map(document.getElementById('map-canvas'), {
		      zoom: 13,
		      center: new google.maps.LatLng(<?php echo $basic[0]['latitude'];?>, <?php echo $basic[0]['longitude'];?>),
		      mapTypeId: google.maps.MapTypeId.ROADMAP,
		      zoomControl: true,
		      scrollwheel: false,
		      disableDefaultUI: true
		    });
		    var marker = new google.maps.Marker({
			    position: new google.maps.LatLng(<?php echo $basic[0]['latitude'];?>, <?php echo $basic[0]['longitude'];?>),
			    map: map,
			    draggable:true,
				animation: google.maps.Animation.DROP,
			    title: "<?php echo $basic[0]['name'];?>"
			});
		    var deleteControlDiv = document.createElement('div');
			var homeControl = new DeleteControl(deleteControlDiv, map);

			deleteControlDiv.index = 1;
			map.controls[google.maps.ControlPosition.TOP_RIGHT].push(deleteControlDiv);
				polyOptions = {
		      		strokeWeight: 0,
		      		fillOpacity: 0.45,
		      		editable: true,
		      		fillColor:'#1E90FF'
		    	};
		    	// markers, lines, and shapes.
		    	drawingManager = new google.maps.drawing.DrawingManager({
		      		drawingControl: false,
		      		drawingMode: google.maps.drawing.OverlayType.POLYGON,
		      		markerOptions: {
		        		draggable: true
		      		},
		      		polylineOptions: {
		        		editable: true
		      		},
		      		rectangleOptions: polyOptions,
		      		circleOptions: polyOptions,
		      		polygonOptions: polyOptions,
		      		map: map
		    	});

		    	<?php if (count($coords) > 0) { ?>
		        	var lats = [];
					var lat_size = <?php echo count($coords);?>;
					<?php foreach ($coords as $coord) { ?>
					<?php if(!empty($coord['latitude']) && !empty($coord['longitude'])) { ?>
						fence_points.push('<?php echo $coord['latitude'];?>#<?php echo $coord['longitude'];?>');
						lats.push(new google.maps.LatLng(<?php echo $coord['latitude'];?>, <?php echo $coord['longitude'];?>));
		    		<?php } ?>
					<?php } ?>
		    		polyOptions.paths = lats;
		        	polygon = new google.maps.Polygon(polyOptions);
		        	polygon.setMap(map);
		        	clearSelection();
		        	selectedShape = polygon;
		        	drawingManager.setDrawingMode(null);
		        <?php } else { ?>
		        	var lat = <?php echo $basic[0]['latitude'];?>;
		        	var lng = <?php echo $basic[0]['longitude'];?>;
		      	  	polyOptions.paths = getFences(lat,lng,radius);
		      		polygon = new google.maps.Polygon(polyOptions);
		      		polygon.setMap(map);
		      		clearSelection();
		      		selectedShape = polygon;
		      		drawingManager.setDrawingMode(null);
		    	<?php } ?>
			
		    	google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
		        	if (e.type != google.maps.drawing.OverlayType.MARKER) {
		        		var newShape = e.overlay;
		        		drawingManager.setDrawingMode(null);
		        		newShape.setEditable(true);
		        		newShape.type = e.type;
		        		google.maps.event.addListener(newShape, 'click', function() {
		          			setSelection(newShape);
		        		});
		        		setSelection(newShape);
		      		}
		    	});
			var options = {
				types: [],
				componentRestrictions: {country: 'in'}
			};

			var input = (document.getElementById('locality'));
			map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

			var autocomplete = new google.maps.places.Autocomplete(input,options);

			google.maps.event.addListener(autocomplete, 'place_changed', function() {
				var place = autocomplete.getPlace();
				map.panTo(place.geometry.location);
				marker.setPosition(place.geometry.location);
				document.getElementById("latitude").value = place.geometry.location.lat();
			    document.getElementById("longitude").value = place.geometry.location.lng(); 
				if (!place.geometry) {
					return;
				}
				if(document.getElementById("have_gf").value == 0){
					polyOptions.paths = changeFences(latitude,longitude,place.geometry.location.lat(),place.geometry.location.lng());
		      		polygon.setOptions(polyOptions);
		      		clearSelection();
		      		selectedShape = polygon;
		      		drawingManager.setDrawingMode(null);
		      		polygon.setEditable(true);
				}
			});
		  
			google.maps.event.addListener(marker, 'dragend', function(){
			
			    document.getElementById("latitude").value = marker.getPosition().lat();
			    document.getElementById("longitude").value = marker.getPosition().lng();
			    if(document.getElementById("have_gf").value == 0){
				    polyOptions.paths = changeFences(latitude,longitude,marker.getPosition().lat(),marker.getPosition().lng());
		      		polygon.setOptions(polyOptions);
		      		clearSelection();
		      		selectedShape = polygon;
		      		drawingManager.setDrawingMode(null);
		      		polygon.setEditable(true);
			    }
			});
		$("#map_load_count").val(1);
	}
}


function getFences(lat,lng,radius){
	var d2r = Math.PI / 180;
	var r2d = 180 / Math.PI;
	var earthsradius = 6371000;
	var points = 8;
	var radius = radius;

	var rlat = (radius / earthsradius) * r2d;
	var rlng = rlat / Math.cos(lat * d2r);
	var extp = new Array();
	var ex1;
	for (var i=0; i < points+1; i++)
	{
	  	var theta = Math.PI * (i / (points/2));
	  	ex = parseFloat(lng) + parseFloat((rlng * Math.cos(theta)));
	  	ey = parseFloat(lat) + parseFloat((rlat * Math.sin(theta)));
	  	ey = Math.round(ey*1000000000)/1000000000;
	  	ex = Math.round(ex*1000000000)/1000000000;
	  	extp.push(new google.maps.LatLng(ey,ex));
	  	fence_points.push(ey+'#'+ex);
	}
	return extp;
}

$("#radius").focusout(function() {
	var fence_radius = parseInt($("#radius").val());
	var new_lat = parseFloat(document.getElementById("latitude").value);
	var new_lng = parseFloat(document.getElementById("longitude").value);
	var polyOptions = {
	  		strokeWeight: 0,
	  		fillOpacity: 0.45,
	  		editable: true,
	  		fillColor:'#1E90FF'
		};
	polyOptions.paths = getFences(new_lat,new_lng,fence_radius);
	deleteSelectedShape();
	polygon = new google.maps.Polygon(polyOptions);
	polygon.setMap(map);
	clearSelection();
	selectedShape = polygon;
	drawingManager.setDrawingMode(null);
	
});

function changeFences(l1,l2,l3,l4){
	latitude = l3;
	longitude = l4;
	var x_diff = parseFloat(l3) - parseFloat(l1);
	var y_diff = parseFloat(l4) - parseFloat(l2);
	var fpoints = new Array();
	var points = fence_points.length;
	var extp = new Array();
	for (var i=0; i < points; i++)
	{
		var geopoints = fence_points[i].split('#');
		ex = x_diff + parseFloat(geopoints[0]);
		ey = y_diff + parseFloat(geopoints[1]);
		fpoints.push(ex+'#'+ey);
		extp.push(new google.maps.LatLng(ex, ey));
	}
	fence_points = fpoints;
	return extp;
}

function storeFence(){
	var maxdist = 0;
	if(selectedShape){
		var vertices = selectedShape.getPath();
	  	var contentString = '';
	  	for (var i =0; i < vertices.getLength(); i++) {
	    	var xy = vertices.getAt(i);
	    	if(contentString != '')
	    		contentString += '#'+xy.lat() + ',' + xy.lng();
	    	else
	    		contentString = xy.lat() + ',' + xy.lng();
			var vendor_dist = getGoePointDistance(document.getElementById("latitude").value,document.getElementById("longitude").value,xy.lat(),xy.lng());
			if(parseInt(vendor_dist) > parseInt(maxdist)){
				maxdist = vendor_dist;
			}
	  	}
	  	/* var itemcount = $("#slabcount").val();
	  	var timeitemcount = $("#timecount").val();
	  	document.getElementById("to_rad-"+itemcount).value = Math.ceil(maxdist);
	  	document.getElementById("to_time_rad_"+timeitemcount).value = Math.ceil(maxdist); */
	  	$("#radius").val(Math.ceil(maxdist)); 
	  return contentString;
	}else{
		return '';
	}
}

//radius calculation by pradeep singh

function getGoePointDistance(lat1,lon1,lat2,lon2) {
	var R = 6371000;
	var dLat = deg2rad(lat2-lat1);
	var dLon = deg2rad(lon2-lon1); 
	var a = 
	    Math.sin(dLat/2) * Math.sin(dLat/2) +
	    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
	    Math.sin(dLon/2) * Math.sin(dLon/2); 
	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
	var d = R * c;
	return d;
}

function deg2rad(deg) {
	return deg * (Math.PI/180)
}

</script>
<script>
	$('#select_all').click(function() {
	    $('#model_id option').prop('selected', true);
	});
</script>
<script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script>
<link href="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css" rel="stylesheet">
