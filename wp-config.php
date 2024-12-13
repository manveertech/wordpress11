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
define( 'DB_NAME', 'workgroundfive' );

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
define( 'AUTH_KEY',         'qIy{N1=$_ C^d^$SI 5%#;>iQ5C5<~<WN6j*?SUIO&4*Sk`@&<ts^5P9 [;exO4 ' );
define( 'SECURE_AUTH_KEY',  'Mk>`onL#4~ZUJJwq6drAW-(Xbpi(,.DPlJxG)bZ;&pJbu`>Q%~R:~>@El}jjQmda' );
define( 'LOGGED_IN_KEY',    'A#^bq &fV2}>VAvf(pSrLWC$Bs[JItJDK~<ihD4t]|R}:r40)L52C>&(b]4Oz78O' );
define( 'NONCE_KEY',        '2A&|&hz +xP:z,,ck8dNYmrxH}DPA:2O`4IHl*xq/IZ/+Bk9JT2Qrf{xySs]x5J.' );
define( 'AUTH_SALT',        'bbZZ}>Ns0FKcM3Era%u!rdOfYymcL?VCT= @*{a=8)7R4q_/B#7*edM7N3BR4pf1' );
define( 'SECURE_AUTH_SALT', 'Wk{~;pQl3A.0ixX?wdiy|7@g0kwuH8PNU%4@M| ^~fPZ ;R1,R(]lTt*B@&fz+.b' );
define( 'LOGGED_IN_SALT',   '~Ft~D8tP3:_.iw#I0[l!j4<Dt+W;UZ$:UAJS4yPz3A_7>qKM:KTFww!X 5l9_vh?' );
define( 'NONCE_SALT',       'u}DG:`JD[kx`Fj3^i4P$cn~7`0Fti:j111^`RJN(CEjC_+W)ZRJLAG_gpOoA-7ea' );

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
