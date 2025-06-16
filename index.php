<?php
require_once './vendor/autoload.php';

define('ROOT', str_replace('index.php', '', (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']));

use Controllers\MainController;
use Controllers\AuthController;
use Controllers\UtilisateurController;
use Controllers\AgenceController;
use Controllers\TrajetController;
use Controllers\DashboardAdminController;

// Instanciation des contrôleurs
$mainController = new MainController();
$authController = new AuthController();
$utilisateurController = new UtilisateurController();
$agenceController = new AgenceController();
$trajetController = new TrajetController();
$dashboardAdminController = new DashboardAdminController();

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
        case 'accueil':
            $mainController->homePage();
            break;

        case 'login':
            $authController->auth();
            break;

        case 'loginProcess':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $authController->loginProcess();
            } else {
                throw new Exception('Méthode non autorisée');
            }
            break;

        case 'logout':
            $authController->logout();
            break;

        case 'utilisateur':
            $utilisateurController->utilisateurPage();
            break;

        case 'agence':
            $agenceController->agencePage();
            break;

        case 'createTrajet':
            $trajetController->createTrajetPage();
            break;

        case 'modifierTrajet':
            $trajetController->modifierTrajetPage();
            break;

        case 'supprimerTrajet':
            $trajetController->supprimerTrajet();
            break;

        case 'createAgence':
            $agenceController->createAgencePage();
            break;

        case 'supprimerAgence':
            $agenceController->supprimerAgence();
            break;

        case 'dashboard':
            $dashboardAdminController->index();
            break;

        default:
            throw new Exception("Page non trouvée");
    }
} catch (Exception $e) {
    $mainController->errorPage($e->getMessage());
}
