<div id="myCarousel" class="carousel slide" data-ride="carousel">                    <!-- Indicators -->
  <ol class="carousel-indicators">
    <?php $i = 1;foreach($images as $key => $image){?>
      <?php   $newstring = substr($image['url'], -3);
      if ($newstring != 'pdf') { ?> 
      <?php if($i == 1){?>
          <li data-target="#myCarousel" data-slide-to="<?php echo $key;?>" class="active"></li>
      <?php }else{?>
          <li data-target="#myCarousel" data-slide-to="<?php echo $key;?>"></li>
      <?php }?>
    <?php $i++;}?>
  <?php } ?>
  </ol>
  <div class="carousel-inner">
    <?php $i = 1;foreach($images as $key => $image){?>
      <?php   $newstring = substr($image['url'], -3);
       if ($newstring != 'pdf') { ?> 
      <?php if($i == 1){?>
      <div class="item active" id="image">
        <img src="<?php echo $image['url'];?>" alt="Los Angeles" style="width:100%;">
      </div>
      <?php }else{?>
      <div class="item">
        <img src="<?php echo $image['url'];?>" alt="Los Angeles" style="width:100%;">
      </div>
      <?php }?>
    <?php $i++;}?> 
  <?php } ?>
</div>
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>