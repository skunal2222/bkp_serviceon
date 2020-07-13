<style>
.check{
	width:auto !important;
    margin: -8px 20px 0 !important;
}
.check1{
	width:auto !important;
    margin: -8px 20px 0 !important;
}
.chk{
	display: -webkit-box !important;
}
.accessinput{
    border: none !important;
 }
</style>
<form id="editcategory" name="editcategory" action="" method="post" enctype="multipart/form-data">
		<?php //print_r($categories);?>
		<input type="hidden" name="id" value="<?php echo $Roles[0]['id'];?>"/>
			<div id="basic" class="tab-pane fade in active">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Role<span class='text-danger'>*</span></label>
											<input type="text" class="form-control" value="<?php echo $Roles[0]['name'];?>" id="name" name="name" />
										</div>
										<div class="messageContainer"></div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Status <span class='text-danger'>*</span></label>
											<select id="status" class="form-control" name="status">
												<option value="1" <?php if(isset($Roles[0]['status']) && $Roles[0]['status'] == 1) {?>selected<?php }?>>Enable</option>
												<option value="0" <?php if(isset($Roles[0]['status']) && $Roles[0]['status'] == 0) {?>selected<?php }?>>Disable</option>
											</select>
										</div>
										<div class="messageContainer"></div>
									</div>
								</div>
							</div>			
								<div class="row">
							        <div class="col-lg-12">
							                	<label class="control-label">Assign form to role<span class='text-danger'>*</span>
							                	</label><br/><br/>
	                     				<div class="panel panel-default">
				                        	<div class="panel-body">
				                          
				                          	<table class="table table-striped table-bordered table-hover">
								                        <thead class="bg-info">
								                            <tr class=""> 
                                                                <th class="">Sr No.</th>
								                                <th class="">Name</th>
								                                <th class="">Edit</th>  
								                                <th class="">No Access</th>
								                            </tr>
								                        </thead>
								
								                        <tbody>
								                        	<?php $i=1; foreach($forms as $value){ ?>
								                            <tr class="">
								                            	<td>
								                            		<?php echo $i; ?>
								                            	</td>
								                                <td class="">
								                                	  <?php echo $value['name']; ?>
								                               	</td>
								                               	<?php if($value['id'] != 0) { ?>
								                                 <td class="">
                                                                            <input id="checkbox1" value="1" <?= $value['access_type'] == 1 ? 'checked' : '' ?> name="accessrole[<?php echo $value['id']; ?>]" type="radio"   >
                                                                            <input type="hidden" id="role_id" name="role_id" value="<?= $value['role_id'];?>">
                                                                        </td>
                                                                    <!--     <td class="">
                                                                            <input id="checkbox1" value="2" <?= $value['access_type'] == 2 ? 'checked' : '' ?> name="accessrole[<?php echo $value['id']; ?>]" type="radio"  >

                                                                        </td> -->
                                                                        <td class="">
                                                                            <input id="checkbox1"  value="3" <?= $value['access_type'] == 3 ? 'checked' : '' ?> name="accessrole[<?php echo $value['id']; ?>]" type="radio">
                                                                           
                                                                        </td>
                                                                        <?php } else {?>
                                                                        	<td class="">
                                                                            <input id="checkbox1" value="1" name="new[<?= $value['module_id']?>]" type="radio">
                                                                            <input type="hidden" id="role_id" name="role_id" value="<?= $value['role_id'];?>">
                                                                        </td>
                                                                        <!-- <td class="">
                                                                            <input id="checkbox1" value="2" name="new[<?= $value['module_id']?>]"type="radio"  >

                                                                        </td> -->
                                                                        <td class="">
                                                                            <input id="checkbox1"  value="3" name="new[<?= $value['module_id']?>]" type="radio">
                                                                           
                                                                        </td>
																			
                                                                        <?php }?>		

								                            </tr> 
								                            <?php $i++; } ?>
								                        </tbody>
								            	</table> 
								               </div>
                                            </div>
                                        </div>
                                    </div>

											 <div class="text-center">
												<div id="response"></div>
												<button type="submit" class="btn btn-success">Update</button>
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
	 		url : base_url+'client/role/update',
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
        window.location.href = base_url+"client/employee";
  	}
}
</script>