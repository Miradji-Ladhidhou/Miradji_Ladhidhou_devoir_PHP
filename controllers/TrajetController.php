<?php

namespace Controllers;

use Controllers\Utilities;
use Models\TrajetsModel;

/**
 * Contrôleur pour la gestion des trajets.
 */
class TrajetController
{
    /**
     * @var TrajetsModel Instance du modèle des trajets.
     */
    public TrajetsModel $trajets;

    /**
     * Initialise le contrôleur avec une instance de TrajetsModel.
     */
    public function __construct()
    {
        $this->trajets = new TrajetsModel();
    }

    /**
     * Affiche la page listant tous les trajets.
     *
     * @return void
     */
    public function trajetPage(): void
    {
        /** @var array<int, array<string, mixed>> $trajets */
        $trajets = $this->trajets->getAlltrajets();

        $datas_page = [
            'views' => "./views/pages/trajetPage.php",
            'layout' => "./views/layout/commun.php",
            'title' => "Page des utilisateurs",
            'description' => "Bienvenue sur la page des trajets.",
            'trajets' => $trajets
        ];

        Utilities::renderPage($datas_page);
    }

    /**
     * Affiche une page d'erreur personnalisée.
     *
     * @param string $message Le message d'erreur à afficher.
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

    /**
     * Affiche la page de création d'un trajet.
     *
     * @return void
     */
    public function createTrajetPage(): void
    {
        $datas_page = [
            'views' => "./views/pages/createTrajetPage.php",
            'layout' => "./views/layout/commun.php",
            'title' => "Créer un trajet",
            'description' => "Bienvenue sur la page de création de trajet.",
        ];

        Utilities::renderPage($datas_page);
    }

    /**
     * Affiche la page de modification d'un trajet donné.
     * Valide l'ID du trajet et affiche une erreur en cas de problème.
     *
     * @return void
     */
    public function modifierTrajetPage(): void
    {
        $trajetId = $_GET['id'] ?? null;

        if ($trajetId === null || !is_numeric($trajetId)) {
            $this->errorPage("Trajet invalide.");
            return;
        }

        /** @var int $trajetId */
        $trajetId = (int) $trajetId;
        $trajet = $this->trajets->getTrajetById($trajetId);

        if (!$trajet) {
            $this->errorPage("Trajet non trouvé.");
            return;
        }

        $datas_page = [
            'views' => "./views/pages/modifierTrajetPage.php",
            'layout' => "./views/layout/commun.php",
            'title' => "Modifier un trajet",
            'description' => "Bienvenue sur la page de modification de trajet.",
            'trajet' => $trajet
        ];

        Utilities::renderPage($datas_page);
    }

    /**
     * Supprime un trajet donné après vérification des droits de l'utilisateur.
     *
     * @return void
     */
    public function supprimerTrajet(): void
    {
        session_start();

        // Récupère et valide l'id en GET
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: index.php?page=trajets');
            exit;
        }

        $trajet = $this->trajets->getTrajetById($id);

        // Vérifie les droits de l'utilisateur
        if (
            !isset($_SESSION['user']) ||
            (!$_SESSION['user']['est_admin'] && $trajet['id_users'] != $_SESSION['user']['id'])
        ) {
            header('HTTP/1.1 403 Forbidden');
            exit('Accès refusé');
        }

        // Supprime le trajet
        $success = $this->trajets->deleteTrajet($id);

        $_SESSION['message'] = $success
            ? "Trajet supprimé avec succès."
            : "Échec de la suppression du trajet.";

        header('Location: index.php?page=accueil');
        exit;
    }
}
