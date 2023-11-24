<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'Shv360_WP' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '8v|1*d?IM+R#kR%7<l58E8uPbF|E`23IlEvbxFUK~SsRXgaC;!Kn^-QlXgL1<}Ku' );
define( 'SECURE_AUTH_KEY',  '3%UX~gkp`e%F?HBCzj&>{AaE6a`ZtkD,d6&OYRys5e-H@* U%Nb0$Cx&rP*Hsr8B' );
define( 'LOGGED_IN_KEY',    '-iIrkH5eO%=SDA:.OSAKy0qg3TwMF4-P(c!uoZNr!b#u,9o6X4Z>FQzeRIJF3kc*' );
define( 'NONCE_KEY',        'dp1m.n~pn6dM>=v/XAuBlO7b/&&U =_6pfPJL%2P|{(^kc_,oHq@hG WU~c3<B3F' );
define( 'AUTH_SALT',        'FpTs+l}>&9Z<oQAke(w76PB3./Xj<w[#>T1_R,[hF32Gt+!7fM:j~r?z;W98[G$s' );
define( 'SECURE_AUTH_SALT', '8+kOc<m@h&2O,dr9w;HAfllI_ZIr@^WjoJ X?<069U~}k4126&3D ?k]FWHmzttW' );
define( 'LOGGED_IN_SALT',   'O4m(-CWu.rz1}8vmC-;:`++Sg1]Xj/K|czOO>[:pg1*FVmg:64(Ja<]q$m_{<WJ5' );
define( 'NONCE_SALT',       'Q)L^o_mrM8j2`?m(lPCcYj=:/Gg|c0PZn|eD(`|.FIx]w=_*i*Oi]QapD5EY<8(u' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
