<?php if ( lsvr_pressville_has_event_location_address( get_the_ID() ) ) : ?>

	<!-- POST ADDRESS : begin -->
	<li class="post__info-item post__info-item--location" title="<?php echo esc_attr( esc_html__( 'Event Location', 'pressville' ) ); ?>">

		<span class="post__info-item-icon post__info-item-icon--location" aria-hidden="true"></span>

		<h3 class="post__info-item-title is-primary-font"><?php lsvr_pressville_the_event_location_linked( get_the_ID(), esc_html__( '%s', 'pressville' ) ); ?></h3>
		<p class="post__info-item-text">
			<?php lsvr_pressville_the_event_location_address( get_the_ID() ); ?>
		</p>

	</li>
	<!-- POST ADDRESS : end -->

<?php endif; ?>