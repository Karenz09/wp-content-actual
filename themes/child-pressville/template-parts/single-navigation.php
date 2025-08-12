<?php if ( true === apply_filters( 'lsvr_pressville_post_single_navigation_enable', false ) &&
	( lsvr_pressville_has_previous_post() || lsvr_pressville_has_next_post() ) ) : ?>

	<!-- POST NAVIGATION : begin -->
	<div class="post-navigation">

		<ul class="post-navigation__list">

			<?php if ( lsvr_pressville_has_previous_post() ) : ?>

				<!-- PREVIOUS POST : begin -->
				<li class="post-navigation__prev">
					<div class="post-navigation__prev-inner">

						<h2 class="post-navigation__title">
							<a href="<?php echo esc_url( lsvr_pressville_get_previous_post_url() ); ?>"
								class="post-navigation__title-link">
								<?php esc_html_e( 'Previous', 'pressville' ); ?>
							</a>
						</h2>

						<a href="<?php echo esc_url( lsvr_pressville_get_previous_post_url() ); ?>"
							class="post-navigation__link">
							<?php echo esc_html( lsvr_pressville_get_previous_post_title() ); ?>
						</a>

					</div>
				</li>
				<!-- PREVIOUS POST : end -->

			<?php endif; ?>

			<?php if ( lsvr_pressville_has_next_post() ) : ?>

				<!-- NEXT POST : begin -->
				<li class="post-navigation__next">
					<div class="post-navigation__next-inner">

						<h2 class="post-navigation__title">
							<a href="<?php echo esc_url( lsvr_pressville_get_next_post_url() ); ?>"
								class="post-navigation__title-link">
								<?php esc_html_e( 'Next', 'pressville' ); ?>
							</a>
						</h2>

						<a href="<?php echo esc_url( lsvr_pressville_get_next_post_url() ); ?>"
							class="post-navigation__link">
							<?php echo esc_html( lsvr_pressville_get_next_post_title() ); ?>
						</a>

					</div>
				</li>
				<!-- NEXT POST : end -->

			<?php endif; ?>

		</ul>

	</div>
	<!-- POST NAVIGATION : end -->

<?php endif; ?>