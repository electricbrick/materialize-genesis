(function($){
	$(document).ready(function(){
		var $width = document.documentElement.clientWidth;
		// Dropdown
		
		
		var windowResize = function() {
			if ( $width > 767 )	{
				$(".dropdown-button").dropdown({
					hover: false
				});		
			}
		};
		
		$(window).resize(windowResize);
		
		windowResize();
		
		// Side Navigation
		$(".button-collapse").sideNav();
	});
	
	// Window load event with minimum delay
	// @https://css-tricks.com/snippets/jquery/window-load-event-with-minimum-delay/
	(function fn() {
		fn.now = +new Date;
		$(window).load(function() {
			if (+new Date - fn.now < 100) {
				setTimeout(fn, 100);
			}
		});
	})();	
})(jQuery);