var Gyik = function () {

    var gyikTable = function () {

        var table = $('#gyik');

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
                {"orderable": true, "searchable": true, "targets": 1},
                {"orderable": true, "searchable": true, "targets": 2},
                {"orderable": true, "searchable": true, "targets": 3},
                {"orderable": true, "searchable": true, "targets": 4},
                {"orderable": true, "searchable": true, "targets": 5},
                {"orderable": false, "searchable": false, "targets": 6}
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

    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            gyikTable();

            vframework.deleteItems({
                table_id: "gyik",
                url: "admin/gyik/delete"
            });

            vframework.changeStatus({
                url: "admin/gyik/change_status",
            });

            vframework.printTable({
                print_button_id: "print_gyik", // elem id-je, amivel elindítjuk a nyomtatást 
                table_id: "print_gyik",
                title: "Gyakran ismételt kérdések listája"
            });

            vframework.hideAlert();

        }

    };

}();

$(document).ready(function () {
    Gyik.init(); // init gyik page
});