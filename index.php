<?php

define('ROOT', str_replace('index.php', '', (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']));

require_once 'controllers/MainController.php';
require_once 'controllers/AuthController.php';

$mainController = new MainController();
$authController = new AuthController();
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

        // Routes pour les pages principales
        case 'accueil':
            $mainController->homePage();
            break;
        // Routes pour les pages d'authentification
        case 'login':
            $authController->auth();
            break;

        // Routes pour les processus d'authentification
        case 'loginProcess':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $authController->loginProcess();
            } else {
                throw new Exception('Méthode non autorisée');
            }
            break;

        // Routes pour la déconnexion
        case 'logout':
            $authController->logout();
            break;

        // Routes pour les pages d'erreur
        default:
            throw new Exception("Page non trouvée");
    }

    // Si aucune route ne correspond, afficher une page d'erreur 404
} catch (Exception $e) {
    $mainController->errorPage($e->getMessage());
}
