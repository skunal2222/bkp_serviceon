<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/dashboard-responsive.css">
<section id="garage-wise-info">
	<div class="jumbotron">
		<div class="row align-items-center">
			<div class="col-lg-4 col-md-4 col-sm-4 col-12">
				<img class="garage-group-img" src="<?php echo asset_url(); ?><?= (isset($garage_detail['image']))? $garage_detail['image'] : 'frontend/images/item-card.png'; ?>" onerror="this.onerror=null; this.src='<?php echo asset_url(); ?>frontend/images/item-card.png'" style="height: 207px; width: 325px;">
			</div>

			<div class="col-lg-4 col-md-4 col-sm-4 col-12">
				<div>
					<h2 class="garage-name-title"><?= (isset($garage_detail['garage_name']))?$garage_detail['garage_name']:"GARAGENAME"; ?></h2>
					<h4 class="garage-speciality"><?= (isset($garage_detail['description']))?$garage_detail['description']:""; ?></h4>
				</div>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-4 col-12">
				<div class="text-right garage-ratings pr-4">
					<span>
						<img class="rating-star" src="<?php echo asset_url();?>frontend/images/rating.png">
					<?= (!empty($garage_detail['rating']))?$garage_detail['rating']:0; ?></span>
					<span class="mid-dot">.</span>
					<span ><img class="price-img mr-1" src="<?php echo asset_url();?>frontend/images/moderate.jpg"></span>
					<span>Moderate</span>
					<span class="mid-dot">.</span>
					<span><img class="timer-img" src="<?php echo asset_url();?>frontend/images/time-remain.png" class="pl-2"></span>
					<span><?= sprintf('%.1f KM', $garage_detail['distance']); ?></span>	
				</div>

				<div class="text-right d-flex justify-content-end">
					<div class="offer-banner text-center">
						<h5 class="current-offer">10% off on all services</h5>
					</div>
				</div>
			</div>
		</div>	
	</div>



	<div id="service-category" class="row leftSidebar">
		<div class="col-lg-2 col-md-2 col-sm-12 col-12">
			<div class="card garage-service-card" style="width: 14rem";>
				<div class="service-cate-card d-flex align-items-center mb-3">
					<h5 class="pl-3 service-cate-title align-items-center">Service Category</h5>
				</div>

				<div class="tab service-categories">
					<?php $no=1; foreach ($servicegroup as $value) { ?>						
					<div>
						<a href="#category-type-<?= $no ?>">
							<button class="tablinks tablinks-btn-2"><?= $value['name'] ?></button>
						</a>
					</div>
					<?php $no++; } ?>
				</div>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-12 category-type">
			<div id="" class="tabcontent">
				<div class="search-service d-flex justify-content-center">
					<form>
						<input type="search" name="" placeholder="search service" class="input-no-outline">
					</form>	
				</div>		

				<?php $catno=1; foreach ($servicegroup as $category) { ?>
				<div id="category-type-<?= $catno; ?>" class="service-categories-table">
					<h4 class="category-no"><?= $category['name'] ?></h4>
					<div class="d-flex justify-content-center">	
						<div class="card d-flex" style="width: 36rem">
							<div class="type-of-services pt-4">
								<div class=" d-flex justify-content-around align-items-center">
									<h5 class="service-no">Service 1</h5>
									<button class="check-color">select</button>
								</div>

								<div class=" d-flex justify-content-around align-items-center">
									<h5 class="service-no">Service 2</h5>
									<button class="check-color" >select</button>
								</div>

								<div class=" d-flex justify-content-around align-items-center">
									<h5 class="service-no">Service 3</h5>
									<button class="check-color">select</button>
								</div>

								<div class=" d-flex justify-content-around align-items-center">
									<h5 class="service-no">Service 4</h5>
									<button class="check-color">select</button>
								</div>

								<div class=" d-flex justify-content-around align-items-center">
									<h5 class="service-no">Service 5</h5>
									<button class="check-color">select</button>
								</div>

								<div class=" d-flex justify-content-around align-items-center">
									<h5 class="service-no">Service 6</h5>
									<button class="check-color">select</button>
								</div>

								<div class=" d-flex justify-content-around align-items-center">
									<h5 class="service-no">Service 7</h5>
									<button class="check-color">select</button>
								</div>

								<div id="link-2" class=" d-flex justify-content-around align-items-center">
									<h5 class="service-no">Service 8</h5>
									<button class="check-color">select</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php $catno++; } ?>	
			</div>
		</div>


		<div class="col-lg-3 col-md-3 col-sm-12 col-12 services-summary">
			<div class="card service-summary-card " style="width: 25rem";>
				<div class="summary-card d-flex align-items-center mb-1">
					<h5 class="pl-3 service-cate-title align-items-center">Summary</h5>
				</div>
				<div class="all-summary pt-4 align-items-center">
					<form>
						<div class=" d-flex justify-content-around align-items-center">
							<h5 class="">Service 1</h5>
							<a href="#"><i class="fas fa-times"></i></a>
						</div>

						<div class=" d-flex justify-content-around align-items-center">
							<h5 class="">Service 2</h5>
							<a href="#"><i class="fas fa-times"></i></a>
						</div>

						<div class=" d-flex justify-content-around align-items-center">
							<h5 class="">Service 3</h5>
							<a href="#"><i class="fas fa-times"></i></a>
						</div>

						<div class=" d-flex justify-content-around align-items-center">
							<h5 class="">Service 4</h5>
							<a href="#"><i class="fas fa-times"></i></a>
						</div>

						<div class=" d-flex justify-content-around align-items-center">
							<h5 class="">Service 5</h5>
							<a href="#"><i class="fas fa-times"></i></a>
						</div>

						<div class=" d-flex justify-content-around align-items-center">
							<h5 class="">Service 6</h5>
							<a href="#"><i class="fas fa-times"></i></a>
						</div>

						<div class=" d-flex justify-content-around align-items-center">
							<h5 class="">Service 7</h5>
							<a href="#"><i class="fas fa-times"></i></a>
						</div>

						<div class=" d-flex justify-content-around align-items-center">
							<h5 class="">Service 8</h5>
							<a href="#"><i class="fas fa-times"></i></a>
						</div>

						<div class="garage-summary-btn pt-5">
							<button><a href="<?php echo base_url(); ?>booking-confirm">Proceed</a></button>
						</div>
					</form>
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

	$('body').attr('id','particular-garage');

	$('.check-color').click(function(){
		$(this).toggleClass("applyColor");
	})



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


	document.getElementById("defaultOpen").click();
</script>

<script type="text/javascript">
	$('.tablinks-btn-2').click(function(){
		$('#category-type-2').addClass("padding-class");
	})
</script>