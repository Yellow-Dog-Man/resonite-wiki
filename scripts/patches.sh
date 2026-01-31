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

# Any other manual commands to patch stuff here.

# Mark that patches have been applied
touch ./.patched
