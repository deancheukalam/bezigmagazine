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

define( 'DB_NAME', "bezigmagazine" );


/** Database username */

define( 'DB_USER', "root" );


/** Database password */

define( 'DB_PASSWORD', "" );


/** Database hostname */

define( 'DB_HOST', "localhost" );


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

define( 'AUTH_KEY',         'dC{8%}`Mc=2)Yuirag%wiEXvI%[jWp|CQIZk3GA~tOHE;8R2igxVr&.-ARnqj<CF' );

define( 'SECURE_AUTH_KEY',  '43*-f/Ey::|Ktf%y*F*m>S/-{rJ7#xt=Z .3Jv/B(iUuc2B;iL4&]YG%s@-u81lA' );

define( 'LOGGED_IN_KEY',    ';]j}3@|^9)g1q{NyUtBH]?_-{E(m7N,JNnWeS,hz[h<D3Ba U& I+0!6YGV DY)!' );

define( 'NONCE_KEY',        'PqXbSTli1?A:eli(YGN3WQ9;+IQRNmm$joc!Z]~fM$DJBf`LMW+FpIY3CeDzUv0m' );

define( 'AUTH_SALT',        'F>jf$&p3G}Q57NyW2>GKxZ9OH*BLF6JL#}.UgT{:(Wy>S=jHoDim6t#{wP(u+sKX' );

define( 'SECURE_AUTH_SALT', 'yP|SA=iN+$e=[L}J2xvZ,>P1{GpC7LAaty56<b(KRJ,A14L)O3x >WaI2,tvzK^o' );

define( 'LOGGED_IN_SALT',   'Kdquba~w*/%}P.O@{*![P=.kSCB6`IAc>r[dSpT2G.(H8~b@_1cYS[O9pz::h!A)' );

define( 'NONCE_SALT',       'adD&kv%`(5^ulz[FOg6n{f6^>}*N5W3NtLpQc)Ch3o.2i_aqC8IeLwC}U6p/Bwcn' );


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

