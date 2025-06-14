INSERT INTO agences (ville) VALUES 
('Paris'),
('Lyon'),
('Marseille'),
('Toulouse'),
('Nice'),
('Nantes'),
('Strasbourg'),
('Montpellier'),
('Bordeaux'),
('Lille'),
('Rennes'),
('Reims');


INSERT INTO users (prenom, nom, telephone, email, mot_de_passe, est_admin) VALUES
('Admin', 'Principal', '0123456789', 'admin@email.fr', '$2y$10$u6jhKsRFxOuKaxfzkAh/9eMlnY2EfKdchsn8f4FCJVc7wFmGo4v/O', TRUE),
('Martin', 'Alexandre', '0612345678', 'alexandre.martin@email.fr', '$2y$10$5aiDCgwRFRIrK8eLmZ.83OLBpg/M91HIjZfIoTmSeuaF5NiYByHTC', FALSE),
('Dubois', 'Sophie', '0698765432', 'sophie.dubois@email.fr', '$2y$10$5aiDCgwRFRIrK8eLmZ.83OLBpg/M91HIjZfIoTmSeuaF5NiYByHTC', FALSE),
('Bernard', 'Julien', '0622446688', 'julien.bernard@email.fr', '$2y$10$5aiDCgwRFRIrK8eLmZ.83OLBpg/M91HIjZfIoTmSeuaF5NiYByHTC', FALSE),
('Moreau', 'Camille', '0611223344', 'camille.moreau@email.fr', '$2y$10$5aiDCgwRFRIrK8eLmZ.83OLBpg/M91HIjZfIoTmSeuaF5NiYByHTC', FALSE),
('Lefèvre', 'Lucie', '0777889900', 'lucie.lefevre@email.fr', '$2y$10$5aiDCgwRFRIrK8eLmZ.83OLBpg/M91HIjZfIoTmSeuaF5NiYByHTC', FALSE),
('Leroy', 'Thomas', '0655443322', 'thomas.leroy@email.fr', '$2y$10$5aiDCgwRFRIrK8eLmZ.83OLBpg/M91HIjZfIoTmSeuaF5NiYByHTC', FALSE),
('Roux', 'Chloé', '0633221199', 'chloe.roux@email.fr', '$2y$10$5aiDCgwRFRIrK8eLmZ.83OLBpg/M91HIjZfIoTmSeuaF5NiYByHTC', FALSE),
('Petit', 'Maxime', '0766778899', 'maxime.petit@email.fr', '$2y$10$5aiDCgwRFRIrK8eLmZ.83OLBpg/M91HIjZfIoTmSeuaF5NiYByHTC', FALSE),
('Garnier', 'Laura', '0688776655', 'laura.garnier@email.fr', '$2y$10$5aiDCgwRFRIrK8eLmZ.83OLBpg/M91HIjZfIoTmSeuaF5NiYByHTC', FALSE),
('Dupuis', 'Antoine', '0744556677', 'antoine.dupuis@email.fr', '$2y$10$5aiDCgwRFRIrK8eLmZ.83OLBpg/M91HIjZfIoTmSeuaF5NiYByHTC', FALSE),
('Lefebvre', 'Emma', '0699887766', 'emma.lefebvre@email.fr', '$2y$10$5aiDCgwRFRIrK8eLmZ.83OLBpg/M91HIjZfIoTmSeuaF5NiYByHTC', FALSE),
('Fontaine', 'Louis', '0655667788', 'louis.fontaine@email.fr', '$2y$10$5aiDCgwRFRIrK8eLmZ.83OLBpg/M91HIjZfIoTmSeuaF5NiYByHTC', FALSE),
('Chevalier', 'Clara', '0788990011', 'clara.chevalier@email.fr', '$2y$10$5aiDCgwRFRIrK8eLmZ.83OLBpg/M91HIjZfIoTmSeuaF5NiYByHTC', FALSE),
('Robin', 'Nicolas', '0644332211', 'nicolas.robin@email.fr', '$2y$10$5aiDCgwRFRIrK8eLmZ.83OLBpg/M91HIjZfIoTmSeuaF5NiYByHTC', FALSE),
('Gauthier', 'Marine', '0677889922', 'marine.gauthier@email.fr', '$2y$10$5aiDCgwRFRIrK8eLmZ.83OLBpg/M91HIjZfIoTmSeuaF5NiYByHTC', FALSE),
('Fournier', 'Pierre', '0722334455', 'pierre.fournier@email.fr', '$2y$10$5aiDCgwRFRIrK8eLmZ.83OLBpg/M91HIjZfIoTmSeuaF5NiYByHTC', FALSE),
('Girard', 'Sarah', '0688665544', 'sarah.girard@email.fr', '$2y$10$5aiDCgwRFRIrK8eLmZ.83OLBpg/M91HIjZfIoTmSeuaF5NiYByHTC', FALSE),
('Lambert', 'Hugo', '0611223366', 'hugo.lambert@email.fr', '$2y$10$5aiDCgwRFRIrK8eLmZ.83OLBpg/M91HIjZfIoTmSeuaF5NiYByHTC', FALSE),
('Masson', 'Julie', '0733445566', 'julie.masson@email.fr', '$2y$10$5aiDCgwRFRIrK8eLmZ.83OLBpg/M91HIjZfIoTmSeuaF5NiYByHTC', FALSE),
('Henry', 'Arthur', '0666554433', 'arthur.henry@email.fr', '$2y$10$5aiDCgwRFRIrK8eLmZ.83OLBpg/M91HIjZfIoTmSeuaF5NiYByHTC', FALSE);


-- Trajet 1 : Paris → Lyon
INSERT INTO trajets (
    id_users, id_agences_depart, id_agences_arrivee,
    date_heure_depart, date_heure_arrivee,
    places_total, places_disponibles
) VALUES (
    2, 1, 2,
    '2025-06-10 08:30:00', '2025-06-10 12:30:00',
    4, 4
);

-- Trajet 2 : Marseille → Toulouse
INSERT INTO trajets (
    id_users, id_agences_depart, id_agences_arrivee,
    date_heure_depart, date_heure_arrivee,
    places_total, places_disponibles
) VALUES (
    3, 3, 4,
    '2025-06-12 14:00:00', '2025-06-12 18:00:00',
    3, 3
);


-- Réservation 1 : pour le trajet Paris → Lyon (id_trajets = 1), par l'utilisateur 4
INSERT INTO reservations (
    id_trajets, id_users, places_reservees
) VALUES (
    1, 4, 1
);

-- Réservation 2 : pour le trajet Marseille → Toulouse (id_trajets = 2), par l'utilisateur 5
INSERT INTO reservations (
    id_trajets, id_users, places_reservees
) VALUES (
    2, 5, 2
);

