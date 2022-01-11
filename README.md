# Requirements
- Docker Desktop
- Terminal Linux / VSCode terminal

# Installation
- Clone ce dépôt.
```
$ git clone https://github.com/Jojo6392/Restaurant---Symfony.git
```
Dans le dossier du dépôt :
- Construire le docker.
```
$ docker-compose up
```

- Mettre à jour les "composer"
```
$ cd symfony
$ composer update
```
Se rendre sur *symfony.localhost*.

# Résumé du travail effectué

### Rôles *user* et *admin* mis en place
*(Lors de l'inscription, le rôle par défaut est user, peut être modifier à la modification de celui-ci.)*

### Partie client
- Affichage et Modification du profil.
  - Modification oblige à changer le mot de passe.
  - Suppression disponible uniquement pour les adminstrateurs dans la partie "*Tous les utilisateurs*".
- Création de commande, afficher ses commandes
- Créer des lignes de commande
  - Récupération de la commande en paramètre de la route.
  - Mise à jour du prix total selon la modification du contenu de la commande.

### Partie responsable
Un responsable a le rôle d'administrateur.
- Affichage et Modification du profil.
  - Modification oblige à changer le mot de passe.
  - Suppression disponible pour tous les utilisateurs.
- Créer, afficher, éditer et supprimer un restaurant.
  - De plus, accès à tous les restaurants existants dont les fonctionnalités.
- Créer, afficher, éditer et supprimer des produits
  - Création d'un produit selon le restaurant récupéré en paramètre de la route.
  - Affichage des produits d'un restaurant depuis sa page. Donc pas seulement l'affichage de tous les produits même si cette fonctionnalité a quand même été implémenté.
Possibilité d'afficher toutes les commandes passées dans un restaurant depuis sa page.

### Front
L'utilisation de Bootstrap n'a pas été fait depuis un webpack mais il y a eu un effort au niveau du front. De plus, j'ai essayé de mettre un petit thème autour de ce projet.
