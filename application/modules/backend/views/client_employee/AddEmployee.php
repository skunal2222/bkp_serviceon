 
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css"> 
 	<form id="addcategory" name="addcategory" action="" method="post" enctype="multipart/form-data">
			<div id="basic" class="tab-pane fade in active">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default"> 
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">First Name<span class='text-danger'>*</span></label>
											<input type="text" class="form-control" id="first_name" name="first_name" />
										</div>
										<div class="messageContainer"></div>
									</div>

									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Last Name<span class='text-danger'>*</span></label>
											<input type="text" class="form-control" id="last_name" name="last_name" />
										</div>
										<div class="messageContainer"></div>
									</div> 
									
                                </div>
                                
                                <div class="row">
                                		<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Phone<span class='text-danger'>*</span></label>
											<input type="text" class="form-control" id="mobile" name="mobile" />
										</div>
										<div class="messageContainer"></div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Email<span class='text-danger'>*</span></label>
											<input type="text" class="form-control" id="email" name="email" />
										</div>
										<div class="messageContainer"></div>
									</div> 
									
                                </div>
                                
                                <div class="row">

									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Password<span class='text-danger'>*</span></label>
											<input type="password" class="form-control" id="password" name="password" />
										</div>
										<div class="messageContainer"></div>
									</div>

                                	<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Emergency Mobile</label>
											<input type="text" class="form-control" id="emargency_mobile" name="emobile" />
										</div>
										<div class="messageContainer"></div>
									</div>
										
									<!-- <div class="col-md-6">
										<div class="form-group form-focus select-focus">
                                            <label class="control-label">Upload Your Documents<span class='c-input--danger'>*</span></label>
                                            <input type="file" id="doc_url" name="doc_url[]" class="form-control floating"  multiple="multiple" >
                                            <span>Note: Supported image format: .jpeg, .jpg, .png</span>
                                        </div> 
										<div class="messageContainer"></div>
									</div> -->
                                    <div class="col-md-6">
                                        <div class="form-group form-focus select-focus">
                                        <label class="control-label ">Upload Photo (80 X 80 px)</label>
                                        <input type="file" value="" name="image" id="image" class="form-control " ></div> 
                                     </div>
									
									<div class="col-md-6">
										<div class="form-group" >
                                            <label class="control-label col-sm-5">Company Name<span class='text-danger'>*</span></label>

                                            <select name="client_id" id="client_id" class="form-control floating">
                                                <option value=""> Select Company Name</option>
                                                <?php foreach ($clients as $value) {
                                                    if ($value['status'] == 1) {
                                                        ?>
                                                        <option value="<?= $value['id']; ?>" ><?= $value['reg_company_name']; ?></option>
                                                    <?php }
                                                }
                                                ?>
                                            </select> 
                                        </div>
                                        <div class="messageContainer"></div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
                                            <label class="control-label col-sm-5">Outlet Name<span class='text-danger'>*</span></label> 
                                            <select name="outlet_id[]" id="outlet_id" class="form-control floating" multiple="true"> 
                                                    <option value=""> Select Outlet </option>             
                                            </select> 
                                        </div>
                                        <div class="messageContainer"></div>
									</div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus select-focus">
                                            <label class="control-label">Select Role</label>
                                            <select id="user_role" name="user_role" class="select form-control floating" onchange="checkEmplyee()"> 
                                            <option value="" >Select Role</option>
                                            <?php foreach ($Roles as $item):?>
                                            <option value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
                                            <?php endforeach;?>
                                            </select>
                                        </div>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>

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
        /*'doc_url[]': {
                validators: {
                    notEmpty: {
                        message: 'Please select an Documents'
                    },
                    file: {
                        extension: 'jpeg,jpg,png',
                        type: 'image/jpeg,image/png',
                        // maxSize: 2097152,   // 2048 * 1024
                        message: 'The selected file is not valid'
                    }
                }
            },*/
        client_id: {
            validators: {
                notEmpty: {
                    message: 'client is required and cannot be empty'
                }
            }
        },
        'outlet_id[]': {
            validators: {
                notEmpty: {
                    message: 'outlet is required and cannot be empty'
                }
            }
        },
        user_role: {
            validators: {
                notEmpty: {
                    message: 'Role is required and cannot be empty'
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
	 		url : base_url+'client/emp/add',
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
        }, 'json');
    });


   function checkEmplyee(){
    //data send to ajax function

    var data = {
        'client_id':$('#client_id').val(),
        'user_role':$('#user_role').val(),
        'outlet_id':$('#outlet_id').val()
    }; 
   // data = JSON.stringify(data);
 
    //url to call ajax
    var url = 'client/emp/checkEmplyee';
    var ajaxObject = AjaxFormSubmit(data, url, 'POST');
            $.when(ajaxObject).then(function () {
                ajaxindicatorstop();
                ajaxObject.done(function (response) {
                    if(response.status == 0){ 
                        alert(response.msg); 
                        $("#outlet_id").val(null).trigger("change");

                    }  
                });
                
            }); 
}
 



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
</script>