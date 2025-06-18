<?php

namespace Controllers;

use Controllers\Utilities;
use Models\UtilisateursModel;

/**
 * Contrôleur pour la gestion des utilisateurs.
 */
class UtilisateurController
{
    /**
     * @var UtilisateursModel Instance du modèle des utilisateurs.
     */
    public UtilisateursModel $utilisateurs;

    /**
     * Initialise le contrôleur avec une instance de UtilisateursModel.
     */
    public function __construct()
    {
        $this->utilisateurs = new UtilisateursModel();
    }

    /**
     * Affiche la page listant tous les utilisateurs.
     *
     * @return void
     */
    public function utilisateurPage(): void
    {
        /** @var array<int, array<string, mixed>> $users */
        $users = $this->utilisateurs->getAllusers();

        $datas_page = [
            'views' => "./views/pages/utilisateurPage.php",
            'layout' => "./views/layout/commun.php",
            'title' => "Page des utilisateurs",
            'description' => "Bienvenue sur la page des utilisateurs.",
            'users' => $users
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
}
