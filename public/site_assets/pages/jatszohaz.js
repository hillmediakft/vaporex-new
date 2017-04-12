var jatszohaz = function () {

    var initMap = function () {
        var iw1, latlng, map, marker, options;

        var default_item = $('#map-infos');

        var latitude = default_item.attr('data-lat');
        var longitude = default_item.attr('data-lng');
        var location = default_item.attr('data-location');
        var address = default_item.attr('data-address');

        latlng = new google.maps.LatLng(latitude, longitude);
        options = {
            scrollwheel: false,
            zoom: 15,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: true
        };

        map = new google.maps.Map(document.getElementById("map-canvas"), options);

        marker = new google.maps.Marker({
            position: latlng,
            map: map
        });

        iw1 = new google.maps.InfoWindow({
            content: location + '<br>' + address
        });

        return google.maps.event.addListener(marker, "click", function (e) {
            return iw1.open(map, this);
        });
    };
    var scrollToMap = function () {
        $("#scroll_to_map").click(function () {
            $('html, body').animate({
                scrollTop: $("#map-box").offset().top-120
            }, 2000);
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            initMap();
            scrollToMap();
        }
    };
}();

$(document).ready(function () {

    jatszohaz.init();


});