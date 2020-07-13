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
            .description h2{
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
            h2{
                font-size: 11px;
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
                border-top: 1px solid #000;
                padding: 14px;

            }
            .logo img{
                float: right;
            }
            .logo{
                text-align: right;
            }

            .details{
                font-size: 10px;
            }
            .description{ 
                font-size: 10px;
            }
            .custom-width p{
                margin:0px !important;
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
                                <h1> Autoden Solutions Pvt Ltd </h1>
                                <p> Pushkar Warehouse, </p>
                                <p> Behind dharmawat petrol pump, </p>
                                <p> Undri-Pisoli road, </p>
                                <p> Pune - 411060 </p>
                            </td>
                            <td class="logo">
                                <img src="<?php echo base_url(); ?>/assets/images/img/Logo.png">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="details">
                <h1 class="center"> Invoice</h1>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <h2>Billed to</h2>
                                <p><?= $data[0]['reg_company_name']?></p>
                            </td>
                            <td>
                                <h2>Outlet</h2>
                                <p><?= $data[0]['outlet_name']?></p>

                            </td>
                            <td>
                                <h2>Invoice #</h2>
                                <p><?php echo $data[0]['bulk_id'] . '/' . date('Y'); ?></p>
                                <br/>
                                <h2>Invoice Date</h2>
                                <p><?php echo date('d-m-Y'); ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php $a = 1; $total_amount = 0;
              foreach($data as $key => $value) {
                  $total_amount = $total_amount + $value['package_price'] + $value['amount'];
                  ?>
            <div class="details">
                <h1> <?= $a?>)</h1>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                 <h2>Bike Details :- <?= $value['bike_name']?>, <?= $value['bike_number']?></h2>
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="description total">
                <table style="margin:-13px;margin-left: 0px;">
                    <tbody>
                        <tr>
                            <th> <h2>S No</h2>
                            </th>
                            <th><h2>Description</h2>
                            </th>
                            <th><h2>Service Type</h2>
                            </th>
                            <th><h2>Amount</h2>
                            </th>
                            
                        </tr>
                        <?php
                        if (isset($value['services'])) {
                            foreach ($value['services'] as $key => $row) {
                                
                                if ($row['is_checked'] == 1) {
                                    # code...
                                    ?>
                                    <tr>
                                        <td>
                                            <p><?php echo $key + 1; ?></p>
                                        </td>
                                        <td>
                                            <p><?php echo $row['service_name']; ?></p>
                                        </td>

                                        <td>
                                            <p><?=  $row['service'] == 1 ? 'Service' : 'Spare'; ?></p>
                                        </td>
                                       

                                        <td>
                                            <p><?php echo $row['price']; ?></p>
                                        </td>
                                        
                                        
                                    </tr>
                                    <?php }
                                }
                            } ?>

                    </tbody>
                </table>
            </div>
            <div>
                <div class="total">

                    <table class="custom-width" style="    border-collapse: collapse;
                           border-spacing: 0;
                           margin-top: 2%; 
                           float: right !important;  margin-left:250px !important;">
                        <tbody>
                            <?php if(!empty($value['package'])) {?>
                            <tr>
                                <td><h2>Package Name</h2></td>
                                <td><h2><?= $value['package'][0]['package_name']?></h2></td>
                            </tr>
                            <tr>
                                <td><h2>Package Deatils</h2></td>
                                <td><h2>Remaining Package service count : <?= $value['package'][0]['remaining_service_count']?></h2></td>
                            </tr>
                            <tr>
                                <td><h2>Package Price</h2></td>
                                <td><h2><?= $value['package_price']?></h2></td>
                            </tr>
                            <?php }?>
                            <tr>
                                <td><h2>Adjustment</h2></td>
                                <td><p><?= $value['adjustment']; ?></p></td>
                            </tr> 
                            <tr>
                                <td><h2>Order Total</h2></td>
                                <td><h2><?= $value['amount']; ?></h2></td>
                            </tr>
<!--                            <tr>
                                <td><p>Discount</p></td>
                                <td><p><?php echo $order['discount']; ?></p></td>
                            </tr> -->
<!--                            <tr>
                                <td><h2>Net Total</h2></td>
                                <td><h2><?php echo $order['net_total']; ?></h2></td>
                            </tr>-->
<!--                            <tr>
                                <td><p>Adjustment</p></td>
                                <td><p><?php echo $order['adjustment']; ?></p></td>
                            </tr>  
                            <tr>
                                <td><h2>Amount Received</h2></td>
                                <td><h2><?php echo $order['amount_received']; ?></h2></td>
                            </tr>-->

                        </tbody>
                    </table>
                </div>
            </div>
            <?php $a++;}?> 
            <div class="">

                    <table class="custom-width" style="    border-collapse: collapse;
                           border-spacing: 0;
                           margin-top: 2%; 
                           float: right !important;  margin-left:250px !important;border-top: 2px solid #000;">
                        <tbody>
                            
                            <tr>
                                <td><h2>Total Amout</h2></td>
                                <td><h2><?= $total_amount?></h2></td>
                            </tr>
                            

                        </tbody>
                    </table>
                </div>
            

    </body>
</html>