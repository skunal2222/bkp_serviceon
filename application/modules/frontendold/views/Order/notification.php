<link href="<?php echo asset_url();?>css/order.css" rel="stylesheet">   

    <section class="about" id="about" style='background-image: url("<?php echo asset_url();?>images/img/templatemo_main_bg_bottom_wrapper.jpg");background-position: 0px -65.24px;'>
     <div class="container">
      <div class="row">

        <div class="col-lg-3 col-xs-12">
			<div class="nk-footer-text" style="margin: 23px;">
					<!-- <ul> -->
					<!-- <li><a href="#section-london">London</a></li> -->
					<!-- <li><a href="#section-paris">Paris</a></li> -->
					<!-- </ul> -->
			    <a href="<?php echo base_url();?>order/trackorder"><p class="foterp">Ongoing Orders</p></a>
				<a href="<?php echo base_url();?>order/history"><p class="foterp">Order	History</p></a>
				<!--<a href="#"><p class="foterp act">Notifications <span>2</span></p></a>-->
				<a href="<?php echo base_url();?>order/setting"><p class="foterp">Settings</p></a>
				<a href="<?php echo base_url();?>order/wallet"><p class="foterp">Wallet</p></a>
				<a href="<?php echo base_url();?>order/offer"><p class="foterp">Offers</p></a>
				</div>
			</div>
            
            <div class="col-lg-9 col-xs-12 text-center" style="padding-top: 23px;">
			<?php foreach($detail as $row){ ?>
                    <div class="nk-footer-text">
					<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
                        <p class="foterp" style="font-weight: inherit;background: #f5f5f7;margin-left: 36px; text-align: left;padding: 10px;"  id="div1"><?php echo $row['message'];?>
                        <input type="hidden" id="id1" name="id1" value="<?php echo $row['id'];?>">
						<span style="float: right;"><img src="<?php echo asset_url();?>images/img/no1.png" class="img-responsive" onclick="remove();" style="cursor: pointer"/></span>
						<span style="float: right;"><img src="<?php echo asset_url();?>images/img/yes1.png" class="img-responsive" style="margin-right: 27px;"/></span>
						</p>
						</div>
					<?php } ?>
            </div>	
            <!-- <div class="col-lg-3 col-xs-12 text-center"> -->
              
            <!-- </div> -->
			
			

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

function remove() {
	$("#div1").remove();
}
</script>