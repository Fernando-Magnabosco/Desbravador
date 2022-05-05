<?php

include 'layout/navbar.php';
include '../controller/culto_functions.php';

if (!esta_logado()) {
    header('Location: login.php');
    exit();
}
redir_tipo();

$submitted = isset($_POST['submit']);

if ($submitted)
    cadastraCulto($db);

?>

<html>

<head>
    <title>Cadastro de Culto</title>
</head>

<body>



    <div id="culto">

        <div class="main-text">
            Culto
            <input id="data" name="data" type="text" placeholder="dd/mm/yyyy" maxlength="10" form="1">
            <br>
            <input id="total" name="total" placeholder="Total de Presentes" type="number" min="0" form="1">
        </div>

        <div class=" secondary-text">
            <input id="hora" name="hora" type="text" placeholder="hh:mm" maxlength="5" form="1">
        </div>


        <div class="divide-screen-half">
            <form action="culto.php" id="1" method="post">
                <table>
                    <tbody id="ambientes">
                        <tr>
                            <td>
                                <label for="ambiente">Sala:</label>
                            </td>
                            <td>
                                <select name="ambiente" id="ambiente"></select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

        </div>


        <span class="half-screen-text"> Escala de Trabalho </span>

        <div class="divide-screen-half" style="flex-wrap:wrap">

            <table class="escala">
                <tbody id="pessoas"></tbody>



            </table>


            <button id="addPessoa"> <i class="fa-solid fa-plus fa-3x"></i></button>
            <button type="submit" name="submit" style="margin-left:10%" form="1"><i class="fa-solid fa-arrow-right-long fa-3x"></i></button>

            <div style="height:100px; width:100%"></div>
        </div>




    </div>

    <script src="../src/culto.js"></script>

</body>

</html>