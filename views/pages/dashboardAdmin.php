<?php

use Models\UserModel;
use Models\AgencesModel;
use Models\TrajetsModel;


if (!isset($_SESSION['user']) || !$_SESSION['user']['est_admin']) {
    header('Location: index.php?page=login');
    exit;
}

$userModel = new UserModel();
$agenceModel = new AgencesModel();
$trajetModel = new TrajetsModel();

$users = $userModel->getAllusers();
$agences = $agenceModel->getAllagences();
$trajets = $trajetModel->getAlltrajets();
?>

<div class="container py-5">
    <h1 class="text-center mb-5 fw-bold">Tableau de bord Administrateur</h1>

    <div class="accordion" id="accordionDashboard">
        <!-- Utilisateurs -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingUsers">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
                    Utilisateurs (<?= count($users ?? []) ?>)
                </button>
            </h2>
            <div id="collapseUsers" class="accordion-collapse collapse show" aria-labelledby="headingUsers" data-bs-parent="#accordionDashboard">
                <div class="accordion-body">
                    <p><strong>Total :</strong> <?= count($users ?? []) ?> utilisateur(s) inscrit(s).</p>
                    <a href="index.php?page=utilisateur" class="btn btn-primary">Gérer les utilisateurs</a>
                </div>
            </div>
        </div>

        <!-- Agences -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingAgences">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAgences" aria-expanded="false" aria-controls="collapseAgences">
                    Agences (<?= count($agences ?? []) ?>)
                </button>
            </h2>
            <div id="collapseAgences" class="accordion-collapse collapse" aria-labelledby="headingAgences" data-bs-parent="#accordionDashboard">
                <div class="accordion-body">
                    <p><strong>Total :</strong> <?= count($agences ?? []) ?> agence(s).</p>
                    <a href="index.php?page=agence" class="btn btn-success">Gérer les agences</a>
                </div>
            </div>
        </div>

        <!-- Trajets -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTrajets">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTrajets" aria-expanded="false" aria-controls="collapseTrajets">
                    Trajets (<?= count($trajets ?? []) ?>)
                </button>
            </h2>
            <div id="collapseTrajets" class="accordion-collapse collapse" aria-labelledby="headingTrajets" data-bs-parent="#accordionDashboard">
                <div class="accordion-body">
                    <p><strong>Total :</strong> <?= count($trajets ?? []) ?> trajet(s).</p>
                    <a href="index.php?page=accueil" class="btn btn-warning">Gérer les trajets</a>
                </div>
            </div>
        </div>
    </div>
</div>