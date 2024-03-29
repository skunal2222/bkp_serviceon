<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row bg-title">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title"><?php echo COMPANY ; ?></h4>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<!--<a href="https://themeforest.net/item/elite-admin-responsive-dashboard-web-app-kit-/16750820" target="_blank" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Buy Now</a>-->
				<ol class="breadcrumb">
					<li><a href="#">Dashboard</a></li>
					<li class="active"><?php echo COMPANY ; ?></li>
				</ol>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<input type="hidden" name="oldordercount" id="oldordercount" value="<?php echo count($ordercount);?>">
		<div class="row">
		  <?php if($_SESSION ['access'][9] == 1) { ?>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="white-box">
					<h3 class="box-title">
						<!--<i class="ti-shopping-cart text-success"></i>-->
						<!-- New Order <h1><?php // echo count($pendingorders);?></h1> -->
						New Order <h1><?php echo count($neworders);?></h1>
					</h3>
					<div class="text-right">
						<a href="<?php echo base_url(); ?>admin/order/pendingorders">View Details</a>
						<!--  <h1><sup><i class="ti-arrow-up text-success"></i></sup> 12,000</h1>-->
					</div>
					<!-- <span class="text-success">20%</span>-->
					<!--<div class="progress m-b-0">						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 20%;">							<span class="sr-only">20% Complete</span>						</div>					</div>-->
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="white-box">
					<h3 class="box-title">
						<!--<i class="fa fa-th fa-5x"></i>-->
						Rider Assigned Orders <h1><?php echo count($pickupriderassignedorders) + count($deliveryriderassignedorders);?></h1>
					</h3>
					<div class="text-right">
					<span class="">
						<b>Pickup <?php echo count($pickupriderassignedorders);?> | Delivery <?php echo count($deliveryriderassignedorders);?></b> &emsp;&emsp;&emsp;
					</span>
						<a href="<?php echo base_url(); ?>admin/order/assignedorders">View Details</a>
						<!--  <h1><sup><i class="ti-arrow-up text-success"></i></sup> 12,000</h1>-->
					</div>
					<!--<span class="text-danger">30%</span>-->
					<!-- <div class="progress m-b-0">						<div class="progress-bar progress-bar-danger" role="progressbar"							aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"							style="width: 30%;">							<span class="sr-only">230% Complete</span>						</div>					</div>-->
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="white-box">
					<h3 class="box-title">
						<!-- <i class="ti-wallet text-info"></i>-->
						<!-- Ongoing Orders/Estimate Generated<h1><?php // echo count($ongoingorders);?></h1> -->
						Ongoing Orders/Estimate Generated <h1><?php echo count($estimateGenerated);?></h1>
					</h3>
					<div class="text-right">
						<a href="<?php echo base_url(); ?>admin/order/ongoingorders">View Details</a>
						<!--  <h1><sup><i class="ti-arrow-up text-success"></i></sup> 12,000</h1>-->
					</div>
					<!-- <span class="text-info">60%</span>-->
					<!--<div class="progress m-b-0">						<div class="progress-bar progress-bar-info" role="progressbar"							aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"							style="width: 60%;">							<span class="sr-only">20% Complete</span>						</div>					</div>-->
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="white-box">
					<h3 class="box-title">
						<!-- <i class="ti-wallet text-info"></i>-->
						Ongoing Orders/Working <h1><?php echo count($workingorders);?></h1>
					</h3>
					<div class="text-right">
						<a href="<?php echo base_url(); ?>admin/order/approvalorders">View Details</a>
						<!--  <h1><sup><i class="ti-arrow-up text-success"></i></sup> 12,000</h1>-->
					</div>
					<!-- <span class="text-info">60%</span>-->
					<!--<div class="progress m-b-0">						<div class="progress-bar progress-bar-info" role="progressbar"							aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"							style="width: 60%;">							<span class="sr-only">20% Complete</span>						</div>					</div>-->
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="white-box">
					<h3 class="box-title">
						<!--<i class="ti-stats-up"></i>-->
						Work Completed Orders <h1><?php echo count($completedorders);?></h1>
					</h3>
					<div class="text-right">
						<a href="<?php echo base_url(); ?>admin/order/completedorders">View Details</a>
						<!--  <h1><sup><i class="ti-arrow-up text-success"></i></sup> 12,000</h1>-->
					</div>
					<!-- <span class="text-inverse">80%</span>					<div class="progress m-b-0">						<div class="progress-bar progress-bar-inverse" role="progressbar"							aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"							style="width: 80%;">							<span class="sr-only">230% Complete</span>						</div>					</div>-->
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="white-box">
					<h3 class="box-title">
						<!--<i class="ti-stats-up"></i>-->
						Delivery Completed Orders <h1><?php echo count($delivery_completed_orders);?></h1>
					</h3>
					<div class="text-right">
						<a href="<?php echo base_url(); ?>admin/order/deliverycompletedorders">View Details</a>
						<!--  <h1><sup><i class="ti-arrow-up text-success"></i></sup> 12,000</h1>-->
					</div>
					<!-- <span class="text-inverse">80%</span>					<div class="progress m-b-0">						<div class="progress-bar progress-bar-inverse" role="progressbar"							aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"							style="width: 80%;">							<span class="sr-only">230% Complete</span>						</div>					</div>-->
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="white-box">
					<h3 class="box-title">
						<!--<i class="ti-stats-up"></i>-->
						Cancelled Orders <h1><?php echo count($canceled_orders);?></h1>
					</h3>
					<div class="text-right">
						<a href="<?php echo base_url(); ?>admin/order/cancelledorders">View Details</a>
						<!--  <h1><sup><i class="ti-arrow-up text-success"></i></sup> 12,000</h1>-->
					</div>
					<!-- <span class="text-inverse">80%</span>					<div class="progress m-b-0">						<div class="progress-bar progress-bar-inverse" role="progressbar"							aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"							style="width: 80%;">							<span class="sr-only">230% Complete</span>						</div>					</div>-->
				</div>
			</div>
			<?php } ?>
			<?php if($_SESSION ['access'][9] == 1) { ?>
			<!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="white-box">
					<h3 class="box-title"> 
						Tickets
					</h3>
					<div class="text-right">
						<a href="<?php echo base_url(); ?>admin/general/tickets">View Details</a> 
					</div> 
				</div>
			</div> -->
			<?php } ?>
		</div>
		<!--row -->
		<!--row -->
		<div class="row">
			<!--<div class="col-md-7 col-lg-8 col-sm-12 col-xs-12">
				<div class="white-box">
					<h3 class="box-title">Product Sales</h3>
					<ul class="list-inline text-center">
						<li>
							<h5>
								<i class="fa fa-circle m-r-5" style="color: #00bfc7;"></i>iMac
							</h5>
						</li>
						<li>
							<h5>
								<i class="fa fa-circle m-r-5" style="color: #b4becb;"></i>iPhone
							</h5>
						</li>
					</ul>
					<div id="morris-area-chart2" style="height: 370px;"></div>
				</div>
			</div>-->
			<!--<div class="col-md-5 col-lg-4 col-sm-12 col-xs-12">
				<div class="white-box">
					<h3 class="box-title">Order Stats</h3>
					<div id="morris-donut-chart" class="ecomm-donute"
						style="height: 317px;"></div>
					<ul class="list-inline m-t-30 text-center">
						<li class="p-r-20">
							<h5 class="text-muted">
								<i class="fa fa-circle" style="color: #fb9678;"></i> Order
							</h5>
							<h4 class="m-b-0"><?php echo count($orders); ?></h4>
						</li>
						<li class="p-r-20">
							<h5 class="text-muted">
								<i class="fa fa-circle" style="color: #01c0c8;"></i> Pending
							</h5>
							<h4 class="m-b-0"><?php echo count($pendingorders); ?></h4>
						</li>
						<li>
							<h5 class="text-muted">
								<i class="fa fa-circle" style="color: #4F5467;"></i> Delivered
							</h5>
							<h4 class="m-b-0"><?php echo count($completedorders); ?></h4>
						</li>
					</ul>
				</div>
			</div>-->
		</div>
		<!-- row -->
		<!--         <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Product Overview</h3>
                            <div class="table-responsive">
                                <table class="table product-overview">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Order ID</th>
                                            <th>Photo</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Steave Jobs</td>
                                            <td>#85457898</td>
                                            <td>
                                                <img src="<?php echo asset_url();?>backend/images/chair.jpg" alt="iMac" width="80">
                                            </td>
                                            <td>Rounded Chair</td>
                                            <td>20</td>
                                            <td>10-7-2017</td>
                                            <td>
                                                <span class="label label-success font-weight-100">Paid</span>
                                            </td>
                                            <td><a href="javascript:void(0)" class="text-inverse p-r-10" data-toggle="tooltip" title="Edit"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Varun Dhavan</td>
                                            <td>#95457898</td>
                                            <td>
                                                <img src="<?php echo asset_url();?>backend/images/chair2.jpg" alt="iPhone" width="80">
                                            </td>
                                            <td>Wooden Chair</td>
                                            <td>25</td>
                                            <td>09-7-2017</td>
                                            <td>
                                                <span class="label label-warning font-weight-100">Pending</span>
                                            </td>
                                            <td><a href="javascript:void(0)" class="text-inverse p-r-10" data-toggle="tooltip" title="Edit"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Ritesh Desh</td>
                                            <td>#68457898</td>
                                            <td>
                                                <img src="<?php echo asset_url();?>backend/images/chair3.jpg" alt="apple_watch" width="80">
                                            </td>
                                            <td>Gray Chair</td>
                                            <td>12</td>
                                            <td>08-7-2017</td>
                                            <td>
                                                <span class="label label-success font-weight-100">Paid</span>
                                            </td>
                                            <td><a href="javascript:void(0)" class="text-inverse p-r-10" data-toggle="tooltip" title="Edit"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Hrithik</td>
                                            <td>#45457898</td>
                                            <td>
                                                <img src="<?php echo asset_url();?>backend/images/chair4.jpg" alt="mac_mouse" width="80">
                                            </td>
                                            <td>Pure Wooden chair</td>
                                            <td>18</td>
                                            <td>02-7-2017</td>
                                            <td>
                                                <span class="label label-default font-weight-100">Failed</span>
                                            </td>
                                            <td><a href="javascript:void(0)" class="text-inverse p-r-10" data-toggle="tooltip" title="Edit"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> -->
		<!-- .right-sidebar -->
		<div class="right-sidebar">
			<div class="slimscrollright">
				<div class="rpanel-title">
					Service Panel <span><i class="ti-close right-side-toggle"></i></span>
				</div>
				<div class="r-panel-body">
					<ul>
						<li><b>Layout Options</b></li>
						<li>
							<div class="checkbox checkbox-info">
								<input id="checkbox1" type="checkbox" class="fxhdr"> <label
									for="checkbox1"> Fix Header </label>
							</div>
						</li>
						<li>
							<div class="checkbox checkbox-warning">
								<input id="checkbox2" type="checkbox" class="fxsdr"> <label
									for="checkbox2"> Fix Sidebar </label>
							</div>
						</li>
						<li>
							<div class="checkbox checkbox-success">
								<input id="checkbox4" type="checkbox" class="open-close"> <label
									for="checkbox4"> Toggle Sidebar </label>
							</div>
						</li>
					</ul>
					<ul id="themecolors" class="m-t-20">
						<li><b>With Light sidebar</b></li>
						<li><a href="javascript:void(0)" theme="default"
							class="default-theme working">1</a></li>
						<li><a href="javascript:void(0)" theme="green" class="green-theme">2</a></li>
						<li><a href="javascript:void(0)" theme="gray" class="yellow-theme">3</a></li>
						<li><a href="javascript:void(0)" theme="blue" class="blue-theme">4</a></li>
						<li><a href="javascript:void(0)" theme="purple"
							class="purple-theme">5</a></li>
						<li><a href="javascript:void(0)" theme="megna" class="megna-theme">6</a></li>
						<li><b>With Dark sidebar</b></li>
						<br />
						<li><a href="javascript:void(0)" theme="default-dark"
							class="default-dark-theme">7</a></li>
						<li><a href="javascript:void(0)" theme="green-dark"
							class="green-dark-theme">8</a></li>
						<li><a href="javascript:void(0)" theme="gray-dark"
							class="yellow-dark-theme">9</a></li>
						<li><a href="javascript:void(0)" theme="blue-dark"
							class="blue-dark-theme">10</a></li>
						<li><a href="javascript:void(0)" theme="purple-dark"
							class="purple-dark-theme">11</a></li>
						<li><a href="javascript:void(0)" theme="megna-dark"
							class="megna-dark-theme">12</a></li>
					</ul>
					<ul class="m-t-20 chatonline">
						<li><b>Chat option</b></li>
						<li><a href="javascript:void(0)"><img
								src="<?php echo asset_url();?>backend/images/users/varun.jpg"
								alt="user-img" class="img-circle"> <span>Varun Dhavan <small
									class="text-success">online</small></span></a></li>
						<li><a href="javascript:void(0)"><img
								src="<?php echo asset_url();?>backend/images/users/genu.jpg"
								alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small
									class="text-warning">Away</small></span></a></li>
						<li><a href="javascript:void(0)"><img
								src="<?php echo asset_url();?>backend/images/users/ritesh.jpg"
								alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small
									class="text-danger">Busy</small></span></a></li>
						<li><a href="javascript:void(0)"><img
								src="<?php echo asset_url();?>backend/images/users/arijit.jpg"
								alt="user-img" class="img-circle"> <span>Arijit Sinh <small
									class="text-muted">Offline</small></span></a></li>
						<li><a href="javascript:void(0)"><img
								src="<?php echo asset_url();?>backend/images/users/govinda.jpg"
								alt="user-img" class="img-circle"> <span>Govinda Star <small
									class="text-success">online</small></span></a></li>
						<li><a href="javascript:void(0)"><img
								src="<?php echo asset_url();?>backend/images/users/hritik.jpg"
								alt="user-img" class="img-circle"> <span>John Abraham<small
									class="text-success">online</small></span></a></li>
						<li><a href="javascript:void(0)"><img
								src="<?php echo asset_url();?>backend/images/users/john.jpg"
								alt="user-img" class="img-circle"> <span>Hritik Roshan<small
									class="text-success">online</small></span></a></li>
						<li><a href="javascript:void(0)"><img
								src="<?php echo asset_url();?>backend/images/users/pawandeep.jpg"
								alt="user-img" class="img-circle"> <span>Pwandeep rajan <small
									class="text-success">online</small></span></a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /.right-sidebar -->
	</div>
	<!-- /.container-fluid -->
	<footer class="footer text-center"> 2018 &copy; </footer>
</div>
<!-- <div id="neworderpopup" class="modal fade" style="" role="dialog">
    <div id="rsp-overlay" class="modal-dialog" style="opacity:1 ;width:400px ">
      	<div class="modal-content">
          	<div class="modal-header">
              	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff"> X </span><span class="sr-only">Close</span></button>
              	<h4 class="modal-title" id="myModalLabel">New Order</h4>
          	</div>
          	<div class="modal-body" style="background-color:#f5f5f5;">
          		<div class="row" style="padding:0px;">
              		<div class="col-md-12 col-xs-12">
                  		<div class="form-group">
                       		New order is place
                  		</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-md-12 col-xs-12">
              			<a href="<?php echo base_url();?>admin/order/pendingorders" class="btn btn-primary">Check Order</a>
             		</div>
              	</div>
          	</div>
      	</div>
  	</div>
</div>-->
<script>
/* setTimeout(function() {
	  location.reload();
}, 60000); */
/*
  $(document).ready(function () {
    window.setInterval(function () {
    	checkUpdate();
    }, 1000);
});
function checkUpdate(){
	var oldordercount = $("#oldordercount").val();
	$.post(base_url+"admin/order/getallorders/",{ }, function(data){
		//alert(oldordercount);
		//alert(data.newordercount);
		var newordercount = data.newordercount;
		if(newordercount > oldordercount){
			console.log("New order added");
			console.log(oldordercount);
			console.log(newordercount);
    		$('<audio id="chatAudio"><source src="<?php echo base_url();?>assets/sound/consequence.ogg" type="assets/sound/audio/ogg"><source src="<?php echo base_url();?>assets/sound/consequence.mp3" type="audio/mpeg"><source src="<?php echo base_url();?>assets/sound/notify.wav" type="audio/wav"></audio>').appendTo('body');
			$('#chatAudio')[0].play();
			//oldordercount = newordercount;
			$("#neworderpopup").modal("show");
			$("#oldordercount").val(newordercount);
    	}
		
	},'json');
} */
</script>
