
<script>
    $.getScript("<?php echo asset_url(); ?>js/bootstrap-typeahead.min.js");
    
                             $(function(){   $("#itemname-1").typeahead({
                                    onSelect: function (item) {
                                        var itemid12 = $('#inputrateid').val();
                                        //alert(itemid12);
                                        if (itemid12 == '')
                                        {
                                            itemid12 = 0;
                                        }
                                        itemvalue = item.value;

//                                        $.get(base_url + "admin/item/detail/" + itemvalue + "/" + a + "/" + b + "/" + c + "/" + d + "/" + e, {}, function (result) {
//                                            $("#price-1").val(result.price);
//                                            $("#pricelbl-1").val("Rs. " + result.price);
//                                            $("#itemtax-1").val(result.tax);
//                                            $("#itemid-1").val(item.value);
//
//                                        }, 'json');
                                    },
                                    ajax: {
                                        url: <?= $_POST['url']?>,
                                        timeout: 500,
                                        displayField: "name",
                                        triggerLength: 1,
                                        method: "get",
                                        loadingClass: "loading-circle",
                                        preDispatch: function (query) {
                                            
                                        },
                                        preProcess: function (data) {
                                            if (data.success === false) {
                                                return false;
                                            }
                                            return data;
                                        }
                                    }
                                });
                                });
    </script>