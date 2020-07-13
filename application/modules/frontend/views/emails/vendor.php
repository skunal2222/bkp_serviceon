<html>
<body>
	<div class="ii gt m14b7cc3fd14b6cd9adPadO">
		<div>
			<table width="60%" cellpadding=0 border=0 style="background-color:#f7f7f9;">
				<tbody>
					<tr>
						<td>
							<table cellspacing="0 cellpadding=0 border=0 align=center style=background: #68c1ec">
								<tbody>
									<tr>
										<td valign="top" >
											<a href="<?php echo base_url();?>"> 
											<img src="<?php echo asset_url().LOGO ; ?>" height='85px' width='152px' style="margin-left:485px;margin-top:18px;">
											</a> 
											<br/>
										</td>
									</tr>
								</tbody>
							</table>
							<table style="width:100%;" width="581 cellspacing=0 cellpadding=0 border=0 align=center style=border-bottom: 1px solid #e1e1e1;margin-bottom:30px;">
								<tbody>
									<tr>
										<td valign="top style=padding: 0px 13px 10px 14px;font-family:Arial">
											<table width="100% cellspacing=0 cellpadding=0">
										<?php 	
											$name = explode(" ",$data['name']);
											$fname = $name[0];
											//$lname = $name[1];
										?>
												<tbody>
													<tr>
														<td style="color:#000;padding-bottom:14px;font-family:Arial;font-size:16px">
															Hello <?php echo $fname;?>,
														</td>
													</tr>
													<tr>
														<td style="color:#000;padding-bottom:14px;font-family:Arial;font-size:16px;">
														    Vendor Added Successfully.
															<!--  your appointment has been confirmed and we will be there to serve you at the given time and address. Thanks for choosing GarageDemo.--> 
														</td>
													</tr>
													
													<!--<tr>
													 <td>
													<table style="width:60%;>-->
													<tr>
														<td style="color:#000;padding-bottom:14px;font-family:Arial;font-size:16px;">
															<b><u>Vendor Details</u></b>
														</td>
													</tr> 

													<!-- 
													<tr>
														<td style="color:#000;padding-bottom:2px;font-family:Arial;font-size:16px;">
															<b>Date :</b> <span style="padding-left:5%;"><?php echo date('d-m-Y',strtotime($data['pickup_date']));?></span>
														</td>
													</tr> -->
													<tr>
														<td style="color:#000;padding-bottom:2px;font-family:Arial;font-size:16px;">
															<!--  <b>Address :</b><span style="padding-left:2%;"><?php echo $data['address']; ?><br></span><?php if(!empty($data['landmark'])) { ?><span style="padding-left:14%;"><?php echo $data['landmark'];?><br></span><?php } ?><span style="padding-left:14%;"><?php echo $data['locality'];?><br></span>-->
															
															Grage Name : <?php echo $data['garage_name'];?>   <br /> 

															Name : <?php echo $data['name'];?>   <br />					
															Address : <?php echo $data['address'];?> </td>

															Mobile : <?php echo $data['mobile'];?>   <br />					
															Password : <?php echo $data['password'];?> </td>
														</td>
													</tr>
													<!-- <tr>
														<td style="color:#000;padding-bottom:14px;font-family:Arial;font-size:16px;">
															<b>Order No :</b> <span style="padding-left:8%;"><?php echo $data['ordercode'];?></span>
														</td>
													</tr> -->
													<!--  <tr>
                                                        <td style="color:#000;padding-bottom:14px;font-family:Arial;font-size:16px;">
                                                           If for any reason you wish to reschedule the pickup, kindly call us on +91-9999999999
                                                        </td>
                                                    </tr>-->
													<tr>
														<td style="color:#000;padding-bottom:22px;font-family:Arial;font-size:16px;">
															Thanks! <br><?php echo COMPANY; ?> Team.
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
