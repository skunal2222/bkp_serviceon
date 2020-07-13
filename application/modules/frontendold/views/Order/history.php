<link href="<?php echo asset_url();?>css/order.css" rel="stylesheet">   

    <section class="about" id="about" style='background-image: url("<?php echo asset_url();?>images/img/templatemo_main_bg_bottom_wrapper.jpg");background-position: 0px -65.24px;'>
     <div class="container">
      <div class="row">

        	<div class="col-lg-3 col-xs-12">
			<div class="nk-footer-text" style="margin: 23px 0px">
					<!-- <ul> -->
					<!-- <li><a href="#section-london">London</a></li> -->
					<!-- <li><a href="#section-paris">Paris</a></li> -->
					<!-- </ul> -->
			    <a href="<?php echo base_url();?>order/trackorder"><p class="foterp">Ongoing Orders</p></a>
				<a href="#">	<p class="foterp act">Order	History</p></a>
				<!--<a href="<?php echo base_url();?>order/notification"><p class="foterp">Notifications <span>2</span></p></a>-->
				<a href="<?php echo base_url();?>order/setting"><p class="foterp">Settings</p></a>
				<a href="<?php echo base_url();?>order/wallet"><p class="foterp">Wallet</p></a>
				<a href="<?php echo base_url();?>order/offer"><p class="foterp">Offers</p></a>
				</div>
			</div>
            
         <div class="col-lg-8 col-xs-12 text-center" style="padding-top: 23px;">
			<?php if(!empty($orders)){?>			
				<?php foreach($orders as $order){ ?>
                    <div class="nk-footer-text">
					    <p class="foterp spl-bg" >
                        <label id="label1"> &nbsp;Order Date : </label> <label id="label1 spl-1"><?php echo date('d-m-Y',strtotime($order['ordered_on']));?></label><br><br>
                        <label id="label1"> &nbsp;Pickup Date : </label> <label id="label1 spl-2"><?php echo date('d-m-Y',strtotime($order['pickup_date']));?></label><br><br>
                        <label id="label1"> &nbsp;Pickup Slot : </label> <label id="label1 spl-3"><?php echo $order['slot'];?></label><br><br>
                        <label id="label1"> &nbsp;Total Bill : </label><label id="label1 spl-4"><?php echo $order['grand_total'];?></label>
						</p>
					</div>			
				<?php } } else { ?>
					 <div class="nk-footer-text">
					    <p class="foterp spl-bg" >
					        No Records Found
					    </p>
					 </div>
				<?php } ?>

            </div>	
            
            <div class="col-lg-3 col-xs-12" ></div>
            
             <!--<div class="col-lg-8 col-xs-12 text-center"id="div1">                <div class="nk-footer-text">					<p class="foterp" style="font-weight: inherit;background: #f5f5f7;margin-left: 36px; text-align: left;padding: 45px;">                        <label id="label2"> &nbsp;Order Date </label> <label id="label1"> &nbsp;</label><span style="float: right;" onclick="show1();"><i class="fa fa-angle-down fa-fw"></i></span><br><br>                    </p>				</div>                </div>
             <div class="col-lg-8 col-xs-12 text-center" style="padding-top: 23px;" id="div2">                    <div class="nk-footer-text">					    <p class="foterp" style="font-weight: inherit;background: #f5f5f7;margin-left: 36px; text-align: left;padding: 45px;">                        <label id="label2"> &nbsp;Order Date </label> <label id="label1"> &nbsp;</label><span style="float: right;" onclick="show1();"><i class="fa fa-angle-down fa-fw"></i></span><br><br>                        <label id="label21"> &nbsp;Order No </label> <label id="label21"> &nbsp;</label><br><br>                        <label id="label22"> &nbsp;Garage </label> <label id="label22"> &nbsp;</label><br><br>                        <label id="label23"> &nbsp;Total Bill </label><label id="label23"> &nbsp;</label>						</p>					</div>            </div>	-->
			
			

	   </div>


		</div>


<div class="container">
<div class="row">
<div class="col-md-3 bike1">

</div>
 <div class="col-md-6"><!--<img src="img/GooglePlay.png" class="img-responsive" width="100%"/> --></div>
 
<div class="col-md-3"></div>

</div>



</div></section>

    <a class="scrolltop" href="#"><span class="fa fa-angle-up"></span></a>
   
<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';
var asset_url = '<?php echo asset_url();?>'; 
</script>
<script>
function ajaxindicatorstart(text)
{
	if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
	jQuery('body').append('<div id="resultLoading" style="display:none"><div><i class="fa fa-spinner fa-5x"></i><div>'+text+'</div></div><div class="bg"></div></div>');
	}

	jQuery('#resultLoading').css({
		'width':'100%',
		'height':'100%',
		'position':'fixed',
		'z-index':'10000000',
		'top':'0',
		'left':'0',
		'right':'0',
		'bottom':'0',
		'margin':'auto'
	});

	jQuery('#resultLoading .bg').css({
		'background':'#000000',
		'opacity':'0.7',
		'width':'100%',
		'height':'100%',
		'position':'absolute',
		'top':'0'
	});

	jQuery('#resultLoading>div:first').css({
		'width': '250px',
		'height':'75px',
		'text-align': 'center',
		'position': 'fixed',
		'top':'0',
		'left':'0',
		'right':'0',
		'bottom':'0',
		'margin':'auto',
		'font-size':'16px',
		'z-index':'10',
		'color':'#ffffff'

	});

    jQuery('#resultLoading .bg').height('100%');
       jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}
function ajaxindicatorstop()
{
    jQuery('#resultLoading .bg').height('100%');
       jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
} 
</script>

<script>
$('#div2').hide();
function show1()
{
	$('#div2').show();
	$('#div1').hide();
}

</script>