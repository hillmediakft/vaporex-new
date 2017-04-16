var Products = function () {

    var productsTable = function () {

        var table = $('#products');

        table.dataTable({

            "language": {
                // metronic specific
                    //"metronicGroupActions": "_TOTAL_ sor kiválasztva: ",
                    //"metronicAjaxRequestGeneralError": "A kérés nem hajtható végre, ellenőrizze az internet kapcsolatot!",

                // data tables specific                
                "decimal":        "",
                "emptyTable":     "Nincs megjeleníthető adat!",
                "info":           "_START_ - _END_ elem &nbsp; _TOTAL_ elemből",
                "infoEmpty":      "Nincs megjeleníthető adat!",
                "infoFiltered":   "(Szűrve _MAX_ elemből)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     " _MENU_ elem/oldal",
                "loadingRecords": "Betöltés...",
                "processing":     "Feldolgozás...",
                "search":         "Keresés:",
                "zeroRecords":    "Nincs egyező elem",
                "paginate": {
                    "previous":   "Előző",
                    "next":       "Következő",
                    "last":       "Utolsó",
                    "first":      "Első",
                    "pageOf":     "&nbsp;/&nbsp;"
                },
                "aria": {
                    "sortAscending":  ": aktiválja a növekvő rendezéshez",
                    "sortDescending": ": aktiválja a csökkenő rendezéshez"
                }
            },

            // set default column settings
            "columnDefs": [
                {"orderable": false, "searchable": false, "targets": 0},
                {"orderable": false, "searchable": false, "targets": 1},
                {"orderable": true, "searchable": true, "targets": 2},
                {"orderable": true, "searchable": true, "targets": 3},
                {"orderable": true, "searchable": true, "targets": 4},
                {"orderable": true, "searchable": true, "targets": 5},
                {"orderable": true, "searchable": true, "targets": 6},
                {"orderable": true, "searchable": true, "targets": 7},
                {"orderable": false, "searchable": false, "targets": 8}
            ],

            "bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "Összes"] // change per page values here
            ],
            // set the initial value
            "pageLength": 15,
            "pagingType": "bootstrap_full_number",
            "order": [
                [2, "asc"]
            ] // set column as a default sort by asc


        });

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                    //$(this).parents('tr').addClass("active");
                } else {
                    $(this).prop("checked", false);
                    //$(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });
    }

    /*----------------------------------------------------------*/

    var add_html = function (label, data) {
        html = '<dt style="font-size:100%; color:grey;">' + label + '</dt>' +
                '<dd>' + data + '</dd>' +
                '<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>';
        return html;
    };

    var add_html_last = function (label, data) {
        html = '<dt style="font-size:100%; color:grey;">' + label + '</dt>' +
                '<dd>' + data + '</dd>';
        return html;
    };

    var viewProductDialog = function () {

        $('[id*=details_]').on('click', function (e) {
            e.preventDefault();
            currentElem = this;
            var id = $(currentElem).attr('data-id');
            console.log(id);

            $.ajax({
                type: "POST",
                data: {id: id},
                url: "admin/products/view_ajax",
                dataType: "json",
                beforeSend: function () {
                    App.blockUI({
                        boxed: true,
                        message: 'Feldolgozás...'
                    });
                },
                complete: function () {
                    App.unblockUI();
                },
                success: function (result) {

                    var data = result[0];

                    var county_name = '';
                    if (data.county_name == 'Budapest') {
                        county_name = 'Budapest, ';
                    }

                    var city_name = '';
                    if (data.city_name != null) {
                        city_name = data.city_name;
                    }

                    var district_name = '';
                    if (data.district_name != null) {
                        district_name = data.district_name + ' kerület';
                    }

                    var munka_helye = county_name + city_name + district_name;

                    var update_date = '';
                    if (data.product_update_timestamp != null) {
                        update_date = data.product_update_timestamp;
                    }
                    var expiry_date = '';
                    if (data.product_expiry_timestamp != null) {
                        expiry_date = data.product_expiry_timestamp;
                    }

                    var product_status = '';
                    if (data.product_status == '0') {
                        product_status = 'Inaktív';
                    } else {
                        product_status = 'Aktív';
                    }

                    content = '<dl class="dl-horizontal">';
                    content += add_html('Azonosító szám', '#' + data.product_id);
                    content += add_html('Megnevezés:', data.product_title);
                    content += add_html('Munkaadó:', data.employer_name);
                    content += add_html('Típus:', data.product_list_name);
                    content += add_html('Leírás:', data.product_description);
                    content += add_html('Feltételek:', data.product_conditions);
                    content += add_html('Munkavégzés helye:', munka_helye);
                    content += add_html('Munkaidő:', data.product_working_hours);
                    content += add_html('Fizetés:', data.product_pay);
                    content += add_html('Lejárati idő:', expiry_date);
                    content += add_html('Létrehozás dátuma:', data.product_create_timestamp);
                    content += add_html('Módosítás dátuma:', update_date);
                    content += add_html_last('Státusz:', product_status);
                    content += '</dl>';

                    // bootbox dialog doboz megjelenítése
                    bootbox.dialog({
                        size: "large",
                        message: content,
                        title: "Munka részletei",
                        animate: true,
                        buttons: {
                            success: {
                                label: "Adatok módosítása",
                                className: "btn-success",
                                callback: function () {
                                    window.location.href = 'admin/products/update/' + data.product_id;
                                }
                            },
                            cancel: {
                                label: "vissza",
                                className: "btn-default"
                            }
                        }
                    });

                },
                error: function (result, status, e) {
                    alert(e);
                }
            });

        });
    }


    /*----------------------------------------------------------*/

    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            productsTable();
            viewProductDialog();

            vframework.deleteItems({
                table_id: "products",
                url: "admin/products/delete"
            });

            vframework.changeStatus({
                url: "admin/products/change_status",
            });

            vframework.printTable({
                print_button_id: "print_products", // elem id-je, amivel elindítjuk a nyomtatást 
                table_id: "products",
                title: "Termékek listája"
            });

            vframework.hideAlert();

        }

    };

}();

$(document).ready(function () {
    Products.init(); // init products page
});