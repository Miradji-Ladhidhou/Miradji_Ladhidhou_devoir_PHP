    <?php
    session_start();
    $isAdmin = isset($_SESSION['user']) && !empty($_SESSION['user']['est_admin']);
    ?>


    <h1>
        <?= $isAdmin ? 'Liste des trajets' : 'Bienvenue sur la page d\'accueil !' ?>
    </h1>

    <br>

    <h2>
        <?= $isAdmin ? '' : 'Consultez les trajets disponibles' ?>
    </h2>

    <?php
    require_once './models/TrajetsModel.php';
    $TrajetsModel = new TrajetsModel();
    if ($isAdmin) {
        $trajets = $TrajetsModel->getAlltrajets();
    } else {
        $trajets = $TrajetsModel->getTrajetsDisponibles();
    }

    ?>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Agence de départ</th>
                <th>Date de départ</th>
                <th>Heure de départ</th>
                <th>Agence d'arrivée</th>
                <th>Date d'arrivée</th>
                <th>Heure d'arrivée</th>
                <th>Places disponibles</th>
                <?php if (isset($_SESSION['user'])): ?>
                    <th>Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trajets as $trajet): ?>
                <tr>
                    <td><?= htmlspecialchars($trajet['agence_depart']) ?></td>
                    <td><?= date('d/m/Y', strtotime($trajet['date_heure_depart'])) ?></td>
                    <td><?= date('H:i', strtotime($trajet['date_heure_depart'])) ?></td>
                    <td><?= htmlspecialchars($trajet['agence_arrivee']) ?></td>
                    <td><?= date('d/m/Y', strtotime($trajet['date_heure_arrivee'])) ?></td>
                    <td><?= date('H:i', strtotime($trajet['date_heure_arrivee'])) ?></td>
                    <td><?= $trajet['places_disponibles'] ?></td>
                    <?php if (isset($_SESSION['user'])): ?>
                        <td>
                            <a href="details.php?id=<?= $trajet['id_trajets'] ?>">Détail</a>
                            <?php if ($_SESSION['user']['id'] == $trajet['id_users'] || $_SESSION['user']['est_admin']): ?>
                                | <a href="edit.php?id=<?= $trajet['id_trajets'] ?>">Modifier</a>
                            <?php endif; ?>
                            <?php if ($_SESSION['user']['est_admin']): ?>
                                | <a href="delete.php?id=<?= $trajet['id_trajets'] ?>" class="text-danger" onclick="return confirm('Supprimer ce trajet ?');">Supprimer</a>
                            <?php endif; ?>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>