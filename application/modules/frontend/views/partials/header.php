<?php // if(!empty($userid)){  ?>
    <script type="text/javascript">
        /*$(document).ready(function(){
            $('#resetPasswordModal').modal({
            backdrop: 'static',
            keyboard: false
            })
            $("#resetPasswordModal").modal();      
        });*/

    </script>
<?php // } ?>
 <?php
// if (empty($_SESSION['olouserid'])) {
//     redirect(base_url());
// }
?>
<header>
    <?php //print_r($_SESSION); die();
        //$chmobileresult = '';
        if (!empty($_SESSION['olouserid'])) {
            $chmobileresult = check_mobile_no_exist($_SESSION['olouserid']);

            // echo $chmobileresult; die();
        }
     ?>
    
  <nav id="navbar" class="navbar  navbar-expand-sm pb-3 pt-3 fixed-top" style="background: white;"> 
    <div class="logo pl-4">
        <a href="<?php echo base_url(); ?>"><img class="images-logo" src="<?php echo asset_url();?>frontend/images/logo.png"></a>
    </div>


    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class=""><i class="fas fa-bars"></i></span>
    </button>
    

    <div class="collapse navbar-collapse " id="navbarCollapse">
        
        <!-- <form class="form-inline my-2 my-lg-0 location-serach-tab">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
        </form> -->

        <ul class="navbar-nav ml-auto">
            <li class="nav-item px-3">
                <a href="<?php echo base_url();?>about-us" class="nav-link" id="active">About</a>
            </li>

            <li class="nav-item px-3">
                <a href="<?php echo base_url();?>FAQ" class="nav-link">Help</a>
            </li>

            <li class="nav-item px-3">
               <a href="<?php echo base_url(); ?>offers" class="nav-link">Offers</a>
           </li>

            <!-- <li class="nav-item px-3">
                <a href="<?php echo base_url();?>my-profile" class="nav-link">Profile</a>
            </li> -->
            <?php if(isset($_SESSION['olouserid'])){ ?>
            <li class="nav-item px-3">
                <a href="<?php echo base_url();?>my-profile/profile" class="nav-link">Profile</a>
            </li>
            <li class="nav-item px-3">
                <a href="<?php echo base_url();?>logout" class="nav-link">Logout</a>
            </li>
            <?php } ?>
            <?php if(!isset($_SESSION['olouserid'])){ ?>
            <li class="nav-item px-3">
              <a href="<?php echo base_url();?>login" class="nav-link">Login / Register</a>
            </li>
            <?php } ?>
    </ul>
</div>
</nav>
</header>

<div class="modal" tabindex="-1" role="dialog" id="md-verifymobile">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Mobile Verification</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body" id="mobileModel">

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
<?php $forvehiclemodal = 1;
if (isset($chmobileresult) && $chmobileresult===0) { $forvehiclemodal = 0;?>
    var options = {
        'show' : true,
        'backdrop' : 'static',
        'keyboard' : false
    }

    $.post(base_url + 'get_mobile_verify_view', {}, function (data) {
        $("#mobileModel").empty();
        $("#mobileModel").html(data.view);
        $("#md-verifymobile").modal(options);

    }, "json");
<?php } ?>
</script>