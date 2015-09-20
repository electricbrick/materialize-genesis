<?php
// Comment Form
// @link http://www.codecheese.com/2013/11/wordpress-comment-form-with-twitter-bootstrap-3-supports/
add_filter( 'comment_form_defaults', 'mcg_comment_form_args' );
function mcg_comment_form_args( $args ) {
	$args['comment_field'] = '<div class="row"><div class="input-field col s12 comment-form-comment"> 
	        <textarea class="materialize-textarea" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
			<label for="comment">' . _x( 'Comment', 'noun' ) . '</label>
	    </div></div>';
	$args['class_submit'] = 'btn btn-default'; // since WP 4.1
	
	return $args;
}

// @link http://www.codecheese.com/2013/11/wordpress-comment-form-with-twitter-bootstrap-3-supports/
add_filter( 'comment_form_default_fields', 'bootstrap3_comment_form_fields' );
function bootstrap3_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
    
    $fields   =  array(
        'author' => '<div class="row"><div class="input-field col s12 comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div></div>',
        'email'  => '<div class="row"><div class="input-field col s12 comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div></div>',
        'url'    => '<div class="row"><div class="input-field col s12 comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
                    '<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></div>'        
    );
    
    return $fields;
}