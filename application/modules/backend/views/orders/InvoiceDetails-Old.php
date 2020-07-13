<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>Invoice</title>
<style>
	.items td{
		border-bottom:1px solid #212121;
		border-right:1px solid #212121;
		padding:5px;
	}
	
	.items1 td{
		border-bottom:1px solid #212121;
		padding:5px;
	}
	.summary td{
		border-bottom:1px solid #212121;
		padding:5px;
	}
	table { 
	    border-spacing: 0;
	    border-collapse: collapse;
	}
	.divFooter {
	position: fixed; 
	top: 20;
	text-align:center;
	page-break-inside:auto;
	height:100%;
	}
</style>
<style type="text/css">
   table { page-break-inside:auto }
   tr    { page-break-inside:avoid; page-break-after:auto }
   .print-friendly tr {
    page-break-inside: avoid;
  }
</style>

</head>
<body>
<div class="divFooter" style="height:100%">
<div style="text-align: left;"><img alt="logo" src="<?php echo FCPATH;?>assets/images/img/Logo.png"/></div>
<h1 style="text-align: center;"><b>Invoice</b></h1>
<table style="padding:25px;width:100%;" class="print-friendly">
	<tr>
		<td>
			<table style="width:100%;">
				<tr>
					<td style="width:60%;">
						<!--<img alt="Logo" src="<?php echo FCPATH;?>assets/images/img/logomain.png"/>-->
					</td>
					<td>
						<table>
							<tr>
								<!-- <td>Autoden Solutions Pvt Ltd<br> 
								    B-102, Archana Hill Town, 
								    Kausarbaug Road, Kondhwa, 
								    Pune-411048
								</td> -->
								<td>
									Autoden Solutions Pvt Ltd
									Pushkar Warehouse, 
									Behind dharmawat petrol pump, 
									Undri-Pisoli road, 
									Pune - 411060
								</td>	
							</tr>
							<!--<tr>
								<td>PickUp Date</td>
								<td>: <?php echo date('j M Y',strtotime($order['pickup_date']));?></td>
							</tr>-->
						</table>
					</td>
				</tr>
			</table>
		</td>
		
	</tr>
	<tr class="items1">
		<td>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;
		</td>
	</tr>
	
	<tr>
		<td>
			<table style="width:100%;" class="print-friendly">
			   <tr>
					<td style="width:13%;">Invoice Date:</td>
					<td> &nbsp;<?php echo date('d-m-Y',strtotime($order['invoice_date']));?></td>
					
					<td style="padding-left : 25px;">Order No:</td>
					<td style="padding-right: 25px;"> &nbsp;<?php echo $order['ordercode'];?></td>
				</tr>
				<tr>
					<td style="width:22%;">Invoice Raised To:</td>
					<td> &nbsp;<?php echo $order['name'];?></td>
					
					<td style="padding-left: 25px;">Invoice No:</td>
					<td style="padding-right: 25px;"> &nbsp;<?php echo $order['ordercode'].'/'.date('Y');?></td>
				</tr>
				<tr>
					<td style="width:13%;">Contact No:</td>
					<td> &nbsp;<?php echo $order['mobile'];?></td>
					
					<td style="padding-left: 25px;">GSTIN:</td>
					<td style="padding-right: 25px;"> 27AAOCA8955B1ZE </td>
				</tr>
				<tr>
					<td>Address:</td>
					<td style="width:35%;"> &nbsp;<?php echo $order['address'];?>,<?php echo $order['locality'];?><?php //echo $order['pincode'];?></td>
				</tr>
				<tr>
                	<td>Customer GSTIN: </td>
                	<td>&nbsp; <?php echo $order['gst_no'];?> </td> 
                </tr>
                <tr>
                	<td>GST Name: </td>
                	<td>&nbsp; <?php echo $order['gst_name'];?> </td>  
                </tr>
                                
                                <?php if(isset($package_details)) {?>
                
                <tr>
					<td>Package Details</td>
					<h4>Remaining Package service count = <?php echo $package_details['remaining']; ?> </h4>
					<h4>You have used <?php echo $package_details['package_name']; ?> Package </h4>
					
				</tr> 
                                <?php }?>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td>
			<table style="width:100%;"  cellspacing="0" class="print-friendly">
				<tr class="items">
					<td style="border-left:1px solid #212121;border-top:1px solid #212121;text-align:center;"><b>Description </b></td>
					<!-- <td style="border-top:1px solid #212121;text-align:center;"></td>-->
					<td style="border-top:1px solid #212121;text-align:center;"><b>Charges</b></td>
				</tr>
				<?php $i=1;
				foreach ($items as $item) { 
				$i++; ?>
				    <?php if($item['is_checked'] == 1){ ?>
					<tr class="items">
						<td style="border-left:1px solid #212121;"><?php echo $item['service_name'];?></td>
						<td>Rs. <?php echo $item['total_amount'];?></td>
					</tr>
					<?php } ?>
				<?php } ?>

				<?php if($order['old_price'] > 0){?>
				<tr class="items">
				<td style="border-left:1px solid #212121;">Package Amount</td>
				<td>Rs. <?php echo $order['old_price'];?></td>
				</tr>
				<?php }?>
				<tr class="items">
				<td style="border-left:1px solid #212121;border-top:1px solid #212121;height: 22px;"></td>
				<!-- <td style="border-top:1px solid #212121;"></td>-->
				<td style="border-top:1px solid #212121;"></td>
				</tr>
				<tr class="items">
				<td style="text-align:right;border-left:1px solid #212121;border-top:1px solid #212121;"><b>Order Amount</b></td>
				<!-- <td style="border-top:1px solid #212121;"></td>-->
				<td style="border-top:1px solid #212121;">Rs. <?php echo $order['order_amount'];?></td>
				</tr>
				<tr class="items">
				<td style="border-left:1px solid #212121;border-top:1px solid #212121;">Discount </td>
				<!-- <td style="border-top:1px solid #212121;"></td>-->
				<td style="border-top:1px solid #212121;">Rs. <?php echo $order['discount'];?></td>
				</tr>
				<tr class="items">
				<td style="text-align:right;border-left:1px solid #212121;border-top:1px solid #212121;"><b>Net Total</b></td>
				<!-- <td style="border-top:1px solid #212121;"></td>-->
				<td style="border-top:1px solid #212121;">Rs. <?php echo $order['net_total'];?></td>
				</tr>
				<tr class="items">
				<td style="border-left:1px solid #212121;border-top:1px solid #212121;height:22px;"></td>
				<!-- <td style="border-top:1px solid #212121;"></td>-->
				<td style="border-top:1px solid #212121;"></td>
				</tr>
			<!-- 	<tr class="items">
				<td style="border-left:1px solid #212121;border-top:1px solid #212121;">CGST 9%</td>
				<td style="border-top:1px solid #212121;"></td>
				<td style="border-top:1px solid #212121;">Rs. <?php echo $order['cgst'];?></td>
				</tr> -->
			<!-- 	<tr class="items">
				<td style="border-left:1px solid #212121;border-top:1px solid #212121;">SGST 9%</td>
				<td style="border-top:1px solid #212121;"></td>
				<td style="border-top:1px solid #212121;">Rs. <?php echo $order['sgst'];?></td>
				</tr> -->
			    <tr class="items">
				<td style="border-left:1px solid #212121;border-top:1px solid #212121;"><b>Adjustment</b></td>
				<!--<td style="border-top:1px solid #212121;"></td>-->
				<td style="border-top:1px solid #212121;">Rs. <?php echo $order['adjustment'];?></td>
				</tr> 
				<tr class="items">
				<td style="border-left:1px solid #212121;border-top:1px solid #212121;height: 22px;"></td>
				<!-- <td style="border-top:1px solid #212121;"></td>-->
				<td style="border-top:1px solid #212121;"></td>
				</tr>
				<tr class="items">
				<td style="text-align:right;border-left:1px solid #212121;border-top:1px solid #212121;"><b>Grand Total</b></td>
				<!--<td style="border-top:1px solid #212121;"></td>-->
				<td style="border-top:1px solid #212121;">Rs. <?php echo round($order['grand_total']);?></td>
				</tr>
			</table>
		</td>    
	</tr>
	<tr>  
		<td> 
			&nbsp;
		</td>
	</tr>

	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
</div>
</body>
</html>