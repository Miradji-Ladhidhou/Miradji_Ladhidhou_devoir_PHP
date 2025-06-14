<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}

require_once './models/AgencesModel.php';
require_once './models/TrajetsModel.php';

$agenceModel = new AgencesModel();
$TrajetsModel = new TrajetsModel();

$agences = $agenceModel->getAllagences();

$errors = [];
$success = false;

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $depart = $_POST['agence_depart'] ?? '';
    $arrivee = $_POST['agence_arrivee'] ?? '';
    $date_depart = $_POST['date_depart'] ?? '';
    $heure_depart = $_POST['heure_depart'] ?? '';
    $date_arrivee = $_POST['date_arrivee'] ?? '';
    $heure_arrivee = $_POST['heure_arrivee'] ?? '';
    $places = intval($_POST['places'] ?? 0);

    // Validation
    if ($depart === $arrivee) $errors[] = "L'agence de départ et d'arrivée doivent être différentes.";
    if (empty($date_depart) || empty($heure_depart) || empty($date_arrivee) || empty($heure_arrivee)) $errors[] = "Toutes les dates et heures doivent être renseignées.";
    if ($places < 1) $errors[] = "Le nombre de places doit être supérieur à 0.";

    $datetime_depart = strtotime("$date_depart $heure_depart");
    $datetime_arrivee = strtotime("$date_arrivee $heure_arrivee");

    if ($datetime_arrivee <= $datetime_depart) $errors[] = "L'arrivée doit être après le départ.";

    if (empty($errors)) {
        $TrajetsModel->createTrajetPage([
            'id_users' => $_SESSION['user']['id'],
            'id_agences_depart' => $depart,
            'id_agences_arrivee' => $arrivee,
            'date_heure_depart' => date('Y-m-d H:i:s', $datetime_depart),
            'date_heure_arrivee' => date('Y-m-d H:i:s', $datetime_arrivee),
            'places_totales' => $places,
            'places_disponibles' => $places,
        ]);
        $success = true;
    }
}
?>

<div class="container mt-5">
    <h2>Création d'un trajet</h2>

    <?php if ($success): ?>
        <div class="alert alert-success">Trajet créé avec succès !</div>
    <?php elseif (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post">
        <fieldset disabled>
            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['nom']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Prénom</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['prenom']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['email']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Téléphone</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['telephone']) ?>">
            </div>
        </fieldset>

        <div class="mb-3">
            <label class="form-label">Agence de départ</label>
            <select name="agence_depart" class="form-select" required>
                <option value="">Sélectionnez...</option>
                <?php foreach ($agences as $a): ?>
                    <option value="<?= $a['id_agences'] ?>"><?= htmlspecialchars($a['ville']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Agence d'arrivée</label>
            <select name="agence_arrivee" class="form-select" required>
                <option value="">Sélectionnez...</option>
                <?php foreach ($agences as $a): ?>
                    <option value="<?= $a['id_agences'] ?>"><?= htmlspecialchars($a['ville']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Date de départ</label>
                <input type="date" name="date_depart" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Heure de départ</label>
                <input type="time" name="heure_depart" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Date d'arrivée</label>
                <input type="date" name="date_arrivee" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Heure d'arrivée</label>
                <input type="time" name="heure_arrivee" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">places_totales</label>
            <input type="number" name="places" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Créer le trajet</button>
    </form>
</div>