<?php    
    $userid = $this->session->userdata('olouserid');  
?>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/booking-flow/common.css">
<div class="booking jumbotron">
	<div class="container">
		<div class="flex-box">
			<div class="flex-1">
                <div class="select-box active">
                    <img src="<?php echo asset_url();?>frontend/images/new-img/subcategoryname1w.png" alt="thankyou">
                    <h2><a href="<?= base_url()?>select-subcategory">Select Subcategory</a></h2>
                </div>
                 <div class="">
                    <?php if(!empty($_SESSION['subcategory_id']) ){

                        if ($_SESSION['subcategory_id']== 11) { ?>
                          
                             <h4 class="text-center">Breakdown </h4>
                      <?php } elseif ($_SESSION['subcategory_id']== 12) { ?>
                        
                         <h4 class="text-center">Pick-Up & Drop</h4>
                    <?php  }  elseif ($_SESSION['subcategory_id']== 13) { ?>
                             <h4 class="text-center">Doorstep</h4>

                    <?php }  ?>
                   
                    <?php }  ?>
                </div>
            </div>
            <div class="flex-1">
                <div class="select-box active">
                    <img src="<?php echo asset_url();?>frontend/images/new-img/modelselectbrandw.png" alt="thankyou">
                    <h2><a href="<?= base_url()?>select-vehicle">Select Vehicle</a></h2>
                </div>
                <div class="">
                    <h4 class="text-center"><?php echo $vehicle_number.'('. $vehicle_brand.'-'.$vehicle_model.')'; ?></h4>
                </div>
            </div>
			<div class="flex-1">
				<div class="select-box active">
					<img src="<?php echo asset_url();?>frontend/images/new-img/servicesandpackagesselectbrandw.png" alt="thankyou">
					<h2><a href="<?= base_url()?>select-services">Select Service or Packages</a></h2>
				</div>
			</div>
			<div class="flex-1">
				<div class="select-box">
					<img src="<?php echo asset_url();?>frontend/images/new-img/address-selectbrand.png" alt="thankyou">
					<h2>Select Address</h2>
				</div>
			</div>
		</div> 


		<!-- select service or package -->
		    <div class="select-service">
		    	<div class="display-inline">
		    		<button type="button" class="ser-btn btn1-spl">Services</button>
		    		<!-- <button type="button" class="ser-btn btn2-spl" onclick="window.location.href = '<?php echo base_url();?>select-package';">Packages</button> -->
		    		<button type="button" class="ser-btn btn2-spl" onclick="setCatsubcat1()" >Packages</button>
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
						  <label><input type="checkbox"  name="catsubcat_id[]" value="<?php echo $value['id']; ?>"  <?php if(in_array($value['id'], $_SESSION['catsubcat_id'])){echo 'Checked' ; }?>>
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
				<button type="button" class="custom-btn1" id="catsubcat_button" onclick="setCatsubcat()" >Continue</button>
			<?php }else{ ?>
				<button type="button" data-toggle="modal" data-target="#myLoginModal" class="custom-btn1">Continue</button>
			<?php } ?>
		</div>  
	</div>
</div> 
<script type="text/javascript"> 
var  catsubcat_id = [];  
//debugger;

var catsubcatList = '<?php echo json_encode($_SESSION['catsubcat_id']); ?>' ; 
var vehicle_no = '<?php echo json_encode($_SESSION['vehicle_no']); ?>' ; 

  if(catsubcatList!='""'){ 
 
	 	catsubcat_id= catsubcatList;   
		$('#catsubcat_button').removeAttr('disabled','false'); 
	} 




/********************brand select ****************************/   
  	


	function setCatsubcat1(){  

		 var val = [];
	        $(':checkbox:checked').each(function(i){
	          val[i] = $(this).val();
	        });

			$.post(base_url+'setCatsubcat',{catsubcat_id:val},function(data){
	   			if(data.status==1){
	   				window.location.href=base_url+'select-package';
	   			}
			},'json');

		} 

 	function setCatsubcat(){  
 	//debugger;  
 		 var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });
        //alert(val);
 		if (val.length == 0){
 			 		swal('','Please select Service','warning');

 		}else{ 

 			 
			  swal({
			  title: "Do you want to select package ?",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true, 
			  buttons: [ 'No', 'Yes' ]
			})
			.then((willDelete) => {
			  if (willDelete) { 
			  	$.post(base_url+'setCatsubcat',{catsubcat_id:val},function(data){
			   			if(data.status==1){
			   				window.location.href=base_url+'select-package';
			   			}
	    			},'json');

			  } else {
			     	 $.post(base_url+'setCatsubcat',{catsubcat_id:val},function(data){
			   			if(data.status==1){
			   				window.location.href=base_url+'select-address';
			   			}
	    			},'json');	
			     		
			  }
			});




 			
	   		/*$.post(base_url+'setCatsubcat',{catsubcat_id:val},function(data){
	   			if(data.status==1){
	   				window.location.href=base_url+'select-address';
	   			}
	    	},'json');*/


	   	}

 	}

/*************************brand select end **********************/  
</script> 