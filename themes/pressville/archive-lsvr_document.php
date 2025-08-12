<?php get_header(); ?>

<?php // Breadcrumbs
get_template_part( 'template-parts/breadcrumbs' ); ?>

<?php // Main begin
get_template_part( 'template-parts/main-begin' ); ?>

<?php // Archive
get_template_part( 'template-parts/lsvr_document/archive-layout', apply_filters( 'lsvr_pressville_document_archive_layout', 'default' ) ); ?>

<?php // Main end
get_template_part( 'template-parts/main-end' ); ?>

<?php get_footer(); ?>