<?php

add_theme_support( 'post-thumbnails' ); 

function theme_enqueue_styles() {
	wp_enqueue_style( 'normalize',
        get_stylesheet_directory_uri() . '/css/normalize.css',
        array(  )
    );
	wp_enqueue_style( 'skeleton',
        get_stylesheet_directory_uri() . '/css/skeleton.css',
        array(  )
    );
//    $parent_style = 'parent-style';

//    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array(  )
    );
	wp_enqueue_script( 'custom', get_stylesheet_directory_uri().'/js/custom.js',array('jquery'));
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );

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