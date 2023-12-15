-- Creazione del database
CREATE DATABASE IF NOT EXISTS Biblioteca;
USE Biblioteca;

-- Creazione della tabella "Libri"
CREATE TABLE IF NOT EXISTS Libri (
    ISBN VARCHAR(13) PRIMARY KEY,
    Titolo VARCHAR(100),
    Autore VARCHAR(50),
    AnnoPubblicazione INT,
    QuantitaInMagazzino INT
);

-- Inserimento di dati nella tabella "Libri"
INSERT INTO Libri (ISBN, Titolo, Autore, AnnoPubblicazione, QuantitaInMagazzino) VALUES
('9780544003415', 'Il Signore degli Anelli', 'J.R.R. Tolkien', 1954, 10),
('9780553803709', 'Il Codice Da Vinci', 'Dan Brown', 2003, 8),
('9780141441146', '1984', 'George Orwell', 1949, 12),
('9780061120084', 'Cronache di Narnia', 'C.S. Lewis', 1950, 15),
('9788807886655', 'Harry Potter e la Pietra Filosofale', 'J.K. Rowling', 1997, 20);

-- Creazione della tabella "Utenti"
CREATE TABLE IF NOT EXISTS Utenti (
    IDUtente INT PRIMARY KEY,
    Nome VARCHAR(50),
    Cognome VARCHAR(50),
    DataNascita DATE,
    Email VARCHAR(100)
);

-- Inserimento di dati nella tabella "Utenti"
INSERT INTO Utenti (IDUtente, Nome, Cognome, DataNascita, Email) VALUES
(1, 'Mario', 'Rossi', '1990-05-15', 'mario.rossi@email.com'),
(2, 'Luca', 'Verdi', '1985-09-22', 'luca.verdi@email.com'),
(3, 'Anna', 'Bianchi', '1995-03-10', 'anna.bianchi@email.com');

-- Creazione della tabella "Prestiti"
CREATE TABLE IF NOT EXISTS Prestiti (
    IDPrestito INT PRIMARY KEY,
    ISBNLibro VARCHAR(13),
    IDUtente INT,
    DataPrestito DATE,
    DataScadenza DATE,
    FOREIGN KEY (ISBNLibro) REFERENCES Libri(ISBN),
    FOREIGN KEY (IDUtente) REFERENCES Utenti(IDUtente)
);

-- Inserimento di dati nella tabella "Prestiti"
INSERT INTO Prestiti (IDPrestito, ISBNLibro, IDUtente, DataPrestito, DataScadenza) VALUES
(1, '9780544003415', 1, '2023-03-01', '2023-03-15'),
(2, '9780553803709', 2, '2023-03-05', '2023-03-20'),
(3, '9780141441146', 3, '2023-03-10', '2023-03-25');

-- Aggiunta di libri
INSERT INTO Libri (ISBN, Titolo, Autore, AnnoPubblicazione, QuantitaInMagazzino) VALUES
('9780061120085', 'Le Cronache del Ghiaccio e del Fuoco', 'George R.R. Martin', 1996, 5),
('9788804645238', 'Dune', 'Frank Herbert', 1965, 7),
('9788806180825', 'Norwegian Wood', 'Haruki Murakami', 1987, 10);

-- Aggiunta di utenti
INSERT INTO Utenti (IDUtente, Nome, Cognome, DataNascita, Email) VALUES
(4, 'Laura', 'Ferrari', '1988-07-20', 'laura.ferrari@email.com'),
(5, 'Riccardo', 'Russo', '1992-01-12', 'riccardo.russo@email.com'),
(6, 'Valeria', 'Galli', '1995-09-30', 'valeria.galli@email.com');

-- Aggiunta di prestiti
INSERT INTO Prestiti (IDPrestito, ISBNLibro, IDUtente, DataPrestito, DataScadenza) VALUES
(4, '9780061120085', 2, '2023-03-15', '2023-03-30'),
(5, '9788804645238', 1, '2023-03-18', '2023-04-02'),
(6, '9788806180825', 3, '2023-03-22', '2023-04-06');

