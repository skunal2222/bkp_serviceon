           <div class="row clearfix"></div>
           <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"> Executive Logs </div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                   <div class="row">
				                    <div class="col-sm-12">
				                        <div class="white-box">
				                            <div class="table-responsive">
				                                <table id="myTable" class="table table-striped">
				                                    <thead>
				                                        <tr>
				                                            <th>Executive Id</th>
				                                            <th>Changed By</th>
				                                            <th>Datetime</th>
				                                        </tr>
				                                    </thead>
				                                    <tbody>
			                                    	<?php
			                                    	foreach($leadHistory['executives'] as $executive) {?>
			                                    	<tr>
			                                    		<td>
			                                    			<?php echo $executive['executive_fname'].' '.$executive['executive_lname']; ?>
		                                    			</td>
			                                            <td><?php echo $executive['first_name'].' '.$executive['last_name']; ?></td>
			                                            <td><?php echo $executive['created_date']; ?></td>
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
           