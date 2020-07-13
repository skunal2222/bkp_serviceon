<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Brandzgarage">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title><?php echo $template['title']; ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo asset_url();?>backend/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo asset_url();?>backend/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
     <!-- Menu CSS -->
    <link href="<?php echo asset_url();?>backend/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="<?php echo asset_url();?>backend/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?php echo asset_url();?>backend/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo asset_url();?>backend/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
  <link href="<?php echo asset_url();?>backend/css/style.css" rel="stylesheet">
      <!--color CSS -->
    <link href="<?php echo asset_url();?>backend/css/colors/default.css" id="theme" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
	<script src="<?php echo asset_url();?>backend/bower_components/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript">
		var base_url = '<?php echo base_url(); ?>';
		var asset_url = '<?php echo asset_url();?>'; 
	</script>
</head>

<body>

	<div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
	<div id="wrapper">
		<?php echo $template['partials']['header']; ?>
		<?php echo $template['partials']['leftnav']; ?>
		<?php echo $template['body']; ?>
		<?php echo $template['partials']['footer']; ?>
	</div>
	
</body>
</html>
<script src="<?php echo asset_url();?>js/metisMenu.min.js"></script>
<script src="<?php echo asset_url();?>js/sb-admin-2.js"></script>
<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>

<script>
function ajaxindicatorstart(text)
{
	if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
	jQuery('body').append('<div id="resultLoading" style="display:none"><div><div class="spinner"></div><div>'+text+'</div></div><div class="bg"></div></div>');
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