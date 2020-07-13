<style>
<!--
.btn-plus{
	margin:5px 0px;
}
-->
</style>
<div id="page-wrapper">
	<div class="container-fluid">
 
	<div class="row">
		<div>
		</div>
		<div class="col-lg-12">
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	Cash Collection List
              	</div>
               	<div class="panel-body">
                	<div class="dataTable_wrapper">
                       	<table class="table table-striped table-bordered table-hover" id="tblRestos">
							<thead class="bg-info">
								<tr>
									<th>Sr. No.</th>
									<th>Order Code</th>
									<th>Rider Name</th>
									<th>Rider Mobile</th>
									<th>Ride Charges</th>
									<th>Mark As Paid<br><sub>(For Ride Charges)</sub></th>
									<th>Garage Amount</th>
									<th>Mark As Paid<br><sub>(For Garage amount)</sub></th>
									<th>Total Amount<br><sub>(Receive by rider)</sub></th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php $no = 0; if (isset($orders)) { ?>
							<?php foreach ($orders as $item):
								if ($item['handling_charges_received_to_serviceon'] != 1 || $item['garage_amount_received_to_serviceon'] != 1) {
								++$no;
							?>
								<tr>
									<td>
										<?php echo $no; ?>
									</td>
									<td>
										<?php echo $item['ordercode'];?>
									</td>
									<td>
										<?php echo $item['rider_name'];?>
									</td>
									<td>
										<?php echo $item['rider_mobile'];?>
									</td>
									<?php 
										$ride_charges = 0;
										$garage_charges = 0;
										$total_amount = 0;
										$is_checkbox_hc = "Online Paid";
										$is_checkbox_gc = "Online Paid";
										// $hcno = 0;
										// $gcno = 0;
										if ($item['handling_charges_collect_by_rider'] == 1) {
											$ride_charges = $item['applied_ride_charge'];
											/*$is_checkbox_hc = "<input type='checkbox' id='hc<?= no ?>' name='hc' value='1'>";*/
											$is_checkbox_hc = "COD Paid";
											// $hcno = "hc".$no;
										}

										if ($item['garage_charges_collect_by_rider'] == 1) {
											$garage_charges = $item['garage_amount_received_by_cod'];
											/*$is_checkbox_gc = "<input type='checkbox' id='gc<?= no ?>' name='gc' value='1'>";*/
											$is_checkbox_gc = "COD Paid";
											// $gcno = "gc".$no;
										}

										$total_amount = $ride_charges + $garage_charges;
									?>


									<td>
										<?php echo $ride_charges;?>
									</td>
									<td>
										<?php echo $is_checkbox_hc;?>
									</td>
									<td>
										<?php echo $garage_charges;?>
									</td>
									<td>
										<?php echo $is_checkbox_gc;?>
									</td>
									<td>
										<?php echo $total_amount;?>
									</td>
									<td>
										<button class="btn btn-success" onclick="btnrcved('<?= $item['orderid']; ?>');">Rs. <?= $total_amount; ?> Received</button>
									</td>
								</tr>
								<?php } endforeach;?>
							<?php } else { ?>
								<tr><td colspan="10">Records not found.</td></tr>
							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
  </div>
</div>
<script>
$(document).ready(function(){
    $('#tblRestos').DataTable();
});

function btnrcved(orderid) {
	$.post(base_url+'save_received_amt_by_rider',{orderid:orderid}, function(response) {
		if (response.status == 1) {
			alert("Data save successfully.");
		}
		location.reload();
	},"json");
}
</script>