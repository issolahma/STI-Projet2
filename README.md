# STI-Projet2

Petite application de messagerie locale développée dans le cadre du cours STI.

Le projet2 consiste en la sécurisation du projet1 d'un autre groupe.

Projet1: https://github.com/WenesLimem/STI_Project_1



## Outils utilisés

- PHP
- SQLite
- nginx



## Installation

L'application se lance dans un container Docker avec le script `startApp.sh`

```bash
./startApp.sh
```

Le code et la base de donnée se trouvent dans le dossier `site`, et sont directement connectés au conteneur.



### Scripts

Le script `start-services.sh` lance les services *PHP* et *nginx* dans le cas ou on relance le conteneur.

Le script `stopApp.sh` stoppe et supprime le conteneur.



### Base de donnée

Pour être lisible et modifiable par *nginx*, la base de donnée doit appartenir à l'utilisateur `www-data`.

Le script modifie les droits de cette dernière, pour qu'elle soit utilisable depuis l'application, mais elle devient inutilisable en local.

Si on ajoute l'utilisateur `labo` au groupe `www-data` nous n'obtenons que des droits de lectures, il est donc plus simple de modifier le propriétaire du fichier.



## Utilisateurs

Les logins suivants sont en base de donnée:

| E-mail          | Mot de passe | Rôle  | Actif |
| --------------- | ------------ | ----- | ----- |
| admin@world.org | admin        | admin | oui   |
| user1@world.org | user1        | admin | non   |
| user2@world.org | user2        | user  | oui   |
| user3@world.org | user3        | admin | oui   |
| user4@world.org | user4        | user  | oui   |
| user5@world.org | user5        | user  | oui   |
| pomme@hei-vd.ch | pomme        | user  | non   |

Les utilisateurs suivants ont des messages dans la bd: `admin@world.org`, `user1@world.org`, `user2@world.org`.



