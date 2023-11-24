<?php
/**
Template Name: Blog Right Sidebar Page
**/

get_header();
erapress_breadcrumbs_style();
?>
<section class="Blog-section wow fadeInUp">
        <div class="container">
            <div class="row">				 
				<div class="col-lg-8">		
					<?php 
						$erapress_paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
						$args = array( 'post_type' => 'post','paged'=>$erapress_paged );	
						$loop = new WP_Query( $args );
						$post_count=0
					?>
					<?php if( $loop->have_posts() ): ?>
					<?php while( $loop->have_posts() ): $loop->the_post(); 
							get_template_part('template-parts/content/content','page'); 						
							endwhile;
						?>
						<!-- Pagination -->
						<?php	
						$GLOBALS['wp_query']->max_num_pages = $loop->max_num_pages;	
						// Previous/next page navigation.
						the_posts_pagination( array(
						'prev_text'          => '<i class="fa fa-angle-double-left"></i>',
						'next_text'          => '<i class="fa fa-angle-double-right"></i>',
						) ); ?>
					<!-- Pagination -->	
				
					<?php else: ?>
						<?php get_template_part('template-parts/content/content','none'); ?>
					<?php endif; ?>
				</div>
				<div class="col-lg-4">
					<?php  get_sidebar(); ?>
				</div>
			</div>
		</div>
	</section>	
<?php get_footer(); ?>