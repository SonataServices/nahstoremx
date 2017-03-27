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
define('DB_NAME', 'natnhomx');

/** MySQL database username */
define('DB_USER', 'naturalnhmx');

/** MySQL database password */
define('DB_PASSWORD', '976Aimn@a07AAm9333a');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'M&gvl9o(jMT<_A<rr[-;)&75R<q}3dQ#0BZ1jFSJ6^K2FJ[;@F2`KRUpxgq~[JmX');
define('SECURE_AUTH_KEY',  'RU&x0 aEeLoB7(@>3u#3kG7C&71puTEXQj>PKIc,,<.nC1=;`#MW9sh9t[9*+!:L');
define('LOGGED_IN_KEY',    '}%a=BZayjK/op>VISG7?]#wQ2xcLba0SW/~5=1rn;v8WdQILd2&H<63 _h;9| ul');
define('NONCE_KEY',        'vWf6ZfNQiN:rSC*OE7E5SBrpHC/+ey]vvJj^~f6RaX;C#(tRC7#f(E8o>`<@Z{Ru');
define('AUTH_SALT',        'eFnlr Owj02A`l^&,&vD6*<N-}4Ns3xx3O^i*%3d}@F$+u1Q4X TP?IHl&@uqjuV');
define('SECURE_AUTH_SALT', 'YaL8x61.0,`cH[k?@}d-ca?W%*CX[nZ8{spAXxozq1%gN;aKEh._<4.hu2nBJKxl');
define('LOGGED_IN_SALT',   'hwM*Ybe}9@P?c]%)Rq1xnQoZ}$Qv=Oj+=#;QcR;Ik{R@y&Fa@$8&P2;wxU1$/[hr');
define('NONCE_SALT',       'BQ?.Q]Gq,<dMjgRGI@?FZ7lbrc85VNq5| y3Px:Z2]oR_hj?!X=];?aX9fG^Z(0l');

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
