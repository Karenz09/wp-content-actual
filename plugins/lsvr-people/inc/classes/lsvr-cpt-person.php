<?php
/**
 * Person post type
 */
if ( ! class_exists( 'Lsvr_CPT_Person' ) && class_exists( 'Lsvr_CPT' ) ) {
    class Lsvr_CPT_Person extends Lsvr_CPT {

		public function __construct() {

			parent::__construct( array(
				'id' => 'lsvr_person',
				'wp_args' => array(
					'labels' => array(
						'name' => esc_html__( 'People', 'lsvr-people' ),
						'singular_name' => esc_html__( 'Person', 'lsvr-people' ),
						'add_new' => esc_html__( 'Add New Person', 'lsvr-people' ),
						'add_new_item' => esc_html__( 'Add New Person', 'lsvr-people' ),
						'edit_item' => esc_html__( 'Edit Person', 'lsvr-people' ),
						'new_item' => esc_html__( 'Add New Person', 'lsvr-people' ),
						'view_item' => esc_html__( 'View Person', 'lsvr-people' ),
						'search_items' => esc_html__( 'Search people', 'lsvr-people' ),
						'not_found' => esc_html__( 'No people found', 'lsvr-people' ),
						'not_found_in_trash' => esc_html__( 'No people found in trash', 'lsvr-people' ),
					),
					'exclude_from_search' => false,
					'public' => true,
					'supports' => array( 'title', 'editor', 'custom-fields', 'excerpt', 'thumbnail', 'author' ),
					'capability_type' => 'post',
					'rewrite' => array( 'slug' => 'people' ),
					'menu_position' => 5,
					'has_archive' => true,
					'show_in_nav_menus' => true,
					'show_in_rest' => true,
					'menu_icon' => 'dashicons-groups',
				),
			));

			// Add Category taxonomy
			$this->add_taxonomy(array(
				'id' => 'lsvr_person_cat',
				'wp_args' => array(
					'labels' => array(
						'name' => esc_html__( 'Person Categories', 'lsvr-people' ),
						'singular_name' => esc_html__( 'Person Category', 'lsvr-people' ),
						'search_items' => esc_html__( 'Search Person Categories', 'lsvr-people' ),
						'popular_items' => esc_html__( 'Popular Person Categories', 'lsvr-people' ),
						'all_items' => esc_html__( 'All Person Categories', 'lsvr-people' ),
						'parent_item' => esc_html__( 'Parent Person Categories', 'lsvr-people' ),
						'parent_item_colon' => esc_html__( 'Parent Person Categories:', 'lsvr-people' ),
						'edit_item' => esc_html__( 'Edit Person Category', 'lsvr-people' ),
						'update_item' => esc_html__( 'Update Person Category', 'lsvr-people' ),
						'add_new_item' => esc_html__( 'Add New Person Category', 'lsvr-people' ),
						'new_item_name' => esc_html__( 'New Person Category Name', 'lsvr-people' ),
						'separate_items_with_commas' => esc_html__( 'Separate person categories by comma', 'lsvr-people' ),
						'add_or_remove_items' => esc_html__( 'Add or remove person categories', 'lsvr-people' ),
						'choose_from_most_used' => esc_html__( 'Choose from the most used person categories', 'lsvr-people' ),
						'menu_name' => esc_html__( 'Person Categories', 'lsvr-people' )
					),
					'public' => true,
					'show_in_nav_menus' => true,
					'show_ui' => true,
					'show_admin_column' => true,
					'show_tagcloud' => true,
					'hierarchical' => true,
					'rewrite' => array( 'slug' => 'person-category' ),
					'query_var' => true,
					'show_in_rest' => true,
				),
				'args' => array(
					'admin_tax_filter' => true,
				),
			));

			// Additional custom admin functionality
			if ( is_admin() ) {

				// Add Person Settings metabox
				add_action( 'init', array( $this, 'add_person_post_metabox' ) );

			}

		}

		// Add Person Settings metabox
		public function add_person_post_metabox() {
			if ( class_exists( 'Lsvr_Post_Metabox' ) ) {
				$lsvr_person_settings_metabox = new Lsvr_Post_Metabox(array(
					'id' => 'lsvr_person_settings',
					'wp_args' => array(
						'title' => __( 'Person Settings', 'lsvr-people' ),
						'screen' => 'lsvr_person',
					),
					'fields' => array(

						// Role
						'lsvr_person_role' => array(
							'type' => 'text',
							'title' => esc_html__( 'Role', 'lsvr-people' ),
							'description' => esc_html__( 'Brief description of this person\'s role.', 'lsvr-people' ),
							'priority' => 10,
						),

						// Separator 1
						'lsvr_person_separator1' => array(
							'type' => 'separator',
							'priority' => 1000,
						),

						// Email
						'lsvr_person_email' => array(
							'type' => 'text',
							'title' => esc_html__( 'Email', 'lsvr-people' ),
							'priority' => 1020,
						),

						// Phone
						'lsvr_person_phone' => array(
							'type' => 'text',
							'content_type' => 'number',
							'title' => esc_html__( 'Phone', 'lsvr-people' ),
							'priority' => 1030,
						),

						// Website
						'lsvr_person_website' => array(
							'type' => 'text',
							'title' => esc_html__( 'Website', 'lsvr-people' ),
							'priority' => 1040,
						),

						// Custom contact 1 icon
						'lsvr_person_custom_contact1_icon' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Contact 1 Icon', 'lsvr-people' ),
							'description' => esc_html__( 'Add icon class here. Please refer to the documentation to learn more about icons.', 'lsvr-people' ),
							'priority' => 1110,
						),

						// Custom contact 1 label
						'lsvr_person_custom_contact1_label' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Contact 1 Label', 'lsvr-people' ),
							'description' => esc_html__( 'You can make the label clickable using a simple HTML like this: &lt;a href="https://example.com"&gt;label&lt;/a&gt;', 'lsvr-people' ),
							'priority' => 1120,
						),

						// Custom contact 1 title
						'lsvr_person_custom_contact1_title' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Contact 1 Title', 'lsvr-people' ),
							'description' => esc_html__( 'Briefly describe the purpose of this information (e.g.: "Mobile phone"). Very important for screen reader users.', 'lsvr-people' ),
							'priority' => 1130,
						),

						// Custom contact 2 icon
						'lsvr_person_custom_contact2_icon' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Contact 2 Icon', 'lsvr-people' ),
							'priority' => 1210,
						),

						// Custom contact 2 label
						'lsvr_person_custom_contact2_label' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Contact 2 Label', 'lsvr-people' ),
							'priority' => 1220,
						),

						// Custom contact 2 title
						'lsvr_person_custom_contact2_title' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Contact 2 Title', 'lsvr-people' ),
							'priority' => 1230,
						),

						// Custom contact 3 icon
						'lsvr_person_custom_contact3_icon' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Contact 3 Icon', 'lsvr-people' ),
							'priority' => 1310,
						),

						// Custom contact 3 label
						'lsvr_person_custom_contact3_label' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Contact 3 Label', 'lsvr-people' ),
							'priority' => 1320,
						),

						// Custom contact 3 title
						'lsvr_person_custom_contact3_title' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Contact 3 Title', 'lsvr-people' ),
							'priority' => 1330,
						),

						// Separator 2
						'lsvr_person_separator2' => array(
							'type' => 'separator',
							'priority' => 2000,
						),

						// Facebook
						'lsvr_person_facebook' => array(
							'type' => 'text',
							'title' => esc_html__( 'Facebook', 'lsvr-people' ),
							'priority' => 2010,
						),

						// Twitter
						'lsvr_person_twitter' => array(
							'type' => 'text',
							'title' => esc_html__( 'Twitter', 'lsvr-people' ),
							'priority' => 2020,
						),

						// LinkedIn
						'lsvr_person_linkedin' => array(
							'type' => 'text',
							'title' => esc_html__( 'LinkedIn', 'lsvr-people' ),
							'priority' => 2030,
						),

						// Custom social 1 icon
						'lsvr_person_custom_social1_icon' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Social Link 1 Icon', 'lsvr-people' ),
							'description' => esc_html__( 'Add icon class here. Please refer to the documentation to learn more about icons.', 'lsvr-people' ),
							'priority' => 2110,
						),

						// Custom social 1 URL
						'lsvr_person_custom_social1_url' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Social Link 1 URL', 'lsvr-people' ),
							'description' => esc_html__( 'Absolute URL to your social profile.', 'lsvr-people' ),
							'priority' => 2120,
						),

						// Custom social 1 label
						'lsvr_person_custom_social1_label' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Social Link 1 Label', 'lsvr-people' ),
							'description' => esc_html__( 'This label will appear when you hover over the icon.', 'lsvr-people' ),
							'priority' => 2130,
						),

						// Custom social 2 icon
						'lsvr_person_custom_social2_icon' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Social Link 2 Icon', 'lsvr-people' ),
							'priority' => 2210,
						),

						// Custom social 2 URL
						'lsvr_person_custom_social2_url' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Social Link 2 URL', 'lsvr-people' ),
							'priority' => 2220,
						),

						// Custom social 2 label
						'lsvr_person_custom_social2_label' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Social Link 2 Label', 'lsvr-people' ),
							'priority' => 2230,
						),

						// Custom social 3 icon
						'lsvr_person_custom_social3_icon' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Social Link 3 Icon', 'lsvr-people' ),
							'priority' => 2310,
						),

						// Custom social 3 URL
						'lsvr_person_custom_social3_url' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Social Link 3 URL', 'lsvr-people' ),
							'priority' => 2320,
						),

						// Custom social 3 label
						'lsvr_person_custom_social3_label' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Social Link 3 Label', 'lsvr-people' ),
							'priority' => 2330,
						),

					),
				));
			}
		}

	}
}

?>