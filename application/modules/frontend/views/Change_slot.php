<link href="<?php echo asset_url(); ?>css/datepicker3.css" rel="stylesheet">
<div class="container">
<div class="col-sm-12 tabcontent login-form" id="Login">
    <div>
        <!-- <form class="profile-login-form" id="frm_address"> -->
            <div class="form-row form-group-padding">
                <div class="form-group col-md-6 col-sm-12">
                    <label for="date">Date</label>
                    <input type="text" class="form-control" name="pickupdate" id="pickupdate" value="<?php echo date('d-M-Y'); ?>">
                    <div class="messageContainer"></div>
                </div>

                <div class="form-group col-md-6 col-sm-12">                                     
                    <label for="time">Time</label>
                    <select class="form-control" name="pickuptime" id="pickuptime">
	                    <?php foreach ($visitingslots as $slot) { ?>
							<option value="<?php echo $slot['time_slot']; ?>"><?php echo $slot['time_slot']; ?></option>  
						<?php } ?>
                    </select>
                    <div class="messageContainer"></div>
                </div>
            </div>
            <div>
            	<span id="response-msg"></span>
            </div>
            <div class="pt-3 update-button">
                <button type="button" class="btn btn-success" id="save">Apply</button>
            </div>
        <!-- </form> -->
    </div>
</div>
</div>
<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
var nowDate = new Date();
var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
$.fn.datepicker.defaults.format = "dd-M-yyyy";
$.fn.datepicker.defaults.startDate = today;

$('#pickupdate').datepicker().on('changeDate', function (e) {
    $('#add_slot').bootstrapValidator('revalidateField', 'pickupdate');
});
$(document).ready(function () {

    var userid = "<?= (isset($_SESSION['olouserid']))?$_SESSION['olouserid']:0; ?>";
	var defaultDate=$("#pickupdate").val();

	$.get(base_url+'delivery_dates',{ date: defaultDate },function(data){
		$("#pickuptime").html(data);
	}); 

    $('#pickupdate').datepicker({
        autoclose: true
    }).on('changeDate', function(e){
        $.get(base_url+'delivery_dates',{date:$(this).val()},function(data){
      		$("#pickuptime").html(data);
    	});
    });

    $(document).on("click", "#save", function() {
    	var slotdate = $("#pickupdate").val();
    	var slottime = $("#pickuptime").val();
        $.get(base_url+'setPickupslot',{slotdate:slotdate,slottime:slottime},function(data){
            $("#setdate").html(slotdate);
            $("#settime").html(slottime);
            $("#order_slotdate").val(slotdate);
            $("#order_slottime").val(slottime);
            $("#md-modalpages").modal('hide');
        });
    });
});
</script>