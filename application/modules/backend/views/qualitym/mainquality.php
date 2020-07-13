<link type="text/css" rel="stylesheet" href="<?php echo asset_url();?>css/datepicker3.css">

<link type="text/css" rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap-timepicker.min.css">

<div id="page-wrapper">

            <div class="container-fluid">

                <div class="row bg-title">

                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

                        <h4 class="page-title">Parameter</h4> </div>

                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                        <ol class="breadcrumb">

                            <li><a href="#">Dashboard</a></li>

                            <li class="active">Parameter</li>

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

				                                <li role="presentation" class="nav-item"><a href="#basic" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Parameter</span></a></li>

				                                <li role="presentation" class="nav-item"><a href="#image" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Grade</span></a></li>

				                             
				                               </ul>

                                          	<div class="tab-content">

		  										<div id="basic"  role="tabpanel" class="tab-pane fade in active show"  aria-expanded="true" >  

													<div id="">

														 	<div class="row">

																<div class="col-lg-12">

																	<div class="btn-plus">

																	<a href="javascript: add();" class="btn btn-primary view-contacts bottom-margin" style="color:white;">

																		<i class="fa fa-plus"></i>Parameter

																	</a>

																	</div>

														        	<div class="panel panel-default">

														            	<div class="panel-heading">

														                	Parameter List

														              	</div>

														               	<div class="panel-body">

														                	<div class="dataTable_wrapper">

														                       	<table class="table table-striped table-bordered table-hover" id="tblpara">

																					<thead class="bg-info">

																						<tr>

																							<th>ID</th>

																							<th>Parameter</th>
																							<th>Status</th>
														     								<th>Action</th>

																						</tr>

																					</thead>

																					<tbody>

																					<?php if (isset($parameters)) { ?>

																					<?php foreach ($parameters as $item):?>

																						<tr>

																							<td>

																								<?php echo $item['id'];?>

																							</td>

																							<td>

																								<?php echo $item['name'];?>

																							</td>																																														<td>																								<?php if($item['status'] == 1) {?>Enable<?php }else{?>Disable <?php }?>																							</td>

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

																		<i class="fa fa-plus"></i> Parameter

																	</a>

																</div>

															</div>

														</div>

															

                                               		 </div>

                                                

                                            	<div id="image" role="tabpanel" class="tab-pane fade"  aria-expanded="true">

		                                           			<div id="">

														 	<div class="row">

																<div class="col-lg-12">

																	<div class="btn-plus">

																	<a href="javascript: addgrade();" class="btn btn-primary view-contacts bottom-margin" style="color:white;">

																		<i class="fa fa-plus"></i> Grade

																	</a>

																	</div>

														        	<div class="panel panel-default">

														            	<div class="panel-heading">

														                	Grade List

														              	</div>

														               	<div class="panel-body">

														                	<div class="dataTable_wrapper">

														                       	<table class="table table-striped table-bordered table-hover" id="tblgrade">

																					<thead class="bg-info">

																						<tr>

																							<th>ID</th>

																							<th> Grade</th>
																						    <th>Status</th>
														     								<th>Action</th>

																						</tr>

																					</thead>

																					<tbody>

																					<?php if (isset($grades)) { ?>

																					<?php foreach ($grades as $item):?>

																						<tr>

																							<td>

																								<?php echo $item['id'];?>

																							</td>

																							<td>

																								<?php echo $item['name'];?>

																							</td>
																							<td>																								<?php if($item['status'] == 1) {?>Enable<?php }else{?>Disable <?php }?>																							</td>
																						
																							<td><a href = "javascript: editgrade(<?php echo $item['id']?>);" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil" style="color:white;"></i></a></td>

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

																	<a href="javascript: addgrade();" class="btn btn-primary view-contacts bottom-margin" style="color:white;">

																		<i class="fa fa-plus"></i> Grade

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

    $('#tblpara').DataTable();

});

$(document).ready(function(){
    $('#tblgrade').DataTable();
});

</script>



<script>



function add()

{

	//alert('hello');

	$.post(base_url+"admin/parameter/new",{},function(data) {

		//alert(data);

		$("#basic").html(data);

		

	},'html');



}



function edit(id)

{

	//alert('hello');

	//alert(id);

	$.post(base_url+"admin/parameter/edit",{id: id},function(data) {

		$("#basic").html(data);

		

	},'html');



}



function addgrade()

{

	//alert('hello');

	$.post(base_url+"admin/grade/new",{},function(data) {

		//alert(data);

		$("#image").html(data);

		

	},'html');



}



function editgrade(id)

{

	//alert('hello');

	//alert(id);

	$.post(base_url+"admin/grade/edit",{id: id},function(data) {

		$("#image").html(data);

		

	},'html');



}


</script>