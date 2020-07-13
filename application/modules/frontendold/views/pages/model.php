<style>
.radiobtn
{
  width:23px;
  height:23px;
}

@media only screen and (max-width:600px) and (min-width:300px){
br{
display:none !important;
}
}
</style>
<br><br>
		<div class="container">
			<div class="row">
				
	<?php if(isset ($_SESSION['model_id'])){?>	
				<?php  foreach ($models as $model) { ?>
				<div class="col-md-2 text-center mno">
				<!-- 	<img src="<?php //echo asset_url(); ?><?php //echo $model['image'];?>" width="180px" height="150px" class="img-responsive" id="image1"> -->
					<p class="foterp" id="p1"><?php echo $model['name'];?></p>
					<input id="model_id" name="model_id" value="<?php echo $model['id'];?>" <?php if($_SESSION['model_id']==$model['id']) { echo 'checked'; } ?> type="radio" class="radiobtn">
				</div>
<?php } ?>

<?php } else { ?>
	<?php  foreach ($models as $model) { ?>
				<div class="col-md-2 text-center mno">
				<!-- 	<img src="<?php //echo asset_url(); ?><?php //echo $model['image'];?>" width="180px" height="150px" class="img-responsive" id="image1"> -->
					<p class="foterp" id="p1"><?php echo $model['name'];?></p>
					<input id="model_id" name="model_id" value="<?php echo $model['id'];?>" type="radio" class="radiobtn">
				</div>
<?php } ?>

	<?php } ?>

				
				
			</div>
		</div>
	
	
	<script>
	$('input[name=model_id]').keypress(function(event) {
		 if (event.which == 13) {
	       event.preventDefault();
	       show3();
	       return false;
	   }
	});
	</script>	