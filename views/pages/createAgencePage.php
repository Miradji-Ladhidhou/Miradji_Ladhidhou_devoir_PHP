<?php
session_start();

use Models\AgencesModel;

if (!isset($_SESSION['user']) || empty($_SESSION['user']['est_admin'])) {
    header('HTTP/1.1 403 Forbidden');
    exit('Accès réservé aux administrateurs.');
}

require_once './models/AgencesModel.php';

$agenceModel = new AgencesModel();

$errors = [];
$success = false;

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ville = trim($_POST['ville'] ?? '');

    // Validation
    if (empty($ville)) {
        $errors[] = "La ville est obligatoire.";
    }

    if (empty($errors)) {
        $success = $agenceModel->createAgence($ville);
    }
}
?>

<div class="container mt-5">

    <?php if ($success): ?>
        <div class="flash">Agence créée avec succès !</div>
    <?php elseif (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <h2>Création d'une agence</h2>

    <form method="post">
        <fieldset disabled>
            <div class="mb-3">
                <label class="form-label">Administrateur</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['nom'] . ' ' . $_SESSION['user']['prenom']) ?>">
            </div>
        </fieldset>

        <div class="mb-3">
            <label class="form-label">Ville</label>
            <input type="text" name="ville" class="form-control" required>
        </div>

        <button type="submit" class="btn">Créer l'agence</button>
    </form>
</div>