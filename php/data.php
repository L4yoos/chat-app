<?php
    while($row = $res->fetch_assoc()){
        $sql2 = $conn->prepare("SELECT * FROM messages WHERE (incoming_msg_id = ?
                OR outgoing_msg_id = ?) AND (outgoing_msg_id = ? 
                OR incoming_msg_id = ?) ORDER BY msg_id DESC LIMIT 1");
        $sql2->bind_param('iiii', $row['unique_id'], $row['unique_id'], $outgoing_id, $outgoing_id);
        $sql2->execute();
        $res2 = $sql2->get_result();
        $row2 = $res2->fetch_assoc();
        ($res2->num_rows > 0) ? $result = $row2['msg'] : $result ="Brak wiadomości";
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "Ty: " : $you = "";
        }else{
            $you = "";
        }
        ($row['status'] == "Niedostępny") ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";

        $output .= '<a href="chat.php?user_id='. $row['unique_id'] .'">
                    <div class="content">
                    <img src="php/images/'. $row['img'] .'" alt="">
                    <div class="details">
                        <span>'. $row['fname']. " " . $row['lname'] .'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>
                    <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                </a>';
    }
?>