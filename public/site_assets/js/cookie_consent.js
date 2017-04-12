   /**
     Cookie jóváhagyás
     **/
    var CookieConsent = function () {

        var dropCookie = true;                      // false disables the Cookie, allowing you to style the banner
        var cookieDuration = 14;                    // Number of days before the cookie expires, and the banner reappears
        var cookieName = 'cookieConsent';        // Name of our cookie
        var cookieValue = 'on';                     // Value of cookie

        var createDiv = function () {
            var bodytag = document.getElementsByTagName('body')[0];
            var div = document.createElement('div');
            div.setAttribute('id', 'cookie-law');
            div.innerHTML = '<p>Weboldalunk a jobb felhasználói élmény biztosítása érdekében sütiket (cookie) használ. A Weboldal használatával Ön beleegyezik a sütik használatába. <a id="cookie-button" class="cookie-banner btn btn-default" href="javascript:void(0);"><span>Értem</span></a></p>';
            // Be advised the Close Banner 'X' link requires jQuery

            // bodytag.appendChild(div); // Adds the Cookie Law Banner just before the closing </body> tag
            // or
            bodytag.insertBefore(div, bodytag.firstChild); // Adds the Cookie Law Banner just after the opening <body> tag
        }


        var createCookie = function (name, value, days) {
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                var expires = "; expires=" + date.toGMTString();
            } else
                var expires = "";
            if (dropCookie) {
                document.cookie = name + "=" + value + expires + "; path=/";
            }
        }

        var clickCookieButton = function () {
            $('#cookie-button').on('click', function (e) {
                e.preventDefault();
                createCookie(cookieName, cookieValue, cookieDuration); // Create the cookie
                $('#cookie-law').fadeOut('slow');
            });
        }

        return {
            //main function to initiate the module
            init: function () {
                if (document.cookie.indexOf("cookieConsent") < 0) {
                    createDiv();
                    clickCookieButton();
                }

            }
        };

    }();

    $(window).load(function () {
        CookieConsent.init();
    });


