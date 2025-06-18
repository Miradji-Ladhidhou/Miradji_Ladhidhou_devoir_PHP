<?php

namespace Controllers;

use Models\UserModel;

/**
 * Contrôleur pour la gestion de l'authentification utilisateur.
 */
class AuthController
{
    /**
     * Affiche la page de connexion.
     * Si l'utilisateur est déjà connecté, il est redirigé automatiquement.
     *
     * @return void
     */
    public function auth(): void
    {
        session_start();

        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);

        Utilities::renderPage([
            'views' => './views/pages/auth.php',
            'layout' => './views/layout/commun.php',
            'title' => 'Connexion',
            'description' => 'Page de connexion',
            'error' => $error
        ]);
    }

    /**
     * Traite les données du formulaire de connexion.
     * Authentifie l'utilisateur et le redirige vers la page appropriée.
     *
     * @return void
     */
    public function loginProcess(): void
    {
        session_start();

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $_SESSION['error'] = "Veuillez remplir tous les champs.";
            header('Location: ' . ROOT . 'index.php?page=login');
            exit;
        }

        /** @var array<string, mixed>|null $user */
        $user = UserModel::findUserByEmail($email);

        if (!$user) {
            $_SESSION['error'] = "Email non trouvé.";
            header('Location: ' . ROOT . 'index.php?page=login');
            exit;
        }

        if (!password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['error'] = "Mot de passe incorrect.";
            header('Location: ' . ROOT . 'index.php?page=login');
            exit;
        }

        // Stocke les infos utilisateur en session
        $_SESSION['user'] = [
            'id' => $user['id_users'],
            'prenom' => $user['prenom'],
            'nom' => $user['nom'],
            'email' => $user['email'],
            'telephone' => $user['telephone'],
            'est_admin' => $user['est_admin'],
        ];

        // Redirige selon le rôle
        if (!empty($user['est_admin'])) {
            header('Location: index.php?page=dashboard');
            exit;
        }

        header('Location: index.php?page=accueil');
        exit;
    }

    /**
     * Déconnecte l'utilisateur et redirige vers la page d'accueil.
     *
     * @return void
     */
    public function logout(): void
    {
        session_start();
        session_destroy();
        header('Location: ' . ROOT . 'index.php?page=accueil');
        exit;
    }
}
