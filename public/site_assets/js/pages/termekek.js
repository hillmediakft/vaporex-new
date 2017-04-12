var Termekek = function () {

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
                success: function (data) {
                    setTimeout(function () {
                        $('#ajax_message').html(data);
                        $('#add_to_cart_button').removeClass('button-loading');
                        $('#add_to_cart_button').removeAttr('disabled');
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