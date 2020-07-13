<style>
    <!--
    .margin-bottom-5 {
        margin-bottom: 5px;
    }
    -->
    .readonly-ctrl{
        background-color: #fff !important;
    }
</style>
<link href="<?php echo asset_url(); ?>css/datepicker3.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css">

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3>Config redeem and offer</h3>
        </div>
    </div>
    <form id="status-form" name="status-form" action="" method="post" enctype="multipart/form-data">
        <div class="tab-content">
            <div id="basic" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body"> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label">Who share refferal code<span class='text-danger'>*</span></label>
                                            <input type="text" class="form-control" id="otherrefer" name="other_referral" placeholder="Who share refferal code" value="<?=$offerconfig['other_referral']; ?>" autocomplete="off"/>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label">Who use referal code<span class='text-danger'>*</span></label><input type="text" id="myrefer" name="my_referral" class="form-control floating" placeholder="Who use referal code" value="<?=$offerconfig['my_referral']; ?>"  > 
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label">Offer Setting <span class='text-danger'>*</span></label>
                                           <select class="select form-control floating" id="offer" name="discount" required>
                                             <option value="">Select Status</option>
                                             <option value="0" <?php echo ($offerconfig['discount']==0 ? 'selected' :'');?>>Percent</option>
                                             <option value="1" <?php echo ($offerconfig['discount']==1 ? 'selected' :'');?>>Flat</option>
                                           </select>
                                        </div> 
                                         <div class="messageContainer"></div>
                                    </div>
 
                                    <div class="col-md-6">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label">Offer Value <span class='text-danger'>*</span></label>
                                            <input type="text" id="offerval" name="value" class="form-control floating" placeholder="eg: invalid, in process, closed etc. " value="<?=$offerconfig['value']; ?>">   
                                  
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>
                                </div>        
                                <div class="text-center">
                                    <div id="response"></div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <br>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="response"></div>

    </form>
</div>
<script src="<?php echo asset_url(); ?>js/bootstrap-typeahead.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url(); ?>js/jquery.form.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>

<script>
     
    $('#status-form').bootstrapValidator({
        container: function ($field, validator) {
            return $field.parent().next('div.messageContainer');
        },
        feedbackIcons: {
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {
            
              other_referral: {
                  validators: {
                      notEmpty: {
                          message: 'This field is required'
                      }
                  }
              },
            my_referral: {
                    validators: {
                        notEmpty: {
                            message: 'This field is required'
                        }
                    }
                },  
            discount: {
                    validators: {
                        notEmpty: {
                            message: 'This field is required'
                        }
                    }
                }, 
            value :{
                    validators: {
                        notEmpty: {
                            message: 'This field is required'
                        }
                    }
            } 

        }
    }).on('success.form.bv', function (event, data) {
        // Prevent form submission
        event.preventDefault();
        addNewStatus();
    }); 

    function addNewStatus() { 
        var options = {
            target: '#response',
            beforeSubmit: showAddRequest,
            success: showAddResponse,
            url: base_url + 'admin/general/saveconfig',
            semantic: true,
            dataType: 'json'
        };
        $('#status-form').ajaxSubmit(options);
    }

    function showAddRequest(formData, jqForm, options) {
        $("#response").hide();
        ajaxindicatorstart("Please hang on.. while we updating data ..");
        var queryString = $.param(formData);
        return true;
    }

    function showAddResponse(resp, statusText, xhr, $form) {
        ajaxindicatorstop();
        alert(resp.msg);
        if (resp.status == '0') {
            $("#response").removeClass('alert-success');
            $("#response").addClass('alert-danger');
            $("#response").html(resp.msg);
            $("#response").show();
        } else {
            $("#response").removeClass('alert-danger');
            $("#response").addClass('alert-success');
            $("#response").html(resp.msg);
            $("#response").show();
            window.location.href = base_url + "admin/general/redeemsetting";
        }
    }
 
      
</script>
 