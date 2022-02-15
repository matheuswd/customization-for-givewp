<?php
/**
 * Plugin Name: Customization For GiveWP
 * Plugin URI:  https://matheuswd.com.br/customization-for-givewp
 * Description: It adds some customization options for GiveWP that doesn't come out of the box.
 * Version:     0.0.1
 * Author:      Matheus de Almeida Martins
 * Author URI:  https://matheuswd.com.br
 * Text Domain: customization-for-givewp
 * Domain Path: /languages
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

 /*
Customization For GiveWP is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Customization For GiveWP is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Customization For GiveWP. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

// register_activation_hook( __FILE__, 'customization_for_givewp_activate' );

// register_deactivation_hook( __FILE__, 'customization_for_givewp_deactivate' );

function customization_for_givewp_subpage() {
	add_submenu_page(
		'tools.php',
		'Customization for GiveWP',
		'Customization for GiveWP',
		'manage_options',
		'customization_for_givewp_subpage',
		'customization_for_givewp_subpage'
	);
}

add_action('admin_menu', 'customization_for_givewp_subpage');

/**
 * custom option and settings
 */
function customization_for_givewp_settings_init() {
    // Register a new setting for "wporg" page.
    register_setting( 'wporg', 'customization_for_givewp_options' );

	// MINE
	register_setting( 'pdf_receipt_background_color', 'customization_for_givewp_options' );

    // Register a new section in the "wporg" page.
    add_settings_section(
        'customization_for_givewp_section_developers',
        __( 'PDF Receipt Background Color', 'wporg' ), 'customization_for_givewp_section_developers_callback',
        'wporg'
    );
 
    // Register a new field in the "customization_for_givewp_section_developers" section, inside the "wporg" page.
    add_settings_field(
        'customization_for_givewp_field_pill', // As of WP 4.6 this value is used only internally.
                                // Use $args' label_for to populate the id inside the callback.
            __( 'Pill', 'wporg' ),
        'customization_for_givewp_field_pill_cb',
        'wporg',
        'customization_for_givewp_section_developers',
        array(
            'label_for'         => 'customization_for_givewp_field_pill',
            'class'             => 'customization_for_givewp_row',
            'customization_for_givewp_custom_data' => 'custom',
        )
    );
}
 
/**
 * Register our customization_for_givewp_settings_init to the admin_init action hook.
 */
add_action( 'admin_init', 'customization_for_givewp_settings_init' );
 
 
/**
 * Custom option and settings:
 *  - callback functions
 */
 
 
/**
 * Developers section callback function.
 *
 * @param array $args  The settings array, defining title, id, callback.
 */
function customization_for_givewp_section_developers_callback( $args ) {
    ?>
    <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Select the options for the PDF Receipts add-on', 'customization_for_givewp' ); ?></p>
    <?php
}
 
/**
 * Pill field callbakc function.
 *
 * WordPress has magic interaction with the following keys: label_for, class.
 * - the "label_for" key value is used for the "for" attribute of the <label>.
 * - the "class" key value is used for the "class" attribute of the <tr> containing the field.
 * Note: you can add custom key value pairs to be used inside your callbacks.
 *
 * @param array $args
 */
function customization_for_givewp_field_pill_cb( $args ) {
    // Get the value of the setting we've registered with register_setting()
    $options = get_option( 'customization_for_givewp_options' );
    ?>
    <select
            id="<?php echo esc_attr( $args['label_for'] ); ?>"
            data-custom="<?php echo esc_attr( $args['customization_for_givewp_custom_data'] ); ?>"
            name="customization_for_givewp_options[<?php echo esc_attr( $args['label_for'] ); ?>]">
        <option value="red" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'red pill', 'wporg' ); ?>
        </option>
        <option value="blue" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'blue', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'blue pill', 'wporg' ); ?>
        </option>
    </select>
    <p class="description">
        <?php esc_html_e( 'You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.', 'wporg' ); ?>
    </p>
    <p class="description">
        <?php esc_html_e( 'You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.', 'wporg' ); ?>
    </p>
	
	<select
            id="<?php echo esc_attr( $args['label_for'] ); ?>"
            data-custom="<?php echo esc_attr( $args['customization_for_givewp_custom_data'] ); ?>"
            name="customization_for_givewp_options[<?php echo esc_attr( $args['label_for'] ); ?>]">
        <option value="red" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'red pill', 'wporg' ); ?>
        </option>
        <option value="blue" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'blue', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'blue pill', 'wporg' ); ?>
        </option>
    </select>
    <p class="description">
        <?php esc_html_e( 'You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.', 'wporg' ); ?>
    </p>
    <p class="description">
        <?php esc_html_e( 'You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.', 'wporg' ); ?>
    </p>
    <?php
}
 
/**
 * Add the top level menu page.
 */
function customization_for_givewp_options_page() {
    add_menu_page(
        'WPOrg',
        'WPOrg Options',
        'manage_options',
        'wporg',
        'customization_for_givewp_options_page_html'
    );
}
 
 
/**
 * Register our customization_for_givewp_options_page to the admin_menu action hook.
 */
add_action( 'admin_menu', 'customization_for_givewp_options_page' );
 
 
/**
 * Top level menu callback function
 */
function customization_for_givewp_options_page_html() {
    // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
 
    // add error/update messages
 
    // check if the user have submitted the settings
    // WordPress will add the "settings-updated" $_GET parameter to the url
    if ( isset( $_GET['settings-updated'] ) ) {
        // add settings saved message with the class of "updated"
        add_settings_error( 'customization_for_givewp_messages', 'customization_for_givewp_message', __( 'Settings Saved', 'wporg' ), 'updated' );
    }
 
    // show error/update messages
    settings_errors( 'customization_for_givewp_messages' );
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "wporg"
            settings_fields( 'wporg' );
            // output setting sections and their fields
            // (sections are registered for "wporg", each field is registered to a specific section)
            do_settings_sections( 'wporg' );
            // output save settings button
            submit_button( 'Save Settings' );
            ?>
        </form>
    </div>
    <?php
}