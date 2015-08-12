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

<div id="main-content" class="main-content container">
	<div id="primary" class="content-area ">	
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
		<?php
			// Start the Loop.
			while (have_posts()) : the_post();
				?>
			<div id="camon-ns" class="camon row">				
				<h1> <?php the_excerpt(); ?></h1>
				<?php the_content(); ?>
			</div>
		<?php
			endwhile;
			?>
		<?php endif; ?>

	</div><!-- #primary -->
</div><!-- #main-content -->
<?php get_footer(); ?>
