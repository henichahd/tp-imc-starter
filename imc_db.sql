-- Base de données du TP Calculateur d'IMC

-- Créer la base `imc_db` (interclassement utf8mb4_general_ci)
CREATE DATABASE IF NOT EXISTS imc_db
  CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Sélectionner la base
USE imc_db;

-- Table des patients
CREATE TABLE IF NOT EXISTS personnes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

-- Table des mesures (InnoDB pour la clé étrangère)
CREATE TABLE IF NOT EXISTS mesures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    personne_id INT NOT NULL,
    poids DECIMAL(5,1) NOT NULL,
    taille DECIMAL(3,2) NOT NULL,
    imc DECIMAL(4,1) NOT NULL,
    categorie VARCHAR(20) NOT NULL,
    date_mesure DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_mesures_personne
        FOREIGN KEY (personne_id) REFERENCES personnes(id)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- Données de test : 3 personnes
INSERT INTO personnes (id, nom, prenom) VALUES
(1, 'Ben Salah', 'Amine'),
(2, 'Trabelsi', 'Sana'),
(3, 'Gharbi', 'Youssef');

-- Données de test : 5 mesures
INSERT INTO mesures (personne_id, poids, taille, imc, categorie) VALUES
(1, 72.5, 1.75, 23.7, 'Normal'),
(1, 80.0, 1.75, 26.1, 'Surpoids'),
(2, 52.0, 1.68, 18.4, 'Sous-poids'),
(2, 58.0, 1.68, 20.5, 'Normal'),
(3, 95.0, 1.72, 32.1, 'Obésité');
