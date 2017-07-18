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
define('DB_NAME', 'lookingapp');

/** MySQL database username */
define('DB_USER', 'lookingapp');

/** MySQL database password */
define('DB_PASSWORD', 'Admin@2020');

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
define('AUTH_KEY',         '_2Jq/?`fAhRFiR5-gAsKXxNHQJ8p@8NWO/$zFuUP>]xbb?Iwfwy&?Gpt[]gJD;PD');
define('SECURE_AUTH_KEY',  '%ggt]t5.E27Q<ByK=lG,|o~Vo0Di8P%s1g]Pf9h/Z`dfHg+M?wJ5_1bcRawb~<58');
define('LOGGED_IN_KEY',    'gX14 jt=vrU!<M]1?e9n[g|q!CMs?fw/ynqm(+H{wrgp52N2/L2<W7R>WU>9D$0~');
define('NONCE_KEY',        'nUyD;vz_V@t:J+RTtUPH$XSs3fr:gX8v,C54+ }&FBGG*l-.~}Tk]weOI#X6n(w*');
define('AUTH_SALT',        '}mB>m8%*%@2eqBs4/*IE>1n*h]K{<9wo;-|{TA2$ cGNU#-+s)e;32`f[c))y2h4');
define('SECURE_AUTH_SALT', 't&6bBhaCTxgD *x1Ik0@W?5HD)h+ccI-W`^QIWog<8$-w>FS$xX-qgTikCsrS0O>');
define('LOGGED_IN_SALT',   '5:ELj/9bWGH/M e~{v[WQ%*j$~j%)i:%Z2.)Hlp$3?8EljN/9b$rgc}eLuPO(z=J');
define('NONCE_SALT',       '.Hqu&oIK1m37@EyM$iCL(F@Nyji;d!gm~<+hFbFBjoJ l}J+K:`%PG.6evyHsnjR');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'lk_';

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
