<?php    
    $userid = $this->session->userdata('olouserid');  
?>
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
				<div class="select-box">
					<img src="<?php echo asset_url();?>frontend/images/" alt="thankyou">
					<h2>Select Modal</h2>
				</div>
			</div> 
			<div class="flex-1">
				<div class="select-box  active">
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
		<!-- select service or package -->
		    <div class="select-service">
		    	<div class="display-inline">
		    		<button type="button" class="ser-btn btn1-spl">Services</button>
		    		<button type="button" class="ser-btn btn2-spl" onclick="window.location.href = '<?php echo base_url();?>select-package';">Packages</button>
		    	</div>
		    </div>
		<div class="select-brand text-center" > 
			<div class="row spl-box">
				<?php if(!empty($catsubcatList)){ 
						foreach ($catsubcatList as $key => $value) {  
					?>
				<div class="col-sm">
					<div class="brand">
						<div class="checkbox">
						  <label><input type="checkbox" onclick="getValue(this.value)" name="catsubcat_id[]" value="<?php echo $value['id']; ?>"  <?php if(in_array($value['id'], $_SESSION['catsubcat_id'])){echo 'Checked' ; }?>>
							<?php echo $value['name']; ?>
						  </label>
						</div>
					</div>
				</div>  
			<?php } } ?>
			</div> 
		</div>  
		<div class="confirm text-center">
			<?php if($userid!=""){ ?>
				<button type="button" class="custom-btn1" id="catsubcat_button" onclick="setCatsubcat()" disabled="true">Continue</button>
			<?php }else{ ?>
				<button type="button" data-toggle="modal" data-target="#myLoginModal" class="custom-btn1">Continue</button>
			<?php } ?>
		</div>  
	</div>
</div> 
<script type="text/javascript"> 
var  catsubcat_id = [] ;  
var catsubcatList = '<?php echo json_encode($_SESSION['catsubcat_id']); ?>' ; 

  if(catsubcatList!=""){
	 	catsubcat_id= catsubcatList;   
		$('#catsubcat_button').removeAttr('disabled','false'); 
	} 

/********************brand select ****************************/   
  	function getValue(id){
   			if(id){
  					if(catsubcat_id.includes(id)){
  						catsubcat_id.pop(id); 
  					}else{
  						catsubcat_id.push(id);  
  					}
					$('#catsubcat_button').removeAttr('disabled','false');
			}
	 			
  	}

 	function setCatsubcat(){   
   		$.post(base_url+'setCatsubcat',{catsubcat_id:catsubcat_id},function(data){
   			if(data.status==1){
   				window.location.href=base_url+'select-address';
   			}
    	},'json');

 	}

/*************************brand select end **********************/  
</script> 