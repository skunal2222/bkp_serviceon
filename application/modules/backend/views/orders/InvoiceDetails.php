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
            .cls_address{
                 width: 140px;
                 white-space: normal;
            }
        </style>

    </head>
    <body>

        <div class="invoice">
            <div class="header">
                <table>
                    <tbody>
                        <tr>
                           <!--  <td>
                                <h1>Autoden Solutions Pvt Ltd</h1>
                                <p>B-102, Archana Hill Town,</p>
                                <p>Kausarbaug Road, Kondhwa,</p>
                                <p>Pune - 411048</p>
                            </td> -->
                            <td>
                               <h1> <?php echo $order['vendor_company_name']; ?> </h1>
                                <p class="cls_address"> <?php echo $order['vendor_address']; ?> </p>
                                <p> <?php echo $order['vendor_pincode']; ?> </p>
                            </td>
                            <td class="logo">
                                In Association With<br>
                                <img src="<?php echo base_url(); ?>/assets/images/img/Logo.png" style="width: 130px;">
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
                                <h2>Invoice Raised To:</h2>
                                <p><?php echo $order['name'];?></p>
                                <br/>
                                <h2>Contact No:</h2>
                                <p><?php echo $order['mobile'];?></p>
                                <br/>
                                <!-- <h2>Customer GSTIN:</h2>
                                <p><?php echo $order['gst_no'];?></p>
                                <br/>
                                <h2>GST Name:</h2>
                                <p><?php echo $order['gst_name'];?></p> -->
                                <h2>Vehicle Number:</h2>
                                <p><?php if(isset($vehicle_number)) echo $vehicle_number;?></p>
                                <h2>Brand Name:</h2> 
                                <p><?php if(isset($brand)) echo $brand;?></p>
                                <h2>Model Name:</h2>
                                <p><?php if(isset($model)) echo $model;?></p>
                                
                            </td>
                            <td>
                                <h2>Address:</h2>
                                <p><?php echo $order['address'];?>,<?php echo $order['locality'];?></p>

                            </td>
                            <td>
                                <h2>Order No:</h2>
                                <p><?php echo $order['ordercode'];?><p>
                                <br/>
                                <h2>Invoice #</h2>
                                <p><?php echo $order['ordercode'] . '/' . date('Y'); ?></p>
                                <br/>
                                <h2>Invoice Date</h2>
                                <p><?php echo date('d-m-Y',strtotime($order['invoice_date']));?></p>
                                <br/>
                                <h2>GSTIN:</h2>
                                <p><?php echo $order['vendor_gstin']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
             
            <div class="description total">
                <table style="margin:-13px;margin-left: 0px;">
                    <tbody>
                        <tr>
                            <th> <h2>Sr No</h2>
                            </th>
                            <th><h2>Description</h2>
                            </th>
                            <th><h2>Service Type</h2>
                            </th>
                            <th><h2>Service Price</h2>
                            </th>
                            <th><h2>Tax</h2>
                            </th>
                            <th><h2>Total Amount</h2>
                            </th>
                            
                        </tr>
                        <?php
                        if (isset($items)) {
                            foreach ($items as $key => $row) {
                                
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
                                            <p><?php echo $row['service_price']; ?></p>
                                        </td>

                                        <td>
                                            <p><?php echo $row['tax']; ?> % </p>
                                        </td>

                                        <td>
                                            <p><?php echo $row['total_amount']; ?></p>
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
                            <?php if(!empty($package_details)) {?>
                            <tr>
                                <td><h2>Package Name</h2></td>
                                <td><h2><?= $package_details['package_name']?></h2></td>
                            </tr>
                            <tr>
                                <td><h2>Package Deatils</h2></td>
                                <td><h2>Remaining Package service count : <?= $package_details['remaining']?></h2></td>
                            </tr>
                            <?php }?>
                            <?php if($order['old_price'] > 0){?>
                            <tr>
                                <td><h2>Package Price</h2></td>
                                <td><h2>Rs <?php echo $order['old_price'];?></h2></td>
                            </tr>
                            <?php }?>
                            
                            <tr>
                                <td><h2>Order Amount</h2></td>
                                <td><h2>Rs. <?php echo $order['order_amount'];?></h2></td>
                            </tr> 
                            <tr>
                                <td><h2>Discount</h2></td>
                                <td><h2><?php echo $order['discount']; ?></h2></td>
                            </tr>
                            <tr>
                                <td><h2>Net Total</h2></td>
                                <td><h2>Rs. <?php echo $order['net_total'];?></h2></td>
                            </tr>
                            <tr>
                                <td><h2>Adjustment</h2></td>
                                <td><h2>Rs. <?php echo $order['adjustment'];?></h2></td>
                            </tr>
 
                            
<!--                            <tr>
                                <td><h2>Net Total</h2></td>
                                <td><h2><?php echo $order['net_total']; ?></h2></td>
                            </tr>-->
<!--                        <tr>
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
         
            <div class="">

                    <table class="custom-width" style="    border-collapse: collapse;
                           border-spacing: 0;
                           margin-top: 2%; 
                           float: right !important;  margin-left:250px !important;border-top: 2px solid #000;">
                        <tbody>
                            
                            <tr>
                                <td><h2>Total Amout</h2></td>
                                <td><h2>Rs. <?php echo round($order['grand_total']);?></h2></td>
                            </tr>
                            

                        </tbody>
                    </table>
                </div>
            

    </body>
</html>