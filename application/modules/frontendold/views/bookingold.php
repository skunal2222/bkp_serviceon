<?php
error_reporting(0);
 
//print_r($_SESSION['subcategory_id']);
if($_SESSION['subcategory_id']== 2 || $_SESSION['subcategory_id']== 3)
{
	echo '<script>  window.onload = function () { show55();}</script>';
	if($_SESSION['orderid']!='')
	{
		echo '<script> window.onload = function () { prev1();} </script>';
	}
}
else if($_SESSION['subcategory_id']== 1) 
{
	echo '<script>  window.onload = function () { show56();}</script>';
	if($_SESSION['orderid']!='')
	{
		echo '<script> window.onload = function () { prev1();} </script>';
	}
}

?>
<style>
.nav-menu a {
    font-size: 15px;
    font-weight: 300;
}
.fa{
width: 25px;
text-align: center;
margin-right: 5px;
}
.form-control {
    padding: .5rem 0rem;
    }
    @media only screen and (min-width:768px) {
    .in1{
        margin: 0px 10px;
        line-height: 1.5 !important;
        height: 15px;
    }
    .font1.alig{
        margin-top: -15px !important;;
        font-size: 13px !important;;
    }
}
@media only screen and (max-width:767px) and (min-width:200px){
   .col-xs-custom{
         width:50%;
   }
   .c1{
     width:100%;
   }
   #model123{
        height: 190px !important;
    }  
    #brand123{
        height:  190px !important;  
    }
     #catsubcat123{
  
    height: 190px  !important;  ;
    overflow: scroll; 
    overflow-x: hidden;
    }
    #booking_summary .col-xs-custom{
      padding-right: 5px;
      padding-left: 5px;
    } 
   #booking_summary .input-group-addon {
      padding: .5rem 0px !important;  ;
    }
    .f16{
    font-size:12px;
    } 
}
</style>

<link href="<?php echo asset_url();?>images/img/favicon.ico" rel="icon">

<!-- <!-- Google Fonts --> 
<!-- <link -->
<!-- 	href="https://fonts.googleapis.com/css?family=Raleway:400,500,700|Roboto:400,900" -->
<!-- 	rel="stylesheet"> -->

<!-- <!-- Bootstrap CSS File --> 
<!-- <link href="<?php echo asset_url();?>js/lib/bootstrap/css/bootstrap.min.css"-->
<!-- 	rel="stylesheet"> -->

<!-- <!-- Libraries CSS Files -->
<!-- <link href="<?php echo asset_url();?>js/lib/font-awesome/css/font-awesome.min.css"-->
<!-- 	rel="stylesheet"> -->

<!-- Main Stylesheet File -->

<link href="<?php echo asset_url();?>css/booking.css" rel="stylesheet">
<link href="<?php echo asset_url();?>css/datepicker3.css"
	rel="stylesheet">


<section class="about" id="about" style='background-image: url("<?php echo asset_url();?>images/img/templatemo_main_bg_bottom_wrapper.jpg");background-position: 0px -65.24px;'>
	<form id="addorder" name="addorder"
		action="<?php echo base_url();?>booking/add" method="post"
		enctype="multipart/form-data">
		<div class="container">
			<div class="row">

				<div class="col-lg-3 col-xs-12 text-center"></div>

				<div class="col-lg-6 col-xs-12 text-center">

					<div class="nk-footer-text">
						<p class="foterp">Book your mechanic now</p>
					</div>

				</div>
				
				<div class="col-lg-3 col-xs-12 text-center"></div>
			</div>
		</div>

		<!------------------------------ category ----------------------------->
		<div id="booking_cat">
			<div class="container">
				<div class="row">
					<div class="col-md-3 bike1"></div>
					<div class="col-md-6">
						<img src="<?php echo asset_url();?>images/img/button1.png"class="img-responsive" width="100%" />
					</div>

					<div class="col-md-3"></div>

				</div>
			</div>


			<!-- 
 <div class="container">
<div class="row">

<div class="col-md-3"></div>
<div class="col-md-6">
<div class="col-md-12 form-group" style="margin-top:10px;">
               
    <input name="txtUserId" id="txtUserId" class="form-control" placeholder="Enter your Pin" type="text">                                        
		
</div>
</div>

<div class="col-md-3"></div>
</div>

</div> -->
			<br>
			<div class="container">
				<div class="row">

					<div class="col-md-3 text-center"></div>
					<div class="col-md-6 text-center">
						<p class="foterp">Select Category</p>
					</div>
					<div class="col-md-3"></div>

				</div>

    <input name="userid" id="userid" class="form-control frmcntrl f1" type="hidden" value="<?php echo $olouserid; ?>">
    <input id="latitude" name="latitude" value="<?php echo $_SESSION['latitude'];?>" type="hidden">
    <input id="longitude" name="longitude" value="<?php echo $_SESSION['longitude'];;?>" type="hidden">
    <input id="landmark1" name="landmark1" value="<?php echo $_SESSION['locality'];?>" type="hidden">
    
    <input id="subsub" name="subsub" value="<?php echo $_SESSION['subcategory_id'];?>" type="hidden">
    
     <?php // foreach($_SESSION['data'] as $row){?>
				 <!-- <input id="vendor_id" name="vendor_id" value="<?php //echo $row[0]['id'];?>" type="text"> -->
				<?php //} ?>
				<input id="vendor_id" name="vendor_id" value="<?php echo $_SESSION['data'][0]['id'];?>" type="hidden">
				<input id="vendor_id1" name="vendor_id1" value="<?php echo $_SESSION['data'][1]['id'];?>,<?php echo $_SESSION['data'][2]['id'];?>" type="hidden">
			</div>
			<br><br>
			<div class="container">
				<div class="row">
				<div class="col-md-2"></div>
		<?php if(isset ($_SESSION['category_id'])){?>			
<?php  foreach ($categories as $category) { ?>
<div class="col-md-4 col-xs-6 col-xs-custom text-center mno">
						<img src="<?php echo asset_url(); ?><?php echo $category['image'];?>" width="80px" height="80px" class="img-responsive">
						<p class="foterp" id="pname"><?php echo $category['name'];?></p>
						<input id="category_id" name="category_id"
							value="<?php echo $category['id'];?>" <?php if($_SESSION['category_id']==$category['id']) { echo 'checked'; } ?> type="radio" class="radiobtn">
					</div>
	<?php } ?>
	<?php } else { ?>
	<?php  foreach ($categories as $category) { ?>
<div class="col-md-4 col-xs-6 col-xs-custom text-center mno">
						<img src="<?php echo asset_url(); ?><?php echo $category['image'];?>" width="80px" height="80px" class="img-responsive">
						<p class="foterp" id="pname"><?php echo $category['name'];?></p>
						<input id="category_id" name="category_id"
							value="<?php echo $category['id'];?>" type="radio" class="radiobtn">
					</div>
	<?php } ?>
	<?php } ?>
    <div class="messageContainer" style="color:red"></div>
					<div class="col-md-1"></div>
					
					<div class="messageContainer" style="color:red"></div>
					<div class="col-md-2"></div>
				</div>
			</div>
			<br>
			<div class="plan-signup text-center">
				<button class="searchbtn" onclick="show1();" type="button">Continue</button>
			</div>
		</div>
		<!--------------------------------- finish category -------------------->

		<!------------------------------ brand----------------------------->
		<div id="booking_brand">
			<div class="container">
				<div class="row">
					<div class="col-md-3 bike1"></div>
					<div class="col-md-6">
						<img src="<?php echo asset_url();?>images/img/button2.png"
							class="img-responsive" width="100%" />
					</div>

					<div class="col-md-3"></div>

				</div>
			</div>


			<!-- 
 <div class="container">
<div class="row">

<div class="col-md-3"></div>
<div class="col-md-6">
<div class="col-md-12 form-group" style="margin-top:10px;">
               
    <input name="txtUserId" id="txtUserId" class="form-control" placeholder="Enter your Pin" type="text">                                        
		
</div>
</div>

<div class="col-md-3"></div>
</div>

</div> -->
			<br>
			<div class="container">
				<div class="row">

					<div class="col-md-3 text-center">
						<p class="foterp">
							<a onclick="prev1();"><-- Back</a>
						</p>
					</div>
					<div class="col-md-6 text-center">
						<p class="foterp">Select Brand</p>
					</div>
					<div class="col-md-3"></div>

				</div>


			</div>
			<div class="container" id="brand123">
				<div class="row">
					<div class="col-md-3 text-center mno">
						<img src="" width="80px" height="80px" class="img-responsive"
							id="image1">
						<p class="foterp" id="p1"></p>
						<input id="brand_id" name="brand_id" value="" type="radio" class="radiobtn">
					</div>

				</div>
			</div>
			<div class="plan-signup text-center">
				<button class="searchbtn" onclick="show2();" type="button">Continue</button>
			</div>
		</div>
		</div>
		<!--------------------------------- finish brand -------------------->

		<!------------------------------ Model----------------------------->
		<div id="booking_model">
			<div class="container">
				<div class="row">
					<div class="col-md-3 bike1"></div>
					<div class="col-md-6">
						<img src="<?php echo asset_url();?>images/img/button3.png"class="img-responsive" width="100%" />
					</div>

					<div class="col-md-3"></div>

				</div>
			</div>


			<!-- 
 <div class="container">
<div class="row">

<div class="col-md-3"></div>
<div class="col-md-6">
<div class="col-md-12 form-group" style="margin-top:10px;">
               
    <input name="txtUserId" id="txtUserId" class="form-control" placeholder="Enter your Pin" type="text">                                        
		
</div>
</div>

<div class="col-md-3"></div>
</div>

</div> -->
			<br>
			<div class="container">
				<div class="row">

					<div class="col-md-3 text-center">
						<p class="foterp">
							<a onclick="prev2();"><-- Back</a>
						</p>
					</div>
					<div class="col-md-6 text-center">
						<p class="foterp">Select Model</p>
					</div>
					<div class="col-md-3"></div>

				</div>


			</div>
			<div class="container" id="model123">
				<div class="row">
					<div class="col-md-12 text-center mno">
						<img src="" class="img-responsive"><br /> <input id="model_id"
							name="model_id" value="" type="radio" class="radiobtn">
					</div>

					<div class="col-md-1"></div>
				</div>
			</div>
			<div class="plan-signup text-center">
				<button class="searchbtn" onclick="show3();" type="button">Continue</button>
			</div>
		</div>
		</div>
		<!--------------------------------- finish model -------------------->

		<!------------------------------Subcategory----------------------------->
		<div id="booking_subcat">
			<div class="container">
				<div class="row">
					<div class="col-md-3 bike1"></div>
					<div class="col-md-6">
						<img src="<?php echo asset_url();?>images/img/button4.png" class="img-responsive" width="100%" />
					</div>

					<div class="col-md-3"></div>

				</div>
			</div>


			<!-- 
 <div class="container">
<div class="row">

<div class="col-md-3"></div>
<div class="col-md-6">
<div class="col-md-12 form-group" style="margin-top:10px;">
               
    <input name="txtUserId" id="txtUserId" class="form-control" placeholder="Enter your Pin" type="text">                                        
		
</div>
</div>

<div class="col-md-3"></div>
</div>

</div> -->
			<br>
			<div class="container">
				<div class="row">

					<div class="col-md-3 text-center">
						<p class="foterp">
							<a onclick="prev3();"><-- Back</a>
						</p>
					</div>
					<div class="col-md-6 text-center">
						<p class="foterp">Select Subcategory</p>
					</div>
					<div class="col-md-3"></div>

				</div>


			</div>
			<div class="container c1" id="subcat123">
				<div class="row">
					<div class="col-md-4 text-center mno">
						<img src="" class="img-responsive"><br />
						 <input id="subcategory_id"	name="subcategory_id" value="" type="radio" class="radiobtn">
						 <input id="subcategory_id1" name="subcategory_id1" value="" type="hidden">
					</div>

					<div class="col-md-1"></div>
					
				</div>
			</div>
			<div class="plan-signup text-center">
				<button class="searchbtn" onclick="show4();" type="button">Continue</button>
			</div>
		</div>
		</div>
		<!--------------------------------- finish subcategory -------------------->


		<!------------------------------Categorysubcat----------------------------->
		<div id="booking_catsubcat">
			<div class="container">
				<div class="row">
					<div class="col-md-3 bike1"></div>
					<div class="col-md-6">
						<img src="<?php echo asset_url();?>images/img/button5.png" class="img-responsive" width="100%" />
					</div>

					<div class="col-md-3"></div>

				</div>
			</div>


			<!-- 
 <div class="container">
<div class="row">

<div class="col-md-3"></div>
<div class="col-md-6">
<div class="col-md-12 form-group" style="margin-top:10px;">
               
    <input name="txtUserId" id="txtUserId" class="form-control" placeholder="Enter your Pin" type="text">                                        
		
</div>
</div>

<div class="col-md-3"></div>
</div>

</div> -->
			<br>
			<div class="container">
				<div class="row">

					<div class="col-md-3 text-center">
						<p class="foterp">
							<a onclick="prev4();"><-- Back</a>
						</p>
					</div>
					<div class="col-md-6 text-center"><?php //print_r($_SESSION);?>
						<p class="foterp">Select Category of Subcategory</p>
					</div>
					<div class="col-md-3"></div>

				</div>


			</div>
			<div class="container" id="catsubcat123">
				<div class="row">
				<!--<div class="col-md-3 text-center mno">
					<img src="" class="img-responsive"><br /> <input id="catsubcat_id"
							name="catsubcat_id[]" type="checkbox" class="radiobtn">
					</div>-->

					<div class="col-md-1"></div>
					<!-- 	<div class="col-md-3 text-center">
					<img src="<?php echo asset_url();?>images/img/car.png"
						/ class="img-responsive"><br /> <input id="subcategory_id2"
						name="subcategory_id" value="2" type="radio">
				</div>-->
					<div class="col-md-2"></div>
				</div>
			</div>
			<div class="plan-signup text-center">
				<button class="searchbtn" onclick="show5();" type="button">Continue</button>
			</div>
		</div>
		</div>
		<!--------------------------------- finish categorysubcat -------------------->
		
		<!------------------------------Service----------------------------->
		<div id="booking_service">
			<div class="container">
				<div class="row">
					<div class="col-md-3 bike1"></div>
					<div class="col-md-6">
						<img src="<?php echo asset_url();?>images/img/button5.png"
							class="img-responsive" width="100%" />
					</div>

					<div class="col-md-3"></div>

				</div>
			</div>
  

			<!-- 
 <div class="container">
<div class="row">

<div class="col-md-3"></div>
<div class="col-md-6">
<div class="col-md-12 form-group" style="margin-top:10px;">
               
    <input name="txtUserId" id="txtUserId" class="form-control" placeholder="Enter your Pin" type="text">                                        
		
</div>
</div>

<div class="col-md-3"></div>
</div>

</div> -->
			<br>
			<div class="container">
				<div class="row">

					<div class="col-md-3 text-center">
						<p class="foterp">
							<a onclick="prev5();"><-- Back</a>
						</p>
					</div>
					<div class="col-md-6 text-center">
						<p class="foterp">Select Service</p>
					</div>
					<div class="col-md-3"></div>

				</div>


			</div>
			<div class="container" id="service123">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-3 text-center">
						<img src="<?php echo asset_url();?>images/img/bike.png"
							class="img-responsive"><br /> <input id="service_id"
							name="service_id" type="radio">
					</div>

					<div class="col-md-1"></div>
					<!-- 	<div class="col-md-3 text-center">
					<img src="<?php echo asset_url();?>images/img/car.png"
						/ class="img-responsive"><br /> <input id="subcategory_id2"
						name="subcategory_id" value="2" type="radio">
				</div>-->
					<div class="col-md-2"></div>
				</div>
			</div>
			<br>
			<div class="plan-signup text-center">
				<button class="searchbtn" onclick="show6();" type="button">Continue</button>
			</div>
		</div>
		</div>
		<!--------------------------------- finish service -------------------->
		
		<!------------------------------Brkdown details----------------------------->
		<div id="booking_brk">
			<div class="container">
				<div class="row">
					<div class="col-md-3 bike1"></div>
					<div class="col-md-6">
						<img src="<?php echo asset_url();?>images/img/button6.png"
							class="img-responsive" width="100%" />
					</div>

					<div class="col-md-3"></div>

				</div>
			</div>


			<br>
			<div class="container">
				<div class="row">

					<div class="col-md-3 text-center">
						 <p class="foterp">
							<a onclick="prev10();"><-- Back</a>
						</p> 
					</div>
					<div class="col-md-6 text-center">
						<button class="searchbtn1" type="button" style="background-color:rgb(250, 186, 3)">NEED SERVICE NOW</button>
						<button class="searchbtn1" type="button" onclick="show6();">SCHEDULE SERVICE</button>
					</div>
						<div class="col-md-3"></div>

				</div>

			</div><br>

			<div class="container">
				<div class="row">

					<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="row">
							
							<div class="col-md-12 form-group" style="margin-top: 10px;">
								<div>
									<input name="locality1" id="locality"
										class="form-control frmcntrl"
										placeholder="Location" type="text" readonly value="<?php echo $_SESSION['locality'];?>">
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							
							<div class="col-md-12 form-group" style="margin-top: 10px;">
								<div>
									<input name="landmark2" id="landmark2"
										class="form-control frmcntrl"
										placeholder="Landmark" type="text">
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							
							<div class="col-md-12 form-group" style="margin-top: 10px;">
								<div>
									<input name="mobile2" id="mobile2" class="form-control frmcntrl"
										placeholder="Your Mobile" type="text" value="<?php echo $olousermobile; ?>" onfocusout="myFunction()">
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							
							<div class="col-md-12 form-group" style="margin-top: 10px;">
								<div>
									<input name="mobile3" id="mobile3" class="form-control frmcntrl"
										placeholder="Alternate Mobile" type="text" onfocusout="myFunction1()">
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							<?php
						$dt = new DateTime();
						
					?>
				     <input type="hidden" value="<?php echo $dt->format('d-m-Y');?>" required  name="visit_date2" id="visit_date2">
							
						</div>

					</div>

					<div class="col-md-3"></div>
				</div>
			</div>
			<br>
			<div class="plan-signup text-center">
				<button class="searchbtn" onclick="show9();" type="button">Continue</button>
			</div>
		</div>
		</div>
		<!--------------------------------- finish brkdown details -------------------->
		
		<!------------------------------Visit details----------------------------->
		<div id="booking_visit1">
			<div class="container">
				<div class="row">
					<div class="col-md-3 bike1"></div>
					<div class="col-md-6">
						<img src="<?php echo asset_url();?>images/img/button6.png"
							class="img-responsive" width="100%" />
					</div>
                  
					<div class="col-md-3"></div>

				</div>
			</div>


			<br>
			<div class="container">
				<div class="row">

					<div class="col-md-3 text-center">
						 <p class="foterp">
							<a onclick="prev11();"><-- Back</a>
						</p> 
					</div>
					 <div class="col-md-6 text-center">
						<button class="searchbtn1" type="button" onclick="show56();" >NEED SERVICE NOW</button>
						<button class="searchbtn1" type="button" style="background-color:rgb(250, 186, 3)">SCHEDULE SERVICE</button>
						<p class="foterp">Enter Visit Details</p>
					</div>
						<div class="col-md-3"></div>

				</div>

			</div>

			<div class="container">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6 form-group" style="margin-top: 10px;">
								<div>
								<input name="loginid" id="loginid" class="form-control frmcntrl f1" type="hidden" value="<?php echo $olouserid; ?>">
									<input name="name123" id="name123" class="form-control frmcntrl f1"
										placeholder="Your Name" type="text" readonly value="<?php echo $olousername; ?>" >
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>

							<div class="col-md-6 form-group" style="margin-top: 10px;">
								<div>
									<input name="email123" id="email123" class="form-control frmcntrl"
										placeholder="your Email" type="text" readonly value="<?php echo $olouseremail; ?>">
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							<div class="col-md-6 form-group" style="margin-top: 10px;">
								<div>
									<input name="mobile123" id="mobile123" class="form-control frmcntrl"
										placeholder="Your Mobile" type="text" readonly value="<?php echo $olousermobile; ?>">
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							<div class="col-md-6 form-group" style="margin-top: 10px;">
								<div>
									<input name="visit_date123" id="visit_date123"
										class="form-control frmcntrl" placeholder="Select Visit date"
										type="text">
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							<div class="col-md-6 form-group" style="margin-top: 10px;">
								<div id="visit_slot">
									<select name="visit_time123" id="visit_time123"
										class="form-control frmcntrl" placeholder="Select Visit time">
										<option value="">Select Time</option>
													<?php foreach ($visitingslots as $slot) { ?>
													<option value="<?php echo $slot['time_slot'];?>"><?php echo $slot['time_slot'];?></option>
													<?php } ?>
												</select>
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							<div class="col-md-6 form-group" style="margin-top: 10px;">
								<div>
									<input name="flat123" id="flat123" class="form-control frmcntrl"
										placeholder="Flat No/Building" type="text">
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							<div class="col-md-12 form-group" style="margin-top: 10px;">
								<div>
									<input name="landmark123" id="landmark123"
										class="form-control frmcntrl"
										placeholder="Society name & landmark" type="text">
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
						</div>

					</div>

					<div class="col-md-3"></div>
				</div>
			</div>
			<br>
			<div class="plan-signup text-center">
				<button class="searchbtn" onclick="show7();" type="button">Continue</button>
			</div>
		</div>
		</div>
		<!--------------------------------- finish visit details -------------------->

		<!------------------------------Visit details----------------------------->
		<div id="booking_visit">
			<div class="container">
				<div class="row">
					<div class="col-md-3 bike1"></div>
					<div class="col-md-6">
						<img src="<?php echo asset_url();?>images/img/button6.png"
							class="img-responsive" width="100%" />
					</div>

					<div class="col-md-3"></div>

				</div>
			</div>


			<br>
			<div class="container">
				<div class="row">

					<div class="col-md-3 text-center">
						 <p class="foterp">
							<a onclick="prev11();"><-- Back</a>
						</p> 
					</div>
					<div class="col-md-6 text-center">
						<p class="foterp">Enter Visit Details</p>
					</div>
					<div class="col-md-3"></div>

				</div>

			</div>

			<div class="container">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6 form-group" style="margin-top: 10px;">
								<div>
								<input name="loginid" id="loginid" class="form-control frmcntrl f1" type="hidden" value="<?php echo $olouserid; ?>">
									<input name="name" id="name" class="form-control frmcntrl f1"
										placeholder="Your Name" type="text" readonly value="<?php echo $olousername; ?>" >
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>

							<div class="col-md-6 form-group" style="margin-top: 10px;">
								<div>
									<input name="email" id="email" class="form-control frmcntrl"
										placeholder="your Email" type="text" readonly value="<?php echo $olouseremail; ?>">
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							<div class="col-md-6 form-group" style="margin-top: 10px;">
								<div>
									<input name="mobile" id="mobile" class="form-control frmcntrl"
										placeholder="Your Mobile" type="text" readonly value="<?php echo $olousermobile; ?>">
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							<div class="col-md-6 form-group" style="margin-top: 10px;">
								<div>
									<input name="visit_date" id="visit_date"
										class="form-control frmcntrl" placeholder="Select Visit date"
										type="text">
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							<div class="col-md-6 form-group" style="margin-top: 10px;">
								<div id="visit_slot">
									<select name="visit_time" id="visit_time"
										class="form-control frmcntrl" placeholder="Select Visit time">
										<option value="">Select Time</option>
													<?php foreach ($visitingslots as $slot) { ?>
													<option value="<?php echo $slot['time_slot'];?>"><?php echo $slot['time_slot'];?></option>
													<?php } ?>
												</select>
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							<div class="col-md-6 form-group" style="margin-top: 10px;">
								<div>
									<input name="flat" id="flat" class="form-control frmcntrl"
										placeholder="Flat No/Building" type="text">
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							<div class="col-md-12 form-group" style="margin-top: 10px;">
								<div>
									<input name="landmark" id="landmark"
										class="form-control frmcntrl"
										placeholder="Society name & landmark" type="text">
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
						</div>

					</div>

					<div class="col-md-3"></div>
				</div>
			</div>
			<br>
			<div class="plan-signup text-center">
				<button class="searchbtn" onclick="show777();" type="button">Continue</button>
			</div>
		</div>
		</div>
		<!--------------------------------- finish visit details -------------------->

		<!------------------------------Booking summary----------------------------->
		<div id="booking_summary">
			<div class="container">
				<div class="row">
					<div class="col-md-3 bike1"></div>
					<div class="col-md-6">
						<img src="<?php echo asset_url();?>images/img/button6.png"
							class="img-responsive" width="100%" />
					</div>

					<div class="col-md-3"></div>

				</div>
			</div>


			<br>
			<div class="container">
				<div class="row">

					<div class="col-md-3 text-center">
					<p class="foterp">
							<a onclick="prev7();"><-- Back</a>
						</p> 
					</div>
					<div class="col-md-6 text-center">
						<p class="foterp">Booking Summary</p>
					</div>
					<div class="col-md-3"></div>

				</div>

			</div>

			<div class="container c1">
				<div class="row">

					<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12 form-group" style="margin-top: 10px;">
								<div class="input-group">
								<input type="hidden" value="<?php echo $_SESSION['subcategory_id'];?>" id="sucat">
								<?php if($_SESSION['subcategory_id']=='') {?>
								<input type="hidden" value="" id="subcategory_id11" name="subcategory_id11">
								<?php } else {?>
								<input type="hidden" value="<?php echo $_SESSION['subcategory_id'];?>" id="subcategory_id11" name="subcategory_id11">
								<?php } ?>
									<span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
									<label id="label1"></label>
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>

							<div class="col-md-12 form-group" style="margin-top: 10px;">
								<div class="input-group">
									<span class="input-group-addon"><i
										class="fa fa-map-marker fa-fw"></i></span> <label id="label2"><?php echo $_SESSION['locality'];?></label>
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							<div class="col-md-12 form-group" style="margin-top: 10px;">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-wrench fa-fw"></i></span>
									<label id="label3"></label>
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							<div class="col-md-12 form-group" style="margin-top: 10px;">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-mobile fa-fw"></i></span>
									<label id="label4"></label>
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							<div class="col-md-12 form-group" style="margin-top: 10px;">
								<div class="input-group">
								  <span class="input-group-addon"><i class="fa fa-percent fa-fw"></i></span>
								  <div class="col-xs-custom">
								     <input type="radio" name="discount_type" id="discount_type" value="promocode" ontouchstart="checkWallet('promocode')" onchange="checkWallet('promocode')" class="in1">Promocode &nbsp;&nbsp;
							      </div>
								  <div class="col-xs-custom">
								        <input type="radio" name="discount_type" id="discount_type" onchange="checkWallet('credits')" ontouchstart="checkWallet('credits')"  class="in1" value="credits"> Use wallet points (<b class="font-16 f16"><blink><?php echo $balance[0]['amount'];?></blink> Points in your account.</b>)
							      </div>
							    </div>
							 </div>
							<div class="col-md-6 form-group" style="margin-top: 10px;">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-percent fa-fw"></i></span>
									<input name="coupon_code" id="coupon_code" class="form-control frmcntrl" placeholder="Enter Coupon code" type="text">
									
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
                           <div class="text-center" style="display:inline-block;">
							<a href="javascript:checkCoupon();" style="display: inline-block;margin-top: 10px; margin-left: 46px;font-weight:600; color:#1B0F41 !important;">Apply Coupon</a>
                           </div> 
							<div class="font1 alig" id="alert-coupon" style="color: rgb(255, 0, 0);padding-top: 0px;margin-left: 68px;margin-bottom: 20px;display: inline-block;"></div>
							<div class="col-md-12 form-group" style="margin-top: 10px;">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
									<input name="comment" id="comment"
										class="form-control frmcntrl"
										placeholder="Additional Comment(Optional)" type="text">
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
						</div>

					</div>

					<div class="col-md-3"></div>
				</div>
			</div>
			<br>
			<div class="text-center">
				<button type="submit" class="searchbtn">Book Now</button>
			</div>
		</div>

		</div>
		<!--------------------------------- summary -------------------->

	</form>
</section>
<div id="myModal" class="modal fade" style='margin-top:100px'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: wheat;">
              <h4 class="modal-title">Register</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               
            </div>
            <div class="modal-body">
				
                <form method="post" name="su_sign_frm" id="su_sign_frm">
                         <div class="col-md-12">
						<div class="row">
							<div class="col-md-6 form-group" style="margin-top: 10px;">
								<div>
								<input name="userid1" id="userid1" class="form-control frmcntrl f1"
										type="hidden">
									<input name="name1" id="name1" class="form-control frmcntrl f1"
										placeholder="First Name" type="text" value="" >
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>

                            <div class="col-md-6 form-group" style="margin-top: 10px;">
								<div>
									<input name="name11" id="name11" class="form-control frmcntrl f1"
										placeholder="Last Name" type="text" value="" >
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							
							<div class="col-md-6 form-group" style="margin-top: 10px;">
								<div>
									<input name="email1" id="email1" class="form-control frmcntrl"
										placeholder="Email" type="text" value="">
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							
							<div class="col-md-6 form-group" style="margin-top: 10px;">
								<div>
									<input name="mobile1" id="mobile1" class="form-control frmcntrl"
										placeholder="Mobile" type="text" value="">
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							
							<div class="col-md-6 form-group" style="margin-top: 10px;">
								<div>
									<input name="password1" id="password1" class="form-control frmcntrl"
										placeholder="Password" type="password" value="">
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							
							<div class="col-md-6 form-group" style="margin-top: 10px;">
								<div>
									<input name="password11" id="password11" class="form-control frmcntrl"
										placeholder="Confirm Password" type="password" value="">
								</div>
								<div class="messageContainer" style="color:red"></div>
								<div class="message" style="color:red"></div>
							</div>
							
							<div class="col-md-6 form-group" style="margin-top: 10px;">
								<div>
									<input name="referal_code" id="referal_code" class="form-control frmcntrl"
										placeholder="Enter referal code(if any)" type="text" value="">
								</div>
								<div class="messageContainer" style="color:red"></div>
							</div>
							
						</div>
						</div><br>
                    <div class="text-center">
                    <div id="ref_code" style="display:none;color:red"><button type="button" onclick="removeRefcode();">Ok</button></div>
                    <button type="submit" class="searchbtn" id="otp_btn">REGISTER</button></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="myOtp" class="modal fade" style='margin-top:100px'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: wheat;">
            <h4 class="modal-title">Verification Code Sent</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                
            </div>
            <div class="modal-body">
				
                <form method="post" name="otp_frm1" id="otp_frm1">
                    <div class="form-group">
                    <input type="hidden" name="lg_uid" id="lg_uid" value=""/>
                    <input type="hidden" name="lg_email" id="lg_email" value=""/>
                    <div>
                        <input type="text" id="lg_otp" name="lg_otp" class="form-control frmcntrl" placeholder="Enter OTP">
                        </div>
                        	<div class="messageContainer" style="color:red"></div>
                    </div>
                    <span style="float: right;margin-left: -20px;"><a onclick="resendOtp();" style="cursor:pointer;">Resend OTP</a></span>
                    <div class="col-md-12" style="margin-top: 45px;">
							<div class="alert alert-danger" id="otp_response1" style="display:none;"></div>
					</div>
					<div class="set text-center">
                    <button type="submit" class="searchbtn" id="otp_verify_btn">CONTINUE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="fogetModal" class="modal fade" role="dialog" style="color:#555;">
  	<div class="modal-dialog">
    	<div class="modal-content">
    		<form action="" name="forget_frm" id="forget_frm">
      		<div class="modal-header">
        		<h4 class="modal-title">Forgot Password</h4>
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
      		</div>
	      	<div class="modal-body">
              	<div class="row" style="padding:0px">
              		<div class="col-md-12">
                  		<div class="form-group">
                       		<input type="text" name="forget_email" id="forget_email" class="form-control frmcntrl" value="" placeholder="Enter Email or Mobile" />
                  		</div>
                  		<div class="messageContainer" style="color:red"></div>
              		</div>
              	</div>
	      	</div>
	      	<div class="modal-footer">
	      		<button type="submit" class="btn btn12">SUBMIT</button>
	        	<button type="button" class="btn btn12" data-dismiss="modal">CLOSE</button>
	      	</div>
	      	</form>
    	</div>
  	</div>
</div>

<div id="fogetModal1" class="modal fade" role="dialog" style="color:#555;">
  	<div class="modal-dialog">
    	<div class="modal-content">
    		<form action="" name="forget_frm1" id="forget_frm1">
      		<div class="modal-header">
        		<h4 class="modal-title">Forgot Password</h4>
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
      		</div>
	      	<div class="modal-body">
              	<div class="row" style="padding:0px">
              		<div class="col-md-12">
              		<input type="hidden" name="uid" id="uid" value=""/>
                  		<div class="form-group">
                       		<input type="password" name="new_password" id="new_password" class="form-control frmcntrl" value="" placeholder="new password" />
                  		</div>
                  		<div class="messageContainer" style="color:red"></div>
              		</div>
              			<div class="col-md-12">
                  		<div class="form-group">
                       		<input type="password" name="new_password1" id="new_password1" class="form-control frmcntrl" value="" placeholder="confirm password" />
                  		</div>
                  		<div class="messageContainer" style="color:red"></div>
              		</div>
              	</div>
	      	</div>
	      	<div class="modal-footer">
	      		<button type="submit" class="btn btn12" style="margin-right: 140px;">RESET NOW</button>
	       	</div>
	      	</form>
    	</div>
  	</div>
</div>
<div id="myLogin" class="modal fade" style='margin-top:40px'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: wheat;">
            <h4 class="modal-title">Login</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                
            </div>
            <div class="modal-body">
				
                <div class="container">
<div class="row">

<div class="col-md-12">
	 <form name="lg_login_frm" id="lg_login_frm" method="post" action="" >
<div class="col-md-12 form-group" style="margin-top:10px;">
      <div>         
    <input name="lg_mobile" id="lg_mobile" class="form-control frmcntrl" placeholder="Phone Number" type="text">   
	</div>
		<div class="messageContainer" style="color:red"></div>	
</div>
<div class="col-md-12 form-group" style="margin-top:10px;">
        <div>       
    <input name="lg_pwd" id="lg_pwd" class="form-control frmcntrl" placeholder="Password" type="password">   
		</div>
			<div class="messageContainer" style="color:red"></div>
</div>
<div class="col-md-12 form-group">
    <span>
    <a data-toggle="modal" data-target="#fogetModal" data-dismiss="modal" style="cursor:pointer;float:left"><i>Forgot Password</i></a>
    </span> 
    <span>
    <a onclick="otpLogin();" style="cursor:pointer; float:right"><i>Login through OTP</i></a>  
	</span>
</div>
<div class="col-md-12 text-center">	<div id="lg_response" style="color:red" ></div></div>
<div class="col-md-12 text-center" style="margin:20px 0px" >
               <button type="submit" class="searchbtn" id="login_btn">LOGIN</button>
              </div>
              	<div class="col-md-12" text-center">
									<div class="alert alert-danger" id="login_response" style="display:none;"></div>
								</div>
			  </form>
			  <!-- <div class="col-md-12 text-center" style="margin:6px" >
              <h5>or login with</h5>
              </div>-->
			  
			  <div class="col-md-12 text-center" style="margin:6px" >
              <div class="row">
			
             <!-- <div class="text-center" style="width: 100%;">
                       <nav class="nav social-nav text-center">
        <a href="#" style="padding: 8px;">
          <img src="<?php echo asset_url();?>images/img/face.png"class="img-responsive"/>
        </a> 
		<a href="#" style="padding: 8px;">
		 <img src="<?php echo asset_url();?>images/img/goog.png"class="img-responsive"/>
		</a> 
		<a href="#" style="padding: 8px;">
		 <img src="<?php echo asset_url();?>images/img/tweet.png"class="img-responsive" />
		</a>
      </nav>
                    </div>-->
					<div class="col-lg-4 col-xs-12 ">
             
            </div>
</div>
              </div>
			  
			  <div class="col-md-12 text-center" style="margin-top:10px;">
               
    <p>Don't have an account?<span style="color:blue"><a onclick="reg();"> Register Now</a></span></p>
		
</div>
</div>
</div>


</div>
            </div>
        </div>
    </div>
</div>

<a class="scrolltop" href="#"><span class="fa fa-angle-up"></span></a>

<script src="<?php echo asset_url();?>js/lib/jquery/jquery.min.js"></script>
<script src="<?php echo asset_url();?>js/lib/superfish/hoverIntent.js"></script>
<script src="<?php echo asset_url();?>js/lib/superfish/superfish.min.js"></script>
<!--
<script src="<?php echo asset_url();?>js/lib/tether/js/tether.min.js"></script>
<script src="<?php echo asset_url();?>js/lib/stellar/stellar.min.js"></script>
<script src="<?php echo asset_url();?>js/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo asset_url();?>js/lib/counterup/counterup.min.js"></script>
<script src="<?php echo asset_url();?>js/lib/waypoints/waypoints.min.js"></script>
<script src="<?php echo asset_url();?>js/lib/easing/easing.js"></script>
<script src="<?php echo asset_url();?>js/lib/stickyjs/sticky.js"></script>
<script src="<?php echo asset_url();?>js/lib/parallax/parallax.js"></script>
<script src="<?php echo asset_url();?>js/lib/lockfixed/lockfixed.min.js"></script>
<script src="<?php echo asset_url();?>js/custom.js"></script>
-->
<script src="<?php echo asset_url();?>js/bootstrap-typeahead.min.js"></script>
<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>


<script>
var nowDate = new Date();
var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
$.fn.datepicker.defaults.format = "dd-mm-yyyy";
$.fn.datepicker.defaults.startDate = today;

</script>

<script type="text/javascript">
$('input[name=category_id]').keypress(function(event) {
	 if (event.which == 13) {
       event.preventDefault();
       show1();
       return false;
   }
});

$('input[name=brand_id]').keypress(function(event) {
		 if (event.which == 13) {
	        event.preventDefault();
	        show2();
	        return false;
	    }
	});

$('input[name=model_id]').keypress(function(event) {
	 if (event.which == 13) {
       event.preventDefault();
       show3();
       return false;
   }
});

$('input[name=subcategory_id]').keypress(function(event) {
	 if (event.which == 13) {
       event.preventDefault();
       show4();
       return false;
   }
});

function checkcatofsubcat(event)
{
	event.preventDefault();
	show5();
	//alert("test");
}
/* $('input[name=catsubcat_id]').keypress(function(event) {
	 if (event.which == 13) {
       event.preventDefault();
       show5();
       return false;
   }
});*/
//var chks = document.getElementsByName('catsubcat_id[]');
/*$('input:checkbox[id=catsubcat_id]').keypress(function(event) {
	alert("please check");
	 if (event.which == 13) {
      event.preventDefault();
      show5();
      return false;
  }
});*/

/*$(document).ready(function() {
	$("input[name='catsubcat_id[]']").each(function(){
	     alert($(this).val());
	     alert("test1");
	     $(this).keypress(function(event) {
	         var keycode = (event.keyCode ? event.keyCode : event.which);

	         if (keycode == 13) {
	             clickCheckBox(this);
	             alert("Test");
	         }
	         event.stopPropagation();
	     });
	}); 
    
}); */

/*$('#catsubcat_id').keypress(function(event) {
var keycode = (event.keyCode ? event.keyCode : event.which);

if (keycode == 13) {
    clickCheckBox(this);
    alert("Test");
}
event.stopPropagation();
});*/

/*$(document).ready(function() {
    $('#catsubcat_id').keypress(function(event) {
        alert("enter press for checkbox");
        var keycode = (event.keyCode ? event.keyCode : event.which);

        if (keycode == 13) {
            alert("enter press for checkbox");
        }
        event.stopPropagation();
    });
}); */


/*$(document).ready(function() {
	  $(window).keydown(function(event){
	    if(event.keyCode == 13) {
	      event.preventDefault();
	      return false;
	    }
	  });
	});
*/

	
	$("#mobile3").keypress(function(event) {
		 if (event.which == 13) {
	        event.preventDefault();
	        show9();
	        return false;
	    }
	});
	$("#landmark").keypress(function(event) {
		 if (event.which == 13) {
	        event.preventDefault();
	        show777();
	        return false;
	    }
	});

	$("#landmark123").keypress(function(event) {
		 if (event.which == 13) {
	        event.preventDefault();
	        show7();
	        return false;
	    }
	});

	$("#lg_pwd").keypress(function(event) {
		 if (event.which == 13) {
	        event.preventDefault();
	        showlogin();
	        return false;
	    }
	});

	$("#password11").keypress(function(event) {
		 if (event.which == 13) {
	        event.preventDefault();
	        showreg();
	        return false;
	    }
	});

	$("#lg_otp").keypress(function(event) {
		 if (event.which == 13) {
	        event.preventDefault();
	        showotp();
	        return false;
	    }
	});

$('#booking_brand').hide();
function show1()
{
	//alert("show 1");
	var cat_id = $('input[name=category_id]:checked').val();
	//alert(cat_id);
	if(cat_id == undefined)
	{
		alert("Please select any one");
	}
	else
	{
	  $('#booking_cat').hide();
      $('#booking_brand').show();
      
      $.post(base_url+"brandbycatid1", {cat_id : cat_id}, function(data)
    		  {
		 /* alert(data.length);
		    if(data.length > 0)
    			   {		    
    			     for( var i=0; i < data.length; i++)
    				     {		   	
    				     alert(data[i].id);	
    				     alert(data[i].name);
    				     alert(asset_url+""+data[i].image);	    
    			    	  $('#brand_id').val(data[i].id);
    			    	  $("#image1").attr("src", asset_url+""+data[i].image);	
    			    	  $('#p1').html(data[i].name);			
    				            }	    
    		              }	 */
		  $("#brand123").empty();
   	   $("#brand123").html(data);
    	  
    	           });
	}
	
	
}
</script>

<script type="text/javascript">
$('#booking_brand').hide();
function prev1()
{
	$('#booking_cat').show();
	$('#booking_brand').hide();
}
</script>

<script type="text/javascript">
$('#booking_brand').hide();
$('#booking_model').hide();
$('#booking_subcat').hide();
function show2()
{
	//alert("show2");
	var brand_id = $('input[name=brand_id]:checked').val();
	if(brand_id == undefined)
	{
		alert("Please select any one");
	}
	else
	{
	$('#booking_cat').hide();
	$('#booking_brand').hide();
	$('#booking_model').show();
	$('#booking_subcat').hide();
	
			  $.post(base_url+"modelbybrandid1", {brand_id : brand_id}, function(data)
					  {
				  $("#model123").empty();
			   	   $("#model123").html(data);
	               });   
              
	}
}
</script>

<script type="text/javascript">
$('#booking_brand').hide();
$('#booking_model').hide();
$('#booking_subcat').hide();
function prev2()
{
	$('#booking_cat').hide();
	$('#booking_brand').show();
	$('#booking_model').hide();
	$('#booking_subcat').hide();
}
</script>

<script type="text/javascript">
$('#booking_brand').hide();
$('#booking_model').hide();
$('#booking_subcat').hide();
function show3()
{
	var model_id = $('input[name=model_id]:checked').val();
	if(model_id == undefined)
	{
		alert("Please select any one");
	}
	else
	{
	$('#booking_cat').hide();
	$('#booking_brand').hide();
	$('#booking_model').hide();
	$('#booking_subcat').show();
	  $.post(base_url+"subcategorybycatid1", {model_id : model_id}, function(data)
			  {
		  $("#subcat123").empty();
	   	   $("#subcat123").html(data);
           });
	}
}
</script>

<script type="text/javascript">
$('#booking_brand').hide();
$('#booking_model').hide();
$('#booking_subcat').hide();
function prev3()
{
	$('#booking_cat').hide();
	$('#booking_brand').hide();
	$('#booking_model').show();
	$('#booking_subcat').hide();
}
</script>

<script type="text/javascript">
$('#booking_brand').hide();
$('#booking_model').hide();
$('#booking_subcat').hide();
$('#booking_catsubcat').hide();
$('#booking_service').hide();
function show4()
{
	var subcat_id = $('input[name=subcategory_id]:checked').val();
	var subcat_id1 = $('input[name=subcategory_id]:checked').next().val();
	$('#subcategory_id11').val(subcat_id1);
	//var subcat_id1 = $('input[name=subcategory_id]:checked').next().val();
	if(subcat_id == undefined)
	{
		alert("Please select any one");
	}
	else
	{
	$('#booking_cat').hide();
	$('#booking_brand').hide();
	$('#booking_model').hide();
	$('#booking_subcat').hide();
	//alert(subcat_id1);
	if(subcat_id1== 1)
	{
		if($('#userid').val()=='')
		{
		$('#booking_subcat').show();
		//$("#myModal").modal("show");
		$("#myLogin").modal("show");
		//$("#booking_brk").show();
		}
		else
		{
			$('#booking_subcat').hide();
			$("#booking_brk").show();
		}
	}
	else
	{
	$('#booking_catsubcat').show();
	  $.post(base_url+"catsubcatbyid1", {subcat_id : subcat_id}, function(data)
			  {
		  $("#catsubcat123").empty();
	   	   $("#catsubcat123").html(data);
           });
	}
	}
}
</script>

<script type="text/javascript">
$('#booking_brand').hide();
$('#booking_model').hide();
$('#booking_subcat').hide();
$('#booking_catsubcat').hide();
function prev4()
{
	$('#booking_cat').hide();
	$('#booking_brand').hide();
	$('#booking_model').hide();
	$('#booking_subcat').show();
	$('#booking_catsubcat').hide();
}
</script>

<script type="text/javascript">
$('#booking_brand').hide();
$('#booking_model').hide();
$('#booking_subcat').hide();
$('#booking_catsubcat').hide();
$('#booking_service').hide();
$('#booking_visit').hide();
$('#booking_visit1').hide();
function show5()
{
	
	var catsubcat_id = $('input[name=catsubcat_id]:checked').val();

	var chks = document.getElementsByName('catsubcat_id[]');
	var hasChecked = false;
	for (var i = 0; i < chks.length; i++)
	{
		if (chks[i].checked)
		{
		hasChecked = true;
		break;
		}
	}

	/* if (hasChecked == false)
		{
		alert("Please select at least one.");
		return false;
		} */
	
	if(hasChecked == false)
	{
		alert("Please select at least one");
	}
	else
	{
		if($('#userid').val()=='')
		{
	$('#booking_cat').hide();
	$('#booking_brand').hide();
	$('#booking_model').hide();
	$('#booking_subcat').hide();
	//$('#booking_catsubcat').hide();
	$("#myLogin").modal("show");
		}
		else
		{
	$('#booking_cat').hide();
	$('#booking_brand').hide();
	$('#booking_model').hide();
	$('#booking_subcat').hide();
	$('#booking_catsubcat').hide();
	$('#booking_visit').show();
		}
/*	$('#booking_service').show();
	  $.post(base_url+"servicebycatid2", {subcat_id : catsubcat_id}, function(data)
			  {
		  $("#service123").empty();
	   	   $("#service123").html(data);
           });
	*/
	  
	}
}
</script>

<script>
$('#booking_brand').hide();
$('#booking_model').hide();
$('#booking_subcat').hide();
$('#booking_catsubcat').hide();
$('#booking_service').hide();
$('#booking_visit').hide();
$('#booking_visit1').hide();
function show55()
{
	$('#booking_cat').hide();
	$('#booking_brand').hide();
	$('#booking_model').hide();
	$('#booking_subcat').hide();
	$('#booking_catsubcat').hide();
	$('#booking_visit').show();
}
</script>

<script type="text/javascript">
$('#booking_brand').hide();
$('#booking_model').hide();
$('#booking_subcat').hide();
$('#booking_catsubcat').hide();
$('#booking_service').hide();
$('#booking_visit').hide();$('#booking_visit1').hide();

function show56()
{
	$('#booking_cat').hide();
	$('#booking_brand').hide();
	$('#booking_model').hide();
	$('#booking_subcat').hide();
	$('#booking_catsubcat').hide();
	$('#booking_visit').hide();
	$('#booking_visit1').hide();
	$('#booking_brk').show();
	
}
</script>

<script type="text/javascript">
$('#booking_brand').hide();
$('#booking_model').hide();
$('#booking_subcat').hide();
$('#booking_service').hide();
$('#booking_visit').hide();
$('#booking_visit1').hide();
function prev5()
{
	$('#booking_cat').hide();
	$('#booking_brand').hide();
	$('#booking_model').hide();
	$('#booking_subcat').hide();
	$('#booking_catsubcat').show();
	$('#booking_service').hide();
	
}
</script>
<script type="text/javascript">
$('#booking_brand').hide();
$('#booking_model').hide();
$('#booking_subcat').hide();
$('#booking_catsubcat').hide();
function prev10()
{
	$('#booking_cat').hide();
	$('#booking_brand').hide();
	$('#booking_model').hide();
	$('#booking_subcat').show();
	$('#booking_catsubcat').hide();
	$('#booking_brk').hide();
}
</script>
<script type="text/javascript">
$('#booking_brand').hide();
$('#booking_model').hide();
$('#booking_subcat').hide();
$('#booking_catsubcat').hide();
function prev11()
{
	var subcat_id = $('input[name=subcategory_id]:checked').next().val();
	if(subcat_id == 1)
	{
		$('#booking_cat').hide();
		$('#booking_brand').hide();
		$('#booking_model').hide();
		$('#booking_subcat').hide();
		$('#booking_catsubcat').hide();
		$('#booking_visit').hide();
		$('#booking_visit1').hide();
		$('#booking_brk').show();
	}
	else
	{
		$('#booking_cat').hide();
		$('#booking_brand').hide();
		$('#booking_model').hide();
		$('#booking_subcat').hide();
		$('#booking_visit').hide();
		$('#booking_visit1').hide();
		$('#booking_catsubcat').show();
		
	}
}
</script>

<script type="text/javascript">
$('#booking_brand').hide();
$('#booking_model').hide();
$('#booking_subcat').hide();
$('#booking_catsubcat').hide();
$('#booking_service').hide();
$('#booking_visit').hide();
$('#booking_visit1').hide();
$('#booking_brk').hide();
$('#booking_summary').hide();
function show6()
{
	$('#booking_cat').hide();
	$('#booking_brand').hide();
	$('#booking_model').hide();
	$('#booking_subcat').hide();
	$('#booking_catsubcat').hide();
	$('#booking_service').hide();
	$('#booking_brk').hide();
	$('#booking_visit1').show();
	
}
</script>

<script type="text/javascript">
$('#booking_brand').hide();
$('#booking_model').hide();
$('#booking_subcat').hide();
$('#booking_catsubcat').hide();
$('#booking_service').hide();
$('#booking_visit').hide();
$('#booking_visit1').hide();
$('#booking_summary').hide();
function prev6()
{
	$('#booking_cat').hide();
	$('#booking_brand').hide();
	$('#booking_model').hide();
	$('#booking_subcat').hide();
	$('#booking_catsubcat').hide();
	$('#booking_service').show();
	$('#booking_visit').hide();
	
}
</script>

<script type="text/javascript">
$('#booking_brand').hide();
$('#booking_model').hide();
$('#booking_subcat').hide();
$('#booking_catsubcat').hide();
$('#booking_service').hide();
$('#booking_visit').hide();
$('#booking_visit1').hide();
$('#booking_summary').hide();
function show7()
{
	var subcat_id1 = $('input[name=subcategory_id]:checked').next().val();
	//alert(subcat_id1);
	if(subcat_id1 == undefined)
	{
      var subcat_id=$('#subsub').val();
    //  alert(subcat_id);
	}
	else
	{
		var subcat_id=subcat_id1;
	}
	if(subcat_id == 1)
	{
	var t ='Break down';
	}
	if(subcat_id == 2)
	{
		var t ='Pick and drop';
	}
	if(subcat_id == 3)
	{
		var t ='Doorstep Service';
	}
	
	if($('#visit_date123').val()=='' || $('#visit_time123').val()=='' || $('#flat123').val()=='' || $('#landmark123').val()=='')
	{
		alert("Please fill all the details");
	}
	else
	{
	$('#booking_cat').hide();
	$('#booking_brand').hide();
	$('#booking_model').hide();
	$('#booking_subcat').hide();
	$('#booking_catsubcat').hide();
	$('#booking_service').hide();
	$('#booking_visit').hide();
	$('#booking_visit1').hide();
	$('#booking_summary').show();
	//$("#myLogin").modal("show");
	var mob=$('#mobile123').val();
	document.getElementById('label4').innerHTML ='+91'+'-'+mob;
	var land=$('#landmark123').val();
	//document.getElementById('label2').innerHTML =land;
	// var catnm = document.getElementById("pname").innerHtml;
	//alert(document.getElementById("pname").innerHtml);
	document.getElementById('label3').innerHTML =t;
	var a=$('#visit_date123').val();
	var time=$('#visit_time123').val();
	document.getElementById('label1').innerHTML = a + ' between ' + time;
	/*var dateFormat = require('dateformat');
	alert(dateFormat);
	var b=dateFormat(a, " dS mmmm , yyyy dddd");
	alert(b);*/
	}
}
</script>

<script type="text/javascript">
$('#booking_brand').hide();
$('#booking_model').hide();
$('#booking_subcat').hide();
$('#booking_catsubcat').hide();
$('#booking_service').hide();
$('#booking_visit').hide();
$('#booking_visit1').hide();
$('#booking_summary').hide();
function show777()
{
	var subcat_id1 = $('input[name=subcategory_id]:checked').next().val();
	//alert(subcat_id1);
	if(subcat_id1 == undefined)
	{
      var subcat_id=$('#subsub').val();
    //  alert(subcat_id);
	}
	else
	{
		var subcat_id=subcat_id1;
	}
	if(subcat_id == 1)
	{
	var t ='Break down';
	}
	if(subcat_id == 2)
	{
		var t ='Pick and drop';
	}
	if(subcat_id == 3)
	{
		var t ='Doorstep Service';
	}
	
	if($('#visit_date').val()=='' || $('#visit_time').val()=='' || $('#flat').val()=='' || $('#landmark').val()=='')
	{
		alert("Please fill all the details");
	}
	else
	{
	$('#booking_cat').hide();
	$('#booking_brand').hide();
	$('#booking_model').hide();
	$('#booking_subcat').hide();
	$('#booking_catsubcat').hide();
	$('#booking_service').hide();
	$('#booking_visit').hide();
	$('#booking_visit1').hide();
	$('#booking_summary').show();
	//$("#myLogin").modal("show");
	var mob=$('#mobile').val();
	document.getElementById('label4').innerHTML ='+91'+'-'+mob;
	var land=$('#landmark').val();
	//document.getElementById('label2').innerHTML =land;
	// var catnm = document.getElementById("pname").innerHtml;
	//alert(document.getElementById("pname").innerHtml);
	
	document.getElementById('label3').innerHTML =t;
	var a=$('#visit_date').val();
	var time=$('#visit_time').val();
	document.getElementById('label1').innerHTML = a + ' between ' + time;
	/*var dateFormat = require('dateformat');
	alert(dateFormat);
	var b=dateFormat(a, " dS mmmm , yyyy dddd");
	alert(b);*/
	}
	
}
</script>


<script type="text/javascript">
$('#booking_brand').hide();
$('#booking_model').hide();
$('#booking_subcat').hide();
$('#booking_catsubcat').hide();
$('#booking_service').hide();
$('#booking_visit').hide();
$('#booking_visit1').hide();
$('#booking_brk').hide();
$('#booking_summary').hide();
function show9()
{
	var subcat_id1 =$('input[name=subcategory_id]:checked').next().val();
	//alert(subcat_id1);
	if(subcat_id1 == undefined)
	{
      var subcat_id=$('#subsub').val();
    //  alert(subcat_id);
	}
	else
	{
		var subcat_id=subcat_id1;
	}
	if(subcat_id == 1)
	{
	var t ='Break down';
	}
	if(subcat_id == 2)
	{
		var t ='Pick and drop';
	}
	if(subcat_id == 3)
	{
		var t ='Doorstep service';
	}
	if($('#landmark2').val()=='')
	{
		alert("Please fill the landmark");
	}
	else
	{
	$('#booking_cat').hide();
	$('#booking_brand').hide();
	$('#booking_model').hide();
	$('#booking_subcat').hide();
	$('#booking_catsubcat').hide();
	$('#booking_service').hide();
	$('#booking_visit').hide();
	$('#booking_visit1').hide();
	$('#booking_brk').hide();
	$('#booking_summary').show();
	//$("#myLogin").modal("show");
	$('#landmark').val(land);
	var mob=$('#mobile2').val();
	document.getElementById('label4').innerHTML ='+91'+'-'+mob;
	var land=$('#landmark2').val();
	//document.getElementById('label2').innerHTML =land;
	var a=$('#visit_date2').val();
	//var time=$('#visit_time123').val();
	document.getElementById('label1').innerHTML = a;
	
	document.getElementById('label3').innerHTML =t;
	}
}
</script>

<script type="text/javascript">
$('#booking_brand').hide();
$('#booking_model').hide();
$('#booking_subcat').hide();
$('#booking_catsubcat').hide();
$('#booking_service').hide();
$('#booking_visit').hide();
$('#booking_visit1').hide();
$('#booking_summary').hide();
function prev7()
{
	var subcat_id1 = $('#subsub').val();
	//alert(subcat_id1);
	if(subcat_id1=='')
	{
       var subcat_id=$('input[name=subcategory_id]:checked').next().val();
	}
	else
	{
		var subcat_id = $('#subsub').val();
	}
	if(subcat_id == 1)
	{
		$('#booking_cat').hide();
		$('#booking_brand').hide();
		$('#booking_model').hide();
		$('#booking_subcat').hide();
		$('#booking_catsubcat').hide();
		$('#booking_service').hide();
		$('#booking_visit').hide();
		$('#booking_visit1').hide();
		$('#booking_summary').hide();
		$('#booking_brk').show();
	}
	else
	{
	$('#booking_cat').hide();
	$('#booking_brand').hide();
	$('#booking_model').hide();
	$('#booking_subcat').hide();
	$('#booking_catsubcat').hide();
	$('#booking_service').hide();
	$('#booking_visit').show();
	$('#booking_visit1').hide();
	$('#booking_brk').hide();
	$('#booking_summary').hide();
	}
}
</script>

<script>
/*var nowDate = new Date();
var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
$.fn.datepicker.defaults.format = "dd-mm-yyyy";
$.fn.datepicker.defaults.startDate = today;*/
/*$('#visit_date').datepicker().on('changeDate', function(e) {
	//$('#addorder').bootstrapValidator('revalidateField', 'item[pickup_date]');4
   $.get(base_url+'delivery_dates',{date:$(this).val()},function(data){
   $("#visit_time").html(data);
      });
});*/

$('#visit_date').datepicker({
	 autoclose: true
 }).on('changeDate', function(e){
	  $.get(base_url+'delivery_dates',{date:$(this).val()},function(data){
		   $("#visit_time").html(data);
		      });
 });

$('#visit_date123').datepicker({
	 autoclose: true
  }).on('changeDate', function(e){
	  $.get(base_url+'delivery_dates',{date:$(this).val()},function(data){
		   $("#visit_time123").html(data);
		      });
  });
  

/*$('#addorder').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('div.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
    		'mobile': {
            validators: {
            	notEmpty: {
                    message: 'The Mobile is required and cannot be empty'
                },
                regexp: {
                    regexp: '^[7-9][0-9]{9}$',
                    message: 'Invalid Mobile Number'
                }
            }
        },
        'name': {
            validators: {
                notEmpty: {
                    message: 'Name is required and cannot be empty'
                }
            }
        },
        'email': {
            validators: {
            	notEmpty: {
                    message: 'The Email is required and cannot be empty'
                },
                regexp: {
                    regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                    message: 'The value is not a valid email address'
                }
            }
        },
     
        'areaid': {
            validators: {
                notEmpty: {
                    message: 'Area Name is required and cannot be empty'
                }
            }
        },
        
    }
}).on('success.form.bv', function(event,data) {
	 Prevent form submission
	event.preventDefault();
	addBooking();
});*/

function addBooking() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'booking/add',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#addorder').ajaxSubmit(options);
}

function showAddRequest(formData, jqForm, options){
	$("#response").hide();
	ajaxindicatorstart("Please hang on.. while we add order ..");
   	var queryString = $.param(formData);
	return true;
}
   	
function showAddResponse(resp, statusText, xhr, $form){
	ajaxindicatorstop();
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
        window.location.href = base_url;
  	}
}


</script>

<script>
var catsubcatvals = [];
$('#catsubcat123 :checked').each(function () {
	  catsubcatvals.push($(this).val());
});
//alert(catsubcatvals);

$('#otp_btn').on('click', function () {
	  if ($('#password1').val() == $('#password11').val()) {
	    $('.message').html('').css('color', 'green');
	  } else {
	    $('.message').html('Passwords do not match').css('color', 'red');
	    return false;
	  }
	});
$('#su_sign_frm').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
   excluded: ':disabled',
    fields: {
    	name1: {
            validators: {
                notEmpty: {
                    message: 'First Name is required and cannot be empty'
                }
            }
        },
        name11: {
            validators: {
                notEmpty: {
                    message: 'Last Name is required and cannot be empty'
                }
            }
        }, 
        email1: {
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
        mobile1: {
            validators: {
                notEmpty: {
                    message: 'The Mobile is required.'
                },
                regexp: {
                    regexp: '^[7-9][0-9]{9}$',
                    message: 'Invalid Mobile Number'
                }
            }
        },
        password1: {
            validators: {
                notEmpty: {
                    message: 'Password is required and cannot be empty'
                },
                stringLength: {
                    max: 25,
                    min: 6,
                    message: 'Password must be 6 characters or longer.'
                }
               /* identical: {
                    field: 'su_password_confirm',
                    message: 'Passwords do not match.'
                }*/
            }
        },
        password11: {
            validators: {
            	notEmpty: {
                    message: 'Password is required and cannot be empty'
                },
                stringLength: {
                    max: 25,
                    min: 6,
                    message: 'Password must be 6 characters or longer.'
                },
                identical: {
                    field: 'password',
                    message: 'Passwords do not match.'
                }
            }
        },
    }
}).on('success.form.bv', function(event,data) {
	event.preventDefault();
	userSignUp();
});

function userSignUp(){
//	alert("inside");
	/*if($('#name1').val() =='' || $('#name11').val()=='' || $('#email1').val()=='' || $('#mobile1').val()=='' || $('#password1').val()=='' || $('#password11').val()=='')
	{
		alert("Please fill all details");
	}
	else
	{
	if($('#password1').val() != $('#password11').val())
	{
		alert("Password and Confirm Password is not match");
	}
	else
	{*/
		$.post(base_url+"register", { mobile: $("#mobile1").val(),fname: $("#name1").val(),lname: $("#name11").val(),email: $("#email1").val(),password: $("#password1").val(),referal_code : $("#referal_code").val()}, function(data){
		/*if(data.is_register == 1) {
			$("#otp_response1").show();
			$("#otp_response1").html("Please enter the verification code sent to your mobile number to proceed.");
			$("#myModal").modal("hide");
			$("#myOtp").modal("show");
			$("#lg_uid").val(data.id);
		} else {*/
			if(data.status==0)
			{
			  if(data.refstatus == 1){
				  $("#otp_response1").show();
				  $("#otp_response1").html("Please enter the verification code sent to your mobile number to proceed.");
				  $("#myModal").modal("hide");
				  $("#myOtp").modal("show");
				  $("#lg_uid").val(data.id);
				  $("#lg_email").val(data.email);
			  }else{
				  $("#ref_code").show();
				  $("#ref_code").html(data.msg);
				  $("#otp_btn").attr('disabled',false);
			  }
			}
			else
			{
			alert("Mobile already registered");
			//ajaxindicatorstop();
			$("#myModal").modal("hide");
			$("#myLogin").modal("show");
			$("#otp_response").show();
			$("#otp_response").html(data.msg);
			}
		//}
	},'json');
//}
//}
}

$('#otp_frm1').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
    	lg_otp: {
            validators: {
                notEmpty: {
                    message: 'OTP is required and cannot be empty'
                }
            }
        }, 
    }
}).on('success.form.bv', function(event,data) {
	event.preventDefault();
	userOTP();
});

function userOTP(){
	//ajaxindicatorstart("Please wait.. while we submit your query...");
	//$.get(base_url+"otpreg/"+$("#lg_uid").val()+"/"+$("#lg_otp").val(), { }, function(data){
	var catsubcatvals = [];
$('#catsubcat123 :checked').each(function () {
	  catsubcatvals.push($(this).val());
});
		$.post(base_url+"otpreg", { id: $("#lg_uid").val(),otp: $("#lg_otp").val(),category_id: $('input[name=category_id]:checked').val(),brand_id: $('input[name=brand_id]:checked').val(),model_id: $('input[name=model_id]:checked').val(),subcategory_id: $('input[name=subcategory_id]:checked').next().val(),subcategory_id1: $('input[name=subcategory_id]:checked').val(),catsubcat_id: catsubcatvals }, function(data){
			//alert(data.mobile);
		if(data.status == 1) {
			//ajaxindicatorstop();
			$('#booking_catsubcat').hide();
			$("#myOtp").modal("hide");
			var subcat_id = $('input[name=subcategory_id]:checked').next().val();
			if(subcat_id== 1)
			{
				//$('#booking_brk').show();
				$('#booking_subcat').show();
				$("#myLogin").modal("show");
				$("#mobile").val(data.mobile);
				$("#userid").val(data.id);
			}
			else
			{
				//$('#booking_visit').show();
				$('#booking_catsubcat').show();
				$("#myLogin").modal("show");
				$("#mobile").val(data.mobile);
				$("#userid").val(data.id);
			}
			if(data.session == 1){
				window.location =  base_url+"booking" ;
				$('#booking_visit').show();
				}
		} else {
			//ajaxindicatorstop();
			$("#otp_response1").show();
			$("#otp_response1").html(data.msg);
			//alert(data.msg);
		}
	},'json');
}

$('#lg_login_frm').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
   excluded: ':disabled',
    fields: {
        lg_mobile: {
            validators: {
                notEmpty: {
                    message: 'The Mobile is required.'
                },
                regexp: {
                    regexp: '^[7-9][0-9]{9}$',
                    message: 'Invalid Mobile Number'
                }
            }
        },
        lg_pwd: {
            validators: {
                notEmpty: {
                    message: 'Password is required and cannot be empty'
                }
            }
        },
    }
}).on('success.form.bv', function(event,data) {	event.preventDefault();	userLogin();});

function userLogin(){
	//ajaxindicatorstart("Please wait.. while we submit your query...");
	//$.get(base_url+"otpreg/"+$("#lg_uid").val()+"/"+$("#lg_otp").val(), { }, function(data){
	/*if($('#lg_mobile').val() =='' || $('#lg_pwd').val()=='')
	{
		alert("Please fill all details");
	}
	else
	{*/
		var catsubcatvals = [];
	$('#catsubcat123 :checked').each(function () {
		  catsubcatvals.push($(this).val());
	});
		$.post(base_url+"userlogin", { mobile: $("#lg_mobile").val(),password: $("#lg_pwd").val(),category_id: $('input[name=category_id]:checked').val(),brand_id: $('input[name=brand_id]:checked').val(),model_id: $('input[name=model_id]:checked').val(),subcategory_id: $('input[name=subcategory_id]:checked').next().val(),subcategory_id1: $('input[name=subcategory_id]:checked').val(),catsubcat_id: catsubcatvals }, function(data){

			if(data.is_verify==1)
			{
				//$("#lg_response").show();
				//$("#lg_response").html(data.msg);
				alert(data.msg);
				$("#myLogin").modal("hide");
				$("#myModal").modal("show");
			}
			else{ 
				if(data.status == 1 && data.otp_verify==1) {
					 $("#lg_response").html(data.msg);
					     $("#myLogin").modal("hide");
							var subcat_id = $('input[name=subcategory_id]:checked').next().val();
							//alert(subcat_id);
							if(subcat_id== 1)
							{
								//alert("inside");
								$('#booking_subcat').hide();
								$('#booking_brk').show();
								$("#mobile2").val(data.mobile);
								
							}
							else
							{
						    $('#booking_catsubcat').hide();
							$('#booking_visit').show();
							$("#name").val(data.name);
							$("#email").val(data.email);
							$("#mobile").val(data.mobile);
							$("#visit_date").val(data.pickup_date);
							$("#visit_time").val(data.slot);
							$("#flat").val(data.locality);
							$("#landmark").val(data.address);
						//	$("#loginid").val(data.id);
							
							}
							if(data.session == 1){
								window.location =  base_url+"booking" ;
								$('#booking_visit').show();
								}
					
				} 
				else if(data.status == 1 && data.otp_verify==0)
				{
					//alert("elseif");
					$("#lg_uid").val(data.id);
					$("#lg_email").val(data.email);
					$("#myLogin").modal("hide");
					$("#myOtp").modal("show");
					$("#otp_response1").show();
					$("#otp_response1").html("Please enter the verification code sent to your mobile number to proceed.");
					
				}
				else
				{
					//alert("else");
					$("#login_response").show();
					$("#login_response").html(data.msg);
					$("#lg_uid").val(data.id);
					//$("#myLogin").modal("hide");
					//$("#myOtp").modal("show");
					//$("#lg_response").show();
					//$("#lg_response").html(data.msg);
				}
			}



	},'json');
	//}
}
</script>
<script type="text/javascript">

$("#mobile1").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        //$( "#first_step" ).trigger( "mouseover" );
        //checkadd();
       // show1();
    }
});

function reg()
{
$("#myLogin").modal("hide");
$("#myModal").modal("show");
}

function showlogin()
{
	if($('#lg_mobile').val() =='' || $('#lg_pwd').val()=='')
	{
		alert("Please fill all details");
	}
	else
	{
		var catsubcatvals = [];
		$('#catsubcat123 :checked').each(function () {
			  catsubcatvals.push($(this).val());
		});
	$.post(base_url+"userlogin", { mobile: $("#lg_mobile").val(),password: $("#lg_pwd").val(),category_id: $('input[name=category_id]:checked').val(),brand_id: $('input[name=brand_id]:checked').val(),model_id: $('input[name=model_id]:checked').val(),subcategory_id: $('input[name=subcategory_id]:checked').next().val(),subcategory_id1: $('input[name=subcategory_id]:checked').val(),catsubcat_id: catsubcatvals }, function(data){

		if(data.is_verify==1)
		{
			//$("#lg_response").show();
			//$("#lg_response").html(data.msg);
			alert(data.msg);
			$("#myLogin").modal("hide");
			$("#myModal").modal("show");
		}
		else{ 
			if(data.status == 1 && data.otp_verify==1) {
				 $("#lg_response").html(data.msg);
				     $("#myLogin").modal("hide");
						var subcat_id = $('input[name=subcategory_id]:checked').next().val();
						//alert(subcat_id);
						if(subcat_id== 1)
						{
							//alert("inside");
							$('#booking_subcat').hide();
							$('#booking_brk').show();
							$("#mobile2").val(data.mobile);
							
						}
						else
						{
					    $('#booking_catsubcat').hide();
						$('#booking_visit').show();
						$("#name").val(data.name);
						$("#email").val(data.email);
						$("#mobile").val(data.mobile);
						$("#visit_date").val(data.pickup_date);
						$("#visit_time").val(data.slot);
						$("#flat").val(data.locality);
						$("#landmark").val(data.address);
					//	$("#loginid").val(data.id);
						
						}
						if(data.session == 1){
							window.location =  base_url+"booking" ;
							$('#booking_visit').show();
							}
				
			} 
			else if(data.status == 1 && data.otp_verify==0)
			{
				//alert("elseif");
				$("#lg_uid").val(data.id);
				$("#lg_email").val(data.email);
				$("#myLogin").modal("hide");
				$("#myOtp").modal("show");
				$("#otp_response1").show();
				$("#otp_response1").html("Please enter the verification code sent to your mobile number to proceed.");
				
			}
			else
			{
				//alert("else");
				$("#lg_uid").val(data.id);
				$("#myLogin").modal("hide");
				$("#myOtp").modal("show");
				$("#lg_response").show();
				$("#lg_response").html(data.msg);
			}
		}

},'json');
}
}

function showreg()
{
	if($('#name1').val() =='' || $('#name11').val()=='' || $('#email1').val()=='' || $('#mobile1').val()=='' || $('#password1').val()=='' || $('#password11').val()=='')
	{
		alert("Please fill all details");
	}
	else
	{
	if($('#password1').val() != $('#password11').val())
	{
		alert("Password and Confirm Password does not match");
	}
	else
	{
	$.post(base_url+"register", { mobile: $("#mobile1").val(),fname: $("#name1").val(),lname: $("#name11").val(),email: $("#email1").val(),password: $("#password1").val(),password1: $("#password11").val(),referal_code : $("#referal_code").val()}, function(data){
		/*if(data.is_register == 1) {
			$("#otp_response1").show();
			$("#otp_response1").html("Please enter the verification code sent to your mobile number to proceed.");
			$("#myModal").modal("hide");
			$("#myOtp").modal("show");
			$("#lg_uid").val(data.id);
		} else {*/
			if(data.status==0)
			{
				if(data.refstatus == 1) {
					$("#otp_response1").show();
					$("#otp_response1").html(data.msg);
					$("#myModal").modal("hide");
					$("#myOtp").modal("show");
					$("#lg_uid").val(data.id);
					$("#lg_email").val(data.email);
				}else{
					$("#ref_code").show();
					$("#ref_code").html(data.msg);
					$("#otp_btn").attr('disabled',false);
				}
			}
			else
			{
			alert("Mobile already registered");
			//ajaxindicatorstop();
			$("#myModal").modal("hide");
			$("#myLogin").modal("show");
			$("#otp_response").show();
			$("#otp_response").html(data.msg);
			}
		//}
	},'json');
	}
}
}

function showotp()
{
	
	var catsubcatvals = [];
	$('#catsubcat123 :checked').each(function () {
		  catsubcatvals.push($(this).val());
	});
	$.post(base_url+"otpreg", { id: $("#lg_uid").val(),otp: $("#lg_otp").val(),category_id: $('input[name=category_id]:checked').val(),brand_id: $('input[name=brand_id]:checked').val(),model_id: $('input[name=model_id]:checked').val(),subcategory_id: $('input[name=subcategory_id]:checked').next().val(),subcategory_id1: $('input[name=subcategory_id]:checked').val(),catsubcat_id: catsubcatvals }, function(data){
		//alert(data.mobile);
	if(data.status == 1) {
		//ajaxindicatorstop();
		$('#booking_catsubcat').hide();
		$("#myOtp").modal("hide");
		var subcat_id = $('input[name=subcategory_id]:checked').next().val();
		if(subcat_id== 1)
		{
			//$('#booking_brk').show();
			$('#booking_subcat').show();
			$("#myLogin").modal("show");
			$("#mobile").val(data.mobile);
			$("#userid").val(data.id);
		}
		else
		{
			//$('#booking_visit').show();
			$('#booking_catsubcat').show();
			$("#myLogin").modal("show");
			$("#mobile").val(data.mobile);
			$("#userid").val(data.id);
		}
		if(data.session == 1){
			window.location =  base_url+"booking" ;
			$('#booking_visit').show();
			}
	} else {
		$("#otp_response1").show();
		$("#otp_response1").html(data.msg);
	}
},'json');
}

function resendOtp() {
	//alert("hi");
$.post(base_url+"resendotp",{email: $("#lg_email").val()},function(data) {
		//alert(data.status);
		if(data.status == 1) {
			$("#signInModal1").modal("hide");
			$("#otp_response1").show();
			$("#otp_response1").html("Verification code has been resent to your mobile number.");
			//alert("Verification code sent to the you mobile number to proceed.");
		} else
		{
			$("#otp_response1").show();
			$("#otp_response1").html("Code not send");
			//alert("otp not send");
		}
	},'json');
}

$('#forget_frm').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
    	  forget_email: {
              validators: {
                  notEmpty: {
                      message: 'Email or Mobile is required and cannot be empty'
                  }
              }
          },
    }
}).on('success.form.bv', function(event,data) {
	event.preventDefault();
	resendPassword1();
});
function resendPassword1() {
	$.post(base_url+"resetpassword",{email: $("#forget_email").val()},function(data) {
		if(data.status == 1) {
			//alert("if");
			$("#myLogin").modal("hide");
			$("#uid").val(data.data['id']);
			$("#fogetModal").modal('hide');
			$("#fogetModal1").modal("show");
			//alert(data.msg);
			//window.location.href = base_url;
		} else {
			//alert("else");
			alert(data.msg);
		}
	},'json');
}

$('#forget_frm1').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
       new_password: {
            validators: {
                notEmpty: {
                    message: 'Password is required and cannot be empty'
                },
                identical: {
                    field: 'new_password1',
                    message: 'Passwords do not match.'
                }
            }
        },
        new_password1: {
            validators: {
            	notEmpty: {
                    message: 'Password is required and cannot be empty'
                },
                identical: {
                    field: 'new_password',
                    message: 'Passwords do not match.'
                }
            }
        },
    }
}).on('success.form.bv', function(event,data) {
	event.preventDefault();
	resetPassword1();
});
function resetPassword1() {
	$.post(base_url+"resetpassword1",{id: $("#uid").val(),password: $("#new_password").val()},function(data) {
		if(data.status == 1) {
			$("#fogetModal1").modal("hide");
			$("#myLogin").modal("show");
		} else {
			alert(data.msg);
		}
	},'json');
}

function otpLogin() {
	var a=$("#lg_mobile").val();

	if(a=='')
	{
       alert("Enter Mobile No");
	}
	else
	{
	$.post(base_url+"sendotp",{mobile: $("#lg_mobile").val()},function(data) {
			if(data.is_verify==0)
			{
				$("#myLogin").modal("hide");
				$("#myOtp").modal("show");
				$("#lg_uid").val(data.id);
				$("#lg_email").val(data.email);
				$("#otp_response1").show();
				$("#otp_response1").html("Please enter the verification code sent to your mobile number to proceed.");
			}
			else
			{ 
				$("#lg_response").show();
				$("#lg_response").html(data.msg);
			}
			 
			
	},'json');
	}
}

function checkCoupon() {
	//alert("inside");
	var subcat_id = $('input[name=subcategory_id]:checked').next().val();
	var category_id = $('input[name=category_id]:checked').val();
	var brand_id = $('input[name=brand_id]:checked').val();
	//alert(subcat_id);
	if(subcat_id==1)
	{
     
      if($("#visit_date1").val()== undefined)
      {
    	  var a= $("#label1").text();
    	  //alert(a);
    	  var p_date = a;
      }
      else
      {
    	  var p_date=$("#visit_date1").val();
      }
	}
	else
	{
	  var p_date=$("#visit_date").val();
	}

	if($("#coupon_code").val() == "") {
		alert("Please enter a coupon code.");
	} else {
		
		$.post("<?php echo base_url();?>applycpoupon",{coupon_code: $("#coupon_code").val(), order_date:p_date,email: '<?php echo $olouseremail;?>', category_id:category_id, brand_id:brand_id},function(data){
			/* $('#coupon_code').addClass('FieldError');
			$('#alert-coupon').html(data.msg);
            if(data.msg == 'Coupon is invalid.')
            {
          		$('#coupon_code').val('');
            } */
            if(data.status == 1){
				//alert(data.coupon.category_id);
				//alert(data.coupon.brand_id);
				//$('#coupon_code').addClass('FieldError');
				//$('#alert-coupon').html(data.msg);
				if(data.coupon.category_id == category_id && data.coupon.brand_id == brand_id){
					$('#coupon_code').addClass('FieldError');
					$('#alert-coupon').html(data.msg);
				}else{
					$('#coupon_code').val('');
					$('#alert-coupon').html("Coupon code not valid for this category and brand");
				}
            }else{
            	$('#alert-coupon').html(data.msg);
            	$('#coupon_code').val('');
            }
            
			$('#alert-coupon').css('color','#ff0000');
		},'json');
	}
}

function myFunction()
{
	var a= $("#mobile2").val();
	if(a.length != 10) {
	  alert("Phone number must be 10 digits.");
	  $('#mobile2').val('');
	 }
}

function myFunction1()
{
	var a= $("#mobile3").val();
	if(a.length != 10) {
	  alert("Phone number must be 10 digits.");
	  $('#mobile3').val('');
	 }
}

function checkWallet(option){
	 var balance ="<?php echo $balance[0]['amount'];?>";
	 //var option = $("#option").val();
	   $(option).attr('checked', 'checked');
		if(option=="credits"){
			$("#coupon_code").val('');
			$("#coupon_code").attr("readonly", true);
		}else {
			$("#coupon_code").attr("readonly", false);
			$("#coupon_code").focus();
			}
	 }

</script>
