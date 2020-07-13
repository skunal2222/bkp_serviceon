<link href="<?php echo base_url();?>assets/css/datepicker3.css" rel="stylesheet" type="text/css">
<style>
<!--
.btn-plus{
	margin:5px 0px;
}
.panel-body> div[class^="col-sm-"], div[class*=" col-sm-"] {
	padding-bottom:5px;
}
.modal-header {
	background-color:#337ab7;
	color:#fff;
}
.datepicker-dropdown {
	z-index:1050 !important;
}
#customer_name_edit {
	width:200px;
}
#customer_email_edit {
	width:200px;
}
-->

.pqr
{
  width:90%;
  margin-bottom:0;
}
</style>
<div id="page-wrapper" style="padding:5px 16px;">
	<div class="row">
		<div class="col-lg-12" style="padding:0px 5px;">
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	<b>Order History</b>
               	</div>
               	<div class="panel-body">
               	
               	     	<div class="row">
	               		<div class="col-sm-5">
	               			<b>Customer Name</b>
	               		</div>
	               		<div class="col-sm-7">
	               			<span id="customer_name_lbl"><?php echo $order['name'];?> </span>
	               		</div>
	               	</div><br>
	               	<div class="row">
	               		<div class="col-sm-5">
	               			<b>Customer Email</b>
	               		</div>
	               		<div class="col-sm-7">
	               			<span id="customer_email_lbl"><?php echo $order['email'];?> </span>
	               			</div>
	               	</div><br>
	               	<div class="row">
	               		<div class="col-sm-5">
	               			<b>Customer Mobile</b>
	               		</div>
	               		<div class="col-sm-7">
	               			<span id="customer_mobile_lbl"><?php echo $order['mobile'];?> </span>
	               		</div>
	               	</div><br>
	               	
	               		<div class="row">
	               		<div class="col-sm-5">
	               			<b>Order</b>
	               		</div>
	               		<div class="col-sm-7">
	               		<?php foreach($data as $row) {?>
	               			<a href="#deliveryModel" role="button" class="btn" data-toggle="modal">OrderId &nbsp;<?php echo $row['orderid'];?></a>
	               		<?php }?>
	               		</div>
               		</div><br>
               			
				</div>
				
		
			</div>
			</div>
			
			<div id="deliveryModel" class="modal fade" style="">
    <div id="cancel-overlay" class="modal-dialog" style="opacity:1 ;width:400px ">
      	<div class="modal-content">
          	<div class="modal-header">
              	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff"> X </span><span class="sr-only">Close</span></button>
              	<h4 class="modal-title" id="myModalLabel">Order Details</h4>
          	</div>
          	<div class="modal-body" style="background-color:#f5f5f5;">
              	<div class="row" style="padding:10px">
              		<div class="col-md-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Category</label>
                       		<input type="text" name="delivery_date" id="delivery_date" class="form-control" value="<?php echo $order['category'];?>"/>
                       		
                  		</div>
              		</div>
              	</div>
             	<div class="row" style="padding:10px">
              		<div class="col-md-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Brand</label>
                       		<input type="text" name="delivery_date" id="delivery_date" class="form-control" value="<?php echo $order['brand'];?>"/>
                       		
                  		</div>
              		</div>
              	</div>
              		<div class="row" style="padding:10px">
              		<div class="col-md-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Model</label>
                       		<input type="text" name="delivery_date" id="delivery_date" class="form-control" value="<?php echo $order['model'];?>"/>
                       		
                  		</div>
              		</div>
              	</div>
              		<div class="row" style="padding:10px">
              		<div class="col-md-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Service</label>
                       		<input type="text" name="delivery_date" id="delivery_date" class="form-control" value="<?php echo $order['subcategory'];?>"/>
                       		
                  		</div>
              		</div>
              	</div>
              	
           
              
          	</div>
      	</div>
  	</div>
</div>
		

<script src="<?php echo asset_url();?>js/bootstrap-typeahead.min.js"></script>
<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>

<script>
$('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    //startDate: '0d'
});



$('#rspickup_date').datepicker({
    format: 'dd-mm-yyyy',
    //startDate: '0d'
}).on("changeDate", function(e) {
    $.get(base_url+"admin/general/pickupdate",{ pickup_date: $(this).val() },function(data) {
		$("#rspickup_slot").html(data);
    },'html');
});
$('#rsdelivery_date').datepicker({
    format: 'dd-mm-yyyy',
    //startDate: '0d'
}).on("changeDate", function(e) {
    $.get(base_url+"admin/general/pickupdate",{ pickup_date: $(this).val() },function(data) {
		$("#rsdelivery_slot").html(data);
    },'html');
});

function updateSlotsDel() {
	$.get(base_url+"admin/general/pickupdate",{ pickup_date: $("#rsdelivery_date").val() },function(data) {
		$("#rsdelivery_slot").html(data);
    },'html');
}
function updateSlotsPick() {
	$.get(base_url+"admin/general/pickupdate",{ pickup_date: $("#rspickup_date").val() },function(data) {
		$("#rspickup_slot").html(data);
    },'html');
}
function hideNav() {
	var status = $("#side-menu").css("display");
	if(status == 'block') {
		$("#side-menu").hide();
		$("#page-wrapper").css("margin","0 0 0 0");
		$("#show-hide-nav").html('<i class="fa fa-chevron-circle-right fa-2x"></i>');
	} else {
		$("#page-wrapper").css("margin","0 0 0 250px");
		$("#side-menu").show();
		$("#show-hide-nav").html('<i class="fa fa-chevron-circle-left fa-2x"></i>');
	}
}

function assignPickup(orderid) {
	if($("#executive_id").val() != "" && $("#pickup_slot").val() != "") {
		ajaxindicatorstart("Please hang on.. while we assign order ..");
		$.get(base_url+"admin/order/assignpickup/"+orderid,{ executive_id: $("#executive_id").val(), pickup_slot: $("#pickup_slot").val()}, function(data){
			ajaxindicatorstop();
			alert(data.message);
			window.location.reload();
		},'json');
	} else if($("#executive_id").val() == "") {
		alert("Please select pickup executive");
	} else if($("#pickup_slot").val() == "") {
		alert("Please select pickup slot");
	} else {
		alert("Please select all fields");
	}
}

function reassignPickup(orderid) {
	if($("#rpexecutive_id").val() != "" && $("#rpickup_slot").val() != "") {
		ajaxindicatorstart("Please hang on.. while we re-assign order ..");
		$.get(base_url+"admin/order/reassignpickup/"+orderid,{ executive_id: $("#rpexecutive_id").val(), pickup_slot: $("#rpickup_slot").val()}, function(data){
			ajaxindicatorstop();
			alert(data.message);
			window.location.reload();
		},'json');
	} else if($("#rpexecutive_id").val() == "") {
		alert("Please select pickup executive");
	} else if($("#rpickup_slot").val() == "") {
		alert("Please select pickup slot");
	} else {
		alert("Please select all fields");
	}
}

function assignDelivery(orderid) {
	if($("#dexecutive_id").val() != "" && $("#delivery_slot").val() != "" && $("#delivery_date").val()) {
		ajaxindicatorstart("Please hang on.. while we assign order ..");
		$.get(base_url+"admin/order/assigndelivery/"+orderid,{ executive_id: $("#dexecutive_id").val()}, function(data){
			ajaxindicatorstop();
			alert(data.message);
			window.location.reload();
		},'json');
	} else if($("#dexecutive_id").val() == "") {
		alert("Please select delivery executive");
	} else if($("#delivery_slot").val() == "") {
		alert("Please select delivery slot");
	} else if($("#delivery_date").val() == "") {
		alert("Please select delivery date");
	} else {
		alert("Please select all fields");
	}
}

function reassignDelivery(orderid) {
	if($("#rdexecutive_id").val() != "" && $("#rdelivery_slot").val() != "" && $("#rdelivery_date").val()) {
		ajaxindicatorstart("Please hang on.. while we re-assign order ..");
		$.get(base_url+"admin/order/reassigndelivery/"+orderid,{ executive_id: $("#rdexecutive_id").val(), delivery_slot: $("#rdelivery_slot").val(), delivery_date: $("#rdelivery_date").val()}, function(data){
			ajaxindicatorstop();
			alert(data.message);
			window.location.reload();
		},'json');
	} else if($("#rdexecutive_id").val() == "") {
		alert("Please select delivery executive");
	} else if($("#rdelivery_slot").val() == "") {
		alert("Please select delivery slot");
	} else if($("#rdelivery_date").val() == "") {
		alert("Please select delivery date");
	} else {
		alert("Please select all fields");
	}
}

function cancelOrder(orderid) {
	if($("#reason_id").val() != "") {
		var ans = confirm("Are you sure !! you want to cancel this order ?");
		if(ans) { 
			ajaxindicatorstart("Please hang on .. while we cancel this order ..");
			$.get(base_url+"admin/order/cancel/"+orderid,{ comment: $("#cancelcomment").val(), reason_id: $("#reason_id").val() }, function(data){
				ajaxindicatorstop();
				alert(data.message);
				window.location.reload();
			},'json');
		}
	} else {
		alert("Please select reason of cancellation.");
	}
}

function deleteOrder(orderid) {
	if($("#reason_id").val() != "") {
		var ans = confirm("Are you sure !! you want to delete this order ?");
		if(ans) { 
			ajaxindicatorstart("Please hang on .. while we delete this order ..");
			$.get(base_url+"admin/order/delete/"+orderid,{ comment: $("#cancelcomment").val(), reason_id: $("#reason_id").val() }, function(data){
				ajaxindicatorstop();
				alert(data.message);
				window.location.reload();
			},'json');
		}
	} else {
		alert("Please select reason of deletion.");
	}
}

function confirmDelivery(orderid) {
	ajaxindicatorstart("Please hang on.. while we complete order ..");
	$.get(base_url+"admin/order/completed/"+orderid,{ net_total: $("#to_amount").val(), final_total: $("#final_total").val(), pay_mode : $("#cpay_mode").val() }, function(data){
		ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function requestPayment(orderid) {
	ajaxindicatorstart("Please hang on.. while we made payment request ...");
	$.get(base_url+"admin/order/payment_request/"+orderid,{  }, function(data){
		ajaxindicatorstop();
		alert(data.message);
		window.location.reload();
	},'json');
}

function generateInvoice(orderid) {
	//alert("inside invoice");
	ajaxindicatorstart("Please hang on.. while we generate invoice ..");
	$.post(base_url+"admin/order/invoice/generate/"+orderid,{ discount: $("#discount").val(), adjustment: $("#adjustment").val() }, function(data){
		ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function saveItems() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/order/additems',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#additems').ajaxSubmit(options);
}

function showAddRequest(formData, jqForm, options){
	ajaxindicatorstart("Please hang on.. while we add items ..");
	$("#response").hide();
   	var queryString = $.param(formData);
	return true;
}
   	
function showAddResponse(resp, statusText, xhr, $form){
	ajaxindicatorstop();
	if(resp.status == '0') {
		$("#response").removeClass('alert-success');
       	$("#response").addClass('alert-danger');
		$("#response").html(resp.message);
		$("#response").show();
  	} else {
  		$("#response").removeClass('alert-danger');
        $("#response").addClass('alert-success');
        $("#response").html(resp.message);
        $("#response").show();
        alert(resp.message);
        window.location.reload();
	    
  	}
}

function updateItems() {
	var options = {
	 		target : '#uresponse', 
	 		beforeSubmit : ushowAddRequest,
	 		success :  ushowAddResponse,
	 		url : base_url+'admin/order/updateitems',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#updateitems').ajaxSubmit(options);
}

function ushowAddRequest(formData, jqForm, options){
	$("#uresponse").hide();
   	var queryString = $.param(formData);
	return true;
}
   	
function ushowAddResponse(resp, statusText, xhr, $form){
	if(resp.status == '0') {
		$("#uresponse").removeClass('alert-success');
       	$("#uresponse").addClass('alert-danger');
		$("#uresponse").html(resp.message);
		$("#uresponse").show();
  	} else {
  		$("#uresponse").removeClass('alert-danger');
        $("#uresponse").addClass('alert-success');
        $("#uresponse").html(resp.message);
        $("#uresponse").show();
        alert(resp.message);
        window.location.reload();
  	}
}

$("#reason_id").change(function() {
	$("#cancelcomment").val($("#reason_id option:selected").text());
});



	
$("#itemname-1").typeahead({
    onSelect: function(item) {
    	var itemid12 = $('#inputrateid').val();
    	//alert(itemid12);
    	if(itemid12=='')
    	{
    		itemid12=0;
        }
        itemvalue = item.value;
        $.get(base_url+"admin/item/detail/"+itemvalue,{},function(result){
			$("#price-1").val(result.price);
			$("#pricelbl-1").html("Rs. "+result.price);
			$("#itemid-1").val(item.value);
			
        },'json');
    },
    ajax: {
        url: base_url+"admin/item/search",
        timeout: 500,
        displayField: "name",
        triggerLength: 1,
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
<?php foreach ($items as $key=>$item) { ?>
	var itemid = $('#ratecardid').val();
$("#eitemname-<?php echo $key;?>").typeahead({
	
    onSelect: function(item) {
    	var itemid12 = $('#inputrateid').val();
    	//alert(itemid12);
    	if(itemid12=='')
    	{
    		itemid12=0;
        }
        itemvalue = item.value;
        $.get(base_url+"admin/item/detail/"+itemvalue+"/"+itemid12,{},function(result){
			$("#eprice-<?php echo $key;?>").val(result.price);
			$("#epricelbl-<?php echo $key;?>").html("Rs. "+result.price);
			$("#eitemid-<?php echo $key;?>").val(item.value);
			
        },'json');
    },
    ajax: {
		 
         url: base_url+"admin/item/search",
        timeout: 500,
        displayField: "name",
        triggerLength: 1,
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
<?php } ?>
function addMoreItems() {
	var rows = parseInt($("#rcount").val());
	rows = rows + 1;
	var html = '<div class="row" style="padding:10px 5px;background-color:#f2f2f2;border-bottom:1px solid #ccc;" id="rowitem-'+rows+'">'+
  		'<div class="row form-group" style="width:90%;margin-bottom:0;">'+
		'<input type="hidden" name="itemid[]" id="itemid-'+rows+'" value=""/>'+
		'<div class="col-sm-6">'+
			'<input type="text" class="form-control itemname" name="itemname[]" id="itemname-'+rows+'" value="" placeholder="Enter Service Name" autocomplete="off"/>'+
		'</div>'+
		
		'<div class="col-sm-2">'+
			'<input type="hidden" name="price[]" id="price-'+rows+'" value=""/>'+
			'<span id="pricelbl-'+rows+'" style="line-height:30px;"></span>'+
		'</div>'+
		'<div class="col-sm-1"><a href="javascript:removeItem('+rows+');" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a></div>'+
		'</div>'+
		'</div>';
	$("#orderitems").append(html);
	$("#rcount").val(rows);
	var itemid = $('#ratecardid').val();
	$("#itemname-"+rows).typeahead({
		
	    onSelect: function(item) {
	    	var itemid12 = $('#inputrateid').val();
	    	//alert(itemid12);
	    	if(itemid12=='')
	    	{
	    		itemid12=0;
	        }
	        itemvalue = item.value;
	        $.get(base_url+"admin/item/detail/"+itemvalue,{},function(result){
				$("#price-"+rows).val(result.price);
				$("#pricelbl-"+rows).html("Rs. "+result.price);
				$("#itemid-"+rows).val(item.value);
				
	        },'json');
	    },
	    ajax: {
	        url: base_url+"admin/item/search",
	        timeout: 500,
	        displayField: "name",
	        triggerLength: 1,
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
}
function removeItem(count) {
	$("#rowitem-"+count).remove();
}
function eaddMoreItems() {
	
	var rows = parseInt($("#ercount").val());
	rows = rows + 1;
	var html = '<div class="row" style="padding:10px 5px;background-color:#f2f2f2;border-bottom:1px solid #ccc;" id="erowitem-'+rows+'">'+
  		'<div class="row form-group" style="width:90%;margin-bottom:0;">'+
		'<input type="hidden" name="itemid[]" id="eitemid-'+rows+'" value=""/>'+
		'<div class="col-sm-6">'+
			'<input type="text" class="form-control itemname" name="itemname[]" id="eitemname-'+rows+'" value="" placeholder="Enter Service Name" autocomplete="off"/>'+
		'</div>'+
		
		'<div class="col-sm-2">'+
			'<input type="hidden" name="price[]" id="eprice-'+rows+'" value=""/>'+
			'<span id="epricelbl-'+rows+'" style="line-height:30px;"></span>'+
		'</div>'+
		'<div class="col-sm-1"><a href="javascript:eremoveItem('+rows+');" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a></div>'+
		'</div>'+
		'</div>';
	$("#eorderitems").append(html);
	$("#ercount").val(rows);
	var itemid = $('#rateid').val();
	$("#eitemname-"+rows).typeahead({
		
	    onSelect: function(item) {
	    //	var itemid12 = $('#inputrateid1').val();
	    	//alert(itemid);
	    	
	        itemvalue = item.value;
			
	        $.get(base_url+"admin/item/detail/"+itemvalue,{},function(result){
				
				$("#eprice-"+rows).val(result.price);
				$("#epricelbl-"+rows).html("Rs. "+result.price);
				$("#eitemid-"+rows).val(item.value);
				
	        },'json');
	    },
	    ajax: {
			
	        url: base_url+"admin/item/search",
	        timeout: 500,
	        displayField: "name",
	        triggerLength:1,
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
}

function eremoveItem(count) {
	$("#erowitem-"+count).remove();
}

$("#discount").focusout(function() {
	var o_amount = parseInt($("#o_amount").val());
	var discount = parseInt($("#discount").val());
	if(isNaN(discount)) {
		discount = 0;
	}
	var adjustment = parseInt($("#adjustment").val());
	if(isNaN(adjustment)) {
		adjustment = 0;
	}
	var f_amount = o_amount-discount-adjustment;
	$("#grand_total").val(f_amount);
});
$("#adjustment").focusout(function() {
	var o_amount = parseInt($("#o_amount").val());
	var discount = parseInt($("#discount").val());
	var adjustment = parseInt($("#adjustment").val());
	var f_amount = o_amount - discount - adjustment;
	$("#grand_total").val(f_amount);
});

function editPickupDate() {
	$("#pickup_date_lbl").hide();
	$("#pickup_date_input").show();
}

function updatePickupDate(orderid) {
	ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"admin/order/updatepickupdate/"+orderid,{ pickup_date: $("#pickup_date_edit").val() }, function(data){
		ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function editPickupSlot() {
	$("#pickup_slot_lbl").hide();
	$("#pickup_slot_input").show();
}

function updatePickupSlot(orderid) {
	ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"admin/order/updatepickupslot/"+orderid,{ pickup_slot: $("#pickup_slot_edit").val() }, function(data){
		ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function reschedulePickup(orderid) {
	ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"admin/order/reschedulepickup/"+orderid,{ pickup_date: $("#rspickup_date").val(), pickup_slot: $("#rspickup_slot").val(), notes: $("#rsnotes").val() }, function(data){
		ajaxindicatorstop();
		alert(data.msg);
		if(data.status == 1)
		window.location.reload();
	},'json');
}

function editDeliveryDate() {
	$("#delivery_date_lbl").hide();
	$("#delivery_date_input").show();
}

function updateDeliveryDate(orderid) {
	ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"admin/order/updatedeliverydate/"+orderid,{ delivery_date: $("#delivery_date_edit").val() }, function(data){
		ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function editDeliverySlot() {
	$("#delivery_slot_lbl").hide();
	$("#delivery_slot_input").show();
}

function updateDeliverySlot(orderid) {
	ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"admin/order/updatedeliveryslot/"+orderid,{ delivery_slot: $("#delivery_slot_edit").val() }, function(data){
		ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function rescheduleDelivery(orderid) {
	ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"admin/order/rescheduledelivery/"+orderid,{ delivery_date: $("#rsdelivery_date").val(), delivery_slot: $("#rsdelivery_slot").val(), notes: $("#rsdnotes").val() }, function(data){
		ajaxindicatorstop();
		alert(data.msg);
		if(data.status == 1)
		window.location.reload();
	},'json');
}

function editCustomerName() {
	$("#customer_name_lbl").hide();
	$("#customer_name_input").show();
}

function updateCustomerName(orderid) {
	ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"admin/order/updatecustomername/"+orderid,{ name: $("#customer_name_edit").val() }, function(data){
		ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function updateRatecard(orderid) {
	ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"admin/order/updateratecard/"+orderid,{ rate_id: $("#rate_id").val() }, function(data){
		ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}
function editCustomerMobile() {
	$("#customer_mobile_lbl").hide();
	$("#customer_mobile_input").show();
}

function updateCustomerMobile(orderid) {
	ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"admin/order/updatecustomermobile/"+orderid,{ mobile: $("#customer_mobile_edit").val() }, function(data){
		ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}
function editCustomerEmail() {
	$("#customer_email_lbl").hide();
	$("#customer_email_input").show();
}

function updateCustomerEmail(orderid) {
	ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"admin/order/updatecustomeremail/"+orderid,{ email: $("#customer_email_edit").val() }, function(data){
		ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}
function editCustomerAddress() {
	$("#customer_address_lbl").hide();
	$("#customer_address_input").show();
}

function updateCustomerAddress(orderid) {
	ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"admin/order/updatecustomeraddress/"+orderid,{ address: $("#customer_address_edit").val() }, function(data){
	ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function changeStatus(orderid) {
	var status = $("#status_id").val();
	if(status == "") {
		alert("Please select status.");
	} else {
		if(status == 0 || status == 2) {
			ajaxindicatorstart("Please hang on.. while we update ..");
			$.post(base_url+"admin/order/updateorderstatus/"+orderid,{ status: status }, function(data){
				ajaxindicatorstop();
				alert(data.msg);
				window.location.reload();
			},'json');
		} else if(status == 1) {
			$("#pickupModel").modal('show');
		} else if(status == 3) {
			$("#deliveryModel").modal('show');
		} else if(status ==4) {
			$("#confirmModal").modal('show');
		}
	}
}

function updateAdjustment(orderid) {
	if($("#iadjustment").val() > 0) {
		var adj_type = $("input[name='adj_type']:checked"). val();
		$.post(base_url+"admin/order/updateorderadjustment/"+orderid,{ adj_type: adj_type, adjustment: $("#iadjustment").val() }, function(data){
			ajaxindicatorstop();
			alert(data.msg);
			window.location.reload();
		},'json');
	} else {
		alert("Please enter adjustment amount.");
	}
}

function resendPaymentLink(orderid) {
	ajaxindicatorstart("Please hang on.. while we resend payment link ..");
	$.post(base_url+"admin/orders/resendpaymentlink/"+orderid,{ }, function(data){
		ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function deliveryAttempted(orderid) {
	ajaxindicatorstart("Please hang on.. while we send sms ..");
	$.post(base_url+"admin/order/deliveryattemptedsms/"+orderid,{ }, function(data){
		ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function deliveryCallAnswered(orderid) {
	ajaxindicatorstart("Please hang on.. while we send sms ..");
	$.post(base_url+"admin/order/deliverycallanssms/"+orderid,{ }, function(data){
		ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function pickupAttempted(orderid) {
	ajaxindicatorstart("Please hang on.. while we send sms ..");
	$.post(base_url+"admin/order/pickupattemptedsms/"+orderid,{ }, function(data){
		ajaxindicatorstop();
		alert(data.msg);
		$("#reSchedulePickup").modal('show');
	},'json');
}

function openInNewTab(url) {
	  var win = window.open(url, '_blank');
	  win.focus();
	}

</script>