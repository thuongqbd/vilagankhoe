<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

	</div><!-- .site-content -->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container" id="gioithieu">
			<div class="row">	
				<?php if (is_front_page() || is_home()) : ?>
					<h4>Giới thiệu chương trình “ Đồng hành cùng bệnh nhân viêm gan ”</h4>								
				<?php endif;
				?>
				
				<div class="routine">
					<div class="line"></div>
					<a href="<?= get_permalink(68)?>"><img class="haytamsoat" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/img-haytoansoat.png" alt=""/></a>
					<a href="<?= get_permalink(7)?>"><img class="haychuatri" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/img-haychuatri.png" alt=""/></a>
					<a href="<?= get_permalink(73)?>"><img class="cunghanhdong" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/img-cunghanhdong.png" alt=""/></a>
				</div>
			</div>
			<div class="row " >
				<div class="  dvtctc">
					<div class="left">
						<span>Đơn vị tổ chức: </span>
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo-dvtochuc.png" alt=""/>
					</div>
					<div class="left">
						<span>Nhà tài trợ: </span>
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo-dvtaitro.png" alt=""/>
					</div>
				</div>
			</div>
			<!--<div class="row copyright"></div>-->
		</div>
	</footer>
</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
