<?php
function erapress_general_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'erapress_general', array(
			'priority' => 2,
			'title' => esc_html__( 'General', 'erapress' ),
		)
	);
	
	/*=========================================
	Preloader
	=========================================*/
	$wp_customize->add_section(
		'preloader', array(
			'title' => esc_html__( 'Preloader', 'erapress' ),
			'priority' => 1,
			'panel' => 'erapress_general',
		)
	);
	
	$wp_customize->add_setting( 
		'hs_preloader' , 
			array(
			'default' => '',
			'sanitize_callback' => 'erapress_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 1,
		) 
	);
	
	$wp_customize->add_control(
	'hs_preloader', 
		array(
			'label'	      => esc_html__( 'Hide / Show Preloader', 'erapress' ),
			'section'     => 'preloader',
			'type'        => 'checkbox'
		) 
	);
	
	/*=========================================
	Scroller
	=========================================*/
	$wp_customize->add_section(
		'top_scroller', array(
			'title' => esc_html__( 'Top Scroller', 'erapress' ),
			'priority' => 4,
			'panel' => 'erapress_general',
		)
	);
	
	$wp_customize->add_setting( 
		'hs_scroller' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'erapress_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 1,
		) 
	);
	
	$wp_customize->add_control(
	'hs_scroller', 
		array(
			'label'	      => esc_html__( 'Hide / Show Scroller', 'erapress' ),
			'section'     => 'top_scroller',
			'type'        => 'checkbox'
		) 
	);
	
	
	// Footer Setting Section // 
	$wp_customize->add_section(
        'footer_copy_Section',
        array(
            'title' 		=> __('Footer','erapress'),
			'panel'  		=> 'erapress_general',
			'priority'      => 4,
		)
    );

	
	
	// footer first text // 
	$erapress_footer_copyright = esc_html__('Copyright &copy; [current_year] [site_title] | Powered by [theme_author]', 'erapress' );
	$wp_customize->add_setting(
    	'footer_first_custom',
    	array(
			'default' => $erapress_footer_copyright,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
		)
	);	

	$wp_customize->add_control( 
		'footer_first_custom',
		array(
		    'label'   		=> __('Copyright Section','erapress'),
		    'section'		=> 'footer_copy_Section',
			'type' 			=> 'textarea',
			'priority'      => 4,
		)  
	);	
	
	
	$wp_customize->add_setting( 
		'hide_show_footer_social_icon' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'erapress_sanitize_checkbox',
			'priority' => 1,
		) 
	);
	
	$wp_customize->add_control(
	'hide_show_footer_social_icon', 
		array(
			'label'	      => esc_html__( 'Hide/Show Social', 'erapress' ),
			'section'     => 'footer_copy_Section',
			'type'        => 'checkbox'
		) 
	);
	
	/**
	 * Customizer Repeater
	 */
		$wp_customize->add_setting( 'footer_social_icons', 
			array(
			 'sanitize_callback' => 'erapress_repeater_sanitize',
			 'priority' => 2,
			 'default' => erapress_get_social_icon_default()
		)
		);
		
		$wp_customize->add_control( 
			new ERAPRESS_Repeater( $wp_customize, 
				'footer_social_icons', 
					array(
						'label'   => esc_html__('Social Icons','erapress'),
						'section' => 'footer_copy_Section',
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_link_control' => true,
					) 
				) 
			);
	
}

add_action( 'customize_register', 'erapress_general_setting' );