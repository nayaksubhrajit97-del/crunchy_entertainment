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
define( 'DB_NAME', 'crunchyentertainment' );

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
define( 'AUTH_KEY',         '.|vi,I|?s$o+9fn1Osw,O<&F=IN`.j$p$Vmy](/!6o>K.OXh;W>19tQo-WB6^[Vw' );
define( 'SECURE_AUTH_KEY',  'zgVml nNM|@Hf(XD=G_n@H1t)8T634QR*$b nsf,InxVh-2[_BG~|!6+:!t{,M5I' );
define( 'LOGGED_IN_KEY',    '$0TtdeDS-M>lMh/$x@yUXB|.1jsu7cFW}h2.5Ov`%,d`/TGhELjMkF|2jek}V,kH' );
define( 'NONCE_KEY',        '#Kh|~@L((Zb&w<;t5^ehWsTFxaX!vX7 (Jz:{t5kxk }_7z+:(tU~@Ds ewr=38f' );
define( 'AUTH_SALT',        'j%;2)zuKavXp`Lnd}B/U03@102W.DHEvVfHQO*<1Ppvy-)w6#BV Oisk(BB~*]TW' );
define( 'SECURE_AUTH_SALT', 'zAd2-a|9^xmk,sX7cg e)gd1flm&$m(:}q-iZ.Gzc?B_X5k830k@D#]7b<jDhL53' );
define( 'LOGGED_IN_SALT',   'K2R@Er)FqG/ArP.vZPU^#PI[K2I5bC^n[.mI8GH{gl8AXz,TqWvJ)DK0ebSjPh$F' );
define( 'NONCE_SALT',       'CJb 9tP g/[jQTW*ImZ/v;P VUs;)<b6fA@#hO9Kw@R6+XDs]>f|14Q #-:0J|I-' );

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
