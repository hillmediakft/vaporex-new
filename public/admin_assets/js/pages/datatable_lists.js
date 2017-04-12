var DatatableLists = function () {

    // html elem tárolja; a dataObj objektum kulcsa!
    //var item = $("table").attr('id');
    var item = $("#table-marker").attr('data-marker');

    // Az egyes táblákhoz és html elemekhez tartozó adatokat tároló objektum
    var dataObj = {
        allapot: {
            html_table_id: "#allapot",
            html_new_button: '#allapot_new',
            db_table_name: 'ingatlan_allapot',
            db_id_name: 'all_id',
            db_leiras_name: 'all_leiras'
        },
        emelet: {
            html_table_id: "#emelet",
            html_new_button: '#emelet_new',
            db_table_name: 'ingatlan_emelet',
            db_id_name: 'emelet_id',
            db_leiras_name: 'emelet_leiras'
        },
        energetika: {
            html_table_id: "#energetika",
            html_new_button: '#energetika_new',
            db_table_name: 'ingatlan_energetika',
            db_id_name: 'energetika_id',
            db_leiras_name: 'energetika_leiras'
        },
        fenyviszony: {
            html_table_id: "#fenyviszony",
            html_new_button: '#fenyviszony_new',
            db_table_name: 'ingatlan_fenyviszony',
            db_id_name: 'fenyviszony_id',
            db_leiras_name: 'fenyviszony_leiras'
        },
        furdo_wc: {
            html_table_id: "#furdo_wc",
            html_new_button: '#furdo_wc_new',
            db_table_name: 'ingatlan_furdo_wc',
            db_id_name: 'furdo_wc_id',
            db_leiras_name: 'furdo_wc_leiras'
        },
        futes: {
            html_table_id: "#futes",
            html_new_button: '#futes_new',
            db_table_name: 'ingatlan_futes',
            db_id_name: 'futes_id',
            db_leiras_name: 'futes_leiras'
        },
        haz_allapot_belul: {
            html_table_id: "#haz_allapot_belul",
            html_new_button: '#haz_allapot_belul_new',
            db_table_name: 'ingatlan_haz_allapot_belul',
            db_id_name: 'haz_allapot_belul_id',
            db_leiras_name: 'haz_allapot_belul_leiras'
        },
        haz_allapot_kivul: {
            html_table_id: "#haz_allapot_kivul",
            html_new_button: '#haz_allapot_kivul_new',
            db_table_name: 'ingatlan_haz_allapot_kivul',
            db_id_name: 'haz_allapot_kivul_id',
            db_leiras_name: 'haz_allapot_kivul_leiras'
        },
        kategoria: {
            html_table_id: "#kategoria",
            html_new_button: '#kategoria_new',
            db_table_name: 'ingatlan_kategoria',
            db_id_name: 'kat_id',
            db_leiras_name: 'kat_nev'
        },
        kert: {
            html_table_id: "#kert",
            html_new_button: '#kert_new',
            db_table_name: 'ingatlan_kert',
            db_id_name: 'kert_id',
            db_leiras_name: 'kert_leiras'
        },
        kilatas: {
            html_table_id: "#kilatas",
            html_new_button: '#kilatas_new',
            db_table_name: 'ingatlan_kilatas',
            db_id_name: 'kilatas_id',
            db_leiras_name: 'kilatas_leiras'
        },
        szoba_elrendezes: {
            html_table_id: "#szoba_elrendezes",
            html_new_button: '#szoba_elrendezes_new',
            db_table_name: 'ingatlan_szoba_elrendezes',
            db_id_name: 'szoba_elrendezes_id',
            db_leiras_name: 'szoba_elrendezes_leiras'
        },
        parkolas: {
            html_table_id: "#parkolas",
            html_new_button: '#parkolas_new',
            db_table_name: 'ingatlan_parkolas',
            db_id_name: 'parkolas_id',
            db_leiras_name: 'parkolas_leiras'
        },
        szerkezet: {
            html_table_id: "#szerkezet",
            html_new_button: '#szerkezet_new',
            db_table_name: 'ingatlan_szerkezet',
            db_id_name: 'szerkezet_id',
            db_leiras_name: 'szerkezet_leiras'
        }        
    };


    var handleTable = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
            jqTds[3].innerHTML = '<a class="edit" href=""><i class="fa fa-check"></i> Mentés</a>';
            jqTds[4].innerHTML = '<a class="cancel" href=""><i class="fa fa-close"></i> Mégse</a>';
        }

        function saveRow(oTable, nRow, lastInsertId) {
            var jqInputs = $('input', nRow);
            if (lastInsertId > 0 && lastInsertId != true) {
                oTable.fnUpdate(lastInsertId, nRow, 0, false);
            }
            
            oTable.fnUpdate(jqInputs[0].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 2, false);
            oTable.fnUpdate('<a class="edit" href=""><i class="fa fa-edit"></i> Szerkeszt</a>', nRow, 3, false);
            oTable.fnUpdate('<a class="delete" href=""><i class="fa fa-trash"></i> Töröl</a>', nRow, 4, false);
            oTable.fnDraw();
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 2, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 3, false);
            oTable.fnDraw();
        }


    // tábla megadása
        var table = $(dataObj[item].html_table_id);

    // tábla paraméterek beállítása    
        var oTable = table.dataTable({
            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "Összes"] // change per page values here
            ],
            // set the initial value
            "pageLength": 20,
            "language": {
                // metronic specific
                //"metronicGroupActions": "_TOTAL_ sor kiválasztva: ",
                //"metronicAjaxRequestGeneralError": "A kérés nem hajtható végre, ellenőrizze az internet kapcsolatot!",

                // data tables specific                
                "decimal": "",
                "emptyTable": "Nincs megjeleníthető adat!",
                "info": "_START_ - _END_ elem &nbsp;/ _TOTAL_ elemből",
                "infoEmpty": "Nincs megjeleníthető adat!",
                "infoFiltered": "(Szűrve _MAX_ elemből)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": " _MENU_ elem/oldal",
                "loadingRecords": "Betöltés...",
                "processing": "Feldolgozás...",
                "search": "Keresés:",
                "zeroRecords": "Nincs egyező elem",
                "paginate": {
                    "previous": "Előző",
                    "next": "Következő",
                    "last": "Utolsó",
                    "first": "Első",
                    "pageOf": "&nbsp;/&nbsp;"
                },
                "aria": {
                    "sortAscending": ": aktiválja a növekvő rendezéshez",
                    "sortDescending": ": aktiválja a csökkenő rendezéshez"
                }
            },
            "columnDefs": [
                {"orderable": true, "searchable": true, "targets": 0},
                {"orderable": true, "searchable": true, "targets": 1},
                {"orderable": true, "searchable": true, "targets": 2},
                {"orderable": false, "searchable": false, "targets": 3},
                {"orderable": false, "searchable": false, "targets": 4}
            ],
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "Összes"] // change per page values here
            ],
            "pageLength": -1,            
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });

        /*      var tableWrapper = $("#kategoria_wrapper");
         
         tableWrapper.find(".dataTables_length select").select2({
         showSearchInput: false //hide search box with special css class
         }); // initialize select2 dropdown */

        var nEditing = null;
        var nNew = false;

    // új elem hozzáadása
        $(dataObj[item].html_new_button).click(function (e) {
            e.preventDefault();

            if (nNew || nEditing) {

                App.alert({
                    container: $('#ajax_message'), // $('#elem'); - alerts parent container(by default placed after the page breadcrumbs)
                    place: "append", // "append" or "prepend" in container 
                    type: 'warning', // alert's type (success, danger, warning, info)
                    message: "A szerkesztett elemet mentse el, vagy klikkel-jen a mégse gombra.", // alert's message
                    icon: "warning" // put icon before the message
                });

            } else {
                var aiNew = oTable.fnAddData(['', '', '', '', '']);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                editRow(oTable, nRow);
                nEditing = nRow;
                nNew = true;
            }
        });

        table.on('click', '.delete', function (e) {
            e.preventDefault();
            reference = $(this);
            bootbox.setDefaults({
                locale: "hu",
            });
            bootbox.confirm("Biztosan törölni akarja?", function (result) {
                if (result) {

                    var ajax_message = $('#ajax_message');
                    var nRow = reference.parents('tr')[0];
                    var id = $(reference.closest('tr')).find('td:first').html();
                    id = $.trim(id);

                    $.ajax({
                        type: "POST",
                        data: {
                            id: id,
                            action: 'delete',
                            table: dataObj[item].db_table_name,
                            id_name: dataObj[item].db_id_name
                        },
                        url: "admin/datatables/ajax_delete",
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
                            if (result.status == 'success') {
                                
                                App.alert({
                                    type: 'success',
                                    //icon: 'warning',
                                    message: result.message,
                                    container: ajax_message,
                                    place: 'append',
                                    close: true, // make alert closable
                                    reset: false, // close all previouse alerts first
                                    //focus: true, // auto scroll to the alert after shown
                                    closeInSeconds: 3 // auto close after defined seconds
                                }); 
                                
                                // sor törlése a DOM-ból
                                oTable.fnDeleteRow(nRow);
                            }

                            if (result.status == 'error') {
                                App.alert({
                                    container: ajax_message, // $('#elem'); - alerts parent container(by default placed after the page breadcrumbs)
                                    place: "append", // "append" or "prepend" in container 
                                    type: 'danger', // alert's type (success, danger, warning, info)
                                    message: result.message, // alert's message
                                    close: true, // make alert closable
                                    reset: true, // close all previouse alerts first
                                    // focus: true, // auto scroll to the alert after shown
                                    closeInSeconds: 4 // auto close after defined seconds
                                    // icon: "warning" // put icon before the message
                                });
                            }

                        },
                        error: function (result, status, e) {
                            console.log(errorThrown);
                            console.log("Hiba történt: " + textStatus);
                            console.log("Rendszerválasz: " + xhr.responseText);
                        }
                    });



                }

            });

        });

        // mégsem
        table.on('click', '.cancel', function (e) {
            e.preventDefault();
            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        // edit, insert
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            reference = $(this);
            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];

            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == '<i class="fa fa-check"></i> Mentés') {
                /* Editing this row and want to save it */

                bootbox.setDefaults({
                    locale: "hu",
                });
                bootbox.confirm("Biztosan menteni akarja a módosítást?", function (result) {
                    if (result) {

                        var ajax_message = $('#ajax_message');
                        
                        var id = $(reference.closest('tr')).find('td:first').html();
                        id = $.trim(id);
                        
                        // ha több input mező van, akkor tömböt kell küldeni a php-nak
                        var data = new Array();
                        // bejárjuk az input elemeket, és az value attribútum értékét berakjuk a data tömbbe
                        $.each(reference.closest('tr').find('input'), function(index, val) {
                            data.push($(this).val());
                        });

                        // php feldolgozónak küldendő objektum összeállítása; pl: {kategoria_leiras_hu: magyar_adat, kategoria_leiras_en: angol_adat}
                        var sendDataObject = {};
                        var leiras_name_hu = dataObj[item].db_leiras_name + "_hu";
                        var leiras_name_en = dataObj[item].db_leiras_name + "_en";
                        sendDataObject[leiras_name_hu] =  data[0];
                        sendDataObject[leiras_name_en] =  data[1];

                        $.ajax({
                            type: "POST",
                            data: {
                                id: id,
                                action: 'update_insert',
                                table: dataObj[item].db_table_name,
                                id_name: dataObj[item].db_id_name,
                                leiras_name: dataObj[item].db_leiras_name,
                                data: sendDataObject
                            },
                            url: "admin/datatables/ajax_update_insert",
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
                                if (result.status == 'success') {

                                    App.alert({
                                        container: ajax_message, // $('#elem'); - alerts parent container(by default placed after the page breadcrumbs)
                                        place: "append", // "append" or "prepend" in container 
                                        type: 'success', // alert's type (success, danger, warning, info)
                                        message: result.message, // alert's message
                                        close: true, // make alert closable
                                        // reset: true, // close all previouse alerts first
                                        // focus: true, // auto scroll to the alert after shown
                                        closeInSeconds: 4 // auto close after defined seconds
                                        // icon: "warning" // put icon before the message
                                    });

                                    saveRow(oTable, nEditing, result.last_insert_id);
                                    nEditing = null;
                                    nNew = false;

                                }

                                if (result.status == 'error') {
                                    App.alert({
                                        container: ajax_message, // $('#elem'); - alerts parent container(by default placed after the page breadcrumbs)
                                        place: "append", // "append" or "prepend" in container 
                                        type: 'danger', // alert's type (success, danger, warning, info)
                                        message: result.message, // alert's message
                                        close: true, // make alert closable
                                        // reset: true, // close all previouse alerts first
                                        // focus: true, // auto scroll to the alert after shown
                                        closeInSeconds: 4 // auto close after defined seconds
                                        // icon: "warning" // put icon before the message
                                    });
                                }
                            },
                            error: function (result, status, e) {
                                console.log(errorThrown);
                                console.log("Hiba történt: " + textStatus);
                                console.log("Rendszerválasz: " + xhr.responseText);
                            }
                        });

                    }
                });

            } else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow);
                nEditing = nRow;
            }
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleTable();
        }

    };

}();

jQuery(document).ready(function () {
    DatatableLists.init();
});