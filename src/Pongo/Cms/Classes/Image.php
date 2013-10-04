<?php namespace Pongo\Cms\Classes;

use PHPImageWorkshop\ImageWorkshop as ImageWorkshop;

use Config, Theme, Tool;

class Image {

	/**
	 * Image compression quality
	 * 
	 * @var int
	 */
	private $image_quality;

	/**
	 * Upload path
	 * 
	 * @var string
	 */
	private $upload_path;

	/**
	 * Class constructor
	 * 
	 * @param File $file
	 */
	public function __construct(ImageWorkshop $imageWorkshop )
	{
		$this->ImageWorkshop = $imageWorkshop;
		$this->image_quality = Config::get('cms::settings.image_quality');
		$this->upload_path = public_path(Config::get('cms::settings.upload_path').'img');
	}

	/**
	 * Create a new thumb
	 * 
	 * @param  object $image
	 * @param  string $thumb_name
	 * @param  string $thumb
	 * @return void
	 */
	public function createThumb($image, $file_name, $thumb)
	{
		$w = Theme::config('thumb.'.$thumb.'.width');
		$h = Theme::config('thumb.'.$thumb.'.height');

		$image->cropMaximumInPixel(0, 0, "MM");
		$image->resizeInPixel($w, $h);

		$thumb_name = Tool::formatFileThumb($file_name);
		
		$this->save($image, $thumb_name);
	}

	/**
	 * Get image instance through ImageWorkshop
	 * 
	 * @param  string $file_path
	 * @return object
	 */
	public function get($file_path)
	{
		return $this->ImageWorkshop->initFromPath($file_path);
	}

	/**
	 * Save thumb to /img path
	 * @param  object $image
	 * @param  string $thumb_name
	 * @return void
	 */
	public function save($image, $thumb_name)
	{
		$image->save($this->upload_path, $thumb_name, true, null, $this->image_quality);
	}

}