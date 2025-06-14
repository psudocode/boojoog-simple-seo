<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://boojoog.com
 * @since      1.0.0
 *
 * @package    Boojoog_Simple_Seo
 * @subpackage Boojoog_Simple_Seo/admin/partials
 */


?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="bss admin-wrap">

    <h1>🚀 Getting Started </h1>
    <p>
        Welcome to <strong>Boojoog Simple SEO</strong> — your new partner for smarter, simpler search engine
        optimization.
        This plugin is designed to help your WordPress site get noticed, without the usual SEO headaches.
    </p>
</div>
<!-- create tabs here [site settings, social media, advanced setting, performance, security, analytics, webmaster, email] -->
<div class="bss admin-wrap">
    <h2>🔧 Quick Setup</h2>
    <h2 class="nav-tab-wrapper">
        <a href="#general" class="nav-tab nav-tab-active" id="tab-general">General</a>
        <a href="#advanced" class="nav-tab" id="tab-advanced">Advanced</a>
        <a href="#performance" class="nav-tab" id="tab-performance">Performance</a>
        <a href="#social-media" class="nav-tab" id="tab-social-media">Social Media</a>
        <a href="#analytics" class="nav-tab" id="tab-analytics">Analytics</a>
        <a href="#webmaster" class="nav-tab" id="tab-webmaster">Webmaster</a>
        <a href="#email" class="nav-tab" id="tab-email">Email</a>
    </h2>
    <div id="tab-general-content" class="tab-content active">
        <h2>General Settings</h2>
        <p>General settings content goes here.</p>
        <form method="post" action="options.php">
            <?php
            settings_fields(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'site_settings_group');
            do_settings_sections(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'site_settings_group');

            $fields = get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'site_settings', [
                'meta_title' => '',
                'meta_description' => '',
                'meta_tagline' => '',
                'meta_author' => '',
                'meta_robots' => 'index, follow',
                'favicon' => '',
                'logo' => ''
            ]);

            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Site Name</th>
                    <td><input class="regular-text" type="text" name="bss_site_settings[meta_title]"
                            value="<?php echo esc_attr($fields['meta_title']); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tagline</th>
                    <td><input class="regular-text" type="text" name="bss_site_settings[meta_tagline]"
                            value="<?php echo esc_attr($fields['meta_tagline']); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Meta Description</th>
                    <td><textarea class="regular-text" rows="5" cols="50"
                            name="bss_site_settings[meta_description]"><?php echo esc_textarea($fields['meta_description']); ?></textarea>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Meta Author</th>
                    <td><input class="regular-text" type="text" name="bss_site_settings[meta_author]"
                            value="<?php echo esc_attr($fields['meta_author']); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Robots.txt</th>
                    <td><textarea class="regular-text" rows="5" cols="50"
                            name="bss_site_settings[meta_robots]"><?php echo esc_textarea($fields['meta_robots']); ?></textarea>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Favicon URL</th>
                    <td>
                        <div class="preview-container">
                            <?php if ($fields['favicon']) : ?>
                                <img src="<?php echo esc_url($fields['favicon']); ?>" alt="Favicon Preview" 
                                class="favicon-preview" style="max-width: 200px;" />
                            <?php else : ?>
                                <p class="no-favicon">No favicon uploaded</p>
                            <?php endif; ?>
                        </div>
                        <input type="hidden" id="boojoog_favicon_url" name="bss_site_settings[favicon]"
                        value="<?php echo esc_url($fields['favicon']); ?>" />
                        <button class="button boojoog-media-upload-button" type="button">Upload</button>
                        <p class="description">Recommended size: 32x32 pixels</p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Logo URL</th>
                    <td>
                        <div class="preview-container">
                            <?php if ($fields['logo']) : ?>
                                <img src="<?php echo esc_url($fields['logo']); ?>" alt="Logo Preview" 
                                class="logo-preview" style="max-width: 200px;"/>
                            <?php else : ?>
                                <p class="no-logo">No logo uploaded</p>
                            <?php endif; ?>
                        </div>
                        <input type="hidden" id="boojoog_logo_url" name="bss_site_settings[logo]"
                        value="<?php echo esc_url($fields['logo']); ?>" />
                        <button class="button boojoog-media-upload-button" type="button">Upload</button>
                        <p class="description">Recommended size: 200x100 pixels</p>
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
    </div>
    <div id="tab-advanced-content" class="tab-content">
        <h2>Advanced Settings</h2>
        <p>Advanced settings content goes here.</p>
        <form method="post" action="options.php">
            <?php
            settings_fields(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'advanced_settings_group');
            do_settings_sections(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'advanced_settings_group');

            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Enable Sitemap</th>
                    <td><input type="checkbox" id="enable_sitemap"
                            name="bss_advanced_settings[enable_sitemap]" value="1"
                            <?php checked(get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'advanced_settings')['enable_sitemap'] ?? false, '1'); ?> />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Enable Breadcrumbs</th>
                    <td><input type="checkbox" id="enable_breadcrumbs"
                            name="bss_advanced_settings[enable_breadcrumbs]" value="1"
                            <?php checked(get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'advanced_settings')['enable_breadcrumbs'] ?? false, '1'); ?> />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Enable Open Graph</th>
                    <td><input type="checkbox" id="enable_open_graph"
                            name="bss_advanced_settings[enable_open_graph]" value="1"
                            <?php checked(get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'advanced_settings')['enable_open_graph'] ?? false, '1'); ?> />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Enable Twitter Cards</th>
                    <td><input type="checkbox" id="enable_twitter_cards"
                            name="bss_advanced_settings[enable_twitter_cards]" value="1"
                            <?php checked(get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'advanced_settings')['enable_twitter_cards'] ?? false, '1'); ?> />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Enable JSON-LD</th>
                    <td><input type="checkbox" id="enable_json_ld"
                            name="bss_advanced_settings[enable_json_ld]" value="1"
                            <?php checked(get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'advanced_settings')['enable_json_ld'] ?? false, '1'); ?> />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Enable Schema Markup</th>
                    <td><input type="checkbox" id="enable_schema_markup"
                            name="bss_advanced_settings[enable_schema_markup]" value="1"
                            <?php checked(get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'advanced_settings')['enable_schema_markup'] ?? false, '1'); ?> />
                    </td>
                </tr>
            </table>

            
            <?php submit_button(); ?>
        </form>
    </div>
    <div id="tab-performance-content" class="tab-content">
        <h2>Performance Settings</h2>
        <p>Performance settings content goes here.</p>
        <form method="post" action="options.php">
            <?php
            settings_fields(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'performance_settings_group');
            do_settings_sections(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'performance_settings_group');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Enable Lazy Load</th>
                    <td><input type="checkbox" id="enable_lazy_load"
                            name="bss_performance_settings[enable_lazy_load]" value="1"
                            <?php checked(get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'performance_settings')['enable_lazy_load'] ?? false, '1'); ?> />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Enable Minify HTML</th>
                    <td><input type="checkbox" id="enable_minify_html"
                            name="bss_performance_settings[enable_minify_html]" value="1"
                            <?php checked(get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'performance_settings')['enable_minify_html'] ?? false, '1'); ?> />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Enable Combine CSS/JS</th>
                    <td><input type="checkbox" id="enable_combine_css_js"
                            name="bss_performance_settings[enable_combine_css_js]" value="1"
                            <?php checked(get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'performance_settings')['enable_combine_css_js'] ?? false, '1'); ?> />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Enable Async JS</th>
                    <td><input type="checkbox" id="enable_async_js"
                            name="bss_performance_settings[enable_async_js]" value="1"
                            <?php checked(get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'performance_settings')['enable_async_js'] ?? false, '1'); ?> />
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
    </div>
    <div id="tab-social-media-content" class="tab-content">
        <h2>Social Media Settings</h2>
        <p>Social media settings content goes here.</p>
        <form method="post" action="options.php">
            <?php
            settings_fields(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'social_media_group');
            do_settings_sections(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'social_media_group');

            $social_media_fields = get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'social_media', [
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
            ?>
            <table class="form-table">
                <?php foreach ($social_media_fields as $key => $value) : ?>
                    <tr valign="top">
                        <th scope="row"><?php echo ucfirst($key); ?> URL</th>
                        <td><input class="regular-text" type="text"
                                name="bss_social_media[<?php echo esc_attr($key); ?>]"
                                value="<?php echo esc_url($value); ?>" /></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            
            <?php submit_button(); ?>
        </form>
    </div>
    <div id="tab-analytics-content" class="tab-content">
        <h2>Analytics Settings</h2>
        <p>Analytics settings content goes here.</p>
        <form method="post" action="options.php">
            <?php
            settings_fields(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'analytics_settings_group');
            do_settings_sections(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'analytics_settings_group');

            // Add your analytics settings fields here
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Google Analytics ID</th>
                    <td><input class="regular-text" type="text"
                            name="bss_analytics_settings[google_analytics_id]"
                            value="<?php echo esc_attr(get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'analytics_settings')['google_analytics_id'] ?? ''); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Facebook Pixel ID</th>
                    <td><input class="regular-text" type="text"
                            name="bss_analytics_settings[facebook_pixel_id]"
                            value="<?php echo esc_attr(get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'analytics_settings')['facebook_pixel_id'] ?? ''); ?>" />
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
    </div>  
    <div id="tab-webmaster-content" class="tab-content">
        <h2>Webmaster Tools Settings</h2>
        <p>Webmaster tools settings content goes here.</p>
        <form method="post" action="options.php">
            <?php
            settings_fields(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'webmaster_tools_group');
            do_settings_sections(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'webmaster_tools_group');

            // Add your webmaster tools settings fields here
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Google Webmaster Tools Verification Code</th>
                    <td><input class="regular-text" type="text"
                            name="bss_webmaster_tools[google_verification_code]"
                            value="<?php echo esc_attr(get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'webmaster_tools')['google_verification_code'] ?? ''); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Bing Webmaster Tools Verification Code</th>
                    <td><input class="regular-text" type="text"
                            name="bss_webmaster_tools[bing_verification_code]"
                            value="<?php echo esc_attr(get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'webmaster_tools')['bing_verification_code'] ?? ''); ?>" />
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
    </div>
    <div id="tab-email-content" class="tab-content">
        <h2>Email Notifications Settings</h2>
        <p>Email notifications settings content goes here.</p>
        <form method="post" action="options.php">
            <?php
            settings_fields(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'email_notifications_group');
            do_settings_sections(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'email_notifications_group');

            // Add your email notifications settings fields here
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Enable Email Notifications</th>
                    <td><input type="checkbox" id="enable_email_notifications"
                            name="bss_email_notifications[enable_email_notifications]" value="1"
                            <?php checked(get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'email_notifications')['enable_email_notifications'] ?? false, '1'); ?> />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Email Notifications Recipient</th>
                    <td><input class="regular-text" type="email"
                            name="bss_email_notifications[email_recipient]"
                            value="<?php echo esc_attr(get_option(BOOJOOG_SIMPLE_SEO_NAMESPACE . 'email_notifications')['email_recipient'] ?? ''); ?>" />
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
    </div>
</div>