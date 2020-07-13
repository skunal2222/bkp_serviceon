
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/booking-flow/common.css">
<style type="text/css">
	.brand{
  font-size: 25px;
  font-weight: normal;
  font-style: normal;
  font-stretch: normal;
  line-height: 1.28;
  letter-spacing: 1.3px;
  color: #000000;
}
</style>>
<div class="booking jumbotron">
	<div class="container">
		<div class="flex-box">
			<div class="flex-1">
				<div class="select-box" id="subcategory">
					<img src="<?php echo asset_url();?>frontend/images/" alt="Subcategory">
					<h2>Select Subcategory</h2>
				</div>
			</div>
			<div class="flex-1">
				<div class="select-box active" id="brand">
					<img src="<?php echo asset_url();?>frontend/images/" alt="Brand">
					<h2>Select Brand</h2>
				</div>
			</div>
			<div class="flex-1">
				<div class="select-box" id="model">
					<img src="<?php echo asset_url();?>frontend/images/" alt="Model">
					<h2>Select Modal</h2>
				</div>
			</div>
			
			<div class="flex-1">
				<div class="select-box" id="catsubcat">
					<img src="<?php echo asset_url();?>frontend/images/" alt="Problem">
					<h2>Select Problem Part</h2>
				</div>
			</div>
			<div class="flex-1">
				<div class="select-box" id="address">
					<img src="<?php echo asset_url();?>frontend/images/" alt="Address">
					<h2>Select Address</h2>
				</div>
			</div>
		</div> 
 		<div class="select-brand text-center" > 
			<div class="row spl-box">
				<?php if(!empty($brandList)){ 
						foreach ($brandList as $key => $value) {  
					?>
				<div class="col-sm">
					<div class="brand">
						<div class="radio">
						  <label><input type="radio" name="brand_id" value="<?php echo $value['id']; ?>" <?php if($_SESSION['brand_id']==$value['id']){echo 'Checked' ; }?>>
							<!-- <img src="<?php echo asset_url();?><?php echo $value['image']; ?>" alt="<?php echo $value['name']; ?>"  width="80px" height="80px"> -->
							<?php echo $value['name']; ?>	
						  </label>
						</div>
					</div>
				</div>  
			<?php } } ?>
			</div> 
		</div>  
		<div class="confirm text-center">
				<button type="button" class="custom-btn1" id="brand_button" onclick="setBrand()"  >Continue</button>
		</div>  
</div>
</div>

<script type="text/javascript">  

/********************brand select ****************************/ 
var brand_id= '<?php echo $_SESSION['brand_id']; ?>';
 
if(brand_id!=""){
	$('#brand_button').removeAttr('disabled','false'); 
}

	$(document).ready(function(){
			$("input[type='radio']"). click(function(){
  			  brand_id = $("input[name='brand_id']:checked"). val();
				if(brand_id){
					$('#brand_button').removeAttr('disabled','false');
	 			}
			});
  	}); 

 	function setBrand(){   
 		if(brand_id==""){
 			 		swal('','Please select Brand','error');

 		}else{
	   		$.post(base_url+'setBrand',{brand_id:brand_id},function(data){ 
	   			if(data.status==1){
	   				window.location.href=base_url+'select-model';
	   			}

	    	},'json'); 
	   	}
 	} 

/*************************brand select end **********************/  
</script>