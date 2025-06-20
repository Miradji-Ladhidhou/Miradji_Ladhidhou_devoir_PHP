<?php
session_start();

use Models\AgencesModel;
use Models\TrajetsModel;


if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}

$agenceModel = new AgencesModel();
$trajetsModel = new TrajetsModel();

$agences = $agenceModel->getAllagences();
$errors = [];
$success = false;

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='alert alert-danger'>Trajet invalide.</div>";
    exit;
}

$id_trajet = intval($_GET['id']);
$trajet = $trajetsModel->getTrajetById($id_trajet);

if ($_SESSION['user']['est_admin'] != 1 && $trajet['id_users'] != $_SESSION['user']['id']) {
    echo "Vous ne pouvez pas modifier ce trajet.";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $depart = $_POST['agence_depart'] ?? '';
    $arrivee = $_POST['agence_arrivee'] ?? '';
    $date_depart = $_POST['date_depart'] ?? '';
    $heure_depart = $_POST['heure_depart'] ?? '';
    $date_arrivee = $_POST['date_arrivee'] ?? '';
    $heure_arrivee = $_POST['heure_arrivee'] ?? '';
    $places_totales = intval($_POST['places_totales'] ?? 0);
    $places_disponibles = intval($_POST['places_disponibles'] ?? 0);

    if ($depart === $arrivee) $errors[] = "L'agence de départ et d'arrivée doivent être différentes.";
    if (empty($date_depart) || empty($heure_depart) || empty($date_arrivee) || empty($heure_arrivee)) $errors[] = "Toutes les dates et heures doivent être renseignées.";
    if ($places_totales < 1) $errors[] = "Le nombre de places doit être supérieur à 0.";
    if ($places_disponibles > $places_totales) $errors[] = "Les places disponibles ne peuvent pas dépasser le nombre total de places.";

    $datetime_depart = strtotime("$date_depart $heure_depart");
    $datetime_arrivee = strtotime("$date_arrivee $heure_arrivee");

    if ($datetime_arrivee <= $datetime_depart) $errors[] = "L'arrivée doit être après le départ.";

    if (empty($errors)) {
        $data = [
            'id_trajets' => $id_trajet,
            'id_agences_depart' => $depart,
            'id_agences_arrivee' => $arrivee,
            'date_heure_depart' => date('Y-m-d H:i:s', $datetime_depart),
            'date_heure_arrivee' => date('Y-m-d H:i:s', $datetime_arrivee),
            'places_totales' => $places_totales,
            'places_disponibles' => $places_disponibles,
        ];

        $trajetsModel->updateTrajet($id_trajet, $data);

        $success = true;

        $trajet = $trajetsModel->getTrajetById($id_trajet);
    }
}

$dt_depart = new DateTime($trajet['date_heure_depart']);
$dt_arrivee = new DateTime($trajet['date_heure_arrivee']);
?>

<div class="container mt-5">

    <?php if ($success): ?>
        <div class="flash">Trajet modifié avec succès !</div>
    <?php elseif (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <h2>Modifier un trajet</h2>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Agence de départ</label>
            <select name="agence_depart" class="form-select" required>
                <?php foreach ($agences as $a): ?>
                    <option value="<?= $a['id_agences'] ?>" <?= $trajet['id_agences_depart'] == $a['id_agences'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($a['ville']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Agence d'arrivée</label>
            <select name="agence_arrivee" class="form-select" required>
                <?php foreach ($agences as $a): ?>
                    <option value="<?= $a['id_agences'] ?>" <?= $trajet['id_agences_arrivee'] == $a['id_agences'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($a['ville']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Date de départ</label>
                <input type="date" name="date_depart" class="form-control" value="<?= $dt_depart->format('Y-m-d') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Heure de départ</label>
                <input type="time" name="heure_depart" class="form-control" value="<?= $dt_depart->format('H:i') ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Date d'arrivée</label>
                <input type="date" name="date_arrivee" class="form-control" value="<?= $dt_arrivee->format('Y-m-d') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Heure d'arrivée</label>
                <input type="time" name="heure_arrivee" class="form-control" value="<?= $dt_arrivee->format('H:i') ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Places totales</label>
            <input type="number" name="places_totales" class="form-control" min="1" value="<?= htmlspecialchars($trajet['places_totales']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Places disponibles</label>
            <input type="number" name="places_disponibles" class="form-control" min="0" value="<?= htmlspecialchars($trajet['places_disponibles']) ?>" required>
        </div>

        <button type="submit" class="btn">Enregistrer</button>
    </form>
</div>