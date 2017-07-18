<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'decidere_blog');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'kSd9DfLBu84J');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** for method update files forced***************/
//define('FS_METHOD', 'direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'xN<Cu{.O23`*l-Axz%;-{`+/I/+jsn#dgqU>N2qk6-JF+z9GRG[AF-^%Dqv|Tlv?');
define('SECURE_AUTH_KEY',  'New|,[MbH4#~`6:#R+b1gy.[)B!W?J>V{y4}#J,<NZ.V~v=t}/.h]sWXxC>n5<D(');
define('LOGGED_IN_KEY',    '?c+j12US>YCvTV (;y&%JHrxmE-]u+%cJM/TDzw,/m(i&U0wKE q#+M631>O4A1V');
define('NONCE_KEY',        '~]._OTxX$Avamv$ex[i7&L1q1jq4.-y#ju|+jF`nD-u%3;+/yC}Y33&a20$;T^L7');
define('AUTH_SALT',        '|lFhm)S{b#tN~[w4RN8h=7}Dir|m|i.)te44a!$(.1|1+$/#v U?lM1.5TkZ(|}K');
define('SECURE_AUTH_SALT', 'DzLytZxvQExo5lRU73lvRDxs3QIdFvG}<lHD]B>hk8;P[AVTE;if?tPU~kDr8{zj');
define('LOGGED_IN_SALT',   'VVrk.{R$[Z*qFFP%KS]s9(/-DQi>K&Ue()Mcb}7We]M;V,R}3lK-cx5OF2K-)6-B');
define('NONCE_SALT',       '~z *YT8Ps=*]|89AB[5SVj?nx.oXLz( l~VF2d>=$z-opKTL3f@R0wpQ4AUe=A;=');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

