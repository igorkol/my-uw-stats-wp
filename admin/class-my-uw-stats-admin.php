<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 * @author     Your Name <email@example.com>
 */
class my_uw_stats_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $my_uw_stats;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $my_uw_stats, $version ) {

		$this->my_uw_stats = $my_uw_stats;
		$this->version = $version;
		var_dump ($version);

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->my_uw_stats, plugin_dir_url( __FILE__ ) . 'css/my-uw-stats-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->my_uw_stats, plugin_dir_url( __FILE__ ) . 'js/my-uw-stats-admin.js', array( 'jquery' ), $this->version, false );

	}

}

/**
 * custom option and settings
 */
function my_uw_stats_settings_init() {
	// register a new setting for "my_uw_stats" page
	register_setting( 'my_uw_stats', 'my_uw_stats_options' );
	
	// register a new section in the "my_uw_stats" page
	add_settings_section(
	'my_uw_stats_section_developers',
	__( 'The Matrix has you.', 'my_uw_stats' ),
	'my_uw_stats_section_developers_cb',
	'my_uw_stats'
	);
	
	// register a new field in the "my_uw_stats_section_developers" section, inside the "my_uw_stats" page
	add_settings_field(
	'my_uw_stats_field_pill', // as of WP 4.6 this value is used only internally
	// use $args' label_for to populate the id inside the callback
	__( 'Pill', 'my_uw_stats' ),
	'my_uw_stats_field_pill_cb',
	'my_uw_stats',
	'my_uw_stats_section_developers',
	[
	'label_for' => 'my_uw_stats_field_pill',
	'class' => 'my_uw_stats_row',
	'my_uw_stats_custom_data' => 'custom',
	]
	);
   }
	
   /**
	* register our my_uw_stats_settings_init to the admin_init action hook
	*/
   add_action( 'admin_init', 'my_uw_stats_settings_init' );
	
   /**
	* custom option and settings:
	* callback functions
	*/
	
   // developers section cb
	
   // section callbacks can accept an $args parameter, which is an array.
   // $args have the following keys defined: title, id, callback.
   // the values are defined at the add_settings_section() function.
   function my_uw_stats_section_developers_cb( $args ) {
	?>
	<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Follow the white rabbit.', 'my_uw_stats' ); ?></p>
	<?php
   }
	
   // pill field cb
	
   // field callbacks can accept an $args parameter, which is an array.
   // $args is defined at the add_settings_field() function.
   // wordpress has magic interaction with the following keys: label_for, class.
   // the "label_for" key value is used for the "for" attribute of the <label>.
   // the "class" key value is used for the "class" attribute of the <tr> containing the field.
   // you can add custom key value pairs to be used inside your callbacks.
   function my_uw_stats_field_pill_cb( $args ) {
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
	
   /**
	* top level menu
	*/
   function my_uw_stats_options_page() {
	// add top level menu page
	add_menu_page(
	'my_uw_stats',
	'my_uw_stats Options',
	'manage_options',
	'my_uw_stats',
	'my_uw_stats_options_page_html'
	);
   }
	
   /**
	* register our my_uw_stats_options_page to the admin_menu action hook
	*/
   add_action( 'admin_menu', 'my_uw_stats_options_page' );
	
   /**
	* top level menu:
	* callback functions
	*/
   function my_uw_stats_options_page_html() {
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
	settings_fields( 'my_uw_stats' );
	// output setting sections and their fields
	// (sections are registered for "my_uw_stats", each field is registered to a specific section)
	do_settings_sections( 'my_uw_stats' );
	// output save settings button
	submit_button( 'Save Settings' );
	?>
	</form>
	</div>
	<?php
   }
