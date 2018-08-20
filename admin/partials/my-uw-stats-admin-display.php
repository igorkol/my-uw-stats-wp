<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin/partials
 */

class my_uw_stats_admin_display {

public function my_uw_stats_section_developers_cb( $args ) {
    ?>
    <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'This is where the description will be coming.', 'my_uw_stats' ); ?></p>
    <?php
   }
    
   // pill field cb
    
   // field callbacks can accept an $args parameter, which is an array.
   // $args is defined at the add_settings_field() function.
   // wordpress has magic interaction with the following keys: label_for, class.
   // the "label_for" key value is used for the "for" attribute of the <label>.
   // the "class" key value is used for the "class" attribute of the <tr> containing the field.
   // you can add custom key value pairs to be used inside your callbacks.


public function my_uw_stats_field_pill_cb( $args ) {
    // get the value of the setting we've registered with register_setting()
    $options = get_option( 'my_uw_stats_options' );
    // output the field
    ?>
    <select id="<?php echo esc_attr( $args['label_for'] ); ?>"
    data-custom="<?php echo esc_attr( $args['my_uw_stats_custom_data'] ); ?>"
    name="my_uw_stats_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
    >
    <option value="red" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
    <?php esc_html_e( 'red pill', 'my_uw_stats' ); ?>
    </option>
    <option value="blue" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'blue', false ) ) : ( '' ); ?>>
    <?php esc_html_e( 'blue pill', 'my_uw_stats' ); ?>
    </option>
    </select>
    <p class="description">
    <?php esc_html_e( 'You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.', 'my_uw_stats' ); ?>
    </p>
    <p class="description">
    <?php esc_html_e( 'You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.', 'my_uw_stats' ); ?>
    </p>
    <?php
   }

}
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
