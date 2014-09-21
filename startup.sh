#/usr/bin/bash
php composer.phar diagnose
php composer.phar update -n
php app/check.php
php composer.phar install