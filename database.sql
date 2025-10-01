-- Création de la base de données
CREATE DATABASE IF NOT EXISTS habit_tracker;
USE habit_tracker;

-- Suppression si existante
DROP TABLE IF EXISTS habit_logs;
DROP TABLE IF EXISTS habits;
DROP TABLE IF EXISTS mns_user;

-- Table utilisateurs
CREATE TABLE IF NOT EXISTS mns_user (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  firstname VARCHAR(50) NOT NULL,
  lastname VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  isadmin TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Ajout d'un utilisateur admin
INSERT INTO mns_user (firstname, lastname, email, password, isadmin) VALUES
('Admin', 'HT', 'admin@ht-buggy-wapp.fr', '$2y$10$.4UY3kD7IXNKAAAY3p.s/.UkbH8da6aQPdGh7DjQ4D.pHIvSNtAUm', 1);

-- Ajout d'un utilisateur standard
INSERT INTO mns_user (firstname, lastname, email, password, isadmin) VALUES
('User', 'HT', 'user@ht-buggy-wapp.fr', '$2y$10$.4UY3kD7IXNKAAAY3p.s/.UkbH8da6aQPdGh7DjQ4D.pHIvSNtAUm', 0);

-- Table des habitudes
CREATE TABLE habits (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES mns_user(id) ON DELETE CASCADE
);

-- Table des logs quotidiens
CREATE TABLE habit_logs (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    habit_id INT UNSIGNED NOT NULL,
    log_date DATE NOT NULL,
    status TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (habit_id) REFERENCES habits(id) ON DELETE CASCADE,
    UNIQUE(habit_id, log_date)
);