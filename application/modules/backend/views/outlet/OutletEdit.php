
<?php echo "123"; ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <!-- .page title -->
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Edit Outlet</h4>
            </div>
            <!-- /.page title -->
        </div>

        <div class="row" style="margin:0 -30px;">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <form id="editoutlet" name="editoutlet" action="" method="post" enctype="multipart/form-data"> 
                            <input type="hidden" id="id" name="id" value="<?php echo $outlet[0]['id']; ?>">   
                            <div class="panel-body"> 
                                    <div class="row"> 
                                      <div class="col-md-6"> 
                                            <div class="form-group form-focus">
                                                <label class="control-label col-sm-5">Select Company <span class='text-danger'>*</span></label>

                                                <select name="client_id" id="client_id" class="form-control floating">
                                                    <option value=""> Select Company Name</option>
                                                    <?php foreach ($clients as $value) {
                                                        if ($value['status'] == 1 || $outlet[0]['client_id'] == $value['id']) {?>
                                                            <option value="<?= $value['id']; ?>" <?= $outlet[0]['client_id'] == $value['id'] ? 'selected' : '';?>><?= $value['reg_company_name']; ?></option>
                                                        <?php } } ?>  
                                                </select>
                                            </div>
                                            <div class="messageContainer"></div> 
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group form-focus select-focus">
                                                <label class="control-label">Outlet Name<span class='c-input--danger'>*</span></label>
                                                <input type="text" id="outlet_name" name="outlet_name" value="<?php echo $outlet[0]['outlet_name']; ?>" class="form-control floating" placeholder="Enter Outlet Name" autocomplete="off">   
                                            </div>
                                            <div class="messageContainer"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-focus select-focus">
                                                 <label class="control-label col-sm-5">City <span class='text-danger'>*</span></label>
                                                <div class="col-sm-12 "> 
                                                  <select name="city_id" id="city_id" class="form-control floating"> 
                                                     <?php if (!empty($cities)) { ?>
                                                        <?php foreach ($cities as $item) { ?>
                                                            <option value="<?php echo $item['id']; ?>" <?= $outlet[0]['cityid'] == $item['id'] ? 'selected' : '';?>><?php echo $item['name']; ?></option>
                                                    <?php } } ?> 
                                                </select> 
                                                </div>
                                            </div>
                                            <div class="messageContainer"></div>
                                        </div>
                                        <div class="col-lg-6 margin-bottom-5">
                                            <div class="form-group" id="error-pincode">
                                                <label class="control-label col-sm-5">Address <span class='text-danger'>*</span></label>
                                                <div class="col-sm-12 ">
                                                    <!-- <textarea name="address" style="width: 100%; height:  auto;"><?php echo $outlet[0]['address']; ?></textarea> -->
                                                    <input type="text" class="form-control" value="<?php echo $outlet[0]['address']; ?>" name="address" id="address" placeholder="Enter a location" autocomplete="off"/> 
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
                                                    <input type="text" class="form-control" id="manager_name" name="manager_name" value="<?php echo $outlet[0]['manager_name']; ?>" required />
                                                </div>
                                                <div class="messageContainer col-sm-10"></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 margin-bottom-5">
                                            <div class="form-group" id="error-landline_2">
                                                <label class="control-label col-sm-5">Mobile (Outlet Manager)<span class='text-danger'>*</span></label>
                                                <div class="col-sm-12 ">
                                                    <input type="text" class="form-control" id="manager_mobile" name="manager_mobile" value="<?php echo $outlet[0]['manager_mobile']; ?>" />
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
                                                        <input type="email" class="form-control" id="manager_email" name="manager_email" value="<?php echo $outlet[0]['manager_email']; ?>" />
                                                    </div>
                                                    <div class="messageContainer  "></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 margin-bottom-5">
                                                <div class="form-group" id="error-name">
                                                    <label class="control-label col-sm-5">Other Contact Person <span class='text-danger'>*</span></label>
                                                    <div class="col-sm-12 ">
                                                        <input type="text" class="form-control" id="other_contact_person" name="other_contact_person"  value="<?php echo $outlet[0]['poc_name']; ?>"/>
                                                    </div>
                                                    <div class="messageContainer  "></div>
                                                </div>
                                            </div> 
                                    </div>    
                                    <div class="row">
                                                    
                                        <div class="col-md-6">
                                            <div class="form-group form-focus select-focus">
                                                <label class="control-label">Status<span class='c-input--danger'>*</span></label>
                                                <select class="select form-control floating" id="status" name="status" required>
                                                    <option value="">Select Status</option>
                                                    <option value="1" <?= $outlet[0]['status'] == 1 ?'selected':'';?>>Enable</option>
                                                    <option value="0" <?= $outlet[0]['status'] == 0 ?'selected':'';?>>Disable</option>
                                                </select>
                                            </div>
                                            <div class="messageContainer"></div>
                                        </div>
                                     </div>  
                                    <div class="form-actions text-center" style="margin-top: 30px;">
                                            <div id="response"></div>
                                            <button class="btn btn-danger btn-lg" type="submit">Update</button>
                                    </div> 
                           </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  

<script src="<?php echo asset_url(); ?>/js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url(); ?>/js/jquery.form.js"></script>
<script>
    $('#editoutlet').bootstrapValidator({
        container: function ($field, validator) {
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
            
        }
    }).on('success.form.bv', function (event, data) {
        // Prevent form submission
        event.preventDefault();
        editOutlet();
    });
    function editOutlet() {
        ajaxindicatorstart("Please wait.. while Updating..");  
        var options = {
            target: '#response',
            beforeSubmit: showAddRequest,
            success: showAddResponse,
            url: base_url + 'client/outlet/update',
            semantic: true,
            dataType: 'json'
        };
        $('#editoutlet').ajaxSubmit(options);
    }

    function showAddRequest(formData, jqForm, options) {
        ajaxindicatorstop();
        $("#response").hide();
        var queryString = $.param(formData);
        return true;
    }

    function showAddResponse(resp, statusText, xhr, $form) {
        ajaxindicatorstop();
        if (resp.status == '0') {
            $("#response").removeClass('alert-success');
            $("#response").addClass('alert-danger');
            $("#response").html(resp.msg);
            alert(resp.msg);
            $("#response").show();
        } else {
            $("#response").removeClass('alert-danger');
            $("#response").addClass('alert-success');
            $("#response").html(resp.msg);
            $("#response").show();
            alert(resp.msg);
            window.location.href = base_url + "client/outlet/list";
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
 
 