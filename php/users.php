<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = $conn->prepare("SELECT * FROM users WHERE NOT unique_id = ? ORDER BY user_id DESC");
    $sql->bind_param('i', $outgoing_id);
    $sql->execute();
    $output = "";
    $res = $sql->get_result();
    if($res->num_rows == 0){
        $output .= "Żaden użytkownik nie jest dostępny na czacie";
    }elseif($res->num_rows > 0){
        include_once "data.php";
    }
    echo $output;
?>