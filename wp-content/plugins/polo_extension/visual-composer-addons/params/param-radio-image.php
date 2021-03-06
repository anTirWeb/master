<?php
/**
 * Radio image parameter for Visual Composer
 *
 * @package Custom_vc
 *
 * # Usage -
 * array(
 * 'type' => 'radio_image_select',
 * 'options' => array(
 * 'image-1' => plugins_url('../assets/images/patterns/01.png',__FILE__),
 * 'image-2' => plugins_url('../assets/images/patterns/12.png',__FILE__),
 * ),
 * )
 */

if ( ! class_exists( 'Crum_Radio_Image_Param' ) ) {

	/**
	 * Class Ultimate_Radio_Image_Param
	 */
	class Crum_Radio_Image_Param {

		/**
		 * Add shortcode parameter for Visual Composer.
		 */
		function __construct() {
			if ( function_exists( 'vc_add_shortcode_param' ) ) {
				vc_add_shortcode_param( 'radio_image_select', array(
						&$this,
						'radio_image_settings_field'
					), PLUGIN_URL . 'assets/js/admin/crum_additional_param.js' );
			}
		}

		/**
		 * Parsing settings field.
		 *
		 * @param array $settings Settings array.
		 * @param array $value    Values array.
		 *
		 * @return string
		 */
		function radio_image_settings_field( $settings, $value ) {

			$options      = isset( $settings['options'] ) ? $settings['options'] : '';
			$useextension = ( isset( $settings['useextension'] ) && '' !== $settings['useextension'] ) ? $settings['useextension'] : 'true';

			$class = isset( $settings['class'] ) ? $settings['class'] : '';

			$output     = $selected = '';
			$css_option = str_replace( '#', 'hash-', vc_get_dropdown_option( $settings, $value ) );

			$output .= '<select name="'
			           . $settings['param_name']
			           . '" class="wpb_vc_param_value wpb-input wpb-select ' . $class
			           . ' ' . $settings['param_name']
			           . ' ' . $settings['type']
			           . ' ' . $css_option
			           . '" data-option="' . $css_option . '">';

			if ( is_array( $options ) ) {
				foreach ( $options as $key => $img_url ) {
					if ( 'true' !== $useextension ) {
						$temp          = pathinfo( $key );
						$temp_filename = $temp['filename'];
						$key           = $temp_filename;
					}

					if ( '' !== $css_option && $css_option === $key ) {
						$selected = ' selected="selected"';
					} else {
						$selected = '';
					}

					$output .= '<option  data-img-src="' . $img_url . '"  value="' . $key . '" ' . $selected . '>';
				}
			}
			$output .= '</select>';

			return $output;
		}
	}
}


if ( class_exists( 'Crum_Radio_Image_Param' ) ) {
	$Crum_Radio_Image_Param = new Crum_Radio_Image_Param();
}
