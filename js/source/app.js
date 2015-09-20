(function($){
	$(document).ready(function(){
		$(".dropdown-button").dropdown({
			hover: false
		});
	});
	
	// Window load event with minimum delay
	// @https://css-tricks.com/snippets/jquery/window-load-event-with-minimum-delay/
	(function fn() {
		fn.now = +new Date;
		$(window).load(function() {
			if (+new Date - fn.now < 100) {
				setTimeout(fn, 100);
			}
		})
	})();	
})(jQuery);