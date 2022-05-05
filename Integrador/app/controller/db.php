<?php

$db = connectToDB();

function connectToDB()
{
    try {
        $dsn = 'pgsql:host=localhost;dbname=integrador';
        $user = 'postgres';
        $password = 'postgres'; // hard coded passwords are very safe 👍
        $db = new PDO($dsn, $user, $password);
        return $db;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return null;
        exit();
    }
}

function createDB()
{
    try {
        $dsn = 'pgsql:host=localhost;';
        $user = 'postgres';
        $password = 'postgres'; // hard coded passwords are very safe 👍
        $db = new PDO($dsn, $user, $password);
        $db->exec('CREATE DATABASE integrador');
        $db = new PDO($dsn . 'dbname=integrador', $user, $password);
        return $db;
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}

function createTables($db)
{

    if ($db == NULL) $db = createDB();

    try {
        $db->exec(

            "CREATE TABLE usuario(
                CPF varchar(11) NOT NULL PRIMARY KEY,
                nome varchar(100) NOT NULL,
                senha varchar(256) NOT NULL,
                ntel varchar(11) NOT NULL,
                email varchar(100) NOT NULL,
                data_nascimento date NOT NULL,
                tipo char(1) NOT NULL,
                cargo varchar(50),
                e_logradouro varchar(150),
                e_numero varchar(4),
                e_complemento varchar(20),
                e_cep varchar(11)
            ); 
            
            CREATE TABLE funcao(
                ID serial NOT NULL PRIMARY KEY,
                descricao text NOT NULL
            );

            CREATE TABLE usuario_pode_exercer(
                fk_usuario varchar(11) NOT NULL,
                fk_funcao integer NOT NULL,
                PRIMARY KEY (fk_usuario,fk_funcao),
                FOREIGN KEY(fk_usuario) REFERENCES usuario(CPF),
                FOREIGN KEY(fk_funcao) REFERENCES funcao(ID)
            );

            CREATE TABLE escala_de_trabalho(
                ID serial NOT NULL PRIMARY KEY,
                descr text NOT NULL
            );

            CREATE TABLE tuplas_escala(
                fk_usuario varchar(11) NOT NULL,
                fk_funcao integer NOT NULL,
                fk_escala integer NOT NULL,
                FOREIGN KEY(fk_usuario) REFERENCES usuario(CPF),
                FOREIGN KEY(fk_funcao) REFERENCES funcao(ID),
                FOREIGN KEY(fk_escala) REFERENCES escala_de_trabalho(ID)
            );


            CREATE TABLE ambiente(
                ID SERIAL NOT NULL PRIMARY KEY,
                nome varchar(30) UNIQUE NOT NULL,
                capacidade integer NOT NULL,
                descr_infraestrutura text NOT NULL
            );


            CREATE TABLE culto(
                data_hora timestamp NOT NULL PRIMARY KEY,
                total_presentes integer NOT NULL,
                fk_escala serial NOT NULL,
                fk_ambiente serial NOT NULL,
                FOREIGN KEY(fk_escala) REFERENCES escala_de_trabalho(ID),
                FOREIGN KEY(fk_ambiente) REFERENCES ambiente(ID)
            ); 

            CREATE TABLE agendamento(
                ID serial NOT NULL PRIMARY KEY,
                data_hora timestamp NOT NULL,
                descricao text NOT NULL,
                fk_escala serial NOT NULL,
                fk_ambiente serial NOT NULL,
                FOREIGN KEY(fk_escala) REFERENCES escala_de_trabalho(ID),
                FOREIGN KEY(fk_ambiente) REFERENCES ambiente(id)
            );

            CREATE TABLE evento(
                ID serial NOT NULL PRIMARY KEY,
                data_hora timestamp NOT NULL,
                descricao text NOT NULL,
                fk_escala serial NOT NULL,
                fk_ambiente serial NOT NULL,
                FOREIGN KEY(fk_escala) REFERENCES escala_de_trabalho(ID),
                FOREIGN KEY(fk_ambiente) REFERENCES ambiente(ID)
            );

            CREATE TABLE usuario_presente(
                fk_usuario varchar(11) NOT NULL,
                fk_evento integer NOT NULL,
                PRIMARY KEY(fk_usuario, fk_evento),
                FOREIGN KEY(fk_usuario) REFERENCES usuario(CPF),
                FOREIGN KEY(fk_evento) REFERENCES evento(ID)
            );

            CREATE TABLE grupo(
                ID serial NOT NULL PRIMARY KEY,
                nome varchar(50)
            );

            CREATE TABLE usuario_participa(
                fk_usuario varchar(11) NOT NULL,
                fk_grupo integer NOT NULL,
                PRIMARY KEY(fk_usuario, fk_grupo),
                FOREIGN KEY(fk_usuario) REFERENCES usuario(CPF),
                FOREIGN KEY(fk_grupo) REFERENCES grupo(ID)
            );

            CREATE TABLE reuniao(
                data_hora timestamp NOT NULL,
                descricao text,
                assunto varchar(50),
                fk_grupo integer NOT NULL,
                fk_ambiente integer NOT NULL,
                PRIMARY KEY (data_hora, fk_grupo),
                FOREIGN KEY (fk_grupo) REFERENCES grupo(ID),
                FOREIGN KEY (fk_ambiente) REFERENCES ambiente(ID)
            );

            CREATE TABLE meta(
                ID serial NOT NULL PRIMARY KEY,
                data_limite date NOT NULL,
                data_inicio date NOT NULL,
                nome varchar(50) NOT NULL,
                objetivo text NOT NULL
            );

            CREATE TABLE acao_meta(
                descricao text NOT NULL,
                fk_meta integer NOT NULL,
                PRIMARY KEY (descricao,fk_meta),
                FOREIGN KEY (fk_meta) REFERENCES meta(ID)
            );

            CREATE TABLE categoria_entrada(
                ID serial NOT NULL PRIMARY KEY,
                nome varchar(25) NOT NULL
            );

            CREATE TABLE categoria_saida(
                ID serial NOT NULL PRIMARY KEY,
                nome varchar(25) NOT NULL
            );

            CREATE TABLE entrada(
                ID serial NOT NULL PRIMARY KEY,
                valor real NOT NULL,
                data_hora timestamp NOT NULL,
                fk_usuario varchar(11) NOT NULL,
                fk_categoria integer NOT NULL,
                fk_culto timestamp,
                FOREIGN KEY (fk_usuario) REFERENCES usuario(CPF),
                FOREIGN KEY (fk_categoria) REFERENCES categoria_entrada(ID),
                FOREIGN KEY (fk_culto) REFERENCES culto(data_hora)
            );

            CREATE TABLE saida(
                ID serial NOT NULL PRIMARY KEY,
                valor real NOT NULL,
                data_hora timestamp NOT NULL,
                fk_categoria integer NOT NULL,
                FOREIGN KEY (fk_categoria) REFERENCES categoria_saida(ID)
            );

        "
        );
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}
