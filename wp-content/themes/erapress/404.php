<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package EraPress
 */

get_header();
erapress_breadcrumbs_style(); 
$pg_404_title1			= get_theme_mod('pg_404_title1','404');
$pg_404_subtitle		= get_theme_mod('pg_404_subtitle','OOPS! YOUR PAGE NOT FOUND...');
$pg_404_btn_lbl			= get_theme_mod('pg_404_btn_lbl','Go To Home');
$pg_404_btn_link		= get_theme_mod('pg_404_btn_link');
$pg_404_img				= get_theme_mod('pg_404_img',get_template_directory_uri() . '/assets/images/bg/smile.svg');
?>
 
<section class="error-section ">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 ">
				<div class="text-404">
					 <?php if ( ! empty( $pg_404_title1 ) ) : ?>
						<h1>
							<?php
								if ( ! empty( $pg_404_title1 ) ) : 
									echo esc_html($pg_404_title1); 
								endif;
							?>							
						</h1>
					<?php 
						endif;
						if ( ! empty($pg_404_subtitle) ) : 
					?>		
						<h2>
							<?php echo wp_kses_post($pg_404_subtitle); ?>
						</h2>    
					<?php endif; ?>	
					<?php if ( ! empty($pg_404_btn_lbl) ) : ?>		
						<a href="<?php echo esc_url($pg_404_btn_link); ?>" class="btn hover-btn border "><i class="fa fa-angle-left"></i>    <?php echo esc_html($pg_404_btn_lbl); ?></a>   
					<?php endif; ?>	
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>