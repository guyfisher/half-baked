<?php
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'Please don\'t load this page directly. Thanks!' );
}
if ( post_password_required() ) {
	return;
}
if ( have_comments() ) {
?>
	<h3 id="comments"><?php comments_number(); ?></h3>
	<ol class="commentlist">
		<?php wp_list_comments( array( 'style' => 'ol', 'callback' => 'half_baked_start_el' ) ); ?>
	</ol>
	<div class="prev-next">
		<div class="prev"><?php previous_comments_link(); ?></div>
		<div class="next"><?php next_comments_link(); ?></div>
	</div>
<?php
}
comment_form();
?>