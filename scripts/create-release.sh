#!/bin/bash

# Boojoog Simple SEO Release Script
# This script helps you create a new version release with automatic version bumping

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_info() {
    echo -e "${BLUE}ℹ️  $1${NC}"
}

print_success() {
    echo -e "${GREEN}✅ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

print_error() {
    echo -e "${RED}❌ $1${NC}"
}

# Function to get current version from plugin file
get_current_version() {
    grep -o "Version:.*[0-9]\+\.[0-9]\+\.[0-9]\+" boojoog-simple-seo.php | grep -o "[0-9]\+\.[0-9]\+\.[0-9]\+"
}

# Function to validate version format
validate_version() {
    if [[ $1 =~ ^[0-9]+\.[0-9]+\.[0-9]+$ ]]; then
        return 0
    else
        return 1
    fi
}

# Function to compare versions
version_greater() {
    local ver1=(${1//./ })
    local ver2=(${2//./ })
    
    for i in {0..2}; do
        if (( ${ver1[i]} > ${ver2[i]} )); then
            return 0
        elif (( ${ver1[i]} < ${ver2[i]} )); then
            return 1
        fi
    done
    return 1
}

# Function to bump version
bump_version() {
    local current=$1
    local type=$2
    local ver=(${current//./ })
    
    case $type in
        "patch")
            ((ver[2]++))
            ;;
        "minor")
            ((ver[1]++))
            ver[2]=0
            ;;
        "major")
            ((ver[0]++))
            ver[1]=0
            ver[2]=0
            ;;
    esac
    
    echo "${ver[0]}.${ver[1]}.${ver[2]}"
}

# Main script
echo -e "${BLUE}"
echo "🚀 Boojoog Simple SEO Release Creator"
echo "===================================="
echo -e "${NC}"

# Check if we're in the right directory
if [ ! -f "boojoog-simple-seo.php" ]; then
    print_error "This script must be run from the plugin root directory (where boojoog-simple-seo.php is located)"
    exit 1
fi

# Check if git repo is clean
if [ ! -z "$(git status --porcelain)" ]; then
    print_warning "You have uncommitted changes. Please commit or stash them before creating a release."
    git status --short
    read -p "Do you want to continue anyway? (y/N): " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        exit 1
    fi
fi

# Get current version
CURRENT_VERSION=$(get_current_version)
print_info "Current version: $CURRENT_VERSION"

# Ask for new version
echo
echo "How would you like to update the version?"
echo "1) Patch (bug fixes): $CURRENT_VERSION -> $(bump_version $CURRENT_VERSION patch)"
echo "2) Minor (new features): $CURRENT_VERSION -> $(bump_version $CURRENT_VERSION minor)"
echo "3) Major (breaking changes): $CURRENT_VERSION -> $(bump_version $CURRENT_VERSION major)"
echo "4) Custom version"
echo

read -p "Choose an option (1-4): " -n 1 -r
echo

case $REPLY in
    1)
        NEW_VERSION=$(bump_version $CURRENT_VERSION patch)
        ;;
    2)
        NEW_VERSION=$(bump_version $CURRENT_VERSION minor)
        ;;
    3)
        NEW_VERSION=$(bump_version $CURRENT_VERSION major)
        ;;
    4)
        read -p "Enter new version (e.g., 1.2.3): " NEW_VERSION
        if ! validate_version "$NEW_VERSION"; then
            print_error "Invalid version format. Please use semantic versioning (e.g., 1.2.3)"
            exit 1
        fi
        ;;
    *)
        print_error "Invalid option"
        exit 1
        ;;
esac

# Validate new version is greater than current
if ! version_greater "$NEW_VERSION" "$CURRENT_VERSION"; then
    print_error "New version ($NEW_VERSION) must be greater than current version ($CURRENT_VERSION)"
    exit 1
fi

print_info "New version will be: $NEW_VERSION"

# Confirm before proceeding
echo
read -p "Create release v$NEW_VERSION? This will create a git tag and trigger the release workflow. (y/N): " -n 1 -r
echo

if [[ ! $REPLY =~ ^[Yy]$ ]]; then
    print_info "Release cancelled"
    exit 0
fi

# Update version in local files (for immediate use)
print_info "Updating version in local files..."

# Update plugin header
sed -i.bak "s/Version:.*$/Version:           $NEW_VERSION/" boojoog-simple-seo.php

# Update PHP constant
sed -i.bak "s/define('BOOJOOG_SIMPLE_SEO_VERSION', '.*');/define('BOOJOOG_SIMPLE_SEO_VERSION', '$NEW_VERSION');/" boojoog-simple-seo.php

# Update README.md badge
sed -i.bak "s/Version-.*-orange/Version-$NEW_VERSION-orange/" README.md

# Update README.txt if it exists
if [ -f "README.txt" ]; then
    sed -i.bak "s/Stable tag: .*/Stable tag: $NEW_VERSION/" README.txt
fi

# Remove backup files
rm -f *.bak

print_success "Updated version to $NEW_VERSION in local files"

# Commit the version changes
print_info "Committing version changes..."
git add boojoog-simple-seo.php README.md
if [ -f "README.txt" ]; then
    git add README.txt
fi
git commit -m "🔖 Prepare release v$NEW_VERSION"

# Create and push the tag
print_info "Creating and pushing git tag v$NEW_VERSION..."
git tag -a "v$NEW_VERSION" -m "Release version $NEW_VERSION"
git push origin "v$NEW_VERSION"
git push origin HEAD

print_success "Successfully created release v$NEW_VERSION!"
echo
print_info "The GitHub Actions workflow will now:"
print_info "1. Build the plugin ZIP file"
print_info "2. Create a GitHub release"
print_info "3. Upload the ZIP file to the release"
echo
print_info "You can monitor the progress at:"
print_info "https://github.com/$(git remote get-url origin | sed 's/.*github.com[:/]\([^.]*\)\.git/\1/')/actions"
echo
print_success "Release process initiated! 🎉"
