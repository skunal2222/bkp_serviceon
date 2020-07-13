<link href="<?php echo asset_url(); ?>css/datepicker3.css" rel="stylesheet">
<div id="page-wrapper" style="padding:0 16px;">
    
               
            <div>
                <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
        <div class="col-lg-12">
            <h3>Mechanic Log</h3>
        </div>
    </div>
                                <form action="" onsubmit="return download_mechanic_log(this)" method="post" autocomplete="off">
                    
                            <div class="row" >
                                <div class="col-md-6">
                                    <div class="form-group" id="error-name">
                                        <label class="control-label">Order From Date<span class='text-'> (Optional)</span></label>
                                    <input type="text" id="from_date" name="from_date" class="form-control" placeholder="Order From Date" value=""/>
                                </div>
                                 </div>   
                                <div class="col-md-6">
                                    <div class="form-group" id="error-name">
                                        <label class="control-label">Order To Date<span class='text-'> (Optional)</span></label>
                                    <input type="text" id="to_date" name="to_date" class="form-control" placeholder="Order To Date" value=""/>
                                </div>
                                    </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-6">
                                    <div class="form-group" id="error-name">
                                        <label class="control-label">Mechanic <span class='text-'> (Optional)</span></label>
                                       <select class="form-control" name="vendor_id">
                                            <option value=""> Select Mechanic</option>
                                            <?php foreach($mechanic as $value) {?>
                                             <option value="<?= $value['id']?>"><?= $value['name']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                 </div>   
                                <div class="col-md-6">
                                    <div class="form-group" id="error-name">
                                        <label class="control-label">Order Status<span class='text-'> </span></label>
                                        <select class="form-control" name="status">
                                            <option value="">All orders</option>
                                            <option value="0">Order Created</option>
                                            <option value="1">Order Assigned</option>
                                            <option value="2">Estimate Generated</option>
                                            <option value="3">Confirmed Estimate</option>
                                            <option value="4">Work Completed</option>
                                            <option value="5"> Cancelled </option>
                                            <option value="6">Invoice Generated</option>
                                            <option value="7" selected> Completed </option>
                                            
                                        </select>
                                      </div>
                                    </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="error-name">
                                        <label class="control-label">Order By<span class='text-'> </span></label>
                                        <select class="form-control" name="order_by">
                                            <option value="ASC">Ascending </option>
                                            <option value="DESC"> Descending </option>
                                        </select>
                                </div>
                                    
                            </div>
                            </div>    
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="submit"  id="Download" class="btn btn-primary" value="Download"/>
                                </div>
                            </div>
                        
                </form>
            </div>
        </div>
    
 </div>
        </div>
<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>
<script>
   // $.fn.datepicker.defaults.format = "dd-mm-yyyy";
$(document).ready(function() {
	/*$('#from_date').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
        });
    $('#to_date').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy',
    });*/

$("#from_date").datepicker({
  format: 'yyyy-mm-dd',
  autoclose: true,
}).on('changeDate', function (selected) {
    var startDate = new Date(selected.date.valueOf());
    $('#to_date').datepicker('setStartDate', startDate);
}).on('clearDate', function (selected) {
    $('#to_date').datepicker('setStartDate', null);
});

$("#to_date").datepicker({
   format: 'yyyy-mm-dd',
   autoclose: true,
}).on('changeDate', function (selected) {
   var endDate = new Date(selected.date.valueOf());
   $('#from_date').datepicker('setEndDate', endDate);
}).on('clearDate', function (selected) {
   $('#from_date').datepicker('setEndDate', null);
});


});
    function download_mechanic_log(ths) {
        console.log($(ths).serialize()); 
        if($('#to_date').val() != '' && $('#from_date').val() != '') {
           

         /*  if($('#to_date').val() < $('#from_date').val()) {
                alert('Order From date should be less than');
                return false;
            }*/ 

        }
        window.open(base_url + 'admin/report/download_mechanic_log?' + $(ths).serialize());
        
        return false;
    }
</script>    