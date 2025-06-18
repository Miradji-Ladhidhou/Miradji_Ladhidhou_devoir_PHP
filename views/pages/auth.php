<h2>Connexion</h2>

<form action="index.php?page=loginProcess" method="POST" class="auth">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br>
    <button type="submit" class="btn btn-success">Se connecter</button>
</form>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>