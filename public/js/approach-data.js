$(document).ready(function () {
    console.log('Approach script ok');


    $('[data-toggle="tooltip"]').tooltip();


    //Approach data submit error script
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    //Create Approach
    $('body').on('click', '#submitForm', function (e) {
        e.preventDefault();
        //$(this).html('Sending..');

        var approachForm = $("#approachForm");
        var formData = approachForm.serialize();
        var approach_url = Globals.base_url + "home/store";
        var home_url = Globals.base_url + "home";

        $.ajax({
            url: approach_url,
            type: 'POST',
            data: formData,
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
                $('#approachModal').trigger("reset");
                $('.approachModalCls').modal('hide');
                window.location.href = home_url;
            },

            error: function (jqXHR, textStatus, errorThrown) {
                data = jqXHR.responseJSON;

                if (data.errors) {

                    if (data.errors.class_data) {
                        $('#class_name_error').html(data.errors.class_data[0]);
                    }
                    if (data.errors.j_code) {
                        $('#j_code_error').html(data.errors.j_code[0]);
                    }
                    if (data.errors.wholesaler_kana) {
                        $('#wholesaler_kana_error').html(data.errors.wholesaler_kana[0]);
                    }

                }
            }
        });

    });


    //approach_edit data
    $(document).on('click', 'a.approach_edit', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var row_id = $(this).attr('data-id');
        var approach_editurl = Globals.base_url + "home/edit/" + row_id;


        $("div#approachModal").modal("show");

        $.ajax({
            url: approach_editurl,
            type: "get",
            success: function (data) {
                var json_res = JSON.parse(data);
                //console.log(json_res.class_data);
                //return false;

                $("input#id").val(row_id);

                $("input#user_id").val(json_res.userID);
                $("input#class_data").val(json_res.class_data);
                $("input#j_code").val(json_res.j_code);
                $("input#responsible").val(json_res.responsible);
                $("input#wholesaler_kana").val(json_res.wholesaler_kana);
                $("input#wholesaler_name").val(json_res.wholesaler_name);
                $("input#charges").val(json_res.charges);
                $("input#invoice_name").val(json_res.invoice_name);
                $("input#department").val(json_res.department);
                $("input#tel").val(json_res.tel);
                $("input#fax").val(json_res.fax);
                $("input#zipcode").val(json_res.zip_code);
                $("input#address").val(json_res.address);
                $("input#address2").val(json_res.address2);
                $("input#basic_rate").val(json_res.basic_rate);
                $("input#line_rate").val(json_res.line_rate);
                $("input#super_code").val(json_res.super_code);
                $("input#super_name").val(json_res.super_name);
                $("input#lease_class").val(json_res.lease_class);
                $("input#id3").val(json_res.id_3);
                $("input#system").val(json_res.system);
                $("input#maturity_date").val(json_res.maturity_date);
                $("input#sales_staff").val(json_res.sales_staff);
                $("input#contract_date").val(json_res.contract_date);
                $("input#cancel_date").val(json_res.cancel_date);
                $("input#period").val(json_res.period);
                $("input#contract_renewal").val(json_res.contract_renewal);
                $("input#cancel_reason").val(json_res.cancel_reason);
                $("input#cancel_reception_date").val(json_res.cancel_reception_date);
                $("input#management_nb").val(json_res.management_nb);
                $("input#sales_nb").val(json_res.sales_nb);
                $("input#support_nb").val(json_res.support_nb);
                $("input#customer_code").val(json_res.customer_code);
                $("input#month_payment").val(json_res.month_payment);
                $("input#month_sales").val(json_res.month_sales);
                $("input#month_balance").val(json_res.month_balance);
                $("input#automatic_transfer").val(json_res.automatic_transfer);
                $("input#zennginn").val(json_res.zennginn);
                $("input#pit").val(json_res.pit);
                $("input#kadou").val(json_res.kadou);
                $("input#torihikisaki_itirann").val(json_res.torihikisaki_itirann);
            },

            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status);
                data = jqXHR.responseJSON;

                alert("Error data edit !!!");
            }
        });


    });


    //Export data CSV
    $(document).on('click', 'a.csv-export-data', function () {
        event.preventDefault();

        var searchIDs = $(".check-data-row:checked").map(function () {
            return $(this).attr('row_id');
        }).get();

        var approachExport = searchIDs;
        var export_url = Globals.base_url + "export_selected/" + approachExport;

        if (approachExport.length > 0) {
            window.location = export_url;
        } else {
            alert("Please select the row");
            return false;
        }


    });


    //Ajax search script

    // $(document).ready(function () {
    //     $(document).on('click', '.pagination a', function (event) {
    //         event.preventDefault();
    //         $('li').removeClass('active');
    //         $(this).parent('li').addClass('active');
    //         var myurl = $(this).attr('href');
    //         var page = $(this).attr('href').split('page=')[1];
    //
    //         getData(page);
    //     });
    //
    // });

    // function getData(page, filter_status = 0, updated_ids = null) {
    //     var j_code = $('').val();
    //     var wholesaler_name = $('').val();
    //     var keywords = $('#approachInput').val();
    //     //var custom_url = "home/search";
    //     var custom_url = "jqueryLoadMore_normal";
    //
    //     $.ajax({
    //         headers: {
    //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    //         },
    //         url: custom_url,
    //         type: "post",
    //         data: {page: page, jan: jan, c_id: c_id, keywords: keywords},
    //         datatype: "html",
    //         beforeSend: function () {
    //             $('.ajax-loading').show();
    //         }
    //     })
    //         .done(function (data) {
    //             console.log(data);
    //             $(".vendor_itemdata_table").html("");
    //             response = data.items;
    //             var j = 0;
    //             var htmls = '';
    //             if (response.length > 0) {
    //                 for (var i = 0; i < (response.length); i++) {
    //                     var item_checkd = '';
    //                     var vendor_name = (response[i].vendor_id == 0 ? '不明' : response[i].vendor_name);
    //                     var update_counter_vl = 0;
    //                     if (updated_ids != null) {
    //                         update_counter_vl = updated_ids.length;
    //
    //                         var rwId = '' + response[i].vendor_item_id + '';
    //                         if (updated_ids.indexOf(rwId) != '-1') {
    //                             item_checkd = 'checked';
    //                             console.log(updated_ids);
    //                             console.log('in array');
    //                         }
    //                     }
    //                     $('.updated_counter').text(update_counter_vl);
    //                     $('.filter_counter').text(data.total);
    //
    //
    //                     htmls += '</tr class="text-center">';
    //                     htmls +='<td>'+ response[i].No +'</td>';
    //                     htmls +='<td>'+ response[i].ExportCSV +'</td>';
    //                     htmls +='<td>'+ response[i].UserID +'</td>';
    //                     htmls +='<td>'+ response[i].Class +'</td>';
    //                     htmls +='<td>'+ response[i].J_Code +'</td>';
    //
    //                     htmls += '</tr>';
    //                     j++;
    //                 }
    //             } else {
    //                 htmls += '<tr><td colspan="12" class="text-center">商品がありません。</td></tr>';
    //             }
    //             $(".vendor_itemdata_table").html(htmls);
    //             $(".pagi_content").html(data.pagi);
    //
    //             show_hide_col_table();
    //             $('.digits_td').digits_td();
    //             $('.digits').digits();
    //
    //             $('.v_ids_v').val(v_id);
    //             $('#vendor_show_modal').modal('hide');
    //             $(".tablesorter").tablesorter({
    //                 sortList: [
    //                     [0, 0],
    //                     [2, 0]
    //                 ]
    //             });
    //         })
    //         .fail(function (jqXHR, ajaxOptions, thrownError) {
    //             alert('No response from server');
    //         });
    // }


});

