<style>
	.check
	{
	  width:auto !important;
	}
	</style>
<form id="editcategory" name="editcategory" action="" method="post" enctype="multipart/form-data">
		<?php //print_r($categories);?>
		<input type="hidden" name="id" value="<?php echo $grades[0]['id'];?>"/>
			<div id="basic" class="tab-pane fade in active">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Grade<span class='text-danger'>*</span></label>
											<input type="text" class="form-control" value="<?php echo $grades[0]['name'];?>" id="name" name="name" />
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Assign parameter to grade<span class='text-danger'>*</span></label>
											<?php 
											   foreach ($parameters as $parameter) {
										     
												?>
											      <input type="checkbox" class="form-control check"  id="parameter" name="parameter[]" value="<?php echo $parameter['id'];?>" <?php if($parameter['checked'] == 'checked') { ?>checked<?php }?>><?php echo $parameter['name'];?>
											
											<?php  } ?>
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Status <span class='text-danger'>*</span></label>
											<select id="status" class="form-control" name="status">
												<option value="1" <?php if(isset($grades[0]['status']) && $grades[0]['status'] == 1) {?>selected<?php }?>>Enable</option>
												<option value="0" <?php if(isset($grades[0]['status']) && $grades[0]['status'] == 0) {?>selected<?php }?>>Disable</option>
											</select>
										</div>
										<div class="messageContainer"></div>
									</div>
                                </div>
								<div class="row">
	                               
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
                    message: 'Parameter is required and cannot be empty'
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
      /*  parameter[]: {
            validators: {
                notEmpty: {
                    message: 'Parameter is required and cannot be empty'
                }
            }
        }*/
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
	 		url : base_url+'admin/grade/update',
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
        window.location.href = base_url+"admin/mainquality";
  	}
}
</script>