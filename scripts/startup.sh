#!/bin/sh
set -e

cd /var/www/html

php maintenance/run.php update --quick

exec apache2-foreground
