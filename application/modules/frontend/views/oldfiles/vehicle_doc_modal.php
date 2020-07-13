<div class="modal fade" id="add-dl" role="dialog">
    <div class="modal-dialog add-new-add select-vehicle account-modal">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>

            </div>
            <div class="modal-body"> 

                <div class="row">

                    <form id="addRC-<?= $_POST['vehicle_id'] ?>" action="" method="POST" autocomplete="off" enctype="multipart/form-data"> 
                        <input type="hidden" name="vehicle_id" id="vehicle_id" value="<?= $_POST['vehicle_id'] ?>">
                        <input type="hidden" name="vehicle_no" id="vehicle_no" value="">
                        <div class="col-md-9">
                            <h4 class="font-weight-bold">Register Certificate</h4>
                            <div class="form-group Disasterphoto">
                                <label for="Photo<?= $_POST['vehicle_id'] ?>"><span>Upload Here</span> 
                                    <img src="<?php echo asset_url(); ?>images/upload.png" id="uploadBtn1">
                                </label> 
                                <input type="file" name="register_certificate" class="form-control-file imageUpload" id="Photo<?= $_POST['vehicle_id'] ?>">
                                <div class="messageContainer"></div>  
                            </div>
                        </div> 
                    </form>

                    <!--  <div class="col-md-3">
                      <button type="submit" class="add-vehicle-btn saveBtn marginTop30px" id="other-doc">Save</button>
                    </div> -->


                    <div class="clear:both;"></div>
                    <div class="col-md-12">
                        <table class="table border0px">

                            <tbody>

                                <?php if (!empty($documentList)) { ?>
                                    <?php $i = 0;
                                    foreach ($documentList as $value): ?>

                                        <tr>
                                            <td>

                                                <?php
                                                if ($value['type'] == 1) {
                                                    $newstring = substr($value['url'], -3);
                                                    if ($newstring == 'pdf') {
                                                        ?>

                                                        <a href="<?php echo $value['url']; ?>" target="_blank">View PDF File 
                                                        </a>

                                                    <?php } else { ?>
                                                        <a href="" data-dismiss="modal" data-toggle="modal" data-target="#ViewImage">
                                                            <img src="<?php echo $value['url']; ?>" class="widthImg">
                                                            <span><?php echo $value['document_name']; ?>_Register Certificate </span>
                                                        </a>
                                                    <?php } ?>  

                                                </td>
                                                <?php if (!empty($value['url'])) { ?>
                                                    <td>
                                                        <img src="<?php echo asset_url(); ?>images/delete.png" id="Delete" data-id="<?php echo $value['id']; ?>" class="deleteIcon1 delete-rc">
                                                    </td> 
                                                <?php } ?> 
                                                <td>

                                                    <form id="editRC-<?php echo $value['id']; ?>" action="" method="POST" autocomplete="off" enctype="multipart/form-data"> 
                                                        <input type="hidden" name="rc_id" value="<?php echo $value['id']; ?>"> 
                                                        <input type="hidden" name="vehicle_id" id="vehicle_id_rc" value="<?= $_POST['vehicle_id'] ?>"> 
                                                        <input type="hidden" name="vehicle_no" id="vehicle_no_rc" value=""> 

                                                        <?php if (!empty($value['url'])) { ?>
                                                            <label for="imageEditorPor-<?php echo $value['id']; ?>"> 
                                                                <img src="<?php echo asset_url(); ?>images/Artboard63.png" id="EditBtn" class="deleteIcon1">
                                                            </label>
                                                        <?php } ?>


                                                        <input type="file" name="RCfile" class="form-control-file"  id="imageEditorPor-<?php echo $value['id']; ?>" style="display: none;"> 
                                                        <div class="messageContainer"></div>   
                                                    </form> 

                                                </td>

                                            <?php } ?>
                                    <script type="text/javascript">

                                        $('#editRC-<?php echo $value['id']; ?>').bootstrapValidator({
                                            container: function ($field, validator) {
                                                return $field.parent().find('div.messageContainer');
                                            },
                                            feedbackIcons: {
                                                validating: 'glyphicon glyphicon-refresh'
                                            },
                                            excluded: ':disabled',
                                            fields: {

                                                RCfile: {
                                                    validators: {
                                                        notEmpty: {
                                                            message: 'Please select an document.(ex.image/jpeg,image/png/pdf)'
                                                        },
                                                        file: {
                                                            extension: 'jpeg,jpg,png,docx,pdf',
                                                            type: 'image/jpeg,image/png,application/pdf',
                                                            maxSize: 20971526565, // 2048 * 1024
                                                            message: 'The selected file is not valid format.'
                                                        }
                                                    }
                                                }

                                            }
                                        }).on('success.form.bv', function (event, data) {
                                            // Prevent form submission
                                            event.preventDefault();
                                            EditRC(<?php echo $value['id']; ?>);
                                        });
                                        $(document).on('change', '#imageEditorPor-<?php echo $value['id']; ?>', function () {

                                            $('#editRC-<?php echo $value['id']; ?>').trigger('submit');

                                        });

                                    </script>
                                    <?php $i++;
                                endforeach; ?> 
                                <?php } ?>
                            </tr>

                            </tbody>
                        </table>
                    </div> 

                </div>

                <div class="row">
                    <form id="addInsurance-<?= $_POST['vehicle_id'] ?>" action="" method="POST" autocomplete="off" enctype="multipart/form-data"> 
                        <input type="hidden" name="vehicle_id" id="vehicle_id_insurance_add" value="<?= $_POST['vehicle_id'] ?>">
                        <input type="hidden" name="vehicle_no" id="vehicle_no_insurance_add" value="">
                        <div class="col-md-9">
                            <h4 class="font-weight-bold">Insurance Certificate</h4>
                            <div class="form-group Disasterphoto">
                                <label for="PhotoInsurance<?= $_POST['vehicle_id'] ?>"><span>Upload Here</span> 
                                    <img src="<?php echo asset_url(); ?>images/upload.png" id="uploadBtn1">
                                </label> 
                                <input type="file" name="Insurance" class="form-control-file imageUpload" id="PhotoInsurance<?= $_POST['vehicle_id'] ?>">
                                <div class="messageContainer"></div> 
                            </div>
                        </div> 
                    </form>


                    <div class="clear:both;"></div>
                    <div class="col-md-12">
                        <table class="table border0px">

                            <tbody>
                                <?php if (!empty($documentList)) { ?>
                                    <?php $i = 0;
                                    foreach ($documentList as $value): ?>	
                                        <tr>
                                            <td>

                                                <?php
                                                if ($value['type'] == 2) {
                                                    $newstring = substr($value['url'], -3);
                                                    if ($newstring == 'pdf') {
                                                        ?>

                                                        <a href="<?php echo $value['url']; ?>" target="_blank">View PDF File 
                                                        </a>

                                                    <?php } else { ?>
                                                        <a href="" data-dismiss="modal" data-toggle="modal" data-target="#ViewImage">
                                                            <img src="<?php echo $value['url']; ?>" class="widthImg">
                                                             <span><?php echo $value['document_name']; ?>_Insurance</span>
                                                        </a>
                                                    <?php } ?>  

                                                </td>
                                                    <?php if (!empty($value['url'])) { ?>
                                                    <td>
                                                        <img src="<?php echo asset_url(); ?>images/delete.png" id="Delete" data-id="<?php echo $value['id']; ?>" class="deleteIcon1 delete-insurance">
                                                    </td> 
                                                    <?php } ?> 
                                                <td>

                                                    <form id="editInsurance-<?php echo $value['id']; ?>" action="" method="POST" autocomplete="off" enctype="multipart/form-data"> 
                                                        <input type="hidden" name="insurance_id" value="<?php echo $value['id']; ?>"> 
                                                        <input type="hidden" name="vehicle_id" id="vehicle_id_insurance_edit" value=""> 
                                                        <input type="hidden" name="vehicle_no" id="vehicle_no_insurance_edit" value=""> 

                                                        <?php if (!empty($value['url'])) { ?>
                                                            <label for="imageEditorPor-<?php echo $value['id']; ?>"> 
                                                                <img src="<?php echo asset_url(); ?>images/Artboard63.png" id="EditBtn" class="deleteIcon1">
                                                            </label>
                                                        <?php } ?>


                                                        <input type="file" name="Insurance" class="form-control-file"  id="imageEditorPor-<?php echo $value['id']; ?>" style="display: none;"> 
                                                        <div class="messageContainer"></div>   
                                                    </form> 

                                                </td>

                                                <?php } ?>
                                    <script type="text/javascript">


                                        $('#editInsurance-<?php echo $value['id']; ?>').bootstrapValidator({
                                            container: function ($field, validator) {
                                                return $field.parent().find('div.messageContainer');
                                            },
                                            feedbackIcons: {
                                                validating: 'glyphicon glyphicon-refresh'
                                            },
                                            excluded: ':disabled',
                                            fields: {

                                                Insurance: {
                                                    validators: {
                                                        notEmpty: {
                                                            message: 'Please select an document.(ex.image/jpeg,image/png/pdf)'
                                                        },
                                                        file: {
                                                            extension: 'jpeg,jpg,png,docx,pdf',
                                                            type: 'image/jpeg,image/png,application/pdf',
                                                            maxSize: 20971526565, // 2048 * 1024
                                                            message: 'The selected file is not valid format.'
                                                        }
                                                    }
                                                }

                                            }
                                        }).on('success.form.bv', function (event, data) {
                                            // Prevent form submission
                                            event.preventDefault();
                                            EditInsurance(<?php echo $value['id']; ?>);
                                            alert(123);
                                        });

                                        $(document).on('change', '#imageEditorPor<?php echo $value['id']; ?>', function () {

                                            $('#editInsurance-<?php echo $value['id']; ?>').trigger('submit');

                                        });


                                    </script> 
                                    <?php $i++;
                                endforeach; ?> 
<?php } ?> 

                            </tr>

                            </tbody>
                        </table>
                    </div> 

                </div>


                <div class="row">  
                    <form id="addPuc-<?= $_POST['vehicle_id'] ?>" action="" method="POST" autocomplete="off" enctype="multipart/form-data"> 
                        <input type="hidden" name="vehicle_id" id="vehicle_id_puc_add" value="<?= $_POST['vehicle_id'] ?>/">
                        <input type="hidden" name="vehicle_no" id="vehicle_no_puc_add" value="">
                        <div class="col-md-9">
                            <h4 class="font-weight-bold">PUC Certificate</h4>
                            <div class="form-group Disasterphoto">
                                <label for="PhotoPuc<?= $_POST['vehicle_id'] ?>"><span>Upload Here</span> 
                                    <img src="<?php echo asset_url(); ?>images/upload.png" id="uploadBtn1">
                                </label> 
                                <input type="file" name="Puc" class="form-control-file imageUpload" id="PhotoPuc<?= $_POST['vehicle_id'] ?>">
                                <div class="messageContainer"></div> 
                            </div>
                        </div> 
                    </form> 

                    <!-- <div class="col-md-3">
                     <button type="button" class="add-vehicle-btn saveBtn marginTop30px" id="other-doc">Save</button>
                   </div> -->

                    <div class="clear:both;"></div>
                    <div class="col-md-12">
                        <table class="table border0px">

                            <tbody>
                                <?php if (!empty($documentList)) { ?>
                                    <?php $i = 0;
                                    foreach ($documentList as $value): ?>   
                                        <tr>
                                            <td>

                                                <?php
                                                if ($value['type'] == 3) {
                                                    $newstring = substr($value['url'], -3);
                                                    if ($newstring == 'pdf') {
                                                        ?>

                                                        <a href="<?php echo $value['url']; ?>" target="_blank">View PDF File 
                                                        </a>

                                                    <?php } else { ?>
                                                        <a href="" data-dismiss="modal" data-toggle="modal" data-target="#ViewImage">
                                                            <img src="<?php echo $value['url']; ?>" class="widthImg">
                                                             <span><?php echo $value['document_name']; ?>_PUC </span>
                                                        </a>
                                                    <?php } ?>  

                                                </td>
                                                    <?php if (!empty($value['url'])) { ?>
                                                    <td>
                                                        <img src="<?php echo asset_url(); ?>images/delete.png" id="Delete" data-id="<?php echo $value['id']; ?>" class="deleteIcon1 delete-puc">
                                                    </td> 
                                                    <?php } ?> 
                                                <td>

                                                    <form id="editPuc-<?php echo $value['id']; ?>" action="" method="POST" autocomplete="off" enctype="multipart/form-data"> 
                                                        <input type="hidden" name="puc_id" value="<?php echo $value['id']; ?>"> 
                                <input type="hidden" name="vehicle_id" id="vehicle_id_puc_edit" value="<?= $_POST['vehicle_id'] ?>">   

                                                        <?php if (!empty($value['url'])) { ?>
                                                            <label for="imageEditorPor-<?php echo $value['id']; ?>"> 
                                                                <img src="<?php echo asset_url(); ?>images/Artboard63.png" id="EditBtn" class="deleteIcon1">
                                                            </label>
                                                        <?php } ?>


                                                        <input type="file" name="Puc" class="form-control-file"  id="imageEditorPor-<?php echo $value['id']; ?>" style="display: none;"> 
                                                        <div class="messageContainer"></div>   
                                                    </form> 

                                                </td>

                                                <?php } ?>
                                    <script type="text/javascript">

                                       $('#editPuc-<?php echo $value['id']; ?>').bootstrapValidator({
                            container: function ($field, validator) {
                                return $field.parent().find('div.messageContainer');
                            },
                            feedbackIcons: {
                                validating: 'glyphicon glyphicon-refresh'
                            },
                            excluded: ':disabled',
                            fields: {

                                Puc: {
                                    validators: {
                                        notEmpty: {
                                            message: 'Please select an document.(ex.image/jpeg,image/png/pdf)'
                                        },
                                        file: {
                                            extension: 'jpeg,jpg,png,docx,pdf',
                                            type: 'image/jpeg,image/png,application/pdf',
                                            maxSize: 20971526565, // 2048 * 1024
                                            message: 'The selected file is not valid format.'
                                        }
                                    }
                                }

                            }
                        }).on('success.form.bv', function (event, data) {
                            alert(123)
                            // Prevent form submission
                            event.preventDefault();
                            EditPuc(<?php echo $value['id']; ?>);
                            alert(<?php echo $value['id']; ?>);
                        });

                          $(document).on('change', '#imageEditorPor3-<?php echo $value['id']; ?>', function () {

                            $('#editPuc-<?php echo $value['id']; ?>').trigger('submit');

                        });
                                        


                                    </script> 
                                    <?php $i++;
                                endforeach; ?> 
<?php } ?> 

                            </tr>

                            </tbody>
                        </table>
                    </div>





                </div>   
                    <script type="text/javascript">

                        $('#addRC-<?= $_POST['vehicle_id'] ?>').bootstrapValidator({
                            container: function ($field, validator) {
                                return $field.parent().find('div.messageContainer');
                            },
                            feedbackIcons: {
                                validating: 'glyphicon glyphicon-refresh'
                            },
                            excluded: ':disabled',
                            fields: {

                                register_certificate: {
                                    validators: {
                                        notEmpty: {
                                            message: 'Please select an document.(ex.image/jpeg,image/png/pdf)'
                                        },
                                        file: {
                                            extension: 'jpeg,jpg,png,docx,pdf',
                                            type: 'image/jpeg,image/png,application/pdf',
                                            maxSize: 20971526565, // 2048 * 1024
                                            message: 'The selected file is not valid format.'
                                        }
                                    }
                                }
                            }
                        }).on('success.form.bv', function (event, data) {
                            // Prevent form submission
                            event.preventDefault();
                            addVehicleRC();
                        });

                        function addVehicleRC() {
                            var options = {
                                target: '#response2',
                                beforeSubmit: showAddRequestRC,
                                success: showAddResponseRC,
                                url: base_url + 'add-vehicle-rc',
                                semantic: true,
                                dataType: 'json'
                            };
                            $('#addRC-<?= $_POST['vehicle_id'] ?>').ajaxSubmit(options);
                        }

                        function showAddRequestRC(formData, jqForm, options) {
                            $("#response2").hide();
                            ajaxindicatorstart("Please hang on.. while we adding register certificate ..");
                            var queryString = $.param(formData);
                            return true;
                        }

                        function showAddResponseRC(resp2, statusText, xhr, $form) {
                            ajaxindicatorstop();
                            //alert(resp.msg);

                            if (resp2.status == '0') {
                                swal('', resp2.msg, 'warning');
                                $("#response").removeClass('alert-success');
                                $("#response").addClass('alert-danger');
                                $("#response").html(resp2.msg);
                                $("#response").show();
                            } else {
                                swal('', resp2.msg, 'success');
                                $("#response").removeClass('alert-danger');
                                $("#response").addClass('alert-success');
                                $("#response").html(resp2.msg);
                                $("#response").show();
                                setTimeout(function () {
                                    window.location.href = base_url + "doc-wallet";
                                }, 2000);

                            }
                        }
                        function EditRC(id) {
                            var options = {
                                target: '#response3',
                                beforeSubmit: showAddRequestRC1,
                                success: showAddResponseRC1,
                                url: base_url + 'edit-rc',
                                semantic: true,
                                dataType: 'json'
                            };
                            $('#editRC-' + id).ajaxSubmit(options);
                        }

                        function showAddRequestRC1(formData, jqForm, options) {
                            $("#response3").hide();
                            ajaxindicatorstart("Please hang on.. while we editing RC ..");
                            var queryString = $.param(formData);
                            return true;
                        }

                        function showAddResponseRC1(resp3, statusText, xhr, $form) {
                            ajaxindicatorstop();
                            //alert(resp.msg);
                            if (resp3.status == '0') {
                                swal('', resp3.msg, 'warning');
                                $("#response3").removeClass('alert-success');
                                $("#response3").addClass('alert-danger');
                                $("#response3").html(resp3.msg);
                                $("#response3").show();
                            } else {
                                swal('', resp3.msg, 'success');
                                $("#response3").removeClass('alert-danger');
                                $("#response3").addClass('alert-success');
                                $("#response3").html(resp3.msg);
                                $("#response3").show();
                                setTimeout(function () {
                                    window.location.href = base_url + "doc-wallet";
                                }, 2000);

                            }
                        }




                        $('#addInsurance-<?= $_POST['vehicle_id'] ?>').bootstrapValidator({
                            container: function ($field, validator) {
                                return $field.parent().find('div.messageContainer');
                            },
                            feedbackIcons: {
                                validating: 'glyphicon glyphicon-refresh'
                            },
                            excluded: ':disabled',
                            fields: {

                                Insurance: {
                                    validators: {
                                        notEmpty: {
                                            message: 'Please select an document.(ex.image/jpeg,image/png/pdf)'
                                        },
                                        file: {
                                            extension: 'jpeg,jpg,png,docx,pdf',
                                            type: 'image/jpeg,image/png,application/pdf',
                                            maxSize: 20971526565, // 2048 * 1024
                                            message: 'The selected file is not valid format.'
                                        }
                                    }
                                }

                            }
                        }).on('success.form.bv', function (event, data) {
                            // Prevent form submission
                            event.preventDefault();
                            AddInsurance();

                        });

                        function AddInsurance() {
                            var options = {
                                target: '#response4',
                                beforeSubmit: showAddRequestInsurance,
                                success: showAddResponseInsurance,
                                url: base_url + 'add-insurance',
                                semantic: true,
                                dataType: 'json'
                            };
                            $('#addInsurance-<?= $_POST['vehicle_id'] ?>').ajaxSubmit(options);
                        }

                        function showAddRequestInsurance(formData, jqForm, options) {
                            $("#response4").hide();
                            ajaxindicatorstart("Please hang on.. while we adding Insurance ..");
                            var queryString = $.param(formData);
                            return true;
                        }

                        function showAddResponseInsurance(resp4, statusText, xhr, $form) {
                            ajaxindicatorstop();
                            //alert(resp.msg);
                            if (resp4.status == '0') {
                                swal('', resp4.msg, 'warning');
                                $("#response4").removeClass('alert-success');
                                $("#response4").addClass('alert-danger');
                                $("#response4").html(resp4.msg);
                                $("#response4").show();
                            } else {
                                swal('', resp4.msg, 'success');
                                $("#response4").removeClass('alert-danger');
                                $("#response4").addClass('alert-success');
                                $("#response4").html(resp4.msg);
                                $("#response4").show();
                                setTimeout(function () {
                                    window.location.href = base_url + "doc-wallet";
                                }, 2000);

                            }
                        }

                        function EditInsurance(id) {
                            var options = {
                                target: '#response5',
                                beforeSubmit: showAddRequestInsurance1,
                                success: showAddResponseInsurance1,
                                url: base_url + 'edit-insurance',
                                semantic: true,
                                dataType: 'json'
                            };
                            $('#editInsurance-' + id).ajaxSubmit(options);
                        }

                        function showAddRequestInsurance1(formData, jqForm, options) {
                            $("#response5").hide();
                            ajaxindicatorstart("Please hang on.. while we editing Insurance ..");
                            var queryString = $.param(formData);
                            return true;
                        }

                        function showAddResponseInsurance1(resp5, statusText, xhr, $form) {
                            ajaxindicatorstop();
                            //alert(resp.msg);
                            if (resp5.status == '0') {
                                swal('', resp5.msg, 'warning');
                                $("#response5").removeClass('alert-success');
                                $("#response5").addClass('alert-danger');
                                $("#response5").html(resp5.msg);
                                $("#response5").show();
                            } else {
                                swal('', resp5.msg, 'success');
                                $("#response5").removeClass('alert-danger');
                                $("#response5").addClass('alert-success');
                                $("#response5").html(resp5.msg);
                                $("#response5").show();
                                setTimeout(function () {
                                    window.location.href = base_url + "doc-wallet";
                                }, 2000);

                            }
                        }


                        $('#addPuc-<?= $_POST['vehicle_id'] ?>').bootstrapValidator({
                            container: function ($field, validator) {
                                return $field.parent().find('div.messageContainer');
                            },
                            feedbackIcons: {
                                validating: 'glyphicon glyphicon-refresh'
                            },
                            excluded: ':disabled',
                            fields: {

                                Puc: {
                                    validators: {
                                        notEmpty: {
                                            message: 'Please select an document.(ex.image/jpeg,image/png/pdf)'
                                        },
                                        file: {
                                            extension: 'jpeg,jpg,png,docx,pdf',
                                            type: 'image/jpeg,image/png,application/pdf',
                                            maxSize: 20971526565, // 2048 * 1024
                                            message: 'The selected file is not valid format.'
                                        }
                                    }
                                }

                            }
                        }).on('success.form.bv', function (event, data) {
                            // Prevent form submission
                            event.preventDefault();
                            addPuc(); 
                        });

                        function addPuc() {
                            var options = {
                                target: '#response5',
                                beforeSubmit: showAddRequestPuc,
                                success: showAddResponsePuc,
                                url: base_url + 'add-puc',
                                semantic: true,
                                dataType: 'json'
                            };
                            $('#addPuc-<?= $_POST['vehicle_id'] ?>').ajaxSubmit(options);
                        }

                        function showAddRequestPuc(formData, jqForm, options) {
                            $("#response5").hide();
                            ajaxindicatorstart("Please hang on.. while we adding PUC ..");
                            var queryString = $.param(formData);
                            return true;
                        }

                        function showAddResponsePuc(resp5, statusText, xhr, $form) {
                            ajaxindicatorstop();
                            //alert(resp.msg);
                            if (resp5.status == '0') {
                                swal('', resp5.msg, 'warning');
                                $("#response4").removeClass('alert-success');
                                $("#response4").addClass('alert-danger');
                                $("#response4").html(resp5.msg);
                                $("#response4").show();
                            } else {
                                swal('', resp5.msg, 'success');
                                $("#response4").removeClass('alert-danger');
                                $("#response4").addClass('alert-success');
                                $("#response4").html(resp5.msg);
                                $("#response4").show();
                                setTimeout(function () {
                                    window.location.href = base_url + "doc-wallet";
                                }, 2000);

                            }
                        }

                     
                        function EditPuc(id) {
                            var options = {
                                target: '#response6',
                                beforeSubmit: showAddRequestPuc1,
                                success: showAddResponsePuc1,
                                url: base_url + 'edit-puc',
                                semantic: true,
                                dataType: 'json'
                            };
                            $('#editPuc-'+id).ajaxSubmit(options);
                        }

                        function showAddRequestPuc1(formData, jqForm, options) {
                            $("#response6").hide();
                            ajaxindicatorstart("Please hang on.. while we editing PUC ..");
                            var queryString = $.param(formData);
                            return true;
                        }

                        function showAddResponsePuc1(resp6, statusText, xhr, $form) {
                            ajaxindicatorstop();
                            //alert(resp.msg);
                            if (resp6.status == '0') {
                                swal('', resp6.msg, 'warning');
                                $("#response6").removeClass('alert-success');
                                $("#response6").addClass('alert-danger');
                                $("#response6").html(resp6.msg);
                                $("#response6").show();
                            } else {
                                swal('', resp6.msg, 'success');
                                $("#response6").removeClass('alert-danger');
                                $("#response6").addClass('alert-success');
                                $("#response6").html(resp6.msg);
                                $("#response6").show();
                                setTimeout(function () {
                                    window.location.href = base_url + "doc-wallet";
                                }, 2000);

                            }
                        }


                        $(document).on('change', '#Photo<?= $_POST['vehicle_id'] ?>', function () {

                            $('#addRC-<?= $_POST['vehicle_id'] ?>').trigger('submit');

                        });



                        $(document).on('change', '#PhotoInsurance<?= $_POST['vehicle_id'] ?>', function () {

                            $('#addInsurance-<?= $_POST['vehicle_id'] ?>').trigger('submit');

                        });



                        $(document).on('change', '#PhotoPuc<?= $_POST['vehicle_id'] ?>', function () {

                            $('#addPuc-<?= $_POST['vehicle_id'] ?>').trigger('submit');

                        }); 


                        $(document).on("click", ".delete-rc", function () {
                            var Id = $(this).data('id');
                            //debugger;
                            // alert(Id);
                            if (Id != '') {
                                $.post(base_url + "delete_rc_by_id", {Id: Id}, function (data) {
                                    console.log(data);
                                    if (data.status == 1) {
                                        //   ajaxindicatorstop();
                                        $("#up_response").show();
                                        $("#up_response").html(data.msg);
                                        swal("RC deleted successfully.", {button: "continue", timer: 2000})
                                                .then((value) => {
                                                    location.reload();
                                                });

                                    } else {
                                        //ajaxindicatorstop();
                                        $("#up_response").show();
                                        $("#up_response").html(data.msg);
                                    }


                                }, 'json');
                            }

                        });

                        $(document).on("click", ".delete-insurance", function () {
                            var Id = $(this).data('id');
                            //debugger;
                            alert(Id);
                            if (Id != '') {
                                $.post(base_url + "delete_insurance_by_id", {Id: Id}, function (data) {
                                    console.log(data);
                                    if (data.status == 1) {
                                        //   ajaxindicatorstop();
                                        $("#up_response").show();
                                        $("#up_response").html(data.msg);
                                        swal("Insurance deleted successfully.", {button: "continue", timer: 2000})
                                                .then((value) => {
                                                    location.reload();
                                                });

                                    } else {
                                        //ajaxindicatorstop();
                                        $("#up_response").show();
                                        $("#up_response").html(data.msg);
                                    }


                                }, 'json');
                            }

                        });

                        $(document).on("click", ".delete-puc", function () {
                            var Id = $(this).data('id');
                            //debugger;
                            alert(Id);
                            if (Id != '') {
                                $.post(base_url + "delete_puc_by_id", {Id: Id}, function (data) {
                                    console.log(data);
                                    if (data.status == 1) {
                                        //   ajaxindicatorstop();
                                        $("#up_response").show();
                                        $("#up_response").html(data.msg);
                                        swal("PUC deleted successfully.", {button: "continue", timer: 2000})
                                                .then((value) => {
                                                    location.reload();
                                                });

                                    } else {
                                        //ajaxindicatorstop();
                                        $("#up_response").show();
                                        $("#up_response").html(data.msg);
                                    }


                                }, 'json');
                            }

                        });

                    </script>                 


