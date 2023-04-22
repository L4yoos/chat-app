<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = $conn->real_escape_string($_POST['incoming_id']);
        $output = "";
        $sql = $conn->prepare("SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = ? AND incoming_msg_id = ?)
                OR (outgoing_msg_id = ? AND incoming_msg_id = ?) ORDER BY msg_id");
        $sql->bind_param('iiii', $outgoing_id, $incoming_id, $incoming_id, $outgoing_id);
        $sql->execute();
        $res = $sql->get_result();
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class="chat incoming">
                                <img src="php/images/'.$row['img'].'" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">Nie są dostępne żadne wiadomości. Po wysłaniu wiadomości pojawią się one tutaj.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>