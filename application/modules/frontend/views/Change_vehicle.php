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
<div class="container">
<div id="tbl_vehicle_head" class="table-responsive d-none">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Select Vehicle</th>
          <th>Brand</th>
          <th>Model</th>
          <th>Vehicle No</th>
        </tr>
      </thead>
      <tbody id="tbl_vehicle">
        
      </tbody>
    </table>
  </div>
<button type="button" class="btn btn-info" id="new-vehicle">New Vehicle</button>
<hr>
<div class="col-md-12 tabcontent login-form" id="Login">
    <div class="hideshowdiv">
        <form class="" id="frm_vehicle">
            <input type="hidden" name="vehical_id" id="vehical_id">            
            <h5 id="vehical_title">Add New Vehicle</h5>
            <div class="form-row pl-1">                
                <div class="form-group col-lg-5 col-md-5 col-sm-12 col-12">
                    <label for="exampleInputEmail1" class="sr-only">Search Brand</label>
                    <select class="form-control" name="search_brand" id="search_brand">
                        <option value="">Select Brand</option>
                        <?php foreach ($brands_data as $brand) { ?>
                            <option value="<?= $brand['id'] ?>" <?= (!empty($_SESSION['filterbrand'][0]) && $_SESSION['filterbrand'][0] == $brand['id']) ? "selected":"" ?>><?= $brand['name'] ?></option>
                        <?php } ?>
                    </select>
                    <div class="messageContainer"></div>
                </div>
                <div class="form-group col-lg-5 col-md-5 col-sm-12 col-12">
                    <label for="exampleInputEmail1" class="sr-only">Search Model</label>
                    <select class="form-control" name="search_model" id="search_model">
                        <option value="">Select Model</option>
                    </select>
                    <div class="messageContainer"></div>
                </div>
            </div>

            <div class="form-row pl-1">
                <div class="form-group col-lg-5 col-md-5 col-sm-12 col-12">
                    <!-- <label for="vehicle-no">Vehicle no.</label> -->
                    <input type="text" class="form-control vehicle__number" placeholder="Vehicle no" name="vehicle_no" id="vehicle_no">
                    <div class="messageContainer"></div>
                </div>

                <div class="form-group col-lg-5 col-md-5 col-sm-12 col-12">
                    <!-- <label for="total-kms">Total kms</label> -->
                    <input type="text" class="form-control total__kms" placeholder="Total kms" name="total_kms" id="total_kms">
                    <div class="messageContainer"></div>
                </div>
            </div>                
            <span id="vehicle-response-msg"></span>
            <div class="form-button">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function () {

    $(document).on("click", "#new-vehicle", function () {
        $("#vehical_id").val("");
        $("#vehicle_no").val("");
        $("#search_brand").val("");
        $("#search_model").val("");
        $("#total_kms").val("");
        $("#vehical_title").html("Add New Vehicle");
    });

    <?php if (!empty($_SESSION['filtermodel'][0])) { ?>
        getmodellist("<?= $_SESSION['filtermodel'][0]?>");
    <?php } ?>

    var userid = "<?= (isset($_SESSION['olouserid']))?$_SESSION['olouserid']:0; ?>";
    function load_tbl() {
        $.get(base_url+"getVehicleTBL", {userid: userid}, function (data) {
            if (data) {
                $("#tbl_vehicle_head").removeClass("d-none");
                $("#tbl_vehicle").html(data);
            }
        },"json");
    }

    load_tbl();

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
            'total_kms': {
                validators: {
                    notEmpty: {
                        message: 'Please Enter Total Kilometers'
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
                        load_tbl();
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

    $(document).on("click", "input[name=is_primary_vehicle]", function () {
    	var id = $(this).attr('id').split('-');
    	$.post(base_url+'set_isPrimary_vehicle', {userid:userid, vehicle_id:id[1]}, function (data) {
    		load_tbl();
    		alert("This vehicle selected for order!");
            $("#setvehicle").html(data.setvehicle);
            $("#order_vehicle").val(id[1]);
    	},"json");
    });
});

$(document).on("click", ".editvehicle", function () {
    var vehicleid = $(this).attr('id');
    $.post(base_url+"admin/vehicle/get_vehicles_by_id", {vehicle_id:vehicleid}, function (data) {
        document.getElementById("frm_vehicle").reset();
        $("#vehical_title").html("Edit Vehicle");
        $("#vehical_id").val(data.id);
        $("#search_brand").val(data.brand_id);
        getmodellist(data.model_id);
        $("#vehicle_no").val(data.vehicle_no);
        $("#total_kms").val(data.total_kms);
    }, "json");
});

$(document).on("click", ".deletevehicle", function () {
    var id = $(this).attr('id');
    $.post(base_url+'delete_vehical', {vehical_id:id}, function (data) {
        alert("Vehical deleted successfully");
        location.reload();
    },"json");
});

function getmodellist(selectedmodelid=null) {
    var brandid = $("#search_brand").val();
    $.get(base_url+"get-models-by-brandId", {brandId:brandid}, function (data) {
        var selectElem = $("#search_model");
        selectElem.html('<option value="">Select Model</option>');

        $.each(data, function(key, model){

            $option = $('<option value="' + model.id + '">' + model.name + '</option>');
            var slcted = "";
            if (selectedmodelid == model.id) {
                slcted = "selected";
                $option.attr('selected', 'selected');
            }
            selectElem.append($option);
        });
    }, "json");
}
</script>