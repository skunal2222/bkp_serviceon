
<?php echo "123"; ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <!-- .page title -->
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Edit Bike</h4>
            </div>
            <!-- /.page title -->
        </div>

        <div class="row" style="margin:0 -30px;">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <form id="editbike" name="editbike" action="" method="post" enctype="multipart/form-data"> 
                            <input type="hidden" id="id" name="id" value="<?php echo $bike[0]['id']; ?>">   
                            <div class="panel-body"> 
                                    <div class="row"> 
                                      <div class="col-md-6"> 
                                            <div class="form-group form-focus">
                                                <label class="control-label col-sm-5">Select Company <span class='text-danger'>*</span></label>

                                                <select name="client_id" id="client_id" class="form-control floating">
                                                    <option value=""> Select Company Name</option>
                                                    <?php foreach ($clients as $value) {
                                                        if ($value['status'] == 1 || $bike[0]['client_id'] == $value['id']) {?>
                                                            <option value="<?= $value['id']; ?>" <?= $bike[0]['client_id'] == $value['id'] ? 'selected' : '';?>><?= $value['reg_company_name']; ?></option>
                                                        <?php } } ?>  
                                                </select>
                                            </div>
                                            <div class="messageContainer"></div> 
                                        </div>
                                        <div class="col-md-6"> 
                                            <div class="form-group form-focus">
                                                <label class="control-label col-sm-5">Select Outlet <span class='text-danger'>*</span></label>

                                                <select name="outlet_id" id="outlet_id" class="form-control floating">
                                                    <option value=""> Select Outlet Name</option>
                                                    <?php foreach ($outlet as $value) {
                                                        if ($value['status'] == 1 || $bike[0]['outlet_id'] == $value['id']) {?>
                                                            <option value="<?= $value['id']; ?>" <?= $bike[0]['outlet_id'] == $value['id'] ? 'selected' : '';?>><?= $value['outlet_name']; ?></option>
                                                        <?php } } ?>  
                                                </select>
                                            </div>
                                            <div class="messageContainer"></div> 
                                        </div>
                                    </div>
                                    <div class="row"> 
                                         
                                         <div class="col-md-6">
                                            <div class="form-group form-focus select-focus">
                                                <label class="control-label">Bike Name<span class='c-input--danger'>*</span></label>
                                                <input type="text" id="bike_name" name="bike_name" value="<?php echo $bike[0]['bike_name']; ?>" class="form-control floating" placeholder="Enter Bike Name" autocomplete="off">   
                                            </div>
                                            <div class="messageContainer"></div>
                                        </div> 
                                         <div class="col-lg-6 margin-bottom-5">
                                            <div class="form-group" >
                                                <label class="control-label col-sm-5">Bike Number<span class='text-danger'>*</span></label>
                                                <div class="col-sm-12 ">
                                                    <input type="text" class="form-control" id="bike_number"
                                                    value="<?php echo $bike[0]['bike_number']; ?>" name="bike_number"/>
                                                </div>
                                                <input id="model_id" type="hidden" value="<?= $bike[0]['model_id']?>" name="model_id">
                                                <div class="messageContainer"></div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row">   
                                         <div class="col-lg-6 margin-bottom-5">
                                            <div class="form-group" id="error-mstart_time">
                                                <label class="control-label col-sm-5">Rider Name<span class='text-danger'>*</span></label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="rider_name" name="rider_name" value="<?php echo $bike[0]['rider_name']; ?>" required />
                                                </div>
                                                <div class="messageContainer col-sm-10"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 margin-bottom-5">
                                            <div class="form-group" id="error-name">
                                                <label class="control-label col-sm-5">Rider Mobile<span class='text-danger'>*</span></label>
                                                <div class="col-sm-12 ">
                                                    <input type="text" class="form-control" id="rider_mobile" name="rider_mobile" value="<?php echo $bike[0]['rider_mobile']; ?>" />
                                                </div>
                                                <div class="messageContainer"></div>
                                            </div>
                                        </div>
                                    </div>        
                                    <div class="row">  
                                            <div class="col-lg-6 margin-bottom-5">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-5">KM's Run <span class='text-danger'>*</span></label>
                                                    <div class="col-sm-12 ">
                                                        <input type="text" class="form-control" id="km_run" name="km_run" value="<?php echo $bike[0]['km_run']; ?>" />
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                            </div> 
                                            <div class="col-lg-6 margin-bottom-5">
                                                <div class="form-group form-focus">
                                                  <label class="control-label">Last Servicing Date</label>
                                                    <input type="text" name="last_servicing_date" id="last_servicing_date" value="<?php echo date('d-m-Y',strtotime($bike[0]['last_servicing_date'])); ?>" placeholder="Start Date" class="form-control floating date_picker" autocomplete="off">
                                               </div>
                                            </div> 
                                    </div>    
                                    <div class="row">
                                                    
                                        <div class="col-md-6">
                                            <div class="form-group form-focus select-focus">
                                                <label class="control-label">Status<span class='c-input--danger'>*</span></label>
                                                <select class="select form-control floating" id="status" name="status" required>
                                                    <option value="">Select Status</option>
                                                    <option value="1" <?= $bike[0]['status'] == 1 ?'selected':'';?>>Enable</option>
                                                    <option value="0" <?= $bike[0]['status'] == 0 ?'selected':'';?>>Disable</option>
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
<script src="<?php echo asset_url(); ?>js/bootstrap-typeahead.min.js"></script>
<script src="<?php echo asset_url(); ?>/js/bootstrapValidator.min.js"></script> 
<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url(); ?>/js/jquery.form.js"></script>
<script>
    
$('#last_servicing_date').datepicker({
    autoclose:true,
   // startDate : date,
    format: 'dd-mm-yyyy'
}).on('change',function(e){
   $('#editbike').bootstrapValidator('revalidateField', $('#last_servicing_date'));
});

    $('#editbike').bootstrapValidator({
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
                        message: 'Company is required and cannot be empty'
                    }
                }
            },
            outlet_id: {
                validators: {
                    notEmpty: {
                        message: 'Outlet Name is required and cannot be empty'
                    }
                }
            },
            bike_name: {
                validators: {
                    notEmpty: {
                        message: 'Bike Name is required and cannot be empty'
                    },
                     regexp: {
                        regexp: '^[A-Za-z]+$',
                        message: 'Only Characters Allowed'
                    } 
                }
            },

            bike_number: {
                validators: {
                    notEmpty: {
                        message: 'Bike Number is required and cannot be empty'
                    }
                }
            },
             model_id: {
                validators: {
                    notEmpty: {
                        message: 'Bike Number is required and cannot be empty'
                    }
                }
            },

            rider_name: {
                validators: {
                    notEmpty: {
                        message: 'Rider Name is required and cannot be empty'
                    },
                     regexp: {
                        regexp: '^[A-Za-z]+$',
                        message: 'Only Characters Allowed'
                    } 
                }
            },

            rider_mobile: {
                validators: {
                    notEmpty: {
                        message: 'Rider mobile is required and cannot be empty'
                    },
                    regexp: {
                        regexp: '^[7-9][0-9]{9}$',
                        message: 'Invalid Mobile Number'
                    }
                }
            }, 
            km_run: {
                validators: {
                    notEmpty: {
                        message: 'Km Run is required and cannot be empty'
                    },
                     regexp: {
                        regexp: '^[0-9]+$',
                        message: 'Only Digits Allowed'
                    } 
                }
            },
            last_servicing_date: {
                validators: {
                    notEmpty: {
                        message: 'Servicing Date is required and cannot be empty'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'The Start Date is not a valid'
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
        editBike();
    });
    function editBike() {
        ajaxindicatorstart("Please wait.. while Updating.."); 
        var options = {
            target: '#response',
            beforeSubmit: showAddRequest,
            success: showAddResponse,
            url: base_url + 'client/bike/update',
            semantic: true,
            dataType: 'json'
        };
        $('#editbike').ajaxSubmit(options);
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
            window.location.href = base_url + "client/bike/list";
        }
    } 
    
    $("#bike_name").typeahead({
        onSelect: function (item) {
            $('#model_id').val(item.value);
            $('#addbikes').bootstrapValidator('revalidateField', 'model_id');
        },
        ajax: {
            url: base_url + "client/bike/byname",
            timeout: 500,
            displayField: "name",
            triggerLength: 1,
            method: "get",
            loadingClass: "loading-circle",
            preDispatch: function (query) {
                return {
                    name: query
                }
            },
            preProcess: function (data) {
                if (data.success === false) {
                    return false;
                }
                return data;
            }
        }

    });
</script> 
 
 