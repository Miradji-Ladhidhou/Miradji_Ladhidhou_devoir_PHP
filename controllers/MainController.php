<?php

namespace Controllers;

use Controllers\Utilities;
use Models\TrajetsModel;

/**
 * Contrôleur principal pour la gestion des pages publiques.
 */
class MainController
{
    /**
     * @var TrajetsModel Instance du modèle pour gérer les trajets.
     */
    public TrajetsModel $trajets;

    /**
     * Initialise le contrôleur avec une instance du modèle TrajetsModel.
     */
    public function __construct()
    {
        $this->trajets = new TrajetsModel();
    }

    /**
     * Affiche la page d'accueil avec la liste des trajets.
     *
     * @return void
     */
    public function homePage(): void
    {
        /** @var array<int, array<string, mixed>> $agences */
        $agences = $this->trajets->getAlltrajets();

        $datas_page = [
            'views' => "./views/pages/homePage.php",
            'layout' => "./views/layout/commun.php",
            'title' => "Page d'accueil",
            'description' => "Bienvenue sur la page d'accueil de notre site web.",
            'agences' => $agences
        ];

        Utilities::renderPage($datas_page);
    }

    /**
     * Affiche la page de connexion utilisateur.
     *
     * @return void
     */
    public function auth(): void
    {
        $datas_page = [
            'views' => "./views/pages/auth.php",
            'layout' => "./views/layout/commun.php",
            'title' => "Connexion",
            'description' => "Page de connexion utilisateur",
        ];

        Utilities::renderPage($datas_page);
    }

    /**
     * Affiche une page d'erreur personnalisée avec un message.
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
