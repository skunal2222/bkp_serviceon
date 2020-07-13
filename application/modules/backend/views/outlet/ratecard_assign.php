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
                        Assign card List
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
                                        <th>Outlet Name</th>
                                        <th>Company Name</th>
                                        <th>City</th>
                                        <th>Rate Card</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php $a = 1;
                                              foreach ($ratecard as $value) { ?>
                                            <tr>
                                                <td><?= $a ?></td>
                                                <td><?= $value['outlet_name']; ?></td>
                                                <td><?= $value['reg_company_name']; ?></td>
                                                <td><?= $value['name']; ?></td>
                                                <td><?= $value['rate_card_name'] == '' ? 'No assigned' : $value['rate_card_name']; ?></td>
                                                <td>
                                                    <button class="btn btn primary" onclick="get_rate_card('<?=$value['outlet_name']?>', <?=$value['id']?>, <?= $value['cityid']?>)"><?= $value['rate_card_name'] == '' ? 'Assign' : 'Change'; ?></button>
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
<div class="container">
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="top :30%">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
            <div class="col-lg-10 margin-bottom-5">
            <div class="form-group" id="error-landmark">
                <label class="control-label col-sm-5">Select Rate Card<span class="text-danger">*</span></label>
                <div class="col-sm-12 ">
                    <select name="rate_card_id" id="rate_card_id" class="form-control floating" data-bv-field="city_id">
                    </select>
                </div>
                <div class="messageContainer   has-error"><small style="display: none;" class="help-block" data-bv-validator="notEmpty" data-bv-for="city_id" data-bv-result="NOT_VALIDATED">City is required and cannot be empty</small></div>
            </div>
             <div class="col-lg-10 margin-bottom-5">
                 <input type="hidden" id="outlet_id" value="">
                 <button onclick="assign_rate_card()" class="btn btn-primary"> Assign </button>
            </div>   
                
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>
 

<script>
    $(document).ready(function () {
        $('#ratecardlist').DataTable();
    });
    
    function get_rate_card(name, id, city_id) {
        ajaxindicatorstart('Please wait');
        $.ajax({
            url : base_url + 'client/ratecard/get_rate_card_by_city',
            data : {city_id : city_id},
            dataType : 'JSON',
            type : 'POST', 
            success : function(response) {
                ajaxindicatorstop();
                if(response.length) {
                    var view = '';
                    view += '<option value="">Select rate card</option>';
                    for(var a = 0; a < response.length; a++) {
                        view += '<option value="' + response[a].id + '">' + response[a].rate_card_name + '</option>'; 
                    }
                    $('#rate_card_id').html(view);
                    $('#outlet_id').val(id);
                    $('.modal-title').text('Assign rate card for ' + name);
                    $('#myModal').modal('show');
                } else {
                    alert('No rate card found') ;
                }
            }
        });
    }
    function assign_rate_card() {
        var outlet_id = $('#outlet_id').val();
        var rate_card_id = $('#rate_card_id').val();
        if(outlet_id && rate_card_id) {
            ajaxindicatorstart('Please wait');
            $.ajax({
                url : base_url + 'client/ratecard/add_ratecard_assign',
                data : {id : outlet_id, rate_card_id : rate_card_id},
                dataType : 'JSON',
                type : 'POST', 
                success : function(response) {
                     alert('Assigned successfully');
                     ajaxindicatorstop();
                     location.reload();
                }
            });
        }
    }
</script>