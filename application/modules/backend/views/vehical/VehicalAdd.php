<style>
    <!--
    .margin-bottom-5 {
        margin-bottom: 5px;
    }
    -->
    .readonly-ctrl{
        background-color: #fff !important;
    }
</style>
<link href="<?php echo asset_url(); ?>css/datepicker3.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css">

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3>Add Vehicle</h3>
        </div>
    </div>
    <form id="addvehical" name="addvehical" action="" method="post" enctype="multipart/form-data">
        <div class="tab-content">
            <div id="basic" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <input type="hidden" name="item[userid]" id="userid" value=""/> 
                                <span class='text-danger'>*Note: You can add vehicle for existing user only.</span> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label">Customer Mobile<span class='text-danger'>*</span></label>
                                            <input type="text" class="form-control" name="item[mobile]" id="mobile" autocomplete="off"/>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label">Customer Name<span class='text-danger'>*</span></label>
                                            <input type="text" class="form-control" name="item[name]" id="name" autocomplete="off"/>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label">Vehicle Number<span class='text-danger'>*</span></label>
                                            <input type="text" class="form-control" name="item[vehical_no]" id="vehicalno" autocomplete="off"/>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>

                                   <!--  <div class="col-md-6">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label">Brand<span class='text-danger'>*</span></label>
                                            <select name="item[brand_id]" id="brand_id" class="form-control">
                                                <option value=""> Select Brand </option>                                                    
                                             </select>
                                        </div>
                                        <div class="messageContainer"></div>
                                     </div>  --> 
                                    <div class="col-md-6">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label">Brand<span class='text-danger'>*</span></label>
                                            <select name="item[brand_id]" id="brand_id" class="form-control">
                                                <option value=""> Select Brand </option>
                                                <?php foreach ($brands as $brand) { ?>
                                                    <option value="<?php echo $brand['id']; ?>"><?php echo $brand['name']; ?></option>
                                                <?php }
                                                ?>
                                            </select>

                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label">Model<span class='text-danger'>*</span></label>
                                            <select name="item[model_id]" id="model_id" class="form-control">
                                                <option value=""> Select Model</option> 
                                            </select>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="form-group form-focus select-focus">
                                            <label class="control-label">Status<span class='c-input--danger'>*</span></label>
                                            <select class="select form-control floating" id="status" name="item[status]" required> 
                                                <option value="1">Enable</option>
                                                <option value="0">Disable</option>
                                            </select>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>
                                   <!--  <div class="col-md-6">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label">License Number </label>
                                            <input type="text" class="form-control" name="item[license_number]" id="license_number" autocomplete="off"/>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>  -->
                                </div>  
                                 <div class="row"> 
                                     <!-- <div class="col-md-6">
                                        <div class="form-group form-focus select-focus">
                                            <label class="control-label">Insurance Bank</label>
                                            <input type="text" class="form-control" name="item[insurance_brand]" id="insurance_brand" autocomplete="off"/>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group form-focus select-focus">
                                            <label class="control-label">Insurance Number </label>
                                            <input type="text" class="form-control" name="item[insurance_number]" id="insurance_number" autocomplete="off"/>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>  --> 
                                    
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
        </div>
        <div id="response"></div>

    </form>
</div>
<script src="<?php echo asset_url(); ?>js/bootstrap-typeahead.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url(); ?>js/jquery.form.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>

<script>
     
    $('#addvehical').bootstrapValidator({
        container: function ($field, validator) {
            return $field.parent().next('div.messageContainer');
        },
        feedbackIcons: {
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {
            'item[mobile]': {
                validators: {
                    notEmpty: {
                        message: 'The Mobile is required and cannot be empty'
                    },
                    regexp: {
                        regexp: '^[7-9][0-9]{9}$',
                        message: 'Invalid Mobile Number'
                    }
                }
            },
            'item[name]': {
                validators: {
                    notEmpty: {
                        message: 'Name is required and cannot be empty'
                    }
                }
            },
            
            'item[vehical_no]': {
                validators: {
                    notEmpty: {
                        message: 'Vehicle Number is required and cannot be empty'
                    }
                }
            },
            'item[brand_id]': {
                validators: {
                    notEmpty: {
                        message: 'Brand is required and cannot be empty'
                    }
                }
            },
            'item[model_id]': {
                validators: {
                    notEmpty: {
                        message: 'Model is required and cannot be empty'
                    }
                }
            }

        }
    }).on('success.form.bv', function (event, data) {
        // Prevent form submission
        event.preventDefault();
        addVehical();
    }); 

    function addVehical() {


        var options = {
            target: '#response',
            beforeSubmit: showAddRequest,
            success: showAddResponse,
            url: base_url + 'admin/vehicle/add',
            semantic: true,
            dataType: 'json'
        };
        $('#addvehical').ajaxSubmit(options);
    }

    function showAddRequest(formData, jqForm, options) {
        $("#response").hide();
        ajaxindicatorstart("Please hang on.. while we add vehical ..");
        var queryString = $.param(formData);
        return true;
    }

    function showAddResponse(resp, statusText, xhr, $form) {
        ajaxindicatorstop();
        alert(resp.msg);
        if (resp.status == '0') {
            $("#response").removeClass('alert-success');
            $("#response").addClass('alert-danger');
            $("#response").html(resp.msg);
            $("#response").show();
        } else {
            $("#response").removeClass('alert-danger');
            $("#response").addClass('alert-success');
            $("#response").html(resp.msg);
            $("#response").show();
            window.location.href = base_url + "admin/vehicle/vehiclelist";
        }
    }
 
    $("#mobile").typeahead({
        onSelect: function (item) {
            itemvalue = item.value;
            $.get(base_url + "admin/user/detail/" + item.value, {}, function (result) {
               // $("#email").val(result.email); 
               
                $("#name").val(result.name);
                $("#userid").val(result.id);
                //$('#addvehical').bootstrapValidator('revalidateField', 'email]');
                $('#addvehical').bootstrapValidator('revalidateField', 'item[mobile]');
            }, 'json');
        },
        ajax: {
            url: base_url + "admin/user/bymobile",
            timeout: 500,
            displayField: "mobile",
            triggerLength: 3,
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
    $("#name").typeahead({
        onSelect: function (item) {
            itemvalue = item.value;
            $.get(base_url + "admin/user/detail/" + item.value, {}, function (result) {
                $("#mobile").val(result.mobile);
                $("#address").html(result.address);
                $("#areaid").val(result.area);
                $("#email").val(result.email);
                $("#landmark").val(result.loc);
                $("#latitude").val(result.latitude);
                $("#longitude").val(result.longitude);
                $("#userid").val(result.id);
                $('#addvehical').bootstrapValidator('revalidateField', 'item[email]');
                $('#addvehical').bootstrapValidator('revalidateField', 'item[mobile]');
            }, 'json');
        },
        ajax: {
            url: base_url + "admin/user/byname",
            timeout: 500,
            displayField: "name",
            triggerLength: 3,
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

    $(document).ready(function () {
        $("#model_id").change(function ()
        {
            var model_id = $('#model_id').val();
            $('#subcategory_id').empty();
            $('#service_id').select2('val', '');
            $('#service_id').html('');
            $('#single_services').select2('val', '');
            $('#single_services').html('');
            $('#spare_id').select2('val', '');
            $('#spare_id').html('');
            console.log(model_id);
            $.post(base_url + "admin/subcategorybycatid2", {model_id: model_id}, function (data)
            {

                $('#subcategory_id').append("<option value=''>" + 'Select Subcategory' + "</option>");
                if (data.subcat.length > 0)
                {
                    for (var i = 0; i < data.subcat.length; i++)
                    {
                        $('#subcategory_id').append("<option value='" + data.subcat[i].id + "'>" + data.subcat[i].name + "</option>");
                    }
                }
                // if (data.spare.length > 0)
                // {
                //     for (var i = 0; i < data.spare.length; i++)
                //     {
                //         $('#spare_id').append("<option value='" + data.spare[i].id + "'>" + data.spare[i].name + "</option>");
                //     }
                // }
            }, 'json');
        });

        $("#category_id").change(function ()
        {
            var cat_id = $('#category_id').val();
            console.log(cat_id);
            $('#model_id').html('');
            $('#brand_id').html('');
            $('#model_id').html('');
            $('#subcategory_id').html('');
            $('#service_id').select2('val', '');
            $('#service_id').html('');
            $('#single_services').select2('val', '');
            $('#single_services').html('');
            $('#spare_id').select2('val', '');
            $('#spare_id').html('');
            
            $.post(base_url + "admin/brandbycatid/", {cat_id: cat_id}, function (data)
            {
                $('#brand_id').empty();
                $('#brand_id').append("<option value=''>" + 'Select Brand' + "</option>");
                if (data.length > 0)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#brand_id').append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
                    }
                }
            }, 'json');
        });

        $("#brand_id").change(function ()
        {
            var brand_id = $('#brand_id').val();
            console.log(brand_id);
            $('#model_id').html('');
            $('#subcategory_id').html('');
            $('#service_id').select2('val', '');
            $('#service_id').html('');
            $('#single_services').select2('val', '');
            $('#single_services').html('');
            $('#spare_id').select2('val', '');
            $('#spare_id').html('');
            $.post(base_url + "admin/modelbybrandid1/", {brand_id: brand_id}, function (data)
            {
                $('#model_id').empty();
                $('#model_id').append("<option value=''>" + 'Select Model' + "</option>");
                if (data.length > 0)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#model_id').append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
                        // $('#model_id').append("</optgroup>");

                    }
                }
            }, 'json');
        });  

    });
</script>
 