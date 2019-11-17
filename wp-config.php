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
define('DB_NAME', 'ielterti_wp502');
/** MySQL database username */
define('DB_USER', 'ielterti_wp502');
/** MySQL database password */
define('DB_PASSWORD', '33s4SBp))9');
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
define('AUTH_KEY',         'ahpdb43bicv0fwfawue5udqpupwshhsrxfsmvp9m10kkvdt3pnmmzcpvfkay1dvx');
define('SECURE_AUTH_KEY',  'mblzxlgwkmjcje16kqnzfcmlzk3wlsyisfcytao09ahxjjypi4biyds6gpktu7qd');
define('LOGGED_IN_KEY',    'os5z6yiiwyaxt2litcivgnmfigokbrpv6nmqfiutl4a4kijzxfiwkxwum3zy5equ');
define('NONCE_KEY',        'gnjbp2853bl1gyokw5hobuxirj11zaqbjy8f58phteapsgc2zy9vng9tq6dbzfqo');
define('AUTH_SALT',        'jnurxmprw6sboqzl1s7qxhdnq3lpgdmko3qftmkzwybhbitvud41ax8v96aelody');
define('SECURE_AUTH_SALT', 'zyzjvgugzmriq7d9sfyj5owrwoygiysxl25r4aus0jyczcfzaoj1uyvmtd3qt6py');
define('LOGGED_IN_SALT',   '6mdfdgxn8slbujwnpcnrjt6pvhhvi81xum2icowvm9bof0q72cfpwlgut6qh69hh');
define('NONCE_SALT',       'n3acfvgrj3pz3zt3r6z82hw7xrqrn85mjrmwjjresp7h0nlank323ae6tpyi4eng');
/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpao_';
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
