<?php
/**
 * Class provided for manage theme customizer
 *
 * @link       https://motivast.com
 *
 * @package    Mizar
 * @subpackage Mizar/inc/theme/customizer
 * @author     Motivast <hello@motivast.com>
 */

namespace Mizar\Theme\Customizer;

/**
 * Class provided for manage theme customizer
 *
 * This class is main class for theme customizer it include all required files
 * create instances and define hooks.
 *
 * @package    Mizar
 * @subpackage Mizar/inc/theme/customizer
 * @author     Motivast <hello@motivast.com>
 */
class Init {


	/**
	 * Theme container.
	 *
	 * @var object $theme Mizar Theme container
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

		$this->theme['theme/customizer/header'] = new Header( $this->theme );
	}

	/**
	 * Run dependencies
	 *
	 * @since    1.0.0
	 */
	public function run() {

		$this->load_dependencies();

		$this->theme['theme/customizer/header']->run();
	}
}
