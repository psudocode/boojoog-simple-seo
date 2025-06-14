# Boojoog Simple SEO

[![WordPress Plugin](https://img.shields.io/badge/WordPress-Plugin-blue.svg)](https://wordpress.org/)
[![GPL License](https://img.shields.io/badge/License-GPL%202.0-green.svg)](http://www.gnu.org/licenses/gpl-2.0.txt)
[![Version](https://img.shields.io/badge/Version-1.0.2-orange.svg)](https://github.com/psudocode/boojoog-simple-seo)

**Boojoog Simple SEO makes SEO easy for everyone.** It's simple and clear to use, yet powered by smart features under the hood that help your site perform better in search engines—no SEO expertise required.

## 🚀 Features

- **Easy to Use**: Simple interface designed for beginners and experts alike
- **Smart SEO**: Powered by intelligent features that work behind the scenes
- **No Expertise Required**: Get better search rankings without needing SEO knowledge
- **WordPress Native**: Built specifically for WordPress with best practices
- **Performance Optimized**: Lightweight and fast, won't slow down your site

## 📋 Requirements

- **WordPress**: 5.0 or higher
- **PHP**: 7.4 or higher
- **MySQL**: 5.6 or higher

## 🔧 Installation

### Method 1: WordPress Admin Dashboard

1. Log in to your WordPress admin dashboard
2. Navigate to **Plugins** → **Add New**
3. Search for "Boojoog Simple SEO"
4. Click **Install Now** and then **Activate**

### Method 2: Manual Installation

1. Download the plugin from [GitHub](https://github.com/psudocode/boojoog-simple-seo)
2. Upload the `boojoog-simple-seo` folder to `/wp-content/plugins/`
3. Activate the plugin through the **Plugins** menu in WordPress

### Method 3: Upload ZIP File

1. Download the plugin ZIP file
2. Go to **Plugins** → **Add New** → **Upload Plugin**
3. Choose the ZIP file and click **Install Now**
4. Activate the plugin

## ⚙️ Configuration

1. After activation, go to **Boojoog SEO** in your WordPress admin menu
2. Configure your SEO settings according to your needs
3. The plugin will automatically start optimizing your site for search engines

## 📚 Documentation

### Getting Started

The plugin provides an intuitive interface that guides you through the SEO optimization process:

- **Dashboard**: Overview of your SEO status
- **Settings**: Configure global SEO options
- **About**: Learn more about the plugin features

### Key Features

- **Meta Tags Optimization**: Automatically generates and optimizes meta titles and descriptions
- **Schema Markup**: Adds structured data to improve search engine understanding
- **Social Media Integration**: Optimizes content for social media sharing
- **Performance Monitoring**: Tracks your SEO improvements

## 🛠️ Development

### File Structure

```
boojoog-simple-seo/
├── admin/                          # Admin interface files
│   ├── class-boojoog-simple-seo-admin.php
│   ├── css/                        # Admin stylesheets
│   ├── js/                         # Admin JavaScript
│   └── partials/                   # Admin page templates
├── includes/                       # Core plugin files
│   ├── class-boojoog-simple-seo.php
│   ├── class-boojoog-simple-seo-loader.php
│   └── ...
├── languages/                      # Translation files
├── public/                         # Public-facing files
│   ├── class-boojoog-simple-seo-public.php
│   ├── css/                        # Public stylesheets
│   └── js/                         # Public JavaScript
├── boojoog-simple-seo.php          # Main plugin file
├── README.md                       # This file
├── README.txt                      # WordPress.org readme
└── uninstall.php                   # Uninstallation script
```

### Contributing

We welcome contributions! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Coding Standards

- Follow [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)
- Use proper PHPDoc comments
- Test your code thoroughly

## 📦 Development & Release Management

### Version Management

This plugin uses automated version management to keep all version references in sync. The version is automatically updated in:

- Plugin header (`boojoog-simple-seo.php`)
- PHP constant (`BOOJOOG_SIMPLE_SEO_VERSION`)
- README.md version badge
- README.txt stable tag (if present)

### Creating a New Release

**Option 1: Using the Release Script (Recommended)**

```bash
./scripts/create-release.sh
```

**Option 2: Manual Tag Creation**

```bash
git tag v1.2.3
git push origin v1.2.3
```

Both methods will trigger the automated release workflow that:

1. ✅ Updates all version references
2. ✅ Creates a distribution ZIP file
3. ✅ Creates a GitHub release
4. ✅ Uploads the ZIP to the release

### Checking Version Status

To verify all versions are in sync:

```bash
./scripts/check-version.sh
```

### Installing Pre-commit Hook

To prevent version inconsistencies:

```bash
cp scripts/pre-commit-hook.sh .git/hooks/pre-commit
chmod +x .git/hooks/pre-commit
```

For more details, see [scripts/README.md](scripts/README.md).

## 🐛 Bug Reports

If you find a bug, please report it by:

1. Opening an issue on [GitHub](https://github.com/psudocode/boojoog-simple-seo/issues)
2. Providing detailed steps to reproduce the issue
3. Including your WordPress and plugin version information

## 💡 Feature Requests

Have an idea for a new feature? We'd love to hear it!

1. Open a feature request on [GitHub](https://github.com/psudocode/boojoog-simple-seo/issues)
2. Describe the feature and its benefits
3. Provide use cases and examples

## �️ Roadmap

### Current Status

- ✅ **Homepage SEO**: Complete optimization for homepage content and meta tags

### Planned Features

#### 🎯 Next Release (v1.1.0)

- [ ] **Post and Page SEO**: Individual SEO optimization for posts and pages
- [ ] **Custom Taxonomy SEO**: SEO support for custom taxonomies and terms

#### 🚀 Future Releases (v1.2.0+)

- [ ] **SEO Real-time Scoring**: Live SEO analysis and scoring system
- [ ] **AI Integrations**: AI-powered content optimization suggestions
- [ ] **Advanced Analytics**: Detailed SEO performance tracking
- [ ] **Bulk SEO Operations**: Mass optimization tools for existing content
- [ ] **Social Media Optimization**: Enhanced social sharing features

#### 🎨 Long-term Vision

- [ ] **Multi-language Support**: Internationalization for global sites
- [ ] **E-commerce SEO**: Specialized features for WooCommerce
- [ ] **Local SEO**: Location-based optimization tools
- [ ] **Advanced Schema**: Rich snippets and structured data templates

Want to contribute to any of these features? Check out our [Contributing Guidelines](#contributing) and get involved!

## �📞 Support

- **Documentation**: [Plugin Documentation](https://boojoog.com/docs)
- **Support Forum**: [WordPress.org Support](https://wordpress.org/support/plugin/boojoog-simple-seo)
- **Email**: [support@boojoog.com](mailto:support@boojoog.com)
- **Website**: [https://boojoog.com](https://boojoog.com)

## 📝 Changelog

### 1.0.1 (2025-06-15)

- 🔧 **Added comprehensive version management system**
- 🚀 **Enhanced GitHub Actions release workflow** with automatic version updates
- 📝 **Added interactive release creation script** (`scripts/create-release.sh`)
- 🔍 **Added version status checker** (`scripts/check-version.sh`)
- 🛡️ **Added pre-commit hook** for version validation
- 📚 **Updated documentation** with version management guide
- ✅ **All version references now sync automatically** with git tags
- 🎯 **Improved release process** for better maintainability

### 1.0.0 (2025-06-15)

- 🎉 **Initial release**
- ⚙️ **Core SEO optimization features**
- 🎛️ **Admin dashboard interface**
- 🌐 **Public-facing SEO enhancements**

## 📄 License

This plugin is licensed under the [GPL v2.0 or later](http://www.gnu.org/licenses/gpl-2.0.txt).

## 👨‍💻 Author

**Ahmad Awdiyanto**

- Website: [https://boojoog.com](https://boojoog.com)
- GitHub: [@psudocode](https://github.com/psudocode)

## 🙏 Acknowledgments

- WordPress community for their excellent documentation
- All contributors who help improve this plugin
- Users who provide feedback and suggestions

---

**Made with ❤️ for the WordPress community**
