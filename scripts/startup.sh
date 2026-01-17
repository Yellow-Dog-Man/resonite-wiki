#!/bin/bash

cd /var/www/html

composer update --no-interaction

php maintenance/run.php installPreConfigured

exec apache2-foreground
