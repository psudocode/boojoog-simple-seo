<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://boojoog.com
 * @since      1.0.0
 *
 * @package    Boojoog_Simple_Seo
 * @subpackage Boojoog_Simple_Seo/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Boojoog_Simple_Seo
 * @subpackage Boojoog_Simple_Seo/public
 * @author     Ahmad Awdiyanto <ahmad@boojoog.com>
 */
class Boojoog_Simple_Seo_Public
{

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
	 * The namespace of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $namespace    The namespace of this plugin.
	 */
	private $namespace;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 * @param      string    $namespace    The namespace of this plugin.
	 * 
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->namespace = BOOJOOG_SIMPLE_SEO_NAMESPACE;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/boojoog-simple-seo-public.css', array(), $this->version, 'all');

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/boojoog-simple-seo-public.js', array('jquery'), $this->version, false);

	}

	public function add_seo_tags()
	{
		// remove wp head default SEO tags
		self::frontpage_seo();

	}

	function frontpage_seo()
	{
		$siteSettings = get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'site_settings', array());
		$socialMedia = get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'social_media', array());
		$analytics = get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'analytics_settings', array());
		$webmasterTools = get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'webmaster_tools', array());
		$performanceSettings = get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'performance_settings', array());
		$securitySettings = get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'security_settings', array());
		$emailNotifications = get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'email_notifications', array());
		$advancedSettings = get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'advanced_settings', array());

		if (is_front_page() || is_home()) {

			// ESSENTIAL SEO TAGS

			echo '<meta name="description" content="' . esc_attr($siteSettings['meta_description']) . '">';
			$canonical_url = get_site_url();
			echo '<link rel="canonical" href="' . esc_url($canonical_url) . '">';

			// Technical SEO Tags
			echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
			echo '<meta name="referrer" content="strict-origin-when-cross-origin">';

			// Branding and Authorship
			if (!empty($siteSettings['meta_author'])) {
				echo '<meta name="author" content="' . esc_attr($siteSettings['meta_author']) . '">';
			}

			// open graph tags get from site settings
			echo '<meta property="og:title" content="' . esc_attr($siteSettings['meta_title']) . '">';
			echo '<meta property="og:description" content="' . esc_attr($siteSettings['meta_description']) . '">';
			echo '<meta property="og:type" content="website">';
			echo '<meta property="og:url" content="' . esc_url(get_site_url()) . '">';
			if (!empty($siteSettings['meta_image'])) {
				echo '<meta property="og:image" content="' . esc_url($siteSettings['meta_image']) . '">';
			}
			echo '<meta property="og:site_name" content="' . esc_attr($siteSettings['meta_title']) . '">';
			echo '<meta property="og:locale" content="' . esc_attr(get_locale()) . '">';

			echo '<meta name="twitter:card" content="summary_large_image">';
			echo '<meta name="twitter:title" content="' . esc_attr($siteSettings['meta_title']) . '">';
			echo '<meta name="twitter:description" content="' . esc_attr($siteSettings['meta_description']) . '">';
			if (!empty($siteSettings['meta_image'])) {
				echo '<meta name="twitter:image" content="' . esc_url($siteSettings['meta_image']) . '">';
			}
			echo '<meta name="twitter:site" content="@' . esc_attr($socialMedia['twitter']) . '">';

			if (!empty($siteSettings['meta_icon'])) {
				echo '<link rel="icon" href="' . esc_url($siteSettings['favicon']) . '" type="image/x-icon">';
			}
			if (!empty($siteSettings['meta_favicon'])) {
				echo '<link rel="shortcut icon" href="' . esc_url($siteSettings['favicon']) . '" type="image/x-icon">';
			}
			if (!empty($siteSettings['meta_apple_touch_icon'])) {
				echo '<link rel="apple-touch-icon" href="' . esc_url($siteSettings['favicon']) . '">';
			}
			if (!empty($siteSettings['meta_manifest'])) {
				echo '<link rel="manifest" href="' . esc_url($siteSettings['meta_manifest']) . '">';
			}

			// JSON-LD schema
			echo '<script type="application/ld+json">' . json_encode(array(
				'@context' => 'https://schema.org',
				'@type' => 'WebSite',
				'name' => esc_attr($siteSettings['meta_title']),
				'description' => esc_attr($siteSettings['meta_description']),
				'url' => esc_url(get_site_url()),
				'potentialAction' => array(
					array(
						'@type' => 'SearchAction',
						'target' => esc_url(get_site_url()) . '/?s={search_term_string}',
						'query-input' => 'required name=search_term_string'
					)
				)
			)) . '</script>';

			// social media links
			if (!empty($socialMedia['facebook'])) {
				echo '<meta property="article:publisher" content="' . esc_url($socialMedia['facebook']) . '">';
			}
			if (!empty($socialMedia['twitter'])) {
				echo '<meta name="twitter:creator" content="' . $socialMedia['twitter'] . '">';
			}
			if (!empty($socialMedia['instagram'])) {
				echo '<meta property="og:instagram" content="' . esc_url($socialMedia['instagram']) . '">';
			}
			if (!empty($socialMedia['linkedin'])) {
				echo '<meta property="og:linkedin" content="' . esc_url($socialMedia['linkedin']) . '">';
			}
			if (!empty($socialMedia['youtube'])) {
				echo '<meta property="og:youtube" content="' . esc_url($socialMedia['youtube']) . '">';
			}
			if (!empty($socialMedia['pinterest'])) {
				echo '<meta property="og:pinterest" content="' . esc_url($socialMedia['pinterest']) . '">';
			}
			if (!empty($socialMedia['tiktok'])) {
				echo '<meta property="og:tiktok" content="' . esc_url($socialMedia['tiktok']) . '">';
			}
			if (!empty($socialMedia['github'])) {
				echo '<meta property="og:github" content="' . esc_url($socialMedia['github']) . '">';
			}
			if (!empty($socialMedia['reddit'])) {
				echo '<meta property="og:reddit" content="' . esc_url($socialMedia['reddit']) . '">';
			}
			if (!empty($socialMedia['whatsapp'])) {
				echo '<meta property="og:whatsapp" content="' . esc_url($socialMedia['whatsapp']) . '">';
			}
			if (!empty($socialMedia['telegram'])) {
				echo '<meta property="og:telegram" content="' . esc_url($socialMedia['telegram']) . '">';
			}
			if (!empty($socialMedia['discord'])) {
				echo '<meta property="og:discord" content="' . esc_url($socialMedia['discord']) . '">';
			}
			if (!empty($socialMedia['twitch'])) {
				echo '<meta property="og:twitch" content="' . esc_url($socialMedia['twitch']) . '">';
			}
			if (!empty($socialMedia['snapchat'])) {
				echo '<meta property="og:snapchat" content="' . esc_url($socialMedia['snapchat']) . '">';
			}
			if (!empty($socialMedia['tiktok'])) {
				echo '<meta property="og:tiktok" content="' . esc_url($socialMedia['tiktok']) . '">';
			}
			if (!empty($socialMedia['flickr'])) {
				echo '<meta property="og:flickr" content="' . esc_url($socialMedia['flickr']) . '">';
			}
			if (!empty($socialMedia['tumblr'])) {
				echo '<meta property="og:tumblr" content="' . esc_url($socialMedia['tumblr']) . '">';
			}
			if (!empty($socialMedia['mastodon'])) {
				echo '<meta property="og:mastodon" content="' . esc_url($socialMedia['mastodon']) . '">';
			}

			// google analytics
			if (!empty($analytics['google_analytics_id'])) {
				echo '<script async src="https://www.googletagmanager.com/gtag/js?id=' . esc_attr($analytics['google_analytics_id']) . '"></script>';
				echo '<script>
					window.dataLayer = window.dataLayer || [];
					function gtag(){dataLayer.push(arguments);}
					gtag("js", new Date());
					gtag("config", "' . esc_attr($analytics['google_analytics_id']) . '");
				</script>';
			}

			// pixel id
			if (!empty($analytics['facebook_pixel_id'])) {
				echo '<script>
					!function(f,b,e,v,n,t,s)
					{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
					n.callMethod.apply(n,arguments):n.queue.push(arguments)};
					if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version="2.0";
					n.queue=[];t=b.createElement(e);t.async=!0;
					t.src=v;s=b.getElementsByTagName(e)[0];
					s.parentNode.insertBefore(t,s)}(window, document,"script",
					"https://connect.facebook.net/en_US/fbevents.js");
					fbq("init", "' . esc_attr($analytics['facebook_pixel_id']) . '");
					fbq("track", "PageView");
				</script>';
			}

			// webmaster tools
			if (!empty($webmasterTools['google_verification_code'])) {
				echo '<meta name="google-site-verification" content="' . esc_attr($webmasterTools['google_verification_code']) . '">';
			}

			if (!empty($webmasterTools['bing_verification_code'])) {
				echo '<meta name="msvalidate.01" content="' . esc_attr($webmasterTools['bing_verification_code']) . '">';
			}

			if (!empty($webmasterTools['yandex_verification_code'])) {
				echo '<meta name="yandex-verification" content="' . esc_attr($webmasterTools['yandex_verification_code']) . '">';
			}
		}
	}

	public function filter_document_title($title)
	{
		$siteSettings = get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'site_settings', array());
		if (is_front_page() || is_home()) {
			return $siteSettings['meta_title'] ? $siteSettings['meta_tagline'] . ' - ' . $siteSettings['meta_title'] : get_bloginfo('name');
		}
		return $title;
	}

	public function filter_robots_meta_tag($robots)
	{
		$siteSettings = get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'site_settings', array());
		if (isset($siteSettings['meta_robots']) && !empty($siteSettings['meta_robots'])) {
			$robots['index'] = strpos($siteSettings['meta_robots'], 'index') !== false;
			$robots['follow'] = strpos($siteSettings['meta_robots'], 'follow') !== false;
		}
		return $robots;
	}

	function serve_manifest_json()
	{
		$siteSettings = get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'site_settings', array());
		if (isset($_GET['manifest'])) {
			header('Content-Type: application/manifest+json');
			$manifest = [
				"name" => $siteSettings['meta_title'] ?: get_bloginfo('name'),
				"short_name" => $siteSettings['meta_title'] ?: get_bloginfo('name'),
				"description" => $siteSettings['meta_description'] ?: get_bloginfo('description'),
				"start_url" => home_url('/'),
				"display" => "standalone",
				"background_color" => "#ffffff",
				"theme_color" => "#0073aa",
				"icons" => [
					[
						"src" => $siteSettings['favicon'] ?: plugins_url('icons/icon-192x192.png', __FILE__),
						"sizes" => "192x192",
						"type" => "image/png"
					],
					[
						"src" => $siteSettings['favicon'] ?: plugins_url('icons/icon-512x512.png', __FILE__),
						"sizes" => "512x512",
						"type" => "image/png"
					]
				]
			];
			echo json_encode($manifest, JSON_PRETTY_PRINT);
			exit;
		}
	}

	function add_manifest_link()
	{
		echo '<link rel="manifest" href="' . esc_url(home_url('?manifest=1')) . '">';
	}

	public function override_favicon($icon_url)
	{
		$siteSettings = get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'site_settings', array());
		if (!empty($siteSettings['favicon'])) {
			return esc_url($siteSettings['favicon']);
		}
		return $icon_url;
	}
}