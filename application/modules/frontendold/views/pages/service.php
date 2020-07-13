<style>.radiobtn{  width:23px;  height:23px;}</style>
		<div class="container" id="service123">
			<div class="row">
				<div class="col-md-3"></div>
				

<?php if(isset ($_SESSION['service_id'])){?>	
				<?php  foreach ($service as $row) { ?>
				<div class="col-md-3 text-center mno">
					<img src="<?php echo asset_url(); ?><?php echo $row['service_icon'];?>" width="180px" height="150px" class="img-responsive" id="image1"><br />
					<br />
					<p class="foterp" id="p1"><?php echo $row['name'];?></p>
					<input id="service_id" name="service_id" value="<?php echo $row['id'];?>" <?php if($_SESSION['service_id']==$row['id']) { echo 'checked'; } ?> type="radio" class="radiobtn">
				</div>
<?php } ?>
<?php } else { ?>
	<?php  foreach ($service as $row) { ?>
				<div class="col-md-3 text-center mno">
					<img src="<?php echo asset_url(); ?><?php echo $row['service_icon'];?>" width="180px" height="150px" class="img-responsive" id="image1"><br />
					<br />
					<p class="foterp" id="p1"><?php echo $row['name'];?></p>
					<input id="service_id" name="service_id" value="<?php echo $row['id'];?>" type="radio" class="radiobtn">
				</div>
<?php } ?>
	<?php } ?>
				<div class="col-md-1"></div>
				
				<div class="col-md-2"></div>
			</div>
		</div>
		