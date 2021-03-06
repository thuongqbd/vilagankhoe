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
    wp_enqueue_style( 'style-400',get_stylesheet_directory_uri() . '/style-400.css',array( 'child-style' ));
    wp_enqueue_style( 'style-550',get_stylesheet_directory_uri() . '/style-550.css',array( 'style-400' ));
    wp_enqueue_style( 'style-750',get_stylesheet_directory_uri() . '/style-750.css',array( 'style-550' ));
	wp_enqueue_style( 'style-1000',get_stylesheet_directory_uri() . '/style-1000.css',array( 'style-750' ));
    
    

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

// THE AJAX ADD ACTIONS
add_action( 'wp_ajax_upload_avatar', 'upload_avatar_function' );
add_action( 'wp_ajax_nopriv_upload_avatar', 'upload_avatar_function' ); // need this to serve non logged in users
// THE FUNCTION
function upload_avatar_function(){
//	check_ajax_referer( 'vilagankhoe', 'security' );
	require_once 'crop.php';
	$crop = new CropAvatar(
		isset($_POST['avatar_src']) ? $_POST['avatar_src'] : null,
		isset($_POST['avatar_data']) ? $_POST['avatar_data'] : null,
		isset($_FILES['avatar_file']) ? $_FILES['avatar_file'] : null
	);

	$response = array(
		'state'  => 200,
		'message' => $crop -> getMsg(),
		'result' => $crop -> getResult()
	);

	echo json_encode($response);
	die;
}

// THE AJAX ADD ACTIONS
add_action( 'wp_ajax_remove_avatar', 'remove_avatar_function' );
add_action( 'wp_ajax_nopriv_remove_avatar', 'remove_avatar_function' ); // need this to serve non logged in users
function remove_avatar_function(){
	if(!is_admin())
		check_ajax_referer( 'vilagankhoe', 'security' );

	$result = 0;
	if(isset($_POST['avatar_id'])){	
		$avatar = get_metadata_by_mid('post', $_POST['avatar_id']);
		if($avatar){
			try {
				$ex = explode('/', $avatar->meta_value);
				$filename = array_pop($ex);
				$wp_upload_dir = wp_upload_dir();
				$upload_dir = $wp_upload_dir['basedir']."/avatars/";
				@unlink($upload_dir.$filename);
				
			} catch (Exception $exc) {
				
			}
			$result = delete_meta($_POST['avatar_id']);
		}
	}
	echo $result;
	die;
}
// THE AJAX ADD ACTIONS
add_action( 'wp_ajax_remove_all_avatar', 'remove_all_avatar_function' );
add_action( 'wp_ajax_nopriv_remove_all_avatar', 'remove_all_avatar_function' ); // need this to serve non logged in users
function remove_all_avatar_function(){
	if(!is_admin())
		check_ajax_referer( 'vilagankhoe', 'security' );
	$upload_avatar_page_id = get_option( 'upload_avatar_page_id', 1 );
	$listAvatar = get_metadata('post', $upload_avatar_page_id, 'avatars');
	$wp_upload_dir = wp_upload_dir();
	foreach ($listAvatar as $avatar) {
		try {
			$ex = explode('/', $avatar->meta_value);
			$filename = array_pop($ex);			
			$upload_dir = $wp_upload_dir['basedir']."/avatars/";
			@unlink($upload_dir.$filename);

		} catch (Exception $exc) {

		}
	}
	delete_post_meta_by_key('avatars');
	echo 1;
	die;
}
/* ======================= them phan quan ly avatar ===================*/
function render_meta_box_content() 
{
	$upload_avatar_page_id = get_option( 'upload_avatar_page_id', 1 );
	?>
	<div class='list-avatar'>
		<?php
		if($upload_avatar_page_id){
			global $wpdb;
			$list_avatars = $wpdb->get_results("
				SELECT meta_id,meta_value FROM {$wpdb->postmeta}
				WHERE meta_key = 'avatars' 
				AND post_id = {$upload_avatar_page_id}
				ORDER BY meta_id DESC
			");

			delete_post_meta_by_key($post_meta_key);
			if($list_avatars){
				wp_enqueue_style('slick', get_stylesheet_directory_uri() . '/libs/slick/slick.css', array());
				wp_enqueue_style('slick-theme', get_stylesheet_directory_uri() . '/libs/slick/slick-theme.css', array());
				wp_enqueue_script('slick-js', get_stylesheet_directory_uri() . '/libs/slick/slick.min.js', array('jquery'), false, true);
				wp_enqueue_style('lightbox-css', get_stylesheet_directory_uri() . '/libs/lightbox/css/lightbox.css', array());
				wp_enqueue_script('lightbox-js', get_stylesheet_directory_uri() . '/libs/lightbox/js/lightbox.min.js', array('jquery'), false, true);
				?>
				<button id="remove_all_avatar" type="button">Xóa tất cả</button>
				<div class="slick-avatar">
					<?php foreach($list_avatars as $avatar){?>
					<div class="slick-slide" style="padding: 10px;">
						<button class="remove_avatar notice-dismiss" data-value="<?= $avatar->meta_id?>" type="button"></button>
						<a href="<?= $avatar->meta_value?>" data-lightbox="roadtrip">
							<img data-lazy="<?= $avatar->meta_value?>" width="100">
						</a>						
					</div>			
					<?php }?>				
				</div>
				<style>
					.slick-initialized .slick-slide {
						display: block;
						position: relative;
					}
					button.remove_avatar{
						padding: 0px;
						right: -5px;
					}
				</style>
				<script type="text/javascript">
					jQuery(document).ready(function(){
						var slick_option = {
							lazyLoad: 'ondemand',
							slidesToShow: 10,
							responsive: [
							  {
								breakpoint: 768,
								settings: {
								  arrows: false,
								  slidesToShow: 3
								}
							  },
							  {
								breakpoint: 480,
								settings: {
								  arrows: false,
								  slidesToShow: 1
								}
							  }
							]
						};
						jQuery('.slick-avatar').slick(slick_option);
						jQuery('.remove_avatar').click(function(){
							var button = jQuery(this);
							if(button.data('value') && confirm('Xóa avatar này?'))
							var data = {
								action: 'remove_avatar',
								avatar_id:button.attr('data-value')
							};
							jQuery.post('<?= admin_url( 'admin-ajax.php' )?>', data, function (response) {
								console.log(response);
								if(response == 1){
									button.closest('.slick-slide').remove();
									jQuery('.slick-avatar').slick(slick_option);
								}
							},'text',{cache:false});
						});
						jQuery('#remove_all_avatar').click(function(){
							if(confirm('Xóa tất cả các avatar?'))
							var data = {
								action: 'remove_all_avatar',
							};
							jQuery.post('<?= admin_url( 'admin-ajax.php' )?>', data, function (response) {
								console.log(response);
								if(response == 1){
									jQuery('.slick-avatar').remove();
								}
							},'text',{cache:false});
						});
					});
				</script>
				<?php
			}
		}	
		?>		  
	</div>
	<?php

}
function myplugin_add_meta_box() {
	global $post;
	$upload_avatar_page_id = get_option( 'upload_avatar_page_id', 1 );
	if($post->ID == $upload_avatar_page_id){
		add_meta_box( 
				 'some_meta_box_name'
				,__( 'Danh sách avatar')
				,'render_meta_box_content'
				,'page' 
				,'advanced'
				,'high'
			);
		
	}
}
function remove_editor() {
	$upload_avatar_page_id = get_option( 'upload_avatar_page_id', 1 );
	if(isset($_GET['post']) && $_GET['post'] == $upload_avatar_page_id){
		remove_post_type_support('page', 'editor');
		remove_post_type_support('page', 'custom-fields');
		remove_post_type_support('page', 'comments');
		remove_post_type_support('page', 'thumbnail');
		remove_post_type_support('page', 'page-attributes');
	}
}

if(is_admin()){
	add_action('admin_init', 'remove_editor');
	add_action( 'add_meta_boxes', 'myplugin_add_meta_box' );
}
/* ======================= ==================== ===================*/

/* ======================= them setting avatar page id ===================*/
$new_general_setting = new new_general_setting();

class new_general_setting {
    function new_general_setting( ) {
        add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
    }
    function register_fields() {
        register_setting( 'general', 'upload_avatar_page_id');
        add_settings_field('upload_avatar_page_id_setting-id', '<label for="upload_avatar_page_id">'.__('Upload avatar page ID?').'</label>' , array(&$this, 'fields_html') , 'general' );
    }
    function fields_html() {
        $value = get_option( 'upload_avatar_page_id', '' );
        echo '<input type="text" id="upload_avatar_page_id" name="upload_avatar_page_id" value="' . $value . '" />';
    }
}
/* ======================= =========================== ===================*/
