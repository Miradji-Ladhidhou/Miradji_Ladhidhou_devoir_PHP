<?php
namespace Controllers;

use Controllers\Utilities;
use Models\TrajetsModel;

class TrajetController
{
   public $trajets;
   public function __construct()
   {
      $this->trajets = new TrajetsModel();
   }
   public function trajetPage()
   {
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

   public function createTrajetPage()
   {
      $datas_page = [
         'views' => "./views/pages/createTrajetPage.php",
         'layout' => "./views/layout/commun.php",
         'title' => "Créer un trajet",
         'description' => "Bienvenue sur la page de création de trajet.",
      ];

      Utilities::renderPage($datas_page);
   }

   public function modifierTrajetPage()
   {
      $trajetId = $_GET['id'] ?? null;

      if (!$trajetId || !is_numeric($trajetId)) {
         $this->errorPage("Trajet invalide.");
         return;
      }

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
}
