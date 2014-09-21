#/usr/bin/bash
git pull
php app/console sonata:easy-extends:generate SonataAdminBundle -d src
php app/console sonata:easy-extends:generate SonataMediaBundle -d src
php app/console sonata:easy-extends:generate SonataUserBundle -d src
php app/console doctrine:schema:update --dump-sql
php app/console doctrine:schema:update --force
php app/console asset:install