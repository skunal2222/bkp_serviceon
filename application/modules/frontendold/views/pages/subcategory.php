<style>.radiobtn{  width:23px;  height:23px;}
@media only screen and (max-width:768px) and (min-width:200px){
   .col-xs-custom1{
         width:33%;
   }
   .c1{
     width:100%;
   }
   .txt{
    font-size: 13px !important;
    font-weight: 500 !important;;
   
   }
   
</style>
<br><br>
		<div class="container c1">
			<div class="row">
				
<?php if(isset ($_SESSION['subcategory_id1'])){?>	
				<?php  foreach ($subcat as $row) { ?>
				<div class="col-md-4  col-xs-custom1text-center mno">
					<img src="<?php echo asset_url(); ?><?php echo $row['image'];?>" height="60px" class="img-responsive" id="image1">
					<p class="foterp txt" id="p1"><?php echo $row['name'];?></p>
					<input id="subcategory_id" name="subcategory_id" value="<?php echo $row['id'];?>" <?php if($_SESSION['subcategory_id1']==$row['id']) { echo 'checked'; } ?> type="radio" class="radiobtn">
						<input id="subcategory_id1" name="subcategory_id1" value="<?php echo $row['sub_id'];?>" type="hidden">
				</div>
<?php } ?>

<?php } else { ?>
	<?php  foreach ($subcat as $row) { ?>
				<div class="col-md-4 col-xs-custom1 text-center mno">
					<img src="<?php echo asset_url(); ?><?php echo $row['image'];?>" height="60px" class="img-responsive" id="image1">
					<p class="foterp txt" id="p1"><?php echo $row['name'];?></p>
					<input id="subcategory_id" name="subcategory_id" value="<?php echo $row['id'];?>" type="radio" class="radiobtn">
					<input id="subcategory_id1" name="subcategory_id1" value="<?php echo $row['sub_id'];?>" type="hidden">
				</div>
<?php } ?>

	<?php } ?>
				<div class="col-md-1"></div>
			
			</div>
		</div>

<script>
$('input[name=subcategory_id]').keypress(function(event) {
	 if (event.which == 13) {
      event.preventDefault();
      show4();
      return false;
  }
});
</script>