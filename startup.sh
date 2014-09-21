#/usr/bin/bash
# git clone https://github.com/omkom-web/sesameGen.git .
php composer.phar diagnose
php composer.phar update -n
php composer.phar install
php app/console sonata:easy-extends:generate SonataAdminBundle -d src
php app/console sonata:easy-extends:generate SonataMediaBundle -d src
php app/console sonata:easy-extends:generate SonataUserBundle -d src
php app/console doctrine:schema:update --dump-sql
php app/console doctrine:schema:update --force
php app/console asset:install
php app/check.php
# php app/console fos:user:create --super-admin


