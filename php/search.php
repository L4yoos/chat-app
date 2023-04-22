<?php
    session_start();
    include_once "config.php";

    $outgoing_id = $_SESSION['unique_id'];
    $searchTerm = $conn->real_escape_string($_POST['searchTerm']);
    $searchTerm = '%'.$searchTerm.'%';

    $sql = $conn->prepare("SELECT * FROM users WHERE NOT unique_id = ? AND (fname LIKE ? OR lname LIKE ?)");
    $sql->bind_param('iss', $outgoing_id, $searchTerm, $searchTerm);
    $sql->execute();
    $output = "";
    $res = $sql->get_result();
    if($res->num_rows > 0){
        include_once "data.php";
    }else{
        $output .= 'Nie znaleziono użytkownika związanego z wyszukiwanym słowem!';
    }
    echo $output;
?>