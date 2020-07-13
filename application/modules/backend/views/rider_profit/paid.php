
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
                                                                <th>Total Pickup Order </th>
                                                                <th>Pickup Total Amount </th>
                                                                <th>Total Delivery Order </th>
                                                                <th>Delivery Total Amount </th>
                                                                <th>Commission in % </th>
                                                                <th>Settlement Amount </th>
                                                                <th>Invoice Date</th>
                                                                <th>Invoice</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>


                                                        <?php
                                                        $i = 1;
                                                        foreach ($weekly as $key => $row) {
                                                            $pickup_order_count = 0;
                                                            $delivery_order_count = 0;
                                                            if (isset($row['pickup_order_id'])){
                                                                $pickup_order_count = count(explode(',', $row['pickup_order_id']));
                                                            }

                                                            if (isset($row['delivery_order_id'])){
                                                                $delivery_order_count = count(explode(',', $row['delivery_order_id']));
                                                            }
                                                        ?>
                                                            <form onsubmit="return add_paid(this);">
                                                                <tbody>
                                                                <tr class="c-table__row">
                                                                <td class="c-table__cell">
                                                                    <?= $i; ?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $row['rider_name']; ?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $pickup_order_count; ?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $row['pickup_total']; ?>
                                                                </td>

                                                                <td class="c-table__cell">
                                                                    <?= $delivery_order_count;?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $row['delivery_total']; ?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $row['ride_commission']; ?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $row['settlment_amount']; ?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell"><?= $row['created_date'] ?>
                                                                </td>

                                                                <td class="c-table__cell"><a href="<?= base_url(). $row['invoice_url']?>">click here </a>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $row['paid_date'] ?>
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
                                        <div class="tab-pane fade in" id="fortnightly">
                                            <div class="">				
                                                <div class="col-12">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead class="bg-info">
                                                            <tr>
                                                                <th>Sr.No.</th>
                                                                <th>Rider Name</th>
                                                                <th>Total Pickup Order </th>
                                                                <th>Pickup Total Amount </th>
                                                                <th>Total Delivery Order </th>
                                                                <th>Delivery Total Amount </th>
                                                                <th>Commission in % </th>
                                                                <th>Settlement Amount </th>
                                                                <th>Invoice Date</th>
                                                                <th>Invoice</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>


                                                        <?php
                                                        $i = 1;
                                                        foreach ($fortnightly as $key => $row) {
                                                            $pickup_order_count = 0;
                                                            $delivery_order_count = 0;
                                                            if (isset($row['pickup_order_id'])){
                                                                $pickup_order_count = count(explode(',', $row['pickup_order_id']));
                                                            }

                                                            if (isset($row['delivery_order_id'])){
                                                                $delivery_order_count = count(explode(',', $row['delivery_order_id']));
                                                            }
                                                        ?>
                                                            <form onsubmit="return add_paid(this);">
                                                                <tbody>
                                                                <tr class="c-table__row">
                                                                <td class="c-table__cell">
                                                                    <?= $i; ?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $row['rider_name']; ?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $pickup_order_count; ?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $row['pickup_total']; ?>
                                                                </td>

                                                                <td class="c-table__cell">
                                                                    <?= $delivery_order_count;?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $row['delivery_total']; ?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $row['ride_commission']; ?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $row['settlment_amount']; ?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell"><?= $row['created_date'] ?>
                                                                </td>

                                                                <td class="c-table__cell"><a href="<?= base_url(). $row['invoice_url']?>">click here </a>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $row['paid_date'] ?>
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
                                        <div class="tab-pane fade in" id="monthly">
                                            <div class="">				
                                                <div class="col-12">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead class="bg-info">
                                                            <tr>
                                                                <th>Sr.No.</th>
                                                                <th>Rider Name</th>
                                                                <th>Total Pickup Order </th>
                                                                <th>Pickup Total Amount </th>
                                                                <th>Total Delivery Order </th>
                                                                <th>Delivery Total Amount </th>
                                                                <th>Commission in % </th>
                                                                <th>Settlement Amount </th>
                                                                <th>Invoice Date</th>
                                                                <th>Invoice</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>


                                                        <?php
                                                        $i = 1;
                                                        foreach ($monthly as $key => $row) {
                                                            $pickup_order_count = 0;
                                                            $delivery_order_count = 0;
                                                            if (isset($row['pickup_order_id'])){
                                                                $pickup_order_count = count(explode(',', $row['pickup_order_id']));
                                                            }

                                                            if (isset($row['delivery_order_id'])){
                                                                $delivery_order_count = count(explode(',', $row['delivery_order_id']));
                                                            }
                                                        ?>
                                                            <form onsubmit="return add_paid(this);">
                                                                <tbody>
                                                                <tr class="c-table__row">
                                                                <td class="c-table__cell">
                                                                    <?= $i; ?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $row['rider_name']; ?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $pickup_order_count; ?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $row['pickup_total']; ?>
                                                                </td>

                                                                <td class="c-table__cell">
                                                                    <?= $delivery_order_count;?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $row['delivery_total']; ?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $row['ride_commission']; ?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $row['settlment_amount']; ?>
                                                                </td>
                                                                
                                                                <td class="c-table__cell"><?= $row['created_date'] ?>
                                                                </td>

                                                                <td class="c-table__cell"><a href="<?= base_url(). $row['invoice_url']?>">click here </a>
                                                                </td>
                                                                
                                                                <td class="c-table__cell">
                                                                    <?= $row['paid_date'] ?>
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