<?php 
	is_user_logged_in() ? get_header() : get_header('temp');
?> 
	<div class="container">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
					
				<h1><?php the_title(); ?></h1>
				<div class="content">
					<?php the_content(); ?>
				</div>

			<?php endwhile; ?>

		<?php else : ?>
				
			<h1><?php _e('La page est introuvable', 'mysoswing'); ?></h1>

		<?php endif; ?>

	</div>

<?php 
	is_user_logged_in() ? get_footer() : get_footer('temp');
?>