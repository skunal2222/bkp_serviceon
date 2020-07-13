<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.bootstrap3.css">
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h3>Add Status</h3>
			</div>
		</div>
		<form id="addmainstatus" name="addmainstatus" action="" method="post" enctype="multipart/form-data">
			<div id="basic" class="tab-pane fade in active">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Status Name <span class='text-danger'>*</span></label>
											<input type="text" class="form-control" id="name" name="name" />
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Sort Order <span class='text-danger'>*</span></label>
											<input type="text" class="form-control" id="sort_order" name="sort_order" value ="0" />
										</div>
										<div class="messageContainer"></div>
									</div>
                                </div>
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Email Content<span class='text-danger'>*</span></label>
											<textarea  class="form-control" id="email_content" name="email_content" > </textarea>
											<div class="messageContainer"></div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">SMS Content <span class='text-danger'>*</span></label>
											<textarea  class="form-control" id="sms_content" name="sms_content" > </textarea>
											<div class="messageContainer"></div>
										</div>
									</div>
								</div>
								<div class="row">
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
											<label class="control-label">Parent Status <span class='text-danger'>*</span></label>
											<select id="parent_id" name="parent_id" class="form-control" >
											<option value="">Select Category</option>
											<?php foreach($categories as $category) {?>
												<option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
											<?php } ?>
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
												<option value="0">No</option>
												<option value="1">Yes</option>
											</select>
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Show To Mechanic</label>
											<select id="is_mechanic" class="form-control" name="is_mechanic">
												<option value="0">No</option>
												<option value="1">Yes</option>
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
$('#addmainstatus').bootstrapValidator({
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
	addmainstatus();
});

function addmainstatus() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/mainstatus/add',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#addmainstatus').ajaxSubmit(options);
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