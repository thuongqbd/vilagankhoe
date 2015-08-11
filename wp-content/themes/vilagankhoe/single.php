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
	<div class="row">
		<div class="column two-thirds">
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

					<div class="entry-content">
						<?php
//						the_post_thumbnail();
						?>
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->
				<?php
			// End the loop.
			endwhile;
			?>
		</div>
		<div class="column one-third">
			<div id="tintuc-khac">
				<h4>Tin tức khác</h4>
				<ul>
					<?php
					$args = array(
						'posts_per_page' => 10,
						'exclude' => $post->ID,
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
	</div>
</div><!-- .content-area -->
<?php get_footer(); ?>
