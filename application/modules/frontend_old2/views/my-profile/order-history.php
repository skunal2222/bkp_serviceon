<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/my-profile/common.css">
<div class="my-pofile">
    <div class="container">
        <div class="banner-section">    
        </div>
        <div class="profile row">
            <div class="col-md-3 col-sm-4">
                <div class="profile-navigation" id="profile-navigation">
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>ongoing-orders">
                                Ongoing Order
                            </a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url();?>order-history">
                                Order History
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>basic-info">
                                Basic Info
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>refer-n-earn">
                                Refer and Earn
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>wallet">
                              My Wallet
                            </a>
                        </li>
                         <li>
                          <a href="<?php echo base_url();?>doc-wallet">
                             Doc Wallet
                          </a>
                      </li>
                        <li>
                            <a href="<?php echo base_url();?>notifications">
                                Notifications
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 col-sm-8">
                <div class="detail-section">

                    <!-- Ongoing Order  -->
                        <div class="ongoingorder">
                            <div class="orderid" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                <div class="row">
                                    <div class="col-md-8 col-sm-8">
                                        <h3 class="order-id-text">SERVICE NAME  ( Booking Id # : 1235467 )</h3>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-10">
                                        <h3 class="align-right">Total Amount : &#8377;106</h3>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-2 text-center">
                                        <div class="grey-bg">
                                            <img src="<?php echo asset_url();?>images/up.png" alt="arrow" class="up-img">
                                            <img src="<?php echo asset_url();?>images/down.png" alt="arrow" class="down-img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="order-status panel-collapse collapse in" id="collapse1">
                                  <div class="order-spl">
                                    <ul class="nav nav-pills spl-navbar">
                                        <li class="active"><a data-toggle="pill" href="#details"><span>Details</span></a></li>
                                        <li><a data-toggle="pill" href="#billing"><span>Billing</span></a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="details" class="tab-pane fade in active">
                                          <div class="details-spl">
                                              <div class="row">
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>Modal Name</p>
                                                  </div>
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>XYZ</p>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>Modal No.</p>
                                                  </div>
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>XYZ</p>
                                                  </div>
                                              </div>
                                               <div class="row">
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>Booking Date</p>
                                                  </div>
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>10th Nov 2018</p>
                                                  </div>
                                              </div>
                                               <div class="row">
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>Booking Time</p>
                                                  </div>
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>10 am</p>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>Total Amount Paid</p>
                                                  </div>
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>100/-</p>
                                                  </div>
                                              </div>
                                          </div>
                                        </div>
                                        <div id="billing" class="tab-pane fade">
                                            <div class="bolling-spl">
                                                <div class="details-spl">
                                                  <div class="row">
                                                      <div class="col-sm-6 col-md-3 col-xs-6">
                                                        <p>Service name</p>
                                                      </div>
                                                      <div class="col-sm-6 col-md-3 col-xs-6">
                                                        <p>Amount</p>
                                                      </div>
                                                  </div>
                                                  <div class="row">
                                                      <div class="col-sm-6 col-md-3 col-xs-6">
                                                        <p>Service name</p>
                                                      </div>
                                                      <div class="col-sm-6 col-md-3 col-xs-6">
                                                        <p>Amount</p>
                                                      </div>
                                                  </div>
                                                  <div class="total-bill-sepration">
                                                    <div class="row">
                                                        <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Subtotal</p>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Amount</p>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Tax</p>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Amount</p>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Service charge</p>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p> Amount</p>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p> Discount</p>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Amount</p>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="total-bill">
                                                    <div class="row">
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Total Amount </p>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Amount</p>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-5 text-right">
                                                             <button type="button" class="saved-btn">Book Now</button>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-7">
                                                             <button type="button" class="download-btn">Download Invoice</button>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                            </div>
                                        </div>
                                        
                                      </div>
                                  </div>

                            </div>
                            
                        </div>

                         <div class="ongoingorder">
                            <div class="orderid" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                               <div class="row">
                                    <div class="col-md-8 col-sm-8">
                                        <h3 class="order-id-text">SERVICE NAME  ( Booking Id # : 1235467 )</h3>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-10">
                                        <h3 class="align-right">Total Amount : &#8377;106</h3>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-2 text-center">
                                        <div class="grey-bg">
                                            <img src="<?php echo asset_url();?>images/up.png" alt="arrow" class="up-img">
                                            <img src="<?php echo asset_url();?>images/down.png" alt="arrow" class="down-img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="order-status panel-collapse collapse" id="collapse2">
                                <div class="order-spl">
                                    <ul class="nav nav-pills spl-navbar">
                                        <li class="active"><a data-toggle="pill" href="#details2"><span>Details</span></a></li>
                                        <li><a data-toggle="pill" href="#billing2"><span>Billing</span></a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="details2" class="tab-pane fade in active">
                                          <div class="details-spl">
                                              <div class="row">
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>Modal Name</p>
                                                  </div>
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>XYZ</p>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>Modal No.</p>
                                                  </div>
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>XYZ</p>
                                                  </div>
                                              </div>
                                               <div class="row">
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>Booking Date</p>
                                                  </div>
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>10th Nov 2018</p>
                                                  </div>
                                              </div>
                                               <div class="row">
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>Booking Time</p>
                                                  </div>
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>10 am</p>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>Total Amount Paid</p>
                                                  </div>
                                                  <div class="col-sm-6 col-md-3 col-xs-6">
                                                    <p>100/-</p>
                                                  </div>
                                              </div>
                                          </div>
                                        </div>
                                        <div id="billing2" class="tab-pane fade">
                                            <div class="bolling-spl">
                                                <div class="details-spl">
                                                  <div class="row">
                                                      <div class="col-sm-6 col-md-3 col-xs-6">
                                                        <p>Service name</p>
                                                      </div>
                                                      <div class="col-sm-6 col-md-3 col-xs-6">
                                                        <p>Amount</p>
                                                      </div>
                                                  </div>
                                                  <div class="row">
                                                      <div class="col-sm-6 col-md-3 col-xs-6">
                                                        <p>Service name</p>
                                                      </div>
                                                      <div class="col-sm-6 col-md-3 col-xs-6">
                                                        <p>Amount</p>
                                                      </div>
                                                  </div>
                                                  <div class="total-bill-sepration">
                                                    <div class="row">
                                                        <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Subtotal</p>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Amount</p>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Tax</p>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Amount</p>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Service charge</p>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p> Amount</p>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p> Discount</p>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Amount</p>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="total-bill">
                                                    <div class="row">
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Total Amount </p>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-6">
                                                            <p>Amount</p>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-5 text-right">
                                                             <button type="button" class="saved-btn">Book Now</button>
                                                          </div>
                                                          <div class="col-sm-6 col-md-3 col-xs-7">
                                                             <button type="button" class="download-btn">Download Invoice</button>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                            </div>
                                        </div>
                                      </div>
                                  </div>
                            </div>
                        </div>
                    <!-- Ongoing Order ends -->


                    <!-- no ongoing orders ends -->
                        <div class="no-ongoing-orders">
                            <img src="<?php echo asset_url();?>images/hierarchy-structure.png" alt="no-ongoin-orders" />
                            <h3>No Booking History available!</h3>
                            <button type="button" class="saved-btn">Book Now</button>
                        </div>
                    <!-- no ongoing orders ends -->


                </div>
            </div>
        </div>
    </div>
</div>
<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("profile-navigation");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky && window.pageYOffset <= 600) { 
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>