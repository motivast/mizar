<?php
/**
 * Class to test core container class.
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

use Blog\Core\I18n;

/**
 * Class to test core container class.
 *
 * @link       https://motivast.com
 * @since      0.1.0
 *
 * @package    Blog
 * @subpackage Blog/tests/core
 * @author     Motivast <hello@motivast.com>
 */
class I18n_Test extends TestCase {

	/**
	 * Test if we can save to container
	 */
	function test_i18n_is_calling_method() {

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

		$i18n = new I18n(
			array(
				'id' => 'blog',
			)
		);
		$i18n->load_plugin_textdomain();
	}
}
