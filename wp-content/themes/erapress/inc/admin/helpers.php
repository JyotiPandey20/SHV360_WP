<?php
/**
 * Contains various functions that may be potentially used throughout
 * the theme.
 *
 * @package     Erapress
 * @author      Erapress Software
 * @since       1.0.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check if we're on a Erapress admin page.
 *
 * @since 1.0.0
 * @param boolean|string $base current screen base.
 * @param string         $slug page slug.
 * @return boolean
 */
function erapress_admin_page( $base = false, $slug = 'erapress' ) {

	if ( false === $base ) {
		$base = get_current_screen()->base;
	}

	return false !== strpos( $base, $slug );
}

/**
 * Print admin notice.
 *
 * @since 1.0.0
 * @param array $args array of options.
 * @return boolean|void
 */
function erapress_print_notice( $args ) {

	$defaults = array(
		'type'           => 'success',
		'message'        => '',
		'is_dismissible' => true,
		'message_id'     => '',
		'expires'        => 0,
		'display_on'     => array(),
		'action_link'    => '',
		'action_text'    => '',
		'dismiss_text'   => esc_html__( 'Dismiss', 'erapress' ),
	);

	$args = wp_parse_args( $args, $defaults );

	if ( erapress_is_notice_dismissed( $args['message_id'] ) ) {
		return false;
	}

	if ( ! empty( $args['display_on'] ) ) {

		$base    = get_current_screen()->base;
		$display = false;

		foreach ( $args['display_on'] as $page ) {
			if ( false !== strpos( $base, $page ) ) {
				$display = true;
			}
		}

		if ( ! $display ) {
			return false;
		}
	}

	$erapress_is_dismissible = $args['is_dismissible'] ? ' is-dismissible' : ''; ?>

	<div id="<?php echo esc_attr( $args['message_id'] ); ?>" class="notice erapress-notice notice-<?php echo esc_attr( $args['type'] ); ?> <?php echo esc_attr( $erapress_is_dismissible ); ?>">
		<div class="xl-notice-container">
			<img class="erapress-screenshot" src="<?php echo esc_url(ERAPRESS_PARENT_URI.'/screenshot.jpg' )?>" alt="<?php esc_attr_e( 'Erapress', 'erapress' ); ?>" />
			
			<div class="xl-notice-content">
				<h2><?php echo ( wp_kses_post( $args['message'] ) ); ?></h2>
				<?php
				if ( $args['action_link'] && $args['action_text'] ) {
					?>
					<p class="erapress-notice-action erapress-buttons plugins">
					<?php
						
						$class       = ' active button button-primary button-hero';
						$button_text = __( 'Start Demo Import', 'erapress' );
						$link        = admin_url( 'admin.php?page=one-click-demo-import' );
						$data        = '';

						printf(
							'<a class="%1$s" %2$s %3$s role="button"> %4$s </a>',
							esc_attr( $class ),
							isset( $link ) ? 'href="' . esc_url( $link ) . '"' : '',
							$data, // phpcs:ignore
							esc_html( $button_text )
						);
						?>

						<?php
						if ( $args['dismiss_text'] ) {
							?>
							<a href="#" class="xl-btn xl-btn-outline erapress-btn secondary button button-secondary erapress-notice-dismiss button-hero" role="button"><?php echo esc_html( $args['dismiss_text'] ); ?></a>
							<?php
						}
						?>
					</p><!-- END .erapress-notice-action -->
					<?php
				}
				?>
			</div>	
		</div>
	</div>	

	<script type="text/javascript">
		jQuery( document ).ready( function ( $ ) {

			var msgid = "<?php echo esc_attr( $args['message_id'] ); ?>";
			var $el   = $( '#' + msgid );

			$el.on( 'click', '.notice-dismiss, .erapress-notice-dismiss', function ( event ) {

				var expires = "<?php echo esc_attr( $args['expires'] ); ?>";
				var nonce = "<?php echo esc_attr( wp_create_nonce( 'erapress_dismiss_notice' ) ); ?>";

				$.post( ajaxurl, {
					action: 		'erapress_dismiss_notice',
					msgid: 			msgid,
					expires: 		expires,
					_ajax_nonce: 	nonce,
				} );

				$el.fadeTo( 100, 0, function() {
					$el.slideUp( 100, function() {
						$el.remove();
					});
				});
			} );
		} );
	</script>
	<?php
}

/**
 * Check if admin notice is dismissed.
 *
 * @since 1.0.0
 * @param array $id Notice ID.
 * @return boolean
 */
function erapress_is_notice_dismissed( $id ) {

	if ( false !== get_transient( 'erapress_notice_' . $id ) ) {
		return true;
	}

	return false;
}

/**
 * Ajax handler to dismiss admin notice.
 *
 * @since 1.0.0
 * @return void
 */
function erapress_dismiss_notice() {

	check_ajax_referer( 'erapress_dismiss_notice' );

	if ( ! isset( $_POST['msgid'] ) ) {
		die;
	}

	$message_id = sanitize_text_field( wp_unslash( $_POST['msgid'] ) );
	$expires    = isset( $post['expires'] ) ? intval( $post['expires'] ) : 0;

	$message              = (array) get_transient( 'erapress_notice_' . $message_id );
	$message['time']      = time();
	$message['dismissed'] = true;

	set_transient( 'erapress_notice_' . $message_id, $message, $expires );
	die;
}
add_action( 'wp_ajax_erapress_dismiss_notice', 'erapress_dismiss_notice' );