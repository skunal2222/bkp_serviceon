	<div id="basic"  role="tabpanel" class="tab-pane fade in active show"  aria-expanded="true" >  
													<div id="">
														 	<div class="row">
																<div class="col-lg-12">
																	<div class="btn-plus">
																	<a href="javascript: add();" class="btn btn-primary view-contacts bottom-margin">
																		<i class="fa fa-plus"></i> SubCategory
																	</a>
																	</div>
														        	<div class="panel panel-default">
														            	<div class="panel-heading">
														                	Category List
														              	</div>
														               	<div class="panel-body">
														                	<div class="dataTable_wrapper">
														                       	<table class="table table-striped table-bordered table-hover" id="tblcategory">
																					<thead class="bg-info">
																						<tr>
																							<th>ID</th>
																							<th>Name</th>
														     								<th>Action</th>
																						</tr>
																					</thead>
																					<tbody>
																					<?php if (isset($subcategories)) { ?>
																					<?php foreach ($subcategories as $item):?>
																						<tr>
																							<td>
																								<?php echo $item['id'];?>
																							</td>
																							<td>
																								<?php echo $item['name'];?>
																							</td>
																							<td><a href = "<?php echo base_url();?>admin/subcategory/edit/<?php echo $item['id']?>" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil"></i></a></td>
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
																	<a href="" class="btn btn-primary view-contacts bottom-margin">
																		<i class="fa fa-plus"></i> SubCategory
																	</a>
																</div>
															</div>
														</div>
															
                                               		 </div>
                                               		    <script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
		<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo asset_url();?>js/bootstrap-timepicker.min.js"></script>
		<script src="<?php echo asset_url();?>js/selectize.min.js"></script>
		<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
                                               		 <script>

function add()
{
	//alert('hello');
	$.post(base_url+"admin/subcategory/new",{},function(data) {
		//alert(data);
		$("#image").html(data);
		
	},'html');

}