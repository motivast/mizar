<?php
/**
 * The template for displaying the header
 *
 * Displays all of the header element and everything up until the end of the "header--primary" div.
 *
 * @package WordPress
 * @subpackage Blog
 * @since Blog 1.0.0
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1"/>

    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/style.css" media="all">

    <?php
		/**
		 * Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();
	?>

</head>
<body <?php body_class(); ?>>
	<?php echo mizar_logo(); ?>
