<?php
/**
 * Class to test core loader class.
 *
 * @link       https://motivast.com
 * @since      0.1.0
 *
 * @package    Blog
 * @subpackage Blog/tests/core
 * @author     Motivast <hello@motivast.com>
 */

namespace BlogTests\Core;

use WP_Mock\Tools\TestCase;

use Blog\Core\Loader;

/**
 * Class to test core loader class.
 *
 * @link       https://motivast.com
 * @since      0.1.0
 *
 * @package    Blog
 * @subpackage Blog/tests/core
 * @author     Motivast <hello@motivast.com>
 */
class Loader_Test extends TestCase {

	/**
	 * Setup test
	 */
	public function setUp() {
		\WP_Mock::setUp();
	}

	/**
	 * Terminate test
	 */
	public function tearDown() {
		\WP_Mock::tearDown();
	}

	/**
	 * Test if loader is calling add_action function
	 */
	function test_loader_is_calling_add_action() {

		$object              = new \stdClass();
		$object->some_method = function() {};

		/**
		 * Mock add_action function
		 */
		\WP_Mock::expectActionAdded( 'init', array( $object, 'some_method' ), 1, 10 );

		$loader = new Loader( array() );
		$loader->add_action( 'init', $object, 'some_method', 1, 10 );

		$loader->run();
	}

	/**
	 * Test if loader is calling add_filter function
	 */
	function test_loader_is_calling_add_filter() {

		$object              = new \stdClass();
		$object->some_method = function() {};

		/**
		 * Mock add_action function
		 */
		\WP_Mock::expectFilterAdded( 'the_content', array( $object, 'some_method' ), 1, 10 );

		$loader = new Loader( array() );
		$loader->add_filter( 'the_content', $object, 'some_method', 1, 10 );

		$loader->run();
	}
}
