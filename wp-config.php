<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'teszt-360-marketing' );

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
define( 'AUTH_KEY',         'vYd.[gX~ikelJ},3J(P_v*Dw.tPA3~Lj,i8L1)rqk=xvUdP^J~A~_/Ck)?BVN8)v' );
define( 'SECURE_AUTH_KEY',  'j0xOtl4$0sp0T&PDhjVL?ogsvI^xGJ>-4,<it_aYdrEh>hnZe-{JD{eBpak/-6d:' );
define( 'LOGGED_IN_KEY',    '5uW^Pl[d2=]Cr.MDA^Nw1K?J:)T+y .k5/EnqkRP,Ht48E,L=PNw:5t)&Xch8}se' );
define( 'NONCE_KEY',        'D65*Rf42Ih8bCrf!IUw~$=BD~s03VX*nawENQGI4=tl,f~2p9Dnobu^^sTFfo@xV' );
define( 'AUTH_SALT',        'nNtK>/R*K}+qWm92/?xEM!Z1_s~MeY|zHgDw>>EB?!Z#M7^ de?<YDem)&`wG@/0' );
define( 'SECURE_AUTH_SALT', 'q+u<Tz_J+879>Rn<A/x,|<#?eria2~~Z4m|ShopO-dHy9qEaw~,bTsu(sgjheOr!' );
define( 'LOGGED_IN_SALT',   '{(oFe*s<eBYY<},qJ,4MCDK.=&`%S%y5*`jFjDd6`}jl)VFx&A7_|QN;;{u$oa]8' );
define( 'NONCE_SALT',       'WF);C$*NX>TjaIW(.7U}}~s+ZZR|B`VpB*v2TL_$3_^tnq$(dIaiyy{A!Zz=5,h#' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'test_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
