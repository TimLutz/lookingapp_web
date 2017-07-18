<?php
if ( function_exists('register_sidebar') )
    register_sidebar();
    
add_filter('comments_template', 'legacy_comments');
function legacy_comments($file) {
	if(!function_exists('wp_list_comments')) 	$file = TEMPLATEPATH . '/legacy.comments.php';
	return $file;
}    

// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'twentyfourteen' ),
		'secondary' => __( 'Secondary menu', 'twentyfourteen' ),
	) );
	
	// Removes ul class from wp_nav_menu
function remove_ul ( $menu ){
    return preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $menu );
}
add_filter( 'wp_nav_menu', 'remove_ul' );


function url_shortcode() {
return get_bloginfo('template_url');
}
add_shortcode('url','url_shortcode');
add_filter( 'widget_text', 'do_shortcode' );  
add_filter('the_content', 'do_shortcode'); 


register_sidebar( array(
'name' => __( 'Footer logo area', 'twentytwelve' ),
'id' => 'Footer-logo-area',
'description' => __( '', 'twentytwelve' ),
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h2>',
'after_title' => '</h2>',
) );	

register_sidebar( array(
'name' => __( 'LOOKING on iOS', 'twentytwelve' ),
'id' => 'LOOKING-on-iOS',
'description' => __( '', 'twentytwelve' ),
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h2>',
'after_title' => '</h2>',
) );	

register_sidebar( array(
'name' => __( 'LOOKING on Android', 'twentytwelve' ),
'id' => 'LOOKING-on-Android',
'description' => __( '', 'twentytwelve' ),
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h2>',
'after_title' => '</h2>',
) );	

register_sidebar( array(
'name' => __( 'Social', 'twentytwelve' ),
'id' => 'Social',
'description' => __( '', 'twentytwelve' ),
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h2>',
'after_title' => '</h2>',
) );	

///////////////////////////////////////////////////
// This theme uses post thumbnails
add_theme_support( 'post-thumbnails' );
add_image_size( 'post-thumbnails', true );
//add_image_size( 'home-testimonials-thumb',616, 447, true );
//add_image_size( 'home-media-thumb',307, 176, true );
//add_image_size( 'current-thumb',32, 30, true );
function remove_empty_p( $content ) {
    $content = force_balance_tags( $content );
    $content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
    $content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );
    return $content;
}
add_filter('the_content', 'remove_empty_p', 20, 1);

    
?>
