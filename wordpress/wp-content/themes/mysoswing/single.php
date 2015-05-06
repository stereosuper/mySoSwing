<?php 
if ( !is_user_logged_in() ) {
	header('Location: ' . icl_get_home_url());  
}
get_header(); ?> 

	<div class="container">

		<aside class="categories">
			<div class="h1"><img src="<?php echo get_template_directory_uri(); ?>/layoutImg/blog.png" alt="<?php _e('Blog', 'mysoswing'); ?>"/></div>
			<ul>
				<li><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"><?php _e('Tous les articles', 'mysoswing');?></a></li>
				<?php wp_list_categories( array('title_li' => '') ); ?> 
			</ul>
			<?php dynamic_sidebar( 'blog' ); ?>
		</aside><section class="live">
			<div class="clearfix h1"><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="btnItPrev"><?php _e("Retour à la liste d'articles", 'mysoswing'); ?></a></div>
			<a href="<?php echo icl_get_home_url(); ?>feed/?post_type=post" title="<?php _e('Flux RSS des articles', 'mysoswing'); ?>" class="rss"><?php _e('Flux RSS', 'mysoswing'); ?></a>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post();?>

					<article class="content">
						<span class="time"><?php echo get_the_date(); ?></span>
						<h1><span><?php if(get_the_category()){ foreach((get_the_category()) as $cat) { echo $cat->cat_name . ' - '; } } ?></span><?php the_title(); ?></h1>
						<?php if ( has_post_thumbnail() ) { the_post_thumbnail('full'); } ?>
						<?php the_content(); ?>
					</article>

				<?php endwhile; ?>

			<?php else : ?>
					
				<p><?php _e("L'article est introuvable", 'mysoswing'); ?></p>

			<?php endif; ?>

		</section>

	</div>

<?php get_footer(); ?>