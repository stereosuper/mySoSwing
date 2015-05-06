<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9 lt-ie10"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="utf-8">
		<title>
			<?php is_front_page() ? bloginfo('description') : wp_title(''); ?>
		</title>
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
		<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="/manifest.json">
		<meta name="msapplication-TileColor" content="#2b5797">
		<meta name="msapplication-TileImage" content="/mstile-144x144.png">
		<meta name="theme-color" content="#000">

		<?php wp_head(); ?>
	</head>

	<body <?php body_class('homeTemp'); ?> >

		<header>
			<div id="top-header">
				<div class="container clearfix">
				</div>
			</div>
			<div id="bottom-header">
				<nav class="container clearfix" role="navigation">
					<a id="logo" href="<?php echo icl_get_home_url(); ?>" title="<?php _e("Retour à l'accueil", 'mysoswing'); ?>"><?php bloginfo( 'name' ); ?></a>
					<?php wp_nav_menu( array( 'theme_location' => 'primaryNotConnected', 'container_id' => 'menu', 'menu_id' => 'menu-header' ) ); ?>
					<a id="burger" href="<?php echo icl_get_home_url(); ?>" title="<?php _e('Ouvrir le menu', 'mysoswing'); ?>" class="btn"><i id="b1"></i><i id="b2"></i><i id="b3"></i></a>
				</nav>
			</div>		
		</header>