<?php
/**
 * Erapress About page class.
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

if ( ! class_exists( 'Erapress_Options' ) ) :
	/**
	 * Erapress Dashboard page class.
	 */
	final class Erapress_Options {
		
		/**
		 * Menu page title
		 *
		 * @since 1.0.45
		 * @var array $menu_page_title
		 */
		public static $menu_page_title = 'Erapress Theme';

		/**
		 * Page title
		 *
		 * @since 1.0.45
		 * @var array $page_title
		 */
		public static $page_title = 'Erapress';

		/**
		 * Plugin slug
		 *
		 * @since 1.0.45
		 * @var array $plugin_slug
		 */
		public static $plugin_slug = 'erapress';

		/**
		 * Default Menu position
		 *
		 * @since 1.0.45
		 * @var array $default_menu_position
		 */
		public static $default_menu_position = 'themes.php';

		/**
		 * Parent Page Slug
		 *
		 * @since 1.0.45
		 * @var array $parent_page_slug
		 */
		public static $parent_page_slug = 'general';

		/**
		 * Current Slug
		 *
		 * @since 1.0.45
		 * @var array $current_slug
		 */
		public static $current_slug = 'general';
		
		/**
		 * Singleton instance of the class.
		 *
		 * @since 1.0.0
		 * @var object
		 */
		private static $instance;

		/**
		 * Main Erapress Dashboard Instance.
		 *
		 * @since 1.0.0
		 * @return Erapress_Options
		 */
		public static function instance() {

			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Erapress_Options ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			/**
			 * Register admin menu item under Appearance menu item.
			 */
			add_action( 'admin_menu', array( $this, 'add_to_menu' ), 10 );
			add_filter( 'submenu_file', array( $this, 'highlight_submenu' ) );
			
			if ( ! is_admin() ) {
				return;
			}

			add_action( 'after_setup_theme', __CLASS__ . '::init_admin_settings', 99 );

			/**
			 * Ajax activate & deactivate plugins.
			 */
			add_action( 'wp_ajax_erapress-plugin-activate', array( $this, 'activate_plugin' ) );
			add_action( 'wp_ajax_erapress-plugin-deactivate', array( $this, 'deactivate_plugin' ) );
		}

		/**
		 * Register our custom admin menu item.
		 *
		 * @since 1.0.0
		 */
		public function add_to_menu() {

			/**
			 * Dashboard page.
			 */
			add_theme_page(
				esc_html__( 'Required Plugin', 'erapress' ),
				apply_filters( 'erapress_menu_main_page', __( 'Required Plugins', 'erapress' ) ),
				apply_filters( 'erapress_manage_cap', 'edit_theme_options' ),
				'erapress-dashboard',
				array( $this, 'render_plugins' )
			);

		}
		
		/**
		 * Admin settings init
		 */
		public static function init_admin_settings() {
			self::$menu_page_title = apply_filters( 'erapress_menu_page_title', __( 'Erapress Options', 'erapress' ) );
			self::$page_title      = apply_filters( 'erapress_page_title', __( 'Erapress', 'erapress' ) );
			self::$plugin_slug     = self::get_theme_page_slug();

			//add_action( 'admin_enqueue_scripts', __CLASS__ . '::register_scripts' );

			if ( isset( $_REQUEST['page'] ) && strpos( $_REQUEST['page'], self::$plugin_slug ) !== false ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended


				// Let extensions hook into saving.
				do_action( 'Erapress_Options_scripts' );

				if ( defined( 'ERAPRESS_PLUGIN_VERSION' )  ) {
					self::save_settings();
				}
			}


			add_action( 'admin_menu', __CLASS__ . '::add_admin_menu', 99 );

		}
		
		/**
		 * Save All admin settings here
		 */
		public static function save_settings() {

			// Only admins can save settings.
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			// Let extensions hook into saving.
			do_action( 'Erapress_Options_save' );
		}

		/**
		 * Theme options page Slug getter including White Label string.
		 *
		 * @since 1.0.45
		 * @return string Theme Options Page Slug.
		 */
		public static function get_theme_page_slug() {
			return apply_filters( 'erapress_theme_page_slug', self::$plugin_slug );
		}



		/**
		 * Get and return page URL
		 *
		 * @param string $menu_slug Menu name.
		 * @since 1.0.45
		 * @return  string page url
		 */
		public static function get_page_url( $menu_slug ) {

			$parent_page = self::$default_menu_position;

			if ( strpos( $parent_page, '?' ) !== false ) {
				$query_var = '&page=' . self::$plugin_slug;
			} else {
				$query_var = '?page=' . self::$plugin_slug;
			}

			$parent_page_url = admin_url( $parent_page . $query_var );

			$url = $parent_page_url . '&action=' . $menu_slug;

			return esc_url( $url );
		}

		/**
		 * Add main menu
		 *
		 * @since 1.0.45
		 */
		public static function add_admin_menu() {

			$parent_page    = self::$default_menu_position;
			$page_title     = self::$menu_page_title;
			$capability     = 'manage_options';
			$page_menu_slug = self::$plugin_slug;
			$page_menu_func = __CLASS__ . '::menu_callback';

			if ( apply_filters( 'erapress_dashboard_admin_menu', true ) ) {
				add_theme_page( $page_title, $page_title, $capability, $page_menu_slug, $page_menu_func );
				remove_submenu_page( 'themes.php', $page_menu_slug );
			} 
		}

		/**
		 * Menu callback
		 *
		 * @since 1.0.45
		 */
		public static function menu_callback() {

			$current_slug = isset( $_GET['action'] ) ? esc_attr( $_GET['action'] ) : self::$current_slug; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

			$active_tab   = str_replace( '_', '-', $current_slug );
			$current_slug = str_replace( '-', '_', $current_slug );

			$erapress_wrapper_class  = apply_filters( 'erapress_welcome_wrapper_class', array( $current_slug ) );

			?>
			<div class="erapress-menu-page-wrapper wrap erapress-clear <?php echo esc_attr( implode( ' ', $erapress_wrapper_class ) ); ?>">
					

				<?php do_action( 'erapress_menu_' . esc_attr( $current_slug ) . '_action' ); ?>
			</div>
			<?php
		}

		/**
		 * Render the recommended plugins page.
		 *
		 * @since 1.0.0
		 */
		public function render_plugins() {

			// Render dashboard navigation.
			$this->render_navigation();

			$plugins = erapress_plugin_utilities()->get_recommended_plugins();
			?>
			<div class="xl-websites">
				<div class="xl-page-content">
					<div class="xl-sites-panel">
						
						<div class="xl-container-no-area">
							<div class="xl-column-12">
								<div class="xl-columns-area">
									<?php if ( is_array( $plugins ) && ! empty( $plugins ) ) { ?>
									<?php foreach ( $plugins as $plugin ) { ?>

										<?php
										// Check plugin status.
										if ( erapress_plugin_utilities()->is_activated( $plugin['slug'] ) ) {
											$btn_class = 'xl-btn xl-btn-outline erapress-btn secondary';
											$btn_text  = esc_html__( 'Deactivate', 'erapress' );
											$action    = 'deactivate';
											$notice    = '<span class="erapress-active-plugin"><span class="dashicons dashicons-yes"></span>' . esc_html__( 'Plugin activated', 'erapress' ) . '</span>';
										} elseif ( erapress_plugin_utilities()->is_installed( $plugin['slug'] ) ) {
											$btn_class = 'xl-btn xl-btn-fill erapress-btn primary';
											$btn_text  = esc_html__( 'Activate', 'erapress' );
											$action    = 'activate';
											$notice    = '';
										} else {
											$btn_class = 'xl-btn xl-btn-fill erapress-btn primary';
											$btn_text  = esc_html__( 'Install & Activate', 'erapress' );
											$action    = 'install';
											$notice    = '';
										}
										?>

										<div class="xl-column-6 plugins">
											<div class="xl-post">
												<div class="plugin-info">
													<h4><i class="dashicons dashicons-admin-plugins"></i><?php echo esc_html( $plugin['name'] ); ?></h4>
													<div class="erapress-buttons">
														<?php echo ( wp_kses_post( $notice ) ); ?>
														<a href="#" class="<?php echo esc_attr( $btn_class ); ?>" data-plugin="<?php echo esc_attr( $plugin['slug'] ); ?>" data-action="<?php echo esc_attr( $action ); ?>"><?php echo esc_html( $btn_text ); ?></a>
														
														<?php 
															if ( erapress_plugin_utilities()->is_activated( $plugin['slug'] ) ) {
																echo wp_kses_post( $plugin['html'] );
															}
															?>
													</div>
												</div>
												<p><?php echo esc_html( $plugin['desc'] ); ?></p>
											</div>
										</div>
										
									<?php } ?>
								<?php } ?>
								</div>
							</div>                      
						</div>
					</div>
				</div>	
			</div>

			<?php
		}

		

		/**
		 * Render admin page navigation tabs.
		 *
		 * @since 1.0.0
		 */
		public function render_navigation() {

			// Get navigation items.
			$menu_items = $this->get_navigation_items();

			?>
			<div class="xl-page-wrapper">
				<div class="xl-tab-panel">
					<div class="xl-theme-body">
		                <div class="xl-tabs xl-tabs-normal">
		                	<ul>
								<?php
								// Determine current tab.
								$base = $this->get_current_page();

								// Display menu items.
								foreach ( $menu_items as $item ) {

									// Check if we're on a current item.
									$current = false !== strpos( $base, $item['id'] ) ? 'current-item' : '';
									?>
									<li class="<?php echo esc_attr( $current ); ?>">
										<a href="<?php echo esc_url( $item['url'] ); ?>" class="xl-tabs-link">
											<?php echo esc_html( $item['name'] ); ?>

											<?php
											if ( isset( $item['icon'] ) && $item['icon'] ) {
												erapress_print_admin_icon( $item['icon'] );
											}
											?>
										</a>
									</li>
								<?php } ?>
			                </ul>
		                </div>
		            </div>
				</div>

			</div><!-- END .xl-container -->
			<?php
		}

		/**
		 * Return the current Erapress Dashboard page.
		 *
		 * @since 1.0.0
		 * @return string $page Current dashboard page slug.
		 */
		public function get_current_page() {

			$page = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : 'dashboard'; // phpcs:ignore
			$page = str_replace( 'erapress-', '', $page );
			$page = apply_filters( 'erapress_dashboard_current_page', $page );

			return esc_html( $page );
		}

		/**
		 * Print admin page navigation items.
		 *
		 * @since 1.0.0
		 * @return array $items Array of navigation items.
		 */
		public function get_navigation_items() {

			$items = array(				
				'plugins'   => array(
					'id'   => 'plugins',
					'name' => esc_html__( 'Recommended Plugins', 'erapress' ),
					'icon' => '',
					'url'  => menu_page_url( 'erapress-plugins', false ),
				)
			);

			return apply_filters( 'erapress_dashboard_navigation_items', $items );
		}

		/**
		 * Activate plugin.
		 *
		 * @since 1.0.0
		 */
		public function activate_plugin() {

			// Security check.
			check_ajax_referer( 'erapress_nonce' );

			// Plugin data.
			$plugin = isset( $_POST['plugin'] ) ? sanitize_text_field( wp_unslash( $_POST['plugin'] ) ) : '';

			if ( empty( $plugin ) ) {
				wp_send_json_error( esc_html__( 'Missing plugin data', 'erapress' ) );
			}

			if ( $plugin ) {

				$response = erapress_plugin_utilities()->activate_plugin( $plugin );

				if ( is_wp_error( $response ) ) {
					wp_send_json_error( $response->get_error_message(), $response->get_error_code() );
				}

				wp_send_json_success();
			}

			wp_send_json_error( esc_html__( 'Failed to activate plugin. Missing plugin data.', 'erapress' ) );
		}

		/**
		 * Deactivate plugin.
		 *
		 * @since 1.0.0
		 */
		public function deactivate_plugin() {

			// Security check.
			check_ajax_referer( 'erapress_nonce' );

			// Plugin data.
			$plugin = isset( $_POST['plugin'] ) ? sanitize_text_field( wp_unslash( $_POST['plugin'] ) ) : '';

			if ( empty( $plugin ) ) {
				wp_send_json_error( esc_html__( 'Missing plugin data', 'erapress' ) );
			}

			if ( $plugin ) {
				$response = erapress_plugin_utilities()->deactivate_plugin( $plugin );

				if ( is_wp_error( $response ) ) {
					wp_send_json_error( $response->get_error_message(), $response->get_error_code() );
				}

				wp_send_json_success();
			}

			wp_send_json_error( esc_html__( 'Failed to deactivate plugin. Missing plugin data.', 'erapress' ) );
		}

		/**
		 * Highlight dashboard page for plugins page.
		 *
		 * @since 1.0.0
		 * @param string $submenu_file The submenu file.
		 */
		public function highlight_submenu( $submenu_file ) {

			global $pagenow;

			// Check if we're on erapress plugins or changelog page.
			if ( 'themes.php' === $pagenow ) {
				if ( isset( $_GET['page'] ) ) { // phpcs:ignore
					if ( 'erapress-plugins' === $_GET['page'] || 'erapress-changelog' === $_GET['page'] ) { // phpcs:ignore
						$submenu_file = 'erapress-dashboard';
					}
				}
			}

			return $submenu_file;
		}
	}
endif;

/**
 * The function which returns the one Erapress_Options instance.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $erapress_options = erapress_options(); ?>
 *
 * @since 1.0.0
 * @return object
 */
function erapress_options() {
	return Erapress_Options::instance();
}

erapress_options();
