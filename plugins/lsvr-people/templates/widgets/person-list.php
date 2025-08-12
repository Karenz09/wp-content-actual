<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="widget__content">

	<?php if ( ! empty( $person_posts ) ) : ?>

		<ul class="lsvr_person-list-widget__list">

    		<?php foreach ( $person_posts as $person_post ) : ?>

    			<li class="lsvr_person-list-widget__item<?php if ( has_post_thumbnail( $person_post->ID ) ) { echo ' lsvr_person-list-widget__item--has-thumb'; } ?>">
    				<div class="lsvr_person-list-widget__item-inner">

	        			<?php // Thumbnail
	        			if ( has_post_thumbnail( $person_post->ID ) ) : ?>

	        				<p class="lsvr_person-list-widget__item-thumb">
	        					<a href="<?php echo esc_url( get_permalink( $person_post->ID ) ); ?>" class="lsvr_person-list-widget__item-thumb-link">
	        						<?php echo get_the_post_thumbnail( $person_post->ID, 'thumbnail' ); ?>
	        					</a>
	        				</p>

	        			<?php endif; ?>

	        			<h4 class="lsvr_person-list-widget__item-title">
	        				<a href="<?php echo esc_url( get_permalink( $person_post->ID ) ); ?>" class="lsvr_person-list-widget__item-title-link">
	        					<?php echo get_the_title( $person_post->ID ); ?>
	        				</a>
	        			</h4>

	        			<?php // Role
	        			if ( ! empty( get_post_meta( $person_post->ID, 'lsvr_person_role', true ) ) ) : ?>

	        				<p class="lsvr_person-list-widget__item-subtitle">
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

						<?php // Social links
						$social_links = lsvr_people_get_person_social_links( $person_post->ID );
						if ( true === $show_social && ! empty( $social_links ) ) : ?>

							<ul class="lsvr_person-list-widget__item-social" title="<?php echo esc_attr( esc_html__( 'Social Media Links', 'lsvr-people' ) ); ?>">

	        					<?php foreach ( $social_links as $profile => $fields ) : ?>

	        						<li class="lsvr_person-list-widget__item-social-item">
	        							<a href="<?php echo esc_url( $fields['url'] ); ?>" class="lsvr_person-list-widget__item-social-link" target="_blank"
	        								<?php echo ! empty( $fields['label'] ) ? ' title="' . esc_attr( $fields['label'] ) .'"' : ''; ?>>
	        								<span class="lsvr_person-list-widget__item-social-icon lsvr_person-social-icon lsvr_person-social-icon--<?php echo esc_attr( $profile ); echo ! empty( $fields['icon'] ) ? ' ' . esc_attr( $fields['icon'] ) : '';  ?>"
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

					</div>
    			</li>

    		<?php endforeach; ?>

		</ul>

		<?php if ( ! empty( $instance[ 'more_label' ] ) ) : ?>

			<p class="widget__more">

				<?php if ( ! empty( $instance['category'] ) && is_numeric( $instance['category'] ) ) : ?>

					<a href="<?php echo esc_url( get_term_link( (int) $instance['category'], 'lsvr_person_cat' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>

				<?php else : ?>

					<a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_person' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>

				<?php endif; ?>

			</p>

		<?php endif; ?>

	<?php else : ?>

		<p class="widget__no-results"><?php esc_html_e( 'There are no people', 'lsvr-people' ); ?></p>

	<?php endif; ?>

</div>

<?php // TEMPLATE : END
endif; ?>