<?php get_header(); /* WordPress Header Template */ ?>

<h2><?php wp_title('') ?></h2><!-- Document Title -->

<?php if (have_posts()): while (have_posts()): the_post(); /* WordPress Loop */ ?>

<!-- Single Post Meta Information -->

<div id="postmeta">
	<div class="dateline">Published on <?php the_time('l, F j, Y') ?>&nbsp;&nbsp;<?php edit_post_link('<img class="icon" src="' . get_bloginfo('template_directory') . '/images/sanscons/edit.gif" width="16" height="16" alt="Edit this post" />', '', '&nbsp;|&nbsp;');?><a id="postmeta_toggle" href="#postmeta_slider" title="More information about this post"><img class="icon" src="<?php bloginfo('template_directory') ?>/images/sanscons/arrow2_s.gif" width="16" height="16" alt="" /></a></div>
	<div id="postmeta_slider">
		<div class="scriptaculous">
			<dl>
				<dt>Author</dt>
				<dd>Posted by <?php the_author_posts_link() ?> at <?php the_time('g:i A T') ?></dd>
				<?php if (get_the_category()) { ?>
				<dt>Category</dt>
				<dd>Filed under <?php the_category(' and ') ?></dd>
				<?php } if (get_the_tags()) { ?>
				<dt>Keywords</dt>
				<dd><?php the_tags('Tagged with ') ?></dd>
				<?php } ?>
			</dl>
		</div>
	</div>
</div>

<!-- Main Content -->

<div id="main" class="single">
	<?php the_content(); ?>
	<div class="link-pages"><!-- Pages Navigation -->
		<?php wp_link_pages(); echo("\n"); ?>
	</div>
	<?php comments_template(); /* WordPress Comments Template */ ?>
<?php endwhile; /* Stop Generating Post */ ?>
	<div id="prev-next"><!-- Posts Navigation -->
		<div class="prev"><?php previous_post_link('%link', '&laquo; %title') ?></div>
		<div class="next"><?php next_post_link('%link', '%title &raquo;') ?></div>
	</div>
<?php endif; /* Stop WordPress Loop */ ?>
</div><!-- End of Main Content -->

<?php get_sidebar(); /* WordPress Sidebar Template */ ?>

<?php get_footer(); /* WordPress Footer Template */ ?>