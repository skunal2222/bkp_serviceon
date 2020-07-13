<style>
    .select2{
        width : 100% !important;
    }
</style>
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/selectize.bootstrap3.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css">

<div id="page-wrapper">	
    <div class="row">
        <div class="col-lg-12">
            <h3>Add Package</h3>
        </div>
    </div>
    <form id="addPackage" name="addpackage" action="" method="post" >
        <div class="tab-content">
            <div id="basic" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" >
                                Add Package
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Package name<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="packagename" name="name" required />
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-bottom-5">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label col-sm-5">Category<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <select name="category_id" id="category_id" class="form-control">
                                                    <option value=""> Select Category </option>
                                                    <?php foreach ($categories as $category) { ?>
                                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="messageContainer col-sm-12"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 margin-bottom-5">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label col-sm-5">Select Brand</label>
                                            <div class="col-sm-10">
                                                <select name="brand_id[]" id="brand_id" class="form-control" multiple="true"  >
                                                    <input type="button" id="select_all" class="btn btn-success" name="select_all" value="Select All">
                                                     <input type="button" class="btn btn-success" id="brand_clear_all" name="brand_clear_all" value="Clear All">
                                                </select>
                                                <div class="messageContainer col-sm-10" id="error_brand" style="color:#a94442;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-bottom-5">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label col-sm-5">Select Model</label>
                                            <div class="col-sm-10">
                                                <select name="model_id[]" id="model_id" class="form-control" multiple="true">
                                                	<input type="button" id="select_all2" class="btn btn-success" name="select_all2" value="Select All"> 
                                                    <input type="button" class="btn btn-success" id="model_clear_all" name="model_clear_all" value="Clear All">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="messageContainer col-sm-4"></div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-6 margin-bottom-5">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label col-sm-5">Select Subcategory</label>
                                            <div class="col-sm-10">
                                                <select name="subcategory_id[]" id="subcategory_id" class="form-control" multiple="true">
                                                    <input type="button" id="select_all3" class="btn btn-success" name="select_all3" value="Select All">  <input type="button" class="btn btn-success" id="subcategory_clear_all" name="subcategory_clear_all" value="Clear All">                      
                                                </select>
                                            </div>
                                        </div>
                                        <div class="messageContainer col-sm-4"></div>
                                    </div>
                                    <div class="col-md-6 margin-bottom-5">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label col-sm-5">Select Services </label>
                                            <div class="col-sm-10">
                                                <select name="service_id[]" id="service_id" class="form-control" multiple="true">
                                                    <input type="button" id="select_all4" class="btn btn-success" name="select_all4" value="Select All"> 
                                                    <input type="button" class="btn btn-success" id="services_clear_all" name="services_clear_all" value="Clear All">                   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="messageContainer col-sm-4"></div>
                                    </div>
                                </div>
                                <div class="row" style='display:none;' id="pricediv">
                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Best Price<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="best_price" name="best_price" required />
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Special Price<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="special_price" name="special_price" required />
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Short Description<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="short_description" name="short_description" required /></textarea>
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Long Description<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="long_description" name="long_description" required /></textarea>
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 margin-bottom-5">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label col-sm-5">Who use referal code<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                            <input type="text" id="my_referral" name="my_referral" class="form-control floating" placeholder="Who use referal code"> 
                                            </div>
                                             <div class="messageContainer"></div>
                                        </div> 
                                    </div>
                                    <div class="col-md-6 margin-bottom-5">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label col-sm-5">Who share refferal code<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="other_referral" name="other_referral" placeholder="Who share refferal code" autocomplete="off"/>
                                            </div>   
                                             <div class="messageContainer"></div> 
                                        </div> 
                                    </div>  
                                </div>    
                                <div class="row">
                                	<!-- <div class="col-md-6 margin-bottom-5">	
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-5">Refer Points<span class='text-danger'>*</span></label>	
										<div class="col-sm-10">
										<input type="text" class="form-control" id="redeem_points" name="redeem_points" />
									    </div>
									    <div class="messageContainer"></div>
									</div>							
												
									</div> -->
                                    <div class="col-md-6 margin-bottom-5">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label col-sm-5">Select Year </label>
                                            <div class="col-sm-10">
                                                <select name="Year" id="Year" class="form-control Year" >   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="messageContainer col-sm-4"></div>
                                    </div>
                                    <div class="col-md-6 margin-bottom-5">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label col-sm-5">User per use</label>
                                            <div class="col-sm-10">
                                                <select name="Service_used" id="Service_used" class="form-control Year" >   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="messageContainer col-sm-4"></div>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-online_payment">
                                            <label class="control-label col-sm-5">Status</label>
                                            <div class="col-sm-10">
                                                <label class="radio-inline"><input type="radio" id="yes1" value="1" name="status" checked>Active</label>
                                                <label class="radio-inline"><input type="radio" id="no1" value ="0" name="status" >Deactive</label>
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                      </div>
                                      <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-image">
                                            <label class="control-label ">Upload Image (80 X 80 px) <span class='text-danger'>*</span></label>
                                            <input type="file" value="" name="image" id="image" class="form-control " >
                                        </div>
                                        <div class="messageContainer col-sm-4"></div>
                                    </div>
                                </div>  
                                </div>
                                <div class="col-lg-8">
                                    <h2>Service Details</h2>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr.no</th>
                                            <th>Name</th>
                                            <th>User per use</th>
                                        </tr>
                                    </thead>
                                    <tbody id="istimate">
                                        
                                    </tbody>
                                </table>  
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
<script src="<?php echo asset_url(); ?>js/selectize.min.js"></script>
<script src="<?php echo asset_url(); ?>js/jquery.form.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        //Chosen
        $("#brand_id").select2({
            //maxItems: 3
        });
        $("#model_id").select2({
            //maxItems: 3
        });
        $("#service_id").select2({
            //maxItems: 3
        });
        $("#subcategory_id").select2({
            //maxItems: 3
        });
    });

    $('#select_all').click(function() {
        $('#brand_id option').prop('selected', true);
        $("#brand_id").trigger("change");
    });

     $('#select_all2').click(function() {
        $('#model_id option').prop('selected', true);
        $("#model_id").trigger("change");
    });

    $('#select_all3').click(function() {
        $('#subcategory_id option').prop('selected', true);
        $("#subcategory_id").trigger("change");
    });

     $('#select_all4').click(function() {
        $('#service_id option').prop('selected', true);
        $("#service_id").trigger("change");
    });
    
    $('#addPackage').bootstrapValidator({
        container: function($field, validator) {
            return $field.parent().next('.messageContainer');
        },
        feedbackIcons: {
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Name is required and cannot be empty'
                    }
                }
            },
            category_id: {
                validators: {
                    notEmpty: {
                        message: 'Category is required and cannot be empty'
                    }
                }
            },
            brand_id: {
                validators: {
                    notEmpty: {
                        message: 'Brand is required and cannot be empty'
                    }
                }
            },
            Services: {
                validators: {
                    notEmpty: {
                        message: 'Services is required and cannot be empty'
                    }
                }
            },
            short_description: {
                validators: {
                    notEmpty: {
                        message: 'Short description is required and cannot be empty'
                    }
                }
            },
            long_description: {
                validators: {
                    notEmpty: {
                        message: 'Long description is required and cannot be empty'
                    }
                }
            },
           /* redeem_points: {
        	validators: {
        		notEmpty: {
        			message: 'Refer amount is required and cannot be empty'
        		},
                regexp: {
                        regexp: '^[0-9]*[1-9]+[0-9]*$',
                        message: 'Invalid value'
                    }
                }
                
        	},*/
            my_referral: {
            validators: {
                notEmpty: {
                    message: 'Refer amount is required and cannot be empty'
                },
                regexp: {
                        regexp: '^[0-9]*[1-9]+[0-9]*$',
                        message: 'Invalid value'
                    }
                }
                
            },
            other_referral: {
            validators: {
                notEmpty: {
                    message: 'Other Refer amount is required and cannot be empty'
                },
                regexp: {
                        regexp: '^[0-9]*[1-9]+[0-9]*$',
                        message: 'Invalid value'
                    }
                }
                
            },
           
            image: {
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
             }

        }
    }).on('success.form.bv', function(event, data) {
        // Prevent form submission
        event.preventDefault();
        addPackage();
    });



    function addPackage() {

        if (($('#brand_id').val()) == null) {
            $('#error_brand').html('Brand is required and cannot be empty');
            $("#couponbtn").attr('disabled', true);
            return;
        }
        if (($('#model_id').val()) == null) {
            $('#error_brand').html('Model is required and cannot be empty');
            $("#couponbtn").attr('disabled', true);
            return;
        }
        if (($('#service_id').val()) == null) {
            $('#error_brand').html('Service is required and cannot be empty');
            $("#couponbtn").attr('disabled', true);
            return;
        }
        savePackage();
    }

    function savePackage() { 
        ajaxindicatorstart("Please wait.. while Adding..");
        var options = {
            target: '#response',
            beforeSubmit: showAddRequest,
            success: showAddResponse,
            url: base_url + 'admin/package/savepackage',
            semantic: true,
            dataType: 'json'
        };
        $('#addPackage').ajaxSubmit(options);
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
            window.location.href = base_url + "admin/package/list";
        }
    }
</script>

<script>
    $(document).ready(function() {
        $("#category_id").change(function() {
            var cat_id = $('#category_id').val();
            console.log(cat_id);
            ajaxindicatorstart("Please wait....");
            $.post(base_url + "admin/brandbycatid/", {
                cat_id: cat_id
            }, function(data) {
                ajaxindicatorstop();
                // $('#brand_id').empty();$('#brand_id').append("<option value=''>"+'Select Brand'+"</option>");            
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        $('#brand_id').append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
                    }
                }
            }, 'json');
        });

        $("#brand_id").change(function() {
            var brand_id = $('#brand_id').val();
            $('#model_id').select2('val', '');
            $('#model_id').html('');
            $.post(base_url + "admin/modelbybrandid1/", {
                brand_id: brand_id
            }, function(data) {
                $('#model_id').empty();
               //$("#model_id").val(null).trigger("change");

                if (data.length > 0) {
                    $('#model_id').html("");
                    for (var i = 0; i < data.length; i++) {
                        $('#model_id').append("<option value='" + data[i].id + "'>" + data[i].name + "(" + data[i].brand_name + ")</option>");
                    }
                }
            }, 'json');
        });

        $("#model_id").change(function() {
            var model_id = $('#model_id').val();
            $('#subcategory_id').select2('val', '');
            $('#subcategory_id').html('');
            $.post(base_url + "admin/subcategorybycatid_3/", {
                model_id: model_id
            }, function(response) {
                var data = response.subcat;
                $('#subcategory_id').empty();
             
                if (data.length > 0) {

                    $('#subcategory_id').html("");

                    for (var i = 0; i < data.length; i++) {
                        $('#subcategory_id').append("<option value='" + data[i].id + "'>" + data[i].name + " (" + data[i].model_name + ")</option>");
                    }
                }
                data = response.spare;
                $('#spare_id').empty();
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        $('#spare_id').append("<option value='" + data[i].id + "'>" + data[i].name + " (" + data[i].model_name + ")</option>");
                    }
                }
            }, 'json');
        });

        $("#subcategory_id").change(function() {
            var subcat_id =  $('#subcategory_id').val();  
                $('#service_id').select2('val', '');
                $('#service_id').html('');       
                $.post(base_url+"admin/getservicesbysubcat/", {subcat_id : subcat_id}, function(data)
                {
                $('#service_id').empty();

                if(data.length > 0)
                {    
                $('#service_id').html("");

                for( var i=0; i < data.length; i++)
                {                       
                $('#service_id').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");            
                }       
                }      
                },'json');   
         });
    });

    $(function() {
        var $select = $(".Year");
        for (i = 1; i <= 10; i++) {
            $select.append($('<option></option>').val(i).html(i))
        }
    });

    $(function() {
        var $select = $(".Service_used");
        for (i = 1; i <= 10; i++) {
            $select.append($('<option></option>').val(i).html(i))
        }
    });

    $("#service_id").change(function () {
         $("#pricediv").show();
            generate_estimate();
    });
    $("#Service_used").change(function () {
            generate_estimate();
    })


    function generate_estimate() {
        var Service_used =  $('#Service_used').val()
            if ($('#service_id').val()) {
                $.post(base_url + "admin/package/get_services_by_serviceid", {
                    service_id: $('#service_id').val()
                }, function (response) {
                        var table = '';
                        var row = 1;
                        var grand_total =  0;
                        var TotalPrice = 0;
                        var TotalTax = 0;
                        var data = response.service;
                        if (data.length > 0) {
                        
                        for (var i = 0; i < data.length; i++) {     
                            var total = 0;
                            table += '<tr>';
                            table += '<td>' + row + '</td>';
                            table += '<td>' + data[i].name + '</td>';
                            table += '<td><input type ="text" name="service_as_per_use[]" id="service_validity" value="'+ Service_used + '"></></td>';
                            table += '<tr>';
                            row++;
                            price   = parseInt(data[i].price);
                            TotalPrice += price;
                            $('#best_price').val(TotalPrice);
                            $('#istimate').html(table);
                        }
                    }
                }, 'json');
            }else {
                $('#istimate').html('');
            }
        }

//Function for Package Name already exist or not 

        $( "#packagename" ).change(function() {
           var package_name = $('#packagename').val();
            $.post(base_url + "admin/package/packagenameexist", {
                package_name: package_name
            }, function(response) {
                if(response.status == 1){
                 alert('Package name already exist');
                }
            }, 'json');
         });

        $('#brand_clear_all').click(function () {
       $('#brand_id option').prop('selected', false);
        $("#brand_id").trigger("change");
    }); 

    $('#model_clear_all').click(function () {
       $('#model_id option').prop('selected', false);
        $("#model_id").trigger("change");
    }); 

    $('#subcategory_clear_all').click(function () {
       $('#subcategory_id option').prop('selected', false);
        $("#subcategory_id").trigger("change");
    }); 
 
    $('#services_clear_all').click(function () {
       $('#service_id option').prop('selected', false);
       $("#service_id").trigger("change");
    }); 
 
</script>