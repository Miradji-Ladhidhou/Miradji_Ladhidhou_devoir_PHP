<?php

require_once("./controllers/Utilities.php");
require_once("./models/AgencesModel.php");

class AgenceController
{
   public $agences;
   public function __construct()
   {
      $this->agences = new AgencesModel();
   }
   public function agencePage()
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
