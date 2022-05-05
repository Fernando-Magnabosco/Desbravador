<?php
include 'layout/navbar.php';
include_once '../controller/login_functions.php';
if (!esta_logado()) {
    header('Location: login.php');
    exit();
}
?>


<html lang='pt'>

<head>

    <link href='../src/calendar/main.css' rel='stylesheet' />
    <script src='../src/calendar/main.js'></script>
    <title>Agenda</title>

</head>

<body>

    <!-- <a href="cadastro.php"> cadastro</a>
    <a href="login.php"> login</a>
    <a href="logoff.php"> logoff</a> -->

    <div id="calendar"></div>



    <script src="../src/calendar.js"></script>
    <script src="../src/navbar.js"></script>
    <script>
        changeCalendarBtnColor();
    </script>
</body>




</html>