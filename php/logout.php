<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $logout_id = $conn->real_escape_string($_GET['logout_id']);
        if(isset($logout_id)){
            $status = "Niedostępny";
            $sql = $conn->prepare("UPDATE users SET status = ? WHERE unique_id = ?");
            $sql->bind_param('si', $status, $_GET['logout_id']);
            $sql->execute();
            if($sql){
                session_unset();
                session_destroy();
                header("location: ../login.php");
            }
        }else{
            header("location: ../users.php");
        }
    }else{  
        header("location: ../login.php");
    }
?>