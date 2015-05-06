<?php 
/*
Template Name: Accueil
*/
is_user_logged_in() ? get_header() : get_header('temp');
$fail = isset($_GET['login']) && $_GET['login'] == 'failed' ? true : false;
?>

	<section id="bloc-home">
		<div id="bloc-bg-home">
			<?php if ( is_user_logged_in() ) { ?>
				<div id="zone-gant">
					<div id="gant"></div><div id="telephone"></div><div id="sur-gant"></div>
				</div>
			<?php } ?>
		</div>

		<div class="container">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php if ( is_user_logged_in() ) { ?>

						<div id="bloc-right-home">
							<h1><?php _e('Mettez', 'mysoswing'); ?><br /> <?php _e('votre pro', 'mysoswing'); ?><br /> <?php _e('dans la poche.', 'mysoswing'); ?></h1>
							<a href="#" id="lien-app-store" title="<?php _e("Télécharger dans l'App Store", "mysoswing"); ?>" target='_blank'></a>
						</div>

					<?php } else { ?>

						<h1><?php the_title(); ?></h1>
						<?php the_content(); ?>

						<?php if($fail){ 
							echo '<p class="fail">' . __('Le mot de passe est incorrect', 'mysoswing') . '.</p>';
						} ?>
						
						<button class="btn <?php if($fail) echo ' hidden'; ?>" id="acces"><?php _e('Accès privé', 'mysoswing'); ?></button>
						<form name="loginform" id="formAcces" action="<?php echo site_url( 'wp-login.php', 'login' ); ?>" method="post" <?php if($fail) echo ' class="here"'; ?>>

							<input type="hidden" name="log" id="log" value="mssUser"/>
							<input type="password" name="pwd" id="mdp" value="" placeholder="<?php _e( 'Mot de passe', 'mysoswing' ); ?>"/>

							<input type="submit" name="wp-submit" id="connect" class="btn" value="<?php _e('Connexion', 'mysoswing'); ?>" />
							<input type="hidden" name="redirect_to" value="<?php echo icl_get_home_url(); ?>" />

						</form>
						
					<?php } ?>		

				<?php endwhile; ?>

			<?php else : ?>

				<h1><?php _e('La page demandée est introuvable', 'mysoswing'); ?></h1>

			<?php endif; ?>
		</div>

	</section>

<?php 
is_user_logged_in() ? get_footer() : get_footer('temp');
?>