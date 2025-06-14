<?php

/**
 * Fired during plugin activation
 *
 * @link       https://boojoog.com
 * @since      1.0.0
 *
 * @package    Boojoog_Simple_Seo
 * @subpackage Boojoog_Simple_Seo/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Boojoog_Simple_Seo
 * @subpackage Boojoog_Simple_Seo/includes
 * @author     Ahmad Awdiyanto <ahmad@boojoog.com>
 */
class Boojoog_Simple_Seo_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */

	public function __construct()
	{
		// You can initialize properties or methods here if needed
		// set namespace if needed
	}

	public static function setupOption($optionName, $options)
	{
		add_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . $optionName, $options);
	}
	public static function activate()
	{
		// // Register default options
		// // complete SEO options
		self::setupOption('site_settings', [
			'meta_title' => '',
			'meta_tagline' => '',
			'meta_description' => '',
			'meta_author' => '',
			'meta_robots' => 'index, follow',
			'favicon' => '',
			'logo' => '',
		]);

		// // options for social media
		self::setupOption('social_media', [
			'facebook' => '',
			'twitter' => '',
			'instagram' => '',
			'linkedin' => '',
			'youtube' => '',
			'pinterest' => '',
			'tiktok' => '',
			'snapchat' => '',
			'whatsapp' => '',
			'telegram' => '',
			'reddit' => '',
			'tumblr' => '',
			'mastodon' => ''
		]);

		// // options for advanced settings
		self::setupOption('advanced_settings', [
			'enable_sitemap' => true,
			'enable_breadcrumbs' => true,
			'enable_open_graph' => true,
			'enable_twitter_cards' => true,
			'enable_json_ld' => true,
			'enable_schema_markup' => true,
		]);

		// // options for performance
		self::setupOption('performance_settings', [
			'enable_lazy_load' => true,
			'enable_minify_html' => true,
			'enable_combine_css_js' => true,
			'enable_async_js' => true,
		]);

		// // options for security
		self::setupOption('security_settings', [
			'enable_security_headers' => true,
			'enable_content_security_policy' => true,
			'enable_x_frame_options' => true,
			'enable_x_content_type_options' => true,
			'enable_referrer_policy' => true,
		]);

		// // options for analytics
		self::setupOption('analytics_settings', [
			'google_analytics_id' => '',
			'facebook_pixel_id' => '',
		]);

		// // options for webmaster tools
		self::setupOption('webmaster_tools', [
			'google_webmaster_tools_verification' => '',
			'bing_webmaster_tools_verification' => '',
			'yandex_webmaster_tools_verification' => '',
		]);

		// // options for email notifications
		self::setupOption('email_notifications', [
			'enable_email_notifications' => false,
			'email_notifications_recipient' => '',
		]);
	}
}
