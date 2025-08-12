<?php if ( lsvr_pressville_has_person_social_links( get_the_ID() ) ) : ?>

	<ul class="post__social-list" aria-label="<?php echo esc_attr( esc_html__( 'Social Media Links', 'pressville' ) ); ?>">

		<?php // Add custom code at the top of social links
		do_action( 'lsvr_pressville_person_social_top' ); ?>

		<?php foreach ( lsvr_pressville_get_person_social_links( get_the_ID() ) as $profile => $fields ) : ?>

			<li class="post__social-item">

				<a href="<?php echo esc_url( $fields['url'] ); ?>" class="post__social-link" target="_blank"
					<?php echo ! empty( $fields['label'] ) ? ' title="' . esc_attr( $fields['label'] ) .'"' : ''; ?>>
					<span class="post__social-icon lsvr_person-social-icon lsvr_person-social-icon--<?php echo esc_attr( $profile ); echo ! empty( $fields['icon'] ) ? ' ' . esc_attr( $fields['icon'] ) : '';  ?>"
						aria-hidden="true">

						<?php if ( ! empty( $fields['label'] ) ) : ?>

							<span class="screen-reader-text"><?php echo esc_html( $fields['label'] ); ?></span>

						<?php endif; ?>

					</span>
				</a>

			</li>

		<?php endforeach; ?>

		<?php // Add custom code at the bottom of social links
		do_action( 'lsvr_pressville_person_social_bottom' ); ?>

	</ul>

<?php endif; ?>