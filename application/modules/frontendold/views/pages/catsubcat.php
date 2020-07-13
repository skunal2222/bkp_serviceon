<style>.radiobtn{  width:23px;  height:23px;}</style>
		<div class="container" id="catsubcat123">
			<div class="row">
				
<?php if(isset ($_SESSION['catsubcat_id'])){?>	
<?php foreach($_SESSION['catsubcat_id'] as $catofsub){
	$user_id = $catofsub;
	$uid[] = $user_id;
}  
$cat_subcatid = implode(",", $uid);
?>
				<?php  foreach ($subcat as $row) { ?>
				<div class="col-md-3 text-center mno">
					<br />
					<br />
					<p class="foterp" id="p1"><?php echo $row['name'];?></p>
					<!--<input id="catsubcat_id" name="catsubcat_id" value="<?php echo $row['id'];?>" <?php if($_SESSION['catsubcat_id']==$row['id']) { echo 'checked'; } ?> type="radio" class="radiobtn">-->
					<!--<input type="checkbox" id="catsubcat_id" name="catsubcat_id[]" value="<?php // echo $cat_subcatid; ?> class="radiobtn" >-->
					<?php //foreach($productsedit as $pro) {?>
					<?php 
						 $commaseparatedlist = explode(',',$cat_subcatid); ?>
						<input type="checkbox" id="catsubcat_id" name="catsubcat_id[]" value="<?php echo $row['id'] ?>" <?php if (in_array($row['id'], $commaseparatedlist))  { echo 'checked'; } ?> class="radiobtn" >
					<?php // }  ?>
				</div>
<?php } ?>

<?php } else { ?>
	<?php  foreach ($subcat as $row) { ?>
				<div class="col-md-3 text-center mno">
					<br />
					<br />
					<p class="foterp" id="p1"><?php echo $row['name'];?></p>
					<!--<input id="catsubcat_id" name="catsubcat_id" value="<?php echo $row['id'];?>" type="radio" class="radiobtn">-->
					<input type="checkbox" id="catsubcat_id" name="catsubcat_id[]" value="<?php echo $row['id'];?>" onkeypress="checkcatofsubcat(event);"class="radiobtn">
				</div>
<?php } ?>


	<?php } ?>
				<div class="col-md-1"></div>
				
			</div>
		</div>
		

		<script>
		$('input[name=catsubcat_id]').keypress(function(event) {
			 if (event.which == 13) {
		       event.preventDefault();
		       show5();
		       return false;
		   }
		});

</script>
		