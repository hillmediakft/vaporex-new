var Termekek = function () {

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "8000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    var equalHeights = function () {
        setTimeout(function () {
            $('.product-grid div.product-container').equalHeights();
        }, 200);
    };

    var metisMenu = function () {
        $("#menu").metisMenu();
    };
    
    var submitCartForm = function () {
        $('#add_to_cart_form').submit(function (e) {
            // Prevent form submission
            e.preventDefault();
            var action = $('#add_to_cart_form').attr('action');
            $('#submit-button').attr('disabled', 'disabled');

            $.ajax({
                type: "POST",
                url: action, //put the url of your php file here
                data: $('#add_to_cart_form').serialize(),
                beforeSend: function () {
                    //$('#submit-button').addClass('disabled');
                    $('#add_to_cart_button').addClass('button-loading');
                },
                success: function (result) {
                    setTimeout(function () {
                        toastr['success'](result.message);
                        $('#add_to_cart_button').removeClass('button-loading');
                        $('#add_to_cart_button').removeAttr('disabled');
                        // kosár elemszám módosítása a fejlécben
                        $('#cart_items_number').html(result.items_number);
                    }, 300);
                }

            });

        });
    }    

    return {
        //main function to initiate the module
        init: function () {
            equalHeights();
            metisMenu();
            submitCartForm();
        }
    };


}();


jQuery(document).ready(function ($) {
    Termekek.init();
});