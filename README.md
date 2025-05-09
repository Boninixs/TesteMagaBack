# ✨ Hello, world! Bem-vindos ao meu projeto! ✨  

Olá, leitor! 💖 Meu nome é **Aline**, mas pode me chamar de **Boni** tenho 21 anos e sou apaixonada por tecnologia, desenvolvimento mobile, back-end.📚✨  

🌸 Sou natural de **São Paulo**, mas há 2 anos me mudei para **Ibirama** para seguir meu sonho de cursar **Engenharia de Software**. Está sendo uma jornada cheia de desafios, aprendizados

---

## 💡 Sobre este repositório  

Este repositório foi desenvolvido por mim para comprovar minhas habilidades no teste de estágio Magazord! Aqui, compartilho um projeto que foi um **desafio superinteressante**, no qual aprendi bastante e pude ter um contato maior com o desenvolvimento back-end. Espero que ele possa ajudar outras pessoas também, além de comprovar minhas habilidades :D! 🌷  


## 🎀 Conecte-se comigo!  

Se quiser trocar ideias sobre tecnologia, programação ou apenas falar sobre gatinhos fofos, fique à vontade para me chamar! 💌  

💻 [**LinkedIn**](https://www.linkedin.com/in/aline-rodrigues-santos-535966241/) 
📧 [**Email**](Aline.RS@edu.udesc.br)

Obrigada por passar por aqui! Espero que goste do projeto! ✨ 

---

## 🌸 Sobre a execução do projeto:

O banco de dados utilizado foi MySql, para rodar a aplicação utilizei o servidor do Xampp e também o SDBD phpMyAdmin integrado ao próprio Xampp para o gerenciamento de banco de dados.

Scripts para criação do banco e tabelas correspondentes: 

CREATE DATABASE IF NOT EXISTS bancoexemplo
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

use bancoexemplo;

CREATE TABLE pessoa (
    idpessoa INT AUTO_INCREMENT PRIMARY KEY,
    nomepessoa VARCHAR(100) NOT NULL,
    cpfpessoa VARCHAR(14) NOT NULL
);

CREATE TABLE contato (
    idcontato INT AUTO_INCREMENT PRIMARY KEY,
    idpessoa INT NOT NULL,
    tipocontato BOOLEAN NOT NULL, -- 0 = telefone, 1 = email
    descricaocontato VARCHAR(255) NOT NULL,
    FOREIGN KEY (idpessoa) REFERENCES pessoa(idpessoa)
);

Recomendo utilizar o xampp para rodar o servidor, e alocar a pasta fonte do projeto em xampp/htdocs, a pasta destinada a armazenar os arquivos que utilizarão o servidor.

Foi utilizado o Composer e a partir dele, o Doctrine/ORM e Symfony/cache. Por já exisitr a pasta Vendor no projeto, acredito que não seja necessário ter o Composer instalado.
