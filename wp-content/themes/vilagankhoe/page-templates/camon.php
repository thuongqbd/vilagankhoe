<?php
/**
 * Template Name: Cam on 
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

<div id="main-content" class="main-content container">
	<div id="primary" class="content-area ">	
		<?php if (is_page('cam-on')): ?>
			<?php
			// Start the Loop.
			while (have_posts()) : the_post();
				?>
				<div id="camon-bv-ns" class="camon">
					<h1>
						<?php the_title(); ?>
					</h1>
					<?php $pages = get_pages(array('child_of' => get_the_ID()));
					?>
					<div class="row">
						<?php
						foreach ($pages as $page) {
							?>
							<div class="one-half column camon-<?php echo $page->post_name; ?>">
								<a href="<?php echo get_page_link($page->ID); ?>" title="<?php echo $page->post_title; ?>"><?php echo $page->post_title; ?></a>
							</div>							
							<?php
						}
						?>
					</div>

				</div>
				<?php
			endwhile;
			?>
		<?php elseif (is_page('cam-on/benh-vien')): ?>
			<?php
			// Start the Loop.
			while (have_posts()) : the_post();
				?>
				<div id="camon-bv" class="camon row">
					<h1> <?php the_excerpt(); ?></h1>
					<?php the_content(); ?>
				</div>
				<?php
			endwhile;
			?>
		<?php else: ?>
		<?php
			wp_enqueue_script( 'counterup', get_stylesheet_directory_uri().'/js/jquery.counterup.min.js',array('jquery'),false,true);
			wp_enqueue_script( 'waypoints', get_stylesheet_directory_uri().'/js/waypoints.min.js',array('jquery'),false,true);
			// Start the Loop.
			while (have_posts()) : the_post();
				?>
			<div id="camon-ns" class="camon row">				
				<h1> <?php the_excerpt(); ?></h1>
				<div class="camon-ns-gallery row">
					<?php the_content(); ?>
					<div>
						<button value="" id="btn-toihuongung">Tôi hưởng ứng</button>
						<span>Đã có <strong id="concurred_count" class="number .integers"><?= number_format_i18n(get_post_meta(get_option('page_on_front'), 'concurred_count', true), 0); ?></strong> người hưởng ứng chương trình</span>
					</div>
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
				<?php $upload_avatar_page_id = get_option( 'upload_avatar_page_id', 1 );?>
				<div class='list-avatar'>
					<?php
					if($upload_avatar_page_id){
						$list_avatars = get_post_meta ( $upload_avatar_page_id, 'avatars');
						if($list_avatars){
							wp_enqueue_style('slick', get_stylesheet_directory_uri() . '/libs/slick/slick.css', array());
							wp_enqueue_style('slick-theme', get_stylesheet_directory_uri() . '/libs/slick/slick-theme.css', array());
							wp_enqueue_script('slick-js', get_stylesheet_directory_uri() . '/libs/slick/slick.min.js', array('jquery'), false, true);
							?>
							<div class="slick-avatar">
								<?php for ($i = count($list_avatars)-1; $i >= 0; $i--){?>
								<div class="slick-slide" style="padding: 10px;">
									<img data-lazy="<?= $list_avatars[$i]?>" width="100">
								</div>			
								<?php }?>				
							</div>
							<script type="text/javascript">
								jQuery(document).ready(function(){
									jQuery('.slick-avatar').slick({
										lazyLoad: 'ondemand',
										slidesToShow: 3,
										responsive: [
										  {
											breakpoint: 768,
											settings: {
											  arrows: false,
											  slidesToShow: 3
											}
										  },
										  {
											breakpoint: 480,
											settings: {
											  arrows: false,
											  slidesToShow: 3
											}
										  }
										]
									});
								});
							</script>
							<?php
						}
					}	
					?>		  
				</div>
			</div>
		<?php
			endwhile;
			?>
			<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/1.4.5/numeral.min.js"></script>
		<?php endif; ?>

	</div><!-- #primary -->
</div><!-- #main-content -->
<?php get_footer(); ?>
