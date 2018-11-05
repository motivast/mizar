<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @package    Mizar
 * @subpackage Mizar/inc
 */

namespace Mizar\Core;

use Mizar\Theme\Init as ThemeInit;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin.
 *
 * @package    Mizar
 * @subpackage Mizar/inc
 */
class Init extends Container {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @var      Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin id that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 */
	public function __construct() {

		/**
		 * The unique identifier of this plugin.
		 *
		 * @var      string $id The string used to uniquely identify this theme.
		 */
		$this['id'] = 'blog';

		/**
		 * The unique name of this plugin.
		 *
		 * @var      string $name The string used to display theme name.
		 */
		$this['name'] = 'Mizar';

		/**
		 * The plugin path.
		 *
		 * @var string $path The plugin path
		 */
		$this['path'] = realpath( plugin_dir_path( __FILE__ ) . '/../../' );

		/**
		 * The plugin url.
		 *
		 * @var string $url The plugin url
		 */
		$this['url'] = rtrim( plugin_dir_url( $this['path'] . '/blog.php' ), '/' );

	}

	/**
	 * Define the locale for this theme for internationalization.
	 *
	 * Uses the I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 */
	private function set_locale() {

		$this['i18n'] = new I18n( $this );
		$this['i18n']->load_plugin_textdomain();
	}

	/**
	 * Load the required core dependencies for this theme.
	 *
	 * Include the following files that make up the theme:
	 *
	 * - Loader. Orchestrates the hooks of the theme.
	 */
	private function load_core_dependencies() {

		$this['loader'] = new Loader( $this );
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - YourClass. What this class is doing?
	 */
	private function load_dependencies() {
		$this['theme'] = new ThemeInit( $this );
	}

	/**
	 * Load and init all dependencies
	 *
	 * This method is public because we need it during tests without running
	 * run method.
	 */
	public function load() {

		/**
		 * Load translations before anything. Some plugins like acf do not attach
		 * into any hook so translations does not has a chance to work.
		 */
		$this->set_locale();

		$this->load_core_dependencies();
		$this->load_dependencies();
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 */
	public function run() {

		// Load dependecies
		$this->load();

		// Run components
		$this['theme']->run();

		// Loader must bu executed as the last because it is loading all hooks.
		$this['loader']->run();
	}
}
