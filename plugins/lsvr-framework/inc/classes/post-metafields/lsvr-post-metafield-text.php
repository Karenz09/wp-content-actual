<?php
/**
 * Text metafield class
 */
if ( ! class_exists( 'Lsvr_Post_Metafield_Text' ) && class_exists( 'Lsvr_Post_Metafield' ) ) {
    class Lsvr_Post_Metafield_Text extends Lsvr_Post_Metafield {

    	public function __construct( $args ) {
    		parent::__construct( $args );
    	}

    	// Display field
    	public function display_metafield() {
    		?>

    		<input type="text" value="<?php echo esc_attr( $this->current_value ); ?>"
				class="lsvr-post-metafield__value regular-text lsvr-post-metafield-text<?php if ( ! empty( $this->args['content_type'] ) && 'number' === $this->args['content_type'] ) { echo ' lsvr-post-metafield-text--number'; } ?>"
				id="<?php echo esc_attr( $this->input_id ); ?>" name="<?php echo esc_attr( $this->input_id ); ?>"
                <?php if ( ! empty( $this->args['placeholder'] ) ) { echo ' placeholder="' . esc_attr( $this->args['placeholder'] ) . '"'; } ?>>

    		<?php
    	}

        // Sanitize metafield value before saving
        public static function sanitize_before_save( $value ) {

            // Allow only some HTML tags
            return wp_kses( $value, array(
                'a' => array(
                    'href' => array(),
                    'title' => array(),
                    'class' => array(),
                ),
                'br' => array(),
                'strong' => array(),
                'span' => array(
                    'class' => array(),
                ),
                'p' => array(),
            ));

        }

    }
}

?>