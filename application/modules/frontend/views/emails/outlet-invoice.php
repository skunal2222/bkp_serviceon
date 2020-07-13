<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type="text/css">
		.emailer{
			max-height: 450px;
		}
		ul.footer-links {
		    list-style-type: none;
		    margin: 0;
		    padding: 0;
		    overflow: hidden;
		    background-color: #3b598a;
		}
		
		ul.footer-links li {
		    float: left;
		}
		
		ul.footer-links li a {
		    display: block;
		    color: white;
		    text-align: center;
		    padding: 14px 16px;
		    text-decoration: none;
		}
		
		/* Change the link color to #111 (black) on hover */
		ul.footer-links li a:hover {
		    background-color: #111;
		}
		th {
			padding:7px;
    		text-align: left;
		}
		td {
			padding-top:7px;
			padding-left:7px;
		}
		.item_set {
			background-color:#ddd;
			padding:7px;
		}
		#main-content {
			font-size:14px;
		}
    
		</style>
	</head>
<body>
<div style="margin-left:15px;">
	<div style="background-color:#f2f2f2;">
	<img src="<?php echo asset_url().LOGO ; ?>" height='85px' width='152px' style="margin-left:485px;margin-top:18px;">
	</div>
	<?php $name = explode(" ",$data['name']);
		  $fname = $name[0];
		//  $lname = $name[1];   ?>
	<div style="padding-top:15px;">
	<br>
	<div style="font-size:16px;">Dear <?php echo $data['name'];?> ,</div>
	<br>
	<div id="main-content">Thanks again for choosing <?php echo COMPANY; ?>. Kindly check Invoice.</div>
	<br>
	<a href="<?php echo base_url().$data['invoice_url'];?>">Get Invoice</a> 
	<br>
	<br>
</div>
<br>
<div style="padding:15px 0px;">
	<div style="padding-left:5px;">
	Thanks, <br>
	Team <?php echo COMPANY?>!
	</div>
</div>
</body>
</html>
