var SbCookieFunctions = (function($, window, undefined) {
    'use strict';
    var $path = '/';

   if(sbcookie_data.wpmu_path != '' && sbcookie_data.wpmu_path != undefined) {
		$path = sbcookie_data.wpmu_path;
	}

	function createCookie() {
		var today = new Date(), 
			expire = new Date(today.getTime() + (24 * 60 * 360 * 360 * 2000)),			
			cookiestring = "SbCookie=Allow; expires=" + expire.toUTCString() + "; path="+$path;
		
		document.cookie = cookiestring;
		$(".cc-window").fadeOut("fast");
	}

	function deleteCookies() {
		var cookiesList = document.cookie.split(";");
		cookiesList.forEach(function(c) { 
			document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path="+$path); 
		});
		window.location.reload();
	}

	function getCookie(cname) {
		var name = cname + "=";
		var decodedCookie = decodeURIComponent(document.cookie);
		var ca = decodedCookie.split(';');
		for(var i = 0; i <ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}

	return {      
        createCookie: createCookie,
        deleteCookies: deleteCookies,
        getCookie: getCookie
    };
}(jQuery, window));

jQuery(document).ready(function($){	

	var cookies = document.cookie.split(";");
	var SbCookie = sbcookie_data.SbCookie;		
	var autoBlock = sbcookie_data.autoBlock;
	var current_lang = sbcookie_data.current_lang;

	var sessionCookies = sessionStorage.getItem("SbSessionCookie");

	if(sessionCookies == 'deny') {
		$(".cc-window").hide();	
		$('body').removeClass('cookies-pp');
		 $('body').removeClass('sb_cookie_top');
	  	$('body').removeClass('sb_cookie_bottom');
	}

	// Navigation Consent
	

	// Accept Button
	$(document).on('click', '#sb_cook_accept', function () {
		$('body').removeClass('cookies-pp');
	 	$('body').removeClass('sb_cookie_top');
	  	$('body').removeClass('sb_cookie_bottom');
		SbCookieConsent();
	});

	if ( SbCookieFunctions.getCookie('SbCookie') === "Allow" ) {
	  	$(".cc-window").hide();
	  	$('body').removeClass('cookies-pp');
	  	$('body').removeClass('sb_cookie_top');
	  	$('body').removeClass('sb_cookie_bottom');
	} else {
		var cookiesList = document.cookie.split(";");
		cookiesList.forEach(function(c) { 
			if(!c.indexOf('woocommerce_')) {
				document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/"); 
			}
		});
	}

	if ( SbCookie == 1 ) {
		SbCookieFunctions.createCookie();
	}

	$(document).on('click', '#sb_cook_deny', function () {
		// set deny session on browser
		sessionStorage.setItem("SbSessionCookie", 'deny');
		SbCookieFunctions.deleteCookies();
		window.location.reload();
	});


	function SbCookieConsent() {		
		SbCookieFunctions.deleteCookies()
		SbCookieFunctions.createCookie();
		if (autoBlock == 1) {
			window.location.reload();
		}
	}
	

	
		if(sessionCookies !='deny' && document.cookie.indexOf('SbCookie') < 0 ) {
			jQuery.ajax({
				type: 'POST',
				url: ajax_postajax.ajaxurl,
				data: {					
					action: 'get_cookie_bar',	
					lang : current_lang
				},
				success: function(data) {
					jQuery('.cookie_loading').html(data);
				}				
			});
		}


}(jQuery));

jQuery(window).load(function($){
	setTimeout(function() {
		if ( SbCookieFunctions.getCookie('SbCookie') !== "Allow" ) {
			var cookiesList = document.cookie.split(";");
			cookiesList.forEach(function(c) {
				if(!c.indexOf('woocommerce_')) {
				document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/"); 
			}
			});
		}
	}, 2000);
}(jQuery));
