<!DOCTYPE html>
<html lang="en">
<head>
<meta content="" property='fb:appid'>
<meta content="Most affordable bike and car servicing near you. Book online and get amazing offers on doorstep and pick up-drop service." property='og:description'>
<meta content="Garage2Ghar - Book bike and car servicing at your doorstep online" property='og:title'>
<meta content='<?php echo base_url();?>' property='og:url'>
<meta content='<?php echo asset_url();?>images/fbshare1.jpg' property='og:image'>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $template['title']; ?></title>
<meta name="description" content="<?php echo $description;?>">
<meta name="keywords" content="<?php // echo $keywords?>">
<meta name="author" content="Brandzgarage">
<meta name="categories" content="E-Commerce">
<meta name="generator" content="">
<meta name="google-site-verification" content="0Uh76CrTn-tdD7Z2kTn28vi3-zRMAjRLie1DcB5bdEs" />
<meta name="msvalidate.01" content="DEFF8E1D668997BB8CFD4264E2C05F79" />

<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-111679248-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		
		gtag('config', 'UA-111679248-1');
	</script>
<!-- Favicon -->
<link href="<?php echo asset_url();?>images/img/favicon.ico" rel="icon">
		
   	<script type="text/javascript">
			var base_url = '<?php echo base_url(); ?>';
			var asset_url = '<?php echo asset_url();?>'; 
	</script>
</head>

<body>
    <?php echo $template['partials']['header']; ?>
    <?php echo $template['body']; ?>
	<?php echo $template['partials']['footer']; ?>
</body>
</html>

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
