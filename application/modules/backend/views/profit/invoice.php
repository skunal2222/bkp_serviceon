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
                font-size: 20px;
                margin: 10px 0px;
                font-weight: 600;
            }
            .description td{
                margin: 0px;
                padding: 0px;
            }
            p{
                margin: 10px 0px 10px;
            }
            .total{
                border-top: 2px solid #000;
            }
            .logo img{
                float: right;
            }
            .invoice{
                width: 80%;
                margin:10% auto;
            }
            .details h3{
                font-style: italic;
            }
            .description h3{

                font-size: 16px;
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
                                
                                <p>Pune - 411 045, Maharashtra</p>
                                
                            </td>
                            <td class="logo">
                                <img src="<?= asset_url(); ?>frontend/images/common/Logo.png">
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
                                <p><?= $invoice[0]['vendor_name']?></p>
                                <p><?= $invoice[0]['locality']?></p>
                                <p><?= $invoice[0]['mobile']?></p>
                                
                                
                            </td>
                            
                            <td>
                                <h3>Invoice #</h3>
                                <p><?= $invoice[0]['invoice_no']?></p>
                                <br/>
                                <h3>Invoice Date</h3>
                                <p><?= $invoice[0]['created_date']?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr/>
            </div>
           
            <?php if(!empty($online)) {
     echo '<h2> Online Order</h2>';
     $i = 1;
            foreach($online as $value) {?>
            <div class="description">
                <h2><?= $i;?></h2>
                <div>
                    <h5>Order id - <?= $value['orderid']?></h5>
                    <h5>Customer Name - <?= $value['name']?></h5>
                    <h5>Customer Mobile - <?= $value['mobile']?></h5>
                    <h5>Amount Received - <?= $value['amount_received']?></h5>
                </div>
                <table>
                    
                        <thead>
                        <tr>
                            <th> 
                                <h3>Sr.No</h3>
                            </th>
                            <th>
                                <h3>Service Type</h3>
                            </th>
                            <th>
                                <h3>Service Name</h3>
                            <th>
                                <h3>Amount</h3>
                            </th>
                            <th>
                                <h3>Tax</h3>
                            </th>
                            <th>
                                <h3>Total Amount</h3>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $a = 1;
                        foreach($value['services'] as $val) {?>
                        <tr>
                            <td>
                                <p><?= $a?></p>
                            </td>
                            <td>
                                <p><?= $val['service'] == 1 ? 'Service' : 'Spare'?></p>
                            </td>
                            <td>
                                <p><?= $val['service_name']?></p>
                            </td>
                            <td>
                                <p><?= $val['service_price']?></p>
                            </td>
                            <td>
                                <p><?= $val['tax']?></p>
                            </td>
                            <td>
                                <p><?= $val['total_amount']?></p>
                            </td>
                            
                        </tr>
                        <?php $a++; }?>
                        
                    </tbody>
                </table>
            </div>
            <Br>
            <?php $i++;} }?>
            <?php if(!empty($offline) && false) {
     echo '<h2> Offline Order</h2>';
     $i = 1;
            foreach($offline as $value) {?>
            <div class="description">
                <h2><?= $i;?></h2>
                <div>
                    <h5>Order id - <?= $value['orderid']?></h5>
                    <h5>Customer Name - <?= $value['name']?></h5>
                    <h5>Customer Mobile - <?= $value['mobile']?></h5>
                    <h5>Amount Received - <?= $value['amount_received']?></h5>
                </div>
                <table>
                    
                        <thead>
                        <tr>
                            <th> 
                                <h3>Sr.No</h3>
                            </th>
                            <th>
                                <h3>Service Type</h3>
                            </th>
                            <th>
                                <h3>Service Name</h3>
                            <th>
                                <h3>Amount</h3>
                            </th>
                            <th>
                                <h3>Tax</h3>
                            </th>
                            <th>
                                <h3>Total Amount</h3>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $a = 1;
                        foreach($value['services'] as $val) {?>
                        <tr>
                            <td>
                                <p><?= $a?></p>
                            </td>
                            <td>
                                <p><?= $val['service'] == 1 ? 'Service' : 'Spare'?></p>
                            </td>
                            <td>
                                <p><?= $val['service_name']?></p>
                            </td>
                            <td>
                                <p><?= $val['service_price']?></p>
                            </td>
                            <td>
                                <p><?= $val['tax']?></p>
                            </td>
                            <td>
                                <p><?= $val['total_amount']?></p>
                            </td>
                            
                        </tr>
                        <?php $a++;}?>
                        
                    </tbody>
                </table>
            </div>
            <Br>
            <?php $i++;} } ?>

            <div class="total">
                <table>
                    <tbody>
                        <tr>
                            
                            <td>
                                <table class="custom-width">
                                    <tbody>
                                        <tr>
                                            <td><p>Online spare total</p></td>
                                            <td><p><?= $invoice[0]['online_spare_total']?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p>Online service total</p></td>
                                            <td><p><?= $invoice[0]['online_service_total']?></p></td>
                                        </tr>
                                        <!-- <tr>
                                            <td><p>Offline spare total</p></td>
                                            <td><p><?= $invoice[0]['offline_spare_total']?></p></td>
                                        </tr> -->
                                        <!-- <tr>
                                            <td><p>Offline service total</p></td>
                                            <td><p><?= $invoice[0]['offline_service_total']?></p></td>
                                        </tr> -->
                                        <tr>
                                            <td><p>Commission service</p></td>
                                            <td><p><?= $invoice[0]['commission_service']?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p>Commission service</p></td>
                                            <td><p><?= $invoice[0]['commission_service']?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p>Commission spare</p></td>
                                            <td><p><?= $invoice[0]['commission_spare']?></p></td>
                                        </tr>
                                        <tr>
                                            <td><h4>Gateway charge</h4></td>
                                            <td><p><?= $invoice[0]['gateway_charge']?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p>Settalment amount</p></td>
                                            <td><p><?= abs($invoice[0]['settlment_amount'])?></p></td>
                                        </tr>
                                        <tr>
                                       <td>     
                                    <h3>
                                        <?php if($invoice[0]['is_company_paid'] == 1) {
                                                echo COMPANY .' will pay '.abs($invoice[0]['settlment_amount']);
                                        } /*else {
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