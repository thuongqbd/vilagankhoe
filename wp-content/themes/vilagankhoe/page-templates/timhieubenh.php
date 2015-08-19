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
wp_enqueue_style('lightbox-style', get_stylesheet_directory_uri() . '/libs/lightbox/css/lightbox.css', array());
wp_enqueue_script('lightbox-js', get_stylesheet_directory_uri() . '/libs/lightbox//js/lightbox.min.js', array('jquery'), false, true);

global $post;
get_header();
if ($post->post_parent === 0) {
	$parent = $post->ID;
	$pages = get_children(
			array(
				'post_parent' => $parent,
				'post_type' => 'page',
				'order' => 'ASC',
				'orderby' => 'menu_order'));
	$arr = $pages;
	$current = reset($arr);
	wp_redirect(get_permalink($current->ID));
	$current = null;
} else {
	$parent = $post->post_parent;
	$current = $post;
}
?>


<div id="main-content" class="main-content container">
	<div id="primary" class="content-area">
		<div id="timhieubenh">
			<div class="two-thirds column" id="show">				
				<?php
				while(have_posts()): the_post();
				?>
				
				<div>
				<?php
				the_content();
				endwhile;
				?>	
				</div>
			</div>
			<div class="one-third column">
				<?php
				wp_reset_query();
				wp_reset_postdata();	
				$pages = get_children(
				array(
					'post_parent' => $parent,
					'post_type' => 'page',
					'order' => 'ASC',
					'orderby' => 'menu_order'));
				foreach ($pages as $page) {					
					?>
					<p class="" data-post_order="<?php echo $page->menu_order; ?>">
						<a style="<?php echo $current->ID == $page->ID ? 'color:#ed1b57' : '' ?>" href="<?php echo get_the_permalink($page->ID); ?>" title="<?php get_the_title($page->ID); ?>">
							<?php echo get_the_title($page->ID);
							?>
						</a>
					</p>						
					<?php
				}
				?>
			</div>
			
		</div>				
	</div><!-- #primary -->
</div><!-- #main-content -->
<script type="text/javascript">
//	$ = jQuery;
//	if ($('#timhieubenh').length) {
//		$('#timhieubenh').find('p a[data-src]').click(function() {
//			$('#timhieubenh').find('p a[data-src]').css('color', '');
//			$(this).css('color', '#ed1b57');
//			var src = $(this).data('src');
//			$('#timhieubenh').find('#show img').attr('src', src);
//		});
//	}


</script>
<?php get_footer(); ?>
