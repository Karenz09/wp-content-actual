<?php $images = lsvr_pressville_get_header_titlebar_background_images();
if ( ! empty( $images ) ) : ?>

	<!-- HEADER TITLEBAR BACKGROUND : begin -->
	<div class="<?php echo lsvr_pressville_get_header_titlebar_background_class(); ?>"
		data-slideshow-speed="<?php echo esc_attr( get_theme_mod( 'header_background_slideshow_speed', 10 ) ); ?>">

		<?php $post = get_post( $post );?>
		<?php echo($post->post_type) ?>
		<?php echo(($post->post_type == 'post')) ?>

		<?php if (( !is_front_page() && ($post->post_type == 'post'))) : ?>
			<div class="header-titlebar__background-image header-titlebar__background-image--default"
			<?php if (is_home()) : ?>
				style="background-image: url('../../wp-content/uploads/2023/12/vocesAmeliCA_fondo2.jpg');"></div>
			<?php elseif ($post->post_type == 'post') : ?>
				style="background-image: url('../../../../../wp-content/uploads/2023/12/vocesAmeliCA_fondo2.jpg');"></div>
			<?php else :?>
				style="background-image: url('../../wp-content/uploads/2023/12/vocesAmeliCA_fondo2.jpg');"></div>
			<?php endif ?>
		<?php else: ?>

			<?php // Pick random image
			if ( 'random' === get_theme_mod( 'header_background_type', 'single' ) ) : $random_index = rand( 0, count( $images ) - 1 ); ?>

				<div class="header-titlebar__background-image header-titlebar__background-image--default"
					style="background-image: url( '<?php echo ! empty( $images[ $random_index ] ) ? esc_url( $images[ $random_index ] ) : esc_url( reset( $images ) ); ?>' );"></div>

			<?php // List all images
			else : ?>

				<?php foreach ( $images as $image_url ) : ?>

					<div class="header-titlebar__background-image<?php if ( $image_url === reset( $images ) ) { echo ' header-titlebar__background-image--default'; } ?>"
						style="background-image: url('<?php echo esc_url( $image_url ); ?>'); "></div>

				<?php endforeach; ?>

			<?php endif; ?>
		<?php endif; ?>


	</div>
	<!-- HEADER TITLEBAR BACKGROUND : end -->

<?php endif; ?>
<?php if ( ( !is_front_page() && ($post->post_type == 'post')) || (is_home())) : ?>
<span class="" <?php lsvr_pressville_the_header_titlebar_overlay_opacity(); ?>></span>
<?php else : ?>
<span class="header-titlebar__overlay" <?php lsvr_pressville_the_header_titlebar_overlay_opacity(); ?>></span>
<?php endif; ?>