<?php
/**
 * Class provided for manage theme subpackage
 *
 * @link       http://viewone.pl
 * @since      1.0.0
 *
 * @package    Mizar
 * @subpackage Mizar/inc/theme
 * @author     ViewOne <support@viewone.pl>
 */

namespace Mizar\Theme;

use Mizar\Theme\Customizer\Init as CustomizerInit;

/**
 * Class provided for manage theme subpackage
 *
 * This class is main class for theme subpackage it include all required files
 * create instances and define hooks.
 *
 * @since      1.0.0
 * @package    Mizar
 * @subpackage Mizar/inc/theme
 * @author     ViewOne <support@viewone.pl>
 */
class Init {


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
	 * Load the required dependencies for theme subpackage.
	 *
	 * Include the following files that make up the theme:
	 *
	 * - Setup  Setup theme
	 * - Assets Manage theme assets
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		include 'functions.php';

		$this->theme['theme/setup']  = new Setup( $this->theme );
		$this->theme['theme/assets'] = new Assets( $this->theme );
		$this->theme['theme/uploader'] = new Uploader( $this->theme );
		$this->theme['theme/customizer'] = new CustomizerInit( $this->theme );
	}

	/**
	 * Run dependencies
	 *
	 * @since    1.0.0
	 */
	public function run() {

		$this->load_dependencies();

		$this->theme['theme/setup']->run();
		$this->theme['theme/assets']->run();
		$this->theme['theme/uploader']->run();
		$this->theme['theme/customizer']->run();
	}
}
