	<footer role="contentinfo">
		<div id="top-footer">
		  	<div class="container clearfix">
		  		<?php dynamic_sidebar( 'footer' ); ?>
		  		<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'container' => '', 'menu_id' => 'menu-footer', 'menu_class' => 'align-right') ); ?>
		  	</div>
		</div>
		<div id="bottom-footer"></div>
	</footer>

	<?php wp_footer(); ?>

	</body>
</html>