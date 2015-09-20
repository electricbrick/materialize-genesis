<?php
add_action( 'wp_enqueue_scripts', 'mcg_theme_scripts' );
function mcg_theme_scripts() {
	// Remove superfish scripts
	wp_deregister_script( 'superfish' );
	wp_deregister_script( 'superfish-args' );
	
	// Register theme scripts
	wp_register_script( 'mcg-vendor-js', MCG_THEME_JS . 'vendor.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'mcg-vendor-js' );
	
	wp_register_script( 'mcg-app-js', MCG_THEME_JS . 'app.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'mcg-app-js' );
}

//Making jQuery to load from Google Library
function replace_jquery() {
	if (!is_admin()) {
		// comment out the next two lines to load the local copy of jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', false, '2.1.4');
		wp_enqueue_script('jquery');
	}
}
add_action('init', 'replace_jquery');