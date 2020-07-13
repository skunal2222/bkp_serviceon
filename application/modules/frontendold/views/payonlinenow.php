<html>
<head>
<title>Invoice</title>
<style>
.items td{
	border-bottom:1px solid #212121;
	border-right:1px solid #212121;
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
.image-responsive {
	width:200px;
}
.img-row {
	width:70%;
}
.simpl-container {
	background-color: #fff;
    padding: 15px;
  /*  border: 1px solid #accede;*/
    color: #222;
    font-size: 12px;
}
.simpl-container span {
	color:#777;
	font-size:14px;
}
.simpl-msg {
	padding-bottom:5px;
}
.insta-msg {
	padding-bottom:20px;
}
.btn-primary {
	background-color:#00D2C1;
	border-color:#4BE0D4;
}
.btn-primary:hover {
	background-color:#4BE0D4;
	border-color:#00D2C1;
}

.paybtn {
    background-color: #5cb85c;
    font-family: "Roboto", Helvetica, Arial, sans-serif;
    font-weight: 800;
    color: #fff;
    padding: 15px 45px;
    border-radius: 50px;
    cursor: pointer;
}
@media (max-width:786px) {
	.image-responsive {
		width:140px;
	}
	.img-row {
		width:45%;
	}
	
}
@media (max-width:480px) {
	.midtable { 
		display: block;
	}
	.midtabletd{
		display: block;
		margin-bottom: 0px !important;
        width: 85% !important;
	}
	.img-row {
	    padding-right: 12px;
	}
}
	
</style>
</head>
<body>
<div style="padding:15px 10px;">
<br>
<h1 style="text-align: center;"><b>Invoice</b></h3>
<br><br>
<table width="80%" align="center" style="padding:25px;">
	<tr>
		<td>
			<table style="width:100%;">
				<tr>
					<td class="img-row">
						<!-- <img alt="Logo" src="<?php echo asset_url();?>images/logo.png" class="image-responsive"/>-->
						<!-- <img alt="Logo" src="<?php echo asset_url();?>images/img/logomain.png"/>-->
					</td>
					<td>
						<table>
							<tr>
								<td>GarageDemo<br>
								    Behind Woodland showroom,<br>
								    Aundh, Pune 27
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
	<tr style="border-bottom:1px solid #212121;">
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
			 <!--<table style="width:100%;" class="print-friendly">
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
					<td style="padding-right: 25px;"> &nbsp;</td>
				</tr>
				<tr>
					<td>Address:</td>
					<td style="width:35%;"> &nbsp;<?php echo $order['address'];?>,<?php echo $order['locality'];?><?php // echo $order['pincode'];?></td>
				</tr>
			</table>-->
			
			<table style="width:100%;" class="print-friendly midtable">
			   <tr>
					<td class="midtabletd" style="width:70%; ><span style="width:20%">Invoice Date:</span> &nbsp;&nbsp;<?php echo date('d-m-Y',strtotime($order['invoice_date']));?></td>
					<td class="midtabletd" style="width:30%; ><span style="width:20%">Order No:</span> &nbsp;&nbsp;<?php echo $order['ordercode'];?></td>
					
					<!--<td style="padding-left : 25px;">Order No:</td>
					<td style="padding-right: 25px;"> &nbsp;<?php echo $order['ordercode'];?></td>-->
				</tr>
				<tr>
					<td class="midtabletd" style="width:70%; ><span style="width:20%">Invoice Raised To:</span> &nbsp;&nbsp;<?php echo $order['name'];?></td>
					<td class="midtabletd" style="width:30%; ><span style="width:20%">Invoice No:</span> &nbsp;&nbsp;<?php echo $order['ordercode'].'/'.date('Y');?></td>
					
					<!--  <td style="width:22%;">Invoice Raised To:</td>
					<td> &nbsp;<?php echo $order['name'];?></td>
					
					<td style="padding-left: 25px;">Invoice No:</td>
					<td style="padding-right: 25px;"> &nbsp;<?php echo $order['ordercode'].'/'.date('Y');?></td>-->
				</tr>
				<tr>
					<td class="midtabletd" style="width:70%; ><span style="width:20%">Contact No:</span> &nbsp;&nbsp;<?php echo $order['mobile'];?></td>
					<td class="midtabletd" style="width:30%; ><span style="width:20%">GSTIN:</span> &nbsp;&nbsp;27AAPFG4288F1ZZ</td>
					<!-- <td style="width:13%;">Contact No:</td>
					<td> &nbsp;<?php echo $order['mobile'];?></td>
					
					<td style="padding-left: 25px;">GSTIN:</td>
					<td style="padding-right: 25px;"> &nbsp;</td>-->
				</tr>
				<tr>
					<td class="midtabletd" style="width:70%; ><span style="width:20%">Address:</span> &nbsp;&nbsp;<?php echo $order['address'];?>,<?php echo $order['locality'];?></td>
					<!--  <td>Address:</td>
					<td style="width:35%;"> &nbsp;<?php echo $order['address'];?>,<?php echo $order['locality'];?><?php // echo $order['pincode'];?></td>-->
				</tr>
			</table>
			
			<!--<table style="width:100%;" class="midtable">
			   <tr>
					<td class="midtabletd" style="width:13%;>Invoice Date:</span> &nbsp;&nbsp;<?php echo date('d-m-Y',strtotime($order['invoice_date']))?></td>
					<td class="midtabletd" style="width:30%;margin-bottom:10px;"><span style="width:20%">Order No:</span>&nbsp;&nbsp;<?php echo $order['ordercode'];?></td>
				</tr>
				<tr>
					<td class="midtabletd" style="width:70%;margin-bottom:10px;"><span style="width:20%">Invoice Raised To: </span>&nbsp;&nbsp;<?php echo $order['name'];?></td>
					<td class="midtabletd" style="width:30%;margin-bottom:10px;"><span style="width:20%">Invoice No:</span>&nbsp;&nbsp<?php echo $order['ordercode'].'/'.date('Y');?></td>
				</tr>
				<tr>
					<td class="midtabletd" style="width:70%;margin-bottom:10px;"><span style="width:20%">Contact No:</span>&nbsp;&nbsp;<?php echo $order['mobile'];?></td>
					<td class="midtabletd" style="width:30%;margin-bottom:10px;"><span style="width:20%">GSTIN:</span>&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td class="midtabletd" style="width:100%;margin-bottom:10px;"><span style="width:20%">Address:</span>&nbsp;&nbsp;<span style="width:50%;"><?php echo $order['address'];?>,<br><?php echo $order['locality'];?><?php //echo $order['pincode'];?></span></td>
				</tr>
			</table>-->
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
				$i++;
					?>
				<tr class="items">
					<td style="border-left:1px solid #212121;"><?php echo $item['service_name'];?></td>
					<td>Rs. <?php echo $item['total_amount'];?></td>
				</tr>
				<?php } ?>
				<tr class="items">
				<td style="border-left:1px solid #212121;border-top:1px solid #212121;height: 30px;"></td>
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
				<td style="border-left:1px solid #212121;border-top:1px solid #212121;height:30px;"></td>
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
				<td style="border-left:1px solid #212121;border-top:1px solid #212121;height: 30px;"></td>
				<!-- <td style="border-top:1px solid #212121;"></td>-->
				<td style="border-top:1px solid #212121;"></td>
				</tr>
				<tr class="items">
				<td style="text-align:right;border-left:1px solid #212121;border-top:1px solid #212121;"><b>Grand Total</b></td>
				<!--<td style="border-top:1px solid #212121;"></td>-->
				<td style="border-top:1px solid #212121;">Rs. <?php echo $order['grand_total'];?></td>
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
			<div class="row" style="margin:0px;">
              	<br>
               	<?php if($order['payment_status'] != "Credit" && $order['status'] != '5') { ?>
                     	<div class="col-sm-6 text-center" style="padding:10px;float: left;">
                        <div class="simpl-container">
                        	<div class="insta-msg">
                        		<span>Payment Status: Unpaid</span><br>
                        		
                        	</div>
                      	</div>
                   	</div>
                   	<?php //if($order['invoice_s']==3){?>
                	<div class="col-sm-6 text-center" style="padding:10px;float: right;">
                        <div class="simpl-container">
                        	<div class="insta-msg">
                        		<span></span><br>
                        		Want to pay by Credit Card, Debit Card or <br>Netbanking ?<br>
                        		Pay instantly using Instamojo :)
                        	</div>
                        	<a href="javascript:instaPay(<?php echo $order['orderid'];?>);" class="paybtn" style="width: 40%;"><b>Pay Now</b></a>
                      	</div>
                   	</div>
                   	<?php //} ?>
               	<?php } else { ?>
               	<!-- 	<div class="col-xs-12 alert alert-success text-center" style="padding:10px;">
                    	Paid
                   	</div> -->
                   	<div class="col-xs-12 text-center" style="padding:10px;float: left;">
                        <div class="simpl-container">
                        	<div class="insta-msg">
                        		<span>Payment Status: Paid</span><br>
                        		
                        	</div>
                      	</div>
                   	</div>
           		<?php } ?>
        	</div>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
	<td><div class="col-xs-12 text-center" style="padding:10px;">
                    	Download Invoice
                   	</div>
                   	<div class="col-xs-12 text-center" style="padding:10px;">
                    	<u><a href="<?php echo base_url();?><?php echo $order['invoice_url'];?>"><img alt="Logo" src="<?php echo asset_url();?>images/down.png" style="width: 25px;margin-top: -15px;"/></a></u>
                   	</div>
                   	</td>
	</tr>
	<!-- <tr>
		<td style="text-align:center;">
			Thank you for using The Washing Bay
		</td>
	</tr>-->
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<table width="581 cellspacing=0 cellpadding=0 border=0 align=center style=border-collapse: collapse; height: 30px;">
								<tbody>
								<!--  <tr>
									<td>
									 	<a href="<?php echo base_url();?>terms-condition" style="float:right">Terms & Conditions</a>
									 </td>
								 </tr>-->
								</tbody>
							</table>
</div>
</body>
</html>
<script id="getsimpl" data-env="production" data-merchant-id="ec5eb7964756e8b9bb42daa774b0fcef" src="https://cdn.getsimpl.com/simpl-custom-v1.min.js"></script>
<script type="text/javascript">
var base_url = '<?php echo base_url();?>';
window.Simpl && window.Simpl.setTransactionAmount(<?php echo $order['grand_total'];?> * 100);
window.Simpl && window.Simpl.setApprovalConfig({
  email: "<?php echo $order['email'];?>",
  phone_number: "<?php echo $order['mobile'];?>"
});

window.Simpl && window.Simpl.on('approval', function yep() {
	$("#pay_later").show();
	$("#simpl_container").show();
	$('#pay_later').html(window.Simpl && window.Simpl.getDisplayText()).show();
}, function nope() {
	$("#pay_later").hide();
	$("#simpl_container").hide();
});

function payLater(orderid,amount) {
	if (window.Simpl && window.Simpl.isApprovalStatus() === 'success') {
		var payable_amount = parseFloat(amount);
		window.Simpl && window.Simpl.setTransactionAmount(payable_amount * 100); 
		window.Simpl && window.Simpl.setAuthorizeConfig({
		    //order_id: orderid
		});
		window.Simpl && window.Simpl.authorizeTransaction();
	} else {
		alert("Sorry we do not connect you on Simpl");
	}
}

window.Simpl && window.Simpl.on('success', function(response) {
	if(response.status == 'success') {
		ajaxindicatorstart("Please wait... While we update payment ...");
		var orderid = <?php echo $order['orderid'];?>;
		var transaction_token = response.transaction_token;
		$.post(base_url+"simpl/create_transaction",{orderid: orderid, transaction_token: transaction_token}, function(data){
			ajaxindicatorstop();
			alert(data.msg);
			window.location.reload();
		},'json');
	}
});
window.Simpl && window.Simpl.on('error', function(response) {
  alert("Payment Failed");
});  

function instaPay(orderid) {
	ajaxindicatorstart("Please wait... Redirection to payment gateway...")
	$.post(base_url+"instamojo/create_transaction",{orderid: orderid},function(data){
		ajaxindicatorstop();
		if(data.status == 1) {
			window.location.href=data.url;
		} else {
			alert("Payment Failed.")
		}
	},'json');
}

</script>