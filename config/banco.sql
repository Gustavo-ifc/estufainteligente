CREATE DATABASE IF NOT EXISTS estufa;
USE estufa;

CREATE TABLE IF NOT EXISTS estufa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    variedade VARCHAR(100) NOT NULL,
    responsavel VARCHAR(100) NOT NULL,
    latitude VARCHAR(50),
    longitude VARCHAR(50)
);


CREATE TABLE IF NOT EXISTS historico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    datahora VARCHAR(150) NOT NULL,
    temperatura VARCHAR(150) NOT NULL,
    umidade VARCHAR(150) NOT NULL,
    nvagua VARCHAR(150) NOT NULL
);


CREATE TABLE IF NOT EXISTS cadastro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL UNIQUE,
    numero VARCHAR(150) NOT NULL,
    senha VARCHAR(255) NOT NULL
    ADD COLUMN email VARCHAR(150) NOT NULL UNIQUE;

);


CREATE TABLE leituras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    estufa_id INT NOT NULL,
    temperatura DECIMAL(5,2) NOT NULL,
    umidade DECIMAL(5,2) NOT NULL,
    nivel_agua DECIMAL(5,2) NOT NULL,
    data_hora DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (estufa_id) REFERENCES estufa(id)
);


INSERT INTO leituras (estufa_id, temperatura, umidade, nivel_agua)
VALUES (1, 25.3, 60.2, 78.5);

INSERT INTO leituras (estufa_id, temperatura, umidade, nivel_agua)
VALUES (1, 26.1, 58.7, 80.0);

INSERT INTO leituras (estufa_id, temperatura, umidade, nivel_agua)
VALUES (1, 24.8, 62.5, 77.3);

INSERT INTO leituras (estufa_id, temperatura, umidade, nivel_agua)
VALUES (2, 27.4, 55.1, 72.9);

INSERT INTO leituras (estufa_id, temperatura, umidade, nivel_agua)
VALUES (2, 28.0, 54.6, 73.2);

INSERT INTO leituras (estufa_id, temperatura, umidade, nivel_agua)
VALUES (2, 26.7, 57.9, 70.4);

INSERT INTO leituras (estufa_id, temperatura, umidade, nivel_agua)
VALUES (1, 23.9, 65.8, 88.2);

INSERT INTO leituras (estufa_id, temperatura, umidade, nivel_agua)
VALUES (1, 24.3, 64.4, 89.0);

INSERT INTO leituras (estufa_id, temperatura, umidade, nivel_agua)
VALUES (1, 25.0, 63.2, 87.7);

INSERT INTO leituras (estufa_id, temperatura, umidade, nivel_agua)
VALUES (1, 29.1, 52.3, 68.5);
select * from leituras;

select   * from leituras 
where estufa_id = 2
and data_hora = (select max(b.data_hora) from leituras b where b.estufa_id = 2)

