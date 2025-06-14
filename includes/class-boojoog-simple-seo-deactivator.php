<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://boojoog.com
 * @since      1.0.0
 *
 * @package    Boojoog_Simple_Seo
 * @subpackage Boojoog_Simple_Seo/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Boojoog_Simple_Seo
 * @subpackage Boojoog_Simple_Seo/includes
 * @author     Ahmad Awdiyanto <ahmad@boojoog.com>
 */
class Boojoog_Simple_Seo_Deactivator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate()
	{
		delete_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'site_settings');
		delete_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'social_settings');
		delete_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'advanced_settings');
		delete_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'performance_settings');
		delete_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'security_settings');
		delete_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'analytics_settings');
		delete_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'webmaster_settings');
		delete_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'email_settings');
	}

}
