				</div>
			</main>
			<!-- MAIN : end -->

			<?php if ( true === apply_filters( 'lsvr_pressville_narrow_content_enable', false ) ) : ?>

					</div>
				</div>

			<?php endif; ?>

			<?php if ( 'disable' !== apply_filters( 'lsvr_pressville_sidebar_position', 'right' ) ) : ?>

				</div>

				<?php if ( 'left' === apply_filters( 'lsvr_pressville_sidebar_position', 'right' ) ) : ?>

					<div class="columns__sidebar columns__sidebar--left lsvr-grid__col lsvr-grid__col--span-4 lsvr-grid__col--pull-8">

				<?php else : ?>

					<div class="columns__sidebar columns__sidebar--right lsvr-grid__col lsvr-grid__col--span-4">

				<?php endif; ?>

					<?php // Sidebar
					get_sidebar(); ?>

				</div>
			</div>

			<?php endif; ?>

		</div>
	</div>
</div>
<!-- COLUMNS : end -->