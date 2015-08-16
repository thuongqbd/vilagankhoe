<?php
/**
 * Template Name: Tim hieu benh 1
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
wp_enqueue_style('lightbox-style', get_stylesheet_directory_uri() . '/libs/lightbox/css/lightbox.css', array());
wp_enqueue_script('lightbox-js', get_stylesheet_directory_uri() . '/libs/lightbox//js/lightbox.min.js', array('jquery'), false, true);

global $post;
get_header();
?>

<div id="main-content" class="main-content container">
	<div id="primary" class="content-area">

		<?php while (have_posts()) : the_post(); ?>
			<div id="timhieubenh">
				<div class="one-third column">
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
								<p class="forpc">
									<a href="#" data-src="<?php echo $img_src; ?>">
										<?php echo $post_obj->post_title; ?>
									</a>
								</p>
								<p class="forsp">
									<a href="<?php echo $img_src; ?>" data-lightbox="image-1">
									<?php echo $post_obj->post_title; ?>
									</a>
								</p>
								<?php
							}
						}
					}
					?>
				</div>
				<div class="two-thirds column" id="show">				
					<?php
					if (!empty($galery) && count($galery) != 0) {
						$attachment_id = $galery[0];
						$post_obj = get_post($attachment_id);
						$img = wp_get_attachment_image_src($id, 'full');
						$img_src = $img[0];
						?>
						<a href="<?php echo $img_src; ?>" data-lightbox="image-tailieu">
							<?php
							echo wp_get_attachment_image($attachment_id, 'full', $icon = 1, $attr = array(
								'id' => '1_1_main',
							));
							?>
						</a>
						<?php
					}
					?>							
				</div>
			</div>
		<?php endwhile; ?>		
	</div><!-- #primary -->
</div><!-- #main-content -->
<script type="text/javascript">
	$ = jQuery;
	if ($('#timhieubenh').length) {
		$('#timhieubenh').find('p a[data-src]').click(function() {
			$('#timhieubenh').find('p a[data-src]').css('color', '');
			$(this).css('color', '#ed1b57');
			var src = $(this).data('src');
			$('#timhieubenh').find('#show img').attr('src', src);
		});
	}


</script>
<?php get_footer(); ?>
