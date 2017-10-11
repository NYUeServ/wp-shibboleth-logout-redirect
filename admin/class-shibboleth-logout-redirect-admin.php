<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/neelakansha85/shibboleth-logout-redirect/
 * @since      1.0.0
 *
 * @package    Shibboleth_Logout_Redirect
 * @subpackage Shibboleth_Logout_Redirect/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Shibboleth_Logout_Redirect
 * @subpackage Shibboleth_Logout_Redirect/admin
 * @author     Neel Shah <shah.neel@nyu.edu>
 */
class Shibboleth_Logout_Redirect_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $shibboleth_logout_redirect    The ID of this plugin.
	 */
	private $shibboleth_logout_redirect;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The option name is database for this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $options_name    The option name is database for this plugin.
	 */
	private $options_name;

	/**
	 * The site settings for this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $settings    The site settings for this plugin.
	 */
	private $settings;

	/**
	 * The network setting for this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $network_settings    The network setting for this plugin.
	 */
	private $network_settings;

	/**
	 * The current settings relative to network admin or site admin page for this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $current_settings    The current settings relative to network admin or site admin page for this plugin.
	 */
	private $current_settings;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $shibboleth_logout_redirect       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $shibboleth_logout_redirect, $version ) {

		$this->shibboleth_logout_redirect = $shibboleth_logout_redirect;
		$this->version = $version;

		$this->options_name = 'shibboleth_logout_redirect_options';
		$this->settings = $this->get_options();
        $this->network_settings = $this->get_options(null, 'network');
        $this->current_settings = is_network_admin() ? $this->network_settings : $this->settings;

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
		 * defined in Shibboleth_Logout_Redirect_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Shibboleth_Logout_Redirect_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->shibboleth_logout_redirect, plugin_dir_url( __FILE__ ) . 'css/shibboleth-logout-redirect-admin.css', array(), $this->version, 'all' );

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
		 * defined in Shibboleth_Logout_Redirect_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Shibboleth_Logout_Redirect_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->shibboleth_logout_redirect, plugin_dir_url( __FILE__ ) . 'js/shibboleth-logout-redirect-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
     * Add network admin menu
     *
     * @access public
     */
    public function network_admin_menu() {
        add_submenu_page( 'settings.php', 'Shibboleth Logout Redirect', 'Shibboleth Logout Redirect', 'manage_network', 'shibboleth-logout-redirect-settings', array( &$this, 'network_settings_page_display' ) );
    }

	/**
     * Load network settings page
     *
     * @access public
     */
    public function network_settings_page_display() {
        /* Get Network settings */
        $this->site_settings_page_display( 'network' );
    }

    /**
     * Admin options page output
     *
     * @access private
     */
    private function site_settings_page_display( $network = '' ) {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/shibboleth-logout-redirect-admin-display.php';
    }

    /**
     * Update Settings
     *
     * @access public
     */
    public function save_settings() {
        if ( isset( $_POST['submit'] ) ) {
        	echo "Inside save settings";
            if ( wp_verify_nonce( $_POST['_wpnonce'], 'submit_slr_settings_network' ) ) {
            	//save network settings
                echo "Inside Network save settings";
                $this->save_options( array('slr_settings' => $_POST), 'network' );

                wp_redirect( add_query_arg( array( 'page' => 'shibboleth-logout-redirect-settings', 'dmsg' => urlencode( __( 'Changes were saved!', $this->text_domain ) ) ), 'settings.php' ) );
                exit;
            }
            elseif ( wp_verify_nonce( $_POST['_wpnonce'], 'submit_slr_settings' ) ) {
            //save settings

                $this->save_options( array('slr_settings' => $_POST) );

                wp_redirect( add_query_arg( array( 'page' => 'shibboleth-logout-redirect-settings', 'dmsg' => urlencode( __( 'Changes were saved!', $this->text_domain ) ) ), 'options-general.php' ) );
                exit;
            }
        }
    }

    /**
     * Save plugin options.
     *
     * @access private
     * @param  array $params The $_POST array
     */
    private function save_options( $params, $network = ''  ) {
        /* Remove unwanted parameters */
        unset( $params['_wpnonce'], $params['_wp_http_referer'], $params['submit'] );
        /* Update options by merging the old ones */
        if ( '' == $network )
            $options = get_option( $this->options_name );
        else
            $options = get_site_option( $this->options_name );

        if(!is_array($options))
            $options = array();

        $options = array_merge( $options, $params );

        if ( '' == $network )
            update_option( $this->options_name, $options );
        else
            update_site_option( $this->options_name, $options );
    }

    /**
     * Get plugin options.
     *
     * @access private
     * @param  string|NULL $key The key for that plugin option.
     * @return array $options Shibboleth Logout Redirect plugin options or empty array if no options are found
     */
    private function get_options( $key = null, $network = '' ) {
        if ( '' == $network )
            $options = get_option( $this->options_name );
        else
            $options = get_site_option( $this->options_name );

        /* Check if specific plugin option is requested and return it */
        if ( isset( $key ) && array_key_exists( $key, $options ) )
            return $options[$key];
        else
            return $options;
    }

    /**
     * Auto redirect to external Logout endpoint for Shibboleth Single Sign On.
     *
     * @since    1.0.0
     */
    public function auto_redirect_external_after_logout(){
        if (!empty($this->network_settings['slr_settings']['slr_settings_logout_redirect_url'])) {
            $logout_redirect_url = $this->network_settings['slr_settings']['slr_settings_logout_redirect_url'];
        }
        else {
            $logout_redirect_url = "";
        }
        // $logout_redirect_url = "https://shibboleth.nyu.edu/idp/profile/Logout";
        wp_redirect( $logout_redirect_url );
        exit();
    }
}
