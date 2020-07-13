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
<div id="tbl_address_head" class="table-responsive d-none">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="width: 7%;">#</th>
          <th>Is Primary?</th>
          <th>Address Type</th>
          <th>Address</th>
          <th>Locality</th>
          <th>Landmark</th>
          <th>State</th>
          <th>City</th>
          <th>Pincode</th>
        </tr>
      </thead>
      <tbody id="tbl_address">
        
      </tbody>
    </table>
  </div>
<button type="button" class="btn btn-info" id="new">New Address</button>

<div class="col-sm-12 tabcontent login-form" id="Login">
    <div class="hideshowdiv" style="display: none;">
        <form class="profile-login-form" id="frm_address">
        	<input type="hidden" name="address_id" id="address_id">
            <div class="form-row form-group-padding">
                <div class="form-group col-md-6 col-sm-12">
                    <label for="address_type">Address Type</label>
                    <select class="form-control" name="address_type" id="address_type">
                        <option value="">Select</option>
                        <option value="1">Home Address</option>
                        <option value="2">Office Address</option>
                        <option value="3">Other</option>
                    </select>
                    <div class="messageContainer"></div>
                </div>

                <div class="form-group col-md-6 col-sm-12">                                     
                    <label for="locality">Locality</label>
                    <input type="text" class="form-control search-input py-2" placeholder="Enter Locality" name="locality" id="locality" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                    <input type="hidden" name="latitude" id="lat">
                    <input type="hidden" name="longitude" id="long">
                    <div class="messageContainer"></div>
                </div>
            </div>

            <div class="form-row form-group-padding">
                <div class="form-group col-md-6 col-sm-12">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address">
                    <div class="messageContainer"></div>
                </div>

                <div class="form-group col-md-6 col-sm-12">
                    <label for="landmark">Landmark</label>
                    <input type="text" class="form-control" name="landmark" id="landmark" placeholder="Enter Landmark">
                    <div class="messageContainer"></div>
                </div>
            </div>

            <div class="form-row form-group-padding">
                <div class="form-group col-md-6 col-sm-12">
                    <input type="hidden" id="selected_stateid">
                    <label for="state">State</label>
                    <select class="form-control" name="state" id="state">
                        <option value="">Select</option>
                    </select>
                    <div class="messageContainer"></div>
                </div>

                <div class="form-group col-md-6 col-sm-12">
                    <input type="hidden" id="selectedcity">
                    <label for="city">city</label>
                    <select class="form-control" name="city" id="city">
                        <option value="">Select</option>
                    </select>
                    <div class="messageContainer"></div>
                </div>
            </div>

            <div class="form-row form-group-padding">
                <div class="form-group col-md-6 col-sm-12">
                    <label for="pincode">Pincode</label>
                    <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Enter Pincode" maxlength="6">
                    <div class="messageContainer"></div>
                </div>
            </div>
            <div>
            	<span id="response-msg"></span>
            </div>
            <div class="pt-3 update-button">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</div>
</div>

<script type="text/javascript">
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
    });
}

$(document).ready(function () {

	$(document).on("click", "#new", function () {
		$("#address_id").val("");
        document.getElementById("frm_address").reset();
		$('.hideshowdiv').show();
	});

    var userid = "<?= (isset($_SESSION['olouserid']))?$_SESSION['olouserid']:0; ?>";
    function load_tbl() {
        $.get(base_url+"getAddressTBL", {userid: userid}, function (data) {
            if (data != "") {
                $("#tbl_address_head").removeClass("d-none");
                $("#tbl_address").html(data);                
            }
        },"json");
    }

    load_tbl();
    get_states();

    $(document).on('click', '.edit', function() {
    	$('.hideshowdiv').show();
        var addr_id = $(this).attr('id');
        $.post(base_url+"edit-address", {userid: userid, address_id: addr_id}, function (data) {
            $("#address_type").val(data[0].address_name);
            $("#locality").val(data[0].locality);
            $("#lat").val(data[0].latitude);
            $("#long").val(data[0].longitude);
            $("#address").val(data[0].address);
            $("#landmark").val(data[0].landmark);
            $("#pincode").val(data[0].pincode);
            $("#is_primary").val(data[0].is_primary);
            $("#state").val(data[0].state);
            $("#address_id").val(addr_id);
            get_cities(data[0].city);
            $("#response-msg").html("");
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

$('#frm_address').bootstrapValidator({
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
		$("#response-msg").hide();
		var formData = new FormData($('#frm_address')[0]);
        ajaxindicatorstart('please wait');
        $.ajax({ url: base_url + 'address_submit', data: formData, type: 'POST', dataType: 'JSON', processData: false, contentType: false, success: function (response) { 
            ajaxindicatorstop();
                load_tbl();
                $("#response-msg").show();
                if (response.result == 1) {
                	$("#address_id").val("");
                	document.getElementById("frm_address").reset();
                    $("#response-msg").css('color','green');
                    $("#response-msg").html(response.msg);
                } else {
                    $("#response-msg").css('color','red');
                    $("#response-msg").html("Error, Something went wrong!");
                }
            }
        });
    return false;
});

$(document).on("click", "input[name=is_primary]", function () {
	var id = $(this).attr('id').split('-');
	$.post(base_url+'set_isPrimary_address', {userid:userid, address_id:id[1]}, function (data) {
		load_tbl();
		alert("Primary address saved successfully");
        $("#setaddress").html(data.setaddress);
        $("#order_address").val(id[1]);
	},"json");
});

$(document).on("click", ".delete", function () {
	var id = $(this).attr('id');
	$.post(base_url+'delete-address', {address_id:id}, function (data) {
		load_tbl();
		alert("Address deleted successfully");
        location.reload();
	},"json");
});

});
</script>