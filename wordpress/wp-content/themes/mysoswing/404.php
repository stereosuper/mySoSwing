<?php 
	is_user_logged_in() ? get_header() : get_header('temp');
?> 
	<div class="container">
					
		<h1><?php _e('La page est introuvable', 'mysoswing'); ?></h1>
		<div class="content">
			<p><?php _e("Désolé, cette page n'existe plus ou a été déplacée.", 'mysoswing'); ?> <br/><?php _e("Si vous êtes perdu, vous pouvez retourner à", 'mysoswing'); ?> <a href="<?php echo icl_get_home_url(); ?>"><?php _e("l'accueil", 'mysoswing'); ?></a>
			</p>
		</div>

	</div>

<?php 
	is_user_logged_in() ? get_footer() : get_footer('temp');
?>