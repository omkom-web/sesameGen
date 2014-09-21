#/usr/bin/bash
git pull
php composer.phar update -n
php app/console sonata:easy-extends:generate SonataAdminBundle -d src
php app/console sonata:easy-extends:generate SonataMediaBundle -d src
php app/console sonata:easy-extends:generate SonataUserBundle -d src
php app/console doctrine:schema:update --dump-sql
php app/console doctrine:schema:update --force
php app/console asset:install
php app/console cache:clear --no-warmup
php app/console cache:clear --env=prod