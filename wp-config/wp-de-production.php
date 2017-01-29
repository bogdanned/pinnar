<?php
// Prevent file from being accessed directly
if (!defined('ABSPATH')) exit();

define('DB_NAME',     'pinnar');
define('DB_USER',     'root');
define('DB_PASSWORD', 'root');
define('DB_HOST',     'localhost');
define('DB_CHARSET',  'utf8mb4');
define('DB_COLLATE',  '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'L*@~Uk=nqSc.F^DaE@5ZrwkGv4y5^UKwVy]=vpX<8%W *{8y@SBSqYl$C5X[F(8K');
define('SECURE_AUTH_KEY',  'Uy]EeNo.xiPuVGW+e(+-EZuP`|.RCj?%,d[m$BeZ#4}nYf$)kC}G5(xzG`Oj=H~s');
define('LOGGED_IN_KEY',    'O-^f!$Bi_X4(!3*gK{b,:@5w>x_LJ>HjANMY{vn.<n-bP2A-{#=M4fsd$XtCj!7.');
define('NONCE_KEY',        'kn<Q+,K4opW9l!|7v54E=gGQd=:-AVL|CmdP)Y8@qK`uE2]i;h@p,7#Wllo5N7_5');
define('AUTH_SALT',        '*tnt@MR`U&^Gi,12;H5uW7w/jYvmkA2Q/|DA|vd*$Dq,ef&3&ry0sy1y3Y/.)!1K');
define('SECURE_AUTH_SALT', '+zzCBD__R=*#vh{5`]1dl-$-(_<^;&p_zs!v1dc*s21c0l]>GpiuWoK1rYF(W;*.');
define('LOGGED_IN_SALT',   't$D7wl|vuqcZg,^_b`%uJgHr):V{=B~D[0nH6%!|9H/Tu~<mpH0A.+7p<}9g4Fs!');
define('NONCE_SALT',       'D4i`j;,*va9!)$6I32)%i:|PWOU#*Y-R!yE$&Xj~Wl1#R{]vavW{<H~e..bjV7Jo');

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'pn_';

$wp_home = 'http://' . $http_host;
$wp_site_url = 'http://' . $http_host;

define('WP_HOME', $wp_home );
define('WP_SITEURL', $wp_site_url );

define('WP_DEBUG', true);
