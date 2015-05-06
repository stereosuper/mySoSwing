<form role="search" method="get" class="searchform" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<fieldset>
		<input type="search" name="s" class="searchInput" id="searchInput" value="<?php the_search_query(); ?>" placeholder="<?php _e('Rechercher', 'mysoswing'); ?>" /><input type="submit" class="btn searchSubmit" id="search" value="&#xe601;"/>
	</fieldset>
</form>