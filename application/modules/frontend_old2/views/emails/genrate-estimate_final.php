<html>
<head>
<style>
	.items td{
		border-bottom:1px solid #212121;
		border-right:1px solid #212121;
		padding:5px;
	}
</style>
</head>
<body>
	<div class="ii gt m14b7cc3fd14b6cd9adPadO">
		<div>
			<table width="60%" cellpadding=0 border=0>
				<tbody>
					<tr>
						<td>
							<table cellspacing="0 cellpadding=0 border=0 bgcolor=#68c1ec align=center style=background: #68c1ec">
								<tbody>
									<tr>
										<td valign="top" >
											<a href="<?php echo base_url();?>"> 
											<img src="<?php echo asset_url().LOGO ; ?>" height='85px' width='152px' style="margin-left:485px;margin-top:18px;">
											</a> 
											<br />
										</td>
									</tr>
								</tbody>
							</table>
							<table width="581 cellspacing=0 cellpadding=0 border=0 align=center style=border-bottom: 1px solid #e1e1e1;margin-bottom:30px;">
								<tbody>
									<tr>
										<td valign="top style=padding: 0px 13px 10px 14px;font-family:Arial">
											<table width="100% cellspacing=0 cellpadding=0">
												<tbody>
												<?php $name = explode(" ",$data['name']);
															  $fname = $name[0];
															//  $lname = $name[1];   ?>
													<tr>
														<td style="color:#000;font-family:Arial;font-size:16px;padding-bottom:18px;">
															Hi <?php echo $fname; ?>,<br><br>Thanks for confirming the estimate.Details are below - 
														</td>
													</tr>
													<!-- <tr>
														<td style="color:#000;font-family:Arial;font-size:16px;padding-bottom:14px;">
															Your laundry has reached our facility and will be processed soon. Here’re the details for the record.
														</td>
													</tr>-->
													
													<tr>
														<td style="color:#000;font-size:16px;font-family:Arial;padding-bottom:14px;">
															<b>Order Details:</b>
														</td>
													</tr>
													
													<tr>
														<td>
															<table style="width:100%;" cellspacing="0">
																<tr>
																	<td style="color:#000;font-size:16px;font-family:Arial;padding-bottom:2px;">
																		Order Number : <span style="padding-left:3%;"><?php echo $data['ordercode'];?></span>
																	</td>
																</tr>
																
																<tr>
																	<td style="color:#000;font-size:16px;font-family:Arial;padding-bottom:2px;">
																		Name : <span style="padding-left:15%;"><?php echo $data['name'];?></span>
																	</td>
																</tr>
																<tr>
																	<td style="color:#000;font-size:16px;font-family:Arial;padding-bottom:2px;">
																		Date : <span style="padding-left:15%;"><?php echo date('d-m-Y',strtotime($data['pickup_date']));?></span>
																	</td>
																</tr><br/>


															<?php if((!empty($data['package_name']))  && (!empty($data['items']))){ ?>
																<tr class="items">
																	<td style="border-left:1px solid #212121;border-top:1px solid #212121;font-size:16px;font-family:Arial;"><b>Package Name</b></td>
																	<td style="border-top:1px solid #212121;font-size:16px;font-family:Arial;" align=center><b>Price</b></td> 
																</tr>

																<tr class="items">
																		<td style="border-left:1px solid #212121;"><?php echo $data['package_name']; ?></td> 
																		<td align=center>Rs <?php echo $data['package_amount']; ?></td>
																</tr> 
																<br> <br>
																<tr class="items">
																	<td style="border-left:1px solid #212121;border-top:1px solid #212121;font-size:16px;font-family:Arial;"><b>Services</b></td>
																	<td style="border-top:1px solid #212121;font-size:16px;font-family:Arial;" align=center><b>Price</b></td>
																	<td style="border-top:1px solid #212121;font-size:16px;font-family:Arial;" align=center><b>Tax(%)</b></td>
																	<td style="border-top:1px solid #212121;font-size:16px;font-family:Arial;" align=center><b>Total</b></td>
																</tr>
															    
															    <?php foreach($data['items'] as $item){ ?>
																	<tr class="items">
																		<td style="border-left:1px solid #212121;"><?php echo $item['service_name']; ?></td>
																		<td align=center><?php echo $item['service_price']; ?></td>
																		<td align=center><?php echo $item['tax']; ?></td>
																		<td align=center><?php echo $item['total_amount']; ?></td>
																	</tr>
																<?php } ?>
																	<tr class="items">
																		<td style="border-left:1px solid #212121;"></td>
																		<td></td>
																		<td align=center>Grand Total</td>
																		<td align=center><?php echo $data['order_amount']; ?></td>
																</tr>
  

																<?php }  else if(!empty($data['package_name'])){ ?>

																<tr class="items">
																	<td style="border-left:1px solid #212121;border-top:1px solid #212121;font-size:16px;font-family:Arial;"><b>Package Name</b></td>
																	<td style="border-top:1px solid #212121;font-size:16px;font-family:Arial;" align=center><b>Price</b></td> 
																</tr>

																<tr class="items">
																		<td style="border-left:1px solid #212121;"><?php echo $data['package_name']; ?></td> 
																		<td align=center>Rs <?php echo $data['package_amount']; ?></td>
																</tr>  



																<?php } else { ?>

																<?php if(!empty($data['items'])){ ?>
																<tr class="items">
																	<td style="border-left:1px solid #212121;border-top:1px solid #212121;font-size:16px;font-family:Arial;"><b>Services</b></td>
																	<td style="border-top:1px solid #212121;font-size:16px;font-family:Arial;" align=center><b>Price</b></td>
																	<td style="border-top:1px solid #212121;font-size:16px;font-family:Arial;" align=center><b>Tax(%)</b></td>
																	<td style="border-top:1px solid #212121;font-size:16px;font-family:Arial;" align=center><b>Total</b></td>
																</tr>
															    
															    <?php foreach($data['items'] as $item){ ?>
																	<tr class="items">
																		<td style="border-left:1px solid #212121;"><?php echo $item['service_name']; ?></td>
																		<td align=center><?php echo $item['service_price']; ?></td>
																		<td align=center><?php echo $item['tax']; ?></td>
																		<td align=center><?php echo $item['total_amount']; ?></td>
																	</tr>
																<?php } ?>
																	<tr class="items">
																		<td style="border-left:1px solid #212121;"></td>
																		<td></td>
																		<td align=center>Grand Total</td>
																		<td align=center><?php echo $data['order_amount']; ?></td>
																	</tr>
																<?php } } ?>

																<!-- <tr style="border-bottom: 1px solid black;padding-top:14px;font-size:16px;font-family:Arial;">
																	<td style="color:#000;font-size:16px;font-family:Arial;float:left;padding-bottom:14px;">
																		<a href="<?php echo $data['invoice_url'];?>" class="btn btn-success btn-block"><b>Get Invoice</b></a>
																	</td>
																</tr> -->
																
															</table>  
														</td>
													</tr>
													<tr>
														<td style="padding-top:10px;">
														</td>
													</tr>
													<tr>
														<td style="color:#000;font-size:16px;font-family:Arial;padding-bottom:14px;">
														Will inform you once we complete the service.<br><br>
														</td>
													</tr>
													<tr>
														<td style="color:#000;font-size:16px;font-family:Arial;padding-bottom:19px;">
															Thanks, <br><br>Team Bikedoctor!
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
							
						</td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>
