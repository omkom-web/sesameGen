#/usr/bin/bash
#git pull
#php composer.phar update -n
php app/console doctrine:schema:update --dump-sql
php app/console doctrine:schema:update --force
php app/console asset:install
php app/console cache:clear --no-warmup
php app/console cache:clear --env=prod
