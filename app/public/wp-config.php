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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '-+[{32FOQR@eT^~.j/B}!A[p~/NjzW7/8N!L$^5()aK<Kg`em/D-?0^|)ltYa#@N' );
define( 'SECURE_AUTH_KEY',   'KzLDetC8RKqTh,9W#{So jgEr6=VWnKPN8R+<010H:]BcQ(=_ICdiofhp~<N^;~#' );
define( 'LOGGED_IN_KEY',     '-r-+cwD3+Y_scPrs[9[m7Y:3Xt<3-[ek<c5I /)v,NG+m<(E&5[gqgC>:eL1p;Qg' );
define( 'NONCE_KEY',         '*pyH>$x]wmU$x~%Z.OK1KCh?O{r|Ono@Q&DyW78j=qf>j9~`}.8CVTx+$-bJ+{yx' );
define( 'AUTH_SALT',         '6+ZEC9124J7~9~6F>}cr2b}m4|WtW`]JrsPq%&Xc(5|PAm2XAcgP]F``]jb!(Pqy' );
define( 'SECURE_AUTH_SALT',  'QT3a>](7nW`x|2g&C9fe%ldwW%lS(H]VAyj.$>q|R`*,,:>ofm5Z,*P/1+o-flMS' );
define( 'LOGGED_IN_SALT',    'o!9~rlf`Ew[l|] XP|x2.b:U$U ${ni@EldwK%vwjnfl/g n=zX/;;?Anu:k,K)L' );
define( 'NONCE_SALT',        'Yt2L?[7 $@V[))87yHw3xz`[N}h;cRfFG-]et|cL6ZUbE 0#`kwL*SW#jTZVMfqv' );
define( 'WP_CACHE_KEY_SALT', 't)F!8Ue4d5=%WPTW$97Ix6188>ogSR467j:0~P}r5&sWIIQ$r%1|Y+ePNuW,vXm6' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
