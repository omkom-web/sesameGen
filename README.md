========================
! Attention Git doit être installé !
========================

    sudo apt-get install git
    
========================
1° installation  
========================   
Cloner le Repository
    git clone https://github.com/omkom-web/sesameGen.git .

Lancer le script d'install
    php app/console omkom:deploy install

Créer un super utilisateur
    php app/console fos:user:create --super-admin
    
========================
Le reste du temps
========================      
Upgrade en cron
    php app/console omkom:deploy upgrade
    
Update 
    php app/console omkom:deploy update

======================== 
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

    
