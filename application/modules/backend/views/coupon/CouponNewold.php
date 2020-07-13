<style>
    <!--
    .margin-bottom-5{
        margin-bottom: 5px;
    }
    -->
</style>
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/selectize.bootstrap3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/datepicker3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/bootstrap-timepicker.min.css">

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
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5"> Coupon Code<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="coupon_code" name="coupon_code" required />
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>
								
                                </div>
                                
                                   <div class="row">
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
                                </div>
                                
                                    <div class="row">
                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Coupon Type<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                               	<select name="coupon_type" id="coupon_type" onchange="couponType(this.value);" class="form-control">
													<option value="0" selected>Discount only</option>
													<option value="1">Cashback + Discount</option>
													<option value="2">Cashback only</option>
												</select>
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>
									
									<div class="col-lg-6 margin-bottom-5">
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
                                </div>
                                
                                 <div class="row">
                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Cashback<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="cashback" name="cashback" />
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>
									
									<div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Max Cashback<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="max_cashback" name="max_cashback" />
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                  <div class="row">
                                    <div class="col-lg-6 margin-bottom-5">
                                        
                                        <div class="form-group" id="error-online_payment">
                                            <label class="control-label col-sm-5">Discount Type </label>
                                            <div class="col-sm-10">
                                                <select name="discount_type" id="discount_type" class="form-control">
                                                    <option value="1">Percentage</option>
                                                    <option value="2">Flat</option>
                                                </select>
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Discount<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="discount" name="discount" />
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>

                                    </div>
                                </div>
								
                                    <div class="row">
                                    <div class="col-lg-6 margin-bottom-5">
                                        
                                        <div class="form-group" id="error-online_payment">
                                            <label class="control-label col-sm-5">Max Discount </label>
                                            <div class="col-sm-10">
                                              <input type="text" class="form-control" id="max_discount" name="max_discount" />
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Minimum Order Value <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="min_order_value" name="min_order_value" required />
                                            </div>
                                            <div class="messageContainer col-sm-10"></div>
                                        </div>

                                    </div>
                                </div>
                               
                                <div class="row">
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
                                </div>
                                
                                 <div class="row">
									<div class="col-md-6 margin-bottom-5">
										<div class="form-group" id="error-name">
											<label class="control-label col-sm-5">Category<span class='text-danger'>*</span></label>
											 <div class="col-sm-10">
											<select name="category_id" id="category_id" class="form-control">
													<option value=""> Select Category </option>
													<?php foreach ($categories as $category) { ?>
													<option value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option>
													<?php } ?>
												</select>
												</div>
										</div>
										<div class="messageContainer col-sm-10"></div>
									</div>
									<div class="col-md-6 margin-bottom-5">
										<div class="form-group" id="error-name">
											<label class="control-label col-sm-5">Brand<span class='text-danger'>*</span></label>
											 <div class="col-sm-10">
												<select name="brand_id" id="brand_id" class="form-control">
														<option value=""> Select Brand </option>												
												</select>
											</div>
										</div>
										<div class="messageContainer col-sm-10"></div>
									</div>
							   </div>
							   
							    <!--<div class="row">
									<div class="col-md-6 margin-bottom-5">
										<div class="form-group" id="error-name">
											<label class="control-label col-sm-5">Model<span class='text-danger'>*</span></label>
											 <div class="col-sm-10">
											<select name="model_id" id="model_id" class="form-control">
													<option value=""> Select Model</option>	
												</select>
												</div>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
									<div class="col-md-6 margin-bottom-5">
												<div class="form-group" id="error-name">
											<label class="control-label col-sm-5">Subcategory<span class='text-danger'>*</span></label>
											 <div class="col-sm-10">
											<select name="subcategory_id" id="subcategory_id" class="form-control">
													<option value=""> Select Subcategory</option>						
											</select>
											</div>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
                                </div>-->
                                
                                <div class="row">
                                    <!--<div class="col-md-6 margin-bottom-5">
												<div class="form-group" id="error-name">
											<label class="control-label col-sm-5">Service<span class='text-danger'>*</span></label>
											 <div class="col-sm-10">
											<select name="service_id" id="service_id" class="form-control">
													<option value=""> Select Service</option>						
											</select>
											</div>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>-->
									
                               
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
<script src="<?php echo asset_url(); ?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo asset_url(); ?>js/selectize.min.js"></script>
<script src="<?php echo asset_url(); ?>js/jquery.form.js"></script>
<script>

$('#start_date').datepicker({
	  autoclose:true,
	 // startDate : date,
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
$('#addcoupon').bootstrapValidator({
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
                    message: 'Title is required and cannot be empty'
                }
            }
        },
        coupon_code: {
            validators: {
                notEmpty: {
                    message: 'Coupon Code is required and cannot be empty'
                }
            }
        },
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
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	addCoupon();
});

function addCoupon() {
	if($("#coupon_type option:selected").val() == 0){
		if($("#discount").val() == '' || $("#max_discount").val() == ''){
			alert("Please enter discount or max discount");
			$("#couponbtn").attr('disabled',true);
		}else{
			saveCoupon();
		}
	}else if($("#coupon_type option:selected").val() == 1){
		if($("#discount").val() == '' || $("#max_discount").val() == '' || $("#cashback").val() == '' || $("#max_cashback").val() == ''){
			alert("Please enter discount or max discount or cashback or max cashback");
			$("#couponbtn").attr('disabled',true);
		}else{
			saveCoupon();
		}
	}else if($("#coupon_type option:selected").val() == 2){
		if($("#cashback").val() =='' || $("#max_cashback").val() == ''){
			alert('Please enter cashback or max cashback');
			$("#couponbtn").attr('disabled',true);
		}else{
			saveCoupon();
		}
	}
}
function saveCoupon(){
	ajaxindicatorstart("Please wait.. while Adding..");
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/coupon/addcoupon',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#addcoupon').ajaxSubmit(options);
}
function showAddRequest(formData, jqForm, options){
	ajaxindicatorstop();
	$("#response").hide();
   	var queryString = $.param(formData);
	return true;
}
   	
function showAddResponse(resp, statusText, xhr, $form){
	if(resp.status == '0') {
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
        window.location.href = base_url+"admin/coupon/list";
  	}
}
</script>

<script>
$(document).ready(function(){    
	$("#category_id").change(function() {
		var cat_id =  $('#category_id').val();       
			console.log(cat_id);
			 ajaxindicatorstart("Please wait....");	    
			  $.post(base_url+"admin/brandbycatid/", {cat_id : cat_id}, function(data){
				  ajaxindicatorstop();
				  $('#brand_id').empty();$('#brand_id').append("<option value=''>"+'Select Brand'+"</option>");		    
			   if(data.length > 0)
				   {		    
				     for( var i=0; i < data.length; i++)
					     {		   			    
					        $('#brand_id').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");			
					     }	    
			       }	   
	         },'json');   
       });

	$("#brand_id").change(function() {
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

	$("#model_id").change(function(){
		var model_id =  $('#model_id').val();       
			console.log(model_id);	    
			  $.post(base_url+"admin/subcategorybycatid/", {model_id : model_id}, function(data)
					  {
				  $('#subcategory_id').empty();$('#subcategory_id').append("<option value=''>"+'Select SubCategory'+"</option>");		    
			   if(data.length > 0)
				   {		    
				     for( var i=0; i < data.length; i++)
					     {		   			    
					           $('#subcategory_id').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");			
					            }	    
			              }	   
	               },'json');   
               });

	$("#subcategory_id").change(function() 
			{
		var subcat_id =  $('#subcategory_id').val();       
			console.log(subcat_id);	    
			  $.post(base_url+"admin/servicebycatid/", {subcat_id : subcat_id}, function(data)
					  {
				  $('#service_id').empty();$('#service_id').append("<option value=''>"+'Select Service'+"</option>");		    
			   if(data.length > 0)
				   {		    
				     for( var i=0; i < data.length; i++)
					     {		   			    
					           $('#service_id').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");			
					            }	    
			              }	   
	               },'json');   
               });
    
    });

couponType(0);
function couponType(coupon_type){
	if(coupon_type == 0){
		$("#cashback").attr("readonly", true);
		$("#cashback").val('');
		$("#cashback_type").attr("disabled", true);
		$("#max_cashback").attr("readonly", true);
		$("#max_cashback").val('');
		$("#discount").attr("readonly", false);
		$("#discount_type").attr("disabled", false);
		$("#max_discount").attr("readonly", false);
	}
	if(coupon_type == 2){
		$("#cashback").attr("readonly", false);
		$("#cashback_type").attr("disabled", false);
		$("#max_cashback").attr("readonly", false);
		$("#discount").attr("readonly", true);
		$("#discount").val('');
		$("#discount_type").attr("disabled", true);
		$("#max_discount").attr("readonly", true);
		$("#max_discount").val('');
	}
	if(coupon_type == 1){
		$("#discount").attr("readonly", false);
		$("#discount_type").attr("disabled", false);
		$("#max_discount").attr("readonly", false);
		$("#cashback").attr("readonly", false);
		$("#cashback_type").attr("disabled", false);
		$("#max_cashback").attr("readonly", false);
	}
}
</script>