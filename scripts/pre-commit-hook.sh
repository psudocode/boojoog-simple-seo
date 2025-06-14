#!/bin/bash

# Pre-commit hook to check version consistency
# Copy this file to .git/hooks/pre-commit and make it executable

# Colors
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m'

# Check if the main plugin file is being committed
if git diff --cached --name-only | grep -q "boojoog-simple-seo.php"; then
    
    # Extract versions from staged files
    PLUGIN_HEADER_VERSION=$(git show :boojoog-simple-seo.php | grep -o "Version:.*[0-9]\+\.[0-9]\+\.[0-9]\+" | grep -o "[0-9]\+\.[0-9]\+\.[0-9]\+")
    PHP_CONSTANT_VERSION=$(git show :boojoog-simple-seo.php | grep "BOOJOOG_SIMPLE_SEO_VERSION" | grep -o "[0-9]\+\.[0-9]\+\.[0-9]\+")
    
    if [ "$PLUGIN_HEADER_VERSION" != "$PHP_CONSTANT_VERSION" ]; then
        echo -e "${RED}❌ Version mismatch detected in boojoog-simple-seo.php:${NC}"
        echo -e "${RED}   Plugin Header: $PLUGIN_HEADER_VERSION${NC}"
        echo -e "${RED}   PHP Constant:  $PHP_CONSTANT_VERSION${NC}"
        echo -e "${YELLOW}   Please ensure both versions match before committing.${NC}"
        exit 1
    fi
fi

# Check README.md if it's being committed
if git diff --cached --name-only | grep -q "README.md"; then
    README_BADGE_VERSION=$(git show :README.md | grep "Version-" | grep -o "[0-9]\+\.[0-9]\+\.[0-9]\+" | head -1)
    PLUGIN_HEADER_VERSION=$(git show :boojoog-simple-seo.php | grep -o "Version:.*[0-9]\+\.[0-9]\+\.[0-9]\+" | grep -o "[0-9]\+\.[0-9]\+\.[0-9]\+")
    
    if [ "$README_BADGE_VERSION" != "$PLUGIN_HEADER_VERSION" ]; then
        echo -e "${RED}❌ Version mismatch between plugin and README.md:${NC}"
        echo -e "${RED}   Plugin: $PLUGIN_HEADER_VERSION${NC}"
        echo -e "${RED}   README: $README_BADGE_VERSION${NC}"
        echo -e "${YELLOW}   Please ensure versions match before committing.${NC}"
        exit 1
    fi
fi

exit 0
