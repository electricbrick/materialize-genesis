<?php
add_filter( 'genesis_attr_structural-wrap', 'mcg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_title-area', 'mcg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_content-sidebar-wrap', 'mcg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_content', 'mcg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_sidebar-primary', 'mcg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_sidebar-secondary', 'mcg_add_markup_class', 10, 2 );
function mcg_add_markup_class( $attr, $context ) {
	$classes_to_add = apply_filters( 'mcg_classes_to_add', array(
		'structural-wrap' => 'container',
		'title-area' => is_active_sidebar( 'header-right' ) ? 'col s12 m4' : 'col s12',
		'content-sidebar-wrap' => 'row',
		'content' => 'col s12 m8',
		'sidebar-primary' => 'col s12 m4',
		'sidebar-secondary' => 'col s12 m2'
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

// Layout
// modify bootstrap classes based on genesis_site_layout
add_filter('mcg_classes_to_add', 'mcg_modify_classes_based_on_template', 10, 3);

function mcg_modify_classes_based_on_template( $classes_to_add, $context, $attr ) {
    $classes_to_add = mcg_layout_options_modify_classes_to_add( $classes_to_add );

    return $classes_to_add;
}

// remove unused layouts
function mcg_layout_options_modify_classes_to_add( $classes_to_add ) {
    $layout = genesis_site_layout();

    // content-sidebar          // default

    // full-width-content       // supported
    if ( 'full-width-content' === $layout ) {
        $classes_to_add['content'] = 'col s12';
    }

    // sidebar-content          // supported
    if ( 'sidebar-content' === $layout ) {
        $classes_to_add['content'] = 'col s12 m8 right';
        $classes_to_add['sidebar-primary'] = 'col s12 m4 left';
    }

    // content-sidebar-sidebar  // supported
    if ( 'content-sidebar-sidebar' === $layout ) {
        $classes_to_add['content'] = 'col s12 m6';
        $classes_to_add['sidebar-primary'] = 'col s12 m4';
        $classes_to_add['sidebar-secondary'] = 'col s12 m2';
    }


    // sidebar-sidebar-content  // supported
    if ( 'sidebar-sidebar-content' === $layout ) {
        $classes_to_add['content'] = 'col s12 m6 right';
        $classes_to_add['sidebar-primary'] = 'col s12 m4 right';
        $classes_to_add['sidebar-secondary'] = 'col s12 m2 left';
    }


    // sidebar-content-sidebar  // supported
    if ( 'sidebar-content-sidebar' === $layout ) {
        $classes_to_add['content'] = 'col s12 m6';
        $classes_to_add['sidebar-primary'] = 'col s12 m4';
        $classes_to_add['sidebar-secondary'] = 'col s12 m2';
    }

    return $classes_to_add;
};