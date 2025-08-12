<?php
/**
 * Checkbox list widget field class
 */
if ( ! class_exists( 'Lsvr_Widget_Field_Checkbox_List' ) && class_exists( 'Lsvr_Widget_Field' ) ) {
    class Lsvr_Widget_Field_Checkbox_List extends Lsvr_Widget_Field {

    	public function __construct( $args ) {
    		parent::__construct( $args );
    	}

    	// Display field
    	public function display_field() {

            // Parse saved value to array
            $saved_value_arr = array();
            if ( ! empty( $this->saved_value ) && is_array( $this->saved_value ) ) {
                $saved_value_arr = $this->saved_value;
            } elseif ( ! empty( $this->saved_value ) ) {
                $saved_value_arr = json_decode( $this->saved_value );
                $saved_value_arr = 0 === json_last_error() ? $saved_value_arr : array();
            }?>

            <label class="lsvr-widget-field__label" for="<?php echo esc_attr( $this->input_id ); ?>">
                <?php echo esc_attr( $this->args['label'] ); ?>
            </label>
            <input type="hidden" class="lsvr-widget-field__input"
                value="<?php echo ! empty( $this->saved_value ) ? esc_attr( $this->saved_value ) : ''; ?>"
                id="<?php echo esc_attr( $this->input_id ); ?>"
                name="<?php echo esc_attr( $this->input_name ); ?>">

            <ul class="lsvr-widget-field__checkbox-list">

                <?php $i = 1; foreach ( $this->args['choices'] as $option_value => $option_label ) : ?>

                    <li class="lsvr-widget-field__checkbox-list-item">

                        <label class="lsvr-widget-field__checkbox-list-label"
                            for="<?php echo esc_attr( $this->input_id ); ?>-checkbox-<?php echo esc_html( $i ); ?>">
                            <input type="checkbox" class="lsvr-widget-field__checkbox-list-input"
                                value="<?php echo esc_attr( $option_value ); ?>"
                                id="<?php echo esc_attr( $this->input_id ); ?>-checkbox-<?php echo esc_html( $i ); ?>"
                                <?php if ( ! empty( $this->saved_value ) && in_array( $option_value, $saved_value_arr ) ) { echo ' checked="checked"'; } ?>>
                            <?php echo esc_html( $option_label ); ?>
                        </label>

                    </li>

                <?php $i++; endforeach; ?>

            </ul>

			<?php
    	}

    }
}