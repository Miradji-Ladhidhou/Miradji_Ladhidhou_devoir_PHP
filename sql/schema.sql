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
    places_total INT NOT NULL, 
    places_disponibles INT NOT NULL, 
    FOREIGN KEY (id_users) REFERENCES users(id_users) ON DELETE CASCADE,
    FOREIGN KEY (id_agences_depart) REFERENCES agences(id_agences) ON DELETE RESTRICT,
    FOREIGN KEY (id_agences_arrivee) REFERENCES agences(id_agences) ON DELETE RESTRICT
);

-- table reservations
CREATE TABLE reservations (
    id_reservations INT AUTO_INCREMENT PRIMARY KEY,
    id_trajets INT NOT NULL,
    id_users INT NOT NULL,
    date_reservations DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    places_reservees INT NOT NULL,
    FOREIGN KEY (id_trajets) REFERENCES trajets(id_trajets) ON DELETE CASCADE,
    FOREIGN KEY (id_users) REFERENCES users(id_users) ON DELETE CASCADE
);

