<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>



# <b>Projet e-commerce Laravel</b>

## Equipe 

Benjamin ROBERT,
Aurélien GUILLEMOT

## Information 
 
Nom de la BDD : projet_ecommerce


## Procedure d'installation 

1. composer install
2. php artisan migrate:fresh --seed
3. npm i 
4. npm run watch 


## Fonctionnement des API

Dans le fichier .env, ajouter à la fin :

    MJ_APIKEY_PUBLIC=(clé_envoyé_par_mail)
    MJ_APIKEY_PRIVATE=(clé_envoyé_par_mail)
    
## Modification fichier de configuration

fichier : database.php 
<br>
Dans 'connections' => 'mysql'

Remplacer 

    'engine' => null,
par

    'engine' => 'InnoDB',


