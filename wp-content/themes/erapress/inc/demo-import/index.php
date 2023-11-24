<?php
function erapress_import_files() {
    return array(
        array(
            'import_file_name'             => 'Erapress Free',
            'categories'                   => array( 'Erapress Free' ),
            'import_file_url'              => 'https://xolotheme.com/import/erapress/free/erapress-site.xml',
			
            'import_widget_file_url'       => 'https://xolotheme.com/import/erapress/free/erapress-widget.json',
			
            'import_customizer_file_url'   => 'https://xolotheme.com/import/erapress/free/erapress-settings.dat',
			
			'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . '/screenshot.jpg',

            'import_notice'                => __( 'Demo Importing process will take some time. Kindly be patience.', 'erapress' ),
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'erapress_import_files' );


function erapress_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
	$footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'primary_menu' => $main_menu->term_id,
        )
    );
	
	set_theme_mod( 'nav_menu_locations', array(
            'footer_menu' => $footer_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'erapress_after_import_setup' );


function erapress_plugin_intro_text( $default_text ) {
    $default_text .= '<div class="ocdi__intro-text"><h4>Do you want to import Premade Demos? Just click on Import button<h4></div>';

    return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'erapress_plugin_intro_text' );


function erapress_plugin_page_setup( $default_settings ) {
    $default_settings['parent_slug'] = 'themes.php';
    $default_settings['page_title']  = esc_html__( 'One Click Demo Import' , 'erapress' );
    $default_settings['menu_title']  = esc_html__( 'Premade Demos' , 'erapress' );
    $default_settings['capability']  = 'import';
    $default_settings['menu_slug']   = 'one-click-demo-import';

    return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'erapress_plugin_page_setup' );