
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
                                                                <th>Garage Name</th>
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
                                                                <th>Invoice Date</th>
                                                                <th>Is <?= COMPANY?> Paid</th>
                                                                <th>Invoice</th>
                                                                <th>Paid date</th>
                                                            </tr>
                                                        </thead>


                                                        <?php
                                                        $i = 1;
                                                        foreach ($weekly as $key => $row) {
                                                            
                                                            ?>
                                                            <form onsubmit="return add_paid(this);">
                                                                <tbody>
                                                                    <tr class="c-table__row">

                                                                <td class="c-table__cell"><?= $i; ?></td>
                                                                <td class="c-table__cell"><?= $row['vendor_name']; ?></td>
                                                               
                                                              <td class="c-table__cell"><?=  count(explode(",", $row['online_order_id']))  ?></td>

                                                               
                                                                <td class="c-table__cell"><?= count(explode(",", $row['offline_order_id'])) ?></td>

                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['online_spare_total'];
                                                                    ?>
                                                                </td>

                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['online_service_total'];
                                                                    ?>
                                                                </td>
                
                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['offline_spare_total'];
                                                                    ?>
                                                                </td>

                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['offline_service_total'];
                                                                    ?>
                                                                </td>

                                                                <td class="c-table__cell"><?= $row['commission_service']; ?></td>

                                                                <td class="c-table__cell"><?= $row['commission_spare']; ?></td>

                                                                <td class="c-table__cell"><?= $row['gateway_charge']; ?></td>


                                                                
                                                                <td class="c-table__cell"><?= $row['settlment_amount'] ?></td> 
                                                                <td class="c-table__cell"><?= $row['created_date'] ?></td>
                                                                <td class="c-table__cell"><?= $row['is_company_paid'] == 1 ? 'Yes' : 'No'?></td>
                                                                <td class="c-table__cell"><a href="<?= base_url(). $row['invoice_url']?>">click here </a></td>
                                                                


                                                                <td class="c-table__cell"><?= $row['paid_date'] ?></td>

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
                                                                <th>Garage Name</th>
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
                                                                <th>Invoice Date</th>
                                                                <th>Is <?= COMPANY?> Paid</th>
                                                                <th>Invoice</th>
                                                                <th>Paid date</th>
                                                            </tr>
                                                        </thead>


                                                        <?php
                                                        $i = 1;
                                                        foreach ($fortnightly as $key => $row) {
                                                            
                                                            ?>
                                                            <form onsubmit="return add_paid(this);">
                                                                <tbody>
                                                                    <tr class="c-table__row">

                                                                <td class="c-table__cell"><?= $i; ?></td>
                                                                <td class="c-table__cell"><?= $row['vendor_name']; ?></td>
                                                               
                                                              <td class="c-table__cell"><?=  count(explode(",", $row['online_order_id']))  ?></td>

                                                               
                                                                <td class="c-table__cell"><?= count(explode(",", $row['offline_order_id'])) ?></td>

                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['online_spare_total'];
                                                                    ?>
                                                                </td>

                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['online_service_total'];
                                                                    ?>
                                                                </td>
                
                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['offline_spare_total'];
                                                                    ?>
                                                                </td>

                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['offline_service_total'];
                                                                    ?>
                                                                </td>

                                                                <td class="c-table__cell"><?= $row['commission_service']; ?></td>

                                                                <td class="c-table__cell"><?= $row['commission_spare']; ?></td>

                                                                <td class="c-table__cell"><?= $row['gateway_charge']; ?></td>


                                                                
                                                                <td class="c-table__cell"><?= $row['settlment_amount'] ?></td> 
                                                                <td class="c-table__cell"><?= $row['created_date'] ?></td>
                                                                <td class="c-table__cell"><?= $row['is_company_paid'] == 1 ? 'Yes' : 'No'?></td>
                                                                <td class="c-table__cell"><a href="<?= base_url(). $row['invoice_url']?>">click here </a></td>
                                                                


                                                                <td class="c-table__cell"><?= $row['paid_date'] ?></td>

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
                                                                <th>Garage Name</th>
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
                                                                <th>Invoice Date</th>
                                                                <th>Is <?= COMPANY?> Paid</th>
                                                                <th>Invoice</th>
                                                                <th>Paid date</th>
                                                            </tr>
                                                        </thead>


                                                        <?php
                                                        $i = 1;
                                                        foreach ($monthly as $key => $row) {
                                                            
                                                            ?>
                                                            <form onsubmit="return add_paid(this);">
                                                                <tbody>
                                                                    <tr class="c-table__row">

                                                                <td class="c-table__cell"><?= $i; ?></td>
                                                                <td class="c-table__cell"><?= $row['vendor_name']; ?></td>
                                                               
                                                              <td class="c-table__cell"><?=  count(explode(",", $row['online_order_id']))  ?></td>

                                                               
                                                                <td class="c-table__cell"><?= count(explode(",", $row['offline_order_id'])) ?></td>

                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['online_spare_total'];
                                                                    ?>
                                                                </td>

                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['online_service_total'];
                                                                    ?>
                                                                </td>
                
                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['offline_spare_total'];
                                                                    ?>
                                                                </td>

                                                                <td class="c-table__cell">
                                                                    <?php
                                                                      echo $row['offline_service_total'];
                                                                    ?>
                                                                </td>

                                                                <td class="c-table__cell"><?= $row['commission_service']; ?></td>

                                                                <td class="c-table__cell"><?= $row['commission_spare']; ?></td>

                                                                <td class="c-table__cell"><?= $row['gateway_charge']; ?></td>


                                                                
                                                                <td class="c-table__cell"><?= $row['settlment_amount'] ?></td> 
                                                                <td class="c-table__cell"><?= $row['created_date'] ?></td>
                                                                <td class="c-table__cell"><?= $row['is_company_paid'] == 1 ? 'Yes' : 'No'?></td>
                                                                <td class="c-table__cell"><a href="<?= base_url(). $row['invoice_url']?>">click here </a></td>
                                                                


                                                                <td class="c-table__cell"><?= $row['paid_date'] ?></td>

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

                function add_paid(ths) {
                    console.log($(ths).serialize());
                    $.ajax({
                        url: base_url + 'admin/profit/addpaid',
                        data: $(ths).serialize(),
                        method: "POST",
                        dataType: "json",
                        success: function (response) {
                            window.location.href = base_url + "admin/profit/paid";
                        }
                    })
                    return false;
                }

            </script>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

