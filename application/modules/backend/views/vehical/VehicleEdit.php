<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <!-- .page title -->
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Edit Vehicle</h4>
            </div>
            <!-- /.page title -->
        </div>

        <div class="row" style="margin:0 -30px;">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <form id="editvehicle" name="editvehicle" action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="id" name="item[id]" value="<?php echo $vehicle[0]['id']; ?>">   
                                <input type="hidden" name="item[userid]" id="userid" value="<?php echo $vehicle[0]['user_id']; ?>"/>
                               
                                <div class="form-body"> 
                                    <div class="tab-content"> 
                                            <span class='text-danger'>*Note: You can edit vehicle for existing user only.</span> 
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" id="error-name">
                                                        <label class="control-label">Customer Mobile<span class='text-danger'>*</span></label>
                                                        <input type="text" class="form-control" value="<?php if(isset($vehicle[0]['usermobile'])) echo $vehicle[0]['usermobile'];?>" name="item[mobile]" id="mobile" autocomplete="off"/>
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group" id="error-name">
                                                        <label class="control-label">Customer Name<span class='text-danger'>*</span></label>
                                                        <input type="text" class="form-control" value="<?php if(isset($vehicle[0]['username'])) echo $vehicle[0]['username'];?>" name="item[name]" id="name" autocomplete="off"/>
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                            </div>
                                            <div class="row"> 
                                                 <div class="col-md-6">
                                                    <div class="form-group" id="error-name">
                                                        <label class="control-label">Vehicle Number<span class='text-danger'>*</span></label>
                                                        <input type="text" class="form-control"  value="<?php if(isset($vehicle[0]['vehicle_no'])) echo $vehicle[0]['vehicle_no'];?>" name="item[vehical_no]" id="vehicalno" autocomplete="off"/>
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div> 
                                                <div class="col-md-6">
                                                    <div class="form-group" id="error-name">
                                                        <label class="control-label">Brand<span class='text-danger'>*</span></label>
                                                        <select name="item[brand_id]" id="brand_id" class="form-control">
                                                                <option value=""> Select Brand </option>
                                                                <?php foreach ($brands as $brand) : ?>
                                                                <option value="<?php echo $brand['id'];?>" <?php if($vehicle[0]['brand_id'] == $brand['id']) {?>selected<?php }?>><?php echo $brand['name'];?></option>
                                                                <?php endforeach;?>                                                     
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
                                                                <?php foreach ($models as $model) : ?>
                                                                <option value="<?php echo $model['id'];?>" <?php if($vehicle[0]['model_id'] == $model['id']) {?>selected<?php }?>><?php echo $model['name'];?></option>
                                                                <?php endforeach;?>
                                                            </select>
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group form-focus select-focus">
                                                        <label class="control-label">Status<span class='text-danger'>*</span></label>
                                                        <select class="select form-control floating" id="status" name="item[status]" required> 
                                                            <option value="1" <?php echo isset($vehicle[0]['status'])?$vehicle[0]['status'] == 1 ?'selected':'':'';?>>Enable</option>
                                                            <option value="0" <?php echo isset($vehicle[0]['status'])?$vehicle[0]['status'] == 0 ?'selected':'':'';?>>Disable</option>
                                                        </select>
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                                <!-- <div class="col-md-6">
                                                    <div class="form-group" id="error-name">
                                                        <label class="control-label">License Number</label>
                                                        <input type="text" class="form-control"  value="<?php if(isset($vehicle[0]['license_number'])) echo $vehicle[0]['license_number'];?>" name="item[license_number]" id="license_number" autocomplete="off"/>
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>  -->
                                            </div>
                                            <div class="row">   
                                                <!-- <div class="col-md-6">
                                                    <div class="form-group" id="error-name">
                                                        <label class="control-label">Insurance Bank </label>
                                                        <input type="text" class="form-control"  value="<?php if(isset($vehicle[0]['insurance_brand'])) echo $vehicle[0]['insurance_brand'];?>" name="item[insurance_brand]" id="insurance_brand" autocomplete="off"/>
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="error-name">
                                                        <label class="control-label">Insurance Number </label>
                                                        <input type="text" class="form-control"  value="<?php if(isset($vehicle[0]['insurance_number'])) echo $vehicle[0]['insurance_number'];?>" name="item[insurance_number]" id="insurance_number" autocomplete="off"/>
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>  -->
                                               
                                            </div>   
                                        </div>

                                            <div class="row">  
                                                      <div class="form-actions text-center" style="margin-top: 30px;">
                                                        <div id="response"></div>
                                                        <button class="btn btn-danger btn-lg" type="submit">Update</button>
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

<script src="<?php echo asset_url(); ?>js/bootstrap-typeahead.min.js"></script>
<script src="<?php echo asset_url(); ?>/js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url(); ?>/js/jquery.form.js"></script>
<script>
    $('#editvehicle').bootstrapValidator({
        container: function ($field, validator) {
            return $field.parent().next('.messageContainer');
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
        editClient();

    });
    function editClient() {
        ajaxindicatorstart("Please wait.. while Updating.."); 
        var options = {
            target: '#response',
            beforeSubmit: showAddRequest,
            success: showAddResponse,
            url: base_url + 'admin/vehicle/update',
            semantic: true,
            dataType: 'json'
        };
        $('#editvehicle').ajaxSubmit(options);
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
                //$('#editvehicle').bootstrapValidator('revalidateField', 'email]');
                $('#editvehicle').bootstrapValidator('revalidateField', 'item[mobile]');
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
                $('#editvehicle').bootstrapValidator('revalidateField', 'item[email]');
                $('#editvehicle').bootstrapValidator('revalidateField', 'item[mobile]');
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

    $("#brand_id").change(function() 

            {

        var brand_id =  $('#brand_id').val();       

            console.log(brand_id);      

              $.post(base_url+"admin/modelbybrandid/", {brand_id : brand_id}, function(data)

                      {

                  $('#model_id').empty();$('#model_id').append("<option value=''>"+'Select Model'+"</option>");         

               if(data.length > 0)

                   {            

                     for( var i=0; i < data.length; i++)

                         {                      

                               $('#model_id').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");           

                                }       

                          }    

                   },'json');   

               });




</script>

</head>
</html>