<style>
<!--
.btn-plus{
	margin:5px 0px;
}
-->
</style>
<div id="page-wrapper">
  <div class="container-fluid">
	<div class="row">
		<div>
		</div>
		<div class="col-lg-12">
			<div class="btn-plus">
		
			<a href="<?php echo base_url();?>admin/manufacture/new" class="btn btn-primary view-contacts bottom-margin" >
				<i class="fa fa-plus"></i> Manufacture
			</a>
			
			
			</div>
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	Manufacture List
                	<!--<span class="pull-right" style="margin-top: -7px;">
                		<select id="status" name="status" class="form-control">
                			<option value="">Select Status</option>
                			<option value="1">Active</option>
                			<option value="0">In-Active</option>
                		</select>
                	</span>-->
              	</div>
               	<div class="panel-body">
                	<div class="dataTable_wrapper">
                       	<table class="table table-striped table-bordered table-hover" id="tblRestos">
							<thead class="bg-info">
								<tr>
									<th>ID</th>
									<th>Manufacture Name</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php if (isset($details)) { ?>
							<?php foreach ($details as $item):?>
								<tr>
									<td>
										<?php echo $item['manufacturer_id'];?>
									</td>
									<td>
										<?php echo $item['name'];?>
									</td>
									<td>
									<?php if($_SESSION['adminsession']['user_role']==1){?>
                                    <?php if($item['status'] == 1) {?>
                                    	<a href="javascript:status(<?php echo $item['manufacturer_id'];?>,1)" >
                                        	<i class="fa fa-cog text-success fa-lg"></i>
                                       	</a>
                                  	<?php }else{?>
                                      	<a href="javascript:status(<?php echo $item['manufacturer_id'];?>,0)">
                                        	<i class="fa fa-cog text-danger fa-lg"></i>
                                     	</a>
                                    <?php }} else {?>
                                    <?php if($item['status'] == 1) {?>
                                    	Active
                                  	<?php }else{?>
                                      	Deactive
                                    <?php }}?>
                                    
									</td>
									<td><a href = "<?php echo base_url();?>admin/manufacture/edit/<?php echo $item['manufacturer_id']?>" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil"></i></a></td>
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
			<a href="<?php echo base_url();?>admin/manufacture/new" class="btn btn-primary view-contacts bottom-margin" >
				<i class="fa fa-plus"></i> Manufacture
			</a>
			<?php } else {?>
			<a href="" class="btn btn-primary view-contacts bottom-margin" disabled>
				<i class="fa fa-plus"></i> Manufacture
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
function status()
{
	
	if($('#statusvalue').val()==1 )
	{
		$.get(base_url + "admin/manufacture/turnoffresto",{id: $('#restaurantid').val(),status:  $('#statusvalue').val(),comment: $('#comment').val()}, function (data) {
			   alert('Status is changed');
			   location.reload();
		});
	}
	else
	{
		$.get(base_url + "admin/manufacture/turnonresto",{id: $('#restaurantid').val(),status:  $('#statusvalue').val(),comment: $('#comment').val()}, function (data) {
		      alert('Status is changed');
			       location.reload();
		});
	}
}

function turnOn(restid,status)
{
	$('#myModal').modal({
        backdrop: 'static',
        keyboard: false
    });
   $('#restaurantid').val(restid);
   $('#statusvalue').val(status);
 	//alert('User is Activated');
  	//location.reload(true);
}

$("#status").change(function() {
	window.location.href = base_url+"admin/manufacture/list?status="+$(this).val();
});
</script>