<?php
 /**
 * Enqueue scripts and styles.
 */
function erapress_scripts() {
	/**-------Bootstrap-------*/
	wp_enqueue_style('bootstrap-min', get_template_directory_uri(). '/assets/css/bootstrap.min.css');
	
	/**-------Owl Carousel-------*/
 	wp_enqueue_style('owl-carousel-min', get_template_directory_uri().'/assets/css/owl.carousel.min.css' );
	
	wp_enqueue_style('owl-theme-min', get_template_directory_uri().'/assets/css/owl.theme.default.min.css' );
	/**-------Style-------*/
	wp_enqueue_style('erapress-editor-style', get_template_directory_uri().'/assets/css/editor-style.css' );
 	wp_enqueue_style('erapress-style', get_template_directory_uri().'/assets/css/style.css' );
	
	wp_enqueue_style('erapress-widget', get_template_directory_uri().'/assets/css/widget.css' );
	wp_enqueue_style('erapress-widget-block', get_template_directory_uri().'/assets/css/widget-block.css' );
	
	/**-------Font Awesome-------*/
	wp_enqueue_style('font-awesome', get_template_directory_uri().'/assets/css/font-awesome.min.css' );
	

	
	/**-------jQuery-------*/
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script('jquery-drag', get_template_directory_uri().'/assets/js/jquery-drag.js' );
	
	wp_enqueue_media();
		
	/**-------jQuery Waypoints-------*/
	wp_enqueue_script('erapress-carousel',get_template_directory_uri() .'/assets/js/carousel.js', true,1);
	
	/**-------Custom JS-------*/
	wp_enqueue_script('wow-min', get_template_directory_uri().'/assets/js/wow.min.js' );
	wp_enqueue_script('jquery-ripples-min', get_template_directory_uri().'/assets/js/jquery.ripples.min.js' );
	wp_enqueue_script('bootstrap-min', get_template_directory_uri().'/assets/js/bootstrap.min.js' );
	wp_enqueue_script('owl-carousel-min', get_template_directory_uri().'/assets/js/owl.carousel.min.js' );
	wp_enqueue_script('counterup-min', get_template_directory_uri().'/assets/js/jquery.counterup.min.js' );
	wp_enqueue_script('jscolor-min', get_template_directory_uri().'/assets/js/jscolor.min.js' );
	wp_enqueue_script('erapress-custom', get_template_directory_uri().'/assets/js/custom.js' );
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'erapress_scripts' );

//Admin Enqueue for Admin
function erapress_admin_enqueue_scripts(){
	wp_enqueue_style('erapress-admin-style', get_template_directory_uri() . '/inc/customizer/assets/css/admin.css');
}
add_action( 'admin_enqueue_scripts', 'erapress_admin_enqueue_scripts' );


?>