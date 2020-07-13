<!-- Vehicles section -->
<section id="profile-login">
    <div class="d-flex align-items-center profile-title-img">
        <img src="<?php echo asset_url();?>frontend/images/profile-img.png" class="profile-img pr-2">
        <span class="profile-title">Profile</span>
    </div>
    <div class="all-user-history">
        <div class="row profile-section-row">
            <?php echo $sidebar_url; ?>
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
        </div>
    </div>
</section>

<script type="text/javascript">
$(document).ready(function() {
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
</script>