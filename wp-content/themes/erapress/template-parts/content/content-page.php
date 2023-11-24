<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package EraPress
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-items wow fadeInUp'); ?>>
		<figure class="post-image">
			<a href="#" class="post-hover">
				<?php the_post_thumbnail('erapress-large-image');?>
			</a>
		</figure>

		<div class="post-meta imu">
			<div class="post-list">
				<ul class="post-categories">
					<li>
						<?php the_category(' '); ?>
					</li>
				</ul>
			</div>
		</div>

		<div class="post-content">
			<div class="post-meta up">
				<span class="posted-on"><i class="fa fa-calendar"></i>
					<a href="#"><?php echo esc_html(get_the_date());?></a>
				</span>
			</div>
			<?php     
				if ( is_single() ) :				
				the_title('<h5 class="post-title">', '</h5>' );				
				else:				
				the_title( sprintf( '<h5 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );				
				endif; 
			?> 
			<a href="<?php echo esc_url(get_permalink()); ?>" class="more-link"><?php echo esc_html__('Read More','erapress'); ?></a>
			<div class="post-meta down">
				<span class="author-name">								
					<img src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ) ); ?>" alt="<?php echo esc_attr__('image','erapress') ?>">
					<span>
						<?php echo esc_html__('post by','erapress'); ?>
					</span> 
					<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"> <?php esc_html(the_author()); ?></a>
				</span>
				<span class="comments-link">
					<a href="<?php echo esc_url(get_comments_link( $post->ID )); ?>"><i class="fa fa-comment"></i> <?php echo esc_html(get_comments_number($post->ID)); ?> <?php esc_html_e('Comments','erapress'); ?></a>
				</span>

			</div>
		</div>
	</article>