			<p><?php bloginfo( 'name' ); ?> is&nbsp;powered&nbsp;by <a href="http://wordpress.org/">WordPress</a>&nbsp;and&nbsp;<a href="http://wordpress.org/extend/themes/half-baked" title="Half-Baked WordPress Theme">Half-Baked</a></p>
			<p class="login">[ <?php wp_register( '', ' | ' ); wp_loginout(); ?> ]</p>
			<ul><?php wp_meta(); /* meta api hook */ ?></ul>