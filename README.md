#  TOUCHE PAS AU KLAXON

**TOUCHE PAS AU KLAXON** est une application web PHP permettant de gérer une plateforme de covoiturage au sein d'une entreprise possédant plusieurs implantations géographiques. Les employés connectés peuvent proposer ou consulter des trajets.

-----------------------------------------

##  Fonctionnalités

-  Connexion sécurisée (mot de passe hashé)
-  Création, modification et suppression de trajets
-  Consultation des trajets disponibles
-  Détails des conducteurs via fenêtre modale
-  Gestion des agences (admin uniquement)
-  Gestion des utilisateurs (admin uniquement)
-  Tableau de bord administrateur
-  Interface responsive (Bootstrap 5)
-  Interface stylisée avec Sass

-----------------------------------------

##  Prérequis

Avant de démarrer l'installation, assurez-vous d'avoir :

- PHP ≥ 8.0
- Composer
- Serveur local (MAMP, XAMPP, WAMP ou PHP intégré)
- Un éditeur de code (ex: VS Code)
- Navigateur web moderne

-----------------------------------------

##  Installation du projet

1. **Cloner le projet**

Ouvrez votre terminal, placez-vous dans le dossier `htdocs`:

```bash
cd /Applications/MAMP/htdocs
git clone https://github.com/Miradji-Ladhidhou/Miradji_Ladhidhou_devoir_PHP.git
cd Miradji_Ladhidhou_devoir_PHP
```
-----------------------------------------

2. **Installer les dépendances avec Composer**

Dans le terminal, depuis le dossier du projet, lancez :

```bash
composer install
```
-----------------------------------------

3. **Créez un dossier config à la racine du projet, puis un fichier config.php à l’intérieur** 
(ce fichier est ignoré par Git pour des raisons de sécurité).

Voici un exemple de contenu :

```php
<?php
// config.php

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'App_covoiturage');
define('DB_USER', 'db_user');
define('DB_PASSWORD', 'db_password');
```
-----------------------------------------

4. **Avec un serveur local comme MAMP/XAMPP** 

Démarrez Apache et MySQL

Ouvre votre navigateur sur :
http://localhost/Miradji_Ladhidhou_devoir_PHP

-----------------------------------------

5. **Création de la base de données dans MySQL**

- Ouvrir mysql
- Importer le fichier schema.sql qui se trouve dans le dossier sql du projet pour créer la base et les tables 
- Importer ensuite le fichier données.sql toujours dans le même dossier 

-----------------------------------------

6. **Connexion à l'application**

- **Admin**
    Email : admin@email.fr
    Mot de passe : admin456

- **User**
    Email : alexandre.martin@email.fr
    Mot de passe : user123

    Email : camille.moreau@email.fr
    Mot de passe : user123

-----------------------------------------

7. **Tests unitaires avec PHPUnit**

Les tests des modèles se trouvent dans le dossier `tests/`.

Lancez par exemple :

```bash
./vendor/bin/phpunit tests/UtilisateursModelTest.php
```

Remplacez "UtilisateursModelTest.php" par le nom du fichier de test voulu

-----------------------------------------

8. **Analyse statique avec PHPStan**

Lancez l’analyse depuis la racine du projet :

```bash
vendor/bin/phpstan analyse
```