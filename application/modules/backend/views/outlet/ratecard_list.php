<style>
    .dataTables_filter label{
        display : none;
    }
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Rate card List
                        <div class="btn-plus" style="float:right">
                            <a href="<?php echo base_url(); ?>client/ratecard/new" class="btn btn-primary view-contacts bottom-margin">
                                <i class="fa fa-plus"></i> Add new rate card
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="ratecardlist">
                                <thead class="bg-info">
                                    <tr>
                                        <th>Sr no</th>
                                        <th>Name</th>
                                        <th>City</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php $a = 1;
                                              foreach ($cardlist as $value) { ?>
                                            <tr>
                                                <td><?= $a ?></td>
                                                <td><?=  $value['rate_card_name']; ?></td>
                                                <td><?=  $value['name']; ?></td>
                                                <td><?= $value['status'] == 1 ? 'Enable' : 'Disable'  ?></td>
                                                <td>
                                                    <a href="<?= base_url();?>client/ratecard/edit/<?= $value['id']?>" class="btn btn-success icon-btn btn-xs">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php $a++; }  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#ratecardlist').DataTable();
    });
</script>