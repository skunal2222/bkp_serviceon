<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $template['title']; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- bikedoctor copy -->
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

		<!-- ./bikedoctor copy -->

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/common/css/style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/responsive.css">
		<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/common/css/index-responsive.css">

		<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/bootstrapValidator.css">

		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

		<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
		<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>

		<script type="text/javascript">
			var base_url = '<?php echo base_url(); ?>';
			var asset_url = '<?php echo asset_url();?>frontend/';
		</script>
	</head>
	<body>
	    <?php echo $template['partials']['header']; ?>
	    <?php echo $template['body']; ?>
		<?php echo $template['partials']['footer']; ?>

		
		<script src="<?php echo asset_url();?>frontend/common/js/index.js"></script>

		<script type="text/javascript">
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
	</body>
</html>






