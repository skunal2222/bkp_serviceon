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
<style type="text/css">
    .uploadExcelBtn{
        /*margin-top: 15px;*/
        margin-right: 30px;
        margin-left: 15px;
    }
</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h3>Add Bike</h3>
        </div>
        <div class="col-lg-6 text-right" style="padding-top: 15px;">
            <a href="<?=asset_url()?>bike.xls" class="downloadBtn">Download Excel Format</a>
            <a href="#uploadExcel" role="button" class="btn btn-success uploadExcelBtn" data-toggle="modal" >Upload Excel</a>
        </div>
    </div>
    <form id="addbikes" name="addbikes" action="" method="post" >
        <div class="tab-content">
            <div id="basic" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" >
                                Add Bike
                            </div>
                            <div class="panel-body">

                                <div class="row"> 
                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" >
                                            <label class="control-label col-sm-5">Company Name<span class='text-danger'>*</span></label>

                                            <select name="client_id" id="client_id" class="form-control floating">
                                                <option value=""> Select Company Name</option>
                                                <?php
                                                foreach ($clients as $value) {
                                                    if ($value['status'] == 1) {
                                                        ?>
                                                        <option value="<?= $value['id']; ?>" ><?= $value['reg_company_name']; ?></option>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </select> 
                                        </div>
                                        <div class="messageContainer  "></div>
                                    </div>

                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group">
                                            <label class="control-label col-sm-5">Outlet Name<span class='text-danger'>*</span></label>

                                            <select name="outlet_id" id="outlet_id" class="form-control floating"> 
                                                <option value=""> Select Outlet </option>             
                                            </select> 
                                        </div>
                                        <div class="messageContainer  "></div>
                                    </div>



                                </div>

                                <div class="row">   
                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group">
                                            <label class="control-label col-sm-8">Bike Name<span class='text-danger'>* Note: Type & Select Bike Name</span></label>
                                            <div class="col-sm-12 "> 
                                                <input type="text" class="form-control" name="bike_name" id="bike_name"  autocomplete="off"/>
                                            </div>
                                            <input id="model_id" type="hidden" value="" name="model_id">
                                            <div class="messageContainer  "></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" >
                                            <label class="control-label col-sm-5">Bike Number<span class='text-danger'>*</span></label>
                                            <div class="col-sm-12 ">
                                                <input type="text" class="form-control" id="bike_number" name="bike_number"/>
                                            </div>
                                            <div class="messageContainer  "></div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">   
                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Rider Name<span class='text-danger'>*</span></label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="rider_name" name="rider_name" required />
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label col-sm-5">Rider Mobile<span class='text-danger'>*</span></label>
                                            <div class="col-sm-12 ">
                                                <input type="text" class="form-control" id="rider_mobile" name="rider_mobile" />
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
                                                <input type="text" class="form-control" id="km_run" name="km_run" />
                                            </div>
                                            <div class="messageContainer"></div>
                                        </div>
                                    </div> 
                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group form-focus">
                                            <label class="control-label">Last Servicing Date <span class='text-danger'>*</span></label>
                                            <input type="text" name="last_servicing_date" id="last_servicing_date" placeholder="Servicing Date" class="form-control floating date_picker" autocomplete="off">
                                        </div> 
                                        <div class="messageContainer"></div>
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
                                        <button type="submit" class="btn btn-success">Submit</button>
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
<!-- Bulk upload -->

<div id="uploadExcel" class="modal fade" style="padding-top: 86px;">
    <div id="cancel-overlay" class="modal-dialog" style="opacity:1 ;width:400px ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:black"> X </span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Upload your excel sheet</h4>
            </div>
            <div class="modal-body" style="background-color:#f5f5f5;">
            <!-- form -->
            <form id="excelForm" action="javascript:void(0)" method="post" enctype = multipart/form-data>
                <div class="row" style="padding:10px">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password" class="control-label">Select files</label>
                            <input type="file" name="userfiles" id="userfiles">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
                <!-- end of form -->
            </div>
        </div>
    </div>
</div>
<!-- end of bulk upload -->
<script src="<?php echo asset_url(); ?>js/bootstrap-typeahead.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url(); ?>js/jquery.form.js"></script>

<script>




    $('#last_servicing_date').datepicker({
        autoclose: true,
        // startDate : date,
        format: 'dd-mm-yyyy',
        endDate: "today"

    }).on('change', function (e) {
        $('#addbikes').bootstrapValidator('revalidateField', $('#last_servicing_date'));
    });

    $('#addbikes').bootstrapValidator({
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
            model_id: {
                validators: {
                    notEmpty: {
                        message: 'Bike Number is required and cannot be empty'
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
    }).on('success.form.bv', function (event, data) {
        // Prevent form submission
        event.preventDefault();
        addBike();
    });


    function addBike() {
        ajaxindicatorstart("Please wait.. while Adding..");
        var options = {
            target: '#response',
            beforeSubmit: showAddRequest,
            success: showAddResponse,
            url: base_url + 'client/bike/add',
            semantic: true,
            dataType: 'json'
        };
        $('#addbikes').ajaxSubmit(options);
    }
    function showAddRequest(formData, jqForm, options) {
        ajaxindicatorstop();
        $("#response").hide();
        var queryString = $.param(formData);
        return true;
    }

    function showAddResponse(resp, statusText, xhr, $form) {
        if (resp.status == '0') {
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
            window.location.href = base_url + "client/bike/list";
        }
    }
    /*Excel uploading*/

    $('#uploadExcel').bootstrapValidator({
        container: function ($field, validator) {
            return $field.parent().next('.messageContainer');
        },
        feedbackIcons: {
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {
        }
    }).on('success.form.bv', function (event, data) {
        // Prevent form submission
        event.preventDefault();
        uploadExcel();
    });

    function uploadExcel(){
        ajaxindicatorstart("Please wait.. while Adding..");
        var options = {
            target: '#response',
            beforeSubmit: showUploadRequest,
            success: showUploadResponse,
            url: base_url + 'client/bike/excel',
            semantic: true,
            dataType: 'json'
        };
        $('#excelForm').ajaxSubmit(options);
    }

    function showUploadRequest(formData, jqForm, options) {
        ajaxindicatorstop();
        $("#response").hide();
        var queryString = $.param(formData);
        return true;
    }

    function showUploadResponse(resp, statusText, xhr, $form) {
      console.log(resp);
      if(resp.status == 1){
        alert(resp.msg);
        if(resp.redirection == 1){
          window.open(base_url+'client/bike/create', '_blank');  
        }
        window.location.href = base_url+'client/bike/list';
      }else{
        alert(resp.msg);
        $('#userfiles').val('');
        $("#uploadExcel").modal('hide');
      }
    }
    /*end of excel uploading*/

    $("#client_id").change(function () {
        var client_id = $('#client_id').val();
        console.log(client_id);
        ajaxindicatorstart("Please wait....");
        $.post(base_url + "client/outletbyclientid/", {client_id: client_id}, function (data) {
            ajaxindicatorstop();
            console.log(data);
            $('#outlet_id').empty();
            $('#outlet_id').append("<option value=''>" + 'Select Outlet' + "</option>");

            if (data.length > 0)
            {
                for (var i = 0; i < data.length; i++)
                {
                    $('#outlet_id').append("<option value='" + data[i].id + "'>" + data[i].outlet_name + "</option>");
                }
            }
        }, 'json');
    });


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
