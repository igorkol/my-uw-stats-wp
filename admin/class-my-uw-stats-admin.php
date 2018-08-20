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
		$this->admin_settings_hooks();
	}


   /**
	* register our my_uw_stats_settings_init to the admin_init action hook
	*/
	public function admin_settings_hooks (){
		add_action( 'admin_init', array($this, 'admin_settings_init'));
	}
	
	public function admin_settings_init (){
		// register a new setting for "my_uw_stats" page
		register_setting( 'my_uw_stats', 'my_uw_stats_options' );
			
		$partial_display = new my_uw_stats_admin_display();

		// register a new section in the "my_uw_stats" page
		add_settings_section(
		'my_uw_stats_section_developers',
		__( 'Numbers', 'my_uw_stats' ),
		array($partial_display, 'my_uw_stats_section_developers_cb'),
		'my_uw_stats'
		);

		// register a new field in the "my_uw_stats_section_developers" section, inside the "my_uw_stats" page
		add_settings_field(
		'my_uw_stats_field_pill', // as of WP 4.6 this value is used only internally
		// use $args' label_for to populate the id inside the callback
		__( 'Pill', 'my_uw_stats' ),
		array($partial_display, 'my_uw_stats_field_pill_cb'),
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
	* top level menu
	*/
   function my_uw_stats_options_page() {
	// add top level menu page
	add_management_page(
	'My Upwork Statistics',
	'Upwork Statistics Options',
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
