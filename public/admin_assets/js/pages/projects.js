var References = function () {

    var projectsTable = function () {

        var table = $('#projects');

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

            "bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.


            // set default column settings
            "columnDefs": [
                {"orderable": false, "searchable": false, "targets": 0},
                {"orderable": true, "searchable": false, "targets": 1},
                {"orderable": true, "searchable": true, "targets": 2},
                {"orderable": true, "searchable": true, "targets": 3},
                {"orderable": true, "searchable": true, "targets": 4},
                {"orderable": true, "searchable": true, "targets": 5},
                {"orderable": true, "searchable": true, "targets": 6},
                {"orderable": false, "searchable": false, "targets": 7}
            ],

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


    var resetSearchForm = function () {
        $('#reset_search_form').on('click', function () {
            $(':input', '#project_search_form')
                    .not(':button, :submit, :reset, :hidden')
                    .val('')
                    .removeAttr('checked')
                    .removeAttr('selected');
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

    var viewReferenceDialog = function () {

        $('[id*=details_]').on('click', function (e) {
            e.preventDefault();
            currentElem = this;
            var id = $(currentElem).attr('data-id');
            console.log(id);

            $.ajax({
                type: "POST",
                data: {id: id},
                url: "admin/projects/view_project_ajax",
                dataType: "json",
                beforeSend: function () {
                    $('#loadingDiv').html('<img src="public/admin_assets/img/loader.gif">');
                    $('#loadingDiv').show();
                },
                complete: function () {
                    $('#loadingDiv').hide();
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
                    if (data.project_update_timestamp != null) {
                        update_date = data.project_update_timestamp;
                    }
                    var expiry_date = '';
                    if (data.project_expiry_timestamp != null) {
                        expiry_date = data.project_expiry_timestamp;
                    }

                    var project_status = '';
                    if (data.project_status == '0') {
                        project_status = 'Inaktív';
                    } else {
                        project_status = 'Aktív';
                    }

                    content = '<dl class="dl-horizontal">';
                    content += add_html('Azonosító szám', '#' + data.project_id);
                    content += add_html('Megnevezés:', data.project_title);
                    content += add_html('Munkaadó:', data.employer_name);
                    content += add_html('Típus:', data.project_list_name);
                    content += add_html('Leírás:', data.project_description);
                    content += add_html('Feltételek:', data.project_conditions);
                    content += add_html('Munkavégzés helye:', munka_helye);
                    content += add_html('Munkaidő:', data.project_working_hours);
                    content += add_html('Fizetés:', data.project_pay);
                    content += add_html('Lejárati idő:', expiry_date);
                    content += add_html('Létrehozás dátuma:', data.project_create_timestamp);
                    content += add_html('Módosítás dátuma:', update_date);
                    content += add_html_last('Státusz:', project_status);
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
                                    window.location.href = 'admin/projects/update_project/' + data.project_id;
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



    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            projectsTable();
            resetSearchForm();
            viewReferenceDialog();

            vframework.deleteItems({
                table_id: "projects",
                url: "admin/projects/delete"
            });

            vframework.changeStatus({
                url: "admin/projects/change_status",
            });

            vframework.printTable({
                print_button_id: "print_projects", // elem id-je, amivel elindítjuk a nyomtatást 
                table_id: "projects",
                title: "Referenciák listája"
            });

            vframework.hideAlert();

        }

    };

}();

$(document).ready(function () {
    References.init(); // init projects page
});