<?php

session_start();
if(isset($_SESSION['login'])){
    $admin = $_SESSION['admin'];
    if($admin == 1){
        header("Location: admin");
    }else{
        header("Location: user");
    }
}else{
    header("Location: login");
}