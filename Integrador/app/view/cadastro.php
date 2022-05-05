<?php

include 'layout/navbar.php';
include_once '../controller/login_functions.php';
include_once '../controller/cadastro_functions.php';

if (!esta_logado()) {
    header('Location: login.php');
    exit();
}
redir_tipo();

$submitted = isset($_POST['submit']);

if ($submitted)
    $result = cadastro($db);

?>

<html>

<head>
    <title>Cadastro membro</title>
</head>

<body>

    <h1 class="main-text">Cadastro</h1>
    <div id="cadastro" class="centralize-w-navbar">

        <form action="cadastro.php" method="post">

            <table>

                <tr>
                    <td> <label for="cpf">CPF *</label> </td>

                    <td> <input id="cpf" <?php if ($submitted && $result['CPF'] == 0) echo "style='border-color:red'"; ?> name="cpf" type="text" placeholder="000.000.000-00" minlength="11" maxlength="14"></td>
                </tr>
                <tr>
                    <td> <label for="nome">Nome *</label> </td>
                    <td> <input id="nome" <?php if ($submitted && $result['nome'] == 0) echo "style='border-color:red'"; ?> name="nome" type="text" maxlength="100"></td>
                </tr>
                <tr>
                    <td> <label for="ntel">Telefone *</label></td>
                    <td> <input id="ntel" <?php if ($submitted && $result['ntel'] == 0) echo "style='border-color:red'"; ?>name="ntel" type="text" placeholder="(00) 00000-0000" minlength="10" maxlength="14"></td>
                </tr>
                <tr>
                    <td> <label for="email">E-mail *</label> </td>
                    <td> <input id="email" <?php if ($submitted && $result['email'] == 0) echo "style='border-color:red'"; ?> name="email" type="email" maxlength="100"></td>
                </tr>
                <tr>
                    <td> <label for="data_nascimento">Data de Nascimento *</label> </td>
                    <td> <input id="data_nascimento" <?php if ($submitted && $result['data_nascimento'] == 0) echo "style='border-color:red'"; ?> name="data_nascimento" type="date"></td>
                </tr>
                <tr>
                    <td>
                        <p>Tipo *</p>
                    </td>
                    <td>
                        <input id="administrador" name="tipo" type="radio" value="A">
                        <label for="administrador"> Administrador </label> <br>
                        <input id="usuario" name="tipo" type="radio" value="U">
                        <label for="usuario"> Usuário </label> <br>
                        <input id="frequentador" name="tipo" type="radio" value="F">
                        <label for="frequentador"> Frequentador </label> <br>
                    </td>
                </tr>
                <tr>
                    <td> <label for="cargo">Cargo</label> </td>
                    <td> <input id="cargo" <?php if ($submitted && $result['cargo'] == 0) echo "style='border-color:red'"; ?>name="cargo" type="text" maxlength="50"></td>
                </tr>
                <tr>
                    <td> <label for="logradouro">Logradouro</label> </td>
                    <td> <input id="logradouro" name="logradouro" type="text" maxlength="150"></td>
                </tr>
                <tr>
                    <td> <label for="numero">Número</label> </td>
                    <td> <input id="numero" name="numero" type="text" maxlength="4"></td>
                </tr>
                <tr>
                    <td> <label for="complemento">Complemento</label> </td>
                    <td> <input id="complemento" name="complemento" type="text" maxlength="50"></td>
                </tr>
                <tr>
                    <td> <label for="cep">CEP</label> </td>
                    <td> <input id="cep" name="cep" type="text" placeholder="00000000" maxlength="8"></td>
                </tr>


            </table>

            <div class="align-right">
                <button type="submit" name="submit">
                    <i class="fa-solid fa-arrow-right fa-3x"></i>
                </button>
            </div>


        </form>
    </div>


</body>







</html>