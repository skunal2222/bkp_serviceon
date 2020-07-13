<!-- Documents -->
<section id="profile-login">
    <div class="d-flex align-items-center profile-title-img">
        <img src="<?php echo asset_url();?>frontend/images/profile-img.png" class="profile-img pr-2">
        <span class="profile-title">Profile</span>
    </div>
    <div class="all-user-history">
        <div class="row profile-section-row">
            <?php echo $sidebar_url; ?>
            <div class="col-lg-9 col-md-9 col-sm-12 tabcontent  pb-5" id="Digi">
                <div class="card " style="min-height: 100%;"> 
                    <div class="document-upload ">
                        <div class="row" id="upload-document-section">
                            <?php $no = 0;
                                foreach ($filedata as $files) {
                            ?>
                            <div class="col-lg-6 col-md-6 col-sm-12 deldiv">
                                <form id="frmupdigi<?= $no; ?>" novalidate>
                                    <input type="hidden" name="dgup_id" value="<?= $files['id'] ?>">
                                <div class="documents-list first-document pt-5">
                                    <div>
                                        <?php
                                            $file = $files['file_path'];
                                            $ext = pathinfo($files['file_path'], PATHINFO_EXTENSION); 
                                            if ($ext == "pdf") { 
                                                $file = "digi_docs/DefaultPDF.png";
                                            }
                                        ?>
                                        <a href="<?= asset_url().$files['file_path']; ?>" target="_blank">
                                        <img id="" src="<?= asset_url().$file; ?>" alt="" height="150px" width="200px" /></a>
                                        <input type="text" name="dgup_fileName" value="<?= $files['file_name']; ?>" placeholder="Document Name" />
                                        <div class="messageContainer"></div>
                                    </div>
                                    <div>
                                    <input name="dgup_files" type="file" />
                                    <div class="messageContainer"></div>
                                    </div>
                                </div>
                                <span id="up-response-msg"></span>
                                <div class="row">
                                <button type="submit" class="btn btn-primary btnup" data-id="<?= $no; ?>">update</button>&emsp;&emsp;
                                <button class="btn btn-danger del_btn" title="Delete" data-id="<?= $files['id']; ?>" >Delete</button>
                                </div>
                                </form>
                            </div>
                            <?php $no++; } ?>
                        </div>
                        <hr>
                        <form id="frm_digi" enctype="multipart/form-data">
                            <div class="row field_wrapper" id="add-document-section">

                            </div>
                            <h5 class="add-document-btn add_button" id="add-document-btn">+ Add Document</h5>
                        <span id="response-msg"></span>
                        <div class="row">
                            <button type="submit" id="btn_dg" class="btn btn-success" style="display: none;">submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
function initialise_btv() {
	$('#frm_digi').bootstrapValidator({
        container: function($field, validator) {
            return $field.parent().find('.messageContainer');
        },
        feedbackIcons: {
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {
            'dg_fileName[]': {
                validators: {
                    notEmpty: {
                        message: 'Please Enter Document Name'
                    },
                    regexp:{
                        regexp:'^[a-zA-Z0-9]+$',
                        message: 'Only a-z, 0-9 allowed'
                    }
                }
            },
            'dg_files[]': {
                validators: {
                    notEmpty: {
                        message: 'Please Choose File'
                    },
					file: {
                        extension: 'jpeg,jpg,png,pdf',
                        type: 'image/jpeg,image/png,application/pdf',
                        maxSize: 5 * 1024 * 1024, //in bytes 1024 bytes multiply with number for 5 mb
                        message: 'The selected file is not valid'
                    }
                }
            }
        }
        }).on('success.form.bv', function(event,data) {
            event.preventDefault();
            $("#response-msg").hide();
            var formData = new FormData($('#frm_digi')[0]);
            ajaxindicatorstart('please wait');
            $.ajax({ url: base_url + 'save_digidocs', data: formData, type: 'POST', dataType: 'JSON', processData: false, contentType: false, success: function (response) { 
                ajaxindicatorstop();
                    $("#response-msg").show();
                    if (response.status == 1) {
                        $("#response-msg").css('color','green');
                        $("#response-msg").html(response.msg);
                        setInterval(function(){ location.reload(); }, 3000);
                    } else {
                        $("#response-msg").css('color','red');
                        $("#response-msg").html(response.msg);
                    }
                }
            });
        return false;
    });
}
$(document).ready(function(){

	initialise_btv();

    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="col-lg-6 col-md-6 col-sm-12 dgdiv">'+
                    '<div class="documents-list first-document pt-5">'+
                    '<div>'+
                    '<h4 class="document-name-title">Document Name</h4>'+
                    '<input type="text" name="dg_fileName[]" placeholder="Enter Document Name" required>'+
                    '<div class="messageContainer"></div>'+
                    '</div>'+
                    '<div>'+
                    // '<label for="files" class="btn document-upload-btn">Upload&emsp;'+
                    '<input id="files" name="dg_files[]" type="file" required />'+
                    '<a href="javascript:void(0);" class="remove_button"><i class="fa fa-times" aria-hidden="true"></i></a>'+
                    '<div class="messageContainer"></div>'+
                    '</div>'+
                    '</div>'+
                    '</div>';

    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
            $("#btn_dg").show();
	        var validator = $('#frm_digi').data('bootstrapValidator');
	        validator.destroy();
	        initialise_btv();
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parents('.dgdiv').remove(); //Remove field html
        x--; //Decrement field counter
        if (x == 1) {
            $("#btn_dg").hide();
        }

        var validator = $('#frm_digi').data('bootstrapValidator');
        validator.destroy();
        initialise_btv();
    });
});

$(document).on("click", ".btnup", function() { 
    var frmid = $(this).attr('data-id');
    $('#frmupdigi'+frmid).bootstrapValidator({
        container: function($field, validator) {
            return $field.parent().find('.messageContainer');
        },
        feedbackIcons: {
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {
            'dgup_fileName': {
                validators: {
                    notEmpty: {
                        message: 'Please Enter Document Name'
                    },
                    regexp:{
                        regexp:'^[a-zA-Z0-9]+$',
                        message: 'Only a-z, 0-9 allowed'
                    }
                }
            },
            'dgup_files': {
                validators: {
                    file: {
                        extension: 'jpeg,jpg,png,pdf',
                        type: 'image/jpeg,image/png,application/pdf',
                        maxSize: 5 * 1024 * 1024, //in bytes 1024 bytes multiply with number for 5 mb
                        message: 'The selected file is not valid'
                    }
                }
            }            
        }
        }).on('success.form.bv', function(event,data) {
            event.preventDefault();
            $("#up-response-msg").hide();
            var formData = new FormData($('#frmupdigi'+frmid)[0]);
            ajaxindicatorstart('please wait');
            $.ajax({ url: base_url + 'update_digidocs', data: formData, type: 'POST', dataType: 'JSON', processData: false, contentType: false, success: function (response) { 
                ajaxindicatorstop();
                    $("#up-response-msg").show();
                    if (response.status == 1) {
                        $("#up-response-msg").css('color','green');
                        $("#up-response-msg").html(response.msg);
                        setInterval(function(){ location.reload(); }, 3000);
                    } else {
                        $("#up-response-msg").css('color','red');
                        $("#up-response-msg").html(response.msg);
                    }
                }
            });
        return false;
    });
});

$(document).on("click",".del_btn", function () {
    var file_id = $(this).attr('data-id');
    if (confirm("Are you sure to delete file?") == true) {
        $(this).parents('.deldiv').remove();
        $.post(base_url+"delete_digidocs", {file_id:file_id}, function(data){
            alert("File deleted successfully");
        });
    }
    return false;
});
</script>