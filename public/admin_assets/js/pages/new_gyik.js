var NewGyik = function () {

    /**
     *	Form validátor
     */
    var handleValidation = function () {
        console.log('start handleValidation');
        // for more info visit the official plugin documentation: 
        // http://docs.jquery.com/Plugins/Validation

        var form1 = $('#new_gyik');
        var error1 = $('.alert-danger', form1);
        var error1_span = $('.alert-danger > span', form1);
        var success1 = $('.alert-success', form1);
        //var success1_span = $('.alert-success > span', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: "input[name='img']",
            rules: {
                gyik_title: {
                    required: true
                },
                gyik_category_id: {
                    required: true
                }

            },
            // az invalidHandler akkor aktiválódik, ha elküldjük a formot és hiba van
            invalidHandler: function (event, validator) { //display error alert on form submit              

                //success1.hide();
                var errors = validator.numberOfInvalids();
                error1_span.html(errors + ' mezőt nem megfelelően töltött ki!');
                error1.show();
                error1.delay(3000).slideUp(750);
            },
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group 

                //menü cím színének megvátoztatása
                var tab_id = $(element).closest('.tab-pane').attr('id');
                $(".nav-tabs li a[href='#" + tab_id + "']").css('color', '#a94442');
                //$(".nav-tabs li a[href='#" + tab_id + "']").addClass('has-error');

            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group                   
            },
            success: function (label) {
                console.log('success');
                //label.closest('.form-group').removeClass('has-error').addClass("has-success"); // set success class to the control group
                label.closest('.form-group').removeClass('has-error'); // set success class to the control group
            },
            submitHandler: function (form) {
                //console.log('submitHandler');
                error1.hide();
                //success1.show();
                Metronic.blockUI({
                    boxed: true,
                    message: 'Feldolgozás...'
                });
                //adatok elküldése "normál" küldéssel
                window.setTimeout(function () {
                    form.submit();
                }, 500);
            }
        });
    }


/*
    var ckeditorInit = function () {
        CKEDITOR.replace('gyik_description', {customConfig: 'config_custom3.js'});
    }
*/

    return {
        //main function to initiate the module
        init: function () {
            handleValidation();
            
            //ckeditorInit();

            vframework.hideAlert();

            vframework.ckeditorInit({
                gyik_description: "config_custom3"
            });


        }
    };


}();


jQuery(document).ready(function () {
    NewGyik.init();
});