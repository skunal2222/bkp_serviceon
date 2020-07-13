<!-- Ongoing Order Section -->
<style type="text/css">
a:hover{
  text-decoration: none!important;
}

.estimate-order-details .section-padding{
  padding-top: 8rem;
}

.ongoing-order-tabs{
  padding-top: 1.5rem;
  margin-bottom: 2.5rem;
}

.estimate-details-table{
  margin-top: 1.5rem;
}

.estimate-details-table td{
  text-align: left;
    padding: 5px 0 10px 5rem;
}

.estimate-details-table th{
  width: 50rem;
}

.confirm-estimate-table{
    table-layout: fixed ;
  width: 100% ;
  margin-top: 1.5rem;
}

.confirm-estimate-table td {
  width: 16.66% ;
  text-align: center;
}

.confirm-estimate-table .status-col{
  padding: 10px 0 10px 0px;
}

.confirm-estimate-table .status-col button{
  margin: 0 2px;
  font-size: 11.5px;
}

.confirm-estimate-table th{
  text-align: center;
}
</style>
<section id="profile-login">
    <div class="d-flex align-items-center profile-title-img">
        <img src="<?php echo asset_url();?>frontend/images/profile-img.png" class="profile-img pr-2">
        <span class="profile-title">Profile</span>
    </div>
    <div class="all-user-history">
        <div class="row profile-section-row">
            <?php echo $sidebar_url; ?>
            <div class="col-lg-10 col-md-10 col-sm-12 card tabcontent ongoing-order-section bs-example" id="Ongoing">
                <div class="row d-flex ongoing-order-track accordion" id="accordionExample">
                    <?php // echo "<pre>"; print_r($orders);die();
                        $no = 0;
                        foreach ($orders as $order) {
                            if ($order['delivery_rider_response'] != 7 && $order['status'] != 5) {
                    ?>
                    <div class="col-lg-10 col-md-10 col-sm-12 d-flex justify-content-center">
                        <div class="jumbotron ">
                            <div>
                                <div id="headingsix">
                                    <div class="users-orders-details" data-toggle="collapse" data-target="#collapse-<?= $no; ?>">
                                        <div class="row d-flex align-items-center justify-content-between">
                                            <h3 class="order-history-no"><?= $order['ordercode']; ?></h3>
                                            <h4 class="bike-model"><?= $order['brand']." ".$order['model']; ?></h4>
                                        </div>
                                    </div>                                  
                                </div>

                                <div id="collapse-<?= $no; ?>" class="collapse <?= ($no == 0)?"show":"" ?>" aria-labelledby="headingsix" data-parent="#accordionExample">
                                    <div class="ongoing-order-tabs">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="estimate-one-tab" data-toggle="tab" href="#estimate-<?= $no; ?>" role="tab" aria-controls="estimateone" aria-selected="true">Confirm Estimate</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="details-one-tab" data-toggle="tab" href="#details-<?= $no; ?>" role="tab" aria-controls="detailone" aria-selected="false">Details</a>
                                            </li>
                                        </ul>

                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="estimate-<?= $no; ?>" role="tabpanel" aria-labelledby="estimate-one-tab">
                                                <form>
                                                    <input type="hidden" name="orderidhidden" id="orderidhidden" value="<?php echo $order['orderid']; ?>">
                                                <table  class="table table-bordered confirm-estimate-table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Service Name</th>
                                                            <th scope="col">Priority</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Unit Price</th>
                                                            <th scope="col">Tax %</th>
                                                            <th scope="col">Total Price</th>
                                                        </tr>
                                                  </thead>

                                                  <tbody>
                                                    <?php foreach ($items[$no] as $item) {
                                                        // print_r($item);
                                                        if (!empty($item)) {
                                                    ?>
                                                        <tr>
                                                            <input type="hidden" name="ratedefault" id="ratedefault">
                                                            <input type="hidden" name="itemidhidden[]" id="itemidhidden" value="<?php echo $item['service_id']; ?>">
                                                            <input type="hidden" name="quantity[]" id="quantity" value="<?php echo $item['quantity']; ?>">
                                                            <input type="hidden" name="cathidden[]" id="cathidden" value="<?php echo $item['service']; ?>">
                                                            <input type="hidden" name="itemtype[]" value="<?php echo $item['service']; ?>">
                                                            <input type="hidden" name="itemnameA[]" value="<?php echo $item['service_name']; ?>">
                                                            <input type="hidden" name="itempriority[]" value="<?php echo $item['priority']; ?>">
                                                            <input type="hidden" name="pric[]" value="<?php echo $item['service_price']; ?>">
                                                            <input type="hidden" name="tax1[]" value="<?php echo $item['tax']; ?>">
                                                            <input type="hidden" name="totalamt[]" value="<?php echo $item['total_amount']; ?>">

                                                            <td scope="row"><?= $item['service_name'].'<br>(Qty: '.$item['quantity'].')'; ?></td>
                                                            <td>
                                                                <?php if($item['priority'] == 1){
                                                                    echo "High";
                                                                } else if ($item['priority'] == 2) {
                                                                    echo "Medium";
                                                                } else {
                                                                    echo "Low";
                                                                } ?>
                                                            </td>
                                                            <td class="status-col">
                                                            <?php if ($order['status'] < 4) { ?>
                                                                <select name="is_checked[]" id="is_checked" class="form-control">
                                                                    <option value="1"<?= ($item['is_checked'] == 1)?"selected":"";?>>Approved</option>
                                                                    <option value="2"<?= ($item['is_checked'] == 2)?"selected":"";?>>Rejected</option>
                                                                </select>
                                                            <?php } else { ?>
                                                            <?php if ($item['is_checked'] == 1) { ?>
                                                                <button class="btn btn-success" disabled>Approve</button>
                                                            <?php } else if ($item['is_checked'] == 2) { ?>
                                                                <button class="btn btn-danger" disabled>Reject</button>
                                                            <?php } } ?>
                                                            </td>
                                                            <td><?= $item['service_price'] ?></td>
                                                            <td><?= $item['tax'] ?></td>
                                                            <td><?= $item['total_amount'] ?></td>
                                                        </tr>
                                                    <?php } } ?>
                                                    </tbody>
                                                </table>
                                                <?php if ($order['status'] < 4 && !empty($items[$no])) { ?>
                                                <button type="button" class="btn btn-success" onclick="ApprovalUpdate();">Confirm Estimate</button>
                                                <?php } else if ($order['invoice_status'] == 1) { ?>
                                                    <a href="<?= base_url().$order['invoice_url']; ?>" target="_blank" class="btn btn-info">View Invoice</a> 
                                                <?php } ?>
                                                </form>
                                            </div>

                                            <div class="tab-pane fade" id="details-<?= $no; ?>" role="tabpanel" aria-labelledby="details-one-tab">
                                                <table class="estimate-details-table">
                                                    <tr>
                                                        <th>Brand Name</th>
                                                        <td><?= (!empty($order['brand']))?$order['brand']:""; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Model Name</th>
                                                        <td><?= (!empty($order['model']))?$order['model']:""; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Order Booked on</th>
                                                        <td><?= (!empty($order['ordered_on']))?$order['ordered_on']:""; ?></td>
                                                     </tr>

                                                    <tr>
                                                        <th>Service Type</th>
                                                        <td><?= (!empty($order['subcategory_name']))?$order['subcategory_name']:""; ?></td>
                                                     </tr>

                                                    <tr>
                                                        <th>Vendor Name</th>
                                                        <td><?= (!empty($order['garage_name']))?$order['garage_name']:""; ?></td>
                                                     </tr>

                                                    <tr>
                                                        <th>Total Amount Paid</th>
                                                        <td><?= (!empty($order['grand_total']))?$order['grand_total']:""; ?></td>
                                                     </tr>
                                                </table>                                                    
                                            </div>
                                        </div>                                              
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 ">
                        <div class="track-order-btn text-center">
                            <a href="<?= base_url()."track-order/".$order['ordercode']; ?>" class="">Track Order</a>
                        </div>
                    </div>
                <?php ++$no; } } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    function ApprovalUpdate() {
        var formData = new FormData($('form')[0]);
        $.ajax({
            url : base_url + 'order/confirm_estimate',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            cache : false,
            success: function (response) {
                alert(response.message);
                location.reload();
            }
        });
    }
</script>