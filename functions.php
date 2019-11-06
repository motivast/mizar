<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @package           Blog
 *
 * @wordpress-plugin
 * Plugin Name:       Blog
 * Description:       Blog is rewards & commission automation engine that helps businesses create their referral, loyalty, MLM, gamification or social selling program on the top of existing e-commerce platforms or CRM's.
 * Version:           0.1.0
 * Author:            Motivast
 * Author URI:        https://motivast.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       blog
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'MIZAR_VERSION' ) )
	define( 'MIZAR_VERSION', '0.2.1' );

/**
 * Load autoloader to not bother to requiring classes.
 */
require_once plugin_dir_path( __FILE__ ) . 'inc/autoloader.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/core/functions.php';

mizar();
