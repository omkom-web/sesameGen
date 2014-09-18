#/usr/bin/bash
# git clone https://github.com/omkom-web/sesameGen.git .
php composer.phar diagnose
php composer.phar update
php composer.phar install
php app/console doctrine:schema:update
php app/console asset:install
# php app/console fos:user:create --super-admin
php app/check.php


