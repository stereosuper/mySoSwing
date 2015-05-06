<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'mysoswiAr32T9hTs');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'b541219d0f3503');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '49076cc0');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'eu-cdbr-azure-north-b.cloudapp.net');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'k:_D`:+H)TL`0WMze+L5Zs8{SPP7gp$[hK? 3ywA)oOVFjI[rc|^CkdE6R(w&Bp+');
define('SECURE_AUTH_KEY',  'CNz9]A:G3p^iLe=Kg1U{--rM+?OqYAtcuP=|6p.;2K{A|jm(&J|cCR<X=J4[+g|n');
define('LOGGED_IN_KEY',    '+-N6,*7:I~D)>+MX&n~.osRzhgq-rl06C7%-r>-W%fc{q*zGjwee@CFi^O-Z&?qS');
define('NONCE_KEY',        '089Z*bE-EykVM#/3Ky+U3c]v:DVti_qlqurwZ?e{&Hr#%0k{OR]0f<cg$_d]2_g_');
define('AUTH_SALT',        '2+*qepoje 2(Xb6+5jw-={nl4A&{dNY]HW7S_Kv7/P]9`;Vf_dD/VF1R*`:D$U;4');
define('SECURE_AUTH_SALT', '~R3%B5zqn58dT6]Y)T*<8ulqPgQ_8li9[NL_N2]<HiG!0Z9j+z)3aej!rQy.g&*}');
define('LOGGED_IN_SALT',   '.%2TuOY2H+9tK5ss*.xP:+<6f0-pBVoJ]AD!~$EB=<e?Ay8vY|-;);KkGt Il875');
define('NONCE_SALT',       'uc{h2{$OHcaf0r-URs<qxTg:Y8-9YNGJN%N~3jk(1=[fX3-lrSLibu|hq&VQ)-2t');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'msw_';

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', false); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');