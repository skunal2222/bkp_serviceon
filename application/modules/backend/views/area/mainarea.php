<link type="text/css" rel="stylesheet" href="<?php echo asset_url();?>css/datepicker3.css">



<link type="text/css" rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap-timepicker.min.css">



<div id="page-wrapper">



            <div class="container-fluid">



                <div class="row bg-title">



                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">



                        <h4 class="page-title">City</h4> </div>



                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">



                        <ol class="breadcrumb">



                            <li><a href="#">Dashboard</a></li>



                            <li class="active">City</li>



                        </ol>



                    </div>



                    <!-- /.col-lg-12 -->



                </div>



                <!-- /.row -->



                <div class="row">



                    <div class="col-md-12">



                        <div class="panel panel-info">



                          <!--   <div class="panel-heading"> 



                         Category



                            </div>-->



                            <div class="panel-wrapper collapse in" aria-expanded="true">



                                <div class="panel-body">



                                        <div class="form-body">



                                               <ul class="nav customtab nav-tabs" role="tablist">



				                                <li role="presentation" class="nav-item"><a href="#basic" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">City</span></a></li>

 

				                               </ul>



                                          	<div class="tab-content">



		  										<div id="basic"  role="tabpanel" class="tab-pane fade in active show"  aria-expanded="true" >  



													<div id="">



														 	<div class="row">



																<div class="col-lg-12">



																	<div class="btn-plus">



																	<a href="javascript: add();" class="btn btn-primary view-contacts bottom-margin" style="color:white;">



																		<i class="fa fa-plus"></i>City



																	</a>



																	</div>



														        	<div class="panel panel-default">



														            	<div class="panel-heading">



														                	City List



														              	</div>



														               	<div class="panel-body">



														                	<div class="dataTable_wrapper">



														                       	<table class="table table-striped table-bordered table-hover" id="tblcity">



																					<thead class="bg-info">



																						<tr>



																							<th>Sr No</th>



																							<th>Name</th>

																							<th>Status</th>

														     								<th>Action</th>



																						</tr>



																					</thead>



																					<tbody>



																					<?php if (isset($cities)) { ?>



																					<?php foreach ($cities as $item):?>



																						<tr>



																							<td>



																								<?php echo $item['id'];?>



																							</td>



																						

																							<td>



																								<?php echo $item['name'];?>



																							</td>

																								<td>



																								 <?php if($item['status'] == 1) {?>
																		                                 Active
																		                                 <?php }else{?>
																		                                 In-active
																		                                 <?php }?>



																							</td>



																							<td><a href = "javascript: edit(<?php echo $item['id']?>);" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil" style="color:white;"></i></a></td>



																						</tr>



																						<?php endforeach;?>



																					<?php } else { ?>



																						<tr><td colspan="4">Records not found.</td></tr>



																					<?php }?>



																					</tbody>



																				</table>



																			</div>



																		</div>



																	</div>



																	<a href="javascript: add();" class="btn btn-primary view-contacts bottom-margin" style="color:white;">



																		<i class="fa fa-plus"></i> City



																	</a>



																</div>



															</div>



														</div> 


                                               		 </div>  

                                             </div> 


	                                        </div> 
                                </div>



                            </div>



                        </div>



                    </div>



                </div>



            </div>



            



            <!-- /.container-fluid -->



        </div>



        <script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>



		<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>



		<script src="<?php echo asset_url();?>js/bootstrap-timepicker.min.js"></script>



		<script src="<?php echo asset_url();?>js/selectize.min.js"></script>



		<script src="<?php echo asset_url();?>js/jquery.form.js"></script>









<script>



$(document).ready(function(){



    $('#tblcity').DataTable();



});

 
</script>  

<script> 


function add()



{



	//alert('hello');



	$.post(base_url+"client/city/new",{},function(data) {



		//alert(data);



		$("#basic").html(data);



		



	},'html');







}







function edit(id)



{



	//alert('hello');



	//alert(id);



	$.post(base_url+"client/city/edit",{id: id},function(data) {



		$("#basic").html(data); 

	},'html'); 


} 

</script>