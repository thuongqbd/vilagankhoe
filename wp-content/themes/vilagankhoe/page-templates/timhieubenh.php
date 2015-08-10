<?php
/**
 * Template Name: Tim hieu benh
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
								<p>
									<a href="javascrip:void(0)" data-src="<?php echo $img_src; ?>">
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
						echo wp_get_attachment_image($attachment_id, 'full', $icon = 1, $attr = array(
							'id' => '1_1_main',
						));
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
		$('#timhieubenh').find('p a[data-src]').click(function () {
			$('#timhieubenh').find('p a[data-src]').css('color', '');
			$(this).css('color', '#ed1b57');
			var src = $(this).data('src');
			$('#timhieubenh').find('#show img').attr('src', src);
		});
	}


</script>
<?php get_footer(); ?>
