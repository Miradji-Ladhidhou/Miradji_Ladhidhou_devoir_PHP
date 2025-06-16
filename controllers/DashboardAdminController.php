<?php

namespace Controllers;

use Models\UserModel;
use Models\AgencesModel;
use Models\TrajetsModel;
use Controllers\Utilities;

class DashboardAdminController
{
    private $userModel;
    private $agencesModel;
    private $trajetsModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->agencesModel = new AgencesModel();
        $this->trajetsModel = new TrajetsModel();
    }

    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Vérification : seulement les admins peuvent accéder
        if (empty($_SESSION['user']) || empty($_SESSION['user']['est_admin'])) {
            header('Location: index.php?page=login');
            exit;
        }

        // Récupération des données
        $users = $this->userModel->getAllusers();
        $agences = $this->agencesModel->getAllagences();
        $trajets = $this->trajetsModel->getAlltrajets();

        // Préparation des données pour la vue
        $datas_page = [
            'views' => './views/pages/dashboardAdmin.php',
            'layout' => './views/layout/commun.php',
            'title' => 'Dashboard Admin',
            'description' => 'Espace administrateur',
            'users' => $users,
            'agences' => $agences,
            'trajets' => $trajets,
        ];

        Utilities::renderPage($datas_page);
    }
}
