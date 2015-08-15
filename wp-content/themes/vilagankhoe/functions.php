<?php

add_theme_support( 'post-thumbnails' ); 

function theme_enqueue_styles() {
	wp_enqueue_style( 'normalize',
        get_stylesheet_directory_uri() . '/css/normalize.css',
        array(  )
    );
	wp_enqueue_style( 'skeleton',
        get_stylesheet_directory_uri() . '/css/skeleton.css',
        array( 'normalize' )
    );
	wp_enqueue_style('jquery-style','//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css');
//    $parent_style = 'parent-style';
//    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',get_stylesheet_directory_uri() . '/style.css',array( 'jquery-style','skeleton' ));
	wp_enqueue_style( 'style-1000',get_stylesheet_directory_uri() . '/style-1000.css',array( 'child-style' ));
    wp_enqueue_style( 'style-400',get_stylesheet_directory_uri() . '/style-400.css',array( 'style-750' ));
//    wp_enqueue_style( 'style-550',get_stylesheet_directory_uri() . '/style-550.css',array( 'style-400' ));
//    wp_enqueue_style( 'style-750',get_stylesheet_directory_uri() . '/style-750.css',array( 'style-550' ));
    
    

	wp_enqueue_script( 'custom', get_stylesheet_directory_uri().'/js/custom.js',array('jquery','jquery-ui-core', 'jquery-ui-dialog'),false,true);

//	wp_enqueue_script( 'custom', get_stylesheet_directory_uri().'/js/custom.js',array('jquery'));
	wp_localize_script( 'custom', 'MyAjax', array(
		// URL to wp-admin/admin-ajax.php to process the request
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'security' => wp_create_nonce( 'vilagankhoe' )
	));
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );
function my_custom_init() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action('init', 'my_custom_init');
function getGaleryFromPost($post, $groupGallery = null) {
    $content = get_the_content($post->ID); 
    $pattern = get_shortcode_regex();
    preg_match_all("/$pattern/s", $content, $match);
    $attachments = array();
    if(isset($match[2]) && $match[3]){
        foreach ($match[2] as $key => $m2) {
            if($m2 == "gallery"){
                $atts = shortcode_parse_atts($match[3][$key]);
				$existGallery = is_array($atts) && count($atts) > 0 && (empty($groupGallery) || $atts['group'] == $groupGallery);
				if ($existGallery) {
					$gallery = array();
					foreach ($atts as $katt => $vatt) {
						if ('ids' == $katt) {
							$gallery['ids'] = isset($atts['ids']) ? explode(',', $atts['ids']) : get_children('post_type=attachment&post_mime_type=image&post_parent=' . $objpost->ID . '&order=ASC&orderby=menu_order ID');
						} else {
							$gallery[$katt] = $vatt;
						}
					}
					$attachments[] = $gallery;
				}
            }
        }
    }
    return count($attachments)?$attachments:false;
}

function vilagankhoe_widgets_init() {

	register_sidebar( array(
		'name'          => 'Right sidebar',
		'id'            => 'sidebar-1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

}
add_action( 'widgets_init', 'vilagankhoe_widgets_init' );

// THE AJAX ADD ACTIONS
add_action( 'wp_ajax_huong_ung', 'huong_ung_function' );
add_action( 'wp_ajax_nopriv_huong_ung', 'huong_ung_function' ); // need this to serve non logged in users
// THE FUNCTION
function huong_ung_function(){
	check_ajax_referer( 'vilagankhoe', 'security' );
	$page_on_front = get_option('page_on_front');
	$concurred_count = get_post_meta( $page_on_front, 'concurred_count', true );
	if(!isset($_COOKIE['huong_ung'])) {		
		update_post_meta($page_on_front, 'concurred_count', ++$concurred_count);
		setcookie('huong_ung', $concurred_count, time() + (86400 * 30), "/");
	}
	
	echo $concurred_count;die;
}
add_filter('widget_text', 'php_set_base_url', 99);
add_filter('the_content', 'php_set_base_url', 99);
function php_set_base_url($text) {
	return str_ireplace('http://localhost/vilagankhoe/', WP_HOME . '/', $text);
}