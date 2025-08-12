<!-- PAGE CONTENT : begin -->
<div class="page__content">

	<?php the_content(); ?>
	<?php wp_link_pages(); ?>

    <?php // Post comments
    if ( comments_open() ) : ?>

    	<?php comments_template(); ?>

    <?php endif; ?>

</div>
<!-- PAGE CONTENT : end -->