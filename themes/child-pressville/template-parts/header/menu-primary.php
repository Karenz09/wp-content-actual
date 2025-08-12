<?php if ( has_nav_menu( 'lsvr-pressville-header-menu-primary' ) ) : ?>

	<!-- HEADER MENU : begin -->
	<nav id="header-menu-primary" class="header-menu-primary"
        data-label-expand-popup="<?php echo esc_attr( esc_html__( 'Expand submenu', 'pressville' ) ); ?>"
        data-label-collapse-popup="<?php echo esc_attr( esc_html__( 'Collapse submenu', 'pressville' ) ); ?>"

		<?php if ( ! empty( lsvr_pressville_get_menu_name_by_location( 'lsvr-pressville-header-menu-primary' ) ) ) : ?>
			aria-label="<?php echo lsvr_pressville_get_menu_name_by_location( 'lsvr-pressville-header-menu-primary' ); ?>"
		<?php endif; ?>>

	    <?php wp_nav_menu(
	        array(
	            'theme_location' => 'lsvr-pressville-header-menu-primary',
				'container' => '',
				'menu_class' => 'header-menu-primary__list',
				'fallback_cb' => '',
				'items_wrap' => '<ul id="%1$s" class="%2$s" role="menu">%3$s</ul>',
				'walker' => new Lsvr_Pressville_Header_Menu_Primary_Walker(),
			)
		); ?>

	</nav>
	<!-- HEADER MENU : end -->

<?php endif; ?>