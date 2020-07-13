   <nav id="nav-menu-container">
        <ul class="nav-menu">
             <?php if(empty($olouserid)) { ?>
				<li><a href="<?php echo base_url();?>login">LOGIN/SIGNUP</a></li>
			<?php } else {?>
						<li class="dropdown">
						<a href="" style="padding-right: 28px; !important"><i class="fa fa-user">&nbsp;&nbsp;</i><?php echo $olousername ?></a>
						  <ul class="dropdown-content">
						  <li><a href="<?php echo base_url();?>order/setting">My Account</a></li>
						  <li><a href="<?php echo base_url();?>order/history">Order History</a></li>
                          <li><a href="<?php echo base_url();?>logout">LOGOUT</a></li>

			  </ul>
						</li>
			<?php }?> 
           <li ><a href="<?php echo base_url();?>#maindiv">BOOK NOW</a></li>
          <li><a href="<?php echo base_url();?>#contact">CONTACT US</a></li>
          <li><a href="<?php echo base_url();?>offer">SPECIAL OFFERS</a></li>
          <li><a href="#">SERVICES</a></li>
          <li><a href="<?php echo base_url();?>about">ABOUT US</a></li>
          <li><a href="<?php echo base_url();?>">HOME</a></li>
         
        </ul>
      </nav>