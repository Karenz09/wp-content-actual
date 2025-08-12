<?php
/**
 * External attachment metafield class
 */
if ( ! class_exists( 'Lsvr_Post_Metafield_External_Attachment' ) && class_exists( 'Lsvr_Post_Metafield' ) ) {
    class Lsvr_Post_Metafield_External_Attachment extends Lsvr_Post_Metafield {

    	public function __construct( $args ) {
    		parent::__construct( $args );
    	}

    	// Display field
    	public function display_metafield() {

            $remove_btn_label = esc_html__( 'Remove', 'lsvr-framework' );

            // Parse saved attachments
            if ( ! empty( $this->current_value ) ) {

                // Check if JSON
                json_decode( $this->current_value );
                if ( json_last_error() === JSON_ERROR_NONE ) {

                    $current_attachments = json_decode( $this->current_value, true );

                }

                // Old version
                else {

                    $current_attachments = array();
                    $current_attachments_old = explode( '|', $this->current_value );
                    foreach ( $current_attachments_old as $value ) {
                        array_push( $current_attachments, array( 'url' => $value ) );
                    }

                }

            } else {
                $current_attachments = false;
            }

    		?>

            <div class="lsvr-post-metafield-ext-attachment">

        		<input type="hidden" value="<?php echo esc_attr( $this->current_value ); ?>"
    				class="lsvr-post-metafield__value lsvr-post-metafield-ext-attachment__value"
    				id="<?php echo esc_attr( $this->input_id ); ?>"
    				name="<?php echo esc_attr( $this->input_id ); ?>">

                <div class="lsvr-post-metafield-ext-attachment__item-list-wrapper"
                    <?php if ( empty( $current_attachments ) ) : ?>style="display: none;"<?php endif; ?>>

                    <ul class="lsvr-post-metafield-ext-attachment__item-list">

                        <?php // Display current attachments
                        if ( ! empty( $current_attachments ) ) : ?>

                            <?php foreach( $current_attachments as $attachment ) : ?>

                                <li class="lsvr-post-metafield-ext-attachment__item"
                                    data-encoded-url="<?php echo esc_attr( $attachment['url'] ); ?>"
                                    <?php if ( ! empty( $attachment['title'] ) ) : ?>
                                        data-title="<?php echo esc_attr( $attachment['title'] ); ?>"
                                    <?php endif; ?>>

                                    <div class="lsvr-post-metafield-ext-attachment__item-inner">

                                        <?php if ( ! empty( $attachment['title'] ) ) : ?>

                                            <?php echo esc_html( $attachment['title'] ); ?>
                                            (<em><?php echo esc_html( urldecode( $attachment['url'] ) ); ?></em>)

                                        <?php else : ?>

                                            <?php echo esc_html( urldecode( $attachment['url'] ) ); ?>

                                        <?php endif; ?>

                                        <button class="lsvr-post-metafield-ext-attachment__btn-remove" type="button"><i class="dashicons dashicons-no-alt"></i></button>

                                    </div>

                                </li>

                            <?php endforeach; ?>

                        <?php endif; ?>

                    </ul>

                    <p class="howto lsvr-post-metafield-ext-attachment__hint">
                        <?php esc_html_e( 'You can rearrange items via drag and drop', 'lsvr-framework' ); ?>
                    </p>

                </div>

                <div class="lsvr-post-metafield-ext-attachment__form-wrapper">

                    <p class="lsvr-post-metafield-ext-attachment__input-wrapper">
                        <label class="lsvr-post-metafield-ext-attachment__input-label"
                            for="<?php echo esc_attr( $this->metafield_id ); ?>-title-input">
                            <?php esc_html_e( 'Attachment Title', 'lsvr-framework' ); ?>
                        </label>
                        <input type="text" class="lsvr-post-metafield-ext-attachment__title-input"
                            id="<?php echo esc_attr( $this->metafield_id ); ?>-title-input"
                            name="<?php echo esc_attr( $this->metafield_id ); ?>-title-input">
                    </p>

                    <p class="lsvr-post-metafield-ext-attachment__input-wrapper">
                        <label class="lsvr-post-metafield-ext-attachment__input-label"
                            for="<?php echo esc_attr( $this->metafield_id ); ?>-url-input">
                            <?php esc_html_e( 'Attachment URL', 'lsvr-framework' ); ?>
                        </label>
                        <input type="text" class="lsvr-post-metafield-ext-attachment__url-input"
                            id="<?php echo esc_attr( $this->metafield_id ); ?>-url-input"
                            name="<?php echo esc_attr( $this->metafield_id ); ?>-url-input">
                    </p>

                    <button type="button" class="button button-primary button-large lsvr-post-metafield-ext-attachment__btn-add">
                        <?php esc_html_e( 'Add External Attachment', 'lsvr-framework' ); ?>
                    </button>

                </div>

            </div>

    		<?php
    	}

    }
}

?>