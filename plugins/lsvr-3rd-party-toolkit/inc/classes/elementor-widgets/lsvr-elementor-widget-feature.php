<?php
/**
 * LSVR Feature Elementor Widget
 */
if ( ! class_exists( 'Lsvr_Elementor_Widget_Feature' ) ) {
    class Lsvr_Elementor_Widget_Feature extends \Elementor\Widget_Base {

		public function get_name() {
			return 'lsvr_feature';
		}

		public function get_title() {
			return esc_html__( 'LSVR Feature', 'lsvr-3rd-party-toolkit' );
		}

		public function get_icon() {
			return 'fa fa-star';
		}

		public function get_categories() {
			return [ 'lsvr-elements' ];
		}

		protected function _register_controls() {

			$this->start_controls_section(
				'content_section', array(
					'label' => esc_html__( 'LSVR Feature', 'lsvr-3rd-party-toolkit' ),
				)
			);

			lsvr_3rd_party_toolkit_shortcode_atts_to_elementor_settings( $this, Lsvr_Shortcode_Feature::lsvr_shortcode_atts() );

			$this->end_controls_section();

		}

		protected function render() {

			lsvr_3rd_party_toolkit_elementor_settings_to_shortcode(
				new Lsvr_Shortcode_Feature,
				Lsvr_Shortcode_Feature::lsvr_shortcode_atts(),
				$this->get_settings_for_display()
			);

		}

    }
}
?>