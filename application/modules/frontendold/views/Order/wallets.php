<!-- Wallet Stylesheet File -->
<style>
.total-head-txt{
    font-weight: 400  !important; ;
    font-size: 20px  !important; ;
    margin-bottom: 40px  !important; ;
    margin-top: 40px  !important; ;
}
.earned-points{
    border: none;
    background: rgb(250, 186, 3);
    color: #000;
    font-size: 21px;
    width: 120px;
    margin: auto;
    padding: 5px 10px;
}
.nrm-text{
    color: #000;
    letter-spacing: 1px;
text-align:left !important;
}
.fright{
float:right;
}
.wallet-points{
    width: 80%;
    margin: auto;
}
.light-grey-row {
    background: #efeeee;
    padding: 2px;
     color: #000;
    margin: 20px 0px 0px;
}
.light-grey-row h4{

    color: #000;
    letter-spacing: 1px;
}
.earn-points-btn{
    border: none;
    background: rgb(250, 186, 3);
    color: #000;
    font-size: 21px;
    border-radius:0px;
    width: 250px;
    margin: auto;
    padding: 5px 10px;
}
.earn-points-btn {
    border: none;
    background: rgb(250, 186, 3);
    color: #000;
    font-size: 17px;
    border-radius: 0px;
    width: 200px;
    margin: auto;
    margin-top: 30px;
    padding: 5px 10px;
}
@media only screen and (max-width:767px) and (min-width:200px){
 .im-1{
    width: 45px;
    margin-top: 20px;
}
.total-head-txt {
    font-weight: 400 !important;
    font-size: 16px !important;
    margin-bottom: 20px !important;
    margin-top: 20px !important;
}
.wallet-points {
    width: 100%;
}
.nrm-text {
   
     font-weight: 500 !important;
    font-size: 14px;
    }
.earned-points {
    font-size: 18px;
    }
    .light-grey-row h4 {
    color: #000;
    
     margin-bottom: 10px;
    margin-top: 8px;
    font-size: 13px;
    font-weight: 500 !important;
    }
    .light-grey-row .col-xs-4{
    width:30%;
    padding-left:5px;
    padding-right:5px;
    }
     .light-grey-row .col-xs-5{
    width:40%;
    padding-left:5px;
    padding-right:5px;
    }
     .light-grey-row .col-xs-2{
    width:20%;
    padding-left:5px;
    padding-right:5px;
    }
    .earn-points-btn {
    border: none;
    background: rgb(250, 186, 3);
    color: #000;
    font-size: 14px;
    letter-spacing: 1px;
    border-radius: 0px;
    width: 180px;
    }
}
</style>
<link href="<?php echo asset_url();?>css/wallet.css" rel="stylesheet">
<link href="<?php echo asset_url();?>css/order.css" rel="stylesheet">
 
    <section class="about" id="about" style='background-image: url("<?php echo asset_url();?>images/img/templatemo_main_bg_bottom_wrapper.jpg");background-position: 0px -65.24px;'>
     <div class="container">
      <div class="row">

              <div class="col-lg-3 col-xs-12">
				<div class="nk-footer-text" style="margin: 23px;">
					<!-- <ul> -->
					<!-- <li><a href="#section-london">London</a></li> -->
					<!-- <li><a href="#section-paris">Paris</a></li> -->
					<!-- </ul> -->
			    <a href="<?php echo base_url();?>order/trackorder"><p class="foterp">Ongoing Orders</p></a>
				<a href="<?php echo base_url();?>order/history"><p class="foterp">Order	History</p></a>
				<!--<a href="<?php echo base_url();?>order/notification"><p class="foterp">Notifications <span>2</span></p></a>-->
				<a href="<?php echo base_url();?>order/setting"><p class="foterp">Settings</p></a>
				<a href="<?php echo base_url();?>order/wallet"><p class="foterp act">Wallet</p></a> 
				<a href="<?php echo base_url();?>order/offer"><p class="foterp">Offers</p></a>
				</div>
			</div>
            
            <div class="col-lg-9 col-xs-12 text-center">
            <?php if(!empty($balance[0]['amount'])){ ?>
			<div class="wallet-points">
			    <img src="<?php echo asset_url();?>images/wallet.png" alt="garage2ghar" class="im-1"/>
			    <h5 class="total-head-txt">TOTAL POINTS IN YOUR WALLET</h5>
		        <h3 class="earned-points"><?php echo $balance[0]['amount'];?></h3>				 
			   <br><br>
			   <h4 class="nrm-text">Each point is equal to 1 Rupee and can be reedemed against orders   <span class="fright">CR | DR</span></h4>
			    <?php //print_r($wallet_history);
                      if(!empty($wallet_history)){
                         foreach($wallet_history as $history){?>
			   <div class="row light-grey-row">
			       <div class="col-lg-4 col-xs-5 col-md-4 col-sm-4 text-left">
			         <h4><?php echo $history['amount'];?> Points</h4>
			       </div>
			       <?php if($history['updated_by'] == 0){ ?>
			       <div class="col-lg-4 col-xs-2 col-md-4 col-sm-4 text-center">
			          <h4>CR</h4>
			       </div>
			       <?php }else{ ?>
			       <div class="col-lg-4 col-xs-2 col-md-4 col-sm-4 text-center">
			          <h4>DR</h4>
			       </div>
			       <?php } ?>
			       <div class="col-lg-4 col-xs-5 col-md-4 col-sm-4 text-right">
			         <h4><?php echo date("jS M Y",strtotime($history['updated_date']));?></h4>
			       </div>
			   </div>
			   <?php }}?>
			    <!-- <div class="row light-grey-row">
			       <div class="col-lg-4 col-xs-5 col-md-4 col-sm-4 text-left">
			         <h4>1000 Points</h4>
			       </div>
			       <div class="col-lg-4 col-xs-2 col-md-4 col-sm-4 text-center">
			          <h4>CR</h4>
			       </div>
			       <div class="col-lg-4 col-xs-5 col-md-4 col-sm-4 text-right">
			         <h4>10-Aug-2018</h4>
			       </div>
			   </div>
			    <div class="row light-grey-row">
			       <div class="col-lg-4 col-xs-5 col-md-4 col-sm-4 text-left">
			         <h4>1000 Points</h4>
			       </div>
			       <div class="col-lg-4 col-xs-2 col-md-4 col-sm-4 text-center">
			          <h4>CR</h4>
			       </div>
			       <div class="col-lg-4 col-xs-5 col-md-4 col-sm-4 text-right">
			         <h4>10-Aug-2018</h4>
			       </div>
			   </div>
			    <div class="row light-grey-row">
			       <div class="col-lg-4 col-xs-5 col-md-4 col-sm-4 text-left">
			         <h4>1000 Points</h4>
			       </div>
			       <div class="col-lg-4 col-xs-2 col-md-4 col-sm-4 text-center">
			          <h4>CR</h4>
			       </div>
			       <div class="col-lg-4 col-xs-5 col-md-4 col-sm-4 text-right">
			         <h4>10-Aug-2018</h4>
			       </div>
			   </div>-->
			   
			   <button type="button" class="earn-points-btn" onclick="refer();">EARN POINTS</button>  
			   			 
			</div>
			<?php }else{ ?>
			<div class="wallet-points">
			    <img src="<?php echo asset_url();?>images/wallet.png" alt="garage2ghar" class="im-1"/>
			    <h5 class="total-head-txt">YOUR WALLET IS EMPTY</h5>
			    
			    <button type="button" class="earn-points-btn" onclick="refer();">EARN POINTS</button> 
			</div>
           <?php } ?>
		            
         </div>	
      
	   </div>


		</div>

    
    </section>

    <a class="scrolltop" href="#"><span class="fa fa-angle-up"></span></a> 
    
<script>
function popitup(url) {
    newwindow=window.open(url,'name','height=400,width=550,top=150,left=350');
    if (window.focus) {newwindow.focus()}
    return false;
}

function refer(){
	window.location.href=base_url+"order/offer";
}
</script>