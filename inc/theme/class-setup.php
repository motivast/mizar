<?php
/**
 * Class provided for setup theme
 *
 * @link       https://motivast.com
 *
 * @package    Mizar
 * @subpackage Mizar/inc/theme
 *
 * @author     Motivast <hello@motivast.com>
 */

namespace Mizar\Theme;

/**
 * Class provided for setup theme
 *
 * This class define all menus provided for theme.
 *
 * @package    Mizar
 * @subpackage Mizar/inc/theme
 *
 * @author     Motivast <hello@motivast.com>
 */
class Setup {


	/**
	 * Theme container.
	 *
	 * @var object $theme Mizar Theme container
	 */
	private $theme;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @param  object $theme Mizar Theme container.
	 */
	public function __construct( $theme ) {

		$this->theme = $theme;
	}

	/**
	 * Aggregate all setup actions in one setup method
	 *
	 * @return void
	 */
	public function setup() {

		$this->add_supported_features();
		$this->add_supported_image_sizes();
	}

	/**
	 * Add supported features
	 *
	 * @link https://codex.wordpress.org/Function_Reference/add_theme_support
	 *
	 * @return void
	 */
	private function add_supported_features() {

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails', array( 'post' ) );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	}

	/**
	 * Add supported image sizes
	 *
	 * @return void
	 */
	private function add_supported_image_sizes() {}

	/**
	 * Register all of the hooks related to the theme core functionality
	 * of the theme.
	 *
	 * @return void
	 */
	public function run() {

		$this->theme['loader']->add_action( 'after_setup_theme', $this, 'setup' );
	}
}
