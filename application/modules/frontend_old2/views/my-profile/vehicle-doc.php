<style type="text/css">
   .danger{
   color: red;
   }
   .dl-btn {
   font-size: 18px;
   font-weight: 500;
   font-style: normal;
   font-stretch: normal;
   line-height: 1.5;
   width: 207px;
   letter-spacing: 0.6px;
   text-align: center;
   border: none;
   border-radius: 28px;
   margin: 5% 0%;
   padding: 7px 20px !important;
   color: #fff !important;
   background-color: #ec3237;
   } 
   .Disasterphoto label {
   font-weight: 300;
   font-style: normal;
   font-stretch: normal;
   letter-spacing: 0.2px;
   text-align: left;
   color: #616261;
   border-top: 0px;
   border-left: 0px;
   border-right: 0px;
   border-bottom: 1px solid #adacad;
   border-radius: 0px;
   padding-left: 0px;
   width: 60%;
   height: 37px;
   line-height: 37px;
   }
   .Disasterphoto input {
   display: none;
   }
   .Disasterphoto label img {
   float: right;
   padding-right: 10px;
   padding-top: 10px;
   width: 30px;
   }
   .border0px tbody tr td{
   border:0px;
   vertical-align: middle;
   }
   .widthImg{
   width: 100px;
   }
   .deleteIcon{
   width: 35px;
   padding-right: 15px;
   margin-top: 45px;
   cursor: pointer;
   }
   .addRecordImg{
   width: 40px;
   height: 40px;
   margin-top: 30px;
   }
   #ViewImage .modal-dialog{
   width: 800px;
   }
   .Disasterphoto label span{
   float: left;
   padding-right: 10px;
   padding-top: 15px;
   }
   .saveBtn{
   font-size: 18px;
   font-weight: 500;
   font-style: normal;
   font-stretch: normal;
   line-height: 1.5;
   /* width: 207px; */
   letter-spacing: 0.6px;
   text-align: center;
   border: none;
   border-radius: 28px;
   margin: 5% 0%;
   padding: 5px 20px !important;
   color: #fff !important;
   background-color: #ec3237;
   }
   .iconImg{
   width: 20px;
   }
   .vAlineM tr td{
   vertical-align: middle !important;
   }
   .uploadFile input{
   border-top: 0px;
   border-left: 0px;
   border-right: 0px;
   border-bottom: 1px solid #adacad !important;
   width: 100%;
   height: 37px;
   font-size: 1em;
   line-height: 1;
   letter-spacing: 0.5px;
   text-align: left;
   margin: 30px 0px 0px;
   color: #515151;
   padding: 0px 40px 0px 15px;
   }
   .uploadFile input:focus, .uploadFile input:active{
   border-bottom: 1px solid #adacad !important;  
   }
   .uploadFile #uploadBtn{
      position: absolute;
      top: 35px;
      right: 15px;
   }
   .basic-info h2{
     padding-left: 15px !important;
     padding-right: 15px;
   }
   .deleteIcon{
      margin-top:0px;
   }
   .labelM{
      margin-top: 0px !important;
   }
   .table.vAlineM tr td:nth-child(2), .table.vAlineM tr td:nth-child(3){
      width: 100px;
   }
   
   .table.vAlineM tr td{
      padding: 15px 8px;
   }
   .pdficon{
  height: 50px;
  width: 50px;
   }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/my-profile/common.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/booking-flow/selectize.bootstrap3.css">
<script type="text/javascript" src="<?php echo asset_url();?>js/selectize.min.js"></script> 
<div class="my-pofile">
   <div class="container">
      <div class="banner-section">  
      </div>
      <div class="profile row">
         <div class="col-md-3 col-sm-4">
            <div class="profile-navigation" id="profile-navigation">
               <ul>
                  <li>
                     <a href="<?php echo base_url();?>ongoing-orders">
                     Ongoing Order
                     </a>
                  </li>
                  <li>
                     <a href="<?php echo base_url();?>order-history">
                     Order History
                     </a>
                  </li>
                  <li>
                     <a href="<?php echo base_url();?>basic-info">
                     Basic Info
                     </a>
                  </li>
                  <li>
                     <a href="<?php echo base_url();?>refer-n-earn">
                     Refer and Earn
                     </a>
                  </li>
                  <li>
                     <a href="<?php echo base_url();?>wallet">
                     My Wallet
                     </a>
                  </li>
                  <li class="active">
                     <a href="<?php echo base_url();?>doc-wallet">
                        Doc Wallet
                     </a>
                     </li>
                  <li>
                     <a href="<?php echo base_url();?>notifications">
                     Notifications
                     </a>
                  </li>
                  <li>
                     <a href="<?php echo base_url();?>my-packages">
                     My Packages
                     </a>
                  </li>
               </ul>
            </div>
         </div>
         <div class="col-md-9 col-sm-8">
            <div class="detail-section">
               <style type="text/css">
               </style>
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item active" aria-current="page">
                        <i class="fa fa-folder" aria-hidden="true"></i>
                        <?php echo $folder;?>
                     </li>
                  </ol>
               </nav>
               <!-- Account Settings -->
               <div class="account">
                  <div class="basic-info">
                     <h2>Vehicle -  <?php if(isset($vehicalList[0]['vehicle_no'])) echo $vehicalList[0]['vehicle_no'];?> Documents</h2>
                     <div class="container">
                        <div class="account-modal" id="accountmodal1">
                           <div class="row">
                              <form id="addRC-<?php if(isset($vehicalList[0]['id'])) echo $vehicalList[0]['id'];?>" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                                 <input type="hidden" name="vehicle_id" value="<?php if(isset($vehicalList[0]['id'])) echo $vehicalList[0]['id'];?>">
                                 <input type="hidden" name="vehicle_no" id="vehicle_no" value="<?php if(isset($vehicalList[0]['vehicle_no'])) echo $vehicalList[0]['vehicle_no'];?>">
                                 <div class="col-md-9">
                                    <h4 class="font-weight-bold">Document Type</h4>
                                    <div class="form-group">
                                       <!-- <label><span>Select Document Type:</span></label>  -->
                                       <input type="radio" name="document_type" value="1"> RC BOOK
                                       <input type="radio" name="document_type" value="2"> INSURANCE
                                       <input type="radio" name="document_type" value="3"> PUC<br/>
                                       <div class="messageContainer"></div>
                                    </div>
                                    <div class="form-group Disasterphoto">
                                       <label for="Photo<?php if(isset($vehicalList[0]['id'])) echo $vehicalList[0]['id'];?>"><span>Upload Here</span> 
                                       <img src="<?php echo asset_url(); ?>images/upload.png" id="uploadBtn1">
                                       </label> 
                                       <input type="file" name="register_certificate" class="form-control-file imageUpload" id="Photo<?php if(isset($vehicalList[0]['id'])) echo $vehicalList[0]['id'];?>">
                                       <div class="messageContainer"></div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="text-left"><button type="submit" class="add-vehicle-btn saveBtn" id="other-doc">Upload</button>
                                    </div>
                                 </div>
                              </form>
                              <div style="clear: both;"></div>

                              <div class="col-md-12">
                                 <table class="table vAlineM">
                                    <tbody>
                                      <tr><td>Your Documents</td></tr>
                                       <?php 
                                          if(!empty($documentList)){ 
                                          
                                            ?>
                                       <?php $i= 0; foreach ($documentList as $value): ?>
                                      
                                       <tr>
                                          <td>
                                             <?php   $newstring = substr($value['url'], -3);
                                                if ($newstring == 'pdf') { ?>

                                           <img src="<?php echo asset_url();?>images/pdficon.png" class="pdficon">    
                                             <a href="<?php echo $value['url'];?>" target="_blank">View PDF File 
                                             </a>
                                             <?php  } else    { ?>
                                             <a href="" class="open-Images" data-toggle="modal" data-id="<?php echo $value['id'];?>" data-target="#ViewImage" >
                                             <img src="<?php echo $value['url'];?>" class="widthImg"> <br>
                                             </a>
                                             <?php } ?> 
                                             <br>
                                             <span id="span_<?= $value['id'];?>"><?php echo $value['document_name']; ?></span> 
                                             <input type="text" id="document_name_<?= $value['id'];?>" name="document_name" value="<?php echo $value['document_name'];?>" style="display: none;">
                                             <i class="fa fa-edit" id="edit_<?= $value['id'];?>" onclick="updateName(<?= $value['id'];?>);"></i>
                                             <input type="button" id="update_<?= $value['id'];?>" name="update" value="update" class="btn btn-primary" style="display: none;" onclick="updateDocumentName(<?= $value['id'];?>)">
                                          </td>
                                          <?php if(!empty($value['url'])) {?>
                                          <td>
                                             <img src="<?php echo asset_url();?>images/delete.png" id="Delete" data-id="<?php echo $value['id'];?>" class="deleteIcon delete-rc">
                                          </td>
                                          <?php } ?> 
                                          <td>
                                             <form id="editRC-<?php echo $value['id'];?>" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                                                <input type="hidden" name="rc_id" value="<?php echo $value['id']; ?>"> 
                                                <input type="hidden" name="vehicle_id" value="<?php if(isset($vehicalList[0]['id'])) echo $vehicalList[0]['id'];?>"> 
                                                <?php if(!empty($value['url'])) {?>
                                                <label for="imageEditorPor-<?php echo $value['id'];?>" class="labelM"> 
                                                <img src="<?php echo asset_url();?>images/Artboard63.png" id="EditBtn" class="deleteIcon">
                                                </label>
                                                <?php } ?>
                                                <input type="file" name="otherfiles" class="form-control-file"  id="imageEditorPor-<?php echo $value['id'];?>" style="display: none;"> 
                                                <div class="messageContainer"></div>
                                             </form>
                                          </td>
                                    
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
                                       </tr>
                                       <?php $i++; endforeach;?> 
                                       <?php } ?>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Account Settings ends -->
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="ViewImage" role="dialog">
   <div class="modal-dialog add-new-add select-vehicle account-modal">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <!-- <h4 class="text-center">Edit Vehicle</h4> -->
         </div>
         <div class="modal-body" id="image-modal-body"> 
              <div id="myCarousel" class="carousel slide" data-ride="carousel">                    <!-- Indicators -->
                <ol class="carousel-indicators">
                  <?php $i = 1;foreach($documentList as $key => $image){ ?> 
                      <?php   $newstring = substr($image['url'], -3);
                           if ($newstring != 'pdf') { ?> 
                    <?php if($i == 1){?>
                        <li data-target="#myCarousel" data-slide-to="<?php echo $key;?>" class="active"></li>
                    <?php }else{?>
                        <li data-target="#myCarousel" data-slide-to="<?php echo $key;?>"></li>
                    <?php }?>
                  <?php $i++;}?>
               <?php } ?>
                </ol>
                <div class="carousel-inner">
                  <?php $i = 1;foreach($documentList as $key => $image){?>
                     <?php   $newstring = substr($image['url'], -3);
                           if ($newstring != 'pdf') { ?> 
                    <?php if($i == 1){?>
                    <div class="item active" id="image">
                      <img src="<?php echo $image['url'];?>" alt="Los Angeles" style="width:100%;">
                    </div>
                    <?php }else{?>
                    <div class="item">
                      <img src="<?php echo $image['url'];?>" alt="Los Angeles" style="width:100%;">
                    </div>
                    <?php }?>
                  <?php $i++;}?> 
               <?php } ?>
              </div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
         </div>
      </div>
   </div>
</div>
<!-- add vehicle modal ends -->  
<script type="text/javascript">  
   window.onscroll = function() {myFunction()};
   
   var navbar = document.getElementById("profile-navigation");
   var sticky = navbar.offsetTop;
   
   function myFunction() {
     if (window.pageYOffset >= sticky && window.pageYOffset <= 600) { 
       navbar.classList.add("sticky")
     } else {
       navbar.classList.remove("sticky");
     }
   }
   
     $('#addRC-<?php if(isset($vehicalList[0]['id'])) echo $vehicalList[0]['id'];?>').bootstrapValidator({
     container: function ($field, validator) {
         return $field.parent().find('div.messageContainer');
     },
     feedbackIcons: {
         validating: 'glyphicon glyphicon-refresh'
     },
     excluded: ':disabled',
     fields: {
         document_type: {
           validators:{
             notEmpty:{
                 message: 'Please select document type'
             }
           }
         },
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
     $('#addRC-<?php if(isset($vehicalList[0]['id'])) echo $vehicalList[0]['id'];?>').ajaxSubmit(options);
   }
   
   function showAddRequestRC(formData, jqForm, options) {
     $("#response2").hide();
     ajaxindicatorstart("Please hang on.. while we adding document..");
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
   
          setTimeout(function() {
                window.location.reload();
              }, 2000);
   
     }
   }
    
   /*   $(document).on('change', '#Photo<?php if(isset($vehicalList[0]['id'])) echo $vehicalList[0]['id'];?>', function () {
   
         $('#addRC-<?php if(isset($vehicalList[0]['id'])) echo $vehicalList[0]['id'];?>').trigger('submit');
   
     });*/
   
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
                               ajaxindicatorstart("Please hang on.. while we editing document ..");
                               var queryString = $.param(formData);
                               return true;
                           }
   
                           function showAddResponseRC1(resp3, statusText, xhr, $form) {
                               ajaxindicatorstop();
                              // alert(resp3.msg);
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
                               }
                              // window.location.reload();
                              setTimeout(function() {
                                  window.location.reload();
                                }, 2000);
                           }
   
    
    $(document).on("click", ".delete-rc", function () {
         var Id = $(this).data('id');
         //debugger;
         // alert(Id);
         if (Id != '') {

            swal({
              title: "Are you sure want to delete ?",
              icon: "warning",
              buttons: true,
              dangerMode: true,  
              buttons: [ 'No', 'Yes' ]
            })

            .then((willDelete) => {
              if (willDelete) {

                   $.post(base_url + "delete_rc_by_id", {Id: Id}, function (data) {
                       console.log(data);
                       if (data.status == 1) {
                           //   ajaxindicatorstop();
                           $("#up_response").show();
                           $("#up_response").html(data.msg);
                           swal("Document deleted successfully.", {button: "continue", timer: 2000})
                                   .then((value) => {
                                       location.reload();
                                   });
         
                       } else {
                           //ajaxindicatorstop();
                           $("#up_response").show();
                           $("#up_response").html(data.msg);
                       }
         
         
                   }, 'json');
                } else { 
                      location.reload(); 
                    } 
            },'json');   
     
         }
   
     });
   
   
   
   /*$(document).on("click", ".open-Images", function () {
        var Id = $(this).data('id'); 
     //debugger;
     //alert(Id);
        if (Id != '') {
                   $.post(base_url + "get_vehicle_all_doc", {
                       Id: Id
   
                   }, function (data) {  
                   
                   $('#image-modal-body').html(data.html);
                   }, 'json');
               }
   
   });*/
   
  function updateName(id){
    $("#document_name_"+id).css('display','block');
    $("#update_"+id).css('display','block');
    $("#span_"+id).css('display','none');
    $("#edit_"+id).css('display','none');
  }

  function updateDocumentName(id){
      $.post(base_url + "rename/document", {Id: id,name: $("#document_name_"+id).val()}, function (data) {
        alert(data.msg);
        window.location.reload();
      }, 'json');
  }
   


$('#Photo<?php if(isset($vehicalList[0]['id'])) echo $vehicalList[0]['id'];?>').change(function () {
    var filePath=$(this).val();
    var result = filePath.substring(filePath.lastIndexOf("/") + 1);
    
    $('.Disasterphoto').find('span').text(result);
});

</script>