/**
 * Customizer controls toggles
 *
 * @package Erapress
 */

( function( $ ) {

	/* Internal shorthand */
	var api = wp.customize;

	/**
	 * Trigger hooks
	 */
	ERAPRESSControlTrigger = {

	    /**
	     * Trigger a hook.
	     *
	     * @since 1.0.0
	     * @method triggerHook
	     * @param {String} hook The hook to trigger.
	     * @param {Array} args An array of args to pass to the hook.
		 */
	    triggerHook: function( hook, args )
	    {
	    	$( 'body' ).trigger( 'erapress-control-trigger.' + hook, args );
	    },

	    /**
	     * Add a hook.
	     *
	     * @since 1.0.0
	     * @method addHook
	     * @param {String} hook The hook to add.
	     * @param {Function} callback A function to call when the hook is triggered.
	     */
	    addHook: function( hook, callback )
	    {
	    	$( 'body' ).on( 'erapress-control-trigger.' + hook, callback );
	    },

	    /**
	     * Remove a hook.
	     *
	     * @since 1.0.0
	     * @method removeHook
	     * @param {String} hook The hook to remove.
	     * @param {Function} callback The callback function to remove.
	     */
	    removeHook: function( hook, callback )
	    {
		    $( 'body' ).off( 'erapress-control-trigger.' + hook, callback );
	    },
	};

	/**
	 * Helper class that contains data for showing and hiding controls.
	 *
	 * @since 1.0.0
	 * @class ERAPRESSCustomizerToggles
	 */
	ERAPRESSCustomizerToggles = {
				
		/**
		 *  Header Button
		 */
		'hdr_btn_enable' :
		[
			{
				controls: [
					'erapress_hdr_btn_icon_select',
					'erapress_hdr_btn_icon',
					'erapress_hdr_btn_icon_margin',
					'hdr_btn_lbl',
					'hdr_btn_link',
					'hdr_btn_radius',
					'hdr_btn_color',
					'hdr_btn_bg_color',
					'hdr_btn_brdr_clr',
					'erapress_hdr_btn_text_hvr_clr',
					'erapress_hdr_btn_bg_hvr_clr',
					'erapress_hdr_btn_brdr_hvr_clr',
					'hdr_btn_width',
					'erapress_hdr_btn_animation',
				],
				callback: function( header_btn ) {

					var header_btn = api( 'hdr_btn_enable' ).get();

					if ( '1' == header_btn ) {
						return true;
					}
					return false;
				}
			}
		],
		
		/**
		 *  Header Search
		 */
		'hdr_search_enable' :
		[
			{
				controls: [
					'hdr_search_color',
					'hdr_search_bg_color',
					'hdr_search_bdr_radius',
					'hdr_search_border_color',
					'hdr_search_bdr_width',
				],
				callback: function( header_search ) {

					var header_search = api( 'hdr_search_enable' ).get();

					if ( '1' == header_search ) {
						return true;
					}
					return false;
				}
			}
		],
		
		/**
		 *  Mobile Logo
		 */
		'mobile_logo_on' :
		[
			{
				controls: [
					'mobile_logo'
				],
				callback: function( mobile_logo ) {

					var mobile_logo = api( 'mobile_logo_on' ).get();

					if ( '1' == mobile_logo ) {
						return true;
					}
					return false;
				}
			}
		],
		
		/**
		 *  Sticky Logo
		 */
		'sticky_enable' :
		[
			{
				controls: [
					'sticky_logo',
					'sticky_logo_width'
				],
				callback: function( sticky_logo ) {

					var sticky_logo = api( 'sticky_enable' ).get();

					if ( '1' == sticky_logo ) {
						return true;
					}
					return false;
				}
			}
		],
		
		
		'footer_bottom_layout' :
		[
			{
				controls: [
					'footer_bottom_1',
					'footer_bottom_2'
				],
				callback: function( footer_bottom_layout ) {

					if ( 'disable' != footer_bottom_layout ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'footer_first_custom',
				],
				callback: function( footer_bottom_layout ) {

					var footer_section_1 = api( 'footer_bottom_1' ).get();

					if ( 'disable' != footer_bottom_layout && 'custom' == footer_section_1 ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'footer_first_shortcode',
				],
				callback: function( footer_bottom_layout ) {

					var footer_section_1 = api( 'footer_bottom_1' ).get();

					if ( 'disable' != footer_bottom_layout && 'shortcode' == footer_section_1 ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'footer_second_custom',
				],
				callback: function( footer_bottom_layout ) {

					var footer_section_2 = api( 'footer_bottom_2' ).get();

					if ( 'disable' != footer_bottom_layout && 'custom' == footer_section_2 ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'footer_second_shortcode',
				],
				callback: function( footer_bottom_layout ) {

					var footer_section_1 = api( 'footer_bottom_2' ).get();

					if ( 'disable' != footer_bottom_layout && 'shortcode' == footer_section_1 ) {
						return true;
					}
					return false;
				}
			},
		],
		'footer_bottom_1' :
		[
			{
				controls: [
					'footer_first_custom',
				],
				callback: function( enabled_section_1 ) {

					var footer_layout = api( 'footer_bottom_layout' ).get();

					if ( 'custom' == enabled_section_1 && 'disable' != footer_layout ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'footer_first_shortcode',
				],
				callback: function( enabled_section_1 ) {

					var footer_layout = api( 'footer_bottom_layout' ).get();

					if ( 'shortcode' == enabled_section_1 && 'disable' != footer_layout ) {
						return true;
					}
					return false;
				}
			}
		],
		'footer_bottom_2' :
		[
			{
				controls: [
					'footer_second_custom',
				],
				callback: function( enabled_section_2 ) {

					var footer_layout = api( 'footer_bottom_layout' ).get();

					if ( 'custom' == enabled_section_2 && 'disable' != footer_layout ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'footer_second_shortcode',
				],
				callback: function( enabled_section_2 ) {

					var footer_layout = api( 'footer_bottom_layout' ).get();

					if ( 'shortcode' == enabled_section_2 && 'disable' != footer_layout ) {
						return true;
					}
					return false;
				}
			}
		],
		
		/**
		 *  Footer Container
		 */
		'footer_container_style' :
		[
			{
				controls: [
					'footer_container_width'
				],
				callback: function( footer_container ) {

					var footer_container = api( 'footer_container_style' ).get();

					if ( 'container' == footer_container ) {
						return true;
					}
					return false;
				}
			}
		],	
		
		
		/**
		 *  erapress_post_excerpt
		 */
		'enable_post_excerpt' :
		[
			{
				controls: [
					'erapress_post_excerpt',
					'erapress_archive_excerpt_more',
					'enable_post_btn'
				],
				callback: function( erapress_post_excerpt ) {

					var erapress_post_excerpt = api( 'enable_post_excerpt' ).get();

					if ( '1' == erapress_post_excerpt ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'read_btn_txt'
				],
				callback: function( erapress_post_excerpt ) {

					var enable_post_excerpt = api( 'enable_post_btn' ).get();

					if ( '1' == erapress_post_excerpt && '1' == enable_post_excerpt ) {
						return true;
					}
					return false;
				}
			}
		],	
			
		'enable_post_btn' :
		[
			{
				controls: [
					'read_btn_txt'
				],
				callback: function( erapress_post_excerpt ) {

					var enable_post_excerpt = api( 'enable_post_excerpt' ).get();

					if ( '1' == erapress_post_excerpt && '1' == enable_post_excerpt ) {
						return true;
					}
					return false;
				}
			}
		],	
		
		/**
		 *  Erapress Site Layout
		 */
		'erapress_site_layout' :
		[
			{
				controls: [
					'erapress_site_cntnr_width'
				],
				callback: function( erapress_site_layout ) {

					var erapress_site_layout = api( 'erapress_site_layout' ).get();

					if ( 'stretched' !== erapress_site_layout ) {
						return true;
					}
					return false;
				}
			}
		],
		
		/**
		 *  edd_product_types
		 */
		'edd_product_types' :
		[
			{
				controls: [
					'edd_archive_column'
				],
				callback: function( edd_product_types ) {

					var edd_product_types = api( 'edd_product_types' ).get();

					if ( 'grid' == edd_product_types ) {
						return true;
					}
					return false;
				}
			}
		],
	};

} )( jQuery );
