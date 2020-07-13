<!-- Addresses Section -->
<section id="profile-login">
    <div class="d-flex align-items-center profile-title-img">
        <img src="<?php echo asset_url();?>frontend/images/profile-img.png" class="profile-img pr-2">
        <span class="profile-title">Profile</span>
    </div>
    <div class="all-user-history">
        <div class="row profile-section-row">
            <?php echo $sidebar_url; ?>
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
        </div>
    </div>
</section>
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

$(document).ready( function(){
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

    $("#btnaddress").on("click", function () {
        $("#address_title").html("Add New Address");
        $("#address_id").val('');
        document.getElementById("frm_address").reset();
        $("#address_div").show();
    });
});
</script>