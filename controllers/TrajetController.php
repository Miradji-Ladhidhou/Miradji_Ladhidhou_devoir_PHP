<?php

require_once("./controllers/Utilities.php");
require_once("./models/TrajetsModel.php");

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

   
}
