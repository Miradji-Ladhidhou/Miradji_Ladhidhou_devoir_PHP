    <?php
    session_start();
    ?>


    <h1>Bienvenue sur la page des agences !</h1>

    <?php
    require_once './models/AgencesModel.php';
    $AgencesModel = new AgencesModel();
    ?>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Agences</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($AgencesModel->getAllagences() as $agence): ?>
                <tr>
                    <td><?= htmlspecialchars($agence['ville']) ?></td>
                    <td>
                        | <a href="edit.php?id=<?= $trajet['id_trajets'] ?>">Modifier</a>
                        | <a href="delete.php?id=<?= $trajet['id_trajets'] ?>" class="text-danger">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button class="btn btn-primary">
        <a href="index.php?page=agence" class="text-white">Ajouter une agence</a>
    </button>