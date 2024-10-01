<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=onlinedukon", 'root', 'root');

if (isset($_POST['accept'])) {
    $id = $_POST['id'];
    $sql = "UPDATE orders SET status=2 WHERE id='{$id}'";
    $sttm = $con->exec($sql);

    if ($sttm) {
        $sql = "UPDATE products SET count = count - '{$_POST['count']}' WHERE id='{$_POST['product']}'";
        $result = $con->exec($sql);
        if ($result) {
            $_SESSION['alert'] = 'success';
            $_SESSION['text'] = 'Buyurtma Qabul qilindi!!!';
            header("location:orders.php");
        }
    } else {
        $_SESSION['alert'] = 'alert';
        $_SESSION['text'] = 'Buyurtma Qabul qilishda xatolik yuz berdi!!!';
        header("location:orders.php");
    }
}
if (isset($_POST['reject'])) {
    $id = $_POST['id'];
    $sql = "UPDATE orders SET status=0 WHERE id='{$id}'";
    $sttm = $con->exec($sql);

    if ($sttm) {
        $_SESSION['alert'] = 'danger';
        $_SESSION['text'] = 'Buyurtma bekor qilindi!!!';
        header("location:orders.php");
    } else {
        $_SESSION['alert'] = 'alert';
        $_SESSION['text'] = 'Buyurtma bekor qilishda xatolik yuz berdi!!!';
        header("location:orders.php");
    }
}
