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
								<td>Bike Doctor<br>
								    <br>
								    Aundh, Pune 07
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
					<td> &nbsp;<?php echo date('d-m-Y',strtotime($order['pickup_date']));?></td>
					
					<td style="padding-left : 25px;">Order No:</td>
					<td style="padding-right: 25px;"> &nbsp;<?php echo $ordercode;?></td>
				</tr> 
				<tr>
					<td style="width:13%;">Contact No:</td>
					<td> &nbsp;<?php echo $order['mobile'];?></td>  
				</tr>
				<tr>
					<td>Address:</td>
					<td style="width:35%;"> &nbsp;<?php echo $order['address'];?>,<?php echo $order['locality'];?> 
					</td>
					<h4>You have used <?php echo $packageData['package_name']; ?> Package</h4>
					<h4>Remaining Package service count = <?php echo $usercnt; ?> </h4>
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
		<td>
			<table style="width:100%;"  cellspacing="0" class="print-friendly">
				<tr class="items"> 
					<td style="border-left:1px solid #212121;border-top:1px solid #212121;text-align:center;"><b>Package Name</b></td>
	 				<td style="border-top:1px solid #212121;text-align:center;"><b><?php echo $packageData['package_name']; ?></b></td> 
				</tr>
				<tr class="items">
					<td style="border-left:1px solid #212121;border-top:1px solid #212121;text-align:center;" colspan="2"><b>**Services in Package**</b></td> 
				</tr>
				<tr class="items">
					<td style="border-left:1px solid #212121;border-top:1px solid #212121;text-align:center;"><b>Sr No</b></td>
 					<td style="border-top:1px solid #212121;text-align:center;"><b>Service Name</b></td>
				</tr>
				<?php $i=0;
				foreach ($packageData['services'] as $item) { 
				$i++; ?>
				<tr class="items">
					<td style="border-left:1px solid #212121;border-top:1px solid #212121;text-align:center;"><b><?php echo $i ; ?></b></td>
 					<td style="border-top:1px solid #212121;text-align:center;"><b><?php echo  $item['name']; ?></b></td>
				</tr> 
				<?php } ?>
 				<!-- <tr class="items">
					<td style="border-left:1px solid #212121;border-top:1px solid #212121;text-align:center;"><b>Best package Price</b></td>
 					<td style="border-top:1px solid #212121;text-align:center;"><b>RS.<?php echo $packageData['best_price']; ?></b></td>
				</tr>
				<tr class="items">
					<td style="border-left:1px solid #212121;border-top:1px solid #212121;text-align:center;"><b>Special package amount</b></td>
 					<td style="border-top:1px solid #212121;text-align:center;"><b>RS.<?php echo $packageData['special_price']; ?></b></td>
				</tr> -->
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