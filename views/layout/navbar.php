<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= htmlspecialchars(ROOT) ?>">TOUCHE PAS AU KLAXON</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        <?php if (!isset($_SESSION['user'])): ?>
          <!-- User non connecté -->
          <li class="nav-item">
            <a class="nav-link" href="<?= htmlspecialchars(ROOT) ?>index.php?page=login">Connexion</a>
          </li>

        <?php else: ?>
          <!-- Affiche nom/prénom -->
          <li class="nav-item nav-link disabled">
            Bonjour <?= htmlspecialchars($_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']) ?>
          </li>

          <?php if (!empty($_SESSION['user']['est_admin'])): ?>

            <!-- User admin -->
            <li class="nav-item">
              <a class="nav-link" href="<?= htmlspecialchars(ROOT) ?>index.php?page=utilisateur">Utilisateurs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= htmlspecialchars(ROOT) ?>index.php?page=agence">Agences</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= htmlspecialchars(ROOT) ?>index.php?page=accueil">Trajets</a>
            </li>
          <?php else: ?>

            <!-- User connecté -->
            <li class="nav-item">
              <a class="nav-link" href="<?= htmlspecialchars(ROOT) ?>index.php?page=trajet">Création trajet</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= htmlspecialchars(ROOT) ?>index.php?page=accueil">Trajets</a>
            </li>
          <?php endif; ?>

          <!-- Déconnexion pour tous les users connectés -->
          <li class="nav-item">
            <a class="nav-link" href="<?= htmlspecialchars(ROOT) ?>logout">Déconnexion</a>
          </li>

        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>