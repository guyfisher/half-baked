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
if ($post->comment_status == 'open'): /* If comments open, display comment form ... */
?>
	<form id="commentform" action="<?php echo(get_option('siteurl')) ?>/wp-comments-post.php" method="post"><!-- Comment Form -->
		<div class="box">
			<h3 id="respond">Leave a Comment</h3>
			<fieldset class="input">
				<?php if (get_option('comment_registration') && !$user_ID) { /* If registration required, display notice ... */ ?>
				<p>You must be logged in to post a comment. [ <a href="<?php echo(get_option('siteurl')) ?>/wp-login.php?redirect_to=<?php echo(urlencode(get_permalink())) ?>">Log In</a> ]</p>
				<?php } if ($user_ID) { /* If user logged in, display user identity ... */ ?>
				<p>You are logged in as <a href="<?php echo(get_option('siteurl')) ?>/wp-admin/profile.php" title="WordPress User Profile"><?php echo($user_identity) ?></a>. [ <a href="<?php echo(wp_logout_url(get_permalink())) ?>">Log Out</a> ]</p>
				<?php } else { /* Else, display user inputs ... */ ?>
				<div><input type="text" id="author" name="author" value="<?php echo($comment_author) ?>" /> <label for="author">Name</label></div>
				<div><input type="text" id="email" name="email" value="<?php echo($comment_author_email) ?>" /> <label for="email">E-mail</label></div>
				<div><input type="text" id="url" name="url" value="<?php echo($comment_author_url) ?>" /> <label for="url">Website</label></div>
				<p><em><?php if ($req) echo('Name and e-mail address are required. ') ?>Your e-mail address will not be dislayed with your comment.</em></p>
				<?php } ?>
			</fieldset>
			<fieldset class="textarea">
				<div><textarea id="comment" name="comment" cols="40" rows="10"></textarea></div>
			</fieldset>
			<input type="submit" id="submit" name="submit" value="Submit Comment" />
			<input type="hidden" name="comment_post_ID" value="<?php echo($id) ?>" />
			<div class="bookmarks">
				<img class="icon" src="<?php echo(get_template_directory_uri()) ?>/images/sanscons/wifi.gif" width="16" height="16" alt="" />&nbsp;<?php post_comments_feed_link('Comments Feed'); echo("\n"); ?>
				<?php if ($post->ping_status == 'open') { /* If pings allowed, display trackback link ... */ ?>
				&nbsp;&nbsp;<img class="icon" src="<?php echo(get_template_directory_uri()) ?>/images/sanscons/trackback.gif" width="16" height="16" alt="" />&nbsp;<a href="<?php trackback_url() ?>" title="Trackback URL for <?php the_title() ?>">Trackback</a>
				<!-- <?php trackback_rdf() ?> -->
				<?php } ?>
			</div>

			<?php do_action('comment_form', $post->ID); /* Comment Form API Hook */ ?>

		</div>
	</form><!-- End of Comment Form -->
<?php endif; ?>