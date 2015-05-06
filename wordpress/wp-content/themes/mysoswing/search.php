<?php 
if ( !is_user_logged_in() ) {
	header('Location: ' . icl_get_home_url());  
}
get_header(); ?>

	<div class="container">
		<aside class="categories">
			<div class="h1"><img src="<?php echo get_template_directory_uri(); ?>/layoutImg/blog.png" alt="Blog"/></div>
			<ul>
				<li><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"><?php _e('Tous les articles', 'mysoswing');?></a></li>
				<?php wp_list_categories( array('title_li' => '') ); ?> 
			</ul>
			<?php dynamic_sidebar( 'blog' ); ?>
		</aside><section class="live">

			<?php if ( have_posts() ) : 
				global $wp_query;
				$results = $wp_query->found_posts; ?>

				<h1><?php _e('La recherche', 'mysoswing'); ?> "<?php the_search_query(); ?>" <?php _e('a retourné ', 'mysoswing'); if($results > 1){ echo $results . __(' résultats', 'mysoswing'); }else{ _e('1 résultat', 'mysoswing'); } ?> </h1>
				
				<?php while (have_posts()) : the_post(); ?>
					<article class="rdv">
						<span class="time"><?php echo get_the_date(); ?></span>
						<h2><span><?php if(get_the_category()){ foreach((get_the_category()) as $cat) { echo $cat->cat_name . ' - '; } } ?></span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<a href="<?php the_permalink(); ?>"><?php _e('lire la suite', 'mysoswing'); ?></a>
					</article><!--

				--><?php endwhile; ?>

				<div class="clearfix">
					<?php previous_posts_link(__('Résultats plus récents', 'mysoswing')); ?>
					<?php next_posts_link(__('Résultats plus anciens', 'mysoswing')); ?>
				</div>
				
			<?php else : ?>

				<h1><?php _e('La recherche', 'mysoswing'); ?> "<?php the_search_query(); ?>" <?php _e("n'a retourné aucun résultat", 'mysoswing'); ?></h1>

			<?php endif; ?>

		</section>
	</div>

<?php get_footer(); ?>