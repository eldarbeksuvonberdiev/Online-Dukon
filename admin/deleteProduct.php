<?php
session_start();

$con = new PDO("mysql:host=localhost;dbname=onlinedukon",'root','root');
if(isset($_POST['delete'])){
    $id = $_POST['id'];

    $sql = "DELETE FROM products WHERE id='{$id}'";
    $con->exec($sql);
    $_SESSION['alert'] = "danger";
    $_SESSION['text'] = "Product successfully deleted!!!";
    header("location:products.php");
}
?>