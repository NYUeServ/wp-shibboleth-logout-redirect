<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/NYUeServ/wp-shibboleth-logout-redirect
 * @since      1.0.0
 *
 * @package    Shibboleth_Logout_Redirect
 * @subpackage Shibboleth_Logout_Redirect/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Shibboleth_Logout_Redirect
 * @subpackage Shibboleth_Logout_Redirect/public
 * @author     Neel Shah <shah.neel@nyu.edu>
 */
class Shibboleth_Logout_Redirect_Public {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $shibboleth_logout_redirect       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $shibboleth_logout_redirect, $version ) {

		$this->shibboleth_logout_redirect = $shibboleth_logout_redirect;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->shibboleth_logout_redirect, plugin_dir_url( __FILE__ ) . 'css/shibboleth-logout-redirect-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->shibboleth_logout_redirect, plugin_dir_url( __FILE__ ) . 'js/shibboleth-logout-redirect-public.js', array( 'jquery' ), $this->version, false );

	}

}
