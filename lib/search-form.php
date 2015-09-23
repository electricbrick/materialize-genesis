<?php
/**
 * Search Form
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://www.superfastbusiness.com
 * @author       SuperFastBusiness <www.superfastbusiness.com>
 * @copyright    Copyright (c) 2015, SuperFastBusiness
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

add_filter( 'genesis_search_form', 'mcg_search_form', 10, 4);

function mcg_search_form( $form, $search_text, $button_text, $label ) {
    $value_or_placeholder = ( get_search_query() == '' ) ? 'placeholder' : 'value';
$format = <<<EOT
<form method="get" class="search-form form-inline" action="%s" role="search">
	<div class="input-field">
		<input type="search" class="search-field" id="mcg-search-form" name="s" %s="%s">
		<label for="mcg-search-form"><i class="material-icons">search</i></label>
		<i class="material-icons">close</i>
	</div>
</form>
EOT;

    return sprintf( $format, home_url( '/' ), esc_html( $label ), $value_or_placeholder, esc_attr( $search_text ), esc_attr( $button_text ) );
}