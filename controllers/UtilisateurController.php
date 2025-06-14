<?php
namespace Controllers;

use Controllers\Utilities;
use Models\UtilisateursModel;

class UtilisateurController
{
   public $utilisateurs;
   public function __construct()
   {
      $this->utilisateurs = new UtilisateursModel();
   }
   public function utilisateurPage()
   {
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
