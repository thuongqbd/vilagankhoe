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
				<div id="video-lagan" class="left">
					<?php
					// Start the Loop.
					while (have_posts()) : the_post();
						the_content();
					endwhile;
					?>
				</div>
				<div id="toihuongung" class="left">
					<div class="top">
						<button value="" id="btn-toihuongung"></button>
					</div>
					<div id="sohuongung">
						<strong class="number"><?= number_format_i18n(get_post_meta(get_option('page_on_front'), 'concurred_count', true), 0); ?></strong>
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
									<a href="#" class="btn-share ">
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

				<div class="next right"></div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php get_footer(); ?>
