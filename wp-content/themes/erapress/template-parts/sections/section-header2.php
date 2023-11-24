 <!--===// Start: Preloader
    =================================-->
	<?php  
		$hs_preloader 				= get_theme_mod( 'hs_preloader'); 
		$hide_show_social_icon 		= get_theme_mod( 'hide_show_social_icon','1');
		$hide_show_search 			= get_theme_mod( 'hide_show_search','1');
		$hide_show_cart 			= get_theme_mod( 'hide_show_cart','1');
		$hide_show_toggle 			= get_theme_mod( 'hide_show_toggle','1');
		$hide_show_toggle 			= get_theme_mod( 'hide_show_toggle','1');
		$hide_show_mbl_details 		= get_theme_mod( 'hide_show_mbl_details','1'); 
		$hide_show_email_details 	= get_theme_mod( 'hide_show_email_details','1'); 
		$hide_show_cntct_details 	= get_theme_mod( 'hide_show_cntct_details','1');
		$tlh_mobile_title 			= get_theme_mod( 'tlh_mobile_title',__('California, USA 1208','erapress'));
		$tlh_email_title 			= get_theme_mod( 'tlh_email_title',__('Call Us','erapress'));
		$tlh_contact_title 			= get_theme_mod( 'tlh_contact_title',__('Mon-Fri','erapress'));
		$nav_btn_lbl 				= get_theme_mod( 'nav_btn_lbl',__('Lets Talk','erapress'));
		
		// Instantiate the Erapress_Plugin_Utilities class
		$plugin_utilities = Erapress_Plugin_Utilities::instance();
		
		// Define the plugin slug you want to check
		$plugin_slug_to_check = 'xolo-addon';  

		// Check if the plugin is activated
		$is_plugin_activated = $plugin_utilities->is_activated($plugin_slug_to_check);
		
		$title_site = get_bloginfo('name');
		if($hs_preloader == '1' && !empty($title_site) ) { 
		$str = $title_site;
		$str1 = str_split($str);
	?>
	<div class="prealoader">
        <section class="nav">
            <h2 class="span loader">
			<?php 
			foreach($str1 as $str2): ?>
                <span class="m"><?php echo esc_html($str2);?></span>
            <?php endforeach; ?>
            </h2>
        </section>
    </div>
	<?php } ?>		
    <!-- End: Preloader
    =================================-->
	<header class="header header-2">
        <div class="top-header top-header-2">
            <div class="container text-center">
                <div class=" header-menu header-menu-2">
                    <div class="widget-left">
                        <aside class="widget widget-contact heads">
                            <?php if(!empty($tlh_mobile_title) && $hide_show_mbl_details == '1') { ?>
                                <div class="contact-area">
                                    <div class="contact-icon">
                                        <i class="fa <?php echo esc_attr(get_theme_mod('tlh_mobile_icon','fa-map-marker'));?>"></i>
                                    </div>
                                    <div class="contact-info">
                                        <p class="text"><a href="#" class="tlh_mobile_title"><?php echo esc_html($tlh_mobile_title);?></a></p>
                                    </div>
                                </div>
							<?php } ?>
							
							<?php if(!empty($tlh_email_title) && $hide_show_email_details == '1' ){ ?>
                            <div class="contact-area">
                                <div class="contact-icon">
                                   <i class="fa <?php echo esc_attr(get_theme_mod('tlh_email_icon','fa-phone'));?>"></i>
                                </div>
                                <div class="contact-info">
                                    <p class="text"><a href="#" class="tlh_email_title"><?php echo esc_html($tlh_email_title);?></a></p>
                                </div>
                            </div>
							<?php } ?>
							
							<?php if(!empty($tlh_contact_title) && $hide_show_cntct_details == '1'){ ?>
                            <div class="contact-area">
                                <div class="contact-icon">
                                     <i class="fa <?php echo esc_attr(get_theme_mod('tlh_contct_icon','fa-clock-o'));?>"></i>
                                </div>
                                <div class="contact-info">
                                   <p class="text"><a href="#" class="tlh_contact_title"><?php echo esc_html($tlh_contact_title);?> <?php echo esc_html(get_theme_mod('tlh_contact_sbtitle','8:00AM-6:00PM'));?></a></p>
                                </div>
                            </div>
							<?php } ?>
                        </aside>
                    </div>
                    <div class="widget-right">
                        <?php
							if($hide_show_social_icon =='1'){ 
								do_action('erapress_abv_hdr_social');
							} 
						?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Navigation Section ===============================================================-->

        <div class="top-navigation <?php echo esc_attr(erapress_sticky_menu()); ?> top-navigation-2 ">
            <div class="container ">
                <div class="row navigation-bar navigation-bar-2 ">
                    <div class="col-lg-2 col-sm-2 ">
                        <div class=" logo logo-2 ">
                            <?php
							if(has_custom_logo())
							{	
								the_custom_logo();
							}
							 ?>
							 
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link">
								<h4 class="site-title">
									<?php 
										echo esc_html(bloginfo('name'));
									?>
								</h4>
							</a>
							
						<?php $description = get_bloginfo( 'description'); ?>
							<p class="site-description"><?php echo esc_html($description); ?></p>
                        </div>
                    </div>
                    <div class="col-lg col-sm-8 ">
                        <div class="navbar navbar-2">
                             <?php 
								wp_nav_menu( 
									array(  
										'theme_location' => 'primary_menu',
										'container'  => '',
										'menu_class' => 'navbar-menu navbar-menu-2',
										'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
										'walker' => new WP_Bootstrap_Navwalker()
										 ) 
									);
							?> 
                        </div>
                    </div>
                    <div class="col-lg-auto col-md-2">
                        <div class="icons-box menu-right">
                            <ul class="icon-list wrap-right">
                                <?php if ( class_exists( 'WooCommerce' ) && $hide_show_cart=='1') { ?>
									<li class="cart-wrapper">
										<a href="javascript:void(0)" class="cart-icon-wrap" id="cart" title="View your shopping cart">                                     
											<i class="fa fa-cart-arrow-down"></i>
											<?php 
											if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
												$count = WC()->cart->cart_contents_count;
												$cart_url = wc_get_cart_url();
												
												if ( $count > 0 ) {
												?>
													 <span class="cart-count"><?php echo esc_html( $count ); ?></span>
												<?php 
												}
												else {
													?>
													<span class="cart-count">0</span>
													<?php 
												}
											}
											?>
										</a>
										<!-- Shopping Cart Start -->
										<div class="shopping-cart">
											<?php get_template_part('woocommerce/cart/mini','cart'); ?>
										</div>
										<!-- Shopping Cart End -->
									</li>
								<?php }  ?>
								
								<?php if($hide_show_search=='1'){ ?>
									<li class="list-item">
										<a href="#" class="header-search-toggle" id="view-search-btn"><i
												class="fa fa-search"></i></a>
									</li>
								<?php }  ?>
								
								<?php if($hide_show_toggle=='1' && $is_plugin_activated){ ?>
									<li class="list-item th-box">
										<a href="#" class="th"><i class="fa fa-th"></i></a>
										<div class="overlay"></div>
									</li>
								<?php }  ?>
								
								<?php if(!empty($nav_btn_lbl) && $is_plugin_activated ){ ?>
									<li class="list-item ">
									   <a href="<?php echo esc_url(get_theme_mod('nav_btn_link','#')); ?>"> <button class=" btn active hover-btn border " style="padding:10px 0px;width:150px"><?php echo esc_html($nav_btn_lbl); ?></button></a>
									</li>
								<?php } ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Sidebar -->
	<?php if($is_plugin_activated): ?>
        <div id="mySidenav" class="sidenav">
            <div class="logo">
                <?php
					if(has_custom_logo())
					{	
						the_custom_logo();
					}
					else { 
					?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link">
						<h4 class="site-title">
							<?php 
								echo esc_html(bloginfo('name'));
							?>
						</h4>
					</a>	
				<?php 						
					}
				?>
				<?php
					$description = get_bloginfo( 'description');
					if ($description) : ?>
						<p class="site-description d-none"><?php echo esc_html($description); ?></p>
				<?php endif; ?>
                <a href="javascript:void(0) " class="closebtn"><span>&times;</span></a>
            </div>

            <aside class="widget custom-widget">
                <h3 class="widget-title"><?php echo esc_html(get_theme_mod('sidebar_title','About'));?></h3>
                <p>
                     <?php echo esc_html(get_theme_mod('sidebar_desc','
                    The argument in favor of using filler text goes something like this: If you use arey real content in the Consulting Process anytime you reachtent.
                '));?>
                </p>
            </aside>
            <aside id="media_gallery-2" class="widget widget_media_gallery">
                <h5 class="widget-title"><?php echo esc_html(get_theme_mod('instagram_title','Gallery'));?></h5>
                <div id="gallery-2" class="gallery galleryid-903 gallery-columns-3 gallery-size-thumbnail">
                     <?php 
				$gallery = get_theme_mod('instagram_gallery',erapress_get_gallery_default());
				
				if ( ! empty( $gallery ) ) {
				$gallery = json_decode( $gallery );
				foreach ( $gallery as $gallery_item ) {
					$image = ! empty( $gallery_item->image_url ) ? apply_filters( 'erapress_translate_single_string', $gallery_item->image_url, 'Gallery section' ) : '';
					?>
                    <figure class="gallery-item">
                        <div class="gallery-icon landscape overlay_media-gallery">
                            <a href="# "><img src="<?php echo esc_url($image);?> " class="attachment-thumbnail size-thumbnail" alt="dsc20050831_165238_332 " loading="lazy"></a>
                        </div>
                    </figure>
				<?php } }?>
                </div>
            </aside>
            <aside class="widget widget-contact">
                <h4 class="widget-title ">Contact Us </h4>
                <?php if(!empty($tlh_mobile_title) && $hide_show_mbl_details == '1') { ?>
					<div class="contact-area">
						<div class="contact-icon">
							<i class="fa <?php echo esc_attr(get_theme_mod('tlh_mobile_icon','fa-map-marker'));?>"></i>
						</div>
						<div class="contact-info">
							<p class="text"><a href="#" class="tlh_mobile_title"><?php echo esc_html($tlh_mobile_title);?></a></p>
						</div>
					</div>
				<?php } ?>
				
				<?php if(!empty($tlh_email_title)  && $hide_show_email_details == '1' ){ ?>
                <div class="contact-area">
                    <div class="contact-icon">
                        <i class="fa <?php echo esc_attr(get_theme_mod('tlh_email_icon','fa-phone'));?>"></i>
                    </div>
                    <div class="contact-info">
                        <p class="text"><a href="#" class="tlh_email_title"><?php echo esc_html($tlh_email_title);?></a></p>
                    </div>
                </div>
				<?php } ?>
				
				<?php if(!empty($tlh_contact_title) && $hide_show_cntct_details == '1'){ ?>
                <div class="contact-area">
                    <div class="contact-icon">
                        <i class="fa <?php echo esc_attr(get_theme_mod('tlh_contct_icon','fa-clock-o'));?>"></i>
                    </div>
                    <div class="contact-info">
                         <p class="text"><a href="#" class="tlh_contact_title"><?php echo esc_html($tlh_contact_title);?></a></p>
                    </div>
                </div>
				<?php } ?>
            </aside>
			<?php
				if($hide_show_social_icon =='1'){ 
					do_action('erapress_abv_hdr_social');
				} 
			?>
        </div>
		<?php endif; ?>
       <?php if($hide_show_search=='1'){ ?>
			<!-- Search Bar -->
			<div class="view-search-btn header-search-popup ">
				<form method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?> " aria-label="<?php esc_attr_e('Site Search','erapress'); ?>">
					<input type="search" class="form-control header-search-field" placeholder="<?php esc_attr_e('Type To Search','erapress'); ?>" name="s" id="search">
					<i class="fa fa-search "></i>
					<a href="javascript:void(0) " class="close-style header-search-close "></a>
				</form>
			</div>
		<?php } ?>
        <!-- Header Section end ===============================================================-->
        <!-- Mobile Naviagtion  ===============================================================-->
        <section class="mobile-navigation-menu <?php echo esc_attr(erapress_sticky_menu()); ?>">
            <nav>
                <div class="logo">
                    <?php
					if(has_custom_logo())
					{	
						the_custom_logo();
					}
					 ?>
					 
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link">
						<h4 class="site-title">
							<?php 
								echo esc_html(bloginfo('name'));
							?>
						</h4>
					</a>
					
				<?php $description = get_bloginfo( 'description'); ?>
					<p class="site-description"><?php echo esc_html($description); ?></p>
                </div>
                <div class="hamburger-menu">
                    <button type="button" class="menu-toggle">
                        <span class="top-bun"></span>
                        <span class="meat"></span>
                        <span class="bottom-bun"></span>
                    </button>
                </div>
                <div class="menu-bar">
				<button type="button" class="header-close-menu close-style" aria-label="Header Close Menu"></button>
                    <?php 
						wp_nav_menu( 
							array(  
								'theme_location' => 'primary_menu',
								'container'  => '',
								'menu_class' => 'mob-menu',
								'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
								'walker' => new WP_Bootstrap_Navwalker()
								 ) 
							);
					?> 
                </div>
            </nav>
            <div class="headtop-mobi">
                <a href="javascript:void(0)" class="header-sidebar-toggle active"><span><i
                            class="fa fa-ellipsis-v"></i></span></a>
            </div>
            <div id="mob-h-top" class="mobi-head-top active">
                <div class="header-widget">
                    <div class="container">
                        <div class="col-area row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <?php 
									if($hide_show_social_icon =='1'){ ?>
										<div class="widget-left text-av-left ">
											<?php do_action('erapress_abv_hdr_social'); ?>
										</div>
								<?php } ?>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="widget-right text-av-right text-center">
                                  <?php if(!empty($tlh_mobile_title) && $hide_show_mbl_details == '1') { ?>
									<div class="contact-widget">
										<aside class="widget widget-contact">
												<div class="contact-area">
													<div class="contact-icon">
														<i class="fa <?php echo esc_attr(get_theme_mod('tlh_mobile_icon','fa-map-marker'));?>"></i>
													</div>
													<div class="contact-info">
														<p class="text"><a href="#" class="tlh_mobile_title"><?php echo esc_html($tlh_mobile_title);?></a></p>
													</div>
												</div>
										</aside>
									</div>
									<?php } ?>
									
									<?php if(!empty($tlh_email_title)  && $hide_show_email_details == '1' ){ ?>
                                    <div class="contact-widget">
                                        <aside class="widget widget-contact">
                                            <div class="contact-area">
                                                <div class="contact-icon">
                                                    <div class="fa <?php echo esc_attr(get_theme_mod('tlh_email_icon','fa-phone'));?>"></div>
                                                </div>
                                                <a href="#" class="contact-info">
                                                     <span class="tlh_email_title"><?php echo esc_html($tlh_email_title);?></span>
                                                </a>
                                            </div>
                                        </aside>
                                    </div>
									<?php } ?>
									
									<?php if(!empty($tlh_contact_title) && $hide_show_cntct_details == '1'){ ?>
                                    <div class="contact-widget">
                                        <aside class="widget widget-contact">
                                            <div class="contact-area">
                                                <div class="contact-icon">
                                                    <div class="fa <?php echo esc_attr(get_theme_mod('tlh_contct_icon','fa-clock-o'));?>"></div>
                                                </div>
                                                <a href="#" class="contact-info">
                                                     <span class="tlh_contact_title"><?php echo esc_html($tlh_contact_title);?> <?php echo esc_html(get_theme_mod('tlh_contact_sbtitle','8:00AM-6:00PM'));?></span>
                                                </a>
                                            </div>
                                        </aside>
                                    </div>
									<?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="area">
                    <ul class="circles">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
            </div>
        </section>
    </header>    <!-- Mobile Naviagtion end ===============================================================-->