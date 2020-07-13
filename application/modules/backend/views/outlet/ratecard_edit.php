<div id="page-wrapper">
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Edit rate card</h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <form id="editratecard" name="editratecard" action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $ratecard[0]['id']; ?>"/>
                            <div id="basic" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group" id="error-name">
                                                            <label class="control-label">City <span class='text-danger'>*</span></label>
                                                            <select id="city_id" class="form-control" name="city_id">
                                                                <?php foreach ($city as $value) { ?>
                                                                <option value="<?= $value['id']?>" <?= $value['id'] == $ratecard[0]['city_id'] ? 'selected' : '' ?>><?= $value['name']?></option>
                                                                <?php }?>    
                                                            </select>
                                                        </div>
                                                        <div class="messageContainer"></div>
                                                    </div>
                                                    <div class="col-lg-6 margin-bottom-5">
                                                        <div class="form-group" id="error-mstart_time">
                                                            <label class="control-label col-sm-5">Rate Card Name<span class='text-danger'>*</span></label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="rate_card_name" name="rate_card_name" value="<?= $ratecard[0]['rate_card_name']?>" />
                                                            </div>
                                                            <div class="messageContainer col-sm-10"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" id="error-name">
                                                            <label class="control-label">Status <span class='text-danger'>*</span></label>
                                                            <select id="status" class="form-control" name="status">
                                                                <option value="1" <?= $ratecard[0]['status'] == 1 ? 'selected' : '' ?>>Enable</option>
                                                                <option value="0" <?= $ratecard[0]['status'] == 0 ? 'selected' : '' ?>>Disable</option>
                                                            </select>
                                                        </div>
                                                        <div class="messageContainer"></div>
                                                    </div>
                                                </div>

                                                <div class="text-center">
                                                    <div id="response"></div>
                                                    <button type="submit" class="btn btn-success">Update</button>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>	
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div> 

<script src="<?= asset_url(); ?>js/bootstrapValidator.min.js"></script>
<script src="<?= asset_url(); ?>js/jquery.form.js"></script>
<script>
    $('#editratecard').bootstrapValidator({
        container: function ($field, validator) {
            return $field.parent().next('.messageContainer');
        },
        feedbackIcons: {
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {
            city_id: {
                validators: {
                    notEmpty: {
                        message: 'City is required and cannot be empty'
                    }
                }
            },
            status: {
                validators: {
                    notEmpty: {
                        message: 'Status is required and cannot be empty'
                    }
                }
            },
            rate_card_name: {
                validators: {
                    notEmpty: {
                        message: 'Rate card name is required and cannot be empty'
                    }
                }
            }
        }
    }).on('success.form.bv', function (event, data) {
        // Prevent form submission
        $.ajax({
            url : base_url + 'client/ratecard/update',
            data : $('#editratecard').serialize(),
            dataType : 'JSON',
            type : 'POST',
            success : function(response) {
                alert(response.msg);
                if(response.status == 1) {
                    window.location = base_url + 'client/ratecard/list';
                }
            }
        });
        return false;

    });
</script>