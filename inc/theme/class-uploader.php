<?php
/**
 * Class provided for manage WordPress uploader
 *
 * @link       http://viewone.pl
 * @since      1.0.0
 *
 * @package    Mizar
 * @subpackage Mizar/inc/theme
 * @author     Motivast <hello@motivast.com>
 */

namespace Mizar\Theme;

/**
 * Class provided for manage WordPress uploader
 *
 * @since      1.0.0
 * @package    Mizar
 * @subpackage Mizar/inc/theme
 * @author     Motivast <hello@motivast.com>
 */
class Uploader {

	/**
	 * Theme container.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object $theme Mizar Theme container
	 */
	private $theme;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    object $theme Mizar Theme container.
	 */
	public function __construct( $theme ) {

		$this->theme = $theme;
	}

	/**
	 * Allow to upload svg files
	 *
	 * @param array $mimes Array of allowed mimetypes to upload
	 *
	 * @return array
	 */
	public function allow_for_svg( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}

	/**
	 * Register all of the hooks related to the theme assets
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	public function run() {
		$this->theme['loader']->add_filter( 'upload_mimes', $this, 'allow_for_svg' );
	}
}
