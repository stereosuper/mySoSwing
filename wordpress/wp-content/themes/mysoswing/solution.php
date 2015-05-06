<?php 
/*
Template Name: Solution
*/

if ( !is_user_logged_in() ) {
	header('Location: ' . icl_get_home_url());  
}

get_header(); ?> 

	<div class="container clearfix">

		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<div class="clearfix">
						
					<h1 ><?php the_field('titleSolution'); ?></h1>

					<div class="schema">
						<img src="<?php echo get_template_directory_uri(); ?>/layoutImg/swing.png" alt="<?php _e('Un problème technique?', 'mysoswing'); ?>"/>
						<i class="icon-fleche"></i>
						<img src="<?php echo get_template_directory_uri(); ?>/layoutImg/tel.png" alt="<?php _e("Posez votre question sur l'application.", 'mysoswing'); ?>"/>
						<i class="icon-fleche"></i>
						<img src="<?php echo get_template_directory_uri(); ?>/layoutImg/pro.png" alt="<?php _e('Un professionnel vous répond.', 'mysoswing'); ?>"/>
						<i class="icon-fleche"></i>
						<img src="<?php echo get_template_directory_uri(); ?>/layoutImg/tel2.png" alt="<?php _e('Recevez la réponse en direct sur votre smartphone.', 'mysoswing'); ?>"/>
						<i class="icon-fleche"></i>
						<img src="<?php echo get_template_directory_uri(); ?>/layoutImg/swing2.png" alt="<?php _e('La partie peut reprendre!', 'mysoswing'); ?>"/>
					</div>

				</div>

				<a href="<?php the_field('lienFonctionnalites'); ?>" class="btnIt"><?php the_field('btnSolution'); ?></a>

			<?php endwhile; ?>
		<?php else : ?>
					
			<h1><?php _e('La page est introuvable', 'mysoswing'); ?></h1>

		<?php endif; ?>
		
	</div>

<?php get_footer(); ?>