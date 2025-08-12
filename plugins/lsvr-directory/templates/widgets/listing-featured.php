<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="widget__content lsvr_listing-featured-widget__content">

	<?php if ( ! empty( $listing_post ) ) : ?>

		<?php // Thumbnail
		if ( has_post_thumbnail( $listing_post->ID ) ) : ?>

			<p class="lsvr_listing-featured-widget__thumb">
				<a href="<?php echo esc_url( get_permalink( $listing_post->ID ) ); ?>" class="lsvr_listing-featured-widget__thumb-link">
					<?php echo get_the_post_thumbnail( $listing_post->ID, 'medium' ); ?>
				</a>
			</p>

		<?php endif; ?>

        <div class="lsvr_listing-featured-widget__content-inner">

			<h4 class="lsvr_listing-featured-widget__title">
				<a href="<?php echo esc_url( get_permalink( $listing_post->ID ) ); ?>" class="lsvr_listing-featured-widget__title-link">
					<?php echo get_the_title( $listing_post->ID ); ?>
				</a>
			</h4>

			<?php // Address
			if ( true === $show_address && ! empty( get_post_meta( $listing_post->ID, 'lsvr_listing_address', true ) ) ) : ?>

				<p class="lsvr_listing-featured-widget__address" title="<?php echo esc_attr( esc_html__( 'Address', 'lsvr-directory' ) ); ?>">
					<?php echo nl2br( esc_html( get_post_meta( $listing_post->ID, 'lsvr_listing_address', true ) ) ); ?>
				</p>

			<?php endif; ?>

            <?php // Category
            if ( true === $show_category && lsvr_directory_has_post_terms( $listing_post->ID, 'lsvr_listing_cat' ) ) : ?>

                <p class="lsvr_listing-featured-widget__category" title="<?php echo esc_attr( esc_html__( 'Category', 'lsvr-directory' ) ); ?>">
                    <?php echo sprintf( esc_html__( 'in %s', 'lsvr-directory' ), lsvr_directory_get_post_taxonomy_html( $listing_post->ID, 'lsvr_listing_cat', '<a href="%s" class="lsvr_listing-featured-widget__category-link">%s</a>' ) ); ?>
                </p>

            <?php endif; ?>

            <?php // Excerpt
            if ( true === $show_excerpt && has_excerpt( $listing_post->ID ) ) : ?>

                <div class="lsvr_listing-featured-widget__excerpt">
                    <?php echo wpautop( get_the_excerpt( $listing_post->ID ) ); ?>
                </div>

            <?php endif; ?>

            <?php if ( ! empty( $instance[ 'more_label' ] ) ) : ?>

                <p class="widget__more">
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_listing' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>
                </p>

            <?php endif; ?>

		</div>

	<?php else : ?>

		<p class="widget__no-results"><?php esc_html_e( 'There are no listings', 'lsvr-directory' ); ?></p>

	<?php endif; ?>

</div>

<?php // TEMPLATE : END
endif; ?>