			<div class="row spl-box">
				<?php if(!empty($brandList)){ 
						foreach ($brandList as $key => $value) {  
					?>
				<div class="col-sm">
					<div class="brand">
						<div class="radio">
						  <label><input type="radio" name="optradio" value="<?php echo $value['id']; ?>">
							<img src="<?php echo asset_url();?><?php echo $value['image']; ?>" alt="<?php echo $value['name']; ?>"  width="80px" height="80px">
						  </label>
						</div>
					</div>
				</div>  
			<?php } } ?>
			</div>
			<div class="confirm text-center">
				<button type="button" class="custom-btn1" id="brand_button" onclick="setBrand()" disabled="true">Continue</button>
			</div> 