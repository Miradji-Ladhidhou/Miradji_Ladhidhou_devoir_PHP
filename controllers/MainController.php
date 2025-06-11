<?php

require_once("./controllers/Utilities.php");
require_once("./models/trajets.php");



class MainController {

   public $agences;

   public function __construct() {
      $this->agences = new Agences();
   }


   public function homePage() {

      $agences = $this->agences->getAllAgences();

      $datas_page = [
         'views' => "./views/pages/homePage.php",
         'layout' => "./views/layout/commun.php",
         'title' => "Page d'accueil",
         'description' => "Bienvenue sur la page d'accueil de notre site web.",
         'agences' => $agences
      ];

      Utilities::renderPage($datas_page);
   }


     public function errorPage($message) {

      

      $datas_page = [
         'views' => "./views/pages/errorPage.php",
         'layout' => "./views/layout/commun.php",
         'title' => "erreur 404",
         'description' => "on est perdu, on ne trouve pas la page",
         'message' => $message,

      ];

      Utilities::renderPage($datas_page);
   }
}