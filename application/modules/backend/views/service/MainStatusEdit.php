<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.bootstrap3.css">
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h3>Edit Status</h3>
			</div>
		</div>
		<form id="editmainstatus" name="editmainstatus" action="" method="post" enctype="multipart/form-data">
		<?php //print_r($categories);?>
		<input type="hidden" name="id" value="<?php echo $categories[0]['id'];?>"/>
			<div id="basic" class="tab-pane fade in active">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Status Name <span class='text-danger'>*</span></label>
											<input type="text" class="form-control" value="<?php echo $categories[0]['name'];?>" id="name" name="name" />
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Sort Order <span class='text-danger'>*</span></label>
											<input type="text" class="form-control" value="<?php echo $categories[0]['sort_order'];?>" id="sort_order" name="sort_order" value ="0" />
										</div>
										<div class="messageContainer"></div>
									</div>
									
                                </div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Email Content <span class='text-danger'>*</span></label>
											<textarea  class="form-control" id="email_content" name="email_content" ><?php echo $categories[0]['email_content'];?></textarea>
											<div class="messageContainer"></div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">SMS Content<span class='text-danger'>*</span></label>
											<textarea  class="form-control" id="sms_content" name="sms_content" ><?php echo $categories[0]['sms_content'];?></textarea>
											<div class="messageContainer"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Status <span class='text-danger'>*</span></label>
											<select id="status" class="form-control" name="status">
												<option value="1" <?php if(isset($categories[0]['status']) && $categories[0]['status'] == 1) {?>selected<?php }?>>Enable</option>
												<option value="0" <?php if(isset($categories[0]['status']) && $categories[0]['status'] == 0) {?>selected<?php }?>>Disable</option>
											</select>
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Parent Status <span class='text-danger'>*</span></label>
											<select id="parent_id" name="parent_id" class="form-control" >
											<option value="">Select Status</option>
											<?php foreach($pcategory as $category) {?>
												<option value="<?php echo $category['id'] ?>" <?php if($category['id'] == $categories[0]['parent_id']) {?>selected<?php }?>><?php echo $category['name'] ?></option>
											<?php  } ?>
											</select>
										</div>
										<div class="messageContainer"></div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Show To Customer</label>
											<select id="is_customer" class="form-control" name="is_customer">
												<option value="0" <?php if(isset($categories[0]['is_customer']) && $categories[0]['is_customer'] == 0) {?>selected<?php }?>>No</option>
												<option value="1" <?php if(isset($categories[0]['is_customer']) && $categories[0]['is_customer'] == 1) {?>selected<?php }?>>Yes</option>
											</select>
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Show To Mechanic<span class='text-danger'>?</span></label>
											<select id="is_mechanic" class="form-control" name="is_mechanic">
												<option value="0" <?php if(isset($categories[0]['is_mechanic']) && $categories[0]['is_mechanic'] == 0) {?>selected<?php }?>>No</option>
												<option value="1" <?php if(isset($categories[0]['is_mechanic']) && $categories[0]['is_mechanic'] == 1) {?>selected<?php }?>>Yes</option>
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
	</div>
</div>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/selectize.js"></script>
<script>
$('#editmainstatus').bootstrapValidator({
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
                    message: 'Status Name is required and cannot be empty'
                }
            }
        }
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	updateMainStatus();
});

function updateMainStatus() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/mainstatus/update',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#editmainstatus').ajaxSubmit(options);
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
        window.location.href = base_url+"admin/mainstatus/list";
  	}
}
</script>
