<?php
/**
 * PHPUnit bootstrap file
 *
 * @package Blog
 */

/**
 * Load autoloader to not bother to requiring classes.
 */
require_once './vendor/autoload.php';
require_once './inc/autoloader.php';

require_once './inc/core/functions.php';

WP_Mock::bootstrap();
