<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://boojoog.com
 * @since      1.0.0
 *
 * @package    Boojoog_Simple_Seo
 * @subpackage Boojoog_Simple_Seo/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Boojoog_Simple_Seo
 * @subpackage Boojoog_Simple_Seo/admin
 * @author     Ahmad Awdiyanto <ahmad@boojoog.com>
 */
class Boojoog_Simple_Seo_Admin
{

	/**
	 * Loader instance for managing settings.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      Boojoog_Simple_Seo_Loader    $loader    The loader instance.
	 */
	private $loader;

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/boojoog-simple-seo-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/boojoog-simple-seo-admin.js', array('jquery'), $this->version, false);
		wp_enqueue_media();
	}

	public function add_admin_menu()
	{
		// add $this->plugin_name to the admin menu
		add_menu_page(
			'Boojoog SEO', // Page title
			'Boojoog SEO', // Menu title
			'manage_options', // Capability
			$this->plugin_name, // Menu slug
			'boojoog_admin_page', // Callback function
			'dashicons-admin-generic' // Icon
		);

		// Submenu: Dashboard
		add_submenu_page(
			$this->plugin_name, // Parent slug
			'Dashboard', // Page title
			'Dashboard', // Menu title
			'manage_options', // Capability
			$this->plugin_name, // Menu slug (same as main menu to make it the default)
			'boojoog_admin_page' // Callback function
		);

		// Submenu: Setup
		add_submenu_page(
			$this->plugin_name,
			'Settings',
			'Settings',
			'manage_options',
			$this->plugin_name . '-settings',
			'boojoog_seo_settings'
		);

		// Submenu: About
		add_submenu_page(
			$this->plugin_name,
			'About',
			'About',
			'manage_options',
			$this->plugin_name . '-about',
			'boojoog_seo_about'
		);
	}

	// sanitize_advanced_settings
	// sanitize_performance_settings
	// sanitize_email_notifications
	public function sanitize_advanced_settings($settings)
	{
		return [
			'enable_sitemap' => isset($settings['enable_sitemap']) ? true : false,
			'enable_breadcrumbs' => isset($settings['enable_breadcrumbs']) ? true : false,
			'enable_open_graph' => isset($settings['enable_open_graph']) ? true : false,
			'enable_twitter_cards' => isset($settings['enable_twitter_cards']) ? true : false,
			'enable_json_ld' => isset($settings['enable_json_ld']) ? true : false,
			'enable_schema_markup' => isset($settings['enable_schema_markup']) ? true : false
		];
	}
	public function sanitize_performance_settings($settings)
	{
		return [
			'enable_lazy_load' => isset($settings['enable_lazy_load']) ? true : false,
			'enable_minify_html' => isset($settings['enable_minify_html']) ? true : false,
			'enable_combine_css_js' => isset($settings['enable_combine_css_js']) ? true : false,
			'enable_async_js' => isset($settings['enable_async_js']) ? true : false
		];
	}
	public function sanitize_email_notifications($settings)
	{
		return [
			'enable_email_notifications' => isset($settings['enable_email_notifications']) ? true : false,
			'email_address' => sanitize_email($settings['email_address'] ?? '')
		];
	}
	public function init_settings()
	{

	}
}
