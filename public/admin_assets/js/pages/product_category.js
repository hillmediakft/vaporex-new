var Product_category = function () {

    var productCategoryTable = function () {

        var table = $('#product_category');

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

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columnDefs": [
                {"orderable": false, "searchable": false, "targets": 0},
                {"orderable": true, "searchable": true, "targets": 1},
                {"orderable": true, "searchable": true, "targets": 2},
                {"orderable": true, "searchable": true, "targets": 3},
                {"orderable": false, "searchable": false, "targets": 4}
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
     
    }

   var deleteOneProductCategoryConfirm = function () {
        $('[id*=delete_product_category]').on('click', function (e) {
            e.preventDefault();
            var deleteLink = $(this).attr('href');
            //var productName = $(this).closest("tr").find('td:nth-child(3)').text();

            bootbox.setDefaults({
                locale: "hu",
            });

            bootbox.confirm("Biztosan törölni akarja a kategóriát?", function (result) {
                if (result) {
                    window.location.href = deleteLink;
                }
            });

        });
    }

    var handleTree = function () {

        $('#tree_1').jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                }            
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder icon-state-warning icon-lg"
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                }
            },
            "plugins": ["types"]
        });

        // handle link clicks in tree nodes(support target="_blank" as well)
        $('#tree_1').on('select_node.jstree', function(e,data) { 
            var link = $('#' + data.selected).find('a');
            if (link.attr("href") != "#" && link.attr("href") != "javascript:;" && link.attr("href") != "") {
                if (link.attr("target") == "_blank") {
                    link.attr("href").target = "_blank";
                }
                document.location.href = link.attr("href");
                return false;
            }
        });
    }    

    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            productCategoryTable();
            deleteOneProductCategoryConfirm();
            handleTree();
            
            vframework.hideAlert();
        }

    };

}();

$(document).ready(function () {
    Product_category.init(); // init product category page
});