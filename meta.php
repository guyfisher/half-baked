			<p><?php printf( __( '%1$s is powered by %2$s and %3$s', 'half-baked' ), get_bloginfo(), '<a href="http://wordpress.org/">WordPress</a>', '<a href="http://wordpress.org/extend/themes/half-baked">Half-Baked</a>' ); ?></p>
			<p class="login">[ <?php wp_register( '', ' | ' ); wp_loginout(); ?> ]</p>
			<ul><?php wp_meta(); /* meta api hook */ ?></ul>