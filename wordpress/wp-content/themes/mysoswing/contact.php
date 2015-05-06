<?php 
/*
Template Name: Contact
*/

$status = '';
$erreurNom = '';
$erreurMail = '';
$erreurMessage = '';
$erreurEnvoi = '';

$nom = (isset($_POST['nom'])) ? strip_tags(stripslashes($_POST['nom'])) : '';
$mail = (isset($_POST['mail'])) ? strip_tags(stripslashes($_POST['mail'])) : '';
$objet = (isset($_POST['objet'])) ? strip_tags($_POST['objet']) : '';
$message = (isset($_POST['message'])) ? strip_tags(stripslashes($_POST['message'])) : '';

// MAIL DE DESTINATION //////////////////////////////////////
$mailto = get_field('mail');

if(isset($_POST['submitted'])){
 	if(empty($nom)){
 		$erreurNom = 'Le champ Nom est obligatoire';
 		$status = "erreur"; 
 	}
 	if(empty($mail)){
 		$erreurMail = 'Le champ Email est obligatoire';
 		$status = "erreur"; 
 	}else{
 		if(!(filter_var($mail, FILTER_VALIDATE_EMAIL))){
 			$erreurMail = 'Vérifiez votre adresse email';
 			$status = "erreur"; 
 		}
 	}
 	if(empty($message)){
 		$erreurMessage = 'Le champ Message est obligatoire';
 		$status = "erreur"; 
 	}
 	if($status == ''){ 
 		$subject = "Nouveau message provenant de MySOSwing.com";

 		$headers = 'From: "' . $nom . '" <' . $mail . '>' . "\r\n" .
 				   'Reply-To: ' . $mail . "\r\n";

 		$content = 'De: ' . $nom . "\r\n" .
 				   'Adresse e-mail: ' . $mail . "\r\n" .
 				   'Objet: ' . $objet . "\r\n\r\n\r\n" .
 				   'Message: ' . "\r\n" . $message;

 		$sent = wp_mail($mailto, $subject, $content, $headers);

 		if($sent){
 			$status = "succes";
 		}else{ 
 			$status = "erreur"; 	
 			$erreurEnvoi = __("Votre message n'a pas pu être envoyé. Veuillez réessayer!", "mysoswing");
 		}
 	}
}

if(isset($_GET['part']) && $_GET['part'] == true && $objet == ''){
	$part = __('Je souhaite devenir partenaire', 'mysoswing');
	$titre = __('Devenir partenaire', 'mysoswing');
}else{
	$part = $objet;
	$titre = get_the_title();
}

is_user_logged_in() ? get_header() : get_header('temp');
?> 
	<div class="container">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); 
			$ID = get_the_ID();
			$currentPage = get_permalink( $ID ); ?>

				<h1><?php echo $titre; ?></h1>
				<?php if($status != "succes") { ?>
					<div class="infoContact">
						<?php the_content(); ?>
					</div><div class="formContainer blocGris <?php if($status == "erreur"){ echo 'error'; } ?>">
						<?php if($status == "erreur" && $erreurEnvoi == ''){
							echo '<p class="blocError">' . __('Merci de remplir les champs obligatoires', 'mysoswing') . '</p>';
						}elseif($status == "erreur" && $erreurEnvoi != ''){
							echo '<p class="blocError">' . $erreurEnvoi . '</p>';
						} 
						?>
						<form action="<?php $currentPage ?>" method="post">
							<fieldset class="<?php if($erreurNom != '') echo 'error'; ?>">
								<label for="nom" class="required">
									<?php _e('Votre nom', 'mysoswing'); ?>
								</label><input type="text" id="nom" name="nom" value="<?php echo $nom; ?>"/>
							</fieldset>
							<fieldset class="<?php if($erreurMail != '') echo 'error'; ?>">
								<label for="email" class="required">
									<?php _e('Votre email', 'mysoswing'); ?>
								</label><input type="email" id="email" name="mail" value="<?php echo $mail; ?>"/>
							</fieldset>
							<fieldset>
								<label for="objet">
									<?php _e('Objet', 'mysoswing'); ?>
								</label><input type="text" id="objet" name="objet" value="<?php echo $part; ?>"/>
							</fieldset>
							<fieldset class="<?php if($erreurMessage != '') echo 'error'; ?>">
								<label for="message" class="required labelMsg">
									<?php _e('Votre message', 'mysoswing'); ?>
								</label><textarea id="message" name="message"><?php echo $message; ?></textarea>
							</fieldset>
							<input type="submit" class="btn" name="submitted" value="<?php _e('Envoyer', 'mysoswing'); ?>"/>
						</form>
					</div>		
				<?php }else{ 
					echo '<p class="succes"><b>'. __('Merci ! Votre message a bien été envoyé', 'mysoswing') .'.</b><br/>'. __('Nous allons vous répondre dans les plus brefs délais', 'mysoswing') .'.</p>';
				} ?>

			<?php endwhile; ?>

		<?php else : ?>
				
			<h1><?php _e('La page est introuvable', 'mysoswing'); ?></h1>

		<?php endif; ?>

	</div>

<?php 
	is_user_logged_in() ? get_footer() : get_footer('temp'); 
?>