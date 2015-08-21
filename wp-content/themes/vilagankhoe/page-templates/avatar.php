<?php
/**
 * Template Name: Avatar
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
//wp_enqueue_style('croppic-css-main', get_stylesheet_directory_uri() . '/libs/croppic/css/main.css', array());
wp_enqueue_style('bootstrap.min', get_stylesheet_directory_uri() . '/libs/cropper/css/bootstrap.min.css', array());
wp_enqueue_style('font-awesome.min', get_stylesheet_directory_uri() . '/libs/cropper/css/font-awesome.min.css', array());
wp_enqueue_style('cropper.min', get_stylesheet_directory_uri() . '/libs/cropper/css/cropper.min.css', array());
wp_enqueue_style('main.cropper', get_stylesheet_directory_uri() . '/libs/cropper/css/main.css', array());
wp_enqueue_script('bootstrap.min-js', get_stylesheet_directory_uri() . '/libs/cropper/js/bootstrap.min.js', array('jquery'), false, true);
wp_enqueue_script('cropper.min-js', get_stylesheet_directory_uri() . '/libs/cropper/js/cropper.min.js', array('jquery'), false, true);
wp_enqueue_script('cropper.main-js', get_stylesheet_directory_uri() . '/libs/cropper/js/main.js', array('jquery'), false, true);
get_header();
?>
<div class="container" id="crop-avatar">
	<?php while (have_posts()) : the_post(); ?>
	<h1> <?php the_excerpt(); ?></h1>
	<?php endwhile;?>
	<!-- Current avatar -->
	<div class="avatar-view">
		<img src="<?= get_stylesheet_directory_uri()?>/images/avatar.png" alt="Upload hình của bạn tại đây" title="Upload hình của bạn tại đây">
	</div>

	<!-- Cropping modal -->
	<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form class="avatar-form" action="<?= admin_url('admin-ajax.php'); ?>" enctype="multipart/form-data" method="post">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" id="avatar-modal-label">Upload và chỉnh sửa avatar</h4>
					</div>
					<div class="modal-body">
						<div class="avatar-body">

							<!-- Upload image and data -->
							<div class="avatar-upload">
								<input type="hidden" class="action" name="action" value="upload_avatar">
								<!--<input type="hidden" class="security" name="security" value="upload_avatar">-->
								<input type="hidden" class="avatar-src" name="avatar_src">
								<input type="hidden" class="avatar-data" name="avatar_data">
								<label for="avatarInput">Upload avatar</label>
								<input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
							</div>

							<!-- Crop and preview -->
							<div class="row">
								<div class="col-md-9">
									<div class="avatar-wrapper"></div>
								</div>
								<div class="col-md-3">
									<div class="avatar-preview preview-lg"></div>
								</div>
							</div>

							<div class="row avatar-btns">
								<div class="col-md-9">
									<div class="btn-group">
										<button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Phóng to">
											<span class="docs-tooltip" data-toggle="tooltip" title="Phóng to">
												<span class="fa fa-search-plus"></span>
											</span>
										</button>
										<button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Thu nhỏ">
											<span class="docs-tooltip" data-toggle="tooltip" title="Thu nhỏ">
												<span class="fa fa-search-minus"></span>
											</span>
										</button>
									</div>

									<div class="btn-group">
										<button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Sang trái">
											<span class="docs-tooltip" data-toggle="tooltip" title="Sang trái">
												<span class="fa fa-arrow-left"></span>
											</span>
										</button>
										<button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Sang phải">
											<span class="docs-tooltip" data-toggle="tooltip" title="Sang phải">
												<span class="fa fa-arrow-right"></span>
											</span>
										</button>
										<button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Lên trên">
											<span class="docs-tooltip" data-toggle="tooltip" title="Lên trên">
												<span class="fa fa-arrow-up"></span>
											</span>
										</button>
										<button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Xuống dưới">
											<span class="docs-tooltip" data-toggle="tooltip" title="Xuống dưới">
												<span class="fa fa-arrow-down"></span>
											</span>
										</button>
									</div>

									<div class="btn-group">
										<button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Xoay trái">
											<span class="docs-tooltip" data-toggle="tooltip" title="Xoay trái">
												<span class="fa fa-rotate-left"></span>
											</span>
										</button>
										<button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Xoay phải">
											<span class="docs-tooltip" data-toggle="tooltip" title="Xoay phải">
												<span class="fa fa-rotate-right"></span>
											</span>
										</button>
									</div>

									<div class="btn-group">
										<button type="button" class="btn btn-primary" data-flip="horizontal" data-method="scale" data-option="-1" data-second-option="1" title="Xoay ngang">
											<span class="docs-tooltip" data-toggle="tooltip" title="Xoay ngang">
												<span class="fa fa-arrows-h"></span>
											</span>
										</button>
										<button type="button" class="btn btn-primary" data-flip="vertical" data-method="scale" data-option="1" data-second-option="-1" title="Xoay dọc">
											<span class="docs-tooltip" data-toggle="tooltip" title="Xoay dọc">
												<span class="fa fa-arrows-v"></span>
											</span>
										</button>
									</div>

									<div class="btn-group">
										<button type="button" class="btn btn-primary" data-method="disable" title="Tắt crop">
											<span class="docs-tooltip" data-toggle="tooltip" title="Tắt crop">
												<span class="fa fa-lock"></span>
											</span>
										</button>
										<button type="button" class="btn btn-primary" data-method="enable" title="Mở crop">
											<span class="docs-tooltip" data-toggle="tooltip" title="Mở crop">
												<span class="fa fa-unlock"></span>
											</span>
										</button>
									</div>
								</div>
								<div class="col-md-3">
									<button type="submit" class="btn btn-primary btn-block avatar-save">Hoàn tất</button>
								</div>
							</div>
						</div>
					</div>
					<!-- <div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div> -->
				</form>
			</div>
		</div>
	</div><!-- /.modal -->

	<!-- Loading state -->
	<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
</div>
<?php get_footer(); ?>