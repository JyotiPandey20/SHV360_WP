<?php	
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package erapress
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function erapress_widgets_init() {
	// register_sidebar( array(
		// 'name' => __( 'Header Widget Area 1', 'erapress' ),
		// 'id' => 'erapress-header-above-first',
		// 'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		// 'after_widget' => '</aside>',
		// 'before_title' => '<h5 class="widget-title">',
		// 'after_title' => '</h5>',
	// ) );
	
	// register_sidebar( array(
		// 'name' => __( 'Header Widget Area 2', 'erapress' ),
		// 'id' => 'erapress-header-above-second',
		// 'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		// 'after_widget' => '</aside>',
		// 'before_title' => '<h5 class="widget-title">',
		// 'after_title' => '</h5>',
	// ) );
	
	register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'erapress' ),
		'id' => 'erapress-sidebar-primary',
		'description' => __( 'The Primary Widget Area', 'erapress' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
	
	
		register_sidebar( array(
			'name' => __( 'Footer  ', 'erapress' ),
			'id' => 'footer-1',
			'description' => __( 'The Footer Widget Area', 'erapress' ),
			'before_widget' => '<div class="col-lg-3"><aside id="%1$s" class="widget %2$s widget_block">',
			'after_widget' => '</aside></div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		) );
		
	// register_sidebar( array(
		// 'name' => __( 'WooCommerce Widget Area', 'erapress' ),
		// 'id' => 'erapress-woocommerce-sidebar',
		// 'description' => __( 'This Widget area for WooCommerce Widget', 'erapress' ),
		// 'before_widget' => '<div class="sidebar"><aside id="%1$s" class="widget %2$s">',
		// 'after_widget' => '</aside></div>',
		// 'before_title' => '<h5 class="widget-title">',
		// 'after_title' => '</h5>',
	// ) );
}
add_action( 'widgets_init', 'erapress_widgets_init' );
?>