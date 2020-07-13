  <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700|Roboto:400,900" rel="stylesheet">
    
    <!-- Bootstrap CSS File -->
    <link href="<?php echo asset_url();?>js/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
    <!-- Libraries CSS Files -->
    <link href="<?php echo asset_url();?>js/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo asset_url();?>css/G2G-AboutUs.css" rel="stylesheet">
      <link href="<?php echo asset_url();?>css/custom.css" rel="stylesheet">  
      <style>
 @media only screen and (min-width:768px){
.lgsi{
 padding: 22px 2px 18px 2px;
}
.desktop-display{
display:inline-block;
}
}
@media only screen and (max-width:767px) and (min-width:300px){
.lgsi{
 padding: 10px 22px 10px 15px;
}
.desktop-display{
display:none
}
.dropdown-content{

display:block !important;

}
#mobile-nav ul li li {
    padding-left: 0px !important;;
}
}
      </style>
    <!-- Header -->
  <header id="header">
    <div class="container">
       <a href="<?php echo base_url();?>">
      <div id="logo" class="pull-left">
       <img src="<?php echo asset_url();?>images/img/logomain.png">
        <!-- Uncomment below if you prefer to use a text image -->
        <!--<h1><a href="#hero">Bell</a></h1>-->
      </div></a>
        <nav class="nav social-nav pull-right hidden-sm-down">
      <!--   <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-linkedin"></i></a> <a href="#"><i class="fa fa-envelope"></i></a>  -->
      </nav>
      <nav id="nav-menu-container">
        <ul class="nav-menu">
             <?php if(empty($olouserid)) { ?>
                    <li><a href="<?php echo base_url();?>signup"  class="lgsi">SIGNUP</a></li>
					<li><a href="<?php echo base_url();?>login"  class="lgsi">LOGIN</a><span class="desktop-display">/</span></li>
			<?php } else {?>
						<li class="dropdown">
						<a href="#" style="padding-right: 28px; !important"><i class="fa fa-user">&nbsp;&nbsp;</i><?php echo $olousername ?></a>
						  <ul class="dropdown-content">
						   <li><a href="<?php echo base_url();?>order/setting">My Account</a></li>
						  <li><a href="<?php echo base_url();?>order/history">Order History</a></li>
  <li><a href="<?php echo base_url();?>logout">Logout</a></li>

			  </ul>
						</li>
			<?php }?> 
           <li ><a href="<?php echo base_url();?>#maindiv">BOOK NOW</a></li>
          <li><a href="<?php echo base_url();?>#contact">CONTACT US</a></li>
          <li><a href="<?php echo base_url();?>#specialoffers">SPECIAL OFFERS</a></li>
          <li><a href="<?php echo base_url();?>services">SERVICES</a></li>
          <li><a href="<?php echo base_url();?>about">ABOUT US</a></li>
          <li><a href="<?php echo base_url();?>">HOME</a></li>
         
        </ul>
      </nav><!-- #nav-menu-container -->
      
      
    </div>
  </header><!-- #header -->
  

