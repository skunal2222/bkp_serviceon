<link type="text/css" rel="stylesheet" href="<?php echo asset_url();?>css/datepicker3.css">

<link type="text/css" rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap-timepicker.min.css">

<div id="page-wrapper">

            <div class="container-fluid">

                <div class="row bg-title">

                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

                        <h4 class="page-title">Tickets</h4> </div>

                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                        <ol class="breadcrumb">

                            <li><a href="#">Dashboard</a></li>

                            <li class="active">Tickets</li>

                        </ol>

                    </div>

                    <!-- /.col-lg-12 -->

                </div>

                <!-- /.row -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="panel panel-info">

                          <!--   <div class="panel-heading"> 

                         Category

                            </div>-->

                            <div class="panel-wrapper collapse in" aria-expanded="true">

                                <div class="panel-body">

                                        <div class="form-body">

                                               <ul class="nav customtab nav-tabs" role="tablist">

				                                <li role="presentation" class="nav-item"><a href="#basic" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Category</span></a></li>
				                                
				                                <li role="presentation" class="nav-item"><a href="#subcat" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Subcategory</span></a></li>
				                                
				                                <li role="presentation" class="nav-item"><a href="#status" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Status</span></a></li>

				                                                        </ul>

                                          	<div class="tab-content">
 			<div id="basic"  role="tabpanel" class="tab-pane fade in active show"  aria-expanded="true" >  

													<div id="">

														 	<div class="row">

																<div class="col-lg-12">

																	<div class="btn-plus">

																	<a href="javascript: add();" class="btn btn-primary view-contacts bottom-margin" style="color:white;">

																		<i class="fa fa-plus"></i> Category

																	</a>

																	</div>

														        	<div class="panel panel-default">

														            	<div class="panel-heading">

														                	Category List

														              	</div>

														               	<div class="panel-body">

														                	<div class="dataTable_wrapper">

														                       	<table class="table table-striped table-bordered table-hover" id="tblcategory">

																					<thead class="bg-info">

																						<tr>

																							<th>ID</th>

																							<th>Name</th>

														     								<th>Action</th>

																						</tr>

																					</thead>

																					<tbody>
																					<?php if (isset($categories)) { ?>

																					<?php foreach ($categories as $item):?>

																						<tr>

																							<td>

																								<?php echo $item['id'];?>

																							</td>

																							<td>

																								<?php echo $item['name'];?>

																							</td>

                                                                         					<td><a href = "javascript: edit(<?php echo $item['id']?>);" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil" style="color:white;"></i></a></td>

																						</tr>

																						<?php endforeach;?>

																					<?php } else { ?>

																						<tr><td colspan="4">Records not found.</td></tr>

																					<?php }?>

																					
																					</tbody>

																				</table>

																			</div>

																		</div>

																	</div>

																	<a href="javascript: add();" class="btn btn-primary view-contacts bottom-margin" style="color:white;">

																		<i class="fa fa-plus"></i> Category

																	</a>

																</div>

															</div>

														</div>
	 </div>
	 
		<div id="subcat"  role="tabpanel" class="tab-pane fade"  aria-expanded="true" >  

													<div id="">

														 	<div class="row">

																<div class="col-lg-12">

																	<div class="btn-plus">

																	<a href="javascript: addsubcat();" class="btn btn-primary view-contacts bottom-margin" style="color:white;">

																		<i class="fa fa-plus"></i>Subcategory

																	</a>

																	</div>

														        	<div class="panel panel-default">

														            	<div class="panel-heading">

														                	Subcategory List

														              	</div>

														               	<div class="panel-body">

														                	<div class="dataTable_wrapper">

														                       	<table class="table table-striped table-bordered table-hover" id="tblsubcategory">

																					<thead class="bg-info">

																						<tr>

																							<th>ID</th>

																							<th>Category</th>
																							
																							<th>Subcategory</th>

														     								<th>Action</th>

																						</tr>

																					</thead>

																					<tbody>

																					<?php if (isset($subcategories)) { ?>

																					<?php foreach ($subcategories as $item):?>

																						<tr>

																							<td>

																								<?php echo $item['id'];?>

																							</td>

																							<td>

																								<?php echo $item['category'];?>

																							</td>

                                                                                            <td>

																								<?php echo $item['name'];?>

																							</td>
																							
																							<td><a href = "javascript: editsubcat(<?php echo $item['id']?>);" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil" style="color:white;"></i></a></td>

																						</tr>

																						<?php endforeach;?>

																					<?php } else { ?>

																						<tr><td colspan="4">Records not found.</td></tr>

																					<?php }?>

																					</tbody>

																				</table>

																			</div>

																		</div>

																	</div>

																	<a href="javascript: addsubcat();" class="btn btn-primary view-contacts bottom-margin" style="color:white;">

																		<i class="fa fa-plus"></i>Subcategory

																	</a>

																</div>

															</div>

														</div>

															

                                               		 </div>
                                               		 
                                              		 
                                            <div id="status"  role="tabpanel" class="tab-pane fade"  aria-expanded="true" >  

													<div id="">

														 	<div class="row">

																<div class="col-lg-12">

																	<div class="btn-plus">

																	<a href="javascript: addstatus();" class="btn btn-primary view-contacts bottom-margin" style="color:white;">

																		<i class="fa fa-plus"></i> Status

																	</a>

																	</div>

														        	<div class="panel panel-default">

														            	<div class="panel-heading">

														                	Status List

														              	</div>

														               	<div class="panel-body">

														                	<div class="dataTable_wrapper">

														                       	<table class="table table-striped table-bordered table-hover" id="tblstatus">

																					<thead class="bg-info">

																						<tr>

																							<th>ID</th>

																							<th>Status</th>
																						
														     								<th>Action</th>

																						</tr>

																					</thead>

																					<tbody>

																					<?php if (isset($status)) { ?>

																					<?php foreach ($status as $item):?>

																						<tr>

																							<td>

																								<?php echo $item['id'];?>

																							</td>

																							<td>

																								<?php echo $item['name'];?>

																							</td>

                                                                                         	
																							<td><a href = "javascript: editstatus(<?php echo $item['id']?>);" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil" style="color:white;"></i></a></td>

																						</tr>

																						<?php endforeach;?>

																					<?php } else { ?>

																						<tr><td colspan="4">Records not found.</td></tr>

																					<?php }?>

																					</tbody>

																				</table>

																			</div>

																		</div>

																	</div>

																	<a href="javascript: addstatus();" class="btn btn-primary view-contacts bottom-margin" style="color:white;">

																		<i class="fa fa-plus"></i> Status

																	</a>

																</div>

															</div>

														</div>

															

                                               		 </div>

                                                

                                            	

                                             </div>

                                    
	                                        </div>

                                    

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            

            <!-- /.container-fluid -->

        </div>

        <script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>

		<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>

		<script src="<?php echo asset_url();?>js/bootstrap-timepicker.min.js"></script>

		<script src="<?php echo asset_url();?>js/selectize.min.js"></script>

		<script src="<?php echo asset_url();?>js/jquery.form.js"></script>

		<script>

			$.fn.datepicker.defaults.format = "dd-mm-yyyy";

			$('#special_from_date').datepicker().on('changeDate', function(ev){

				$('#special_from_date').bootstrapValidator('revalidateField', 'cycle_effective_date');

			});

			$('#special_to_date').datepicker().on('changeDate', function(ev){

				$('#special_to_date').bootstrapValidator('revalidateField', 'cycle_effective_date');

			});

			$('#new_to_date').datepicker().on('changeDate', function(ev){

				$('#new_to_date').bootstrapValidator('revalidateField', 'cycle_effective_date');

			});

			$('#new_from_date').datepicker().on('changeDate', function(ev){

				$('#new_from_date').bootstrapValidator('revalidateField', 'cycle_effective_date');

			});

			$('#avail_from_date').datepicker().on('changeDate', function(ev){

				$('#avail_from_date').bootstrapValidator('revalidateField', 'cycle_effective_date');

			});

			$('#avail_to_date').datepicker().on('changeDate', function(ev){

				$('#avail_to_date').bootstrapValidator('revalidateField', 'cycle_effective_date');

			}); 

			/* $('#new_from_date').datepicker().on('changeDate', function(ev){

				$('#new_from_date').bootstrapValidator('revalidateField', 'cycle_effective_date');

			}); */



		</script>

		

		

		

        <script>



//         $.post(base_url+"signup", { name: $("#su_name").val() }, function(data){

//     		if(data.is_register == 1) {

//     			alert("SignUp Successful.");

//     			$("#signInModal").modal("hide");

//     			//$("#otpModal").modal("show");

//     			//$("#lg_uid").val(data.id);

//     			window.location.reload();

//     		} else {

//     			$("#su_response").show();

//     			$("#su_response").html(data.msg);

//     		}

//     	},'json');

        

        $(".attrgrp" ).change(function() {

           var attrgrp = $("#attribute_group_id").val();

           //alert(attrgrp);

          	 $.get(base_url + "admin/productAttribute", { attribute_group_id : attrgrp }, function (data) {

	              // alert(data);

	    	      // alert('Status is changed');

	        	   $("#attributes").empty();

	        	   $("#attributes").html(data);

        	   

      			});

        	});

        </script>

        

<script>

$('#addProduct').bootstrapValidator({

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

        sku: {

            validators: {

                notEmpty: {

                    message: 'SKU is required and cannot be empty'

                }

            }

        },

    	price : {

	        validators: {

	        	numeric: {

                    message: 'The value is not a number',

                }, 

	            notEmpty: {

	                message: 'Price is required and cannot be empty'

	            }

	        }

	    },

	    special_price : {

	        validators: {

	        	numeric: {

                    message: 'The value is not a number',

                } 

	            

	        }

	    },

	    minimum_quantity : {

	        validators: {

	        	numeric: {

                    message: 'The value is not a number',

                } 

	            

	        }

	    },

	    quantity: {

            validators: {

                numeric: {

                    message: 'The value is not a number',

                }, 

                notEmpty: {

	                message: 'Quantity is required and cannot be empty'

	            }

            }

        }, 

        vendor_id : {

        	validators :{

					notEmpty: {

							message : 'Please select a vendor'

						}

					}

            }

    }

}).on('success.form.bv', function(event,data) {

	// Prevent form submission

	event.preventDefault();

	addProduct();

});



function addProduct() {

	var options = {

	 		target : '#response', 

	 		beforeSubmit : showAddRequest,

	 		success :  showAddResponse,

	 		url : base_url+'admin/product/add',

	 		semantic : true,

	 		dataType : 'json'

	 	};

   	$('#addProduct').ajaxSubmit(options);

}



function showAddRequest(formData, jqForm, options){

	$("#response").hide();

   	var queryString = $.param(formData);

	return true;

}

   	

function showAddResponse(resp, statusText, xhr, $form){

	if(resp.status == '0') {

		$("#response").removeClass('alert-success');

       	$("#response").addClass('alert-danger');

		$("#response").html(resp.msg.name);

		$("#response").show();

  	} else {

  		$("#response").removeClass('alert-danger');

        $("#response").addClass('alert-success');

        $("#response").html(resp.msg);

        $("#response").show();

        alert(resp.msg);

        window.location.href = base_url+"admin/product/add";

  	}

}



function abc(input){

	//alert('hello');

	$(input).val('1')

}





//Image Preview 

var images = $('.imageOutput')



$(".imageUpload").change(function(event){

    readURL(this);

});



function readURL(input) {



    if (input.files && input.files[0]) {

        $.each(input.files, function() {

            var reader = new FileReader();

            reader.onload = function (e) {           

                images.append('<img height="100" width="100" src="'+ e.target.result+'" /> <input type="radio" name="is_image[]" value="0" onclick="abc(this)" />');

            }

            reader.readAsDataURL(this);

        });

        

    }

}



$(function () {

    $("input[type='checkbox']").change(function () {

        $(this).siblings('ul')

            .find("input[type='checkbox']")

            .prop('checked', this.checked);

    });

});

</script>

<script>

$(document).ready(function(){

    $('#tblcategory').DataTable();

});

$(document).ready(function(){
    $('#tblsubcategory').DataTable();
});

$(document).ready(function(){
    $('#tblstatus').DataTable();
});

</script>

<Script>

function add()

{

	//alert('hello');

	$.post(base_url+"admin/general/new",{},function(data) {

		//alert(data);

		$("#basic").html(data);

		

	},'html');



}



function edit(id)

{

	//alert('hello');

	//alert(id);

	$.post(base_url+"admin/general/edit",{id: id},function(data) {

		$("#basic").html(data);

		

	},'html');



}


function addsubcat()

{

	//alert('hello');

	$.post(base_url+"admin/general/newsub",{},function(data) {

		//alert(data);

		$("#subcat").html(data);

		

	},'html');



}



function editsubcat(id)

{

	//alert('hello');

	//alert(id);

	$.post(base_url+"admin/general/editsub",{id: id},function(data) {

		$("#subcat").html(data);

		

	},'html');



}

function addstatus()

{

	//alert('hello');

	$.post(base_url+"admin/general/newstatus",{},function(data) {

		//alert(data);

		$("#status").html(data);

		

	},'html');



}



function editstatus(id)

{

	//alert('hello');

	//alert(id);

	$.post(base_url+"admin/general/editstatus",{id: id},function(data) {

		$("#status").html(data);

		

	},'html');



}
</Script>

