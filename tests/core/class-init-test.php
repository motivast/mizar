<?php
/**
 * Class to test core init class.
 *
 * @link       https://motivast.com
 * @since      0.1.0
 *
 * @package    Blog
 * @subpackage Blog/tests/core
 * @author     Motivast <hello@motivast.com>
 */

namespace BlogTests\Core;

use PHPUnit\Framework\TestCase;

use Mockery;

use Blog\Core\Init;

/**
 * Class to test core init class.
 *
 * @link       https://motivast.com
 * @since      0.1.0
 *
 * @package    Blog
 * @subpackage Blog/tests/core
 * @author     Motivast <hello@motivast.com>
 */
class Init_Test extends TestCase {

	/**
	 * Test if init is settings variables
	 */
	function test_init_is_settings_variables() {

		$this->mock_path_and_url_functions();

		$init = new Init();

		$this->assertEquals( 'blog', $init['id'] );
		$this->assertEquals( 'Blog', $init['name'] );
	}

	/**
	 * Test if init is loading core dependencies
	 *
	 * @runInSeparateProcess
	 *
	 * Isolate in separate process because we are already mocking
	 * load_plugin_textdomain in other tests and we do not want break them.
	 */
	function test_init_is_loading_dependencies() {

		$this->mock_path_and_url_functions();

		$init = new Init();

		$this->mock_load_plugin_textdomain();
		$this->mock_get_option_with_plugins();

		$init->load();

		$this->assertInstanceOf( '\Blog\Core\i18n', $init['i18n'] );
		$this->assertInstanceOf( '\Blog\Core\Loader', $init['loader'] );
		$this->assertInstanceOf( '\Blog\Core\Notice', $init['notice'] );

		$this->assertInstanceOf( '\Blog\Admin\Init', $init['admin'] );
		$this->assertInstanceOf( '\Blog\Blog\Init', $init['blog'] );

		$this->assertInstanceOf( '\Blog\WooCommerce\Init', $init['woocommerce'] );
	}

	/**
	 * Test if init is not loading WooCommerce module when WooCommerce is not installed.
	 *
	 * @runInSeparateProcess
	 *
	 * Isolate in separate process because we are already mocking
	 * load_plugin_textdomain in other tests and we do not want break them.
	 */
	function test_init_is_loading_dependencies_without_woocommerce() {

		$this->mock_path_and_url_functions();

		$init = new Init();

		$this->mock_load_plugin_textdomain();
		$this->mock_get_option_without_plugins();

		$init->load();

		$this->assertInstanceOf( '\Blog\Core\i18n', $init['i18n'] );
		$this->assertInstanceOf( '\Blog\Core\Loader', $init['loader'] );
		$this->assertInstanceOf( '\Blog\Core\Notice', $init['notice'] );

		$this->assertInstanceOf( '\Blog\Admin\Init', $init['admin'] );
		$this->assertInstanceOf( '\Blog\Blog\Init', $init['blog'] );

		$this->assertNull( $init['woocommerce'] );
	}

	/**
	 * Test if init is calling run on dependencies
	 *
	 * @runInSeparateProcess
	 *
	 * Isolate in separate process because we are already mocking
	 * load_plugin_textdomain in other tests and we do not want break them.
	 */
	function test_init_is_calling_run_on_dependencies() {

		$this->mock_path_and_url_functions();

		$init = new Init();

		$this->mock_load_plugin_textdomain();
		$this->mock_get_option_with_plugins();

		$init->load();

		$init['admin'] = Mockery::mock( '\Blog\Admin\Init' )
			->shouldReceive( 'run' )
			->once()
			->getMock();

		$init['blog'] = Mockery::mock( '\Blog\Blog\Init' )
			->shouldReceive( 'run' )
			->once()
			->getMock();

		$init['woocommerce'] = Mockery::mock( '\Blog\WooCommerce\Init' )
			->shouldReceive( 'run' )
			->once()
			->getMock();

		$init['edd'] = Mockery::mock( '\Blog\EasyDigitalDownloads\Init' )
			->shouldReceive( 'run' )
			->once()
			->getMock();

		$init['notice'] = Mockery::mock( '\Blog\Core\Notice' )
			->shouldReceive( 'run' )
			->once()
			->getMock();

		$init['loader'] = Mockery::mock( '\Blog\Core\Loader' )
			->shouldReceive( 'run' )
			->once()
			->getMock();

		$init->run();
	}

	/**
	 * Mock load_plugin_textdomain which is called during set_locale method
	 */
	function mock_load_plugin_textdomain() {

		/**
		 * Mock load_plugin_textdomain function
		 */
		\WP_Mock::userFunction(
			'load_plugin_textdomain', array(
				'times' => 1,
				'args'  => array(
					'blog',
					false,
					'blog/languages',
				),
			)
		);
	}

	/**
	 * Mock get_option which is called during loading dependecies when woocommerce plugin is not installed
	 */
	function mock_path_and_url_functions() {

		/**
		 * Mock plugin_dir_path function
		 */
		\WP_Mock::userFunction(
			'plugin_dir_path', array(
				'times' => 1,
				'return' => '/var/www/blog/core/init'
			)
		);

		/**
		 * Mock plugin_dir_path function
		 */
		\WP_Mock::userFunction(
			'plugin_dir_url', array(
				'times' => 1,
				'return' => 'http://blog.local/wp-content/plugins/blog/'
			)
		);
	}

	/**
	 * Mock get_option which is called during loading dependecies when woocommerce plugin is installed
	 */
	function mock_get_option_with_plugins() {

		/**
		 * Mock load_plugin_textdomain function
		 */
		\WP_Mock::userFunction(
			'get_option', array(
				'times' => 1,
				'args'  => array(
					'active_plugins',
				),
				'return' => array(
					'woocommerce/woocommerce.php',
					'easy-digital-downloads/easy-digital-downloads.php'
				)
			)
		);
	}

	/**
	 * Mock get_option which is called during loading dependecies when woocommerce plugin is not installed
	 */
	function mock_get_option_without_plugins() {

		/**
		 * Mock load_plugin_textdomain function
		 */
		\WP_Mock::userFunction(
			'get_option', array(
				'times' => 1,
				'args'  => array(
					'active_plugins',
				),
				'return' => array()
			)
		);
	}
}
