<?php
/**
 * File provided for custom theme core functions
 *
 * @package    Mizar
 * @subpackage Mizar/inc/core
 */

/**
 * Begins execution of the theme.
 *
 * Since everything within the theme is registered via hooks,
 * then kicking off the theme from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function mizar() {

	static $theme;

	if ( isset( $theme ) && $theme instanceof \Mizar\Core\Init ) {
		return $theme;
	}

	$theme = new \Mizar\Core\Init();
	$theme->run();

}
