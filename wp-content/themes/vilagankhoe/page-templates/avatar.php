<?php
/**
 * Template Name: Avatar
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
wp_enqueue_style('croppic-css-main', get_stylesheet_directory_uri() . '/libs/croppic/css/main.css', array());
wp_enqueue_style('croppic-css', get_stylesheet_directory_uri() . '/libs/croppic/css/croppic.css', array());
wp_enqueue_script('croppic-js', get_stylesheet_directory_uri() . '/libs/croppic/js/croppic.js', array('jquery'), false, true);
wp_enqueue_script('mousewheel-js', get_stylesheet_directory_uri() . '/libs/croppic/js/jquery.mousewheel.min.js', array('jquery'), false, true);
get_header();
?>
<style>
	.avatar #main{
		height: auto !important;
	}
	div#croppic img {
		max-width: none !important;
	}
</style>
<div id="main-content" class="main-content container">
	<div id="primary" class="content-area">		
		<div id="avatar" class="row">									
			<div class="cropHeaderWrapper">
				<div id="croppic"></div>
				<span class="btn" id="cropContainerHeaderButton">click here to try it</span>
				<input type="hidden" id="cropOutput" >
			</div><!-- /col-lg-6 -->
		</div>

	</div><!-- #primary -->
</div><!-- #main-content -->
<?php get_footer(); ?>