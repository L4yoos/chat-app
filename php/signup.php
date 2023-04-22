<?php
    session_start();
    include_once "config.php";
    $fname = $conn->real_escape_string($_POST['fname']);
    $lname = $conn->real_escape_string($_POST['lname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $sql->bind_param('s', $email);
            $sql->execute();
            $sql->store_result();
            if($sql->num_rows > 0){
                echo "$email - Ten e-mail już istnieje!";
            }else{
                if(isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    
                    $img_explode = explode('.',$img_name);
                    $img_ext = end($img_explode);
    
                    $extensions = ["jpeg", "png", "jpg"];
                    if(in_array($img_ext, $extensions) === true){
                        $types = ["image/jpeg", "image/jpg", "image/png"];
                        if(in_array($img_type, $types) === true){
                            $time = time();
                            $new_img_name = $time.$img_name;
                            if(move_uploaded_file($tmp_name,"images/".$new_img_name)){
                                $ran_id = rand(time(), 100000000);
                                $status = "Dostępny";
                                $encrypt_pass = md5($password);
                                $sql = $conn->prepare("INSERT INTO `users` (`unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?)");
                                $sql->bind_param('issssss', $ran_id, $fname, $lname, $email, $encrypt_pass, $new_img_name, $status);
                                $sql->execute();
                                if($sql){
                                    $sql2 = $conn->prepare("SELECT * FROM users WHERE email = ?");
                                    $sql2->bind_param('s', $email);
                                    $sql2->execute();
                                    $res = $sql2->get_result();
                                    if($res->num_rows > 0){
                                        $result = $res->fetch_assoc();
                                        $_SESSION['unique_id'] = $result['unique_id'];
                                        echo "success";
                                    }else{
                                        echo "Ten adres e-mail nie istnieje!";
                                    }
                                }else{
                                    echo "Coś poszło nie tak. Proszę spróbować ponownie!";
                                }
                            }
                        }else{
                            echo "Prosimy o przesłanie pliku graficznego - jpeg, png, jpg";
                        }
                    }else{
                        echo "Prosimy o przesłanie pliku graficznego - jpeg, png, jpg";
                    }
                }
            }
        }else{
            echo "$email to nie jest prawidłowy e-mail!";
        }
    }else{
        echo "Wszystkie pola wejściowe są wymagane!";
    }
?>