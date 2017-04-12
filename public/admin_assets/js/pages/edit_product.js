var EditProduct = function () {

    var cropProductPhoto = function () {
        var userPhoto = $('#product_image');
        userPhoto.css("width", '402px').css("height", '302px');
        var cropperOptions = {
            //kérés a user_img_upload metódusnak "upload" paraméterrel
            uploadUrl: 'admin/products/product_crop_img_upload/upload',
            //kérés a user_img_upload metódusnak "crop" paraméterrel
            cropUrl: 'admin/products/product_crop_img_upload/crop',
            outputUrlId: 'OutputId',
            modal: false,
            doubleZoomControls: false,
            rotateControls: false,
            loaderHtml: '<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> '
        }
        var cropperHeader = new Croppic('product_image', cropperOptions);
    }

    var handle_oldImg = function () {
        var oldImg = $('#old_img').val();
        $('#product_image').css('background-image', 'url(' + oldImg + ')');
    }

    var ckeditorInit = function () {
        CKEDITOR.replace('product_description', {customConfig: 'config_minimal1.js'});
    };

    return {
        //main function to initiate the module
        init: function () {
            cropProductPhoto();
            handle_oldImg();
            ckeditorInit();
            vframework.hideAlert();
        }
    };


}();

jQuery(document).ready(function () {
    EditProduct.init();
});