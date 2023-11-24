<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package erapress
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function erapress_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Select Theme
	$select_theme		= get_theme_mod('select_theme','erapress-theme');
	$classes[] = esc_attr($select_theme);
	
	// Header Type
	$erapress_header_type	=	get_theme_mod('erapress_header_type','header-default');
	$classes[] = esc_attr($erapress_header_type);

	// Footer Type
	$erapress_footer_type	=	get_theme_mod('erapress_footer_type','footer-dark');
	$classes[] = esc_attr($erapress_footer_type);
	
	return $classes;
}
add_filter( 'body_class', 'erapress_body_classes' );

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Backward compatibility for wp_body_open hook.
	 *
	 * @since 1.0.0
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

if (!function_exists('erapress_str_replace_assoc')) {

    /**
     * erapress_str_replace_assoc
     * @param  array $replace
     * @param  array $subject
     * @return array
     */
    function erapress_str_replace_assoc(array $replace, $subject) {
        return str_replace(array_keys($replace), array_values($replace), $subject);
    }
}

// Comments Counts
if ( ! function_exists( 'erapress_comment_count' ) ) :
function erapress_comment_count() {
	$erapress_comments_count 	= get_comments_number();
	if ( 0 === intval( $erapress_comments_count ) ) {
		echo esc_html__( '0 Comments', 'erapress' );
	} else {
		/* translators: %s Comment number */
		 echo sprintf( _n( '%s Comment', '%s Comments', $erapress_comments_count, 'erapress' ), number_format_i18n( $erapress_comments_count ) );
	}
} 
endif;

//Background Image Pattern
function erapress_background_pattern()
{
	$bg_pattern = get_theme_mod('bg_pattern','bg-img1.png');
	if($bg_pattern!='')
	{
	echo '<style>body.boxed { background-image:url("'.get_template_directory_uri().'/assets/images/bg-pattern/'.$bg_pattern.'");}</style>';
	}
}
add_action('wp_head','erapress_background_pattern',10,0);


/**
 * Display Sidebars
 */
if ( ! function_exists( 'erapress_get_sidebars' ) ) {
	/**
	 * Get Sidebar
	 *
	 * @since 1.0
	 * @param  string $sidebar_id   Sidebar Id.
	 * @return void
	 */
	function erapress_get_sidebars( $sidebar_id ) {
		if ( is_active_sidebar( $sidebar_id ) ) {
			dynamic_sidebar( $sidebar_id );
		} elseif ( current_user_can( 'edit_theme_options' ) ) {
			?>
			<div class="widget">
				<p class='no-widget-text'>
					<a href='<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>'>
						<?php esc_html_e( 'Add Widget', 'erapress' ); ?>
					</a>
				</p>
			</div>
			<?php
		}
	}
}

/**
 * Get registered sidebar name by sidebar ID.
 *
 * @since  1.0.0
 * @param  string $sidebar_id Sidebar ID.
 * @return string Sidebar name.
 */
function erapress_get_sidebar_name_by_id( $sidebar_id = '' ) {

	if ( ! $sidebar_id ) {
		return;
	}

	global $wp_registered_sidebars;
	$sidebar_name = '';

	if ( isset( $wp_registered_sidebars[ $sidebar_id ] ) ) {
		$sidebar_name = $wp_registered_sidebars[ $sidebar_id ]['name'];
	}

	return $sidebar_name;
}

// EraPress Footer Group First
if ( ! function_exists( 'erapress_footer_group_first' ) ) :
function erapress_footer_group_first() {
	$footer_bottom_1 			= get_theme_mod('footer_bottom_1','custom');	
	$footer_first_custom 		= get_theme_mod('footer_first_custom','Copyright &copy; [current_year] [site_title] | Powered by [theme_author]');	
		// Custom
		if($footer_bottom_1 == 'custom'): ?>
			<?php  if ( ! empty( $footer_first_custom ) ){ ?>
				<?php 	
					$erapress_copyright_allowed_tags = array(
						'[current_year]' => date_i18n('Y', current_time( 'timestamp' )),
						'[site_title]'   => get_bloginfo('name'),
						'[theme_author]' => sprintf(__('<a href="#">EraPress WordPress Theme</a>', 'erapress')),
					);
				?>
				<div class="widget-center text-av-center text-center">                          
					<div class="copyright-text">
						<?php
							echo apply_filters('erapress_footer_copyright', wp_kses_post(erapress_str_replace_assoc($erapress_copyright_allowed_tags, $footer_first_custom)));
						?>
					</div>
				</div>
			<?php } ?>
		<?php endif;
		
		// Widget
		 if($footer_bottom_1 == 'widget'): ?>
			<?php  erapress_get_sidebars( 'erapress-footer-layout-first' ); ?>
		<?php endif; 
		
		// Menu
		 if($footer_bottom_1 == 'menu'): ?>
			<aside class="widget widget_nav_menu">
				<div class="menu-pages-container">
					<?php 
						wp_nav_menu( 
							array(  
								'theme_location' => 'footer_menu',
								'container'  => '',
								'menu_class' => 'menu',
								'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
								'walker' => new WP_Bootstrap_Navwalker()
								 ) 
							);
					?>   
				</div>
			</aside>	
		<?php endif; ?>
	<?php 
	} 
endif;


// EraPress Footer Group Second
if ( ! function_exists( 'erapress_footer_group_second' ) ) :
function erapress_footer_group_second() {
	$footer_bottom_2 			= get_theme_mod('footer_bottom_2','none');	
	$footer_second_custom 		= get_theme_mod('footer_second_custom');
		// Custom
		 if($footer_bottom_2 == 'custom'): ?>
			<?php 	
				$erapress_copyright_allowed_tags = array(
					'[current_year]' => date_i18n('Y', current_time( 'timestamp' )),
					'[site_title]'   => get_bloginfo('name'),
					'[theme_author]' => sprintf(__('<a href="#">EraPress WordPress Theme</a>', 'erapress')),
				);
			?>
			<div class="widget-center text-av-center text-center">                          
				<div class="copyright-text">
					<?php
						echo apply_filters('erapress_footer_copyright', wp_kses_post(erapress_str_replace_assoc($erapress_copyright_allowed_tags, $footer_second_custom)));
					?>
				</div>
			</div>
		<?php endif; 
		
		// Widget
		 if($footer_bottom_2 == 'widget'): ?>
			<?php  erapress_get_sidebars( 'erapress-footer-layout-second' ); ?>
		<?php endif; 
		
		// Menu
		 if($footer_bottom_2 == 'menu'): ?>
			<aside class="widget widget_nav_menu">
				<div class="menu-pages-container">
					<?php 
						wp_nav_menu( 
							array(  
								'theme_location' => 'footer_menu',
								'container'  => '',
								'menu_class' => 'menu',
								'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
								'walker' => new WP_Bootstrap_Navwalker()
								 ) 
							);
					?>   
				</div>
			</aside>	
		<?php endif; ?>
	<?php 
	} 
endif;	



/**
 * EraPress Above Header First
 */
if ( ! function_exists( 'erapress_abv_hdr_social' ) ) {
	function erapress_abv_hdr_social() {
		$hide_show_social_icon 		= get_theme_mod( 'hide_show_social_icon','1'); 
		$social_icons 				= get_theme_mod( 'social_icons',erapress_get_social_icon_default());	
		
				 if($hide_show_social_icon == '1') { ?>
					<aside class="widget widget_social_widget">
						<ul>
							<?php
								$social_icons = json_decode($social_icons);
								if( $social_icons!='' )
								{
								foreach($social_icons as $social_item){	
								$social_icon = ! empty( $social_item->icon_value ) ? apply_filters( 'erapress_translate_single_string', $social_item->icon_value, 'Header section' ) : '';	
								$social_link = ! empty( $social_item->link ) ? apply_filters( 'erapress_translate_single_string', $social_item->link, 'Header section' ) : '';
							?>
								<li><a href="<?php echo esc_url( $social_link ); ?>"><i class="fa <?php echo esc_attr( $social_icon ); ?>"></i></a></li>
							<?php }} ?>
						</ul>
					</aside>
				<?php } 
	}
}
add_action( 'erapress_abv_hdr_social', 'erapress_abv_hdr_social' );

/**
 * EraPress Footer Social
 */
if ( ! function_exists( 'erapress_footer_social' ) ) {
	function erapress_footer_social() {
		$hide_show_social_icon 		= get_theme_mod( 'hide_show_footer_social_icon','1'); 
		$social_icons 				= get_theme_mod( 'footer_social_icons',erapress_get_social_icon_default());	
		
				 if($hide_show_social_icon == '1') { ?>
					<aside class="widget widget_social_widget">
						<ul>
							<?php
								$social_icons = json_decode($social_icons);
								if( $social_icons!='' )
								{
								foreach($social_icons as $social_item){	
								$social_icon = ! empty( $social_item->icon_value ) ? apply_filters( 'erapress_translate_single_string', $social_item->icon_value, 'Header section' ) : '';	
								$social_link = ! empty( $social_item->link ) ? apply_filters( 'erapress_translate_single_string', $social_item->link, 'Header section' ) : '';
							?>
								<li><a href="<?php echo esc_url( $social_link ); ?>"><i class="fa <?php echo esc_attr( $social_icon ); ?>"></i></a></li>
							<?php }} ?>
						</ul>
					</aside>
				<?php } 
	}
}
add_action( 'erapress_footer_social', 'erapress_footer_social' );


 /**
 * Add WooCommerce Cart Icon With Cart Count (https://isabelcastillo.com/woocommerce-cart-icon-count-theme-header)
 */
function erapress_add_to_cart_fragment( $fragments ) {
	
    ob_start();
    $count = WC()->cart->cart_contents_count;
	// Header Type
	$erapress_header_type	=	get_theme_mod('erapress_header_type','header-default');
	$header_cart				= get_theme_mod('header_cart','fa-shopping-cart'); 
	if($erapress_header_type =='ampark-theme header-eleven'):
	
    if ( $count > 0 ) { ?>
			 <span class="cart-count"><?php echo esc_html( $count ); ?></span>
		<?php }else { ?>
			<span class="cart-count"><?php esc_html_e( '0','erapress' ); ?></span>
			<?php 
		}
    $fragments['.cart-count'] = ob_get_clean();
	
	 else: ?>
		<a href="javascript:void(0)" class="cart-icon-wrap" id="cart" title="View your shopping cart"><i class="fa fa-cart-arrow-down"></i>
		<?php
		if ( $count > 0 ) { 
		?>
			<span><?php echo esc_html( $count ); ?></span>
		<?php  } else { ?>	
			<span>0</span>
		<?php } ?>
		</a>
		<?php
		$fragments['a.cart-icon-wrap'] = ob_get_clean();
     endif; 
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'erapress_add_to_cart_fragment' );



// Activate WordPress Maintenance Mode
$enable_comming_soon = get_theme_mod('enable_comming_soon');
  if($enable_comming_soon == '1') { 
	function wp_maintenance_mode() {
		if (!current_user_can('edit_themes') || !is_user_logged_in()) {
		   // wp_die('<h1>Under Maintenance</h1><br />Something aint right, but we are working on it! Check back later.');
		   $file = get_template_directory() . '/inc/maintenance.php';
				include($file);
				exit();
		}
	}
	add_action('get_header', 'wp_maintenance_mode');
 }
/*
 *
 * Social Icon
 */
function erapress_get_social_icon_default() {
	return apply_filters(
		'erapress_get_social_icon_default', json_encode(
				 array(
				array(
					'icon_value'	  =>  esc_html__( 'fa-facebook', 'erapress' ),
					'link'	  =>  esc_html__( '#', 'erapress' ),
					'id'              => 'customizer_repeater_header_social_001',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fa-google-plus', 'erapress' ),
					'link'	  =>  esc_html__( '#', 'erapress' ),
					'id'              => 'customizer_repeater_header_social_002',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fa-twitter', 'erapress' ),
					'link'	  =>  esc_html__( '#', 'erapress' ),
					'id'              => 'customizer_repeater_header_social_003',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fa-linkedin', 'erapress' ),
					'link'	  =>  esc_html__( '#', 'erapress' ),
					'id'              => 'customizer_repeater_header_social_004',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fa-behance', 'erapress' ),
					'link'	  =>  esc_html__( '#', 'erapress' ),
					'id'              => 'customizer_repeater_header_social_005',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fa-vimeo', 'erapress' ),
					'link'	  =>  esc_html__( '#', 'erapress' ),
					'id'              => 'customizer_repeater_header_social_006',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fa-skype', 'erapress' ),
					'link'	  =>  esc_html__( '#', 'erapress' ),
					'id'              => 'customizer_repeater_header_social_007',
				),
			)
		)
	);
}

/*
 *
 * Footer Above Default
 */
 function erapress_get_footer_above_default() {
	return apply_filters(
		'erapress_get_footer_above_default', json_encode(
				 array(
				array(
					'icon_value'       => 'fa-support',
					'title'           => esc_html__( 'Live Chat Support', 'erapress' ),
					'text'            => esc_html__( 'Lorem Ipsum simply dummy text printing.', 'erapress' ),
					'link'	  =>  esc_html__( '#', 'erapress' ),
					'id'              => 'customizer_repeater_footer_above_001',
					
				),
				array(
					'icon_value'       => 'fa-wechat',
					'title'           => esc_html__( 'Send Ticket', 'erapress' ),
					'text'            => esc_html__( 'Lorem Ipsum simply dummy text printing.', 'erapress' ),
					'link'	  =>  esc_html__( '#', 'erapress' ),
					'id'              => 'customizer_repeater_footer_above_002',
				
				),
				array(
					'icon_value'       => 'fa-file-zip-o',
					'title'           => esc_html__( 'Knowledge Base', 'erapress' ),
					'text'            => esc_html__( 'Lorem Ipsum simply dummy text printing.', 'erapress' ),
					'link'	  =>  esc_html__( '#', 'erapress' ),
					'id'              => 'customizer_repeater_footer_above_003',
			
				),
			)
		)
	);
}


/*
 *
 * Slider Default
 */
 function erapress_get_slider_default() {
	return apply_filters(
		'erapress_get_slider_default', json_encode(
				 array(
				array(
					'image_url'       => get_template_directory_uri() . '/assets/images/slider/img01.jpg',
					'title'           => esc_html__( 'Global Project Managment', 'erapress' ),
					'subtitle'         => esc_html__( 'Services & Solutions', 'erapress' ),
					'text'            => esc_html__( 'There are many variations of passages of Lorem Ipsum available but the majority have suffered injected humour dummy now.', 'erapress' ),
					'text2'	  =>  esc_html__( 'Get Started', 'erapress' ),
					'link'	  =>  esc_html__( '#', 'erapress' ),
					'button_second'	  =>  esc_html__( 'Read More', 'erapress' ),
					'link2'	  =>  esc_html__( '#', 'erapress' ),
					"slide_align" => "left", 
					'id'              => 'customizer_repeater_slider_001',
				),
				array(
					'image_url'       => get_template_directory_uri() . '/assets/images/slider/img02.jpg',
					'title'           => esc_html__( 'Develop Stronger Minds', 'erapress' ),
					'subtitle'         => esc_html__( 'Better Coaching Gets', 'erapress' ),
					'text'            => esc_html__( 'There are many variations of passages of Lorem Ipsum available but the majority have suffered injected humour dummy now.', 'erapress' ),
					'text2'	  =>  esc_html__( 'Get Started', 'erapress' ),
					'link'	  =>  esc_html__( '#', 'erapress' ),
					'button_second'	  =>  esc_html__( 'Read More', 'erapress' ),
					'link2'	  =>  esc_html__( '#', 'erapress' ),
					"slide_align" => "center", 
					'id'              => 'customizer_repeater_slider_002',
				),
				array(
					'image_url'       => get_template_directory_uri() . '/assets/images/slider/img03.jpg',
					'title'           => esc_html__( 'Industry Analysis', 'erapress' ),
					'subtitle'         => esc_html__( 'Marketing & Strategy', 'erapress' ),
					'text'            => esc_html__( 'There are many variations of passages of Lorem Ipsum available but the majority have suffered injected humour dummy now.', 'erapress' ),
					'text2'	  =>  esc_html__( 'Get Started', 'erapress' ),
					'link'	  =>  esc_html__( '#', 'erapress' ),
					'button_second'	  =>  esc_html__( 'Read More', 'erapress' ),
					'link2'	  =>  esc_html__( '#', 'erapress' ),
					"slide_align" => "right", 
					'id'              => 'customizer_repeater_slider_003',
			
				),
			)
		)
	);
}


/*
 *
 * Features Default
 */
 function erapress_get_features_default() {
	return apply_filters(
		'erapress_get_features_default', json_encode(
				 array(
				array(
					'title'           => esc_html__( 'Business Growth', 'erapress' ),
					'text'            => esc_html__( 'Many variations of at Lorem Ipsum but the majority have suffered. Lorem Ipsum the majority suffered.', 'erapress' ),
					'icon_value'       => 'fa-bar-chart',
					'id'              => 'customizer_repeater_features_001',
					
				),
				array(
					'title'           => esc_html__( 'Business Sustainability', 'erapress' ),
					'text'            => esc_html__( 'Many variations of at Lorem Ipsum but the majority have suffered. Lorem Ipsum the majority suffered.', 'erapress' ),
					'icon_value'       => 'fa-connectdevelop',
					'id'              => 'customizer_repeater_features_002',			
				),
				array(
					'title'           => esc_html__( 'Business Performance', 'erapress' ),
					'text'            => esc_html__( 'Many variations of at Lorem Ipsum but the majority have suffered. Lorem Ipsum the majority suffered.', 'erapress' ),
					'icon_value'       => 'fa-tachometer',
					'id'              => 'customizer_repeater_features_003',
				),
				array(
					'title'           => esc_html__( 'Business Organization', 'erapress' ),
					'text'            => esc_html__( 'Many variations of at Lorem Ipsum but the majority have suffered. Lorem Ipsum the majority suffered.', 'erapress' ),
					'icon_value'       => 'fa-user-secret',
					'id'              => 'customizer_repeater_features_004',
				),
				array(
					'title'           => esc_html__( 'Dedicated Teams', 'erapress' ),
					'text'            => esc_html__( 'Many variations of at Lorem Ipsum but the majority have suffered. Lorem Ipsum the majority suffered.', 'erapress' ),
					'icon_value'       => 'fa-folder-open-o',
					'id'              => 'customizer_repeater_features_005',
				),
				array(
					'title'           => esc_html__( '24X7 support', 'erapress' ),
					'text'            => esc_html__( 'Many variations of at Lorem Ipsum but the majority have suffered. Lorem Ipsum the majority suffered.', 'erapress' ),
					'icon_value'       => 'fa-users',
					'id'              => 'customizer_repeater_features_006',
				),
			)
		)
	);
}

/*
 *
 * Gallery Default
 */
 function erapress_get_gallery_default() {
	return apply_filters(
		'erapress_get_gallery_default', json_encode(
				 array(
				array(
					'image_url'       => get_template_directory_uri() . '/assets/images/blog/blog_bg.png',
					'id'              => 'customizer_repeater_gallery_001',
				),
				array(
					'image_url'       => get_template_directory_uri() . '/assets/images/blog/blog_bg2.png',
					'id'              => 'customizer_repeater_gallery_002',
				),
				array(
					'image_url'       => get_template_directory_uri() . '/assets/images/blog/blog_bg3.jpg',
					'id'              => 'customizer_repeater_gallery_003',
				),
				array(
					'image_url'       => get_template_directory_uri() . '/assets/images/blog/blog_bg4.jpg',
					'id'              => 'customizer_repeater_gallery_004',
				),
				array(
					'image_url'       => get_template_directory_uri() . '/assets/images/blog/blog_bg5.jpg',
					'id'              => 'customizer_repeater_gallery_005',
				),
				array(
					'image_url'       => get_template_directory_uri() . '/assets/images/blog/blog_bg6.jpg',
					'id'              => 'customizer_repeater_gallery_006',
				),
				array(
					'image_url'       => get_template_directory_uri() . '/assets/images/blog/blog_bg7.jpg',
					'id'              => 'customizer_repeater_gallery_007',
				),
				array(
					'image_url'       => get_template_directory_uri() . '/assets/images/blog/blog_bg8.jpg',
					'id'              => 'customizer_repeater_gallery_008',
				),
				array(
					'image_url'       => get_template_directory_uri() . '/assets/images/blog/blog_bg9.jpg',
					'id'              => 'customizer_repeater_gallery_009',
				),
			)
		)
	);
}
