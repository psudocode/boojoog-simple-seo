<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://boojoog.com
 * @since             1.0.0
 * @package           Boojoog_Simple_Seo
 *
 * @wordpress-plugin
 * Plugin Name:       Boojoog Simple SEO
 * Plugin URI:        https://saas.boojoog.com
 * Description:       Boojoog Simple SEO makes SEO easy for everyone. It’s simple and clear to use, yet powered by smart features under the hood that help your site perform better in search engines—no SEO expertise required.
 * Version:           1.0.0
 * Author:            Ahmad Awdiyanto
 * Author URI:        https://boojoog.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       boojoog-simple-seo
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('BOOJOOG_SIMPLE_SEO_VERSION', '1.0.0');
define('BOOJOOG_SIMPLE_SEO_NAMESPACE', 'bss_');

/**
 * Callback function for the main admin page.
 */
function boojoog_admin_page()
{
	// Include the main admin page template
	require_once plugin_dir_path(__FILE__) . 'admin/partials/boojoog-simple-seo-admin-display.php';
}

function boojoog_seo_settings()
{
	// Include the settings page template
	require_once plugin_dir_path(__FILE__) . 'admin/partials/boojoog-simple-seo-admin-settings.php';
}
function boojoog_seo_about()
{
	// Include the about page template
	require_once plugin_dir_path(__FILE__) . 'admin/partials/boojoog-simple-seo-admin-about.php';
}


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-boojoog-simple-seo-activator.php
 */
function activate_boojoog_simple_seo()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-boojoog-simple-seo-activator.php';
	Boojoog_Simple_Seo_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-boojoog-simple-seo-deactivator.php
 */
function deactivate_boojoog_simple_seo()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-boojoog-simple-seo-deactivator.php';
	Boojoog_Simple_Seo_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_boojoog_simple_seo');
register_deactivation_hook(__FILE__, 'deactivate_boojoog_simple_seo');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-boojoog-simple-seo.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_boojoog_simple_seo()
{

	$plugin = new Boojoog_Simple_Seo();
	$plugin->run();

}
run_boojoog_simple_seo();


