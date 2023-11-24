<?php
/**
Template Name: Fullwidth Page
**/

get_header();
erapress_breadcrumbs_style();
?>
<section class="post-section ">
	<div class="container">
		<div class="row wow fadeInUp">
			<div class="col-lg-12  wow fadeInUp">
				<?php 		
					the_post(); the_content(); 
					
					if( $post->comment_status == 'open' ) { 
						 comments_template( '', true ); // show comments 
					}
				?>
			</div>
		</div>
	</div>
</section> 
<?php get_footer(); ?>