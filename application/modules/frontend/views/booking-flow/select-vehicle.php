<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/booking-flow/common.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/my-profile/common.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/booking-flow/selectize.bootstrap3.css">
<script type="text/javascript" src="<?php echo asset_url();?>js/selectize.min.js"></script> 
<script type="text/javascript" src="<?php echo asset_url(); ?>js/bootstrapValidator.min.js"></script>
 <style type="text/css">
     .danger{
        color: red;
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
		<div class="select-brand">

			<div class="row">
				<div class="col-sm-6">
					<h3>Select Vehicle for service</h3><br/>
					<?php if(!empty($vehicalList)){ 
						foreach ($vehicalList as $key => $value) {  
					?>
					<div class="brand">
						<div class="radio">
						  <label><input type="radio" name="vehicle_no" id="vehicle_no"  data-model="<?php echo $value['model_id']?>" data-brand="<?php echo $value['brand_id']?>" value="<?php echo $value['id']; ?>"  <?php if($_SESSION['vehicle_no']==$value['id']){echo 'Checked' ; }?>> 
							<h4 id="vehicle_no_<?php echo $value['id']?>"><?php echo $value['vehicle_no'] ."(". $value['brandname']."-". $value['modelname'] .")"; ?></h4> 
						  </label>
						</div>
					</div>
					<?php } } ?> 
 
				</div>
				<div class="col-sm-6">
					<button type="button" class="add-vehicle-btn" id="add-vehicle" data-toggle="modal" data-target="#add-new-vehicle">+ Add New Vehicle</button>
				</div>
			</div>
		</div>
		<div class="confirm text-center">
			<button type="button" class="custom-btn1"  onclick="setPackages()">Continue</button>
		</div>
	</div>
</div>

<!-- add vehicle modal strats -->
<div class="modal fade" id="add-new-vehicle" role="dialog">
    <div class="modal-dialog add-new-add select-vehicle account-modal">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="text-center">Add new Vehicle</h4>
            </div>
            <div class="modal-body"> 
    			<form id="addvehical" name="addvehical" action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                            	<label>Vehicle Brand <span class='danger'>*</span></label>
                                <select name="brand_id" class="form-control custom-add" id="brand_id">
                                	 <option value=""> Select Brand </option>
                                        <?php foreach ($brands as $brand) { ?>
                                            <option value="<?php echo $brand['id']; ?>"><?php echo $brand['name']; ?></option>
                                        <?php }
                                        ?>
							    </select>  
                            </div>
                            <div class="messageContainer"></div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                            	<label>Vehicle Model <span class='danger'>*</span></label>
                                <select name="model_id" class="form-control custom-add" id="model_id">
                                	 <option value="">Select Model</option> 
							    </select> 
                            </div>
                            <div class="messageContainer"></div>
                        </div>
                         <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                            	<label>Vehicle No. <span class='danger'>*</span></label>
                                <input type="text" id="vehicle_no"  name="vehicle_no" placeholder="Vehicle No." class="form-control custom-input">
                            </div>
                             <div class="messageContainer"></div>
                        </div>
                        <!--  <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>License Number</label>
                                <input type="text" id="license_number"  name="license_number" placeholder="License number" class="form-control custom-input">
                            </div>
                             <div class="messageContainer"></div>
                        </div>
                         <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Insurance Bank</label>
                                <input type="text" id="insurance_brand"  name="insurance_brand" placeholder="Insurance Bank" class="form-control custom-input">
                            </div>
                             <div class="messageContainer"></div>
                        </div>
                         <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Insurance Number</label>
                                <input type="text" id="insurance_number"  name="insurance_number" placeholder="Insurance Number" class="form-control custom-input">
                            </div>
                             <div class="messageContainer"></div>
                        </div> -->


                    </div>
                    <div class="form-group text-center">
                        <button class="custom-btn1" type="submit" >Save</button>
                    </div>
                    <div id="response"></div> 
                </form>
            </div>
        </div>
    </div>
</div>
<!-- add vehicle modal ends -->


<!-- select-location -->
  <script>


  	$('#addvehical').bootstrapValidator({
        container: function ($field, validator) {
            return $field.parent().next('div.messageContainer');
        },
        feedbackIcons: {
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {  
            
            'brand_id': {
                validators: {
                    notEmpty: {
                        message: 'Brand is required and cannot be empty'
                    }
                }
            },
            'model_id': {
                validators: {
                    notEmpty: {
                        message: 'Model is required and cannot be empty'
                    }
                }
            },
            'vehicle_no': {
                validators: {
                    notEmpty: {
                        message: 'Vehical Number is required and cannot be empty'
                    }
                }
            }

        }
    }).on('success.form.bv', function (event, data) {
        // Prevent form submission
        event.preventDefault();
        addVehical();
    }); 

    function addVehical() { 
        var options = {
            target: '#response',
            beforeSubmit: showAddRequest,
            success: showAddResponse,
            url: base_url + 'add-vehical',
            semantic: true,
            dataType: 'json'
        };
        $('#addvehical').ajaxSubmit(options);
    }

    function showAddRequest(formData, jqForm, options) {
        $("#response").hide();
        ajaxindicatorstart("Please hang on.. while we add vehical ..");
        var queryString = $.param(formData);
        return true;
    }

    function showAddResponse(resp, statusText, xhr, $form) {
        ajaxindicatorstop();
        //alert(resp.msg);
        
        if (resp.status == '0') {
            swal('',resp.msg,'warning');
            $("#response").removeClass('alert-success');
            $("#response").addClass('alert-danger');
            $("#response").html(resp.msg);
            $("#response").show();
        } else {
            swal('',resp.msg,'success');
            $("#response").removeClass('alert-danger');
            $("#response").addClass('alert-success');
            $("#response").html(resp.msg);
            $("#response").show(); 
            setTimeout(function() {
            window.location.href = base_url + "select-vehicle";
           }, 2000);
            
        }
    } 


       $("#brand_id").selectize({});
       $("#modal_id").selectize({});


       $(document).ready(function(){  

    // $('#add-vehicle').hide(); 
    
        if($('#vehicle_no').val() == 0){ 
            $('#add-vehicle').trigger('click');
        }  
        else{   
             // $('#add-vehicle').hide();  
        }  
 
    });  

       $("#brand_id").change(function ()
        {
            var brand_id = $('#brand_id').val();
            console.log(brand_id);
            $('#model_id').html(''); 
            $.post(base_url + "admin/modelbybrandid1/", {brand_id: brand_id}, function (data)
            {
                $('#model_id').empty();
                $('#model_id').append("<option value=''>" + 'Select Model' + "</option>");
                if (data.length > 0)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#model_id').append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
                        // $('#model_id').append("</optgroup>");

                    }
                }
            }, 'json');
        });

    var userid= '<?php echo $_SESSION['olouserid']; ?>';  
    var vehicle_no= '<?php echo $_SESSION['vehicle_no']; ?>'; 
    var subcategory_id= '<?php echo $_SESSION['subcategory_id']; ?>';
 
	function setPackages(){ 

		vehicle_no = $("input[name='vehicle_no']:checked"). val();
		 
		var model_id = $("input[name='vehicle_no']:checked").data("model");
		var brand_id = $("input[name='vehicle_no']:checked").data("brand");
		  
		//alert(brand_id); 
                if(typeof(vehicle_no) == "undefined") {
                    swal('','Please select vehicle','warning');
                    return false;
                }
		$.post(base_url+'setVehical',{vehicle_no:vehicle_no,model_id:model_id,brand_id:brand_id,subcategory_id:subcategory_id},function(data){
	   			if(data.status==1){ 

   					if(userid!=""){	
   						window.location.href=base_url+'select-services'; 
   					}else{
   						$('#myLoginModal').modal('show');
   					} 
   			}
    	},'json');

	}

  </script>
<!-- select-location -->