var Kosar = function () {

    var felhasznalas_celja_selected;

    var get_faltipus = function () {

        output = '<div class="form-group well" id="faltipus">';
        output += '<label for="felhcel">Falazat típusa:</label>';
        output += '<div class="radio"><label><input type="radio" name="tipus" value="1" required/>tégla </label></div>';
        output += '<div class="radio"><label><input type="radio" name="tipus" value="2" />vályog</label></div>';
        output += '<div class="radio"><label><input type="radio" name="tipus" value="3" />vegyes</label></div>';
        output += '<div class="radio"><label><input type="radio" name="tipus" value="4" />beton</label></div>';
        output += '</div>';
        return output;
    };

    var get_esos = function () {
        console.log('get_esos');
        output = '<div class="form-group well" id="esos">';
        output += '<label for="esohely">Falazat elhelyezkedése:</label>';
        output += '<div class="radio"><label><input type="radio" name="esohely" value="1" required/>csapó esőnek jobban kitett oldal</label></div>';
        output += '<div class="radio"><label><input type="radio" name="esohely" value="2" />csapó esőnek kevésbé kitett oldal</label></div>';
        output += '</div>';
        return output;
    };

    function get_felhhelye() {
        output = '<div class="form-group well" id="felhhelye">';
        output += '<label for="hely">Felhasználás helye:</label>';
        output += '<div class="radio"><label><input type="radio"  name="hely" value="1" required/>falazat</label></div>';
        output += '<div class="radio labazat"><label><input type="radio" name="hely" value="2" />lábazat</label></div>';
        output += '<div class="radio pince"><label><input type="radio" name="hely" value="3" />pince</label></div>';
        output += '</div>';
        return output;

    }
    function get_felhhelye2() {
        output = '<div class="form-group well" id="felhhelye2">';
        output += '<label for="hely2">Felhasználás helye:</label>';
        output += '<div class="radio"><label><input type="radio" name="hely2" value="1" required/>falazat</label></div>';
        output += '<div class="radio"><label><input type="radio" name="hely2" value="2" />lábazat</label></div>';
        output += '</div>';
        return output;
    }

    function get_kulter_belter() {
        output = '<div class="form-group well" id="kulter_belter">';
        output += '<label for="kulter_belter">Kültér vagy beltér vakolása:</label>';
        output += '<div class="radio"><label><input type="radio" name="kulter_belter" value="1" required/>kültér</label></div>';
        output += '<div class="radio"><label><input type="radio" name="kulter_belter" value="2" />beltér</label></div>';
        output += '</div>';
        return output;
    }

    function get_falszarito() {
        output = '<div class="form-group well" id="falszarito">';
        output += '<label for="falszarito">A vakolat legyen:</label>';
        output += '<div class="radio"><label><input type="radio" name="falszarito" value="1" required/>falszárító</label></div>';
        output += '<div class="radio"><label><input type="radio" name="falszarito" value="2" />falszárító és víztaszító</label></div>';
        output += '</div>';
        return output;
    }

    function get_csakkul() {
        output = '<div class="form-group well" id="csakkul">';
        output += '<label for="csakkul">Kültér vagy beltér vakolása:</label>';
        output += '<div class="radio"><label><input type="radio" name="kulter_belter" value="1" checked />kültér</label></div>';
        output += '</div>';
        return output;
    }
    function show_csakbel() {
        output = '<br />';
        output += '<strong>KĂźltĂŠr vagy beltĂŠr vakolĂĄsa:</strong>';
        output += '<br />';
        output += '<input type="radio" name="kulter_belter" value="2" checked />beltĂŠr';
        return output;
    }

    function get_nedvesseg() {
        output = '<div class="form-group well" id="falnedvesseg_erossege">';
        ;
        output += '<label for="falnedvesseg_erossege">Falnedvesség, illetve sókivirágzás (salétromosodás) foka:</label>';
        output += '<div class="radio"><label><input type="radio" name="falnedvesseg_erossege" value="1" required/>enyhe</label></div>';
        output += '<div class="radio"><label><input type="radio" name="falnedvesseg_erossege" value="2" />közepes</label></div>';
        output += '<div class="radio"><label><input type="radio" name="falnedvesseg_erossege" value="3" />erős</label></div>';
        output += '</div>';
        return output;
    }

    function get_terulet() {
        output = '<div class="form-group well" id="terulet">';
        output += '<div class="row">';
        output += '<label class="col-md-3" for="terulet" control-label">Felület nagysága (m<sup>2</sup>-ben megadva)</label>';
        output += '<div class="col-md-2"><input type="text" class="form-control" name="terulet" placeholder="terület m2" pattern="[0-9]+" required /></div>';
        output += '</div>';
        output += '</div>';
        return output;
    }

    function get_vakolat_vastagsag() {
        output = '<div class="form-group well" id="vakolat_vastagsag">';
        output += '<div class="row">';
        output += '<label class="col-md-3" for="vakolat_vastagsag" control-label">Vakolatvastagság cm-ben (ajánlott: minimum 2)</label>';
        output += '<div class="col-md-2"><input type="text" class="form-control" name="vakolat_vastagsag" placeholder="vastagság cm" pattern="[0-9]+" required /></div>';
        output += '</div>';
        output += '</div>';
        return output;
    }

    function get_habarcs() {
        output = '<div class="form-group well" id="habarcs">';
        output += '<label for="kulter_belter">Miylen habarcshoz?</label>';
        output += '<div class="radio"><label><input type="radio" name="habarcs" value="1" required/>vakolóhabarcshoz</label></div>';
        output += '<div class="radio"><label><input type="radio" name="habarcs" value="2" />ágyazó/falazóhabarcshoz</label></div>';
        output += '</div>';
        return output;
    }

    function get_keveroviz() {
        output = '<div class="form-group well" id="keveroviz">';
        output += '<label for="kulter_belter">Felhasználás célja</label>';
        output += '<div class="radio"><label><input type="radio" name="keveroviz" value="1" required/>fagyáspontcsökkentés</label></div>';
        output += '<div class="radio"><label><input type="radio" name="keveroviz" value="2" />jégmentesítés</label></div>';
        output += '</div>';
        return output;
    }

    function hideAll() {
        console.log('torles');
        console.log($('#kalkulator_html').find('div.well'));
        $('#kalkulator_html').find('div.well').slice(1).remove();
    }
    function hideAjaxMessage() {
        $('#kalkulator-valasz').remove();
    }
    var felhasznalas_celja_handler = function () {
        $('input[type=radio][name=felhcel]').change(function () {
            hideAjaxMessage();
            console.log('felhasznalas celja változott');
            if (this.value == '1') {
                hideAll();
                felhasznalas_celja_selected = 1;
                // kültér beltér megjelenítése
                $(get_kulter_belter()).appendTo('#kalkulator_html');
                // kültér beltér handler indítása
                kulter_belter_handler();
                // terület megjelenítése
                $(get_terulet()).appendTo('#kalkulator_html');
                $(get_vakolat_vastagsag()).appendTo('#kalkulator_html');
            }
            if (this.value == '2') {
                hideAll();
                felhasznalas_celja_selected = 2;
                // kültér beltér megjelenítése
                $(get_kulter_belter()).appendTo('#kalkulator_html');
                // kültér beltér handler indítása
                kulter_belter_handler();
                // terület megjelenítése
                $(get_nedvesseg()).appendTo('#kalkulator_html');
                $(get_terulet()).appendTo('#kalkulator_html');
                $(get_vakolat_vastagsag()).appendTo('#kalkulator_html');
            }
            if (this.value == '3') {
                hideAll();
                $(get_habarcs()).appendTo('#kalkulator_html');
                $(get_terulet()).appendTo('#kalkulator_html');
            }
            if (this.value == '4') {
                hideAll();
                $(get_terulet()).appendTo('#kalkulator_html');
            }
            if (this.value == '5') {
                hideAll();
                $(get_terulet()).appendTo('#kalkulator_html');
            }
            if (this.value == '6') {
                hideAll();
                $(get_terulet()).appendTo('#kalkulator_html');
            }
            if (this.value == '7') {
                hideAll();
                $(get_keveroviz()).appendTo('#kalkulator_html');
                $(get_terulet()).appendTo('#kalkulator_html');
            }
        });
    }

    var kulter_belter_handler = function () {
        $('input[type=radio][name=kulter_belter]').change(function () {
            if (this.value == '1') {
                /* ******* felhasználás célja 1-es kiválasztva *** */
                if (felhasznalas_celja_selected == 1) {
                    if ($('#felhhelye').length) {
                        $('#felhhelye').replaceWith(get_felhhelye());

                        $('#felhhelye').find('.radio.pince').remove();

                        felhasznalas_helye_handler();
                    }
                    if (!$('#felhhelye').length) {
                        $(get_felhhelye()).insertBefore('#terulet');
                        $('#felhhelye').find('.radio.pince').remove();
                        if (!felhasznalas_helye_handler()) {
                            felhasznalas_helye_handler();
                        }
                    }
                    if (!$('#esos').length) {
                        $(get_esos()).insertAfter('#kulter_belter');

                    }
                    if ($('#falszarito').length) {
                        $('#falszarito').remove();
                    }
                }
                /* ******* felhasználás célja2-es kiválasztva *** */
                if (felhasznalas_celja_selected == 2) {
                    if ($('#felhhelye').length) {
                        $('#felhhelye').replaceWith(get_felhhelye());

                        $('#felhhelye').find('.radio.pince').remove();

                        felhasznalas_helye_handler();
                    }
                    if (!$('#felhhelye').length) {
                        $(get_felhhelye()).insertBefore('#terulet');
                        $('#felhhelye').find('.radio.pince').remove();
                        if (!felhasznalas_helye_handler()) {
                            felhasznalas_helye_handler();
                        }
                    }
                }
            }
            if (this.value == '2') {
                /* ******* felhasználás célja 1-es kiválasztva *** */
                if (felhasznalas_celja_selected == 1) {
                    console.log('belter');

                    if ($('#felhhelye').length) {
                        $('#felhhelye').replaceWith(get_felhhelye());
                        $('#felhhelye').find('.radio.labazat').remove();
                        felhasznalas_helye_handler();
                    }
                    if (!$('#felhhelye').length) {
                        $(get_felhhelye()).insertBefore('#terulet');
                        $('#felhhelye').find('.radio.labazat').remove();
                        if (!felhasznalas_helye_handler()) {
                            felhasznalas_helye_handler();
                        }
                    }

                    if (!$('#falszarito').length) {
                        $(get_falszarito()).insertBefore('#terulet');
                        ;
                    }
                    $('#faltipus').remove();
                    $('#esos').remove();
                }
                /* ******* felhasználás célja2-es kiválasztva *** */
                if (felhasznalas_celja_selected == 2) {


                    if ($('#felhhelye').length) {
                        $('#felhhelye').replaceWith(get_felhhelye());
                        $('#felhhelye').find('.radio.labazat').remove();
                        felhasznalas_helye_handler();
                    }
                    if (!$('#felhhelye').length) {
                        $(get_felhhelye()).insertBefore('#terulet');
                        $('#felhhelye').find('.radio.labazat').remove();
                        if (!felhasznalas_helye_handler()) {
                            felhasznalas_helye_handler();
                        }
                    }
                }
            }
        });
    }

    var felhasznalas_helye_handler = function () {
        console.log('felhasznalas_helye_handler');
        $('input[type=radio][name=hely]').change(function () {
            if (this.value === '1' || this.value === '2') {
                console.log('felhasznalas helye 1 kiválasztva' + $('#faltipus').length);
                //       show_faltipus();
                //       show_esos();
                if (felhasznalas_celja_selected == 2) {
                    if (!$('#faltipus').length) {
                        $(get_faltipus()).insertBefore('#terulet');
                    }
                }
                if (this.value === '2') {
                    $('#kulter_belter input[value=1]').prop('checked', true);
                }
                //       show_terulet();
            }
            if (this.value == '3') {
                console.log('pince');
                $('#faltipus').remove();
                $('#kulter_belter input[value=2]').prop('checked', true);
            }
        });
    }

    var submit_form = function () {
        $('#kalkulator_form').submit(function (e) {
            // Prevent form submission
            e.preventDefault();
            var action = $('#kalkulator_form').attr('action');
            $('#submit-button').attr('disabled', 'disabled');

            $.ajax({
                type: "POST",
                url: action, //put the url of your php file here
                data: $('#kalkulator_form').serialize(),
                beforeSend: function () {
                    //$('#submit-button').addClass('disabled');
                    $('#submit-button').addClass('button-loading');
                },
                success: function (data) {
                    setTimeout(function () {
                        $('#ajax_message').html(data);
                        $('#submit-button').removeClass('button-loading');
                        $('#submit-button').removeAttr('disabled');
                    }, 300);
                }
            });

        });
    }




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

    var clearCart = function(){
        $("#clear-cart-button").on('click', function(){
            console.log('kosár törlése');

            $.ajax({
                type: "POST",
                url: "kosar/clear", //put the url of your php file here
                //data: $('#dummy').serialize(),
                beforeSend: function () {
                    //$('#submit-button').addClass('disabled');
                    $('#clear-cart-button').addClass('button-loading');
                },
                success: function (result) {
                    setTimeout(function () {
                        toastr['success'](result.message);
                        //$('#ajax_message').html(data);
                        $('#clear-cart-button').removeClass('button-loading');
                        $('#clear-cart-button').removeAttr('disabled');
                        $('#cart_items_number').html(result.items_number);

                    }, 300);
                }
            });

        });
    }


    return {
        //main function to initiate the module
        init: function () {
            felhasznalas_celja_handler();
            submit_form();
            clearCart();
        }
    };
}();

jQuery(document).ready(function ($) {
    Kosar.init();
});