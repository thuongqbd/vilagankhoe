<?php
/**
 * Template Name: Dat cau hoi
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
	<div id="primary" class="content-area">		
		<div id="datcauhoi" class="row lagan-form">									
			<div class="row">
				<?php
				// Start the Loop.
				while (have_posts()) : the_post();
					?>				
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
						<div class="form_description"><?php the_field('form_description') ?></div>
					</div>
					<div class="seven columns" >								
						<?php the_content(); ?>
					</div>
					<?php
				endwhile;
				?>
			</div>
			<div id="camon-dch" class="camon" style="display:none;">
				<h1><?php the_field('tk_title')?></h1>
				<p><?php the_field('tk_content')?></p>
				<p class="form-button">
					<a href="<?php echo get_permalink(get_page_by_path('hoi-dap')->ID) ?>">XEM NHỮNG THẮC MẮC KHÁC</a>
					<button class="btn-close">Đóng</button></p>
			</div>

		</div>

	</div><!-- #primary -->
</div><!-- #main-content -->
<?php get_footer(); ?>
