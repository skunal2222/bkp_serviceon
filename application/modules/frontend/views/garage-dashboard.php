<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/dashboard-responsive.css">
<section class="garage-details-services">
	<div class="container-fluid">
		<div class="section-padding">
				<div class="row">
					<div class="col-md-11 mx-auto">
						<div class="row">
							<div class="col-md-4 px-auto">
								<div class="card garage-details-card">
									<div class="text-center">
									  	<img class="img-fluid" src="<?php echo asset_url(); ?><?= (isset($garage_detail['image']))? $garage_detail['image'] : 'frontend/images/item-card.png'; ?>" onerror="this.onerror=null; this.src='<?php echo asset_url(); ?>frontend/images/item-card.png'" style="height: 207px; width: 325px;" alt="Card image cap">
									</div>

								 	<div class="card-body">
								  		<div class="garage-details-card-body">
									  		<h5 class="card-title search-garage-name"><?= (isset($garage_detail['garage_name']))?$garage_detail['garage_name']:"GARAGENAME"; ?></h5>
									    	<p class="card-text search-city-name"><?= (isset($garage_detail['landmark']))?$garage_detail['landmark']:""; ?></p>
									    
									    	<div class="d-flex align-items-center justify-content-around mt-4">
									    		<div class="d-flex align-items-center">
									    			<img class="rating-star " src="<?php echo asset_url();?>frontend/images/rating.png">
									    			<p><?= (!empty($garage_detail['rating']))?$garage_detail['rating']:0; ?></p>
									    		</div>

									    		<div class="d-flex align-items-center">
									    			<img class="price-img " src="<?php echo asset_url();?>frontend/images/moderate.jpg">
									    			<p><?= !empty($garage_detail['moderate'])?$garage_detail['moderate']:"NA"; ?></p>
									    		</div>
									    
									    		<div class="d-flex align-items-center">
													<img class="timer-img mr-2" src="<?php echo asset_url();?>frontend/images/time-remain.png" class="pl-2">
									    			<p><?= sprintf('%.1f KM', $garage_detail['distance']); ?> away</p>	
									    		</div>
									    	</div>

									    	<div class="offers-banner-text d-none">
									    		<div class="d-flex justify-content-center align-items-center current-offer-text">
									    			<img class="sale-copy-img pr-2" src="images/sale copy.png">
													<h5 class="current-offer">10% off on all services</h5>
									    		</div>
									    	</div>								  			
								  		</div>
									</div>
								</div>
							</div>

							<div class="col-md-7 offset-md-1">
								<h5 class="category-list-header">Category List</h5>

								<div class="service-category-card">
									<form id="frm_cats" action="<?= base_url() ?>booking-confirm" method="POST" onsubmit="return goto_bookingconfirm(this);">
										<input type="hidden" name="vendor_id" value="<?= $this->uri->segment(4); ?>">
										<input type="hidden" name="distance" value="<?= $garage_detail['distance']; ?>">
										<input type="hidden" name="ref_url" value="<?= current_url() ?>">
										<div class="d-flex row">
										<?php $catno=1; foreach ($servicegroup as $category) { ?>
												<div class="custom-control custom-checkbox col-lg-6 col-md-6 col-sm-12">
													<input type="checkbox" class="custom-control-input ch-category" id="ch<?= $catno ?>" name="categories[]" value="<?= $category['id'] ?>">
													<label class="custom-control-label" for="ch<?= $catno ?>"><?= $category['name'] ?></label>
												</div>
										<?php $catno++; } ?>
										</div>
										<span id="cat-error" style="color: red;"></span>
										<div class="garage-summary-btn pt-5 col-md-10 d-flex justify-content-center">
											<div class="d-flex justify-content-center">
												<button class="">Proceed</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</section>

<script src="<?php echo asset_url();?>frontend/js/ResizeSensor.js"></script>
<script src="<?php echo asset_url();?>frontend/js/theia-sticky-sidebar.js"></script>
<script type="text/javascript">

function goto_bookingconfirm(frmid) {
	//var cats = selected_category();
	var $cats = $(frmid).find('input[name="categories[]"]:checked');
	if (!$cats.length) {
		$("#cat-error").html("Please select at least one category");
		return false;
	} 
}

/*function selected_category() {
	var filter = [];
    $('.ch-category:checked').each(function(){
        filter.push($(this).val());
    });
    return filter;
}*/

/*function get_login() {
	<?php if(empty($_SESSION['olouserid'])){ ?>
		$.post(base_url + 'get_login_view', {}, function (data) {
			$("#login_modal").empty();
			$("#login_modal").html(data.view);
			$("#md-login").modal('show');
		}, "json");
	<?php } else { ?>
		return true;
	<?php } ?>
}*/

$(".ch-category").click(function () {
	$("#cat-error").html("");
});

$('body').attr('id','particular-garage');

/*$('.check-color').click(function(){
	$(this).toggleClass("applyColor");
});*/

function openCity(evt, cityName) {
	var i, tabcontent, tablinks;
	tabcontent = document.getElementsByClassName("tabcontent");
	for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	}

	tablinks = document.getElementsByClassName("tablinks");
	for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active", "");
	}
	document.getElementById(cityName).style.display = "block";
	evt.currentTarget.className += " active";
}
</script>

<script type="text/javascript">
$('.tablinks-btn-2').click(function(){
	$('#category-type-2').addClass("padding-class");
})
</script>