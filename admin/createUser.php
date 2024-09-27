<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=onlinedukon",'root','root');

if(isset($_POST['add']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $password = md5($password);

    $sql ="INSERT INTO users(name,email,password,role) VALUES ('{$name}','{$email}','{$password}','{$role}')";

    $result = $con->exec($sql);
    
    if($result){
        $_SESSION['alert'] = 'success';
        $_SESSION['message'] = 'Yangi foydalanuvchi qo\'shildi';
        header("location:users.php");
    }
}else{
    $_SESSION['alert'] = 'warning';
    $_SESSION['text'] = 'barcha ma\'lumotlarni to\'ldiring';
    header("location:users.php");
}


?>