#!/bin/bash

set -e
/etc/init.d/cron start
echo "* * * * * /usr/local/bin/php /var/www/html/artisan schedule:run >> /dev/null 2>&1" | crontab -
apache2-foreground
exec "$@"