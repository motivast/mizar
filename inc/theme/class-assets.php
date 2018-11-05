<?php
/**
 * Class provided for manage theme assets
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
 * Class provided for manage theme assets
 *
 * This class define and attach all assets provided for theme.
 *
 * @since      1.0.0
 * @package    Mizar
 * @subpackage Mizar/inc/theme
 * @author     Motivast <hello@motivast.com>
 */
class Assets {

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
	 * Register scripts.
	 *
	 * Register all scripts for theme. This method do not attach scripts to html.
	 * Scripts are only registered. If you want to enqueue script from this method
	 * you must to use wp_enqueue_script function.
	 *
	 * @link https://developer.wordpress.org/reference/functions/wp_register_script
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script
	 *
	 * @since    1.0.0
	 */
	public function register_scripts() {
		wp_register_script( $this->theme['id'], $this->theme['url'] . '/js/scripts.bundle.js', array(), $this->theme['version'], true );
	}

	/**
	 * Register production scripts.
	 *
	 * Register all scripts for theme. This method do not attach scripts to html.
	 * Scripts are only registered. If you want to enqueue script from this method
	 * you must to use wp_enqueue_script function.
	 *
	 * @link https://developer.wordpress.org/reference/functions/wp_register_script
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script
	 *
	 * @since    1.0.0
	 */
	public function register_min_scripts() {
		wp_register_script( $this->theme['id'], $this->theme['url'] . '/js/scripts.min.js', array(), $this->theme['version'], true );
	}

	/**
	 * Enqueue scripts.
	 *
	 * Enqueue scripts for theme. In this method scripts previously declared with
	 * wp_register_scripts are actually attached to site html.
	 *
	 * @link https://developer.wordpress.org/reference/functions/wp_register_script
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->theme['id'] );
	}

	/**
	 * Enqueue scripts.
	 *
	 * Enqueue scripts for theme. In this method scripts previously declared with
	 * wp_register_scripts are actually attached to site html.
	 *
	 * @link https://developer.wordpress.org/reference/functions/wp_register_script
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script
	 *
	 * @since    1.0.0
	 */
	public function enqueue_min_scripts() {

		$this->enqueue_scripts();
	}

	/**
	 * Register styles.
	 *
	 * Register all styles for theme. This method do not attach styles to html.
	 * Styles are only registered. If you want to enqueue styles from this method
	 * you must to use wp_enqueue_style function.
	 *
	 * @link https://developer.wordpress.org/reference/functions/wp_register_style
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style
	 *
	 * @since    1.0.0
	 */
	public function register_styles() {

		/**
		 * Main theme style
		 */
		wp_register_style( $this->theme['id'], $this->theme['url'] . '/css/style.css', array(), $this->theme['version'], 'all' );
	}

	/**
	 * Register styles.
	 *
	 * Register all styles for theme. This method do not attach styles to html.
	 * Styles are only registered. If you want to enqueue styles from this method
	 * you must to use wp_enqueue_style function.
	 *
	 * @link https://developer.wordpress.org/reference/functions/wp_register_style
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style
	 *
	 * @since    1.0.0
	 */
	public function register_min_styles() {

		/**
		 * Main theme style
		 */
		wp_register_style( $this->theme['id'], $this->theme['url'] . '/css/style.min.css', array(), $this->theme['version'], 'all' );
	}

	/**
	 * Enqueue styles.
	 *
	 * Enqueue styles for theme. In this method styles previously declared with
	 * wp_register_style are actually attached to site html.
	 *
	 * @link https://developer.wordpress.org/reference/functions/wp_register_style
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * Main theme style
		 */
		wp_enqueue_style( $this->theme['id'] );
	}

	/**
	 * Enqueue styles.
	 *
	 * Enqueue styles for theme. In this method styles previously declared with
	 * wp_register_style are actually attached to site html.
	 *
	 * @link https://developer.wordpress.org/reference/functions/wp_register_style
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style
	 *
	 * @since    1.0.0
	 */
	public function enqueue_min_styles() {

		$this->enqueue_styles();
	}

	/**
	 * Register all of the hooks related to the theme assets
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	public function run() {

		if ( defined( 'MZ_DEBUG_STYLES' ) && MZ_DEBUG_STYLES ) {

			$this->theme['loader']->add_action( 'wp_enqueue_scripts', $this, 'register_styles' );
			$this->theme['loader']->add_action( 'wp_enqueue_scripts', $this, 'enqueue_styles' );
		} else {

			$this->theme['loader']->add_action( 'wp_enqueue_scripts', $this, 'register_min_styles' );
			$this->theme['loader']->add_action( 'wp_enqueue_scripts', $this, 'enqueue_min_styles' );
		}

		if ( defined( 'MZ_DEBUG_SCRIPTS' ) && MZ_DEBUG_SCRIPTS ) {

			$this->theme['loader']->add_action( 'wp_enqueue_scripts', $this, 'register_scripts' );
			$this->theme['loader']->add_action( 'wp_enqueue_scripts', $this, 'enqueue_scripts' );

		} else {

			$this->theme['loader']->add_action( 'wp_enqueue_scripts', $this, 'register_min_scripts' );
			$this->theme['loader']->add_action( 'wp_enqueue_scripts', $this, 'enqueue_min_scripts' );
		}
	}
}
