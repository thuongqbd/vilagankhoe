<?php
/**
 * Template Name: Hoi dap
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
//wp_enqueue_style( 'scrollbar',
//        get_stylesheet_directory_uri() . '/libs/jquery.scrollbar/jquery.scrollbar.css',
//        array(  )
//    );
//wp_enqueue_script( 'scrollbar', get_stylesheet_directory_uri().'/libs/jquery.scrollbar/jquery.scrollbar.min.js',array('jquery'));
get_header(); ?>

<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content container" role="main">
			<div id="hoidap" class="row">
				<div class="scrollbar-inner">
				<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();
					the_content();
				endwhile;
				?>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->
<script type="text/javascript">	
//	$ = jQuery;
//	$(function(){
//		$('.qafp-faq').each(function(){
//			that = this;
//			$(that).find('.hoi').on('click',function(){
//
//				if($(that).find('.dap').is(":hidden")){			
//					$(this).addClass('active');
//					console.log($(that).find('.dap').is(":hidden"));
//				}else{
//					$(this).addClass('active');
//					$(this).removeClass('active');
//				}
//
//			});
//		});
//	})


</script>
<?php get_footer(); ?>
