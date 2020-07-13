<style>
    <!--
    .margin-bottom-5{
        margin-bottom: 5px;
    }
    -->
    .select2{
		width : 100% !important;
	}
</style>
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/selectize.bootstrap3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/datepicker3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css">

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3>Add Outlets</h3>
        </div>
    </div>
    <form id="addoutlets" name="addoutlets" action="" method="post" autocomplete="off" >
        <div class="tab-content">
            <div id="basic" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" >
                                Add Outlets
                            </div>
                            <div class="panel-body">
							
                                <div class="row"> 
                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-landmark">
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
                                        <div class="messageContainer  "></div>
                                    </div>

                                     <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label col-sm-5">Outlet Name <span class='text-danger'>*</span></label>
                                            <div class="col-sm-12 ">
                                                <input type="text" class="form-control" id="outlet_name" name="outlet_name" />
                                            </div>
                                            <div class="messageContainer  "></div>
                                        </div>
                                    </div>
								
                                </div>
                                
                                <div class="row">  
                                        <div class="col-lg-6 margin-bottom-5">
                                            <div class="form-group" id="error-landmark">
                                                <label class="control-label col-sm-5">City <span class='text-danger'>*</span></label>
                                                <div class="col-sm-12 ">
                                                    <select name="city_id" id="city_id" class="form-control floating">
                                                        <option value=""> Select City</option>
                                                        <?php foreach ($cities as $city) { ?>
                                                            <option value="<?php echo $city['id']; ?>" ><?php echo $city['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="messageContainer  "></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 margin-bottom-5">
                                            <div class="form-group" id="error-pincode">
                                                <label class="control-label col-sm-5">Address <span class='text-danger'>*</span></label>
                                                <div class="col-sm-12 ">
                                                    <!-- <textarea name="address" id="address" style="width: 100%; height:  auto;"></textarea> -->
                                                     <input type="text" class="form-control" name="address" id="address"/>
                                                </div>
                                                <div class="messageContainer  "></div>
                                            </div>
                                        </div>  
                                </div>
                                <div class="row">   
                                        <div class="col-lg-6 margin-bottom-5">
                                            <div class="form-group" id="error-mstart_time">
                                                <label class="control-label col-sm-5">Name (Outlet Manager)<span class='text-danger'>*</span></label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="manager_name" name="manager_name" required />
                                                </div>
                                                <div class="messageContainer col-sm-10"></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 margin-bottom-5">
                                            <div class="form-group" id="error-landline_2">
                                                <label class="control-label col-sm-5">Mobile (Outlet Manager)<span class='text-danger'>*</span></label>
                                                <div class="col-sm-12 ">
                                                    <input type="text" class="form-control" id="manager_mobile" name="manager_mobile"/>
                                                </div>
                                                <div class="messageContainer  "></div>
                                            </div>
                                        </div>
                                </div>        
                                <div class="row">  
                                        <div class="col-lg-6 margin-bottom-5">
                                            <div class="form-group" id="error-name">
                                                <label class="control-label col-sm-5">Email (Outlet Manager)<span class='text-danger'>*</span></label>
                                                <div class="col-sm-12 ">
                                                    <input type="email" class="form-control" id="manager_email" name="manager_email" />
                                                </div>
                                                <div class="messageContainer  "></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 margin-bottom-5">
                                            <div class="form-group" id="error-name">
                                                <label class="control-label col-sm-5">Other Contact Person <span class='text-danger'>*</span></label>
                                                <div class="col-sm-12 ">
                                                    <input type="text" class="form-control" id="other_contact_person" name="other_contact_person" />
                                                </div>
                                                <div class="messageContainer  "></div>
                                            </div>
                                        </div> 
                                </div>           
                                 <div class="row">   
                                         <div class="col-lg-6 margin-bottom-5">
                                            <div class="form-group form-focus select-focus">
                                                        <label class="control-label">Status<span class='text-danger'>*</span></label>
                                                        <select class="select form-control floating" id="status" name="status" required>
                                                            <option value="">Select Status</option>
                                                            <option value="1">Enable</option>
                                                            <option value="0">Disable</option>
                                                        </select>
                                            </div>
                                        <div class="messageContainer"></div> 
                                    </div>  
                                </div>                       
                              <div class="row">
                				<div class="col-lg-12 margin-bottom-5 text-center">
                				<div id="response"></div>
                					<button type="submit" id="couponbtn"  class="btn btn-success">Submit</button>
                				</div>
			                 </div>
                          <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </form>
</div>
<script src="<?php echo asset_url(); ?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo asset_url(); ?>js/selectize.min.js"></script>
<script src="<?php echo asset_url(); ?>js/jquery.form.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script> 

$('#addoutlets').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {

    	    client_id: {
                validators: {
                    notEmpty: {
                        message: 'Client is required and cannot be empty'
                    }
                }
            },
            outlet_name: {
                validators: {
                    notEmpty: {
                        message: 'Outlet Name is required and cannot be empty'
                    },
                    regexp: {
                        regexp: '^[A-Za-z ]+$',
                        message: 'Only Characters Allowed'
                    }
                }
            },

            address: {
                validators: {
                    notEmpty: {
                        message: 'Address is required and cannot be empty'
                    }
                }
            },

            manager_name: {
                validators: {
                    notEmpty: {
                        message: 'Manager Name is required and cannot be empty'
                    }, 
                    regexp: {
                        regexp: '^[A-Za-z ]+$',
                        message: 'Only Characters Allowed'
                    } 
                }
            },

            manager_mobile: {
                validators: {
                    notEmpty: {
                        message: 'Manager mobile is required and cannot be empty'
                    },
                    regexp: {
                        regexp: '^[7-9][0-9]{9}$',
                        message: 'Invalid Mobile Number'
                    }
                }
            },

            manager_email: {
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

            other_contact_person: {
                validators: {
                    notEmpty: {
                        message: 'Other Contact Person is required and cannot be empty'
                    },
                     regexp: {
                        regexp: '^[A-Za-z ]+$',
                        message: 'Only Characters Allowed'
                    } 
                }
            },
            city_id: {
                validators: {
                    notEmpty: {
                        message: 'City is required and cannot be empty'
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
        /*image: {
            validators: {
                notEmpty: {
                    message: 'Please select an image'
                },
                file: {
                    extension: 'jpeg,jpg,png',
                    type: 'image/jpeg,image/png',
                    maxSize: 2097152,   // 2048 * 1024
                    message: 'The selected file is not valid'
                }
            }
        }*/
      
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	addOutlets();
});

 
function addOutlets(){
	ajaxindicatorstart("Please wait.. while Adding..");
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'client/outlet/add',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#addoutlets').ajaxSubmit(options);
}
function showAddRequest(formData, jqForm, options){
	ajaxindicatorstop();
	$("#response").hide();
   	var queryString = $.param(formData);
	return true;
}
   	
function showAddResponse(resp, statusText, xhr, $form){
	if(resp.status == '0') {
		ajaxindicatorstop();
		$("#response").removeClass('alert-success');
       	$("#response").addClass('alert-danger');
		$("#response").html(resp.msg.name);
		alert(resp.msg);
		$("#response").show();
  	} else {
  		ajaxindicatorstop();
  		$("#response").removeClass('alert-danger');
        $("#response").addClass('alert-success');
        $("#response").html(resp.msg);
        $("#response").show();
        alert(resp.msg);
        window.location.href = base_url+"client/outlet/list";
  	}
}

 $.getScript("//maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyA92M4tQATmUa-sQahIxITnLLSOqXa0-6o&libraries=places&sensor=false&callback=initMap");

    function initMap() {
        var options = {
            componentRestrictions: {country: 'in'}
        };
        var input = document.getElementById('address');
        var autocomplete = new google.maps.places.Autocomplete(input, options);
        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
           // $('#latitude').val(place.geometry.location.lat());
           // $('#longitude').val(place.geometry.location.lng());
        });
    }
</script>
 