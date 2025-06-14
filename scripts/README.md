# Scripts Directory

This directory contains utility scripts for managing the Boojoog Simple SEO plugin.

## Available Scripts

### 🚀 `create-release.sh`

**Purpose**: Automates the process of creating a new plugin release with proper version management.

**What it does**:

- Prompts you to choose version bump type (patch, minor, major, or custom)
- Updates version in all relevant files:
  - Plugin header in `boojoog-simple-seo.php`
  - PHP constant `BOOJOOG_SIMPLE_SEO_VERSION`
  - README.md version badge
  - README.txt stable tag (if exists)
- Commits the changes
- Creates and pushes a git tag
- Triggers the GitHub Actions release workflow

**Usage**:

```bash
./scripts/create-release.sh
```

**Requirements**:

- Must be run from the plugin root directory
- Git repository should be clean (no uncommitted changes)
- Push access to the repository

---

### 🔍 `check-version.sh`

**Purpose**: Checks if all version references across the plugin are in sync.

**What it checks**:

- Plugin header version
- PHP constant version
- README.md badge version
- README.txt stable tag
- Latest git tag version

**Usage**:

```bash
./scripts/check-version.sh
```

**Example output**:

```
🔍 Boojoog Simple SEO Version Status
==================================

📋 Version Status:
===================
Plugin Header:     1.0.0
PHP Constant:      1.0.0
README.md Badge:   1.0.0
README.txt:        1.0.0
Latest Git Tag:    1.0.0

✅ All versions are in sync!
✅ Git tag matches the current version
```

## Version Management Workflow

### For New Releases

1. **Check current status**:

   ```bash
   ./scripts/check-version.sh
   ```

2. **Create a new release**:

   ```bash
   ./scripts/create-release.sh
   ```

3. **Monitor the release**:
   - Go to GitHub Actions tab to see the workflow progress
   - Check the Releases page for the new release

### What Happens Automatically

When you create a git tag (either manually or via the script), the GitHub Actions workflow will:

1. ✅ Extract version from the tag
2. ✅ Update all version references in the plugin files
3. ✅ Create a clean ZIP file for distribution
4. ✅ Create a GitHub release with the ZIP file
5. ✅ Commit version updates back to the repository

### Manual Version Update

If you need to update versions manually:

1. Update `boojoog-simple-seo.php`:

   ```php
   Version:           1.2.3
   define('BOOJOOG_SIMPLE_SEO_VERSION', '1.2.3');
   ```

2. Update `README.md`:

   ```markdown
   [![Version](https://img.shields.io/badge/Version-1.2.3-orange.svg)]
   ```

3. Update `README.txt` (if exists):

   ```
   Stable tag: 1.2.3
   ```

4. Create git tag:
   ```bash
   git tag v1.2.3
   git push origin v1.2.3
   ```

## Tips

- Always use semantic versioning (MAJOR.MINOR.PATCH)
- Test your plugin thoroughly before creating a release
- Check that the GitHub Actions workflow completes successfully
- Verify the release files are correct in the GitHub Releases page
