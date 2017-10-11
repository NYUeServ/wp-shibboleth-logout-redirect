<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/neelakansha85/shibboleth-logout-redirect/
 * @since      1.0.0
 *
 * @package    Shibboleth_Logout_Redirect
 * @subpackage Shibboleth_Logout_Redirect/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Shibboleth_Logout_Redirect
 * @subpackage Shibboleth_Logout_Redirect/includes
 * @author     Neel Shah <shah.neel@nyu.edu>
 */
class Shibboleth_Logout_Redirect_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'shibboleth-logout-redirect',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
