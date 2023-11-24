<?php
function erapress_edd_archives( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	

	$wp_customize->add_panel(
		'erapress_edd', array(
			'priority' => 10,
			'title' => esc_html__( 'Easy Digital Download', 'erapress' ),
		)
	);	

/*=========================================
	Erapress Single Blog
=========================================*/
	$wp_customize->add_section(
        'erapress_edd_product_archive',
        array(
        	'priority'      => 1,
            'title' 		=> __('Product Archive','erapress'),
			'panel'  		=> 'erapress_edd',
		)
    );
	if ( class_exists( 'Erapress_Customize_Control_Radio_Image' ) ) {
		// Default pages
		$wp_customize->add_setting(
			'erapress_edd_archives_layout', array(
				'sanitize_callback' => 'erapress_sanitize_select',
				'default' => 'erapress_rsb',
			)
		);

		$wp_customize->add_control(
			new Erapress_Customize_Control_Radio_Image(
				$wp_customize, 'erapress_edd_archives_layout', array(
					'label'     => esc_html__( 'Layout', 'erapress' ),
					'section'   => 'erapress_edd_product_archive',
					'priority'  => 1,
					'choices'   => array(
						'erapress_lsb' => array(
							'url' => apply_filters( 'erapress_lsb', esc_url(trailingslashit( get_template_directory_uri() ) . 'inc/customizer/assets/images/lsb.svg' )),
						),
						'erapress_fullwidth' => array(
							'url' => apply_filters( 'erapress_fullwidth', esc_url(trailingslashit( get_template_directory_uri() ) . 'inc/customizer/assets/images/full-width.svg' )),
						),
						'erapress_rsb' => array(
							'url' => apply_filters( 'erapress_rsb', esc_url(trailingslashit( get_template_directory_uri() ) . 'inc/customizer/assets/images/rsb.svg' )),
						),
					),
				)
			)
		);
	}
	
	// Product Type // 
	$wp_customize->add_setting( 
		'edd_product_types' , 
			array(
			'default' => __('grid', 'erapress' ),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'erapress_sanitize_select',
		) 
	);

	$wp_customize->add_control(
	'edd_product_types' , 
		array(
			'label'          => __( 'Product Type', 'erapress' ),
			'section'        => 'erapress_edd_product_archive',
			'type'           => 'select',
			'priority'      => 2,
			'choices'        => 
			array(
				'grid'       => __( 'Grid', 'erapress' ),
				'list' => __( 'List', 'erapress' )
			) 
		) 
	);	
	
	// Grid Layout // 
	$wp_customize->add_setting( 
		'edd_archive_column' , 
			array(
			'default' => __('6', 'erapress' ),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'erapress_sanitize_select',
		) 
	);

	$wp_customize->add_control(
	'edd_archive_column' , 
		array(
			'label'          => __( 'Grid Layout', 'erapress' ),
			'section'        => 'erapress_edd_product_archive',
			'type'           => 'select',
			'priority'      => 2,
			'choices'        => 
			array(
				'12'       => __( '1 Column ', 'erapress' ),
				'6' => __( '2 Columns', 'erapress' ),
				'4' => __( '3 Columns', 'erapress' ),
				'3' => __( '4 Columns', 'erapress' )
			) 
		) 
	);	
	
	// Structure
	 $wp_customize->add_setting( 
		'edd_product_structure' , 
			array(
			'default'   => array(
							'feature-image',
							'title',
							'meta',
							'description',
						),
		'sanitize_callback' => 'erapress_sanitize_sortable',
		) 
	);
	
	$wp_customize->add_control( 
	new Erapress_Control_Sortable( $wp_customize, 'edd_product_structure', 
		array(
			'label'      => __( 'Structure', 'erapress' ),
			'section'     => 'erapress_edd_product_archive',
			'priority'      => 3,
			'choices'     => array(				
				'feature-image'   => __( 'Feature Image', 'erapress' ),
				'title'     => __( 'Title', 'erapress' ),
				'meta'     => __( 'Meta', 'erapress' ),
				'description'     => __( 'Description', 'erapress' ),
			),
			
		) ) 
	);	
	
	// Meta Layout
	 $wp_customize->add_setting( 
		'edd_archive_meta_layout' , 
			array(
			'default'   => array(
							'price',
							'category',
							'cart',
						),
		'sanitize_callback' => 'erapress_sanitize_sortable',
		) 
	);
	
	$wp_customize->add_control( 
	new Erapress_Control_Sortable( $wp_customize, 'edd_archive_meta_layout', 
		array(
			'label'      => __( 'Meta', 'erapress' ),
			'section'     => 'erapress_edd_product_archive',
			'priority'      => 3,
			'choices'     => array(
				'price'   => __( 'Price', 'erapress' ),
				'cart'     => __( 'Add to Cart', 'erapress' ),
				'category'     => __( 'Category', 'erapress' ),
				'author'     => __( 'Author', 'erapress' ),
				'date'     => __( 'Date', 'erapress' ),
				'tags'     => __( 'Tags', 'erapress' ),
			),
		) ) 
	);
	
	// Show Author Box
	$wp_customize->add_setting(
		'erapress_enable_edd_sorting_bar'
			,array(
			'default' => '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'erapress_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
	'erapress_enable_edd_sorting_bar',
		array(
			'type' => 'checkbox',
			'label' => __('Enable Sorting Bar','erapress'),
			'section' => 'erapress_edd_product_archive',
			'priority'      => 4,
		)
	);
	
	// Show Author Box
	$wp_customize->add_setting(
		'erapress_enable_edd_grid_list'
			,array(
			'default' => '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'erapress_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
	'erapress_enable_edd_grid_list',
		array(
			'type' => 'checkbox',
			'label' => __('Enable Grid List','erapress'),
			'section' => 'erapress_edd_product_archive',
			'priority'      => 5,
		)
	);
	
	// Product Image Size// 
	if ( class_exists( 'Erapress_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'edd_archive_img_width',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'erapress_sanitize_range_value',
				'transport'         => 'postMessage'
			)
		);
		$wp_customize->add_control( 
		new Erapress_Customizer_Range_Control( $wp_customize, 'edd_archive_img_width', 
			array(
				'label'      => __( 'Media Image Width (%)', 'erapress' ),
				'section'  => 'erapress_edd_product_archive',
				'priority'      => 6,
				 'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 50,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 50,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 50,
                    ),
                ),
			) ) 
		);
	}

	// Cart button label // 
	$wp_customize->add_setting(
    	'cart_btn_lbl',
    	array(
			'title' 		=> __('Add to Cart','erapress'),
			'priority'      => 11,
			'sanitize_callback' => 'erapress_sanitize_text',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
		)
	);	

	$wp_customize->add_control( 
		'cart_btn_lbl',
		array(
		    'label'   => esc_html__('Add to Cart','erapress'),
		    'section' => 'erapress_edd_product_archive',
			'settings'=> 'cart_btn_lbl',
			'type' => 'text',
		)  
	);
	
	// Variable button label // 
	$wp_customize->add_setting(
    	'cart_variable_btn_lbl',
    	array(
			'title' 		=> __('View Details','erapress'),
			'priority'      => 11,
			'sanitize_callback' => 'erapress_sanitize_text',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
		)
	);	

	$wp_customize->add_control( 
		'cart_variable_btn_lbl',
		array(
		    'label'   => esc_html__('View Details','erapress'),
		    'section' => 'erapress_edd_product_archive',
			'settings'=> 'cart_variable_btn_lbl',
			'type' => 'text',
		)  
	);
	
	/*=========================================
	Erapress Single Product
	=========================================*/
	$wp_customize->add_section(
        'erapress_edd_product_Single',
        array(
        	'priority'      => 2,
            'title' 		=> __('Product Single','erapress'),
			'panel'  		=> 'erapress_edd',
		)
    );
	if ( class_exists( 'Erapress_Customize_Control_Radio_Image' ) ) {
		// Default pages
		$wp_customize->add_setting(
			'erapress_edd_single_layout', array(
				'sanitize_callback' => 'erapress_sanitize_select',
				'default' => 'erapress_rsb',
			)
		);

		$wp_customize->add_control(
			new Erapress_Customize_Control_Radio_Image(
				$wp_customize, 'erapress_edd_single_layout', array(
					'label'     => esc_html__( 'Layout', 'erapress' ),
					'section'   => 'erapress_edd_product_Single',
					'priority'  => 1,
					'choices'   => array(
						'erapress_lsb' => array(
							'url' => apply_filters( 'erapress_lsb', esc_url(trailingslashit( get_template_directory_uri() ) . 'inc/customizer/assets/images/lsb.svg' )),
						),
						'erapress_fullwidth' => array(
							'url' => apply_filters( 'erapress_fullwidth', esc_url(trailingslashit( get_template_directory_uri() ) . 'inc/customizer/assets/images/full-width.svg' )),
						),
						'erapress_rsb' => array(
							'url' => apply_filters( 'erapress_rsb', esc_url(trailingslashit( get_template_directory_uri() ) . 'inc/customizer/assets/images/rsb.svg' )),
						),
					),
				)
			)
		);
	}
	
	// Structure
	 $wp_customize->add_setting( 
		'edd_product_single_structure' , 
			array(
			'default'   => array(
							'feature-image',
							'content',
						),
		'sanitize_callback' => 'erapress_sanitize_sortable',
		) 
	);
	
	$wp_customize->add_control( 
	new Erapress_Control_Sortable( $wp_customize, 'edd_product_single_structure', 
		array(
			'label'      => __( 'Structure', 'erapress' ),
			'section'     => 'erapress_edd_product_Single',
			'priority'      => 3,
			'choices'     => array(				
				'feature-image'   => __( 'Feature Image', 'erapress' ),
				'content'     => __( 'Content', 'erapress' ),
			),
			
		) ) 
	);	
	
	// Related Item // 
	$wp_customize->add_setting(
		'edd_related'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'erapress_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'edd_related',
		array(
			'type' => 'hidden',
			'label' => __('Related Item','erapress'),
			'section' => 'erapress_edd_product_Single',
			'priority' => 15,
		)
	);
	
	 $wp_customize->add_setting( 'erapress_related_item_type', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'categories',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'erapress_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'erapress_related_item_type', array(
                'label'       => __( 'Related Item', 'erapress' ),
                'section'     => 'erapress_edd_product_Single',
                'type'        => 'select',
                'priority'    => 16,
                'choices'     => array(
                    'categories'       =>  __( 'EDD Categories', 'erapress' ),
                    'tags'     =>  __( 'EDD Tags', 'erapress' ),
                ),
            )
        )
    );
	
	if ( class_exists( 'Erapress_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'erapress_related_item_no',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'erapress_sanitize_range_value',
				'transport'         => 'postMessage'
			)
		);
		$wp_customize->add_control( 
		new Erapress_Customizer_Range_Control( $wp_customize, 'erapress_related_item_no', 
			array(
				'label'      => __( 'Number of Item', 'erapress' ),
				'section'  => 'erapress_edd_product_Single',
				'priority'      => 17,
				 'media_query'   => false,
                'input_attr'    => array(
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 4,
                    ),
                ),
			) ) 
		);
	}
	
	/*=========================================
	Erapress Product Styler
	=========================================*/
	$wp_customize->add_section(
        'erapress_edd_product_styler',
        array(
        	'priority'      => 3,
            'title' 		=> __('Product Styler','erapress'),
			'panel'  		=> 'erapress_edd',
		)
    );
	
	// EDD text color
	$wp_customize->add_setting(
	'archive_edd_txt_clr', 
	array(
		'default' => '#383E41',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'erapress_sanitize_alpha_color'
    ));
	
	$wp_customize->add_control( 
		new Erapress_Color_Control
		($wp_customize, 
			'archive_edd_txt_clr', 
			array(
				'label'      => __( 'Content Color', 'erapress' ),
				'section'    => 'erapress_edd_product_styler',
				'settings'   => 'archive_edd_txt_clr'
			) 
		) 
	);
	
	// EDD link color
	$wp_customize->add_setting(
	'archive_edd_title_clr', 
	array(
		'default' => '#383E41',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'erapress_sanitize_alpha_color',
    ));
	
	$wp_customize->add_control( 
		new Erapress_Color_Control
		($wp_customize, 
			'archive_edd_title_clr', 
			array(
				'label'      => __( 'Title Color', 'erapress' ),
				'section'    => 'erapress_edd_product_styler',
				'settings'   => 'archive_edd_title_clr'
			) 
		) 
	);
	
	// EDD link hover color
	$wp_customize->add_setting(
	'archive_edd_ttl_hov_clr', 
	array(
		'default' => '#381CC5',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'erapress_sanitize_alpha_color'
    ));
	
	$wp_customize->add_control( 
		new Erapress_Color_Control
		($wp_customize, 
			'archive_edd_ttl_hov_clr', 
			array(
				'label'      => __( 'Title Hover Color', 'erapress' ),
				'section'    => 'erapress_edd_product_styler',
				'settings'   => 'archive_edd_ttl_hov_clr'
			) 
		) 
	);
	
	// EDD icon color
	$wp_customize->add_setting(
	'archive_edd_icon_clr', 
	array(
		'default' => '#492cdd',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'erapress_sanitize_alpha_color',
    ));
	
	$wp_customize->add_control( 
		new Erapress_Color_Control
		($wp_customize, 
			'archive_edd_icon_clr', 
			array(
				'label'      => __( 'Meta Icon Color', 'erapress' ),
				'section'    => 'erapress_edd_product_styler',
				'settings'   => 'archive_edd_icon_clr'
			) 
		) 
	);
	
	// EDD meta color
	$wp_customize->add_setting(
	'archive_edd_meta_clr', 
	array(
		'default' => '#383E41',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'erapress_sanitize_alpha_color'
    ));
	
	$wp_customize->add_control( 
		new Erapress_Color_Control
		($wp_customize, 
			'archive_edd_meta_clr', 
			array(
				'label'      => __( 'Meta Color', 'erapress' ),
				'section'    => 'erapress_edd_product_styler',
				'settings'   => 'archive_edd_meta_clr'
			) 
		) 
	);
	
	// Edd Button color
	$wp_customize->add_setting(
	'archive_edd_btn_clr', 
	array(
		'default' => '#ffffff',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'erapress_sanitize_alpha_color',
    ));
	
	$wp_customize->add_control( 
		new Erapress_Color_Control
		($wp_customize, 
			'archive_edd_btn_clr', 
			array(
				'label'      => __( 'Button Text Color', 'erapress' ),
				'section'    => 'erapress_edd_product_styler',
				'settings'   => 'archive_edd_btn_clr'
			) 
		) 
	);
	
	// Edd Button BG color
	$wp_customize->add_setting(
	'archive_edd_btn_bg_clr', 
	array(
		'default' => '#492cdd',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'erapress_sanitize_alpha_color',
    ));
	
	$wp_customize->add_control( 
		new Erapress_Color_Control
		($wp_customize, 
			'archive_edd_btn_bg_clr', 
			array(
				'label'      => __( 'Button Background Color', 'erapress' ),
				'section'    => 'erapress_edd_product_styler',
				'settings'   => 'archive_edd_btn_bg_clr'
			) 
		) 
	);
	
	// Edd Tabs color
	$wp_customize->add_setting(
	'archive_edd_tabs_clr', 
	array(
		'default' => '#ffffff',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'erapress_sanitize_alpha_color',
    ));
	
	$wp_customize->add_control( 
		new Erapress_Color_Control
		($wp_customize, 
			'archive_edd_tabs_clr', 
			array(
				'label'      => __( 'Tabs Text Color', 'erapress' ),
				'section'    => 'erapress_edd_product_styler',
				'settings'   => 'archive_edd_tabs_clr'
			) 
		) 
	);
	
	// Edd Tabs BG color
	$wp_customize->add_setting(
	'archive_edd_tabs_bg_clr', 
	array(
		'default' => '#492cdd',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'erapress_sanitize_alpha_color',
    ));
	
	$wp_customize->add_control( 
		new Erapress_Color_Control
		($wp_customize, 
			'archive_edd_tabs_bg_clr', 
			array(
				'label'      => __( 'Tabs Background Color', 'erapress' ),
				'section'    => 'erapress_edd_product_styler',
				'settings'   => 'archive_edd_tabs_bg_clr'
			) 
		) 
	);
	
	// Edd Bg color
	$wp_customize->add_setting(
	'archive_edd_bg_clr', 
	array(
		'default' => '#',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'erapress_sanitize_alpha_color',
    ));
	
	$wp_customize->add_control( 
		new Erapress_Color_Control
		($wp_customize, 
			'archive_edd_bg_clr', 
			array(
				'label'      => __( 'Product Background Color', 'erapress' ),
				'section'    => 'erapress_edd_product_styler',
				'settings'   => 'archive_edd_bg_clr'
			) 
		) 
	);
}
add_action( 'customize_register', 'erapress_edd_archives' );	