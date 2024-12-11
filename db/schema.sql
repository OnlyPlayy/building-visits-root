-- Tworzenie bazy danych
CREATE DATABASE system_wizyt;

-- Wybór bazy danych
USE system_wizyt;

-- Tworzenie tabeli wizyt
CREATE TABLE visits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address VARCHAR(255) NOT NULL,
    service_type ENUM('Montaż okien', 'Montaż drzwi', 'Inne') NOT NULL,
    visit_date DATETIME NOT NULL,
    photo_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Przykładowe dane wizyty
INSERT INTO visits (name, email, phone, address, service_type, visit_date)
VALUES ('Jan Kowalski', 'jan.kowalski@example.com', '123456789', 'Warszawa, ul. Przykładowa 1', 'Montaż okien', '2024-12-15 14:00:00');
