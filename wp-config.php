<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'vilagankhoe');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define('WP_HOME','http://localhost/vilagankhoe');
//define('WP_HOME','http://'.$_SERVER['SERVER_NAME']);
//define('WP_SITEURL', 'http://'.$_SERVER['SERVER_NAME'].'');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '?Aj|H+9h}Rt|y~iU]Xu [q+652-ed:Oe.Uu=JvR3E6{2|>[5-}i2Tv!M(mwZ)n+&');
define('SECURE_AUTH_KEY',  'jB?vy7:.Y1 ]yEuG^pg|+ ovu3WvxOE4kWM={]P|LT%PL:^L+yf16K]5QE@Q{aAh');
define('LOGGED_IN_KEY',    'KlEF_XOuXwOI19ByOo;Pu|i~efP%hl-4|h~Q3wA|)C.C1R,7Il^4El/z0F0R=4:X');
define('NONCE_KEY',        '|P;r&e_CJ~+n>ICB|U={H2$*5XQ3R3@R=OHFw?2Ph5u}^}Is{||e=5CIZV3FK5pl');
define('AUTH_SALT',        'oaelPHH.:w91H%vRD;g[!R=N 8,4H8]u _9%``PKEn2^_1Ubk68tR125T^oY@(Va');
define('SECURE_AUTH_SALT', '|8Eg^;_csNwO.dA<1,UTA]d~Sy8;#/=}m@|5W+gsNg46|n625Ue;<I#z-G*ACy-j');
define('LOGGED_IN_SALT',   'z<tmGW)CXw?%_:svIo$4]ag?tmf)Hw64yo=|s|J1-A&ZjR/vYR*=x+B=+Yx5XB0#');
define('NONCE_SALT',       '+OYx^Y@i sT@ghcU?+;zt$p{kSc+.eXW@^gC[y^Yx~x;$5.[xUx0kh!S?_k,oGs6');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
