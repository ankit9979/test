+function ($) {

    $(function () {
       
            var site_url = "http://localhost/hair/";
       

        $('.tool_for_tip').delay(5000).fadeOut(400)

        $(".form,#save_time").validate({
        });
        $(".form2").validate({
        });
//        $('.time_add').clockpicker({donetext: 'Done', 'default': 'now',minDate: new Date(),});
//
        $('.time_add').bootstrapMaterialDatePicker({date: false, switchOnClick: true, format: 'HH:mm', minDate: new Date(), maxDate: new Date()}).on('change', function (e, date)
        {
            $('#save_time').submit();
        });
        $('.timepicker-24').timepicker({
            autoclose: true,
            minuteStep: 15, defaultTime: false,
            showSeconds: false,
            showMeridian: false, pickTime: false

        });




        $("#new_item_number").keyup(function () {
            var total = parseInt($('#new_item_number').val()) + parseInt($('#current_items_no').val());
            $('#total_items').val(total);
        });
        $("#clearance_stock").keyup(function () {
            var total = parseInt($('#current_items_no').val()) - parseInt($('#clearance_stock').val());
            $('#remained_stock').val(total);
        });
        $('.select2').select2();
        $('.dpd1').datepicker({format: 'dd-mm-yyyy'})
                .on('changeDate', function (ev) {
                    $('.dpd1').datepicker('hide');
                });
        $('.dpd2').datepicker({format: 'dd-mm-yyyy'})
                .on('changeDate', function (ev) {
                    $('.dpd2').datepicker('hide');
                });
        $('.dpd3').datepicker({format: 'dd-mm-yyyy'})
                .on('changeDate', function (ev) {
                    $('.dpd3').datepicker('hide');
                });
        $('.dpd4').datepicker({format: 'dd-mm-yyyy'})
                .on('changeDate', function (ev) {
                    $('.dpd4').datepicker('hide');
                });
        $(document).on('blur', 'input, textarea', function (e) {
            $(this).val() ? $(this).addClass('has-value') : $(this).removeClass('has-value');
        });

        $(".sale_category_id").change(function () {
            $.ajax({
                type: "GET",
                url: site_url + "sales/get_products/" + $(this).val(),
                async: true,
                cache: false,
                dataType: 'html',
                success: function (data) {

                    $("#sale_item_id").empty();
                    $('#sale_item_id').append(data);
                    $("#item_name").val('');
                    $("#item_size").val('');
                    $("#barcode_number").val('');
                    $("#item_desc").val('');
                    $("#item_price").val('');
                    $("#item_id").val('');

                }
            });


        });


//
//        $("body").on("click", "#add_more_item", function () {
//            $.ajax({
//                type: "GET",
//                url: site_url + "sales/add_item",
//                async: true,
//                cache: false,
//                dataType: 'html',
//                success: function (data) {
//                    $('.items').empty();
//                    $('.items').append(data);
//                    $('.select2').select2();
//                    $(".items #sale_category_id").change(function () {
//                        $.ajax({
//                            type: "GET",
//                            url: site_url + "sales/get_products/" + $(this).val(),
//                            async: true,
//                            cache: false,
//                            dataType: 'html',
//                            success: function (data) {
//
//                                $("#sale_item_id").empty();
//                                $('#sale_item_id').append(data);
//                                $("#item_name").val('');
//                                $("#item_size").val('');
//                                $("#barcode_number").val('');
//                                $("#item_desc").val('');
//                                $("#item_price").val('');
//                                $("#item_id").val('');
//
//                            }
//                        });
//
//
//                    });
//                    $("#sale_item_id").change(function () {
//
//
//                        $.ajax({
//                            type: "GET",
//                            url: site_url + "sales/get_product_info/" + $(this).val(),
//                            async: true,
//                            cache: false,
//                            dataType: 'json',
//                            success: function (data) {
//                                if ($.isEmptyObject(data)) {
//                                    $("#item_name").val('');
//                                    $("#item_size").val('');
//                                    $("#barcode_number").val('');
//                                    $("#item_desc").val('');
//                                    $("#item_price").val('');
//                                    $("#item_id").val('');
//
//                                } else {
//                                    $("#item_name").val(data[0].item_name);
//                                    $("#item_size").val(data[0].size);
//                                    $("#barcode_number").val(data[0].barcode_number);
//                                    $("#item_desc").val(data[0].item_desc);
//                                    $("#item_price").val(data[0].price);
//                                    $("#item_id").val(data[0].item_id);
//                                }
//
//
//                            }
//                        });
//                    });
//                }
//            });
//
//
//        });


        $("#sale_item_id").change(function () {


            $.ajax({
                type: "GET",
                url: site_url + "sales/get_product_info/" + $(this).val(),
                async: true,
                cache: false,
                dataType: 'json',
                success: function (data) {
                    if ($.isEmptyObject(data)) {
                        $("#item_name").val('');
                        $("#item_size").val('');
                        $("#barcode_number").val('');
                        $("#item_desc").val('');
                        $("#item_price").val('');
                        $("#item_id").val('');
                        $("#color_id").val('');

                    } else {
                        $("#item_name").val(data[0].item_name);
                        $("#item_size").val(data[0].size);
                        $("#barcode_number").val(data[0].barcode_number);
                        $("#item_desc").val(data[0].item_desc);
                        $("#item_price").val(data[0].price);
                        $("#item_id").val(data[0].item_id);
                        $("#color_id").val(data[0].color);
                    }


                }
            });
        });

        $("#sale_item_barcode").change(function () {
            $.ajax({
                type: "GET",
                url: site_url + "sales/sale_item_barcode/" + $(this).val(),
                async: true,
                cache: false,
                dataType: 'json',
                success: function (data) {
                    if ($.isEmptyObject(data)) {
                        $("#item_name").val('');
                        $("#item_size").val('');
                        $("#barcode_number").val('');
                        $("#item_desc").val('');
                        $("#item_price").val('');
                        $("#item_id").val('');
                    } else {
                        $("#item_name").val(data[0].item_name);
                        $("#item_size").val(data[0].size);
                        $("#barcode_number").val(data[0].barcode_number);
                        $("#item_desc").val(data[0].item_desc);
                        $("#item_price").val(data[0].price);
                        $("#item_id").val(data[0].item_id);
                    }
                }
            });
        });
        $("#item_discount_percentage").change(function () {
            var d_total = ($('#total_items_price').val() * $(this).val()) / 100;

            $('#item_discount_amount').val(d_total);
            var discount_total = $('#total_items_price').val() - d_total;
            var val_value;
            if ($("#remove_vat").is(':checked')) {
                val_value = 0;
            } else {
                val_value = 14;
            }
            var vat = ((val_value / 100) * discount_total);
            $('#vat').val(vat.toFixed(2));

            $('#total_price').val((parseFloat(vat) + discount_total).toFixed(2));

        });


        $("#item_discount_amount").change(function () {
            var d_total = ($(this).val() / $('#total_items_price').val()) * 100;
            $('#item_discount_percentage').val(d_total.toFixed(2));
            var discount_total = $('#total_items_price').val() - $(this).val();
            var val_value;
            if ($("#remove_vat").is(':checked')) {
                val_value = 0;
            } else {
                val_value = 14;
            }
            var vat = ((val_value / 100) * discount_total);
            $('#vat').val(vat.toFixed(2));
            $('#total_price').val((parseFloat(vat) + discount_total).toFixed(2));

        });
        if ($("#remove_vat").is(':checked') && ($('#total_items_price').val())) {
            var d_total = ($('#total_items_price').val() * $('#item_discount_percentage').val()) / 100;

            $('#item_discount_amount').val(d_total);
            var discount_total = $('#total_items_price').val() - d_total;

            var val_value;
            if ($("#remove_vat").is(':checked')) {
                val_value = 0;
            } else {
                val_value = 14;
            }

            var vat = ((val_value / 100) * discount_total);
            $('#vat').val(vat.toFixed(2));

            $('#total_price').val((parseFloat(vat) + discount_total).toFixed(2));
        }



        $('#remove_vat').change(function () {
            var d_total = ($('#total_items_price').val() * $('#item_discount_percentage').val()) / 100;

            $('#item_discount_amount').val(d_total);
            var discount_total = $('#total_items_price').val() - d_total;

            var val_value;
            if ($("#remove_vat").is(':checked')) {
                val_value = 0;
            } else {
                val_value = 14;
            }

            var vat = ((val_value / 100) * discount_total);
            $('#vat').val(vat.toFixed(2));

            $('#total_price').val((parseFloat(vat) + discount_total).toFixed(2));

        });

        $("#amount_paid").change(function () {
            var total = $(this).val() - $('#total_price').val();
            if (total < 0) {
                var final_change = 0;
                var remained_price = $('#total_price').val() - $(this).val();

            } else {
                var final_change = total;
                var remained_price = 0;
            }
            $('#remained_price').val(remained_price.toFixed(2));
            $('#change').val(final_change.toFixed(2));
        });

        $("#sale_id").change(function () {
            $.ajax({
                type: "GET",
                url: site_url + "sales/sale_item_info/" + $(this).val(),
                async: true,
                cache: false,
                dataType: 'html',
                success: function (data) {
                    $("#items").empty();
                    $("#items").append(data);



                }
            });
        });
        $("#amount_paid_settle_layby").change(function () {
            var total = $(this).val() - $('#remained_amount').val();
            if (total < 0) {
                var final_change = 0;
            } else {
                var final_change = total;
            }
            $('#change').val(final_change);
        });

        $("#commission_percentage").change(function () {
            var d_total = ($('#item_price').val() * $(this).val()) / 100;
            $('#commission_amount').val(d_total);




        });
        $("#commission_amount").change(function () {
            var d_total = ($(this).val() / $('#item_price').val()) * 100;
            $('#commission_percentage').val(d_total);

        });
        $(".employee_id").change(function () {
            $('#employee_id').submit()

        });

    });
}(jQuery);
