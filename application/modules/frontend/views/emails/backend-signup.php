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
														<?php //$name = explode(" ",$data['name']);
															  //$fname = $name[0];
															 // $lname = $name[1];   ?>
															<td style="color:#000;padding-bottom:14px;font-size:16px;font-family:Arial;">
																Hi <?php echo $name;?>!
															</td>
														</tr>
														
														<tr>
															<td style="color:#000;padding-bottom:14px;font-size:16px;font-family:Arial;">
																Thanks for registering with us! use this username and password to login you account username : <?php echo $data['mobile'];?>, password: <?php echo $data['password']; ?>.
														   </td>
														</tr>
														<tr>
															<td style="color:#000;padding-bottom:14px;font-size:16px;font-family:Arial;">Simply book your appointment any time you wish and get updates on your order, offers and options to pay online.</td>
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
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>