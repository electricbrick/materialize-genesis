<?php
// Move navigation after header
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_header', 'genesis_do_nav' );

// filter menu args for bootstrap walker and other settings
add_filter( 'wp_nav_menu_args', 'mcg_nav_menu_args_filter', 10, 2 );

function mcg_nav_menu_args_filter( $args ) {
	require_once( MCG_THEME_LIB . 'classes/bootstrap-walker.php' );
	
	if ( 'primary' === $args['theme_location'] || 'secondary' === $args['theme_location'] ) {
		$args['container'] = '';
		$args['items_wrap'] = '<ul id="%1$s" class="right hide-on-med-and-down %2$s">%3$s</ul>';
		$args['fallback_cb'] = 'wp_bootstrap_navwalker::fallback';
        $args['walker'] = new wp_bootstrap_navwalker();
	}
	
	return $args;
}