<?php
session_start();
require_once './models/AgencesModel.php';
use Models\AgencesModel;

$AgencesModel = new AgencesModel();
?>

<!-- message flash  -->
<?php if (!empty($_SESSION['message'])): ?>
        <div class="flash">
            <?= htmlspecialchars($_SESSION['message']) ?>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

<h1>Bienvenue sur la page des agences !</h1>
<a href="index.php?page=createAgence" class="btn">Ajouter une agence</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Ville</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($AgencesModel->getAllagences() as $agence): ?>
            <tr>
                <td><?= htmlspecialchars($agence['ville']) ?></td>
                <td>
                    <a href="index.php?page=supprimerAgence&id=<?= $agence['id_agences'] ?>" 
                       onclick="return confirm('Confirmer la suppression de cette agence ?');" 
                       class="btn-danger btn-sm">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

