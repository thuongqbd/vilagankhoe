<?php
/**
 * Template Name: HomePage
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

<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content container" role="main">
			<div id="huongung" class="row">
				<div id="video-lagan" class="left"><img src="http://localhost/vilagankhoe/wp-content/uploads/2015/08/video.png" alt="" /></div>
				<div id="toihuongung" class="left">
					<div class="top">
						<button value="" id="btn-toihuongung"></button>
					</div>
					<div id="sohuongung">
						<strong id="concurred_count" class="number"><?= number_format_i18n( get_post_meta( get_option('page_on_front'), 'concurred_count', true ), 0 );?></strong>
						<span>người đã hưởng ứng</span>
					</div>
				</div>
				
				<div class="next right"></div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php get_footer(); ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/1.4.5/numeral.min.js"></script>