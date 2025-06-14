    <?php
    session_start();
    ?>


    <h1>Bienvenue sur la page des utilisateurs !</h1>

    <?php
    require_once './models/UtilisateursModel.php';
    $UtilisateursModel = new UtilisateursModel();
    ?>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($UtilisateursModel->getAllusers() as $users): ?>
                <tr>
                    <td><?= htmlspecialchars($users['prenom']) ?></td>
                    <td><?= htmlspecialchars($users['nom']) ?></td>
                    <td><?= htmlspecialchars($users['telephone']) ?></td>
                    <td><?= htmlspecialchars($users['email']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>