<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package erapress
 */

get_header();
erapress_breadcrumbs_style();  
$erapress_default_pg_layout 		= get_theme_mod('erapress_default_pg_layout', 'erapress_rsb'); 

$class='post-section  blog-page';
$col_class = 'col-lg-8';

?>

<section id="post-section" class="<?php echo esc_attr($class); ?>">
	<div class="container">
		<div class="row wow fadeInUp">
			<?php if($erapress_default_pg_layout == 'erapress_lsb'): ?>
				<div class="col-lg-4">
					<?php  get_sidebar(); ?>
				</div>
			<?php endif; ?>
			
			 <?php if($erapress_default_pg_layout == 'erapress_fullwidth'):?>
				<div id="primary-content" class="col-lg-12  wow fadeInUp">
			<?php else: ?>			
				<div id="primary-content" class="<?php echo esc_attr($col_class); ?>  wow fadeInUp">
			<?php endif; ?>	
				
			<?php 		
				if( have_posts()) :  the_post();
				
				the_content(); 
				endif;
				
				if( $post->comment_status == 'open' ) { 
					 comments_template( '', true ); // show comments 
				}
			?>
			
			<!-- Pagination -->
			<?php		
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'erapress' ),
					'after'  => '</div>',
				) );
				// Previous/next page navigation.
				the_posts_pagination( array(
				'prev_text'          => '<i class="fa fa-angle-double-left"></i>',
				'next_text'          => '<i class="fa fa-angle-double-right"></i>',
				) ); ?>
			<!-- Pagination -->	
			</div>
			
			<?php if($erapress_default_pg_layout == 'erapress_rsb'): ?>
				<div class="col-lg-4">
					<?php get_sidebar(); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section> 	
<?php get_footer(); ?>