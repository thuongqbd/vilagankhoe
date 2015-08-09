<?php
/**
 * Template Name: Dat cau hoi
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
get_header(); ?>

<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content container" role="main">
			<div id="datcauhoi" class="row lagan-form">									
				<div class="row">
					<div class="five columns" id="logo-slogan">							
						<img src="<?= get_stylesheet_directory_uri()?>/images/logo-dktest.png" alt=""/>
						<p>Nếu bạn nằm trong nhóm có nguy cơ 
							bị lây nhiễm bệnh cao, hãy đăng ký
							tham gia tầm soát bệnh hoàn toàn miễn phí 
							tại bệnh viện gần nhất nơi bạn sống cùng 
							chúng tôi ngay hôm nay
						</p>
					</div>
					<div class="seven columns" >								
						<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();
							the_content();
						endwhile;
						?>
					</div>
					<div id="camon-dch" class="camon" style="display:none;">
						<h1>Cảm ơn bạn đã gửi câu hỏi!</h1>
						<p>Chúng tôi sẽ gửi tư vấn vào hộp thư điện tử của bạn và công bố trên website của chương trình. Vui lòng kiểm tra hộp thư điện thường xuyên.

						</p>
						<p class="form-button">
							<a href="<?php echo get_permalink(get_page_by_path('hoi-dap')->ID)?>">XEM NHỮNG THẮC MẮC KHÁC</a>
							<button class="btn-close">Đóng</button></p>
					</div>
				</div>										
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->
<?php get_footer(); ?>
