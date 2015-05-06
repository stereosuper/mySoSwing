<?php 
/*
Template Name: Fonctionnalites
*/

if( !is_user_logged_in() ){
	header('Location: ' . icl_get_home_url());  
}

get_header();
?> 
	<div class="container fonctionnalites">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
					
				<aside>
					<h1><?php the_title(); ?></h1>
					<ul id="slideNb">
						<li><a href="#demande" title="Première étape" class="actif">1 - <span><?php the_field('titre_e1'); ?></span></a></li>
						<li><a href="#probleme" title="Deuxième étape">2 - <span><?php the_field('titre_e2'); ?></span></a></li>
						<li><a href="#video" title="Troisième étape">3 - <span><?php the_field('titre_e3'); ?></span></a></li>
						<li><a href="#reponse" title="Quatrième étape">4 - <span><?php the_field('titre_e4'); ?></span></a></li>
					</ul>
				</aside><section id="slider">
					<ul class="slider">
						<li class="on" id="demande">
							<div class="slides"></div>
							<div class="slidesTxt" style="right:-600px;opacity:0">
								<h2><span>1</span><?php the_field('titre_e1'); ?></h2>
								<p><?php the_field('texte_e1'); ?></p>
								<a href="#probleme" title="<?php _e('Deuxième étape', 'mysoswing'); ?>" class="btnIt">2 - <span><?php the_field('titre_e2'); ?></span></a>
							</div>
						</li>

						<li id="probleme">
							<div class="slides"></div>
							<div class="slidesTxt" style="right:-600px;opacity:0">
								<h2><span>2</span><?php the_field('titre_e2'); ?></h2>
								<p><?php the_field('texte_e2'); ?></p>
								<a href="#video" title="<?php _e('Troisième étape', 'mysoswing'); ?>" class="btnIt">3 - <span><?php the_field('titre_e3'); ?></span></a>
							</div>
						</li>

						<li id="video">
							<div class="slides"></div>
							<div class="slidesTxt" style="right:-600px;opacity:0">
								<h2><span>3</span><?php the_field('titre_e3'); ?></h2>
								<p><?php the_field('texte_e3'); ?></p>
								<a href="#reponse" title="<?php _e('Quatrième étape', 'mysoswing'); ?>" class="btnIt">4 - <span><?php the_field('titre_e4'); ?></span></a>
							</div>
						</li>

						<li id="reponse">
							<div class="slides"></div>
							<div class="slidesTxt" style="right:-600px;opacity:0">
								<h2><span>4</span><?php the_field('titre_e4'); ?></h2>
								<p><?php the_field('texte_e4'); ?></p>
							</div>
						</li>
					</ul>
				</section>

			<?php endwhile; ?>

		<?php else : ?>
				
			<h1><?php _e('La page est introuvable', 'mysoswing'); ?></h1>

		<?php endif; ?>

	</div>

<?php get_footer(); ?>