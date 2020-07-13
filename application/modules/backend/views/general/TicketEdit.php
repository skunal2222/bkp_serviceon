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
			<h3>Edit Ticket</h3>
		</div>
	</div>
	<form id="addticket" name="addticket" action="" method="post" enctype="multipart/form-data">
		<div class="tab-content">
		  	<div id="basic" class="tab-pane fade in active">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<input type="hidden" name="ticket[ticketid]" id="ticketid" value="<?php echo $ticket['ticketid'];?>"/>
								<input type="hidden" name="ticket[userid]" id="userid" value="<?php echo $ticket['userid'];?>"/>
								<div class="row">
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-subject">
											<label class="control-label col-sm-5">Ticket Number</label>
											<div class="col-sm-10">
												<?php echo $ticket['ticket_no'];?>
											</div>
										</div>
									</div>
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-subject">
											<label class="control-label col-sm-5">Customer Mobile <span class='text-danger'>*</span></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="ticket[mobile]" id="mobile" value="<?php echo $ticket['mobile'];?>"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-subject">
											<label class="control-label col-sm-5">Customer Email<span class='text-danger'>*</span></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="ticket[email]" id="email" value="<?php echo $ticket['email1'];?>"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-subject">
											<label class="control-label col-sm-5">Customer Name <span class='text-danger'>*</span></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="ticket[name]" id="name" value="<?php echo $ticket['name'];?>"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-name">
											<label class="control-label">Category<span class='text-danger'>*</span></label>
											<div class="col-sm-10">
											<select name="ticket[category_id]" id="category_id" class="form-control">
													<option value=""> Select Category </option>
													<?php foreach ($categories as $category) { ?>
													<option value="<?php echo $category['id'];?>" <?php if($ticket['category_id'] == $category['id']) {?>selected<?php }?>><?php echo $category['name'];?></option>
													<?php } ?>
												</select>
												</div>
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-name">
											<label class="control-label">SubCategory<span class='text-danger'>*</span></label>
											<div class="col-sm-10">
											<select name="ticket[subcategory_id]" id="subcategory_id" class="form-control">
											<option value=""> Select Subcategory</option>											<option value="1" <?php if($ticket['subcategory_id'] == 1) {?>selected<?php }?>>Breakdown</option>											<option value="2" <?php if($ticket['subcategory_id'] == 2) {?>selected<?php }?>>Pick n' Drop</option>											<option value="3" <?php if($ticket['subcategory_id'] == 3) {?>selected<?php }?>>Doorstep</option>		
													<?php /* foreach ($subcategories as $subcategory) : ?>
													<option value="<?php echo $subcategory['id'];?>" <?php if($ticket['subcategory_id'] == $subcategory['id']) {?>selected<?php }?>><?php echo $subcategory['name'];?></option>
													<?php endforeach; */ ?>
														</select>
												</div>
										</div>
										<div class="messageContainer"></div>
									</div>
								
								</div>
								
								<div class="row">
								
										<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-subject">
											<label class="control-label col-sm-5">Order ID </label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="ticket[orderid]" id="orderid" value="<?php if(!empty($ticket['orderid'])){ echo $ticket['orderid'];}?>"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-subject">
											<label class="control-label col-sm-5">Subject <span class='text-danger'>*</span></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="ticket[subject]" id="subject" value="<?php if(!empty($ticket['subject'])) {echo $ticket['subject'];}?>"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
								</div>
								<div class="row">
								
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-description">
											<label class="control-label col-sm-5">Description <span class='text-danger'>*</span></label>
											<div class="col-sm-10">
												<textarea name="ticket[description]" id="description" class="form-control"><?php if(!empty($ticket['description'])) {echo $ticket['description'];}?></textarea>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-priority">
											<label class="control-label col-sm-5">Priority</label>
											<div class="col-sm-10">
												<select name="ticket[priority]" id="priority" class="form-control">
													<option value="0" <?php if($ticket['priority'] == 0) { ?>selected<?php } ?>>Low</option>
													<option value="1" <?php if($ticket['priority'] == 1) { ?>selected<?php } ?>>Normal</option>
													<option value="2" <?php if($ticket['priority'] == 2) { ?>selected<?php } ?>>High</option>
													<option value="3" <?php if($ticket['priority'] == 3) { ?>selected<?php } ?>>Urgent</option>
												</select>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
									
								</div>
							
								<div class="row">
								
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-assigned_to">
											<label class="control-label col-sm-3">Assigned To <span class='text-danger'>*</span></label>
											<div class="col-sm-10">
												<select name="ticket[assigned_to]" id="assigned_to" class="form-control">
													<option value="">Select Executive</option>
													<?php foreach ($acps as $acp) { ?>
													<option value="<?php echo $acp['id'];?>" <?php if($ticket['assigned_to'] == $acp['id']) { ?>selected<?php } ?>><?php echo $acp['first_name'];?> <?php echo $acp['last_name'];?></option>
													<?php } ?>
												</select>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-status">
											<label class="control-label col-sm-5">Status</label>
											<div class="col-sm-10">
													<select name="ticket[status]" id="status" class="form-control">
											<option value=""> Select Status</option>	
													<?php foreach ($status as $row) : ?>
													<option value="<?php echo $row['id'];?>" <?php if($ticket['status_id'] == $row['id']) {?>selected<?php }?>><?php echo $row['name'];?></option>
													<?php endforeach;?>
														</select>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
									
								</div>
								<div class="row">
								<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-status">
											<label class="control-label col-sm-5">Created By</label>
											<div class="col-sm-10">
												<?php if(!empty($ticket['created_by_name'])) { echo $ticket['created_by_name'];} else { echo 'NA';}?>
											</div>
										</div>
									</div>
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-status">
											<label class="control-label col-sm-5">Created Date</label>
											<div class="col-sm-10">
												<?php echo date('j M Y h:i A',strtotime($ticket['created_date']));?>
											</div>
										</div>
									</div>
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-status">
											<label class="control-label col-sm-5">Updated Date</label>
											<div class="col-sm-10">
												<?php echo date('j M Y h:i A',strtotime($ticket['updated_date']));?>
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
		<div id="response"></div>
		<div class="text-center">
		  <button type="submit" class="btn btn-success">Update</button>
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
                    message: 'Subject is required and cannot be empty'
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
	 		url : base_url+'admin/general/ticket/update',
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
			$("#name").val(result.fname);
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
        	$("#name").val(result.fname);
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
	$("#model_id").change(function() 
			{
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

	$("#category_id").change(function() 
			{
		var cat_id =  $('#category_id').val();       
			console.log(cat_id);	    
			  $.post(base_url+"admin/brandbycatid/", {cat_id : cat_id}, function(data)
					  {
				  $('#brand_id').empty();$('#brand_id').append("<option value=''>"+'Select Brand'+"</option>");		    
			   if(data.length > 0)
				   {		    
				     for( var i=0; i < data.length; i++)
					     {		   			    
					           $('#brand_id').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");			
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

	$("#brand_id").change(function() 
			{
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
</script>