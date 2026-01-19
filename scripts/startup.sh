#!/bin/bash

cd /var/www/html

# Temporarily disable UserFunctions composer.
mv extensions/UserFunctions/composer.json composer.bak

composer update --no-interaction

# Modify all patches to use IF EXISTS for DROP INDEX to avoid errors when indexes don't exist
sed -i 's/DROP INDEX /DROP INDEX IF EXISTS /g' sql/mysql/*.sql

# Comment out the ALTER TABLE in pagelinks patch to avoid corruption
sed -i 's/^ALTER TABLE /\-- ALTER TABLE /g' sql/mysql/patch-pagelinks-drop-pl_title.sql

# Remove the ALTER TABLE blocks from categorylinks patch to avoid corruption
sed -i '/^ALTER TABLE/,/;/d' sql/mysql/patch-categorylinks-pk.sql

# TODO: this manually marks a schema update as done, not sure if needed, but here for now.
mysql -h resonite-wiki-database -u "$(cat /run/secrets/db_user)" -p"$(cat /run/secrets/db_password)" wiki_db -e "INSERT IGNORE INTO updatelog (ul_key, ul_value) VALUES ('patch-pagelinks-drop-pl_title.sql', '1'), ('patch-categorylinks-pk.sql', '1');"

php maintenance/run.php update --quick

exec apache2-foreground
