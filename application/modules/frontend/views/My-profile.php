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
<section id="profile-login">
    <div class="d-flex align-items-center profile-title-img">
        <img src="<?php echo asset_url();?>frontend/images/profile-img.png" class="profile-img pr-2">
        <span class="profile-title">Profile</span>
    </div>
    <div class="all-user-history">
        <div class="row profile-section-row">
            <!-- Side Navbar -->
            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 align-self-start side-nav" id="side-nav">
                <div class="tab card profile-category-section d-flex align-items-start">
                    <div class="button-color">
                        <button class="tablinks side-nav-titles" onclick="openCity(event, 'Login')" id="defaultOpen"><img class="pr-1" src="<?php echo asset_url();?>frontend/images/user-img.png">My Profile</button>     
                    </div>

                    <div class="button-color">
                        <button class="tablinks side-nav-titles" onclick="openCity(event, 'History')"><img class="pr-1" src="<?php echo asset_url();?>frontend/images/order-history.png">Order History</button>   
                    </div>

                    <div class="button-color">
                        <button class="tablinks side-nav-titles" onclick="openCity(event, 'Ongoing')"><img class="pr-1" src="<?php echo asset_url();?>frontend/images/ongoing-order.png">Ongoing Orders</button>  
                    </div>

                    <div class="button-color">
                        <button class="tablinks side-nav-titles" onclick="openCity(event, 'Vehicles')"><img class="pr-1" src="<?php echo asset_url();?>frontend/images/vehicle.png">Vehicles</button> 
                    </div>

                    <div class="button-color">
                        <button class="tablinks side-nav-titles" onclick="openCity(event, 'Addresses')"><img class="pr-1" src="<?php echo asset_url();?>frontend/images/address.png">Addresses</button>   
                    </div>

                    <div class="button-color">
                        <button class="tablinks side-nav-titles" onclick="openCity(event, 'Refer')"><img class="pr-1" src="<?php echo asset_url();?>frontend/images/referearn.png">Refer & Earn</button>  
                    </div>

                    <div class="button-color">
                        <button class="tablinks side-nav-titles" onclick="openCity(event, 'Points')"><img class="pr-1" src="<?php echo asset_url();?>frontend/images/points.png">Points</button>  
                    </div>

                    <div class="button-color">
                        <button class="tablinks side-nav-titles" onclick="openCity(event, 'Digi')"><img class="pr-1" src="<?php echo asset_url();?>frontend/images/docs.png">Digi Docs</button>   
                    </div>
                </div>  
            </div>

            <!-- User Login Section -->
            <div class="col-xl-10 col-lg-9 col-md-9 col-sm-12 tabcontent login-form pb-5" id="Login">
                <div class="card user-login-form ">
                    <form class="profile-login-form" id="frm_profile">
                        <input type="hidden" name="isOtpVerify" id="isOtpVerify" value="0">
                        <div class="form-row">
                            <?php //print_r($data); ?>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control" name="fname" placeholder="Enter First Name" value="<?= isset($data['name'])?$data['name']:''; ?>">
                                <div class="messageContainer"></div>
                            </div>

                            <div class="form-group col-md-6 col-sm-12">                                     
                                <label for="phone">Last Name</label>
                                <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" value="<?= isset($data['lname'])?$data['lname']:''; ?>">
                                <div class="messageContainer"></div>
                            </div>
                        </div>

                        <div class="form-row form-group-padding">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="phone">Phone Number</label>
                                <input type="hidden" id="oldMobile" name="oldMobile" value="<?= isset($data['mobile'])?$data['mobile']:''; ?>">
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Phone" value="<?= isset($data['mobile'])?$data['mobile']:''; ?>" maxlength="10">
                                <div class="messageContainer"></div>
                            </div>

                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Email" value="<?= isset($data['email'])?$data['email']:''; ?>">
                                <div class="messageContainer"></div>
                            </div>
                        </div>

                        <div class="form-row form-group-padding">
                            <div class="form-group col-md-6 col-sm-12" >
                                <label for="birth-date">DOB</label>
                                <input type="date" class="form-control" name="dob" value="<?= isset($data['dob'])?$data['dob']:''; ?>" >
                                <div class="messageContainer"></div>
                            </div>

                            <div class="form-group col-md-6 col-sm-12">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="">select</option>
                                    <option value="1" <?= (isset($data['gender']) && $data['gender'] == 1)? 'selected':'' ?>>Male</option>
                                    <option value="2" <?= (isset($data['gender']) && $data['gender'] == 2)? 'selected':'' ?>>Female</option>
                                </select>
                                <div class="messageContainer"></div>
                            </div>
                        </div>
                        <span id="response-msg"></span>
                        <div class="pt-3 update-button">
                            <button type="submit" class="btn">Update</button>          
                        </div>
                    </form>
                </div>
            </div>

            <!-- Order History and accordin -->
            <div class="col-xl-10 col-lg-9 col-md-9 col-sm-12 card tabcontent order-history-section pb-5" id="History" style="box-shadow: none!important;">
                <div class="row order-history-accordin">

                    <div class="col-lg-12">
                        <div id="accordion">
                            <div class="card">
                                <div data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <div class="row orders-placed">
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <h5 class="placed-order-no">ABCD1234</h5>
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-sm-12 text-center">
                                            <h5 class="placed-bike-details">Kawasaki Ninja ZX - 10R</h5>
                                        </div>

                                        <div class="col-lg-6 col-md-4 col-sm-12 d-flex justify-content-end">
                                            <h5 class="placed-bike-details">Order Placed: On <span class="placed-date-time">12-Jan-19</span> at <span class="placed-date-time">10.30AM</span></h5>
                                        </div>
                                    </div>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="d-flex">
                                        <!-- <h5 class="order-invoice-id">ABCD1234</h5> -->
                                        <div class="ml-auto download-invoice">
                                            <a href="#">Download Invoice</a>
                                        </div>
                                    </div>

                                    <h6 class="garage-name">Sunriser's Garage</h6>
                                    <h6 class="bike-name order-delivery-content">Kawawsaki Ninja ZX - 10R</h6>

                                    <div class="order-delivery-details">
                                        <div class="d-flex flex-row">
                                            <div class="align-self-start">
                                                <h6 class="order-delivery-content">Order Date</h6>
                                            </div>

                                            <div class="align-self-end">
                                                <h6 class="order-delivery-content ordered-date">: Date <span class="date-time">12-Jan-19</span> | Time <span class="date-time">10:30AM</span></h6>      
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row">
                                            <div class="align-self-start">
                                                <h6 class="order-delivery-content">Delivered on</h6>
                                            </div>

                                            <div class="align-self-center">
                                                <h6 class="order-delivery-content delivered-date">: Date <span class="date-time">15-Jan-19</span> | Time <span class="date-time">11.00AM</span></h6>        
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row">
                                            <div class="align-self-start">
                                                <h6 class="order-delivery-content">Customer</h6>
                                            </div>

                                            <div class="align-self-center">
                                                <h6 class="order-delivery-content coustomer-name">: Aditya Singh <br><span class="pl-2">9090092090</span></h6>      
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row">
                                            <div class="align-self-start">
                                                <h6 class="order-delivery-content">Address</h6>
                                            </div>

                                            <div class="align-self-center ml-4">
                                                <h6 class="order-delivery-content delivered-address"> Flat 2,Niyoshi Park 2,<br>Opposite, Puma showroom <br> Aundh, Pune. - 4110070 </h6>   
                                            </div>
                                        </div>                  
                                    </div>  

                                    <div class="invoice-print mt-4">
                                        <table>
                                            <tr>
                                                <th>Service/Spare</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Final</th>
                                            </tr>

                                            <tr>
                                                <td>Punture</td>
                                                <td>4</td>
                                                <td>100</td>
                                                <td>400</td>
                                            </tr>

                                            <tr>
                                                <td>Punture</td>
                                                <td>4</td>
                                                <td>100</td>
                                                <td>400</td>
                                            </tr>
                                        </table>    
                                    </div>  

                                    <div class="row final-charges pb-5 d-flex align-items-end flex-column-reverse flex-lg-row">
                                        <div class="col-lg-6 ">
                                            <div class="repeat-invoice">
                                                <button>Repeat</button>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 ">
                                            <div class="total-amount">
                                                <div class="d-flex all-total">
                                                    <h5 class="total-tax-title">Sub Total</h5>
                                                    <span class="title-amount-dot">:</span>
                                                    <h5 class="ml-auto total-tax-title">Rs.800</h5>
                                                </div>

                                                <div class=" d-flex texes">
                                                    <h5 class="total-tax-title">Tax</h5>
                                                    <span class="title-amount-dot">:</span>
                                                    <h5 class="ml-auto total-tax-title">Rs.30</h5>
                                                </div>

                                                <div class=" d-flex delivery-charges">
                                                    <h5 class="total-tax-title">Delivery Charges</h5>
                                                    <span class="title-amount-dot">:</span>
                                                    <h5 class="ml-auto total-tax-title">Rs.40</h5>
                                                </div>

                                                <div class=" d-flex applied-offers">
                                                    <h5 class="total-tax-title">Offer Applied</h5>
                                                    <span class="title-amount-dot">:</span>
                                                    <h5 class="ml-auto total-tax-title">Rs.0</h5>
                                                </div>  

                                                <hr style="color: #a1a1a1;">

                                                <div class=" d-flex subtotal-amount">
                                                    <h5 class="total-amount-paid">Total</h5>
                                                    <span class="title-amount-dot">:</span>
                                                    <h5 class="ml-auto total-amount-paid">Rs.870</h5>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>                          
                                </div>
                            </div>

                            <!-- 2nd Accordin -->
                            <div class="card">
                                <div id="headingTwo" class="headings">
                                    <div class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <div class="row orders-placed">
                                            <div class="col-lg-3 col-md-4 col-sm-12">
                                                <h5 class="placed-order-no">ABCD1234</h5>
                                            </div>

                                            <div class="col-lg-3 col-md-4 col-sm-12 text-center">
                                                <h5 class="placed-bike-details">Kawasaki Ninja ZX - 10R</h5>
                                            </div>

                                            <div class="col-lg-6 col-md-4 col-sm-12 d-flex justify-content-end">
                                                <h5 class="placed-bike-details">Order Placed: On <span class="placed-date-time">12-Jan-19</span> at <span class="placed-date-time">10.30AM</span></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="d-flex">
                                        <!-- <h5 class="order-invoice-id">ABCD1234</h5> -->
                                        <div class="ml-auto download-invoice">
                                            <a href="#">Download Invoice</a>
                                        </div>
                                    </div>

                                    <h6 class="garage-name">Sunriser's Garage</h6>
                                    <h6 class="bike-name order-delivery-content">Kawawsaki Ninja ZX - 10R</h6>

                                    <div class="order-delivery-details">
                                        <div class="d-flex flex-row">
                                            <div class="align-self-start">
                                                <h6 class="order-delivery-content">Order Date</h6>
                                            </div>

                                            <div class="align-self-end">
                                                <h6 class="order-delivery-content ordered-date">: Date <span class="date-time">12-Jan-19</span> | Time <span class="date-time">10:30AM</span></h6>      
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row">
                                            <div class="align-self-start">
                                                <h6 class="order-delivery-content">Delivered on</h6>
                                            </div>

                                            <div class="align-self-center">
                                                <h6 class="order-delivery-content delivered-date">: Date <span class="date-time">15-Jan-19</span> | Time <span class="date-time">11.00AM</span></h6>        
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row">
                                            <div class="align-self-start">
                                                <h6 class="order-delivery-content">Customer</h6>
                                            </div>

                                            <div class="align-self-center">
                                                <h6 class="order-delivery-content coustomer-name">: Aditya Singh <br><span class="pl-2">9090092090</span></h6>      
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row">
                                            <div class="align-self-start">
                                                <h6 class="order-delivery-content">Address</h6>
                                            </div>

                                            <div class="align-self-center ml-4">
                                                <h6 class="order-delivery-content delivered-address"> Flat 2,Niyoshi Park 2,<br>Opposite, Puma showroom <br> Aundh, Pune. - 4110070 </h6>   
                                            </div>
                                        </div>                  
                                    </div>  

                                    <div class="invoice-print mt-4">
                                        <table>
                                            <tr>
                                                <th>Service/Spare</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Final</th>
                                            </tr>

                                            <tr>
                                                <td>Punture</td>
                                                <td>4</td>
                                                <td>100</td>
                                                <td>400</td>
                                            </tr>

                                            <tr>
                                                <td>Punture</td>
                                                <td>4</td>
                                                <td>100</td>
                                                <td>400</td>
                                            </tr>
                                        </table>    
                                    </div>  

                                    <div class="row final-charges pb-5 d-flex align-items-end flex-column-reverse flex-lg-row">
                                        <div class="col-lg-6 ">
                                            <div class="repeat-invoice">
                                                <button>Repeat</button>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 ">
                                            <div class="total-amount">
                                                <div class="d-flex all-total">
                                                    <h5 class="total-tax-title">Sub Total</h5>
                                                    <span class="title-amount-dot">:</span>
                                                    <h5 class="ml-auto total-tax-title">Rs.800</h5>
                                                </div>

                                                <div class=" d-flex texes">
                                                    <h5 class="total-tax-title">Tax</h5>
                                                    <span class="title-amount-dot">:</span>
                                                    <h5 class="ml-auto total-tax-title">Rs.30</h5>
                                                </div>

                                                <div class=" d-flex delivery-charges">
                                                    <h5 class="total-tax-title">Delivery Charges</h5>
                                                    <span class="title-amount-dot">:</span>
                                                    <h5 class="ml-auto total-tax-title">Rs.40</h5>
                                                </div>

                                                <div class=" d-flex applied-offers">
                                                    <h5 class="total-tax-title">Offer Applied</h5>
                                                    <span class="title-amount-dot">:</span>
                                                    <h5 class="ml-auto total-tax-title">Rs.0</h5>
                                                </div>  

                                                <hr style="color: #a1a1a1;">

                                                <div class=" d-flex subtotal-amount">
                                                    <h5 class="total-amount-paid">Total</h5>
                                                    <span class="title-amount-dot">:</span>
                                                    <h5 class="ml-auto total-amount-paid">Rs.870</h5>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 3rd Accordin -->
                            <div class="card">
                                <div id="headingThree" class="headings">
                                    <div class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <div class="row orders-placed">
                                            <div class="col-lg-3 col-md-4 col-sm-12">
                                                <h5 class="placed-order-no">ABCD1234</h5>
                                            </div>

                                            <div class="col-lg-3 col-md-4 col-sm-12 text-center">
                                                <h5 class="placed-bike-details">Kawasaki Ninja ZX - 10R</h5>
                                            </div>

                                            <div class="col-lg-6 col-md-4 col-sm-12 d-flex justify-content-end">
                                                <h5 class="placed-bike-details">Order Placed: On <span class="placed-date-time">12-Jan-19</span> at <span class="placed-date-time">10.30AM</span></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="d-flex">
                                        <!-- <h5 class="order-invoice-id">ABCD1234</h5> -->
                                        <div class="ml-auto download-invoice">
                                            <a href="#">Download Invoice</a>
                                        </div>
                                    </div>

                                    <h6 class="garage-name">Sunriser's Garage</h6>
                                    <h6 class="bike-name order-delivery-content">Kawawsaki Ninja ZX - 10R</h6>

                                    <div class="order-delivery-details">
                                        <div class="d-flex flex-row">
                                            <div class="align-self-start">
                                                <h6 class="order-delivery-content">Order Date</h6>
                                            </div>

                                            <div class="align-self-end">
                                                <h6 class="order-delivery-content ordered-date">: Date <span class="date-time">12-Jan-19</span> | Time <span class="date-time">10:30AM</span></h6>      
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row">
                                            <div class="align-self-start">
                                                <h6 class="order-delivery-content">Delivered on</h6>
                                            </div>

                                            <div class="align-self-center">
                                                <h6 class="order-delivery-content delivered-date">: Date <span class="date-time">15-Jan-19</span> | Time <span class="date-time">11.00AM</span></h6>        
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row">
                                            <div class="align-self-start">
                                                <h6 class="order-delivery-content">Customer</h6>
                                            </div>

                                            <div class="align-self-center">
                                                <h6 class="order-delivery-content coustomer-name">: Aditya Singh <br><span class="pl-2">9090092090</span></h6>      
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row">
                                            <div class="align-self-start">
                                                <h6 class="order-delivery-content">Address</h6>
                                            </div>

                                            <div class="align-self-center ml-4">
                                                <h6 class="order-delivery-content delivered-address"> Flat 2,Niyoshi Park 2,<br>Opposite, Puma showroom <br> Aundh, Pune. - 4110070 </h6>   
                                            </div>
                                        </div>                  
                                    </div>  

                                    <div class="invoice-print mt-4">
                                        <table>
                                            <tr>
                                                <th>Service/Spare</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Final</th>
                                            </tr>

                                            <tr>
                                                <td>Punture</td>
                                                <td>4</td>
                                                <td>100</td>
                                                <td>400</td>
                                            </tr>

                                            <tr>
                                                <td>Punture</td>
                                                <td>4</td>
                                                <td>100</td>
                                                <td>400</td>
                                            </tr>
                                        </table>    
                                    </div>  

                                    <div class="row final-charges pb-5 d-flex align-items-end flex-column-reverse flex-lg-row">
                                        <div class="col-lg-6 ">
                                            <div class="repeat-invoice">
                                                <button>Repeat</button>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 ">
                                            <div class="total-amount">
                                                <div class="d-flex all-total">
                                                    <h5 class="total-tax-title">Sub Total</h5>
                                                    <span class="title-amount-dot">:</span>
                                                    <h5 class="ml-auto total-tax-title">Rs.800</h5>
                                                </div>

                                                <div class=" d-flex texes">
                                                    <h5 class="total-tax-title">Tax</h5>
                                                    <span class="title-amount-dot">:</span>
                                                    <h5 class="ml-auto total-tax-title">Rs.30</h5>
                                                </div>

                                                <div class=" d-flex delivery-charges">
                                                    <h5 class="total-tax-title">Delivery Charges</h5>
                                                    <span class="title-amount-dot">:</span>
                                                    <h5 class="ml-auto total-tax-title">Rs.40</h5>
                                                </div>

                                                <div class=" d-flex applied-offers">
                                                    <h5 class="total-tax-title">Offer Applied</h5>
                                                    <span class="title-amount-dot">:</span>
                                                    <h5 class="ml-auto total-tax-title">Rs.0</h5>
                                                </div>  

                                                <hr style="color: #a1a1a1;">

                                                <div class=" d-flex subtotal-amount">
                                                    <h5 class="total-amount-paid">Total</h5>
                                                    <span class="title-amount-dot">:</span>
                                                    <h5 class="ml-auto total-amount-paid">Rs.870</h5>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- 4th Accordin -->

                            <div class="card">
                                <div id="headingFour" class="headings">
                                    <div class="collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        <div class="row orders-placed">
                                            <div class="col-lg-3 col-md-4 col-sm-12">
                                                <h5 class="placed-order-no">ABCD1234</h5>
                                            </div>

                                            <div class="col-lg-3 col-md-4 col-sm-12 text-center">
                                                <h5 class="placed-bike-details">Kawasaki Ninja ZX - 10R</h5>
                                            </div>

                                            <div class="col-lg-6 col-md-4 col-sm-12 d-flex justify-content-end">
                                                <h5 class="placed-bike-details">Order Placed: On <span class="placed-date-time">12-Jan-19</span> at <span class="placed-date-time">10.30AM</span></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                    <div class="d-flex">
                                        <!-- <h5 class="order-invoice-id">ABCD1234</h5> -->
                                        <div class="ml-auto download-invoice">
                                            <a href="#">Download Invoice</a>
                                        </div>
                                    </div>

                                    <h6 class="garage-name">Sunriser's Garage</h6>
                                    <h6 class="bike-name order-delivery-content">Kawawsaki Ninja ZX - 10R</h6>

                                    <div class="order-delivery-details">
                                        <div class="d-flex flex-row">
                                            <div class="align-self-start">
                                                <h6 class="order-delivery-content">Order Date</h6>
                                            </div>

                                            <div class="align-self-end">
                                                <h6 class="order-delivery-content ordered-date">: Date <span class="date-time">12-Jan-19</span> | Time <span class="date-time">10:30AM</span></h6>      
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row">
                                            <div class="align-self-start">
                                                <h6 class="order-delivery-content">Delivered on</h6>
                                            </div>

                                            <div class="align-self-center">
                                                <h6 class="order-delivery-content delivered-date">: Date <span class="date-time">15-Jan-19</span> | Time <span class="date-time">11.00AM</span></h6>        
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row">
                                            <div class="align-self-start">
                                                <h6 class="order-delivery-content">Customer</h6>
                                            </div>

                                            <div class="align-self-center">
                                                <h6 class="order-delivery-content coustomer-name">: Aditya Singh <br><span class="pl-2">9090092090</span></h6>      
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row">
                                            <div class="align-self-start">
                                                <h6 class="order-delivery-content">Address</h6>
                                            </div>

                                            <div class="align-self-center ml-4">
                                                <h6 class="order-delivery-content delivered-address"> Flat 2,Niyoshi Park 2,<br>Opposite, Puma showroom <br> Aundh, Pune. - 4110070 </h6>   
                                            </div>
                                        </div>                  
                                    </div>  

                                    <div class="invoice-print mt-4">
                                        <table>
                                            <tr>
                                                <th>Service/Spare</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Final</th>
                                            </tr>

                                            <tr>
                                                <td>Punture</td>
                                                <td>4</td>
                                                <td>100</td>
                                                <td>400</td>
                                            </tr>

                                            <tr>
                                                <td>Punture</td>
                                                <td>4</td>
                                                <td>100</td>
                                                <td>400</td>
                                            </tr>
                                        </table>    
                                    </div>  

                                    <div class="row final-charges pb-5 d-flex align-items-end flex-column-reverse flex-lg-row">

                                        <div class="col-lg-6 ">
                                            <div class="repeat-invoice">
                                                <button>Repeat</button>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 ">
                                            <div class="total-amount">
                                                <div class="d-flex all-total">
                                                    <h5 class="total-tax-title">Sub Total</h5>
                                                    <span class="title-amount-dot">:</span>
                                                    <h5 class="ml-auto total-tax-title">Rs.800</h5>
                                                </div>

                                                <div class=" d-flex texes">
                                                    <h5 class="total-tax-title">Tax</h5>
                                                    <span class="title-amount-dot">:</span>
                                                    <h5 class="ml-auto total-tax-title">Rs.30</h5>
                                                </div>

                                                <div class=" d-flex delivery-charges">
                                                    <h5 class="total-tax-title">Delivery Charges</h5>
                                                    <span class="title-amount-dot">:</span>
                                                    <h5 class="ml-auto total-tax-title">Rs.40</h5>
                                                </div>

                                                <div class=" d-flex applied-offers">
                                                    <h5 class="total-tax-title">Offer Applied</h5>
                                                    <span class="title-amount-dot">:</span>
                                                    <h5 class="ml-auto total-tax-title">Rs.0</h5>
                                                </div>  

                                                <hr style="color: #a1a1a1;">

                                                <div class=" d-flex subtotal-amount">
                                                    <h5 class="total-amount-paid">Total</h5>
                                                    <span class="title-amount-dot">:</span>
                                                    <h5 class="ml-auto total-amount-paid">Rs.870</h5>
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

            <!-- Ongoing Order Section -->
            <div class="col-xl-10 col-lg-9 col-md-9 col-sm-12 card tabcontent ongoing-order-section" id="Ongoing">
                <div class="row d-flex ongoing-order-track">
                    <div class="col-lg-9 col-md-9 d-flex justify-content-center">
                        <div class="jumbotron ">
                            <div class="row users-orders-details d-flex align-self-center">
                                <div class="col-lg-4 col-md-4">
                                    <div class="d-flex">
                                        <h3 class="order-history-no">ABCD1234</h3>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 bike-model-name">
                                    <h4 class="bike-model">Kawasaki Ninja ZX - 10R</h4>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <h4 class="order-date">12-jan-19 | 10.30AM</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="track-order-btn text-center">
                            <a href="track-order.html" class="">Track Order</a>
                        </div>
                    </div>
                </div>

                <div class="row d-flex ongoing-order-track">
                    <div class="col-lg-9 col-md-9 d-flex justify-content-center">
                        <div class="jumbotron ">
                            <div class="row users-orders-details d-flex align-self-center">
                                <div class="col-lg-4 col-md-4">
                                    <div class="d-flex">
                                        <h3 class="order-history-no">ABCD1234</h3>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 bike-model-name">
                                    <h4 class="bike-model">Kawasaki Ninja ZX - 10R</h4>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <h4 class="order-date">12-jan-19 | 10.30AM</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="track-order-btn text-center">
                            <a href="track-order.html" class="">Track Order</a>
                        </div>
                    </div>
                </div>

                <div class="row d-flex ongoing-order-track">
                    <div class="col-lg-9 col-md-9 d-flex justify-content-center">
                        <div class="jumbotron ">
                            <div class="row users-orders-details d-flex align-self-center">
                                <div class="col-lg-4 col-md-4">
                                    <div class="d-flex">
                                        <h3 class="order-history-no">ABCD1234</h3>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 bike-model-name">
                                    <h4 class="bike-model">Kawasaki Ninja ZX - 10R</h4>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <h4 class="order-date">12-jan-19 | 10.30AM</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="track-order-btn text-center">
                            <a href="track-order.html" class="">Track Order</a>
                        </div>
                    </div>
                </div>

                <div class="row d-flex ongoing-order-track">
                    <div class="col-lg-9 col-md-9 d-flex justify-content-center">
                        <div class="jumbotron ">
                            <div class="row users-orders-details d-flex align-self-center">
                                <div class="col-lg-4 col-md-4">
                                    <div class="d-flex">
                                        <h3 class="order-history-no">ABCD1234</h3>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 bike-model-name">
                                    <h4 class="bike-model">Kawasaki Ninja ZX - 10R</h4>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <h4 class="order-date">12-jan-19 | 10.30AM</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="track-order-btn text-center">
                            <a href="track-order.html" class="">Track Order</a>
                        </div>
                    </div>
                </div>
            </div>  

            <!-- Vehicles section -->
            <div class="col-xl-10 col-lg-9 col-md-9 col-sm-12 tabcontent user-vechicle-section pb-5" id="Vehicles">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="users-orders-details-vechicles">
                                <h5 class="saved-vehicles-title">Saved Vehicles</h5>
                                <div class="row pt-4 pb-5 saved-vehicles-details">
                                	<?php foreach ($vehicallist as $vehical) { ?>
                                	<div class="col-lg-6 col-sm-12 col-12 pb-4">
                                		<div class="card card-1 vehicles">
                                			<div class="d-flex">
                                				<h6 class="saved-vehicle-number"></h6>
                                				<a href="#" class="ml-auto deletevehical" id="<?= $vehical['id'] ?>" ><i class="fa fa-times"></i></a>
                                			</div>
                                			<h6 class="saved-vehicle-details"><?= $vehical['brandname']." ".$vehical['modelname'] ?><br> <?= $vehical['total_kms'] ?> Km | Manufactured in <?= $vehical['manufactured_year'] ?> <a href="#" class="ml-auto editvehical" id="<?= $vehical['id'] ?>" ><i class="fa fa-edit" aria-hidden="true"></i></a></h6>
                                		</div>
                                	</div>
                                	<?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="row add-new-vehicle-section mt-5">
                            <div class="col">
                                <div class="card saved-vehicle-card">
                                    <div class="user-addnew-vehicle">
                                        <h6 class="add-new-vehicle-title" id="vehical_title">Add Vehicle</h6>
                                        <form class="add-vehicle-form" id="frm_vehicle">
                                        	<input type="hidden" name="vehical_id" id="vehical_id">
                                            <div class="form-group search-brand-input">
                                                <label for="exampleInputEmail1" class="sr-only">Search Brand</label>
                                                <select class="form-control" name="search_brand" id="search_brand">
                                                	<option value="">select brand</option>
                                                	<?php foreach ($brands_data as $brand) { ?>
                                                		<option value="<?= $brand['id'] ?>"><?= $brand['name'] ?></option>
                                                	<?php } ?>
                                                </select>
                                                <div class="messageContainer"></div>
                                            </div>
                                            <div class="form-group search-brand-input">
                                                <label for="exampleInputEmail1" class="sr-only">Search Model</label>
                                                <select class="form-control" name="search_model" id="search_model">
                                                	<option value="">Select Model</option>
                                                </select>
                                                <div class="messageContainer"></div>
                                            </div>

                                            <div class="row user-selected-bikebrand">
                                                <div class="col-lg-3 col-md-4 col-sm-12 col-12 pb-4">
                                                    <div class="card search-bike-brand">
                                                        <div class="d-flex">
                                                            <h6 class="">Brand</h6>
                                                            <a href="#" class="ml-auto"><i class="fas fa-times"></i></a>
                                                        </div>
                                                        <h3 class="user-selected-bike" id="brandname"></h3>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-md-4 col-sm-12 col-12 pb-4">
                                                    <div class="card search-bike-brand">
                                                        <div class="d-flex">
                                                            <h6 class="">Model</h6>
                                                            <a href="#" class="ml-auto"><i class="fas fa-times"></i></a>
                                                        </div>
                                                        <h3 class="user-selected-bike" id="modelname"></h3>    
                                                    </div>   
                                                </div>
                                            </div>

                                            <div class="form-row pl-1">
                                                <div class="form-group col-lg-5 col-md-5 col-sm-12 col-12">
                                                    <label for="vehicle-no">Vehicle no.</label>
                                                    <input type="text" class="form-control vehicle__number" placeholder="Vehicle no" name="vehicle_no" id="vehicle_no">
                                                    <div class="messageContainer"></div>
                                                </div>

                                                <div class="form-group col-lg-5 col-md-5 col-sm-12 col-12">
                                                    <label for="manufactured-year">Manufactured Year</label>
                                                    <input type="text" class="form-control manufactured__year"  placeholder="Manufactured Year" name="manufactured_year" id="manufactured_year">
                                                    <div class="messageContainer"></div>
                                                </div>
                                            </div>

                                            <div class="form-row pl-1">
                                                <div class="form-group col-lg-5 col-md-5 col-sm-12 col-12">
                                                    <label for="total-kms">Total kms</label>
                                                    <input type="text" class="form-control total__kms" placeholder="Total kms" name="total_kms" id="total_kms">
                                                    <div class="messageContainer"></div>
                                                </div>

                                                <div class="form-group col-lg-5 col-md-5 col-sm-12 col-12 ">
                                                    <label for="insurance">Insurance no.</label>
                                                    <input type="text" class="form-control"  placeholder="Insurance no." name="insurance_no" id="insurance_no">
                                                    <div class="messageContainer"></div>
                                                </div>
                                            </div>

                                            <div class="form-row pl-1 ">
                                                <div class="form-group col-lg-5 col-md-5 col-sm-12 col-12">
                                                    <label for="purchase-date">Purchase date</label>
                                                    <input type="text" class="form-control" placeholder="Purchase date" name="purchase_date" id="purchase_date">
                                                    <div class="messageContainer"></div>
                                                </div>

                                                <div class="form-group col-lg-5 col-md-5 col-sm-12 col-12">
                                                    <label for="issued-by">Issued by</label>
                                                    <input type="text" class="form-control"  placeholder="Issued by" name="issued_by" id="issued_by">
                                                    <div class="messageContainer"></div>
                                                </div>
                                            </div>

                                            <div class="form-button">
                                                <button class="add-vehicle-btn" type="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Addresses Section -->
            <div class="col-xl-10 col-lg-9 col-md-9 col-sm-12  tabcontent user-address pb-5" id="Addresses">
                <div class="row users-saved-addresses">
                    <div class="col">
                        <div class="card saved-address-card">
                            <div class="user-address-section">
                                <h5 class="address-title">Saved Addresses</h5>
                                <div class="row pt-4 pb-5">
                                    <?php 
                                    if (!empty($userAddress)) {
                                        foreach ($userAddress as $data) { 
                                            $address_id = $data['id']; ?>
                                    <div class="col-lg-6 col-md-12 col-sm-12 pb-4">
                                        <div class="card card-1 home-address ">
                                        	<?= ($data['is_primary'] == 1)?'<span style="color: #f15b36;"><i class="fa fa-check"></i> Primary Address</span>':'<a href="#" class="is_primary" id="is_primary-'.$address_id.'" style="color: #e0e0e0;"><i class="fa fa-check"></i> Primary Address</a>'; ?>
                                            <h6 class="home-name"><?= ($data['address_name'] == 1 ? "Home Address" : ($data['address_name'] == 2 ? "Office Address" : "Other Address")); ?> 
                                            </h6>
                                            <h6 class="exact-address">
                                                <?php
                                                    $address = $data['address'].", ".$data['locality'].", ".$data['landmark'].", ".$data['cityname'].", ".$data['statename'].", ".$data['pincode'];
                                                    echo $address;
                                                ?>
                                            </h6>

                                            <div class="edit-delete-address  pt-3">
                                                <a href="#" class="edit" id="<?= $address_id ?>">Edit</a>
                                                <a href="#" class="pl-3 delete" id="<?= $address_id ?>">Delete</a>
                                            </div>
                                        </div>
                                    </div>  
                                    <?php } } ?>
                                </div>
                            </div>
                            <div class="text-center pb-3">
                                <button type="button" class="btn btn-info" id="btnaddress" >Add New Address</button>
                            </div>
                        </div>  
                    </div>
                </div>

                <div class="row add-new-address-section" id="address_div" style="display: none;">
                    <div class="col">
                        <div class="card saved-address-card">
                            <div class="user-addnew-address">
                                <h6 class="add-new-address-title" id="address_title"></h6>
                                <form class="profile-login-form" id="frm_address">
                                <input type="hidden" name="address_id" id="address_id">
                                    <div class="row">
                                    <div class="form-group col-lg-12">
                                        <label for="address_type" class="sr-only">Address Type</label>
                                        <select class="form-control" name="address_type" id="address_type">
                                            <option value="">Select</option>
                                            <option value="1">Home Address</option>
                                            <option value="2">Office Address</option>
                                            <option value="3">Other</option>
                                        </select>
                                        <div class="messageContainer"></div>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label for="Location" class="sr-only">Locality</label>
                                            <input type="text" class="form-control" placeholder="Enter Locality" name="locality" id="locality" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                                            <input type="hidden" name="latitude" id="lat">
                                            <input type="hidden" name="longitude" id="long">
                                            <div class="messageContainer"></div>
                                        <div class="pt-4">
                                            <h5 class="user-entered-location" id="selected-locality"></h5>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="address" class="sr-only">Address</label>
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address">
                                        <div class="messageContainer"></div>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="landmark" class="sr-only">Landmark</label>
                                        <input type="text" class="form-control" name="landmark" id="landmark" placeholder="Enter Landmark">
                                        <div class="messageContainer"></div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="form-group col-lg-6">
                                        <input type="hidden" id="selected_stateid">
                                        <label for="state">State</label>
                                        <select class="form-control" name="state" id="state">
                                            <option value="">Select</option>
                                        </select>
                                        <div class="messageContainer"></div>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <input type="hidden" id="selectedcity">
                                        <label for="city">city</label>
                                        <select class="form-control" name="city" id="city">
                                            <option value="">Select</option>
                                        </select>
                                        <div class="messageContainer"></div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="pincode">Pincode</label>
                                        <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Enter Pincode" maxlength="6">
                                        <div class="messageContainer"></div>
                                    </div>
                                    </div>
                                    <span id="address-response-msg"></span>

                                <div class="text-center pb-3">
                                    <button type="submit" class="btn address-update-btn">Submit</button>
                                </div>
                                </form>     
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Refer and Earn section -->
            <div class="col-xl-10 col-lg-9 col-md-9 col-sm-12    tabcontent refer-earn-section pb-5 text-center" id="Refer">
                <div class="card text-center refer-earn-card">
                    <div class="d-flex justify-content-center">
                        <img src="<?php echo asset_url();?>frontend/images/refer&earn.png">
                    </div>  

                    <div class="refer-code">
                        <h5 class="offer-title">Rs 100 off for you and your friend</h5>
                        <small>Refer Code</small>   
                        <h5 class="user-refer-code">ABCD12345</h5>
                        <button class="share-code-btn">Share with your friends</button>
                    </div>
                </div>
            </div>

            <!-- points section -->
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

                                    <tr>
                                        <td>10-Jan-2019</td>
                                        <td class="deducted-points">- 1000pts</td>
                                    </tr>

                                    <tr>
                                        <td>10-Jan-2019</td>
                                        <td class="points-gain">+ 1000pts</td>
                                    </tr>

                                    <tr>
                                        <td>10-Jan-2019</td>
                                        <td class="deducted-points">- 1000pts</td>
                                    </tr>

                                    <tr>
                                        <td>10-Jan-2019</td>
                                        <td class="points-gain">+ 1000pts</td>
                                    </tr>

                                    <tr>
                                        <td>10-Jan-2019</td>
                                        <td class="deducted-points">- 1000pts</td>
                                    </tr>

                                    <tr>
                                        <td>10-Jan-2019</td>
                                        <td class="points-gain">+ 1000pts</td>
                                    </tr>

                                    <tr>
                                        <td>10-Jan-2019</td>
                                        <td class="deducted-points">- 1000pts</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12  point-card-section">
                            <div class="user-point-card">
                                <div class="card">
                                    <small class="points-title">Your Points</small>
                                    <div class="d-flex">
                                        <h6 class="user-total-points">2000 points</h6>
                                        <img class="card-brand-logo" src="<?php echo asset_url();?>frontend/images/sologo.png">   
                                    </div>

                                    <div class="card-details pt-3">
                                        <h5 class="card-number">xxxx - xxxx - xxxx - xxxx</h5>
                                        <h6 class="card-holder-name">Saquib Jawed</h6>
                                    </div>
                                </div>

                                <div class="text-center earn-more-points mt-4 pt-2">
                                    <a href >Earn More points</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents -->
            <div class="col-lg-9 col-md-9 col-sm-12 tabcontent  pb-5" id="Digi">
                <div class="card "> 
                    <div class="document-upload ">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="documents-list first-document">
                                    <h4 class="document-name-title">Document Name</h4>
                                    <!-- <input id="upload" type="file"/> -->
                                    <input type="text" name="">
                                    <label for="files" class="btn">Upload</label>
                                    <span><input id='files' style="visibility:hidden;" type='file' /></span>
                                    <img id="myImg" src="#" alt="" />   
                                </div>          
                            </div>  
                        </div>      
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<!-- <div class="modal fade editAddressModal" id="editAddressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"><br><br><br>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="profile-login-form" id="frm_address" onsubmit="return frm_submit('frm_address');">
            <div class="modal-body">
            <input type="hidden" name="address_id" id="address_id">
                <div class="row">
                <div class="form-group col-lg-12">
                    <label for="address_type" class="sr-only">Address Type</label>
                    <select class="form-control" name="address_type" id="address_type">
                        <option value="">Select</option>
                        <option value="1">Home Address</option>
                        <option value="2">Office Address</option>
                        <option value="3">Other</option>
                    </select>
                    <div class="messageContainer"></div>
                </div>
                <div class="form-group col-lg-12">
                    <label for="Location" class="sr-only">Locality</label>
                        <input type="text" class="form-control" placeholder="Enter Locality" name="locality" id="locality" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                        <input type="hidden" name="latitude" id="lat">
                        <input type="hidden" name="longitude" id="long">
                        <div class="messageContainer"></div>
                    <div class="pt-4">
                        <h5 class="user-entered-location" id="selected-locality"></h5>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="form-group col-lg-6">
                    <label for="address" class="sr-only">Address</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address">
                    <div class="messageContainer"></div>
                </div>

                <div class="form-group col-lg-6">
                    <label for="landmark" class="sr-only">Landmark</label>
                    <input type="text" class="form-control" name="landmark" id="landmark" placeholder="Enter Landmark">
                    <div class="messageContainer"></div>
                </div>
                </div>
                <div class="row">
                <div class="form-group col-lg-6">
                    <input type="hidden" id="selected_stateid">
                    <label for="state">State</label>
                    <select class="form-control" name="state" id="state">
                        <option value="">Select</option>
                    </select>
                    <div class="messageContainer"></div>
                </div>

                <div class="form-group col-lg-6">
                    <input type="hidden" id="selectedcity">
                    <label for="city">city</label>
                    <select class="form-control" name="city" id="city">
                        <option value="">Select</option>
                    </select>
                    <div class="messageContainer"></div>
                </div>
                </div>
                <div class="row">
                <div class="form-group col-lg-6">
                    <label for="pincode">Pincode</label>
                    <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Enter Pincode" maxlength="6">
                    <div class="messageContainer"></div>
                </div>
                <span id="address-response-msg"></span>
                </div>
            </div>

            <div class="text-center pb-3">
                <button type="submit" class="btn address-update-btn">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div> -->
<script src="<?php echo asset_url();?>frontend/js/addaddress.js"></script>
<script>
$.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&callback=initMap&key=<?= GOOGLE_MAP_API_KEY; ?>");

function initMap() { 
    var options = {
        componentRestrictions: { country: 'in' }
    }; 
    var input = document.getElementById('locality');
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
        $('#lat').val(place.geometry.location.lat());
        $('#long').val(place.geometry.location.lng());
        $("#selected-locality").html(input.value); 
    });
}

$(document).ready(function() {

    var optionsMobile = {
        'show' : true,
        'backdrop' : 'static',
        'keyboard' : false
    }

    $(document).on('blur', '#mobile', function () {
        var mobile = $(this).val();
        var oldMobile = $("#oldMobile").val();
        if (mobile != oldMobile) {
            loginWithOTP();
        }
    });

    function loginWithOTP() {
        ajaxindicatorstart("Please wait..");
        $.post(base_url+"send_otp_verify_mobile",{username: $("#mobile").val(), seprateView:1},function(data) {
            ajaxindicatorstop();
            if(data.exist_flag === 0){

            $("#mobileModel").empty();
            $("#mobileModel").html(data.view);
            $("#md-verifymobile").modal(optionsMobile);
            $("#sent-otp").val(data.otp);
            $("#resent-msg").html('Please enter OTP which send your mobile number');
            } else {
                alert('Mobile number alrady exist, Please enter another number.');
                return false;
            }                
        },'json');
        return false;
    }

    $('#frm_profile').bootstrapValidator({
        container: function($field, validator) {
            return $field.parent().find('.messageContainer');
        },
        feedbackIcons: {
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {
            'fname': {
                validators: {
                    notEmpty: {
                        message: 'Please Enter First Name'
                    },
                    regexp:{
                        regexp:'^[a-zA-Z]+$',
                        message: 'Allowed letters only'
                    }
                }
            },
            'lname': {
                validators: {
                    notEmpty: {
                        message: 'Please Enter Last Name'
                    },
                    regexp:{
                        regexp:'^[a-zA-Z]+$',
                        message: 'Allowed letters only'
                    }
                }
            },
            'mobile': {
                validators: {
                    notEmpty: {
                        message: 'Please Enter Mobile'
                    },
                    regexp:{
                        regexp:'^[6-9][0-9]{9}$',
                        message: 'Please enter a 10 digit valid mobile number'
                    }
                }
            },
            'email': {
                validators: {
                    notEmpty: {
                        message: 'Please Enter Email'
                    },
                    regexp:{
                        regexp:'^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'Not a valid email address '
                    }
                }
            },
            'dob': {
                validators: {
                    notEmpty: {
                        message: 'Please Select Date of Birth'
                    }
                }
            },
            'gender': {
                validators: {
                    notEmpty: {
                        message: 'Please Select Gender'
                    }
                }
            },
            'pincode': {
                validators: {
                    notEmpty: {
                        message: 'Please Enter Pincode'
                    }
                }
            }
        }
        }).on('success.form.bv', function(event,data) {
            event.preventDefault();
            $("#response-msg").hide();
            var formData = new FormData($('#frm_profile')[0]);
            ajaxindicatorstart('please wait');
            $.ajax({ url: base_url + 'profile_update', data: formData, type: 'POST', dataType: 'JSON', processData: false, contentType: false, success: function (response) { 
                ajaxindicatorstop();
                    $("#response-msg").show();
                    if (response.status == 1) {
                        $("#isOtpVerify").val(0);
                        $("#response-msg").css('color','green');
                        $("#response-msg").html('Profile updated successfully');
                        setInterval(function(){ location.reload(); }, 3000);
                    } else {
                        $("#response-msg").css('color','red');
                        $("#response-msg").html("Error, Something went wrong!");
                    }
                }
            });
        return false;
    });

	get_states();

	var userid = "<?= (isset($_SESSION['olouserid']))?$_SESSION['olouserid']:0; ?>";
	$(document).on('click', '.edit', function() {
	    var addr_id = $(this).attr('id');
	    $.post(base_url+"edit-address", {userid: userid, address_id: addr_id}, function (data) {
	        $("#address_title").html("Edit Address");
	        $("#address_type").val(data[0].address_name);
	        $("#locality").val(data[0].locality);
	        $("#selected-locality").html(data[0].locality);
	        $("#lat").val(data[0].latitude);
	        $("#long").val(data[0].longitude);
	        $("#address").val(data[0].address);
	        $("#landmark").val(data[0].landmark);
	        $("#pincode").val(data[0].pincode);
	        $("#state").val(data[0].state);
	        $("#address_id").val(addr_id);
	        get_cities(data[0].city);
	        $("#address-response-msg").html("");
	        $("#address_div").show();
	        // $("#setfrm").html($("#getfrm").html());
	        // $("#editAddressModal").modal('show');
	    },"json");
	});

	function get_states() {
	    $.get(base_url+"get_statelist",{}, function(data) {
	        var selectElem = $("#state");
	        $.each(data, function (id,state) {
	            $("<option/>", {value: state.id,text: state.name}).appendTo(selectElem);                    
	        });
	    },"json");
	}

	$(document).on("change","#state",function () {
	    get_cities();
	});

	function get_cities(selectedcity=null) {
	    var stateid = $("#state").val();
	    $.get(base_url+"get_citylist",{stateid:stateid}, function(data) {
	        var selectElem = $("#city");
	        $(selectElem).html("<option value=''>Select</option>");
	        $.each(data, function (id,city) {
	            var selected = "";
	            if (selectedcity === city.id) {
	                selected = "selected";
	            }
	            $("<option/>", {value: city.id, text: city.name, selected: selected}).appendTo(selectElem);
	        });
	    },"json");
	}

	$(document).on("click", ".delete", function () {
	    var id = $(this).attr('id');
	    $.post(base_url+'delete-address', {address_id:id}, function (data) {
	        alert("Address deleted successfully");
	        location.reload();
	    },"json");
	});
   
	$("#frm_address").bootstrapValidator({
	    container: function($field, validator) {
	        return $field.parent().find('.messageContainer');
	    },
	    feedbackIcons: {
	        validating: 'glyphicon glyphicon-refresh'
	    },
	    excluded: ':disabled',
	    fields: {
	        'address_type': {
	            validators: {
	                notEmpty: {
	                    message: 'Please Select Address Type'
	                }
	            }
	        },
	        'locality': {
	            validators: {
	                notEmpty: {
	                    message: 'Please Enter Locality'
	                }
	            }
	        },
	        'address': {
	            validators: {
	                notEmpty: {
	                    message: 'Please Enter Address'
	                }
	            }
	        },
	        'landmark': {
	            validators: {
	                notEmpty: {
	                    message: 'Please Enter Landmark'
	                }
	            }
	        },
	        'state': {
	            validators: {
	                notEmpty: {
	                    message: 'Please Select State'
	                }
	            }
	        },
	        'city': {
	            validators: {
	                notEmpty: {
	                    message: 'Please Select City'
	                }
	            }
	        },
	        'pincode': {
	            validators: {
	                notEmpty: {
	                    message: 'Please Enter Pincode'
	                }
	            }
	        }
	    }
	    }).on('success.form.bv', function(event,data) {
	        event.preventDefault();
	        $("#address-response-msg").hide();
	        var formData = new FormData($("#frm_address")[0]);
	        ajaxindicatorstart('please wait');
	        $.ajax({ url: base_url + 'address_submit', data: formData, type: 'POST', dataType: 'JSON', processData: false, contentType: false, success: function (response) { 
	            ajaxindicatorstop();
	                $("#address-response-msg").show();
	                if (response.result == 1) {
	                    $("#address-response-msg").css('color','green');
	                    $("#address-response-msg").html(response.msg);
	                    setInterval(function() { location.reload();}, 3000);
	                } else {
	                    $("#address-response-msg").css('color','red');
	                    $("#address-response-msg").html("Error, Something went wrong!");
	                }
	            }
	        });
	    return false;
	});

	$(document).on("click", ".is_primary", function () {
		var id = $(this).attr('id').split('-');
		$.post(base_url+'set_isPrimary_address', {userid:userid, address_id:id[1]}, function (data) {
			alert("Primary address saved successfully");
			location.reload();
		},"json");
	});

    $('#frm_vehicle').bootstrapValidator({
        container: function($field, validator) {
            return $field.parent().find('.messageContainer');
        },
        feedbackIcons: {
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {
            'search_brand': {
                validators: {
                    notEmpty: {
                        message: 'Please Select Brand'
                    }
                }
            },
            'search_model': {
                validators: {
                    notEmpty: {
                        message: 'Please Select Model'
                    }
                }
            },
            'vehicle_no': {
                validators: {
                    notEmpty: {
                        message: 'Please Enter Vehicle Number'
                    }
                }
            },
            'manufactured_year': {
                validators: {
                    notEmpty: {
                        message: 'Please Select Manufactured Year'
                    }
                }
            },
            'total_kms': {
                validators: {
                    notEmpty: {
                        message: 'Please Enter Total Kilometers'
                    }
                }
            },
            'insurance_no': {
                validators: {
                    notEmpty: {
                        message: 'Please Enter Insurance Number'
                    }
                }
            },
            'purchase_date': {
                validators: {
                    notEmpty: {
                        message: 'Please Select Purchase Date'
                    }
                }
            },
            'issued_by': {
                validators: {
                    notEmpty: {
                        message: 'Please Enter Issued By'
                    }
                }
            }
        }
        }).on('success.form.bv', function(event,data) {
            event.preventDefault();
            $("#vehicle-response-msg").hide();
            var formData = new FormData($('#frm_vehicle')[0]);
            ajaxindicatorstart('please wait');
            if ($("#vehical_id").val() == "") {
            	var setUrl = base_url+"add_vehicle";
            	var msg = "Vehicle added successfully";
            } else {
            	var setUrl = base_url+"update_vehical";
            	var msg = "Vehicle updated successfully";
            }
            $.ajax({ url: setUrl, data: formData, type: 'POST', dataType: 'JSON', processData: false, contentType: false, success: function (response) { 
                ajaxindicatorstop();
                    $("#vehicle-response-msg").show();
                    if (response.status == 1) {
                        $("#vehicle-response-msg").css('color','green');
                        $("#vehicle-response-msg").html(msg);
                        setInterval(function(){ location.reload(); }, 3000);
                    } else if(response.status == 0) {
                        $("#vehicle-response-msg").css('color','red');
                        $("#vehicle-response-msg").html(response.msg);
                    } else {
                        $("#vehicle-response-msg").css('color','red');
                        $("#vehicle-response-msg").html("Error, Something went wrong.");
                    }
                }
            });
        return false;
    });

    $(document).on("change", "#search_brand", function () {
		getmodellist();
	});

	$(document).on("click", ".editvehical", function () {
		var vehicleid = $(this).attr('id');
		$.post(base_url+"admin/vehicle/get_vehicles_by_id", {vehicle_id:vehicleid}, function (data) {
			document.getElementById("frm_vehicle").reset();
			$("#vehical_title").html("Edit Vehical");
			$("#vehical_id").val(data.id);
			$("#search_brand").val(data.brand_id);
			getmodellist(data.model_id);
			$("#modelname").html(data.modelname);
			$("#vehicle_no").val(data.vehicle_no);
			$("#manufactured_year").val(data.manufactured_year);
			$("#total_kms").val(data.total_kms);
			$("#insurance_no").val(data.insurance_no);
			$("#purchase_date").val(data.purchase_date);
			$("#issued_by").val(data.issued_by);
	    }, "json");
	});

	$(document).on("change", "#search_model", function () {
		var name = $("#search_model option:selected").text();
		$("#modelname").html(name);
	});

	$(document).on("click", ".deletevehical", function () {
	    var id = $(this).attr('id');
	    $.post(base_url+'delete_vehical', {vehical_id:id}, function (data) {
	        alert("Vehical deleted successfully");
	        location.reload();
	    },"json");
	});

});

$("#btnaddress").on("click", function () {
	$("#address_title").html("Add New Address");
	$("#address_id").val('');
	document.getElementById("frm_address").reset();
	$("#address_div").show();
});

function getmodellist(selectedmodelid=null) {
	var brandid = $("#search_brand").val();
	var name = $("#search_brand option:selected").text();
	$("#brandname").html(name);
	$.get(base_url+"get-models-by-brandId", {brandId:brandid}, function (data) {
		var selectElem = $("#search_model");
		selectElem.html('<option value="">Select Model</option>');

		$.each(data, function(key, model){

			$option = $('<option value="' + model.id + '">' + model.name + '</option>');
			var slcted = "";
            if (selectedmodelid === model.id) {
                slcted = "selected";
				$option.attr('selected', 'selected');
            }
			selectElem.append($option);
	    });
    }, "json");
}

function getData(e) {
    e.preventDefault();
}

$('.tablinks').click(function(){
    $('button').removeAttr('id');
    $(this).attr('id', 'profile-active-btn');
})


$(function () {
    $(":file").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });
});

function imageIsLoaded(e) {
    $('#myImg').attr('src', e.target.result);
};


function imageIsLoaded(e) {
    $('#myImg').attr('src', e.target.result);
};

function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>