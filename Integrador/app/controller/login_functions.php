<?php

include_once 'db.php';
include_once 'sanitize_functions.php';
session_start();
header("Content-Type: text/html; charset=utf-8");


function esta_logado()
{
    if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] == 1) {
        return true;
    }
    return false;
}

function login($db)
{
    if (!isset($_POST['cpf']) || !isset($_POST['password'])) return -1;

    $cpf = sanitize_cpf($_POST['cpf']);
    if (!is_numeric($cpf))
        return 0;

    $password = $_POST['password'];
    $query = $db->prepare("SELECT senha, tipo FROM usuario WHERE CPF = :cpf");
    $query->execute([':cpf' => $cpf]);
    if (!($user = $query->fetch())) return 1;
    if (!password_verify($password, $user['senha'])) return 2;
    $_SESSION['autenticado'] = 1;
    $_SESSION['cpf'] = $cpf;
    $_SESSION['tipo'] = $user['tipo'];
    return 3;
}

function redir_tipo()
{
    if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'A') {
        header('Location: login.php');
        exit();
    }
}

function logoff()
{
    session_destroy();
    header('Location: login.php');
    exit();
}
