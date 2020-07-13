<form id="editcategory" name="editcategory" action="" method="post" enctype="multipart/form-data">
		<?php //print_r($categories);?>
		<input type="hidden" name="id" value="<?php echo $catsubcats[0]['id'];?>"/>
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
													<option value=""> Select Vehical Type </option>
													<?php foreach ($categories as $category) { ?>
													<option value="<?php echo $category['id'];?>" <?php if($catsubcats[0]['category_id'] == $category['id']) {?>selected<?php }?>><?php echo $category['name'];?></option>
													<?php } ?>
												</select>
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Brand<span class='text-danger'>*</span></label>
											<select name="brand_id" id="brand_id" class="form-control">
													<option value=""> Select Brand </option>
													<?php foreach ($brands as $brand) : ?>
													<option value="<?php echo $brand['id'];?>" <?php if($catsubcats[0]['brand_id'] == $brand['id']) {?>selected<?php }?>><?php echo $brand['name'];?></option>
													<?php endforeach;?>														
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
													<?php foreach ($models as $model) : ?>
													<option value="<?php echo $model['id'];?>" <?php if($catsubcats[0]['model_id'] == $model['id']) {?>selected<?php }?>><?php echo $model['name'];?></option>
													<?php endforeach;?>
												</select>
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
												<div class="form-group" id="error-name">
											<label class="control-label">Service Type<span class='text-danger'>*</span></label>
											<select name="subcategory_id" id="subcategory_id" class="form-control">
													<option value=""> Select Service Type</option>	
													 <?php foreach ($subcategories as $subcategory) : ?>
													 <option value="<?php echo $subcategory['id'];?>" <?php if($catsubcats[0]['subcategory_id'] == $subcategory['id']) {?>selected<?php }?>><?php echo $subcategory['name'];?></option>
													<?php endforeach;?>
													</select>
										</div>
										<div class="messageContainer"></div>
									</div>
								
                                </div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Service Group Name <span class='text-danger'>*</span></label>
											<input type="text" class="form-control" value="<?php echo $catsubcats[0]['name'];?>" id="name" name="name" />
										</div>
										<div class="messageContainer"></div>
									</div>
								
	                                <div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Status <span class='text-danger'>*</span></label>
											<select id="status" class="form-control" name="status">
												<option value="1" <?php if(isset($catsubcats[0]['status']) && $catsubcats[0]['status'] == 1) {?>selected<?php }?>>Enable</option>
												<option value="0" <?php if(isset($catsubcats[0]['status']) && $catsubcats[0]['status'] == 0) {?>selected<?php }?>>Disable</option>
											</select>
										</div>
										<div class="messageContainer"></div>
									</div>
                                </div>
								<div class="row">
	                                
									<!-- <div class="col-md-6">
		                              	<div class="form-group" id="error-image">
	                                       	<label class="control-label ">Upload Image (300 X 225 px) <span class='text-danger'>*</span></label>
	                                       	<input type="file" value="" name="image" id="image" value="<?php echo $catsubcats[0]['service_icon'];?>" class="form-control " >
										</div>
										<span>
											<img src="<?php echo asset_url();?><?php echo $catsubcats[0]['service_icon'];?>" width="160px" height="80px" />
										</span>
										<div class="messageContainer col-sm-4"></div>
	                                </div>-->
										
								<!-- 		<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Price<span class='text-danger'>*</span></label>
											<input type="text" class="form-control" id="price" name="price" value="<?php echo $catsubcats[0]['price'];?>" />
										</div>
										<div class="messageContainer"></div>
									</div>-->
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

$(document).ready(function(){    

	$("#model_id").change(function() 

			{

		var model_id =  $('#model_id').val();       

			console.log(model_id);	    

			  $.post(base_url+"admin/subcategorybycatid/", {model_id : model_id}, function(data)

					  {

				  $('#subcategory_id').empty();$('#subcategory_id').append("<option value=''>"+'Select Service Type'+"</option>");		    

			   if(data.length > 0)

				   {		    

				     for( var i=0; i < data.length; i++)

					     {		   			    

					           $('#subcategory_id').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");			

					            }	    

			              }	   

	               },'json');   

               });



	$("#category_id").change(function() 

			{

		var cat_id =  $('#category_id').val();       

			console.log(cat_id);	    

			  $.post(base_url+"admin/brandbycatid/", {cat_id : cat_id}, function(data)

					  {

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

		var brand_id =  $('#brand_id').val();       

			console.log(brand_id);	    

			  $.post(base_url+"admin/modelbybrandid/", {brand_id : brand_id}, function(data)

					  {

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





$('#editcategory').bootstrapValidator({
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
                    message: 'Service Group Name is required and cannot be empty'
                }
            }
        },
        category_id: {
            validators: {
                notEmpty: {
                    message: 'Vehical Type Name is required and cannot be empty'
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
                    message: 'Service Type Name is required and cannot be empty'
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
       
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	updateCategory();
});

function updateCategory() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/catsubcat/update',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#editcategory').ajaxSubmit(options);
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
		$("#response").html(resp.msg.name);
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
</script>