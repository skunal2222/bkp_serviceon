<!-- Side Navbar -->
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/profile-responsive.css">
<style type="text/css">
.pac-container {
    background-color: #FFF;
    z-index: 20;
    position: fixed;
    display: inline-block;
    float: left;
}
.modal{
    z-index: 20;   
}
.modal-backdrop{
    z-index: 10;        
}​
</style>
<div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 align-self-start side-nav" id="side-nav">
    <div class="tab card profile-category-section d-flex align-items-start">
        <div class="button-color">
            <button class="tablinks side-nav-titles" onclick="openUrl('profile')" id="<?= ($active == 1)? 'profile-active-btn':''; ?>"><img class="pr-1" src="<?php echo asset_url();?>frontend/images/user-img.png">My Profile</button>     
        </div>

        <div class="button-color">
            <button class="tablinks side-nav-titles" onclick="openUrl('order-history')" id="<?= ($active == 2)? 'profile-active-btn':''; ?>"><img class="pr-1" src="<?php echo asset_url();?>frontend/images/order-history.png">Order History</button>   
        </div>

        <div class="button-color">
            <button class="tablinks side-nav-titles" onclick="openUrl('ongoing-order')" id="<?= ($active == 3)? 'profile-active-btn':''; ?>"><img class="pr-1" src="<?php echo asset_url();?>frontend/images/ongoing-order.png">Ongoing Orders</button>  
        </div>

        <div class="button-color">
            <button class="tablinks side-nav-titles" onclick="openUrl('vehicle')" id="<?= ($active == 4)? 'profile-active-btn':''; ?>"><img class="pr-1" src="<?php echo asset_url();?>frontend/images/vehicle.png">Vehicles</button> 
        </div>

        <div class="button-color">
            <button class="tablinks side-nav-titles" onclick="openUrl('address')" id="<?= ($active == 5)? 'profile-active-btn':''; ?>"><img class="pr-1" src="<?php echo asset_url();?>frontend/images/address.png">Addresses</button>   
        </div>

        <div class="button-color">
            <button class="tablinks side-nav-titles" onclick="openUrl('refer-n-earn')" id="<?= ($active == 6)? 'profile-active-btn':''; ?>"><img class="pr-1" src="<?php echo asset_url();?>frontend/images/referearn.png">Refer & Earn</button>  
        </div>

        <div class="button-color">
            <button class="tablinks side-nav-titles" onclick="openUrl('points')" id="<?= ($active == 7)? 'profile-active-btn':''; ?>"><img class="pr-1" src="<?php echo asset_url();?>frontend/images/points.png">Points</button>  
        </div>

        <div class="button-color">
            <button class="tablinks side-nav-titles" onclick="openUrl('digi-docs')" id="<?= ($active == 8)? 'profile-active-btn':''; ?>"><img class="pr-1" src="<?php echo asset_url();?>frontend/images/docs.png">Digi Docs</button>   
        </div>
    </div>  
</div>
<script type="text/javascript">
    function openUrl(page) {
        location.href = base_url + "my-profile/" + page;
    }
</script>