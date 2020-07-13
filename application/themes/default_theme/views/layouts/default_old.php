<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $template['title']; ?></title>
   		<meta charset="utf-8">
    	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
    	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
     	<meta name="description" content="<?php echo $description;?>">
     	<meta name="keywords" content="<?php echo $keywords;?>">
    	<meta name="author" content="Brandzgarage">
		<meta name="categories" content="">
		<meta name="generator" content="Brandzgarage">
		<!-- <meta http-equiv="refresh" content="<?php echo $txt; ?>" /> -->
		<meta property="og:url"           content="<?= current_url()?>" />
          <meta property="og:type"          content="website" />
          <meta property="og:title"         content="<?php echo isset($ogtitle) ? $ogtitle : ''; ?>" />
          <meta property="og:description"   content="<?php echo isset($ogdes) ? $ogdes : ''; ?>" />
          <meta property="og:image"         content="<?php echo isset($ogimage) ? $ogimage : ''; ?>" />

    		<!--[if lt IE 9]>
            	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        	<![endif]-->
		<link rel="icon" href="<?php echo asset_url();?>frontend/images/icon.png" type="image/x-icon" />
   		<link rel="shortcut icon" href="<?php echo asset_url();?>frontend/images/favicon.ico">
    	<link rel="stylesheet" href="<?php echo asset_url();?>frontend/css/font-cion.css">
    	<link href="<?php echo asset_url();?>frontend/css/font.css" rel="stylesheet">
        <script type="text/javascript" src="<?php echo asset_url();?>frontend/dist/js/jquery-3.2.1.min.js"></script>



		    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/dist/css/bootstrap.min.css">
		    <link href="<?php echo asset_url();?>frontend/css/<?php echo $page;?>.css" rel="stylesheet">
		    <link href="<?php echo asset_url();?>frontend/css/form.css" rel="stylesheet">
            <link href="<?php echo asset_url();?>frontend/css/glyphicon.css" rel="stylesheet">
            <!--  <link rel="stylesheet" href="<?php echo asset_url();?>dist/css/bootstrap-material-design.min.css">-->
            <link rel="stylesheet" href="<?php echo asset_url();?>frontend/font-awesome-4.7.0/css/font-awesome.min.css">
        	<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/style.css">
        	<script type="text/javascript" src="<?php echo asset_url();?>frontend/dist/js/bootstrap.min.js"></script>
        	<!-- <script src="<?php echo asset_url();?>dist/js/material.min.js"></script>-->
        	<script type="text/javascript" src="<?php echo asset_url();?>frontend/js/script.js"></script>


        	<script src="<?php echo asset_url();?>frontend/common/js/sweetalert.min.js"></script>
		        	<!-- <script src="<?php echo asset_url();?>js/lib/jquery/jquery.min.js"></script> -->
					<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
					<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
				<!-- 	<script src="<?php echo asset_url();?>js/bootstrap.min.js"></script> -->

		<!--custom js and css starts -->
		    <link href="<?php echo asset_url();?>frontend/css/filetree.css" rel="stylesheet">
		    <script type="text/javascript" src="<?php echo asset_url();?>frontend/js/filetree.js"></script>
		<!--custom js and css ends -->
                <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-123202152-4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-123202152-4');
</script>


        <script type="text/javascript">
			var base_url = '<?php echo base_url(); ?>';
			var asset_url = '<?php echo asset_url();?>frontend/';
		</script>

		<div id="google_translate_element"></div>
		<script type="text/javascript">
			function googleTranslateElementInit() {
			  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'hi', layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL}, 'google_translate_element');
			}
		</script>
		<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

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




