<?php
/**
 * Class provided for mock WordPress MO class
 *
 * @link       https://motivast.com
 * @since      0.1.0
 *
 * @package    Blog
 * @subpackage Blog/tests/sample
 * @author     Motivast <hello@motivast.com>
 */

/**
 * Class provided for mock WordPress MO class
 *
 * @link       https://motivast.com
 * @since      0.1.0
 *
 * @package    Blog
 * @subpackage Blog/tests/sample
 * @author     Motivast <hello@motivast.com>
 */
class MO {

	/**
	 * All translations
	 *
	 * @var array
	 */
	public $entries;

	/**
	 * Method for adding translations
	 *
	 * @param string $entry Translation.
	 */
	public function add_entry( $entry ) {

		$this->entries[ $entry ] = $entry;
	}
}
