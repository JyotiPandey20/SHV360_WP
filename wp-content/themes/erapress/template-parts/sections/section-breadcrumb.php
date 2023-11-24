<?php 
	$hs_breadcrumb					= get_theme_mod('hs_breadcrumb','1');
	$breadcrumb_title_enable		= get_theme_mod('breadcrumb_title_enable','1');
	$breadcrumb_path_enable			= get_theme_mod('breadcrumb_path_enable','1');
	$breadcrumb_bg_img2				= get_theme_mod('breadcrumb_bg_img2',get_template_directory_uri().'/assets/images/Slide_img1.png');
	
if($hs_breadcrumb == '1') {	
?>
<!--===// Start: Breadcrumb
    =================================-->
    <section id="breadcrumb-section" class="breadcrumb-area breadcrumb-center" style="background: url('<?php echo esc_url($breadcrumb_bg_img2);?>'); background-size:cover; no-repeat; background-position: center -280px;">
        <div class="container">

            <div class="breadcrumb-content">
                <img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/slider.png');?>" alt="">
                <div class="breadcrumb-content-inner">
                    <div class="breadcrumb-heading">
                        <?php if($breadcrumb_title_enable == '1') { ?>
								<h1>
									<?php 
										if ( is_home() || is_front_page()):
			
											single_post_title();
											
										elseif ( is_day() ) : 
										
											printf( __( 'Daily Archives: %s', 'erapress' ), get_the_date() );
										
										elseif ( is_month() ) :
										
											printf( __( 'Monthly Archives: %s', 'erapress' ), (get_the_date( 'F Y' ) ));
											
										elseif ( is_year() ) :
										
											printf( __( 'Yearly Archives: %s', 'erapress' ), (get_the_date( 'Y' ) ) );
											
										elseif ( is_category() ) :
										
											printf( __( 'Category Archives: %s', 'erapress' ), (single_cat_title( '', false ) ));

										elseif ( is_tag() ) :
										
											printf( __( 'Tag Archives: %s', 'erapress' ), (single_tag_title( '', false ) ));
											
										elseif ( is_404() ) :

											printf( __( 'Error 404', 'erapress' ));
											
										elseif ( is_author() ) :
										
											printf( __( 'Author: %s', 'erapress' ), (get_the_author( '', false ) ));		
										
										elseif ( is_tax( 'portfolio_categories' ) ) :

											printf( __( 'Portfolio Categories: %s', 'erapress' ), (single_term_title( '', false ) ));	
											
										elseif ( is_tax( 'pricing_categories' ) ) :

											printf( __( 'Pricing Categories: %s', 'erapress' ), (single_term_title( '', false ) ));	
											
										elseif ( class_exists( 'woocommerce' ) ) : 
											
											if ( is_shop() ) {
												woocommerce_page_title();
											}
											
											elseif ( is_cart() ) {
												the_title();
											}
											
											elseif ( is_checkout() ) {
												the_title();
											}
											
											else {
												the_title();
											}
										else :
												the_title();
												
										endif;
										
									?>
								</h1>
							<?php } ?>	
                    </div>
					<?php if($breadcrumb_path_enable == '1') { ?>
							 <ul class="breadcrumb-list">
								<?php if (function_exists('erapress_breadcrumbs')) erapress_breadcrumbs();?>
							</ul>
						<?php } ?>		
                </div>

            </div>
        </div>
    </section>
    <!-- End: Breadcrumb
    =================================-->








 
<?php } ?>	