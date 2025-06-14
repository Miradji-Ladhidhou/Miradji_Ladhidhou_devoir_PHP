<?php
namespace Controllers;

use Controllers\Utilities;
use Models\TrajetsModel;

class MainController
{
   public $trajets;

   public function __construct()
   {
      $this->trajets = new TrajetsModel();
   }

   public function homePage()
   {
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

   public function auth()
   {
      $datas_page = [
         'views' => "./views/pages/auth.php",
         'layout' => "./views/layout/commun.php",
         'title' => "Connexion",
         'description' => "Page de connexion utilisateur",
      ];

      Utilities::renderPage($datas_page);
   }

   public function errorPage($message)
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
