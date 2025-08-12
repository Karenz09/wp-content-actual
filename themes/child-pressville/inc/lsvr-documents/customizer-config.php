<?php

add_action( 'customize_register', 'lsvr_pressville_documents_customize_register' );
if ( ! function_exists( 'lsvr_pressville_documents_customize_register' ) ) {
    function lsvr_pressville_documents_customize_register( $wp_customize ) {
        if ( class_exists( 'Lsvr_Customizer' ) ) {

            $lsvr_customizer = new Lsvr_Customizer( $wp_customize, 'lsvr_pressville_' );

            $lsvr_customizer->add_section( 'lsvr_document_settings', array(
                'title' => esc_html__( 'Documents', 'pressville' ),
                'priority' => 160,
            ));

                // Archive settings
                $lsvr_customizer->add_info( 'lsvr_document_archive_info', array(
                    'section' => 'lsvr_document_settings',
                    'label' => esc_html__( 'Archive Settings', 'pressville' ),
                    'description' => esc_html__( 'The following settings apply to post archive page. You can change your default post archive URL under Settings / Permalinks. Scroll down for post detail page settings.', 'pressville' ),
                    'priority' => 1010,
                ));

                // Title
                $lsvr_customizer->add_field( 'lsvr_document_archive_title', array(
                    'section' => 'lsvr_document_settings',
                    'label' => esc_html__( 'Document Archive Title', 'pressville' ),
                    'description' => esc_html__( 'This title will be used as the archive page headline and in breadcrumbs.', 'pressville' ),
                    'type' => 'text',
                    'default' => esc_html__( 'Documents', 'pressville' ),
                    'priority' => 1020,
                ));

                // Archive layout
                $lsvr_customizer->add_field( 'lsvr_document_archive_layout', array(
                    'section' => 'lsvr_document_settings',
                    'label' => esc_html__( 'Archive Layout', 'pressville' ),
                    'description' => esc_html__( 'Change layout for document archive page.', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        'default' => esc_html__( 'Post View', 'pressville' ),
                        'categorized-attachments' => esc_html__( 'Attachment View', 'pressville' ),
                    ),
                    'default' => 'default',
                    'priority' => 1030,
                ));

                // Archive posts per page
                $lsvr_customizer->add_field( 'lsvr_document_archive_posts_per_page', array(
                    'section' => 'lsvr_document_settings',
                    'label' => esc_html__( 'Posts Per Page', 'pressville' ),
                    'description' => esc_html__( 'How many document posts should be displayed per page. Set to 0 to display all.', 'pressville' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'default' => 20,
                    'priority' => 1040,
                    'required' => array(
                        'setting' => 'lsvr_document_archive_layout',
                        'operator' => '==',
                        'value' => 'default',
                    ),
                ));

                // Archive attachments per post
                $lsvr_customizer->add_field( 'lsvr_document_archive_attachments_per_post', array(
                    'section' => 'lsvr_document_settings',
                    'label' => esc_html__( 'Attachments Per Post', 'pressville' ),
                    'description' => esc_html__( 'How many document attachments should be displayed per post on the archive page. Set to 0 to display all.', 'pressville' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 0,
                        'max' => 20,
                        'step' => 1,
                    ),
                    'default' => 0,
                    'priority' => 1050,
                    'required' => array(
                        'setting' => 'lsvr_document_archive_layout',
                        'operator' => '==',
                        'value' => 'default',
                    ),
                ));

                // Archive posts order
                $lsvr_customizer->add_field( 'lsvr_document_archive_posts_order', array(
                    'section' => 'lsvr_document_settings',
                    'label' => esc_html__( 'Archive Order', 'pressville' ),
                    'description' => esc_html__( 'How document posts should be ordered.', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        'default' => esc_html__( 'Default', 'pressville' ),
                        'date_asc' => esc_html__( 'Published date, ascending', 'pressville' ),
                        'date_desc' => esc_html__( 'Published date, descending', 'pressville' ),
                        'title_asc' => esc_html__( 'Post title, ascending', 'pressville' ),
                        'title_desc' => esc_html__( 'Post title, descending', 'pressville' ),
                        'random' => esc_html__( 'Random', 'pressville' ),
                    ),
                    'default' => 'date_desc',
                    'priority' => 1060,
                    'required' => array(
                        'setting' => 'lsvr_document_archive_layout',
                        'operator' => '==',
                        'value' => 'default',
                    ),
                ));

                // Archive attachments order
                $lsvr_customizer->add_field( 'lsvr_document_archive_attachments_order', array(
                    'section' => 'lsvr_document_settings',
                    'label' => esc_html__( 'Archive Order of Attachments', 'pressville' ),
                    'description' => esc_html__( 'How document attachments should be ordered.', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        'default' => esc_html__( 'Default', 'pressville' ),
                        'date_asc' => esc_html__( 'Parent post published date, ascending', 'pressville' ),
                        'date_desc' => esc_html__( 'Parent post published date, descending', 'pressville' ),
                        'filename_asc' => esc_html__( 'Attachment filename, ascending', 'pressville' ),
                        'filename_desc' => esc_html__( 'Attachment filename, descending', 'pressville' ),
                        'title_asc' => esc_html__( 'Attachment title, ascending', 'pressville' ),
                        'title_desc' => esc_html__( 'Attachment title, descending', 'pressville' ),
                    ),
                    'default' => 'filename_asc',
                    'priority' => 1070,
                    'required' => array(
                        'setting' => 'lsvr_document_archive_layout',
                        'operator' => '==',
                        'value' => 'categorized-attachments',
                    ),
                ));

                // Enable categories
                $lsvr_customizer->add_field( 'lsvr_document_archive_categories_enable', array(
                    'section' => 'lsvr_document_settings',
                    'label' => esc_html__( 'Display Archive Categories', 'pressville' ),
                    'description' => esc_html__( 'Display links to document categories.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1110,
                    'required' => array(
                        'setting' => 'lsvr_document_archive_layout',
                        'operator' => '==',
                        'value' => 'default',
                    ),
                ));

                // Enable date on archive
                $lsvr_customizer->add_field( 'lsvr_document_archive_date_enable', array(
                    'section' => 'lsvr_document_settings',
                    'label' => esc_html__( 'Display Date on Archive', 'pressville' ),
                    'description' => esc_html__( 'Display post date on archive page.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1120,
                    'required' => array(
                        'setting' => 'lsvr_document_archive_layout',
                        'operator' => '==',
                        'value' => 'default',
                    ),
                ));

                // Enable author on archive
                $lsvr_customizer->add_field( 'lsvr_document_archive_author_enable', array(
                    'section' => 'lsvr_document_settings',
                    'label' => esc_html__( 'Display Author on Archive', 'pressville' ),
                    'description' => esc_html__( 'Display post author on archive page.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1130,
                    'required' => array(
                        'setting' => 'lsvr_document_archive_layout',
                        'operator' => '==',
                        'value' => 'default',
                    ),
                ));

                // Attachment titles
                $lsvr_customizer->add_field( 'lsvr_document_enable_attachment_titles', array(
                    'section' => 'lsvr_document_settings',
                    'label' => esc_html__( 'Display Attachment Titles', 'pressville' ),
                    'description' => esc_html__( 'Display attachment titles instead of file names. You can change titles by editing your files under Media.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => false,
                    'priority' => 1140,
                ));

                // Excluded categories
                $lsvr_customizer->add_field( 'lsvr_document_excluded_categories', array(
                    'section' => 'lsvr_document_settings',
                    'label' => esc_html__( 'Excluded Categories', 'pressville' ),
                    'description' => esc_html__( 'List of category IDs or slugs separated by comma. Documents from these categories won\'t be displayed on the default archive page (but they will still be displayed on the category archive page for that particular category).', 'pressville' ),
                    'type' => 'text',
                    'default' => '',
                    'priority' => 1150,
                ));

                // Archive sidebar position
                $lsvr_customizer->add_field( 'lsvr_document_archive_sidebar_position', array(
                    'section' => 'lsvr_document_settings',
                    'label' => esc_html__( 'Archive Sidebar Position', 'pressville' ),
                    'description' => esc_html__( 'Change the document post archive sidebar position.', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'pressville' ),
                        'left' => esc_html__( 'Left', 'pressville' ),
                        'right' => esc_html__( 'Right', 'pressville' ),
                    ),
                    'default' => 'disable',
                    'priority' => 1210,
                ));

                // Archive sidebar ID
                $lsvr_customizer->add_field( 'lsvr_document_archive_sidebar_id', array(
                    'section' => 'lsvr_document_settings',
                    'label' => esc_html__( 'Archive Sidebar', 'pressville' ),
                    'description' => esc_html__( 'Choose sidebar to display.', 'pressville' ),
                    'type' => 'select',
                    'choices' => lsvr_pressville_get_sidebars(),
                    'priority' => 1220,
                    'required' => array(
                        'setting' => 'lsvr_document_archive_sidebar_position',
                        'operator' => '==',
                        'value' => 'left,right',
                    ),
                ));

                // Separator
                $lsvr_customizer->add_separator( 'lsvr_document_separator_2', array(
                    'section' => 'lsvr_document_settings',
                    'priority' => 2000,
                ));

                // Detail settings
                $lsvr_customizer->add_info( 'lsvr_document_single_info', array(
                    'section' => 'lsvr_document_settings',
                    'label' => esc_html__( 'Detail Settings', 'pressville' ),
                    'description' => esc_html__( 'The following settings apply to post detail pages.', 'pressville' ),
                    'priority' => 2010,
                ));

                // Enable date on detail
                $lsvr_customizer->add_field( 'lsvr_document_single_date_enable', array(
                    'section' => 'lsvr_document_settings',
                    'label' => esc_html__( 'Display Date on Detail', 'pressville' ),
                    'description' => esc_html__( 'Display document post date on post detail.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2020,
                ));

                // Enable author on detail
                $lsvr_customizer->add_field( 'lsvr_document_single_author_enable', array(
                    'section' => 'lsvr_document_settings',
                    'label' => esc_html__( 'Display Author on Detail', 'pressville' ),
                    'description' => esc_html__( 'Display document post author on post detail', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2030,
                ));

                // Single sidebar position
                $lsvr_customizer->add_field( 'lsvr_document_single_sidebar_position', array(
                    'section' => 'lsvr_document_settings',
                    'label' => esc_html__( 'Detail Sidebar Position', 'pressville' ),
                    'description' => esc_html__( 'Change the document post detail sidebar position.', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'pressville' ),
                        'left' => esc_html__( 'Left', 'pressville' ),
                        'right' => esc_html__( 'Right', 'pressville' ),
                    ),
                    'default' => 'disable',
                    'priority' => 2210,
                ));

                // Single sidebar ID
                $lsvr_customizer->add_field( 'lsvr_document_single_sidebar_id', array(
                    'section' => 'lsvr_document_settings',
                    'label' => esc_html__( 'Detail Sidebar', 'pressville' ),
                    'description' => esc_html__( 'Choose sidebar to display.', 'pressville' ),
                    'type' => 'select',
                    'choices' => lsvr_pressville_get_sidebars(),
                    'priority' => 2220,
                    'required' => array(
                        'setting' => 'lsvr_document_single_sidebar_position',
                        'operator' => '==',
                        'value' => 'left,right',
                    ),
                ));

        }
    }
}

?>