####################################
! Attention Git doit être installé !
####################################

    sudo apt-get install git
    

Mode opératoire
========================
1) installation
------------------------------------------
    se placer dans le répertoire racine du site
    
    a) Cloner le Repository
        git clone https://github.com/omkom-web/sesameGen.git .
    le point à la fin est important !
    
    b) Lancer le script d'initialisation
        sh startup.sh
        
    c) création du compte super-admin
        php app/console fos:user:create --super-admin
        
2) Mise à jour
------------------------------------------

    sh update.sh
    
    placer ce script en CRON permet d'être toujours à jour !!