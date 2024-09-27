<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=onlinedukon",'root','root');
if(isset($_POST['edit']) && !empty($_POST['editname']) && !empty($_POST['edittr'])  && !empty($_POST['editstatus'])){

    $id = $_POST['id'];
    $name = $_POST['editname'];
    $tr = $_POST['edittr'];
    $status = $_POST['editstatus'];
    $sql = "UPDATE categories SET name='{$name}', tr='{$tr}',active='{$status}' WHERE id = '{$id}'";
    $con->exec($sql);

    $_SESSION['alert'] = "success";
    $_SESSION['text'] = "Category successfully edited!!!";
    header("location:index.php");
    
}else{
    $_SESSION['alert'] = "alert";
    $_SESSION['text'] = "All of the fields are shuild be filled!!!";
    header("location:index.php");
}

?>