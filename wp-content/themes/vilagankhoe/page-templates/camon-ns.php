<?php
/**
 * Template Name: Cam on Nghe si
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
wp_enqueue_style('slick-style', get_stylesheet_directory_uri() . '/libs/slick/slick.css', array());
wp_enqueue_style('slick-theme', get_stylesheet_directory_uri() . '/libs/slick/slick-theme.css', array());
wp_enqueue_script('scrollbar', get_stylesheet_directory_uri() . '/libs/slick/slick.min.js', array('jquery'), false, true);

get_header();

global $post;
?>

<div class="main-content">
	<div class="container">
		<div id="camon-ns" class="camon row">

			<?php
			// Start the Loop.
			while (have_posts()) : the_post();
				?>
				<h1><?php the_title(); ?></h1>
				<div class="row ds-ns center">
					<?php
					$listGalery = getGaleryFromPost($post);
					if ($listGalery) {
						foreach ($listGalery as $galery) {
							$galery = $galery['ids'];
							foreach ($galery as $id) {
								$post_obj = get_post($id);
								$img = wp_get_attachment_image_src($id, 'full');
								$img_src = $img[0];
								?>
								<div class="">							
									<img src="<?php echo $img_src; ?>" alt="<?php echo $post_obj->post_title; ?>"/>
									<span><?php echo $post_obj->post_title; ?></span>
								</div>												
								<?php
							}
						}
					}
					?>
				</div>				
				<?php
			endwhile;
			?>
		</div>		
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php get_footer(); ?>
