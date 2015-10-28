<!-- sidebar -->

<div id="sidebar">
	<hr />
	<h2><?php _e( 'Sidebar', 'half-baked' ); ?></h2>
	<?php if ( ! dynamic_sidebar( 'main' ) ) : /* sidebar widgets */ ?>
	<div id="pages" class="widget widget_pages">
		<h3><?php _e( 'Pages', 'half-baked' ); ?></h3>
		<?php wp_page_menu( array( 'show_home' => '1', 'sort_column' => 'menu_order' ) ); ?>
	</div>
	<div id="search" class="widget widget_search">
		<h3><?php _e( 'Search', 'half-baked' ); ?></h3>
		<?php get_search_form(); ?>
	</div>
	<div id="feeds" class="widget widget_feeds">
		<h3><?php _e( 'Feeds', 'half-baked' ); ?></h3>
		<ul>
			<li><a href="<?php bloginfo( 'rss2_url' ); ?>" title="<?php esc_attr_e( 'RSS feed for all posts', 'half-baked' ); ?>"><?php _e( 'Posts', 'half-baked' ); ?></a></li>
			<li><a href="<?php bloginfo( 'comments_rss2_url' ) ?>" title="<?php esc_attr_e( 'RSS feed for all comments', 'half-baked' ); ?>"><?php _e( 'Comments', 'half-baked' ); ?></a></li>
			<li><a href="<?php bloginfo( 'atom_url' ); ?>" title="<?php esc_attr_e( 'Atom feed for all posts', 'half-baked' ); ?>"><?php _e( 'Atom', 'half-baked' ); ?></a></li>
		</ul>
	</div>
	<?php if ( ! is_home() ) {
		$half_baked_recent_posts = new wp_query( array( 'showposts' => '5', 'ignore_sticky_posts' => '1' ) );
		if ( $half_baked_recent_posts->have_posts() ) :
	?>
	<div id="recent-posts" class="widget widget_recent_entries">
		<h3><?php _e( 'Recent Posts', 'half-baked' ); ?></h3>
		<ul>
		<?php while ( $half_baked_recent_posts->have_posts() ) : $half_baked_recent_posts->the_post(); ?>
			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php endwhile; ?>
		</ul>
	</div>
	<?php endif; }	?>
	<div id="categories" class="widget widget_categories">
		<h3><?php _e( 'Categories', 'half-baked' ); ?></h3>
		<ul>
			<?php wp_list_categories( array( 'title_li' => '', 'orderby' => 'name' ) ); ?>
		</ul>
	</div>
	<?php wp_list_bookmarks( array( 'title_before' => '<h3>', 'title_after' => '</h3>', 'category_before' => '<div class="widget widget_links">', 'category_after' => '</div>', 'category_orderby' => 'id' ) ); ?>
	<div id="meta" class="widget widget_meta">
		<h3><?php _e( 'Meta', 'half-baked' ); ?></h3>
		<?php get_template_part( 'meta' ); ?>
	</div>
	<?php endif; /* end of sidebar widgets */ ?>

	<?php wp_meta(); /* sidebar api hook */	?>

</div><!-- end of sidebar -->