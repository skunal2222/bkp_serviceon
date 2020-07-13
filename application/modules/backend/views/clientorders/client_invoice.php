<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title>Invoice</title>
        <style>
            .items td{
                border-bottom:1px solid #212121;
                border-right:1px solid #212121;
                padding:5px;
            }

            .items1 td{
                border-bottom:1px solid #212121;
                padding:5px;
            }
            .summary td{
                border-bottom:1px solid #212121;
                padding:5px;
            }
            table { 
                border-spacing: 0;
                border-collapse: collapse;
            }
            .divFooter {
                position: fixed; 
                top: 20;
                text-align:center;
                page-break-inside:auto;
                height:100%;
            }
        </style>
        <style type="text/css">
            table { page-break-inside:auto }
            tr    { page-break-inside:avoid; page-break-after:auto }
            .print-friendly tr {
                page-break-inside: avoid;
            }
        </style>

    </head>
    <body>
        <div class="divFooter" style="height:100%">
            <h1 style="text-align: center;"><b>Invoice</b></h1>
            <table style="padding:25px;width:100%;" class="print-friendly">
                <tr>
                    <td>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:60%;">
                                        <!--<img alt="Logo" src="<?php echo FCPATH; ?>assets/images/img/logomain.png"/>-->
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <td> 
                                                 <h1> Autoden Solutions Pvt Ltd </h1>
                                                    <p> Pushkar Warehouse, </p>
                                                    <p> Behind dharmawat petrol pump, </p>
                                                    <p> Undri-Pisoli road, </p>
                                                    <p> Pune - 411060 </p>
                                            </td>
                                        </tr>
                                        <!--<tr>
                                                <td>PickUp Date</td>
                                                <td>: <?php echo date('j M Y', strtotime($order[0]['pickup_date'])); ?></td>
                                        </tr>-->
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
                <tr class="items1">
                    <td>
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;
                    </td>
                </tr>

                <tr>
                    <td>
                        <table style="width:100%;" class="print-friendly">
                            <tr>
                                <td style="width:13%;">Invoice Date:</td>
                                <td> &nbsp;<?php echo date('d-m-Y'); ?></td>

                                <td style="padding-left : 25px;">Order No:</td>
                                <td style="padding-right: 25px;"> &nbsp;<?php echo $order[0]['ordercode']; ?></td>
                            </tr>
                            <tr>
                                <td style="width:22%;">Invoice Raised To:</td>
                                <td> &nbsp;<?php echo $order[0]['reg_company_name']; ?> - <?php echo $order[0]['outlet_name']; ?> - <?php echo $order[0]['name']; ?>, </td>

                                <td style="padding-left: 25px;">Invoice No:</td>
                                <td style="padding-right: 25px;"> &nbsp;<?php echo $order[0]['ordercode'] . '/' . date('Y'); ?></td>
                            </tr>
                            
                            <tr>
                                <td style="width:13%;">Bike No:</td>
                                <td style="padding-left: 05px;"><?= $order[0]['bike_name']?> - <?= $order[0]['bike_number']?></td>
                                <td style="padding-right: 25px;"> &nbsp; </td>
                            </tr>
                            
                            <tr>
                                <td style="width:13%;">Contact No:</td>
                                <td style="padding-right: 25px;"> &nbsp; </td>
                                <td style="padding-left: 25px;">GSTIN:</td>
                                <td style="padding-right: 25px;"> &nbsp; </td>
                            </tr>
                            
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td>
                        <table style="width:100%;"  cellspacing="0" class="print-friendly">
                            <tr class="items">
                                <td style="border-left:1px solid #212121;border-top:1px solid #212121;text-align:center;"><b>Description </b></td>
                                <!-- <td style="border-top:1px solid #212121;text-align:center;"></td>-->
                                <td style="border-top:1px solid #212121;text-align:center;"><b>Charges</b></td>
                            </tr>
                            <?php
                            $i = 1;
                            foreach ($services as $item) {
                                $i++;
                                ?>
    <?php if ($item['is_checked'] == 1) { ?>
                                    <tr class="items">
                                        <td style="border-left:1px solid #212121;"><?php echo $item['service_name']; ?></td>
                                        <td>Rs. <?php echo $item['price']; ?></td>
                                    </tr>
    <?php } ?>
<?php } ?>
                            <tr class="items">
                                <td style="border-left:1px solid #212121;border-top:1px solid #212121;height: 22px;"></td>
                                <!-- <td style="border-top:1px solid #212121;"></td>-->
                                <td style="border-top:1px solid #212121;"></td>
                            </tr>
                            <tr class="items">
                                <td style="text-align:right;border-left:1px solid #212121;border-top:1px solid #212121;"><b>Order Amount</b></td>
                                <!-- <td style="border-top:1px solid #212121;"></td>-->
                                <td style="border-top:1px solid #212121;">Rs. <?php echo $order[0]['amount']; ?></td>
                            </tr>
                            
                            <tr class="items">
                                <td style="border-left:1px solid #212121;border-top:1px solid #212121;height:22px;"></td>
                                <!-- <td style="border-top:1px solid #212121;"></td>-->
                                <td style="border-top:1px solid #212121;"></td>
                            </tr>
                    
                            <tr class="items">
                                <td style="border-left:1px solid #212121;border-top:1px solid #212121;"><b>Adjustment</b></td>
                                <!--<td style="border-top:1px solid #212121;"></td>-->
                                <td style="border-top:1px solid #212121;">Rs. 0</td>
                            </tr> 
                            <tr class="items">
                                <td style="border-left:1px solid #212121;border-top:1px solid #212121;height: 22px;"></td>
                                <!-- <td style="border-top:1px solid #212121;"></td>-->
                                <td style="border-top:1px solid #212121;"></td>
                            </tr>
                            <tr class="items">
                                <td style="text-align:right;border-left:1px solid #212121;border-top:1px solid #212121;"><b>Grand Total</b></td>
                                <!--<td style="border-top:1px solid #212121;"></td>-->
                                <td style="border-top:1px solid #212121;">Rs. <?php echo $order[0]['amount']; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;
                    </td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
    </body>
</html>