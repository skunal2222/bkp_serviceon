				<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"> Priority Logs </div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                   <div class="row">
				                    <div class="col-sm-12">
				                        <div class="white-box">
				                            <div class="table-responsive">
				                                <table id="myTable" class="table table-striped">
				                                    <thead>
				                                        <tr>
				                                            <th>Priority</th>
				                                            <th>Changed By</th>
				                                            <th>Datetime</th>
				                                        </tr>
				                                    </thead>
				                                    <tbody>
			                                    	<?php
			                                    	foreach($leadHistory['priorities']as $priority) {?>
			                                    	<tr>
			                                    		<td>
			                                    			<?php if($priority['changed_id']==1){echo "HOT";} elseif($priority['changed_id']==2){echo "WARM";} elseif($priority['changed_id']==3){echo "COLD"; } ?>
		                                    			</td>
			                                            <td><?php echo $priority['first_name'].' '.$priority['last_name']; ?></td>
			                                            <td><?php echo $priority['created_date']; ?></td>
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
