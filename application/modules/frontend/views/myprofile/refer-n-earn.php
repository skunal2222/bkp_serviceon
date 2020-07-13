<!-- Refer and Earn section -->
<section id="profile-login">
    <div class="d-flex align-items-center profile-title-img">
        <img src="<?php echo asset_url();?>frontend/images/profile-img.png" class="profile-img pr-2">
        <span class="profile-title">Profile</span>
    </div>
    <div class="all-user-history">
        <div class="row profile-section-row">
            <?php echo $sidebar_url; ?>
            <div class="col-xl-10 col-lg-9 col-md-9 col-sm-12 tabcontent refer-earn-section pb-5 text-center" id="Refer">
                <div class="card text-center refer-earn-card">
                    <div class="d-flex justify-content-center">
                        <img src="<?php echo asset_url();?>frontend/images/refer&earn.png">
                    </div>  
                    <?php // print_r($refercode);?>
                    <div class="refer-code">
                        <h5 class="offer-title">Rs 100 off for you and your friend</h5>
                        <small>Refer Code</small>   
                        <h5 class="user-refer-code" id="ref Code"><?php echo !empty($refercode['my_ref_code'])?$refercode['my_ref_code']:""; ?></h5>
                                                <div class="bd-clipboard"><button class="btn-sm btn-xs" title="Copy to clipboard" onclick="return copyCode();">Copy</button></div>
                        <input type="text" class="d-none" id="refCode" value="<?php echo !empty($refercode['my_ref_code'])?$refercode['my_ref_code']:""; ?>">

                        <h5 class="offer-title">Share on </h5>

                        <a  class="refer" onclick="return popitup('https://www.facebook.com/sharer/sharer.php?u=<?=base_url()?>user/<?=$this->session->olouserid?>')" title="Share on Facebook"  class="social_icons social_facebook" > 
                            <img src="<?php echo asset_url();?>frontend/images/Facebook-share.png" alt="wallet" class="media-icon" style="height: 30px !important; width: 30px !important;"  >
                        </a>
                        <a  class="refer" onclick="return popitup('http://twitter.com/home?status=My coupon code is -  <?php echo $refercode['my_ref_code']; ?>  sign up using this code and get 50 points in your wallet. <?php echo base_url();?>')" title="Share on Twitter"  class="social_icons social_twitter" > 
                            <img src="<?php echo asset_url();?>frontend/images/twitter-share.png" alt="wallet" class="media-icon" style="height: 30px !important; width: 30px !important;" >
                        </a>       
                        <a  class="refer" onclick="return popitup('https://api.instagram.com/v1/media/%d/comments?access_token=%s')" title="Share on Instagram"> 
                            <img src="<?php echo asset_url();?>frontend/images/insta-share.png" alt="wallet" class="media-icon" style="height: 30px !important; width: 30px !important;" >
                        </a>
                        <!-- <button class="share-code-btn">Share with your friends</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function popitup(url) {
    newwindow=window.open(url,'name','height=400,width=550,top=150,left=350');
    if (window.focus) {newwindow.focus()}
    return false;
}

function copyCode() {
  var copyText = document.getElementById("refCode");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Code Copied : " + copyText.value);
}
</script>