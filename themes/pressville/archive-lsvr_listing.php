<?php get_header(); ?>

<?php // Directory map
get_template_part( 'template-parts/lsvr_listing/archive-map' ); ?>

<?php // Breadcrumbs
get_template_part( 'template-parts/breadcrumbs' ); ?>

<?php // Main begin
get_template_part( 'template-parts/main-begin' ); ?>

<?php // Archive
get_template_part( 'template-parts/lsvr_listing/archive-layout', apply_filters( 'lsvr_pressville_listing_archive_layout', 'default' ) ); ?>

<?php // Main end
get_template_part( 'template-parts/main-end' ); ?>

<?php get_footer(); ?>