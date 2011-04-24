<?php get_header(); /* WordPress Header Template */ ?>

<h2><?php wp_title('') ?></h2><!-- Document Title -->

<?php if (have_posts()): while (have_posts()): the_post(); /* WordPress Loop */ ?>

<!-- Single Page Meta Information -->

<div id="postmeta">
	<div class="dateline">Updated on <?php the_modified_date('l, F j, Y'); edit_post_link('<img class="icon" src="' . get_bloginfo('template_directory') . '/images/sanscons/edit.gif" width="16" height="16" alt="Edit this page" />', '&nbsp;&nbsp;'); ?></div>
</div>

<!-- Main Content -->

<div id="main" class="page">
	<?php the_content() ?>
	<div class="link-pages">
		<?php wp_link_pages(); echo("\n"); ?>
	</div>
	<?php comments_template(); /* WordPress Comments Template */ ?>
<?php endwhile; endif; /* Stop WordPress Loop */ ?>
</div><!-- End of Main Content -->

<?php get_sidebar(); /* WordPress Sidebar Template */ ?>

<?php get_footer(); /* WordPress Footer Template */ ?>