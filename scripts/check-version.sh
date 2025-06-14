#!/bin/bash

# Version Status Checker for Boojoog Simple SEO
# This script checks if all version references are in sync

set -e

# Colors
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

echo -e "${BLUE}🔍 Boojoog Simple SEO Version Status${NC}"
echo "=================================="

# Check if we're in the right directory
if [ ! -f "boojoog-simple-seo.php" ]; then
    echo -e "${RED}❌ This script must be run from the plugin root directory${NC}"
    exit 1
fi

# Extract versions from different files
PLUGIN_HEADER_VERSION=$(grep -o "Version:.*[0-9]\+\.[0-9]\+\.[0-9]\+" boojoog-simple-seo.php | grep -o "[0-9]\+\.[0-9]\+\.[0-9]\+")
PHP_CONSTANT_VERSION=$(grep "BOOJOOG_SIMPLE_SEO_VERSION" boojoog-simple-seo.php | grep -o "[0-9]\+\.[0-9]\+\.[0-9]\+")
README_BADGE_VERSION=$(grep "Version-" README.md | grep -o "[0-9]\+\.[0-9]\+\.[0-9]\+" | head -1)

# Check README.txt if it exists
if [ -f "README.txt" ]; then
    README_TXT_VERSION=$(grep "Stable tag:" README.txt | grep -o "[0-9]\+\.[0-9]\+\.[0-9]\+" || echo "Not found")
else
    README_TXT_VERSION="File not found"
fi

# Get latest git tag version
LATEST_TAG=$(git describe --tags --abbrev=0 2>/dev/null || echo "No tags found")
if [[ $LATEST_TAG =~ ^v([0-9]+\.[0-9]+\.[0-9]+)$ ]]; then
    TAG_VERSION="${BASH_REMATCH[1]}"
else
    TAG_VERSION="No version tags"
fi

echo
echo "📋 Version Status:"
echo "==================="
echo -e "Plugin Header:     ${BLUE}$PLUGIN_HEADER_VERSION${NC}"
echo -e "PHP Constant:      ${BLUE}$PHP_CONSTANT_VERSION${NC}"
echo -e "README.md Badge:   ${BLUE}$README_BADGE_VERSION${NC}"
echo -e "README.txt:        ${BLUE}$README_TXT_VERSION${NC}"
echo -e "Latest Git Tag:    ${BLUE}$TAG_VERSION${NC}"

# Check if all versions match
ALL_VERSIONS=($PLUGIN_HEADER_VERSION $PHP_CONSTANT_VERSION $README_BADGE_VERSION)
if [ -f "README.txt" ] && [[ $README_TXT_VERSION =~ ^[0-9]+\.[0-9]+\.[0-9]+$ ]]; then
    ALL_VERSIONS+=($README_TXT_VERSION)
fi

FIRST_VERSION=${ALL_VERSIONS[0]}
ALL_MATCH=true

for version in "${ALL_VERSIONS[@]}"; do
    if [ "$version" != "$FIRST_VERSION" ]; then
        ALL_MATCH=false
        break
    fi
done

echo
if [ "$ALL_MATCH" = true ]; then
    echo -e "${GREEN}✅ All versions are in sync!${NC}"
    if [ "$TAG_VERSION" = "$FIRST_VERSION" ]; then
        echo -e "${GREEN}✅ Git tag matches the current version${NC}"
    else
        echo -e "${YELLOW}⚠️  Git tag ($TAG_VERSION) doesn't match current version ($FIRST_VERSION)${NC}"
        echo -e "${YELLOW}   Consider creating a new release tag${NC}"
    fi
else
    echo -e "${RED}❌ Version mismatch detected!${NC}"
    echo -e "${RED}   Please ensure all version references are the same${NC}"
fi

echo
echo "🛠️  To update versions, you can:"
echo "   1. Use the automated release script: ./scripts/create-release.sh"
echo "   2. Manually update and create a git tag: git tag v1.x.x"
