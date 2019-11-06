<?php
/**
 * Class provided for manage nav menu
 *
 * @link       http://viewone.pl
 * @since      1.0.0
 *
 * @package    Mizar
 * @subpackage Mizar/inc/theme
 * @author     ViewOne <support@viewone.pl>
 */

namespace Mizar\Theme;

/**
 * Class provided for manage nav menu
 *
 * If we want to have well formated css we need to have additional classes for
 * sub-menu elements. We are not use floats for nav elements so indentation
 * can cause some unnecessary empty spaces between elements.
 *
 * @since      1.0.0
 * @package    Mizar
 * @subpackage Mizar/inc/theme
 * @author     ViewOne <support@viewone.pl>
 */
class Nav {


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
	 * Add wp_nav_menu new classes
	 *
	 * @since 1.0.0
	 *
	 * @param array $args Arguments.
	 *
	 * @return array $args Arguments
	 */
	public function add_additional_classes( $args ) {

		$additional = array();

		if ( isset( $args['theme_location_class'] ) && $args['theme_location_class'] ) {
			$theme_location_class = $args['theme_location_class'];
		} else {
			$theme_location_class = $args['theme_location'];
		}

		$level = 'nav__level-0';
		$level_theme = sprintf('nav--%s--level-0', $theme_location_class );

		$args['container_class'] .= sprintf( 'nav nav--%s', $theme_location_class );
		$args['menu_class']      .= sprintf( ' menu %s %s', $level, $level_theme );

		$args = array_merge( $args, $additional );

		return $args;
	}

	/**
	 * Add additional classes to item
	 *
	 * @param array    $classes The CSS classes that are applied to the menu `<ul>` element.
	 * @param WP_Post  $item    The current menu item.
	 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
	 * @param int      $depth   Depth of menu item. Used for padding.
	 *
	 * @return array Submenu classes
	 *
	 * @SuppressWarnings(PHPMD.UnusedFormalParameter) // We are overwriting wp function and all parameters are mandatory
	 */
	public function add_additional_classes_to_item( $classes, $item, $args, $depth ) {

		if ( isset( $args->theme_location_class ) && $args->theme_location_class ) {
			$theme_location_class = $args->theme_location_class;
		} else {
			$theme_location_class = $args->theme_location;
		}

		$classes[] = 'nav__item';
		$classes[] = sprintf('nav--%s__item', $theme_location_class);
		$classes[] = 'nav--level-' . $depth . '__item';
		$classes[] = sprintf('nav--%s--level-%s__item', $theme_location_class, $depth);

		return $classes;

	}

	/**
	 * Add additional classes to sub menu
	 *
	 * @param array    $classes The CSS classes that are applied to the menu `<ul>` element.
	 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
	 * @param int      $depth   Depth of menu item. Used for padding.
	 *
	 * @return array Submenu classes
	 */
	public function add_additional_classes_to_sub_menu( $classes, $args, $depth ) {

		if ( isset( $args->theme_location_class ) && $args->theme_location_class ) {
			$theme_location_class = $args->theme_location_class;
		} else {
			$theme_location_class = $args->theme_location;
		}

		$classes[] = 'nav--level-' . ( $depth + 1 );
		$classes[] = sprintf('nav--%s--level-%s', $theme_location_class, ( $depth + 1 ));

		return $classes;

	}

	/**
	 * Register all of the hooks related to the theme nav functionality
	 * of the theme.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	public function run() {

		$this->theme['loader']->add_filter( 'wp_nav_menu_args', $this, 'add_additional_classes' );
		$this->theme['loader']->add_filter( 'nav_menu_css_class', $this, 'add_additional_classes_to_item', 10, 4 );
		$this->theme['loader']->add_filter( 'nav_menu_submenu_css_class', $this, 'add_additional_classes_to_sub_menu', 10, 3 );
	}
}
