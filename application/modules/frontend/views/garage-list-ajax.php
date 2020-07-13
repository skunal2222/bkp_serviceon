<?php if (!empty($data)) {
foreach ($data as $garage) { 
    $garagename = str_replace(' ', '-', $garage['garage_name']);
	$url = base_url()."garage-details/".$garagename.'-'.$location.'/'.$latitude.'-'.$longitude.'/'.$garage['id'];
	if(isset($byvendor_id) && $byvendor_id == 1 && $garage['distance'] > 10) {
		$url = "#";
	?>
	<div class="align-items-center">
		<strong><h3>Sorry, This garage not provide service as per your selected location.</h3></strong>
    </div>
    <?php
	}

    // print_r($garage);die();
	?>
    <div class="col-lg-4 col-md-6 col-sm-12 garage-list-info">
        <a href="<?= $url ?>">
            <div class="card d-flex align-items-center item-detail-card">
                <div class="garage-image">
                    <img class="card-img-top" src="<?php echo asset_url(); ?><?= (isset($garage['image']))? $garage['image'] : 'frontend/images/item-card.png'; ?>" onerror="this.onerror=null; this.src='<?php echo asset_url(); ?>frontend/images/item-card.png'" style="height: 181.34px; width: 324.73px;">
                </div>
                <div class="garage-rating-distance">
                    <span>
                        <img class="rating-star" src="<?php echo asset_url();?>frontend/images/rating.png">
                    <?= (!empty($garage['rating']))? $garage['rating'] : 0 ?></span>
                    <span class="mid-dot">.</span>
                    <span ><img class="price-img mr-1" src="<?php echo asset_url();?>frontend/images/moderate.jpg"></span>
                    <span><?= !empty($garage['moderate'])?$garage['moderate']:"NA"; ?></span>
                    <span class="mid-dot">.</span>
                    <span><img class="timer-img" src="<?php echo asset_url();?>frontend/images/time-remain.png" class="pl-2"></span>
                    <span><?= sprintf('%.1f KM', $garage['distance']); ?></span>	
                </div>
            </div>	

            <div class="text-left garage-group-info pt-4">
                <span class="item-info-head"><?= $garage['garage_name'] ?></span>
                <p class="item-info-content"><?= (!empty($garage['landmark']))? $garage['landmark']:"" ?></p>
                <div class="text-left">
                    <hr style="background-color: #f9f9f9;">
                    <div class="discount-offer d-none"> 		
                        <span><img src="<?php echo asset_url();?>frontend/images/sale copy.png"></span>
                        <span class="discount-title">10% Off on all services</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
<?php } ?>
<?php } ?>