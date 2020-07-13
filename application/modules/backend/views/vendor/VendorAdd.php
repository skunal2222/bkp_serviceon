<style>

.margin-bottom-5{
	margin-bottom: 5px;
}

#map-canvas {

	width: 100%;
	height: 350px;

}

.service-txt{
	height: 34px;
	padding: 6px 12px;
	font-size: 14px;
	line-height: 1.42857143;
	color: #555;
	background-color: #fff;
	background-image: none;
	border: 1px solid #ccc;
	border-radius: 4px;
}

.panel-group .panel+.panel {
	margin-top: 6px !important ; 
}

</style>
<?php
/* if($_SESSION['vendor_id']!='')
{
//echo '<script>window.location =  "' . base_url () . 'admin/vendor/new" ; </script>';
echo '<script>  window.onload = function () { xyz();}</script>';

} */
?>
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/selectize.bootstrap3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/datepicker3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css">
<!--  <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<link href="<?php echo asset_url(); ?>css/jquery.multiselect.css" rel="stylesheet" />
<script src="<?php echo asset_url(); ?>js/jquery.multiselect.js"></script>
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="<?php echo asset_url(); ?>js/jquery.almightree.js"></script>
<link rel="stylesheet" href="<?php echo asset_url(); ?>css/almightree.css">
<style>
.select2{
	width : 100% !important;
}

</style>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<div class="row" style="padding-left: 259px;padding-right: 35px;">
	<div class="col-lg-12">
		<h3 class="page-header">Add Vendor</h3>
		<div class="panel panel-info">
			<div class="panel-wrapper collapse in" aria-expanded="true">
				<div class="panel-body">
					<div class="form-body">
						<ul class="nav customtab nav-tabs" role="tablist">
							<li role="presentation" class="nav-item" title="Basic details">
								<a href="#basic" id="Basic_li" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Basic Details</span></a>
							</li>
							<li role="presentation" class="nav-item disabled" title="Please fill basic details">
								<a href="#meta_info" id="Service_li" class="nav-link disabled" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span><span class="hidden-xs">Services</span></a>
							</li>
							<li role="presentation" class="nav-item disabled" title="Please fill basic details">
								<a href="#spare_info" id="Spare_li" class="nav-link disabled" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span><span class="hidden-xs">Spares</span></a>
							</li>
							<li role="presentation" class="nav-item disabled" title="Please fill basic details">
								<a href="#Zone" id="Zone_li" class="nav-link disabled" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span><span class="hidden-xs">Zone</span></a>
							</li>
							<li role="presentation" class="nav-item disabled" title="Please fill basic details">
								<a href="#Billing" id="Billing_li" class="nav-link disabled" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span><span class="hidden-xs">Billing</span></a>
							</li>

						</ul>
						<div class="tab-content">
							<div id="basic" class="tab-pane fade in active">
								<form id="addrestaurant" name="addrestaurant" action="" method="post">
									<div class="row">
										<div class="col-lg-12">
											<div class="panel panel-default">
												<div class="panel-body">
													<div class="row">
														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-name">
																<label class="control-label col-sm-5">Garage Name <span class='text-danger'>*</span></label>
																<div class="col-sm-10">
																	<input type="text" autocomplete="off" class="form-control" id="garage_name" name="garage_name"/>
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>
														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-name">
																<label class="control-label col-sm-5">Owner Name <span class='text-danger'>*</span></label>
																<div class="col-sm-10">
																	<input type="text" class="form-control" id="name" name="name"/>
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-landmark">
																<label class="control-label col-sm-5">Email <span class='text-danger'></span></label>
																<div class="col-sm-10">
																	<input type="text" class="form-control" id="email" name="email" autocomplete="off"/>
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>
														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-landline_1">
																<label class="control-label col-sm-5">Mobile Number <span class='text-danger'>*</span></label>
																<div class="col-sm-10">
																	<input type="text" autocomplete="off" class="form-control" id="mobile" name="mobile"/>
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>  
													</div> 
													<div class="row">
														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-landline_2">
																<label class="control-label col-sm-5">Alternate Number</label>
																<div class="col-sm-10">
																	<input type="text" autocomplete="off" class="form-control" id="landline" name="landline"/>
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>
														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-address">
																<label class="control-label col-sm-5">Address <span class='text-danger'>*</span></label>
																<div class="col-sm-10">
																	<textarea class="form-control" autocomplete="off" rows="3" id="address" name="address"></textarea>
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="form-group" id="error-category_id">
																<label class="control-label col-sm-5">Category<span class='text-danger'>*</span></label>
																<div class="col-sm-10"> 
																	<select name="category_id" id="category_id" class="form-control"  >
																		<option value=""> Select Category </option>
																		<?php foreach ($categories as $category) { ?>
																			<option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
																		<?php } ?>
																	</select>
																</div><div class="messageContainer col-sm-6"></div>

															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group" id="error-serviceType">
																<label class="control-label col-sm-5">Service Type<span class='text-danger'>*</span></label>
																<div class="col-sm-12">
																	<select name="serviceType[]" id="serviceType" class="form-control" multiple="true">
																	<?php
																	foreach ($subcategories as $st) { ?>
																	    <option value="<?php echo $st['id'];?>">
																		<?php echo $st['name'];?>
																		</option>	
																	<?php } ?>
																		<div class="messageContainer"></div>
																	</select>
																</div>
																<div class="messageContainer col-sm-10" id="error_serviceType" style="color:#a94442;"></div>
															</div> 
														</div>
														<div class="col-md-6">
															<div class="form-group" id="error-brand_id">
																<label class="control-label col-sm-5">Brand<span class='text-danger'>*</span></label>
																<div class="col-sm-12">
																	<select name="brand_id[]" id="brand_id" class="form-control" multiple="true"    >
																		<div class="messageContainer"></div>
																		<input type="button" id="select_all2" class="btn btn-success" name="select_all2" value="Select All">
																		<input type="button" class="btn btn-success" id="brand_clear_all" name="brand_clear_all" value="Clear All">
																	</select>
																</div>
																<div class="messageContainer col-sm-10" id="error_brand" style="color:#a94442;"></div>
															</div> 
														</div> 
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group" id="error-model_id">
																<label class="control-label col-sm-5">Model<span class='text-danger'>*</span></label>
																<div class="col-sm-12">
																	<select name="model_id[]" id="model_id" class="form-control" multiple="true"  >
																		<div class="messageContainer"></div> 
																		<input type="button" id="select_all" class="btn btn-success" name="select_all" value="Select All" >
																		<input type="button" class="btn btn-success" id="model_clear_all" name="model_clear_all" value="Clear All">
																	</select>
																</div>
																<div class="messageContainer col-sm-10" id="error_model" style="color:#a94442;"></div>
															</div>
														</div>
<!-- <div class="col-md-6">
<div class="form-group" id="error-name">
<label class="control-label">Subcategory<span class='text-danger'>*</span></label>
<div class="col-sm-10">
<select name="subcategory_id" id="subcategory_id" class="form-control">
<option value=""> Select Subcategory</option>													<?php /* print_r($subcategories[0]);?>
<?php foreach ($subcategories[0] as $category) { ?>													     <option value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option>													<?php } */ ?>
</select>
</div>
</div>
<div class="messageContainer"></div>
</div>-->

</div>

<div class="row"> 
	<div class="col-lg-6 margin-bottom-5">
		<div class="form-group" id="error-pincode">
			<label class="control-label col-sm-5">Pincode</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" autocomplete="off" id="pincode" name="pincode"/>
			</div>
			<div class="messageContainer col-sm-10"></div>
		</div>
	</div>
	<div class="col-lg-6 margin-bottom-5">
		<div class="form-group" id="error-pincode">
			<label class="control-label col-sm-5">Description</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" autocomplete="off" maxlength="35" id="description" name="description"/>
			</div>
			<div class="messageContainer col-sm-10"></div>
		</div>
	</div>
</div>
<div class="row"> 
	<div class="col-lg-6 margin-bottom-5">
		<div class="form-group" id="error-pincode">
			<label class="control-label col-sm-5">Rating</label>
			<div class="col-sm-10">
				<select name="rating" id="rating" class="form-control">
					<option value=""> Select rating</option>
					<?php foreach ($grades as $grade) { ?>
						<option value="<?php echo $grade['id']; ?>"><?php echo $grade['name']; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="messageContainer col-sm-10"></div>
		</div>
	</div>
	<div class="col-lg-6 margin-bottom-5">
		<div class="form-group" id="error-pincode">
			<label class="control-label col-sm-5">Status</label>
			<div class="col-sm-10">
				<select name="status" id="status" class="form-control">
					<option value="">Select</option>
					<option value="1">Enable</option>
					<option value="2">Disable</option>
				</select>
			</div>
			<div class="messageContainer col-sm-10"></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-6 margin-bottom-5">
		<div class="form-group" id="error-pincode">
			<label class="control-label col-sm-5">Profile photo</label>
			<div class="col-sm-10">
				<input type="file" name="image" accept="image/*">
			</div>
			<div class="messageContainer col-sm-10"></div>
		</div>
	</div>
	<!-- <div class="col-lg-6 margin-bottom-5">
		<div class="form-group" id="error-address">
			<label class="control-label col-sm-5">Review <span class='text-danger'>*</span></label>
			<div class="col-sm-10">
				<textarea class="form-control" rows="3" id="review" name="review"></textarea>
			</div>
			<div class="messageContainer col-sm-10"></div>
		</div>
	</div> -->
</div>

<div class="row"><input type="hidden" id="vendor_id" name="id">
	<div class="col-lg-12 margin-bottom-5 text-center">
		<div id="response1"></div>
		<button type="submit" id="save_btn" class="btn btn-success">Save</button>
<!-- <button class="btn btn-success" type="button" onclick="toggale_div('#Service_li')">Next</button>
	<?php //} ?> -->
</div>
</div>
</div>
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
</div>         

<script src="<?php echo asset_url(); ?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo asset_url(); ?>js/selectize.min.js"></script>
<script src="<?php echo asset_url(); ?>js/jquery.form.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>-->

<!-- <script src="<?php echo asset_url(); ?>js/select2.multicheckboxes.js"></script> -->

<script>
/* $('#trial_start_date').datepicker().on('changeDate', function(ev){
$('#addrestaurant').bootstrapValidator('revalidateField', 'trial_start_date');
});
$('#trial_end_date').datepicker().on('changeDate', function(ev){
$('#addrestaurant').bootstrapValidator('revalidateField', 'trial_end_date');
});  */

/*cuisine.on('change', function() {
$('#addrestaurant').bootstrapValidator('revalidateField', 'cuisines[]');
});
*/

$("#is_trial").change(function () {
	if ($(this).val() == 1) {
		$("#trial_dates").show();
		$('#addrestaurant').bootstrapValidator('enableFieldValidators', 'trial_start_date', true);
		$('#addrestaurant').bootstrapValidator('enableFieldValidators', 'trial_end_date', true);
	} else {
		$("#trial_dates").hide();
		$('#addrestaurant').bootstrapValidator('enableFieldValidators', 'trial_start_date', false);
		$('#addrestaurant').bootstrapValidator('enableFieldValidators', 'trial_end_date', false);
	}
});


$('#addrestaurant').bootstrapValidator({
	container: function ($field, validator) {
		return $field.parent().next('.messageContainer');
	},

	feedbackIcons: {
		validating: 'glyphicon glyphicon-refresh'
	},
	fields: {
		email: {
			validators: {
/*notEmpty: {
message: 'Email is required and cannot be empty'
},*/
regexp: {
	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
	message: 'The value is not a valid email address'
}
}
},
mobile: {
	validators: {
		notEmpty: {
			message: 'Mobile is required and cannot be empty'
		},
		regexp: {
			regexp: '^[7-9][0-9]{9}$',
			message: 'Invalid Mobile Number'
		}
	}
},
landline: {
	validators: {
/*notEmpty: {
message: 'Mobile is required and cannot be empty'
},*/
regexp: {
	regexp: '^[7-9][0-9]{9}$',
	message: 'Invalid Mobile Number'
}
}
},
name: {
	validators: {
		notEmpty: {
			message: 'Vendor Name is required and cannot be empty'
		}
	}
},
garage_name: {
	validators: {
		notEmpty: {
			message: 'Garage Name is required and cannot be empty'
		}
	}
},
address: {
	validators: {
		notEmpty: {
			message: 'Address is required and cannot be empty'
		}
	}
},

pincode: {
	validators: {
		integer: {
			message: 'Invalid pincode.'
		},
		stringLength: {
			max: 6,
			min: 6,
			message: 'Invalid pincode.'
		},
	}
},
category_id: {
	validators: {
		notEmpty: {
			message: 'Category is required and cannot be empty'
		}
	}
},
'serviceType[]': {
	validators: {
		notEmpty: {
			message: 'Service type is required and cannot be empty'
		}
	}
},
'brand_id[]': {
	validators: {
		notEmpty: {
			message: 'Brand is required and cannot be empty'
		}
	}
},
/*image : {
validators: {
notEmpty: {
message: 'Profile photo is required and cannot be empty'
}
}
},*/
'model_id[]': {
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
addRestaurant();
});


$("#brand_id").change(function () {
	var brand = $('#brand_id').val();
	if (brand != null) {
//debugger;
$("#save_btn").removeAttr('disabled');
$("#next_btn").removeAttr('disabled');
$('#error_brand').html('');
}
});

$("#model_id").change(function () {
	var brand = $('#brand_id').val();
	if (brand != null) {
// debugger;
$("#save_btn").removeAttr('disabled');
$("#next_btn").removeAttr('disabled');
$('#error_model').html('');
}
});


function addRestaurant() {

	if (($('#brand_id').val()) == null) {
		$('#error_brand').html('Brand is required and cannot be empty');
		$("#save_btn").attr('disabled', true);
		$("#next_btn").attr('disabled', true);
	}

	if (($('#model_id').val()) == null) {
		$('#error_model').html('Model is required and cannot be empty');
		$("#save_btn").attr('disabled', true);
		$("#next_btn").attr('disabled', true);
	}


/* 	var vendor_id = document.getElementById("vendor_id").value;
if(vendor_id)
{
var options = {
target : '#response', 
beforeSubmit : showAddRequest,
success :  showAddResponse,
url : base_url+'admin/vendor/updatebasic',
semantic : true,
dataType : 'json'
};
$('#addrestaurant').ajaxSubmit(options);

} else { */

	var brand = $('#brand_id').val();
	var model = $('#model_id').val();

	var options = {
		target: '#response',
		beforeSubmit: showAddRequest,
		success: showAddResponse,
		url: base_url + 'admin/vendor/add',
		semantic: true,
		dataType: 'json'
	};
	$('#addrestaurant').ajaxSubmit(options);
}
//}


function showAddRequest(formData, jqForm, options) {
	$("#response").hide();
	var queryString = $.param(formData);
	return true;
}

function showAddResponse(resp, statusText, xhr, $form) {
	$('button').removeAttr('disabled');
	if (resp.status == '0') {
		alert(resp.msg);

		$("#response1").removeClass('alert-success');
		$("#response1").addClass('alert-danger');
		$("#response1").html(resp.msg.name);
		$("#response1").show();
// window.location.href = base_url+"admin/vendor/list";
} else {
	alert(resp.msg);

	$("#vendor_id").val(resp.id);
	$("#response1").removeClass('alert-danger');
	$("#response1").addClass('alert-success');
	$("#response1").html(resp.msg);
	$("#response1").show();
	$("#id").val(resp.id);
	window.location.href = base_url+"admin/vendor/edit/"+resp.id;
	// $("#Service_li").trigger("click");
	}
}
</script>
<script type="text/javascript">

	$(document).ready(function () {
//Chosen
$("#serviceType").select2({
	maxItems: 3
})

$("#brand_id").select2({
	maxItems: 3
})

$("#model_id").select2({
	maxItems: 3
})


});


$(document).ready(function () {

/*$.post(base_url + "admin/getservicetype/", {}, function (data)
{
	if (data.length > 0)
	{
		for (var i = 0; i < data.length; i++)
		{
			$('#ser').append("<option data-targetname=" + data[i].name + " value='" + data[i].id + "'>" + data[i].name + "</option>");
		}
	}
}, 'json');*/

$("#category_id").change(function () {
	var cat_id = $('#category_id').val();
	console.log(cat_id);
	$.post(base_url + "admin/brandbycatid/", {cat_id: cat_id}, function (data)
	{
		if (data.length > 0)
		{
			for (var i = 0; i < data.length; i++)
			{
				$('#brand_id').append("<option data-targetname=" + data[i].name + " value='" + data[i].id + "'>" + data[i].name + "</option>");
			}
		}
	}, 'json');
});

$("#brand_id").change(function () {
	var brand_id = $('#brand_id').val();

	$.post(base_url + "admin/modelbybrandid1/", {brand_id: brand_id}, function (data) {
		$('#model_id').empty();
		if (data.length > 0) {
			$('#model_id').html("");
			for (var i = 0; i < data.length; i++)
			{
//  $('#model_id').append("<optgroup label="+data[i].brand_name+">");      			    
$('#model_id').append("<option value='" + data[i].id + "'>" + data[i].name + "(" + data[i].brand_name + ")</option>");
// $('#model_id').append("</optgroup>");
}
$("#model_id").select2({
	maxItems: 3
})
}
}, 'json');
});
});

</script>
<script>
	$(function () {
		$("#treecheck").almightree({search: "#box"});
	});
</script>

<script>
/**
* Comment
*/
function toggale_div(div) {
	$(div).trigger('click');
}
$("#category_id1").change(function () {
	jQuery.noConflict();
	alert("Mouse down event");
	var cat_id = $('#category_id').val();
	var html = "";
//ajaxindicatorstart("Loading...");
$.post(base_url + "admin/brandbycatid/", {cat_id: cat_id}, function (data)
{
	$('#brand_id').empty();
	$('#brand_id').append("<option value=''>" + 'Select Brand' + "</option>");
	if (data.length > 0)
	{
		for (var i = 0; i < data.length; i++)
		{
// $('#brand_id').append("<option data-targetname="+data[i].name+" value='"+data[i].id+"'>"+data[i].name+"</option>");			
html = html + "<option value='" + data[i].id + "'>" + data[i].name + "</option>";

}
}
$("#brand_id").multiselect({
	selectAll: true
});
$("#brand_id").html(html);
}, 'json');

});

</script>

<script>

	$('#select_all').click(function () {
		$('#model_id option').prop('selected', true);
		$("#model_id").trigger("change");
	});

	$('#select_all2').click(function () {
		$('#brand_id option').prop('selected', true);
		$("#brand_id").trigger("change");
	});

	$('#brand_clear_all').click(function () {
		$('#brand_id option').prop('selected', false);
		$("#brand_id").trigger("change");
	}); 

	$('#model_clear_all').click(function () {
		$('#model_id option').prop('selected', false);
		$("#model_id").trigger("change");
	}); 
</script>