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
			<h1><?php _e('Blog', 'mysoswing'); ?></h1>
			<a href="<?php echo icl_get_home_url(); ?>/feed/?post_type=post" title="<?php _e('Flux RSS des articles', 'mysoswing'); ?>" class="rss"><?php _e('Flux RSS', 'mysoswing'); ?></a>

			<?php if ( have_posts() ) : 
				$count = 0;
				global $paged;
				if(get_query_var('paged')){
					$paged = get_query_var('paged');
				}elseif(get_query_var('page')){
					$paged = get_query_var('page');
				}else{
					$paged = 1;
				}
			?>

				<?php while ( have_posts() ) : the_post();?>

					<?php $count ++;
						  if($count == 1 && $paged == 1) { ?>
							<article class="rdvNow clearfix">
								<span class="time"><?php _e('Dernier article', 'mysoswing'); ?></span>
								<?php if ( has_post_thumbnail() ) { the_post_thumbnail('full', array()); } ?>
								<h2><span><?php if(get_the_category()){ foreach((get_the_category()) as $cat) { echo $cat->cat_name . ' - '; } } ?></span><?php the_title(); ?></h2>
								<?php the_excerpt(); ?>
								<a href="<?php the_permalink(); ?>" class="btnIt"><?php _e('lire la suite', 'mysoswing'); ?></a>
							</article>
						<?php }else{ ?>
							<article class="rdv">
								<span class="time"><?php echo get_the_date(); ?></span>
								<h2><span><?php if(get_the_category()){ foreach((get_the_category()) as $cat) { echo $cat->cat_name . ' - '; } } ?></span><?php the_title(); ?></h2>
								<a href="<?php the_permalink(); ?>"><?php _e('lire la suite', 'mysoswing'); ?></a>
							</article><!-- 
						--><?php } ?>

				<?php endwhile; ?>
				
				<div class="clearfix">
					<?php previous_posts_link(__('Articles suivants', 'mysoswing')); ?>
					<?php next_posts_link(__('Articles précédents', 'mysoswing')); ?>
				</div>

			<?php else : ?>
					
				<p><?php _e("Pas d'articles à afficher", 'mysoswing'); ?></p>

			<?php endif; ?>

		</section>

	</div>

<?php get_footer(); ?>