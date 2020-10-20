<p align="center"><a href="https://github.com/Gizmologie/projetLaravel" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


# <b>Projet e-commerce Laravel</b>

## Equipe 

Benjamin ROBERT <br>
Aurélien GUILLEMOT


## contexte 

C'est un site de e-commerce qui permet aux visisteurs de visualiser les produits que nous vendons.
Les produits proposés sont de tous types.

Une fois connecté, l'utilisateur peut enregistrer sa commande dans un panier et simuler un achat.

L'administrateur peut modifier/ supprier des produits et des utilisateurs


## Procedure d'installation 

1. composer install
2. php artisan migrate:fresh --seed
3. npm i 
4. npm run watch 


## Fonctionnement des API

Dans le fichier .env, ajouter à la fin :

    MJ_APIKEY_PUBLIC=(clé fournie)
    MJ_APIKEY_PRIVATE=(clé fournie)
    
    STRIPE_PUBLIC=(clé fournie)
    STRIPE_SECRET=(clé fournie)

    
## Modification fichier de configuration

Fichier : database.php 
<br>
Dans 'connections' => 'mysql'

Remplacer 

    'engine' => null,
par

    'engine' => 'InnoDB',


## seed utilisateur

Il existe 2 utilisateurs prédéfinis :

email : user@user.com <br>
mot de passe : user

email : admin@admin.com <br>
mot de passe : admin
(compte admin)


!! Si vous vous connextez avec le user de base vous ne recevrez pas les mails 
