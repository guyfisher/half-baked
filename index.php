<?php get_header(); /* WordPress Header Template */ ?>

<h2>[&nbsp;<?php echo( is_search() ? __( 'Search Results', 'half-baked' ) : __( 'Archives', 'half-baked' ) ); ?>&nbsp;]</h2><!-- Document Title -->

<!-- Main Content -->

<div id="main">
<?php if (have_posts()): /* WordPress Loop */ ?>
	<div class="highlight"><!-- Message -->
		<div class="message">
			<?php if ( is_search() ) { ?>
				<h3><?php the_search_query(); ?></h3>
				<p><?php printf( __( 'The following posts published on %1$s match your search for %2$s.', 'half-baked' ), '<em>' . get_bloginfo() . '</em>', '<strong>' . get_search_query() . '</strong>' ); ?></p>
			<?php } else if ( is_date() ) { ?>
				<?php if ( is_day() ) { ?>
					<h3><?php echo( get_the_date() ); ?></h3>
					<p><?php printf( _x( 'The following posts on %1$s were published on %2$s.', 'posts published on a specific date', 'half-baked' ), '<em>' . get_bloginfo() . '</em>', '<strong>' . get_the_date() . '</strong>' ); ?></p>
				<?php } if ( is_month() ) { ?>
					<h3><?php echo( get_the_date( 'F Y' ) ); ?></h3>
					<p><?php printf( _x( 'The following posts on %1$s were published in %2$s.', 'posts published during a specific month', 'half-baked' ), '<em>' . get_bloginfo() . '</em>', '<strong>' . get_the_date( 'F Y' ) . '</strong>' ); ?></p>
				<?php } if ( is_year() ) { ?>
					<h3><?php echo( get_the_date( 'Y' ) ); ?></h3>
					<p><?php printf( _x( 'The following posts on %1$s were published in %2$s.', 'posts published during a specific year', 'half-baked' ), '<em>' . get_bloginfo() . '</em>', '<strong>' . get_the_date( 'Y' ) . '</strong>' ); ?></p>
				<?php } ?>
			<?php } else if ( is_category() ) { ?>
				<h3><?php single_cat_title(); ?></h3>
				<p><?php printf( __( 'The following posts on %1$s were published in the %2$s category.', 'half-baked' ), '<em>' . get_bloginfo() . '</em>', '<strong>' . single_cat_title( '', false ) . '</strong>' ); ?></p>
				<?php half_baked_subcategories(); ?>
			<?php } else if ( is_tag() ) { ?>
				<h3><?php single_tag_title(); ?></h3>
				<p><?php printf( __( 'The following posts on %1$s were tagged with the keyword %2$s.', 'half-baked' ), '<em>' . get_bloginfo() . '</em>', '<strong>' . single_tag_title( '', false ) . '</strong>' ); ?></p>
			<?php } else if ( is_author() ) {
				$half_baked_author = $wp_query->get_queried_object();
			?>
				<h3><?php echo( $half_baked_author->display_name ); ?></h3>
				<p><?php printf( __( 'The following posts published on %1$s were written by %2$s.', 'half-baked' ), '<em>' . get_bloginfo() . '</em>', '<strong>' . $half_baked_author->display_name . '</strong>' ); ?></p>
				<?php if ( $half_baked_author->description ) echo( "\t\t\t<p>" . wptexturize( $half_baked_author->description ) . "</p>\n" ); ?>
			<?php } ?>
		</div>
	</div>
<?php while (have_posts()): the_post(); /* Generate Posts */ ?>
	<div id="post-<?php the_ID() ?>" <?php post_class('excerpt') ?>>
		<h4><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permanent link to %s', 'half-baked' ), the_title( '', '', false ) ); ?>"><?php the_title(); ?></a></h4>
		<div class="dateline"><?php echo(get_the_date()) ?> | <?php the_category(', '); ?></div>
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
		<div class="next"><?php next_posts_link( __( 'More Posts &raquo;', 'half-baked' ) ); ?></div>
	</div>
<?php else: /* No Posts */ ?>
	<div class="highlight">
		<div class="message error"><!-- Message -->
			<h3><?php _e( 'No Matches', 'half-baked' ); ?></h3>
			<p><?php printf( __( 'Sorry, none of the posts published on %1$s match your search for %2$s.', 'half-baked' ), '<em>' . get_bloginfo() . '</em>', '<strong>' . esc_html( $s ) . '</strong>' ); ?></p>
		</div>
	</div>
<?php endif; /* Stop WordPress Loop */ ?>
</div><!-- End of Main Content -->

<?php get_sidebar(); /* WordPress Sidebar Template */ ?>

<?php get_footer(); /* WordPress Footer Template */ ?>