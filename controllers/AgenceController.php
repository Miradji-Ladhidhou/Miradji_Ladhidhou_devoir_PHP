<?php

namespace Controllers;

use Models\AgencesModel;
use Controllers\Utilities;


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

   public function createAgencePage()
   {
      $datas_page = [
         'views' => "./views/pages/createAgencePage.php",
         'layout' => "./views/layout/commun.php",
         'title' => "Création d'une agence",
         'description' => "Formulaire de création d'une nouvelle agence."
      ];

      Utilities::renderPage($datas_page);
   }

  public function supprimerAgence()
   {
      session_start();

      // Vérifie que l'utilisateur est connecté ou est admin
      // Récupère l'id depuis GET et sécurise
      $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

      if (!$id) {
         header('Location: index.php?page=agence');
         exit;
      }

      // Récupère l'agence
      $agence = $this->agences->getAgenceById($id);

      // Vérifie que l'utilisateur est connecté et a le droit de supprimer
      if (!isset($_SESSION['user']) || (!$_SESSION['user']['est_admin'] && $agence['id_users'] != $_SESSION['user']['id'])) {
         header('HTTP/1.1 403 Forbidden');
         exit('Accès refusé');
      }

      if (!$id) {
         // id invalide
         header('Location: index.php?page=agence'); // ou autre page
         exit;
      }

      // Supprime le agence
      $success = $this->agences->deleteAgence($id);

      // Redirige avec un message de succès ou d'erreur
      $_SESSION['message'] = $success
         ? "Agence supprimé avec succès."
         : "Échec de la suppression de l'agence.";

      header('Location: index.php?page=agence');
      exit;
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
