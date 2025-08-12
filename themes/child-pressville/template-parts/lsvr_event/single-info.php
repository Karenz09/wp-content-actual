<?php // Ended event
if ( ! lsvr_pressville_has_next_event_occurrences( get_the_ID() ) ) : ?>

	<p class="post__status post__status--ended">
		<?php esc_html_e( 'This event has ended', 'pressville' ); ?>
	</p>

<?php elseif ( lsvr_pressville_is_recurring_event( get_the_ID() ) && lsvr_pressville_has_next_event_occurrences( get_the_ID() ) ) : ?>

	<h2 class="post__next-date-title is-primary-font"><?php esc_html_e( 'Next Date', 'pressville' ); ?></h2>

<?php endif; ?>

<!-- POST INFO : begin -->
<ul class="post__info<?php if ( lsvr_pressville_is_multiday_event( get_the_ID() ) ) { echo ' post__info--multiday'; } else { echo ' post__info--singleday'; } ?>">

	<?php // Date
	get_template_part( 'template-parts/lsvr_event/single-date' ); ?>

	<?php // Address
	get_template_part( 'template-parts/lsvr_event/single-address' ); ?>

</ul>
<!-- POST INFO : end -->