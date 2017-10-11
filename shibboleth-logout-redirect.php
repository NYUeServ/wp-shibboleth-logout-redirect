<?php

/**
 *
 * @link              https://github.com/NYUeServ/wp-shibboleth-logout-redirect
 * @since             1.0.0
 * @package           shibboleth_logout_redirect
 *
 * @wordpress-plugin
 * Plugin Name:       Shibboleth Logout Redirect
 * Plugin URI:        https://github.com/NYUeServ/wp-shibboleth-logout-redirect
 * Description:       Force redirect to custom Shibboleth endpoint after performing local wordpress logout. This addresses inconsistent Shibboleth logout issue while wordpress is behind a load balancer and using Shibboleth Sticky Sessions.
 * Version:           1.0.0
 * Author:            Neel Shah
 * Author URI:        https://neelshah.info
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       shibboleth-logout-redirect
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-shibboleth-logout-redirect-activator.php
 */
function activate_shibboleth_logout_redirect() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-shibboleth-logout-redirect-activator.php';
	Shibboleth_Logout_Redirect_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-shibboleth-logout-redirect-deactivator.php
 */
function deactivate_shibboleth_logout_redirect() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-shibboleth-logout-redirect-deactivator.php';
	Shibboleth_Logout_Redirect_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_shibboleth_logout_redirect' );
register_deactivation_hook( __FILE__, 'deactivate_shibboleth_logout_redirect' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-shibboleth-logout-redirect.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_shibboleth_logout_redirect() {

	$plugin = new Shibboleth_Logout_Redirect();
	$plugin->run();

}
run_shibboleth_logout_redirect();
