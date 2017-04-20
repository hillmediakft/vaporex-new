var Profil = function () {

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
            console.log('validator indul');
        if (form.length) {
            form.bootstrapValidator({
                excluded: [':disabled'],
                feedbackIcons: {
                    // required: 'glyphicon glyphicon-asterisk',
                    valid: 'glyphicon glyphicon-ok',
                    // invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                    
                    //valid: 'fa fa-check',
                    //invalid: 'fa fa-times',
                    //validating: 'fa fa-refresh'
                },
                fields: {
                    user_name: {
                        validators: {
                            notEmpty: {
                                message: 'A név nem lehet üres!'
                            },
                            regexp: {
                                regexp:  /^[\_\sa-záöőüűóúéíÁÖŐÜŰÓÚÉÍ\d]{2,64}$/i,
                                message: 'A felhasználó név minimum 2, maximum 64 karakter hosszú lehet, kis- és nagybetűket, szóközt és ékezetes karaktereket tartalmazhat!'
                            }
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
                    },
                    user_password: {
                        validators: {
                            identical: {
                                field: 'user_password_again',
                                message: 'A jelszó és megerősítése nem azonos!'
                            }
                        }
                    },
                    user_password_again: {
                        validators: {
                            identical: {
                                field: 'user_password',
                                message: 'A jelszó és megerősítése nem azonos!'
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
                        dataType: 'json',
                        data: form.serialize(),
                        beforeSend: function () {
                            //$('#submit-button').addClass('disabled');
                            $('#edit_user_submit').addClass('button-loading');
                        },
                        success: function (result) {

                            setTimeout(function () {
                                //$('#ajax_message').html(result);
                                $('#edit_user_submit').removeClass('button-loading');
                                $('#edit_user_submit').removeAttr('disabled');
                            }, 300);

                            if (result.status == 'success') {
                                //toastr['success'](result.message);
                                //$('#logged_in_user_name').html(result.new_name);
                                window.location.href = 'profil';

                            }
                            else if (result.status == 'error')  {
                                toastr['error'](result.message);
                            }
       

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