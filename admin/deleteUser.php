<?php
session_start();

$con = new PDO("mysql:host=localhost;dbname=onlinedukon",'root','root');
if(isset($_POST['delete'])){
    $id = $_POST['id'];

    $sql = "DELETE FROM users WHERE id='{$id}'";
    $con->exec($sql);
    $_SESSION['alert'] = "danger";
    $_SESSION['text'] = "User successfully deleted!!!";
    header("location:users.php");
}
?>