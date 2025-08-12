<?php if ( is_active_sidebar( apply_filters( 'lsvr_pressville_sidebar_id', 'lsvr-pressville-default-sidebar' ) ) ) : ?>

	<!-- SIDEBAR : begin -->
	<aside id="sidebar">
		<div class="sidebar__inner">

			<?php dynamic_sidebar( apply_filters( 'lsvr_pressville_sidebar_id', 'lsvr-pressville-default-sidebar' ) ); ?>

		</div>
	</aside>
	<!-- SIDEBAR : end -->

<?php endif; ?>
