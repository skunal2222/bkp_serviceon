
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
                                                                <th>Mechanic Name</th>
                                                                <th>Total online order </th>
                                                                <th>Total COD order </th>
                                                                <th>Total online spare </th>
                                                                <th>Total online service</th>
                                                                <th>Total COD spare </th>
                                                                <th>Total COD service</th>
                                                                <th>Service commission</th>
                                                                <th>Spare commission</</th>
                                                                <th>Gateway charge</th>
                                                                <th>Settlement amount</th>
                                                                <th>Generate Invoice</th>
                                                            </tr>
                                                        </thead>


                                                        <?php
                                                        $i = 1;
                                                        foreach ($weekly as $key => $row) {
                                                            $total = 0;
                                                            $profit = 0;
                                                            ?>
                                                            <form onsubmit="return add_invoice(this);">
                                                                <tbody>
                                                                    <tr class="c-table__row">
                                                                        <input type="hidden" name="billing_cycle" value="<?=$row['billing_cycle']?>">
                                                                        <td class="c-table__cell"><?= $i; ?></td>
                                                                        <td class="c-table__cell"><?= $row['name']; ?></td>
                                                                <input type="hidden" name="vendor_id" value="<?= $row['vendor_id'] ?>">
                                                                <input type="hidden" name="vendor_name" value="<?= $row['name']; ?>">
                                                                <?php $invoice_code = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($row['vendor_id'], 10, 36)) ;?>
                                                                <input type="hidden" name="invoice_no" value="<?=$invoice_code?>">
                                                                <td class="c-table__cell"><?= isset($row['online_order_id']) ? count($row['online_order_id']) : '-'; ?></td>

                                                                <input type="hidden" name="online_order_id" value="<?= isset($row['online_order_id']) ? implode(",", $row['online_order_id']) : ''; ?>">

                                                                <td class="c-table__cell"><?= isset($row['offline_order_id']) ? count($row['offline_order_id']) : '-'; ?></td>

                                                                <input type="hidden" name="offline_order_id" value="<?= isset($row['offline_order_id']) ? implode(",", $row['offline_order_id']) : ''; ?>">

                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['online_spare_total'];
                                                                    ?>
                                                                </td>

                                                                <input type="hidden" name="online_spare_total" value="<?= $row['online_spare_total'] ?>">
                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['online_service_total'];
                                                                    ?>
                                                                </td>

                                                                <input type="hidden" name="online_service_total" value="<?= $row['online_service_total'] ?>">
                                                                
                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['offline_spare_total'];
                                                                    ?>
                                                                </td>

                                                                <input type="hidden" name="offline_spare_total" value="<?= $row['offline_spare_total'] ?>">
                                                                
                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['offline_service_total'];
                                                                    ?>
                                                                </td>

                                                                <input type="hidden" name="offline_service_total" value="<?= $row['offline_service_total'] ?>">
                                                                
                                                                <td class="c-table__cell"><?= $row['commission_service']; ?></td>

                                                                <input type="hidden" name="commission_service" value="<?= $row['commission_service']; ?>">
                                                                
                                                                <td class="c-table__cell"><?= $row['commission_spare']; ?></td>

                                                                <input type="hidden" name="commission_spare" value="<?= $row['commission_spare']; ?>">
                                                                
                                                                <td class="c-table__cell"><?= $row['gateway_charge']; ?></td>

                                                                <input type="hidden" name="gateway_charge" value="<?= $row['gateway_charge']; ?>">


                                                                <?php
                                                                $remaining = 0;
                                                                $online_spare_profit = $row['commission_spare'] / 100 * $row['online_spare_total'];
                                                                $online_service_profit = $row['commission_service'] / 100 * $row['online_service_total'];
                                                                if(isset($row['online_total'])){
                                                                    $online_spare_profit = $online_spare_profit + ($row['gateway_charge'] / 100 * $row['online_actual_total']);
                                                                    $remaining = ($row['online_actual_total']) - ($online_spare_profit + $online_service_profit);
                                                                   // echo '<script> alert('.$row['tax_settlement'].') </script>';
                                                                }  
                                                                //echo '<script> alert('.$remaining.') </script>';
                                                                $remaining = $remaining - $row['tax_settlement'];
                                                                //echo '<script> alert('.$remaining.') </script>';
                                                                $offline_spare_profit = $row['commission_spare'] / 100 * $row['offline_spare_total'];
                                                                $offline_service_profit = $row['commission_service'] / 100 * $row['offline_service_total'];
                                                                //echo '<script> alert('.$offline_service_profit.') </script>';
                                                                //echo '<script> alert('.$online_service_profit.') </script>';
                                                                //echo '<script> alert('.$online_spare_profit.') </script>';
                                                                $settelment = $remaining - ($offline_spare_profit + $offline_service_profit);
                                                                //echo '<script> alert('.$remaining.') </script>';
                                                                //echo '<script> alert('.$settelment.') </script>';
                                                                if ($row['discount_amount'] != 0) {
                                                                    if($settelment < 0) {
                                                                      $settelment = abs($settelment) - $row['discount_amount'];
                                                                    } else {
//                                                                      $settelment = $settelment + $row['discount_amount'];
//                                                                      $settelment = abs($settelment);
                                                                    }
                                                                }
                                                                
                                                               // $settelment = ($online_spare_profit + $online_service_profit) - ($offline_spare_profit + $offline_service_profit);
                                                                //$company_profit = ($online_spare_profit + $online_service_profit + $offline_spare_profit + $offline_service_profit);
                                                                ?>
                                                                
<!--                                                                <td class="c-table__cell"><?= round($company_profit)?></td> 
                                                                <input type="hidden" name="company_profit" value="<?= round($company_profit) ?>">-->

                                                                <td class="c-table__cell"><?= round(abs($settelment)) ?></td> 
                                                                <input type="hidden" name="with_service_tax" value="<?= $row['with_service_tax']?>">
                                                                <input type="hidden" name="settlment_amount" value="<?= round(abs($settelment))?>">
                                                                <input type="hidden" name="is_company_paid" value="<?= $settelment > 0 ? 1 : 0?>">
                                                                <td class="c-table__cell">
                                                                    <button class="btn-default" type="submit"> Generate Invoice </button></td>
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
                                                                <th>Mechanic Name</th>
                                                                <th>Total online order </th>
                                                                <th>Total COD order </th>
                                                                <th>Total online spare </th>
                                                                <th>Total online service</th>
                                                                <th>Total COD spare </th>
                                                                <th>Total COD service</th>
                                                                <th>Service commission</th>
                                                                <th>Spare commission</</th>
                                                                <th>Gateway charge</th>
                                                                
                                                                <th>Settlement amount</th>
                                                                <th>Generate Invoice</th>
                                                            </tr>
                                                        </thead>


                                                        <?php
                                                        $i = 1;
                                                        foreach ($fortnightly as $key => $row) {
                                                            $total = 0;
                                                            $profit = 0;
                                                            ?>
                                                            <form onsubmit="return add_invoice(this);">
                                                                <tbody>
                                                                    <tr class="c-table__row">

                                                                        <td class="c-table__cell"><?= $i; ?></td>
                                                                        <td class="c-table__cell"><?= $row['name']; ?></td>
                                                                        <input type="hidden" name="billing_cycle" value="<?=$row['billing_cycle']?>">
                                                                <input type="hidden" name="vendor_id" value="<?= $row['vendor_id'] ?>">
                                                                <input type="hidden" name="vendor_name" value="<?= $row['name']; ?>">
                                                                <?php $invoice_code = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($row['vendor_id'], 10, 36)) ;?>
                                                                <input type="hidden" name="invoice_no" value="<?=$invoice_code?>">
                                                                <td class="c-table__cell"><?= isset($row['online_order_id']) ? count($row['online_order_id']) : '-'; ?></td>

                                                                <input type="hidden" name="online_order_id" value="<?= isset($row['online_order_id']) ? implode(",", $row['online_order_id']) : ''; ?>">

                                                                <td class="c-table__cell"><?= isset($row['offline_order_id']) ? count($row['offline_order_id']) : '-'; ?></td>

                                                                <input type="hidden" name="offline_order_id" value="<?= isset($row['offline_order_id']) ? implode(",", $row['offline_order_id']) : ''; ?>">

                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['online_spare_total'];
                                                                    ?>
                                                                </td>

                                                                <input type="hidden" name="online_spare_total" value="<?= $row['online_spare_total'] ?>">
                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['online_service_total'];
                                                                    ?>
                                                                </td>

                                                                <input type="hidden" name="online_service_total" value="<?= $row['online_service_total'] ?>">
                                                                
                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['offline_spare_total'];
                                                                    ?>
                                                                </td>

                                                                <input type="hidden" name="offline_spare_total" value="<?= $row['offline_spare_total'] ?>">
                                                                
                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['offline_service_total'];
                                                                    ?>
                                                                </td>

                                                                <input type="hidden" name="offline_service_total" value="<?= $row['offline_service_total'] ?>">
                                                                
                                                                <td class="c-table__cell"><?= $row['commission_service']; ?></td>

                                                                <input type="hidden" name="commission_service" value="<?= $row['commission_service']; ?>">
                                                                
                                                                <td class="c-table__cell"><?= $row['commission_spare']; ?></td>

                                                                <input type="hidden" name="commission_spare" value="<?= $row['commission_spare']; ?>">
                                                                
                                                                <td class="c-table__cell"><?= $row['gateway_charge']; ?></td>

                                                                <input type="hidden" name="gateway_charge" value="<?= $row['gateway_charge']; ?>">


                                                                <?php
                                                                $remaining = 0;
                                                                $online_spare_profit = $row['commission_spare'] / 100 * $row['online_spare_total'];
                                                                $online_service_profit = $row['commission_service'] / 100 * $row['online_service_total'];
                                                                if(isset($row['online_total'])){
                                                                    $online_spare_profit = $online_spare_profit + ($row['gateway_charge'] / 100 * $row['online_actual_total']);
                                                                    $remaining = ($row['online_actual_total']) - ($online_spare_profit + $online_service_profit);
                                                                   // echo '<script> alert('.$row['tax_settlement'].') </script>';
                                                                }  
                                                                //echo '<script> alert('.$remaining.') </script>';
                                                                $remaining = $remaining - $row['tax_settlement'];
                                                                //echo '<script> alert('.$remaining.') </script>';
                                                                $offline_spare_profit = $row['commission_spare'] / 100 * $row['offline_spare_total'];
                                                                $offline_service_profit = $row['commission_service'] / 100 * $row['offline_service_total'];
                                                                //echo '<script> alert('.$offline_service_profit.') </script>';
                                                                //echo '<script> alert('.$online_service_profit.') </script>';
                                                                //echo '<script> alert('.$online_spare_profit.') </script>';
                                                                $settelment = $remaining - ($offline_spare_profit + $offline_service_profit);
                                                                //echo '<script> alert('.$remaining.') </script>';
                                                                //echo '<script> alert('.$settelment.') </script>';
                                                                if ($row['discount_amount'] != 0) {
                                                                    if($settelment < 0) {
                                                                      $settelment = abs($settelment) - $row['discount_amount'];
                                                                    } else {
//                                                                      $settelment = $settelment + $row['discount_amount'];
//                                                                      $settelment = abs($settelment);
                                                                    }
                                                                }
                                                                ?>
                                                                
<!--                                                                <td class="c-table__cell"><?= round($company_profit)?></td> 
                                                                <input type="hidden" name="company_profit" value="<?= round($company_profit) ?>">-->

                                                                <td class="c-table__cell"><?= round(abs($settelment)) ?></td> 
                                                                <input type="hidden" name="with_service_tax" value="<?= $row['with_service_tax']?>">
                                                                <input type="hidden" name="settlment_amount" value="<?= round(abs($settelment))?>">
                                                                
                                                                    <input type="hidden" name="is_company_paid" value="<?= $settelment > 0 ? 1 : 0?>">
                                                                


                                                                <td class="c-table__cell">
                                                                    <button class="btn-default" type="submit"> Generate Invoice </button></td>

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
                                        <div class="tab-pane fade" id="monthly" role="tabpanel" aria-labelledby="nav-home-tab" style="overflow-x:scroll;max-width:1093px;">
                                            <div class="">				
                                                <div class="col-12">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead class="bg-info">
                                                            <tr>
                                                                <th>Sr.No.</th>
                                                                <th>Mechanic Name</th>
                                                                <th>Total online order </th>
                                                                <th>Total COD order </th>
                                                                <th>Total online spare </th>
                                                                <th>Total online service</th>
                                                                <th>Total COD spare </th>
                                                                <th>Total COD service</th>
                                                                <th>Service commission</th>
                                                                <th>Spare commission</</th>
                                                                <th>Gateway charge</th>
                                                                <th>Settlement amount</th>
                                                                <th>Generate Invoice</th>
                                                            </tr>
                                                        </thead>


                                                        <?php
                                                        $i = 1;
                                                        foreach ($monthly as $key => $row) {
                                                            $total = 0;
                                                            $profit = 0;
                                                            ?>
                                                            <form onsubmit="return add_invoice(this);">
                                                                <tbody>
                                                                    <tr class="c-table__row">

                                                                        <td class="c-table__cell"><?= $i; ?></td>
                                                                        <td class="c-table__cell"><?= $row['name']; ?></td>
                                                                        <input type="hidden" name="billing_cycle" value="<?=$row['billing_cycle']?>">
                                                                <input type="hidden" name="vendor_id" value="<?= $row['vendor_id'] ?>">
                                                                <input type="hidden" name="vendor_name" value="<?= $row['name']; ?>">
                                                                <?php $invoice_code = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($row['vendor_id'], 10, 36)) ;?>
                                                                <input type="hidden" name="invoice_no" value="<?=$invoice_code?>">
                                                                <td class="c-table__cell"><?= isset($row['online_order_id']) ? count($row['online_order_id']) : '-'; ?></td>

                                                                <input type="hidden" name="online_order_id" value="<?= isset($row['online_order_id']) ? implode(",", $row['online_order_id']) : ''; ?>">

                                                                <td class="c-table__cell"><?= isset($row['offline_order_id']) ? count($row['offline_order_id']) : '-'; ?></td>

                                                                <input type="hidden" name="offline_order_id" value="<?= isset($row['offline_order_id']) ? implode(",", $row['offline_order_id']) : ''; ?>">

                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['online_spare_total'];
                                                                    ?>
                                                                </td>

                                                                <input type="hidden" name="online_spare_total" value="<?= $row['online_spare_total'] ?>">
                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['online_service_total'];
                                                                    ?>
                                                                </td>

                                                                <input type="hidden" name="online_service_total" value="<?= $row['online_service_total'] ?>">
                                                                
                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['offline_spare_total'];
                                                                    ?>
                                                                </td>

                                                                <input type="hidden" name="offline_spare_total" value="<?= $row['offline_spare_total'] ?>">
                                                                
                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['offline_service_total'];
                                                                    ?>
                                                                </td>

                                                                <input type="hidden" name="offline_service_total" value="<?= $row['offline_service_total'] ?>">
                                                                
                                                                <td class="c-table__cell"><?= $row['commission_service']; ?></td>

                                                                <input type="hidden" name="commission_service" value="<?= $row['commission_service']; ?>">
                                                                
                                                                <td class="c-table__cell"><?= $row['commission_spare']; ?></td>

                                                                <input type="hidden" name="commission_spare" value="<?= $row['commission_spare']; ?>">
                                                                
                                                                <td class="c-table__cell"><?= $row['gateway_charge']; ?></td>

                                                                <input type="hidden" name="gateway_charge" value="<?= $row['gateway_charge']; ?>">


                                                                <?php
                                                                $remaining = 0;
                                                                $online_spare_profit = $row['commission_spare'] / 100 * $row['online_spare_total'];
                                                                $online_service_profit = $row['commission_service'] / 100 * $row['online_service_total'];
                                                                if(isset($row['online_total'])){
                                                                    $online_spare_profit = $online_spare_profit + ($row['gateway_charge'] / 100 * $row['online_actual_total']);
                                                                    $remaining = ($row['online_actual_total']) - ($online_spare_profit + $online_service_profit);
                                                                   // echo '<script> alert('.$row['tax_settlement'].') </script>';
                                                                }  
                                                                //echo '<script> alert('.$remaining.') </script>';
                                                                $remaining = $remaining - $row['tax_settlement'];
                                                                //echo '<script> alert('.$remaining.') </script>';
                                                                $offline_spare_profit = $row['commission_spare'] / 100 * $row['offline_spare_total'];
                                                                $offline_service_profit = $row['commission_service'] / 100 * $row['offline_service_total'];
                                                                //echo '<script> alert('.$offline_service_profit.') </script>';
                                                                //echo '<script> alert('.$online_service_profit.') </script>';
                                                                //echo '<script> alert('.$online_spare_profit.') </script>';
                                                                $settelment = $remaining - ($offline_spare_profit + $offline_service_profit);
                                                                //echo '<script> alert('.$remaining.') </script>';
                                                                //echo '<script> alert('.$settelment.') </script>';
                                                                if ($row['discount_amount'] != 0) {
                                                                    if($settelment < 0) {
                                                                      $settelment = abs($settelment) - $row['discount_amount'];
                                                                    } else {
//                                                                      $settelment = $settelment + $row['discount_amount'];
//                                                                      $settelment = abs($settelment);
                                                                    }
                                                                }
                                                                ?>
                                                                
<!--                                                                <td class="c-table__cell"><?= round($company_profit)?></td> 
                                                                <input type="hidden" name="company_profit" value="<?= round($company_profit) ?>">-->

                                                                <td class="c-table__cell"><?= round(abs($settelment)) ?></td> 
                                                                <input type="hidden" name="with_service_tax" value="<?= $row['with_service_tax']?>">
                                                                
                                                                <input type="hidden" name="settlment_amount" value="<?= round(abs($settelment))?>">
                                                                
                                                                    <input type="hidden" name="is_company_paid" value="<?= $settelment > 0 ? 1 : 0?>">
                                                                


                                                                <td class="c-table__cell">
                                                                    <button class="btn-default" type="submit"> Generate Invoice </button></td>

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
                        url: base_url + 'admin/profit/addinvoice',
                        data: $(ths).serialize(),
                        method: "POST",
                        dataType: "json",
                        success: function (response) {
                            alert('Invoice generated successfully');
                            window.location.href = base_url + "admin/profit/pending";
                        }
                        
                    })
                    return false;
                }

            </script>
