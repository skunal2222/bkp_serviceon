	<form id="addsubcategory" name="addsubcategory" action="" method="post" enctype="multipart/form-data">
			<div id="basic" class="tab-pane fade in active">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Vehical Type<span class='text-danger'>*</span></label>
											<select name="category_id" id="category_id" class="form-control">
													<option value=""> Select Type </option>
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
											<select name="brand_id" id="brand_id" class="form-control">
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
											<select name="model_id" id="model_id" class="form-control">
													<option value=""> Select Model</option>	
												</select>
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
												<div class="form-group" id="error-name">
											<label class="control-label">Service Type Name <span class='text-danger'>*</span></label>
											<select name="name" id="name" class="form-control">													<option value=""> Select Service Type </option>													<?php foreach ($sub_categories as $subcategory) { ?>													<option value="<?php echo $subcategory['id'];?>,<?php echo $subcategory['name'];?>"><?php echo $subcategory['name'];?></option>													<?php } ?>											</select>
										</div>
										<div class="messageContainer"></div>
									</div>
								
                                </div>
								<div class="row">
	                                  	<div class="col-md-6">
		                              	<div class="form-group" id="error-image">
	                                       	<label class="control-label ">Upload Image (80 X 80 px) <span class='text-danger'>*</span></label>
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
									
								</div>
								
								
								 <div class="text-center">
									<div id="response"></div>
									<button type="submit" class="btn btn-success">Submit</button>
									<br>
								 </div>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</form>
		<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script>
$('#addsubcategory').bootstrapValidator({
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
                    message: 'SubCategory Name is required and cannot be empty'
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
        image: {
            validators: {
                notEmpty: {
                    message: 'Image is required and cannot be empty'
                }
            }
        },
       status: {
            validators: {
                notEmpty: {
                    message: 'Status is required and cannot be empty'
                }
            }
        }
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	addCategory();
});

function addCategory() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/subcategory/add',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#addsubcategory').ajaxSubmit(options);
}

function showAddRequest(formData, jqForm, options){
	$("#response").hide();
   	var queryString = $.param(formData);
	return true;
}
   	
function showAddResponse(resp, statusText, xhr, $form){
	if(resp.status == '0') {
		$("#response").removeClass('alert-success');
       	$("#response").addClass('alert-danger');
		$("#response").html(resp.msg);
		$("#response").show();
		alert(resp.msg);
  	} else {
  		$("#response").removeClass('alert-danger');
        $("#response").addClass('alert-success');
        $("#response").html(resp.msg);
        $("#response").show();
        alert(resp.msg);
        window.location.href = base_url+"admin/mainservice";
  	}
}



$(document).ready(function(){  
// alert();

	$(document).on('change','#category_id',function(){ 
				ajaxindicatorstart("Please hang on..");
		var cat_id =  $('#category_id').val();       
			console.log(cat_id);	    
			  $.post(base_url+"admin/brandbycatid/", {cat_id : cat_id}, function(data)
					  {
					  	ajaxindicatorstop();
				  $('#brand_id').empty();$('#brand_id').append("<option value=''>"+'Select Brand'+"</option>");		    
			   if(data.length > 0)
				   {		    
				     for( var i=0; i < data.length; i++)
					     {		   			    
					           $('#brand_id').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");			
					            }	    
			              }	   
	               },'json');   
               });

	$("#brand_id").change(function() 
			{
				ajaxindicatorstart("Please hang on..");

		var brand_id =  $('#brand_id').val();       
			console.log(brand_id);	    
			  $.post(base_url+"admin/modelbybrandid/", {brand_id : brand_id}, function(data)
					  {
					  	ajaxindicatorstop();
					  	
				  $('#model_id').empty();$('#model_id').append("<option value=''>"+'Select Model'+"</option>");		    
			   if(data.length > 0)
				   {		    
				     for( var i=0; i < data.length; i++)
					     {		   			    
					           $('#model_id').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");			
					            }	    
			              }	   
	               },'json');   
               });
    }); 
</script>