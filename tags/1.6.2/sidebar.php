<!-- Sidebar -->

<div id="sidebar">
	<hr />
	<h2>Sidebar</h2>
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar()): /* Sidebar Widgets Plugin (http://automattic.com/code/widgets/) */ ?>
	<div id="pages" class="widget widget_pages">
		<h3>Pages</h3>
		<?php if (function_exists('wswwpx_fold_page_list')) { ?>
		<ul>
			<?php wswwpx_fold_page_list('sort_column=menu_order&title_li='); /* Fold Page List Plugin (http://www.webspaceworks.com/resources/wordpress/30/) */ ?>
		</ul>
		<?php } else wp_page_menu('sort_column=menu_order&depth=1&show_home=1') ?>
	</div>
	<div id="search" class="widget">
		<h3>Search</h3>
		<?php get_search_form() ?>
	</div>
	<div id="feeds" class="widget">
		<h3>Feeds</h3>
		<ul>
			<li><a href="<?php bloginfo('rss2_url') ?>" title="RSS feed for all posts">Posts</a></li>
			<li><a href="<?php bloginfo('comments_rss2_url') ?>" title="RSS feed for all comments">Comments</a></li>
			<li><a href="<?php bloginfo('atom_url') ?>" title="Atom feed for all posts">Atom</a></li>
		</ul>
	</div>
<?php if (is_home() && (function_exists('get_flickrrss') || function_exists('netflix') || function_exists('get_scrobbler'))) { ?>
	<div id="half-baked-accordion">
		<div class="accordion_content">
			<?php if (function_exists('get_flickrrss')) { ?>
			<div id="flickrrss" class="widget">
				<h3>Flickr</h3>
				<div class="widget_content">
					<div class="scriptaculous">
						<?php get_flickrrss() /* flickrRSS Widget (http://eightface.com/wordpress/flickrrss/) */ ?>
					</div>
				</div>
			</div>
			<?php } if (function_exists('netflix')) { ?>
			<div id="netflix-widget" class="widget">
				<h3>Netflix</h3>
				<div class="widget_content">
					<div class="scriptaculous">
						<?php netflix() /* Netflix Plugin (http://www.albertbanks.com/wordpress-netflix-plugin/) */ ?>
					</div>
				</div>
			</div>
			<?php } if (function_exists('get_scrobbler')) { ?>
			<div id="scrobbler" class="widget">
				<h3>Last.fm</h3>
				<div class="widget_content">
					<div class="scriptaculous">
						<?php get_scrobbler() /* Scrobbler Widget (http://leflo.de/projekte/wordpress/scrobbler/) */ ?>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
<?php } if (is_single() && function_exists('wp_related_posts')) { ?>
	<div id="related-posts" class="widget">
		<?php wp_related_posts() /* WP Related Posts Plugin (http://fairyfish.net/2007/09/12/wordpress-23-related-posts-plugin/) */ ?>
	</div>
<?php
}
else if (!is_home()) {
		$half_baked_recent_posts = new WP_Query(array('showposts' => '5', 'ignore_sticky_posts' => '1'));
		if ($half_baked_recent_posts->have_posts()) :
?>
	<div id="recent-posts" class="widget">
		<h3>Recent Posts</h3>
		<ul>
		<?php while ($half_baked_recent_posts->have_posts()) : $half_baked_recent_posts->the_post(); ?>
			<li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
		<?php endwhile; ?>
		</ul>
	</div>
<?php
		endif;
}
?>
	<div id="categories" class="widget widget_categories">
		<h3>Categories</h3>
		<ul>
			<?php
			if (function_exists('wswwpx_fold_category_list')) {
				wswwpx_fold_category_list('title_li=&orderby=name'); /* Fold Category List Plugin (http://www.webspaceworks.com/resources/wordpress/31/) */
			}
			else wp_list_categories('title_li=&orderby=name');
			?>
		</ul>
	</div>
<?php
if (is_home()) {
	wp_list_bookmarks('category_orderby=id&title_before=<h3>&title_after=</h3>&category_before=<div class="widget links">&category_after=</div>');
}
?>
	<div id="meta" class="widget">
		<h3>Meta</h3>
		<?php include TEMPLATEPATH . '/meta.php'; ?>
	</div>
<?php endif; /* End of Sidebar Widgets */?>

	<?php wp_meta(); /* Sidebar API Hook */ ?>

</div><!-- End of Sidebar -->
