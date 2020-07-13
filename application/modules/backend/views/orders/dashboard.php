<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-th fa-5x"></i>
                                </div>
                                <?php 
		                        $neworders = 0;
		                        foreach ($orders as $order) {
		                        	if($order['status'] == 0) {
		                        		$neworders = $order['orders'];
		                        	}
		                        }
		                        ?>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $neworders;?></div>
                                    <div>New Orders!</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo base_url();?>crm/order/pendingorders">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-th fa-5x"></i>
                                </div>
                                <?php 
		                        $completedorders = 0;
		                        foreach ($orders as $order) {
		                        	if($order['status'] == 4) {
		                        		$completedorders = $order['orders'];
		                        	}
		                        }
		                        ?>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $completedorders;?></div>
                                    <div>Completed Orders!</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo base_url();?>crm/order/completedorders">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-th fa-5x"></i>
                                </div>
                                <?php 
		                        $cancelledorders = 0;
		                        foreach ($orders as $order) {
		                        	if($order['status'] == 5) {
		                        		$cancelledorders = $order['orders'];
		                        	}
		                        }
		                        ?>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $cancelledorders;?></div>
                                    <div>Cancelled Orders</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo base_url();?>crm/order/cancelledorders">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $pickup_orders;?></div>
                                    <div>Total Pickup Orders</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo base_url();?>crm/order/todaysorders">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>