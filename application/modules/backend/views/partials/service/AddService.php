<form id="addservice" name="addservice" action="" method="post"	enctype="multipart/form-data">	
	<input type="hidden" name="vendor_id" value="<?php echo $vendor_id;?>" />
	<div id="basic" class="tab-pane fade in active">	
		<div class="row">		
			<div class="col-lg-12">		
				<div class="panel panel-default">				
					<div class="panel-body">					
						<div class="row">					
							<div class="col-md-6">		
								<div class="form-group" id="error-name">	
									<label class="control-label">Category Type<span class='text-danger'>*</span></label>				
									<select name="category_id" id="category_id_service"	class="form-control">				
										<option value="">Select Category Type</option>
										<?php foreach ($categories as $category) { ?>
											<option value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option>
										<?php } ?>
									</select>								
								</div>								
								<div class="messageContainer"></div>
							</div>
							<div class="col-md-6">				
								<div class="form-group" id="error-name">			
									<label class="control-label">Brand<span class='text-danger'>*</span></label>
									<select name="brand_id" id="brand_id_service" class="form-control">			
										<option value="">Select Brand</option>	
										<?php
										/*
										 * print_r($subcategories[0]);?>
										 *
										 * <?php foreach ($subcategories[0] as $category) { ?> <option value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option> <?php }
										 */
										?>
									</select>								
								</div>	
								<div class="messageContainer"></div>
							</div>	
						</div>	
						<div class="row">	
							<div class="col-md-6">
								<div class="form-group" id="error-name">
									<label class="control-label">Model<span class='text-danger'>*</span></label>
									<select name="model_id" id="model_id_service" class="form-control">
										<option value="">Select Model</option>	
									</select>	
								</div>	
								<div class="messageContainer"></div>	
							</div>	
							<div class="col-md-6">	
								<div class="form-group" id="error-name">	
									<label class="control-label">Service Type<span class='text-danger'>*</span></label> 
									<select	name="subcategory_id" id="subcategory_id" class="form-control">
										<option value="">Select Service Type</option>
										<?php foreach ($servicetype as $value) { ?>
											<option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
										<?php } ?>
									</select>	
								</div>
								<div class="messageContainer"></div>	
							</div>	
						</div>
						<div class="row">

							<div class="col-md-6">	
								<div class="form-group" id="error-name">	
									<label class="control-label">Service Group<span class='text-danger'>*</span></label>
									<select	name="catsubcat_id" id="catsubcat_id" class="form-control">
										<option value="">Select Service Group</option>
										<?php foreach ($servicegroup as $value) { ?>
											<option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="messageContainer"></div>
							</div>
							<div class="col-md-6">		
								<div class="form-group" id="error-name">	
									<label class="control-label">Service Name <span	class='text-danger'>*</span></label>
									<input type="text"	class="form-control" id="name" name="name" />
								</div>								
								<div class="messageContainer"></div>					
							</div>							
							<div class="col-md-6">			
								<div class="form-group" id="error-image">		
									<label class="control-label ">Upload Image (80 X 80 px) </label>
									<input type="file"	value="" name="image" id="image" class="form-control ">				
								</div>							
								<div class="messageContainer col-sm-4"></div>				
							</div>							
							<div class="col-md-6">				
								<div class="form-group" id="error-name">							
									<label class="control-label">Status <span class='text-danger'>*</span></label>								
									<select id="status" class="form-control" name="status">									
										<option value="1">Enable</option>								
										<option value="0">Disable</option>			
									</select>		
								</div>						
								<div class="messageContainer"></div>	
							</div>		
							<div class="col-md-6">	
								<div class="form-group" id="error-name">
									<label class="control-label">Price<span class='text-danger'>*</span></label>	
									<input type="text" class="form-control" id="price" name="price" />
								</div>							
								<div class="messageContainer"></div>				
							</div>	
							<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Tax Inclusive<span class='text-danger'></span></label>
										<select id="tax_inclusive_service" class="form-control" name="tax_inclusive">
												<option value="1">Yes</option>
												<option value="0">No</option>
											</select>
										</div>
										<div class="messageContainer"></div>
							</div>
							<div class="col-md-6">
								<div class="form-group" id="tax_value_service">					
									<label class="control-label">Tax </label>	
									<input type="text" class="form-control" id="tax_service" name="tax" />			
								</div>							
								<div class="messageContainer"></div>	
							</div>					
						
						</div>						
						<div class="text-center">	
							<div id="response_service"></div>
							<button type="button" class="btn btn-info" onclick="goto_service()">Go to service list</button>&emsp;	
							<button type="submit" class="btn btn-success">Submit</button>		
							<br>				
						</div>				
					</div>		
				</div>		
			</div>	  
		</div>	
	</div>
</form>

<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script><script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script>

	$(document).ready(function(){    
		
		$("#category_id_service").change(function() 
		{

			ajaxindicatorstart("Please hang on..");

			var cat_id =  $("#category_id_service").val();    
			//alert(cat_id);   
			console.log(cat_id);	    
			$.post(base_url+"admin/brandbycatid/", {cat_id : cat_id}, function(data)
			{
				ajaxindicatorstop();
				
				$('#brand_id_service').empty();
				$('#brand_id_service').append("<option value=''>"+'Select Brand'+"</option>");		    
				if(data.length > 0)
				{
					for( var i=0; i < data.length; i++)
					{		   			    
						$('#brand_id_service').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");			
					}	    
				} 
			},'json');   
		});

		$("#brand_id_service").change(function() 
		{
			ajaxindicatorstart("Please hang on..");

			var brand_id_service =  $('#brand_id_service').val();       
			console.log(brand_id_service);	    
			$.post(base_url+"admin/modelbybrandid/", {brand_id : brand_id_service}, function(data)
			{
					ajaxindicatorstop();

				$('#model_id_service').empty();$('#model_id_service').append("<option value=''>"+'Select Model'+"</option>");		    
				if(data.length > 0)
				{		    
					for( var i=0; i < data.length; i++)
					{		   			    
						$('#model_id_service').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");			
					}	    
				}	   
			},'json');   
		});

		/*$("#model_id_service").change(function() 
		{
			ajaxindicatorstart("Please hang on..");

			var model_id_service =  $('#model_id_service').val();       
			console.log(model_id_service);	    
			$.post(base_url+"admin/subcategorybycatid/", {model_id : model_id_service}, function(data)
			{
					ajaxindicatorstop();

				$('#subcategory_id').empty();$('#subcategory_id').append("<option value=''>"+'Select Service Type'+"</option>");
				if(data.length > 0)
				{		    
					for( var i=0; i < data.length; i++)
					{		   			    
						$('#subcategory_id').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");			
					}	    
				}	   
			},'json');   
		});*/

/*		$("#subcategory_id").change(function() 
		{
			ajaxindicatorstart("Please hang on..");

			var subcategory_id =  $('#subcategory_id').val();       
			console.log(subcategory_id);	    
			$.post(base_url+"admin/catsubcatbyid/", {subcat_id : subcategory_id}, function(data)
			{
					ajaxindicatorstop();

				$('#catsubcat_id').empty();$('#catsubcat_id').append("<option value=''>"+'Select Service Group'+"</option>");		    
				if(data.length > 0)
				{		    
					for( var i=0; i < data.length; i++)
					{		   			    
						$('#catsubcat_id').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");			
					}	    
				}	   
			},'json');   
		});*/
	}); 

	$('#addservice').bootstrapValidator({
		container: function($field, validator) {
			return $field.parent().next('.messageContainer');
		},
		feedbackIcons: {
			validating: 'glyphicon glyphicon-refresh'
		},
		excluded: ':disabled',
		fields: {
			name: {
				validators: {
					notEmpty: {
						message: 'Category Name is required and cannot be empty'
					}
				}
			},
			category_id: {
				validators: {
					notEmpty: {
						message: 'Category Name is required and cannot be empty'
					}
				}
			},
			brand_id: {
				validators: {
					notEmpty: {
						message: 'Brand Name is required and cannot be empty'
					}
				}
			},
			model_id: {
				validators: {
					notEmpty: {
						message: 'Model Name is required and cannot be empty'
					}
				}
			},
			subcategory_id: {
				validators: {
					notEmpty: {
						message: 'SubCategory Name is required and cannot be empty'
					}
				}
			},
			status: {
				validators: {
					notEmpty: {
						message: 'Status is required and cannot be empty'
					}
				}
			},
        /*image: {
            validators: {
                notEmpty: {
                    message: 'Image is required and cannot be empty'
                }
            }
        },*/
        price: {
        	validators: {
        		notEmpty: {
        			message: 'Price is required and cannot be empty'
        		},
                        regexp: {
                        regexp: '^[0-9]*[1-9]+[0-9]*$',
                        message: 'Invalid value'
                    }
                }
                
        }      
        
        /*tax: {            
        	validators: {                
        		notEmpty: {                    
        			message: 'Tax is required and cannot be empty'                
        		},
                        regexp: {
                        regexp: '^[0-9]*[1-9]+[0-9]*$',
                        message: 'Invalid value'
                    }            
        	}        
        }*/
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	addService();
});

function addService() {
	var options = {
		target : '#response_service', 
		beforeSubmit : showAddRequest_service,
		success :  showAddResponse_service,
		url : base_url+'admin/service/add',
		semantic : true,
		dataType : 'json'
	};
	$('#addservice').ajaxSubmit(options);
}

function showAddRequest_service(formData, jqForm, options){
	$("#response").hide();
	var queryString = $.param(formData);
	return true;
}

function showAddResponse_service(resp, statusText, xhr, $form){
	if(resp.status == '0') {
		$("#response_service").removeClass('alert-success');
		$("#response_service").addClass('alert-danger');
		$("#response_service").html(resp.msg);
		$("#response_service").show();
		alert(resp.msg);
	} else {
		$("#response_service").removeClass('alert-danger');
		$("#response_service").addClass('alert-success');
		$("#response_service").html(resp.msg);
		$("#response_service").show();
		alert(resp.msg);
		// window.location.href = base_url+"admin/mainservice";
		// $("#Spare_li").trigger("click");
		goto_service();
	}
}
$(document).ready(function(){    
	$("#tax_inclusive_service").change(function() 
			{
		  	if($('#tax_inclusive_service').val() == 1){
		  		$('#tax_value_service').show();
		  		$('#tax_service').val('');
		  	} else {
		  		$('#tax_value_service').hide();
		  		$('#tax_service').val(0);
		  	} 
	  });
    }); 
</script>