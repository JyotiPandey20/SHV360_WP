<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>">
		<?php endif; ?>

		<?php wp_head(); ?>
	</head>
	
<body <?php body_class(); ?>  >
<!--============== Dark/Light Theme Switcher ============= -->

<div class="theme-menu">
	<div class="theme-switcher">
		<input type="radio" id="light-theme" name="themes">
		<label for="light-theme" id="light">
		<span>
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sun"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
		</span>
		</label>
		<input type="radio" id="dark-theme" name="themes">
		<label for="dark-theme" id="dark">
		<span>
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-moon"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
		</span>
		</label>

		<span class="slider"></span>
	</div>
</div>
<!--============== Dark/Light Theme Switcher ============= -->
<?php wp_body_open(); ?>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'erapress' ); ?></a>
		
		<?php
	if ( get_header_image() ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-header" id="custom-header" rel="home">
			<img src="<?php esc_url(header_image()); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr(get_bloginfo( 'title' )); ?>">
		</a>
	<?php endif; ?>
	
	<?php	
	// Header Type
	$erapress_header_type	=	get_theme_mod('erapress_header_type','header-default');
	if($erapress_header_type =='header-two'):
	
		 get_template_part('template-parts/sections/section','header2');
		
	 elseif($erapress_header_type =='header-three'):
	
		 get_template_part('template-parts/sections/section','header3');
	else:
	
		get_template_part('template-parts/sections/section','header'); 
		
		
	endif;	
	?>
	
	<div id="content" class="erapress-content">