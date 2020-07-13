<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/colors/yellow.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/checkout-responsive.css">

<!-- Use For Autocomplete -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<style type="text/css">

.searched-garages-section .rating-star {
    height: 15px;
    object-fit: contain;
    position: relative;
    top: -3px;
    margin-right: 10px;
}

.searched-garages-section .price-img {
    width: 10px;
    height: 14px;
    object-fit: contain;
    background-color: #f1685c;
    position: relative;
    top: -2px;
  }

  .searched-garages-section .timer-img {
    width: 21px;
    height: 16px;
    position: relative;
    top: -1px;
    object-fit: contain;
    margin-right: 10px;
}

.card-img-top{
    max-width: 100%!important;
}
</style>
<section id="garage-list">
    <div class="row filter-section-cards align-items-center">
        <div class="col-lg-2 col-md-2 col-sm-12 ">
            <div class="text-center filter-title-icon">
                <img class="filter-img" src="<?php echo asset_url();?>frontend/images/control-img.png">
                <span class="filter">Filters</span>
            </div>
        </div>

        <div class="col-lg-5 col-md-5 col-sm-12">
            <form class="form-inline my-2 my-lg-0 applied-filter">
                <div class="form-group d-none">
                    <label for="bike-model" class="sr-only">Your Bike</label>
                    <?php 
                    $vehicle = "Not Available";
                    if (!empty($_SESSION['olouserid']) && !empty($userVehicle)) {
                            foreach ($userVehicle as $data) {
                                if ($data['is_primary_vehicle'] == 1) {
                                    $vehicle = $data['brandname']." ". $data['modelname'];
                                    break;
                                }
                            }

                            if ($vehicle == "Not Available") {
                                $last_id = sizeof($userVehicle)-1;
                                $vehicle = $userVehicle[$last_id]['brandname']." ". $userVehicle[$last_id]['modelname'];
                            }
                        }
                    ?>
                    <input type="text" class="form-control user-bike-selected" placeholder="Your Bike - <?= $vehicle ?>" disabled>
                    <i class="fas fa-times bike-selection-remove"></i>
                </div>
            </form>
        </div>

        <div class="col-lg-5 col-md-5 col-sm-12">
            <form class="d-flex justify-content-end search-garage-input">
                <div class="form-group ">
                    <label for="garage-search" class="sr-only">Search Garage</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="search garage">
                    <input type="hidden" id="vendor_id" name="vendor_id">
                </div>
            </form>	
        </div>
        <br/>
        <br/>
    </div>

    <div class="row filter-section">
        <div class="col-lg-3 col-md-3 col-sm-4">
            <div class="card filter-sections-card">
                <div class="card-head">
                    <h5>Brand</h5>
                </div>

                <div class="card-body">
                    <div class="user-select">
                        <?php $brandsize = sizeof($brands);
                        for($i = 0; $i < 4; $i++){?>
                        <div>
                            <label>
                                <input type="checkbox" class="common_selector brand model_by_brands" name="ch-brand[]" value="<?= $brands[$i]['id'] ?>">
                                <span class="pl-3"><?= $brands[$i]['name'] ?></span>
                            </label>
                        </div>	
                        <?php } ?>

                        <div>
                            <h5  class="see-more" data-toggle="modal" data-target="#brandModal">See <?= $brandsize-4; ?> More</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="brandModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" >
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Brand</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body" >
                            <div class="listWrapper widget_layered_nav">
                                <ul id="demoThree" class="demo">
                                    <?php $brandsize = sizeof($brands);
                                    for($i = 4; $i < $brandsize; $i++){?>
                                    <li>
                                        <label>
                                            <input type="checkbox" class="brand" name="ch-brand[]" value="<?= $brands[$i]['id'] ?>">
                                            <span class="pl-3"><?= $brands[$i]['name'] ?></span>
                                        </label>
                                    </li>  
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn common_selector model_by_brands" data-dismiss="modal">Apply</button>
                        </div>

                    </div>
                </div>
            </div>


            <!-- Model Filter -->
            <div class="card filter-sections-card">
                <div class="card-head">
                    <h5>Model</h5>
                </div>

                <div class="card-body" id="modelList">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <!-- <div class="user-select">
                        <?php $modelsize = sizeof($models);
                        for($i = 0; $i < 4; $i++){?>
                        <div>
                            <label>
                                <input type="checkbox" class="common_selector model" name="ch-model[]" value="<?= $models[$i]['id'] ?>">
                                <span class="pl-3"><?= $models[$i]['name'] ?></span>
                            </label>
                        </div>  
                        <?php } ?>	

                        <div>
                            <h5 class="see-more" data-toggle="modal" data-target="#bikebrandModal">See <?= $modelsize-4; ?> More</h5>
                        </div>
                    </div> -->
                </div>
            </div>


            <!-- Bike model Modal -->
            <div class="modal fade" id="bikebrandModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Model</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="listWrapper widget_layered_nav">
                                <ul id="demoThree" class="demo modelModalList">
                                    <!-- <?php $modelsize = sizeof($models);
                                    for($i = 4; $i < $modelsize; $i++){?>
                                    <div>
                                        <label>
                                            <input type="checkbox" class="model" name="ch-model[]" value="<?= $models[$i]['id'] ?>">
                                            <span class="pl-3"><?= $models[$i]['name'] ?></span>
                                        </label>
                                    </div>  
                                    <?php } ?> -->
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn common_selector" data-dismiss="modal">Apply</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card filter-sections-card d-none">
                <div class="card-head">
                    <h5>Service Category</h5>
                </div>

                <div class="card-body">
                    <div class="user-select">
                        <label>
                            <input type="radio" name="group1" value="">
                            <span class="pl-3">Tyre</span>
                        </label>

                        <div>
                            <label>
                                <input type="radio" name="group1" value="">
                                <span class="pl-3">Engine</span>
                            </label>
                        </div>	


                        <div>
                            <label>
                                <input type="radio" name="group1" value="">
                                <span class="pl-3">Headlight</span>
                            </label>
                        </div>	

                        <div id="dots-2">
                            <label>
                                <input type="radio" name="group1" value="">
                                <span class="pl-3">Breaks</span>
                            </label>
                        </div>	

                        <div id="service-model">
                            <div>
                                <label>
                                    <input type="radio" name="group1" value="">
                                    <span class="pl-3">Model 5</span>
                                </label>
                            </div>	

                            <div>
                                <label>
                                    <input type="radio" name="group1" value="">
                                    <span class="pl-3">Model 6</span>
                                </label>
                            </div>

                            <div>
                                <label>
                                    <input type="radio" name="group1" value="">
                                    <span class="pl-3">Model 7</span>
                                </label>
                            </div>

                            <div>
                                <label>
                                    <input type="radio" name="group1" value="">
                                    <span class="pl-3">Brand 8</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <h5  class="see-more" data-toggle="modal" data-target="#servicecateModal">See 25 More</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service type model -->

            <!-- Bike model Modal -->
            <div class="modal fade" id="servicecateModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Brand</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="listWrapper widget_layered_nav">

                                <ul id="demoThree" class="demo">
                                    <li><input type="checkbox"> Tyre</li>
                                    <li><input type="checkbox"> Engine</li>
                                    <li><input type="checkbox"> Breaks</li>
                                    <li><input type="checkbox"> Headlights</li>
                                    <li><input type="checkbox"> wires</li>
                                    <li><input type="checkbox"> oil</li>
                                    <li><input type="checkbox"> Rim</li>

                                    <li><input type="checkbox"> Tyre</li>
                                    <li><input type="checkbox"> Engine</li>
                                    <li><input type="checkbox"> Breaks</li>
                                    <li><input type="checkbox"> Headlights</li>
                                    <li><input type="checkbox"> wires</li>
                                    <li><input type="checkbox"> oil</li>
                                    <li><input type="checkbox"> Rim</li>

                                    <li><input type="checkbox"> Tyre</li>
                                    <li><input type="checkbox"> Engine</li>
                                    <li><input type="checkbox"> Breaks</li>
                                    <li><input type="checkbox"> Headlights</li>
                                    <li><input type="checkbox"> wires</li>
                                    <li><input type="checkbox"> oil</li>
                                    <li><input type="checkbox"> Rim</li>

                                    <li><input type="checkbox"> Tyre</li>
                                    <li><input type="checkbox"> Engine</li>
                                    <li><input type="checkbox"> Breaks</li>
                                    <li><input type="checkbox"> Headlights</li>
                                    <li><input type="checkbox"> wires</li>
                                    <li><input type="checkbox"> oil</li>
                                    <li><input type="checkbox"> Rim</li>
                                </ul>

                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn" data-dismiss="modal">Apply</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card filter-sections-card">
                <div class="card-head">
                    <h5>Service Category</h5>
                </div>

                <div class="card-body">
                    <div class="user-select">
                        <label>
                            <input type="radio" class="common_selector" name="star" value="5">
                            <span class="pl-3">5 star</span>
                        </label>

                        <div>
                            <label>
                                <input type="radio" class="common_selector" name="star" value="4">
                                <span class="pl-3">4 star & above</span>
                            </label>
                        </div>	


                        <div>
                            <label>
                                <input type="radio" class="common_selector" name="star" value="3">
                                <span class="pl-3">3 star & above</span>
                            </label>
                        </div>	

                        <div>
                            <label>
                                <input type="radio" class="common_selector" name="star" value="2">
                                <span class="pl-3">2 star & above</span>
                            </label>
                        </div>	
                    </div>
                </div>
            </div>


            <div class="card filter-sections-card d-none">
                <div class="card-head">
                    <h5>Offers</h5>
                </div>

                <div class="card-body">
                    <div class="user-select">
                        <label>
                            <input type="radio" name="group1" value="">
                            <span class="pl-3">> 10% Off</span>
                        </label>

                        <div>
                            <label>
                                <input type="radio" name="group1" value="">
                                <span class="pl-3">10-20% Off</span>
                            </label>
                        </div>	


                        <div>
                            <label>
                                <input type="radio" name="group1" value="">
                                <span class="pl-3">20% - 40% Off</span>
                            </label>
                        </div>	

                        <div id="dots-2">
                            <label>
                                <input type="radio" name="group1" value="">
                                <span class="pl-3">Above 40% Off</span>
                            </label>
                        </div>	
                    </div>
                </div>
            </div>
        </div>
        <?php //echo "<pre>"; print_r($_SESSION['G_filter']); die(); ?>
        <div class="col-lg-9 col-md-9 col-sm-8 searched-garages-section">
            <input type="hidden" id="latitude" value="<?= $location_data['latitude']; ?>">
            <input type="hidden" id="longitude" value="<?= $location_data['longitude']; ?>">
            <input type="hidden" id="locality" value="<?= $location_data['locality']; ?>">
            <input type="hidden" id="serviceType" value="<?= $location_data['serviceType']; ?>">
            <div class="d-flex flex-wrap " id="garageList"><!-- remove this "justify-content-around" -->
        	
            </div>
            <div id="load_data_message" class="load-more" style="text-align: center;">
            
            </div>  
        </div>
    </div>
</section>

<script type="text/javascript" src="<?php echo asset_url();?>frontend/js/jquery-listnav.js"></script>
<script type="text/javascript" src="<?php echo asset_url();?>frontend/js/vendor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- jQuery UI -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

    var limit = 3;
    var start = 0;
    var action = 'inactive';

    function lazzy_loader(limit)
    {
      var output = '';
      for(var count=0; count<1; count++)
      {
        output += '<img src="<?php echo asset_url(); ?>frontend/images/loading.gif"/> Loading...';
      }
      $('#load_data_message').html(output);
    }

    //lazzy_loader(limit);

    function load_data(limit, start, vendor_id=null)
    {
        var loc = $("#locality").val();
        var lat = $("#latitude").val();
        var long = $("#longitude").val();
        var serviceType = $("#serviceType").val();
        var star = $("input[name='star']:checked").val();
        var brand = get_filter('brand');
        var model = get_filter('model');
        $.ajax({
            url: base_url + 'vendor/searched',
            type:'POST',
            data:{limit:limit, start:start, locality:loc, latitude:lat, longitude:long, st:serviceType, brand:brand, model:model, vendor_id:vendor_id, star:star},
            cache: false,
            success:function(data)
            {
                if(data == '')
                {
                    $('#load_data_message').html('<h3>No More Garage Found This Location</h3>');
                    action = 'active';
                }
                else
                {
                    $('#load_data_message').html("");
                    $('#garageList').append(data);
                    if (vendor_id == null) {
                    	action = 'inactive';
                    } else {
                    	action = 'active';
                    }
                }
            }
        });
    }

    if(action == 'inactive')
    {
        action = 'active';
        load_data(limit, start);
    }

    $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() > $("#garageList").height() && action == 'inactive')
        {
            lazzy_loader(limit);
            action = 'active';
            start = start + limit;
            setTimeout(function(){
                load_data(limit, start);
            }, 1000);
        }
    });

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.model_by_brands').click(function(){
        getModeldata();
    });

    $(document).on('click', '.common_selector', function(){
        $("#garageList").html("");
        lazzy_loader(limit);
        start = 0;
        load_data(limit, start);
    });

     // Initialize 
     $( "#search" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: base_url + "get_vendor_list",
            type: 'post',
            dataType: "json",
            data: {
              search: request.term
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        select: function (event, ui) {
          $('#search').val(ui.item.label); // display the selected text
          $('#vendor_id').val(ui.item.value); // save selected id to input
          if ($("#search").val() != '' && $("#vendor_id").val() != '') {
          	var vendor_id = $("#vendor_id").val();
          	$("#garageList").html("");
	        lazzy_loader(limit);
	        start = 0;
          	load_data(limit, start, vendor_id);
          }
          return false;
        }
      });

    getModeldata();

    function getModeldata() {
        var brand = get_filter('brand');
        $.ajax({
            url: base_url + 'getModelsByBrandsID',
            type:'POST',
            dataType:'json',
            data:{brand:brand},
            cache: false,
            success:function(data)
            {
                if(data.modelList == '')
                {
                    $('#modelList').html('<h3>No More Garage Found This Location</h3>');
                }
                else
                {
                    $('#modelList').html("");
                    $('#modelList').append(data.modelList);
                    $('.modelModalList').html("");
                    $('.modelModalList').append(data.modelModalList);
                }
            }
        });
    }

});


</script>


<script>
    function myFunction() {
        var dots = document.getElementById("dots");
        var moreText = document.getElementById("more");
        var btnText = document.getElementById("myBtn");

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "See more"; 
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "See less"; 
            moreText.style.display = "inline";
        }
    }
</script>	

<script>
    window.onscroll = function() {myFunction()};

    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    }
</script>

<!-- word max-width starts here-->

<script type="text/javascript">
    /*function truncateText(selector, maxLength) {
        var element = document.querySelector(selector),
        truncated = element.innerText;

        if (truncated.length > maxLength) {
            truncated = truncated.substr(0,maxLength) + '...';
        }
        return truncated;
    }
    document.querySelector('h3').innerText = truncateText('h3', 50);*/
</script>