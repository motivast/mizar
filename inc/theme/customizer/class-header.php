<?php
/**
 * Class provided for manage theme customizer header section
 *
 * @link       https://motivast.com
 *
 * @package    Mizar
 * @subpackage Mizar/inc/theme/customizer
 * @author     Motivast <hello@motivast.com>
 */

namespace Mizar\Theme\Customizer;

/**
 * Class provided for manage theme customizer header section
 *
 * @package    Mizar
 * @subpackage Mizar/inc/theme/customizer
 * @author     Motivast <hello@motivast.com>
 */
class Header {

	/**
	 * Theme container.
	 *
	 * @var object $theme Mizar Theme container
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
	 * Register customizer header settings
	 */
	public function register() {

		global $wp_customize;

		$wp_customize->add_section( 'mizar_header_options', array(
			'title'       => __( 'Header', 'mizar' ),
			'priority'    => 35,
			'capability'  => 'edit_theme_options',
			'description' => __('Allows you to customize some header settings.', 'mizar'),
		));

		$wp_customize->add_setting( 'mizar_header', array(
			'default'    => null,
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage',
		));

		$wp_customize->add_setting( 'mizar_header_logo', array(
			'default'    => null,
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage',
		));

		$wp_customize->add_setting( 'mizar_header_logo_width', array(
			'default'    => null,
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage',
		));

		$wp_customize->add_setting( 'mizar_header_logo_height', array(
			'default'    => null,
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage',
		));

		$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'mizar_header_logo', array(
			'label'      => __( 'Logo', 'mizar' ),
			'settings'   => 'mizar_header_logo',
			'priority'   => 10,
			'section'    => 'mizar_header_options',
			'description' => __('For the best result upload your logo twice the size for retina displays. You can also upload logo in svg format.', 'mizar'),
		)));

		$wp_customize->add_control( 'mizar_header_logo_width', array(
			'type'     => 'text',
			'label'    => __( 'Logo width', 'mizar' ),
			'settings'   => 'mizar_header_logo_width',
			'priority' => 20,
			'section'  => 'mizar_header_options',
			'description' => __('Specify logo width size.', 'mizar'),
		));

		$wp_customize->add_control( 'mizar_header_logo_height', array(
			'type'     => 'text',
			'label'    => __( 'Logo height', 'mizar' ),
			'settings'   => 'mizar_header_logo_height',
			'priority' => 30,
			'section'  => 'mizar_header_options',
			'description' => __('Specify logo height size.', 'mizar'),
		));
	}

	/**
	 * Create dynamic size for logo and save metadata
	 *
	 * @param \WP_Customize_Manager $manager Cusomizer manager
	 */
	public function resize_logo( $manager ) {

		// If there are no customized data do not do anything
		if( !isset( $_POST['customized'] ) ) {
			return;
		}

		// If there are no customized logo do not do anything
		$data = json_decode( stripslashes( $_POST['customized'] ), true );

		if( !isset( $data['mizar_header_logo'] ) ) {
			return;
		}

		// If there is no required properties do not do anything
		$logo   = get_theme_mod( 'mizar_header_logo' );
		$width  = get_theme_mod( 'mizar_header_logo_width' );
		$height = get_theme_mod( 'mizar_header_logo_height' );

		// We can not resize logo if do not not have at least width or height
		if( !$width && !$height ){
			return;
		}

		$logo_id   = attachment_url_to_postid( $logo );
		$logo_path = get_attached_file( $logo_id );

		$logo_mime_type = get_post_mime_type( $logo_id );

		// If uploaded logo is in svg only save base size of the image
		if( $logo_mime_type === 'image/svg+xml' ) {

			$metadata = wp_get_attachment_metadata( $logo_id );

			if( isset( $metadata['sizes'] ) ) {

				$metadata['sizes']['logo'] = [
					'file' => pathinfo( $metadata['file'], PATHINFO_BASENAME ),
					'width' => $metadata['width'],
					'height' => $metadata['height'],
					'mime-type' => 'image/svg+xml',
				];

				wp_update_attachment_metadata( $logo2x_id, $metadata );
			}

			return;
		}

		// If mime type of the image is not image/png or image/jpeg do not do anything
		if( $logo_mime_type === 'image/jpeg' || $logo_mime_type === 'image/png' ) {

			// Resize logo, if there are no $height or $width use 9999
			$image_editor = wp_get_image_editor( $logo_path );
			$image_editor->resize( ( $width ) ? $width : 9999, ( $height ) ? $height : 9999 );

			$logo_resized = $image_editor->save();

			if ( ! is_wp_error( $logo_resized ) && $logo_resized ) {

				$metadata = wp_get_attachment_metadata( $logo_id );

				if( isset( $metadata['sizes'] ) ) {

					$metadata['sizes']['logo@2x'] = [
						'file' => pathinfo( $metadata['file'], PATHINFO_BASENAME ),
						'width' => $metadata['width'],
						'height' => $metadata['height'],
						'mime-type' => $logo_resized['mime-type'],
					];

					$metadata['sizes']['logo'] = [
						'file' => $logo_resized['file'],
						'width' => $logo_resized['width'],
						'height' => $logo_resized['height'],
						'mime-type' => $logo_resized['mime-type'],
					];

					wp_update_attachment_metadata( $logo2x_id, $metadata );
				}
			}

			return;
		}
	}

	/**
	 * Run dependencies
	 *
	 * @since    1.0.0
	 */
	public function run() {

		$this->theme['loader']->add_action('customize_register', $this, 'register');
		$this->theme['loader']->add_action('customize_save_after', $this, 'resize_logo');
	}
}
