<style>
.radiobtn
{
  width:23px;
  height:23px;
}

</style>

		<div class="container">
			<div class="row">
				<?php if(isset ($_SESSION['brand_id'])){?>	
				<?php  foreach ($brands as $brand) { ?>
				<div class="col-md-2 text-center mno">
					<img src="<?php echo asset_url(); ?><?php echo $brand['image'];?>" width="80px" height="80px" class="img-responsive" id="image1">
					<p class="foterp" id="p1"><?php echo $brand['name'];?></p>
					<input id="brand_id" name="brand_id" value="<?php echo $brand['id'];?>" <?php if($_SESSION['brand_id']==$brand['id']) { echo 'checked'; } ?> type="radio" class="radiobtn">
				</div>
<?php } ?>
<?php } else { ?>
	<?php  foreach ($brands as $brand) { ?>
				<div class="col-md-2 text-center mno">
					<img src="<?php echo asset_url(); ?><?php echo $brand['image'];?>" width="80px" height="80px" class="img-responsive" id="image1">
					<p class="foterp" id="p1"><?php echo $brand['name'];?></p>
					<input id="brand_id" name="brand_id" value="<?php echo $brand['id'];?>" type="radio" class="radiobtn">
				</div>
<?php } ?>
	<?php } ?>

	
				
				
			</div>
		</div>
		
		
<script>
$('input[name=brand_id]').keypress(function(event) {
		 if (event.which == 13) {
	        event.preventDefault();
	        show2();
	        return false;
	    }
	});
</script>
		