<div class="status ">
	<div class="status-data ">
		<div class="d-flex flex-row ">
			<div class="align-self-start">
				<i id="first-fas" class=" fas fa-motorcycle status-logo"></i>
			</div>
			<div class="align-self-start ml-4">
				<span class="status-title">
				<?php
					if ($order['status'] == 5 && ($order['rider_response'] >= 0 && $order['rider_response'] <= 5)) {
	        			echo "Order Canceled!";
	        			echo "<span>&emsp;&emsp;&emsp;&emsp;<i class='fa fa-times' style='font-size:25px; color: red;'></i></span>";
	        		}
	        		else
	        		{
						if ($order['rider_response'] == 0 || $order['rider_response'] == 1) {
		        			echo "Order Received";
		        		} else if ($order['rider_response'] >= 2 && $order['rider_response'] <= 5) {
		        			echo "Pickup in progress";
		        		?>
		        			<span>&emsp;&emsp;&emsp;&emsp;<a href="tel:<?= $order['rider_mobile']; ?>"><i class='fa fa-phone' style='font-size:25px; color:lime;'></i></a></span>
		        		<?php
		        		} else if ($order['rider_response'] == 6) {
		        			echo "Pickup Completed";
		        			echo "<span>&emsp;&emsp;&emsp;&emsp;<i class='fa fa-check' style='font-size:25px; color: lime;'></i></span>";
		        		}
					}
				?>
				</span>
				<p class="status-content">
				<?php 
						$rider_name = ucwords($order['rider_name']);
						$garage_name = ucwords($order['garage_name']);

					if ($order['status'] == 5 && ($order['rider_response'] >= 0 && $order['rider_response'] <= 5)) {
	        			echo "Sorry your order has been canceled. contact us - <a href='tel:8850699195'>8850699195</a>";
	        		} 
	        		else 
	        		{
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
					if ($order['status'] == 5 && $order['rider_response'] == 6) {
						echo "Order Canceled!";
	        			echo "<span>&emsp;&emsp;&emsp;&emsp;<i class='fa fa-times' style='font-size:25px; color: red;'></i></span>";
					}
					else 
					{
						if ($order['rider_response'] == 6 && $order['status'] == 1) { 
		        			echo "Bike reached at garage";
		        		} else if ($order['rider_response'] == 6 && ($order['status'] >= 2 && $order['status'] < 4)) {
		        			echo "Bike Inspection Done";
		        			echo "<span>&emsp;&emsp;&emsp;&emsp;<a href='tel:8850699195'><i class='fa fa-phone' style='font-size:25px; color:lime;'></i></a></span>";
		        		} else if ($order['rider_response'] == 6 && $order['status'] == 4) {
		        			echo "Estimate Approved";
		        			echo "<span>&emsp;&emsp;&emsp;&emsp;<a href='tel:8850699195'><i class='fa fa-phone' style='font-size:25px; color:lime;'></i></a></span>";
		        		} else if ($order['status'] == 7) {
		        			echo "Invoice Generated";
		        			echo "<span>&emsp;&emsp;&emsp;&emsp;<i class='fa fa-check' style='font-size:25px; color: lime;'></i></span>";
		        		} else if ($order['status'] == 0) {
		        			// echo "Bike is yet to reach garage";
		        			echo "Bike reached at garage";
		        		}
					}
				?>
				</span>
				<p class="status-content pt-1">
				<?php
						$garage_name = ucwords($order['garage_name']);
					if ($order['status'] == 0) {
	        			echo "Bike is ready to inspection.";
	        		} else if ($order['status'] == 1) {
	        			echo "Bike is ready to inspection.";
	        		} else if ($order['status'] == 2) {
	        			echo "Estimate generated, Waiting for approval.";
	        		} else if ($order['status'] == 3) {
	        			echo "Thanks for approval.";
	        		} else if ($order['status'] == 4) {
	        			echo "Bike work is in progress.";
	        		} else if ($order['status'] == 5) {
	        			echo "Sorry your order has been canceled. contact us - <a href='tel:8850699195'>8850699195</a>";
	        		} else if ($order['status'] == 7) {
	        			echo "Work Completed";
	        		}
	        	?>
				</p>
			</div>
		</div>
		<hr class="status-break">	
	</div>

	<div class="status-data pt-4">
		<div class="d-flex flex-row ">
			<div class="align-self-start">
				<i id="<?= ($order['status'] == 7)?'first-fas':''; ?>" class="fas fa-motorcycle status-logo"></i>
			</div>

			<div class="align-self-start ml-4">
				<span class="<?= ($order['status'] == 7)?"status-title":"status-title-2"; ?>">
				<?php
					if ($order['status'] == 7 && ($order['delivery_rider_response'] >= 0 && $order['delivery_rider_response'] <= 6)) {
	        			echo "Bike work is completed";
						echo "<span>&emsp;&emsp;&emsp;&emsp;<i class='fa fa-check' style='font-size:25px; color: lime;'></i></span>";
	        		} else if ($order['status'] >= 0 && $order['status'] < 7) {
	        			echo "Bike work is completed";
	        		}
				?>
				</span>
				<p class="status-content pt-2">
				<?php
					// if ($order['status'] == 7) {
	        			echo "Bike is ready for delivery.";
	        		// }
	        	?>
				</p>
			</div>
		</div>	
		<hr class="status-break">
	</div>

	<div class="status-data pt-4">
		<div class="d-flex flex-row ">
			<div class="align-self-start">
				<i id="<?= ($order['status'] == 7 && $order['delivery_rider_response'] >= 1)?'first-fas':''; ?>" class="fas fa-motorcycle status-logo"></i>
			</div>

			<div class="align-self-start ml-4">
				<span class="<?= ($order['status'] == 7 && $order['delivery_rider_response'] >= 1)?"status-title":"status-title-2"; ?>">
					<?php 
						if ($order['delivery_rider_response'] == 1) {
							echo "Rider Assigning in progress";
						} else if ($order['delivery_rider_response'] >= 2 && $order['delivery_rider_response'] <= 5) {
	        				echo "Delivery is in progress";
	        		?>
	        				<span>&emsp;&emsp;&emsp;&emsp;<a href="tel:<?= $order['delivery_rider_mobile']; ?>"><i class='fa fa-phone' style='font-size:25px; color:lime;'></i></a></span>
	        		<?php	
		        		} else if ($order['delivery_rider_response'] == 6) {
		        			echo "Bike Delivered";
		        			echo "<span>&emsp;&emsp;&emsp;&emsp;<i class='fa fa-check' style='font-size:25px; color: lime;'></i></span>";
		        		} else if ($order['delivery_rider_response'] == 0) {
		        			echo "Assign rider to delivery";
		        		}
					?>
				</span>
				<p class="status-content pt-1">
					<?php 
						$rider_name = ucwords($order['delivery_rider_name']);
						$garage_name = ucwords($order['garage_name']);

						if ($order['delivery_rider_response'] == 0 || $order['delivery_rider_response'] == 1) {
		        			echo "We will assign a pickup person as soon as possible to deliver your bike.";
		        		} else if ($order['delivery_rider_response'] == 2) {
		        			echo $rider_name." is assigned to pickup your bike from ".$garage_name." and will deliver to your location.";
		        		} else if ($order['delivery_rider_response'] == 3) {
		        			echo $rider_name." is on the way to pickup your bike.";
		        		} else if ($order['delivery_rider_response'] == 4) {
		        			echo $rider_name." has arrived at ".$garage_name." for pickup.";
		        		} else if ($order['delivery_rider_response'] == 5) {
		        			echo $rider_name." is on the way to your location.";
		        		} else if ($order['delivery_rider_response'] == 6) { 
		        			echo "Bike delivered successfully! Happy Ridding.";
		        		}
				?>
				</p>
			</div>
		</div>
	</div>
</div>