<div id="page-wrapper">
	<div class="container-fluid">
 
	<div class="row">
		<div>
		</div>
		<div class="col-lg-12">
			<div class="btn-plus">
		
			<a href="<?php echo base_url();?>admin/general/addpickup" class="btn btn-primary view-contacts bottom-margin" >
				<i class="fa fa-plus"></i> Pickup Slot
			</a>
			
			
			</div>
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	Pickup slot List
              	</div>
               	<div class="panel-body">
                	<div class="dataTable_wrapper">
                       	<table class="table table-striped table-bordered table-hover" id="tblRestos">
							<thead class="bg-info">
								<tr>
									<th>ID</th>
									<th>From KM</th>
									<th>To KM</th>
									<th>Price</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
							<?php if (isset($pickup)) { ?>
							<?php foreach ($pickup as $item):?>
								<tr>
									<td>
										<a href="<?= base_url('admin/general/editpickup/').$item['id']?>"><?= $item['id'];?></a>
									</td>
									<td>
										<?= $item['minkm'];?>
									</td>
									<td>
										<?= $item['maxkm'];?>
									</td>
									<td>
										<?= $item['price'];?>
									</td>
									<td>
										<?= $item['status']==0?"Active":"In-active";?>
									</td>
									
								</tr>
								<?php endforeach;?>
							<?php } else { ?>
								<tr><td colspan="5">Records not found.</td></tr>
							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<?php if($_SESSION['adminsession']['user_role']==1){?>
			<a href="<?php echo base_url();?>admin/general/addpickup" class="btn btn-primary view-contacts bottom-margin" >
				<i class="fa fa-plus"></i> Pickup Slot
			</a>
			<?php } else {?>
			<a href="" class="btn btn-primary view-contacts bottom-margin" disabled>
				<i class="fa fa-plus"></i> Pickup Slot
			</a>
			<?php }?>
		</div>
	</div>
  </div>
</div>

<!--  Comment for Log -->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm" style="padding-top:10%;">
      <div class="modal-content" style="background:#transparent">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Comment</h4>
        </div>
        <div class="modal-body" style="padding:0px">
        <input type="hidden" id="restaurantid" value=""/>
        <input type="hidden" id="statusvalue" value=""/>
          <textarea rows='5' style="width:100%" autofocus id="comment"></textarea>
        </div>
        <div class="modal-footer" style="background-color: none">
         <button type="button" class="btn btn-primary" data-dismiss="modal" onclick='status()'>Add</button>
          <button type="button " class="btn btn-danger" data-dismiss="modal">Close</button>
         
        </div>
      </div>
    </div>
  </div>
<script>
	$(document).ready(function(){
	    $('#tblRestos').DataTable();
	});
</script>