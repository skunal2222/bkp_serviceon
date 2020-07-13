 
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
    width: 100%;
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
  padding-right: 18px;
  margin-top: 36px;
  cursor: pointer;
  margin-left: -70px;
}

.deleteIcon1{
width: 35px;
    padding-right: 18px;
    margin-top: -9px;
    cursor: pointer;
    margin-left: -119px;
}

.border0px tr td:nth-child(2), .border0px tr td:nth-child(3){
  text-align: right;
}
.folderTable tr td{
  text-align: center;
}
.font-weight-bold{
  font-weight: bold !important;
}
.form-group.Disasterphoto{
  margin-bottom: 0px;
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
.marginTop30px{
  margin-top: 30px;
}
.otherDocBtn{
    width: 50px;
    margin-right: 20px;
}
.basic-info h2{
  padding-left: 15px !important;
  padding-right: 15px;
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
           <!-- Account Settings -->
              <div class="account">
                  <div class="basic-info">
                      <h2>Doc Collection </h2>
                      <div class="container">
                        <div class="account-modal"> 
                         <form id="editlicense-<?php echo $userList[0]['id'];?>" action="" method="POST" autocomplete="off" enctype="multipart/form-data">        
                              <div class="row"> 
                                   <div class="col-md-6"> 
                                     <!--  <div class="text-center">
                                      <button type="button" class="add-vehicle-btn dl-btn" id="add-dl" data-toggle="modal" data-target="#add-dl">+ Driving License </button> 
                                      </div> -->
                                      <div class="form-group">                           
                                        <div class="text-left">

                                          <?php 
                                      if(!empty($userList[0]['license_url'])){?> 

                                        <?php
                                   
                                   $newstring = substr($userList[0]['license_url'], -3);
                                   if ($newstring == 'pdf') { ?>
                                     <img src="<?php echo asset_url();?>images/pdficon.png" class="pdficon">
                                    <a href="<?php echo $userList[0]['license_url'];?>" target="_blank">View PDF File 
                                    </a> <br>
                                    <span><?php echo $userList[0]['name'];?>_License</span>
                                     <td>
                               		 	<img src="<?php echo asset_url();?>images/delete.png" id="Delete" data-id="<?php echo $userList[0]['id'];?>" class="deleteIcon delete-license">
                            		</td>

                            		<label for="imageEditorDL<?php echo $userList[0]['id'];?>"> 
                                  <img src="<?php echo asset_url();?>images/Artboard63.png" id="EditBtn" class="deleteIcon">
                                  </label>

                                <?php } else { ?>
                                
                                <a href=""  data-target="#ViewImage" data-toggle="modal">
                                  <img src="<?php echo $userList[0]['license_url'];?>" class="widthImg" width="139px">   <br>
                                  <span><?php echo $userList[0]['name'];?>_License</span>
                                </a>


                                	<?php if(!empty($userList[0]['license_url'])) {?>
                            <td>
                                <img src="<?php echo asset_url();?>images/delete.png" id="Delete" data-id="<?php echo $userList[0]['id'];?>" class="deleteIcon delete-license">
                            </td> 
                              <?php } ?> 



                              <?php if(!empty($userList[0]['license_url'])) {?>
                                  <label for="imageEditorDL<?php echo $userList[0]['id'];?>"> 
                                  <img src="<?php echo asset_url();?>images/Artboard63.png" id="EditBtn" class="deleteIcon">
                                  </label>
                                   <?php } ?>




                                <?php } ?>




                                 


                      
                              <input type="hidden" name="license_id" value="<?php echo $userList[0]['id'];?>"> 
                                
                                   


                                  <input type="file" name="licensefile" class="form-control-file"  id="imageEditorDL<?php echo $userList[0]['id'];?>" style="display: none;" accept="image/*"> 
                                  <div class="messageContainer"></div>   
                    
                               
                       <script>    


                          $('#editlicense-<?php echo $userList[0]['id'];?>').bootstrapValidator({
                            container: function ($field, validator) {
                                return $field.parent().find('div.messageContainer');
                            },
                            feedbackIcons: {
                                validating: 'glyphicon glyphicon-refresh'
                            },
                            excluded: ':disabled',
                            fields: {  
                                
                                licensefile : {
                                    validators: {
                                        notEmpty: {
                                            message: 'Please select an document.(ex.image/jpeg,image/png/pdf)'
                                        },
                                        file: {
                                            extension: 'jpeg,jpg,png,docx,pdf',
                                            type: 'image/jpeg,image/png,application/pdf',
                                            maxSize: 20971526565,   // 2048 * 1024
                                            message: 'The selected file is not valid format.'
                                        }
                                    }
                                }

                            }
                        }).on('success.form.bv', function (event, data) {
                            // Prevent form submission
                            event.preventDefault();
                            EditLicense(<?php echo $userList[0]['id'];?>); 
                            //alert(<?php echo $userList[0]['id'];?>);
                        }); 


                        $(document).on('change', '#imageEditorDL<?php echo $userList[0]['id'];?>', function () {
                          $('#editlicense-<?php echo $userList[0]['id'];?>').trigger('submit');

                        }); 





                      </script>            
                           <?php  } else { ?>


                                          <a href="" data-target="#my_modal" data-toggle="modal" >  <button type="button" class="add-vehicle-btn dl-btn" id="licence-doc">Driving Licence </button> </a>


                                  <?php } ?>

                                        </div>                                         
                                      </div>

                                  </div>
                                  <div class="col-md-6">  
                                    
                                   	<div class="text-right">
                                   <a href="<?php echo base_url();?>other-doc">	
                                    <!-- <button type="button" class="add-vehicle-btn dl-btn" id="other-doc"></button> -->
                                    <img src="<?php echo asset_url();?>images/folder.png" class="widthImg">
                                      <div>+ Other Docs </div>

                                     </a>
                                   
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>
                                   <h2>Vehicle Doc </h2>
                                  <div class="col-md-12">

                                     <table class="table folderTable">
                            
                                        <tbody> 

                                          <tr>
                                          	<?php 
				                              if(!empty($vehicalList)){?>
				                           <?php $i= 0; foreach ($vehicalList as $value):
				                            
				                           	if($i % 4 == 0){ 	
				                           		echo "</tr><tr>";

				                           	}
				                           ?>

                                            <td>
                                              <a href="javascript:void(0)" class="open-Dialog" data-id="<?php echo $value['id'];?>" data-number="<?php echo str_replace(" ", "-",$value['vehicle_no']);?>">
                                                <img src="<?php echo asset_url();?>images/folder.png" class="widthImg">
                                                <p class="folderNameTitel"><?php echo $value['vehicle_no'];?></p>
                                              </a>
                                            </td>
                                             <?php $i++; endforeach;?> </tr> 
						       							 <?php  } else{?>
															<tr><td colspan="4">No Folder Found.</td></tr>
														<?php }?>
                                         

                                         
                                        </tbody>
                                      </table>
                                  </div>  

                              </div>  
                              <style type="text/css">
                                  .vehicleList .col-md-4{
                                      height: 50px;
                                  }
                              </style>
                             
                             
                          </form>
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

<div class="modal fade" id="my_modal" role="dialog">
    <div class="modal-dialog add-new-add select-vehicle account-modal">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="text-center">Driving License</h4>
            </div>
            <div class="modal-body"> 
              <div class="row">
              	<form id="addlicense" action="" method="POST" autocomplete="off" enctype="multipart/form-data"> 
               <?php if(empty($userList[0]['license_url'])){?>
                <div class="col-md-9">
                <div class="form-group Disasterphoto">
                    <label for="Photo"><span>Upload Here</span>  

                      <img src="<?php echo asset_url();?>images/upload.png" id="uploadBtn"> 

                    </label> 
                    <input type="file" name="licensefiles"  accept="image/gif, image/jpeg, application/pdf" class="form-control-file imageUpload" id="Photo" data-bv-field="photos[]"> 
                    <div class="messageContainer"></div>
                 </div>
                 
                 </div> 

             <?php } ?>

                 <div class="col-md-3">  
                 </div>
                </form> 

                 <div class="clear:both;"></div>
                   <div class="col-md-12">
                    <table class="table border0px">        
                    </table>
                  </div> 
                  
                </div>
            </div>
        </div>
    </div>
</div>
<!-- add vehicle modal ends --> 


<div class="modal fade" id="ViewImage" role="dialog">
    <div class="modal-dialog add-new-add select-vehicle account-modal">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <!-- <h4 class="text-center">Edit Vehicle</h4> -->
            </div>
            <div class="modal-body"> 
                 <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                      <!-- <li data-target="#myCarousel" data-slide-to="1"></li>
                      <li data-target="#myCarousel" data-slide-to="2"></li> -->
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">

                      <div class="item active">
                        <img src="<?php echo $userList[0]['license_url'];?>" alt="Los Angeles" style="width:100%;">
                       
                      </div>
                  
                    </div>

                    <!-- Left and right controls -->
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

<div id="nmnm"></div>
<script type="text/javascript" > 

  $(document).ready(function(){
    // $('#add-dl').on('hidden.bs.modal', function () {
    //   // Load up a new modal...
    //   $('#ViewImage').modal('show')
    // })

  })

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
 

 $('#addlicense').bootstrapValidator({
        container: function ($field, validator) {
            return $field.parent().find('div.messageContainer');
        },
        feedbackIcons: {
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {  
            
         licensefiles : {
		            validators: {
		                notEmpty: {
		                    message: 'Please select an document.(ex.image/jpeg,image/png/pdf)'
		                },
		                file: {
		                    extension: 'jpeg,jpg,png,docx,pdf',
		                    type: 'image/jpeg,image/png,application/pdf',
		                    maxSize: 20971526565,   // 2048 * 1024
		                    message: 'The selected file is not valid format.'
		                }
		            }
		        }
        }
    }).on('success.form.bv', function (event, data) {
        // Prevent form submission
        event.preventDefault();
        addUserDl();
    }); 

    function addUserDl() { 
        var options = {
            target: '#response',
            beforeSubmit: showAddRequest,
            success: showAddResponse,
            url: base_url + 'add-license',
            semantic: true,
            dataType: 'json'
        };
        $('#addlicense').ajaxSubmit(options);
    }

    function showAddRequest(formData, jqForm, options) {
        $("#response").hide();
        ajaxindicatorstart("Please hang on.. while we adding license ..");
        var queryString = $.param(formData);
        return true;
    }

    function showAddResponse(resp, statusText, xhr, $form) {
        ajaxindicatorstop();
        //alert(resp.msg);
        
        if (resp.status == '0') {
            swal('',resp.msg,'warning');
            $("#response").removeClass('alert-success');
            $("#response").addClass('alert-danger');
            $("#response").html(resp.msg);
            $("#response").show();
        } else {
            swal('',resp.msg,'success');
            $("#response").removeClass('alert-danger');
            $("#response").addClass('alert-success');
            $("#response").html(resp.msg);
            $("#response").show(); 
            setTimeout(function() {
           	 window.location.href = base_url + "doc-wallet";
           }, 2000);
            
        }
    } 


    $(document).on("click", ".delete-license", function () {
     var Id = $(this).data('id'); 
  //debugger;
 	//alert(Id);
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
           
             $.post(base_url + "delete_license_by_id", { Id: Id  }, function (data) {  
                    console.log(data); 
                  if(data.status == 1 ) {
             //   ajaxindicatorstop();
                     $("#up_response").show();
                     $("#up_response").html(data.msg);
                    swal("License deleted successfully.",{button: "continue",timer: 2000})
                    .then((value) => {
                        location.reload(); 
                    });
            
                } else {
                    //ajaxindicatorstop();
                    $("#up_response").show();
                    $("#up_response").html(data.msg);
                }  
            },'json');

        } else { 
                location.reload(); 
              }
            },'json');   

        }
      });

 
    function EditLicense(id) { 
        
        var options = {
            target: '#response1',
            beforeSubmit: customFunctionReq,
            success: customFunctionResp,
            url: base_url + 'edit-license',
            semantic: true,
            dataType: 'json'
        };
        
        $('#editlicense-'+id).ajaxSubmit(options);
    }

    function customFunctionReq(formData, jqForm, options) {
        
        $("#response1").hide();
        ajaxindicatorstart("Please hang on.. while we editing license ..");
        var queryString = $.param(formData);
        return true;
    }

    function customFunctionResp(resp1, statusText, xhr, $form) {
        ajaxindicatorstop();
        //alert(resp.msg);
        if (resp1.status == '0') {
            swal('',resp1.msg,'warning');
            $("#response1").removeClass('alert-success');
            $("#response1").addClass('alert-danger');
            $("#response1").html(resp1.msg);
            $("#response1").show();
        } else {
            swal('',resp1.msg,'success');
            $("#response1").removeClass('alert-danger');
            $("#response1").addClass('alert-success');
            $("#response1").html(resp1.msg);
            $("#response1").show(); 
            setTimeout(function() {
             window.location.href = base_url + "doc-wallet";
           }, 2000);
            
        }
    }  
 

$(document).on("click", ".open-Dialog", function () {
     var Id = $(this).data('id'); 
     var number = $(this).data('number');
  //debugger;
  //alert(Id);
     if (Id != '') {
                       window.location.href = base_url + number+"/" + Id ;
                                
            }

}); 


$(document).on('change', '#Photo', function () {

	$('#addlicense').trigger('submit'); 

});	
 
</script>