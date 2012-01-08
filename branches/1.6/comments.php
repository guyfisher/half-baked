<?php

/* Do not delete this code block! */

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
	die ('Please do not load this page directly. Thanks!');
}
if (post_password_required()) {
?>
	<p class="nocomments">This post is password protected. Please enter the password to view comments.</p>
<?php
	return;
}

/* You can start editing here. */

if ($comments): /* Start Comments Loop */
?>
	<div id="comments"><!-- Comments -->
<?php
	$half_baked_comments = half_baked_comments($comments); // Split comments and trackbacks
	if (count($half_baked_comments['comments']) > 0) { /* Comments Subloop */
		$comment_count = count($half_baked_comments['comments']);
?>
		<h3><?php echo($comment_count == 1 ? '1 Comment' : "$comment_count Comments") ?></h3>
<?php
		foreach ($half_baked_comments['comments'] as $comment): /* Generate Comments */
?>
		<div id="comment-<?php comment_ID() ?>" <?php comment_class('excerpt') ?>>
			<h4>Comment by <?php comment_author() ?></h4>
			<div class="dateline"><?php comment_date(); if ($comment->comment_author_url) comment_author_url_link('', ' | ', ' &raquo;'); ?></div>
			<div class="avatar"><?php echo(get_avatar($comment, '32')); ?></div>
			<?php comment_text() ?>
			<div class="bookmarks">
				<img class="icon" src="<?php echo(get_template_directory_uri()) ?>/images/sanscons/document.gif" width="16" height="16" alt="" />&nbsp;<a href="#comment-<?php comment_ID() ?>" title="Permanent link to this comment">Bookmark</a>
				&nbsp;&nbsp;<?php edit_comment_link('Edit', '<img class="icon" src="' . get_template_directory_uri() . '/images/sanscons/edit.gif" width="16" height="16" alt="" />&nbsp;'); echo("\n"); ?>
			</div>
		</div>
<?php
	endforeach; /* Stop Generating Comments */
	}
	if (count($half_baked_comments['trackbacks']) > 0) { /* Trackbacks Subloop */
?>
		<h3>Trackbacks</h3>
		<ol id="trackbacks">
<?php
		foreach ($half_baked_comments['trackbacks'] as $comment) { /* Generate Trackbacks */
?>
			<li id="comment-<?php comment_ID() ?>"><?php comment_author_link() ?></li>
<?php
		}
?>
		</ol>
<?php
	}
?>
	</div><!-- End of Comments -->
<?php
endif; /* End of Comments Loop */
comment_form();
?>