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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpressenv' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         ',oP^;ngUj`::VscGst_$j#ebh/,i`jfe`}Kh~=!a?@K28)V-MU!<y+)6l^(K-*).' );
define( 'SECURE_AUTH_KEY',  '&}}9zsC@L7wlPGDDzZ+u=,gbOr7l$SR!]TI;y/2`B2`H^asCYe1gI%7Aa:[X.XDd' );
define( 'LOGGED_IN_KEY',    '(ucHp{%V:mO^3LDBe0lA]SGDRO%00w!.E]o.6^b]1;oN}m 1TYAN=7`KT.7M;~[&' );
define( 'NONCE_KEY',        ';BMQ4Dl6!)kZ}4o[W+ngN}`l;{|E@k?._Yh,{RyF@F^BZ)Zal1xwJh1|GQt5V!^}' );
define( 'AUTH_SALT',        's]|7L?a^Mnl49T|$1n$e-?NkzP>UGIfhk4NR3oAt]TC#n};kM}/%~AbCf7M0aJr$' );
define( 'SECURE_AUTH_SALT', 'zz4=L>unaINQ^;<pGa2_W._ZXYX?_R1>/w $iMfwiUr:VCg.gq(e6[c2{<P(YPyF' );
define( 'LOGGED_IN_SALT',   'n2|0p(}.jXGp(esLCl()B~oL$(Pj`kN]z#-Tw~eRVDe+SvJ>qpkGA/A~Z]yD.~FB' );
define( 'NONCE_SALT',       'cMy6o9iU.DNx{<lor$6Ia[<RS:Sr`l>OX`=sbu;^6<1`3:/K_rK/[>B,L{W{);=l' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
