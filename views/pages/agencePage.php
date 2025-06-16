<?php
session_start();
require_once './models/AgencesModel.php';
use Models\AgencesModel;

$AgencesModel = new AgencesModel();
?>

<?php if (!empty($_SESSION['message'])): ?>
        <div style="color: green; padding: 10px;">
            <?= htmlspecialchars($_SESSION['message']) ?>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

<h1>Bienvenue sur la page des agences !</h1>


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
                       class="btn btn-danger btn-sm">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php?page=createAgence" class="btn btn-primary">Ajouter une agence</a>
