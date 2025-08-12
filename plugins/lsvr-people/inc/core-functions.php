<?php

/**
 * Return person contact info.
 *
 * @param int 	$post_id		Post ID of lsvr_person post.
 *
 * @return array 	Social links.
 */
if ( ! function_exists( 'lsvr_people_get_person_contact_info' ) ) {
	function lsvr_people_get_person_contact_info( $post_id ) {

		$contact_info = array();
		$default_contact_fields = array(
			'email' => esc_html__( 'Email', 'lsvr-people' ),
			'phone' => esc_html__( 'Phone', 'lsvr-people' ),
			'website' => esc_html__( 'Website', 'lsvr-people' )
		);

		// Parse predefined fields
		foreach ( $default_contact_fields as $profile_id => $profile_title ) {

			$profile_label = get_post_meta( $post_id, 'lsvr_person_' . $profile_id, true );

			if ( ! empty( $profile_label ) ) {

				// Parse predefined fields
				if ( true === apply_filters( 'lsvr_person_contact_info_parse_predefined', true ) && 0 === preg_match( "/<[^<]+>/", $profile_label, $m ) ) {

					// Email
					if ( 'email' === $profile_id ) {
						$profile_label = '<a href="mailto:' . esc_attr( $profile_label ) . '">' . $profile_label . '</a>';
					}

					// Phone
					elseif ( 'phone' === $profile_id ) {
						$profile_label = '<a href="tel:' . esc_attr( str_replace( array( ' ', '(', ')', '-' ), '', $profile_label ) ) . '">' . $profile_label . '</a>';
					}

					// Website
					elseif ( 'website' === $profile_id ) {
						$profile_label = '<a href="' . esc_url( $profile_label ) . '" target="_blank">' . $profile_label . '</a>';
					}

				}

				$contact_info[ $profile_id ] = array( 'label' => $profile_label, 'title' => $profile_title );

			}

		}

		// Parse custom fields
		for ( $i = 1; $i < 4; $i++ ) {

			$profile_icon = get_post_meta( $post_id, 'lsvr_person_custom_contact' . $i . '_icon', true );
			$profile_label = get_post_meta( $post_id, 'lsvr_person_custom_contact' . $i . '_label', true );
			$profile_title = get_post_meta( $post_id, 'lsvr_person_custom_contact' . $i . '_title', true );

			if ( ! empty( $profile_icon ) && ! empty( $profile_label ) ) {
				$contact_info[ 'custom' . $i ] = array(
					'icon' => $profile_icon,
					'label' => $profile_label,
				);
			}

			if ( ! empty( $profile_title ) ) {
				$contact_info[ 'custom' . $i ]['title'] = $profile_title;
			}

		}

		return array_merge( $contact_info, apply_filters( 'lsvr_person_contact_info', array() ) );

	}
}

/**
 * Return person social links.
 *
 * @param int 	$person_id		Post ID of lsvr_person post.
 *
 * @return array 	Social links.
 */
if ( ! function_exists( 'lsvr_people_get_person_social_links' ) ) {
	function lsvr_people_get_person_social_links( $person_id ) {

		$social_links = array();
		$predefined_social_fields = array(
			'twitter' => esc_html__( 'Twitter', 'lsvr-people' ),
			'facebook' => esc_html__( 'Facebook', 'lsvr-people' ),
			'linkedin' => esc_html__( 'LinkedIn', 'lsvr-people' ),
		);

		// Parse predefined fields
		foreach ( $predefined_social_fields as $profile => $label ) {

			$profile_url = get_post_meta( $person_id, 'lsvr_person_' . $profile, true );

			if ( ! empty( $profile_url ) ) {
				$social_links[ $profile ] = array(
					'url' => $profile_url,
					'label' => $label,
				);
			}

		}

		// Parse custom fields
		for ( $i = 1; $i < 4; $i++ ) {

			$profile_icon = get_post_meta( $person_id, 'lsvr_person_custom_social' . $i . '_icon', true );
			$profile_url = get_post_meta( $person_id, 'lsvr_person_custom_social' . $i . '_url', true );
			$profile_label = get_post_meta( $person_id, 'lsvr_person_custom_social' . $i . '_label', true );

			if ( ! empty( $profile_icon ) && ! empty( $profile_url ) ) {

				$social_links[ 'custom' . $i ] = array(
					'icon' => $profile_icon,
					'url' => $profile_url,
				);

				if ( ! empty( $profile_label ) ) {
					$social_links[ 'custom' . $i ]['label'] = $profile_label;
				}

			}

		}

		return array_merge( $social_links, apply_filters( 'lsvr_person_social_links', array() ) );

	}
}

?>