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

# These next three commands, get us around some sort of migration that shouldn't happen but is happening.
# I can remove this stuff, once we're not running the old wiki again, but until then let's deal with it.
# Modify all patches to use IF EXISTS for DROP INDEX to avoid errors when indexes don't exist
sed -i 's/DROP INDEX /DROP INDEX IF EXISTS /g' sql/mysql/*.sql

# Comment out the ALTER TABLE in pagelinks patch to avoid corruption
sed -i 's/^ALTER TABLE /\-- ALTER TABLE /g' sql/mysql/patch-pagelinks-drop-pl_title.sql

# Remove the ALTER TABLE blocks from categorylinks patch to avoid corruption
sed -i '/^ALTER TABLE/,/;/d' sql/mysql/patch-categorylinks-pk.sql

# Mark that patches have been applied
touch ./.patched
