<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=onlinedukon", 'root', 'root');

if (isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

    $sql = "SELECT * FROM users WHERE email='{$email}' AND password='{$password}'";
    $result = $con->query($sql);

    if ($result->rowCount() > 0) {
        $user = $result->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        header("location:index.php");
    } else {
        $_SESSION['error'] = "danger";
        $_SESSION['msg'] = "Email yoki parol xato!!!";
        header("location:login.php");
    }
} else {
    $_SESSION['error'] = "danger";
    $_SESSION['msg'] = "Barcha maydonlar to'ldirilishi shart!!!";
    header("location:login.php");
}
