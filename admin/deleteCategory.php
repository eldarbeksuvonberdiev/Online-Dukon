<?php
session_start();

$con = new PDO("mysql:host=localhost;dbname=onlinedukon",'root','root');
if(isset($_POST['delete'])){
    $id = $_POST['id'];

    $sql = "DELETE FROM categories WHERE id='{$id}'";
    $con->exec($sql);
    $_SESSION['alert'] = "danger";
    $_SESSION['text'] = "Category successfully deleted!!!";
    header("location:index.php");
}

?>