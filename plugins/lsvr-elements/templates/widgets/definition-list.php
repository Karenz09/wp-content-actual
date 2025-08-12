<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="widget__content">

	<dl class="lsvr-definition-list-widget__list">

		<?php for ( $i = 1; $i <= 5; $i++ ) : ?>

			<?php if ( ! empty( $instance[ 'item' . $i . '_title' ] ) && ! empty( $instance[ 'item' . $i . '_text' ] ) ) : ?>

				<dt class="lsvr-definition-list-widget__item-title">
					<?php echo esc_html( $instance[ 'item' . $i . '_title' ] ); ?>
				</dt>

				<?php if ( ! empty( $instance[ 'item' . $i . '_text_link' ] ) ) : ?>

					<dd class="lsvr-definition-list-widget__item-text">
						<a href="<?php echo esc_url( $instance[ 'item' . $i . '_text_link' ] ); ?>"
							class="lsvr-definition-list-widget__item-text-link">
							<?php echo esc_html( $instance[ 'item' . $i . '_text' ] ); ?>
						</a>
					</dd>

				<?php else : ?>

					<dd class="lsvr-definition-list-widget__item-text">
						<?php echo esc_html( $instance[ 'item' . $i . '_text' ] ); ?>
					</dd>

				<?php endif; ?>

			<?php endif; ?>

		<?php endfor; ?>

	</dl>

	<?php if ( ! empty( $instance[ 'more_label' ] ) && ! empty( $instance[ 'more_link' ] ) ) : ?>

		<p class="widget__more">
			<a href="<?php echo esc_url( $instance[ 'more_link' ] ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>
		</p>

	<?php endif; ?>

</div>

<?php // TEMPLATE : END
endif; ?>