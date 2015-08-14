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
wp_enqueue_script( 'counterup', get_stylesheet_directory_uri().'/js/jquery.counterup.min.js',array('jquery'),false,true);
wp_enqueue_script( 'waypoints', get_stylesheet_directory_uri().'/js/waypoints.min.js',array('jquery'),false,true);
?>

<div id="main-content" class="main-content">
	<div id="primary" class="content-area container">		
		<div id="huongung" class="row">
			<div id="video-lagan" class="two-thirds column">
				<?php
				// Start the Loop.
				while (have_posts()) : the_post();
					the_content();
				endwhile;
				?>
			</div>
			<div id="toihuongung" class="one-third column">
				<div class="top">
					<button value="" id="btn-toihuongung">Tôi hưởng ứng</button>
				</div>
				<div id="sohuongung">
					<strong id="concurred_count" class="number .integers"><?= number_format_i18n(get_post_meta(get_option('page_on_front'), 'concurred_count', true), 0); ?></strong>
					<span>người đã hưởng ứng</span>
				</div>
				<div id="camon-fb" class="camon " style="display:none;">
					<div class="container">

						<h1>  Cảm ơn bạn đã HƯỞNG ỨNG chương trình<br>
							cùng hành động vì bệnh nhân viêm gan!</h1>
						<p>
							Hãy chia sẻ để chương trình lan tỏa và ý nghĩa hơn
						</p>
						<div class="row">
							<div class="one-half column">
								<a href="javascript:fbshareCurrentPage()" class="btn-share ">
									<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/btn-share.png" alt=""/>
								</a>
							</div>
							<div class="one-half column">
								<a href="#" class="btn-dont-share btn-close" >
									<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/btn-dont-share.png" alt=""/>
								</a>
							</div>
						</div>

					</div>

				</div>
			</div>
			<!--<div class="next right"></div>-->
		</div>
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php get_footer(); ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/1.4.5/numeral.min.js"></script>
