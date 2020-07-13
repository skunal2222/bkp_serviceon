<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/offer-responsive.css">
<style type="text/css">
  .card-img-top{
    height: 250px !important;
  }
</style>
<section id="offer-section" class="bg-white pb-4">
	<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-12">
			<h4 class="offer-section-title">Offers</h4>
		</div>

		<div class="col-lg-10 col-md-10 col-sm-12">	
			<div class="our-offers">
				<div class="row pb-5 our-offers-col">

            <?php
              foreach ($offers as $key => $value) {
                if($offers[$key]['generic_or_unique']!=0){
            ?>	

  					<div class="col-lg-4 col-md-4 col-sm-12 offers-code-card">
  						<div class="card  item-detail-card">
  							<img class="card-img-top" src="<?= !empty($offers[$key]['image'])?asset_url().$offers[$key]['image']:asset_url()."frontend/images/item-card.png"; ?>">

  							<div class="offer-content pt-3">
  								<h6 class="text-success"><?= isset($offers[$key]['garage_name'])?$offers[$key]['garage_name']:""?></h6>
                  
                  <h6><?= $offers[$key]['discount']?>% Off on all services</h6>

  								<div class="offer-code d-flex align-items-center">
  									<h6 class="cpy"><?= !empty($offers[$key]['coupon_code'])?$offers[$key]['coupon_code']:"Garage specific";?></h6>
	  								<div class="ml-auto">
	  									<i class="fas fa-copy" style="cursor:pointer" onclick="copy('<?= isset($offers[$key]['coupon_code'])?$offers[$key]['coupon_code']:""?>')"></i>
	  								</div>
  								</div>
  								<small class="terms-conditions" onclick="expand_modal('<?= $offers[$key]['id']?>')">Terms and conditions</small>
                  <!-- <small class="terms-conditions" data-toggle="modal" data-target="#offer2-condition">Terms and conditions</small> -->
  							</div>
  						</div>
  					</div>

          <?php }}?>

  				</div>
			</div>
		</div>
	</div>
</section>


<!-- Modal 1 -->
 <div class="modal fade" id="offer-condition" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title offer-condition-title" id="exampleModalLabel">Terms & Conditions</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ee3837;  outline: none;">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>

	      	<div class="modal-body offer-condition-content">
		      	<p id="descriptionmeta"></p>
	      	</div>
	    </div>
	 </div>
</div>


<script type="text/javascript">
  function expand_modal(cid) {
    $.ajax({
      url: "<?= base_url('coupon/get_description')?>",
      cache: false,
      type: "POST",
      data: {'cid':cid},
      dataType: "json",
      success: function(data){
        var description = data.description;
        $('#descriptionmeta').text(description);
        $('#offer-condition').modal('show');
      }
    });
  }

  function copy(copyText) {
      var textarea = document.createElement("textarea");
      textarea.textContent = copyText;
      textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in MS Edge.
      document.body.appendChild(textarea);
      textarea.select();
      document.execCommand("copy"); 
      document.body.removeChild(textarea);
      alert("Copied!");

  }
</script>