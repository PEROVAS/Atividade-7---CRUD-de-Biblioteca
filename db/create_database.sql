CREATE DATABASE biblioteca;
USE biblioteca;

CREATE TABLE autores (
    id_autor INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    nacionalidade VARCHAR(50),
    ano_nascimento YEAR
);

CREATE TABLE livros (
    id_livro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    genero VARCHAR(50),
    ano_publicacao YEAR CHECK (ano_publicacao > 1500 AND ano_publicacao <= YEAR(CURDATE())),
    id_autor INT NOT NULL,
    FOREIGN KEY (id_autor) REFERENCES autores(id_autor) ON DELETE CASCADE
);

CREATE TABLE leitores (
    id_leitor INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    telefone VARCHAR(20)
);

CREATE TABLE emprestimos (
    id_emprestimo INT AUTO_INCREMENT PRIMARY KEY,
    id_livro INT NOT NULL,
    id_leitor INT NOT NULL,
    data_emprestimo DATE NOT NULL,
    data_devolucao DATE DEFAULT NULL,
    CONSTRAINT fk_livro FOREIGN KEY (id_livro) REFERENCES livros(id_livro) ON DELETE CASCADE,
    CONSTRAINT fk_leitor FOREIGN KEY (id_leitor) REFERENCES leitores(id_leitor) ON DELETE CASCADE,
    CONSTRAINT chk_datas CHECK (data_devolucao IS NULL OR data_devolucao >= data_emprestimo)
);



INSERT INTO autores (nome, nacionalidade, ano_nascimento) VALUES
('Machado de Assis', 'Brasileiro', 1839),
('J. K. Rowling', 'Britânica', 1965),
('George Orwell', 'Britânico', 1903);

INSERT INTO livros (titulo, genero, ano_publicacao, id_autor) VALUES
('Dom Casmurro', 'Romance', 1899, 1),
('Harry Potter e a Pedra Filosofal', 'Fantasia', 1997, 2),
('1984', 'Distopia', 1949, 3);

INSERT INTO leitores (nome, email, telefone) VALUES
('Ana Silva', 'ana@email.com', '1199999999'),
('Carlos Souza', 'carlos@email.com', '1198888888'),
('Mariana Lima', 'mariana@email.com', '1197777777');

INSERT INTO emprestimos (id_livro, id_leitor, data_emprestimo) VALUES
(1, 1, '2025-08-01'),
(2, 2, '2025-08-05');
