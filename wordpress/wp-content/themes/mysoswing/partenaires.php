<?php 
/*
Template Name: Partenaires
*/

if ( !is_user_logged_in() ) {
	header('Location: ' . icl_get_home_url());  
}

get_header();
?> 
	<div class="container">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
					
				<h1><?php the_title(); ?></h1>
				
				<?php $loop = new WP_Query( array( 'post_type' => 'partenaire', 'posts_per_page' => -1 ) ); while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<div class="partenaire blocGris">
						<?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumbPartner'); } ?>	
						<h2><?php the_title(); ?></h2>
						<?php the_content(); ?>
						<a href="<?php the_field('lienPartenaire'); ?>" target="_blank" class="btnItExt"><?php the_field('lienTxtPartenaire'); ?></a>
					</div><!-- 
				--><?php endwhile; wp_reset_query(); ?><!--

				--><div class="devenir blocGris">
					<a href="<?php the_field('lienDevenir'); ?>?part=true" class="plus" title="<?php the_field('btnDevenir'); ?>">+</a>
					<h2><?php the_field('partenaire'); ?></h2>
					<?php the_content(); ?>
					<a href="<?php the_field('lienDevenir'); ?>?part=true" class="btn"><?php the_field('btnDevenir'); ?></a>
				</div>

			<?php endwhile; ?>

		<?php else : ?>
				
			<h1><?php _e('La page est introuvable', 'mysoswing'); ?></h1>

		<?php endif; ?>

	</div>

<?php get_footer(); ?>