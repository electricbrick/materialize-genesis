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

// Filter WP Navigation
add_filter( 'wp_nav_menu', 'mcg_nav_menu_markup_filter', 10, 2 );
function mcg_nav_menu_markup_filter( $html, $args ) {
	if ( 'primary' !== $args->theme_location && 'secondary' !== $args->theme_location )
		return;

	$data_target = "mobile" . sanitize_html_class( '-' . $args->theme_location );

	$output = '<a href="#" data-activates="'.$data-target.'" class="button-collapse"><i class="material-icons">menu</i></a>';

	if ( 'primary' == $args->theme_location )
		$output .= apply_filters( 'mcg_navbar_brand', mcg_navbar_brand_markup() );

	$output .= $html;

	$output .= '';

	return $output;
}

function mcg_navbar_brand_markup() {
	$output = '<a class="brand-logo" id="logo" title="'.esc_attr( get_bloginfo( 'description' ) ).'" href="'.esc_url( home_url( '/' ) ).'">';
	$output .= get_bloginfo( 'name' );
	$output .= '</a>';

	return $output;
}