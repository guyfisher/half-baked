<?php get_header(); /* WordPress Header Template */ ?>

<h2>[&nbsp;Blog&nbsp;]</h2><!-- Document Title -->

<!-- Main Content -->

<div id="main">
<?php
if (!is_paged()) { // If home page, display highlighted posts ...
	if (get_option('sticky_posts')) { // If sticky posts, get them ...
		$half_baked_highlight_posts = new WP_Query(array('post__in' => get_option('sticky_posts'), 'orderby' => 'modified'));
	}
	else $half_baked_highlight_posts = new WP_Query(array('showposts' => '1')); // Else, get most recent post
	if ($half_baked_highlight_posts) : /* Highlighted Posts Loop */
		$wp_query->in_the_loop = true; /* Tags in custom loop hack (http://wordpress.org/support/topic/178823) */
		while ($half_baked_highlight_posts->have_posts()) : $half_baked_highlight_posts->the_post(); /* Generate Highlighted Posts */
?>
	<div class="highlight"><!-- Highlighted Post -->
		<div id="post-<?php the_ID() ?>" <?php post_class() ?>>
			<h3><a href="<?php the_permalink() ?>" title="Permanent link to <?php the_title() ?>"><?php the_title() ?></a></h3>
			<div class="dateline"><?php echo(get_the_date()) ?> | <?php the_category(' and ') ?></div>
			<?php the_content('Read More &raquo;') ?>
			<div class="link-pages"><!-- Pages Navigation -->
				<?php wp_link_pages(); echo("\n"); ?>
			</div>
			<div class="tags"><?php the_tags() ?></div>
			<div class="bookmarks">
				<img class="icon" src="<?php bloginfo('template_directory') ?>/images/sanscons/document.gif" width="16" height="16" alt="" />&nbsp;<a href="<?php the_permalink() ?>" title="Permanent link to <?php the_title() ?>">Read</a>
				<?php edit_post_link('Edit', '&nbsp;&nbsp;<img class="icon" src="' . get_bloginfo('template_directory') . '/images/sanscons/edit.gif" width="16" height="16" alt="" />&nbsp;'); echo("\n") ?>
				&nbsp;&nbsp;<img class="icon" src="<?php bloginfo('template_directory') ?>/images/sanscons/comment.gif" width="16" height="16" alt="" />&nbsp;<?php comments_popup_link('No Comments', '1 Comment', '% Comments', '', 'Comments Closed'); echo("\n"); ?>
			</div>
		</div>
	</div><!-- End of Highlighted Post -->
<?php
		endwhile; /* Stop Generating Highlighted Posts */
	endif; /* End of Highlighted Posts Loop */
}
if (get_option('sticky_posts')) { // If sticky posts, exclude them ...
	query_posts(array_merge($wp_query->query_vars, array('caller_get_posts' => '1', 'post__not_in' => get_option('sticky_posts'))));
}
else if (!is_paged()) { // If home page, exclude most recent post ...
	query_posts(array_merge($wp_query->query_vars, array('offset' => '1', 'showposts' => intval(get_option('posts_per_page'))-1)));
}
if (have_posts()) : /* WordPress Loop */
	echo "\t<h3>More Posts</h3>\n";
	while (have_posts()) : the_post(); /* Generate Posts */
?>
	<div id="post-<?php the_ID() ?>" <?php post_class('excerpt') ?>>
		<h4><a href="<?php the_permalink() ?>" title="Permanent link to <?php the_title() ?>"><?php the_title() ?></a></h4>
		<div class="dateline"><?php echo(get_the_date()) ?> | <?php the_category(' and ') ?></div>
		<?php the_excerpt() ?>
		<div class="tags"><?php the_tags() ?></div>
		<div class="bookmarks">
			<img class="icon" src="<?php bloginfo('template_directory') ?>/images/sanscons/document.gif" width="16" height="16" alt="" />&nbsp;<a href="<?php the_permalink() ?>" title="Permanent link to <?php the_title() ?>">Read</a>
			<?php edit_post_link('Edit', '&nbsp;&nbsp;<img class="icon" src="' . get_bloginfo('template_directory') . '/images/sanscons/edit.gif" width="16" height="16" alt="" />&nbsp;'); echo("\n") ?>
			&nbsp;&nbsp;<img class="icon" src="<?php bloginfo('template_directory') ?>/images/sanscons/comment.gif" width="16" height="16" alt="" />&nbsp;<?php comments_popup_link('No Comments', '1 Comment', '% Comments', '', 'Comments Closed'); echo("\n"); ?>
		</div>
	</div>
<?php endwhile; /* Stop Generating Posts */ ?>
	<div id="prev-next"><!-- Posts Navigation -->
		<div class="prev"><?php previous_posts_link('&laquo; Previous Page') ?></div>
		<div class="next"><?php next_posts_link('Even More Posts &raquo;') ?></div>
	</div>
<?php endif; /* End of WordPress Loop */ ?>
</div><!-- End of Main Content -->

<?php get_sidebar(); /* WordPress Sidebar Template */ ?>

<?php get_footer(); /* WordPress Footer Template */ ?>
