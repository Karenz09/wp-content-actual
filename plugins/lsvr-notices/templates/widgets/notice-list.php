<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="widget__content">

	<?php if ( ! empty( $notice_posts ) ) : ?>

		<ul class="lsvr_notice-list-widget__list">

    		<?php foreach ( $notice_posts as $notice_post ) : ?>

    			<li class="lsvr_notice-list-widget__item">

        			<h4 class="lsvr_notice-list-widget__item-title">
        				<a href="<?php echo esc_url( get_permalink( $notice_post->ID ) ); ?>" class="lsvr_notice-list-widget__item-title-link">
        					<?php echo get_the_title( $notice_post->ID ); ?>
        				</a>
        			</h4>

        			<?php if ( ( true === $show_date ) ||
						( true === $show_category && lsvr_notices_has_post_terms( $notice_post->ID, 'lsvr_notice_cat' ) ) ) : ?>

						<ul class="lsvr_notice-list-widget__item-meta">

							<?php // Date
							if ( true === $show_date ) : ?>

								<li class="lsvr_notice-list-widget__item-meta-item lsvr_notice-list-widget__item-meta-item--date">
									<?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $notice_post->post_date ) ) ); ?>
								</li>

							<?php endif; ?>

							<?php // Category
							if ( true === $show_category && lsvr_notices_has_post_terms( $notice_post->ID, 'lsvr_notice_cat' ) ) : ?>

								<li class="lsvr_notice-list-widget__item-meta-item lsvr_notice-list-widget__item-meta-item--category">
									<?php echo sprintf( esc_html__( 'in %s', 'lsvr-notices' ), lsvr_notices_get_post_taxonomy_html( $notice_post->ID, 'lsvr_notice_cat', '<a href="%s" class="lsvr_notice-list-widget__item-category-link">%s</a>' ) ); ?>
								</li>

							<?php endif; ?>

						</ul>

					<?php endif; ?>

    			</li>

    		<?php endforeach; ?>

		</ul>

		<?php if ( ! empty( $instance[ 'more_label' ] ) ) : ?>

			<p class="widget__more">

				<?php if ( ! empty( $instance['category'] ) && is_numeric( $instance['category'] ) ) : ?>

					<a href="<?php echo esc_url( get_term_link( (int) $instance['category'], 'lsvr_notice_cat' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>

				<?php else : ?>

					<a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_notice' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>

				<?php endif; ?>

			</p>

		<?php endif; ?>

	<?php else : ?>

		<p class="widget__no-results"><?php esc_html_e( 'There are no notices', 'lsvr-notices' ); ?></p>

	<?php endif; ?>

</div>

<?php // TEMPLATE : END
endif; ?>