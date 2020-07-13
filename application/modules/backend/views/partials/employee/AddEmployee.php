<?php //print_r($garagelist); ?>
	<form id="addcategory" name="addcategory" action="" method="post" enctype="multipart/form-data">
			<div id="basic" class="tab-pane fade in active">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default"> 
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Name<span class='text-danger'>*</span></label>
											<input type="text" class="form-control" id="name" name="name" />
										</div>
										<div class="messageContainer"></div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Phone<span class='text-danger'>*</span></label>
											<input type="text" class="form-control" id="mobile" name="mobile" />
										</div>
										<div class="messageContainer"></div>
									</div>
									
									
                                </div>
                                
                                	<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Email<span class='text-danger'>*</span></label>
											<input type="text" class="form-control" id="email" name="email" />
										</div>
										<div class="messageContainer"></div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Password<span class='text-danger'>*</span></label>
											<input type="password" class="form-control" id="password" name="password" />
										</div>
										<div class="messageContainer"></div>
									</div>
									
                                </div>
                                
                                	<div class="row">
                                	<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Emergency Mobile</label>
											<input type="text" class="form-control" id="emobile" name="emobile" />
										</div>
										<div class="messageContainer"></div>
									</div>
										
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Document <span class='text-danger'>*</span></label>
											<input type="file" id="image" name="image[]" class="form-control" multiple="true">
										</div>
										<div class="messageContainer"></div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Role<span class='text-danger'>*</span></label>
											<select name="role_id" id="role_id" class="form-control">
													<option value=""> Select Role </option>
													<?php foreach ($ActiveRoles as $role) { ?>
													<option value="<?php echo $role['id'];?>"><?php echo $role['name'];?></option>
													<?php } ?>
												</select>
										</div>
										<div class="messageContainer"></div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Assign Mechanic<span class='text-danger'>*</span></label>
											<select name="garage_id" id="garage_id" class="form-control">
													<option value=""> Select Mechanic </option>
													<?php foreach ($garagelist as $garage) { ?>
													<option value="<?php echo $garage['id'];?>"><?php echo $garage['garage_name'];?></option>
													<?php } ?>
												</select>
										</div>
										<div class="messageContainer"></div>
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
$('#addcategory').bootstrapValidator({
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
                    message: 'Employee is required and cannot be empty'
                }
            }
        },
        mobile: {
            validators: {
                notEmpty: {
                    message: 'Mobile is required and cannot be empty'
                }
            }
        },
        email: {
            validators: {
                notEmpty: {
                    message: 'Email is required and cannot be empty'
                }
            }
        },
        password: {
            validators: {
                notEmpty: {
                    message: 'Password is required and cannot be empty'
                }
            }
        },
         
        'image[]': {
            validators: {
                notEmpty: {
                    message: 'Image is required and cannot be empty'
                }
            }
        },
        garage_id: {
            validators: {
                notEmpty: {
                    message: 'Mechanic is required and cannot be empty'
                }
            }
        },
        role_id: {
            validators: {
                notEmpty: {
                    message: 'Role is required and cannot be empty'
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
	 		url : base_url+'admin/emp/add',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#addcategory').ajaxSubmit(options);
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
        window.location.href = base_url+"admin/mainemp";
  	}
}
</script>