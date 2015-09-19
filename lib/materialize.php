<?php
add_filter( 'genesis_attr_structural-wrap', 'mcg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_title-area', 'mcg_add_markup_class', 10, 2 );
function mcg_add_markup_class( $attr, $context ) {
	$classes_to_add = apply_filters( 'mcg_classes_to_add', array(
		'structural-wrap' => 'container',
		'title-area' => is_active_sidebar( 'header-right' ) ? 'col s12 m4' : 'col s12',
	), $context, $attr );
	
	$value = isset( $classes_to_add[ $context ] ) ? $classes_to_add[ $context ] : array();
	
	if ( is_array( $value ) ) {
		$classes_array = $value;
	} else {
		$classes_array = explode( ' ', (string) $value );
	}
	
	$classes_array = apply_filters( 'mcg_add_class', $classes_array, $context, $attr );
	
	$classes_array = array_map( 'sanitize_html_class', $classes_array );
	
	$attr['class'] .= ' ' . implode( ' ', $classes_array );
	
	return $attr;
}

// Add row after wrap
add_filter( 'genesis_structural_wrap-header', 'mcg_filter_structural_wrap', 10, 2 );
// add_filter( 'genesis_structural_wrap-menu-primary', 'mcg_filter_structural_wrap', 10, 2 );
function mcg_filter_structural_wrap( $output, $original_output ) {
	switch( $original_output ) {
		case 'close':
			$output = '</div>' . $output;
			break;
		case 'open':
			$output = $output . '<div class="row">';	
			break;
		default:
			break;
	}
	
	return $output;
}

add_filter( 'genesis_structural_wrap-menu-primary', 'mcg_filter_menu_wrap', 10, 2 );
function mcg_filter_menu_wrap( $output, $original_output ) {
	switch( $original_output ) {
		case 'open':
			$output = str_replace( 'class="wrap', 'class="nav-wrapper wrap', $output );
			break;
		default:
			break;
	}
	return $output;
}