# The ugly directory

Une plateforme faite pour partager avec la communauté des joueurs d’Animal Crossing sur un sujet plus que primordial lors du game-play : les habitants de notre île. Certains sont plus réputés que d’autres et ici, nous rendons hommage aux laissés pour compte.

![image](https://user-images.githubusercontent.com/47384185/196681754-c1a3178b-65f9-43c9-b9ed-93a6dadd395a.png)

## Fonctionnalités

Possibilité de consulter les habitants déjà listés et d’en ajouter de nouveaux, à condition d’avoir créé un compte. Seul l’administrateur a la possibilité de modifier ou de supprimer un habitant.

## Utilisation

### Installation

Après avoir installé toutes les dépendances et Webpack :

- `npm run watch` pour lancer Webpack
- `symfony serve` pour lancer le serveur Symfony

## Mise en place de la base de données

### Migration

Nous avons mis en place des fichiers de migrations que vous pouvez exécuter à l'aide de la commande : `php bin/console doctrine:migrations:migrate`

### Importer les fixtures

Afin de partir d'une bases de données pré-remplie, vous pouvez exécuter la commande suivante pour déclencher les fixtures : `php bin/console doctrine:fixtures:load`

## Connexion

Vous pouvez créer un compte en cliquant sur le bouton "Login" ou vous connecter :

- En tant qu'utilisateur par défaut :
    - pseudo : admin
    - password : adminadmin
- En tant qu'admin :
    - pseudo : mathilde
    - password : mathildee
