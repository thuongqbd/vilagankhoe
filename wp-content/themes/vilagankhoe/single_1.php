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

<div id="primary" class="content-area">
	<main id="main" class="site-main container" role="main">
		<div class="row">
			<div class="two-thirds column">

				<?php
				// Start the loop.
				while (have_posts()) : the_post();

					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part('content', get_post_format());

				// If comments are open or we have at least one comment, load up the comment template.
//			if ( comments_open() || get_comments_number() ) :
//				comments_template();
//			endif;
				// Previous/next post navigation.
//			the_post_navigation( array(
//				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentyfifteen' ) . '</span> ' .
//					'<span class="screen-reader-text">' . __( 'Next post:', 'twentyfifteen' ) . '</span> ' .
//					'<span class="post-title">%title</span>',
//				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentyfifteen' ) . '</span> ' .
//					'<span class="screen-reader-text">' . __( 'Previous post:', 'twentyfifteen' ) . '</span> ' .
//					'<span class="post-title">%title</span>',
//			) );
				// End the loop.
				endwhile;
				?>
				<div id="tintuc-khac">
					<h4>Tin tức khác</h4>
					
					<?php
					$args = array( 
//						'posts_per_page' => 5,
//						'exclude'=>$post->ID, 
//						'category_name'=> 'tintuc' 
						);

					$myposts = get_posts( $args );
					foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
						<p>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						</p>
					<?php endforeach; 
					wp_reset_postdata();?>

					
				</div>				
			</div>
			<div class="column one-third">
				<?php echo get_sidebar(); ?>
			</div>
		</div>
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
