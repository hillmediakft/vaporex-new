var projectCategory = function () {

    var projectsCategoryTable = function () {

        var table = $('#projects_category');


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


       //     "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            // set default column settings
            "columnDefs": [
                {"orderable": true, "searchable": true, "targets": 0},
                {"orderable": true, "searchable": true, "targets": 1},
                {"orderable": false, "searchable": false, "targets": 2}
            ],


            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "Összes"] // change per page values here
            ],
            // set the initial value
            "pageLength": 15,

            "pagingType": "bootstrap_full_number",

            "order": [
                [0, "asc"]
            ] // set column as a default sort by asc

        });

    }

    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            projectsCategoryTable();

            vframework.deleteItems({
                table_id: "projects_category",
                url: "admin/projects/category_delete"
            });

            vframework.hideAlert();
        }

    };

}();

$(document).ready(function () {
    projectCategory.init(); // init projects category page
});