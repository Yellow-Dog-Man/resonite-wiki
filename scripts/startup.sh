#!/bin/bash
set -e

cd /var/www/html

# TODO: this manually marks a schema update as done, not sure if needed, but here for now.
mysql -h resonite-wiki-database -u "wiki" -p"$(cat /run/secrets/db_password)" wiki_db -e "INSERT IGNORE INTO updatelog (ul_key, ul_value) VALUES ('patch-pagelinks-drop-pl_title.sql', '1'), ('patch-categorylinks-pk.sql', '1');"

php maintenance/run.php update --quick

exec apache2-foreground
