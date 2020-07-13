<!-- points section -->
<section id="profile-login">
    <div class="d-flex align-items-center profile-title-img">
        <img src="<?php echo asset_url();?>frontend/images/profile-img.png" class="profile-img pr-2">
        <span class="profile-title">Profile</span>
    </div>
    <div class="all-user-history">
        <div class="row profile-section-row">
            <?php echo $sidebar_url; ?>
            <div class="col-xl-10 col-lg-9 col-md-9 col-sm-12 tabcontent user-offer-points" id="Points">
                <div class="card mb-5 details-point-card">
                    <div class="row text-center">
                        <div class="col-lg-6 col-md-12 col-sm-12 pb-5 details-point-table">
                            <table class="d-flex pb-5">
                                <tbody>
                                    <tr>
                                        <th>Details</th>
                                        <th>Points</th> 
                                    </tr>
                                    <?php 
                                        if (!empty($wallet_history)) {
                                            foreach ($wallet_history as $history) {
                                                if ($history['is_debit'] == 0 && $history['updated_by'] == 0) {
                                                    if ($history['amount'] > 0) {
                                    ?>
                                                    <tr>
                                                        <td><?= date('d-M-Y', strtotime($history['updated_date'])); ?></td>
                                                        <td class="points-gain">+ <?= $history['amount']; ?> pts</td>
                                                    </tr>
                                    <?php           } else { ?>
                                                    <tr>
                                                        <td><?= date('d-M-Y', strtotime($history['updated_date']));?></td>
                                                        <td class="points-gain"><?= $history['amount'];?> pts</td>
                                                    </tr>
                                    <?php           }
                                                } else { ?>
                                                    <tr>
                                                        <td><?= date('d-M-Y', strtotime($history['updated_date'])); ?></td>
                                                        <td class="deducted-points">- <?= $history['amount'] ?> pts</td>
                                                    </tr>
                                    <?php       }
                                            }
                                        }
                                    ?>                                    
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12  point-card-section">
                            <div class="user-point-card">
                                <div class="card">
                                    <small class="points-title">Your Points</small>
                                    <div class="d-flex">
                                        <h6 class="user-total-points"><?= $balance[0]['amount']; ?> points</h6>
                                        <img class="card-brand-logo" src="<?php echo asset_url();?>frontend/images/sologo.png">   
                                    </div>

                                    <div class="card-details pt-3">
                                        <h5 class="card-number">xxxx - xxxx - xxxx - xxxx</h5>
                                        <h6 class="card-holder-name"><?= $_SESSION['olousername']; ?></h6>
                                    </div>
                                </div>

                                <div class="text-center earn-more-points mt-4 pt-2">
                                    <a href ="<?= base_url(); ?>my-profile/refer-n-earn" >Earn More points</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>