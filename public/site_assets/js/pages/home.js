var Home = function () {

    var equalHeights = function () {
        setTimeout(function () {
            $('.product-grid div.product-container').equalHeights();
        }, 200);
    };

    return {
        //main function to initiate the module
        init: function () {
            equalHeights();
        }
    };


}();


jQuery(document).ready(function ($) {
    Home.init();
});