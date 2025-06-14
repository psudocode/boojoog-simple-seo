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

<!-- about plugin page -->

<div class="bss admin-wrap">
    <h1>
        Boojoog Simple SEO
    </h1>
    <span class="version">Version <?php echo esc_html((new Boojoog_Simple_Seo())->get_version()); ?></span>

    <!-- about plugin -->
    <p>This plugin helps you optimize your WordPress site for search engines. It’s simple and clear to use, yet powered
        by smart features under the hood that help your site perform better in
        search engines—no SEO expertise required.With Boojoog Simple SEO, you can easily manage your site's SEO
        settings, including meta tags, sitemaps, and more.
    </p>
    <p>We believe that SEO should be accessible to everyone, and our plugin is designed to make it easy for you to
        improve your site's visibility in search engines.</p>
    <p>For more information, please visit our <a href="https://boojoog.com" target="_blank"
            class="text-red-100 hover:text-red-200">website</a>.</p>
    <p class="boojoog-footer">
        <strong>Boojoog SEO Plugin</strong> is a product of <a href="https://boojoog.com" target="_blank"
            class="text-red-100 hover:text-red-200">Ahmad
            Awdiyanto at Boojoog</a>.
        <br>
        <a href="https://boojoog.com/privacy-policy" target="_blank">Privacy Policy</a> |
        <a href="https://boojoog.com/contact" target="_blank">Contact Us</a>
    </p>
</div>