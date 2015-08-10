<?php
/**
 * Template Name: Cam on 
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
get_header();
?>

<div class="main-content">
	<div class="container">
		<?php if (is_page('cam-on')): ?>
			<?php
			// Start the Loop.
			while (have_posts()) : the_post();
				?>
				<div id="camon-bv-ns" class="camon">
					<h1>
						<?php the_title(); ?>
					</h1>
					<?php $pages = get_pages(array('child_of' => get_the_ID()));
					?>
					<div class="row">
						<?php
						foreach ($pages as $page) {
							?>
							<div class="one-half column camon-<?php echo $page->post_name; ?>">
								<a href="<?php echo get_page_link($page->ID); ?>" title="<?php echo $page->post_title; ?>"><?php echo $page->post_title; ?></a>
							</div>							
							<?php
						}
						?>
					</div>

				</div>
				<?php
			endwhile;
			?>
		<?php elseif (is_page('cam-on/benh-vien')): ?>
			<?php
			// Start the Loop.
			while (have_posts()) : the_post();
				?>
				<div id="camon-bv" class="camon row">
					<h1> <?php the_excerpt(); ?></h1>
					<?php the_content(); ?>
				</div>
				<?php
			endwhile;
			?>
		<?php else: ?>
			<div id="camon-ns" class="camon row">
				<?php
				wp_enqueue_style('slick-style', get_stylesheet_directory_uri() . '/libs/slick/slick.css', array());
				wp_enqueue_style('slick-theme', get_stylesheet_directory_uri() . '/libs/slick/slick-theme.css', array());
				wp_enqueue_script('scrollbar', get_stylesheet_directory_uri() . '/libs/slick/slick.min.js', array('jquery'), false, true);

				global $post;
				?>
				<?php
				// Start the Loop.
				while (have_posts()) : the_post();
					?>
					<h1><?php the_title(); ?></h1>
					<div class="row ds-ns responsive">
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
										<div>
											<img src="<?php echo $img_src; ?>" alt="<?php echo $post_obj->post_title; ?>"/>
											<span><?php echo $post_obj->post_title; ?></span>
										</div>

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
			<script type="text/javascript">
				var $ = jQuery;
				$(function () {
					$('.responsive').slick({
						dots: false,
						infinite: false,
						speed: 2000,
						autoplay: true,
						autoplaySpeed: 2000,
						slidesToShow: 3,
						slidesToScroll: 3,
						responsive: [
							{
								breakpoint: 1024,
								settings: {
									slidesToShow: 3,
									slidesToScroll: 3,
									infinite: true,
									dots: false
								}
							},
							{
								breakpoint: 600,
								settings: {
									slidesToShow: 2,
									slidesToScroll: 2
								}
							},
							{
								breakpoint: 480,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1
								}
							}
							// You can unslick at a given breakpoint now by adding:
							// settings: "unslick"
							// instead of a settings object
						]
					});
				});

			</script>
		<?php endif; ?>

	</div><!-- #primary -->
</div><!-- #main-content -->
<?php get_footer(); ?>
