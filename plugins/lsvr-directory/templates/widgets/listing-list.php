<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="widget__content lsvr_listing-list-widget__content">

	<?php if ( ! empty( $listing_posts ) ) : ?>

		<ul class="lsvr_listing-list-widget__list">

    		<?php foreach ( $listing_posts as $listing_post ) : ?>

    			<li class="lsvr_listing-list-widget__item<?php if ( has_post_thumbnail( $listing_post->ID ) ) { echo ' lsvr_listing-list-widget__item--has-thumb'; } ?>">

        			<?php // Thumbnail
        			if ( has_post_thumbnail( $listing_post->ID ) ) : ?>

        				<p class="lsvr_listing-list-widget__item-thumb">
        					<a href="<?php echo esc_url( get_permalink( $listing_post->ID ) ); ?>" class="lsvr_listing-list-widget__item-thumb-link">
        						<?php echo get_the_post_thumbnail( $listing_post->ID, 'thumbnail' ); ?>
        					</a>
        				</p>

        			<?php endif; ?>

        			<div class="lsvr_listing-list-widget__item-content">

	        			<h4 class="lsvr_listing-list-widget__item-title">
	        				<a href="<?php echo esc_url( get_permalink( $listing_post->ID ) ); ?>" class="lsvr_listing-list-widget__item-title-link">
	        					<?php echo get_the_title( $listing_post->ID ); ?>
	        				</a>
	        			</h4>

	        			<?php // Address
	        			if ( true === $show_address && ! empty( get_post_meta( $listing_post->ID, 'lsvr_listing_address', true ) ) ) : ?>

	        				<p class="lsvr_listing-list-widget__item-address" title="<?php echo esc_attr( esc_html__( 'Address', 'lsvr-directory' ) ); ?>">
	        					<?php echo nl2br( esc_html( get_post_meta( $listing_post->ID, 'lsvr_listing_address', true ) ) ); ?>
	        				</p>

	        			<?php endif; ?>

						<?php // Category
						if ( true === $show_category && lsvr_directory_has_post_terms( $listing_post->ID, 'lsvr_listing_cat' ) ) : ?>

							<p class="lsvr_listing-list-widget__item-category" title="<?php echo esc_attr( esc_html__( 'Category', 'lsvr-directory' ) ); ?>">
								<?php echo sprintf( esc_html__( 'in %s', 'lsvr-directory' ), lsvr_directory_get_post_taxonomy_html( $listing_post->ID, 'lsvr_listing_cat', '<a href="%s" class="lsvr_listing-list-widget__item-category-link">%s</a>' ) ); ?>
							</p>

						<?php endif; ?>

					</div>

    			</li>

    		<?php endforeach; ?>

		</ul>

		<?php if ( ! empty( $instance[ 'more_label' ] ) ) : ?>

			<p class="widget__more">

				<?php if ( ! empty( $instance['category'] ) && is_numeric( $instance['category'] ) ) : ?>

					<a href="<?php echo esc_url( get_term_link( (int) $instance['category'], 'lsvr_listing_cat' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>

				<?php else : ?>

					<a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_listing' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>

				<?php endif; ?>

			</p>

		<?php endif; ?>

	<?php else : ?>

		<p class="widget__no-results"><?php esc_html_e( 'There are no listings', 'lsvr-directory' ); ?></p>

	<?php endif; ?>

</div>

<?php // TEMPLATE : END
endif; ?>