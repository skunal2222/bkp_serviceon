<link type="text/css" rel="stylesheet" href="<?php echo asset_url();?>css/datepicker3.css">

<link type="text/css" rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap-timepicker.min.css">

<div id="page-wrapper">

            <div class="container-fluid">

                <div class="row bg-title">

                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

                        <h4 class="page-title">Area</h4> </div>

                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                        <ol class="breadcrumb">

                            <li><a href="#">Dashboard</a></li>

                            <li class="active">Area</li>

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

				                                <li role="presentation" class="nav-item"><a href="#image" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Zone</span></a></li>

				                                <li role="presentation" class="nav-item"><a href="#meta_info" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Area</span></a></li>

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

																							<th>ID</th>

																							<th>Name</th>

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

                                                

                                            	<div id="image" role="tabpanel" class="tab-pane fade"  aria-expanded="true">

		                                           			<div id="">

														 	<div class="row">

																<div class="col-lg-12">

																	<div class="btn-plus">

																	<a href="javascript: addzone();" class="btn btn-primary view-contacts bottom-margin" style="color:white;">

																		<i class="fa fa-plus"></i> Zone

																	</a>

																	</div>

														        	<div class="panel panel-default">

														            	<div class="panel-heading">

														                	Zone List

														              	</div>

														               	<div class="panel-body">

														                	<div class="dataTable_wrapper">

														                       	<table class="table table-striped table-bordered table-hover" id="tblzone">

																					<thead class="bg-info">

																						<tr>

																							<th>ID</th>

																							<th>Name</th>

																							<th>City</th>

														     								<th>Action</th>

																						</tr>

																					</thead>

																					<tbody>

																					<?php if (isset($zones)) { ?>

																					<?php foreach ($zones as $item):?>

																						<tr>

																							<td>

																								<?php echo $item['id'];?>

																							</td>

																							<td>

																								<?php echo $item['name'];?>

																							</td>

																							<td>

																								<?php echo $item['city'];?>

																							</td>

																							<td><a href = "javascript: editzone(<?php echo $item['id']?>);" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil" style="color:white;"></i></a></td>

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

																	<a href="javascript: addzone();" class="btn btn-primary view-contacts bottom-margin" style="color:white;">

																		<i class="fa fa-plus"></i> Zone

																	</a>

																</div>

															</div>

														</div>

                                                </div>

                                                

                                                <div id="meta_info" role="tabpanel" class="tab-pane fade"  aria-expanded="true">

	                                             			<div id="">

														 	<div class="row">

																<div class="col-lg-12">

																	<div class="btn-plus">

																	<a href="javascript: addarea();" class="btn btn-primary view-contacts bottom-margin" style="color:white;">

																		<i class="fa fa-plus"></i> Area

																	</a>

																	</div>

														        	<div class="panel panel-default">

														            	<div class="panel-heading">

														                	Area List

														              	</div>

														               	<div class="panel-body">

														                	<div class="dataTable_wrapper">

														                       	<table class="table table-striped table-bordered table-hover" id="tblarea">

																					<thead class="bg-info">

																						<tr>

																							<th>ID</th>
																							<th>Name</th>
																							<th>Zone</th>
																							<th>Nearest Area</th>
																							<th>Action</th>

																						</tr>

																					</thead>

																					<tbody>

																					<?php if (isset($areas)) { ?>

																					<?php foreach ($areas as $item):?>

																						<tr>

																							<td>

																								<?php echo $item['id'];?>

																							</td>

																							<td>

																								<?php echo $item['name'];?>

																							</td>
		<td>

																								<?php echo $item['zone'];?>

																							</td>
																							<td>

																								<?php echo $item['area'];?>

																							</td>
																							

																							<td><a href = "javascript: editarea(<?php echo $item['id']?>);" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil" style="color:white;"></i></a></td>

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

																	<a href="javascript: addarea();" class="btn btn-primary view-contacts bottom-margin" style="color:white;">

																		<i class="fa fa-plus"></i> Area

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

$(document).ready(function(){
    $('#tblzone').DataTable();
});

$(document).ready(function(){
    $('#tblarea').DataTable();
});

</script>



<script>



function add()

{

	//alert('hello');

	$.post(base_url+"admin/city/new",{},function(data) {

		//alert(data);

		$("#basic").html(data);

		

	},'html');



}



function edit(id)

{

	//alert('hello');

	//alert(id);

	$.post(base_url+"admin/city/edit",{id: id},function(data) {

		$("#basic").html(data);

		

	},'html');



}



function addzone()

{

	//alert('hello');

	$.post(base_url+"admin/zone/new",{},function(data) {

		//alert(data);

		$("#image").html(data);

		

	},'html');



}



function editzone(id)

{

	//alert('hello');

	//alert(id);

	$.post(base_url+"admin/zone/edit",{id: id},function(data) {

		$("#image").html(data);

		

	},'html');



}

function addarea()

{

	//alert('hello');

	$.post(base_url+"admin/area/new/0",{},function(data) {

		//alert(data);

		$("#meta_info").html(data);

		

	},'html');



}



function editarea(id)

{

	//alert('hello');

	//alert(id);

	$.post(base_url+"admin/area/edit",{id: id},function(data) {

		$("#meta_info").html(data);

		

	},'html');



}

</script>