<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package EraPress
 */

get_header();
erapress_breadcrumbs_style();  
?>

    <!-- =============================== Blog Section Content ==================== -->
    <section class="blog-left-section single">
        <div class="container">
            <div class="row">
			<?php if( have_posts() ): ?>
					<?php while( have_posts() ): the_post(); ?>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <article id="post-<?php the_ID(); ?>" <?php post_class('post-items wow fadeInUp'); ?>>
                                <h2 class="d-none">-</h2>
                                <figure class="post-image">
                                    <a href="# " class="post-hover">
                                        <?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
                                    </a>
                                </figure>

                                <div class="post-meta imu">
                                    <div class="post-list">
                                        <ul class="post-categories">
                                           <li><?php the_category(' '); ?></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="post-content">
                                    <div class="post-meta down">
                                        <span class="author-name">
                                            <img src="assets/images/blog/a1.png" alt=""><span><?php echo esc_html__('post by','erapress'); ?></span> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php esc_html(the_author()); ?></a>
                                        </span>
                                        <span class="posted-on"><i class="fa fa-calendar"></i>
                                            <a href="<?php echo esc_url(the_date('Y/m/d')); ?>"><?php echo esc_html(get_the_date('M j Y')); ?></a>
                                        </span>
                                        <span class="comments-link">
                                            <i class="fa fa-comment"></i> <a href="<?php echo esc_url(get_comments_link( $post->ID )); ?>"><?php echo esc_html(get_comments_number($post->ID)); ?> <?php esc_html_e('Comments','erapress'); ?></a>
											
                                        </span>

                                    </div>
                                </div>
                            </article>
                            <div class="post-contents">
                                <h5 class="post-title"><?php the_title();?>
                                </h5>
                                <p><?php the_content();?> </p>
                                
								<?php if(has_tag()){ ?>
									<aside class="widget widget_tag_cloud sinlge-page-tag">
										<h5 class="widget-title"><?php echo esc_html__('Tag Cloud:','erapress'); ?></h5>
										<div class="tagcloud">
										   <?php the_tags();?>
											
										</div>
									</aside>
								<?php } ?>
									
								<?php if(!empty($user)){ ?>
									<div class="share-icon">
										<aside class="widget widget-social-widget">
											<h5 class="widget-title"><?php echo esc_html__('Share:','erapress'); ?></h5>
											<ul class="social-items">
												<?php
													$user = new WP_User( get_current_user_id() );
												?>
												<?php $instagram_profile = $user->instagram_profile;
													if ( $instagram_profile && $instagram_profile != '' ): ?>
														<li><a href="<?php echo esc_url($instagram_profile); ?>" class="social-icon"><i class="fa fa-instagram"></i></a></li>
													<?php endif; ?>
													
													
													<?php $facebook_profile = $user->facebook_profile;
														if ( $facebook_profile && $facebook_profile != '' ): ?>
														<li><a href="<?php echo esc_url($facebook_profile); ?>" class="social-icon"><i class="fa fa-facebook"></i></a></li>
													<?php endif; ?>
														
													<?php $pinterest_profile = $user->pinterest_profile;
													if ( $pinterest_profile && $pinterest_profile != '' ): ?>
														<li><a href="<?php echo esc_url($pinterest_profile); ?>" class="social-icon"><i class="fa fa-pinterest"></i></a></li>
													<?php endif; ?>
														
													<?php $twitter_profile = $user->twitter_profile;
													if ( $twitter_profile && $twitter_profile != '' ): ?>
														<li><a href="<?php echo esc_url($twitter_profile); ?>" class="social-icon"><i class="fa fa-twitter"></i></a></li>
													<?php endif; ?>
													
													<?php $linkedin_profile = $user->linkedin_profile;
													if ( $linkedin_profile && $linkedin_profile != '' ): ?>
														<li><a href="<?php echo esc_url($linkedin_profile); ?>" class="social-icon"><i class="fa fa-linkedin"></i></a></li>
													<?php endif; ?>
													
													<?php $skype_profile = $user->skype_profile;
													if ( $skype_profile && $skype_profile != '' ): ?>
														<li><a href="<?php echo esc_url($skype_profile); ?>" class="social-icon"><i class="fa fa-skype"></i></a></li>
													<?php endif; ?>								
											</ul>
										</aside>
									
                                </div>
								<?php } ?>
                               <?php comments_template( '', true ); // show comments  ?>
                            </div>
                        </div>
                    </div>
                </div>
				<?php endwhile; ?>
				<?php endif; ?>
                <div class="col-lg-4">
                    <div id="secondary-content">
                        <div class="sidebar">                            
                            <?php dynamic_sidebar('erapress-sidebar-primary'); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
    <!-- =============================== Blog Section Content ==================== -->

 
<?php get_footer(); ?>
