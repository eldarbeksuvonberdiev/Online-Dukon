<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=onlinedukon",'root','root');

$name = htmlspecialchars($_POST['name']);
$price = $_POST['price'];
$count = $_POST['count'];
$premium = $_POST['premium'];
$category = $_POST['category'];
$user = $_SESSION['id'];

$img = $_FILES['img']['name'];
$data = explode('.', $img);
$filepath = date('Y-m-d_H-i-s_') . '.' . $data[1];
move_uploaded_file($_FILES['img']['tmp_name'],'images/'.$filepath);

if(isset($_POST['add'])){
    $sql = "INSERT INTO products(name,price,img,count,premium,user_id,category_id,start_date,end_date) VALUES('{$name}','{$price}','images/{$filepath}','{$count}','{$premium}','{$user}','{$category}',NOW(),NOW())";

    $con->exec($sql);
    
    $_SESSION['alert'] = "success";
    $_SESSION['text'] = "Product successfully created!!!";
    header("location:adminProducts.php");

}

?>