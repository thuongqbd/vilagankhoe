<?php
/**
 * The template for displaying Category pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content container" role="main">

			<?php if ( have_posts() ) : ?>
			
			<div class="tintuc-list">
			<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();

					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
//					get_template_part( 'content', get_post_format() );
					?>
			
					<div class="item one-third column">
						<a href="<?php the_permalink()?>" title="<?php the_title();?>">
							<?php the_post_thumbnail(297,198);?>
							<!--<img src="images/img-tintuc.jpg" alt=""/>-->
							<span><?php the_title();?></span>
						</a>
					</div>
					
				
			<?php

					endwhile;
					// Previous/next page navigation.
					?>
	</div>
				<?php if(function_exists('wp_paginate')) {
    wp_paginate();
}
else {
    twentythirteen_paging_nav( 'nav-below' );
}
?> 
	<?php

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>
		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
