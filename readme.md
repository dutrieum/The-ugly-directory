# The ugly directory

Une plateforme faite pour partager avec la communauté des joueurs d’Animal Crossing sur un sujet plus que primordial lors du game-play : les habitants de notre île. Certains sont plus réputés que d’autres et ici, nous rendons hommage aux laissés pour compte.

![the-ugly-directory-screen](https://user-images.githubusercontent.com/72490689/202869228-1a9d7895-09ca-4852-96c5-ccefa94ce27a.png)

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
