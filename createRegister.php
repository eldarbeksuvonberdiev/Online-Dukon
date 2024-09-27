<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=onlinedukon", 'root', 'root');

if (isset($_POST['ok'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = ($_POST['password']);
    $repeatpassword = $_POST['repeatpassword'];

    if ($password == $repeatpassword) {
        $password = md5($password);
        $sql = "SELECT * FROM users WHERE email='{$email}'";
        $result = $con->query($sql);

        if ($result->rowCount() > 0) {
            $_SESSION['email'] = "Bu email orqali oldin ro'yxatdan o'tilgan!!!";
            header("location:registration.php");
        } else {
            $sql = "INSERT INTO users(name,email,password) VALUES('{$name}','{$email}','{$password}')";
            $result = $con->exec($sql);

            if ($result) {
                $_SESSION['id'] = $con->lastInsertId();
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header("location:users/index.php");
            }
        }
    }
} else {
    $_SESSION['email'] = "Malumotlar to'liqligiga e'tibor bering!";
    header("location:registration.php");
}