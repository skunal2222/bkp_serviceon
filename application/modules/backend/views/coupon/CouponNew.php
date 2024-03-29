 
<style>
    <!--
    .margin-bottom-5{
        margin-bottom: 5px;
    }
    -->
    .select2{
        width : 100% !important;
    }
    .hidden{
        display: none;
    }
</style>
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/selectize.bootstrap3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/datepicker3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css">

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3>Add Coupon</h3>
        </div>
    </div>

    <form id="addcoupon" name="addcoupon" action="" method="post" >
        <div class="tab-content">
            <div id="basic" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" >
                                Add Coupon
                            </div>
                            <div class="panel-body">

                                

                                <div class="row">

                                    <div class="col-lg-12 margin-bottom-5">
                                        <div class="form-group" id="error-online_payment">

                                            <label class="control-label col-sm-5">Coupon Type</label>
                                            <div class="col-sm-10">
                                                <label class="radio-inline"><input type="radio" id="serviceon" value="1" name="ctype" checked>Service On</label>
                                                <label class="radio-inline"><input type="radio" id="garagespec" value ="0" name="ctype" >Garage Specific</label>
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>

                                    </div>

                                    <div class="col-lg-6 margin-bottom-5 hidden" id="optionalGarageList">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Select Garage<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <select name="garage_id" id="garage_id" class="form-control">
                                                    <option disabled="" selected="">Select garage</option>
                                                    <?php foreach ($garages as $garage) { ?>
                                                        <option value="<?php echo $garage['id']; ?>"><?php echo $garage['garage_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>


                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Campaign name<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="name" name="name" required />
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-online_payment">

                                            <label class="control-label col-sm-5">Coupon Code Type</label>
                                            <div class="col-sm-10">
                                                <label class="radio-inline"><input type="radio" id="generic" value="1" name="cctype" checked>Generic</label>
                                                <label class="radio-inline"><input type="radio" id="unique" value ="0" name="cctype" >Unique</label>
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 margin-bottom-5 hidden" id="cctypeinput">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5"> No. of Coupon Code<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="coupon_code_cnt" name="coupon_code_cnt" />
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 margin-bottom-5 hidden" id="times">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5"> How many times can be used?<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="times" name="times" />
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 margin-bottom-5" id="cpn_code">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5"> Coupon Code<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="coupon_code" name="coupon_code"/>
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>


                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Coupon Description<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="description" name="description" required />
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Coupon Category ?<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                        <select name="coupon_category" id="coupon_category" onchange="couponCategory(this.value);" class="form-control">
                                                    <option value="1" selected>Service</option>
                                                    <!-- <option value="2">Package</option>  -->
                                                </select>
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>



                                    <!-- <div class="col-md-6 margin-bottom-5">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label col-sm-5">Package<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <select name="package_id[]" id="package_id" class="form-control" multiple="true">
                                                    <?php foreach ($packages as $package) { ?>
                                                        <option value="<?php echo $package['id']; ?>"><?php echo $package['package_name']; ?></option>
                                                    <?php } ?>
                                                     <input type="button" id="select_all7" class="btn btn-success" name="select_all7" value="Select All">
                                                     <input type="button" class="btn btn-success" id="package_clear_all" name="package_clear_all" value="Clear All">
                                                </select> 
                                            </div>
                                            <div class="messageContainer col-sm-12"></div> 
                                        </div>
                                    </div> -->

                                    

                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Is First Order Coupon ?<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <select name="is_new_user" id="is_new_user" class="form-control">
                                                    <option value="0" selected>No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div> 

                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Coupon Type<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                               	<select name="coupon_type" id="coupon_type" onchange="couponType(this.value);" class="form-control">
                                                    <option value="0" selected>Discount only</option>
                                                    <!-- <option value="1">Cashback + Discount</option> -->
                                                    <!-- <option value="2">Cashback only</option> -->
                                                </select>
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>

                                    <!-- <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Cashback type<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <select name="cashback_type" id="cashback_type" class="form-control">
                                                    <option value="1" selected>Percentage</option>
                                                    <option value="2">Flat</option>
                                                </select>
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Cashback<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <input type="number" step=1 min=0 class="form-control" id="cashback" name="cashback" />
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Max Cashback<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <input type="number" step=1 min=0 class="form-control" id="max_cashback" name="max_cashback" />
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div> -->

                                    <div class="col-lg-6 margin-bottom-5">

                                        <div class="form-group" id="error-online_payment">
                                            <label class="control-label col-sm-5">Discount Type </label>
                                            <div class="col-sm-10">
                                                <select name="discount_type" id="discount_type" class="form-control" >
                                                    <option value="1">Percentage</option>
                                                    <option value="2">Flat</option>
                                                </select>
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Discount</label>
                                            <div class="col-sm-10">
                                                <input type="number" step=1 min=0 class="form-control" id="discount" name="discount" />
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>

                                    </div>

                                    <div class="col-lg-6 margin-bottom-5">

                                        <div class="form-group" id="error-online_payment">
                                            <label class="control-label col-sm-5">Max Discount </label>
                                            <div class="col-sm-10">
                                                <input type="number" step=1 min=0 class="form-control" id="max_discount" name="max_discount" />
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Minimum Order Value <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <input type="number" step=1 min=0 class="form-control" id="min_order_value" name="min_order_value" required />
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>

                                    </div>

                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-eclose_time">
                                            <label class="control-label col-sm-5">From Date <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="start_date" name="start_date" required value=""/>
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-eclose_time">
                                            <label class="control-label col-sm-5">To Date <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="end_date"  required name="end_date" value=""/>
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-bottom-5">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label col-sm-5">Category<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <select name="category_id" id="category_id" class="form-control">
                                                    <!-- <option value=""> Select Category </option> -->
                                                    <?php foreach ($categories as $category) { ?>
                                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="messageContainer col-sm-12"></div>

                                        </div>
                                    </div>

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

                                </div>

                            
                                <div class="row">
                                    
                                    <!-- <div class="col-md-6 margin-bottom-5">
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
                                    </div> -->
                                </div>

                                <!-- <div class="row">
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
                                    <div class="col-md-6 margin-bottom-5">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label col-sm-5">Select Subcategory</label>
                                            <div class="col-sm-10">
                                                <select name="subcategory_id[]" id="subcategory_id" class="form-control" multiple="true">
                                                    <input type="button" id="select_all3" class="btn btn-success" name="select_all3" value="Select All">
                                                     <input type="button" class="btn btn-success" id="subcategory_clear_all" name="subcategory_clear_all" value="Clear All">    					
                                                </select>
                                            </div>
                                        </div>
                                        <div class="messageContainer col-sm-4"></div>
                                    </div>
                                </div> -->

                                <div class="row">
                                    <!-- <div class="col-md-6 margin-bottom-5">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label col-sm-5">Select Service Group </label>
                                            <div class="col-sm-10">
                                                <select name="service_id[]" id="service_id" class="form-control" multiple="true">
                                                  
                                                    <input type="button" id="select_all4" class="btn btn-success" name="select_all4" value="Select All">
                                                    <input type="button" class="btn btn-success" id="service_group_clear_all" name="service_group_clear_all" value="Clear All">                  
                                                </select>
                                            </div>
                                        </div>
                                        <div class="messageContainer col-sm-4"></div>
                                    </div>
                                    <div class="col-md-6 margin-bottom-5">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label col-sm-5">Select Services </label>
                                            <div class="col-sm-10">
                                                <select name="single_services[]" id="single_services" class="form-control" multiple="true">
                                                  
                                                    <input type="button" id="select_all5" class="btn btn-success" name="select_all5" value="Select All">  
                                                    <input type="button" class="btn btn-success" id="services_clear_all" name="services_clear_all" value="Clear All"> 				
                                                </select>
                                            </div>
                                        </div>
                                        <div class="messageContainer col-sm-4"></div>
                                    </div>
                                    
                                    <div class="col-md-6 margin-bottom-5">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label col-sm-5">Select Spares</label>
                                            <div class="col-sm-10">
                                                <select name="spare_id[]" id="spare_id" class="form-control" multiple="true">
                                                    <input type="button" id="select_all6" class="btn btn-success" name="select_all6" value="Select All">	
                                                     <input type="button" class="btn btn-success" id="spare_clear_all" name="spare_clear_all" value="Clear All"> 					
                                                </select>
                                            </div>
                                        </div>
                                        <div class="messageContainer col-sm-4"></div>
                                    </div> -->


                                    

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
 
    $(document).ready(function () {
        
    var nowDate = new Date();
    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
    $.fn.datepicker.defaults.format = "dd-mm-yyyy";
    $.fn.datepicker.defaults.startDate = today;

    // $('#start_date').datepicker().on('changeDate', function (e) {
    //     $('#addcoupon').bootstrapValidator('revalidateField', '#start_date');
    // }); 
    // $('#end_date').datepicker().on('changeDate', function (e) {
    //     $('#addcoupon').bootstrapValidator('revalidateField', '#end_date');
    // }); 


    $('#start_date').datepicker({
    autoclose:true,
     //startDate : date,
      format: 'dd-mm-yyyy'
     
        }).on('change',function(e){
             $('#addcoupon').bootstrapValidator('revalidateField', $('#start_date'));
        });
        $('#end_date').datepicker({
            autoclose:true,
              format: 'dd-mm-yyyy'
        }).on('change',function(e){
             $('#addcoupon').bootstrapValidator('revalidateField', $('#end_date'));
        });
        
        //Chosen
        $("#brand_id").select2({
            //maxItems: 3
        });
        $("#model_id").select2({
            //maxItems: 3
        });
        $("#subcategory_id").select2({
            maxItems: 3
        }); 
        $("#service_id").select2({
            maxItems: 3
        }); 
        $("#single_services").select2({
           maxItems: 3
        });
        $("#spare_id").select2({
            maxItems: 3
        }); 
        $("#package_id").select2({
            maxItems: 3
        }); 
    });


   /* function Remove_options()
    {
        $('#brand_id option').prop('selected', false);
        $("#brand_id").trigger("change");
    }*/



    $('#clear_all').click(function () {
       $('#brand_id option').prop('selected', false);
        $("#brand_id").trigger("change");
    }); 

    $('#select_all').click(function () {
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
    $('#select_all5').click(function() {
        $('#single_services option').prop('selected', true);
        $("#single_services").trigger("change");
    }); 
    $('#select_all6').click(function() {
        $('#spare_id option').prop('selected', true);
        $("#spare_id").trigger("change");
    }); 
     $('#select_all7').click(function() {
        $('#package_id option').prop('selected', true);
        $("#package_id").trigger("change");
    });

    $('#addcoupon').bootstrapValidator({
        container: function ($field, validator) {
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
                        message: 'Title is required and cannot be empty'
                    }
                }
            },
           /* category_id: {
                validators: {
                    notEmpty: {
                        message: 'Category is required and cannot be empty'
                    }
                }
            },
            package_id: {
                validators: {
                    notEmpty: {
                        message: 'Package is required and cannot be empty'
                    }
                }
            },*/
            ctype: {
                validators: {
                    notEmpty: {
                        message: 'Coupon type is required and cannot be empty'
                    }
                }
            },
            // coupon_code: {
            //     validators: {
            //         notEmpty: {
            //             message: 'Coupon Code is required and cannot be empty'
            //         }
            //     }
            // },
            /* discount: {
             validators: {
             notEmpty: {
             message: 'Discount is required and cannot be empty'
             }
             }
             },*/
           /* brand_id: {
                validators: {
                    notEmpty: {
                        message: 'Brand is required and cannot be empty'
                    }
                }
            },*/

            /* count_per_user: {
             validators: {
             notEmpty: {
             message: 'Value is required and cannot be empty'
             },
             numeric: {
             message: 'The value is not a number',
             thousandsSeparator: '',
             decimalSeparator: '.'
             }
             }
             }, */
            min_order_value: {
                validators: {
                    notEmpty: {
                        message: 'Minimum Order Value is required and cannot be empty'
                    },
                    numeric: {
                        message: 'The value is not a number',
                        thousandsSeparator: '',
                        decimalSeparator: '.'
                    }
                }
            },
            start_date: {
                validators: {
                    notEmpty: {
                        message: 'Start Date is required and cannot be empty'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'The Start Date is not a valid'
                    }
                }
            },
            end_date: {
                validators: {
                    notEmpty: {
                        message: 'End Date is required and cannot be empty'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'The End Date is not a valid'
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
        addCoupon();
    });


    function addCoupon() {

        /*if (($('#brand_id').val()) == null) {
            $('#error_brand').html('Brand is required and cannot be empty');
            $("#couponbtn").attr('disabled', true);
            return;
        }*/
        if ($("#coupon_type option:selected").val() == 0) {
            if ($("#discount").val() == '' || $("#max_discount").val() == '') {
                alert("Please enter discount or max discount");
                $("#couponbtn").attr('disabled', true);
                return;
            }
        } else if ($("#coupon_type option:selected").val() == 1) {
            if ($("#discount").val() == '' || $("#max_discount").val() == '' || $("#cashback").val() == '' || $("#max_cashback").val() == '') {
                alert("Please enter discount or max discount or cashback or max cashback");
                $("#couponbtn").attr('disabled', true);
                return;
            }
        } else if ($("#coupon_type option:selected").val() == 2) {
            if ($("#cashback").val() == '' || $("#max_cashback").val() == '') {
                alert('Please enter cashback or max cashback');
                $("#couponbtn").attr('disabled', true);
                return;
            }
        }
        saveCoupon();
    }
    function saveCoupon() {
        ajaxindicatorstart("Please wait.. while Adding..");
        var options = {
            target: '#response',
            beforeSubmit: showAddRequest,
            success: showAddResponse,
            url: base_url + 'admin/coupon/addcoupon',
            semantic: true,
            dataType: 'json'
        };
        $('#addcoupon').ajaxSubmit(options);

    }
    function showAddRequest(formData, jqForm, options) {
        ajaxindicatorstop();
        $("#response").hide();
        var queryString = $.param(formData);
        return true;
    }

    function showAddResponse(resp, statusText, xhr, $form) {
        console.log(resp);
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
            if($('#coupon_code_cnt').val()!=''){
            	window.location.href = base_url+'admin/menu/downloadCouponCodes/'+resp.last_id;
            }
            setTimeout(function(){
                window.location.href = base_url + "admin/coupon/list";
            }, 1000);
        }
    }
</script>

<script>
    $(document).ready(function () {
        $("#category_id").change(function () {
            var cat_id = $('#category_id').val();
           // console.log(cat_id);
            ajaxindicatorstart("Please wait....");
            $.post(base_url + "admin/brandbycatid/", {cat_id: cat_id}, function (data) {
                ajaxindicatorstop();
                // $('#brand_id').empty();$('#brand_id').append("<option value=''>"+'Select Brand'+"</option>");		    
                if (data.length > 0)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#brand_id').append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
                    }
                }
            }, 'json');
        });

        $("#brand_id").change(function() {
    		var brand_id =  $('#brand_id').val();       
                    $.post(base_url+"admin/modelbybrandid1/", {brand_id : brand_id}, function(data){
                            $('#model_id').empty();
                            if(data.length > 0) {		
                              $('#model_id').html("");						   
                              for( var i=0; i < data.length; i++)  {		
                                  $('#model_id').append("<option value='"+data[i].id+"'>"+data[i].name+"("+data[i].brand_name+")</option>");
                              }   
                            }
    	               },'json');   
         });
        
         $("#model_id").change(function(){
         var model_id =  $('#model_id').val();       
         console.log(model_id);	    
         $.post(base_url+"admin/subcategorybycatid_3/", {model_id : model_id}, function(response)
         {
             var data = response.subcat;
         $('#subcategory_id').empty();		    
         if(data.length > 0)
         {		    
         for( var i=0; i < data.length; i++)
         {		   			    
         $('#subcategory_id').append("<option value='"+data[i].id+"'>"+data[i].name+" ("+data[i].model_name+")</option>");			
         }	    
         }
         data = response.spare;
         $('#spare_id').empty();
         if(data.length > 0)
         {		    
         for( var i=0; i < data.length; i++)
         {		   			    
         $('#spare_id').append("<option value='"+data[i].id+"'>"+data[i].name+" ("+data[i].model_name+")</option>");			
         }	    
         }
         },'json');   
         });
         
        /* $("#subcategory_id").change(function() {
                var subcat_id =  $('#subcategory_id').val();       
                console.log(subcat_id);	    
                $.post(base_url+"admin/servicebycatid1/", {subcat_id : subcat_id}, function(data)
                {
                $('#service_id').empty();
                if(data.length > 0)
                {		    
                for( var i=0; i < data.length; i++)
                {		   			    
                $('#service_id').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");			
                }	    
                }	   
                },'json');   
         });*/
         $("#subcategory_id").change(function ()
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

        $('input[type=radio][name=ctype]').change(function() {
            if (this.value == '0') {
                $('#optionalGarageList').removeClass('hidden');
            }else if (this.value == '1') {
                $('#optionalGarageList').addClass('hidden');
            }
        });

        $('input[type=radio][name=cctype]').change(function() {
            if (this.value == '0') {
                //unique
                $('#cctypeinput').removeClass('hidden');
                $('#cpn_code').addClass('hidden');
                $('#times').removeClass('hidden');

            }else if (this.value == '1') {
                //generic
                $('#cpn_code').removeClass('hidden');
                $('#cctypeinput').addClass('hidden');
                $('#times').addClass('hidden');

            }
        });

        
    });

    couponType(0);
    function couponType(coupon_type) {
        if (coupon_type == 0) {
            $("#cashback").attr("readonly", true);
            $("#cashback").val('');
            $("#cashback_type").attr("disabled", true);
            $("#max_cashback").attr("readonly", true);
            $("#max_cashback").val('');
            $("#discount").attr("readonly", false);
            $("#discount_type").attr("disabled", false);
            $("#max_discount").attr("readonly", false);
        }
        if (coupon_type == 2) {
            $("#cashback").attr("readonly", false);
            $("#cashback_type").attr("disabled", false);
            $("#max_cashback").attr("readonly", false);
            $("#discount").attr("readonly", true);
            $("#discount").val('');
            $("#discount_type").attr("disabled", true);
            $("#max_discount").attr("readonly", true);
            $("#max_discount").val('');
        }
        if (coupon_type == 1) {
            $("#discount").attr("readonly", false);
            $("#discount_type").attr("disabled", false);
            $("#max_discount").attr("readonly", false);
            $("#cashback").attr("readonly", false);
            $("#cashback_type").attr("disabled", false);
            $("#max_cashback").attr("readonly", false);
        }
    }

/*
    $(document).ready(function(){    
    $("#coupon_category").change(function() 
            {
            if($('#coupon_category').val() == 1){
                $('#tax_value').show();
                $('#tax').val('');
            }  
            else{

                $('#tax_value').hide();
                $('#tax').val(0);
            } 
      });
    }); */


    couponCategory(1);
    function couponCategory(coupon_category) {
        if (coupon_category == 1) {
            $("#package_id").attr("disabled", true);  
            $("#package_clear_all").attr("disabled", true);
            $("#select_all7").attr("disabled", true);
            $("#category_id").attr("disabled", false); 
            $("#brand_id").attr("disabled", false);
            $("#select_all").attr("disabled", false); 
            $("#model_id").attr("disabled", false);
            $("#select_all2").attr("disabled", false);  
            $("#subcategory_id").attr("disabled", false); 
            $("#select_all3").attr("disabled", false); 
            $("#service_id").attr("disabled", false);
            $("#select_all4").attr("disabled", false);
            $("#single_services").attr("disabled", false);
            $("#select_all5").attr("disabled", false);
            $("#spare_id").attr("disabled", false);
            $("#select_all6").attr("disabled", false);  

            $("#brand_clear_all").attr("disabled", false);
            $("#model_clear_all").attr("disabled", false);
            $("#subcategory_clear_all").attr("disabled", false);   
            $("#service_group_clear_all").attr("disabled", false);
            $("#services_clear_all").attr("disabled", false); 
            $("#spare_clear_all").attr("disabled", false);  
        }
        if (coupon_category == 2) { 
            $("#package_id").attr("disabled", false); 
            $("#package_clear_all").attr("disabled", false);
            $("#select_all7").attr("disabled", false);
            $("#category_id").attr("disabled", true); 
            $("#brand_id").attr("disabled", true);
            $("#select_all").attr("disabled", true); 
            $("#model_id").attr("disabled", true);
            $("#select_all2").attr("disabled", true); 
            $("#subcategory_id").attr("disabled", true);
            $("#select_all3").attr("disabled", true);    
            $("#service_id").attr("disabled", true);
            $("#select_all4").attr("disabled", true); 
            $("#single_services").attr("disabled", true);
            $("#select_all5").attr("disabled", true); 
            $("#spare_id").attr("disabled", true);
            $("#select_all6").attr("disabled", true); 
            $("#brand_clear_all").attr("disabled", true);
            $("#model_clear_all").attr("disabled", true);
            $("#subcategory_clear_all").attr("disabled", true);   
            $("#service_group_clear_all").attr("disabled", true);
            $("#services_clear_all").attr("disabled", true); 
            $("#spare_clear_all").attr("disabled", true); 
        }
    }


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

    $('#service_group_clear_all').click(function () {
       $('#service_id option').prop('selected', false);
        $("#service_id").trigger("change");
    }); 

    $('#services_clear_all').click(function () {
       $('#single_services option').prop('selected', false);
       $("#single_services").trigger("change");
    }); 

    $('#spare_clear_all').click(function () {
       $('#spare_id option').prop('selected', false);
        $("#spare_id").trigger("change");
    }); 

    $('#package_clear_all').click(function () {
       $('#package_id option').prop('selected', false);
        $("#package_id").trigger("change");
    }); 

</script>