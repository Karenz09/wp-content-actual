<?php if ( lsvr_pressville_has_person_contact_info( get_the_ID() ) ) : ?>

	<ul class="post__contact" aria-label="<?php echo esc_attr( esc_html__( 'Contact Information', 'pressville' ) ); ?>">

		<?php // Add custom code at the top of person contact info
		do_action( 'lsvr_pressville_person_contact_info_top' ); ?>

		<?php foreach ( lsvr_pressville_get_person_contact_info( get_the_ID() ) as $profile => $fields ) : ?>

			<li class="post__contact-item post__contact-item--<?php echo esc_attr( $profile ); ?>"
				<?php if ( ! empty( $fields['title'] ) ) { echo ' title="' . esc_attr( $fields['title'] ) . '"'; } ?>>

				<span class="post__contact-item-icon post__contact-item-icon--<?php echo esc_attr( $profile ); echo ! empty( $fields['icon'] ) ? ' ' . esc_attr( $fields['icon'] ) : ''; ?>"
					aria-hidden="true"></span>

				<?php echo wp_kses( $fields['label'], array(
					'a' => array(
						'href' => array(),
						'target' => array(),
						'title' => array(),
					),
					'strong' => array(),
					'span' => array(
						'class' => array(),
						'style' => array(),
					),
				)); ?>

			</li>

		<?php endforeach; ?>

		<?php // Add custom code at the bottom of person contact info
		do_action( 'lsvr_pressville_person_contact_info_bottom' ); ?>

	</ul>

<?php endif; ?>