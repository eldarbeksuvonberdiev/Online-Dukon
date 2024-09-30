<?php
if(isset($_POST['checkout'])){
    if(!isset($_SESSION['id'])){
        header("location:login.php");
    }else{
        
    }
}

?>