<form id="editcategory" name="editcategory" action="" method="post" enctype="multipart/form-data">
		<?php //print_r($categories);?>
		<input type="hidden" name="id" value="<?php echo $subcategories[0]['id'];?>"/>
			<div id="basic" class="tab-pane fade in active">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Category<span class='text-danger'>*</span></label>
											<select name="category_id" id="category_id" class="form-control">
													<option value=""> Select Category </option>
													<?php foreach ($categories as $category) { ?>
													<option value="<?php echo $category['id'];?>" <?php if($subcategories[0]['category_id'] == $category['id']) {?>selected<?php }?>><?php echo $category['name'];?></option>
													<?php } ?>
												</select>
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
												<div class="form-group" id="error-name">
											<label class="control-label">Subcategory Name <span class='text-danger'>*</span></label>
											<input type="text" class="form-control" id="name" name="name"  value="<?php echo $subcategories[0]['name'];?>"/>
										</div>
										<div class="messageContainer"></div>
									</div>
								
                                </div>
                              
								<div class="row">
									  <div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Status <span class='text-danger'>*</span></label>
											<select id="status" class="form-control" name="status">
												<option value="1" <?php if(isset($subcategories[0]['status']) && $subcategories[0]['status'] == 1) {?>selected<?php }?>>Enable</option>
												<option value="0" <?php if(isset($subcategories[0]['status']) && $subcategories[0]['status'] == 0) {?>selected<?php }?>>Disable</option>
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
	updateCategory();
});

function updateCategory() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/general/updatesub',
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
  	} else {
  		$("#response").removeClass('alert-danger');
        $("#response").addClass('alert-success');
        $("#response").html(resp.msg);
        $("#response").show();
        alert(resp.msg);
        window.location.href = base_url+"admin/general/ticket";
  	}
}

</script>