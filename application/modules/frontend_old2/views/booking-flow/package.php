<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>/frontend/css/booking-flow/common.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>/frontend/css/banner.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>/frontend/css/booking-flow/selectize.bootstrap3.css">
<script type="text/javascript" src="<?php echo asset_url();?>/frontend/js/selectize.min.js"></script>

<style type="text/css">
  .text-box{
    border-radius: 29px !important;
    box-shadow: 0px 0px !important;
    font-size: 18px;
    font-weight: 500;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.5; 
    letter-spacing: 0.7px;
    text-align: left;
    color: #838383;
    padding: 5px 12px;
    border: 1px solid #cecece !important;
    height: 40px;
    min-height: 40px !important;
  }
</style>
<div class="booking">
	<div class="jumbotron custom-banner">
		<h1>Our Packages</h1>
		<p>We give to you, customised packages for your vehicle. These packages have been curated by our experienced team which enable you to get the best value for money.</p> 
		<div class="service-quote-section text-center">
	  	  <div class="inline-flex">
	  	  	  <button type="button" class="spl-btn service-btn" onclick="window.location.href = '<?php echo base_url();?>select-subcategory';">Book Now
                </button>
                <button type="button" class="spl-btn service-btn bt2" onclick="window.location.href = '<?php echo base_url();?>contact-us';">Contact Us
                </button>
	  	  </div>
	  </div>
	</div>
	<div class="container">
		
		<!-- selected modal -->
        <div class="select-modal">
        	<h1>Fix Price Servicing Package</h1>
        	<h2>Save 25% on your bike Maintenance only with bikedoctor</h2>
        	 <form  action="<?php echo base_url();?>package" method="GET">
			    <div class="input-group">
			      <input type="text"   required class="form-control custom-add text-box" id="servicename" placeholder="Enter brand/model " />  
			      <input type="hidden" name="searchid"  required class="form-control custom-add text-box" id="searchid" placeholder="Enter brand/model " />  
			      <div class="input-group-btn">
			        <button type="submit" class="spl-btn">Search</button>
			      </div>
			    </div>
			  </form>
        </div>
		<!-- selected modal -->

		
		<!-- Package Sections  -->
			<div class="package-section">
				<!-- <div class="row" id="ajax_row">  -->
					<div class="row">
                    <?php if (!empty($package)) { ?>
						            <?php foreach ($package as $item):
 						     $url=base_url().'book-service?id='.$item['id'];?>
					<div class="col-sm-6 col-md-4 col-xs-12">
						<div class="package text-center">
							<img src="<?php echo asset_url().'/'. $item['image'];?>" alt="thankyou">
							<h3><?php echo $item['package_name'];?></h3>
							<h4>Rs <strike> <?php echo number_format($item['best_price']);?></strike> Rs <?php echo number_format($item['special_price']);?></h4>
							<h4></h4>
						  <!--  <?php  foreach ($item['services'] as $services): ?>
							<p><?php echo $services['servicename'];?> </p>
						    <?php endforeach; ?> -->
						    <div style="height: 140px">

												     <?php  $services=$item['services'];

						                            for($f=0;$f<4;$f++){ 
											             echo '<p>'.(isset($services[$f]['servicename']) ? $services[$f]['servicename'] : "") .'</p>'; 
						                           }?>

						   </div>
							
							<h5>You Saved Rs <?php echo $item['best_price']-$item['special_price'];?></h5> 
							<button type="button" class="know-more-btn" onclick="quickView(<?= $item['id'];?>);">Know More+</button>
							<button type="button" class="custom-btn1" onclick="setPackage(<?= $item['id'];?>)">Buy Now</button>
						</div>
					</div>  
				     <?php endforeach;?>
					<?php } else{  ?>
								
				    <div class="col-sm-6 col-md-4 col-xs-12 text-center">
						<div class="package text-center">
						  <!-- <img src="<?php echo asset_url();?>frontend/images/" alt="thankyou">  --> 
							<h3>No Package Found</h3> 
						</div>
					</div>
					<?php } ?>
				</div>
			</div>

		<!-- <div class="confirm text-center">
			<button type="button" class="custom-btn1" id="load_more" data-val = "0">View More+ <img style="display: none" id="loader" src="http://www.trycatchclasses.com/code/demo/load-more-records-ci/asset/loader.GIF"></button>
		</div> -->
	</div>



					<!-- know more package pop up -->
                      <!-- Modal -->
                        <div id="quick_view_Popup" >
                          
                        </div>
                      <!-- Modal -->  
                    <!-- know more package pop up -->

  <script src="<?php echo asset_url();?>js/bootstrap-typeahead.min.js"></script>

<!-- select-location -->
  
<script>

	 $(document).ready(function(){
        getcountry(0);

        $("#load_more").click(function(e){
            e.preventDefault();
            var page = $(this).data('val'); 
            getcountry(page);

        });
        //getcountry();
        <?php if(isset($_GET['searchid'])){?>
         $('html, body').animate({
        scrollTop: $(".select-modal").offset().top
    }, 1000);
       <?php } ?> 	
    });

    var getcountry = function(page){
        $("#loader").show();
        $.ajax({
            url:"getmorepack",
            type:'GET',
            data: {page:page}
        }).done(function(response){
            $("#ajax_row").append(response);
            $("#loader").hide();
            $('#load_more').data('val', ($('#load_more').data('val')+1));
            scroll();
        });
    };

	  var scroll  = function(){
        $('html, body').animate({
            scrollTop: $('#load_more').offset().top
        }, 1000);
    }; 


		var userid = '<?php echo $this->session->userdata('olouserid') ; ?>';

     //  $("#servicename").selectize({});
    //function quickview
    function quickView(id){ 
     $.post(base_url+"quickView", {id : id}, function(data){
          $('#quick_view_Popup').html(data); 
             $("#package_modal").modal('show');
          },'html');
 }
</script>

  <script> 

 	function setPackage(id){ 
 		//debugger;
  		if(id==""){
 			 		swal('','Please select Package','error'); 
 		}else{
	   		$.post(base_url+'setPackage',{package_id:id},function(data){
	   			if(data.status==1){
	   				if(userid!=""){ 
						window.location.href=base_url+'select-user-address'; 
					}else{
						 $('#myLoginModal').modal('show');
					}
				}
	    	},'json');
	   	}

 	}

        $("#servicename").typeahead({
		    onSelect: function(item) {
		        itemvalue = item.value;
		       
		        $('#searchid').val(itemvalue);
		         $("#formbtn").removeAttr("disabled");
 		    },
		    ajax: {
		        url: base_url+"filter/byservicename",
		        timeout: 500,
		        displayField: "name",
		        triggerLength: 3,
		        method: "get",
		        loadingClass: "loading-circle",
		        preDispatch: function (query) {
		            return {
		            	name: query,
		            }
		        },
		        preProcess: function (data) {
		            if (data.success === false) {
		                return false;
		            }
		            return data; 
		        }
		    }
		});	
  </script>
<!-- select-location -->