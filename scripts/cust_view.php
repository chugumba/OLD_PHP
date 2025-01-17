<?php

header('Content-Type: text/html; charset=utf-8');
session_start();
if ($_SESSION["position"] != "accountant" && $_SESSION["position"] != "admin" && $_SESSION["position"] != "HR") {
    header("Location: http://localhost/course/index.php");
    exit;
}


echo'<h1>Клиенты</h1>';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "course";

// Создаем подключение
$conn = new mysqli($servername, $username, $password, $dbname);

mysqli_set_charset($conn, "utf8");

// Проверяем подключение
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Выполняем SQL запрос для получения данных из таблицы "customers"
$sql = "SELECT cid, cname, city FROM customers";
$result = $conn->query($sql);

// Проверяем, есть ли данные
if ($result->num_rows > 0) {
    // Создаем таблицу
    echo "<table border=1><tr><th>ID</th><th>Name</th><th>City</th></tr>";
    // Выводим данные каждой строки
    while($row = $result->fetch_assoc()) {
        // Заполняем таблицу данными
        echo "<tr><td>" . $row["cid"]. "</td><td>" . $row["cname"]. "</td><td>" . $row["city"]. "</td></tr>";
    }
    // Закрываем таблицу
    echo "</table>";
}
 else {
    echo "0 результатов";
}

// Закрываем подключение
$conn->close();
echo'<br><a href="javascript:history.back()">Назад</a>';
?>

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
    table {
    border-collapse: collapse;
    margin: 20px auto;
    font-size: 1.2em;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

table th,
table td {
    padding: 8px 5px;
}

table th {
    background-color: #4CAF50;
    color: white;
    text-align: left;
}

table tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

table tr:hover {
    background-color: #ddd;
}

table td:last-child {
    text-align: center;
}

table input[type="text"] {
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
    width: 100%;
    box-sizing: border-box;
}

table select {
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
    width: 100%;
    box-sizing: border-box;
}

table input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

table input[type="submit"]:hover {
    background-color: #3e8e41;
}
form {
  width: 90%;
  margin: 0 auto;
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}
label {
  margin-right: 5px;  
  display: block;
  margin-bottom: 10px;
  font-weight: bold;
}

     input[type="text"],
input[type="password"] {
    padding: 1px;
    border: 2px solid black; /* добавляем рамку */
    border-radius: 5px;
    margin-bottom: 5px;
    margin-right: 5px;
    width: 25%;
    box-sizing: border-box;
}</style>