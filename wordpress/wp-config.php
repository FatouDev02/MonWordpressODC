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
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         'NWGQp[0%fh=74#[E~lBYQ({le<RnymY}D%TLx79[/u<zD&|*4QhvD(<SGy?.v{D!' );
define( 'SECURE_AUTH_KEY',  'tpi2LT1VpiMt[S)S;gHU?,jv$<$Cl1Iaoe5YOT28dt7^$0jJJ_txiHky&}>w2A&V' );
define( 'LOGGED_IN_KEY',    'mU5<%a?:f7#.87on,?MP+-7bTRB&OQiT)3E$^U9qE>BB,q[#nB;J^=ATe{qW-vdM' );
define( 'NONCE_KEY',        'Lzq6eemS>Ozx8C(c8Pe,4:y@Tc<6@dZa~ubVh(;-P}x!A|XjrU/@!g~1IG<jiv+l' );
define( 'AUTH_SALT',        '[E-EC<M)g@!ll,/jaI0YP:@W6TiHLT}D_A-Nin+^|P-ut4CUt7*b7mHF*bHzBg>G' );
define( 'SECURE_AUTH_SALT', 'W77$8*P.V8).39CN,y< vuKEh-Q&&/ODgZs,s^!YH2G?[-P>5cz#O*=a8ss-aTEa' );
define( 'LOGGED_IN_SALT',   '<n^QfCC5h|=O&,[i,8yc2 rd}=3B9QITyydjV<tbWP.8y-Hq]L=3,kR8@We%S)PN' );
define( 'NONCE_SALT',       ',,3^{N d.&_S#J;jA/0:h-(eG6U]vD4k~DRdr^w:{cKz16MtG!:S}UWUzZdvyV=S' );

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
