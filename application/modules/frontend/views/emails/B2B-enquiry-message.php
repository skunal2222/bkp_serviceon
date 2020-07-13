<html> 
	<body>   
		<div class="ii gt m14b7cc3fd14b6cd9 adP adO">
			<div>
				<table width="60%"  cellpadding=0 border=0 style="background-color:#f7f7f9;">
					<tbody>
						<tr>
							<td>
								<table cellspacing="0 cellpadding=0 border=0 bgcolor=#68c1ec align=center style=background: #68c1ec">
									<tbody>
										<tr>
										
											<td valign="top">
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
														<tr>
														
															<td style="color:#000;padding-bottom:14px;font-size:16px;font-family:Arial;">
																Hi Team!
															</td>
														</tr>
														<tr>
															<td style="color:#000;padding-bottom:14px;font-size:16px;font-family:Arial;">
																	Got Enquiry request from.<br>
																<b> <?php  
																  if(isset($data['p_cname']))
									 echo   $str.= "Company Name : {$data['p_cname']} <br> Country : {$data['p_country']} <br>City : {$data['p_city']} <br>";		
																 
																
																 ?>
															      Name : <?= $data['p_name']; ?> <br>
																  Email : <?= $data['p_email']; ?> <br>
																  Mobile : <?= $data['p_mobile']; ?> <br>
																  City : <?= $data['p_city']; ?> <br>
																  Company Name : <?= $data['p_company_name']; ?> <br>
																  Total Vehicle : <?= $data['p_total_vehicle']; ?> <br>
															
																</b>
														   </td>
														</tr>
														
														<tr>
															<td style="color:#000;padding-bottom:14px;font-size:16px;font-family:Arial;">
																  Massage : <?= $data['p_msg']; ?>
														   </td>
														</tr>
													
														<tr>
															<td style="color:#000;padding-bottom:14px;font-size:16px;font-family:Arial;">Thanks! <br><?php echo COMPANY; ?> Team.</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>            
									</tbody>
								</table>
								<!--<table width="581 cellspacing=0 cellpadding=0 border=0 align=center style=border-collapse: collapse; height: 30px;">
									<tbody>
									</tbody>
								</table>-->
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>