<?php
if ( ! function_exists( 'erapress_setup' ) ) :
function erapress_setup() {

/**
 * Define Constants
 */
define( 'ERAPRESS_THEME_VERSION', '1.4' );

// Root path/URI.
define( 'ERAPRESS_PARENT_DIR', get_template_directory() );
define( 'ERAPRESS_PARENT_URI', get_template_directory_uri() );

// Root path/URI.
define( 'ERAPRESS_PARENT_INC_DIR', ERAPRESS_PARENT_DIR . '/inc');
define( 'ERAPRESS_PARENT_INC_URI', ERAPRESS_PARENT_URI . '/inc');

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'custom-header' );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	
	//Add selective refresh for sidebar widget
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'erapress' );
		
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary_menu' => esc_html__( 'Primary Menu', 'erapress' ),
		'footer_menu' => esc_html__( 'Footer Menu', 'erapress' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );	
	
	add_theme_support('custom-logo');
	
	// Gutenberg wide images.
	add_theme_support( 'align-wide' );
	
	// Editor style
	
	add_theme_support('editor-styles');
	add_editor_style('editor-style.css');
	
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.css', erapress_google_font() ) );
	
	//Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'erapress_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	if (function_exists('add_image_size')) {
		add_image_size('erapress-large-image', 856, 400, false);
	}
}
endif;
add_action( 'after_setup_theme', 'erapress_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function erapress_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'erapress_content_width', 1170 );
}
add_action( 'after_setup_theme', 'erapress_content_width', 0 );


/**
 * All Styles & Scripts.
 */
require_once get_template_directory() . '/inc/enqueue.php';

/**
 * Nav Walker fo Bootstrap Dropdown Menu.
 */

require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';


/**
 * Called Breadcrumb
 */
require_once get_template_directory() . '/inc/breadcrumb/breadcrumb.php';

/**
 * Sidebar.
 */
require_once get_template_directory() . '/inc/sidebar/sidebar.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Dynamic Style
 */
require_once get_template_directory() . '/inc/dynamic_style.php';
/**
 * Custom functions that act independently of the theme templates.
 */
require_once get_template_directory() . '/inc/extras.php';


/**
 * Customizer additions.
 */
 require_once get_template_directory() . '/inc/erapress-customizer.php';
  
 require get_template_directory() . '/inc/customizer/customizer-repeater/functions.php';

/**
 * Load Jetpack compatibility file.
 */
require_once get_template_directory() . '/inc/jetpack.php';


if ( is_admin() ) {
	require_once get_template_directory() . '/inc/admin/class-erapress-plugin-utilities.php';
	require_once get_template_directory() . '/inc/admin/class-erapress-admin.php';
}

/**
 * Compatibility
 */
require_once get_template_directory() . '/inc/compatibility/edd/class-erapress-edd.php';

/**
 * Called Demo Import Features
 */
require( get_template_directory() . '/inc/demo-import/index.php');

/**
* Plugin activation Check
*/
// Include or require the PHP file with the Erapress_Plugin_Utilities class definition
require_once get_template_directory(). '/inc/admin/class-erapress-plugin-utilities.php';	


/**
 * Suspend Elementor redirection after activation.
 */
function erapress_suspend_elementor_redirection() {
    // Check if Elementor is being activated
    if (isset($_GET['activate']) && $_GET['activate'] === 'true' && is_admin()) {
        // Suspend the redirection
        remove_action('admin_init', 'elementor_go_to_dashboard');
    }
}
add_action('admin_init', 'erapress_suspend_elementor_redirection');