<?php
/**
 * Mizar theme functions
 */

if ( ! function_exists( 'mizar_get_logo' ) ) {

	/**
	 * Display logo from theme customizer.
	 *
	 * @return void
	 */
	function mizar_get_logo() {

		$logo   = get_theme_mod( 'mizar_header_logo' );
		$width  = get_theme_mod( 'mizar_header_logo_width' );
		$height = get_theme_mod( 'mizar_header_logo_height' );

		// If there is no logo return null
		if( !$logo || !filter_var( $logo, FILTER_VALIDATE_URL ) ) {
			return null;
		}

		// If there is not logo attachemnet return null
		$logo_id = attachment_url_to_postid( $logo );

		if( !$logo_id ) {
			return null;
		}

		$logo_url   = wp_get_attachment_image_url( $logo_id, 'logo' );
		$logo2x_url = wp_get_attachment_image_url( $logo_id, 'logo@2x' );
		$alt        = get_post_meta( $logo_id, '_wp_attachment_image_alt', TRUE);

		$attr_img  = ['class' => 'mizar-logo'];
		$attr_link = ['class' => 'mizar-logo-link'];

		$attr_img['src']    = ( $logo_url ) ? $logo_url : false;
		$attr_img['srcset'] = ( $logo_url && $logo2x_url && $logo_url !== $logo2x_url ) ? $attr_img['srcset'] = sprintf( '%s, %s 2x', $logo_url, $logo2x_url ) : false;
		$attr_img['alt']    = ( $alt ) ? $alt : false;
		$attr_img['width']  = ( $width ) ? $width : false;
		$attr_img['height'] = ( $height ) ? $height : false;

		$attr_link['href'] = get_bloginfo( 'url' );

		$attr_img  = apply_filters( 'mizar_logo_img_attr', $attr_img );
		$attr_link = apply_filters( 'mizar_logo_link_attr', $attr_link );

		$img_format = '<img %s>';
		$link_format = '<a %s>%s</a>';

		$html = sprintf( $img_format, mizar_get_attr( $attr_img ) );
		$html = sprintf( $link_format, mizar_get_attr( $attr_link ), $html );

		return $html;
	}
}

if ( ! function_exists( 'mizar_get_attr' ) ) {

	/**
	 * Function provided to generate html attributes from array.
	 *
	 * @param array $attr Array of attributes
	 *
	 * @return string
	 */
	function mizar_get_attr( $attr ) {

		$output = [];

		foreach ( $attr as $key => $value ) {

			if ( 'placeholder' === $key || 'title' === $key ) {
				$output[] = sprintf( '%s="%s" ', esc_attr( $key ), esc_attr( $value ) ); // @codingStandardsIgnoreLine Translate $value , we do not know string
			} elseif ( true === $value ) {
				$output[] = sprintf( '%s="%s" ', esc_attr( $key ), esc_attr( $key ) );
			} elseif ( false !== $value && ( ! empty( $value ) || is_numeric( $value )) ) {
				$output[] = sprintf( '%s="%s" ', esc_attr( $key ), esc_attr( $value ) );
			}
		}

		return join( $output , ' ' );
	}
}

if ( ! function_exists( 'mizar_render' ) ) {

	/**
	 * Function provided to render php file to the html string
	 *
	 * @param string $partial Partial path
	 * @param array  $vars     Partial variables
	 *
	 * @return string html output
	 */
	function mizar_render( $partial, $vars = array() ) {

		if ( is_array( $vars ) && ! empty( $vars ) ) {
			extract( $vars );
		}

		try {
			if ( ! file_exists( $partial ) ) {
				throw new \Exception( sprintf( 'Partial file "%s" do not exist.', $partial ) );
			}

			ob_start();

			include $partial;

			$output = ob_get_clean();
		} catch ( \Exception $e ) {
			ob_end_clean();
			throw $e;
		}

		return $output;
	}
}
