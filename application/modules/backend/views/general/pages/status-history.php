           <div class="row clearfix"></div>
           <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"> Status Logs </div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                   <div class="row">
				                    <div class="col-sm-12">
				                        <div class="white-box">
				                            <div class="table-responsive">
				                                <table id="myTable" class="table table-striped">
				                                    <thead>
				                                        <tr>
				                                            <th>Status</th>
				                                            <th>Changed By</th>
				                                            <th>Datetime</th>
				                                        </tr>
				                                    </thead>
				                                    <tbody>
			                                    	<?php
			                                    	foreach($leadHistory['leadStatus'] as $lstatus) {?>
			                                    	<tr>
			                                    		<td>
			                                    			<?php echo $lstatus['status_name']; ?>
		                                    			</td>
			                                            <td><?php echo $lstatus['first_name'].' '.$lstatus['last_name']; ?></td>
			                                            <td><?php echo $lstatus['created_date']; ?></td>
			                                    	</tr>
			                                    	<?php }?>
				                                    </tbody>
				                                </table>
				                            </div>
				                        </div>
				                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>