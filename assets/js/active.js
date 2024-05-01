jQuery(document).ready(function($){
	"use strict";
	(function ($) {
							
/*--
        Menu Sticky
    -----------------------------------*/
    var $window = $(window);
    $window.on('scroll', function() {
        var scroll = $window.scrollTop();
        if (scroll < 300) {
            $(".header-sticky").removeClass("stick");
        }else{
            $(".header-sticky").addClass("stick");
        }
    });

	})(jQuery);
});
		