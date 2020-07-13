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
            <h3>Add New Order</h3>
        </div>
    </div>
    <form id="addorder" name="addorder" action="" method="post" enctype="multipart/form-data">
        <div class="tab-content">
            <div id="basic" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <input type="hidden" name="item[userid]" id="userid" value=""/>
                                <input type="hidden" name="item[latitude]" id="latitude" value=""/>
                                <input type="hidden" name="item[longitude]" id="longitude" value=""/> 
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
                                            <label class="control-label">Customer Email<span class='text-danger'>*</span></label>
                                            <input type="text" class="form-control" name="item[email]" id="email" autocomplete="off"/>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>

                                    <!-- 	<div class="col-md-6">
                                                    <div class="form-group" id="error-name">
                                                            <label class="control-label">Customer Area<span class='text-danger'>*</span></label>
                                                            <select name="item[areaid]" id="areaid" class="form-control">
                                                                    <option value=""> Select Area</option>
                                    <?php foreach ($areas as $area) { ?>
                                                                                    <option value="<?php echo $area['id']; ?>"><?php echo $area['name']; ?></option>
                                    <?php }
                                    ?>
                                                                    </select>
                                                    </div>
                                                    <div class="messageContainer"></div>
                                            </div>-->
                                    <div class="col-md-6">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label">Customer Area (Pickup Point)<span class='text-danger'>*</span></label>
                                            <input type="text" class="form-control" name="item[landmark]" id="landmark"/>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label">Vehicle<span class='text-danger'>* </span></label>
                                            <a href="#VehicleModel" role="button" id="vehicle" data-toggle="modal" style="margin-top: 5px;"> + Add</a>
                                            <select name="item[vehical_no]" id="vehicle_no" class="form-control ch_vehicle">
                                                   <option value="" >Select Vehicle</option>                                                     
                                            </select>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label">Vendor List<span class='text-danger'>* </span></label>
                                            <select name="item[vendor_id]" id="vendor_id" class="form-control">
                                                   <option value="" >Select Vendor</option>
                                            </select>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="sub-cat">
                                            <label class="control-label">Subcategory<span class='text-danger'>* </span></label>
                                            <select name="subcategory_id[]" id="subcategory_id" class="form-control" onchange="getSpareList(this.value)">
                                                <option value="" >
                                                    Select Subcategory
                                                </option>                                           
                                            </select>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>
  
                                     <div class="col-md-6">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label">Package (Optional)</label>
                                            <select name="package_id" id="package_id" class="form-control">
                                                <option value="" >
                                                    Select Package
                                                </option>                                           
                                            </select>
                                        </div>
                                        <span class='text-danger' id="first-note">Note: New Order </span> 
                                         <span class='text-danger' id="second-note"></span>  
                                        <div class="messageContainer"></div>
                                    </div>  
                                    
                                    <div class="col-md-6">
                                        <div class="form-group" id="serv-grp">
                                            <label class="control-label">Service Group<span class='text-danger'></span></label>
                                            <select name="service_id[]" id="service_id" class="form-control" multiple="true">
                                                <?php foreach ($servicegroup as $value) { ?>
                                                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="single-serv">
                                            <label class="control-label">Service</label>
                                            <select name="single_services[]" id="single_services" class="form-control" multiple="true">

                                            </select>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="spare-id">
                                            <label class="control-label">Spare<span class='text-danger'></span></label>
                                            <select name="spare_id[]" id="spare_id" class="form-control" multiple="true">

                                            </select>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label">Pickup Date<span class='text-danger'>*</span></label>
                                            <input type="text" class="form-control" name="item[pickup_date]" id="pickup_date" value="<?php echo date('d-m-Y'); ?>"/>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>  
                                    <div class="col-md-6"> 
                                        <div class="form-group" id="error-name">
                                            <label class="control-label">Assign Visit Slot<span class='text-danger'>*</span></label>
                                            <select name="item[slot]" id="slot" class="form-control">
                                                <option value=""> Select Slot</option>

                                                <?php foreach ($visitingslots as $slot) {  
                                                        ?>
                                                         
                                                   <option value="<?php echo $slot['time_slot']; ?>"><?php echo $slot['time_slot']; ?></option>  
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label">Comment<span class='text-danger'>*</span></label>
                                            <input type="text" class="form-control" name="item[comment]" id="comment" autocomplete="off"/>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <h2>Estimate</h2>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr.no</th>
                                            <th>Type</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Tax</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="istimate">
                                        
                                    </tbody>
                                </table>  
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

    <div id="VehicleModel" class="modal fade" style="padding-top: 86px;">
        <div id="cancel-overlay" class="modal-dialog" style="opacity:1 ;width:400px ">
            <div class="modal-content">
            <form action="" method="post" name="addvehicle" id="addvehicle" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#f30a03"> X </span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Vehicle</h4>
                </div>
                <div class="modal-body" style="background-color:#f5f5f5;">
                    <input type="hidden" name="item[userid]" id="userid1" value=""/>
                     <div class="row" style="padding:10px">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password" class="control-label">Enter Vehicle Number <span class='text-danger'>*</span></label>
                                <input type="text" class="form-control" name="item[vehicle_no1]" id="vehicle_no" value="" placeholder="Enter Vehicle Number" autocomplete="off"/>
                            </div>
                            <div class="messageContainer"></div>
                        </div>
                    </div>
                    <div class="row" style="padding:10px">
                        <div class="col-md-12">
                            <div class="form-group">
                                  <label class="control-label">Brand<span class='text-danger'>*</span></label>
                                    <select name="item[brand_id1]" id="brand_id1" class="form-control">
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
                     <div class="row" style="padding:10px">
                        <div class="col-md-12">
                            <div class="form-group">
                                   <label class="control-label">Model<span class='text-danger'>*</span></label>
                                    <select name="item[model_id1]" id="model_id1" class="form-control">
                                                <option value=""> Select Model</option> 
                                   </select> 
                            </div>
                            <div class="messageContainer"></div>
                        </div>
                    </div>
                    <!--  <div class="row" style="padding:10px">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password" class="control-label">License Number </label>
                                <input type="text" class="form-control" name="item[license_number1]" id="license_number" value="" placeholder="Enter License Number" autocomplete="off"/>
                            </div>
                            <div class="messageContainer"></div>
                        </div>
                    </div>
                     <div class="row" style="padding:10px">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password" class="control-label">Insurance Bank </label>
                                <input type="text" class="form-control" name="item[insurance_brand1]" id="insurance_brand" value="" placeholder="Enter Insurance Bank" autocomplete="off"/>
                            </div>
                            <div class="messageContainer"></div>
                        </div>
                    </div>
                     <div class="row" style="padding:10px">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password" class="control-label">Insurance Number </label>
                                <input type="text" class="form-control" name="item[insurance_number1]" id="insurance_number" value="" placeholder="Enter Insurance Number" autocomplete="off"/>
                            </div>
                            <div class="messageContainer"></div>
                        </div>
                    </div> -->
                    <div class="row" style="padding:10px">
                        <div class="col-md-12">
                            <div class="form-group">
                                    <label class="control-label">Status<span class='c-input--danger'>*</span></label>
                                    <select class="select form-control floating" id="status" name="item[status1]" required> 
                                                <option value="1">Enable</option>
                                                <option value="0">Disable</option>
                                    </select>
                            </div>
                        </div>
                    </div> 

                    <div class="row">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div> 
            </form>
            </div>
        </div>
    </div> 

</div>
<script src="<?php echo asset_url(); ?>js/bootstrap-typeahead.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url(); ?>js/jquery.form.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>

<script>
    var nowDate = new Date();
    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
    $.fn.datepicker.defaults.format = "dd-mm-yyyy";
    $.fn.datepicker.defaults.startDate = today;

    $('#pickup_date').datepicker().on('changeDate', function (e) {
        $('#addorder').bootstrapValidator('revalidateField', 'item[pickup_date]');
    });


    $(document).ready(function(){

      var defaultDate=$("#pickup_date").val();

      //alert(defaultDate);

     $.get(base_url+'delivery_dates',{ date: defaultDate },function(data){

       $("#slot").html(data);

          }); 

    });

    $('#pickup_date').datepicker({
         autoclose: true
     }).on('changeDate', function(e){
          $.get(base_url+'delivery_dates',{date:$(this).val()},function(data){
               $("#slot").html(data);
                  });
     }); 
  

    $('#addorder').bootstrapValidator({
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
            'item[email]': {
                validators: {
                    notEmpty: {
                        message: 'The Email is required and cannot be empty'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'The value is not a valid email address'
                    }
                }
            },

            'item[landmark]': {
                validators: {
                    notEmpty: {
                        message: 'Landmark is required and cannot be empty'
                    }
                }
            },
            'item[slot]': {
                validators: {
                    notEmpty: {
                        message: 'Slot is required and cannot be empty'
                    }
                }
            },
            'item[comment]': {
                validators: {
                    notEmpty: {
                        message: 'Comment is required and cannot be empty'
                    }
                }
            },  
            'item[vehical_no]':{
                validators: {
                    notEmpty: {
                        message: 'Vehical is required and cannot be empty'
                    }
                }
            },  
            'item[vendor_id]':{
                validators: {
                    notEmpty: {
                        message: 'Vendor is required and cannot be empty'
                    }
                }
            }, 
            'subcategory_id[]': {
                validators: {
                    notEmpty: {
                        message: 'Subcategory is required and cannot be empty'
                    }
                }
            },
            'item[pickup_date]': {
                validators: {
                    notEmpty: {
                        message: 'Pickup date is required and cannot be empty'
                    }
                }
            }

        }
    }).on('success.form.bv', function (event, data) {
        // Prevent form submission
        event.preventDefault();
        addBooking();
    });

    function addBooking() {

         var options = {
            target: '#response',
            beforeSubmit: showAddRequest,
            success: showAddResponse,
            url: base_url + 'admin/order/add',
            semantic: true,
            dataType: 'json'
        };
        $('#addorder').ajaxSubmit(options);
        ajaxindicatorstart("Please hang on.. while we add order ..");
    }

    function showAddRequest(formData, jqForm, options) { 
         ajaxindicatorstop();
         $("#response").hide();  
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
            window.location.href = base_url + "admin/order/pendingorders";
        }
    }

    $.getScript("//maps.googleapis.com/maps/api/js?v=3.exp&key=<?php echo $google_map_key; ?>&libraries=places&sensor=false&callback=initMap");

    function initMap() {
        var options = {
            componentRestrictions: {country: 'in'}
        };
        var input = document.getElementById('landmark');
        var autocomplete = new google.maps.places.Autocomplete(input, options);
        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
            $('#latitude').val(place.geometry.location.lat());
            $('#longitude').val(place.geometry.location.lng());

            getVendors();
        });
    }

    $("#mobile").typeahead({
        onSelect: function (item) {
            itemvalue = item.value;
            $.get(base_url + "admin/user/detail/" + item.value, {}, function (result) {
                
                $('#vehicle_no').empty();
                $("#email").val(result.email);
                $("#address").val(result.address);
                $("#areaid").val(result.area);
                $("#name").val(result.name);
                $("#landmark").val(result.loc);
                $("#latitude").val(result.latitude);
                $("#longitude").val(result.longitude);
                $("#userid").val(result.id);
                $("#userid1").val(result.id);
                $("#vehical_no").val(result.vlist);
                var vlist = result.vlist;
               
             $('#vehicle_no').append("<option value=''>" + 'Select Vehical' + "</option>");
            if (vlist.length > 0)
            {
                for (var i = 0; i < vlist.length; i++)
                {
                    $('#vehicle_no').append("<option value='" + vlist[i].id + "' data-model='" + vlist[i].model_id + "' data-brand='" + vlist[i].brand_id + "'>" + vlist[i].vehicle_no + "</option>");
                }
            }

                $('#addorder').bootstrapValidator('revalidateField', 'item[email]');
                $('#addorder').bootstrapValidator('revalidateField', 'item[mobile]');
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
    $("#email").typeahead({
        onSelect: function (item) {
            itemvalue = item.value;
            $.get(base_url + "admin/user/detail/" + item.value, {}, function (result) {

                $('#vehicle_no').empty();
                $("#mobile").val(result.mobile);
                $("#address").html(result.address);
                $("#areaid").val(result.area);
                $("#name").val(result.name);
                $("#landmark").val(result.loc);
                $("#latitude").val(result.latitude);
                $("#longitude").val(result.longitude);
                $("#userid").val(result.id); 
                $("#userid1").val(result.id);
                $("#vehical_no").val(result.vlist);
                 var vlist = result.vlist;
               
             $('#vehicle_no').append("<option value=''>" + 'Select Vehical' + "</option>");
            if (vlist.length > 0)
            {
                for (var i = 0; i < vlist.length; i++)
                {
                    $('#vehicle_no').append("<option value='" + vlist[i].id + "' data-model='" + vlist[i].model_id + "' data-brand='" + vlist[i].brand_id + "'>" + vlist[i].vehicle_no + "</option>");
                }
            }
                $('#addorder').bootstrapValidator('revalidateField', 'item[email]');
                $('#addorder').bootstrapValidator('revalidateField', 'item[mobile]');
            }, 'json');
        },
        ajax: {
            url: base_url + "admin/user/byemail",
            timeout: 500,
            displayField: "email",
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

                $('#vehicle_no').empty();
                $("#mobile").val(result.mobile);
                $("#address").html(result.address);
                $("#areaid").val(result.area);
                $("#email").val(result.email);
                $("#landmark").val(result.loc);
                $("#latitude").val(result.latitude);
                $("#longitude").val(result.longitude);
                $("#userid").val(result.id); 
                $("#userid1").val(result.id);
                $("#vehical_no").val(result.vlist);
                 var vlist = result.vlist;
               
             $('#vehicle_no').append("<option value=''>" + 'Select Vehical' + "</option>");
            if (vlist.length > 0)
            {
                for (var i = 0; i < vlist.length; i++)
                {
                    $('#vehicle_no').append("<option value='" + vlist[i].id + "' data-model='" + vlist[i].model_id + "' data-brand='" + vlist[i].brand_id + "'>" + vlist[i].vehicle_no + "</option>");
                }
            }
                $('#addorder').bootstrapValidator('revalidateField', 'item[email]');
                $('#addorder').bootstrapValidator('revalidateField', 'item[mobile]');
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
        $("#vehicle_no").change(function ()  
        { 
            var model_id = $("#vehicle_no").children("option:selected").data("model"); 
             
            $('#subcategory_id').empty();
            $('#package_id').empty();
            // $('#service_id').select2('val', '');
            // $('#service_id').html('');
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


             $.post(base_url + "admin/package/getpackagenamebymodelid", {model_id: model_id}, function (data)
            {

                //debugger;

                $('#package_id').append("<option value=''>" + 'Select Package' + "</option>");
                if (data.length > 0)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#package_id').append("<option value='" + data[i].id + "'>" + data[i].package_name + "</option>");
                    }
                } 
            }, 'json');
  
        }); 
         
        $("#service_id").change(function () {
            $('#single_services').select2('val', '');
            $('#single_services').html('');
            if ($('#service_id').val()) {
                $.post(base_url + "admin/order/get_services_by_group", {service_id: $('#service_id').val()}, function (data)
                {

                    if (data.length > 0)
                    {
                        for (var i = 0; i < data.length; i++)
                        {
                            $('#single_services').append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
                        }
                    }
                }, 'json');
            }
        });

        $("#single_services").change(function () {
            generate_estimate();
    })
    $("#spare_id").change(function () {
            generate_estimate();
    })
     function generate_estimate() {
            if ($('#single_services').val() || $('#spare_id').val()) {
                $.post(base_url + "admin/order/get_services_by_id", {single_services: $('#single_services').val(), spare_id : $('#spare_id').val()}, function (response) {
                        var table = '';
                        var row = 1;
                        var grand_total =  0;
                        var data = response.service;
                        if (data.length > 0) {
                        
                        for (var i = 0; i < data.length; i++) {
                            
                            var total = 0;
                            table += '<tr>';
                            table += '<td>' + row + '</td>';
                            table += '<td> Service </td>';
                            table += '<td>' + data[i].name + '</td>';
                            table += '<td>' + data[i].price + '</td>';
                            table += '<td>' + data[i].tax + '</td>';
                            var tax = data[i].tax == 0 ? 0 : (data[i].tax / 100) * data[i].price;
                            //alert(tax);
                            total = tax + parseInt(data[i].price);
                            grand_total = grand_total + total;
                            table += '<td>' + total + '</td>';
                            table += '</tr>';
                            row++;
                        }
                    }
                    data = response.spare;
                    if (data.length > 0) {
                        
                        for (var i = 0; i < data.length; i++) {
                            
                            var total = 0;
                            table += '<tr>';
                            table += '<td>' + row + '</td>';
                            table += '<td> Spare </td>';
                            table += '<td>' + data[i].name + '</td>';
                            table += '<td>' + data[i].price + '</td>';
                            table += '<td>' + data[i].tax + '</td>';
                            var tax = data[i].tax == 0 ? 0 : (data[i].tax / 100) * data[i].price;
                            //alert(tax);
                            total = tax + parseInt(data[i].price);
                            grand_total = grand_total + total;
                            table += '<td>' + parseInt(total) + '</td>';
                            table += '</tr>';
                            row++;
                        }
                    }
                    table += '<tr>';
                    table += '<td colspan="4"></td>';
                    table += '<td> Grand Total</td>';
                    table += '<td>' + parseInt(grand_total) + '</td>';
                    table += '</tr>';
                    $('#istimate').html(table);
                }, 'json');
            } else {
                $('#istimate').html('');
            }
        }
        

        /*$("#subcategory_id").change(function ()
        {
            var subcat_id = $('#subcategory_id').val(); 
            //console.log(brand_id);
           // debugger;  
            $('#service_id').select2('val', '');
            $('#service_id').html('');
            $('#single_services').select2('val', '');
            $('#single_services').html('');
            //$.post(base_url+"admin/servicebycatid1/", {subcat_id : subcat_id}, function(data)
            $.post(base_url + "admin/catsubcatbyid1", {subcat_id: subcat_id}, function (data)
            {

                //$('#service_id').append("<option value=''>" + 'Select Service' + "</option>");
                if (data.length > 0)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#service_id').append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
                        // $('#model_id').append("</optgroup>");

                    }
                }
            }, 'json');
        });*/
 
    });



     $("#brand_id1").change(function ()
        {
            var brand_id = $('#brand_id1').val();
            console.log(brand_id);
            $('#model_id1').html(''); 
            $.post(base_url + "admin/modelbybrandid1/", {brand_id: brand_id}, function (data)
            {
                $('#model_id1').empty();
                $('#model_id1').append("<option value=''>" + 'Select Model' + "</option>");
                if (data.length > 0)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#model_id1').append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
                        // $('#model_id').append("</optgroup>");

                    }
                }
            }, 'json');
        });   


</script>

<script>
    $(document).ready(function () {
        //Chosen
        /* $("#subcategory_id").select2({
         maxItems: 3
         })*/

        $("#service_id").select2({
            //maxItems: 3
        })
        $("#single_services").select2({
            //maxItems: 3
        })
        $("#spare_id").select2({
            //maxItems: 3
        })

    });

    function getSpareList(value){
        $('#spare_id').select2('val', '');
         
        //var category_id = $("#category_id").val();
        //var category_id = 9;

        //var brand_id = $("#vehicle_no").children("option:selected").data("brand"); 
        var model_id = $("#vehicle_no").children("option:selected").data("model");
        var subcategory_id = value;
       // console.log(category_id + '-' +brand_id+'-'+model_id+'-'+subcategory_id);
       console.log(model_id+'-'+subcategory_id);
         $.post(base_url + "admin/spare/getsparelistbyparams", {model_id:model_id,subcategory_id:subcategory_id}, function (data)
        {
            if (data.length > 0)
            {
                for (var i = 0; i < data.length; i++)
                {
                    $('#spare_id').append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
                }
            }
        }, 'json');
    }

 

    $(document).ready(function(){  

     $('#first-note').hide();
     $('#second-note').hide();

    $("#package_id").change(function() 
            { 
                var package_id = $('#package_id').val();  
                var vehicle_no = $('#vehicle_no').val();  
                var userid     = $('#userid').val();

                $.post(base_url + "admin/package/getuserpackagebyid", {userid:userid,vehicle_no:vehicle_no,package_id: package_id}, function (data)
                {  
                    if(data.length > 0 )
                    {  
                            $('#second-note').show();  
                             document.getElementById("second-note").innerHTML = "Remaning Count =" + data[0].remaining_service_count +  "  Total Count =" + data[0].service_used_validity;
                            $('#first-note').hide();
                    } 

                    else{
                            $('#first-note').show();
                            $('#second-note').hide();
                    }
                }, 'json');
      });
    }); 
 

    $('#addvehicle').bootstrapValidator({
        container: function ($field, validator) {
            return $field.parent().next('div.messageContainer');
        },
        feedbackIcons: {
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {
            
            'item[vehicle_no1]': {
                validators: {
                    notEmpty: {
                        message: 'Vehical Number is required and cannot be empty'
                    }
                }
            }, 
            'item[brand_id1]': {
                validators: {
                    notEmpty: {
                        message: 'Brand is required and cannot be empty'
                    }
                }
            },

            'item[model_id1]': {
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
        AddVehicle();
    }); 
        
        function AddVehicle() {
                ajaxindicatorstart("Please hang on.. while we add Vehical..");
                var options = {
                    target: '#response',
                    beforeSubmit: showAddRequest,
                    success: showAddResponse1,
                    url: base_url + 'admin/order/addvehicle',
                    semantic: true,
                    dataType: 'json'
            };
            $('#addvehicle').ajaxSubmit(options);
        }

        function showAddRequest(formData, jqForm, options) {
            ajaxindicatorstop();
            $("#response").hide();
            var queryString = $.param(formData);
            return true;
        }

        function showAddResponse1(resp, statusText, xhr, $form) {
            //debugger;
            alert(resp.msg);
            if (resp.status == '0') {
                ajaxindicatorstop();
                $("#response").removeClass('alert-success');
                $("#response").addClass('alert-danger');
                $("#response").html(resp.message);
                $("#response").show();
            } else {
                ajaxindicatorstop();
                $('#VehicleModel').modal('hide');
                $('#addvehicle')[0].reset();
                var uid = $("#userid1").val();
                    
                if(uid !='')
                {
                    $.get(base_url + "admin/user/detail/" + uid , {}, function (result) {

                    $('#vehicle_no').empty();
                    $("#mobile").val(result.mobile);
                    $("#address").html(result.address);
                    $("#areaid").val(result.area);
                    $("#email").val(result.email);
                    $("#landmark").val(result.loc);
                    $("#latitude").val(result.latitude);
                    $("#longitude").val(result.longitude);
                    $("#userid").val(result.id); 
                    $("#userid1").val(result.id);
                    $("#vehical_no").val(result.vlist);
                     var vlist = result.vlist;
                       
                     $('#vehicle_no').append("<option value=''>" + 'Select Vehical' + "</option>");
                     if (vlist.length > 0)
                    {
                        for (var i = 0; i < vlist.length; i++)
                        {
                            $('#vehicle_no').append("<option value='" + vlist[i].id + "' data-model='" + vlist[i].model_id + "' data-brand='" + vlist[i].brand_id + "'>" + vlist[i].vehicle_no + "</option>");
                        }
                    }
                    }, 'json');
                }
                else
                {

                    var vehicleid = resp.id;

                    $.get(base_url + "admin/user/vehicle/" + vehicleid , {}, function (result) {

                    //$("#vehical_no").val(result.vlist);
                    var vlist = result; 

                   // $('#vehicle_no').append("<option value=''>" + 'Select Vehical' + "</option>");
                     if (vlist.length > 0)
                    {
                        for (var i = 0; i < vlist.length; i++)
                        {
                            $('#vehicle_no').append("<option value='" + vlist[i].id + "' data-model='" + vlist[i].model_id + "' data-brand='" + vlist[i].brand_id + "'>" + vlist[i].vehicle_no + "</option>");
                        }
                    }
                    }, 'json');

                }    
        }
    }

$(document).on("change", ".ch_vehicle", function() {
	getVendors();
});

function getVendors() {	
	var latitude = $("#latitude").val();
	var longitude = $("#longitude").val();
	var vehicle = $("#vehicle_no").val();
	var brand = "";//vehicle.attr('data-brand');
	var model = "";//vehicle.attr('data-model');
	if (latitude != "" && longitude != "") {
		var selectElem = $("#vendor_id");
        selectElem.html('<option value="">Select Vendor</option>');
		$.post(base_url+"admin/order/getvendorlist", {latitude:latitude, longitude:longitude, brand:brand, model:model}, function (data) {
			if (data.vendorlist != false) {
				$.each(data.vendorlist, function(key, vendors){
		            $option = $('<option value="' + vendors.id + '">' + vendors.garage_name + '</option>');
		            selectElem.append($option);
		        });
			} else {
				alert(data.errmsg);
			}
		}, "json");
	} else {
		alert("Please add valid address");
	}
}
</script>