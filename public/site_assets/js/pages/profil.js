var Profil = function () {

    var copyAddress = function () {
        console.log('copy init');
        delivery_address = $('input[name="delivery_address"]');
        console.log(delivery_address);
        $('#copy_address').on('click', function () {
            
            console.log(delivery_address.val());
            if (delivery_address.val() != '') {
                $('input[name="invoice_address"]').val(delivery_address.val());
            }
        });
    };

    var formValidation = function () {
        // contact form
        form = $('#edit_user_form');
        if (form.length) {
            console.log('validator indul');
            form.bootstrapValidator({
                excluded: [':disabled'],
                feedbackIcons: {
//            required: 'glyphicon glyphicon-asterisk',
                    valid: 'glyphicon glyphicon-ok',
//            invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    user_name: {
                        validators: {
                            notEmpty: {
                                message: 'A név nem lehet üres!'
                            },
                        }
                    },
                    user_email: {
                        validators: {
                            notEmpty: {
                                message: 'Az e-mail megadása kötelező!'
                            },
                            emailAddress: {
                                message: 'Az e-mail cím nem megfelelő formátumú!'
                            }
                        }
                    }
                },
                onSuccess: function (e) {
                    console.log('validator ok');
                    // Prevent form submission
                    e.preventDefault();
                    var action = form.attr('action');
                    $('#edit_user_submit').attr('disabled', 'disabled');

                    $.ajax({
                        type: "POST",
                        url: action, //put the url of your php file here
                        data: form.serialize(),
                        beforeSend: function () {
                            //$('#submit-button').addClass('disabled');
                            $('#edit_user_submit').addClass('button-loading');
                        },
                        success: function (data) {
                            setTimeout(function () {
                                $('#ajax_message').html(data);
                                $('#edit_user_submit').removeClass('button-loading');
                                $('#edit_user_submit').removeAttr('disabled');
                            }, 300);
                            window.location.href = 'profil';
                        }
                    });
                }
                // on success vége

            });
        }
    }

    var hideAlert = function () {
        $('div.alert').delay(2500).slideUp(750);
    }
    return {
        //main function to initiate the module
        init: function () {
            copyAddress();
            hideAlert();
            formValidation();
        }
    };


}();


jQuery(document).ready(function ($) {
    Profil.init();
});