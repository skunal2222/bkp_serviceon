<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/booking-flow/common.css">
<style type="text/css">
.select-brand .spl-box{
    overflow: hidden;
}
.col-sm .brand .radio label{
  padding-left: 0px;
}
.col-sm .brand .radio input[type=radio]{
  position: relative;
}
</style>
<div class="booking jumbotron">
	<div class="container"> 
		<div class="flex-box">
			<div class="flex-1">
				<div class="select-box active">
					<img src="<?php echo asset_url();?>frontend/images/new-img/subcategoryname1w.png" alt="thankyou">
					<h2><a href="<?= base_url()?>select-subcategory">Select Subcategory</a></h2>
				</div>				
			</div>
 			<div class="flex-1">
				<div class="select-box">
					<img src="<?php echo asset_url();?>frontend/images/new-img/modelselectbrand.png" alt="thankyou">
					<h2>Select Vehicle</h2>
				</div>
			</div>
			<div class="flex-1">
				<div class="select-box">
					<img src="<?php echo asset_url();?>frontend/images/new-img/servicesandpackagesselectbrand.png" alt="thankyou">
					<h2>Select Service or Packages</h2>
				</div>
			</div>
			<div class="flex-1">
				<div class="select-box">
					<img src="<?php echo asset_url();?>frontend/images/new-img/address-selectbrand.png" alt="thankyou">
					<h2>Select Address</h2>
				</div>
			</div>
		</div>
		<!-- <div class="select-brand text-center" >  
			  <div class="row spl-box">
				<?php if(!empty($subcategoryList)){ 
                                        $arr = array('breakdown.png','pickup.png', 'doorstep.png');
                                         
						foreach ($subcategoryList as $key => $value) {  
					?>
				<div class="col-sm">
					<div class="brand">
						<div class="radio">
						  <label><input type="radio" name="subcategory_id" value="<?php echo $value['id']; ?>"  <?php if($_SESSION['subcategory_id']==$value['id']){echo 'Checked' ; }?>>
							<img src="<?php echo asset_url();?>images/<?= $arr[$key]?>" alt="<?php echo $value['name']; ?>"  width="80px" height="80px">
							<h2 id="subcat_<?php echo $value['id']?>"><?php echo $value['name'] ; ?></h2> 
						  </label>
						</div>
					</div>
				</div>  
			<?php } } ?>  
			</div> 
		</div>   -->

		<div class="select-brand text-center" >  
			  <div class="row spl-box">
				<?php if(!empty($subcategoryList)){ 
                                        $arr = array('breakdown.png','pickup.png', 'doorstep.png');
                                         
						   
					?>
				<div class="col-sm">
					<div class="brand">
						<div class="radio"> 
						  <label>
							<img src="<?php echo asset_url();?>images/subcategory/breakdown.png" alt="Breakdown"  width="40px" height="40px">
							<h2 id="subcat_11"> Breakdown </h2>  
						   <input type="radio" name="subcategory_id" id="subcategory_id" value="11">
						  </label>  
						</div>
					</div>
				</div>  
				<div class="col-sm">
					<div class="brand">
						<div class="radio">
						  <label>
							<img src="<?php echo asset_url();?>images/subcategory/pickn-drop-bdoc.png" alt="pickn-drop"  width="40px" height="40px">
							<h2 id="subcat_12"> Pick-Up & Drop </h2> 
							<input type="radio" name="subcategory_id" id="subcategory_id" value="12">
						  </label>  
						</div> 
					</div>
				</div> 
				<div class="col-sm">
					<div class="brand">
						<div class="radio">
						    <label> 
							<img src="<?php echo asset_url();?>images/subcategory/doorstep.png" alt="Doorstep"  width="40px" height="40px">
							<h2 id="subcat_13"> Doorstep </h2>  
						    <input type="radio" name="subcategory_id" id="subcategory_id" value="13">
						  </label>  
						</div>
					</div>
				</div> 
			<?php  } ?>  
			</div> 
		</div> 



		<div class="confirm text-center">
				<button type="button" class="custom-btn1" id="subcategory_button" onclick="setSubcategory()">Continue</button>
		</div>  
	</div>
</div>

<script type="text/javascript">  
var subcategory_id= '<?php echo $_SESSION['subcategory_id']; ?>';
var userid= '<?php echo $_SESSION['olouserid']; ?>';


if(subcategory_id!=""){
	$('#subcategory_button').removeAttr('disabled','false'); 
}

/********************brand select ****************************/  
 	$(document).ready(function(){
			$("input[type='radio']"). click(function(){
  			  subcategory_id = $("input[name='subcategory_id']:checked"). val();
				if(subcategory_id){
					$('#subcategory_button').removeAttr('disabled','false');
	 			}
			});
  	}); 

 	function setSubcategory(){ 

 	subcategory_id = $("input[name='subcategory_id']:checked"). val();	

 /*	if(subcategory_id== ""){
 		swal('','Please select subcategory','error');
 	} */ 
	 if(typeof(subcategory_id) == "undefined") {
            swal('','Please select subcategory','warning');
            return false;
        }
        else{ 
   		$.post(base_url+'setSub',{subcategory_id:subcategory_id},function(data){
	   			if(data.status==1){
 	   				subcat = $("#subcat_"+subcategory_id).text();  
					if(userid!=""){	
						window.location.href=base_url+'select-vehicle'; 
					}else{
						$('#myLoginModal').modal('show');
					} 
   			}
    	},'json');
   	}

 	}

/*************************brand select end **********************/   
</script>