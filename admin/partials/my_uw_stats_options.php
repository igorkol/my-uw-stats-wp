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

class my_uw_stats_options {

	static private $class = null;

	public static function init() {
		if ( null === self::$class ) {
			self::$class = new self;
		}

		return self::$class;
	}

	public function __construct() {

		$this->admin_settings_init();
		$this->my_uw_stats_settings_pages_html();

	}

	public static function register_options() {

		// register a new setting for "my_uw_stats" page
		register_setting( 'my_uw_stats_options', 'my_uw_stats_options_key' );
		register_setting( 'my_uw_stats_options', 'my_uw_stats_options_secret' );

	}

	public function admin_settings_init() {

		// register a new section in the "my_uw_stats" page
		add_settings_section(
			'my_uw_stats_section_developers',
			__( 'API access data', 'my_uw_stats' ),
			array( $this, 'my_uw_stats_section_developers_cb' ),
			'my_uw_stats_options'
		);

		// register a new field in the "my_uw_stats_section_developers" section, inside the "my_uw_stats" page
		add_settings_field(
			'my_uw_stats_field_key', // as of WP 4.6 this value is used only internally
			// use $args' label_for to populate the id inside the callback
			__( 'Upwork Key', 'my_uw_stats' ),
			array( $this, 'my_uw_stats_field_key_cb' ),
			'my_uw_stats_options',
			'my_uw_stats_section_developers',
			[
				'label_for'               => 'my_uw_stats_field_key',
				'class'                   => 'my_uw_stats_row',
				'my_uw_stats_custom_data' => 'custom',
			]
		);
		add_settings_field(
			'my_uw_stats_field_secret', // as of WP 4.6 this value is used only internally
			// use $args' label_for to populate the id inside the callback
			__( 'Upwork Secret', 'my_uw_stats' ),
			array( $this, 'my_uw_stats_field_secret_cb' ),
			'my_uw_stats_options',
			'my_uw_stats_section_developers',
			[
				'label_for'               => 'my_uw_stats_field_secret',
				'class'                   => 'my_uw_stats_row',
				'my_uw_stats_custom_data' => 'custom',
			]
		);
	}

	public function my_uw_stats_section_developers_cb( $args ) {
		?>
        <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'You need to apply first to get an API access from Upwork. Go to https://bla.com first', 'my_uw_stats' ); ?></p>
		<?php
	}

	// pill field cb

	// field callbacks can accept an $args parameter, which is an array.
	// $args is defined at the add_settings_field() function.
	// wordpress has magic interaction with the following keys: label_for, class.
	// the "label_for" key value is used for the "for" attribute of the <label>.
	// the "class" key value is used for the "class" attribute of the <tr> containing the field.
	// you can add custom key value pairs to be used inside your callbacks.


	public function my_uw_stats_field_key_cb( $args ) {
		// get the value of the setting we've registered with register_setting()
		$options_key = get_option( 'my_uw_stats_options_key' );
		// output the field
		?>
        <input type="text" id="<?php echo esc_attr( $args['label_for'] ); ?>"
               data-custom="<?php echo esc_attr( $args['my_uw_stats_custom_data'] ); ?>"
               name="my_uw_stats_options_key"
               value="<?php echo isset( $options_key ) ? ( $options_key ) : ( '' ); ?>"
        />
		<?php
	}

	public function my_uw_stats_field_secret_cb( $args ) {
		// get the value of the setting we've registered with register_setting()
		$options_secret = get_option( 'my_uw_stats_options_secret' );
		// output the field
		?>
        <input type="text" id="<?php echo esc_attr( $args['label_for'] ); ?>"
               data-custom="<?php echo esc_attr( $args['my_uw_stats_custom_data'] ); ?>"
               name="my_uw_stats_options_secret"
               value="<?php echo isset( $options_secret ) ? ( $options_secret ) : ( '' ); ?>"
        >
		<?php
	}

	public function my_uw_stats_settings_pages_html() {
		// check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		// add error/update messages

		// check if the user have submitted the settings
		// wordpress will add the "settings-updated" $_GET parameter to the url
		if ( isset( $_GET['settings-updated'] ) ) {
			// add settings saved message with the class of "updated"
			add_settings_error( 'my_uw_stats_messages', 'my_uw_stats_message', __( 'Settings Saved', 'my_uw_stats' ), 'updated' );
		}

		// show error/update messages
		settings_errors( 'my_uw_stats_messages' );
		?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <form action="options.php" method="post">
				<?php
				// output security fields for the registered setting "my_uw_stats"
				settings_fields( 'my_uw_stats_options' );
				// output setting sections and their fields
				// (sections are registered for "my_uw_stats", each field is registered to a specific section)
				do_settings_sections( 'my_uw_stats_options' );
				// output save settings button
				submit_button( 'Save Settings' );
				?>
            </form>
        </div>
		<?php
	}

}

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
