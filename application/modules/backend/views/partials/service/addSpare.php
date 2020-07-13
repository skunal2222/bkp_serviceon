	<form id="addspare" name="addspare" action="" method="post" enctype="multipart/form-data">
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
											<select name="category_id" id="category_id_spares" class="form-control">
													<option value=""> Select Category Type </option>
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
											<select name="brand_id" id="brand_id_spares" class="form-control">
													<option value=""> Select Brand </option>													<?php /*print_r($subcategories[0]);?>
													<?php foreach ($subcategories[0] as $category) { ?>													     <option value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option>													<?php } */ ?>
											</select>
										</div>
										<div class="messageContainer"></div>
									</div>
								
                                </div>
                                <div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Model<span class='text-danger'>*</span></label>
											<select name="model_id" id="model_id_spares" class="form-control">
													<option value=""> Select Model</option>	
												</select>
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
												<div class="form-group" id="error-name">
											<label class="control-label">Service Type<span class='text-danger'>*</span></label>
											<select name="subcategory_id" id="subcategory_id_spares" class="form-control">
													<option value=""> Select Service Type</option>				<?php  //print_r($subcategories);?>
													<?php foreach ($servicetype as $category) { ?>			
														<option value="<?php echo $category['id'];?>"><?php echo $category['name'];?>
														</option>
													<?php }  ?>
											</select>
										</div>
										<div class="messageContainer"></div>
									</div>
								
                                </div>
								<div class="row">
									<!-- <div class="col-md-6">	
										<div class="form-group" id="error-name">	
											<label class="control-label">Service Group<span class='text-danger'>*</span></label> 
											<select	name="catsubcat_id" id="catsubcat_id_spares" class="form-control">
												<option value="">Select Service Group</option>
												<?php foreach ($servicegroup as $value) { ?>
													<option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
												<?php } ?>
											</select>								
										</div>							
										<div class="messageContainer"></div>	
									</div> -->
	                          		<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Spare Name <span class='text-danger'>*</span></label>
											<input type="text" class="form-control" id="name" name="name" />
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
		                              	<div class="form-group" id="error-image">
	                                       	<label class="control-label ">Upload Image (80 X 80 px) </label>
	                                       	<input type="file" value="" name="image" id="image" class="form-control " >
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
											<label class="control-label">Tax Inclusive<span class='text-danger'>*</span></label>
										<select id="tax_inclusive_spare" class="form-control" name="tax_inclusive">
												<option value="1">Yes</option>
												<option value="0">No</option>
											</select>
										</div>
										<div class="messageContainer"></div>
									</div>																	
									<div class="col-md-6">										
										<div class="form-group" id="tax_value_spare">										
										<label class="control-label">Tax<span class='text-danger'>*</span></label>					
										<input type="text" class="form-control" id="tax_spare" name="tax" />	
										</div>								
										<div class="messageContainer"></div> 
									</div> 
								</div>
							</div>	
								 <div class="text-center">
									<div id="response_spare"></div>
									<button type="button" class="btn btn-info" onclick="goto_spare()">Go to spare list</button>&emsp;
									<button type="submit" class="btn btn-success">Submit</button>
									<br>
								 </div>
							
						</div>
					</div>
				</div>
			</div>	
		</form>
		<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script>
$(document).ready(function(){    

		$("#category_id_spares").change(function() 
		{
			ajaxindicatorstart("Please hang on..");

			var cat_id =  $('#category_id_spares').val();       
				console.log(cat_id);	    
		 	$.post(base_url+"admin/brandbycatid/", {cat_id : cat_id}, function(data)
				  {
				ajaxindicatorstop();

			  	$('#brand_id_spares').empty();$('#brand_id_spares').append("<option value=''>"+'Select Brand'+"</option>");		    
			    	if(data.length > 0)
				   	{		    
				     	for( var i=0; i < data.length; i++)
					    {		   			    
				           	$('#brand_id_spares').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");
				       	}	    
		            }	   
               	},'json');   
           });

		$("#brand_id_spares").change(function() 
		{
			ajaxindicatorstart("Please hang on..");

			var brand_id_spares =  $('#brand_id_spares').val();       
			console.log(brand_id_spares);	    
		  	$.post(base_url+"admin/modelbybrandid/", {brand_id : brand_id_spares}, function(data)
			{

				ajaxindicatorstop();

			  	$('#model_id_spares').empty();$('#model_id_spares').append("<option value=''>"+'Select Model'+"</option>");		    
			   		if(data.length > 0)
				    {		    
				    	for( var i=0; i < data.length; i++)
					    {		   			    
				           	$('#model_id_spares').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");	
				        }	    
		            }	   
               },'json');   
           	});
    	}); 

		/*$("#model_id_spares").change(function() 
		{
			ajaxindicatorstart("Please hang on..");

			var model_id_spares =  $('#model_id_spares').val();       
			console.log(model_id_spares);	    
		  	$.post(base_url+"admin/subcategorybycatid/", {model_id : model_id_spares}, function(data)
			{
				ajaxindicatorstop();

			  	$('#subcategory_id_spares').empty();$('#subcategory_id_spares').append("<option value=''>"+'Select Service Type'+"</option>");		    
			   	if(data.length > 0)
			   	{		    
			     	for( var i=0; i < data.length; i++)
				    {		   			    
				    	$('#subcategory_id_spares').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");			
				    }
		        }	   
           	},'json');   
        });*/

/*		$("#subcategory_id_spares").change(function() 
		{
			ajaxindicatorstart("Please hang on..");

			var subcategory_id_spares =  $('#subcategory_id_spares').val();       
			console.log(subcategory_id_spares);	    
			$.post(base_url+"admin/catsubcatbyid/", {subcat_id : subcategory_id_spares}, function(data)
			{
					ajaxindicatorstop();

				$('#catsubcat_id_spares').empty();$('#catsubcat_id_spares').append("<option value=''>"+'Select Service Group'+"</option>");		    
				if(data.length > 0)
				{		    
					for( var i=0; i < data.length; i++)
					{		   			    
						$('#catsubcat_id_spares').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");			
					}	    
				}	   
			},'json');   
		});*/

$('#addspare').bootstrapValidator({
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
                    message: 'Spare Name is required and cannot be empty'
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
        }/*,
        catsubcat_id: {
            validators: {
                notEmpty: {
                    message: 'Service Group is required and cannot be empty'
                }
            }
        }*/,
       status: {
            validators: {
                notEmpty: {
                    message: 'Status is required and cannot be empty'
                }
            }
        },
       /* image: {
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
        },
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	addSpare();
});

function addSpare() {
	var options = {
	 		target : '#response_spare', 
	 		beforeSubmit : showAddRequest_spare,
	 		success :  showAddResponse_spare,
	 		url : base_url+'admin/spare/add',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#addspare').ajaxSubmit(options);
}

function showAddRequest_spare(formData, jqForm, options){
	$("#response_spare").hide();
   	var queryString = $.param(formData);
	return true;
}
   	
function showAddResponse_spare(resp, statusText, xhr, $form){
	if(resp.status == '0') {
		$("#response_spare").removeClass('alert-success');
       	$("#response_spare").addClass('alert-danger');
		$("#response_spare").html(resp.msg);
		$("#response_spare").show();
		 alert(resp.msg);
  	} else {
  		$("#response_spare").removeClass('alert-danger');
        $("#response_spare").addClass('alert-success');
        $("#response_spare").html(resp.msg);
        $("#response_spare").show();
        alert(resp.msg);
        // window.location.href = base_url+"admin/mainservice";
        // $("#Zone_li").trigger("click");
        goto_spare();
  	}
} 

$(document).ready(function(){    
	$("#tax_inclusive_spare").change(function() 
			{
		  	if($('#tax_inclusive_spare').val() == 1){
		  		$('#tax_value_spare').show();
		  		$('#tax_spare').val('');
		  	}  
		  	else{

		  		$('#tax_value_spare').hide();
		  		$('#tax_spare').val(0);
		  	} 
	  });
    }); 
</script>