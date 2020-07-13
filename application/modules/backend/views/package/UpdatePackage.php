
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
      <h3>Update Package
      </h3>
    </div>
  </div>
  <form id="editpackage" name="editpackage" action="" method="post">
    <div class="tab-content">
      <div id="basic" class="tab-pane fade in active">
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading" >
                Package 
              </div>
              <div class="panel-body">
                <?php foreach ($package as $packageItem) { ?>
                <input type="hidden" value="<?php echo $packageItem['id']; ?>" id="id" name="id">
                <div class="row">
                  <div class="col-lg-6 margin-bottom-5">
                    <div class="form-group" id="error-mstart_time">
                      <label class="control-label col-sm-5">Package name
                        <span class='text-danger'>*
                        </span>
                      </label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $packageItem['package_name']; ?>" required />
                      </div>
                      <div class="messageContainer col-sm-10">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 margin-bottom-5">
                    <div class="form-group" id="error-eclose_time">
                      <label class="control-label col-sm-5">Category 
                        <span class='text-danger'>*
                        </span>
                      </label>
                      <div class="col-sm-10">
                        <select name="category_id" id="category_id" class="form-control">
                          <option value=""> Select Category 
                          </option>
                          <?php foreach ($categories as $category) { ?>
                          <option value="<?php echo $category['id'];?>" 
                                  <?php if($category['id'] == $packageItem['category_id']) {?>selected
                          <?php }?>>
                          <?php echo $category['name'];?>
                          </option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="messageContainer col-sm-10">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 margin-bottom-5">
                  <div class="form-group" id="error-eclose_time">
                    <label class="control-label col-sm-5">Brand
                      <span class='text-danger'>*
                      </span>
                    </label>
                    <div class="col-sm-10">
                      <select name="brand_id[]" id="brand_id" class="form-control" multiple="true">
                        <?php
                          if (! empty ( $brands )) {
                            foreach ( $brands as $pro ) {
                              $commaseparatedlist = explode ( ',', $packageItem['brand_id'] );
                        ?>
                        <option value="<?php echo $pro['id'] ?>"
                                <?php if (in_array($pro['id'], $commaseparatedlist))  {?>
                        selected 
                        <?php }?>>
                        <?php echo $pro['name'] ?>
                        </option>
                      <?php  } }  ?>
                      </select>
                    <input type="button" id="select_all" class="btn btn-success" name="select_all" value="Select All">
                    <input type="button" class="btn btn-success" id="brand_clear_all" name="brand_clear_all" value="Clear All">
                  </div>
                  <div class="messageContainer col-sm-10" id="error_brand" style="color:#a94442;">
                  </div>
                </div>
              </div>
            <div class="col-md-6 margin-bottom-5">
                <div class="form-group" id="error-name">
            <label class="control-label col-sm-5">Select Model</label>
                <div class="col-sm-10">
            <select name="model_id[]" id="model_id" class="form-control" multiple="true">
               <!--  <option value=""> Select Model</option>  -->
                <?php foreach ($models as $model) { ?>
                    <option value="<?php echo $model['id'];?>" <?php echo in_array($model['id'], $selectedModel) ? 'selected':'';?>>
                    <?php echo $model['name']; ?>
                    </option>
                <?php } ?>      
            </select>
            <input type="button" id="select_all2" class="btn btn-success" name="select_all2" value="Select All"> 
            <input type="button" class="btn btn-success" id="model_clear_all" name="model_clear_all" value="Clear All">
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
                  <?php if (! empty ( $subcategories )) {
                          foreach ( $subcategories as $subcat ) {
                              $commaseparatedlist = explode ( ',', $packageItem['subcategory_id'] );
                  ?>
                  <option value="<?php echo $subcat['id'] ?>" <?php if (in_array($subcat['id'], $commaseparatedlist))  {?>
                        selected <?php }?>>
                      <?php echo $subcat['name'].'('.$subcat['model'].')' ?>
                  </option>
                 <?php  } }  ?>                     
               </select>
               <input type="button" id="select_all3" class="btn btn-success" name="select_all3" value="Select All">  
               <input type="button" class="btn btn-success" id="subcategory_clear_all" name="subcategory_clear_all" value="Clear All"> 
              </div>
            </div>
           <div class="messageContainer col-sm-4"></div>
            </div> 
            <div class="col-lg-6 margin-bottom-5">
              <div class="form-group" id="error-name">
                <label class="control-label col-sm-5">Select Services </label>
                  <div class="col-sm-10">
                <select name="service_id[]" id="service_id" class="form-control" multiple="true">  
                 <!-- <option value=""> Select Services</option>  -->
                <?php foreach ($services as $ActiveModelservices) { ?>
                    <option value="<?php echo $ActiveModelservices['id'];?>" <?php echo in_array($ActiveModelservices['id'], $selectedService) ? 'selected':'';?>>
                    <?php echo $ActiveModelservices['name']; ?>
                    </option>
                <?php }?>                                                  
                </select>
                <input type="button" id="select_all4" class="btn btn-success" name="select_all4" value="Select All">
                <input type="button" class="btn btn-success" id="service_clear_all" name="service_clear_all" value="Clear All">
              </div>
              </div>
            <div class="messageContainer col-sm-4"></div>
            </div>
            </div>
        <div class="row">
          <div class="col-lg-6 margin-bottom-5">
             <div class="form-group" id="error-mstart_time">
              <label class="control-label col-sm-5">Best Price<span class='text-danger'>*</span></label>
             <div class="col-sm-10">
                <input type="text" class="form-control" id="best_price" name="best_price" 
                value="<?php echo $packageItem['best_price']; ?>" required />
             </div>
                <div class="messageContainer col-sm-10"></div>
             </div>
             </div>
          <div class="col-lg-6 margin-bottom-5">
           <div class="form-group" id="error-mstart_time">
            <label class="control-label col-sm-5">Special Price<span class='text-danger'>*</span></label>
              <div class="col-sm-10">
            <input type="text" class="form-control" id="special_price" name="special_price" 
            value="<?php echo $packageItem['special_price']; ?>" required />
              </div>
            <div class="messageContainer col-sm-10"></div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 margin-bottom-5">
              <div class="form-group" id="error-eclose_time">
              <label class="control-label col-sm-5">Short Description<span class='text-danger'>*</span>
              </label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="short_description" name="short_description" value="<?php echo $packageItem['short_description']; ?>" required ><?php echo $packageItem['short_description']; ?></textarea>
                </div>
                  <div class="messageContainer col-sm-10"></div>
              </div>
            </div>
            <div class="col-lg-6 margin-bottom-5">
              <div class="form-group" id="error-eclose_time">
               <label class="control-label col-sm-5">Long Description<span class='text-danger'>*</span>
               </label>
                <div class="col-sm-10">
                   <textarea class="form-control" id="long_description" name="long_description" value="<?php echo $packageItem['long_description']; ?>"required ><?php echo $packageItem['long_description']; ?></textarea>
                </div>
                  <div class="messageContainer col-sm-10"></div>
              </div>
            </div>
        </div>
         <div class="row">
          <div class="col-lg-6 margin-bottom-5">
             <div class="form-group" id="error-mstart_time">
              <label class="control-label col-sm-5">Who use referal code<span class='text-danger'>*</span></label>
             <div class="col-sm-10">
                <input type="text" class="form-control" id="my_referral" name="my_referral" 
                value="<?php echo $packageItem['my_referral']; ?>" required />
             </div>
                <div class="messageContainer col-sm-10"></div>
             </div>
             </div>
          <div class="col-lg-6 margin-bottom-5">
           <div class="form-group" id="error-mstart_time">
            <label class="control-label col-sm-5">Who share refferal code<span class='text-danger'>*</span></label>
              <div class="col-sm-10">
            <input type="text" class="form-control" id="other_referral" name="other_referral" 
            value="<?php echo $packageItem['other_referral']; ?>" required />
              </div>
            <div class="messageContainer col-sm-10"></div>
              </div>
            </div>
        </div>
        <div class="row"> 
                <div class="col-lg-6 margin-bottom-5">
                  <div class="form-group" id="error-eclose_time">
                    <label class="control-label col-sm-5">Year
                      <span class='text-danger'>*
                      </span>
                    </label>
                    <div class="col-sm-10">
                     <select name="Year" id="Year" class="form-control Year" >
                       <option value="<?php echo $packageItem['year']; ?>" ><?php echo $packageItem['year']; ?></option> 
                     </select>
                  </div>
                  <div class="messageContainer col-sm-10" id="error_brand" style="color:#a94442;">
                  </div>
                </div>
              </div>
            <div class="col-md-6 margin-bottom-5">
                <div class="form-group" id="error-name">
            <label class="control-label col-sm-5">User per use</label>
                <div class="col-sm-10">
            <select name="service_used_validity" id="Service_used" class="form-control service_used_validity " >
              <option value="<?php echo $packageItem['service_used_validity']; ?>" ><?php echo $packageItem['service_used_validity']; ?></option>
            </select>
            </div>
            </div>
            <div class="messageContainer col-sm-4"></div>
            </div>

        </div>

<div class="row"> 
  <div class="col-lg-6 margin-bottom-5">
    <div class="form-group" id="error-online_payment">
      <label class="control-label col-sm-5">Status
      </label>
      <div class="col-sm-10">
        <label class="radio-inline">
          <input type="radio" id="yes1" value="1" name="status" 
                 <?php if($packageItem['status']==1)echo "checked";?> >Active
        </label>
        <label class="radio-inline">
          <input type="radio" id="no1" value ="0" name="status"  
                 <?php if($packageItem['status']==0)echo "checked";?>>Deactive
        </label>
      </div>
      <div class="messageContainer col-sm-10">
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group" id="error-image">
      <label class="control-label ">Upload Image (80 X 80 px) </label> 
        <input type="file"  name="image" id="image" value="<?php echo $packageItem['image'];?>"
        class="form-control ">
    </div>
    <span> <img src="<?php echo asset_url();?><?php echo $packageItem['image'];?>" width="160px" height="80px" />
    </span>
  <div class="messageContainer col-sm-4"></div>
  </div>
</div>
<div class="col-lg-8" id="defaulttable">
  <h2>Service Details</h2>
  <?php $i = 1; ?>
    <table class="table table-striped">
      <thead>
          <tr>
            <th>Sr.no</th>
            <th>Name</th>
            <th>User per use</th>
          </tr>
      </thead>
      <tbody >
    <?php foreach ($packageservices as $value) { ?>
        <tr>
           <td><?php echo $i++ ?></td>
           <td><?php echo $value['servicename'] ?></td>
           <td><input type ="text" name="service_as_per_use[]" id="service_validity" value=
            "<?php echo $value['service_used_validity']; ?>"></></td>
        </tr> 
    <?php } ?>    
       </tbody>
    </table>  
</div>    
<?php } ?>

<div class="col-lg-8" id="servicetable">
  <h2>Service Details</h2>
    <table class="table table-striped">
      <thead>
          <tr>
            <th>Sr.no</th>
            <th>Name</th>
            <th>User per use</th>
          </tr>
      </thead>
        <tbody id="istimate"></tbody>
    </table>  
</div>   
<div class="col-lg-12 margin-bottom-5 text-center">
  <div id="response">
  </div>
  <button type="submit" id="couponbtn"   class="btn btn-success">Submit
  </button>
</div>
<br>
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
<!--<script src="<?php echo asset_url(); ?>js/bootstrap-timepicker.min.js"></script>-->
<script src="<?php echo asset_url(); ?>js/selectize.min.js"></script>
<script src="<?php echo asset_url(); ?>js/jquery.form.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script>
$(document).ready(function(){
	 $("#brand_id").select2({
		 maxItems: 3
	  })
    $("#model_id").select2({
        maxItems: 3
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


$('#editpackage').bootstrapValidator({
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
            /*redeem_points: {
            validators: {
              notEmpty: {
                message: 'Refer amount is required and cannot be empty'
              },
                  regexp: {
                          regexp: '^[0-9]*[1-9]+[0-9]*$',
                          message: 'Invalid value'
                      }
                  }
                  
            }*/
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
                
            }

        }
    }).on('success.form.bv', function(event, data) {
        event.preventDefault();
	    editPackage();
});

function editPackage() {
        if(($('#brand_id').val()) == null){
            $('#error_brand').html('Brand is required and cannot be empty');
            $("#couponbtn").attr('disabled',true);
            return;
        } 
    updatePackage() ; 
}
function updatePackage(){
	ajaxindicatorstart("Please wait.. while Adding..");
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/package/updatePackage',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#editpackage').ajaxSubmit(options);
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
		$("#response").show();
		alert(resp.msg);
  	} else {
  		ajaxindicatorstop();
  		$("#response").removeClass('alert-danger');
        $("#response").addClass('alert-success');
        $("#response").html(resp.msg);
        $("#response").show();
        alert(resp.msg);
        window.location.href = base_url+"admin/package/list";
  	}
}
</script>

<script>
$(document).ready(function(){    
	$("#category_id").change(function() {
		var cat_id =  $('#category_id').val();       
			console.log(cat_id);	    
			ajaxindicatorstart("Please wait....");
			  $.post(base_url+"admin/brandbycatid/", {cat_id : cat_id}, function(data)
					  {
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
        $('#model_id').select2('val', '');
        $('#model_id').html('');           
      ajaxindicatorstart("Please wait....");
        $.post(base_url+"admin/getmodelsbybrid/", {brand_id : brand_id}, function(data)
            {
          ajaxindicatorstop();
         $('#model_id').empty();$('#model_id').append("<option value=''>"+'Select Model'+"</option>");
         $('#model_id').empty();        
         if(data.length > 0)
           {      
            $('#model_id').html("");  
             for( var i=0; i < data.length; i++)
               {                
                     $('#model_id').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");     
                      }     
                    }    
                 },'json');   
       });

                
        $("#model_id").change(function(e) {
            e.preventDefault();
            var model_id = $('#model_id').val();
            $('#subcategory_id').select2('val', '');
            $('#subcategory_id').html('');
            console.log(model_id);
            $.post(base_url + "admin/subcategorybycatid_3/", {
                model_id: model_id
            }, function(response) {
                var data = response.subcat;
                $('#subcategory_id').empty();
                if (data.length > 0) {
                  $('#subcategory_id').html("");
                    for (var i = 0; i < data.length; i++) {
                         $('#subcategory_id').append("<option value='"+data[i].id+"'>"+data[i].name+" ("+data[i].model_name+")</option>"); 
                    }
                }
                data = response.spare;
                //$('#spare_id').empty();
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
                  console.log(data); 
                $('#service_id').empty();
                if(data.length > 0)
                {     
                
                $('#service_id').html("");      
                
                for( var i=0; i < data.length; i++)
                {                       
                 $('#service_id').append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");           
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
        var $select = $(".service_used_validity ");
        for (i = 1; i <= 10; i++) {
            $select.append($('<option></option>').val(i).html(i))
        }
    });   

     $("#service_id").change(function () {
         $("#pricediv").show();
         $("#servicetable").show();
         $( "#defaulttable" ).remove();
            generate_estimate();
    });
    
    $("#servicetable").hide();

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
                        console.log(data);   
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

    $('#service_clear_all').click(function () {
       $('#service_id option').prop('selected', false);
        $("#service_id").trigger("change");
    }); 
</script>