<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
get_header();
global $post;
?>

<div id="primary" class="content-area container">	

	<?php
	// Start the loop.
	while (have_posts()) : the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php
				the_title('<h1 class="entry-title">', '</h1>');
				?>
			</header><!-- .entry-header -->
			<div class="row">				
				<div class="entry-content column two-thirds">
					<?php
					// Post thumbnail.
					the_post_thumbnail();
					?>
					<?php
					/* translators: %s: Name of current post */
					the_content();
					?>
				</div><!-- .entry-content -->
				<div class="column one-third">
					<div id="tintuc-khac">
						<h4>Tin tức khác</h4>
						<ul>
							<?php
							$args = array(
								'posts_per_page' => 5,
								'exclude' => get_the_ID(),
								'category_name' => 'tin-tuc'
							);

							$myposts = get_posts($args);
							foreach ($myposts as $post) : setup_postdata($post);
								?>
								<li>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
								</li>
								<?php
							endforeach;
							wp_reset_postdata();
							?>

						</ul>
					</div>
				</div>
			</div><!-- .row -->
			<footer class="entry-footer">
				<?php // twentyfifteen_entry_meta();  ?>
				<?php edit_post_link(__('Edit', 'twentyfifteen'), '<span class="edit-link">', '</span>'); ?>
			</footer><!-- .entry-footer -->
		</article><!-- #post-## -->
		<?php
// End the loop.
	endwhile;
	?>


</div><!-- .content-area -->

<?php get_footer(); ?>
