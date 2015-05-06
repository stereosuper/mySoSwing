<?php 
/*
Template Name: Live
*/

if ( !is_user_logged_in() ) {
	header('Location: ' . icl_get_home_url());  
}

get_header();
?> 
	<div class="container">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post();?>

				<aside class="categories">
					<div class="h1"><img src="<?php echo get_template_directory_uri(); ?>/layoutImg/live.png" alt="Live"/></div>
					<ul>
						<?php 
							global $wp_query, $paged;
							if(get_query_var('paged')){
								$paged = get_query_var('paged');
							}elseif(get_query_var('page')){
								$paged = get_query_var('page');
							}else{
								$paged = 1;
							}

							if(isset($_GET['cat'])){
								$cat = $_GET['cat'];
								$argsQuery = array( 'post_type' => 'live', 'posts_per_page' => 7, 'meta_key' => 'dateLive', 'orderby' => 'meta_value_num', 'order' => 'ASC', 'paged' => $paged, 'tax_query' => array( array( 'taxonomy' => 'catLive', 'field' => 'slug', 'terms' => $cat ) ));
							}else{
								$argsQuery = array( 'post_type' => 'live', 'posts_per_page' => 7, 'meta_key' => 'dateLive', 'orderby' => 'meta_value_num', 'order' => 'ASC', 'paged' => $paged );
							}

							$ID = get_the_ID();
							$currentPage = get_permalink( $ID );
							if($paged != 1){
								$currentPage .= 'page/'. $paged .'/';
							}

							$args = array(
								'orderby' => 'name',
								'order' => 'ASC',
								'style' => 'list',
								'title_li' => '',
								'taxonomy' => 'catLive'
							);
							$catsLive = get_categories( $args );

							$allActif = ($cat == '') ? 'actif' : '';

							echo '<li><a href="'. $currentPage .'" class="'. $allActif .'">'. __('Tous les lives', 'mysoswing') .'</a></li>';
							foreach($catsLive as $catLive){
								$classe = ($cat == $catLive->slug) ? 'actif' : ''; 
								echo '<li><a href="'. $currentPage .'?cat='. $catLive->slug .'" class="'. $classe .'"">'. $catLive->name .'</a></li>';
							}
						?>
					</ul>
					<a href="https://plus.google.com/u/2/b/109310690175075602696/events" class="hang" target="_blank">Google Hangouts</a>
				</aside><section class="live">
					<h1><?php the_title(); ?></h1>
					<?php $today = date('dd MM yy'); 
						  $wp_query = new WP_Query( $argsQuery ); 
						  $count = 0; while ( $wp_query->have_posts() ) : $wp_query->the_post(); $count ++;
						  if($count == 1 && $paged == 1) { ?>
							<article class="rdvNow clearfix">
								<span class="time"><?php $date = get_field('dateLive'); if($date <= $today && get_field('dateFinLive') >= $today){ _e('en ce moment !', 'mysoswing'); }else{ if($date == get_field('dateFinLive')){ the_field('dateFinLive'); }else{ $dateOk = substr($date, 0, -5); echo $dateOk . ' › ' . get_field('dateFinLive'); } }?></span>
								<?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumbPost'); } ?>
								<h2><span><?php $terms = get_the_terms( $post->ID , 'catLive' ); if($terms){ foreach ( $terms as $term ) { echo $term->name . ' - '; } } ?></span><?php the_title(); ?></h2>
								<?php the_content(); ?>
								<a href="<?php the_field('lienLive'); ?>" title="<?php _e('Accéder au live sur Google Hangouts', 'mysoswing'); ?>" target="_blank" class="btn btnLive"><?php if($date <= $today && get_field('dateFinLive') >= $today){ _e('Accéder au live', 'mysoswing'); }else{ _e("+ d'infos", 'mysoswing'); } ?></a>
							</article>
						<?php }else{ ?>
							<article class="rdv">
								<span class="time"><?php $date = get_field('dateLive'); if($date == get_field('dateFinLive')){ the_field('dateFinLive'); }else{ $dateOk = substr($date, 0, -5); echo $dateOk . ' › ' . get_field('dateFinLive'); } ?></span>
								<h2><span><?php $terms = get_the_terms( $post->ID , 'catLive' ); if($terms){ foreach ( $terms as $term ) { echo $term->name . ' - '; } } ?></span><?php the_title(); ?></h2>
								<a href="<?php the_field('lienLive'); ?>" title="<?php _e('Accéder au live sur Google Hangouts', 'mysoswing'); ?>" target="_blank"><?php if($date <= $today && get_field('dateFinLive') >= $today){ _e('› Accéder au live', 'mysoswing'); }else{ _e("+ d'infos", 'mysoswing'); } ?></a>
							</article><!-- 
						--><?php } ?>
					<?php endwhile; ?>
					<div class="clearfix">
						<?php previous_posts_link(__('Rendez-vous précédents', 'mysoswing')); ?>
						<?php next_posts_link(__('Rendez-vous suivants', 'mysoswing')); ?>
					</div>
					<?php wp_reset_query(); ?>
				</section>

			<?php endwhile; ?>

		<?php else : ?>
				
			<h1><?php _e('La page est introuvable', 'mysoswing'); ?></h1>

		<?php endif; ?>

	</div>

<?php get_footer(); ?>