# Version Management Guide

## 🎯 Overview

Your WordPress plugin now has a complete automated version management system that ensures all version references stay in sync across your codebase and releases.

## 🏗️ What Was Set Up

### 1. Enhanced GitHub Actions Workflow (`.github/workflows/release.yml`)

- **Trigger**: Automatically runs when you push a version tag (e.g., `v1.2.3`)
- **Actions**:
  - Extracts version from git tag
  - Updates all version references in plugin files
  - Creates a clean distribution ZIP
  - Creates GitHub release with ZIP attachment
  - Commits version updates back to repository

### 2. Release Creation Script (`scripts/create-release.sh`)

- **Interactive script** for creating new releases
- **Smart version bumping** (patch/minor/major or custom)
- **Validation** ensures new version is greater than current
- **Git integration** automatically creates and pushes tags

### 3. Version Status Checker (`scripts/check-version.sh`)

- **Quick verification** that all version references are in sync
- **Checks multiple files**: plugin header, PHP constants, README badges
- **Git tag comparison** to ensure releases match code versions

### 4. Pre-commit Hook (`scripts/pre-commit-hook.sh`)

- **Prevents version inconsistencies** before they get committed
- **Automatic validation** during git commits
- **Optional installation** for enhanced workflow

## 🚀 How to Use

### Creating Your First Release

1. **Check current status**:

   ```bash
   ./scripts/check-version.sh
   ```

2. **Create a release**:

   ```bash
   ./scripts/create-release.sh
   ```

3. **Monitor the workflow**:
   - Go to your GitHub repository
   - Click "Actions" tab
   - Watch the "Create Plugin Release" workflow

### Version Files That Are Automatically Managed

| File                     | What Gets Updated     | Example                                          |
| ------------------------ | --------------------- | ------------------------------------------------ |
| `boojoog-simple-seo.php` | Plugin header version | `Version: 1.2.3`                                 |
| `boojoog-simple-seo.php` | PHP constant          | `define('BOOJOOG_SIMPLE_SEO_VERSION', '1.2.3');` |
| `README.md`              | Version badge         | `Version-1.2.3-orange`                           |
| `README.txt`             | Stable tag            | `Stable tag: 1.2.3`                              |

## 🔄 Workflow Examples

### Example 1: Bug Fix Release (Patch)

```bash
# Current version: 1.0.0
./scripts/create-release.sh
# Choose option 1 (patch) -> Creates v1.0.1
```

### Example 2: New Feature Release (Minor)

```bash
# Current version: 1.0.1
./scripts/create-release.sh
# Choose option 2 (minor) -> Creates v1.1.0
```

### Example 3: Breaking Changes (Major)

```bash
# Current version: 1.1.0
./scripts/create-release.sh
# Choose option 3 (major) -> Creates v2.0.0
```

## 🎛️ Advanced Usage

### Manual Tag Creation

If you prefer manual control:

```bash
# Update versions manually in files, then:
git add .
git commit -m "Prepare release v1.2.3"
git tag v1.2.3
git push origin v1.2.3
```

### Installing Pre-commit Hook

To prevent version mismatches:

```bash
cp scripts/pre-commit-hook.sh .git/hooks/pre-commit
chmod +x .git/hooks/pre-commit
```

### Checking Specific Files

```bash
# Check plugin header version
grep "Version:" boojoog-simple-seo.php

# Check PHP constant
grep "BOOJOOG_SIMPLE_SEO_VERSION" boojoog-simple-seo.php

# Check README badge
grep "Version-" README.md
```

## 🚨 Troubleshooting

### "Version mismatch detected"

If the version checker finds mismatches, manually update all files to the same version:

1. **Plugin file**: Update both header and constant
2. **README.md**: Update the version badge
3. **README.txt**: Update stable tag (if exists)

### "Could not push changes back to repository"

This happens if the GitHub Actions doesn't have write permissions. The release still works, but version updates aren't committed back. This is normal and doesn't affect functionality.

### "No version tags found"

If you haven't created any releases yet, this is expected. Create your first release and this message will disappear.

## 📋 Best Practices

1. **Always test** your plugin before creating a release
2. **Use semantic versioning**: MAJOR.MINOR.PATCH
3. **Check version status** before making releases: `./scripts/check-version.sh`
4. **Keep a CHANGELOG** to document what's new in each version
5. **Use the release script** instead of manual version updates

## 🎉 Benefits

- ✅ **No more version mismatches** across different files
- ✅ **Automated release process** saves time and reduces errors
- ✅ **Professional releases** with proper ZIP files and GitHub releases
- ✅ **Consistent versioning** follows semantic versioning standards
- ✅ **Easy to use** with simple scripts and clear documentation

---

**Your plugin now has enterprise-level version management! 🚀**

For any questions or issues, check the individual script documentation in the `scripts/` directory.
