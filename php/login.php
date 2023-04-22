<?php 
    session_start();
    include_once "config.php";
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    if(!empty($email) && !empty($password)){
        $sql = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $sql->bind_param('s', $email);
        $sql->execute();
        $res = $sql->get_result();
        if($res->num_rows > 0){
            $row = $res->fetch_assoc();
            $user_pass = md5($password);
            $enc_pass = $row['password'];
            if($user_pass === $enc_pass){
                $status = "Dostępny";
                $sql2 = $conn->prepare("UPDATE users SET status = ? WHERE unique_id = ?");
                $sql2->bind_param('si', $status, $row['unique_id']);
                $sql2->execute();
                if($sql2){
                    $_SESSION['unique_id'] = $row['unique_id'];
                    echo "success";
                }else{
                    echo "Coś poszło nie tak. Proszę spróbować ponownie!";
                }
            }else{
                echo "Nieprawidłowy e-mail lub hasło!";
            }
        }else{
            echo "$email - Ten e-mail nie istnieje!";
        }
    }else{
        echo "Wszystkie pola wejściowe są wymagane!";
    }
?>