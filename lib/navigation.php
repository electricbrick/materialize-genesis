<?php
// Move navigation after header
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before', 'genesis_do_nav' );

// filter menu args for bootstrap walker and other settings
add_filter( 'wp_nav_menu_args', 'mcg_nav_menu_args_filter', 10, 2 );
function mcg_nav_menu_args_filter( $args ) {
	require_once( MCG_THEME_LIB . 'classes/bootstrap-walker.php' );
	
	if ( 'primary' === $args['theme_location'] || 'mobile' === $args['theme_location'] ) {
		$args['container'] = '';
		$args['items_wrap'] = '<ul id="%1$s" class="right hide-on-med-and-down %2$s">%3$s</ul>';
		$args['fallback_cb'] = 'wp_bootstrap_navwalker::fallback';
        $args['walker'] = new wp_bootstrap_navwalker();
	}
	
	if ( 'mobile' === $args['theme_location'] ) {
		$args['items_wrap'] = '<ul id="%1$s" class="side-nav %2$s">%3$s</ul>';
	}
	
	return $args;
}

// Filter WP Navigation
add_filter( 'wp_nav_menu', 'mcg_nav_menu_markup_filter', 10, 2 );
function mcg_nav_menu_markup_filter( $html, $args ) {
	// if ( 'primary' !== $args->theme_location && 'secondary' !== $args->theme_location )
		// return;

	$data_target = "mobile-navigation";
	
	// $nav = $html;

	if ( 'primary' == $args->theme_location ) {
		$output = '<a href="#" data-activates="'.$data_target.'" class="button-collapse"><i class="material-icons">menu</i></a>';
		$output .= apply_filters( 'mcg_navbar_brand', mcg_navbar_brand_markup() );
	}
	
	$output .= $html;
	// $output .= $html;
	// $output .= str_replace( 'id="menu-primary-navigation" class="right hide-on-med-and-down', 'id="mobile-primary" class="side-nav ', $html );
	
	return $output;
}

function mcg_navbar_brand_markup() {
	// if ( 'primary' == $args->theme_location ) {
		$output = '<a class="brand-logo" id="logo" title="'.esc_attr( get_bloginfo( 'description' ) ).'" href="'.esc_url( home_url( '/' ) ).'">';
		$output .= get_bloginfo( 'name' );
		$output .= '</a>';
	// }
	return $output;
}