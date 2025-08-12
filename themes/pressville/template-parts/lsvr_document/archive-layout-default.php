<!-- DOCUMENT POST ARCHIVE : begin -->
<div class="lsvr_document-post-page post-archive lsvr_document-post-archive lsvr_document-post-archive--default">

	<?php // Main header
	get_template_part( 'template-parts/main-header' ); ?>

	<?php // Archive categories
	get_template_part( 'template-parts/archive-categories' ); ?>

	<?php // Archive category description
	get_template_part( 'template-parts/archive-category-description' ); ?>

	<?php if ( have_posts() ) : ?>

		<!-- POST ARCHIVE LIST : begin -->
		<div class="post-archive__list">

			<?php while ( have_posts() ) : the_post(); ?>

				<!-- POST : begin -->
				<article <?php post_class( 'post' ); ?>>
					<div class="post__inner">

						<!-- POST HEADER : begin -->
						<header class="post__header">

							<!-- POST TITLE : begin -->
							<h2 class="post__title">
								<a href="<?php the_permalink(); ?>" class="post__title-link" rel="bookmark"><?php the_title(); ?></a>
							</h2>
							<!-- POST TITLE : end -->

							<?php // Post meta
							get_template_part( 'template-parts/archive-post-meta' ); ?>

						</header>
						<!-- POST HEADER : end -->

						<?php if ( ! empty( $post->post_excerpt ) ) : ?>

							<!-- POST CONTENT : begin -->
							<div class="post__content">
								<?php the_excerpt(); ?>
							</div>
							<!-- POST CONTENT : end -->

						<?php endif; ?>

						<?php // Post attachments
						get_template_part( 'template-parts/lsvr_document/attachments' ); ?>

						<!-- POST PERMALINK : begin -->
						<p class="post__permalink">
							<a href="<?php the_permalink(); ?>" class="c-button post__permalink-link" rel="bookmark">
								<?php esc_html_e( 'Read More', 'pressville' ); ?>
							</a>
						</p>
						<!-- POST PERMALINK : end -->

					</div>
				</article>
				<!-- POST : end -->

			<?php endwhile; ?>

		</div>
		<!-- POST ARCHIVE LIST : end -->

		<?php // Pagination
		the_posts_pagination(); ?>

	<?php else : ?>

		<?php lsvr_pressville_the_alert_message( esc_html__( 'There are no documents', 'pressville' ) ); ?>

	<?php endif; ?>

</div>
<!-- DOCUMENT POST ARCHIVE : end -->