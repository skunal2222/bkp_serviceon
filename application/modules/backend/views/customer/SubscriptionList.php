<style>
<!--
.btn-plus{
	margin:5px 0px;
}
-->
</style>

<div id="page-wrapper">
	<div class="row" >
		<div>
			<form action="" method="post">
			
			</form>
		</div>
		<div class="col-lg-12" style="padding:0px"> 
        	<div class="panel panel-default"  >
            	<div class="panel-heading" style="width:500">
                	Subscriber  List
              	</div>
              <div class="panel-body">
				<div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover" id="tblVehicle">	
						<thead class="bg-info">
								 <tr>
	                              <th>Sr. No.</th>
	                              <th>Email</th>  
	                              <th>Register Date</th>
                           		</tr>
							</thead>
							<tbody>
							 <?php 
                              if(!empty($users)) { ?>
                           <?php $i= 1; foreach ($users as $item):?>
                           <tr>
                              <td>
                                 <?php echo $i; ?>
                              </td>
                              <td>
                                 <?php echo $item['email'] ; ?>
                              </td> 
                               <td>
                                 <?php echo $item['created_datetime'] ; ?>
                              </td>  	
							</tr>
							    <?php $i++; endforeach;?>
						        <?php  } else{?>
								
								<tr><td colspan="5">Records not found.</td></tr>
							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div> 
		</div>
	</div>
</div>
<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

<!-- Modal --> 
    
    