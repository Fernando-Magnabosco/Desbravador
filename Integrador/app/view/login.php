<?php
include 'layout/header.html';
include_once '../controller/login_functions.php';

$login_result = login($db);

if (esta_logado()) {
    header('Location: index.php');
    exit();
}


?>

<html>

<head>
    <title>Login</title>
</head>

<body>

    <div id="login">

        <h1 class="main-text">Login</h1>
        <div class="centralize">
            <form action="login.php" method="post">

                <label for="cpf">CPF</label>
                <input id="cpf" name="cpf" type="text" placeholder="000.000.000-00" minlength="11" maxlength="14">
                <?php
                if ($login_result == 0)
                    echo "<p class='error'>CPF inválido</p>";
                else if ($login_result == 1)
                    echo "<p class='error'>CPF não cadastrado</p>";
                else echo "<div class = 'h-10'></div>";
                ?>
                <label for="password">Senha</label>
                <input id="password" name="password" type="password" minlength="8">
                <?php
                if ($login_result == 2)
                    echo "<p class='error'>Senha incorreta</p>";
                else echo "<div class = 'h-10'></div>";
                ?>
                <div class="align-right">
                    <button type="submit">
                        <i class="fa-solid fa-arrow-right-to-bracket fa-3x"></i>
                    </button>
                </div>

            </form>
        </div>
    </div>

</body>







</html>