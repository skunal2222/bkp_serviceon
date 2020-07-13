<?php
//print_r($_SESSION);
 ?>
<div class="thankyou">
	<div class="container">
            <?php if($status == 'Success') {?>
		<div class="thankyou-box">
			<img src="<?php echo asset_url();?>frontend/images/new/thankyou.png" alt="thankyou">
			<h1>Thank You</h1>
			<h2>Payment Successfully Complete!!</h2>
			
		</div>
            <?php } else {?>
                 <div class="thankyou-box">
			<!--<img src="<?php echo asset_url();?>frontend/images/new/thankyou.png" alt="thankyou">-->
			<h1>OOPS</h1>
			<h2>Payment Failed!!</h2>
                        <h2><a href="<?= $url?>">TRY AGRAIN</a></h2>
		</div>
            <?php }?>
	</div>
</div>