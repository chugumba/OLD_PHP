<?php
session_start();
if ($_SESSION["position"] != "HR") {
    header("Location: http://localhost/course/index.php");
    exit;
}

echo "<h1>Клиенты</h1>";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "course";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT cid, cname, city FROM customers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border=1>";
    echo "<tr><th>ID</th><th>Имя</th><th>Город</th><th>Действие</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><form action='hrm.php' method='get'><td>" . $row["cid"] . "</td><td><input type='text' name='cname' value='" . $row["cname"] . "' required></td><td><input type='text' name='city' value='" . $row["city"] . "' required></td><td><input type='hidden' name='cid' value='" . $row["cid"] . "'><input type='submit' name='action' value='Удалить'><input type='submit' name='action' value='Обновить'></td></form></tr>";
    }
    echo "</table>";
} else {
    echo "0 результатов";
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["action"])) {
    $cid = $_GET["cid"];
    $cname = $_GET["cname"];
    $city = $_GET["city"];
    $action = $_GET["action"];

    if ($action == "Удалить") {
        $sql = "DELETE FROM customers WHERE cid='$cid'";
        if (mysqli_query($conn, $sql)) {
            echo "Запись успешно удалена";
        } else {
            echo "Ошибка: " . mysqli_error($conn);
        }
    } elseif ($action == "Обновить") {
        $sql = "SELECT * FROM customers WHERE (cname ='$cname') AND cid !='$cid'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "Ошибка: запись с таким же именем или городом уже существует";
        } else {
            $sql = "UPDATE customers SET cname='$cname', city='$city' WHERE cid='$cid'";
            if (mysqli_query($conn, $sql)) {
                echo "Запись успешно обновлена";
            } else {
                echo "Ошибка: " . mysqli_error($conn);
            }
        }
    } elseif($action == "Добавить") {
        $sql = "SELECT * FROM customers WHERE cname='$cname'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "Ошибка: запись с таким же именем уже существует";
        } else {
            $sql = "INSERT INTO customers (cname, city) VALUES ('$cname', '$city')";
            if (mysqli_query($conn, $sql)) {
                echo "Запись успешно добавлена";
            } else {
                echo "Ошибка: " . mysqli_error($conn);
            }
        }
    }

echo "<script>
    setTimeout(() => {
        window.location.href = 'http://localhost/course/scripts/hrm.php';
    }, 800);
</script>
";

}

$conn->close();
?>

<head>

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
}

</style>
</head>
<h1>Добавить клиента</h1>
<form action="hrm.php" method="get">
    <label for="cname">Имя:</label>
    <input type="text" name="cname" id="cname" required><br>
    <label for="city">Город:</label>
    <input type="text" name="city" id="city" required><br>

    <input type="submit" name="action" value="Добавить">
    <br>
    <button type="submit" onclick="document.location='http://localhost/course/users/HR.php'">Назад</button>
</form>

<script>
    const textFields = document.querySelectorAll('input[type="text"]:not(#cname):not(#city)');
    document.addEventListener('click', (event) => {

        if (!event.target.matches('input[type="text"]') && !event.target.matches('input[type="submit"]')) {

            textFields.forEach((textField) => {
                textField.value = textField.defaultValue;
            });
        }
    });

</script>
