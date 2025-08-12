<?php if ( has_nav_menu( 'lsvr-pressville-header-menu-secondary' ) ) : ?>

	<!-- SECONDARY HEADER MENU : begin -->
	<nav class="header-menu-secondary"

		<?php if ( ! empty( lsvr_pressville_get_menu_name_by_location( 'lsvr-pressville-header-menu-secondary' ) ) ) : ?>
			 aria-label="<?php echo lsvr_pressville_get_menu_name_by_location( 'lsvr-pressville-header-menu-secondary' ); ?>"
		<?php endif; ?>>

	    <?php wp_nav_menu(
	        array(
	            'theme_location' => 'lsvr-pressville-header-menu-secondary',
				'container' => '',
				'menu_class' => 'header-menu-secondary__list',
				'fallback_cb' => '',
				'items_wrap' => '<ul id="%1$s" class="%2$s" role="menu">%3$s</ul>',
				'depth' => 1,
				'walker' => new Lsvr_Pressville_Header_Menu_Secondary_Walker(),
			)
		); ?>

	</nav>
	<!-- SECONDARY HEADER MENU : end -->

<?php endif; ?>