<?php
require_once './vendor/autoload.php';

define('ROOT', str_replace('index.php', '', (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']));

use Controllers\MainController;
use Controllers\AuthController;
use Controllers\UtilisateurController;
use Controllers\AgenceController;
use Controllers\TrajetController;


$mainController = new MainController();
$authController = new AuthController();
$utilisateurController = new UtilisateurController();
$AgenceController = new AgenceController();
$TrajetController = new TrajetController();
$uri = trim($_SERVER['REQUEST_URI'], '/');


try {
    // Si 'page' n'est pas défini, charger la page d'accueil
    if (empty($_GET['page'])) {
        $page = 'accueil';
    } else {
        $page = explode('/', filter_var($_GET['page'], FILTER_SANITIZE_URL))[0];
    }

    // Routeur principal
    switch ($page) {

        // Route pour la page d'accueil
        case 'accueil':
            $mainController->homePage();
            break;

        // Route pour la page d'authentification
        case 'login':
            $authController->auth();
            break;

        // Route pour le processus d'authentification
        case 'loginProcess':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $authController->loginProcess();
            } else {
                throw new Exception('Méthode non autorisée');
            }
            break;

        // Route pour la déconnexion
        case 'logout':
            $authController->logout();
            break;

        // Route pour la page utilisateur
        case 'utilisateur':
            $utilisateurController->utilisateurPage();
            break;

        // Route pour la page des agences
        case 'agence':
            $AgenceController->agencePage();
            break;

        // Route pour la création de trajet
        case 'trajet':
            $TrajetController->createTrajetPage();
            break;

        // Route pour la modification d'un trajet
        case 'modifierTrajet':
            $TrajetController->modifierTrajetPage();
            break;

        // Route pour la page d'erreur
        default:
            throw new Exception("Page non trouvée");
    }

    // Si aucune route ne correspond, afficher une page d'erreur 404
} catch (Exception $e) {
    $mainController->errorPage($e->getMessage());
}
