<?php get_header(); /* WordPress Header Template */ ?>

<h2>[&nbsp;<?php echo(is_search() ? 'Search' : 'Archives') ?>&nbsp;]</h2><!-- Document Title -->

<!-- Main Content -->

<div id="main">
<?php if (have_posts()): /* WordPress Loop */ ?>
	<div class="highlight"><!-- Message -->
		<div class="message">
			<?php if (is_search()) { ?>
			<h3><?php the_search_query(); ?></h3>
			<p>The following posts published on <em><?php bloginfo('name') ?></em> match your search for <strong><?php the_search_query(); ?></strong>.</p>
			<?php } else if (is_date()) {
				if (is_day()) $half_baked_date = get_the_date();
				if (is_month()) $half_baked_date = get_the_date('F Y');
				if (is_year()) $half_baked_date = get_the_date('Y');
			?>
			<h3><?php echo($half_baked_date) ?></h3>
			<p>The following posts on <em><?php bloginfo('name') ?></em> were published <?php echo(is_day() ? 'on' : 'in'); ?> <strong><?php echo($half_baked_date) ?></strong>.</p>
			<?php } else if (is_category()) { ?>
			<h3><?php single_cat_title() ?></h3>
			<p>The following posts on <em><?php bloginfo('name') ?></em> were published in the <strong><?php single_cat_title() ?></strong> category.</p>
			<?php half_baked_subcategories() ?>
			<?php } else if (is_tag()) { ?>
			<h3><?php single_tag_title() ?></h3>
			<p>The following posts on <em><?php bloginfo('name') ?></em> were tagged with the keyword <strong><?php single_tag_title() ?></strong>.</p>
			<?php } else if (is_author()) {
				$half_baked_author = $wp_query->get_queried_object();
			?>
			<h3><?php echo($half_baked_author->display_name) ?></h3>
			<p>The following posts published on <em><?php bloginfo('name') ?></em> were written by <strong><?php echo($half_baked_author->display_name) ?></strong>.</p>
			<?php if ($half_baked_author->description) echo("\t\t\t<p>" . wptexturize($half_baked_author->description) . "</p>\n") ?>
			<?php } ?>
		</div>
	</div>
<?php while (have_posts()): the_post(); /* Generate Posts */ ?>
	<div id="post-<?php the_ID() ?>" <?php post_class('excerpt') ?>>
		<h4><a href="<?php the_permalink() ?>" title="Permanent link to <?php the_title() ?>"><?php the_title() ?></a></h4>
		<div class="dateline"><?php echo(get_the_date()) ?> | <?php the_category(' and '); ?></div>
		<?php the_excerpt() ?>
		<div class="tags"><?php the_tags() ?></div>
		<div class="bookmarks">
			<img class="icon" src="<?php echo(get_template_directory_uri()) ?>/images/sanscons/document.gif" width="16" height="16" alt="" />&nbsp;<a href="<?php the_permalink() ?>" title="Permanent link to <?php the_title() ?>">Read</a>
			<?php edit_post_link('Edit', '&nbsp;&nbsp;<img class="icon" src="' . get_template_directory_uri() . '/images/sanscons/edit.gif" width="16" height="16" alt="" />&nbsp;'); echo("\n") ?>
			&nbsp;&nbsp;<img class="icon" src="<?php echo(get_template_directory_uri()) ?>/images/sanscons/comment.gif" width="16" height="16" alt="" />&nbsp;<?php comments_popup_link('No Comments', '1 Comment', '% Comments', '', 'Comments Closed'); echo("\n"); ?>
		</div>
	</div>
<?php endwhile; /* Stop Generating Posts */ ?>
	<div class="prev-next"><!-- Posts Navigation -->
		<div class="prev"><?php previous_posts_link('&laquo; Previous Page') ?></div>
		<div class="next"><?php next_posts_link('More Posts &raquo;') ?></div>
	</div>
<?php else: /* No Posts */ ?>
	<div class="highlight">
		<div class="message error"><!-- Message -->
			<h3>No Matches</h3>
			<p>Sorry, none of the posts published on <em><?php bloginfo('name') ?></em> match your search for <strong><?php echo(wp_specialchars($s)) ?></strong>.</p>
		</div>
	</div>
<?php endif; /* Stop WordPress Loop */ ?>
</div><!-- End of Main Content -->

<?php get_sidebar(); /* WordPress Sidebar Template */ ?>

<?php get_footer(); /* WordPress Footer Template */ ?>