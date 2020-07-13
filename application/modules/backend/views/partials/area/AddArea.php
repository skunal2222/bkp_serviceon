	<form id="addservice" name="addservice" action="" method="post" enctype="multipart/form-data">
			<div id="basic" class="tab-pane fade in active">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Name <span class='text-danger'>*</span></label>
											<input type="text" class="form-control" id="name" name="name" />
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Assign zone to area<span class='text-danger'>*</span></label>
											<select name="zone_id" id="zone_id" class="form-control">
													<option value=""> Select Zone</option>
													<?php foreach ($zones as $zone) { ?>
													<option value="<?php echo $zone['id'];?>"><?php echo $zone['name'];?></option>
													<?php } ?>
												</select>
										</div>
										<div class="messageContainer"></div>
									</div>
								
                                </div>
								<div class="row">
	                <div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Assign area<span class='text-danger'>*</span></label>
											<select name="area_id" id="area_id" class="form-control">
													<option value=""> Select area </option>
													<?php foreach ($areas as $area) { ?>
													<option value="<?php echo $area['id'];?>"><?php echo $area['name'];?></option>
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

$("#category_id").change(function() {
	//window.location.href = base_url+"admin/service/new/"+$("#category_id").val();

	$.post(base_url+"admin/service/new/"+$("#category_id").val(),{},function(data) {

		//alert(data);

		$("#subcategory_id").html(data);

		

	},'html');

	
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
                    message: 'Name is required and cannot be empty'
                }
            }
        },
        zone_id: {
            validators: {
                notEmpty: {
                    message: 'Zone is required and cannot be empty'
                }
            }
        },
        area_id: {
            validators: {
                notEmpty: {
                    message: 'Area is required and cannot be empty'
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
	addService();
});

function addService() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/area/add',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#addservice').ajaxSubmit(options);
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
        window.location.href = base_url+"admin/mainarea";
      
  	}
}
</script>