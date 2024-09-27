<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=onlinedukon",'root','root');
$name = htmlspecialchars($_POST['name']);
$order = $_POST['order'];
$status = $_POST['status'];
echo $name." ".$order." ".$status;

if(isset($_POST['add'])){

    if($status=="Active"){
        $sql = "INSERT INTO categories(name,tr,active) VALUES('{$name}','{$order}','active')";
    }
    else{
        $sql = "INSERT INTO categories(name,tr) VALUES('{$name}','{$order}')";
    }
    $con->exec($sql);
    
    $_SESSION['alert'] = "success";
    $_SESSION['text'] = "Category successfully created!!!";
    header("location:index.php");

}

?>