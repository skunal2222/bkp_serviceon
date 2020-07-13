<div id="page-wrapper" style="padding:0 16px;">
    <div class="row">
        <div class="panel panel-default">
            <br><br>
            <div class="">
                <div class="col-12">
                    <div class="panel-wrapper collapse in" aria-expanded="true">

                        <div class="">

                            <div class="form-body">

                                <ul class="nav customtab nav-tabs" role="tablist">

                                    <li role="presentation" class="nav-item">
                                        <a href="#weekly" class="nav-link active" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">
                                            <span class="visible-xs">
                                                <i class="ti-user"></i>
                                            </span>
                                            <span class="hidden-xs">Weekly</span>
                                        </a>
                                    </li>

                                    <li role="presentation" class="nav-item">
                                        <a href="#fortnightly" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">
                                            <span class="visible-xs">
                                                <i class="ti-user"></i>
                                            </span>
                                            <span class="hidden-xs">Fortnightly</span>
                                        </a>
                                    </li>
                                    
                                    <li role="presentation" class="nav-item">
                                        <a href="#monthly" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">
                                            <span class="visible-xs">
                                                <i class="ti-user"></i>
                                            </span>
                                            <span class="hidden-xs">Monthly</span>
                                        </a>
                                    </li>
                                    </ul>
                                    <div class="tab-content" >
                                        <div class="tab-pane fade in active" id="weekly">
                                            <div class="">				
                                                <div class="col-12">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead class="bg-info">
                                                            <tr>
                                                                <th>Sr.No.</th>
                                                                <th>Rider Name</th>
                                                                <th>Rider Mobile </th>
                                                                <th>Total Pickup Order </th>
                                                                <th>Pickup Total Amount </th>
                                                                <th>Total Delivery Order </th>
                                                                <th>Delivery Total Amount </th>
                                                                <th>Commission in % </th>
                                                                <th>Settlement Amount </th>
                                                                <th>Generate Invoice</th>
                                                            </tr>
                                                        </thead>

                                                        <?php
                                                        $i = 1;
                                                        foreach ($weekly as $key => $row) { 
                                                            $invoice_code = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($row['rider_id'], 10, 36)) ;

                                                            $pickup_total = 0;
                                                            $delivery_total = 0;
                                                            $total_amount = 0;
                                                            $appliedCommission = 0;
                                                            $settlement_amount = 0;
                                                            $pickup_order_id = "";
                                                            $pickup_order_count = 0;
                                                            $delivery_order_id = "";
                                                            $delivery_order_count = 0;
                                                            $commission = $row['commission_service'];
                                                            $wst = $row['with_service_tax'];
                                                            $bc = $row['billing_cycle'];
                                                            if (!empty($row['pickup_total'])) {
                                                                $pickup_total = $row['pickup_total'];
                                                            }
                                                            if (!empty($row['delivery_total'])) {
                                                                $delivery_total = $row['delivery_total'];
                                                            }
                                                            $total_amount = round($pickup_total) + round($delivery_total);
                                                            $appliedCommission = ($commission / 100) * ($total_amount);
                                                            $settlement_amount = round($total_amount) - round($appliedCommission);

                                                            if (isset($row['pickup_order_id'])){
                                                            $pickup_order_id = implode(',', $row['pickup_order_id']);
                                                            $pickup_order_count = count($row['pickup_order_id']);
                                                            }

                                                            if (isset($row['delivery_order_id'])){
                                                            $delivery_order_id = implode(',', $row['delivery_order_id']);
                                                            $delivery_order_count = count($row['delivery_order_id']);
                                                            }


                                                        ?>
                                                            <form onsubmit="return add_invoice(this);">
                                                                <tbody>
                                                                <tr class="c-table__row">
                                                                <input type="hidden" name="billing_cycle" value="<?=$row['billing_cycle']?>">
                                                                <td class="c-table__cell">
                                                                    <?= $i; ?>
                                                                </td>
                                                                <td class="c-table__cell">
                                                                    <?= $row['rider_name']; ?>
                                                                </td>
                                                                <input type="hidden" name="rider_id" value="<?= $row['rider_id'] ?>">

                                                                <input type="hidden" name="rider_name" value="<?= $row['rider_name'] ?>">

                                                                <input type="hidden" name="invoice_no" value="<?=$invoice_code?>">
                                                                <td class="c-table__cell">
                                                                    <?= isset($row['rider_mobile']) ? $row['rider_mobile'] : '-';
                                                                    ?>
                                                                </td>

                                                                <td class="c-table__cell">
                                                                    <?= $pickup_order_count; ?>
                                                                </td>
                                                                <input type="hidden" name="pickup_order_id" value="<?= $pickup_order_id ?>">

                                                                <td class="c-table__cell">
                                                                    <?= $pickup_total; ?>
                                                                </td>
                                                                <input type="hidden" name="pickup_total" value="<?= $pickup_total; ?>">

                                                                <td class="c-table__cell">
                                                                    <?= $delivery_order_count;?>
                                                                </td>
                                                                <input type="hidden" name="delivery_order_id" value="<?= $delivery_order_id ?>">

                                                                <td class="c-table__cell">
                                                                    <?= $delivery_total; ?>
                                                                </td>
                                                                <input type="hidden" name="delivery_total" value="<?= $delivery_total; ?>">

                                                                <td class="c-table__cell">
                                                                    <?= $commission; ?>
                                                                </td>
                                                                <input type="hidden" name="ride_commission" value="<?= $commission; ?>">

                                                                <td class="c-table__cell">
                                                                    <?= $settlement_amount; ?>
                                                                </td>
                                                                <input type="hidden" name="settlment_amount" value="<?= $settlement_amount; ?>">

                                                                <input type="hidden" name="total_amount" value="<?= $total_amount; ?>">

                                                                <input type="hidden" name="with_service_tax" value="<?= $wst; ?>">
                                                                <input type="hidden" name="billing_cycle" value="<?= $bc; ?>">

                                                                <td class="c-table__cell">
                                                                    <button class="btn-default" type="submit"> Generate Invoice </button>
                                                                </td>
                                                                </tr>
                                                                </tbody>
                                                            </form>
                                                        <?php $i++;
                                                    }
                                                    ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="fortnightly">
                                            <div class="">				
                                                <div class="col-12">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead class="bg-info">
                                                            <tr>
                                                                <th>Sr.No.</th>
                                                                <th>Rider Name</th>
                                                                <th>Rider Mobile </th>
                                                                <th>Total Pickup Order </th>
                                                                <th>Pickup Total Amount </th>
                                                                <th>Total Delivery Order </th>
                                                                <th>Delivery Total Amount </th>
                                                                <th>Commission in % </th>
                                                                <th>Settlement Amount </th>
                                                                <th>Generate Invoice</th>
                                                            </tr>
                                                        </thead>

                                                        <?php
                                                        $i = 1;
                                                        foreach ($fortnightly as $key => $row){ 
                                                            $invoice_code = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($row['rider_id'], 10, 36)) ;

                                                            $pickup_total = 0;
                                                            $delivery_total = 0;
                                                            $total_amount = 0;
                                                            $appliedCommission = 0;
                                                            $settlement_amount = 0;
                                                            $pickup_order_id = "";
                                                            $pickup_order_count = 0;
                                                            $delivery_order_id = "";
                                                            $delivery_order_count = 0;
                                                            $commission = $row['commission_service'];
                                                            $wst = $row['with_service_tax'];
                                                            $bc = $row['billing_cycle'];
                                                            if (!empty($row['pickup_total'])) {
                                                                $pickup_total = $row['pickup_total'];
                                                            }
                                                            if (!empty($row['delivery_total'])) {
                                                                $delivery_total = $row['delivery_total'];
                                                            }
                                                            $total_amount = round($pickup_total) + round($delivery_total);
                                                            $appliedCommission = ($commission / 100) * ($total_amount);
                                                            $settlement_amount = round($total_amount) - round($appliedCommission);

                                                            if (isset($row['pickup_order_id'])){
                                                            $pickup_order_id = implode(',', $row['pickup_order_id']);
                                                            $pickup_order_count = count($row['pickup_order_id']);
                                                            }

                                                            if (isset($row['delivery_order_id'])){
                                                            $delivery_order_id = implode(',', $row['delivery_order_id']);
                                                            $delivery_order_count = count($row['delivery_order_id']);
                                                            }
                                                        ?>
                                                            <form onsubmit="return add_invoice(this);">
                                                                <tbody>
                                                                <tr class="c-table__row">
                                                                <input type="hidden" name="billing_cycle" value="<?=$row['billing_cycle']?>">
                                                                <td class="c-table__cell">
                                                                    <?= $i; ?>
                                                                </td>
                                                                <td class="c-table__cell">
                                                                    <?= $row['rider_name']; ?>
                                                                </td>
                                                                <input type="hidden" name="rider_id" value="<?= $row['rider_id'] ?>">

                                                                <input type="hidden" name="rider_name" value="<?= $row['rider_name'] ?>">

                                                                <input type="hidden" name="invoice_no" value="<?=$invoice_code?>">
                                                                <td class="c-table__cell">
                                                                    <?= isset($row['rider_mobile']) ? $row['rider_mobile'] : '-';
                                                                    ?>
                                                                </td>

                                                                <td class="c-table__cell">
                                                                    <?= $pickup_order_count; ?>
                                                                </td>
                                                                <input type="hidden" name="pickup_order_id" value="<?= $pickup_order_id ?>">

                                                                <td class="c-table__cell">
                                                                    <?= $pickup_total; ?>
                                                                </td>
                                                                <input type="hidden" name="pickup_total" value="<?= $pickup_total; ?>">

                                                                <td class="c-table__cell">
                                                                    <?= $delivery_order_count;?>
                                                                </td>
                                                                <input type="hidden" name="delivery_order_id" value="<?= $delivery_order_id ?>">

                                                                <td class="c-table__cell">
                                                                    <?= $delivery_total; ?>
                                                                </td>
                                                                <input type="hidden" name="delivery_total" value="<?= $delivery_total; ?>">

                                                                <td class="c-table__cell">
                                                                    <?= $commission; ?>
                                                                </td>
                                                                <input type="hidden" name="ride_commission" value="<?= $commission; ?>">

                                                                <td class="c-table__cell">
                                                                    <?= $settlement_amount; ?>
                                                                </td>
                                                                <input type="hidden" name="settlment_amount" value="<?= $settlement_amount; ?>">

                                                                <input type="hidden" name="total_amount" value="<?= $total_amount; ?>">

                                                                <input type="hidden" name="with_service_tax" value="<?= $wst; ?>">
                                                                <input type="hidden" name="billing_cycle" value="<?= $bc; ?>">

                                                                <td class="c-table__cell">
                                                                    <button class="btn-default" type="submit"> Generate Invoice </button>
                                                                </td>
                                                                </tr>
                                                                </tbody>
                                                            </form>
                                                        <?php $i++;
                                                    }
                                                    ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="monthly" role="tabpanel" aria-labelledby="nav-home-tab" style="overflow-x:scroll;">
                                            <div class="">				
                                                <div class="col-12">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead class="bg-info">
                                                            <tr>
                                                                <th>Sr.No.</th>
                                                                <th>Rider Name</th>
                                                                <th>Rider Mobile </th>
                                                                <th>Total Pickup Order </th>
                                                                <th>Pickup Total Amount </th>
                                                                <th>Total Delivery Order </th>
                                                                <th>Delivery Total Amount </th>
                                                                <th>Commission in  %</th>
                                                                <th>Settlement Amount </th>
                                                                <th>Generate Invoice</th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                        $i = 1;
                                                        foreach ($monthly as $key => $row) {
                                                            $invoice_code = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($row['rider_id'], 10, 36)) ;

                                                            $pickup_total = 0;
                                                            $delivery_total = 0;
                                                            $total_amount = 0;
                                                            $appliedCommission = 0;
                                                            $settlement_amount = 0;
                                                            $pickup_order_id = "";
                                                            $pickup_order_count = 0;
                                                            $delivery_order_id = "";
                                                            $delivery_order_count = 0;
                                                            $commission = $row['commission_service'];
                                                            $wst = $row['with_service_tax'];
                                                            $bc = $row['billing_cycle'];
                                                            if (!empty($row['pickup_total'])) {
                                                                $pickup_total = $row['pickup_total'];
                                                            }
                                                            if (!empty($row['delivery_total'])) {
                                                                $delivery_total = $row['delivery_total'];
                                                            }
                                                            $total_amount = round($pickup_total) + round($delivery_total);
                                                            $appliedCommission = ($commission / 100) * ($total_amount);
                                                            $settlement_amount = round($total_amount) - round($appliedCommission);

                                                            if (isset($row['pickup_order_id'])){
                                                            $pickup_order_id = implode(',', $row['pickup_order_id']);
                                                            $pickup_order_count = count($row['pickup_order_id']);
                                                            }

                                                            if (isset($row['delivery_order_id'])){
                                                            $delivery_order_id = implode(',', $row['delivery_order_id']);
                                                            $delivery_order_count = count($row['delivery_order_id']);
                                                            }
                                                        ?>
                                                            <form onsubmit="return add_invoice(this);">
                                                                <tbody>
                                                                <tr class="c-table__row">
                                                                <input type="hidden" name="billing_cycle" value="<?=$row['billing_cycle']?>">
                                                                <td class="c-table__cell">
                                                                    <?= $i; ?>
                                                                </td>
                                                                <td class="c-table__cell">
                                                                    <?= $row['rider_name']; ?>
                                                                </td>
                                                                <input type="hidden" name="rider_id" value="<?= $row['rider_id'] ?>">

                                                                <input type="hidden" name="rider_name" value="<?= $row['rider_name'] ?>">

                                                                <input type="hidden" name="invoice_no" value="<?=$invoice_code?>">
                                                                <td class="c-table__cell">
                                                                    <?= isset($row['rider_mobile']) ? $row['rider_mobile'] : '-';
                                                                    ?>
                                                                </td>

                                                                <td class="c-table__cell">
                                                                    <?= $pickup_order_count; ?>
                                                                </td>
                                                                <input type="hidden" name="pickup_order_id" value="<?= $pickup_order_id ?>">

                                                                <td class="c-table__cell">
                                                                    <?= $pickup_total; ?>
                                                                </td>
                                                                <input type="hidden" name="pickup_total" value="<?= $pickup_total; ?>">

                                                                <td class="c-table__cell">
                                                                    <?= $delivery_order_count;?>
                                                                </td>
                                                                <input type="hidden" name="delivery_order_id" value="<?= $delivery_order_id ?>">

                                                                <td class="c-table__cell">
                                                                    <?= $delivery_total; ?>
                                                                </td>
                                                                <input type="hidden" name="delivery_total" value="<?= $delivery_total; ?>">

                                                                <td class="c-table__cell">
                                                                    <?= $commission; ?>
                                                                </td>
                                                                <input type="hidden" name="ride_commission" value="<?= $commission; ?>">

                                                                <td class="c-table__cell">
                                                                    <?= $settlement_amount; ?>
                                                                </td>
                                                                <input type="hidden" name="settlment_amount" value="<?= $settlement_amount; ?>">
                                                                
                                                                <input type="hidden" name="total_amount" value="<?= $total_amount; ?>">

                                                                <input type="hidden" name="with_service_tax" value="<?= $wst; ?>">
                                                                <input type="hidden" name="billing_cycle" value="<?= $bc; ?>">

                                                                <td class="c-table__cell">
                                                                    <button class="btn-default" type="submit"> Generate Invoice </button>
                                                                </td>
                                                                </tr>
                                                                </tbody>
                                                            </form>
                                                        <?php $i++;
                                                    }
                                                    ?>
                                                    </table>
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
                </div>
            </div>
            <script>

                function add_invoice(ths) {
                    console.log($(ths).serialize());
                    ajaxindicatorstart('Please wait'); 
                    $.ajax({
                        url: base_url + 'admin/profit/addinvoice_rider',
                        data: $(ths).serialize(),
                        method: "POST",
                        dataType: "json",
                        success: function (response) {

                            // alert(response);
                            alert('Invoice generated successfully');
                            window.location.href = base_url + "admin/profit/pending_rider";
                        }
                        
                    })
                    return false;
                }

            </script>
