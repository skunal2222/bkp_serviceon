<style>
    <!--
    .btn-plus{
        margin:5px 0px;
    }
    .modal-header {
        background-color:#337ab7;
        color:#fff;
    }
    .datepicker-dropdown {
        z-index:1050 !important;
    }
    -->
</style>
<div id="page-wrapper" style="padding:0 16px;">
    <div class="row">
        <div class="panel panel-default" style="width: 100%;">
            <div class="panel-heading">
                <span style="cursor:pointer;" onclick="hideNav();" id="show-hide-nav"><i class="fa fa-chevron-circle-left fa-2x"></i></span> Approval Orders
            </div>
            <div class="panel-body">
                <div class="dataTable_wrapper" style="overflow:auto;">
                    <table class="table table-striped table-bordered table-hover" id="tblRestos">
                        <thead class="bg-info">
                            <tr>
                            <!-- 	<th><input type="checkbox" name="selectall" id="selectall" /></th> -->
                                <th>ID</th> 
                                <!--<th>Order Code</th>--> 
                                <th>Company Name</th>
                                <th>Outlet Name</th>
                                <th>City Name</th> 
                                <th>No. of Bikes </th>
                                <?php if($_SESSION['adminsession']['user_role'] == 1 && $_SESSION['adminsession']['is_client'] == 0) {?>
                                <th>Generate Invoice</th>
                                <?php }?>
                                <th>Invoice URL</th>
                            </tr>
                        </thead>
                        <tbody class="inoice_table">
                            <?php if (isset($orders)) { ?>
                            
                                <?php foreach ($orders as $item): ?>
                                    <tr>
                                    <!-- 	<td><input type="checkbox" name="orderid[]" class="orderid" value="<?php echo $item['order_id']; ?>"/></td> -->
                                        <td>
                                            <!--<a href = "<?php echo base_url(); ?>client/order/view_details/<?php echo $item['order_id'] ?>">-->
                                                <?php echo $item['id']; ?>
                                            </a>
                                        </td>
<!--                                        <td>
                                            <?php echo $item['ordercode']; ?>
                                        </td>-->
                                        <td>
                                            <?php echo $item['reg_company_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $item['outlet_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $item['name']; ?>
                                        </td> 
                                        <td>
                                            <?php echo count($item['bikes']); ?>
                                        </td>
                                        
                                            <?php if($_SESSION['adminsession']['user_role'] == 1 && $_SESSION['adminsession']['is_client'] == 0) {
                                            ?>
                                        <td>   
                                            <?php $pending = 0;
                                                    foreach($item['all_status'] as $status){
                                                          if($status != 7) {
                                                              if($status !=5 ) {
                                                                 $pending++;
                                                              }
                                                          }
                                                      }  
                                                    if($pending == 0 && $item['bulk_invoice_url'] == '') {?>
                                            <a href="javascript:void(0)" class="btn btn-success icon-btn btn-xs" onclick="generate_bulk_invoice(<?= $item['bulk_id']?>)"> Generate</a>
                                                <?php } else if($item['bulk_invoice_url'] != ''){
                                                         echo 'Invoice generated.';
                                                     } else {
                                                       echo 'Pending '. $pending . ' orders.';
                                                    } ?>
                                        </td>
                                    <?php }?>
                                        <td>
                                            <?php if($item['bulk_invoice_url'] != ''){?>
                                            <a target="__blank" href = "<?php echo base_url();?><?php echo $item['bulk_invoice_url']?>" class="btn btn-success icon-btn btn-xs">View</a>
                                            <?php } else {?>
                                            Pending
                                            <?php }?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#tblRestos').DataTable({
            "aaSorting": []
        });
    });
    function generate_bulk_invoice(id){
        ajaxindicatorstart("Please hang on.. while we genrating invoice..");
        $.ajax({
            url : base_url + 'client/order/generate_bulk_invoice?bulk_id=' + id,
            dataType : 'JSON',
            type : 'GET',
            success : function(response){
                ajaxindicatorstop();
                if(response.status == 1){
                    // var win = window.open(base_url + response.url, '_blank');
                    // win.focus();
                    location.reload();
                }
            }
        });
    }
</script>