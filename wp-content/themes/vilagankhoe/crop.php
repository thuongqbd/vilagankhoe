<?php

class CropAvatar {

	private $src;
	private $src_name;
	private $data;
	private $dst;
	private $dst_name;
	private $type;
	private $extension;
	private $msg;
	private $upload_dir;
	private $upload_url;

	function __construct($src, $data, $file) {
		$wp_upload_dir = wp_upload_dir();
		$this->upload_dir = $wp_upload_dir['basedir'] . "/avatars/";
		$this->upload_url = $wp_upload_dir['baseurl'] . "/avatars/";
		$this->setSrc($src);
		$this->setData($data);
		$this->setFile($file);
		$result = $this->crop($this->src, $this->dst, $this->data);
		if($result)
			$this->watermark_image($this->data);
	}

	private function setSrc($src) {
		if (!empty($src)) {
			$type = exif_imagetype($src);

			if ($type) {
				$this->src = $src;
				$this->type = $type;
				$this->extension = image_type_to_extension($type);
				$this->setDst();
			}
		}
	}

	private function setData($data) {
		if (!empty($data)) {
			$this->data = json_decode(stripslashes($data));
		}
	}

	private function setFile($file) {
		$errorCode = $file['error'];

		if ($errorCode === UPLOAD_ERR_OK) {
			$type = exif_imagetype($file['tmp_name']);

			if ($type) {
				$extension = image_type_to_extension($type);
				$this->src_name = date('YmdHis') . '.original' . $extension;
				$src = $this->upload_dir . $this->src_name;
				if ($type == IMAGETYPE_GIF || $type == IMAGETYPE_JPEG || $type == IMAGETYPE_PNG) {

					if (file_exists($src)) {
						unlink($src);
					}

					$result = move_uploaded_file($file['tmp_name'], $src);

					if ($result) {
						$this->src = $src;
						$this->type = $type;
						$this->extension = $extension;
						$this->setDst();
					} else {
						$this->msg = 'Không thể lưu file.'; //'Failed to save file';
					}
				} else {
					$this->msg = 'Vui lòng chọn các loại file như sau: JPG, PNG, GIF'; //'Please upload image with the following types: JPG, PNG, GIF';
				}
			} else {
				$this->msg = 'Vui lòng upload một file hình.'; //'Please upload image file';
			}
		} else {
			$this->msg = $this->codeToMessage($errorCode);
		}
	}

	private function setDst($ext = '') {
		$this->dst_name = date('YmdHis') . $ext . '.png';
		$this->dst = $this->upload_dir . $this->dst_name;
	}

	private function crop($src, $dst, $data) {
		if (!empty($src) && !empty($dst) && !empty($data)) {
			switch ($this->type) {
				case IMAGETYPE_GIF:
					$src_img = imagecreatefromgif($src);
					break;

				case IMAGETYPE_JPEG:
					$src_img = imagecreatefromjpeg($src);
					break;

				case IMAGETYPE_PNG:
					$src_img = imagecreatefrompng($src);
					break;
			}

			if (!$src_img) {
				$this->msg = 'Không thể dọc file.'; //"Failed to read the image file";
				return false;
			}

			$size = getimagesize($src);
			$size_w = $size[0]; // natural width
			$size_h = $size[1]; // natural height

			$src_img_w = $size_w;
			$src_img_h = $size_h;

			$degrees = $data->rotate;

			// Rotate the source image
			if (is_numeric($degrees) && $degrees != 0) {
				// PHP's degrees is opposite to CSS's degrees
				$new_img = imagerotate($src_img, -$degrees, imagecolorallocatealpha($src_img, 0, 0, 0, 127));

				imagedestroy($src_img);
				$src_img = $new_img;

				$deg = abs($degrees) % 180;
				$arc = ($deg > 90 ? (180 - $deg) : $deg) * M_PI / 180;

				$src_img_w = $size_w * cos($arc) + $size_h * sin($arc);
				$src_img_h = $size_w * sin($arc) + $size_h * cos($arc);

				// Fix rotated image miss 1px issue when degrees < 0
				$src_img_w -= 1;
				$src_img_h -= 1;
			}

			$tmp_img_w = $data->width;
			$tmp_img_h = $data->height;
			// $dst_img_w = 220;
			// $dst_img_h = 220;
			$dst_img_w = $data->width;
			$dst_img_h = $data->height;

			$src_x = $data->x;
			$src_y = $data->y;

			if ($src_x <= -$tmp_img_w || $src_x > $src_img_w) {
				$src_x = $src_w = $dst_x = $dst_w = 0;
			} else if ($src_x <= 0) {
				$dst_x = -$src_x;
				$src_x = 0;
				$src_w = $dst_w = min($src_img_w, $tmp_img_w + $src_x);
			} else if ($src_x <= $src_img_w) {
				$dst_x = 0;
				$src_w = $dst_w = min($tmp_img_w, $src_img_w - $src_x);
			}

			if ($src_w <= 0 || $src_y <= -$tmp_img_h || $src_y > $src_img_h) {
				$src_y = $src_h = $dst_y = $dst_h = 0;
			} else if ($src_y <= 0) {
				$dst_y = -$src_y;
				$src_y = 0;
				$src_h = $dst_h = min($src_img_h, $tmp_img_h + $src_y);
			} else if ($src_y <= $src_img_h) {
				$dst_y = 0;
				$src_h = $dst_h = min($tmp_img_h, $src_img_h - $src_y);
			}

			// Scale to destination position and size
			$ratio = $tmp_img_w / $dst_img_w;
			$dst_x /= $ratio;
			$dst_y /= $ratio;
			$dst_w /= $ratio;
			$dst_h /= $ratio;

			$dst_img = imagecreatetruecolor($dst_img_w, $dst_img_h);

			// Add transparent background to destination image
			imagefill($dst_img, 0, 0, imagecolorallocatealpha($dst_img, 0, 0, 0, 127));
			imagesavealpha($dst_img, true);

			$result = imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

			if ($result) {
				if (!imagepng($dst_img, $dst)) {
					$this->msg = 'Đã xãy ra lỗi trong quá trình lưu file.'; //"Failed to save the cropped image file";
					return false;
				}
			} else {
				$this->msg = 'Đã xãy ra lỗi trong quá trình crop file.'; //"Failed to crop the image file";
				return false;
			}

			imagedestroy($src_img);
			imagedestroy($dst_img);
			return true;
		}
	}

	function watermark_image($data) {
		//main watermark
		$image_path = get_stylesheet_directory() . '/images/watermark.png';
		list($w_width, $w_height) = getimagesize($image_path);

		//
		$oldimage_name = $this->dst;
		list($owidth, $oheight) = getimagesize($oldimage_name);

		//new watermark wifth and height
		if ($data->width && $data->height) {
			$new_w_width = $data->width;
			$new_w_height = $data->height;
		} else {
			$new_w_width = $owidth;
			$new_w_height = $oheight;
		}
		// resize the original watermark image to size of editor
		$watermark_new = get_stylesheet_directory() . '/images/waternew_' . date('YmdHis') . '.png';
		$watermark_src = imagecreatefrompng($image_path);
		$watermark = imagecreatetruecolor($new_w_width, $new_w_height);
		imagealphablending($watermark, false);
		imagesavealpha($watermark, true);
		$transparent = imagecolorallocatealpha($watermark, 255, 255, 255, 127);
		imagefilledrectangle($watermark, 0, 0, $new_w_width, $new_w_height, $transparent);
		imagecopyresampled($watermark, $watermark_src, 0, 0, 0, 0, $new_w_width, $new_w_height, $w_width, $w_height);
		imagepng($watermark, $watermark_new);


		$width = $new_w_width;
		$height = $new_w_height;

		$im = imagecreatetruecolor($width, $height);
		$img_src = imagecreatefrompng($oldimage_name);
		imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);

		list($w_width, $w_height) = getimagesize($watermark_new);
		$pos_x = $width - $w_width;
		$pos_y = $height - $w_height;
		imagecopy($im, $watermark, $pos_x, $pos_y, 0, 0, $w_width, $w_height);
		$this->setDst('_new_avatar');
		imagejpeg($im, $this->dst, 100);
		imagedestroy($im);
		@unlink($oldimage_name);
		@unlink($watermark);
		$upload_avatar_page_id = get_option('upload_avatar_page_id', 1);
		$meta_id = add_post_meta($upload_avatar_page_id, 'avatars', $this->getResult());

		return true;
	}

	private function codeToMessage($code) {
		$errors = array(
		UPLOAD_ERR_INI_SIZE => 'Kích thước file vượt quá giới hạn cho phép, tối đa 2M.',
		UPLOAD_ERR_FORM_SIZE => 'Kích thước file vượt quá giới hạn cho phép, tối đa 2M.',
		UPLOAD_ERR_PARTIAL => 'Đã xãy ra lỗi trong quá trình upload.',//'The uploaded file was only partially uploaded',
		UPLOAD_ERR_NO_FILE => 'Đã xãy ra lỗi trong quá trình upload.',//'No file was uploaded',
		UPLOAD_ERR_NO_TMP_DIR => 'Đã xãy ra lỗi trong quá trình upload.',//'Missing a temporary folder',
		UPLOAD_ERR_CANT_WRITE => 'Đã xãy ra lỗi trong quá trình upload.',//'Failed to write file to disk',
		UPLOAD_ERR_EXTENSION => 'Loại file không được hỗ trợ.'//'File upload stopped by extension',
		);

		if (array_key_exists($code, $errors)) {
			return $errors[$code];
		}

		return 'Lỗi không xác định'; //'Unknown upload error';
	}

	public function getResult() {
		return !empty($this->data) ? $this->upload_url . $this->dst_name : $this->upload_url . $this->src_name;
	}

	public function getMsg() {
		return $this->msg;
	}

}
