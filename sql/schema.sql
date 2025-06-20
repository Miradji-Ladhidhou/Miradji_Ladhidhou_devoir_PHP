-- Créer la base de données
CREATE DATABASE IF NOT EXISTS App_covoiturage CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE App_covoiturage;

-- table users
CREATE TABLE users(
    id_users INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(50) NOT NULL,
    nom VARCHAR(50) NOT NULL,
    telephone VARCHAR(20),
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    est_admin BOOLEAN DEFAULT FALSE
);

-- table agences
CREATE TABLE agences (
    id_agences INT AUTO_INCREMENT PRIMARY KEY,
    ville VARCHAR(100) NOT NULL
);

-- table trajets
CREATE TABLE trajets (
    id_trajets INT AUTO_INCREMENT PRIMARY KEY,
    id_users INT NOT NULL,
    id_agences_depart INT NOT NULL,
    id_agences_arrivee INT NOT NULL,
    date_heure_depart DATETIME NOT NULL,
    date_heure_arrivee DATETIME NOT NULL,
    places_totales INT NOT NULL, 
    places_disponibles INT NOT NULL, 
    FOREIGN KEY (id_users) REFERENCES users(id_users) ON DELETE CASCADE,
    FOREIGN KEY (id_agences_depart) REFERENCES agences(id_agences) ON DELETE RESTRICT,
    FOREIGN KEY (id_agences_arrivee) REFERENCES agences(id_agences) ON DELETE RESTRICT
);


