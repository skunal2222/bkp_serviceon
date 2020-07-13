<link type="text/css" rel="stylesheet" href="<?php echo asset_url();?>css/selectize.bootstrap3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url();?>css/datepicker3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap-timepicker.min.css">
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Manufacture Edit</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Manufacture Edit</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<?php //print_r($details[0]['name']);?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                          <!--  <div class="panel-heading"> Add Manufacture</div>-->
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <form id="editmanufacture" name="editmanufacture" action="" method="post" >
									<input type="hidden" name="mid" value="<?php echo $details[0]['manufacturer_id'];?>"/>
                                        <div class="form-body">
                                          <!--  <h3 class="box-title">About Manufacture</h3>-->
                                            <hr>	
                                            <div class="row">
                                                <div class="col-md-6 margin-bottom-5">
                                                    <div class="form-group" id="error-name">
                                                        <label class="control-label">Manufacture Name</label>
														<div class="col-sm-10">
															<input type="text" id="mname" name="mname" value="<?php echo $details[0]['name'];?>" class="form-control" placeholder="Please Enter Name"> 
														</div>
														<div class="messageContainer col-sm-10"></div>
													</div>	
                                                </div>
                                                <div class="col-md-6 margin-bottom-5">
                                                    <div class="form-group" id="error-sortorder">
                                                        <label class="control-label">Sort Order</label>
														<div class="col-sm-10">
														<select class="form-control" data-placeholder="Choose a Category" id="sort_order" name="sort_order" tabindex="1">
                                                            <option value="1" <?php if(isset($details[0]['sort_order']) && $details[0]['sort_order'] == 1) {?>selected<?php }?>>1</option>
                                                            <option value="2" <?php if(isset($details[0]['sort_order']) && $details[0]['sort_order'] == 2) {?>selected<?php }?>>2</option>
                                                            <option value="3" <?php if(isset($details[0]['sort_order']) && $details[0]['sort_order'] == 3) {?>selected<?php }?>>3</option>
                                                            <option value="4" <?php if(isset($details[0]['sort_order']) && $details[0]['sort_order'] == 4) {?>selected<?php }?>>4</option>
                                                        </select>
														</div>
														<div class="messageContainer col-sm-10"></div>
                                                    </div>
                                                </div>
											</div>
                                            <div class="row">
                                                <div class="col-md-6 margin-bottom-5">
                                                    <div class="form-group" id="error-sortorder">
                                                        <label>Manufacture Image</label>
														<div class="col-sm-10">
															<input type="file" id="image" name="image" value="<?php echo $details[0]['image'];?>" class="upload"> 
														</div>
														<div class="messageContainer col-sm-10"></div>
													</div>
												<span>
													<img src="<?php echo asset_url();?><?php echo $details[0]['image'];?>" width=180px height=100px style="margin-top:10px;" />
												</span>
                                                </div>
												
                                                <!--<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Discount</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="ti-cut"></i></div>
                                                            <input type="text" class="form-control" id="exampleInputuname" placeholder="36%"> </div>
                                                    </div>
                                                </div>-->
                                            </div>   
										</div>
                                        <div class="form-actions m-t-40 text-center">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                            <button type="button" class="btn btn-default">Cancel</button>
                                        </div>
                                    </form>
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
$('#editmanufacture').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
        mname: {
            validators: {
                notEmpty: {
                    message: 'Manufacture Name is required and cannot be empty'
                }
            }
        },
        sort_order: {
            validators: {
                notEmpty: {
                    message: 'Sort Order is required and cannot be empty'
                }
            }
        },
       /* image: {
            validators: {
                notEmpty: {
                    message: 'Image is required and cannot be empty'
                },
                file: {
                    extension: 'jpeg,jpg,png,gif',
                    type: 'image/jpeg,image/png,image/gif,image/jpg',
                    maxSize: 2097152,   // 2048 * 1024
                    message: 'The selected file is not valid'
                }
            }
        },*/
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	updateManufacture();
});

function updateManufacture() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showEditRequest,
	 		success :  showEditResponse,
	 		url : base_url+'admin/manufacture/update',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#editmanufacture').ajaxSubmit(options);
}

function showEditRequest(formData, jqForm, options){
	$("#response").hide();
   	var queryString = $.param(formData);
	return true;
}
   	
function showEditResponse(resp, statusText, xhr, $form){
	if(resp.status == '0') {
		$("#response").removeClass('alert-success');
       	$("#response").addClass('alert-danger');
		$("#response").html(resp.msg);
		$("#response").show();
  	} else {
  		$("#response").removeClass('alert-danger');
        $("#response").addClass('alert-success');
        $("#response").html(resp.msg);
        $("#response").show();
        alert(resp.msg);
		location.reload();
  	}
}

</script>