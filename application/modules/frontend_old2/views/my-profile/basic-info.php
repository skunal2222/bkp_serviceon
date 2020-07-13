<?php //echo "<pre>"; print_r($data); exit; ?>
<style type="text/css">
    .danger{
        color: red;
    }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/my-profile/common.css">
<div class="my-pofile">
	<div class="container">
	    <div class="banner-section">	
		</div>
		<div class="profile row">
			<div class="col-md-3 col-sm-4">
				<div class="profile-navigation" id="profile-navigation">
					<ul>
						<li>
							<a href="<?php echo base_url();?>ongoing-orders">
							    Ongoing Order
						    </a>
						</li>
						<li>
							<a href="<?php echo base_url();?>order-history">
							    Order History
						    </a>
						</li>
						<li class="active">
							<a href="<?php echo base_url();?>basic-info">
							    Basic Info
						    </a>
						</li>
						<li>
							<a href="<?php echo base_url();?>refer-n-earn">
							    Refer and Earn
						    </a>
						</li>
						<li>
							<a href="<?php echo base_url();?>wallet">
							   My Wallet
						    </a>
						</li>
                         <li>
                            <a href="<?php echo base_url();?>doc-wallet">
                               Doc Wallet
                            </a>
                        </li>
						<li>
							<a href="<?php echo base_url();?>notifications">
							    Notifications
						    </a>
						</li>
                         <li>
                            <a href="<?php echo base_url();?>my-packages">
                               My Packages
                            </a>
                        </li>
					</ul>
				</div>
			</div>
			<div class="col-md-9 col-sm-8">
				<div class="detail-section">

					<!-- Account Settings -->
                        <div class="account">
                            <div class="basic-info">
                                <h2>Basic Info</h2>
                                <div class="container">
                                  <div class="account-modal">
                                    <form name="update_profile" id="update_profile" action="" method="post" >
                                        <div class="row">

                                            <div class="col-md-6 col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" name="upfname" id="upfname" class="form-control custom-input" value="<?php echo $data['name']; ?>" placeholder="First Name">
                                                    <span class="input-group-addon spl-icon"><i class="glyphicon glyphicon-user"></i></span>
                                                </div>
                                                <div class="messageContainer"></div>
                                            </div>

                                            <div class="col-md-6 col-sm-6">
                                                <div class="input-group">
                                                   <input type="text" name="uplname" id="uplname" class="form-control custom-input" value="<?php echo $data['lname']; ?>" placeholder="Last Name">
                                                    <span class="input-group-addon spl-icon"><i class="glyphicon glyphicon-user"></i></span>
                                                </div>
                                                <div class="messageContainer"></div>
                                            </div>
                                        </div>  
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <div class="input-group">
                                                   <input type="email" name="upemail" id="upemail" class="form-control custom-input" value="<?php echo $data['email']; ?>" placeholder="Email Id" readonly="">
                                                    <span class="input-group-addon spl-icon"><i class="glyphicon glyphicon-envelope"></i></span>
                                                </div>
                                                <div class="messageContainer"></div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <div class="input-group">
                                                   <input type="text" name="upmobile" id="upmobile" class="form-control custom-input" value="<?php echo $data['mobile'] ; ?>" placeholder="Phone No." readonly="">
                                                    <span class="input-group-addon spl-icon"><i class="glyphicon glyphicon-phone"></i></span>
                                                </div>
                                                <div class="messageContainer"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6">
                                               <div class="input-group">
                                                   <input type="password" name="password" id="password1" class="form-control custom-input" placeholder="enter password">
                                                   <span class="input-group-addon spl-icon"><i class="glyphicon glyphicon-lock"></i></span>
                                                </div>
                                                <div class="messageContainer"></div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                            	
                                                <div class="input-group">
                                                   <input type="password" name="cpassword" id="cpassword" class="form-control custom-input" placeholder="confirm password">
                                                    <span class="input-group-addon spl-icon"><i class="glyphicon glyphicon-lock"></i></span>
                                                </div>
                                                <div class="messageContainer"></div>
                                            </div>
                                        </div>   
                                         <div id="up_response" style="display:none;color:red"></div>
                                            <div class="text-center">
                                                <button class="saved-btn" type="submit">Save</button>
                                            </div>
                                    </form>
    
                                    <form>        
                                        <div class="row"> 
                                             <div class="col-md-6"> 
                                                <h2>Vehicle List</h2>  
                                            </div>
                                             <div class="col-md-6">  
                                             	<div class="text-center">
                                             	<button type="button" class="add-vehicle-btn saved-btn" id="add-vehicle" data-toggle="modal" data-target="#add-new-vehicle">+ Add </button> 
                                                </div>
                                            </div>
                                        </div>  
                                        <style type="text/css">
                                            .vehicleList .col-md-4{
                                                height: 50px;

                                            }
                                        </style>
                                        <div class="row vehicleList">   

                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                            	<th>Sr No.</th>
                                                                <th>Brand</th>
                                                                <th>Model</th>
                                                                <th>Vehicle No</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody> 
                                                 			<?php 
								                              if(!empty($vehicalList)){?>
								                           <?php $i= 1; foreach ($vehicalList as $value):?>
                                                              <tr>
                                                              	<td><?php echo $i ;?></td>
                                                                <td><?php echo $value['brandname'];?></td>
                                                                <td><?php echo $value['modelname'];?></td>
                                                                <td><?php echo $value['vehicle_no'];?></td>
                                                                <td><a href = "#" class="open-Dialog" data-target="#my_modal" data-toggle="modal" data-id="<?php echo $value['id'];?>"><i class="fa fa-pencil"></i></a></td>
                                                              </tr>
                                                              <?php $i++; endforeach;?>
						       							 <?php  } else{?>
															<tr><td colspan="4">Records not found.</td></tr>
														<?php }?>
                                                        </tbody>
                                                    </table>  

                                        </div>   
                                       
                                    </form>
                                     </div>
                               </div> 
                                
                            </div>
                        </div>
                    <!-- Account Settings ends -->

				</div>
			</div>
		</div>
	</div>
</div>

 <div class="modal fade" id="my_modal" role="dialog">
    <div class="modal-dialog add-new-add select-vehicle account-modal">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="text-center">Edit Vehicle</h4>
            </div>
            <div class="modal-body"> 
                <form id="editvehical" name="editvehical" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id1" id="id1" value="" /> 
                    <input type="hidden" name="vehicle_brand" id="vehicle_brand" value="" />
                    <input type="hidden" name="vehicle_model" id="vehicle_model" value="" /> 
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Vehicle Brand <span class='danger'>*</span></label>
                                 <select name="brand_id1" id="brand_id1" onclick="getmodels();"  class="form-control">
                                     <option value=""> Select Brand </option>
                                    <?php foreach ($brands as $brand) : ?>
                                    <option value="<?php echo $brand['id'];?>"><?php echo $brand['name'];?></option>  
                                    <?php endforeach;?>                                                     
                                    </select>  
                            </div>
                            <div class="messageContainer"></div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Vehicle Model <span class='danger'>*</span></label>
                                <select name="model_id1" class="form-control custom-add" id="model_id1"> 
                                  <!-- <option value="">Select Model</option>  -->
                                    <?php foreach ($models as $model) : ?>
                                     <option value="<?php echo $model['id'];?>"><?php echo $model['name'];?></option> 
                                    <?php endforeach;?> 
                                </select> 
                            </div>
                            <div class="messageContainer"></div>
                        </div>
                         <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Vehicle No. <span class='danger'>*</span></label>
                                <input type="text" id="vehicle_no1" value="" name="vehicle_no1" placeholder="Vehicle No." class="form-control custom-input">
                            </div>
                             <div class="messageContainer"></div>
                        </div>
                        <!--  <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>License Number</label>
                                <input type="text" id="license_number1" value="" name="license_number1" placeholder="License number" class="form-control custom-input">
                            </div>
                             <div class="messageContainer"></div>
                        </div>
                         <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Insurance Service Provider</label>
                                <input type="text" id="insurance_brand1"  name="insurance_brand1" placeholder="Insurance Service Provider" class="form-control custom-input">
                            </div>
                             <div class="messageContainer"></div>
                        </div>
                         <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Insurance Number</label>
                                <input type="text" id="insurance_number1"  name="insurance_number1" placeholder="Insurance Number" class="form-control custom-input">
                            </div>
                             <div class="messageContainer"></div>
                        </div> -->


                    </div>
                    <div class="form-group text-center">
                        <button class="custom-btn1" type="submit" >Update</button>
                    </div>
                    <div id="response"></div> 
                </form>
            </div>
        </div>
    </div>
</div>
<!-- add vehicle modal ends --> 
 
<!-- add vehicle modal strats -->
<div class="modal fade" id="add-new-vehicle" role="dialog">
    <div class="modal-dialog add-new-add select-vehicle account-modal">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="text-center">Add new Vehicle</h4>
            </div>
            <div class="modal-body"> 
    			<form id="addvehical" name="addvehical" action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                            	<label>Vehicle Brand <span class='danger'>*</span></label>
                                <select name="brand_id" class="form-control custom-add" id="brand_id">
                                	 <option value=""> Select Brand </option>
                                        <?php foreach ($brands as $brand) { ?>
                                            <option value="<?php echo $brand['id']; ?>" ><?php echo $brand['name']; ?></option>
                                        <?php }
                                        ?>
							    </select>  
                            </div>
                            <div class="messageContainer"></div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                            	<label>Vehicle Model <span class='danger'>*</span></label>
                                <select name="model_id" class="form-control custom-add" id="model_id">
                                	 <option value="">Select Model</option> 
							    </select> 
                            </div>
                            <div class="messageContainer"></div>
                        </div>
                         <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                            	<label>Vehicle No. <span class='danger'>*</span></label>
                                <input type="text" id="vehicle_no"  name="vehicle_no" placeholder="Vehicle No." class="form-control custom-input">
                            </div>
                             <div class="messageContainer"></div>
                        </div>
                        <!--  <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>License Number</label>
                                <input type="text" id="license_number"  name="license_number" placeholder="License number" class="form-control custom-input">
                            </div>
                             <div class="messageContainer"></div>
                        </div>
                         <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Insurance Bank</label>
                                <input type="text" id="insurance_brand"  name="insurance_brand" placeholder="Insurance Bank" class="form-control custom-input">
                            </div>
                             <div class="messageContainer"></div>
                        </div>
                         <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Insurance Number</label>
                                <input type="text" id="insurance_number"  name="insurance_number" placeholder="Insurance Number" class="form-control custom-input">
                            </div>
                             <div class="messageContainer"></div>
                        </div> -->


                    </div>
                    <div class="form-group text-center">
                        <button class="custom-btn1" type="submit" >Save</button>
                    </div>
                    <div id="response"></div> 
                </form>
            </div>
        </div>
    </div>
</div>
<!-- add vehicle modal ends -->

 

<script>

$('#update_profile').bootstrapValidator({
    container: function($field, validator) {
        return $field.parent().next('.messageContainer');
    },
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
        upfname: {
            validators: {
                notEmpty: {
                    message: 'First Name is required and cannot be empty'
                }
            }
        }, 
        uplname: {
            validators: {
                notEmpty: {
                    message: 'Last Name is required and cannot be empty'
                }
            }
        }, 
        upemail: {
            validators: {
                notEmpty: {
                    message: 'Email is required'
                },
                regexp: {
                    regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                    message: 'Not a valid email address'
                }
                
            }
        },
        upmobile: {
            validators: {
                notEmpty: {
                    message: 'The Mobile is required.'
                },
                regexp: {
                    //regexp: '^[7-9][0-9]{9}$',
                    regexp: '^[0-9]{6,14}$',
                    message: 'Invalid Mobile Number'
                } 
            }
        },
        password: {
            validators: {
                notEmpty: {
                    message: 'Password is required'
                },
            }
        },
        cpassword: {
            validators: {
                notEmpty: {
                    message: 'Confirm Password is required'
                },
                identical: {
                    field: 'password',
                    message: 'Passwords do not match.'
                }
            }
        }
    
    }
}).on('success.form.bv', function(event,data) {
    event.preventDefault();
   // sendOTP();
   updateUser();
});
 
function updateUser() {
  //  debugger;

   var radioValue = $("input[name='gender']:checked").val();
        $.post(base_url+"updateuser", { fname: $("#upfname").val(), lname: $("#uplname").val(), email: $("#upemail").val(), mobile: $("#upmobile").val(),password: $("#password1").val(),cpassword: $("#cpassword").val() }, function(data){
            if(data.status == 1 ) {
             //   ajaxindicatorstop();
                     $("#up_response").show();
                     $("#up_response").html(data.msg);
                swal("Profile updated successfully.",{button: "continue",timer: 2000})
                .then((value) => {
                    location.reload();
                    $("#lg_uid").val(data.id);
                    $("#su_emailreg").val(data.email);
                });
            
            } else {
                //ajaxindicatorstop();
                $("#up_response").show();
                $("#up_response").html(data.msg);
            }
    },'json');
}





window.onscroll = function() {myFunction()};

var navbar = document.getElementById("profile-navigation");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky && window.pageYOffset <= 600) { 
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}


$(document).on("click", ".open-Dialog", function () {
     var Id = $(this).data('id'); 
  //debugger;
     if (Id != '') {
                $.post(base_url + "admin/vehicle/get_vehicles_by_id", {
                    vehicle_id: Id

                }, function (data) {  

                    console.log(data); 
                      	   
                       /* $('#brand_id1').html('');    
                        $('#brand_id1').empty();
                        $('#brand_id1').append("<option value=''>"+'Select Brand'+"</option>");  
                        $('#model_id1').empty();
                        $('#model_id1').append("<option value=''>"+'Select Model'+"</option>");         
         */

                      	   $('#id1').val(data.id);
                           $('#vehicle_no1').val(data.vehicle_no);
                           /*$('#license_number1').val(data.license_number); 
                           $('#insurance_brand1').val(data.insurance_brand);
                           $('#insurance_number1').val(data.insurance_number);*/ 
                           $('#vehicle_brand').val(data.brand_id);
                           $('#vehicle_model').val(data.model_id); 

                           var brand_value = $("#vehicle_brand").val()

                          // alert(brand_value);
                           if (brand_value == data.brand_id) {

                            $('#brand_id1').append("<option value='"+data.brand_id+" selected'>"+data.brandname+"</option>");

                           }
                           else
                           {

                            $('#brand_id1').append("<option value='"+data.brand_id+"'>"+data.brandname+"</option>");

                           }

                           $('#model_id1').append("<option value='"+data.model_id+"'>"+data.modelname+"</option>");

                          /* $('#brand_id1').append("<option value='"+data.brand_id+"'>"+data.brandname+"</option>"); 
                           $('#model_id1').append("<option value='"+data.model_id+"'>"+data.modelname+"</option>"); */


                }, 'json');
            }

      		/*var cat_id = 9;       
			console.log(cat_id);	    
			$.post(base_url+"admin/brandbycatid/", {cat_id : cat_id}, function(data)
			{
				$('#brand_id1').empty();$('#brand_id1').append("<option value=''>"+'Select Brand'+"</option>");		    
				if(data.length > 0)
				{		    
					for( var i=0; i < data.length; i++)
					{		   			    
						$('#brand_id1').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");			
					}	    
				}	   
			},'json'); */     

});


 $("#brand_id").change(function ()
        {
            var brand_id = $('#brand_id').val();
            console.log(brand_id);
            $('#model_id').html(''); 
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

 $("#brand_id1").change(function() 
		{
			var brand_id =  $('#brand_id1').val();       
			console.log(brand_id);	    
			$.post(base_url+"admin/modelbybrandid/", {brand_id : brand_id}, function(data)
			{
                $('#model_id1').empty();
				$('#model_id1').empty();$('#model_id1').append("<option value=''>"+'Select Model'+"</option>");		    
				if(data.length > 0)
				{		    
					for( var i=0; i < data.length; i++)
					{		   			    
						$('#model_id1').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");			
					}	    
				}	   
			},'json');   
		});

 $('#addvehical').bootstrapValidator({
        container: function ($field, validator) {
            return $field.parent().next('div.messageContainer');
        },
        feedbackIcons: {
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {  
            
            'brand_id': {
                validators: {
                    notEmpty: {
                        message: 'Brand is required and cannot be empty'
                    }
                }
            },
            'model_id': {
                validators: {
                    notEmpty: {
                        message: 'Model is required and cannot be empty'
                    }
                }
            },
            'vehicle_no': {
                validators: {
                    notEmpty: {
                        message: 'Vehical Number is required and cannot be empty'
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
            url: base_url + 'add-vehical',
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
        //alert(resp.msg);
        
        if (resp.status == '0') {
            swal('',resp.msg,'warning');
            $("#response").removeClass('alert-success');
            $("#response").addClass('alert-danger');
            $("#response").html(resp.msg);
            $("#response").show();
        } else {
            swal('',resp.msg,'success');
            $("#response").removeClass('alert-danger');
            $("#response").addClass('alert-success');
            $("#response").html(resp.msg);
            $("#response").show(); 
            setTimeout(function() {
           	 window.location.href = base_url + "basic-info";
           }, 2000);
            
        }
    } 




 $('#editvehical').bootstrapValidator({
        container: function ($field, validator) {
            return $field.parent().next('div.messageContainer');
        },
        feedbackIcons: {
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {  
            
            'brand_id1': {
                validators: {
                    notEmpty: {
                        message: 'Brand is required and cannot be empty'
                    }
                }
            },
            'model_id1': {
                validators: {
                    notEmpty: {
                        message: 'Model is required and cannot be empty'
                    }
                }
            },
            'vehicle_no1': {
                validators: {
                    notEmpty: {
                        message: 'Vehical Number is required and cannot be empty'
                    }
                }
            }

        }
    }).on('success.form.bv', function (event, data) {
        // Prevent form submission
        event.preventDefault();
        EditVehical();
    }); 

    function EditVehical() { 
        var options = {
            target: '#response1',
            beforeSubmit: customFunctionReq,
            success: customFunctionResp,
            url: base_url + 'edit-vehical',
            semantic: true,
            dataType: 'json'
        };
        $('#editvehical').ajaxSubmit(options);
    }

    function customFunctionReq(formData, jqForm, options) {
        $("#response1").hide();
        ajaxindicatorstart("Please hang on.. while we editing vehical ..");
        var queryString = $.param(formData);
        return true;
    }

    function customFunctionResp(resp1, statusText, xhr, $form) {
        ajaxindicatorstop();
        //alert(resp.msg);
        
        if (resp1.status == '0') {
            swal('',resp1.msg,'warning');
            $("#response1").removeClass('alert-success');
            $("#response1").addClass('alert-danger');
            $("#response1").html(resp1.msg);
            $("#response1").show();
        } else {
            swal('',resp1.msg,'success');
            $("#response1").removeClass('alert-danger');
            $("#response1").addClass('alert-success');
            $("#response1").html(resp1.msg);
            $("#response1").show(); 
            setTimeout(function() {
            window.location.href = base_url + "basic-info";
           }, 100);
            
        }
    } 


   /* function getbrands(){

        var cat_id = 9;       
            console.log(cat_id);        
            $.post(base_url+"admin/brandbycatid/", {cat_id : cat_id}, function(data)
            {
                $('#brand_id1').empty();$('#brand_id1').append("<option value=''>"+'Select Brand'+"</option>");         
                if(data.length > 0)
                {           
                    for( var i=0; i < data.length; i++)
                    {                       
                        $('#brand_id1').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");         
                    }       
                }      
            },'json');       

    }*/

     function getmodels()
    {
        var brand_id =  $('#brand_id1').val();       
            console.log(brand_id);      
            $.post(base_url+"admin/modelbybrandid/", {brand_id : brand_id}, function(data)
            { 
                $('#model_id1').empty();
                $('#model_id1').append("<option value=''>"+'Select Model'+"</option>");         
                if(data.length > 0)
                {           
                    for( var i=0; i < data.length; i++)
                    {                       
                        $('#model_id1').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");         
                    }       
                }      
            },'json');   
    }

     $("#brand_id").selectize({});


</script>