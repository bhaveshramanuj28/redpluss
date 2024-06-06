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
define( 'DB_NAME', 'redpluss' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          'RxeI6}mo}5G$p!1zE73.;&`|]F?zota|rmn>0ZmZ%}DQn5KT 8=I;Bs5Xz,3%O]>' );
define( 'SECURE_AUTH_KEY',   'q%1!>#{X$hz{n]-T4E~XUBLU5Gvt4^z+cn+Iy6z:;.1&j9P^$iR0aX[tEW-%2sOh' );
define( 'LOGGED_IN_KEY',     'so=b<I7$n3[Q6hz~rhWo(Q3J[t]!NLD6!pC2NRD@%0y[;+A:17Ou8k2|cnfaAKN_' );
define( 'NONCE_KEY',         '*Eo 7$8{aO~2hD)G7qyG)2m[y(=MsSLC#)dWRT;<+mi8 }dg(s}fGF3&1j|r4y?G' );
define( 'AUTH_SALT',         'EYA^,fL:0H+?_Bk^Oj*iEz05g<k&C}YWBwp};i,$oW3@pLhjY^]O7?e=%=-@h;xQ' );
define( 'SECURE_AUTH_SALT',  'qmU{fd6V$]NPaGDY+T/<T9x>vf?XMz^k3)Y9:tCw7~)gl~s@22[6RQ%4,j`-8~t4' );
define( 'LOGGED_IN_SALT',    '0-It(ZRYn2bY<tE5TJ;9=juB>$_!RM)t(ob$rj{@(IQB=1{?%q>E:~[>;jFSnu]i' );
define( 'NONCE_SALT',        'SXg:z^:= Uy$:7C?Kj<8PE0Z5QHgI[2 U>h+2ERI%8QiffC|j+Xy:G7M6uqD`ACw' );
define( 'WP_CACHE_KEY_SALT', 'EVj49m*e}yxLx%5`/fKY3{<=g8!)Lgy3336%..]c7Rq31p?S!aRTz{?3BQi$BWu~' );


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

define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
