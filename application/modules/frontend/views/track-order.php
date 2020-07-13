<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>frontend/css/track-order-responsive.css">
<section id="track-order">
	<div class="row justify-content-between track-order-header">
		<div class="col-lg-6 col-sm-12">
			<h3 class="track-order-title">Track Order : <?= $order['ordercode']; ?></h3>
			<h3 class="track-order-details">order placed on <?= date('d-M-y', strtotime($order['ordered_on'])); ?> | pick up date & time - <?= date('d-M-y', strtotime($order['pickup_date'])); ?> | <?= $order['slot']; ?></h3>
			<?php // echo "<pre>"; print_r($order); die(); ?>
			<input type="hidden" id="rd_lt" value="<?= $order['latitude']; ?>">
			<input type="hidden" id="rd_lg" value="<?= $order['longitude']; ?>">
			<input type="hidden" id="vd_lt" value="<?= $order['vendor_latitude']; ?>">
			<input type="hidden" id="vd_lg" value="<?= $order['vendor_longitude']; ?>">
		</div>

		<div class="col-lg-4 text-right order-help">
			<span class="pr-5"><a href="#">Cancel Order</a></span>
			<span><a href="#">Help</a></span>
		</div>
	</div>
</section>

<section id="map-bike-status">
	<div class="row map-detail">
		<div class="col-lg-7 col-md-7 col-sm-12">
			<div id="map"></div>
		</div>

		<div class="col-lg-5 col-md-5 col-sm-12 status-card">
			<div class="card">
				<div class="card-body" id="statusView">
					<!-- <div class="status ">
						<div class="status-data ">
							<div class="d-flex flex-row ">
								<div class="align-self-start">
									<i id="first-fas" class=" fas fa-motorcycle status-logo"></i>
								</div>

								<div class="align-self-start ml-4">
									<span class="status-title"><?php
										if ($order['rider_response'] == 0 || $order['rider_response'] == 1) {
						        			echo "Order Received";
						        		} else if ($order['rider_response'] >= 2 && $order['rider_response'] <= 5) {
						        			echo "Pickup in progress"; ?>
						        			<span>&emsp;&emsp;&emsp;&emsp;<a href="tel:<?= $order['rider_mobile']; ?>"><i class='fa fa-phone' style='font-size:25px; color:lime;'></i></a></span>
						        	<?php
						        		} else if ($order['rider_response'] == 6) {
						        			echo "Pickup Completed";
						        			echo "<span>&emsp;&emsp;&emsp;&emsp;<i class='fa fa-check' style='font-size:25px; color: lime;'></i></span>";
						        		}
									?></span>
									<p class="status-content">
									<?php 
											$rider_name = ucwords($order['rider_name']);
											$garage_name = ucwords($order['garage_name']);
										if ($order['rider_response'] == 0 || $order['rider_response'] == 1) {
						        			echo "We will assign a pickup person as soon as possible to pickup your bike.";
						        		} else if ($order['rider_response'] == 2) {
						        			echo $rider_name." is assigned to pick up your bike and will deliver to ".$garage_name.".";
						        		} else if ($order['rider_response'] == 3) {
						        			echo $rider_name." is on the way to pick up your bike.";
						        		} else if ($order['rider_response'] == 4) {
						        			echo $rider_name." has arrived at your location for pickup.";
						        		} else if ($order['rider_response'] == 5) {
						        			echo $rider_name." is on the way to ".$garage_name.".";
						        		} else if ($order['rider_response'] == 6) { 
						        			echo "Your bike reached to ".$garage_name.".";
						        		}
									?>
									</p>
								</div>
							</div>
							<hr class="status-break mb-3">	
						</div>

						<div class="status-data pt-4">
							<div class="d-flex flex-row ">
								<div class="align-self-start">
									<i id="<?= ($order['rider_response'] == 6)?'first-fas':''; ?>" class="fas fa-motorcycle status-logo"></i>
								</div>

								<div class="align-self-start ml-4">
									<span class="<?= ($order['rider_response'] == 6)?'status-title':'status-title-2'; ?>">
										<?php
										if ($order['rider_response'] == 6) { 
						        			echo "Bike reached at garage";
						        		} else {
						        			echo "Bike is yet to reach garage";
						        		}
									?>
									</span>
									<p class="status-content pt-1">We will Assign a pick up person on 20-jan-19 to pick up your bike.</p>
								</div>
							</div>
							<hr class="status-break">	
						</div>

						<div class="status-data pt-4">
							<div class="d-flex flex-row ">
								<div class="align-self-start">
									<i class="fas fa-motorcycle status-logo"></i>
								</div>

								<div class="align-self-start ml-4">
									<span class="status-title-2">Service is yet complete</span>
									<p class="status-content pt-2">We will Assign a pick up person on 20-jan-19 to pick up your bike.</p>
								</div>
							</div>	
							<hr class="status-break">
						</div>

						<div class="status-data pt-4">
							<div class="d-flex flex-row ">
								<div class="align-self-start">
									<i class="fas fa-motorcycle status-logo"></i>
								</div>

								<div class="align-self-start ml-4">
									<span class="status-title-2">Bike Delivered</span>
									<p class="status-content pt-1">We will Assign a pick up person on 20-jan-19 to pick up your bike.</p>
								</div>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</div>
</section>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLE_MAP_API_KEY; ?>&callback=order_tracking">
</script>
<script type="text/javascript">

	// setInterval(function(){ order_tracking(); }, 5000);

	function order_tracking() {
		$.get(base_url+"order_tracking",{ordercode:"<?= $order['ordercode']; ?>"},function (response) {
			if (response.status == 1) {
				$("#statusView").html(response.status_view);
				var lati = parseFloat(response.rd_lt);
				var long = parseFloat(response.rd_lg);
				var ven_lati = parseFloat(response.vd_lt);
				var ven_long = parseFloat(response.vd_lg);
				initMap(lati,long,ven_lati,ven_long);
			} else if(response.status == 2) {
				location.reload();
			}
		},"json");
	}

	function initMap(lati,long,ven_lati,ven_long) {
		var lati = lati;
		var long = long;
		var ven_lati = ven_lati;
		var ven_long = ven_long;
		var directionsService = new google.maps.DirectionsService();
		var directionsRenderer = new google.maps.DirectionsRenderer();
		var mapOptions = {
		    zoom:10,
		    center: {lat: lati , lng: long},
		    map:map
		}
		var map = new google.maps.Map(document.getElementById('map'), mapOptions);
		directionsRenderer.setMap(map);
		getRoute(directionsService,directionsRenderer,lati,long,ven_lati,ven_long);
	}

	function getRoute(directionsService,directionsRenderer,lati,long,ven_lati,ven_long) {
		var start = new google.maps.LatLng(lati, long);
	  	var end = new google.maps.LatLng(ven_lati, ven_long);
	  	var request = {
		    origin: start,
		    destination: end,
		    travelMode: 'DRIVING'
		};
		// setDirections(directionsService,directionsRenderer,request);
	  	directionsService.route(request, function(result, status) {
	    if (status == 'OK') {
	    	directionsRenderer.setDirections(result);
	    }
	  	});
	}

/*	function setDirections(directionsService,directionsRenderer,request) {
		directionsService.route(request, function(result, status) {
	    if (status == 'OK') {
	    	directionsRenderer.setDirections(result);
	    }
	  	});	
	}*/
</script>