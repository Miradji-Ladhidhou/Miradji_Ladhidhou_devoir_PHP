    <?php
    session_start();

    use Models\TrajetsModel;
    ?>

    <?php if (!empty($_SESSION['message'])): ?>
        <div class="flash">
            <?= htmlspecialchars($_SESSION['message']) ?>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>


    <?php
    $isLoggedIn = isset($_SESSION['user']);
    $isAdmin = $isLoggedIn && !empty($_SESSION['user']['est_admin']) && $_SESSION['user']['est_admin'];

    if (!$isLoggedIn): ?>
        <h1>Bienvenue sur la liste des trajets</h1>
        <h2>Pour plus d'information sur un trajet, veuillez vous connecter</h2>

    <?php elseif ($isAdmin): ?>
        <h1>Bienvenue sur la page des trajets!</h1>
        <a href="index.php?page=createTrajet" class="btn">Ajouter un trajet</a>

    <?php else: ?>
        <h1>Bienvenue sur la liste des trajets</h1>
        <h2>Trajets proposés</h2>
    <?php endif; ?>

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
                            <button type="button" class="btnModal" data-bs-toggle="modal" data-bs-target="#modalLabel<?= $trajet['id_trajets'] ?>">
                                Détail
                            </button>
                            <div class="modal fade" id="modalLabel<?= $trajet['id_trajets'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $trajet['id_trajets'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel<?= $trajet['id_trajets'] ?>">Détails du trajet</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h6>Conducteur</h6>
                                            <ul>
                                                <li><strong>Auteur :</strong> <?= htmlspecialchars($trajet['nom'] . ' ' . $trajet['prenom']) ?></li>
                                                <li><strong>Téléphone :</strong> <?= htmlspecialchars($trajet['telephone']) ?></li>
                                                <li><strong>Email :</strong> <?= htmlspecialchars($trajet['email']) ?></li>
                                                <li><strong>Nombre total de places :</strong> <?= htmlspecialchars($trajet['places_totales']) ?></li>
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if (
                                isset($_SESSION['user']['id'], $trajet['id_users']) && ($_SESSION['user']['id'] == $trajet['id_users'] || !empty($_SESSION['user']['est_admin']))
                            ): ?>
                                | <a href="index.php?page=modifierTrajet&id=<?= $trajet['id_trajets'] ?>">Modifier</a>
                                | <a href="index.php?page=supprimerTrajet&id=<?= $trajet['id_trajets'] ?>" class="text-danger" onclick="return confirm('Supprimer ce trajet ?');">Supprimer</a>
                            <?php endif; ?>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>