<?php
session_start();
$con = new PDO('mysql:host=localhost;dbname=onlinedukon','root','root');
if(isset($_POST['edit'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $count = $_POST['count'];
    $category = $_POST['category_id'];
    $user = $_SESSION['id'];

    $sql = "UPDATE products SET name='{$name}',price='{$price}',count='{$count}' WHERE id='{$_POST['id']}'";

    $con->exec($sql);

    $_SESSION['alert'] = "success";
    $_SESSION['text'] = "Product successfully edited!!!";
    header("location:adminProducts.php");
}


?>