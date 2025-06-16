<?php

namespace Controllers;

use Models\AgencesModel;
use Controllers\Utilities;

/**
 * Contrôleur pour la gestion des agences.
 */
class AgenceController
{
    /**
     * @var AgencesModel Modèle pour l'accès aux agences.
     */
    public $agences;

    /**
     * Constructeur du contrôleur Agence.
     */
    public function __construct()
    {
        $this->agences = new AgencesModel();
    }

    /**
     * Affiche la page listant toutes les agences.
     *
     * @return void
     */
    public function agencePage(): void
    {
        $agences = $this->agences->getAllagences();

        $datas_page = [
            'views' => "./views/pages/agencePage.php",
            'layout' => "./views/layout/commun.php",
            'title' => "Page des utilisateurs",
            'description' => "Bienvenue sur la page des utilisateurs.",
            'agences' => $agences
        ];

        Utilities::renderPage($datas_page);
    }

    /**
     * Affiche la page de création d'une agence.
     *
     * @return void
     */
    public function createAgencePage(): void
    {
        $datas_page = [
            'views' => "./views/pages/createAgencePage.php",
            'layout' => "./views/layout/commun.php",
            'title' => "Création d'une agence",
            'description' => "Formulaire de création d'une nouvelle agence."
        ];

        Utilities::renderPage($datas_page);
    }

    /**
     * Supprime une agence selon l'ID passé en GET.
     * Vérifie les autorisations de l'utilisateur.
     *
     * @return void
     */
    public function supprimerAgence(): void
    {
        session_start();

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: index.php?page=agence');
            exit;
        }

        $agence = $this->agences->getAgenceById($id);

        if (!isset($_SESSION['user']) || (!$_SESSION['user']['est_admin'] && $agence['id_users'] != $_SESSION['user']['id'])) {
            header('HTTP/1.1 403 Forbidden');
            exit('Accès refusé');
        }

        $success = $this->agences->deleteAgence($id);

        $_SESSION['message'] = $success
            ? "Agence supprimée avec succès."
            : "Échec de la suppression de l'agence.";

        header('Location: index.php?page=agence');
        exit;
    }

    /**
     * Affiche une page d'erreur avec un message personnalisé.
     *
     * @param string $message Message d'erreur à afficher
     * @return void
     */
    public function errorPage(string $message): void
    {
        $datas_page = [
            'views' => "./views/pages/errorPage.php",
            'layout' => "./views/layout/commun.php",
            'title' => "Erreur 404",
            'description' => "On est perdu, on ne trouve pas la page",
            'message' => $message,
        ];

        Utilities::renderPage($datas_page);
    }
}
