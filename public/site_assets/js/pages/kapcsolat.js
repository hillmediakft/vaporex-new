var Kapcsolat = function () {

    var googleMaps = function () {
        
        var myLatLng = {lat: 47.501191, lng: 19.007794};

        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            scrollwheel: false,
            zoom: 16
        });

        // Create a marker and set its position.
        var marker = new google.maps.Marker({
            map: map,
            position: myLatLng,
            title: 'Vaporex'
        });
    }

    var contactFormValidation = function () {
        // contact form
        if ($('#contactform').length) {
            $('#contactform').bootstrapValidator({
                excluded: [':disabled'],
                feedbackIcons: {
//            required: 'glyphicon glyphicon-asterisk',
                    valid: 'glyphicon glyphicon-ok',
//            invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'A név nem lehet üres!'
                            },
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Az e-mail megadása kötelező!'
                            },
                            emailAddress: {
                                message: 'Az e-mail cím nem megfelelő formátumú!'
                            }
                        }
                    },
                    message: {
                        validators: {
                            notEmpty: {
                                message: 'Az üzenet nem lehet üres!'
                            },
                        }
                    }



                },
                onSuccess: function (e) {
                    // Prevent form submission
                    e.preventDefault();

                    var action = $('#contactform').attr('action');

                    $('#ajax_message').hide();

                    $('#submit_button').after('<img src="public/site_assets/image/ajax-loader.gif" class="loader" />');
                    $('#submit_contact').attr('disabled', 'disabled');
                    $.ajax({
                        type: "POST",
                        url: action, //put the url of your php file here
                        data: $('#contactform').serialize(),
                        success: function (data) {

                            document.getElementById('ajax_message').innerHTML = data;
                            $('#ajax_message').slideDown('slow');
                            $('#contactform img.loader').fadeOut('slow', function () {
                                $(this).remove()
                            });
                            $('#submit_contact').removeAttr('disabled');
                            $('.form-group').removeClass('has-success');
                            $('#ajax_message').delay(7500).slideUp(700);
                            $('#name').val('');
                            $('#email').val('');
                            $('#message').val('');


                        }
                    });
                }
                // on success vége

            });
        }
    }


    return {
        //main function to initiate the module
        init: function () {
            googleMaps();
            contactFormValidation();

        }
    };

}();


jQuery(document).ready(function () {
    Kapcsolat.init();
});