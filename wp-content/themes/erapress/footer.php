<!-- =================================
	Cursor Follow  
==============================-->

<div class="cursor-follow"></div>

<!-- =================================
	End 
==============================-->
<?php $hide_show_social_icon 		= get_theme_mod( 'hide_show_footer_social_icon','1'); ?>

<footer class="footer-section main-footer footer-section-1 wow fadeInUp">
	<h2 class="d-none">-</h2>
	<div class="container text-center">
		<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
		<div class="row footer">
			<?php dynamic_sidebar( 'footer-1'); ?>		
		</div>
		<?php endif; ?>
		<div class="row footer-bottom <?php if($hide_show_social_icon !='1') echo 'justify-content-center'; ?>">
			<div class="col-md-6">
				<div class="widget-center text-center">
					<div class="copyright-text">
						<?php if ( function_exists( 'erapress_footer_group_first' ) ) : erapress_footer_group_first(); endif; ?>
					</div>
				</div>
			</div>
			
			<?php 
				
				if($hide_show_social_icon =='1'){ ?>
                <div class="col-md-6">
					<?php	do_action('erapress_footer_social'); 
					}?>
			</div>
		</div>
		
	</div>
	
</footer>





<!-- ScrollUp -->
<?php 
	$hs_scroller 	= get_theme_mod('hs_scroller','1');	
	$scroller_icon 	= get_theme_mod('scroller_icon','fa-arrow-up');	
	if($hs_scroller == '1') :
?>

<a href="javascript: " class="scrollup" id="return-to-top" style=""><i class="fa <?php echo esc_attr($scroller_icon);?>"></i></a>
<?php endif; ?>	
<!-- / -->  
</div>
<?php wp_footer(); ?>
</body>
</html>
