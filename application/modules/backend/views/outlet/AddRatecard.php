<style>
    <!--
    .margin-bottom-5{
        margin-bottom: 5px;
    }
    -->
    .select2{
		width : 100% !important;
	}
</style>
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/selectize.bootstrap3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/datepicker3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css">

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3>Add Rate Card</h3>
        </div>
    </div>
    <form id="addratecard" name="addratecard" action="" method="post" >
        <div class="tab-content">
            <div id="basic" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" >
                                Add Rate Card
                            </div>
                            <div class="panel-body"> 
                               
                                <div class="row">  
                                        <div class="col-lg-6 margin-bottom-5">
                                            <div class="form-group" id="error-landmark">
                                                <label class="control-label col-sm-5">City <span class='text-danger'>*</span></label>
                                                <div class="col-sm-12 ">
                                                    <select name="city_id" id="city_id" class="form-control floating">
                                                        <option value=""> Select City</option>
                                                        <?php foreach ($cities as $city) { ?>
                                                            <option value="<?php echo $city['id']; ?>" ><?php echo $city['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="messageContainer  "></div>
                                            </div>
                                        </div> 

                                        <div class="col-lg-6 margin-bottom-5">
                                            <div class="form-group" id="error-mstart_time">
                                                <label class="control-label col-sm-5">Rate Card Name<span class='text-danger'>*</span></label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="rate_card_name" name="rate_card_name" required />
                                                </div>
                                                <div class="messageContainer col-sm-10"></div>
                                            </div>
                                        </div>

                                </div>    

                              <div class="row">
                				<div class="col-lg-12 margin-bottom-5">
                                     <h4>1. Use this file format to upload services
                                      <a href="<?php echo base_url().'client/ratecard/download'; ?>">Download format</a>
                                     </h4> 
                                    <h4>2. Select file <input type="file" name="services" id="services[]"/></h4> 
                                </div> 
                                <div class="col-lg-6 margin-bottom-5 text-center">  
                				    <div id="response"></div>
                					<button type="submit"  class="btn btn-success">Upload</button>
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

$('#addratecard').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {

             city_id: {
                validators: {
                    notEmpty: {
                        message: 'City is required and cannot be empty'
                    }
                }
            },
    	     
            rate_card_name: {
                validators: {
                    notEmpty: {
                        message: 'Rate Card Name is required and cannot be empty'
                    },
                     regexp: {
                        regexp: '^[A-Za-z ]+$',
                        message: 'Only Characters Allowed'
                    }
                }
            },

            services: {
                validators: {
                    notEmpty: {
                        message: 'Services is required and cannot be empty'
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
	addOutlets();
});

 
function addOutlets(){
	ajaxindicatorstart("Please wait.. while Adding..");
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'client/ratecard/add',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#addratecard').ajaxSubmit(options);
}
function showAddRequest(formData, jqForm, options){
	
	$("#response").hide();
   	var queryString = $.param(formData);
	return true;
}
   	
function showAddResponse(resp, statusText, xhr, $form){
    ajaxindicatorstop();
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
        window.location.href = base_url+"client/ratecard/list";
  	}
}
</script>
 