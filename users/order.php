<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=onlinedukon", "root", "root");
if (isset($_POST['checkout'])) {
    if(!isset($_SESSION['id'])){
        header("Location:login.php");
    }else{
        foreach($_SESSION['carts'] as $cart){
            $sql = "SELECT * FROM products WHERE id = '{$cart['id']}'";
            $result = $con->query($sql);
            $product = $result->fetch(PDO::FETCH_ASSOC);
            $sql = "INSERT INTO orders(client_id,owner_id,product_id,count,status) VALUES ('{$_SESSION['id']}','{$cart['user_id']}','{$cart['id']}','{$_POST['quantity']}','1')";
            $con->query($sql);    
        }
        unset($_SESSION['carts']);
        // $_SESSION['carts'] = [];
        header("location:index.php");
    }
}
