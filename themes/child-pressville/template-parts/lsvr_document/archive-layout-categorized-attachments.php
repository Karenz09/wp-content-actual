<!-- POST ARCHIVE : begin -->
<div class="lsvr_document-post-page post-archive lsvr_document-post-archive lsvr_document-post-archive--categorized-attachments">

	<?php // Main header
	get_template_part( 'template-parts/main-header' ); ?>

	<?php // Archive category description
	get_template_part( 'template-parts/archive-category-description' ); ?>

	<?php if ( have_posts() ) : ?>

		<?php // Categorized attachments
		get_template_part( 'template-parts/lsvr_document/archive-categorized-attachments' ); ?>

	<?php else : ?>

		<?php lsvr_pressville_the_alert_message( esc_html__( 'There are no documents', 'pressville' ) ); ?>

	<?php endif; ?>

</div>
<!-- POST ARCHIVE : end -->
