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
define('REVISR_GIT_PATH', 'faizan-endshift@bitbucket.org:endshiftteam/spell.com-clone.git'); // Added by Revisr
define('DB_NAME', 'spel1');

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

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'AaeK7f41YKmm:B2>k)$eM=+bZEr@$,JKi5[/oP9oZu1olSI1O<jj@5Q(wh#;{0UU');
define('SECURE_AUTH_KEY',  'XIfP%sv0F%bPS|M$9K(nfhDU)9O(gLctPr0pJ<}90Wy&i -orWa>? u)5h}<_`.m');
define('LOGGED_IN_KEY',    'r+MFq(_[&EY%kTNa*T(~2_Mi5iMOG#rBJDvf,JVg*i%e:2;3[3|Ka.LdpSOMQb-;');
define('NONCE_KEY',        'x<J*Vr75Y4Q.?P`NDkSd$B~JnCPa`V&4@(pa]G*j_Ci?8h 8GKSM)jNRjJO$Qe(Y');
define('AUTH_SALT',        'g>,cw%3{Fw[nwgYT[3J=d(4Rqro4WMJj3~meE2hyx<+@[&{n/o 8*PME(C@jy9H5');
define('SECURE_AUTH_SALT', 'YVA0S=Y=9=?k zgCM11]X.*h u|GH7YWm]Cwy2nS2zCAfm8Hv#1-n_mj5 ^02f^~');
define('LOGGED_IN_SALT',   '@E[mLeBFex}w@b27FQ@pW024 E=5b~p(`^nrI*>KwXUr$lPk{sj:jwlER6qBNj/(');
define('NONCE_SALT',       '{A/)2,X+|CtD)/AzA>Nf_r]7t7j8j2t#p^j=V.B Gf u{Ey1Utjg*6t. 9A}DN<4');

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
