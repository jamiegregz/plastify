function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

// Check if the device is a touch screen, store true if it is
var isTouchDevice = 'ontouchstart' in document.documentElement;

// Navbar events
$(document).ready(function () {
    $("#menu-button").click(function () {
        if($(".menu-wrapper").offset().left == 0) {
            // Hide the sidebar, re-enable scrolling
            $(".menu-wrapper").animate({"left": "-100%"});
            document.ontouchmove = function(event){}
        } else {
            // Show the sidebar, disable scrolling
            $(".menu-wrapper").animate({"left": "0px"});
            document.ontouchmove = function(event){ event.preventDefault(); }
        }
    });
});
