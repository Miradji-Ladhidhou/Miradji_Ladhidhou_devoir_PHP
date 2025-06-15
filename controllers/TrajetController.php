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

   public function supprimerTrajet()
   {
      session_start();

      // Vérifie que l'utilisateur est admin (ou a le droit)
      if (!isset($_SESSION['user']) || empty($_SESSION['user']['est_admin'])) {
         // pas autorisé
         header('HTTP/1.1 403 Forbidden');
         exit('Accès refusé');
      }

      // Récupère l'id depuis GET et sécurise
      $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

      if (!$id) {
         // id invalide
         header('Location: index.php?page=trajets'); // ou autre page
         exit;
      }

      // Supprime le trajet
      $success = $this->trajets->deleteTrajet($id);

      // Redirige avec un message de succès ou d'erreur
      $_SESSION['message'] = $success
         ? "Trajet supprimé avec succès."
         : "Échec de la suppression du trajet.";

      header('Location: index.php?page=accueil');
      exit;
   }
}
