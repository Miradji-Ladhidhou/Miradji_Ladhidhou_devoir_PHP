<?php

require_once("./controllers/Utilities.php");
require_once("./models/trajetsModel.php");

class MainController
{
   public $trajets;

   public function __construct()
   {
      // session_start(); // supprimé comme demandé
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
