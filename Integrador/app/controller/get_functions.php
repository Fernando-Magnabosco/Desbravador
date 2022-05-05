<?php

header('Content-Type: application/json');
include_once 'db.php';

$str = file_get_contents('php://input');
$json = json_decode($str, true);
if ($json['id'] == 0) getAmbientes($db);
if ($json['id'] == 1) getPessoasComFuncao($db);
if ($json['id'] == 2) getFuncoesPorPessoa($db, $json['cpf']);
if ($json['id'] == 3) getCultosNaData($db, $json['mes'], $json['ano']);

function getAmbientes($db)
{
    try {
        $query = $db->prepare("SELECT * FROM ambiente");
        $query->execute();
        $ambientes = $query->fetchAll();
        echo json_encode($ambientes);
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}

function getPessoasComFuncao($db)
{

    try {
        $query = $db->prepare("SELECT DISTINCT u.cpf,u.nome FROM usuario u JOIN usuario_pode_exercer e on u.cpf = e.fk_usuario");
        $query->execute();
        $pessoas = $query->fetchAll();
        echo json_encode($pessoas);
    } catch (Exception $e) {
        echo $e->getMessage();
        exit();
    }
}

function getFuncoesPorPessoa($db, $cpf)
{
    try {
        $query = $db->prepare("SELECT f.id, f.descricao FROM funcao f JOIN usuario_pode_exercer e on e.fk_funcao = f.id JOIN usuario u on e.fk_usuario = u.cpf WHERE u.cpf = :cpf");
        $query->bindParam(':cpf', $cpf);
        $query->execute();
        $funcoes = $query->fetchAll();
        echo json_encode($funcoes);
    } catch (Exception $e) {
        echo $e->getMessage();
        exit();
    }
}

function getCultosNaData($db, $mes, $ano)
{
    try {
        $query = $db->prepare("SELECT c.*, a.nome FROM culto c JOIN ambiente a ON c.fk_ambiente = a.id WHERE c.data_hora BETWEEN :data1 AND :data2");
        $data1 = $ano . '-' . $mes . '-01';
        $data2 = $ano . '-' . $mes + 1 . '-01';
        $query->bindParam(':data1', $data1);
        $query->bindParam(':data2', $data2);
        $query->execute();
        $cultos = $query->fetchAll();
        echo json_encode($cultos);
    } catch (Exception $e) {
        echo $e->getMessage();
        exit();
    }
}
