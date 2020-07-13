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
            <h3>Bulk Notifications</h3>
        </div>
    </div>
    <form id="addnotifications" name="addnotifications" action="" method="post" enctype="multipart/form-data">
        <div class="tab-content">
            <div id="basic" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body"> 
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" id="error-name">
                                            <label class="control-label">Title<span class='text-danger'>*</span></label>
                                            <input type="text" class="form-control" name="title" id="title" autocomplete="off"/>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>

                                    <div class="col-md-12"> 
                                        <div class="form-group" id="error-name">
                                            <label class="control-label">Message<span class='text-danger'>*</span></label>
                                            <textarea class="form-control" autocomplete="off" rows="3" id="message" name="message"></textarea>
                                        </div>
                                        <div class="messageContainer"></div>
                                    </div>
                                </div> 
                                 
                                </div> 
                                     
                                <div class="text-center">
                                    <div id="response"></div>
                                    <button type="submit" class="btn btn-success">Send</button>
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
     
    $('#addnotifications').bootstrapValidator({
        container: function ($field, validator) {
            return $field.parent().next('div.messageContainer');
        },
        feedbackIcons: {
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {
            'title': {
                validators: {
                    notEmpty: { 
                        message: 'Title is required and cannot be empty'
                    }
                }
            },
            'message': {
                validators: {
                    notEmpty: {
                        message: 'Message is required and cannot be empty'
                    }
                }
            } 

        }
    }).on('success.form.bv', function (event, data) {
        // Prevent form submission
        event.preventDefault();
        addnotifications();
    }); 

    function addnotifications() {


        var options = {
            target: '#response',
            beforeSubmit: showAddRequest,
            success: showAddResponse,
            url: base_url + 'admin/notifications/add',
            semantic: true,
            dataType: 'json'
        };
        $('#addnotifications').ajaxSubmit(options);
    }

    function showAddRequest(formData, jqForm, options) {
        $("#response").hide();
        ajaxindicatorstart("Please hang on.. while we adding notifications ..");
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
            window.location.href = base_url + "admin/notifications/newnotification";
        }
    }
   
</script>
 