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

	</div><!-- #main -->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container" id="gioithieu">
			<?php if (is_front_page() || is_home()) : ?>
				<h4><a href="<?php echo get_permalink(139) ?>">Giới thiệu chương trình “ Đồng hành cùng bệnh nhân viêm gan ”</a></h4>								
			<?php endif; ?>
			<div class="row">					
				<div class="line"></div>
				<div class="routine">					
					<div class="one-third column"><a class="haytamsoat" href="<?= get_permalink(68) ?>" title="Hãy tầm soát vì lá gan khỏe"><span class="hidden-text">Hãy tầm soát vì lá gan khỏe </span></a></div>
					<div class="one-third column"><a class="haychuatri" href="<?= get_permalink(7) ?>" title="Hãy chữa trị vì lá gan khỏe"><span class="hidden-text">Hãy chữa trị vì lá gan khỏe </span></a>					</div>
					<div class="one-third column"><a class="cunghanhdong" href="<?= get_permalink(73) ?>" title="Cùng hành động vì lá gan khỏe"><span class="hidden-text">Cùng hành động vì lá gan khỏe </span></a></div>					
				</div>
			</div>		
		</div>
		<div class="container dvtctc">				
			<div class="row">
				<div class="one-half column">
					<div>
						<span>Đơn vị tổ chức: </span>
						<a href="http://hoitruyennhiem.vn/" target="_blank">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/logo-dvtochuc.png" alt=""/>
						</a>
					</div>

				</div>
				<div class="one-half column">
					<div>
						<span>Đơn vị tài trợ: </span>
						<a href="http://www.roche.com/" target="_blank">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/logo-dvtaitro.png" alt=""/>
						</a>
					</div>

				</div>
			</div>		
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
