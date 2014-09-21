========================
! Attention Git doit être installé !
========================

    sudo apt-get install git
    
Config apache MINIMALE
========================
    <VirtualHost *:80>
        ServerName [YOUR_DNS.TLD]
        RewriteEngine On
        
        DocumentRoot [YOUR_PATH]/web
        DirectoryIndex app.php
        
        <Directory [YOUR_PATH]/web >
            Options Indexes FollowSymLinks MultiViews
        </Directory>
        
        ErrorLog  [YOUR_PATH]/log/apache2/error.log
        CustomLog [YOUR_PATH]/log/apache2/access.log combined
        
    </VirtualHost>

Mode opératoire
========================
1) installation
------------------------------------------
se placer dans le répertoire racine du site
    
a) Cloner le Repository
Le point à la fin est important !

    git clone https://github.com/omkom-web/sesameGen.git .
     
b) Lancer le script d'initialisation

    php composer.phar update -n

c) Lancer la config locale

    php composer.phar install
    
d) Création du compte super-admin

    php app/console fos:user:create --super-admin
    
e) Mettre à jour les bundles

    sh update.sh
        
2) Mise à jour
------------------------------------------
Placer ce script en CRON permet d'être toujours à jour !!
    sh update.sh

    