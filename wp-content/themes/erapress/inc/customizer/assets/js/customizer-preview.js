/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	/**
     * Outputs custom css for responsive controls
     * @param  {[string]} setting customizer setting
     * @param  {[string]} css_selector
     * @param  {[array]} css_prop css property to write
     * @param  {String} ext css value extension eg: px, in
     * @return {[string]} css output
     */
    function range_live_media_load( setting, css_selector, css_prop, ext = '' ) {
        wp.customize(
            setting, function( value ) {
                'use strict';
                value.bind(
                    function( to ){
                        var values          = JSON.parse( to );
                        var desktop_value   = JSON.parse( values.desktop );
                        var tablet_value    = JSON.parse( values.tablet );
                        var mobile_value    = JSON.parse( values.mobile );

                        var class_name      = 'customizer-' + setting;
                        var css_class       = $( '.' + class_name );
                        var selector_name   = css_selector;
                        var property_name   = css_prop;

                        var desktop_css     = '';
                        var tablet_css      = '';
                        var mobile_css      = '';

                        if ( property_name.length == 1 ) {
                            var desktop_css     = property_name[0] + ': ' + desktop_value + ext + ';';
                            var tablet_css      = property_name[0] + ': ' + tablet_value + ext + ';';
                            var mobile_css      = property_name[0] + ': ' + mobile_value + ext + ';';
                        } else if ( property_name.length == 2 ) {
                            var desktop_css     = property_name[0] + ': ' + desktop_value + ext + ';';
                            var desktop_css     = desktop_css + property_name[1] + ': ' + desktop_value + ext + ';';

                            var tablet_css      = property_name[0] + ': ' + tablet_value + ext + ';';
                            var tablet_css      = tablet_css + property_name[1] + ': ' + tablet_value + ext + ';';

                            var mobile_css      = property_name[0] + ': ' + mobile_value + ext + ';';
                            var mobile_css      = mobile_css + property_name[1] + ': ' + mobile_value + ext + ';';
                        }

                        var head_append     = '<style class="' + class_name + '">@media (min-width: 320px){ ' + selector_name + ' { ' + mobile_css + ' } } @media (min-width: 720px){ ' + selector_name + ' { ' + tablet_css + ' } } @media (min-width: 960px){ ' + selector_name + ' { ' + desktop_css + ' } }</style>';

                        if ( css_class.length ) {
                            css_class.replaceWith( head_append );
                        } else {
                            $( "head" ).append( head_append );
                        }
                    }
                );
            }
        );
    }
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
	
	$(document).ready(function ($) {
        $('input[data-input-type]').on('input change', function () {
            var val = $(this).val();
            $(this).prev('.cs-range-value').html(val);
            $(this).val(val);
        });
    })
	
	
	// hdr_btn_lbl
	wp.customize(
		'hdr_btn_lbl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.header_btn a' ).text( newval );
				}
			);
		}
	);
	
	/**
	 * hdr_btn_width
	 */
	wp.customize( 'hdr_btn_width', function( value ) {
		value.bind( function( width ) {
			jQuery( '.header_btn a' ).css( 'border-width', width + 'px' );
		} );
	} );
	
	/**
	 * hdr_btn_color
	 */
	wp.customize( 'hdr_btn_color', function( value ) {
		value.bind( function( color ) {
			jQuery( '.header_btn a' ).css( 'color', color );
		} );
	} );
	
	/**
	 * hdr_btn_bg_color
	 */
	wp.customize( 'hdr_btn_bg_color', function( value ) {
		value.bind( function( bg_color ) {
			jQuery( '.header_btn a' ).css( 'background-color', bg_color );
		} );
	} );
	
	/**
	 * hdr_btn_radius
	 */
	wp.customize( 'hdr_btn_radius', function( value ) {
		value.bind( function( border_size ) {
			jQuery( '.header_btn a' ).css( 'border-radius', border_size + 'px' );
		} );
	} );
	
	/**
	 * hdr_search_color
	 */
	wp.customize( 'hdr_search_color', function( value ) {
		value.bind( function( color ) {
			jQuery( '.search-button i' ).css( 'color', color );
		} );
	} );
	
	/**
	 * hdr_search_bg_color
	 */
	wp.customize( 'hdr_search_bg_color', function( value ) {
		value.bind( function( bg_color ) {
			jQuery( '.search-button #view-search-btn' ).css( 'background-color', bg_color );
			jQuery( '.search-button #view-search-btn' ).css( 'border-color', bg_color );
		} );
	} );
	
	/**
	 * hdr_search_bdr_radius
	 */
	wp.customize( 'hdr_search_bdr_radius', function( value ) {
		value.bind( function( radius ) {
			jQuery( '.search-button #view-search-btn' ).css( 'border-radius', radius+ 'px' );
		} );
	} );
	
	
	/**
	 * logo_width
	 */
	range_live_media_load( 'logo_width', 'body[class*="header-"] .logo img, body[class*="header-"] .mobile-logo img', [ 'max-width' ], 'px !important' );
	/**
	 * Sticky Logo Width
	 */
	wp.customize( 'sticky_logo_width', function( value ) {
		value.bind( function( logo_width ) {
			jQuery( '.sticky-navbar-brand img' ).css( 'max-width', logo_width + 'px' );
		} );
	} );
	
	/**
	 * site_ttl_size
	 */
	 
	range_live_media_load( 'site_ttl_size', '.site-title', [ 'font-size' ], 'px !important' );
	
	/**
	 * site_desc_size
	 */
	 
	range_live_media_load( 'site_desc_size', '.site-description', [ 'font-size' ], 'px !important' );
	
	/**
	 * Menu Active
	 */
	wp.customize( 'erapress_menu_active', function( value ) {
		value.bind( function( column ) {
			jQuery( 'body' ).removeClass( function (index, className) {
				return (className.match (/(^|\s)active-\S+/g) || []).join(' ');
			});
			jQuery( 'body' ).addClass( column );
		} );
	} );
	
	/**
	 * mbl_menu_color
	 */
	wp.customize( 'mbl_menu_color', function( value ) {
		value.bind( function( color ) {
			jQuery( '.mobile-menu li > a' ).css( 'color', color );
		} );
	} );
	
	/**
	 * mbl_menu_hover_color
	 */
	wp.customize( 'mbl_menu_hover_color', function( value ) {
		value.bind( function( color ) {
			jQuery( '.theme-mobile-menu div.mobile-menu li > span a' ).css( 'color', color );
		} );
	} );
	
	/**
	 * Container Width
	 */
	wp.customize( 'erapress_hdr_cntnr_width', function( value ) {
		value.bind( function( erapress_hdr_cntnr_width ) {
			if (erapress_hdr_cntnr_width >= 768 && erapress_hdr_cntnr_width < 2000){
				jQuery( '#header-section .xl-container' ).css( 'max-width', erapress_hdr_cntnr_width + 'px' );
			}	
		} );
	} );
	
	/**
	 * erapress_cntnr_mtop
	 */
	wp.customize( 'erapress_cntnr_mtop', function( value ) {
		value.bind( function( margin ) {
			jQuery( '.main-content-part' ).css( 'margin-top', margin+ 'px' );
		} );
	} );
	
	/**
	 * erapress_cntnr_mbtm
	 */
	wp.customize( 'erapress_cntnr_mbtm', function( value ) {
		value.bind( function( margin ) {
			jQuery( '.erapress-content' ).css( 'margin-bottom', margin+ 'px' );
		} );
	} );
	
	/**
	 * erapress_site_layout
	 */
	$body = $( 'body' );	
	wp.customize( 'erapress_site_layout', function( value ) {
		value.bind( function( erapress_site_layout ) {
			$body.removeClass( function (index, className) {
				return (className.match (/(^|\s)xl-layout-\S+/g) || []).join(' ');
			});

			$body.addClass( 'xl-layout-' + erapress_site_layout );
		} );
	} );
	
	/**
	 * Container Width
	 */
	wp.customize( 'erapress_site_cntnr_width', function( value ) {
		
		value.bind( function( erapress_site_cntnr_width ) {
			var class_name      = 'erapress_site_cntnr_width'; // Used as id in gfont link
			var css_class       = $( '.' + class_name );			
			
			if (erapress_site_cntnr_width >= 768 && erapress_site_cntnr_width < 2000){
				var head_append     = '<style class="' + class_name + '">.xl-layout-contained .xl-container, .xl-layout-boxed .xl-container { max-width: ' + erapress_site_cntnr_width + 'px;} .xl-layout-boxed #page { max-width: ' + erapress_site_cntnr_width + 'px;}</style>';
			}

			if ( css_class.length ) {
				css_class.replaceWith( head_append );
			} else {
				$( 'head' ).append( head_append );
			}
			
		});
		
	} );
	/**
	 * Nav Bar Padding
	 */
	 range_live_media_load( 'erapress_menu_bar_padding', '#header-section .navigation:not(.pagination), #header-section .theme-mobile-nav', [ 'padding-top', 'padding-bottom' ], 'px' );
	
	/**
	 * Footer Container Width
	 */
	wp.customize( 'footer_container_width', function( value ) {
		value.bind( function( footer_container_width ) {
			if (footer_container_width >= 768 && footer_container_width < 2000){
				jQuery( '.footer  .xl-container' ).css( 'max-width', footer_container_width + 'px' );
			}	
		} );
	} );
	
	range_live_media_load( 'breadcrumb_min_height', 'body[class*="header"] .breadcrumb-area div.breadcrumb-content', [ 'min-height' ], 'px' );

	/**
	 * Body font family
	 */
	wp.customize( 'erapress_body_font_family', function( value ) {
		value.bind( function( font_family ) {
			jQuery( 'body' ).css( 'font-family', font_family );
		} );
	} );
	
	/**
	 * Body font size
	 */
	
	range_live_media_load( 'erapress_body_font_size', 'body', [ 'font-size' ], 'px' );
	
	/**
	 * Body Letter Spacing
	 */
	
	range_live_media_load( 'erapress_body_ltr_space', 'body', [ 'letter-spacing' ], 'px' );
	
	/**
	 * Body font weight
	 */
	wp.customize( 'erapress_body_font_weight', function( value ) {
		value.bind( function( font_weight ) {
			jQuery( 'body' ).css( 'font-weight', font_weight );
		} );
	} );
	
	/**
	 * Body font style
	 */
	wp.customize( 'erapress_body_font_style', function( value ) {
		value.bind( function( font_style ) {
			jQuery( 'body' ).css( 'font-style', font_style );
		} );
	} );
	
	/**
	 * Body Text Decoration
	 */
	wp.customize( 'erapress_body_txt_decoration', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'body, a' ).css( 'text-decoration', decoration );
		} );
	} );
	/**
	 * Body text tranform
	 */
	wp.customize( 'erapress_body_text_transform', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'body' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * erapress_body_line_height
	 */
	range_live_media_load( 'erapress_body_line_height', 'body', [ 'line-height' ] );
	
	
} )( jQuery );