<!DOCTYPE html>
<html>
    <head>
        <title>Invoice</title>
        <style type="text/css">
            table{
                width: 100%;
            }
            .center{
                text-align: center;
            }
            .description h3{
                text-align: left;
            }
            .border-top td{
                border-top: .5px solid #000;
            }
            body{

                font-family: Arial, Helvetica, sans-serif;
            }
            h1{
                font-size: 13px;
                margin: 10px 0px;
                font-weight: 600;
            }
            .description td{
                margin: 0px;
                padding: 0px;
            }
            p{
                margin: 10px 0px 10px;
                font-size: 12px;
            }
            .total{
                border-top: 2px solid #000;
                padding: 14px;
            }
            .logo img{
                float: right;
            }
            .logo{
                text-align: right;
            }
            /*.invoice{
                width: 80%;
                margin:10% auto;
            }*/
            .details h3{
                font-style: italic;
                font-size: 10px;
            }
            .description h3{
                font-size: 12px;
            }
        </style>
    </head>
    <body>
        <div class="invoice">
            <div class="header">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <h1><?= COMPANY ?></h1>
                                
                                <p>206, 2nd floor,<br>
                                Nehru Society Mahim Link road,<br>
                                T junction Mumbai-400017</p>
                                
                            </td>
                            <td class="logo">
                                <img src="<?php echo base_url(); ?>/assets/images/img/Logo.png" style="width: 130px;">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="details">
                <h2 class="center"> Invoice</h2>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <h3>Billed to</h3>
                                <p><?= $invoice[0]['rider_name']?></p>
                                <p><?= $invoice[0]['mobile']?></p>                                
                            </td>
                            <td>
                                <p>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</p>
                            </td>
                            <td>
                                <p>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</p>
                            </td>
                            <td>
                                <p>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</p>
                            </td>
                            
                            <td style="text-align:right;">
                                <h3>Invoice #</h3>
                                <p><?= $invoice[0]['invoice_no']?></p>
                                <h3>Invoice Date</h3>
                                <p><?= date('d-m-Y', strtotime($invoice[0]['created_date'])); ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr/>
            </div>
           
            <?php if(!empty($pickup)) {
     echo '<h2> Pickup Order</h2>'; ?>
            <div class="description">
                <table>
                        <thead>
                        <tr>
                            <th> 
                                <h3>Sr.No</h3>
                            </th>
                            <th>
                                <h3>Ordercode</h3>
                            </th>
                            <th>
                                <h3>Customer Name</h3>
                            </th>
                            <th>
                                <h3>Customer Mobile</h3>
                            </th>
                            <th>
                                <h3>Total Ride Charges</h3>
                            </th>
                            <th>
                                <h3>Your Pickup Charges</h3>
                            </th>
                            <th>
                                <h3>Order Date</h3>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $a = 1;
                        foreach($pickup as $value) {?>
                        <tr>
                            <td>
                                <p><?= $a?></p>
                            </td>
                            <td>
                                <p><?= $value['ordercode']?></p>
                            </td>
                            <td>
                                <p><?= $value['name']?></p>
                            </td>
                            <td>
                                <p><?= $value['mobile']?></p>
                            </td>
                            <td>
                                <p><?= $value['applied_ride_charge']?></p>
                            </td>
                            <td>
                                <p><?= round($value['applied_ride_charge'] / 2); ?></p>
                            </td>
                            <td>
                                <p><?= date('d-m-Y', strtotime($value['ordered_on'])); ?></p>
                            </td>
                        </tr>
                        <?php $a++; }?>
                    </tbody>
                </table>
            </div>
            <br>
            <?php }?>
            <?php if(!empty($delivery)) {
     echo '<h2> Delivery Order</h2>'; ?>
            <div class="description">
                <table>
                        <thead>
                        <tr>
                            <th> 
                                <h3>Sr.No</h3>
                            </th>
                            <th>
                                <h3>Ordercode</h3>
                            </th>
                            <th>
                                <h3>Customer Name</h3>
                            </th>
                            <th>
                                <h3>Customer Mobile</h3>
                            </th>
                            <th>
                                <h3>Total Ride Charges</h3>
                            </th>
                            <th>
                                <h3>Your Delivery Charges</h3>
                            </th>
                            <th>
                                <h3>Order Date</h3>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $a = 1;
                        foreach($delivery as $value) {?>
                        <tr>
                            <td>
                                <p><?= $a ?></p>
                            </td>
                            <td>
                                <p><?= $value['ordercode']?></p>
                            </td>
                            <td>
                                <p><?= $value['name']?></p>
                            </td>
                            <td>
                                <p><?= $value['mobile']?></p>
                            </td>
                            <td>
                                <p><?= $value['applied_ride_charge']?></p>
                            </td>
                            <td>
                                <p><?= round($value['applied_ride_charge'] / 2); ?></p>
                            </td>
                            <td>
                                <p><?= date('d-m-Y', strtotime($value['ordered_on'])); ?></p>
                            </td>
                        </tr>
                        <?php $a++; }?>
                    </tbody>
                </table>
            </div>
            <br>
            <?php } ?>

            <div class="total">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <table class="custom-width">
                                    <tbody>
                                        <tr>
                                            <td><p>Pickup total</p></td>
                                            <td><p><?= $invoice[0]['pickup_total']?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p>Delivery total</p></td>
                                            <td><p><?= $invoice[0]['delivery_total']?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p>Commission in %</p></td>
                                            <td><p><?= $invoice[0]['ride_commission']?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p>Settlement amount</p></td>
                                            <td><p><?= abs($invoice[0]['settlment_amount'])?></p></td>
                                        </tr>
                                        <tr>
                                            <td>     
                                            <h3>
                                                <?php
                                                    echo COMPANY .' will pay '.abs($invoice[0]['settlment_amount']);
                                                ?>

                                                <?php /*if($invoice[0]['is_company_paid'] == 1) {
                                                        echo COMPANY .' will pay '.abs($invoice[0]['settlment_amount']);
                                                } else {
                                                    echo  $invoice[0]['vendor_name'] .' will pay '.abs($invoice[0]['settlment_amount']);
                                                }*/
                                                ?>
                                            </h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>