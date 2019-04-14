$(document).ready(function () {

    function clearconsole() {
        console.log(window.console);
        if (window.console || window.console.firebug) {
            console.clear();
        }
    }
    clearconsole();


    $('.time_add').bootstrapMaterialDatePicker({date: false, switchOnClick: true, format: 'HH:mm', minDate: new Date(), maxDate: new Date()}).on('change', function (e, date)
    {
        $('.save_time').submit();
    });
    $('.dpd1').datepicker({format: 'dd-mm-yyyy'});
    $('.dpd2').datepicker({format: 'dd-mm-yyyy'});
//    function clearconsole() {
//        console.log(window.console);
//        if (window.console || window.console.firebug) {
//            console.clear();
//        }
//    }


if ("http://localhost" == window.location.origin) {
    var site_url = "http://localhost/tpt/";
} else if ("http://turningpointtutors.co.za" == window.location.origin)
{
    var site_url = window.location.origin + "/test/";
} else {
  var site_url = window.location.origin + "/";


}



var url = window.location.href.split('/');
if ((url[url.length - 2] == "tutor") && (url[url.length - 1] == "dashboard")) {
    var hidden_session = $('#hidden_sesion').val();
    if (hidden_session > 0) {
        $('#studentcontactedmsg').modal({backdrop: 'static'});
        $('#studentcontactedmsg').on('hidden.bs.modal', function () {
                // window.location.reload(true);
            });
    }


}

var url = window.location.href.split('/');
if ((url[url.length - 2] == "student") && (url[url.length - 1] == "dashboard")) {
    var hidden_session = $('#hidden_sesion').val();
    if (hidden_session > 0) {
        $('#studentcontactedmsg').modal({backdrop: 'static'});
        $('#studentcontactedmsg').on('hidden.bs.modal', function () {
                // window.location.reload(true);
            });
    }


}
//sales
$("#sale_item_id").change(function () {


    $.ajax({
        type: "GET",
        url: site_url + "admin/get_product_info/" + $(this).val(),
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

$("#check_all").click(function () {
    $(".check_data").prop('checked', $(this).prop('checked'));
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
    if ($('#amount_paid').val() < $('#total_price').val()) {
        alert('Amount is less than cost.');
        $('#amount_paid').val('');
    } else {
        var total = $(this).val() - $('#total_price').val();
        if (total < 0) {
            var final_change = 0;
        } else {
            var final_change = total;
        }
        $('#change').val(final_change.toFixed(2));
    }
});



//code for live search


$("#live_search").keyup(function () {
    _this = this;
        // alert('dd');
        // Show only matching TR, hide rest of them
        $.each($("table tbody").find("tr"), function () {
            console.log($(this).text());
            if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) == -1)
                $(this).hide();
            else
                $(this).show();
        });
    });
    //   $('#live_search').on('input', function() {
    //       var searchKeyword = $(this).val();

//        if (searchKeyword.length >= 2) {
//
//            $.ajax({
//                type: "Post",
//                url: site_url + "student/live_course_serach",
//                data: {
//                    keywords: searchKeyword
//                },
//                dataType: 'html',
//                async: true,
//                cache: false,
//                success: function(data) {
//                    //alert(data);
//                    $(".live_course_value").html(data);
//
//                }
//            });
//        } else {
//
//            $.ajax({
//                type: "Post",
//                url: site_url + "student/live_course_serach",
//                data: {
//                    keywords: searchKeyword
//                },
//                dataType: 'html',
//                async: true,
//                cache: false,
//                success: function(data) {
//                    //alert(data);
//                    $(".live_course_value").html(data);
//
//                }
//            });
//
//        }
    //   });

    $(".table-responsive").on('click', '.edit_text_b_user', function () {

        $.ajax({
            type: "Post",
            url: site_url + "admin/get_textbook_user",
            data: {
                log_id: $(this).attr('itemid')

            }, async: true,
            cache: false,
            dataType: 'json',
            success: function (data) {

                $("#t1").val(data[0].tutor_name);
                $("#t2").val(data[0].tutor_surname);
                $("#t3").val(data[0].c_date);
                $("#t4").val(data[0].r_date);
                $("#t5").val(data[0].textbooks_users_id);
                $('#myModal4d').modal();
            }
        });

    });
    $(".table-responsive").on('click', '.edit_electronics_b_user', function () {

        $.ajax({
            type: "Post",
            url: site_url + "admin/get_electronics_user",
            data: {
                log_id: $(this).attr('itemid')

            }, async: true,
            cache: false,
            dataType: 'json',
            success: function (data) {

                $("#t1").val(data[0].tutor_name);
                $("#t2").val(data[0].tutor_surname);
                $("#t3").val(data[0].c_date);
                $("#t4").val(data[0].r_date);
                $("#t5").val(data[0].ele_users_id);
                $('#myModal_ele_edit').modal();
            }
        });

    });
    $('div').on('click', '#open_modald', function (e) {
        $('#myModal4').modal();
    });

    $('.table-responsive').on('click', '.avi_or_not', function (e) {
        $('#avi_or_not').val($(this).attr('id'));
    });
    $('.table-responsive').on('click', '.avi_ele_not', function (e) {
        $('#avi_ele_not').val($(this).attr('id'));
    });

    $(".live_course_value").on('click', '.get_course_id_b_admin', function () {

        var someObj = {};

        someObj.courseIdGet = [];
        someObj.sessionIdGet = [];
        someObj.courseItemId = [];

        if ($(this).attr("itemid") != 0 && $(this).is(":checked")) {

            var my_id = $(this).attr("itemid");
            var my_vvvvid = $(this).attr("id");


            $(".get_course_id_b_admin").each(function () {
                if ($(this).is(":checked")) {

                    someObj.courseItemId.push($(this).attr("itemid"));
                }
            });
            $.ajax({
                type: "Post",
                url: site_url + "admin/get_cc_id",
                data: {
                    course_all_id: someObj.courseItemId,
                    course_id: my_id,
                },
                async: true,
                cache: false,
                dataType: 'html',
                success: function (data) {
                    if (data == 1) {

                        $('#' + my_vvvvid).prop('checked', false);
                        alert('Whoops, you seem to have registered twice for the same course. Note that you are only allowed to register once for each course.')
                        return false;
                    }

                }
            });


        }

        setTimeout(function () {
            $(".get_course_id_b_admin").each(function () {
                if ($(this).is(":checked")) {
                    someObj.courseIdGet.push($(this).attr("id"));
                    someObj.sessionIdGet.push($(this).val());
                }
            });



            if (someObj.courseIdGet.length > 0) {
                $('.hide_if_none').show();
            } else {
                $('.hide_if_none').hide();
            }
//


Number.prototype.formatMoney = function (c, d, t) {
    var n = this,
    c = isNaN(c = Math.abs(c)) ? 2 : c,
    d = d == undefined ? "." : d,
    t = t == undefined ? "," : t,
    s = n < 0 ? "-" : "",
    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
    j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

$.ajax({
    type: "Post",
    url: site_url + "admin/get_course_detail",
    data: {
        course_id: someObj.courseIdGet,
        session_id: someObj.sessionIdGet
    },
    async: true,
    cache: false,
    success: function (data) {

        $("#fill_data").html(data);
                    // $("#fill_data_2").html(data);
                    var sum = 0;
                    $('.amount_no').each(function () {
                        sum += parseFloat($(this).text());  //Or this.innerHTML, this.innerText
                    });

                    $("#total").html((sum).formatMoney(2));
                    // $("#total_2").html((sum).formatMoney(2));
                    $("#total_pay").val(sum);
                }
            });
}, 1500);


    });
    $(".live_course_value").on('click', '.get_course_id_b', function () {

        var someObj = {};
        someObj.courseIdGet = [];
        someObj.sessionIdGet = [];
        someObj.courseItemId = [];

        if ($(this).attr("itemid") != 0 && $(this).is(":checked")) {

            var my_id = $(this).attr("itemid");
            var my_vvvvid = $(this).attr("id");


            $(".get_course_id_b").each(function () {
                if ($(this).is(":checked")) {

                    someObj.courseItemId.push($(this).attr("itemid"));
                }
            });
            $.ajax({
                type: "Post",
                url: site_url + "student/get_cc_id",
                data: {
                    course_all_id: someObj.courseItemId,
                    course_id: my_id,
                },
                async: true,
                cache: false,
                dataType: 'html',
                success: function (data) {
                    if (data == 1) {

                        $('#' + my_vvvvid).prop('checked', false);
                        alert('Whoops, you seem to have registered twice for the same course. Note that you are only allowed to register once for each course.')
                        return false;
                    }

                }
            });


        }


        setTimeout(function () {
            $(".get_course_id_b").each(function () {
                if ($(this).is(":checked")) {
                    someObj.courseIdGet.push($(this).attr("id"));
                    someObj.sessionIdGet.push($(this).val());
                }
            });
            if (someObj.courseIdGet.length > 0) {
                $('.hide_if_none').show();
            } else {
                $('.hide_if_none').hide();
            }
//



Number.prototype.formatMoney = function (c, d, t) {
    var n = this,
    c = isNaN(c = Math.abs(c)) ? 2 : c,
    d = d == undefined ? "." : d,
    t = t == undefined ? "," : t,
    s = n < 0 ? "-" : "",
    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
    j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

$.ajax({
    type: "Post",
    url: site_url + "/student/get_course_detail",
    data: {
        course_id: someObj.courseIdGet,
        session_id: someObj.sessionIdGet
    }, async: true,
    cache: false,
    success: function (data) {

        $("#fill_data").html(data);
                    // $("#fill_data_2").html(data);
                    var sum = 0;
                    $('.amount_no').each(function () {
                        sum += parseFloat($(this).text());  //Or this.innerHTML, this.innerText
                    });

                    $("#total").html((sum).formatMoney(2));
                    // $("#total_2").html((sum).formatMoney(2));
                    $("#total_pay").val(sum);
                }
            });
}, 1500);
    });
//    $('.get_course_id_b').click(function() {
//        var someObj = {};
//        someObj.courseIdGet = [];
//        someObj.sessionIdGet = [];
//
//        $(".get_course_id_b").each(function() {
//            if ($(this).is(":checked")) {
//                someObj.courseIdGet.push($(this).attr("id"));
//                someObj.sessionIdGet.push($(this).val());
//            }
//        });
//        if (someObj.courseIdGet.length > 0) {
//            $('.hide_if_none').show();
//        } else {
//            $('.hide_if_none').hide();
//        }
////
//
//        Number.prototype.formatMoney = function(c, d, t) {
//            var n = this,
//                    c = isNaN(c = Math.abs(c)) ? 2 : c,
//                    d = d == undefined ? "." : d,
//                    t = t == undefined ? "," : t,
//                    s = n < 0 ? "-" : "",
//                    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
//                    j = (j = i.length) > 3 ? j % 3 : 0;
//            return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
//        };
//
//        $.ajax({
//            type: "Post",
//            url: "get_course_detail",
//            data: {
//                course_id: someObj.courseIdGet,
//                session_id: someObj.sessionIdGet
//            }, async: true,
//            cache: false,
//            success: function(data) {
//
//                $("#fill_data").html(data);
//                var sum = 0;
//                $('.amount_no').each(function() {
//                    sum += parseFloat($(this).text());  //Or this.innerHTML, this.innerText
//                });
//
//                $("#total").html((sum).formatMoney(2));
//                $("#total_pay").val(sum);
//            }
//        });
//    });
// code for file upload progress



$('.up_file').submit(function (e) {
    if ($('#signupForm').valid())
    {
        if ($('#no_val3').val()) {
            e.preventDefault();
                // $('#loader-icon').show();
                $(this).ajaxSubmit({
                    target: '#targetLayer',
                    beforeSubmit: function () {
                        $("#progress-bar").width('0%');
                    },
                    uploadProgress: function (event, position, total, percentComplete) {
                        $("#progress-bar").width(percentComplete + '%');
                        $("#progress-bar").html('<div id="progress-status">' + percentComplete + ' %</div>')
                    },
                    success: function (data) {
                        //alert(data);
                        if (data == "error") {
                            window.location.href = site_url + "/tutor_redirect_error";
                        } else {
                            window.location.href = site_url + "/tutor_redirect";
                        }

                        // $('#loader-icon').hide();
                    },
                    //resetForm: true
                });
                return false;
            }
        }
    });
$('.uploadForm').submit(function (e) {

    if ($('#no_val').val()) {
        e.preventDefault();
            // $('#loader-icon').show();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $("#progress-bar").width('0%');
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    $("#progress-bar").width(percentComplete + '%');
                    $("#progress-bar").html('<div id="progress-status">' + percentComplete + ' %</div>')
                },
                success: function () {
                    // $('#loader-icon').hide();
                },
                resetForm: true
            });
            return false;
        }

        if ($('#no_val1').val() && $('#sele_cls_d').val() != "") {
            e.preventDefault();
            //$('#loader-icon').show();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $("#progress-bar").width('0%');
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    $("#progress-bar").width(percentComplete + '%');
                    $("#progress-bar").html('<div id="progress-status">' + percentComplete + ' %</div>')
                },
                success: function () {
                    // $('#loader-icon').hide();
                },
                resetForm: true
            });
            return false;
        }

        if ($('#no_val2').val() && $('#sele_cls_d').val() != "") {
            e.preventDefault();
            //$('#loader-icon').show();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $("#progress-bar").width('0%');
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    $("#progress-bar").width(percentComplete + '%');
                    $("#progress-bar").html('<div id="progress-status">' + percentComplete + ' %</div>')
                },
                success: function () {
                    // $('#loader-icon').hide();
                },
                resetForm: true
            });
            return false;
        }
        if ($('#no_val3').val() && $('#sele_cls_d').val() != "") {
            e.preventDefault();
            //$('#loader-icon').show();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $("#progress-bar").width('0%');
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    $("#progress-bar").width(percentComplete + '%');
                    $("#progress-bar").html('<div id="progress-status">' + percentComplete + ' %</div>')
                },
                success: function () {
                    // $('#loader-icon').hide();
                },
                resetForm: true
            });
            return false;
        }







    });
// code end for file upload progress
$(".phon_val").keyup(function () {
    var num = $(this).val();
    var arr = num.split('');
    if (arr[0] != 0) {
        alert('Please Enter Phone no (Ex:0793859264)');
        $(this).val('');
    }


});

$('#hidden-table-info_8').dataTable({
    "aaSorting": [[4, "desc"]]
});
$('#hidden-table-info_0').dataTable({
});

$("#course_id").change(function () {
    $(".course_remove").submit();
});
$("#change_vanuee").change(function () {
    $(".change_vanuee").submit();
});
$("#package_id").change(function () {
    $(".package").submit();
});
$("#save_d").change(function () {
    $(".save_d").submit();
});


$("#get_uni_id_edit").change(function () {
    $(".get_uni_id_edit").submit();
});
$("#get_pack_in").change(function () {
    $(".get_pack_in").submit();
});


$("#session_id").change(function () {
    $(".course_remove").submit();
});
$("#course_id_nnn").change(function () {
    $(".course_id_nnn").submit();
});

$("#c_c_id").change(function () {
    if ($(this).val() != "k") {
        $(".c_c_id").submit();
    } else {

    }
});
$("#select_ac_for_date").change(function () {

    $(".select_ac_for_date").submit();

});

$(".submit_data").change(function () {

    $(".submit_data").submit();

});



$("#select_p_id").change(function () {

    $(".select_p_id").submit();

});

$("#program_date").change(function () {

    $(".program_date").submit();

});



$(".g_uni").change(function () {

    $.ajax({
        type: "Post",
        url: site_url + "tutor/get_spe_subject",
        data: {
            g_uni: $(this).val()

        },
        async: true,
        cache: false,
        success: function (data) {

            $(".put_subject").html(data);
                // clearconsole();
            }
        });


});

$(".sel_sub").change(function () {
    var d = '#dev' + $(this).attr('id');
    $.ajax({
        type: "Post",
        url: site_url + "admin/get_user_by_university",
        data: {
            subject_id: $(this).val()

        },
        async: true,
        cache: false,
        success: function (data) {

            $(d).html(data);

        }
    });

});

$("#selct_unni").change(function () {

    $.ajax({
        type: "Post",
        url: site_url + "admin/get_user_by_uni",
        data: {
            session_id: $('#selct_unni').val()

        }, async: true,
        cache: false,
        success: function (data) {
            $(".det").html(data);

        }
    });

});

$("#checked_values_course").click(function () {
    if (this.checked) {
        $('.checked_values_course').show();
    } else {
        $('.checked_values_course').hide();
    }

});
$("#selct_unni").change(function () {

});
$("#co_reg_yes").click(function () {

    $('.co_reg_form').submit();
    $("#co_reg_yes").hide();
    $(".black_hover").hide();
    $(".please_wait").show();
        //$(".co_reg_form").submit();
    });

$('.timepicker-24').timepicker({
    autoclose: true,
    minuteStep: 1, defaultTime: false,
    showSeconds: false,
    showMeridian: false, pickTime: false

});


$(document).ready(function () {
        $('#check_data').click(function (event) {  //on click
            if (this.checked) { // check select status
                $('.check_data').each(function () { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "checkbox1"              
                });
            } else {
                $('.check_data').each(function () { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "checkbox1"                      
                });
            }
        });

    });  


$("#terms_condi").click(function () {
    if (this.checked) {
        $('#pck_reg_yes').prop("disabled", false);
    } else {
        $('#pck_reg_yes').prop("disabled", true);
    }

});



$("#pck_reg_yes").click(function () {
    $("form").submit();
    $("#pck_reg_yes").hide();
    $(".black_hover").hide();
    $(".please_wait").show();
});
$(".clk_dis1").click(function () {
    $('#commentForm11111').submit(function () {
        if ($(this).valid()) {
            $(".clk_dis1").hide();
            $(".black_hover").hide();
            $(".please_wait").show();
        }
    });
});

$(".update_course_hour").click(function () {
    $('#update_course_hour').validate();
    $('#update_course_hour').submit(function () {
        if ($(this).valid()) {
            $(".update_course_hour").hide();
            $(".black_hover").hide();
            $(".please_wait").show();
        }
    });
});
$(".update_c").click(function () {
    $('#update_c').validate();
    $('#update_c').submit(function () {
        if ($(this).valid()) {
            $(".update_c").hide();
            $(".black_hover").hide();
            $(".please_wait").show();
        }
    });
});

$(".add_c_s").click(function () {
    $('#add_c_s').validate();
    $('#add_c_s').submit(function () {
        if ($(this).valid()) {
            $(".add_c_s").hide();
            $(".black_hover").hide();
            $(".please_wait").show();
        }
    });
});


$(".add_course_hour").click(function () {
    $('#add_course_hour').validate();
    $('#add_course_hour').submit(function () {
        if ($(this).valid()) {
            $(".add_course_hour").hide();
            $(".black_hover").hide();
            $(".please_wait").show();
        }
    });
});




$('#commentForm1111').validate();

$(".clk_dis2").click(function () {
    $('#commentForm2').submit(function () {
        if ($(this).valid()) {
            $(".clk_dis2").hide();
                // $(".black_hover").hide();
                $(".please_wait").show();
            }
        });
});


$(".commentForm1").click(function () {
    $('#commentForm1').submit(function () {
        if ($(this).valid()) {
            $(".commentForm1").hide();

            $(".wait_pl").show();
        }
    });
});

$(".clk_dis_remove_course").click(function () {
    $('#course_remove').submit();
    $(".clk_dis_remove_course").hide();
    $(".black_hover").hide();
    $(".please_wait").show();
});

$("#remove_full_course").click(function () {
    $('#myModa12l88').modal({backdrop: 'static'});
});

    //for confirmation of course reg
    $("#beofre_course_reg").click(function () {
        //alert($('.remove_leour').html());
        $('.s_h_data').html($('.remove_leour').html())
        //  s_h_data
        $('#myModa12l_pp').modal({backdrop: 'static'});
    });

    $('#myModa12l_pp').on('hidden.bs.modal', function () {
        $('.s_h_data').empty();
    });

    $("#co_reg_no").click(function () {
        window.location.href = site_url + "student/course_register";
    });
    $("#co_reg_no_admin").click(function () {
        window.location.href = site_url + "admin/course_register_student";
    });
    //for confirmation of course reg end

    $("#university").click(function () {
        $('#show_hide_div').show();
    });
    $("#university").click(function () {
        $('#show_hide_div_sh').hide();
        $('#show_hide_div').show();
    });


    $("#high_school").click(function () {
        $('#show_hide_div').hide();
        $('#show_hide_div_sh').show();
    });
    $('.get_id').click(function (e) {
        $('#user_id').val($(this).attr('id'));
    });
    $('.contacted_student').click(function (e) {
        $('#contacted_student').val($(this).attr('id'));
    });
    $('.remove_onecourse').click(function (e) {
        $('#remove_onecourse').val($(this).attr('id'));
    });

    $('.get_this_tutor_id').click(function (e) {
        $('#get_this_tutor_id').val($(this).attr('id'));
    });





    $('.update_class_hour').click(function (e) {

        $.ajax({
            type: "Post",
            url: site_url + "admin/get_log_hour_course",
            data: {
                log_id: $(this).attr('id')

            }, async: true,
            cache: false,
            dataType: 'json',
            success: function (data) {

                $("#tutor_courses_logs_id").val(data[0].tutor_courses_logs_id);
                $("#up_tutor_id").val(data[0].tutor_id);
                $("#up_hour_presenter").val(data[0].hour_presenter);
                $("#up_hour_assiter").val(data[0].hour_assiter);
                $("#up_day").val(data[0].day);
                $("#up_date").val(data[0].date);


            }
        });
        // $('#hid_val').val($(this).attr('id'));
    });
    $('.get_this_update').click(function (e) {

        $.ajax({
            type: "Post",
            url: site_url + "admin/get_bonus_tutor",
            data: {
                course_time_id: $(this).attr('id')

            }, async: true,
            cache: false,
            dataType: 'json',
            success: function (data) {

                $("#rate_id").val(data[0].tutor_add_rate_id);
                $("#tutor_id").val(data[0].tutor_id);
                $("#notes_pay").val(data[0].notes_pay);
                $("#bonus_pay").val(data[0].bonus_pay);
            }
        });
        $('#hid_val').val($(this).attr('id'));
    });
    $('.hid_vla').click(function (e) {
        $.ajax({
            type: "Post",
            url: site_url + "get_course_time",
            data: {
                course_time_id: $(this).attr('id')

            }, async: true,
            cache: false,
            dataType: 'json',
            success: function (data) {
                $("#d1").val(data[0].course_start_date);
                $("#d2").val(data[0].start_time);
                $("#d3").val(data[0].end_time);
                $("#d4").val(data[0].additional_time);
            }
        });
        $('#hid_val').val($(this).attr('id'));
    });


//session validation code start
$('.app_reject_admin').click(function (e) {
    $('.show_hidd').empty();
    $.ajax({
        type: "Post",
        url: site_url + "admin/valid_session_data",
        data: {
            student_package_id: $(this).attr('id')

        }, async: true,
        cache: false,
        dataType: 'html',
        success: function (data) {
                // alert(data);
                $('.show_hidd').html(data);
            }
        });
    $('#myApp_Reject').modal({backdrop: 'static'});
});
// code for update university
$('.update_uni').click(function (e) {
    $('.show_hidd').empty();
    $.ajax({
        type: "Post",
        url: site_url + "admin/update_university",
        data: {
            subject_id: $(this).attr('id')

        }, async: true,
        cache: false,
        dataType: 'html',
        success: function (data) {
            $('.show_hidd').html(data);
        }
    });
    $('#myApp_Reject').modal({backdrop: 'static'});
});


//code for update subject


$('.select2').select2();
$('.subject_update_id').click(function (e) {
    $('.show_hidd').empty();  
    $('#sub_update').modal({backdrop: 'static'});  
    $.ajax({
        type: "Post",
        url: site_url + "admin/get_university",
        data: {
            id: $(this).attr('id')

        }, async: true,
        cache: false,
        dataType: 'html',
        success: function (data) {
           $('.show_hidd').html(data);
           $('.search_select_box').select2();
           
       }
   });


});


$('.subject_add_id').click(function (e) {
    $('#sub_add').modal({backdrop: 'static'});
});
$('.table-responsive').on('click', '.master_package_id', function (e) {
    $('#master_package_id').val($(this).attr('id'));
});


$('.table-responsive').on('click', '.rate_id', function (e) {
    $('#rate_id').val($(this).attr('id'));
});

$('.show_hidd').on('click', '.app_rejeject', function (e) {
    var sh = $(this).attr('id');

    $('#sh_' + sh).show();
});

$('.show_hidd').on('click', '.app_approve_r', function (e) {
    ;
    $('#sh_' + $(this).attr('id')).hide();
});
//session validation code end


$('.get_doc_id_').click(function (e) {
    $('#get_doc_id_').val($(this).attr('id'));
});
$('.tutor_assign_id').click(function (e) {
    $('#tutor_assign_id').val($(this).attr('id'));
});
$('.get_private_id').click(function (e) {
    $('#tutor_id').val($(this).attr('id'));
});
$('#hidden-table-info_8').on('click', '.get_reg_id', function (e) {
    jQuery('#reg_id').val($(this).attr('id'));
});
$('#hidden-table-info_8').on('click', '.employee_app_id', function (e) {
    jQuery('#employee_app_id').val($(this).attr('id'));
});
$('#hidden-table-info').on('click', '.get_course_id_pay', function (e) {

    $('#course_amt').val($(this).attr("itemid"));
    $('#get_course_id_pay').val($(this).attr('id'));
});

$('#hidden-table-info_8').on('click', '.remove_full_cont', function (e) {
    $('#remove_full_cont').val($(this).attr('id'));
});



$('#hidden-table-info').on('click', '.get_std_id_app', function (e) {
    $('#get_std_id_app').val($(this).attr('id'));
});


$('#hidden-table-info_8').on('click', '.get_std_id_pay', function (e) {

    $('#get_std_id_pay').val($(this).attr('id'));
    $('#de_amt_pay').val($(this).attr("itemid"));
    $.ajax({
        type: "Post",
        url: site_url + "admin/student_package_de/" + $(this).attr('id'),
        async: true,
        cache: false,
        success: function (data) {

            $("#student_id").html(data);


        }
    });

});

$('#editor').wysihtml5();

$("#get_date_range").change(function () {
    $.ajax({
        type: "Post",
        url: site_url + "/admin/get_date_range",
        dataType: 'html',
        data: {
            course_id: this.value

        },
        async: true,
        cache: false,
        success: function (data) {

            $(".date_dareh").html(data);


        }
    });

});
$("#select_uni_co_id").change(function () {
    $.ajax({
        type: "Post",
        url: site_url + "/admin/select_uni_co_id",
        dataType: 'html',
        data: {
            uni_id: this.value

        },
        async: true,
        cache: false,
        success: function (data) {

            $(".select_uni_co_id").html(data);


        }
    });

});
$("#select_days").change(function () {


    $(".for_input").remove();
    $(".four_input").empty();

    for ($i = 1; $i <= $('#select_days').val(); $i++) {
        $(".four_input").append('<p><div class="left_align for_input">'
            + '<p><lable>Course Start Date</lable></p>'
            + '<input type="text" class="dpd1 full_inputs" value="" name="course_start_date[' + $i + '][]" required>'
            + '<input type="hidden" class="fdpd2 full_inputs" name="from">'
            + '</div>'
            + '<div class="left_align for_input"> '
            + '<p><lable>Course Start Time</lable></p>'
            + '<input type="text" class="timepicker-24 full_inputs" value="" name="start_time[' + $i + '][]" required>'
            + '</div>'
            + '<div class="left_align for_input"> '
            + '<p><lable>Course End Time</lable></p>'
            + '<input type="text" class="timepicker-24 full_inputs" value="" name="end_time[' + $i + '][]" required>'
            + '</div></p>');
    }
     //   $(".four_input").append('<p><div class="col-md-8 row "><textarea class="full_input " id="editor" name="course_content" class="blog_scroll_y textarea_blg" required placeholder="Course Content"></textarea></div></p>');
     $(".four_input").append('<p><lable>Upload Course Content</lable><div class=" for_input left_align"><input type="file" class="full_input " name="course_content" required></div></p>');

     $(".four_input").append('<p><lable>Upload Course Review</lable><div class=" for_input left_align"><input type="file" class="full_input" name="course_doc"></div></p>');
     $('#editor').wysihtml5();
     $(function () {
        window.prettyPrint && prettyPrint();
        $('.default-date-picker').datepicker({
            format: 'dd-mm-yyyy'
        });
        $('.dpYears').datepicker();
        $('.dpMonths').datepicker();


        var startDate = new Date(2012, 1, 20);
        var endDate = new Date(2012, 1, 25);
        $('.dp4').datepicker()
        .on('changeDate', function (ev) {
            if (ev.date.valueOf() > endDate.valueOf()) {
                $('.alert').show().find('strong').text('The start date can not be greater then the end date');
            } else {
                $('.alert').hide();
                startDate = new Date(ev.date);
                $('#startDate').text($('.dp4').data('date'));
            }
            $('.dp4').datepicker('hide');
        });
        $('.dp5').datepicker()
        .on('changeDate', function (ev) {
            if (ev.date.valueOf() < startDate.valueOf()) {
                $('.alert').show().find('strong').text('The end date can not be less then the start date');
            } else {
                $('.alert').hide();
                endDate = new Date(ev.date);
                $('.endDate').text($('.dp5').data('date'));
            }
            $('.dp5').datepicker('hide');
        });

            // disabling dates
            var nowTemp = new Date();
            var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

            var checkin = $('.dpd1').datepicker({format: 'dd-mm-yyyy',
                onRender: function (date) {
                    return date.valueOf() < now.valueOf() ? 'disabled' : '';
                }
            }).on('changeDate', function (ev) {
                if (ev.date.valueOf() > checkout.date.valueOf()) {
                    var newDate = new Date(ev.date)
                    newDate.setDate(newDate.getDate() + 1);
                    checkout.setValue(newDate);
                }
                checkin.hide();
                $('.dpd2')[0].focus();
            }).data('datepicker');
            var checkout = $('.dpd2').datepicker({format: 'dd-mm-yyyy',
                onRender: function (date) {
                    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                }
            }).on('changeDate', function (ev) {
                checkout.hide();
            }).data('datepicker');
        });


     $('.timepicker-24').timepicker({
        autoclose: true,
        minuteStep: 1,
        showSeconds: false, defaultTime: false,
        showMeridian: false
    });

 });
$("#select_days_edit_time").change(function () {


    $(".for_input").remove();
    $(".four_input").empty();

    for ($i = 1; $i <= $('#select_days_edit_time').val(); $i++) {
        $(".four_input").append('<p><div class="left_align for_input">'
            + '<p><lable>Course Start Date</lable></p>'
            + '<input type="text" class="dpd1 full_inputs" value="" name="course_start_date[' + $i + '][]" required>'
            + '<input type="hidden" class="fdpd2 full_inputs" name="from">'
            + '</div>'
            + '<div class="left_align for_input"> '
            + '<p><lable>Course Start Time</lable></p>'
            + '<input type="text" class="timepicker-24 full_inputs" value="" name="start_time[' + $i + '][]" required>'
            + '</div>'
            + '<div class="left_align for_input"> '
            + '<p><lable>Course End Time</lable></p>'
            + '<input type="text" class="timepicker-24 full_inputs" value="" name="end_time[' + $i + '][]" required>'
            + '</div></p>');
    }
    $(function () {
        window.prettyPrint && prettyPrint();
        $('.default-date-picker').datepicker({
            format: 'dd-mm-yyyy'
        });
        $('.dpYears').datepicker();
        $('.dpMonths').datepicker();


        var startDate = new Date(2012, 1, 20);
        var endDate = new Date(2012, 1, 25);
        $('.dp4').datepicker()
        .on('changeDate', function (ev) {
            if (ev.date.valueOf() > endDate.valueOf()) {
                $('.alert').show().find('strong').text('The start date can not be greater then the end date');
            } else {
                $('.alert').hide();
                startDate = new Date(ev.date);
                $('#startDate').text($('.dp4').data('date'));
            }
            $('.dp4').datepicker('hide');
        });
        $('.dp5').datepicker()
        .on('changeDate', function (ev) {
            if (ev.date.valueOf() < startDate.valueOf()) {
                $('.alert').show().find('strong').text('The end date can not be less then the start date');
            } else {
                $('.alert').hide();
                endDate = new Date(ev.date);
                $('.endDate').text($('.dp5').data('date'));
            }
            $('.dp5').datepicker('hide');
        });

            // disabling dates
            var nowTemp = new Date();
            var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

            var checkin = $('.dpd1').datepicker({format: 'dd-mm-yyyy',
                onRender: function (date) {
                    return date.valueOf() < now.valueOf() ? 'disabled' : '';
                }
            }).on('changeDate', function (ev) {
                if (ev.date.valueOf() > checkout.date.valueOf()) {
                    var newDate = new Date(ev.date)
                    newDate.setDate(newDate.getDate() + 1);
                    checkout.setValue(newDate);
                }
                checkin.hide();
                $('.dpd2')[0].focus();
            }).data('datepicker');
            var checkout = $('.dpd2').datepicker({format: 'dd-mm-yyyy',
                onRender: function (date) {
                    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                }
            }).on('changeDate', function (ev) {
                checkout.hide();
            }).data('datepicker');
        });


    $('.timepicker-24').timepicker({
        autoclose: true,
        minuteStep: 1,
        showSeconds: false, defaultTime: false,
        showMeridian: false
    });

});

$("#select_course_no").change(function () {

    $(".four_input").empty();

    $.ajax({
        type: "Post",
        url: site_url + "admin/get_course_list",
        async: true,
        cache: false,
        success: function (data) {
            data = JSON.parse(data);

            var list;
            $.each(data, function (i, item) {

                list += '<option value="' + item.course_id + '">' + item.course_name + '</option>';


            });


            for ($i = 1; $i <= $('#select_course_no').val(); $i++) {
                $(".four_input").append('<div class="col-md-4"><select name="course_id[' + $i + ']" class="required">' +
                    '<option value="">Select Course ' + $i + ' </option>' + list +
                    '</select></div><div class="clear"></div>');
            }

        }
    });




});

// academic_program_add  date n time add
$("#add_more_day_date").click(function (e) {
    e.preventDefault();


    $(".four_input").append('<p><div class="left_align for_input">'
        + '<p><lable>Program Date</lable></p>'
        + '<input type="text" class="dpd1 full_inputs" value="" name="academic_program_date[]" required>'
                // + '<input type="hidden" class="fdpd2 full_inputs" name="from">'
                + '</div>'
                + '<div class="left_align for_input"> '
                + '<p><lable>Program Start Time</lable></p>'
                + '<input type="text" class=" full_inputs" value="" name="start_time[]" required>'
                + '</div>'
                + '<div class="left_align for_input"> '
                + '<p><lable>Program End Time</lable></p>'
                + '<input type="text" class="full_inputs" value="" name="end_time[]" required>'
                + '</div></p>');


    $(function () {
        window.prettyPrint && prettyPrint();
        $('.default-date-picker').datepicker({
            format: 'dd-mm-yyyy'
        });
        $('.dpYears').datepicker();
        $('.dpMonths').datepicker();


        var startDate = new Date(2012, 1, 20);
        var endDate = new Date(2012, 1, 25);
        $('.dp4').datepicker()
        .on('changeDate', function (ev) {
            if (ev.date.valueOf() > endDate.valueOf()) {
                $('.alert').show().find('strong').text('The start date can not be greater then the end date');
            } else {
                $('.alert').hide();
                startDate = new Date(ev.date);
                $('#startDate').text($('.dp4').data('date'));
            }
            $('.dp4').datepicker('hide');
        });
        $('.dp5').datepicker()
        .on('changeDate', function (ev) {
            if (ev.date.valueOf() < startDate.valueOf()) {
                $('.alert').show().find('strong').text('The end date can not be less then the start date');
            } else {
                $('.alert').hide();
                endDate = new Date(ev.date);
                $('.endDate').text($('.dp5').data('date'));
            }
            $('.dp5').datepicker('hide');
        });

            // disabling dates
            var nowTemp = new Date();
            var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

            var checkin = $('.dpd1').datepicker({format: 'dd-mm-yyyy',
                onRender: function (date) {
                    return date.valueOf() < now.valueOf() ? 'disabled' : '';
                }
            }).on('changeDate', function (ev) {
                if (ev.date.valueOf() > checkout.date.valueOf()) {
                    var newDate = new Date(ev.date)
                    newDate.setDate(newDate.getDate() + 1);
                    checkout.setValue(newDate);
                }
                checkin.hide();
                $('.dpd2')[0].focus();
            }).data('datepicker');
            var checkout = $('.dpd2').datepicker({format: 'dd-mm-yyyy',
                onRender: function (date) {
                    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                }
            }).on('changeDate', function (ev) {
                checkout.hide();
            }).data('datepicker');
        });
    $('.timepicker-24').timepicker({
        autoclose: true,
        minuteStep: 1,
        showSeconds: false, defaultTime: false,
        showMeridian: false
    });

});

$(".cal_time").change(function () {
    var tim1 = $('#start_time').val();
    var tim2 = $('#end_time').val();

    if (tim2 == "") {
        tim2 = tim1;
    }
    if (tim1 == "") {
        tim1 = tim2;
    }

    var ary1 = tim1.split(':'), ary2 = tim2.split(':');

    var minsdiff = parseInt(ary2[0], 10) * 60 + parseInt(ary2[1], 10) - parseInt(ary1[0], 10) * 60 - parseInt(ary1[1], 10);
    var total_time = String(100 + Math.floor(minsdiff / 60)).substr(1) + ':' + String(100 + minsdiff % 60).substr(1);

    $('.cal_time_total').val(total_time);


});

$("#select_package").change(function () {

    $(".send_package").submit();
});



$("#select_package_uni").change(function () {

    $(".send_package_uni").submit();
});
$("#get_hour").change(function () {


    $.ajax({
        type: "Post",
        url: site_url + "/student/get_pck_detail",
        dataType: 'html',
        data: {
            pck_id: this.value

        }, async: true,
        cache: false,
        beforeSend: function () {
                // setting a timeout
                $("#fill_data").html("<h3 style='color:#3C763D'><b>Please Wait.....</b></h3>");
            },
            success: function (data) {

                $("#fill_data").html(data);


            }
        });

});
    //get hour while admin add contact
    $("#get_hour_admin").change(function () {


        $.ajax({
            type: "Post",
            url: site_url + "/admin/get_pck_detail",
            dataType: 'html',
            data: {
                pck_id: this.value

            }, async: true,
            cache: false,
            beforeSend: function () {
                // setting a timeout
                $("#fill_data").html("<h3 style='color:#3C763D'><b>Please Wait.....</b></h3>");
            },
            success: function (data) {

                $("#fill_data").html(data);


            }
        });

    });

    $('.get_sum_of_hour').click(function () {

        //solution for hh:mm calculate
        var totalh = 0;
        var totalm = 0;
        $('.get_sum').each(function () {
            if (($(this).val())) {
                var h = parseInt(($(this).val()).split(':')[0]);
                var m = parseInt(($(this).val()).split(':')[1]);
                totalh += h;
                totalm += m;
            }
        });
        totalh += Math.floor(totalm / 60);
        totalm = totalm % 60;
        if (totalm.toString() == 0) {
            totalm = "00";
        }
        var sum = totalh.toString() + ':' + totalm.toString();
        //solution hh:mm

        var hid_sum = $("#get_sum").val();

        if (hid_sum == sum) {
            return true
        } else {
            return true
            // alert('Please enter equal sum of remaining hour ' + hid_sum + '')
            // return false;
        }

    });

    $('.get_subject_value').click(function (event) {
        var someObj = {};
        someObj.subjectIdGet = [];
        someObj.hoursIdGet = [];

        var sub = $("#hid_subject").val();
        var hour = $("#hid_hour").val();
        $(".get_subject_value").each(function () {
            if ($(this).is(":checked")) {
                if (sub > someObj.subjectIdGet.length) {
                    someObj.subjectIdGet.push($(this).val());
                    $('.' + $(this).attr('id')).prop("disabled", false);
                } else {
                    $(this).prop('checked', false);
                }

            } else {
                $('.' + $(this).attr('id')).val("");
                $('.' + $(this).attr('id')).prop("disabled", true);
            }
        });
        if (sub < someObj.subjectIdGet.length) {
            event.stopPropagation();
            alert('You can not select more than ' + sub + ' subjects');
        }


    });
    $('#step_3').click(function () {

        var someObj = {};
        someObj.subjectIdGet = [];
        someObj.hoursIdGet = [];

        var sub = $("#hid_subject").val();
        var hour = $("#hid_hour").val();



        $(".get_subject_value").each(function () {
            if ($(this).is(":checked")) {

                someObj.subjectIdGet.push($(this).val());

            }
        });



        var sum = 0;
        $('.get_hour').each(function () {
            if (Number($(this).val())) {
                sum += Number($(this).val());
            }
        });

//        if (someObj.subjectIdGet.length != sub) {
//
//            alert('Please select ' + sub + ' subjects');
//            return false;
//        }
//        else 
if (hour != sum) {
    alert('Please ensure the tuition hours add up to ' + hour + ' hours exactly ');
    return false;
} else {


    if ($("#step_3").hasClass("pack_reg_conf")) {
        $('#myModa12l_pck_con').modal('show');
    } else {
        $("#step_3").prop("type", "submit");
        $('form').submit();

    }


}

});

    $('#step3_3').click(function () {

        var someObj = {};
        someObj.subjectIdGet = [];
        someObj.hoursIdGet = [];

        var sub = $("#hid_subject").val();
        var hour = $("#hid_hour").val();



        $(".get_subject_value").each(function () {
            if ($(this).is(":checked")) {

                someObj.subjectIdGet.push($(this).val());

            }
        });



        var sum = 0;
        $('.get_hour').each(function () {
            if (Number($(this).val())) {
                sum += Number($(this).val());
            }
        });

//        if (someObj.subjectIdGet.length != sub) {
//
//            alert('Please select ' + sub + ' subjects');
//            return false;
//        }
//        else 
if (hour != sum) {
    alert('Please ensure the tuition hours add up to ' + hour + ' hours exactly ');
    return false;
} else {


    if ($("#step3_3").hasClass("pack_reg_conf")) {
        $('#myModa12l_pck_con').modal('show');
    } else {
        $("#step3_3").prop("type", "submit");
        $('form').submit();

    }


}

});

    $("#change_type_btn").click(function () {

        if ($("form").valid()) {
            $('#myModa12l_pck_con').modal('show');
        }
    });




    $("#pck_reg_no").click(function () {

        window.location.href = site_url + "student/request_new_package";
    });






    $("#tutor_id_get").change(function () {
        $("#tutor_id_get_t").submit();
    });
    $("#pay_up_doc").change(function () {
        if ($(this).val() == "EFT") {
            $('.bank').hide();
            $('.bursary').hide();
            $('.hi_p').show();
        } else if ($(this).val() == "Bank Statement") {
            $('.hi_p').hide();
            $('.bursary').hide();
            $('.bank').show();
        } else if ($(this).val() == "Bursary Company") {
            $('.hi_p').hide();
            $('.bank').hide();
            $('.bursary').show();
        } else {
            $('.bank').hide();
            $('.bursary').hide();
            $('.hi_p').hide();
        }
    });



    $(".change_employee").change(function () {
        $(".change_employee").submit();
    });
    $('.dm_test').click(function (e) {

        $('#student_log_id').val($(this).attr('id'));
        $('.timepicker-24').timepicker({
            autoclose: true,
            minuteStep: 1,
            showSeconds: false, defaultTime: false,
            showMeridian: false
        });
    });



    $('.region_get').click(function (e) {
        var reg = $(this).val();
        $(".subject_set_Data").empty();
        // $('.uni').hide();
        // $('.' + reg).show();
        $.ajax({
            type: "Post",
            url: site_url + "/get_university_by_region",
            dataType: 'html',
            data: {
                reg_name: reg

            }, async: true,
            cache: false,
            beforeSend: function () {
                // setting a timeout
                $(".set_data").html("<div class='set_region_div'><b>Please Wait.....</b></div>");
            },
            success: function (data) {

                $(".set_data").html(data);


            }
        });
    });
    $(".set_data").on('click', '.interset_get', function () {



        var someObj = {};

        someObj.uniGet = [];

        $(".interset_get").each(function () {

            if ($(this).is(":checked")) {
                someObj.uniGet.push($(this).val());
            }
        });


        $.ajax({
            type: "Post",
            url: site_url + "get_subject_by_uni",
            dataType: 'html',
            data: {
                uni_name: someObj.uniGet
            }, async: true,
            cache: false,
            beforeSend: function () {
                // setting a timeout

                $(".subject_set_Data").html("<div class='set_region_div'><b>Please Wait.....</b></div>");

            },
            success: function (data) {

                $(".subject_set_Data").html(data);


            }
        });
        if (someObj.uniGet == "") {
            $(".subject_set_Data").empty();
        }



    });

    $('#cls_for_valid').click(function (e) {

        var someObj = {};

        someObj.sessionIdGet = [];

        $(".new_check_for").each(function () {

            if ($(this).is(":checked")) {
                someObj.sessionIdGet.push($(this).val());
            }
        });
        if (someObj.sessionIdGet.length == 0) {
            alert('Select atleast one subject');
            return false;
        } else if (someObj.sessionIdGet.length > 0) {
            if (confirm("Are you absolutely sure you want to delete subject?")) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }


    });


    $('#checkin_stu').click(function (e) {

        var someObj = {};

        someObj.sessionIdGet = [];

        $(".check_student_sel").each(function () {

            if ($(this).is(":checked")) {
                someObj.sessionIdGet.push($(this).val());
            }
        });
        if (someObj.sessionIdGet.length == 0) {
            alert('Select atleast one Student');
            return false;
        } else if (someObj.sessionIdGet.length > 0) {
            if (confirm("Are you absolutely sure you want to remove student?")) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }


    });



    $('#checkin_us').click(function (e) {

        var someObj = {};

        someObj.sessionIdGet = [];

        $(".check_suser_sel").each(function () {

            if ($(this).is(":checked")) {
                someObj.sessionIdGet.push($(this).val());
            }
        });
        if (someObj.sessionIdGet.length == 0) {
            alert('Select atleast one User');
            return false;
        } else if (someObj.sessionIdGet.length > 0) {
            if (confirm("Are you absolutely sure you want to remove User?")) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }


    });
    $('#faculty_vlaide').click(function (e) {

        var someObj = {};

        someObj.sessionIdGet = [];

        $(".check_faculty_sel").each(function () {

            if ($(this).is(":checked")) {
                someObj.sessionIdGet.push($(this).val());
            }
        });
        if (someObj.sessionIdGet.length == 0) {
            alert('Select atleast one Faculty');
            return false;
        } else if (someObj.sessionIdGet.length > 0) {
            if (confirm("Are you absolutely sure you want to remove Faculty?")) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }


    });
    $('#checkin_tutor').click(function (e) {

        var someObj = {};

        someObj.sessionIdGet = [];

        $(".check_tutor_sel").each(function () {

            if ($(this).is(":checked")) {
                someObj.sessionIdGet.push($(this).val());
            }
        });
        if (someObj.sessionIdGet.length == 0) {
            alert('Select atleast one Tutor');
            return false;
        } else if (someObj.sessionIdGet.length > 0) {
            if (confirm("Are you absolutely sure you want to remove tutor?")) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }
    });


    $('#create_user_n').click(function (e) {

        var someObj = {};

        someObj.sessionIdGet = [];

        $(".new_user_create").each(function () {

            if ($(this).is(":checked")) {
                someObj.sessionIdGet.push($(this).val());
            }
        });
        if (someObj.sessionIdGet.length == 0) {
            alert('Select atleast one User Type');
            return false;
        } else if (someObj.sessionIdGet.length > 0) {
            return true;
        } else {
            return false;
        }
    });



    //subject_tutors


    var options = {
        url: site_url + 'admin/tutor_aj_id',
        //  getValue: "name",
        list: {
            match: {
                enabled: true
            },
            maxNumberOfElements: 10,
            onHideListEvent: function () {

            }
        }

    };


    $("#subject_id_subject").easyAutocomplete(options);
    $("#subject_id_subjectshow").click(function () {
        $.ajax({
            type: "Post",
            url: site_url + "admin/tutors_and_subjects",
            data: {
                subject_id: $('#subject_id_subject').val()

            },
            async: true,
            cache: false,
            success: function (data) {

                $(".tutor_lists").html(data);
                // clearconsole();
            }
        });
        $.ajax({
            type: "Post",
            url: site_url + "admin/tutors_and_subjects",
            data: {
                subject_count: $('#subject_id_subject').val()

            },
            async: true,
            cache: false,
            success: function (data) {
                $(".tutor_count").html(data);
                // clearconsole();
            }
        });
    });

    $("#tutor_id_tutor").change(function () {

        $.ajax({
            type: "Post",
            url: site_url + "admin/tutors_and_subjects",
            data: {
                tutor_id: $(this).val()

            },
            async: true,
            cache: false,
            success: function (data) {

                $(".stu_allocated_lists").html(data);
                //   clearconsole();
            }
        });
        $.ajax({
            type: "Post",
            url: site_url + "admin/tutors_and_subjects",
            data: {
                tutor_id_count: $(this).val()

            },
            async: true,
            cache: false,
            success: function (data) {

                $(".student_allocated_count").html(data);
                //    clearconsole();
            }
        });


    });
    
    $("#select_type_user").change(function () {

        $.ajax({
            type: "Post",
            url: site_url + "admin/get_list_course_subject",
            data: {
                usertype: $(this).val()

            },
            async: true,
            cache: false,
            success: function (data) {

                $(".stu_allocated_lists").html(data);
                $("#live_search").keyup(function () {
                    _this = this;
        // alert('dd');
        // Show only matching TR, hide rest of them
        $.each($("table tbody").find("tr"), function () {
            console.log($(this).text());
            if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) == -1)
                $(this).hide();
            else
                $(this).show();
        });
    });
            }
        });



    });
    

});