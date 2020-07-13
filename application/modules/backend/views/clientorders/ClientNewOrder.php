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

    <form id="addorder" name="addorder" action="" method="post" enctype="multipart/form-data">


        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add New Order

                    </div>
                    <div class="panel-body">

                        <div class="row"> 
                            <div class="col-lg-6">
                                <div class="form-group" >
                                    <label class="control-label">Company Name<span class='text-danger'>*</span></label>

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
                            <div class="col-md-6">
                                <div class="form-group" id="error-landmark">
                                    <label class="control-label col-sm-5">City <span class='text-danger'>*</span></label>
                                    <div class="col-sm-12 ">
                                        <select name="city_id" id="city_id" class="form-control floating"> 
                                            <option value=""> Select City </option> 
                                        </select>
                                    </div>
                                    <div class="messageContainer  "></div>
                                </div>
                            </div> 

                        </div> 

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Outlet Name<span class='text-danger'>*</span></label>

                                    <select name="outlet_id" id="outlet_id" class="form-control floating"> 
                                        <option value=""> Select Outlet </option>             
                                    </select> 
                                </div>
                                <div class="messageContainer  "></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Select services<span class='text-danger'>*</span></label>
                                    <select id="service_id" class="form-control floating" multiple> 
                                        <option value=""> Select service </option>             
                                    </select> 
                                </div>
                                <div class="messageContainer  "></div>
                            </div>
                            <div class="col-md-6" style="display:none">
                                <div class="form-group" id="error-landmark">
                                    <label class="control-label col-sm-5">Bike<span class='text-danger'>*</span></label>
                                    <div class="col-sm-12 ">
                                        <select  id="bike_id" class="form-control floating" multiple> 
                                        </select>
                                    </div>
                                    <div class="messageContainer  "></div>
                                </div>
                            </div> 
                        </div>
                        <div class="row" id="payment_mode" style="display:none">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Package payment mode<span class='text-danger'>*</span></label> <br>
                                    
                                    <input type="radio" checked=""  name="package_payment_mode" id="Instamojo" value="1">
                                    <label for="Instamojo">Online (Instamojo)</label><br>
                                    
                                    <input type="radio" name="package_payment_mode" id="NEFT" value="2">
                                    <label for="NEFT">Online (NEFT)</label><br>
                                   
                                    <input type="radio" name="package_payment_mode" id="Cheque" value="3">
                                    <label for="Cheque">Cheque</label>
                                    <input type="text" id="cheque_no" style="display:none" placeholder="cheque no." name="cheque_no" class="form-control">
                                     <br>
                                    
                                    <input type="radio" name="package_payment_mode" id="Other" value="4">
                                    <label for="Other">Other</label><br>
                                </div>
                                <div class="messageContainer  "></div>
                            </div>
                             
                        </div>
                        
                        <div class="col-lg-12">
                            <h2>Bike</h2>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>Sr.no</th>
                                        <th>Bike</th>
                                        <th>Rider Name</th>
                                        <th>Rider Mobile</th>
                                        <th>Package</th>
                                        <th>Services</th>
                                    </tr>
                                </thead>
                                <tbody id="bike_table">

                                </tbody>
                            </table>  
                        </div>
<!--                        <div class="col-lg-8">
                            <h2>Estimate</h2>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr.no</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Discount Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="istimate">

                                </tbody>
                            </table>  
                        </div>-->
                        <div class="text-center">
                            <div id="response"></div>
                            <button type="submit" class="btn btn-success">Submit</button>
                            <br>
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
    $("#service_id").select2({});
    $("#bike_id").select2({});
    var SERVICES;
    $('#addorder').bootstrapValidator({
        container: function ($field, validator) {
            return $field.parent().next('div.messageContainer');
        },
        feedbackIcons: {
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {

            'client_id': {
                validators: {
                    notEmpty: {
                        message: 'Name is required and cannot be empty'
                    }
                }
            },

            'outlet_id': {
                validators: {
                    notEmpty: {
                        message: 'Outlet is required and cannot be empty'
                    }
                }
            },
            'city_id': {
                validators: {
                    notEmpty: {
                        message: 'City is required and cannot be empty'
                    }
                }
            },
            'service_id': {
                validators: {
                    notEmpty: {
                        message: 'Service is required and cannot be empty'
                    }
                }
            },
            'bike_id': {
                validators: {
                    notEmpty: {
                        message: 'Bike is required and cannot be empty'
                    }
                }
            },
            'garage_name': {
                validators: {
                    notEmpty: {
                        message: 'Garage name is required and cannot be empty'
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
        ajaxindicatorstart("Please hang on.. while we add order ..");
        $.ajax({
            url: base_url + 'client/order/add',
            data: $('#addorder').serialize(),
            dataType: 'JSON',
            type: 'POST',
            success: function (response) {
                alert(response.msg);
                ajaxindicatorstop();
                if(response.status == 1) {
                    window.location.href = base_url + "client/order/pendingorders";
                }
                $('.btn-success').removeAttr('disabled');
            }
        });


    }


    $(document).ready(function () {

        $("#client_id").change(function () {
            var client_id = $('#client_id').val();
            console.log(client_id);
            ajaxindicatorstart("Please wait....");
            $.post(base_url + "client/citybyclientid/", {client_id: client_id}, function (data) {
                ajaxindicatorstop();
                console.log(data);
                $('#city_id').empty();
                $('#city_id').append("<option value=''>" + 'Select City' + "</option>");

                if (data.length > 0)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#city_id').append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
                    }
                }
            }, 'json');
        });

        $("#city_id").change(function ()
        {
            var city_id = $('#city_id').val();
            console.log(outlet_id);

            ajaxindicatorstart("Please wait....");
            $.post(base_url + "client/outletbycityid/", {city_id: city_id, client_id : $('#client_id').val()}, function (data)
            {

                console.log(data);
                ajaxindicatorstop();
                $('#outlet_id').empty();
                $('#outlet_id').append("<option value=''>" + 'Select Outlet' + "</option>");
                if (data.length > 0)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#outlet_id').append("<option value='" + data[i].id + "'>" + data[i].outlet_name + "</option>");
                        // $('#city_id').append("</optgroup>");

                    }
                }
            }, 'json');
        });

        $("#outlet_id").change(function ()
        {
            var outlet_id = $('#outlet_id').val();
            console.log(outlet_id);

            ajaxindicatorstart("Please wait....");
            $.post(base_url + "client/bikesbyoutletid/", {outlet_id: outlet_id}, function (response)
            {

                console.log(data);
                ajaxindicatorstop();
                $('#service_id').empty();
                $('#bike_id').empty();
                $('#bike_id').append("<option value=''>" + 'Select Bike' + "</option>");
                var data = response.bike;
                if (data.length > 0)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#bike_id').append("<option value='" + data[i].id + "' data-name='" + data[i].bike_number + "(" + data[i].bike_name + ")'>" + data[i].bike_number + "(" + data[i].bike_name + ")" + "</option>");
                        // $('#city_id').append("</optgroup>");

                    }
                }
                data = response.service;
                SERVICES = response.service;
                if (data.length > 0)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#service_id').append("<option value='" + data[i].id + "'>" + data[i].service_name + "</option>");


                    }
                }
                $('#bike_id option').prop('selected', true);
                $("#bike_id").trigger("change"); 
            }, 'json');
        });

    });
    $("#service_id").change(function () {
        generate_estimate();
        var json = JSON.parse("[" + $('#service_id').val() + "]");
        $('.sepearte_service_id').val(json);
        $('.sepearte_service_id').trigger('change');
    });
    function generate_estimate() {
        if ($('#service_id').val()) {
            $.post(base_url + "client/order/get_services_by_id", {service_id: $('#service_id').val()}, function (data) {
                var table = '';
                var row = 1;
                var grand_total = 0;
                if (data.length > 0) {

                    for (var i = 0; i < data.length; i++) {

                        var total = 0;
                        var sp = data[i].special_price == 0 ? data[i].price : data[i].special_price;
                        table += '<tr>';
                        table += '<td>' + row + '</td>';
                        table += '<td>' + data[i].service_name + '</td>';
                        table += '<td>' + data[i].price + '</td>';
                        table += '<td>' + sp + '</td>';
                        grand_total = grand_total + parseInt(sp);
                        table += '<td>' + sp + '</td>';
                        table += '</tr>';
                        row++;
                    }
                    table += '<tr>';
                    table += '<td colspan="3"></td>';
                    table += '<td> Grand Total</td>';
                    table += '<td>' + parseInt(grand_total) + '</td>';
                    table += '</tr>';
                    $('#istimate').html(table);
                }
                $('#istimate').html(table);
            }, 'json');
        } else {
            $('#istimate').html('');
        }
    }
    $("#bike_id").change(function () {
        generate_bike_table();
    });
    function generate_bike_table() {
        if ($('#bike_id').val()) {
            $.post(base_url + "client/order/get_bike_by_id", {bike_id: $('#bike_id').val()}, function (response) {
                var table = '';
                var row = 1;
                var grand_total = 0;
                var data = response;
                if (data.length > 0) {

                    for (var i = 0; i < data.length; i++) {

                        table += '<tr>';
                        table += '<td> <input type="checkbox" class="chk" checked > </td>';
                        table += '<td> <input type="hidden" class="bike_ids" name="bike_id[]" value="' + data[i].id + '">' + row + '</td>';
                        table += '<td>' + data[i].bike_number + ' - ' + data[i].bike_name + '</td>';
                        table += '<td>' + data[i].rider_name + '</td>';
                        table += '<td>' + data[i].rider_mobile + '</td>';
                        table += '<td><select class="form-control select_package" name="package_id[]" onchange="get_package_count(this.value, this)"><option value="0"> Select package </option>';
                        for (var a = 0; a < data[i].packages.length; a++) {
                          table += '<option value="' + data[i].packages[a].id + '" data-price="' + data[i].packages[a].special_price + '">' + data[i].packages[a].package_name + '</option>';
                        }
                        table += '</select> <span class="pck_span"><span></td>';
                        table += '<td><select class="form-control sepearte_service_id" id="sepearte_service_id_' + data[i].id + '" name="service_id_' + data[i].id + '[]" multiple>';
                        for (var a = 0; a < SERVICES.length; a++) {
                          table += "<option value='" + SERVICES[a].id + "'>" + SERVICES[a].service_name + "</option>";
                        }
                        table += '</select></td>';
                        table += '</tr>';
                        row++;
                    }
                    
                    $('#bike_table').html(table);
                    setTimeout(function(){
                        $('.sepearte_service_id').select2({}); 
                    }, 500);
                }
                $('#bike_table').html(table);
                
            }, 'json');
        } else {
            $('#bike_table').html('');
        }
    }
    $(document).on('change', '.chk', function(){
        if($(this).is(':checked')) {
            $(this).parent().parent().removeAttr('bgcolor');
            $(this).parent().parent().find('input, select').removeAttr('disabled'); 
            $(this).parent().parent().find('.pck_span').show();
        } else {
            $(this).parent().parent().attr('bgcolor', "#FFFFCC");
            $(this).parent().parent().find('input, select').attr('disabled','disabled');
            $(this).parent().parent().find('.pck_span').hide();
            $(this).removeAttr('disabled');
        }
    });
    function get_package_count(id, ths) {
        if(id != 0) {
        var bike_id = $(ths).parent().parent().find('.bike_ids').val();
        $.post(base_url + "client/order/get_package_count", {bike_id: bike_id, package_id : id}, function (response) {
             $(ths).parent().find('.pck_span').html(response.msg).show();
             $('#payment_mode').show(500);
         }, 'JSON');
        
    } else {
        $(ths).parent().find('.pck_span').html('');
        var a = 0;
        $('.select_package').each(function(){
           if($(this).val() != 0) {
              a = 1; 
           } 
        });
        if(a == 0) {
            $('#payment_mode').hide(500);
        }
    }
        
    }
    $(document).on('change', 'input[name="package_payment_mode"]', function(){
        if($(this).val() == 3) {
            $('#cheque_no').show();
            $('#cheque_no').attr('required', true);
        } else {
            $('#cheque_no').hide();
            $('#cheque_no').removeAttr('required');
        }
    })
</script>


