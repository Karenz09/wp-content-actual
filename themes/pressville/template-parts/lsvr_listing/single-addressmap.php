<!-- POST ADDRESS & MAP : begin -->
<div class="post__addressmap">

	<div class="post__addressmap-inner">

		<h2 class="post__addressmap-title"><?php esc_html_e( 'Address', 'pressville' ); ?></h2>
		<p class="post__addressmap-address">
			<?php lsvr_pressville_the_listing_address( get_the_ID() ); ?>
		</p>

		<?php if ( lsvr_pressville_has_listing_map_link( get_the_ID() ) ) : ?>

			<p class="post__addressmap-link-wrapper">
				<a href="<?php echo esc_url( lsvr_pressville_get_listing_map_link( get_the_ID() ) ); ?>" class="post__addressmap-link"
					target="_blank"><?php esc_html_e( 'Open in Google Maps', 'pressville' ); ?></a>
			</p>

		<?php endif; ?>

	</div>

	<?php // Map
	get_template_part( 'template-parts/lsvr_listing/single-map' ); ?>

</div>
<!-- POST ADDRESS & MAP : end -->