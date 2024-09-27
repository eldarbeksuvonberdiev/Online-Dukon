<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=onlinedukon", 'root', 'root');

if(isset($_POST['edit']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['role'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $newpassword = md5($newpassword);

    
    if(!($password === $_POST['newpassword'])){
        $sql = "UPDATE users SET name='{$name}', email='{$email}', role='{$role}' WHERE id='{$_POST['id']}'";
    }else{
        $sql = "UPDATE users SET name='{$name}', email='{$email}', role='{$role}', password='{$newpassword}' WHERE id='{$_POST['id']}'";
    }
    $result = $con->query($sql);

    $_SESSION['alert'] = "success";
    $_SESSION['text'] = "User muvaffaqiyatli yangilandi!!!";
    header("location:users.php");
}else{
    $_SESSION['alert'] = "warning";
    $_SESSION['text'] = "Barcha ma'lumotlarni to'ldiring!!!";
    header("location:users.php");
}


?>