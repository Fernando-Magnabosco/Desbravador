<?php include 'header.html';
include_once '../controller/login_functions.php';
?>

<html>




<body>

    <div id="navbar">

        <div id="texts">
            <h1>IGREJA DO EVANGELHO QUADRANGULAR</h1>

        </div>
        <div id="buttons">

            <a href="index.php" id="calendar-btn">
                <i class="fa-regular fa-calendar fa-2x"></i>
            </a>

            <button id="opmenu-btn">
                <i class="fa-solid fa-bars fa-2x"></i>
            </button>

        </div>


    </div>


    <script src="../../src/navbar.js"></script>


    <?php if (esta_logado()) {
        $cpf = htmlentities($_SESSION['cpf']);
        $tipo = htmlentities($_SESSION['tipo']);
        echo "<script> navBarUserInformation('$cpf','$tipo') </script>";
    } ?>



</body>






</html>