<?php
$admin = $this->session->userdata ( 'adminsession' );
if (! isset ( $admin ['id'] )) {
	?>
<script>
		alert('Please login to continue');
</script>
<?php
	redirect ( base_url () . 'admin/' );
}
?>
<input type="hidden" name="oldordercount" id="oldordercount" value="<?php echo count($ordercount);?>">
<nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
               <!-- <div class="top-left-part">
				 <a class="logo" href="<?php echo base_url();?>admin/dashboard">
				   <b>
				     <img src="<?php echo asset_url();?>backend/images/eliteadmin-logo.png" alt="home" class="dark-logo"/>
				     <img src="<?php echo asset_url();?>backend/images/logo-dark.png" alt="home" class="light-logo"/>
				   </b>
				   <span class="hidden-xs">
				     <img src="<?php echo asset_url();?>backend/images/eliteadmin-text.png" alt="home" class="dark-logo" />
				     <img src="<?php echo asset_url();?>backend/images/logo-text-dark.png" alt="home" class="light-logo" />
				   </span>
				 </a>
				</div>-->
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
                  <!--   <li>
                        <form role="search" class="app-search hidden-xs">
                            <input type="text" placeholder="Search..." class="form-control">
                            <a href="#"><i class="fa fa-search"></i></a>
                        </form>
                    </li> -->
                </ul>
               <ul class="nav navbar-top-links navbar-right pull-right">
                    <li class="dropdown"> <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><i class="icon-envelope"></i>
          <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
          </a>
                        <ul class="dropdown-menu mailbox animated bounceInDown">
                            <li>
                                <div class="drop-title">This user services there vehical 60 days ago</div>
                            </li>
                            <li>
                                <div class="message-center">
                                  <?php $i = 0;
                                  if (isset($remindorders)) { ?>
									<?php foreach ($remindorders as $order):?>
									<?php if($i < 5){ ?>
                                    <a href="#">
                                        <!-- <div class="user-img"> <img src="<?php echo asset_url();?>backend/images/users/pawandeep.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>-->
                                        <div class="mail-contnet">
                                            <h5><?php echo $order['name'];?>(<?php echo $order['mobile'];?>)</h5>
                                            <span class="mail-desc">Last Order Date is <?php echo date('j M Y',strtotime($order['last_order_date']));?></span> <span class="time"></span> </div>
                                    </a>
                                    <?php } ?>
                                    <?php $i++;
                                    endforeach;?>
								  <?php } ?>
                                   <!-- <a href="#">
                                        <div class="user-img"> <img src="<?php echo asset_url();?>backend/images/users/sonu.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Sonu Nigam</h5>
                                            <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                    </a>
                                    <a href="#">
                                        <div class="user-img"> <img src="<?php echo asset_url();?>backend/images/users/arijit.jpg" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Arijit Sinh</h5>
                                            <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                    </a>
                                    <a href="#">
                                        <div class="user-img"> <img src="<?php echo asset_url();?>backend/images/users/pawandeep.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Pavan kumar</h5>
                                            <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                    </a>-->
                                </div>
                            </li>
                            <li>
                                <a class="text-center" href="<?php echo base_url();?>admin/order/getreminderusers"> <strong>See all Reminder Users</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </li>
                    <!-- /.dropdown -->
          <!--           <li class="dropdown"> <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><i class="ti-shopping-cart"></i>
          <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
          </a>
                        <ul class="dropdown-menu dropdown-cart dropdown-tasks animated slideInUp">
                            <li>
                                <div class="cart-img"><img src="<?php echo asset_url();?>backend/images/chair.jpg" /></div>
                                <div class="cart-content">
                                    <h5>Rounded Chair</h5><small>$153</small></div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="cart-img"><img src="<?php echo asset_url();?>backend/images/chair2.jpg" /></div>
                                <div class="cart-content">
                                    <h5>Rounded Chair</h5><small>$153</small></div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="cart-img"><img src="<?php echo asset_url();?>backend/images/chair3.jpg" /></div>
                                <div class="cart-content">
                                    <h5>Rounded Chair</h5><small>$153</small></div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="product-checkout.html"> <strong>Checkout</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </li>-->
                    <!-- /.dropdown -->
                    <!-- .Megamenu -->
                   <!-- <li class="mega-dropdown">
                        <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><span class="hidden-xs">Mega</span> <i class="icon-options-vertical"></i></a>
                        <ul class="dropdown-menu mega-dropdown-menu animated bounceInDown">
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Forms Elements</li>
                                    <li><a href="form-basic.html">Basic Forms</a></li>
                                    <li><a href="form-layout.html">Form Layout</a></li>
                                    <li><a href="form-advanced.html">Form Addons</a></li>
                                    <li><a href="form-material-elements.html">Form Material</a></li>
                                    <li><a href="form-float-input.html">Form Float Input</a></li>
                                    <li><a href="form-upload.html">File Upload</a></li>
                                    <li><a href="form-mask.html">Form Mask</a></li>
                                    <li><a href="form-img-cropper.html">Image Cropping</a></li>
                                    <li><a href="form-validation.html">Form Validation</a></li>
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Advance Forms</li>
                                    <li><a href="form-dropzone.html">File Dropzone</a></li>
                                    <li><a href="form-pickers.html">Form-pickers</a></li>
                                    <li><a href="icheck-control.html">Icheck Form Controls</a></li>
                                    <li><a href="form-wizard.html">Form-wizards</a></li>
                                    <li><a href="form-typehead.html">Typehead</a></li>
                                    <li><a href="form-xeditable.html">X-editable</a></li>
                                    <li><a href="form-summernote.html">Summernote</a></li>
                                    <li><a href="form-bootstrap-wysihtml5.html">Bootstrap wysihtml5</a></li>
                                    <li><a href="form-tinymce-wysihtml5.html">Tinymce wysihtml5</a></li>
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Table Example</li>
                                    <li><a href="basic-table.html">Basic Tables</a></li>
                                    <li><a href="table-layouts.html">Table Layouts</a></li>
                                    <li><a href="data-table.html">Data Table</a></li>
                                    <li class="hidden"><a href="crud-table.html">Crud Table</a></li>
                                    <li><a href="bootstrap-tables.html">Bootstrap Tables</a></li>
                                    <li><a href="responsive-tables.html">Responsive Tables</a></li>
                                    <li><a href="editable-tables.html">Editable Tables</a></li>
                                    <li><a href="foo-tables.html">FooTables</a></li>
                                    <li><a href="jsgrid.html">JsGrid Tables</a></li>
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Charts</li>
                                    <li> <a href="flot.html">Flot Charts</a> </li>
                                    <li><a href="morris-chart.html">Morris Chart</a></li>
                                    <li><a href="chart-js.html">Chart-js</a></li>
                                    <li><a href="peity-chart.html">Peity Charts</a></li>
                                    <li><a href="knob-chart.html">Knob Charts</a></li>
                                    <li><a href="sparkline-chart.html">Sparkline charts</a></li>
                                    <li><a href="extra-charts.html">Extra Charts</a></li>
                                </ul>
                            </li>
                            <li class="col-sm-12 m-t-40 demo-box">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="white-box text-center bg-purple"><a href="http://eliteadmin.themedesigner.in/demos/eliteadmin-inverse/index.html" target="_blank" class="text-white"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i><br/>Demo 1</a></div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="white-box text-center bg-success"><a href="http://eliteadmin.themedesigner.in/demos/eliteadmin/index.html" target="_blank" class="text-white"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i><br/>Demo 2</a></div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="white-box text-center bg-info"><a href="index.html" target="_blank" class="text-white"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i><br/>Demo 3</a></div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="white-box text-center bg-inverse"><a href="http://eliteadmin.themedesigner.in/demos/eliteadmin-horizontal-navbar/index3.html" target="_blank" class="text-white"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i><br/>Demo 4</a></div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="white-box text-center bg-warning"><a href="http://eliteadmin.themedesigner.in/demos/eliteadmin-iconbar/index4.html" target="_blank" class="text-white"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i><br/>Demo 5</a></div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="white-box text-center bg-danger"><a href="https://themeforest.net/item/elite-admin-responsive-web-app-kit-/16750820" target="_blank" class="text-white"><i class="linea-icon linea-ecommerce fa-fw" data-icon="d"></i><br/>Buy Now</a></div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>-->
                    <!-- /.Megamenu -->
					<!--<li>
					 <a href="<?php echo base_url();?>admin/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
				    </li>
                    <li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>-->
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
<div id="neworderpopup" class="modal fade" style="" role="dialog">
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
             			<!-- <button type="submit" class="btn btn-primary"></button>-->
             		</div>
              	</div>
          	</div>
      	</div>
  	</div>
</div>

<audio id="myAudio">
   <source src="<?= base_url()?>assets/notification.mp3" type="audio/mpeg">
 </audio>
<script>
/* setTimeout(function() {
	  location.reload();
}, 60000); */

$(document).ready(function () {
    window.setInterval(function () {
    	checkUpdate();
    }, 5000);
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
    		
			$('#myAudio')[0].play();
			//oldordercount = newordercount;
			$("#neworderpopup").modal("show");
			$("#oldordercount").val(newordercount);
    	}
		
	},'json');
}
</script>
<script type="text/javascript">
    function check_access_url()
    {
        $.ajax({
            type : "POST",
            url  : base_url + 'admin/module/access-type',
            dataType : "JSON",
            data : {'url' : '<?= $this->uri->uri_string()?>'},
            success: function(data){ 
                console.log(data);

                if(data.status == 'true')
                {

                }
                else
                {
                    alert('You do not have permission to access this page..!!'); 
                    window.location.href = base_url+"admin/dashboard";
                }
            }
        });
        return false;

    }
    <?php if($this->session->adminsession['user_role']!=1 && $this->uri->uri_string() != 'admin/dashboard'){?>
            check_access_url();

    <?php  } ?>  

</script>>