<?php
/**
 * Listing post type
 */
if ( ! class_exists( 'Lsvr_CPT_Listing' ) && class_exists( 'Lsvr_CPT' ) ) {
    class Lsvr_CPT_Listing extends Lsvr_CPT {

		public function __construct() {

			parent::__construct( array(
				'id' => 'lsvr_listing',
				'wp_args' => array(
					'labels' => array(
						'name' => esc_html__( 'Directory', 'lsvr-directory' ),
						'singular_name' => esc_html__( 'Listing', 'lsvr-directory' ),
						'add_new' => esc_html__( 'Add New Listing', 'lsvr-directory' ),
						'add_new_item' => esc_html__( 'Add New Listing', 'lsvr-directory' ),
						'edit_item' => esc_html__( 'Edit Listing', 'lsvr-directory' ),
						'new_item' => esc_html__( 'Add New Listing', 'lsvr-directory' ),
						'view_item' => esc_html__( 'View Listing', 'lsvr-directory' ),
						'search_items' => esc_html__( 'Search listings', 'lsvr-directory' ),
						'not_found' => esc_html__( 'No listings found', 'lsvr-directory' ),
						'not_found_in_trash' => esc_html__( 'No listings found in trash', 'lsvr-directory' ),
					),
					'exclude_from_search' => false,
					'public' => true,
					'supports' => array( 'title', 'editor', 'custom-fields', 'revisions', 'excerpt', 'thumbnail', 'author' ),
					'capability_type' => 'post',
					'rewrite' => array( 'slug' => 'directory' ),
					'menu_position' => 5,
					'has_archive' => true,
					'show_in_nav_menus' => true,
					'show_in_rest' => true,
					'menu_icon' => 'dashicons-location-alt',
				),
			));

			// Add Category taxonomy
			$this->add_taxonomy(array(
				'id' => 'lsvr_listing_cat',
				'wp_args' => array(
					'labels' => array(
						'name' => esc_html__( 'Listing Categories', 'lsvr-directory' ),
						'singular_name' => esc_html__( 'Listing Category', 'lsvr-directory' ),
						'search_items' => esc_html__( 'Search Listing Categories', 'lsvr-directory' ),
						'popular_items' => esc_html__( 'Popular Listing Categories', 'lsvr-directory' ),
						'all_items' => esc_html__( 'All Listing Categories', 'lsvr-directory' ),
						'parent_item' => esc_html__( 'Parent Listing Category', 'lsvr-directory' ),
						'parent_item_colon' => esc_html__( 'Parent Listing Category:', 'lsvr-directory' ),
						'edit_item' => esc_html__( 'Edit Listing Category', 'lsvr-directory' ),
						'update_item' => esc_html__( 'Update Listing Category', 'lsvr-directory' ),
						'add_new_item' => esc_html__( 'Add New Listing Category', 'lsvr-directory' ),
						'new_item_name' => esc_html__( 'New Listing Category Name', 'lsvr-directory' ),
						'separate_items_with_commas' => esc_html__( 'Separate listing categories by comma', 'lsvr-directory' ),
						'add_or_remove_items' => esc_html__( 'Add or remove listing categories', 'lsvr-directory' ),
						'choose_from_most_used' => esc_html__( 'Choose from the most used listing categories', 'lsvr-directory' ),
						'menu_name' => esc_html__( 'Listing Categories', 'lsvr-directory' )
					),
					'public' => true,
					'show_in_nav_menus' => true,
					'show_ui' => true,
					'show_admin_column' => true,
					'show_tagcloud' => true,
					'hierarchical' => true,
					'rewrite' => array( 'slug' => 'directory-category' ),
					'query_var' => true,
					'show_in_rest' => true,
				),
				'args' => array(
					'admin_tax_filter' => true,
				),
			));

			// Add Tag taxonomy
			$this->add_taxonomy(array(
				'id' => 'lsvr_listing_tag',
				'wp_args' => array(
					'labels' => array(
						'name' => esc_html__( 'Listing Tags', 'lsvr-directory' ),
						'singular_name' => esc_html__( 'Listing Tag', 'lsvr-directory' ),
						'search_items' => esc_html__( 'Search Listing Tags', 'lsvr-directory' ),
						'popular_items' => esc_html__( 'Popular Listing Tags', 'lsvr-directory' ),
						'all_items' => esc_html__( 'All Listing Tags', 'lsvr-directory' ),
						'parent_item' => esc_html__( 'Parent Listing Tag', 'lsvr-directory' ),
						'parent_item_colon' => esc_html__( 'Parent Listing Tag:', 'lsvr-directory' ),
						'edit_item' => esc_html__( 'Edit Listing Tag', 'lsvr-directory' ),
						'update_item' => esc_html__( 'Update Listing Tag', 'lsvr-directory' ),
						'add_new_item' => esc_html__( 'Add New Listing Tag', 'lsvr-directory' ),
						'new_item_name' => esc_html__( 'New Listing Tag Name', 'lsvr-directory' ),
						'separate_items_with_commas' => esc_html__( 'Separate listing tags by comma', 'lsvr-directory' ),
						'add_or_remove_items' => esc_html__( 'Add or remove tags', 'lsvr-directory' ),
						'choose_from_most_used' => esc_html__( 'Choose from the most used listing tags', 'lsvr-directory' ),
						'menu_name' => esc_html__( 'Listing Tags', 'lsvr-directory' )
					),
					'public' => true,
					'show_in_nav_menus' => true,
					'show_ui' => true,
					'show_admin_column' => true,
					'show_tagcloud' => true,
					'hierarchical' => false,
					'rewrite' => array( 'slug' => 'directory-tag' ),
					'query_var' => true,
					'show_in_rest' => true,
				),
				'args' => array(
					'admin_tax_filter' => true,
				),
			));

			// Additional custom admin functionality
			if ( is_admin() ) {

				// Add listing post metabox
				add_action( 'init', array( $this, 'add_listing_post_metabox' ) );

				// Display custom columns in admin archive view
				add_filter( 'manage_edit-lsvr_listing_columns', array( $this, 'add_columns' ), 10, 1 );
				add_action( 'manage_posts_custom_column', array( $this, 'display_columns' ), 10, 1 );

			}

		}

		// Add Listing Settings metabox
		public function add_listing_post_metabox() {
			if ( class_exists( 'Lsvr_Post_Metabox' ) ) {

				// Listing settings metabox
				$lsvr_listing_settings_metabox = new Lsvr_Post_Metabox(array(
					'id' => 'lsvr_listing_settings',
					'wp_args' => array(
						'title' => __( 'Listing Settings', 'lsvr-directory' ),
						'screen' => 'lsvr_listing',
					),
					'fields' => array(

						// Listing map locating method
						'lsvr_listing_map_locating_method' => array(
							'type' => 'radio',
							'title' => esc_html__( 'Locate Listing on Map', 'lsvr-directory' ),
							'description' => esc_html__( 'Don\'t forget to set your maps provider under Customizer / Map Settings for map functionality to work.', 'lsvr-directory' ),
							'choices' => array(
								'false' => esc_html__( 'Do Not Show On Map', 'lsvr-directory' ),
								'latlong' => esc_html__( 'Locate via Latitude and Longitude (recommended)', 'lsvr-directory' ),
								'address' => esc_html__( 'Locate via Address', 'lsvr-directory' ),
							),
							'default' => 'false',
							'priority' => 1110,
						),

						// Latitude & Longitude
						'lsvr_listing_latlong' => array(
							'type' => 'text',
							'content_type' => 'number',
							'title' => esc_html__( 'Latitude & Longitude', 'lsvr-directory' ),
							'description' => esc_html__( 'For example: 40.751597, -73.982243.', 'lsvr-directory' ),
							'priority' => 1120,
							'required' => array(
								'id' => 'lsvr_listing_map_locating_method',
								'value' => 'latlong',
							),
						),

						// Accurate address
						'lsvr_listing_accurate_address' => array(
							'type' => 'text',
							'title' => esc_html__( 'Exact Address', 'lsvr-directory' ),
							'description' => esc_html__( 'For example: 216 W 44th St, New York, NY 10036, US.', 'lsvr-directory' ),
							'priority' => 1130,
							'required' => array(
								'id' => 'lsvr_listing_map_locating_method',
								'value' => 'address',
							),
						),

						// Human-readable address
						'lsvr_listing_address' => array(
							'type' => 'textarea',
							'title' => esc_html__( 'Address', 'lsvr-directory' ),
							'description' => esc_html__( 'Displayed in listing details (it won\'t be used to locate listing on the map).', 'lsvr-directory' ),
							'priority' => 1140,
						),

						// Separator 2
						'lsvr_listing_separator2' => array(
							'type' => 'separator',
							'priority' => 2000,
						),

						// Phone number
						'lsvr_listing_contact_phone' => array(
							'type' => 'text',
							'content_type' => 'number',
							'title' => esc_html__( 'Phone Number', 'lsvr-directory' ),
							'description' => esc_html__( 'Displayed in listing details.', 'lsvr-directory' ),
							'priority' => 2110,
						),

						// Fax
						'lsvr_listing_contact_fax' => array(
							'type' => 'text',
							'content_type' => 'number',
							'title' => esc_html__( 'Fax', 'lsvr-directory' ),
							'description' => esc_html__( 'Displayed in listing details.', 'lsvr-directory' ),
							'priority' => 2120,
						),

						// Email address
						'lsvr_listing_contact_email' => array(
							'type' => 'text',
							'title' => esc_html__( 'Email Address', 'lsvr-directory' ),
							'description' => esc_html__( 'Displayed in listing details.', 'lsvr-directory' ),
							'priority' => 2130,
						),

						// Website
						'lsvr_listing_contact_website' => array(
							'type' => 'text',
							'title' => esc_html__( 'Website', 'lsvr-directory' ),
							'description' => esc_html__( 'Displayed in listing details.', 'lsvr-directory' ),
							'priority' => 2140,
						),

						// Custom contact 1 icon
						'lsvr_listing_custom_contact1_icon' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Contact 1 Icon', 'lsvr-directory' ),
							'description' => esc_html__( 'Add icon class here. Please refer to the documentation to learn more about icons.', 'lsvr-directory' ),
							'priority' => 2210,
						),

						// Custom contact 1 label
						'lsvr_listing_custom_contact1_label' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Contact 1 Label', 'lsvr-directory' ),
							'description' => esc_html__( 'You can make the label clickable using a simple HTML like this: &lt;a href="https://example.com"&gt;label&lt;/a&gt;', 'lsvr-directory' ),
							'priority' => 2220,
						),

						// Custom contact 1 title
						'lsvr_listing_custom_contact1_title' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Contact 1 Title', 'lsvr-directory' ),
							'description' => esc_html__( 'Briefly describe the purpose of this information (e.g.: "Mobile phone"). Very important for screen reader users.', 'lsvr-directory' ),
							'priority' => 2230,
						),

						// Custom contact 2 icon
						'lsvr_listing_custom_contact2_icon' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Contact 2 Icon', 'lsvr-directory' ),
							'priority' => 2310,
						),

						// Custom contact 2 label
						'lsvr_listing_custom_contact2_label' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Contact 2 Label', 'lsvr-directory' ),
							'priority' => 2320,
						),

						// Custom contact 2 title
						'lsvr_listing_custom_contact2_title' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Contact 2 Title', 'lsvr-directory' ),
							'priority' => 2330,
						),

						// Custom contact 3 icon
						'lsvr_listing_custom_contact3_icon' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Contact 3 Icon', 'lsvr-directory' ),
							'priority' => 2410,
						),

						// Custom contact 3 label
						'lsvr_listing_custom_contact3_label' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Contact 3 Label', 'lsvr-directory' ),
							'priority' => 2420,
						),

						// Custom contact 3 title
						'lsvr_listing_custom_contact3_title' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Contact 3 Title', 'lsvr-directory' ),
							'priority' => 2430,
						),

						// Separator 3
						'lsvr_listing_separator3' => array(
							'type' => 'separator',
							'priority' => 3000,
						),

						// Twitter
						'lsvr_listing_social_twitter' => array(
							'type' => 'text',
							'title' => esc_html__( 'Twitter', 'lsvr-directory' ),
							'description' => esc_html__( 'Twitter profile URL.', 'lsvr-directory' ),
							'priority' => 3110,
						),

						// Facebook
						'lsvr_listing_social_facebook' => array(
							'type' => 'text',
							'title' => esc_html__( 'Facebook', 'lsvr-directory' ),
							'description' => esc_html__( 'Facebook profile URL.', 'lsvr-directory' ),
							'priority' => 3120,
						),

						// Instagram
						'lsvr_listing_social_instagram' => array(
							'type' => 'text',
							'title' => esc_html__( 'Instagram', 'lsvr-directory' ),
							'description' => esc_html__( 'Instagram profile URL.', 'lsvr-directory' ),
							'priority' => 3130,
						),

						// Yelp
						'lsvr_listing_social_yelp' => array(
							'type' => 'text',
							'title' => esc_html__( 'Yelp', 'lsvr-directory' ),
							'description' => esc_html__( 'Yelp profile URL.', 'lsvr-directory' ),
							'priority' => 3140,
						),

						// Custom social 1 icon
						'lsvr_listing_custom_social1_icon' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Social Link 1 Icon', 'lsvr-directory' ),
							'description' => esc_html__( 'Add icon class here. Please refer to the documentation to learn more about icons.', 'lsvr-directory' ),
							'priority' => 3210,
						),

						// Custom social 1 URL
						'lsvr_listing_custom_social1_url' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Social Link 1 URL', 'lsvr-directory' ),
							'description' => esc_html__( 'Absolute URL to your social profile.', 'lsvr-directory' ),
							'priority' => 3220,
						),

						// Custom social 1 label
						'lsvr_listing_custom_social1_label' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Social Link 1 Label', 'lsvr-directory' ),
							'description' => esc_html__( 'This label will appear when you hover over the icon.', 'lsvr-directory' ),
							'priority' => 3230,
						),

						// Custom social 2 icon
						'lsvr_listing_custom_social2_icon' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Social Link 2 Icon', 'lsvr-directory' ),
							'priority' => 3310,
						),

						// Custom social 2 URL
						'lsvr_listing_custom_social2_url' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Social Link 2 URL', 'lsvr-directory' ),
							'priority' => 3320,
						),

						// Custom social 2 label
						'lsvr_listing_custom_social2_label' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Social Link 2 Label', 'lsvr-directory' ),
							'priority' => 3330,
						),

						// Custom social 3 icon
						'lsvr_listing_custom_social3_icon' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Social Link 3 Icon', 'lsvr-directory' ),
							'priority' => 3410,
						),

						// Custom social 3 URL
						'lsvr_listing_custom_social3_url' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Social Link 3 URL', 'lsvr-directory' ),
							'priority' => 3420,
						),

						// Custom social 3 label
						'lsvr_listing_custom_social3_label' => array(
							'type' => 'text',
							'title' => esc_html__( 'Custom Social Link 3 Label', 'lsvr-directory' ),
							'priority' => 3430,
						),

						// Separator 4
						'lsvr_listing_separator4' => array(
							'type' => 'separator',
							'priority' => 4000,
						),

						// Opening hours type
						'lsvr_listing_opening_hours' => array(
							'type' => 'radio',
							'title' => esc_html__( 'Opening Hours', 'lsvr-directory' ),
							'description' => esc_html__( 'Choose method for inserting the opening hours.', 'lsvr-directory' ),
							'choices' => array(
								'false' => esc_html__( 'No opening hours', 'lsvr-directory' ),
								'select' => esc_html__( 'Select hours', 'lsvr-directory' ),
								'custom' => esc_html__( 'Add hours in custom format', 'lsvr-directory' ),
							),
							'default' => 'false',
							'priority' => 4110,
						),

						// Select opening hours
						'lsvr_listing_opening_hours_select' => array(
							'type' => 'opening-hours',
							'title' => esc_html__( 'Select Opening Hours', 'lsvr-directory' ),
							'description' => esc_html__( 'You can change the time format displayed on the site under Settings / General.', 'lsvr-directory' ),
							'priority' => 4120,
							'required' => array(
								'id' => 'lsvr_listing_opening_hours',
								'value' => 'select',
							),
						),

						// Opening hours note
						'lsvr_listing_opening_hours_note' => array(
							'type' => 'textarea',
							'title' => esc_html__( 'Opening Hours Note', 'lsvr-directory' ),
							'description' => esc_html__( 'Add a note to opening hours.', 'lsvr-directory' ),
							'priority' => 4130,
							'required' => array(
								'id' => 'lsvr_listing_opening_hours',
								'value' => 'select',
							),
						),

						// Custom opening hours
						'lsvr_listing_opening_hours_custom' => array(
							'type' => 'textarea',
							'title' => esc_html__( 'Custom Format for Opening Hours', 'lsvr-directory' ),
							'description' => esc_html__( 'You can use STRONG HTML tag for formatting.', 'lsvr-directory' ),
							'priority' => 4140,
							'required' => array(
								'id' => 'lsvr_listing_opening_hours',
								'value' => 'custom',
							),
						),

					),

				));

				// Listing gallery metabox
				$lsvr_listing_gallery_metabox = new Lsvr_Post_Metabox(array(
					'id' => 'lsvr_listing_gallery',
					'wp_args' => array(
						'title' => __( 'Listing Gallery', 'lsvr-directory' ),
						'screen' => 'lsvr_listing',
					),
					'fields' => array(

						// Gallery
						'lsvr_listing_gallery' => array(
							'type' => 'gallery',
							'description' => esc_html__( 'You can add some additional images for this listing which will be displayed on its detail page.', 'lsvr-directory' ),
							'multiple' => true,
							'select_btn_label' => esc_html__( 'Manage Gallery Images', 'lsvr-directory' ),
							'media_type' => array( 'image' ),
							'priority' => 110,
						),

					),
				));

				// Listing metadata metabox
				$lsvr_listing_metadata_metabox = new Lsvr_Post_Metabox(array(
					'id' => 'lsvr_listing_metadata',
					'wp_args' => array(
						'title' => __( 'Listing Metadata', 'lsvr-directory' ),
						'description' => __( 'Schema.org metadata. More info:', 'lsvr-directory' ) . ' <a href="https://schema.org">https://schema.org</a>',
						'screen' => 'lsvr_listing',
						'context' => 'normal',
						'priority' => 'high',
					),
					'fields' => array(

						// Enable
						'lsvr_listing_meta_enable' => array(
							'type' => 'switch',
							'title' => esc_html__( 'Enable Metadata', 'lsvr-directory' ),
							'default' => false,
							'priority' => 10,
						),

						// Business type
						'lsvr_listing_meta_business_type' => array(
							'type' => 'select',
							'title' => esc_html__( 'Business Type', 'lsvr-directory' ),
							'choices' => array(
								'LocalBusiness' => esc_html__( 'General Local Business', 'lsvr-directory' ),
								'AnimalShelter' => esc_html__( 'Animal Shelter', 'lsvr-directory' ),
								'AutomotiveBusiness' => esc_html__( 'Automotive Business', 'lsvr-directory' ),
								'ChildCare' => esc_html__( 'Child Care', 'lsvr-directory' ),
								'Dentist' => esc_html__( 'Dentist', 'lsvr-directory' ),
								'DryCleaningOrLaundry' => esc_html__( 'Dry Cleaning Or Laundry', 'lsvr-directory' ),
								'EmergencyService' => esc_html__( 'Emergency Service', 'lsvr-directory' ),
								'EmploymentAgency' => esc_html__( 'Employment Agency', 'lsvr-directory' ),
								'EntertainmentBusiness' => esc_html__( 'Entertainment Business', 'lsvr-directory' ),
								'FinancialService' => esc_html__( 'Financial Service', 'lsvr-directory' ),
								'FoodEstablishment' => esc_html__( 'Food Establishment', 'lsvr-directory' ),
								'GovernmentOffice' => esc_html__( 'Government Office', 'lsvr-directory' ),
								'HealthAndBeautyBusiness' => esc_html__( 'Health And Beauty Business', 'lsvr-directory' ),
								'HomeAndConstructionBusiness' => esc_html__( 'Home And Construction Business', 'lsvr-directory' ),
								'InternetCafe' => esc_html__( 'Internet Cafe', 'lsvr-directory' ),
								'LegalService' => esc_html__( 'Legal Service', 'lsvr-directory' ),
								'Library' => esc_html__( 'Library', 'lsvr-directory' ),
								'LodgingBusiness' => esc_html__( 'Lodging Business', 'lsvr-directory' ),
								'ProfessionalService' => esc_html__( 'Professional Service', 'lsvr-directory' ),
								'RadioStation' => esc_html__( 'Radio Station', 'lsvr-directory' ),
								'RealEstateAgent' => esc_html__( 'Real Estate Agent', 'lsvr-directory' ),
								'RecyclingCenter' => esc_html__( 'Recycling Center', 'lsvr-directory' ),
								'SelfStorage' => esc_html__( 'Self Storage', 'lsvr-directory' ),
								'ShoppingCenter' => esc_html__( 'Shopping Center', 'lsvr-directory' ),
								'SportsActivityLocation' => esc_html__( 'Sports Activity Location', 'lsvr-directory' ),
								'Store' => esc_html__( 'Store', 'lsvr-directory' ),
								'TelevisionStation' => esc_html__( 'Television Station', 'lsvr-directory' ),
								'TouristInformationCenter' => esc_html__( 'Tourist Information Center', 'lsvr-directory' ),
								'TravelAgency' => esc_html__( 'Travel Agency', 'lsvr-directory' ),
							),
							'default' => 'LocalBusiness',
							'priority' => 20,
							'required' => array(
								'id' => 'lsvr_listing_meta_enable',
								'value' => true,
							),
						),

						// Country
						'lsvr_listing_meta_country' => array(
							'type' => 'text',
							'title' => esc_html__( 'Country', 'lsvr-directory' ),
							'description' => esc_html__( 'For example: USA. You can also provide the two-letter country code. For example: US, DE, FR.', 'lsvr-directory' ),
							'priority' => 30,
							'required' => array(
								'id' => 'lsvr_listing_meta_enable',
								'value' => true,
							),
						),

						// Locality
						'lsvr_listing_meta_locality' => array(
							'type' => 'text',
							'title' => esc_html__( 'Locality', 'lsvr-directory' ),
							'description' => esc_html__( 'For example: Mountain View.', 'lsvr-directory' ),
							'priority' => 40,
							'required' => array(
								'id' => 'lsvr_listing_meta_enable',
								'value' => true,
							),
						),

						// Region
						'lsvr_listing_meta_region' => array(
							'type' => 'text',
							'title' => esc_html__( 'Region', 'lsvr-directory' ),
							'description' => esc_html__( 'For example: CA.', 'lsvr-directory' ),
							'priority' => 50,
							'required' => array(
								'id' => 'lsvr_listing_meta_enable',
								'value' => true,
							),
						),

						// Postal Code
						'lsvr_listing_meta_postalcode' => array(
							'type' => 'text',
							'content_type' => 'number',
							'title' => esc_html__( 'Postal Code', 'lsvr-directory' ),
							'description' => esc_html__( 'For example: 94043.', 'lsvr-directory' ),
							'priority' => 60,
							'required' => array(
								'id' => 'lsvr_listing_meta_enable',
								'value' => true,
							),
						),

						// Street Address
						'lsvr_listing_meta_street' => array(
							'type' => 'text',
							'title' => esc_html__( 'Street Address', 'lsvr-directory' ),
							'description' => esc_html__( 'For example: 1600 Amphitheatre Pkwy.', 'lsvr-directory' ),
							'priority' => 70,
							'required' => array(
								'id' => 'lsvr_listing_meta_enable',
								'value' => true,
							),
						),

					),

				));

			}
		}

		// Add custom columns to admin view
		public function add_columns( $columns ) {
			$image_count = array( 'lsvr_listing_address' => esc_html__( 'Address', 'lsvr-directory' ) );
			$columns = array_slice( $columns, 0, 2, true ) + $image_count + array_slice( $columns, 1, NULL, true );
			return $columns;
		}

		// Display custom columns in admin view
		public function display_columns( $column ) {
			global $post;
			global $typenow;
			if ( 'lsvr_listing' == $typenow && 'lsvr_listing_address' === $column ) {

				// Get listing address
				$lsvr_listing_address = get_post_meta( $post->ID, 'lsvr_listing_address', true );
				if ( ! empty( $lsvr_listing_address ) ) {
					echo esc_html( $lsvr_listing_address );
				}

			}
		}

	}
}

?>