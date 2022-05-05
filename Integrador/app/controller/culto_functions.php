<?php
include_once 'db.php';
include_once 'sanitize_functions.php';
header("Content-Type: text/html; charset=utf-8");


function cadastraCulto($db)
{

    if (!isset($_POST['data']) || !isset($_POST['hora']) || !isset($_POST['total']))
        return;

    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $total = $_POST['total'];
    $ambiente = $_POST['ambiente'];
    $timestamp = $data . ' ' . $hora;

    try {
        $query = $db->prepare("INSERT INTO escala_de_trabalho(descr) VALUES (:descr)");
        $query->bindValue(':descr', $timestamp);
        $query->execute();
        $id = $db->lastInsertId();

        $query = $db->prepare("INSERT INTO culto(data_hora, total_presentes, fk_escala, fk_ambiente) VALUES (:data_hora, :total_presentes, :fk_escala, :fk_ambiente)");
        $query->bindParam(':data_hora', $timestamp);
        $query->bindParam(':total_presentes', $total);
        $query->bindParam(':fk_escala', $id);
        $query->bindParam(':fk_ambiente', $ambiente);
        $query->execute();

        if (count($_POST) - 5 == 0) return;
        $sql = "INSERT INTO tuplas_escala(fk_usuario,fk_funcao,fk_escala) VALUES ";
        for ($i = 0; $i < (count($_POST) - 5) / 2; $i++) {
            $sql .= "('" . $_POST["p" . $i] . "'," . $_POST["f" . $i] . "," . $id . "),";
        }
        $sql = substr($sql, 0, -1);
        $db->prepare($sql)->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}
