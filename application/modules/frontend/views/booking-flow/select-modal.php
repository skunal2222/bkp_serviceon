<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/booking-flow/common.css">
<div class="booking jumbotron">
	<div class="container">
		<div class="flex-box">
			<div class="flex-1">
				<div class="select-box">
					<img src="<?php echo asset_url();?>frontend/images/" alt="thankyou">
					<h2>Select Subcategory</h2>
				</div>
			</div>
			<div class="flex-1">
				<div class="select-box">
					<img src="<?php echo asset_url();?>frontend/images/" alt="thankyou">
					<h2>Select Brand</h2>
				</div>
			</div> 
			<div class="flex-1">
				<div class="select-box active">
					<img src="<?php echo asset_url();?>frontend/images/" alt="thankyou">
					<h2>Select Modal</h2>
				</div>
			</div>
			
			<div class="flex-1">
				<div class="select-box">
					<img src="<?php echo asset_url();?>frontend/images/" alt="thankyou">
					<h2>Select Problem Part</h2>
				</div>
			</div>
			<div class="flex-1">
				<div class="select-box">
					<img src="<?php echo asset_url();?>frontend/images/" alt="thankyou">
					<h2>Select Address</h2>
				</div>
			</div>
		</div>

		<div class="select-brand text-center" > 
			<div class="row spl-box">
				<?php if(!empty($modelList)){ 
						foreach ($modelList as $key => $value) {  
					?>
				<div class="col-sm">
					<div class="brand">
						<div class="radio">
						  <label><input type="radio" name="model_id" value="<?php echo $value['id']; ?>"  <?php if($_SESSION['model_id']==$value['id']){echo 'Checked' ; }?>>
							<?php echo $value['name']; ?>
						  </label>
						</div>
					</div>
				</div>  
			<?php } } ?>
			</div> 
		</div>  
		<div class="confirm text-center">
				<button type="button" class="custom-btn1" id="model_button" onclick="setModel()"  >Continue</button>
		</div>  
	</div>
</div>

<script type="text/javascript">  
	debugger;
var model_id= '<?php echo $_SESSION['model_id']; ?>';

if(model_id!=""){
	$('#model_button').removeAttr('disabled','false'); 
}
/********************brand select ****************************/ 
 	$(document).ready(function(){
			$("input[type='radio']"). click(function(){
  			  model_id = $("input[name='model_id']:checked"). val();
				if(model_id){
					$('#model_button').removeAttr('disabled','false');
	 			}
			});
  	}); 

 	function setModel(){   
 		if(model_id==""){
 			 		swal('','Please select Model','error');

 		}else{
	   		$.post(base_url+'setModel',{model_id:model_id},function(data){
	   			if(data.status==1){
	   				window.location.href=base_url+'select-services';
	   			}
	    	},'json');
	   	}

 	}

/*************************brand select end **********************/ 

</script>