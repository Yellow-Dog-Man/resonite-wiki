#!/bin/bash

# Check if patches have already been applied
if [ -f ./.patched ]; then
    echo "Patches already applied."
    exit 0
fi

# Temporarily disable UserFunctions composer.
# TODO: Update or poke userfunctions, its using an ancient composer file, COMMUNITY HELP WELCOME
if [ -f extensions/UserFunctions/composer.json ]; then
    mv extensions/UserFunctions/composer.json extensions/UserFunctions/composer.bak
fi

# Temporarily disable Analytics composer (google/apiclient conflicts with MediaWiki's firebase/php-jwt ^7.0.2)
# TODO: Update once Analytics extension supports newer google/apiclient
if [ -f extensions/Analytics/composer.json ]; then
    mv extensions/Analytics/composer.json extensions/Analytics/composer.bak
fi

# We don't use these in prod, these are dev deps, but composer wants us to fix them... well ok, this is how we do it.
sed -i 's/"phpunit\/phpunit": "9\.6\.21"/"phpunit\/phpunit": "^10.0"/' composer.json
sed -i '/"johnkary\/phpunit-speedtrap":/d' composer.json

# symfony/yaml 6.4.25 has security advisories, update to patched version
# https://symfony.com/blog/symfony-6-4-40-released
sed -i 's/"symfony\/yaml": "6\.4\.25"/"symfony\/yaml": "^6.4.40"/' composer.json

# Any other manual commands to patch stuff here.

# Mark that patches have been applied
touch ./.patched
