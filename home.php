<?php get_header(); /* WordPress Header Template */ ?>

<h2>[&nbsp;<?php _ex( 'Blog', 'noun', 'half-baked' ); ?>&nbsp;]</h2><!-- Document Title -->

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
			<h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permanent link to %s', 'half-baked' ), the_title( '', '', false ) ); ?>"><?php the_title(); ?></a></h3>
			<div class="dateline"><?php echo(get_the_date()) ?> | <?php the_category(', ') ?></div>
			<?php the_content( __( 'Read More &raquo;', 'half-baked' ) ); ?>
			<div class="link-pages"><!-- Pages Navigation -->
				<?php wp_link_pages(); echo("\n"); ?>
			</div>
			<div class="tags"><?php the_tags() ?></div>
			<div class="bookmarks">
				<img class="icon" src="<?php echo( get_template_directory_uri() ); ?>/images/twotone/bookmark.gif" width="16" height="16" alt="" />&nbsp;<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Read the full text of %s', 'half-baked' ), the_title( '', '', false ) ); ?>"><?php _ex( 'Read', 'verb, as in read the full post', 'half-baked' ); ?></a>
				&nbsp;&nbsp;<img class="icon" src="<?php echo( get_template_directory_uri() ); ?>/images/twotone/quote.gif" width="16" height="16" alt="" />&nbsp;<?php comments_popup_link( _x( 'Comment', 'verb, as in comment on this post', 'half-baked' ), __( '1 Comment', 'half-baked' ), __( '% Comments', 'half-baked' ), '', __( 'Comments Closed', 'half-baked' ) ); ?>
				<?php edit_post_link( _x( 'Edit', 'verb, as in to edit this post', 'half-baked' ), '&nbsp;&nbsp;<img class="icon" src="' . get_template_directory_uri() . '/images/twotone/edit.gif" width="16" height="16" alt="" />&nbsp;' ); ?>
			</div>
		</div>
	</div><!-- End of Highlighted Post -->
<?php
		endwhile; /* Stop Generating Highlighted Posts */
	endif; /* End of Highlighted Posts Loop */
}
if (get_option('sticky_posts')) { // If sticky posts, exclude them ...
	query_posts(array_merge($wp_query->query_vars, array('post__not_in' => get_option('sticky_posts'))));
}
else if (!is_paged()) { // If home page, exclude most recent post ...
	query_posts(array_merge($wp_query->query_vars, array('offset' => '1')));
}
if (have_posts()) : /* WordPress Loop */
	echo "\t<h3>" . __( 'More Posts', 'half-baked' ) . "</h3>\n";
	while (have_posts()) : the_post(); /* Generate Posts */
?>
	<div id="post-<?php the_ID() ?>" <?php post_class('excerpt') ?>>
		<h4><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permanent link to %s', 'half-baked' ), the_title( '', '', false ) ); ?>"><?php the_title(); ?></a></h4>
		<div class="dateline"><?php echo(get_the_date()) ?> | <?php the_category(', ') ?></div>
		<?php the_excerpt() ?>
		<div class="tags"><?php the_tags() ?></div>
		<div class="bookmarks">
			<img class="icon" src="<?php echo( get_template_directory_uri() ); ?>/images/twotone/bookmark.gif" width="16" height="16" alt="" />&nbsp;<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Read the full text of %s', 'half-baked' ), the_title( '', '', false ) ); ?>"><?php _ex( 'Read', 'verb, as in read the full post', 'half-baked' ); ?></a>
			&nbsp;&nbsp;<img class="icon" src="<?php echo( get_template_directory_uri() ); ?>/images/twotone/quote.gif" width="16" height="16" alt="" />&nbsp;<?php comments_popup_link( _x( 'Comment', 'verb, as in comment on this post', 'half-baked' ), __( '1 Comment', 'half-baked' ), __( '% Comments', 'half-baked' ), '', __( 'Comments Closed', 'half-baked' ) ); ?>
			<?php edit_post_link( _x( 'Edit', 'verb, as in to edit this post', 'half-baked' ), '&nbsp;&nbsp;<img class="icon" src="' . get_template_directory_uri() . '/images/twotone/edit.gif" width="16" height="16" alt="" />&nbsp;' ); ?>
		</div>
	</div>
<?php endwhile; /* Stop Generating Posts */ ?>
	<div class="prev-next"><!-- Posts Navigation -->
		<div class="prev"><?php previous_posts_link( __( '&laquo; Previous Page', 'half-baked' ) ); ?></div>
		<div class="next"><?php next_posts_link( __( 'Even More Posts &raquo;', 'half-baked' ) ); ?></div>
	</div>
<?php endif; /* End of WordPress Loop */ ?>
</div><!-- End of Main Content -->

<?php get_sidebar(); /* WordPress Sidebar Template */ ?>

<?php get_footer(); /* WordPress Footer Template */ ?>