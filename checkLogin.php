<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=onlinedukon", 'root', 'root');

if (isset($_POST['ok']) && !empty($_POST['email']) && !empty($_POST['password'])) {
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

        if ($_SESSION['role'] == 'admin') {
            header("location:admin/index.php");
        } else {
            header("location:admin/adminProducts.php");
        }
    } else {
        $_SESSION['error'] = "Email yoki parol xato";
        header("location:login.php");
    }
} else {
    $_SESSION['error'] = "Email yoki parol to'ldirilmagan";
    header("location:login.php");
}
