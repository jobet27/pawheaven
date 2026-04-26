<?php
/**
 * Custom Meta Boxes for Animal Post Type
 */

function pawhaven_add_animal_metaboxes() {
    add_meta_box(
        'animal_details',
        __( 'Animal Details', 'pawhaven' ),
        'pawhaven_animal_details_callback',
        'animal',
        'normal',
        'high'
    );
    // Stat Details
    add_meta_box(
        'stat_details',
        __( 'Stat Details', 'pawhaven' ),
        'pawhaven_stat_details_callback',
        'impact_stat'
    );
}
add_action( 'add_meta_boxes', 'pawhaven_add_animal_metaboxes' );

/**
 * Callbacks
 */
function pawhaven_animal_details_callback( $post ) {
    wp_nonce_field( 'pawhaven_animal_meta_nonce', 'pawhaven_animal_meta_box_nonce' );

    $status = get_post_meta( $post->ID, '_animal_status', true );
    $temperament = get_post_meta( $post->ID, '_animal_temperament', true );
    ?>
    <p>
        <label for="animal_status"><strong><?php _e( 'Adoption Status:', 'pawhaven' ); ?></strong></label><br>
        <select name="animal_status" id="animal_status" style="width:100%; padding:10px; margin-top:5px;">
            <option value="available" <?php selected( $status, 'available' ); ?>><?php _e( 'Available', 'pawhaven' ); ?></option>
            <option value="pending" <?php selected( $status, 'pending' ); ?>><?php _e( 'Pending Adoption', 'pawhaven' ); ?></option>
            <option value="adopted" <?php selected( $status, 'adopted' ); ?>><?php _e( 'Adopted', 'pawhaven' ); ?></option>
            <option value="urgent" <?php selected( $status, 'urgent' ); ?>><?php _e( 'Urgent Case', 'pawhaven' ); ?></option>
        </select>
    </p>

    <p>
        <label for="animal_temperament"><strong><?php _e( 'Temperament:', 'pawhaven' ); ?></strong></label><br>
        <input type="text" name="animal_temperament" id="animal_temperament" value="<?php echo esc_attr( $temperament ); ?>" style="width:100%; padding:10px; margin-top:5px;" placeholder="<?php _e( 'e.g. Playful, Calm, Loves Kids', 'pawhaven' ); ?>">
    </p>
    <?php
}

function pawhaven_stat_details_callback( $post ) {
    wp_nonce_field( 'pawhaven_stat_meta_nonce', 'pawhaven_stat_meta_box_nonce' );

    $value = get_post_meta( $post->ID, '_stat_value', true );
    $icon = get_post_meta( $post->ID, '_stat_icon', true );
    $suffix = get_post_meta( $post->ID, '_stat_suffix', true ) ?: '+';
    ?>
    <p>
        <label for="stat_icon"><strong><?php _e( 'Icon (Emoji):', 'pawhaven' ); ?></strong></label><br>
        <input type="text" name="stat_icon" id="stat_icon" value="<?php echo esc_attr( $icon ); ?>" style="width:100%; padding:10px;">
    </p>
    <p>
        <label for="stat_value"><strong><?php _e( 'Value (Number):', 'pawhaven' ); ?></strong></label><br>
        <input type="number" name="stat_value" id="stat_value" value="<?php echo esc_attr( $value ); ?>" style="width:100%; padding:10px;">
    </p>
    <p>
        <label for="stat_suffix"><strong><?php _e( 'Suffix (e.g. +, k+):', 'pawhaven' ); ?></strong></label><br>
        <input type="text" name="stat_suffix" id="stat_suffix" value="<?php echo esc_attr( $suffix ); ?>" style="width:100%; padding:10px;">
    </p>
    <?php
}

function pawhaven_save_animal_meta( $post_id ) {
    // Nonce check for animal
    if ( isset( $_POST['pawhaven_animal_meta_box_nonce'] ) && wp_verify_nonce( $_POST['pawhaven_animal_meta_box_nonce'], 'pawhaven_animal_meta_nonce' ) ) {
        if ( isset( $_POST['animal_status'] ) ) update_post_meta( $post_id, '_animal_status', sanitize_text_field( $_POST['animal_status'] ) );
        if ( isset( $_POST['animal_temperament'] ) ) update_post_meta( $post_id, '_animal_temperament', sanitize_text_field( $_POST['animal_temperament'] ) );
    }

    // Nonce check for stats
    if ( isset( $_POST['pawhaven_stat_meta_box_nonce'] ) && wp_verify_nonce( $_POST['pawhaven_stat_meta_box_nonce'], 'pawhaven_stat_meta_nonce' ) ) {
        if ( isset( $_POST['stat_value'] ) ) update_post_meta( $post_id, '_stat_value', sanitize_text_field( $_POST['stat_value'] ) );
        if ( isset( $_POST['stat_icon'] ) ) update_post_meta( $post_id, '_stat_icon', sanitize_text_field( $_POST['stat_icon'] ) );
        if ( isset( $_POST['stat_suffix'] ) ) update_post_meta( $post_id, '_stat_suffix', sanitize_text_field( $_POST['stat_suffix'] ) );
    }
}
add_action( 'save_post', 'pawhaven_save_animal_meta' );
