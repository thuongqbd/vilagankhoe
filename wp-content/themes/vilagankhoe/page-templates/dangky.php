<?php
/**
 * Template Name: Dang ky
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

<div id="main-content" class="main-content container">
	<div id="primary" class="content-area ">	
		<div id="dangky-test" class="row lagan-form">
			<!--<div class="prev left"></div>-->
			<?php
			// Start the Loop.
			while (have_posts()) : the_post();
				?>
				<div class="row">
					<div class="five columns" id="logo-slogan">
						<?php
						$logo = get_field('logo');
						if ($logo) {
							echo wp_get_attachment_image($logo, 'full');
						} else {
							?>
							<img src="<?= get_stylesheet_directory_uri() ?>/images/logo-dktest.png" alt=""/>
							<?php
						}
						?>
						
					</div>
					<div class="seven columns" id="form-dkt">
						<?php
						the_content();
						?>
					</div>

					<?php
					$form_img = get_field('form_img');
					if ($form_img) {
						echo wp_get_attachment_image($form_img, 'full', false, array('class'=>'tip'));
					} else {
						?>
						<img src="<?= get_stylesheet_directory_uri() ?>/images/img-dk-test.png" alt="" class="tip"/>
						<?php
					}
					?>
					<?php the_post_thumbnail($size = 'post-thumbnail', $attr = array('class' => 'tip')); ?>
					<div id="camon-dk" class="camon" style="display:none;">
						<h1><?php the_field('tk_title'); ?></h1>
						<p><?php the_field('tk_content'); ?>
						</p>
						<p><button class="btn-close">Đóng</button></p>
					</div>
				</div>
				<?php
			endwhile;
			?>
			<!--<div class="next right"></div>-->
		</div><!-- #dangky-test -->
	</div><!-- #primary -->
</div><!-- #main-content -->
<?php get_footer(); ?>
