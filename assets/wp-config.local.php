<?php
define('WP_CACHE', true); // Added by WP Rocket

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
define('DB_NAME', 'halloween');

/** Database username */
define('DB_USER', 'sandor');

/** Database password */
define('DB_PASSWORD', 'pass');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',          ',srw{>%lo37_qfS/Li}?}w-z[*l/uV|kdXb>8d`z{9H;k>S5-bR^]4p[c!X;@SaU');
define('SECURE_AUTH_KEY',   '%j]r<(7jp<7_UHgM<xj&9siZ[$X!FqQpi&yEuO`M-0y]$(dR=BEGZVE1.)@hz7IY');
define('LOGGED_IN_KEY',     '{HIsB[80pt@]Z{}pyI1~(M0Y/^2>;KR4InjMhYG|cWMy~T`v=D!zVv78^S8Y0NSj');
define('NONCE_KEY',         'c^D+d_ ;0R14CXJkF)|KKc;@ljeL@uF!O1r.ufahoR,*gE-^t@Av ,6lM5rh[ )k');
define('AUTH_SALT',         'N%~^]Bar_[7/Erp8_(>[S4 %H =+!L}29Fgc[jw(?|nXdTNs!}nuOqO_C+%J_P`d');
define('SECURE_AUTH_SALT',  ' kp=&|KP%-LX@Ij]e&Uq.E~Fhqt;LsK0}vZ:P0T6e0-*bq6&/k<aG-{2!3uYLAxv');
define('LOGGED_IN_SALT',    'w$X[_hKl<Rd0B[`94hc:fnP94bEM1t.!|?$~ WHM,jJI/A:V:;WGi&3L=x4nd{0F');
define('NONCE_SALT',        'qLG4Gk(gy$,/gH_/R,Ce*5c&!.(V7@9xZ%EQ>HR]F-L(Q7TMA.YztgsE43$>|l:P');
define('WP_CACHE_KEY_SALT', 'GF33-4T|7`FAA]s)v#yrs?Dyv7$eF?C<hs)SeL*2l|QHg>Ee[Cxq3xC7g ^aH<[q');


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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

define('WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . "/halloween/wp-content"); // no host name, no trailing backslash
define('WP_CONTENT_URL', 'http://localhost/halloween/wp-content');
define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins');
define('WP_PLUGIN_URL', 'http://localhost/halloween/wp-content/plugins');
require_once($_SERVER['DOCUMENT_ROOT'] . '/halloween/vendor/autoload.php');

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
  define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
