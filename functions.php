<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'MCG_THEME_NAME', 'Materialize Genesis' );
define( 'MCG_THEME_URL', 'http://www.superfastbusiness.com/' );
define( 'MCG_THEME_VERSION', '0.0.1' );
define( 'MCG_THEME_LIB', CHILD_DIR . '/lib/' );
define( 'MCG_THEME_JS', CHILD_URL . '/js/' );
define( 'MCG_THEME_STYLESHEET', CHILD_URL . '/css/' );

// Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

// Add Accessibility support
add_theme_support( 'genesis-accessibility', array( 'headings', 'drop-down-menu',  'search-form', 'skip-links', 'rems' ) );

// Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom background
add_theme_support( 'custom-background' );

// Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

// Structural Wraps
	add_theme_support( 'genesis-structural-wraps', array(
		'header',
		'menu-primary',
		'menu-secondary',
		'site-inner',
		'footer-widgets',
		'footer'
	) );

// Move Sidebar Secondary After Content
remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_get_sidebar_alt' );
add_action( 'genesis_after_content', 'genesis_get_sidebar_alt' );

// Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'mcg_google_fonts' );
function mcg_google_fonts() {
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Material+Icons', array(), MCG_THEME_VERSION );
}

remove_theme_support( 'genesis-menus' );
add_theme_support( 'genesis-menus', array(
	'primary' => __( 'Primary Navigation Menu', 'bfg' ),
	'mobile' => __( 'Mobile Navigation Menu', 'bfg' )
) );

// Include php files from lib folder
// @link https://gist.github.com/theandystratton/5924570
foreach ( glob( dirname( __FILE__ ) . '/lib/*.php' ) as $file ) { 
	include $file; 
}
