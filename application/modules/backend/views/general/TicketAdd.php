<style>
<!--
.margin-bottom-5 {
	margin-bottom: 5px;
}
-->
</style>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h3>Add Ticket</h3>
		</div>
	</div>
	<form id="addticket" name="addticket" action="" method="post" enctype="multipart/form-data">
		<ul class="nav nav-tabs">
		  	<li class="active"><a data-toggle="tab" href="#basic">Ticket Add</a></li>
		</ul>
		<div class="tab-content">
		  	<div id="basic" class="tab-pane fade in active">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<input type="hidden" name="ticket[userid]" id="userid" value=""/>
								<div class="row">
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-subject">
											<label class="control-label col-sm-5">Customer Mobile <span class='text-danger'>*</span></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="ticket[mobile]" id="mobile" />
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-subject">
											<label class="control-label col-sm-5">Customer Email<span class='text-danger'>*</span></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="ticket[email]" id="email" autocomplete="off"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-subject">
											<label class="control-label col-sm-5">Customer Name <span class='text-danger'>*</span></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="ticket[name]" id="name" />
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-name">
											<label class="control-label">Category<span class='text-danger'>*</span></label>
											<div class="col-sm-10">
											<select name="ticket[category_id]" id="category_id" class="form-control">
													<option value=""> Select Category </option>
													<?php foreach ($categories as $category) { ?>
													<option value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option>
													<?php } ?>
												</select>
												</div>
										</div>
										<div class="messageContainer"></div>
									</div>
								</div>
								
								
							
							<div class="row">
								
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-name">
											<label class="control-label">SubCategory<span class='text-danger'>*</span></label>
											<div class="col-sm-10">
											<select name="ticket[subcategory_id]" id="subcategory_id" class="form-control">
													<option value="">Select SubCategory </option>
													<option value="1">Breakdown</option>
													<option value="2">Pick n' Drop</option>
													<option value="3">Doorstep</option>														
													<?php /*print_r($subcategories[0]);?>
													<?php foreach ($subcategories[0] as $category) { ?>	
														     <option value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option>		
													<?php } */ ?>
											</select>
												</div>
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-subject">
											<label class="control-label col-sm-5">Order ID </label>
											<div class="col-sm-10">
												<select name="ticket[orderid]" id="orderid" class="form-control">
													<option value=""> Select Order</option>	
												</select>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
								</div>
							
								
								<div class="row">
								 	
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-subject">
											<label class="control-label col-sm-5">Subject <span class='text-danger'>*</span></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="ticket[subject]" id="subject" />
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
										<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-description">
											<label class="control-label col-sm-5">Comment<span class='text-danger'>*</span></label>
											<div class="col-sm-10">
												<textarea name="ticket[description]" id="description" class="form-control"></textarea>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
								</div>
								<div class="row">
								
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-priority">
											<label class="control-label col-sm-5">Priority</label>
											<div class="col-sm-10">
												<select name="ticket[priority]" id="priority" class="form-control">
													<option value="0">Low</option>
													<option value="1">Normal</option>
													<option value="2">High</option>
													<option value="3">Urgent</option>
												</select>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
										<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-assigned_to">
											<label class="control-label col-sm-5">Assigned To <span class='text-danger'>*</span></label>
											<div class="col-sm-10">
												<select name="ticket[assigned_to]" id="assigned_to" class="form-control">
													<option value="">Select Executive</option>
													<?php foreach ($Emps as $acp) { ?>
													<option value="<?php echo $acp['id'];?>"><?php echo $acp['name'];?></option>
													<?php } ?>
												</select>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>	
								</div>
								
								
								<div class="row">
							
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-status">
											<label class="control-label col-sm-5">Status</label>
											<div class="col-sm-10">
													<select name="ticket[status]" id="status" class="form-control">
													<option value=""> Select status</option>
													<?php foreach ($status as $row) { ?>
													<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
													<?php } ?>
														</select>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="response"></div>
		<div class="text-center">
			<button type="submit" class="btn btn-success">Submit</button>
		</div>
		<br> <br>
	</form>
</div>
<script src="<?php echo asset_url();?>js/bootstrap-typeahead.min.js"></script>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script>
$('#addticket').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('div.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
    	'ticket[name]': {
            validators: {
                notEmpty: {
                    message: 'Customer Name is required and cannot be empty'
                }
            }
        },
        'ticket[mobile]': {
            validators: {
                notEmpty: {
                    message: 'Customer Mobile is required and cannot be empty'
                },
                regexp: {
                    regexp: '^[7-9][0-9]{9}$',
                    message: 'Invalid Mobile Number'
                }
            }
        },
        'ticket[email]': {
            validators: {
                notEmpty: {
                    message: 'Customer Email is required and cannot be empty'
                },
                regexp: {
                    regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                    message: 'The value is not a valid email address'
                }
            }
        },
        'ticket[subject]': {
            validators: {
            	notEmpty: {
                    message: 'subject is required and cannot be empty'
                }
            }
        },
        'ticket[description]': {
            validators: {
            	notEmpty: {
                    message: 'Description is required and cannot be empty'
                }
            }
        },
        'ticket[assigned_to]': {
            validators: {
            	notEmpty: {
                    message: 'Assigned To is required and cannot be empty'
                }
            }
        },
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	addTicket();
});

function addTicket() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/general/ticket/add',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#addticket').ajaxSubmit(options);
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
		$("#response").html(resp.msg);
		$("#response").show();
  	} else {
  		$("#response").removeClass('alert-danger');
        $("#response").addClass('alert-success');
        $("#response").html(resp.msg);
        $("#response").show();
        alert(resp.msg);
        window.location.href = base_url+"admin/general/tickets";
  	}
}

$("#mobile").typeahead({
    onSelect: function(item) {
        itemvalue = item.value;
        $.get(base_url+"admin/user/detail/"+item.value,{},function(result){
        	$("#email").val(result.email);
			$("#name").val(result.name);
			$("#userid").val(result.id);
			$('#addticket').bootstrapValidator('revalidateField', 'ticket[name]');
			$('#addticket').bootstrapValidator('revalidateField', 'ticket[mobile]');
        },'json');
    },
    ajax: {
        url: base_url+"admin/user/bymobile",
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
    onSelect: function(item) {
        itemvalue = item.value;
        $.get(base_url+"admin/user/detail/"+item.value,{},function(result){
        	$("#email").val(result.email);
			$("#mobile").val(result.mobile);
			$("#userid").val(result.id);
			$('#addticket').bootstrapValidator('revalidateField', 'ticket[email]');
			$('#addticket').bootstrapValidator('revalidateField', 'ticket[mobile]');
        },'json');
    },
    ajax: {
        url: base_url+"admin/user/byname",
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

$("#email").typeahead({
    onSelect: function(item) {
        itemvalue = item.value;
        $.get(base_url+"admin/user/detail/"+item.value,{},function(result){
        	$("#name").val(result.name);
			$("#mobile").val(result.mobile);
			$("#userid").val(result.id);
			$('#addticket').bootstrapValidator('revalidateField', 'ticket[name]');
			$('#addticket').bootstrapValidator('revalidateField', 'ticket[mobile]');
        },'json');

  	 
    },
    ajax: {
        url: base_url+"admin/user/byemail",
        timeout: 500,
        displayField: "email",
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

</script>
<script>
$(document).ready(function(){    
	

	$("#category_id").change(function() 
			{
		var cat_id =  $('#category_id').val();       
			console.log(cat_id);	    
			  $.post(base_url+"admin/general/subcbycatid/", {cat_id : cat_id}, function(data)
				{
				  $('#subcategory_id').empty();$('#subcategory_id').append("<option value=''>"+'Select Subcategory'+"</option>");		    
			   if(data.length > 0)
				    {		    
				     for( var i=0; i < data.length; i++)
					     {		   			    
					           $('#subcategory_id').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");			
					     }	    
			        }	   
	               },'json'); 

				var userid =  $('#userid').val();       
				console.log(userid);  
			  $.post(base_url+"admin/details/", {userid : userid}, function(data)
					  {
				  
				  $('#orderid').empty();$('#orderid').append("<option value=''>"+'Select Order'+"</option>");		    
			   if(data.length > 0)
				   {		  
				     for( var i=0; i < data.length; i++)
					     {		   			    
					           $('#orderid').append("<option value='"+data[i].orderid+"'>"+data[i].orderid+"</option>");			
					            }	    
			              }	   
		           },'json'); 
              
               });
});
</script>
