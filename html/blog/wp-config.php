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
define('DB_USER', 'decidere_user');

/** MySQL database password */
define('DB_PASSWORD', 'xFTNycT3X2mdh3dE');
//define('DB_PASSWORD', 'kSd9DfLBu84J');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_HOME','http://www.decidere.com/articles/');
define('WP_SITEURL','http://www.decidere.com/articles/');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'i(6:6la:#=_)E*w]y_3Qp3IEpK. >R6fS:+d%bo8b^!Y@GV;h+25S~3$ip0G-z|%');
define('SECURE_AUTH_KEY',  'Y;31+|bW7]-LuQIy%u&SeR|#@#igxSWyK@[lhxAw#}M,T*KfU j$*vL|@?Zrv;i)');
define('LOGGED_IN_KEY',    ')E4#N;!8-oZ28KVgz+~<DPK?R2|UvTjT![Rt&p[C~N`zkY!lP+fdLEQ%_[:wr>U,');
define('NONCE_KEY',        'tQ1D+zMYWmlt~z+em8_tyXQPy`s->`&i&1m}6qBp:HEAc;ci%8lv>fjOUDugmF-!');
define('AUTH_SALT',        '{;((+W_$|s}M1v2Z 2w><aDrZFcuOO +p/hu4C!u_#Oaa1MlP8fb2O1_Z5?+b+{z');
define('SECURE_AUTH_SALT', 'Q8f#-&o@[2 {weO?0}iP2z]-~VmH_u6)$Q|4sxMnp4a+9#CI{,J|V48Iz_T!Z&jS');
define('LOGGED_IN_SALT',   '8a`Os(^ZmpQz.%/c#(gQ)Dfqybx!lE#z<*vY}EJ+)oC$[,G.@p+#LpHNgW5x55Gp');
define('NONCE_SALT',       'zhj/,(ZQ`Sw+>-;f%t5|k{i3NCmEF#IWuYMbYaD>=A.9IDLO+CeXXN:g%6j@#<]|');

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

define('FS_METHOD', 'direct');
