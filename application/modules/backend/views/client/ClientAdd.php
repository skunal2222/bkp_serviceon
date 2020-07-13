<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <!-- .page title -->
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Add Client</h4>
            </div>
            <!-- /.page title -->
        </div>

        <div class="row" style="margin:0 -30px;">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <form id="addclient" name="addclient" action="" method="post" enctype="multipart/form-data">
                                <div class="form-body"> 
                                    <div class="tab-content">  
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus select-focus">
                                                        <label class="control-label">First Name (Primary)<span class='c-input--danger'>*</span></label>
                                                        <input type="text" id="first_name" name="first_name" class="form-control floating" placeholder="Enter First Name" autocomplete="off">   
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <label class="control-label">Last Name (Primary)<span class='c-input--danger'>*</span></label>
                                                        <input type="text" id="last_name" name="last_name" class="form-control floating" placeholder="Enter Last Name" autocomplete="off">   
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                            </div>
                                            <div class="row"> 
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <label class="control-label">Registered Company Name<span class='c-input--danger'>*</span></label>
                                                        <input type="text" id="reg_company_name" name="reg_company_name" class="form-control floating" placeholder="Enter Company Name" autocomplete="off">   
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <label class="control-label">Contact Person Name<span class='c-input--danger'>*</span></label>
                                                        <input type="text" id="poc_name" name="poc_name" class="form-control floating" placeholder="Enter Contact Person's Name" autocomplete="off">   
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                            </div>
                                            <div class="row">    
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus select-focus">
                                                        <label class="control-label">Contact Person Mobile No<span class='c-input--danger'>*</span></label>
                                                        <input type="text" id="poc_mob" name="poc_mob" class="form-control floating" placeholder="Enter Mobile No" autocomplete="off">   
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <label class="control-label">Contact Person Email<span class='c-input--danger'>*</span></label>
                                                        <input type="text" id="poc_email" name="poc_email" class="form-control floating" placeholder="Enter Email" autocomplete="off">   
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                            </div>
                                            <div class="row">                    
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus select-focus">
                                                        <label class="control-label">GST No <span class='c-input--danger'>*</span> (e.g 29AAAAA0000A1Z5) </label>
                                                        <input type="text" id="gst_no" name="gst_no" class="form-control floating" placeholder="Enter GST No" autocomplete="off">   
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus select-focus">
                                                        <label class="control-label">Upload Your Documents(PAN/ADHAR)<span class='c-input--danger'>*</span></label>
                                                        <input type="file" id="doc_url" name="doc_url[]" class="form-control floating"  multiple="multiple" >
                                                        <span>Note: Supported image format: .jpeg, .jpg, .png</span>
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                            </div>  
                                            <div class="row"> 
                                                 <div class="col-md-6">
                                                    <div class="form-group form-focus select-focus">
                                                        <label class="control-label">Billing Cycle<span class='c-input--danger'>*</span></label>
                                                        <select class="select form-control floating" id="billing_cycle" name="billing_cycle" required>
                                                            <option value="">Select Billing Cycle</option>
                                                            <option value="1">Weekly</option>
                                                            <option value="2">Fortnightly</option>
                                                            <option value="3">Monthly</option>
                                                            <option value="4">Quarterly</option>
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus select-focus">
                                                        <label class="control-label">Package Payment Type<span class='c-input--danger'>*</span></label>
                                                        <select class="select form-control floating"  name="package_payment_type" required>
                                                            <option value="">Select Package Payment Type</option>
                                                            <option value="1">Up front(100%)</option>
                                                            <option value="2">Partially(50%)</option>
                                                            <option value="3">Divided in orders</option>
                                                           
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus select-focus">
                                                        <label class="control-label">Status<span class='c-input--danger'>*</span></label>
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
                                                   <div class="form-actions text-center" style="margin-top: 30px;">
                                                        <div id="response"></div>
                                                        <button class="btn btn-danger btn-lg" type="submit">Save </button>
                                                   </div>
                                            </div>  
                                        </div> 
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>

</div>

<script src="<?php echo asset_url(); ?>/js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url(); ?>/js/jquery.form.js"></script>
<script>
    $('#addclient').bootstrapValidator({
        container: function ($field, validator) {
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
                        message: 'First name is required and cannot be empty'
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
                        message: 'Last name  is required and cannot be empty'
                    },
                    regexp: {
                        regexp: '^[A-Za-z]+$',
                        message: 'Only Characters Allowed'
                    }
                }
            }, 
            reg_company_name: {
                validators: {
                    notEmpty: {
                        message: 'Registered company name  is required and cannot be empty'
                    }
                }
            },
            poc_name: {
                validators: {
                    notEmpty: {
                        message: 'Contact person name  is required and cannot be empty'
                    },
                    regexp: {
                        regexp: '^[A-Za-z ]+$',
                        message: 'Only Characters Allowed'
                    }
                }
            },
            poc_mob: {
                validators: {
                    notEmpty: {
                        message: 'Contact person mobile number is required and cannot be empty'
                    },
                    regexp: {
                        regexp: '^[7-9][0-9]{9}$',
                        message: 'Invalid Mobile Number'
                    }
                }
            },
            gst_no: {
                validators: {
                  /*  notEmpty: {
                        message: 'GST number is required and cannot be empty'
                    },*/
                     regexp: {
                        regexp: '^([0][1-9]|[1-2][0-9]|[3][0-5])([a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9a-zA-Z]{1}[zZ]{1}[0-9a-zA-Z]{1})+$',
                        message: 'Invalid GST Number'
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
            poc_email: {
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
            'doc_url[]': {
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
            },
             billing_cycle: {
                validators: {
                    notEmpty: {
                        message: 'Billing Cycle is required and cannot be empty'
                    }
                }
            },
            package_payment_type :{
                validators: {
                    notEmpty: {
                        message: 'Package Payment Type is required and cannot be empty'
                    }
                }
            }
            
        }
    }).on('success.form.bv', function (event, data) {
        // Prevent form submission
        event.preventDefault();
        addClient();
    });
    function addClient() {
        var options = {
            target: '#response',
            beforeSubmit: showAddRequest,
            success: showAddResponse,
            url: base_url + 'client/add',
            semantic: true,
            dataType: 'json'
        };
        $('#addclient').ajaxSubmit(options);
    }

    function showAddRequest(formData, jqForm, options) {
        ajaxindicatorstart("Loading..");
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
            window.location.href = base_url + "client/clientlist";
        }
    }

</script>

</head>
</html>