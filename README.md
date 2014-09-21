========================
! Attention Git doit être installé !
========================

    sudo apt-get install git
    

Mode opératoire
========================
1) installation
------------------------------------------
    se placer dans le répertoire racine du site
    
a) Cloner le Repository
------------------------------------------
le point à la fin est important !
    git clone https://github.com/omkom-web/sesameGen.git .
    
b) Lancer le script d'initialisation
------------------------------------------
    sh startup.sh

c) Lancer la config locale
------------------------------------------
    php composer.phar install
    
d) création du compte super-admin
------------------------------------------
    php app/console fos:user:create --super-admin
    
e) Mettre à jour les bundles
------------------------------------------
    sh update.sh
        
2) Mise à jour
------------------------------------------

    sh update.sh
placer ce script en CRON permet d'être toujours à jour !!
    