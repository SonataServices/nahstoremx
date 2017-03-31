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
define('DB_NAME', '');

/** MySQL database username */
define('DB_USER', '');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '6dT`6H2aLWq4Pq?j|NeH-k|cWsl~[,@pqIX}gvn6}|z$/ehh_7p5Rq.$40f+9kT-');
define('SECURE_AUTH_KEY',  '{JcvkJQj-RAvUyI_1|`8hh[JM&$,yOY-{g6_9>D?w>%W0DMkP&Iq#7Ub+1jvX%Q%');
define('LOGGED_IN_KEY',    'p:1QEI&*-,(x|)7n_oPZIei/#W; )({f#&Un-PzOkluhQCcZ|4EA/l!eeD_l*UmF');
define('NONCE_KEY',        'N!=K815$;6n^Lh1[7Q-9g1_i[pnl+t#f9-OO?3:ld4++,1PqSE@tINON`bw*s@t%');
define('AUTH_SALT',        '_1X:Ob^kz~E|Pz/cv{]C2r{-.1(~9N>jvS--<y7al04g^/=Y^C/5@|ePrb=/jhif');
define('SECURE_AUTH_SALT', 'Pi3)gZBN }f6q:S&E=W2H;c%C:H;9*c9j#?j)nHifxQ::+(Y^67h#3|-$/5mztQC');
define('LOGGED_IN_SALT',   'cBF~+1J<Y|-xS!,y^;69y+(2g[%.p;<J:-xl|3^g)#iiO<F7@[K),9+^iP&]R}+f');
define('NONCE_SALT',       'mHVVgi{s`{@<pf|Jf|$f]>]75Z>AB)HUF41QULU#oG5k)=UNV#-|JYh05)-+~W,P');

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
