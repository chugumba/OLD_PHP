<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "course";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT position FROM users WHERE login = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $position = $row["position"];

        $_SESSION["position"] = $position;

        if ($position == "admin") {
            header("Location: users/admin.php");
            exit;
        } elseif ($position == "accountant") {
            header("Location: users/accountant.php");
            exit;
        } elseif ($position == "HR") {
            header("Location: users/hr.php");
            exit;
        }
    } else {
        $error = "Неверные учетные данные. Пожалуйста, попробуйте еще раз.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Авторизация</title>
    <style>
    body {
    margin: auto;
    font-family: -apple-system, BlinkMacSystemFont, sans-serif;
    overflow: auto;
    background: linear-gradient(315deg, rgba(101,0,94,1) 3%, rgba(60,132,206,1) 38%, rgba(48,238,226,1) 68%, rgba(255,25,25,1) 98%);
    animation: gradient 15s ease infinite;
    background-size: 400% 400%;
    background-attachment: fixed;
}

@keyframes gradient {
    0% {
        background-position: 0% 0%;
    }
    50% {
        background-position: 100% 100%;
    }
    100% {
        background-position: 0% 0%;
    }
}

.wave {
    background: rgb(255 255 255 / 25%);
    border-radius: 1000% 1000% 0 0;
    position: fixed;
    width: 200%;
    height: 12em;
    animation: wave 10s -3s linear infinite;
    transform: translate3d(0, 0, 0);
    opacity: 0.8;
    bottom: 0;
    left: 0;
    z-index: -1;
}

.wave:nth-of-type(2) {
    bottom: -1.25em;
    animation: wave 18s linear reverse infinite;
    opacity: 0.8;
}

.wave:nth-of-type(3) {
    bottom: -2.5em;
    animation: wave 20s -1s reverse infinite;
    opacity: 0.9;
}

@keyframes wave {
    2% {
        transform: translateX(1);
    }

    25% {
        transform: translateX(-25%);
    }

    50% {
        transform: translateX(-50%);
    }

    75% {
        transform: translateX(-25%);
    }

    100% {
        transform: translateX(1);
    }
}
    h1 {
        color: #333;
        text-align: center;
        margin-top: 50px;
    }
    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 30px;
    }
    label {
        font-weight: bold;
        margin-bottom: 10px;
    }
    input[type="text"],
input[type="password"] {
    padding: 10px;
    border: 2px solid black; /* добавляем рамку */
    border-radius: 5px;
    margin-bottom: 20px;
    width: 30%;
    box-sizing: border-box;
}

input[type="text"]:focus,
input[type="password"]:focus {
    outline: none;
    border-color: #4CAF50; /* меняем цвет рамки при фокусировке */
}

input[type="text"][value],
input[type="password"][value] {
    border-color: #4CAF50; /* меняем цвет рамки для уже заполненных полей */
}

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px;
    }
    input[type="submit"]:hover {
        background-color: #3e8e41;
    }
    p {
        color: red;
        text-align: center;
        margin-top: 20px;
    }
.bottom-right {
    position: fixed;
    bottom: 0;
    right: 0;
    font-style: italic;
    border: 1px solid black;
    padding: 5px;
    margin-left: 50%; 
}


</style>

</head>

<body>
    <h1>Авторизация</h1>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="username">Имя пользователя:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Войти">
    </form>

    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
  <div>
     <div class="wave"></div>
     <div class="wave"></div>
     <div class="wave"></div>
  </div>
  <div class="bottom-right">Данная ИС позволяет осуществлять работу с ИС склада, управлять системой могут 3 типа пользователей - бухгалтер, администратор или HR. Если вы ещё не зарегистрированы, обратитесь к администратору</div>

</body>


</html>