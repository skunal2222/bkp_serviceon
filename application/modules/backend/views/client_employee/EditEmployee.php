<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css"> 

<form id="editcategory" name="editcategory" action="" method="post" enctype="multipart/form-data">
		<?php //print_r($categories);?>
		<input type="hidden" name="id" value="<?php echo $Emps[0]['id'];?>"/>
			<div id="basic" class="tab-pane fade in active">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">First Name<span class='text-danger'>*</span></label>
											<input type="text" class="form-control" value="<?php echo $Emps[0]['first_name'];?>" id="first_name" name="first_name" />
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Last Name<span class='text-danger'>*</span></label>
											<input type="text" class="form-control" value="<?php echo $Emps[0]['last_name'];?>" id="last_name" name="last_name" />
										</div>
										<div class="messageContainer"></div>
									</div> 
                                </div>
								<div class="row">

									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Phone<span class='text-danger'>*</span></label>
											<input type="text" class="form-control" value="<?php echo $Emps[0]['mobile'];?>" id="mobile" name="mobile" />
										</div>
										<div class="messageContainer"></div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Email<span class='text-danger'>*</span></label>
											<input type="text" class="form-control" value="<?php echo $Emps[0]['email'];?>" id="email" name="email" />
										</div>
										<div class="messageContainer"></div>
									</div>
								</div> 
									
								<div class="row">

									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Password<span class='text-danger'>*</span></label>
											<input type="text" class="form-control" value="<?php echo $Emps[0]['password'];?>" id="password" name="password" />
										</div>
										<div class="messageContainer"></div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Emergency Mobile</label>
											<input type="text" class="form-control" value="<?php echo $Emps[0]['emergency_mobile'];?>" id="emobile" name="emobile" />
										</div>
										<div class="messageContainer"></div>
									</div>

                                    <!-- <div class="col-md-6">
                                        <div class="form-group" id="error-image">
                                            <label class="control-label ">Upload Photo (80 X 80 px) <span class='text-danger'>*</span></label>
                                            <input type="file" value="" name="doc_url[]" id="doc_url" value="<?php echo $Emps[0]['doc']; ?>" class="form-control " >
                                        </div>
                                        <span>
                                             <img src="<?php echo base_url(); ?><?php echo $Emps[0]['doc']; ?>" width="160px" height="80px" /> 
                                        </span>

                                    </div> -->
                                    <div class="col-md-6">
                                        <div class="form-group" id="error-image">
                                            <label class="control-label ">Upload Photo (80 X 80 px) <span class='text-danger'>*</span></label>
                                            <input type="file" value="" name="image" id="image" value="<?php echo $Emps[0]['image']; ?>" class="form-control " >
                                        </div>
                                        <span>
                                            <img src="<?php echo asset_url(); ?><?php echo $Emps[0]['image']; ?>" width="160px" height="80px" />
                                        </span> 
                                    </div>
 
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Company Name<span class='text-danger'>*</span></label>
											<select name="client_id" id="client_id" class="form-control">
													<option value=""> Select Company Name </option>
													<?php foreach ($clients as $value) { ?>
													<option value="<?php echo $value['id'];?>"  <?php if($Emps[0]['client_id'] == $value['id']) {?>selected<?php }?>><?php echo $value['reg_company_name'];?></option>
													<?php } ?>
												</select>
										</div>
										<div class="messageContainer"></div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
                                            <label class="control-label col-sm-5">Outlet Name<span class='text-danger'>*</span></label> 
                                            <!-- <select name="outlet_id[]" id="outlet_id" class="form-control floating" multiple="true"> 
                                                    <option value=""> Select Outlet </option>             
                                            </select>  --> 
                                            <select id="outlet_id" name="outlet_id[]" class="form-control"  multiple="true"> 
                                      	   <?php foreach ($Outlets as $outlet) { ?>
                                            <option value="<?php echo $outlet['id']; ?>" 
                                            <?php
                                            if (!empty($Emps[0]['outlet_id'])) {
                                                $attr_id = explode(',', $Emps[0]['outlet_id']);
                                                foreach ($attr_id as $value) {
                                                    if ($outlet['id'] == $value)
                                                        echo 'selected';
                                                }
                                            }
                                            ?>
                                                    >
                                            <?php echo $outlet['outlet_name']; ?></option>
                                        <?php } ?>
                                        	<input type="button" id="select_all" name="select_all" value="Select All"> 
                                    		</select> 
                                        </div>
										<div class="messageContainer"></div>
									</div>

                                    <div class="col-md-6">
                                        <div class="form-group form-focus select-focus">
                                            <label class="control-label">Select Role</label>
                                            <select id="user_role" name="user_role" class="select form-control floating"> 
                                                <?php foreach ($Roles as $item): ?>
                                                    <option value="<?php echo $item['id']; ?>" <?php echo isset($Emps[0]['user_role']) ? $Emps[0]['user_role'] == $item['id'] ? 'selected' : '' : ''; ?>><?php echo $item['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>
									
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Status <span class='text-danger'>*</span></label>
											<select id="status" class="form-control" name="status">
												<option value="1" <?php if(isset($Emps[0]['status']) && $Emps[0]['status'] == 1) {?>selected<?php }?>>Enable</option>
												<option value="0" <?php if(isset($Emps[0]['status']) && $Emps[0]['status'] == 0) {?>selected<?php }?>>Disable</option>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
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
    	
    	first_name: {
            validators: {
                notEmpty: {
                    message: 'First Name is required and cannot be empty'
                },
            	regexp: {
                    regexp: '^[A-Za-z]+$',
                    message: 'Only Characters Allowed'
                }
            }
        },
        last_name: {
            validators: {
                notEmpty: {
                    message: 'Last Name is required and cannot be empty'
                },
            	regexp: {
                    regexp: '^[A-Za-z]+$',
                    message: 'Only Characters Allowed'
                }
            }
        },
        mobile: {
            validators: {
                notEmpty: {
                    message: 'Mobile is required and cannot be empty'
                },
                regexp: {
                        regexp: '^[7-9][0-9]{9}$',
                        message: 'Invalid Mobile Number'
                    }

            }
        },
        email: {
            validators: {
                notEmpty: {
                    message: 'Email is required and cannot be empty'
                },
            	regexp: {
                    regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                    message: 'The value is not a valid email address'
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
         /*  emobile: {
              validators: {
                  notEmpty: {
                      message: 'Emergency mobile is required and cannot be empty'
                  }
              }
          }, */
        client_id: {
            validators: {
                notEmpty: {
                    message: 'client is required and cannot be empty'
                }
            }
        },
        outlet_id: {
            validators: {
                notEmpty: {
                    message: 'outlet is required and cannot be empty'
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
	 		url : base_url+'client/emp/update',
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
		$("#response").html(resp.msg);
		$("#response").show();
		alert(resp.msg);
  	} else {
  		$("#response").removeClass('alert-danger');
        $("#response").addClass('alert-success');
        $("#response").html(resp.msg);
        $("#response").show();
        alert(resp.msg);
        window.location.href = base_url+"client/employee";
  	}
}
$("#client_id").change(function () {
        var client_id = $('#client_id').val();
        console.log(client_id);
        ajaxindicatorstart("Please wait....");
        $.post(base_url + "client/outletbyclientid/", {client_id: client_id}, function (data) {
            ajaxindicatorstop();
               console.log(data);     
            $('#outlet_id').empty();
            //$('#outlet_id').append("<option value=''>"+'Select Outlet'+"</option>");    
          
            if (data.length > 0)
            {
                for (var i = 0; i < data.length; i++)
                {
                    $('#outlet_id').append("<option value='" + data[i].id + "'>" + data[i].outlet_name + "</option>"); 
                } 
            }
            else {
                $('#outlet_id').empty();
            }
        }, 'json');
    });
</script>
<script>
$(document).ready(function(){
	  //Chosen
	/* $("#subcategory_id").select2({
		 maxItems: 3
	  	})*/

	  	 $("#outlet_id").select2({
		 maxItems: 3
	  	})

	});
 $('#select_all').click(function () {
    $('#outlet_id option').prop('selected', true);
    $("#outlet_id").trigger("change");
});
</script>