<!-- Order History and accordin -->
<section id="profile-login">
    <div class="d-flex align-items-center profile-title-img">
        <img src="<?php echo asset_url();?>frontend/images/profile-img.png" class="profile-img pr-2">
        <span class="profile-title">Profile</span>
    </div>
    <div class="all-user-history">
        <div class="row profile-section-row">
            <?php echo $sidebar_url; ?>
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
        </div>
    </div>
</section>