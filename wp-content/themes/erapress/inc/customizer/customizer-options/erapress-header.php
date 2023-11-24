<?php
function erapress_header_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Header Settings Panel
	=========================================*/
	$wp_customize->add_panel( 
		'header_section', 
		array(
			'priority'      => 2,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Header', 'erapress'),
		) 
	);
	
	/*=========================================
	EraPress Site Identity
	=========================================*/
	$wp_customize->add_section(
        'title_tagline',
        array(
        	'priority'      => 1,
            'title' 		=> __('Site Identity','erapress'),
			'panel'  		=> 'header_section',
		)
    );

	// Logo Width // 
	if ( class_exists( 'EraPress_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'logo_width',
			array(
				'default'			=> '140',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'erapress_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new EraPress_Customizer_Range_Control( $wp_customize, 'logo_width', 
			array(
				'label'      => __( 'Logo Width', 'erapress' ),
				'section'  => 'title_tagline',
				 'media_query'   => true,
					'input_attr'    => array(
						'mobile'  => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 140,
						),
						'tablet'  => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 140,
						),
						'desktop' => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 140,
						),
					),
			) ) 
		);
	}
	
	// Typography
	$wp_customize->add_setting(
		'logo_typography'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'erapress_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'logo_typography',
		array(
			'type' => 'hidden',
			'label' => __('Typography','erapress'),
			'section' => 'title_tagline',
			'priority' => 100,
		)
	);
	
	// Site Title Font Size// 
	if ( class_exists( 'EraPress_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'site_ttl_size',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'erapress_sanitize_range_value',
				'transport'         => 'postMessage'
			)
		);
		$wp_customize->add_control( 
		new EraPress_Customizer_Range_Control( $wp_customize, 'site_ttl_size', 
			array(
				'label'      => __( 'Site Title Font Size', 'erapress' ),
				'section'  => 'title_tagline',
				'priority' => 101,
				 'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 30,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 30,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 30,
                    ),
                ),
			) ) 
		);

	// Site Description Font Size// 	
		$wp_customize->add_setting(
			'site_desc_size',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'erapress_sanitize_range_value',
				'transport'         => 'postMessage'
			)
		);
		$wp_customize->add_control( 
		new EraPress_Customizer_Range_Control( $wp_customize, 'site_desc_size', 
			array(
				'label'      => __( 'Site Description Font Size', 'erapress' ),
				'section'  => 'title_tagline',
				'priority' => 102,
				 'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 12,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 12,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 12,
                    ),
					),
			) ) 
		);
	}
	
	/*=========================================
	EraPress Header Types
	=========================================*/
	$wp_customize->add_section(
        'header_type',
        array(
        	'priority'      => 2,
            'title' 		=> __('Header Type','erapress'),
			'panel'  		=> 'header_section',
		)
    );
	
	if ( class_exists( 'EraPress_Customize_Control_Radio_Image' ) ) {
        $wp_customize->add_setting(
            'erapress_header_type', array(
                'sanitize_callback' => 'erapress_sanitize_select',
                'default' => 'header-default',
                'priority'  => 8,
            )
        );
        $wp_customize->add_control(
            new EraPress_Customize_Control_Radio_Image(
                $wp_customize, 'erapress_header_type', array(
                    'label'     => esc_html__( 'Header Layout', 'erapress' ),
                    'section'   => 'header_type',
                    'choices'   => array(
                        'header-default' => array(
                            'url' => apply_filters( 'square', esc_url(trailingslashit( get_template_directory_uri() ) . 'inc/customizer/assets/images/header/erapress-header-1.png' )),
                        ),
                        'header-two' => array(
                            'url' => apply_filters( 'circle', esc_url(trailingslashit( get_template_directory_uri() ) . 'inc/customizer/assets/images/header/erapress-header-2.png' )),
                        ),
                        'header-three' => array(
                            'url' => apply_filters( 'circle', esc_url(trailingslashit( get_template_directory_uri() ) . 'inc/customizer/assets/images/header/erapress-header-3.png' )),
                        ),
                    ),
                )
            )
        );
    }
	/*=========================================
	Above Header Section
	=========================================*/
	$wp_customize->add_section(
        'above_header',
        array(
        	'priority'      => 2,
            'title' 		=> __('Above Header','erapress'),
			'panel'  		=> 'header_section',
		)
    );	
	
	$wp_customize->add_setting(
    	'info',
    	array(
			'sanitize_callback' => 'erapress_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 1,
		)
	);	

	$wp_customize->add_control( 
		'info',
		array(
			'type'		 =>	'hidden',
		    'label'   		=> __('Info','erapress'),
		    'section' 		=> 'above_header'
		)  
	);
	
	$wp_customize->add_setting(
    	'tlh_header_info_text',
    	array(
	        'default'			=> __('Are you ready to grow up your business?','erapress'),
			'sanitize_callback' => 'erapress_sanitize_text',
			'transport'         => $selective_refresh,
			'capability' => 'edit_theme_options',
			'priority' => 3,
		)
	);	

	$wp_customize->add_control( 
		'tlh_header_info_text',
		array(
		    'label'   		=> __('Info text','erapress'),
		    'section' 		=> 'above_header',
			'type'		 =>	'text'
		)  
	);
	
	$wp_customize->add_setting(
    	'tlh_header_title_info',
    	array(
	        'default'			=> __('Contact Us','erapress'),
			'sanitize_callback' => 'erapress_sanitize_text',
			'transport'         => $selective_refresh,
			'capability' => 'edit_theme_options',
			'priority' => 3,
		)
	);	

	$wp_customize->add_control( 
		'tlh_header_title_info',
		array(
		    'label'   		=> __('Info Title','erapress'),
		    'section' 		=> 'above_header',
			'type'		 =>	'text'
		)  
	);
	
	$wp_customize->add_setting(
    	'tlh_header_title_info_link',
    	array(
	        'default'			=> '#',
			'sanitize_callback' => 'erapress_sanitize_text',
			'transport'         => $selective_refresh,
			'capability' => 'edit_theme_options',
			'priority' => 3,
		)
	);	

	$wp_customize->add_control( 
		'tlh_header_title_info_link',
		array(
		    'label'   		=> __('Info Link','erapress'),
		    'section' 		=> 'above_header',
			'type'		 =>	'text'
		)  
	);
	
	
	$wp_customize->add_setting(
    	'header_social',
    	array(
			'sanitize_callback' => 'erapress_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 1,
		)
	);	

	$wp_customize->add_control( 
		'header_social',
		array(
			'type'		 =>	'hidden',
		    'label'   		=> __('Social','erapress'),
		    'section' 		=> 'above_header'
		)  
	);
	

	$wp_customize->add_setting( 
		'hide_show_social_icon' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'erapress_sanitize_checkbox',
			'priority' => 1,
		) 
	);
	
	$wp_customize->add_control(
	'hide_show_social_icon', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'erapress' ),
			'section'     => 'above_header',
			'type'        => 'checkbox'
		) 
	);
	
	/**
	 * Customizer Repeater
	 */
		$wp_customize->add_setting( 'social_icons', 
			array(
			 'sanitize_callback' => 'erapress_repeater_sanitize',
			 'priority' => 2,
			 'default' => erapress_get_social_icon_default()
		)
		);
		
		$wp_customize->add_control( 
			new ERAPRESS_Repeater( $wp_customize, 
				'social_icons', 
					array(
						'label'   => esc_html__('Social Icons','erapress'),
						'section' => 'above_header',
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_link_control' => true,
					) 
				) 
			);
	
	
	// Mobile
	$wp_customize->add_setting(
		'hdr_top_mbl'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'erapress_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'hdr_top_mbl',
		array(
			'type' => 'hidden',
			'label' => __('Phone','erapress'),
			'section' => 'above_header',
			
		)
	);
	$wp_customize->add_setting( 
		'hide_show_mbl_details' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'erapress_sanitize_checkbox',
			'transport'         => $selective_refresh,
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'hide_show_mbl_details', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'erapress' ),
			'section'     => 'above_header',
			'type'        => 'checkbox'
		) 
	);	
	// icon // 
	$wp_customize->add_setting(
    	'tlh_mobile_icon',
    	array(
	        'default' => 'fa-map-marker',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control(new EraPress_Icon_Picker_Control($wp_customize, 
		'tlh_mobile_icon',
		array(
		    'label'   		=> __('Icon','erapress'),
		    'section' 		=> 'above_header',
			'iconset' => 'fa',
			
		))  
	);
	
	// Mobile title // 
	$wp_customize->add_setting(
    	'tlh_mobile_title',
    	array(
	        'default'			=> __('Online 24x7','erapress'),
			'sanitize_callback' => 'erapress_sanitize_text',
			'transport'         => $selective_refresh,
			'capability' => 'edit_theme_options',
			'priority' => 3,
		)
	);	

	$wp_customize->add_control( 
		'tlh_mobile_title',
		array(
		    'label'   		=> __('Title','erapress'),
		    'section' 		=> 'above_header',
			'type'		 =>	'text'
		)  
	);
	
	
	$wp_customize->add_setting(
    	'header_abv_email',
    	array(
			'sanitize_callback' => 'erapress_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 1,
		)
	);	

	$wp_customize->add_control( 
		'header_abv_email',
		array(
			'type'		 =>	'hidden',
		    'label'   		=> __('Email','erapress'),
		    'section' 		=> 'above_header'
		)  
	);
	

	$wp_customize->add_control(
	'hdr_top_email',
		array(
			'type' => 'hidden',
			'label' => __('Email','erapress'),
			'section' => 'above_header',
		)
	);
	$wp_customize->add_setting( 
		'hide_show_email_details' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'erapress_sanitize_checkbox',
			'transport'         => $selective_refresh,
			'priority' => 6,
		) 
	);
	
	$wp_customize->add_control(
	'hide_show_email_details', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'erapress' ),
			'section'     => 'above_header',
			'type'        => 'checkbox'
		) 
	);	
	
	// icon // 
	$wp_customize->add_setting(
    	'tlh_email_icon',
    	array(
	        'default' => 'fa-phone',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control(new EraPress_Icon_Picker_Control($wp_customize, 
		'tlh_email_icon',
		array(
		    'label'   		=> __('Icon','erapress'),
		    'section' 		=> 'above_header',
			'iconset' => 'fa',
			
		))  
	);	
	// Mobile title // 
	$wp_customize->add_setting(
    	'tlh_email_title',
    	array(
	        'default'			=> __('Email Us','erapress'),
			'sanitize_callback' => 'erapress_sanitize_text',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 7,
		)
	);	

	$wp_customize->add_control( 
		'tlh_email_title',
		array(
		    'label'   		=> __('Title','erapress'),
		    'section' 		=> 'above_header',
			'type'		 =>	'text'
		)  
	);
	
	// Contact
	$wp_customize->add_setting(
		'hdr_top_contact'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'erapress_sanitize_text',
			'priority' => 9,
		)
	);

	$wp_customize->add_control(
	'hdr_top_contact',
		array(
			'type' => 'hidden',
			'label' => __('Contact','erapress'),
			'section' => 'above_header',
		)
	);
	$wp_customize->add_setting( 
		'hide_show_cntct_details' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'erapress_sanitize_checkbox',
			'transport'         => $selective_refresh,
			'priority' => 10,
		) 
	);
	
	$wp_customize->add_control(
	'hide_show_cntct_details', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'erapress' ),
			'section'     => 'above_header',
			'type'        => 'checkbox'
		) 
	);	
	
	// icon // 
	$wp_customize->add_setting(
    	'tlh_contct_icon',
    	array(
	        'default' => 'fa-clock-o',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control(new EraPress_Icon_Picker_Control($wp_customize, 
		'tlh_contct_icon',
		array(
		    'label'   		=> __('Icon','erapress'),
		    'section' 		=> 'above_header',
			'iconset' => 'fa',
			
		))  
	);		
	
	// Mobile title // 
	$wp_customize->add_setting(
    	'tlh_contact_title',
    	array(
	        'default'			=> __('8:00AM - 6:00PM','erapress'),
			'sanitize_callback' => 'erapress_sanitize_text',
			'transport'         => $selective_refresh,
			'capability' => 'edit_theme_options',
			'priority' => 11,
		)
	);	

	$wp_customize->add_control( 
		'tlh_contact_title',
		array(
		    'label'   		=> __('Title','erapress'),
		    'section' 		=> 'above_header',
			'type'		 =>	'text'
		)  
	);
	
	// Mobile subtitle // 
	$wp_customize->add_setting(
    	'tlh_contact_sbtitle',
    	array(
	        'default'			=> __('Mon-Fri','erapress'),
			'sanitize_callback' => 'erapress_sanitize_text',
			'transport'         => $selective_refresh,
			'capability' => 'edit_theme_options',
			'priority' => 12,
		)
	);	

	$wp_customize->add_control( 
		'tlh_contact_sbtitle',
		array(
		    'label'   		=> __('Subtitle','erapress'),
		    'section' 		=> 'above_header',
			'type'		 =>	'text'
		)  
	);
	
	
	/*=========================================
	Top Header Left
	=========================================*/
	$wp_customize->add_section(
        'header_top_left',
        array(
        	'priority'      => 1,
            'title' 		=> __('Top Left Header','erapress'),
			'panel'  		=> 'header_section',
		)
    );
	
	
	/*=========================================
	Top Header Left
	=========================================*/	
	$wp_customize->add_section(
        'header_top_right',
        array(
        	'priority'      => 2,
            'title' 		=> __('Top Right Header','erapress'),
			'panel'  		=> 'header_section',
		)
    );
	
	
	/*=========================================
	Header Navigation
	=========================================*/	
	$wp_customize->add_section(
        'header_navigation',
        array(
        	'priority'      => 4,
            'title' 		=> __('Header Navigation','erapress'),
			'panel'  		=> 'header_section',
		)
    );
	
	// Search
	$wp_customize->add_setting(
		'hdr_nav_search'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'erapress_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'hdr_nav_search',
		array(
			'type' => 'hidden',
			'label' => __('Search','erapress'),
			'section' => 'header_navigation',
		)
	);
	$wp_customize->add_setting( 
		'hide_show_search' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'erapress_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'hide_show_search', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'erapress' ),
			'section'     => 'header_navigation',
			'type'        => 'checkbox'
		) 
	);	
	
	// Instantiate the Erapress_Plugin_Utilities class
	$plugin_utilities = Erapress_Plugin_Utilities::instance();
	
	// Define the plugin slug you want to check
	$plugin_slug_to_check = 'xolo-addon';  

	// Check if the plugin is activated
	$is_plugin_activated = $plugin_utilities->is_activated($plugin_slug_to_check);	
	
	if($is_plugin_activated ) {
	// Toggle
	$wp_customize->add_setting(
		'hdr_nav_toggle'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'erapress_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'hdr_nav_toggle',
		array(
			'type' => 'hidden',
			'label' => __('Toggle','erapress'),
			'section' => 'header_navigation',
		)
	);
	$wp_customize->add_setting( 
		'hide_show_toggle' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'erapress_sanitize_checkbox',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'hide_show_toggle', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'erapress' ),
			'section'     => 'header_navigation',
			'type'        => 'checkbox'
		) 
	);
	
	$wp_customize->add_control(
	'hide_show_nav_btn', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'erapress' ),
			'section'     => 'header_navigation',
			'type'        => 'checkbox'
		) 
	);	
	
	// Button Label // 
	$wp_customize->add_setting(
    	'nav_btn_lbl',
    	array(
	        'default'			=> __('Lets Talk','erapress'),
			'sanitize_callback' => 'erapress_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 7,
		)
	);	

	$wp_customize->add_control( 
		'nav_btn_lbl',
		array(
		    'label'   		=> __('Button Label','erapress'),
		    'section' 		=> 'header_navigation',
			'type'		 =>	'text'
		)  
	);
	
	// Button Link // 
	$wp_customize->add_setting(
    	'nav_btn_link',
    	array(
	        'default'			=> __('#','erapress'),
			'sanitize_callback' => 'erapress_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 8,
		)
	);	

	$wp_customize->add_control( 
		'nav_btn_link',
		array(
		    'label'   		=> __('Button Link','erapress'),
		    'section' 		=> 'header_navigation',
			'type'		 =>	'text'
		)  
	);
	}
	
	/*=========================================
	Sticky Header
	=========================================*/	
	$wp_customize->add_section(
        'sticky_header_set',
        array(
        	'priority'      => 4,
            'title' 		=> __('Sticky Header','erapress'),
			'panel'  		=> 'header_section',
		)
    );
	
	// Heading
	$wp_customize->add_setting(
		'sticky_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'erapress_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'sticky_head',
		array(
			'type' => 'hidden',
			'label' => __('Sticky Header','erapress'),
			'section' => 'sticky_header_set',
		)
	);
	$wp_customize->add_setting( 
		'hide_show_sticky' , 
			array(
			// 'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'erapress_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'hide_show_sticky', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'erapress' ),
			'section'     => 'sticky_header_set',
			'type'        => 'checkbox'
		) 
	);	
	
	/*=========================================
	Header Sidebar
	=========================================*/	
	$wp_customize->add_section(
        'header_sidebar',
        array(
        	'priority'      => 4,
            'title' 		=> __('Header Sidebar','erapress'),
			'panel'  		=> 'header_section',
		)
    );
	
	$wp_customize->add_setting(
    	'sidebar_title',
    	array(
	        'default'			=> __('About','erapress'),
			'sanitize_callback' => 'erapress_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 15,
		)
	);	

	$wp_customize->add_control( 
		'sidebar_title',
		array(
		    'label'   		=> __('Title','erapress'),
		    'section' 		=> 'header_sidebar',
			'type'		 =>	'text'
		)  
	);
	
	$wp_customize->add_setting(
    	'sidebar_desc',
    	array(
	        'default'			=> __('The argument in favor of using filler text goes something like this: If you use arey real content in the Consulting Process anytime you reachtent.','erapress'),
			'sanitize_callback' => 'erapress_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 16,
		)
	);	
	$wp_customize->add_control( 
		'sidebar_desc',
		array(
		    'label'   		=> __('Description','erapress'),
		    'section' 		=> 'header_sidebar',
			'type'		 =>	'text'
		)  
	);
	
	$wp_customize->add_setting(
    	'instagram_title',
    	array(
	        'default'			=> __('Gallery Title','erapress'),
			'sanitize_callback' => 'erapress_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 18,
		)
	);	
	$wp_customize->add_control( 
		'instagram_title',
		array(
		    'label'   		=> __('Gallery','erapress'),
		    'section' 		=> 'header_sidebar',
			'type'		 =>	'text'
		)  
	);
	
	$wp_customize->add_setting(
    	'sidebar_contact_title',
    	array(
	        'default'			=> __('Contact Title','erapress'),
			'sanitize_callback' => 'erapress_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 18,
		)
	);	
	$wp_customize->add_control( 
		'sidebar_contact_title',
		array(
		    'label'   		=> __('Contact','erapress'),
		    'section' 		=> 'header_sidebar',
			'type'		 =>	'text'
		)  
	);
	
	
	
	
	$wp_customize->add_setting( 'instagram_gallery', 
		array(
		 'sanitize_callback' => 'erapress_repeater_sanitize',
		 'transport'         => $selective_refresh,
		 'priority' => 18,
		 'default' => erapress_get_gallery_default()
		)
	);
	
	$wp_customize->add_control( 
		new erapress_Repeater( $wp_customize, 
			'instagram_gallery', 
				array(
					'label'   => esc_html__('Gallery','erapress'),
					'section' => 'header_sidebar',
					'add_field_label'                   => esc_html__( 'Add New', 'erapress' ),
					'item_name'                         => esc_html__( 'Gallery', 'erapress' ),
					'customizer_repeater_image_control' => true,
				) 
			) 
		);
}
add_action( 'customize_register', 'erapress_header_settings' );

// Header selective refresh
function erapress_header_partials( $wp_customize ){

	// hide show Social
	$wp_customize->selective_refresh->add_partial(
		'hide_show_social_icon', array(
			'selector' => '#above-header .widget_social_widget',
			'container_inclusive' => true,
			'render_callback' => 'header_top_right',
			'fallback_refresh' => true,
		)
	);
	// hide_show_cntct_details
	$wp_customize->selective_refresh->add_partial(
		'hide_show_cntct_details', array(
			'selector' => '#above-header .wgt-1',
			'container_inclusive' => true,
			'render_callback' => 'header_top_right',
			'fallback_refresh' => true,
		)
	);
	// hide_show_email_details
	$wp_customize->selective_refresh->add_partial(
		'hide_show_email_details', array(
			'selector' => '#above-header .wgt-2',
			'container_inclusive' => true,
			'render_callback' => 'header_top_right',
			'fallback_refresh' => true,
		)
	);
	// hide_show_mbl_details
	$wp_customize->selective_refresh->add_partial(
		'hide_show_mbl_details', array(
			'selector' => '#above-header .wgt-3',
			'container_inclusive' => true,
			'render_callback' => 'header_top_left',
			'fallback_refresh' => true,
		)
	);
	
	// hide_show_nav_btn
	$wp_customize->selective_refresh->add_partial(
		'hide_show_nav_btn', array(
			'selector' => '.navigator .av-button-area',
			'container_inclusive' => true,
			'render_callback' => 'header_navigation',
			'fallback_refresh' => true,
		)
	);
	// tlh_mobile_title
	$wp_customize->selective_refresh->add_partial( 'tlh_mobile_title', array(
		'selector'            => '.top-header .widget-contact .contact-area .tlh_mobile_title',
		'settings'            => 'tlh_mobile_title',
		'render_callback'  => 'erapress_tlh_mobile_title_render_callback',
	) );
	
	// tlh_mobile_sbtitle
	$wp_customize->selective_refresh->add_partial( 'tlh_mobile_sbtitle', array(
		'selector'            => '.top-header .widget-contact .contact-area .tlh_mobile_sbtitle',
		'settings'            => 'tlh_mobile_sbtitle',
		'render_callback'  => 'erapress_tlh_mobile_sbtitle_render_callback',
	) );
	
	// tlh_email_title
	$wp_customize->selective_refresh->add_partial( 'tlh_email_title', array(
		'selector'            => '.top-header .widget-contact .contact-area .tlh_email_title',
		'settings'            => 'tlh_email_title',
		'render_callback'  => 'erapress_tlh_email_title_render_callback',
	) );
	
	// tlh_email_sbtitle
	$wp_customize->selective_refresh->add_partial( 'tlh_email_sbtitle', array(
		'selector'            => '.top-header .widget-contact .contact-area .tlh_email_sbtitle',
		'settings'            => 'tlh_email_sbtitle',
		'render_callback'  => 'erapress_tlh_email_sbtitle_render_callback',
	) );
	
	// tlh_contact_title
	$wp_customize->selective_refresh->add_partial( 'tlh_contact_title', array(
		'selector'            => '.top-header .widget-contact .contact-area .tlh_contact_title',
		'settings'            => 'tlh_contact_title',
		'render_callback'  => 'erapress_tlh_contact_title_render_callback',
	) );
	
	// tlh_contact_sbtitle
	$wp_customize->selective_refresh->add_partial( 'tlh_contact_sbtitle', array(
		'selector'            => '.top-header .widget-contact .contact-area .tlh_contact_title',
		'settings'            => 'tlh_contact_sbtitle',
		'render_callback'  => 'erapress_tlh_contact_sbtitle_render_callback',
	) );
	
	// sidebar_title
	$wp_customize->selective_refresh->add_partial( 'sidebar_title', array(
		'selector'            => '.sidenav .custom-widget .widget-title',
		'settings'            => 'sidebar_title',
		'render_callback'  => 'erapress_sidebar_title_render_callback',
	) );
	
	// sidebar_desc
	$wp_customize->selective_refresh->add_partial( 'sidebar_desc', array(
		'selector'            => '.sidenav .custom-widget p',
		'settings'            => 'sidebar_desc',
		'render_callback'  => 'erapress_sidebar_desc_render_callback',
	) );
	
	// instagram_title
	$wp_customize->selective_refresh->add_partial( 'instagram_title', array(
		'selector'            => '.sidenav .widget_media_gallery .widget-title',
		'settings'            => 'instagram_title',
		'render_callback'  => 'erapress_instagram_title_render_callback',
	) );
	
	// sidebar_contact_title
	$wp_customize->selective_refresh->add_partial( 'sidebar_contact_title', array(
		'selector'            => '.sidenav .widget-contact .widget-title',
		'settings'            => 'sidebar_contact_title',
		'render_callback'  => 'erapress_sidebar_contact_title_render_callback',
	) );
	
	// info_header_text
	$wp_customize->selective_refresh->add_partial( 'tlh_header_info_text', array(
		'selector'            => '.top-header .left-area .contact p',
		'settings'            => 'tlh_header_info_text',
		'render_callback'  => 'erapress_info_header_text_render_callback',
	) );
	}

add_action( 'customize_register', 'erapress_header_partials' );

// tlh_mobile_title
function erapress_tlh_mobile_title_render_callback() {
	return get_theme_mod( 'tlh_mobile_title' );
}

// tlh_mobile_sbtitle
function erapress_tlh_mobile_sbtitle_render_callback() {
	return get_theme_mod( 'tlh_mobile_sbtitle' );
}

// tlh_email_title
function erapress_tlh_email_title_render_callback() {
	return get_theme_mod( 'tlh_email_title' );
}

// tlh_email_sbtitle
function erapress_tlh_email_sbtitle_render_callback() {
	return get_theme_mod( 'tlh_email_sbtitle' );
}

// tlh_contact_title
function erapress_tlh_contact_title_render_callback() {
	return get_theme_mod( 'tlh_contact_title' );
}

// tlh_contact_sbtitle
function erapress_tlh_contact_sbtitle_render_callback() {
	return get_theme_mod( 'tlh_contact_sbtitle' );
}

// sidebar_title
function erapress_sidebar_title_render_callback() {
	return get_theme_mod( 'sidebar_title' );
}

// sidebar_desc
function erapress_sidebar_desc_render_callback() {
	return get_theme_mod( 'sidebar_desc' );
}

// instagram_title
function erapress_instagram_title_render_callback() {
	return get_theme_mod( 'instagram_title' );
}

// sidebar_contact_title
function erapress_sidebar_contact_title_render_callback() {
	return get_theme_mod( 'sidebar_contact_title' );
}

// info_header_text
function erapress_info_header_text_render_callback() {
	return get_theme_mod( 'tlh_info_header_text' );
}