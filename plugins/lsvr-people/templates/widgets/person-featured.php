<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="widget__content lsvr_person-featured-widget__content">

	<?php if ( ! empty( $person_post ) ) : ?>

		<div class="lsvr_person-featured-widget__wrapper<?php if ( has_post_thumbnail( $person_post->ID ) ) { echo ' lsvr_person-featured-widget__wrapper--has-thumb'; } ?>">

			<?php // Thumbnail
			if ( has_post_thumbnail( $person_post->ID ) ) : ?>

				<p class="lsvr_person-featured-widget__thumb">
					<a href="<?php echo esc_url( get_permalink( $person_post->ID ) ); ?>" class="lsvr_person-featured-widget__thumb-link">
						<?php echo get_the_post_thumbnail( $person_post->ID, 'thumbnail' ); ?>
					</a>
				</p>

			<?php endif; ?>

			<h4 class="lsvr_person-featured-widget__title">
				<a href="<?php echo esc_url( get_permalink( $person_post->ID ) ); ?>" class="lsvr_person-featured-widget__title-link">
					<?php echo get_the_title( $person_post->ID ); ?>
				</a>
			</h4>

			<?php // Role
			if ( ! empty( get_post_meta( $person_post->ID, 'lsvr_person_role', true ) ) ) : ?>

				<p class="lsvr_person-featured-widget__subtitle">
					<?php echo wp_kses( get_post_meta( $person_post->ID, 'lsvr_person_role', true ),
						array(
							'a' => array(
								'href' => array(),
							),
							'br' => array(),
							'strong' => array(),
					)); ?>
				</p>

			<?php endif; ?>

			<?php // Excerpt
			if ( true === $show_excerpt && has_excerpt( $person_post->ID ) ) : ?>

				<div class="lsvr_person-featured-widget__excerpt">
					<?php echo wpautop( get_the_excerpt( $person_post->ID ) ); ?>
				</div>

			<?php endif; ?>

			<?php // Social links
			if ( true === $show_social ) : ?>

    			<?php $social_links = lsvr_people_get_person_social_links( $person_post->ID ); ?>
    			<?php if ( ! empty( $social_links ) ) : ?>

    				<ul class="lsvr_person-featured-widget__social" title="<?php echo esc_attr( esc_html__( 'Social Media Links', 'lsvr-people' ) ); ?>">

    					<?php foreach ( $social_links as $profile => $fields ) : ?>

    						<li class="lsvr_person-featured-widget__social-item">
    							<a href="<?php echo esc_url( $fields['url'] ); ?>" class="lsvr_person-featured-widget__social-link" target="_blank"
    								<?php echo ! empty( $fields['label'] ) ? ' title="' . esc_attr( $fields['label'] ) .'"' : ''; ?>>
    								<span class="lsvr_person-featured-widget__social-icon lsvr_person-social-icon lsvr_person-social-icon--<?php echo esc_attr( $profile ); echo ! empty( $fields['icon'] ) ? ' ' . esc_attr( $fields['icon'] ) : '';  ?>"
    									aria-hidden="true">

										<?php if ( ! empty( $fields['label'] ) ) : ?>

											<span class="screen-reader-text"><?php echo esc_html( $fields['label'] ); ?></span>

										<?php endif; ?>

    								</span>
    							</a>
    						</li>

    					<?php endforeach; ?>

    				</ul>

    			<?php endif; ?>

    		<?php endif; ?>

		</div>

		<?php if ( ! empty( $instance[ 'more_label' ] ) ) : ?>

			<p class="widget__more">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_person' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>
			</p>

		<?php endif; ?>

	<?php else : ?>

		<p class="widget__no-results"><?php esc_html_e( 'Please choose a person to display', 'lsvr-people' ); ?></p>

	<?php endif; ?>

</div>

<?php // TEMPLATE : END
endif; ?>