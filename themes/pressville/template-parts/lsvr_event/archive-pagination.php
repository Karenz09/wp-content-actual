<?php $pagination = lsvr_pressville_get_event_archive_pagination();
if ( ! empty( $pagination ) ) : ?>

	<!-- PAGINATION : begin -->
	<nav class="post-pagination">
		<h6 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'pressville' ); ?></h6>
		<ul class="post-pagination__list">

			<?php // Prev link
			if ( ! empty( $pagination['prev'] ) ) : ?>

				<li class="post-pagination__item post-pagination__prev">
					<a href="<?php echo esc_url( $pagination['prev'] ); ?>"
						class="post-pagination__item-link">
						<?php esc_html_e( 'Previous', 'pressville' ); ?>
					</a>
				</li>

			<?php endif; ?>

			<?php // First page
			if ( ! empty( $pagination['page_first'] ) ) : ?>

				<li class="post-pagination__item post-pagination__number post-pagination__number--first<?php if ( 1 === $pagination['current_page'] ) { echo ' post-pagination__number--active'; } ?>">
					<a href="<?php echo esc_url( $pagination['page_first'] ); ?>"
						class="post-pagination__number-link"><?php esc_html_e( '1', 'pressville' ); ?></a>
				</li>

			<?php endif; ?>

			<?php // Page numbers
			if ( ! empty( $pagination['page_numbers'] ) ) : ?>

				<?php // Dots before
				if ( (int) key( $pagination['page_numbers'] ) > 2 ) : ?>

					<li class="post-pagination__item post-pagination__dots"><?php esc_html_e( '&hellip;', 'pressville' ); ?></li>

				<?php endif; ?>

				<?php // Page numbers
				foreach ( $pagination['page_numbers'] as $number => $permalink ) : ?>

					<li class="post-pagination__item post-pagination__number<?php if ( (int) $number === $pagination['current_page'] ) { echo ' post-pagination__number--active'; } ?>">
						<a href="<?php echo esc_url( $permalink ); ?>"
							class="post-pagination__number-link">
							<?php echo esc_html( $number ); ?>
						</a>
					</li>

				<?php endforeach; ?>

				<?php // Dots after
				end( $pagination['page_numbers'] );
				if ( (int) key( $pagination['page_numbers'] ) < (int) $pagination['pages_count'] - 1 ) : ?>

					<li class="post-pagination__item post-pagination__dots"><?php esc_html_e( '&hellip;', 'pressville' ); ?></li>

				<?php endif; ?>

			<?php endif; ?>

			<?php // Last page
			if ( ! empty( $pagination['page_last'] ) && ! empty( $pagination['pages_count'] ) ) : ?>

				<li class="post-pagination__item post-pagination__number post-pagination__number--last<?php if ( (int) $pagination['pages_count'] === (int) $pagination['current_page'] ) { echo ' post-pagination__number--active'; } ?>">
					<a href="<?php echo esc_url( $pagination['page_last'] ); ?>"
						class="post-pagination__number-link">
						<?php echo (int) $pagination['pages_count']; ?>
					</a>
				</li>

			<?php endif; ?>

			<?php // Next link
			if ( ! empty( $pagination['next'] ) ) : ?>

				<li class="post-pagination__item post-pagination__next">
					<a href="<?php echo esc_url( $pagination['next'] ); ?>"
						class="post-pagination__item-link">
						<?php esc_html_e( 'Next', 'pressville' ); ?>
					</a>
				</li>

			<?php endif; ?>

		</ul>
	</nav>
	<!-- PAGINATION : end -->

<?php endif; ?>