<?php
session_start();

if ($_SESSION["position"] != "accountant") {
    header("Location: http://localhost/course/index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Меню бухгалтера</title>

    <style>
    body {
        background-color: #e5e5f7;
opacity: 0.8;
background-image: radial-gradient(#0cab35 0.9px, #e5e5f7 0.9px);
background-size: 18px 18px;    }
    h1 {
        color: #333;
        text-align: center;
        margin-top: 50px;
    }
    form {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }
    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 10px;
    }
    input[type="submit"]:hover {
        background-color: #3e8e41;
    }
    a {
        display: block;
        text-align: center;
        margin-top: 30px;
        color: #333;
        text-decoration: none;
    }
    a:hover {
        text-decoration: underline;
    }
</style>

</head>
<body>
    <h1>Меню бухгалтера</h1>
    <form action="http://localhost/course/scripts/cust_view.php" method="POST">
        <input type="submit" value="Просмотр клиентов">
    </form>
    <form action="http://localhost/course/scripts/wares.php" method="POST">
        <input type="submit" value="Приход товаров">
    </form>
    <form action="http://localhost/course/scripts/opm.php" method="POST">
        <input type="submit" value="Уход товаров">
    </form>
    <br><a href="http://localhost/course">Назад</a>
</body>
</html>
