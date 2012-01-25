<hr>

</div><!-- End of Content Container -->

<!-- Running Foot -->

<div id="foot">
	<?php half_baked_about() ?>
	<?php wp_footer(); echo("\n"); /* Plugin API Hook */ ?>
</div><!-- End of Running Foot -->

<?php echo("<!-- $wpdb->num_queries Queries ("); timer_stop(1); echo(" sec.) -->\n"); ?>

</body>

</html>
