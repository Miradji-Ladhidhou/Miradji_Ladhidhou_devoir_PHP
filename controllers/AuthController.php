<?php
require_once './models/UserModel.php';

class AuthController
{
    public function auth()
{
    session_start();

    $error = $_SESSION['error'] ?? null;
    unset($_SESSION['error']); 

    // Si l'utilisateur est déjà connecté, rediriger vers la page d'accueil
    Utilities::renderPage([
        'views' => './views/pages/auth.php',
        'layout' => './views/layout/commun.php',
        'title' => 'Connexion',
        'description' => 'Page de connexion',
        'error' => $error 
    ]);
}


   public function loginProcess()
{
    session_start();

    // Récupérer email et mot de passe du formulaire
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Veuillez remplir tous les champs.";
        header('Location: ' . ROOT . 'index.php?page=login');
        exit;
    }

    // Chercher l'utilisateur dans la base
    $user = UserModel::findUserByEmail($email);

    if (!$user) {
        $_SESSION['error'] = "Email non trouvé.";
        header('Location: ' . ROOT . 'index.php?page=login');
        exit;
    }

    // Vérifier le mot de passe
    if (!password_verify($password, $user['mot_de_passe'])) {
        $_SESSION['error'] = "Mot de passe incorrect.";
        header('Location: ' . ROOT . 'index.php?page=login');
        exit;
    }

    // Authentification réussie : sauvegarder les infos utilisateur en session
    $_SESSION['user'] = [
        'id' => $user['id_users'],
        'prenom' => $user['prenom'],
        'nom' => $user['nom'],
        'est_admin' => $user['est_admin'],
    ];

    // Redirection vers la page d'accueil
    header('Location: ' . ROOT . 'index.php?page=accueil');
    exit;
}

// efface la session et redirige vers la page d'accueil
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ' . ROOT . 'index.php?page=accueil');
        exit;
    }
}
