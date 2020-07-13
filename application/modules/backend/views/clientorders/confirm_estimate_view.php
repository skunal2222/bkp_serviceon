<link rel="stylesheet" href="<?php echo asset_url(); ?>css/select2.min.css">
<div id="enquiry_modal" class="modal fade" style="">
    <div id="pickedup-overlay" class="modal-dialog m1 modal-lg" style="opacity:1 ;width:800px;margin-top: 12%; "> 
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" >X</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Order Items</h4>
            </div>
            <div class="modal-body" style="background-color:#f5f5f5;">
                <div class="panel panel-default">
                        <form action="" method="post" name="approvalUpdate" id="approvalUpdate" >
                            <div class="panel-heading">
                                <!--<b>Order Items</b>--> 
                                
                            </div>
                            <div class="panel-body" style="padding:1px;">
                                <div class="row col-sm-12" style="padding:0px 0px;margin-left: 0;">
                                    <div class="col-sm-3" style="background-color:#f5f5f5;padding:5px;padding-left:15px;"><b>Action</b></div>
                                    <div class="col-sm-2" style="background-color:#f5f5f5;padding:5px;"><b>Type</b></div>
                                    <div class="col-sm-3" style="background-color:#f5f5f5;padding:5px;"><b>Name</b></div>
                                    <div class="col-sm-2" style="background-color:#f5f5f5;padding:5px;"><b>Priority</b></div>
                                    <div class="col-sm-2" style="background-color:#f5f5f5;padding:5px;"><b>Total Price</b></div>
                                </div>
                                <input type="hidden" name="order_id" id="orderidhidden" value="<?php echo $order['order_id']; ?>">
                                    <?php foreach ($items as $item) { ?>
                                      <div class="row col-sm-12" style="padding:5px 0px;margin-left: 0;font-weight:400;background-color:#f9f9f9;">
                                        <input type="hidden" name="itemid[]" id="itemidhidden" value="<?php echo $item['service_id']; ?>"> 
                                        <div class="col-sm-3">
                                              <select name="is_checked[]" id="is_checked" class="">
                                                <option value="0" <?php if ($item['is_checked'] == 0) { ?> selected<?php } ?>>Waiting</option>
                                                <option value="1" <?php if ($item['is_checked'] == 1) { ?> selected<?php } ?>>Approved</option>
                                                <option value="2" <?php if ($item['is_checked'] == 2) { ?> selected<?php } ?>>Rejected</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <span style="font-weight:500;"><?= $item['service'] == 1 ? 'Service' : 'Spare'; ?></span>
                                            <br> 
                                        <input type="hidden" name="itemtype[]" value="<?php echo $item['service']; ?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <span style="font-weight:500;"><?php echo $item['service_name']; ?></span>
                                            <br><span style="color:red"><?php if ($item['is_checked'] == 0) { ?>(waiting for approval)<?php } else if ($item['is_checked'] == 1) { ?>(Approved)<?php } else { ?>(Rejected)<?php } ?></span>  
                                        <input type="hidden" name="itemname[]" value="<?php echo $item['service_name']; ?>">
                                        </div>
                                        <div class="col-sm-2">
                                            <span style="font-weight:500;">
                                                <?= $item['priority'] == 1 ? 'High' : ($item['priority'] == 2 ? 'Medium' : 'Low')?>
                                            </span>
                                            <br> 
                                            <input type="hidden" name="priority[]" value="<?php echo $item['priority']; ?>">
                                        </div>
                                        <div class="col-sm-2"><i class="fa fa-rupee"></i> <?php echo $item['price']; ?>
                                            <input type="hidden" name="price[]" value="<?php echo $item['price']; ?>"></div>
                                        <div class="clearfix" style="padding-left:15px;"></div>
                                    </div>
                                    <?php }?>
                                <div class="col-sm-12" style="padding:5px 0px;">
   
                                        <button type="button" class="btn btn-success" onclick="ApprovalUpdate()">Save Items</button>
    
                                </div>
                                <div class="col-sm-12" style="padding:5px 0px;">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-6" style="background-color: #fafafa;border-radius: 5px;padding-bottom:10px;float:right;">
                                        <br>
                                        <table cellpadding="0px" cellspacing="0px" style="width:100%;">
                                            <tr>
                                                <td width="70%"><b>Order Total</b></td>
                                                <td width="30%"><i class="fa fa-rupee"></i> <?php echo $order['amount']; ?></td>
                                            </tr>
                                           <!--  <tr>
                                                <td width="70%"><b>Discount</b></td>
                                                <td width="30%"><i class="fa fa-rupee"></i>  </td>
                                            </tr>  -->

                                            <tr>
                                                <td width="70%"><b>Adjustments</b> &nbsp; </td>
                                                <td width="30%">
                                                    <i class="fa fa-rupee"></i> <?php echo $order['adjustment']; ?> 
                                                </td>
                                            </tr>

                                            <tr>
                                                <td width="70%"><b>Gross Total</b></td>
                                                <td width="30%"><i class="fa fa-rupee"></i> <?php echo ($order['amount']); ?></td>
                                            </tr> 
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo asset_url(); ?>js/jquery.form.js"></script>
<script>
    function ApprovalUpdate() {
                                ajaxindicatorstart("Please hang on.. while we add items ..");
                                var options = {
                                    target: '#response',
                                    beforeSubmit: AshowAddRequest,
                                    success: AshowAddResponse,
                                    url: base_url + 'client/order/confirm_estimate_client',
                                    semantic: true,
                                    dataType: 'json'
                                };
                                $('#approvalUpdate').ajaxSubmit(options);
                            }

                            function AshowAddRequest(formData, jqForm, options) {
                                //ajaxindicatorstop();
                                $("#response").hide();
                                var queryString = $.param(formData);
                                return true;
                            }

                            function AshowAddResponse(resp, statusText, xhr, $form) {
                                ajaxindicatorstop();
                                if (resp.status == '0') {
                                    
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
</script>    