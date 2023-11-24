<?php
/**
 * Erapress Theme Customizer.
 *
 * @package Erapress
 */

 if ( ! class_exists( 'Erapress_Customizer' ) ) {

	/**
	 * Customizer Loader
	 *
	 * @since 1.0.0
	 */
	class Erapress_Customizer {

		/**
		 * Instance
		 *
		 * @access private
		 * @var object
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			/**
			 * Customizer
			 */
			add_action( 'customize_preview_init',                  array( $this, 'erapress_customize_preview_js' ) );
			add_action( 'customize_controls_enqueue_scripts',      array( $this, 'erapress_controls_scripts' ) );
			add_action( 'customize_register',                      array( $this, 'erapress_customizer_register' ) );
			add_action( 'after_setup_theme',                       array( $this, 'erapress_customizer_settings' ) );
		}
		
		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		function erapress_customizer_register( $wp_customize ) {
			
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
			$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
			$wp_customize->get_setting('custom_logo')->transport = 'refresh';			
			
			/**
			 * Register controls
			 */
			$wp_customize->register_control_type( 'Erapress_Control_Sortable' );
			$wp_customize->register_control_type( 'Erapress_Customizer_Range_Control' );
			$wp_customize->register_control_type( 'Erapress_Color_Control' );
			
			/**
			 * Helper files
			 */
			require ERAPRESS_PARENT_INC_DIR . '/customizer/customizer-controls.php';
			require ERAPRESS_PARENT_INC_DIR . '/customizer/sanitization.php';
		}
		
		/**
		 * Customizer Controls
		 *
		 * @since 1.0.0
		 * @return void
		 */
		function erapress_controls_scripts() {
				$js_prefix  = '.js';
				$css_prefix = '.css';
			
			// Customizer Core.
			wp_enqueue_script( 'erapress-customizer-controls-toggle-js', ERAPRESS_PARENT_INC_URI . '/customizer/assets/js/customizer-toggle-control' . $js_prefix, array(), ERAPRESS_THEME_VERSION, true );

			// Customizer Controls.
			wp_enqueue_script( 'erapress-customizer-controls-js', ERAPRESS_PARENT_INC_URI . '/customizer/assets/js/customizer-control' . $js_prefix, array( 'erapress-customizer-controls-toggle-js' ), ERAPRESS_THEME_VERSION, true );
		}

		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 */
		function erapress_customize_preview_js() {
			wp_enqueue_script( 'erapress-customizer', ERAPRESS_PARENT_INC_URI . '/customizer/assets/js/customizer-preview.js', array( 'customize-preview' ), '20151215', true );
		}

		// Include customizer customizer settings.
			
		function erapress_customizer_settings() {	
			require ERAPRESS_PARENT_INC_DIR . '/customizer/customizer-options/erapress-header.php';
			require ERAPRESS_PARENT_INC_DIR . '/customizer/customizer-options/erapress-general-settings.php'; 
			require ERAPRESS_PARENT_INC_DIR . '/customizer/customizer-pro/class-customize.php';
		}
	}
}
// End if().

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Erapress_Customizer::get_instance();