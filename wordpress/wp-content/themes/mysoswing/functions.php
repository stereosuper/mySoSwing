<?php
define( 'MYSOSWING_VERSION', 1.0 );

/*-----------------------------------------------------------------------------------*/
/* Add Rss feed support to Head section
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'automatic-feed-links' );

/*-----------------------------------------------------------------------------------*/
/* Hide Wordpress version and stuff for security, hide login errors
/*-----------------------------------------------------------------------------------*/
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

add_filter('login_errors', create_function('$a', "return null;"));

function remove_comment_author_class( $classes ) {
	foreach( $classes as $key => $class ) {
		if(strstr($class, "comment-author-")) {
			unset( $classes[$key]
 );
		}
	}
	return $classes;
}
add_filter( 'comment_class' , 'remove_comment_author_class' );

/*-----------------------------------------------------------------------------------*/
/* Register main menu for Wordpress use
/*-----------------------------------------------------------------------------------*/
register_nav_menus( 
	array(
		'primary' => 'Primary', 
		'primaryNotConnected' => 'Primary Not Connected',
		'secondary'	=> 'Secondary',
		'secondaryNotConnected' => 'Secondary Not Connected'
	)
);

// Cleanup WP Menu html
function css_attributes_filter($var) {
     return is_array($var) ? array_intersect($var, array('current-menu-item', 'current_page_parent')) : '';
}
add_filter('nav_menu_css_class', 'css_attributes_filter', 100, 1);
add_filter('page_css_class', 'css_attributes_filter', 100, 1);

/*-----------------------------------------------------------------------------------*/
/* Widgets
/*-----------------------------------------------------------------------------------*/
function mysoswing_register_sidebars() {
	register_sidebar(array(				
		'id' => 'footer', 					
		'name' => 'Footer',				
		'description' => 'Texte du footer', 
		'before_widget' => '',	
		'after_widget' => '',	
		'before_title' => '',	
		'after_title' => '',		
		'empty_title'=> ''			
	));
	register_sidebar(array(				
		'id' => 'blog', 					
		'name' => 'Blog Sidebar',				
		'description' => 'Sidebar de la page blog', 
		'before_widget' => '',	
		'after_widget' => '',	
		'before_title' => '',	
		'after_title' => '',		
		'empty_title'=> ''			
	));
} 
add_action( 'widgets_init', 'mysoswing_register_sidebars' );

// widget footer
class Footer_Widget extends WP_Widget {
	function Footer_Widget() {
		parent::WP_Widget(false, 'MySOSwing - Footer');
	}
	function form($instance) {
		$texte = esc_attr($instance['texte']);  
		$bouton = esc_attr($instance['bouton']); 
		$lien = esc_attr($instance['lien']); 
		?>  	<h4>Footer</h4>
		        <p><label for="<?php echo $this->get_field_id('texte'); ?>">Texte : <input class="widefat" id="<?php echo $this->get_field_id('texte'); ?>" name="<?php echo $this->get_field_name('texte'); ?>" type="text" value="<?php echo $texte; ?>" /></label></p> 
				<p><label for="<?php echo $this->get_field_id('bouton'); ?>">Bouton : <input class="widefat" id="<?php echo $this->get_field_id('bouton'); ?>" name="<?php echo $this->get_field_name('bouton'); ?>" type="text" value="<?php echo $bouton; ?>" /></label></p> 	
				<p><label for="<?php echo $this->get_field_id('lien'); ?>">Lien : <input class="widefat" id="<?php echo $this->get_field_id('lien'); ?>" name="<?php echo $this->get_field_name('lien'); ?>" type="text" value="<?php echo $lien; ?>" /></label></p>		
		<?php  
	}
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	function widget($args, $instance) {
		?>
		<p class="align-left">
			<?php if ($instance['texte'] != '') {
				echo $instance['texte'] . '&nbsp;'; 
			} ?>
			<?php if ($instance['bouton'] != '' && $instance['lien'] != '') { ?>
				<a href="<? echo $instance['lien']; ?>" class="btn-inline"><? echo $instance['bouton']; ?></a>		
			<?php } ?>		
		</p>
		<?php 
	}
}
register_widget('Footer_Widget');

/*-----------------------------------------------------------------------------------*/
/* Custom Post Types => Partenaires, RDV Live
/*-----------------------------------------------------------------------------------*/
function create_post_type() { 
  register_post_type('partenaire', array(
    'label' => 'Partenaires',
    'singular_label' => 'Partenaire',
    'public' => true,
    'supports' => array('title', 'editor', 'thumbnail')
  ));
  register_post_type('live', array(
    'label' => 'RDV Live',
    'singular_label' => 'RDV Live',
    'public' => true,
    'supports' => array('title', 'editor', 'thumbnail')
  ));
}
add_action( 'init', 'create_post_type' );

/*-----------------------------------------------------------------------------------*/
/* Custom Taxonomies => Catégories Live
/*-----------------------------------------------------------------------------------*/
function create_live_taxonomies() {
	register_taxonomy( 'catLive', array( 'live' ), array(
		'hierarchical' => true,
		'labels' => array(
						'name' => 'Catégories Live', 'RDV Live',
						'singular_name' => 'Catégorie Live', 'RDV Live'
					),
		'rewrite' => array( 'slug' => 'catLive' )
	));
}
add_action( 'init', 'create_live_taxonomies', 0 );

/*-----------------------------------------------------------------------------------*/
/* Add a class to Prev and Next posts links
/*-----------------------------------------------------------------------------------*/
function nextposts_link_attributes() {
    return 'class="btnIt"';
}
add_filter('next_posts_link_attributes', 'nextposts_link_attributes');

function prevposts_link_attributes() {
    return 'class="btnItPrev"';
}
add_filter('previous_posts_link_attributes', 'prevposts_link_attributes');

/*-----------------------------------------------------------------------------------*/
/* Custom excerpt
/*-----------------------------------------------------------------------------------*/
function improved_trim_excerpt($text) {
    global $post;
    if ( '' == $text ) {
        $text = get_the_content('');
        $text = apply_filters('the_content', $text);
        $text = strip_tags($text, '<p>');
        $excerpt_length = 43;
        $words = explode(' ', $text, $excerpt_length + 1);
        if (count($words) > $excerpt_length) {
            array_pop($words);
            array_push($words, '...');
            $text = implode(' ', $words);
        }
    }
    return $text;
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'improved_trim_excerpt');

/*-----------------------------------------------------------------------------------*/
/* Ajout des "images à la une" dans les custom posts et les articles
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'post-thumbnails' , array('partenaire', 'live', 'post')); 

/*-----------------------------------------------------------------------------------*/
/* New thumbnail sizes
/*-----------------------------------------------------------------------------------*/
function mysoswing_custom_thumbnail_size(){
    add_image_size( 'thumbPost', 330, 235, true );
    add_image_size( 'thumbPartner', 600, 110 );
}
add_action( 'after_setup_theme', 'mysoswing_custom_thumbnail_size' );

/*-----------------------------------------------------------------------------------*/
/* Enlever le lien par défaut autour des images
/*-----------------------------------------------------------------------------------*/
function wpb_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
    if ($image_set !== 'none') {
        update_option('image_default_link_type', 'none');
    }
}
add_action('admin_init', 'wpb_imagelink_setup', 10);

/*-----------------------------------------------------------------------------------*/
/* Do not display admin bar
/*-----------------------------------------------------------------------------------*/
function my_function_admin_bar(){
    return false;
}
add_filter( 'show_admin_bar' , 'my_function_admin_bar');

/*-----------------------------------------------------------------------------------*/
/* Remove default WYSIWYG editor in Solution, RDV Live
/*-----------------------------------------------------------------------------------*/
function hide_editor() {
	if(isset($_GET['post']) || isset($_POST['post_ID'])){
    	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    }
    if( !isset( $post_id ) ) return;
    $template_file = get_post_meta($post_id, '_wp_page_template', true);
    
    if($template_file == 'live.php'){
        remove_post_type_support('page', 'editor');
    }
}
add_action( 'admin_init', 'hide_editor' );

/*-----------------------------------------------------------------------------------*/
/* WPML
/*-----------------------------------------------------------------------------------*/
// Languages Switcher
function lang_switcher(){
	if (!class_exists('SitePress')) return '';
	$languages = icl_get_languages('skip_missing=0&orderby=code&order=desc');
	$actives = '';
	if (!empty($languages)) {
    	echo '<ul id="menu-langues">';
    	foreach ($languages as $l){
        	$actives .= '<li'.($l['active']?' class="active"':'').'><a href="' . $l['url'] . '" data-lang="' . $l['language_code'] . '">' . $l['language_code'] . '</a></li>';
    	}
    	echo $actives . '</ul>';
  	}
}

// Clean WPML head
remove_action( 'wp_head', array($sitepress, 'meta_generator_tag' ) );
define('ICL_DONT_LOAD_NAVIGATION_CSS', true);
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
define('ICL_DONT_LOAD_LANGUAGES_JS', true);

/*-----------------------------------------------------------------------------------*/
/* Redirection après erreur de connexion
/*-----------------------------------------------------------------------------------*/
function custom_login_failed( $username ){
    $referrer = wp_get_referer();
    if( $referrer && ! strstr($referrer, 'wp-login') && ! strstr($referrer,'wp-admin') ){
        wp_redirect( add_query_arg('login', 'failed', $referrer) );
        exit;
    }
}
add_action( 'wp_login_failed', 'custom_login_failed' );

/*-----------------------------------------------------------------------------------*/
/* Résultats de recherche: uniquement des articles
/*-----------------------------------------------------------------------------------*/
function search_filter($query) {
  if($query->is_main_query() && $query->is_search){
    $query->set('post_type', 'post');
  }
}
add_action('pre_get_posts','search_filter');

/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/
function mysoswing_scripts()  { 

	// header
	wp_enqueue_style( 'mysoswing-style', get_template_directory_uri() . '/css/style.css', '10000', 'all' );
	wp_deregister_script('jquery');
	wp_enqueue_script( 'mysoswing-modernizr', get_template_directory_uri() . '/js/libs/modernizr-min.js', array(), MYSOSWING_VERSION);
	
	// footer
	wp_enqueue_script( 'mysoswing-jquery', get_template_directory_uri() . '/js/libs/jquery-1.11.2.min.js', array(), MYSOSWING_VERSION, true );
	wp_enqueue_script( 'mysoswing-jqueryui', get_template_directory_uri() . '/js/libs/jquery-ui.min.js', array(), MYSOSWING_VERSION, true );
	wp_enqueue_script( 'mysoswing-tweenmax', get_template_directory_uri() . '/js/libs/greensock/TweenMax.min.js', array(), MYSOSWING_VERSION, true );
	wp_enqueue_script( 'mysoswing-timeline', get_template_directory_uri() . '/js/libs/greensock/TimelineMax.min.js', array(), MYSOSWING_VERSION, true );
	wp_enqueue_script( 'mysoswing-split', get_template_directory_uri() . '/js/libs/greensock/utils/SplitText.min.js', array(), MYSOSWING_VERSION, true );
	wp_enqueue_script( 'mysoswing', get_template_directory_uri() . '/js/script.js', array(), MYSOSWING_VERSION, true );
  
}
add_action( 'wp_enqueue_scripts', 'mysoswing_scripts' );