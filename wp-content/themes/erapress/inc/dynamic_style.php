<?php
get_template_part( 'inc/customizer/control-function/functions-style' );
get_template_part( 'inc/customizer/control-function/typography-functions' );
if( ! function_exists( 'erapress_dynamic_style' ) ):
    function erapress_dynamic_style() {

		$output_css = '';
		
			
		 /**
		 *  Breadcrumb Style
		 */
		 
		$output_css   .= erapress_customizer_value( 'breadcrumb_min_height', '.breadcrumb-content', array( 'min-height' ), array( 236, 236, 236 ), 'px' );
		 $output_css   .=  erapress_customizer_value( 'breadcrumb_title_size', '.breadcrumb-heading h2', array( 'font-size' ), array( 20, 20, 20 ), 'px' );
		  $output_css   .=  erapress_customizer_value( 'breadcrumb_content_size', '.breadcrumb-list li', array( 'font-size' ), array( 16, 16, 16 ), 'px' );
		
		$breadcrumb_align				= get_theme_mod('breadcrumb_align','center');
		$breadcrumb_min_height			= get_theme_mod('breadcrumb_min_height','236');	
		if($breadcrumb_align !== '') { 
				$output_css .=".breadcrumb-center .breadcrumb-heading {
					text-align: " .esc_attr($breadcrumb_align). ";
				}\n";
			}
		
		$breadcrumb_bg_img			= get_theme_mod('breadcrumb_bg_img',get_template_directory_uri() .'/assets/images/bg/breadcrumbg.jpg'); 
		$breadcrumb_back_attach		= get_theme_mod('breadcrumb_back_attach','scroll'); 
		$breadcrumb_bg_img_opacity	= get_theme_mod('breadcrumb_bg_img_opacity','0.75');
		$breadcrumb_overlay_color	= get_theme_mod('breadcrumb_overlay_color','#000000');

		if($breadcrumb_bg_img !== '') { 
			$output_css .=".breadcrumb-section {
					background-image: url(" .esc_url($breadcrumb_bg_img). ");
					background-attachment: " .esc_attr($breadcrumb_back_attach). ";
				}\n";
		}
		
		if($breadcrumb_bg_img !== '') { 
			$output_css .=".breadcrumb-section{
					content = '';
					background-color: " .esc_attr($breadcrumb_overlay_color). ";
					opacity: " .esc_attr($breadcrumb_bg_img_opacity). ";
				}\n";
		}
		
		/**
		 * Logo Width 
		 */
		$output_css   .= erapress_customizer_value( 'logo_width', 'body[class*="header-"] .logo img, body[class*="header-"] .mobile-logo img', array( 'max-width' ), array( 140, 140, 140 ), 'px !important' );
		$output_css   .= erapress_customizer_value( 'site_ttl_size', '.site-title', array( 'font-size' ), array( 30, 30, 30 ), 'px !important' );
		$output_css   .= erapress_customizer_value( 'site_desc_size', '.site-description', array( 'font-size' ), array( 16, 16, 16 ), 'px !important' );
		
	
		$custom_color_type	= get_theme_mod('custom_color_type','gradiant');
			$theme_color 	= get_theme_mod('theme_color','#FF9300');
			if($custom_color_type == 'prebuilt') {
			$output_css .=":root {
						--gradient1:" .esc_attr($theme_color). ";
						--primary-color:" .esc_attr($theme_color). ";
						--primary-color-2:#FF0056;
						--sc:#363636;
					}\n";
			
			}	
			
			$primary_color1 			= get_theme_mod('primary_color1','#FF9300');
			$primary_color1_loc 		= get_theme_mod('primary_color1_loc','10');
			$primary_color2 			= get_theme_mod('primary_color2','#FF0056');
			$primary_color2_loc 		= get_theme_mod('primary_color2_loc','100');
			$primary_color_grad_degree 	= get_theme_mod('primary_color_grad_degree','-137');
			 
			 if($custom_color_type == 'solid') {
			$output_css .=":root {
						--gradient1:" .esc_attr($primary_color1). ";
						--primary-color:" .esc_attr($primary_color1). ";
						--primary-color-2:" .esc_attr($primary_color2). ";
					}\n";
			
			}
			
			if($custom_color_type == 'gradiant') { 
				$output_css .=":root {
						--gradient1:linear-gradient(" .esc_attr($primary_color_grad_degree). "deg, var(--primary-color) " .esc_attr($primary_color1_loc). "%, var(--primary-color-2) " .esc_attr($primary_color2_loc). "%);
						--primary-color:" .esc_attr($primary_color1). ";
						--primary-color-2:" .esc_attr($primary_color2). ";
					}\n";
			}
		

		/**
		 *  Typography Body
		 */
		 $erapress_body_font_family		 = get_theme_mod('erapress_body_font_family','');
		 $erapress_body_font_weight	 	 = get_theme_mod('erapress_body_font_weight','inherit');
		 $erapress_body_text_transform	 = get_theme_mod('erapress_body_text_transform','inherit');
		 $erapress_body_font_style	 	 = get_theme_mod('erapress_body_font_style','inherit');
		 $erapress_body_txt_decoration	 = get_theme_mod('erapress_body_txt_decoration','none');
		
		 $output_css   .= erapress_customizer_value( 'erapress_body_font_size', 'body', array( 'font-size' ), array( 16, 16, 16 ), 'px' );
		 $output_css   .= erapress_customizer_value( 'erapress_body_line_height', 'body', array( 'line-height' ), array( 1.6, 1.6, 1.6 ) );
		 $output_css   .= erapress_customizer_value( 'erapress_body_ltr_space', 'body', array( 'letter-spacing' ), array( 0, 0, 0 ), 'px' );
		 if($erapress_body_font_family !== '') { 
			if ( $erapress_body_font_family && ( strpos( $erapress_body_font_family, ',' ) != true ) ) {
				erapress_enqueue_google_font($erapress_body_font_family);
			}	
			 $output_css .=" body{ font-family: " .esc_attr($erapress_body_font_family). ";	}\n";
		 }
		 $output_css .=" body{ 
			font-weight: " .esc_attr($erapress_body_font_weight). ";
			text-transform: " .esc_attr($erapress_body_text_transform). ";
			font-style: " .esc_attr($erapress_body_font_style). ";
			text-decoration: " .esc_attr($erapress_body_txt_decoration). ";
		} a {text-decoration: " .esc_attr($erapress_body_txt_decoration). ";
		}\n";		 
		
		/**
		 *  Typography Heading
		 */
		 for ( $i = 1; $i <= 6; $i++ ) {
			 $erapress_heading_font_family	    = get_theme_mod('erapress_h' . $i . '_font_family','');	
			 $erapress_heading_font_weight	 	= get_theme_mod('erapress_h' . $i . '_font_weight','700');
			 $erapress_heading_text_transform 	= get_theme_mod('erapress_h' . $i . '_text_transform','inherit');
			 $erapress_heading_font_style	 	= get_theme_mod('erapress_h' . $i . '_font_style','inherit');
			 $erapress_heading_txt_decoration	= get_theme_mod('erapress_h' . $i . '_text_decoration','inherit');
			 
			 $output_css   .= erapress_customizer_value( 'erapress_h' . $i . '_font_size', 'h' . $i .'', array( 'font-size' ), array( 36, 36, 36 ), 'px' );
			 $output_css   .= erapress_customizer_value( 'erapress_h' . $i . '_line_height', 'h' . $i . '', array( 'line-height' ), array( 1.2, 1.2, 1.2 ) );
			 $output_css   .= erapress_customizer_value( 'erapress_h' . $i . '_ltr_spacing', 'h' . $i . '', array( 'letter-spacing' ), array( 0, 0, 0 ), 'px' );
			  if($erapress_heading_font_family !== '') {
				  if ( $erapress_heading_font_family && ( strpos( $erapress_heading_font_family, ',' ) != true ) ) {
					erapress_enqueue_google_font($erapress_heading_font_family);
				  }
			  }	
			 $output_css .=" h" . $i . "{ 
				font-family: " .esc_attr($erapress_heading_font_family). ";
				font-weight: " .esc_attr($erapress_heading_font_weight). ";
				text-transform: " .esc_attr($erapress_heading_text_transform). ";
				font-style: " .esc_attr($erapress_heading_font_style). ";
				text-decoration: " .esc_attr($erapress_heading_txt_decoration). ";
			}\n";
		 }


		/**
		 *  Typography Menu
		 */
		 $erapress_menu_font_family		 = get_theme_mod('erapress_menu_font_family');
		 $erapress_menu_font_weight	 	 = get_theme_mod('erapress_menu_font_weight','inherit');
		 $erapress_menu_text_transform	 	 = get_theme_mod('erapress_menu_text_transform','inherit');
		 $erapress_menu_font_style	 	 	 = get_theme_mod('erapress_menu_font_style','inherit');
		 $erapress_menu_txt_decoration	 	 = get_theme_mod('erapress_menu_txt_decoration','inherit');
		 
		 $output_css   .= erapress_customizer_value( 'erapress_menu_font_size', '.navbar .navbar-menu .menu-item a, .dropdown-menu li a', array( 'font-size' ), array( 15, 15, 15 ), 'px' );
		 $output_css   .= erapress_customizer_value( 'erapress_menu_line_height', '.navbar .navbar-menu .menu-item a, .dropdown-menu li a', array( 'line-height' ), array( 3, 3, 3 ), '!important');
		 $output_css   .= erapress_customizer_value( 'erapress_menu_ltr_space', '.navbar .navbar-menu .menu-item a, .dropdown-menu li a', array( 'letter-spacing' ), array( 0, 0, 0 ), 'px' );
		   if($erapress_menu_font_family !== '') { 
			if ( $erapress_menu_font_family && ( strpos( $erapress_menu_font_family, ',' ) != true ) ) {
				erapress_enqueue_google_font($erapress_menu_font_family);
			}	
			 $output_css .=".navbar .navbar-menu .menu-item a, .dropdown-menu li a{ font-family: " .esc_attr($erapress_menu_font_family). ";	}\n";
		 }
		 $output_css .=".navbar .navbar-menu .menu-item a, .dropdown-menu li a{ 
			font-weight: " .esc_attr($erapress_menu_font_weight). ";
			text-transform: " .esc_attr($erapress_menu_text_transform). ";
			font-style: " .esc_attr($erapress_menu_font_style). ";
			text-decoration: " .esc_attr($erapress_menu_txt_decoration). ";
		}\n";
		
		
		$footer_bg_color	= get_theme_mod('footer_bg_color','#0d0c44');
		$footer_bg_img		= get_theme_mod('footer_bg_img',esc_url(get_template_directory_uri() .'/assets/images/footer/footer-bg.jpg'));
		$footer_bg_opacity_clr	= get_theme_mod('footer_bg_opacity_clr','#000000');
		$footer_bg_opacity	= get_theme_mod('footer_bg_opacity','0.75');
		list($br, $bg, $bb) = sscanf($footer_bg_opacity_clr, "#%02x%02x%02x");
		
		
		if(!empty($footer_bg_img)){
			 $output_css .=".footer-background{ 
				background-image: url(".esc_url($footer_bg_img).");
				background-blend-mode: multiply;
			}.footer-background:after{
				content: '';
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				opacity: ".esc_attr($footer_bg_opacity).";
				background: ".esc_attr($footer_bg_opacity_clr)." none repeat scroll 0 0;
				z-index: -1;
			}\n";
		}else{
			 $output_css .=".footer-background{ 
				    background: ".esc_attr($footer_bg_color).";
			}\n";
			
		}
		
        wp_add_inline_style( 'erapress-style', $output_css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'erapress_dynamic_style' );
?>