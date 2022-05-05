<?php
include_once 'db.php';
include_once 'sanitize_functions.php';
header("Content-Type: text/html; charset=utf-8");


function cadastro($db)
{

    $resultArray = [
        'CPF' => isset($_POST['cpf']),
        'nome' => isset($_POST['nome']),
        'ntel' => isset($_POST['ntel']),
        'email' => isset($_POST['email']),
        'data_nascimento' => isset($_POST['data_nascimento']),
        'tipo' => isset($_POST['tipo']),
        'cargo' => isset($_POST['cargo']),
        'logradouro' => isset($_POST['logradouro']),
        'numero' => isset($_POST['numero']),
        'complemento' => isset($_POST['complemento']),
        'cep' => isset($_POST['cep'])
    ];
    if (!$resultArray['CPF']) return $resultArray;

    $cpf = sanitize_cpf($_POST['cpf']);
    $query = $db->prepare("SELECT CPF FROM usuario WHERE CPF = :cpf");
    $query->execute([':cpf' => $cpf]);
    if ($query->fetch()) {
        $resultArray['CPF'] = 0;
        return $resultArray;
    } else if (!is_numeric($cpf)) {
        $resultArray['CPF'] = 0;
        return $resultArray;
    } else if (strlen($cpf) != 11) {
        $resultArray['CPF'] = 0;
        return $resultArray;
    } else if (
        $resultArray['nome'] && $resultArray['ntel'] && $resultArray['email']
        && $resultArray['data_nascimento'] && $resultArray['tipo']
    ) {
        try {
            $senha = generate_password();
            $query = $db->prepare(
                "INSERT INTO usuario (CPF, nome, senha, ntel, email, data_nascimento, tipo, 
            cargo, e_logradouro, e_numero, e_complemento, e_cep)
            VALUES (:cpf, :nome, :senha, :ntel, :email, :data_nascimento, :tipo, :cargo,
            :logradouro, :numero, :complemento, :cep)"
            );

            $query->execute([
                ':cpf' => $cpf,
                ':nome' => $_POST['nome'],
                ':senha' => password_hash($senha, PASSWORD_DEFAULT),
                ':ntel' => sanitize_phone($_POST['ntel']),
                ':email' => $_POST['email'],
                ':data_nascimento' => $_POST['data_nascimento'],
                ':tipo' => $_POST['tipo'],
                ':cargo' => $resultArray['cargo'] ? $_POST['cargo'] : null,
                ':logradouro' => $resultArray['logradouro'] ? $_POST['logradouro'] : null,
                ':numero' => $resultArray['numero'] ? $_POST['numero'] : null,
                ':complemento' => $resultArray['complemento'] ? $_POST['complemento'] : null,
                ':cep' => $resultArray['cep'] ? sanitize_cep($_POST['cep']) : null
            ]);
            echo "
            <div class = 'centralize-w-navbar' style:'flex-wrap:wrap'>
            <div>
            <h1>Cadastro realizado com sucesso!</h1> <br>
            <p> Sua senha: $senha </p> <br>
            <a href = 'index.php'>Voltar para a agenda</a>
            </div>
            </div>
            ";
            exit();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }
    return $resultArray;
}

function generate_password()
{

    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); 
    $alphaLength = strlen($alphabet) - 1; 
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); 
}
